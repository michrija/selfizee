<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\RegenerateImageComponent;
use App\Controller\Component\SendComponent; 
use Cake\Core\Configure;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use Cake\ORM\Query;
use Cake\Mailer\Email;
use Cake\Collection\Collection;
use ZipArchive;


class PhotoShell extends Shell
{
    
    public function import($idEvenement = null, $ancienChemin = true){
        $time = new Time('1 month ago');
        
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        //Pour l'import automatique
                                        ->where(['Evenements.date_debut <' => Time::now(),'Evenements.date_fin >' =>$time]);

        if(!empty($idEvenement)){
            $evenements = $evenements->where(['id' => $idEvenement]);
        }
        
        foreach($evenements as $evenement){
            $this->out('Import lancé pour l\événement '.$evenement->id);
            $this->importPhoto($evenement->id, $ancienChemin); 
            //Import vidéo
            $this->importVideo($evenement->id, $ancienChemin);
            $this->out('Terminée ');
        }
        
    }

    public function envoiV2($idEvenement = null){
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all');
        if(!empty($idEvenement)){
            $evenements = $evenements->where(['Evenements.id' => $idEvenement]);
        }

        foreach($evenements as $evenement){
                $this->sendEmailAndSms($evenement->id);
        }

    }
    
    public function envoi($idEvenement = null){
		//die;
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        ->contain([
                                            'Crons' => function ($q) {
                                                return $q->where(['Crons.date_debut <' => Time::now(),'Crons.date_fin >' =>Time::now(), 'Crons.is_active'=>true]);
                                            }
                                        ]);
        //debug($evenements->toArray()); die;
        if(!empty($idEvenement)){
            $evenements = $evenements->where(['Evenements.id' => $idEvenement]);
        }
        
        foreach($evenements as $evenement){
            
            if(!empty($evenement->cron)){
                $this->out('Import lancé pour l\événement '.$evenement->id);
                /**
                 * Cette modification est due à la duplication des photo avec les crons qui sont très proche
                 * **/
                $this->sendEmailAndSmsEvenement($evenement->id, $evenement->cron->is_cron_email, $evenement->cron->is_cron_sms);
                
                $this->out('Terminée ');
            }
        }
    }

    public function envoiProgrammee($idEvenement = null){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        ->contain([
                                            'CronsProgrammes' => function ($q) {
                                                return $q->where([
                                                    'CronsProgrammes.date_programme <=' => Time::now(),
                                                    'CronsProgrammes.is_active_envoi_programme'=>true]);
                                            }
                                        ]);
        //debug($evenements->toArray()); die;
        if(!empty($idEvenement)){
            $evenements = $evenements->where(['Evenements.id' => $idEvenement]);
        }
        
        foreach($evenements as $evenement){
            
            if(!empty($evenement->crons_programme)){
                $this->out('Import lancé pour l\événement '.$evenement->id);
                /**
                 * Cette modification est due à la duplication des photo avec les crons qui sont très proche
                 * **/
                $this->sendEmailAndSmsEvenement($evenement->id, $evenement->crons_programme->is_email_cron_programme, $evenement->crons_programme->is_sms_cron_programme);
                
                $this->out('Terminée ');
            }
        }
    }
    
    //cd /home/manager-selfizee/public_html/ && bin/cake photo importNextCloud 
    public function importNextCloud($idEvenement = null){
        
        $time = new Time('1 month ago');
        
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        //Pour l'import automatique
                                        ->where(['Evenements.date_debut <' => Time::now(),'Evenements.date_fin >' =>$time]);

        if(!empty($idEvenement)){
            $evenements = $evenements->where(['id' => $idEvenement]);
        }
        
        foreach($evenements as $evenement){
            
            for($numBorne = 1;$numBorne<=200;$numBorne++){
                $numBorneSperik = sprintf('%03d', $numBorne);
                $this->out('Import next cloud lancé pour l\événement '.$evenement->id.'pour la borne b'.$numBorne);
                //Pour la borne Classik
                $this->importPhoto($evenement->id, 0, $numBorne, 'b' ); 
                //Pour la borne Spherik
                $this->importPhoto($evenement->id, 0, $numBorneSperik, 's' );
                
                //Import vidéo
                $this->importVideo($evenement->id, 0,$numBorne,'b');  // Classik
                $this->importVideo($evenement->id, 0, $numBorneSperik , 's'); // Shpérique
                //Import Gif
                $this->importGif($evenement->id, 0,$numBorne, 'b');
                $this->importGif($evenement->id, 0,$numBorneSperik, 's');

                //Pour la nouvelle borne
                //Pour la borne Classik
                $this->importPhoto($evenement->id, 0, $numBorne, 'b' , 1); 
                //Pour la borne Spherik
                $this->importPhoto($evenement->id, 0, $numBorneSperik, 's', 1 );
                //Pour event 2552, 2553 : import crop
                if(in_array($evenement->id, ['2552', '2553'])){
                    $this->importPhotoCrop($evenement->id, 0, $numBorne, 'b' );
                }
                
            }
            $this->out('Terminée depuis next cloud');
        }
        
        
    }

    /**
     *  Import vidéo de tous les événements
     *  Exemple : /home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/b99/files/1948
     * **/
    public function importVideo($idEvenement, $ancienChemin = true, $numBorne = 0, $nomBorne = 'b'){
        $this->out('Import video lancé');
        $source = Configure::read('source_photo').$idEvenement.DS.'Videos'.DS;
        if(!$ancienChemin){
             $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.'files'.DS.$idEvenement.DS.'Videos'.DS;
        }
        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
        //debug($source);
        $dirEvenent = new Folder($source);
        $videos = $dirEvenent->find('.*\.mp4', true);
        //debug($videos);
        $queue = time();
        foreach($videos as $video){
                $media = array();
                    $media['type_media'] = 'video';
                    $media['queue'] = $queue;
                    $media['source_upload'] = 'upload';
                    $media['evenement_id'] = $idEvenement;
                    $media['name_origne'] = $video;
                    $media['name'] = $video;
                    $media['name_in_csv'] = $video;

                    $media['miniature_video'] = null;
                    $media['is_miniature_video_generated'] = false;
                    $nameMiniatureVideo = pathinfo($source.DS.$video,PATHINFO_FILENAME).'.wmv'.'.jpg';
                    //debug($nameMiniatureVideo);
                    if(file_exists($source.DS.$nameMiniatureVideo)){
                        

                        $destinationMiniature = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS.'miniature_video'.DS;
                        $dirMinuature  = new Folder($destinationMiniature, true, 0755);
                        if(copy($source.DS.$nameMiniatureVideo, $dirMinuature->pwd().DS.$nameMiniatureVideo)){
                            $media['miniature_video'] = $nameMiniatureVideo;
                            $media['is_miniature_video_generated'] = true;
                        }
                    }
                    
                    $media['is_postable_on_facebook'] = false;
                    $this->loadModel('Photos');
                    $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $media['name_in_csv'],
                                                        'evenement_id' => $idEvenement
                                                        ])->first();
                    //debug($media);
                    //debug($isExiste);
                    if(!$isExiste){
                        $entityPhoto = $this->Photos->newEntity($media);
                       // debug($entityPhoto);
                        if(file_exists($dirEvenent->pwd().DS.$video)){
                            if (copy($dirEvenent->pwd().DS.$video, $destintionPath.DS.$video)) {
                                if($this->Photos->save($entityPhoto)){
                                    rename($source.DS.$entityPhoto->name_origne,$source.DS.$media['name_in_csv']);
                                    $this->out('Video enregistrée '.$idEvenement .' id vidéo '.$entityPhoto->id);
                                }
                            }
                        }
                    }
                
            }
    }
     
    public function importPhotoCropLocal($idEvenement, $ancienChemin = true, $numBorne = 0, $nomBorne ='b' , $isNewBorne = false){
        //=================== test local
        // Modif pour client : CA 22 
        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
        $destintionPathCrop = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS."crop".DS;
        //debug($destintionPathCrop);die;
        
        $source_locale = Configure::read('source_photo').DS.$idEvenement.DS;
        // photo crop 
        $source_locale_crop = "";
        if(in_array($idEvenement, ['1419'])){
            $source_locale_crop = Configure::read('source_photo').DS.$idEvenement.DS.'crop'.DS;
        }
        //debug($source_locale);
        //debug($source_locale_crop);die;
        $dirEvenent = new Folder($source_locale);
        $files = $dirEvenent->find('.*\.jpg', true);
        $files_gif = $dirEvenent->find('.*\.gif', true);
        $files = array_merge($files, $files_gif);
        //debug($files);die; 
        
        $dirEvenentCrop = new Folder($source_locale_crop);
        $filesCrop = $dirEvenentCrop->find('.*\.jpg', true);
        $files_gif_crop = $dirEvenentCrop->find('.*\.gif', true);
        $filesCrop = array_merge($filesCrop, $files_gif_crop);
        $queue = time();
        //debug($filesCrop);die;       

        if(count($filesCrop)){
            echo $source;
        }
        //debug($filesCrop);die;
        foreach($files as $file){
            if(!strpos($file, "x2") || !strpos($file, "In_Progress") ){
                $photo = array();
                    $photo['queue'] = $queue;
                    $photo['source_upload'] = 'upload';
                    $photo['evenement_id'] = $idEvenement;
                    $photo['name_origne'] = $file;
                    $photo['name'] = $file;
                    $photo['name_in_csv'] = $file;
                    if(strpos($file, "Default-") !== false){
                        $fileNameinCSv = str_replace('Default-', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, "Default_") !== false){
                        $fileNameinCSv = str_replace('Default_', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."-") !== false){
                        $fileNameinCSv = str_replace($idEvenement."-", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."_") !== false){
                        $fileNameinCSv = str_replace($idEvenement."_", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }
                    //debug($photo);die;
                    
                    $photo['is_postable_on_facebook'] = false;
                    $this->loadModel('Photos');
                    $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                        'evenement_id' => $idEvenement
                                                        ])->first();
                    //if(!$isExiste){
                        $entityPhoto = $this->Photos->newEntity($photo);
                        //debug($entityPhoto);die;
                        if(file_exists($dirEvenent->pwd().$file)){
                            
                            $dirPath         = new Folder($destintionPath, true, 0755);  
                            //debug($destintionPath.$file);die;
                            if (copy($dirEvenent->pwd().$file, $dirPath->pwd().$file)) {
                                if($this->Photos->save($entityPhoto)){
                                    rename($source_locale.$entityPhoto->name_origne,$source_locale.$photo['name_in_csv']);
                                    $this->out('Photo save Ev id '.$idEvenement .' id Photo '.$entityPhoto->id);
                                }
                            }
                        }
                    //}
                }
            }
            //die;

         //=================== fin test local
         
            //==== Boucle pour crop
            if(count($filesCrop)){
                //echo $source;
            }
            //debug($filesCrop);die;
            foreach($filesCrop as $file){
                if(!strpos($file, "x2") || !strpos($file, "In_Progress") ){
                    //debug($file);die;
                    $photo = array();
                        $photo['queue'] = $queue;
                        $photo['source_upload'] = 'upload';
                        $photo['evenement_id'] = $idEvenement;
                        $photo['name_origne'] = $file;
                        $photo['name'] = $file;
                        $photo['name_in_csv'] = $file;
                        $photo['is_croppee'] = true;
                        if(strpos($file, "Default-") !== false){
                            $fileNameinCSv = str_replace('Default-', '', $file);
                            $photo['name_in_csv'] = $fileNameinCSv;
                            
                        }else if(strpos($file, "Default_") !== false){
                            $fileNameinCSv = str_replace('Default_', '', $file);
                            $photo['name_in_csv'] = $fileNameinCSv;
                            
                        }else if(strpos($file, $idEvenement."-") !== false){
                            $fileNameinCSv = str_replace($idEvenement."-", '', $file);
                            $photo['name_in_csv'] = $fileNameinCSv;
                            
                        }else if(strpos($file, $idEvenement."_") !== false){
                            $fileNameinCSv = str_replace($idEvenement."_", '', $file);
                            $photo['name_in_csv'] = $fileNameinCSv;
                            
                        }
                        
                        $photo['is_postable_on_facebook'] = false;
                        $this->loadModel('Photos');
                        $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                            'evenement_id' => $idEvenement
                                                            ])->first();
                        //if(!$isExiste){
                            $entityPhoto = $this->Photos->newEntity($photo);
                            //debug($entityPhoto);
                            if(file_exists($dirEvenentCrop->pwd().$file)){
                                $dirCrop         = new Folder($destintionPathCrop, true, 0755);   
                                //debug($dirCrop);die;
                                if (copy($dirEvenentCrop->pwd().$file, $dirCrop->pwd() . $file)) {
                                    if($this->Photos->save($entityPhoto)){
                                        rename($source_locale_crop.$entityPhoto->name_origne,$source_locale_crop.$photo['name_in_csv']);
                                        $this->out('Photo save Ev id '.$idEvenement .' id Photo '.$entityPhoto->id);
                                    }
                                }
                            }
                        //}
                    }
                }
                //===== fin boucle crop
    }

    public function importPhotoCrop($idEvenement, $ancienChemin = true, $numBorne = 0, $nomBorne ='b' , $isNewBorne = false){
       //die;
       $source = Configure::read('source_photo').$idEvenement.DS."Crop".DS;
       if(!$ancienChemin){
           ///home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/b46/files/1442/Customized/
           ///home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/s001/files/2232/Customized
            $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.'files'.DS.$idEvenement.DS.'Crop'.DS;

            if($isNewBorne){
               $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.$idEvenement.DS.'Crop'.DS;
            }
       }
        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS."crop".DS;
    
        $dirEvenent = new Folder($source);
        $files = $dirEvenent->find('.*\.jpg', true);
        $files_gif = $dirEvenent->find('.*\.gif', true);
        $files = array_merge($files, $files_gif);
        $queue = time();
        //debug($files);die;

        if(count($files)){
            echo $source;
        }
        //debug($filesCrop);die;
        foreach($files as $file){
            if(!strpos($file, "x2") || !strpos($file, "In_Progress") ){
                $photo = array();
                    $photo['queue'] = $queue;
                    $photo['source_upload'] = 'upload';
                    $photo['evenement_id'] = $idEvenement;
                    $photo['name_origne'] = $file;
                    $photo['name'] = $file;
                    $photo['name_in_csv'] = $file;
                    $photo['is_croppee'] = true;
                    if(strpos($file, "Default-") !== false){
                        $fileNameinCSv = str_replace('Default-', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, "Default_") !== false){
                        $fileNameinCSv = str_replace('Default_', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."-") !== false){
                        $fileNameinCSv = str_replace($idEvenement."-", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."_") !== false){
                        $fileNameinCSv = str_replace($idEvenement."_", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }
                    //debug($photo);die;
                    
                    $photo['is_postable_on_facebook'] = false;
                    $this->loadModel('Photos');
                    $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                        'evenement_id' => $idEvenement
                                                        ,'is_croppee' => true
                                                        ])->first();
                    if(!$isExiste){
                        $entityPhoto = $this->Photos->newEntity($photo);
                        //debug($entityPhoto);die;
                        if(file_exists($dirEvenent->pwd().$file)){
                            
                            $dirPath         = new Folder($destintionPath, true, 0755);  
                            //debug($destintionPath.$file);die;
                            if (copy($dirEvenent->pwd().$file, $dirPath->pwd().$file)) {
                                if($this->Photos->save($entityPhoto)){
                                    rename($source.$entityPhoto->name_origne,$source.$photo['name_in_csv']);
                                    $this->out('Photo cropppe save Ev id '.$idEvenement .' id Photo '.$entityPhoto->id);
                                }
                            }
                        }
                    }
                }
            }           
    }
    
    /**
     * Import des photos dans le photo upload sans passé du CSV
     * */
    public function importPhoto($idEvenement, $ancienChemin = true, $numBorne = 0, $nomBorne ='b' , $isNewBorne = false){
		//die;
        $source = Configure::read('source_photo').$idEvenement.DS;
        if(!$ancienChemin){
            ///home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/b46/files/1442/Customized/
            ///home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/s001/files/2232/Customized
             $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.'files'.DS.$idEvenement.DS.'Customized'.DS;

             if($isNewBorne){
                $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.$idEvenement.DS.'Photos'.DS;
             }
        }
        
        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
        
        /*$source = Configure::read('source_photo_local').$idEvenement.DS;
        //debug($source_local);die;
        $dirEvenent = new Folder($source);
        $files = $dirEvenent->find('.*\.jpg', true);
        $files_gif = $dirEvenent->find('.*\.gif', true);
        $files = array_merge($files, $files_gif);*/
        //debug($files);die;
        
        $dirEvenent = new Folder($source);
        $files = $dirEvenent->find('.*\.jpg', true);
        $files_gif = $dirEvenent->find('.*\.gif', true);
        $files_gif2 = $dirEvenent->find('.*\.GIF', true);
        $files_gif = array_merge($files_gif, $files_gif2);
        $files = array_merge($files, $files_gif);
        $queue = time();
        //var_dump($idEvenement);
        //var_dump($files);
        if(count($files)){
            echo $source;
        }
        foreach($files as $file){
            if(!strpos($file, "x2") || !strpos($file, "In_Progress") ){
                $photo = array();
                    $photo['queue'] = $queue;
                    $photo['source_upload'] = 'upload';
                    $photo['evenement_id'] = $idEvenement;
                    $photo['name_origne'] = $file;
                    $photo['name'] = $file;
                    $photo['name_in_csv'] = $file;
                    if(strpos($file, "Default-") !== false){
                        $fileNameinCSv = str_replace('Default-', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, "Default_") !== false){
                        $fileNameinCSv = str_replace('Default_', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."-") !== false){
                        $fileNameinCSv = str_replace($idEvenement."-", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."_") !== false){
                        $fileNameinCSv = str_replace($idEvenement."_", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }
                    
                    $photo['is_postable_on_facebook'] = false;
                    $this->loadModel('Photos');
                    $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                        'evenement_id' => $idEvenement
                                                        ])->first();
                    if(!$isExiste){
                        $entityPhoto = $this->Photos->newEntity($photo);
                        //debug($entityPhoto);
                        if(file_exists($dirEvenent->pwd().$file)){
                            if (copy($dirEvenent->pwd().$file, $destintionPath.$file)) {
                                if($this->Photos->save($entityPhoto)){
                                    rename($source.$entityPhoto->name_origne,$source.$photo['name_in_csv']);
                                    $this->out('Photo save Ev id '.$idEvenement .' id Photo '.$entityPhoto->id);
                                }
                            }
                        }
                    }
                }
            }
    }

     /**
     * Import gif
     * */
    public function importGif($idEvenement, $ancienChemin = true, $numBorne = 0 ){
        $source = Configure::read('source_photo').$idEvenement.DS;
        if(!$ancienChemin){
            // /home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/b56/files/2160/GIFs
             $source = Configure::read('source_photo_cloud').DS.'b'.$numBorne.DS.'files'.DS.$idEvenement.DS.'GIFs'.DS;
        }
        
        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
        
        $dirEvenent = new Folder($source);
        $files = $dirEvenent->find('.*\.gif', true);
        $files_gif2= $dirEvenent->find('.*\.GIF', true);
        $files = array_merge($files, $files_gif2);
        $queue = time();
        foreach($files as $file){
            if(!strpos($file, "x2") || !strpos($file, "In_Progress") ){
                $photo = array();
                    $photo['queue'] = $queue;
                    $photo['source_upload'] = 'upload';
                    $photo['evenement_id'] = $idEvenement;
                    $photo['name_origne'] = $file;
                    $photo['name'] = $file;
                    $photo['name_in_csv'] = $file;
                    if(strpos($file, "Default-") !== false){
                        $fileNameinCSv = str_replace('Default-', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, "Default_") !== false){
                        $fileNameinCSv = str_replace('Default_', '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."-") !== false){
                        $fileNameinCSv = str_replace($idEvenement."-", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }else if(strpos($file, $idEvenement."_") !== false){
                        $fileNameinCSv = str_replace($idEvenement."_", '', $file);
                        $photo['name_in_csv'] = $fileNameinCSv;
                        
                    }
                    
                    $photo['is_postable_on_facebook'] = false;
                    $this->loadModel('Photos');
                    $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                        'evenement_id' => $idEvenement
                                                        ])->first();
                    if(!$isExiste){
                        $entityPhoto = $this->Photos->newEntity($photo);
                        //debug($entityPhoto);
                        if(file_exists($dirEvenent->pwd().$file)){
                            if (copy($dirEvenent->pwd().$file, $destintionPath.$file)) {
                                if($this->Photos->save($entityPhoto)){
                                    rename($source.$entityPhoto->name_origne,$source.$photo['name_in_csv']);
                                    $this->out('Photo save Ev id '.$idEvenement .' id Photo '.$entityPhoto->id);
                                }
                            }
                        }
                    }
                }
            }
    }
    
    
    public function importContactNextCloud($idEvenement = null){
        $time = new Time('1 month ago');
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        //Pour l'import automatique
                                        ->where(['Evenements.date_debut <' => Time::now(),'Evenements.date_fin >' =>$time]);

        if(!empty($idEvenement)){
            $evenements = $evenements->where(['id' => $idEvenement]);
        }
        
        foreach($evenements as $evenement){
            for($numBorne = 1;$numBorne<=200;$numBorne++){
                $numBorneSperik = sprintf('%03d', $numBorne);
                $this->out('Import contact next cloud lancé pour l\événement '.$evenement->id);
                //Pour la borne Classik
                $this->importContactViaCsv($evenement->id, false, $numBorne, null, 0, 'b'); 
                //Pour la borne Spherik
                $this->importContactViaCsv($evenement->id, false, $numBorneSperik, null, 0, 's'); 

                //Pour la nouvelle borne
                //Pour la borne Classik
                $this->importContactViaCsv($evenement->id, false, $numBorne, null, 0, 'b',1); 
                //Pour la borne Spherik
                $this->importContactViaCsv($evenement->id, false, $numBorneSperik, null, 0, 's',1); 
                $this->out('Import contact Terminée pour événement '.$evenement->id);
            }
        }
    }
    
    public function importAllContact($idEvenement = null, $ancienChemin = true){
         $time = new Time('1 month ago');
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        //Pour l'import automatique
                                        ->where(['Evenements.date_debut <' => Time::now(),'Evenements.date_fin >' =>$time]);

        if(!empty($idEvenement)){
            $evenements = $evenements->where(['id' => $idEvenement]);
        }
        
        foreach($evenements as $evenement){
            $this->out('Import contact lancé pour l\événement '.$evenement->id);
            $this->importContactViaCsv($evenement->id, $ancienChemin); 
            $this->out('Import contact Terminée ');
        }
        
    }
    
    /**
     * Import contact en bouclant le csv et en attribuant le contact à la photo
     * **/
    public function importContactViaCsv($idEvenement, $ancienChemin = true, $numBorne = 0, $thePathOfCSv = null, $user_id = 0,$nomBorne = 'b', $isNewBorne = false){
        
        //debug($thePathOfCSv);
        
        $this->loadModel('Photos');
        
        $this->loadModel('CsvColonnePositions');
        $positionChampFacebook = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>1])
                                                            ->first();
        $positionOptinGalerie = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>2])
                                                            ->first();
        $positionOptinEmailSms = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>3])
                                                            ->first();
        $positionOptinEmail = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>4])
                                                            ->first();
        $positionOptinSms = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>5])
                                                            ->first();

        $positionOptinEmailSmsFb = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>6])
                                                            ->first();
        
        $source = Configure::read('source_photo').$idEvenement.DS;
        //$source = Configure::read('source_photo').DS.$idEvenement.DS; // Test local
        if(!$ancienChemin){
             //$source = Configure::read('source_photo').DS.'borne'.DS.'files'.DS.$idEvenement.DS.'Data'.DS;
             $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.'files'.DS.$idEvenement.DS.'Data'.DS;

             if($isNewBorne){
                $source = Configure::read('source_photo_cloud').DS.$nomBorne.$numBorne.DS.$idEvenement.DS.'Data'.DS;
             }
        }

        $pathCsv = $source.'data.csv';
        //debug($pathCsv);die;
        /**
         * Si path fournit on prend directement celui indiqué
         * */
        if(!empty($thePathOfCSv) && file_exists($thePathOfCSv) ){
            //echo 'je passe dans la condition';
            $pathCsv = $thePathOfCSv;
        }
        
        
        /*if($infoEvenement['idEvenement'] == 2403){
            var_dump($pathCsv); die;            
        }*/
                
       // debug($pathCsv); die;
        
        
        if(file_exists($pathCsv)){
           // debug('je passe ici'); die;
            $csv = array_map('str_getcsv', file($pathCsv)); 
            $nomDesColonnes = null;
            if(!empty($csv)){
                $nomDesColonnes = $csv[0];
            }
                          
            array_shift($csv);
            $datas = array();
            
            
            $queue = time();
            foreach($csv as $numLigne => $ligne){
                $photo = array();
                $photo['contacts'][0]['user_id'] = $user_id;
                $photo['contacts'][0]['queue'] = $queue;
                $photo['contacts'][0]['source_upload'] = "upload";
                $photo['contacts'][0]['email'] = null;
                $photo['contacts'][0]['telephone'] = null;
                foreach($ligne as $position => $colonne){
                   
                    $colonne = trim($colonne);
                    
                    //Prendre l' email dans la ligne
                    if(filter_var($colonne, FILTER_VALIDATE_EMAIL)){
                        $photo['contacts'][0]['email'] = $colonne;
                        $positionDeLemail = $position;
                    }

                    //Event test : concatener l'email via la colonne identifiant
                    if(in_array($idEvenement, ['2562']) &&  $position == 6 ){
                        $photo['contacts'][0]['email'] = $colonne."@gmail.com";//@ca-cotesdarmor.fr
                        $positionDeLemail = $position;
                    }

                    //Event 2552 : concatener l'email via la colonne Matricule colonne 16 ==> col. 16 - 1 = 15
                    if(in_array($idEvenement, ['2552']) &&  $position == 15 ){                        
                        $photo['contacts'][0]['email'] = $colonne."@ca-cotesdarmor.fr";
                        $positionDeLemail = $position;
                    }
                    
                    //Prendre le téléphone 
                    if(preg_match("/^[0-9]{10}$/", $colonne)){
                        $photo['contacts'][0]['telephone'] = $colonne;
                    }
                    
                    //Prendre le nom de l'image
                    if(strpos(strtolower($colonne), "c:\\") !== false){
                        $cheminPhotoInCSv = $colonne;
                        //$nomPhoto = pathinfo($cheminPhotoInCSv,  PATHINFO_BASENAME);
                        $cheminExpoded = explode('\\',$cheminPhotoInCSv);
                        $nomPhoto = end($cheminExpoded);
                        $nomPhoto = trim($nomPhoto);
                       
                        $photo['name_in_csv'] = $nomPhoto;
                    }
                    
                    /**
                     * Postion optin facebook
                     * */
                    if(!empty($positionChampFacebook) && !empty($nomDesColonnes)){
                        $postionFbauto = $positionChampFacebook->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOption = array_search('survey'.$postionFbauto, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOption])){
                            $valueFbauto = $ligne[$realPostionDeLOption];
                            if(!empty($valueFbauto)){
                                if($valueFbauto == '"Yes"' || $valueFbauto == 'Yes' ){
                                      $photo['is_postable_on_facebook'] =  true;
                                }
                            }
                        }
                    }
                    
                    /**
                     * Position optin galerie $positionOptinGalerie
                    **/
                     if(!empty($positionOptinGalerie) && !empty($nomDesColonnes)){
                        $postion = $positionOptinGalerie->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOptin = array_search('survey'.$postion, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOptin])){
                            $value = $ligne[$realPostionDeLOptin];
                            if(!empty($value)){
                                if($value == '"Yes"' || $value == 'Yes' ){
                                      $photo['is_optin_galerie'] =  true;
                                }
                            }
                        }
                    }else{ // Si ce n'est configurer c'est true comme avant
                        $photo['is_optin_galerie'] =  true;
                    }
                    
                    /**
                     * Position optin Email & Sms $positionOptinEmailSms
                    **/
                     if(!empty($positionOptinEmailSms) && !empty($nomDesColonnes)){
                        $postion = $positionOptinEmailSms->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOptin = array_search('survey'.$postion, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOptin])){
                            $value = $ligne[$realPostionDeLOptin];
                            if(!empty($value)){
                                if($value == '"Yes"' || $value == 'Yes' ){
                                    $photo['is_optin_email'] =  true;
                                    $photo['is_optin_sms'] =  true;
                                }else{
                                    $photo['is_optin_email'] =  false;
                                    $photo['is_optin_sms'] =  false;
                                }
                            }
                        }
                    }else{
                        $photo['is_optin_email'] =  true;
                        $photo['is_optin_sms'] =  true;
                    }
                    
                    
                    /**
                     * Position optin Email $positionOptinEmail
                    **/
                     if(!empty($positionOptinEmail) && !empty($nomDesColonnes)){
                        $postion = $positionOptinEmail->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOptin = array_search('survey'.$postion, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOptin])){
                            $value = $ligne[$realPostionDeLOptin];
                            if(!empty($value)){
                                if($value == '"Yes"' || $value == 'Yes' ){
                                    $photo['is_optin_email'] =  true;
                                }
                            }
                        }
                    }else{
                        $photo['is_optin_email'] =  true;
                    }
                    
                    /**
                     * Position optin Email & Sms $positionOptinSms
                    **/
                     if(!empty($positionOptinSms) && !empty($nomDesColonnes)){
                        $postion = $positionOptinSms->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOptin = array_search('survey'.$postion, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOptin])){
                            $value = $ligne[$realPostionDeLOptin];
                            if(!empty($value)){
                                if($value == '"Yes"' || $value == 'Yes' ){
                                    $photo['is_optin_sms'] =  true;
                                }
                            }
                        }
                    }else{ 
                        $photo['is_optin_email'] =  true;
                    }


                    /**
                     * Position optin Email & Sms et facebook $positionOptinEmailSmsFb
                    **/
                     if(!empty($positionOptinEmailSmsFb) && !empty($nomDesColonnes)){
                        $postion = $positionOptinEmailSmsFb->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOptin = array_search('survey'.$postion, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOptin])){
                            $value = $ligne[$realPostionDeLOptin];
                            if(!empty($value)){
                                if($value == '"Yes"' || $value == 'Yes' ){
                                    $photo['is_optin_email'] =  true;
                                    $photo['is_optin_sms'] =  true;
                                    $photo['is_postable_on_facebook'] =  true;
                                }
                            }
                        }
                    }
                    
                    /**
                    * Prendre les valeurs des survey ( 1 à 7)
                    * **/
                    for($numSrv=1; $numSrv<=7 ; $numSrv++ ){
                        $positionSurvey = array_search('survey'.$numSrv, $nomDesColonnes);
                        if(!empty($positionSurvey)){
                            if(isset($ligne[$positionSurvey])){
                                $valueOfSurvey = $ligne[$positionSurvey];
                                $photo['survey'.$numSrv] = $valueOfSurvey;
                            }
                        }
                    }
                    
                    
                
                    
                }
                //debug($photo);
                
                if(!empty($photo['name_in_csv'])){
                    
                    //debug($photo);die;
                    /**
                     * On vérifie si l'import de la photo est déjà faite'
                     * */
                     if( !empty( $photo['contacts'][0]['telephone']) || !empty($photo['contacts'][0]['email'] || !empty($photo['is_postable_on_facebook']) ) ){
                         //$contactAInserer = $photo['contacts'][0];
                         $tel = $photo['contacts'][0]['telephone'];
                         $email = $photo['contacts'][0]['email'];
                         $photoFind = $this->Photos->find()
                                                            //->contain(['Contacts']);
                                                            /*->matching(['Contacts'=>function($q) use($tel, $email) {
                                                                debug($contactAInserer); die;
                                                               
                                                                    return $q->where(['email =' =>$email ])
                                                                        ->where(['telephone ='=>$tel ]);
                                                            }])*/
                                                            ->notMatching('Contacts', function ($q) use($email,$tel ) {
                                                                 if(!empty($email)){
                                                                    $q->where(['Contacts.email' => $email]);
                                                                 }
                                                                 
                                                                 if(!empty($tel)){
                                                                    $q->where(['Contacts.telephone'=>$tel ]);
                                                                 }
                                                                  return $q;          
                                                            })
                                                            ->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                                    'evenement_id' => $idEvenement
                                                                    ,'is_croppee' => false // pour 2552, 2553
                                                                    ])
                                                            ->first();
                         //debug($photoFind); die;
                         
                         if(!empty($photoFind)){
                            $photo['id'] = $photoFind->id;
                            
                            $entity = $this->Photos->patchEntity($photoFind, $photo,['associated'=>['Contacts']]);
                            if($this->Photos->save($entity)){
                                array_push($datas, $photo);
                            }
                         }
                     }
                }
                
                
            }
            
            if(count($datas)){
                $this->out(__('Import réussi : '.count($datas).' Contact(s)' ));
                //$this->sendEmailAndSmsEvenement($idEvenement, $sendEmail, $sendSms);
            }else{
                $this->out(__('Aucun contact importé ou contact déjà existant dans la base.'));
            }
            
            return count($datas);
            
        }else{
            $this->out(__('Csv non trouvé'));
        }
        
    }
    /**
     * Import des photos en bouclant le csv
     * */
    public function importPhotoViaCsv($idEvenement, $sendEmail = false, $sendSms = false,$ancienChemin = true ){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel("Photos");
        $evenement = $this->Photos->Evenements->get($idEvenement);
        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $evenement->id.DS;
        
        $this->loadModel('CsvColonnePositions');
        $positionChampFacebook = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$evenement->id,'csv_colonne_id'=>1])
                                                            ->first();
        
        //$source = 'D:\wamp64\www\source_image'.DS.$evenement->slug.DS;
        //$source = SOURCE_ROOT.$evenement->id.DS;
        $source = Configure::read('source_photo').$evenement->id.DS;
        if(!$ancienChemin){
             $source = Configure::read('source_photo').DS.'borne'.DS.'files'.DS.$evenement->id.DS.'Data'.DS;
        }
        
        $cheminDuCsv = $source.'data.csv';
        //debug($cheminDuCsv);
        if(file_exists($cheminDuCsv)){
            $csv = array_map('str_getcsv', file($cheminDuCsv));
            //array_shift($csv);
            $nomDesColonnes = null;
            if(!empty($csv)){
                $nomDesColonnes = $csv[0];
            }
                        
            array_shift($csv);
            $datas = array();
            foreach($csv as $numLigne => $ligne){
               //debug($numLigne);
                $photo = array();
                $photo['evenement_id'] = $evenement->id;
                $dt = trim($ligne[0]);
                $dataArray = explode("/", $dt);
                $dateOk = $dt;
                if(!empty($dataArray[2]) && !empty($dataArray[1]) && !empty($dataArray[0])){
                    $dateOk = $dataArray[2].'-'.$dataArray[1].'-'.$dataArray[0];
                }
                
                $dataPriseTime = new Date($dateOk);
                $dateInsert = $dataPriseTime->format('Y-m-d');
                $photo['date_prise_photo'] = $dateInsert;
                $photo['heure_prise_photo'] = trim($ligne[1]);
                $photo['name_origne'] = null;
                $photo['name'] = null;
                $photo['name_in_csv'] = null;
                $photo['is_postable_on_facebook'] = false;
                $photo['contacts'] = array();
                $positionDeLemail = 0; // Pour l'optin
                foreach($ligne as $position => $colonne){
                   
                    $colonne = trim($colonne);
                    
                    //Prendre l' email dans la ligne
                    if(filter_var($colonne, FILTER_VALIDATE_EMAIL)){
                        $photo['contacts'][0]['email'] = $colonne;
                        $positionDeLemail = $position;
                    }
                    
                    //Prendre le téléphone 
                    if(preg_match("/^[0-9]{10}$/", $colonne)){
                        $photo['contacts'][0]['telephone'] = $colonne;
                    }
                    
                    //Prendre le nom de l'image
                    if(strpos(strtolower($colonne), "c:\\") !== false){
                        $cheminPhotoInCSv = $colonne;
                        //$nomPhoto = pathinfo($cheminPhotoInCSv,  PATHINFO_BASENAME);
                        $cheminExpoded = explode('\\',$cheminPhotoInCSv);
                        $nomPhoto = end($cheminExpoded);
                        $nomPhoto = trim($nomPhoto);
                        /**
                         * Si via Batch ou Via FTP
                         * */
                         //var_dump($source.$nomPhoto);
                        if(file_exists($source.$nomPhoto)){ // Via ftp
                            $photo['name_origne'] =  $nomPhoto;
                            $photo['name'] = $nomPhoto;
                        }else if(file_exists($source."Default_".$nomPhoto)){ // Via BATCH
                            $photo['name_origne'] =  "Default_".$nomPhoto;
                            $photo['name'] =  "Default_".$nomPhoto;
                        }else if(file_exists($source."Default-".$nomPhoto)){
                            $photo['name_origne'] =  "Default-".$nomPhoto;
                            $photo['name'] =  "Default-".$nomPhoto;
                        }else if(file_exists($source.$idEvenement."-".$nomPhoto)){
                            $photo['name_origne'] =  $idEvenement."-".$nomPhoto;
                            $photo['name'] =  $idEvenement."-".$nomPhoto;
                        }else if(file_exists($source.$idEvenement."_".$nomPhoto)){
                            $photo['name_origne'] =  $idEvenement."_".$nomPhoto;
                            $photo['name'] =  $idEvenement."_".$nomPhoto;
                        }
                        $photo['name_in_csv'] = $nomPhoto;

                        //=== SET DATE HEURE PRISE PHOTO
                        $date = new \DateTime();
                        $name_array = explode('-', $nomPhoto);
                        if($name_array[0] == date('Y') && count($name_array) == 4) { // ou array_key_exists(3, $name_array)
                            $date->setTimestamp(intval($name_array[3]));
                            $heure = $date->format('H:i:s');
                            $photo['date_prise_photo'] = date($name_array[0] . "-" . $name_array[1] . "-" . $name_array[2]);
                            $photo['heure_prise_photo'] = $heure;
                        }
                    }
                    
                    //Option : postable sur FB : is_postable_on_facebook
                    
                    if(!empty($positionChampFacebook) && !empty($nomDesColonnes)){
                        $postionFbauto = $positionChampFacebook->position;
                        //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                        $realPostionDeLOption = array_search('survey'.$postionFbauto, $nomDesColonnes);
                        //debug($realPostionDeLOption);
                        if(isset($ligne[$realPostionDeLOption])){
                            $valueFbauto = $ligne[$realPostionDeLOption];
                            if(!empty($valueFbauto)){
                                if($valueFbauto == '"Yes"' || $valueFbauto == 'Yes' ){
                                      $photo['is_postable_on_facebook'] =  true;
                                }
                            }
                        }
                    }
                    
                }
               
                
                if(!empty($photo['name_in_csv']) && !empty($photo['name_origne'])){
                    
                    /**
                     * On vérifie si l'import de la photo est déjà faite'
                     * */
                     $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                                'evenement_id' => $evenement->id
                                                                ])->first();
                     
                     if(!$isExiste){
                        /**
                        *  si la photo est copié en l'ajout dans le tableau photos pour être insérer 
                        * en une seule transation
                        * **/
                        $cheminSourcePhoto = $source.$photo['name_origne'];
                        $destintionPathFile = $destintionPath.$photo['name_origne'];
                        if(file_exists($cheminSourcePhoto)){
                            if (copy($cheminSourcePhoto, $destintionPathFile)) {
                                /**
                                 * Enregister les photos
                                 * */
                                $entity = $this->Photos->newEntity($photo,['associated'=>['Contacts']]);
                                if($this->Photos->save($entity)){
                                    array_push($datas, $photo);
                                    rename($source.$entity->name_origne,$source.$photo['name_in_csv']);
                                }
                                
                            }
                        }
                     }
                }
                
                
                
            }
            
            if(count($datas)){
                $this->out(__('Import réussi : '.count($datas).'Photo(s)' ));
                //$this->sendEmailAndSmsEvenement($idEvenement, $sendEmail, $sendSms);
            }else{
                $this->out(__('Toutes les photos du CSV sont importées'));
            }
          
        }else{
            $this->out(__('Le Fichier CSV n\'est pas trouvé.'));
        }
    }
    
    public function generateThumbAll(){
        $this->loadModel('Evenements');
        $evenements = $this->Evenements->find('all');
        foreach($evenements as $evenement){
            $this->generateThumbEvenement($evenement->id);
        }
    }
    
    public function generateThumbEvenement($idEvenement = null)
    {
       
        
        $this->loadModel('Photos');
        $photos = $this->Photos->find('all')->where([ 'is_gererated_thumb'=> false])
                                        //->order(['Photos.id' => 'DESC']);
                                        ->order(['RAND()'])
                                        ->limit(1000);
        if(!empty($idEvenement)){
            $photos = $photos->where(['evenement_id'=>$idEvenement]);
        }
                                        
        
        //debug($photos->toArray()); die;
        foreach($photos as $photo){
            
            $this->RegenerateImage = new RegenerateImageComponent(new ComponentRegistry());
            
            //debug('dee');
            //debug($photo);
            $path = WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS;
            
            $folderThumb   = $path.DS.'thumbnails'.DS;
            $pathTbum  = new Folder($folderThumb, true, 0755);
        
            $imgPath = $path.$photo->name;
            if(file_exists($imgPath)){
                $extension = pathinfo($imgPath, PATHINFO_EXTENSION);
                //$this->out($imgPath); die;
                
                //Thumbnail BO
                $destinationThumBO = $pathTbum->pwd().DS.'thumb_bo_'.$photo->name;
                $this->RegenerateImage->_image_quality = $extension;
                $this->RegenerateImage->resize($imgPath,$destinationThumBO,235,235);
                
                //Thumbnail souvenir
                 $destinationThumSouv = $pathTbum->pwd().DS.'thumb_souv_'.$photo->name;
                 $this->RegenerateImage->_image_quality = $extension;
                 $this->RegenerateImage->resize($imgPath,$destinationThumSouv,320,320,$extension);
                 
                 //Thumbnail Popup
                /* $destinationThumPopup = $pathTbum->pwd().DS.'thumb_popup_'.$photo->name;
                 $this->RegenerateImage->_image_quality = $extension;
                 $this->RegenerateImage->resize($imgPath,$destinationThumPopup,320,320,$extension);*/
                 
                
                $photo->is_gererated_thumb = true;
                if($this->Photos->save($photo)){
                    $this->out('Generated '.$photo->id);
                }
            }
            
        }
        
    }
    
    public function envoiManuel(){
        $this->loadModel('EnvoiManuels');
        $envoiManuels = $this->EnvoiManuels->find('all')
                                //->where(['EnvoiManuels.id'=>291])
                                //->where(['EnvoiManuels.id !='=>15])
                                //->contain(['ContactToSendManuels'=>['Contacts']])
                                ->contain([
                                    'ContactToSendManuels' => function (Query $q) {
                                        return $q->where(['ContactToSendManuels.is_send' => false]);
                                    },
                                    'ContactToSendManuels.Contacts',
                                    'Evenements'
                                ]);
        //debug($envoiManuels->toArray()); die;
        
        $this->loadModel('Photos');
        $this->loadModel('EmailConfigurations');
        $this->loadModel('SmsConfigurations');
        $this->loadModel('ContactToSendManuels');
        $this->Send = new SendComponent(new ComponentRegistry());
        
        foreach($envoiManuels as $envoi){
            
            $smsConfiguration = $this->SmsConfigurations->find()->where(['evenement_id'=>$envoi->evenement_id])
                                                            ->contain(['Evenements'])
                                                            ->first();
            
            $emailConfiguration = $this->EmailConfigurations->find()->where(['evenement_id'=>$envoi->evenement_id])
                                                            ->contain(['Evenements'])
                                                            ->first();
            $queue = time();
            $sourceExecution = 'bo';
            
            if(!empty($envoi->contact_to_send_manuels)){
            
                foreach($envoi->contact_to_send_manuels as $toSend){
                    
                    if(!$toSend->is_send){
                         $contact = $toSend->contact;
                         
                         $photo = $this->Photos->find()
                                        ->where(['Photos.id' => $contact->photo_id])
                                        ->contain(['Contacts','Evenements'])
                                        ->first();
                         
                         /**
                          * Send E-mail
                          * **/
                         $resEmail = false;
                         if($envoi->is_email && !empty($contact->email)){
                            //debug($resEmail);
                            $resEmail = $this->Send->email($photo, $contact, $emailConfiguration, $envoi->is_force_envoi, $queue, $sourceExecution);
                            debug($resEmail);
                         }
                         
                         /**
                          * Send Sms
                          * **/
                          $resSms = false;
                          if($envoi->is_sms && !empty($contact->telephone)){
                            $resSms = $this->Send->sms($photo, $contact, $smsConfiguration, $envoi->is_force_envoi, $queue ,$sourceExecution);
                         }
                         
                         if($resEmail || $resSms){
                            $toSend->is_send = true;
                            $this->ContactToSendManuels->save($toSend);
                         }
                     }
                }
            
            }else{
                /**
                 * Send email notification si ce n'est pas encore envoyé
                 * **/
                 if(!$envoi->is_notify_send && !empty($envoi->email_notify)){
                    
                        /*$countContactEmail  =  $this->EnvoiManuels->ContactToSendManuels
                                                                        ->find()
                                                                        ->where(['ContactToSendManuels.envoi_manuel_id' => $envoi->id])
                                                                        ->contain('Contacts', function (Query $q) {
                                                                            return $q
                                                                                ->select(['body', 'author_id'])
                                                                                ->where(['Comments.approved' => true]);
                                                                        });*/
                        
                        $email = new Email();
                        $email
                            ->setFrom(['contact@selfizee.fr' => $envoi->evenement->slug])
                            ->setDomain('event.selfizee.fr')
                            ->setViewVars(['envoi'=>$envoi])
                            ->setTemplate('notification_envoi_complete')
                            ->setEmailFormat('html')
                            ->setTo($envoi->email_notify);
                
                        $email->setSubject('Envoi manuel effectué pour l\'événement '.$envoi->evenement->slug)
                            ->setTransport('mailjet');
                        
                        //var_dump($email); die;
                        
                        if ($email->send()) {
                            
                            $envoi->is_notify_send = true;
                            $this->EnvoiManuels->save($envoi);
                            
                        }
                    
                 }
            }
            
            /**
             *  Verify if all contacts si Send
             * **/
             
        }
                                
    }

    //v2
    public function sendEmailAndSms($idEvenement ){
        $this->loadModel('Photos');
        $photos = $this->Photos->find()
                                ->where(['evenement_id'=>$idEvenement,'Photos.id >'=>213583])
                                ->contain(['Contacts','Evenements']);

        $this->loadModel('SmsConfigurations');
        $smsConfiguration = $this->SmsConfigurations->find()
                                                    ->where([
                                                            'evenement_id' =>$idEvenement,
                                                            'is_active' => true
                                                            ])
                                                    ->contain(['Evenements'])
                                                    ->first();
        
        $this->loadModel('EmailConfigurations');
        $emailConfiguration = $this->EmailConfigurations->find()
                                                        ->where([
                                                            'evenement_id' =>$idEvenement,
                                                            'is_active' => true
                                                        ])
                                                        ->contain(['Evenements'])
                                                        ->first();

        $this->Send = new SendComponent(new ComponentRegistry());
    
        $queue = time();
        foreach($photos as $photo){
            foreach($photo->contacts as $contact){ 
                //Envoi de l'email au contact
                 $email = $contact->email;
                if(!empty($email) && !empty($emailConfiguration) && $photo->id > 213583 && $emailConfiguration->is_active ){
                    if($emailConfiguration->is_envoi_plannifie && !empty($emailConfiguration->date_heure_envoi)){
                        //Si envoi plannifé : on attend la date arrvé 
                        if($emailConfiguration->date_heure_envoi <= Time::now()){
                            $resEmail = $this->Send->email($photo, $contact, $emailConfiguration, $forceToSend, $queue, $sourceExecution, $user_id);
                        }
                    }else{ // Sinon on l'envoi tout de suite
                        $resEmail = $this->Send->email($photo, $contact, $emailConfiguration, $forceToSend, $queue, $sourceExecution, $user_id);
                    }
                   
                }
                
                //Envoi de sms au contact
                if(!empty($contact->telephone) && !empty($smsConfiguration) && $photo->id > 213583 && $smsConfiguration->is_active ){

                     if($smsConfiguration->is_envoi_plannifie && !empty($smsConfiguration->date_heure_envoi)){
                        //Si envoi plannifé : on attend la date arrvé 
                        if($smsConfiguration->date_heure_envoi <= Time::now()){
                            $resSms = $this->Send->sms($photo, $contact, $smsConfiguration, $forceToSend, $queue ,$sourceExecution, $user_id);
                        }
                    }else{ // Sinon on l'envoi tout de suite
                        $resSms = $this->Send->sms($photo, $contact, $smsConfiguration, $forceToSend, $queue ,$sourceExecution, $user_id);
                    }

                     
                }
                
            }
        }


    }
    
    public function sendEmailAndSmsEvenement($idEvenement, $sendEmail = false, $sendSms = false, $forceToSend = false, $sourceExecution = 'auto', $user_id = 0){
        $sendEmail = boolval($sendEmail);
        $sendSms = boolval($sendSms);
        $forceToSend = boolval($forceToSend);
        
        //debug($sendEmail);        
        
        $this->loadModel('Photos');
        $photos = $this->Photos->find()->where(['evenement_id'=>$idEvenement,'Photos.id >'=>213583])
                                    ->contain(['Contacts','Evenements']);
        //var_dump($photos->toArray());
        $this->loadModel('SmsConfigurations');
        $smsConfiguration = $this->SmsConfigurations->find()->where(['evenement_id'=>$idEvenement])
                                                        ->contain(['Evenements'])
                                                        ->first();
        
        $this->loadModel('EmailConfigurations');
        $emailConfiguration = $this->EmailConfigurations->find()->where(['evenement_id'=>$idEvenement])
                                                        ->contain(['Evenements'])
                                                        ->first();
        
        $this->Send = new SendComponent(new ComponentRegistry());
        
        //debug($sendSms);
        
        //debug($photos->toArray());
        $queue = time();
        foreach($photos as $photo){
            foreach($photo->contacts as $contact){ 
                //Envoi de l'email au contact
                 $email = $contact->email;
                 //var_dump($sendEmail);
                 //var_dump($email);
                 
                 if(!empty($email) && !empty($sendEmail) && $photo->id > 213583 && $emailConfiguration->is_active  ){
                    //echo 'je passe ici';
                    $resEmail = $this->Send->email($photo, $contact, $emailConfiguration, $forceToSend, $queue, $sourceExecution, $user_id);
                 }
                 //Envoi de sms au contact
                 //debug($contact); die;
                 if(!empty($contact->telephone) && !empty($sendSms) && $photo->id > 213583 && $smsConfiguration->is_active ){
                     $resSms = $this->Send->sms($photo, $contact, $smsConfiguration, $forceToSend, $queue ,$sourceExecution, $user_id);
                 }
                
            }
        }
    }
    
    public function generateToken(){
        $this->loadModel('Shorturls');
        $shorturls = $this->Shorturls->find('all');
        foreach($shorturls as $shorturl){
            $this->loadModel('Photos');
            $photo = $this->Photos->find()
                                ->where(['id' => $shorturl->spd_id  ,'token IS' => NULL])
                                
                                ->first();
            if(!empty($photo)){
                $photo->token = $shorturl->token;
                if($this->Photos->save($photo)){
                    $this->out('Save '.$photo->id);
                }
            }
        }
    }

    public function updateOptin(){
        $idEvenement = 2308;
        $source = DS."home".DS."manager-selfizee".DS."domains".DS."upload.selfizee.fr".DS."public_html".DS."dev".DS."b82".DS."files".DS.$idEvenement.DS."Data".DS;
        $cheminDuCsv = $source.'data.csv';
        echo $cheminDuCsv;
        
        $this->loadModel('CsvColonnePositions');
        $positionOptinEmailSmsFb = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>6])
                                                            ->first();
        
          $positionChampFacebook = $this->CsvColonnePositions->find()
                                                            ->where(['evenement_id'=>$idEvenement,'csv_colonne_id'=>1])
                                                            ->first();

        if(file_exists($cheminDuCsv)){
            echo 'existe';
            $csv = array_map('str_getcsv', file($cheminDuCsv));
            $nomDesColonnes = null;
            if(!empty($csv)){
                $nomDesColonnes = $csv[0];
            }
                        
            array_shift($csv);
            $datas = array();
            foreach($csv as $numLigne => $ligne){
                foreach($ligne as $position => $colonne){
                    $colonne = trim($colonne);

                    //Prendre le nom de l'image
                    $nomPhoto = null;
                    if(strpos(strtolower($colonne), "c:\\") !== false){
                        $cheminPhotoInCSv = $colonne;
                        //$nomPhoto = pathinfo($cheminPhotoInCSv,  PATHINFO_BASENAME);
                        $cheminExpoded = explode('\\',$cheminPhotoInCSv);
                        $nomPhoto = end($cheminExpoded);
                        $nomPhoto = trim($nomPhoto);
                    }

                    //var_dump($nomPhoto);

                    if(!empty($nomPhoto)){
                        $this->out('Je passe ici car photo non vide');
                        $this->loadModel('Photos');
                        $photoFind = $this->Photos->find()
                                        ->where([ 
                                                'name_in_csv'=> $nomPhoto,
                                                'evenement_id' => $idEvenement
                                            ])      
                                        ->first();
                        if(!empty($photoFind)){
                            $this->out('je passe ici car photo trouvée');
                            //$photo['id'] = $photoFind->id;
                            if(!empty($positionOptinEmailSmsFb) && !empty($nomDesColonnes)){
                                $LaPostion = $positionOptinEmailSmsFb->position;
                                $realPostionDeLOptin = array_search('survey'.$LaPostion, $nomDesColonnes);
                                //debug($realPostionDeLOption);
                                if(isset($ligne[$realPostionDeLOptin])){
                                    $value = $ligne[$realPostionDeLOptin];
                                    if(!empty($value)){
                                        if($value == '"Yes"' || $value == 'Yes' ){
                                            $photoFind->is_optin_email =  true;
                                            $photoFind->is_optin_sms =  true;
                                            $photoFind->is_postable_on_facebook=  true;
                                        }else{
                                            $photoFind->is_optin_email =  false;
                                            $photoFind->is_optin_sms =  false;
                                            $photoFind->is_postable_on_facebook=  false;
                                        }

                                        if( $this->Photos->save($photoFind) ){
                                            $this->out('Update optin '.$photoFind->id);
                                        }
                                    }
                                }
                            }
                            
                            
                             /**
                             * Postion optin facebook
                             * */
                            if(!empty($positionChampFacebook) && !empty($nomDesColonnes)){
                                $postionFbauto = $positionChampFacebook->position;
                                //$realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
                                $realPostionDeLOption = array_search('survey'.$postionFbauto, $nomDesColonnes);
                                //debug($realPostionDeLOption);
                                if(isset($ligne[$realPostionDeLOption])){
                                    $valueFbauto = $ligne[$realPostionDeLOption];
                                    if(!empty($valueFbauto)){
                                        if($valueFbauto == '"Yes"' || $valueFbauto == 'Yes' ){
                                            $photoFind->is_postable_on_facebook =  true;
                                            if( $this->Photos->save($photoFind) ){
                                                $this->out('Update optin '.$photoFind->id);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
        }else{
            $this->out('fichier non trouvé');
        }
    }
    
    public function importSansCsv(){
        //Les sous dossiers
        $sources = '/home/manager-selfizee/public_html/dev/sans_csv/JEANNE/'; 
        //$sources = 'D:\wamp64\www\source_image\\';
        $dir = new Folder($sources);
        $alls = $dir->read(true);
        //var_dump($alls); die;
        if(!empty($alls[0])){
            $dossiers = $alls[0];
            foreach($dossiers as $dossier){
                //echo '==> '.$dossier; //05.09-Brest-SandyKevin
                
                $nomEv = strtoupper($dossier);
                
                $nomExplo = explode('-', $dossier);
                unset( $nomExplo[0] ); 
                $identifiantGal =  implode('-', $nomExplo);
                $identifiantGal = strtoupper($identifiantGal);
                
                $evenement = array();
                    $evenement = [
                                    'client_id' => '1',
                                    'nom' => $nomEv,
                                    'slug' => Text::slug($identifiantGal),
                                    'lieu' => '',
                                    'is_marque_blanche' => '0',
                                    'is_data_acces' => '0',
                                    'date_debut' => Time::now(),
                                    'date_fin' => Time::now(),
                                    'galeries' => [
                                        [
                                            'nom' => $nomEv,
                                            'slug' => Text::slug($identifiantGal),
                                            'titre' => $nomEv,
                                            'user' => [
                                                'username' => Text::slug($identifiantGal),
                                                'password' => Text::slug($identifiantGal),
                                                'role_id' => '3'
                                            ]
                                        ]
                                    ]
                                ];
                $this->loadModel('Evenements');
                
                $eventFind = $this->Evenements->find()->where(['slug' =>Text::slug($identifiantGal)])
                                            ->contain(['Galeries','Galeries.Users'])
                                            ->first();
                $entitiEvenement = $this->Evenements->newEntity($evenement,[ 'associated' => ['Galeries', 'Galeries.Users']]);
                //debug($eventFind); die;
                if($eventFind){
                    $entitiEvenement =  $eventFind;
                    //$this->Evenements->patchEntity($eventFind, $evenement, [ 'associated' => ['Galeries', 'Galeries.Users']]);
                }
                
                //debug($entitiEvenement); die;
                
                if($this->Evenements->save($entitiEvenement)){
                    
                    $this->out('Evenet save '.$entitiEvenement->id);
                    
                    $destintionPath = WWW_ROOT."import".DS."galleries".DS. $entitiEvenement->id.DS;
                    $dirPathDestination = new Folder($destintionPath, true, 0755);
                    
                    $dirEvenent = new Folder($sources.$dossier.DS);
                    $files = $dirEvenent->find('.*\.jpg', true);
                    foreach($files as $file){
                        $photo = array();
                            $photo['evenement_id'] = $entitiEvenement->id;
                            $photo['name_origne'] = $file;
                            $photo['name'] = $file;
                            $photo['name_in_csv'] = $file;
                            $photo['is_postable_on_facebook'] = false;
                        $this->loadModel('Photos');
                        
                        $isExiste = $this->Photos->find()->where([ 'name_in_csv'=> $photo['name_in_csv'],
                                                                'evenement_id' => $entitiEvenement->id
                                                                ])->first();
                        if(!$isExiste){
                            $entityPhoto = $this->Photos->newEntity($photo);
                            //debug($entityPhoto);
                            if(file_exists($dirEvenent->pwd().$file)){
                                if (copy($dirEvenent->pwd().$file, $dirPathDestination->pwd().$file)) {
                                    if($this->Photos->save($entityPhoto)){
                                        $this->out('Photo save Ev id '.$entitiEvenement->id .' id Photo '.$entityPhoto->id);
                                    }
                                }
                            }
                        }
                        
                        
                    }
                    $this->out('=======');
                }else{
                    debug($entitiEvenement);
                    die;
                }
                //die;
               
                
                
            }
        }
        
        
    }
    
    public function regenerateUserNameGal(){
        $this->loadModel('Users');
        $users = $this->Users->find('all') 
                                ->where(['role_id' => 3]);
        foreach($users as $user){
            $user->username = mb_strtoupper ($user->username);
            $user->password = mb_strtoupper ($user->username);
            if($this->Users->save($user)){
                $this->out('Save pour '.$user->id);
            }
        }
        
    }

    public function setDateHeurePrise ($idEvenement= null){
        $this->loadModel('Photos');
        $photos = $this->Photos->find("all")
                                        ->where(['date_prise_photo IS'=> NULL, 'heure_prise_photo IS'=> NULL,'Photos.id > '=> 213583 ])
                                        ->order('RAND()');
                                        //->limit(1000);
        //debug(explode('-', $photosSansDateHeurePrises->toArray()[1]->name_origne));die;
        
        if(!empty($idEvenement)){
            $photos = $photos->where(['Photos.evenement_id'=>$idEvenement]);
        }
        
        $date = new \DateTime();
        $date->setTimeZone(new \DateTimeZone("Europe/Paris"));
        $this->out('Lancement... ');
        //debug($photosSansDateHeurePrises->toArray());
        //var_dump($photos->toArray());
        foreach ($photos as $key => $photo){
            $name_fichier = $photo->name_origne;
            $name_array = explode('-', $photo->name_origne);
            $nbr = count($name_array);
            //debug($name_array);
            ///debug($nbr);
            //1305-2018-11-21-36323.jpg
            /*echo 'Phto id '.$photo->id;
            var_dump($name_array[0]);
            var_dump(count($name_array) );
            var_dump($photo->evenement_id );*/
            if($name_array[0] == $photo->evenement_id && count($name_array) == 5) {
                //debug($photo);die;
                $date->setTimestamp(intval($name_array[4]));
                $heure = $date->format('H:i:s');
                $photo->date_prise_photo = date($name_array[1] . "-" . $name_array[2] . "-" . $name_array[3]);
                $photo->heure_prise_photo = $heure;
                if ($this->Photos->save($photo)) {
                    $this->out('Ok avec id event => '.$photo->id);
                }
            }else if($name_array[0] == date('Y') && count($name_array) == 4){
                $date->setTimestamp(intval($name_array[3]));
                $heure = $date->format('H:i:s');
                $photo->date_prise_photo = date($name_array[0] . "-" . $name_array[1] . "-" . $name_array[2]);
                $photo->heure_prise_photo = $heure;
                if ($this->Photos->save($photo)) {
                    $this->out('Ok => '.$photo->id);
                }
            }
        }
        $this->out('terminer... ');
    }
    
    public function getCountPrint($idEvenement= null){
        $time = new Time('1 month ago');
        
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        //Pour l'import automatique
                                        ->where(['Evenements.date_debut <' => Time::now(),'Evenements.date_fin >' =>$time]);

        if(!empty($idEvenement)){
            $evenements = $evenements->where(['id' => $idEvenement]);
        }
        
        
        foreach($evenements as $evenement){
            for($numBorne = 1;$numBorne<=200;$numBorne++){
                 $source = Configure::read('source_photo_cloud').DS.'b'.$numBorne.DS.'files'.DS.$evenement->id.DS.'Data'.DS;
                 $counterFile = $source.'printcounter.txt';
                 if(file_exists($counterFile)){
                     $contentFile = file_get_contents($counterFile);
                     $counterPrintValue = intval($contentFile);
                     if(!empty($counterPrintValue)){
                         $evenement->print_counter = $counterPrintValue;
                         if($this->Evenements->save($evenement)){
                            $this->out('Printer count save for evenement '.$evenement->id .' = '.$evenement->print_counter);
                         }
                     }
                 }
            }
            //$this->out('Terminée depuis next ');
        }
    }
    
    public function notifyVisiteur(){
        $this->loadModel('Visiteurs');
        $visiteurs = $this->Visiteurs->find()
                                ->where(['Visiteurs.is_notification_send' => false])
                                
                                ->contain('Photos', function (Query $q) {
                                    return $q
                                        ->where(['Photos.is_validate' => true]);
                                });
                                /*->matching('Photos', function ($q) {
                                    return $q->where(['Photos.is_validate' => true]);
                                })
                                ->toArray();*/
                                
        foreach($visiteurs as $visiteur){
                if(!empty($visiteur->photos)){
                    //debug($visiteur); die;
                
                        $evenement = $this->Visiteurs->Evenements->find()
                                                            ->where(['Evenements.id' => $visiteur->evenement_id])
                                                            ->contain(['Galeries'])
                                                            ->first();
                        //is_photo_invited_must_moderate
                        if(!empty($evenement)){
                            $galerie = $evenement->galeries[0];
                            if($galerie->is_photo_invited_must_moderate){
                                
                                $titreHeader = $galerie->titre;
                                if(empty($titreHeader)){
                                    $titreHeader = $evenement->nom;
                                }
                                
                                $email = new Email();
                                $email
                                    ->setFrom(['contact@konitys.fr' => $titreHeader])
                                    ->setDomain('event.selfizee.fr')
                                    ->setViewVars(['visiteur' => $visiteur,'titreHeader' =>$titreHeader,'galerie' => $galerie ])
                                    ->setTemplate('photo_visiteur_validate')
                                    ->setEmailFormat('html')
                                    ->setTo($visiteur->email);
                                    
                                $subject = "Une photo a été validée dans la galerie ".$titreHeader;
                                if(count($visiteur->photos) > 1){
                                    $subject = count($visiteur->photos) ." photos ont été validées dans la galerie ".$titreHeader;
                                }
                                
                                
                                $email->setSubject($subject)
                                    ->setTransport('mailjet');
                                
                                if ($email->send()) {
                                    $visiteur->is_notification_send = true;
                                    $this->Visiteurs->save($visiteur);
                                }
                            }
                           
                        }
                }
        }
    }
    
    
    public function emailModerationNofitication(){
        $this->loadModel('Galeries');
        $galeries = $this->Galeries->find()
                                ->contain(['Evenements'])
                                ->where(['is_moderation_notification_sent' => false,'email_to_notify IS NOT' => NULL]);
        foreach($galeries as $galerie){
            if(!empty($galerie->email_to_notify)){
                $evenement = $galerie->evenements[0];
                $this->loadModel('Photos');
                $photoCount = $this->Photos->find()
                                    ->where(['Photos.evenement_id'=>$evenement->id,
                                             'Photos.source_upload' => 'galerie',
                                             'Photos.is_validate' => false,
                                             'Photos.deleted' => false
                                            ])
                                    ->count();
                if(!empty($photoCount)){
                        //Send email 
                        $titreHeader = $galerie->titre;
                        if(empty($titreHeader)){
                            $titreHeader = $galerie->evenements[0]->nom;
                        }
                        $email = new Email();
                        $email
                            ->setFrom(['contact@konitys.fr' => $titreHeader])
                            ->setDomain('event.selfizee.fr')
                            ->setViewVars(['galerie' => $galerie,'evenement'=>$evenement])
                            ->setTemplate('moderation_notification')
                            ->setEmailFormat('html')
                            ->setTo($galerie->email_to_notify);
                            
                
                        $email->setSubject("Des nouvelles photos ajoutées pour la galerie ".$titreHeader)
                            ->setTransport('mailjet');
                        
                        
                        if ($email->send()) {
                            $galerie->is_moderation_notification_sent = true;
                            $this->Galeries->save($galerie);
                        }
                }                   
            }
        }
        
        
    }

    /**
    * Liste des événement qui ont des fichiers modifiers dans le dossier upload de next cloud
    * Une tache cron qui sera appellée toutes les 3 minutes
    * Exemple chemin NextCloud : ///home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/b46/files/1442/Customized/
    * $source = Configure::read('source_photo_cloud').DS.'b'.$numBorne.DS.'files'.DS.$idEvenement.DS.'Customized'.DS;
    **/

    public function listeEvenementModierNextCloud(){
        $listeIdEvenement = array();
        $output = shell_exec('cd '.Configure::read('source_photo_cloud').'&& find . -cmin -45'); // Liste de tous les fichiers créés dans les 2 derniers heures:
        $arrayResult = $this->listFolderToArray($output);
        //var_dump($arrayResult); die;
        foreach($arrayResult as $key => $value){
                $infoEvenement = array();
                /**
                 * si la chaine /Customized est retourvée, ça veut dire que c'est une photo
                 * depuis la borne car le chemin de toutes les photos depuis next cloud 
                 * contient toujours /Customized . Et on va recupérer le id de l'événement
                 * qui se trouve entre files/ et /Customized (Ex: files/1537/Customized)
                 * 
                **/
                if(strpos($value, 'Customized') !== false && 
                    (
                        strpos($value, '.jpg') !== false || strpos($value, '.jpeg') !== false
                        || strpos($value, '.png') !== false 
                        || strpos($value, '.gif') !== false 
                    ) 
                    && strpos($value, '/files') !== false

                ){ // la chaine a été retrouvé
                    //var_dump(substr($value, 0, 1));
                    if(substr($value, 0, 1) == 'b'){
                        $numeroBorne = $this->getStringBetween($value,'b','/files/');
                        $idEvenement = $this->getStringBetween($value, 'files/', '/Customized');
                        
                        /*var_dump($idEvenement);
                        var_dump($numeroBorne);
                        die;*/
                        if(!empty($idEvenement) && !empty($numeroBorne)){
                            $infoEvenement['idEvenement'] = $idEvenement;
                            $infoEvenement['numeroBorne'] = $numeroBorne;
                            array_push($listeIdEvenement, $infoEvenement);
                        }
                    }
                }
        }
        /**
         * Importer les photos des événenement qui ont des nouvelles photos ajoutées
         * */
        //var_dump($listeIdEvenement); die;
        if(!empty($listeIdEvenement)){
            //$listeIdEvenement = array_unique($listeIdEvenement);
            $listeIdEvenement = array_map("unserialize", array_unique(array_map("serialize", $listeIdEvenement)));

            //var_dump($listeIdEvenement); die;
            foreach($listeIdEvenement as $key => $infoEvenement){
                $this->importPhoto($infoEvenement['idEvenement'] ,false, $infoEvenement['numeroBorne']);
                //Pour la borne Classik
                /*if($infoEvenement['idEvenement'] == 2403 ){
                    die('tapitra');
                }*/
                $this->importContactViaCsv($infoEvenement['idEvenement'], false, $infoEvenement['numeroBorne'], null, 0, 'b'); 
                
                //Ennvoi email et sms de l'événement
                $this->envoiV2($infoEvenement['idEvenement']);
              
            }
        }


    }

    public function getStringBetween($string, $start, $end){
           /* $ini = strpos($string, $start);
        
            if ($ini == 0){
                return null;
            }else{
                $ini += strlen($start);
                $len = strpos($string, $end, $ini) - $ini;
                return substr($string, $ini, $len);
            } */
            
            //$string = "[modid=256]";
            preg_match('~'.$start.'(.*?)'.$end.'~', $string, $output);
            return  $output[1]; // 256
            
    }
    
    public function listFolderToArray($string){
        return explode("./",$string);
    }

    public  function stringToArray($jobs = '') {
        $array = explode("\r\n", trim($jobs)); // trim() gets rid of the last \r\n
        foreach ($array as $key => $item) {
            if ($item == '') {
                unset($array[$key]);
            }
        }
        return $array;
    }


    //== cron generation vignette video
    public function generateMiniatureVideo(){
        $this->loadModel('Photos');
        $videos = $this->Photos->find('all')->where(['type_media'=> 'video', 'is_miniature_video_generated' => false])->limit(300);
        //debug(count($videos->toArray()));die;

        foreach ($videos as $key => $video) {
            //======= Generation miniature video
            $destination_path = WWW_ROOT."import".DS."galleries".DS. $video->evenement_id .DS. $video->name;
            $filename_miniature = explode(".", $video->name);
            $filename_miniature = $filename_miniature[0].".jpg";
            //debug($destination_path);
            if(file_exists($destination_path)){
                $destinationMiniautre = WWW_ROOT."import".DS."galleries".DS. $video->evenement_id .DS.'miniature_video'.DS;
                $dir_miniature         = new Folder($destinationMiniautre, true, 0755);
                $destinationMiniautre_path = $dir_miniature->pwd() . $filename_miniature;
                //debug($destinationMiniautre_path);                

                $this->loadComponent('PHPFFMpeg');
                $ffmpeg = $this->PHPFFMpeg->getFFMpeg();
                $movie = $ffmpeg->open($destination_path);

                $mediaFrame = $movie->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10));
                $vignette =   $mediaFrame->save($destinationMiniautre_path);
                if($vignette->getTimeCode() && file_exists($destinationMiniautre_path)){

                    $video->is_miniature_video_generated = true;
                    $video->miniature_video = $filename_miniature;
                    if($this->Photos->save($video)){
                        // minuature cree
                        //debug($video->evenement_id);
                    }
                }
            }  
        }
        //die;        
    }
	
	/**
	* Supprimer les photos qui sont déjà synchronisées.
	**/
	public function removeSynchronisedPicture(){
		$this->loadModel('Photos');
        $photos  = $this->Photos->find('all')
								->order(['RAND()']);
		 
	
		foreach($photos as $photo){
			
			$destintionPath = WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS;
			
			$sourceAncien = Configure::read('source_photo').$photo->evenement_id.DS;
			//$this->out('Photo : '.$sourceAncien.$photo->name_origne);
			if(file_exists($sourceAncien.$photo->name_origne) && file_exists($destintionPath.$photo->name_origne) ){
				unlink($sourceAncien.$photo->name_origne);
				$this->out('Photo supprimée '.$sourceAncien.$photo->name_origne);
			}
			
			
			for($numBorne = 1; $numBorne <= 200; $numBorne++){
				$sourceCloud = Configure::read('source_photo_cloud').DS.'b'.$numBorne.DS.'files'.DS.$photo->evenement_id.DS.'Customized'.DS;
				if(file_exists($sourceCloud.$photo->name_origne) && file_exists($destintionPath.$photo->name_origne) ){
					if(unlink($sourceCloud.$photo->name_origne)){
						$this->out('Photo supprimée '.$sourceCloud.$photo->name_origne);
					}
				}
			}
		}          
	}


	// Génération zip BO
	public function generateZip($idEvenment){
		$this->loadModel('Photos');
		$photos = $this->Photos->find()->where(['evenement_id'=>$idEvenment,'is_in_corbeille' => false,'deleted' => false]);
        $evenement = $this->Photos->Evenements->get($idEvenment,['contain'=>['Galeries']]);
        
        $outZipPath =  WWW_ROOT."import".DS."download".DS.$evenement->slug.'-tmp.zip';
        
        $zipFile = new ZipArchive();
        $zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
        foreach($photos as $photo){
            $filePath = $photo->uri_photo;
            $fileName = pathinfo($filePath,  PATHINFO_BASENAME );
            $zipFile->addFile($filePath, $fileName);
        }
        $zipFile->close();	
		rename(WWW_ROOT."import".DS."download".DS.$evenement->slug.'-tmp.zip', WWW_ROOT."import".DS."download".DS.$evenement->slug.'.zip');
	}
	
	// Génération zip Gallerie souvenir
	public function generateZipFront($idGalerie){
		$this->loadModel('Galeries');
		
		$galery = $this->Galeries->get($idGalerie, [
            'contain' => ['Evenements']
        ]);
       
        $evenements = $galery->evenements;
        $collection = new Collection($evenements);
        $listeIdEvenement = $collection->extract('id');
        $listeIdEvenement = $listeIdEvenement->toList();
        
         //debug($listeIdEvenement); die;
        
        $photos = $this->Galeries->Evenements->Photos->find()
                                    ->where(['evenement_id IN' => $listeIdEvenement,'is_in_corbeille' => false,'deleted' => false]);
        
        $outZipPath =  WWW_ROOT."import".DS."download".DS.$galery->slug.'-tmp.zip';
        
		// Si le fichier existe déjà on telecharger directement sinon on le crée.
		$zipFile = new ZipArchive();
		$zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
		foreach($photos as $photo){
			$filePath = $photo->uri_photo;
			$fileName = pathinfo($filePath,  PATHINFO_BASENAME );
			$zipFile->addFile($filePath, $fileName);
		}
		$zipFile->close();
		
		rename(WWW_ROOT."import".DS."download".DS.$galery->slug.'-tmp.zip', WWW_ROOT."import".DS."download".DS.$galery->slug.'.zip');
	}
	
    
    /*public function generateToken($idEvenement = null){
        $this->loadModel('Photos');
         $photos = $this->Photos->find('all')
                                ->where(['token IS'=>NULL]);
         if(!empty($idEvenement)){
            $photos = $photos->where(['evenement_id' => $idEvenement]);
         }
         
         foreach($photos as $photo){
            $mt = microtime();
            $token     = hash("crc32", $mt);
            $photo->token = $token;
            if($this->Photos->save($photo)){
                $this->out('Save '.$photo->id);
            }
         }
    }*/
}
