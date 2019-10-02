<?php

namespace App\Shell;
use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\FacebookComponent;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Routing\Router; 
use Cake\I18n\Date;
use Cake\I18n\Time;

class AutoPostFacebookShell extends Shell{
    
    public function postAutoFacebook(){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('FacebookAutos');
        $facebookAutos = $this->FacebookAutos->find('all')
                    //->contain(['Evenements'])
                    ->where(['FacebookAutos.date_debut <' => Time::now(),'FacebookAutos.date_fin >' =>Time::now(), 'FacebookAutos.is_active'=>true]);
        
        //var_dump($facebookAutos->toArray()); die;
        foreach($facebookAutos as $facebookAuto){
            $this->postByIdFacebookAuto($facebookAuto->id);
        }
    }
    
    public function postAutoProgrammeeFacebook(){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('FacebookAutos');
        $facebookAutos = $this->FacebookAutos->find('all')
                    //->contain(['Evenements'])
                    ->where(['FacebookAutos.date_programmee <=' => Time::now(), 'FacebookAutos.is_programmee'=>true]);
        //debug(Time::now());
        //debug($facebookAutos->toArray()); die;
        foreach($facebookAutos as $facebookAuto){
            $this->postByIdFacebookAuto($facebookAuto->id);
        }
    }

    public function postByIdFacebookAuto($idFacebookAuto){ //Par cadre id
        
        $this->loadModel('FacebookAutos');
        $facebookAuto = $this->FacebookAutos->get($idFacebookAuto, [
            'contain' => ['Evenements']
        ]);
        
        //debug($facebookAuto);
        
        $this->loadModel('FacebookAutoSuivis');
        $photoIdAlredySent = $this->FacebookAutoSuivis->find('list',['valueField'=>'photo_id'])
                                        ->where(['facebook_auto_id'=>$idFacebookAuto])
                                        ->toArray();
        
        $this->loadModel("Photos");
        $photos = $this->Photos->find('all')
                ->where(['Photos.deleted'=>false,'Photos.is_in_corbeille'=> false, 'Photos.evenement_id' =>$facebookAuto->evenement_id,'Photos.is_postable_on_facebook'=>true ])
                ->order(['Photos.date_prise_photo' => 'ASC','Photos.heure_prise_photo' => 'ASC']);
        if(!empty($photoIdAlredySent)){
           $photos = $photos->where(['Photos.id NOT IN' => $photoIdAlredySent]);
        }
        
        /*if($idFacebookAuto == 29){
            var_dump($photos->toArray()); 
            debug($photoIdAlredySent);
        }*/
        
        
        ///debug(count($photos->toArray()));
      
        $queue = time();
        foreach($photos as $photo){
            if(!in_array($photo->id, $photoIdAlredySent)){
                $urlPhoto = $photo->url_photo_shell;
                echo '==>'.$urlPhoto;
                $this->FacebookComponent = new FacebookComponent(new ComponentRegistry());
                $_result_post = $this->FacebookComponent->postImage($facebookAuto->token_facebook,$facebookAuto->id_in_facebook,null,$urlPhoto,$facebookAuto->id_album_in_facebook);
                //debug($_result_post);
                if(!empty($_result_post)){
                    if(!empty($_result_post['id'])){
                        echo $photo->id.' ==> Posted';
                        $idPhoto = $photo->id;
                        $this->loadModel('FacebookAutoSuivis');
                        $suivi['facebook_auto_id'] = $facebookAuto->id;
                        $suivi['photo_id'] = $photo->id;
                        $suivi['queue'] = $queue;
                        $facebookAutoSuivi = $this->FacebookAutoSuivis->newEntity();
                        $facebookAutoSuivi = $this->FacebookAutoSuivis->patchEntity($facebookAutoSuivi,$suivi);
                        if ($this->FacebookAutoSuivis->save($facebookAutoSuivi)) {
                            
                        }
                    }
                }
            }
        }        
        
    }

    public function zipPhotoPublie($idEvenement){

        $this->loadModel('FacebookAutos');
        $facebookAuto = $this->FacebookAutos->find()
                                    ->where(['evenement_id' => $idEvenement])
                                    ->first();
        if(!empty($facebookAuto)){
            $this->loadModel('FacebookAutoSuivis');
            $photoIdAlredySent = $this->FacebookAutoSuivis->find('list',['valueField'=>'photo_id'])
                                        ->where(['facebook_auto_id'=>$facebookAuto->id])
                                        ->toArray();
            if(!empty($photoIdAlredySent)){
                $this->loadModel("Photos");
                $photos = $this->Photos->find('all')
                    ->where(['Photos.deleted'=>false,'Photos.is_in_corbeille'=> false, '    Photos.evenement_id' =>$facebookAuto->evenement_id,'Photos.is_postable_on_facebook'=>true ])
                    ->where(['Photos.id IN' => $photoIdAlredySent])
                    ->order(['Photos.date_prise_photo' => 'ASC','Photos.heure_prise_photo' => 'ASC']);
                $outZipPath =  WWW_ROOT."import".DS."download".DS.$evenement->slug.'-facebook.zip';
        
                $zipFile = new ZipArchive();
                $zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
                foreach($photos as $photo){
                    $filePath = $photo->uri_photo;
                    $fileName = pathinfo($filePath,  PATHINFO_BASENAME );
                    $zipFile->addFile($filePath, $fileName);
                }
                $zipFile->close();  
            }
        }
    }
    
}
