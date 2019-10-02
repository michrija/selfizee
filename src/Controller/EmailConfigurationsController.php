<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Utility\Text;
use Cake\Routing\Router;
use Cake\Http\Response;

use Cake\Collection\Collection;
/**
 * EmailConfigurations Controller
 *
 * @property \App\Model\Table\EmailConfigurationsTable $EmailConfigurations
 *
 * @method \App\Model\Entity\EmailConfiguration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailConfigurationsController extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['add','sendEmailTest'])) {
                    $idEvenement = $this->request->getParam('pass.0');
                    $clientId = $user['client_id'];
                    $this->loadModel('Evenements');
                    $evenement = $this->Evenements->get($idEvenement);
                    //debug($evenement->client_id); debug($clientId); die;
                    if($clientId == $evenement->client_id)  {
                        return true;
                    }               
            }
        }
        
        if($action == 'postTestEmail' || $action == 'uploadImgEditeur'  || $action == 'deleteImgEditeur' || $action == 'uploadfileInEditor'){
            return true;
        }
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    
    
    public function sendEmailTest($idEvenement){
         if ($this->request->is(['patch', 'post', 'put'])) {
            $idEvenement = $this->request->getData('evenement_id');
            $destinataire = $this->request->getData('email');
            $nom = $this->request->getData('nom');
            $prenom = $this->request->getData('prenom');
            
            if(!empty($destinataire) && !empty($idEvenement)){
                $this->loadComponent('Send');
                $this->loadModel('EmailConfigurations');
                $emailConfiguration = $this->EmailConfigurations->find()
                                                    ->where(['evenement_id'=> $idEvenement])
                                                    ->contain(['Evenements'])
                                                    ->first();                            
                if(!empty($emailConfiguration)){
                    $res = $this->Send->emailTest($destinataire, $nom, $prenom, $emailConfiguration);
                    if($res){
                        $this->Flash->success(__('Email de test envoyé'));
                    }else{
                        $this->Flash->error(__('Email de test non envoyé. Veuillez réessayer'));
                    }
                }else{
                    $this->Flash->error(__("Avant de faire un test d'envoi. Veuillez enregister votre configuration."));
                }
            }else{
                 $this->Flash->error(__('Champ email obligatoire'));
            }
         }
         return $this->redirect(['action' => 'add',$idEvenement]);
    }
    
    


    public function getMailId()
    {
       $mailId = $this->request->getQuery('id');
        $EmailConf = $this->EmailConfigurations->findById($mailId)->first();
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $defaultCouleurFond = "#FFFFFF";
        $emailConfiguration = $this->EmailConfigurations->newEntity();
        $evenement = null;
        if(!empty($idEvenement)){
            $evenement = $this->EmailConfigurations->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);//debug($evenement);die;
            $emailConfigurationFind = $this->EmailConfigurations->find()
                                                        ->where(['evenement_id'=>$idEvenement])
                                                        ->contain(['CodePromos'])
                                                        ->first();
            if($emailConfigurationFind){
                $emailConfiguration = $emailConfigurationFind;
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;  
            //Date d'envoi
            $dataEnvoiFr = trim($this->request->getData('date_heure_envoi'));
            if(!empty($dataEnvoiFr)){
                $dateEnvoi = $this->DateFR2DateSQL($dataEnvoiFr);
                $data['date_heure_envoi'] = $dateEnvoi;
            }
            $isEnvoiPlannifie = $this->request->getData('is_envoi_plannifie');
            if(empty($isEnvoiPlannifie)){
                $data['date_heure_envoi'] = null;
            }
            
            if(!empty($data['img_contents'])){                     
                $destination = WWW_ROOT."import".DS."email_config".DS. $idEvenement.DS;
                $dir         = new Folder($destination, true, 0755);
                foreach ($data['img_contents'] as $key => $img) {
                    # code...
                    $destination_path = $dir->pwd() . $img;
                    //debug(UPLOAD_TMP .DS. $img);debug($destination_path);die;
                    if(file_exists(UPLOAD_TMP .DS. $img)){
                        if (copy(UPLOAD_TMP .DS. $img, $destination_path)) {
                                unlink(UPLOAD_TMP .DS. $img);
                                if(substr_count($data['content'], 'upload/tmp') > 0) {
                                    $url_img_tmp = array('upload/tmp');
                                    $url_img_exact = array('import/email_config/'.$idEvenement);
                                    $data['content'] = str_replace($url_img_tmp, $url_img_exact, $data['content']);
                                } 
                        }
                    }
                }
            }

            if (!empty($data['img_contents_to_delete'])) {
                    $listImgToDelete = $data['img_contents_to_delete'];
                    foreach ($listImgToDelete as $img) {

                        if(file_exists(UPLOAD_TMP .DS. $img)){
                                unlink(UPLOAD_TMP .DS. $img);
                        }

                        if(file_exists(WWW_ROOT."import".DS."email_config".DS. $idEvenement .DS. $img)){
                                unlink(WWW_ROOT."import".DS."email_config".DS. $idEvenement .DS. $img);
                        }
                    }
            }
            /**
             *  Liste code promo en textarea
             * */
             $listeCodePromo = $this->request->getData('liste_code_promo');
             if(!empty($listeCodePromo)){
                $codePromos = explode("\n", $listeCodePromo);
                $codePromos = array_map('trim',$codePromos);
                $allCodePromo = array();
                if(!empty($codePromos)){
                    foreach($codePromos as $codePromo){
                        $oneCode = array();
                            $oneCode['code_promo'] = $codePromo;
                        array_push($allCodePromo, $oneCode);
                    }
                }
                
                $data['code_promos'] = $allCodePromo;
             }
             //debug($data); die;
             $isNewAdress = $this->request->getData('is_newAdresse');
             $clientId = $this->Auth->user('client_id');
             if($isNewAdress && $clientId){
                $this->loadModel('Expediteurs');
                $expediteur = $this->Expediteurs->newEntity();
                    $expediteur->email = $this->request->getData('email_expediteur');
                    $expediteur->client_id = $clientId;
                $this->Expediteurs->save($expediteur);
             }
             
            
            $emailConfiguration = $this->EmailConfigurations->patchEntity($emailConfiguration, $data);
            $emailConfiguration->dirty('code_promos', true);
            if ($this->EmailConfigurations->save($emailConfiguration)) {
                $this->Flash->success(__('The email configuration has been saved.'));

                return $this->redirect(['action' => 'add', $emailConfiguration->evenement_id]);
            }
            $this->Flash->error(__('The email configuration could not be saved. Please, try again.'));
        }
        
        $codePromoList = null;
        if(!empty($emailConfiguration->code_promos)){
            $collection = new Collection($emailConfiguration->code_promos);
            $codePromo  = $collection->extract('code_promo');
            $codePromo = $codePromo->toList();
            if(!empty($codePromo)){
                $codePromoList = implode("\n", $codePromo);
            }
        }
        $evenements = $this->EmailConfigurations->Evenements->find('list',['valueField'=>'nom']);
        $clientsModelesEmails = $this->EmailConfigurations->ClientsModelesEmails->find('list', ['valueField'=>'nom_modele'])->where(['client_id'=> $evenement->client_id]);
        
        $this->loadModel('Expediteurs');
        $expediteurs = $this->Expediteurs->find('list', [ 
            'keyField' => 'email',
            'valueField' => 'email'
        ]);

        $this->set(compact('expediteurs','emailConfiguration','idEvenement','evenements','evenement', 'clientsModelesEmails','defaultCouleurFond','defaultCouleurDownloadLink','codePromoList'));

        $this->set('isConfiguration',true);
    }

    public function uploadImgEditeur(){

        $this->autoRender = false;
        $res ['success'] = false;
        $file   = $this->request->getData('imageField');
        //debug($file);die;
        //echo json_encode($file);

        $destination = WWW_ROOT."upload".DS."tmp".DS;
        $dir         = new Folder($destination, true, 0755);
             
        if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $destination . $filename;

                if(move_uploaded_file($tmp, $destination_path)){
                    $res ['success'] = true;
                    $res ['filename'] = $filename;
                    $res ['url'] = Router::url('/', true)."upload/tmp/".$filename;
                }               
        }
        //debug($res);die;
        echo json_encode($res); 
    }

    public function deleteImgEditeur(){

        $this->autoRender = false;
        $res ['success'] = false;
        $file   = $this->request->getData('imageName');
        //debug($file);die;
        if(file_exists(UPLOAD_TMP .DS. $file)){
            unlink(UPLOAD_TMP .DS. $file);
            $res ['success'] = true;
        }
        echo json_encode($res); 
    }


//    /**
//     * Edit method
//     *
//     * @param string|null $id Email Configuration id.
//     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $emailConfiguration = $this->EmailConfigurations->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $emailConfiguration = $this->EmailConfigurations->patchEntity($emailConfiguration, $this->request->getData());
//            if ($this->EmailConfigurations->save($emailConfiguration)) {
//                $this->Flash->success(__('The email configuration has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The email configuration could not be saved. Please, try again.'));
//        }
//        $this->set(compact('emailConfiguration'));
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Email Configuration id.
//     * @return \Cake\Http\Response|null Redirects to index.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $emailConfiguration = $this->EmailConfigurations->get($id);
//        if ($this->EmailConfigurations->delete($emailConfiguration)) {
//            $this->Flash->success(__('The email configuration has been deleted.'));
//        } else {
//            $this->Flash->error(__('The email configuration could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
//    }
 
    public  function DateFR2DateSQL ($date) {
          //$date = '29/12/1990 23:30';
          //29/12/1990 23:30
          $day    = substr($date,0,2);
          $month  = substr($date,3,2);
          $year   = substr($date,6,4);
          $hour   = substr($date,11,2);
          $minute = substr($date,14,2);
          $second = substr($date,18,2);
            //debug($hour.'-'.$minute.'-'.$second.'-'.$month.'-'.$day.'-'.$year);die;

          $timestamp= mktime($hour,$minute,$second,$month,$day,$year);
          return date('Y-m-d H:i:s',$timestamp);  
    }

    public function uploadfileInEditor(){

        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');

        /***************************************************
       * Only these origins are allowed to upload images *
       ***************************************************/
      $accepted_origins = array("http://localhost", "https://manager.selfizee.fr", "http://example.com",'http://manager.selfizee.mg');

      /*********************************************
       * Change this line to set the upload folder *
       *********************************************/
     // $imageFolder = "images/";
      $destination = WWW_ROOT."import".DS."editor".DS;
      $imageFolder         = new Folder($destination, true, 0755);

      reset ($_FILES);
      $temp = current($_FILES);
      if (is_uploaded_file($temp['tmp_name'])){
        /*if (isset($_SERVER['HTTP_ORIGIN'])) {
          // same-origin requests won't set an origin. If the origin is set, it must be valid.
          if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
          } else {
            header("HTTP/1.1 403 Origin Denied");
            return;
          }
        }*/

        /*
          If your script needs to receive cookies, set images_upload_credentials : true in
          the configuration and enable the following two headers.
        */
        // header('Access-Control-Allow-Credentials: true');
        // header('P3P: CP="There is no P3P policy."');

        // Sanitize input
        if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
            header("HTTP/1.1 400 Invalid file name.");
            return;
        }

        // Verify extension
        if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
            header("HTTP/1.1 400 Invalid extension.");
            return;
        }

        $pathinfos        = pathinfo($temp['name']);
        $extension        = $pathinfos['extension'];
        $filename         = Text::uuid()."." . $extension;

        // Accept upload if there was no origin, or if it is an accepted origin
        $filetowrite = $imageFolder->pwd() . $filename;

        if(move_uploaded_file($temp['tmp_name'], $filetowrite)){
            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => Router::url('/', true)."import/editor/".$filename));
        }else{
            header("HTTP/1.1 400 Une erreur est survenue. Veuillez réessayer plus tard.");
            return;
        }

        
      } else {
        // Notify editor that the upload failed
        header("HTTP/1.1 500 Server Error");
      }
    }
}
