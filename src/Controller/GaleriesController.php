<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Collection\Collection;
use Cake\Console\ShellDispatcher;
use ZipArchive;
use Cake\Mailer\Email;
use Cake\Core\Configure;
/**
 * Galeries Controller
 *
 * @property \App\Model\Table\GaleriesTable $Galeries
 *
 * @method \App\Model\Entity\Galery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GaleriesController extends AppController
{

     const PATH_GALERIE_BANIERE = WWW_ROOT."import".DS."galleries".DS."head". DS;
     const PATH_GALERIE_BANIERE_APERCU = WWW_ROOT."import".DS."galleries".DS."head_apercu". DS;
     
     
     public function isAuthorized($user)
    {
        
        // Par d�faut, on autorise.
        return true;
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
        $this->viewBuilder()->setLayout('sans_menu');
        $key = $this->request->getQuery('key');
        $optionsFiltre['key'] = $key;
        
        $evenements = array();
        if(!empty($this->Auth->user('client_id'))){
            $evenements = $this->Galeries->Evenements->find('list',['valueField'=>'id'])
                                        ->where(['client_id' => $this->Auth->user('client_id')])
                                        ->toArray();
        }
        //debug($evenements);
        $optionsFiltre['listeEvenementId'] = $evenements;
        $this->paginate = [
            'finder' => [
                'filtre' => $optionsFiltre
            ],
            'order' =>['id'=>'desc']
        ];
       
        $galeries = $this->paginate($this->Galeries);

        $this->set(compact('galeries','key'));
    }

    /**
     * View method
     *
     * @param string|null $id Galery id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $galery = $this->Galeries->get($id, [
            'contain' => []
        ]);

        $this->set('galery', $galery);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $defaultIsLivreDor = false;
        $defaultCouleurTheme = "";
        $defaultTitre = "";
        $defailtSousTitre = "";
        $defaultImageBaniere = "";
        
        $galery = $this->Galeries->newEntity();
        if(!empty($idEvenement)){  
            $evenement = $this->Galeries->Evenements->get($idEvenement, ['contain'=>'Fonctionnalites','Clients','Galeries']);
            //debug($evenement);die;
            $galeryFind = $this->Galeries->find()
                                ->matching('Evenements', function ($q) use($idEvenement) {
                                        return $q->where(['Evenements.id' => $idEvenement]);
                                })
                                ->contain(['Users'])
                                ->first();
            if($galeryFind){
                $galery = $galeryFind;
            }
            
         $role = $this->Auth->user('role_id');
         if($role == 2){
            $this->loadModel('ClientsCustoms');
            $clientInSession = $this->Auth->user('client_id');
            $defaultConf = $this->ClientsCustoms->find('all')->where(['client_id'=>$clientInSession])->first();
            if($defaultConf){
                //$defaultCouleurFond = $defaultPageSouvenir->ps_couleur_de_fond;
                //$defaultCouleurDownloadLink = $defaultPageSouvenir->ps_couleur_download_link;
                $defaultIsLivreDor = $defaultConf->gs_is_livredor_active;
                $defaultCouleurTheme = $defaultConf->gs_couleur;
                $defaultTitre = $defaultConf->gs_titre;
                $defailtSousTitre = $defaultConf->gs_sous_titre;
                $defaultImageBaniere = $defaultConf->ps_couleur_de_fond;
            }
         }   
            
        }else{
            $this->viewBuilder()->setLayout('sans_menu');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;
            if(!empty($data['img_banniere_file'])){
                    $fileData = $this->request->getData('img_banniere_file');
                    if(!empty($fileData['name'])) {
                        $res = $this->uploadImgBanniere($fileData,$galery->id);
                        if($res['success']){
                            $data['img_banniere'] = $res['filename'];
                        }
                    }else{
                        $data['img_banniere'] = null;
                    }
                    
            }
            
            //debug($data); 
            //$data['evenement']['slug'] =  $data['slug'];
            
            $galery = $this->Galeries->patchEntity($galery, $data);
            if ($this->Galeries->save($galery)) {

                $this->Flash->success(__('The galery has been saved.'));

                return $this->redirect(['action' => 'add', $idEvenement]);
            }
            $this->Flash->error(__('The galery could not be saved. Please, try again.'));
        }
        $evenements = $this->Galeries->Evenements->find('list',['valueField'=>'nom']);
        if(!empty($this->Auth->user('client_id'))){
          $evenements = $evenements->where(['client_id' => $this->Auth->user('client_id')]);
        }
        //debug($galery);die;
        
        $this->set(compact("defaultIsLivreDor","defaultCouleurTheme","defaultTitre","defailtSousTitre","defaultImageBaniere" ));
        $this->set(compact('galery','idEvenement',"evenements","evenement"));
        $this->set('isConfiguration',true);
    }

    public function sendgalerie(){
        date_default_timezone_set('Europe/Paris');
        //debug(date('Y-m-d h:i:s'));die;
        $this->loadModel('GalerieEmails');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;
            $destinateurs = [];
            if(!empty($data['destinateur'])){
                if (filter_var(trim($data['destinateur']), FILTER_VALIDATE_EMAIL)) { //==email valide
                    //debug($email_multi);
                    $destinateurs [] = trim($data['destinateur']);
                }
            }
            if(!empty($data['destinateurs_mutliple'])){
                $dest_multiple = explode(',', $data['destinateurs_mutliple']);
                //debug($dest_multiple);
                foreach ($dest_multiple as $email_multi){
                    $email_multi = trim($email_multi);
                    if (filter_var($email_multi, FILTER_VALIDATE_EMAIL)) { //==email valide
                        //debug($email_multi);
                        $destinateurs [] = $email_multi;
                    }
                }
            }
            $evenement = $this->Galeries->Evenements->get($data['evenement_id'], ['contain'=>'Clients']);
            $galery = $this->Galeries->get($data['galery_id'], ['contain'=>'Users']);
            $galery_email = $this->GalerieEmails->newEntity();
            $galery_email->date = date('Y-m-d h:i:s');
            //$galery_email->commentaire = $data['commentaire'];
            $galery_email->galerie_id = $data['galery_id'];
            $galery_email->destinateurs = implode(", ", $destinateurs);
            //debug($galery_email);die;
            /*if ($this->GalerieEmails->save($galery_email)){
                $this->Flash->success(__('Email sent.'));
                debug($galery_email);
            }die;*/

            $email = new Email('default');
            $email->setViewVars(['slug' => $evenement->slug, 'url_front' => Configure::read('url_front_domaine')/* 'commentaire' => $data['commentaire']*/])
                ->setTemplate('sendgalerie')
                ->setEmailFormat('html')
                ->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
                ->setSubject('SELFIZEE <> Votre Galerie Photo en ligne')
                ->setTransport('mailjet')
                ->setTo($destinateurs);
                if ($email->send()) {
                    $this->GalerieEmails->save($galery_email);
                    $this->Flash->success(__('Email envoyé.'));
                } else {
                    $this->Flash->error(__('Email non envoyer. Veuillez réessayer.'));
                }
            return $this->redirect($this->referer());
            //return $this->redirect(['action' => 'add', $evenement->id]);
        }
        //$this->set('slug', $evenement->slug );
    }
    
    private function uploadImgBanniere($fileData,$idGalerie, $destinationPath = null) {
        $this->loadComponent("RegenerateImage");
        //debug($fileData);die;
        $res['success'] = false;
        if (!empty($fileData['name'])) {
           $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);
            if (in_array($extension, array('jpg', 'jpeg', 'png'))) {

                $filename         = Text::uuid().'.'. $extension;
                $destination      = $destinationPath == null ? self::PATH_GALERIE_BANIERE. "album-".$idGalerie : $destinationPath ;

                if(is_dir($destination)){
                    $dir              = new Folder($destination);
                    $dir->delete();
                }     
                $dir              = new Folder($destination, true, 0755);
                $destinationPath = $dir->pwd() . DS . $filename;
                //debug($fileData);
                if(move_uploaded_file($fileData['tmp_name'], $destinationPath)){
                    $this->RegenerateImage->_image_quality = $extension;
                    $this->RegenerateImage->resize($destinationPath,$destinationPath,1280,633);//1280x633
                    $res['success'] = true;
                    $res['filename'] = $filename;
                }
            }
        }
        return $res;
    }

    /**
     * Edit method
     *
     * @param string|null $id Galery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $galery = $this->Galeries->get($id, [
            'contain' => ['Evenements']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if(!empty($data['img_banniere_file'])){
                    $fileData = $this->request->getData('img_banniere_file');
                    if(!empty($fileData['name'])) {
                        $res = $this->uploadImgBanniere($fileData,$galery->id);
                        if($res['success']){
                            $data['img_banniere'] = $res['filename'];
                        }
                    }else{
                        $data['img_banniere'] = null;
                    }
                    
            }
            $galery = $this->Galeries->patchEntity($galery, $data);
            if ($this->Galeries->save($galery)) {
                $this->Flash->success(__('The galery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The galery could not be saved. Please, try again.'));
        }
        $evenements = $this->Galeries->Evenements->find('list',['valueField'=>'nom']);
        if(!empty($this->Auth->user('client_id'))){
          $evenements = $evenements->where(['client_id' => $this->Auth->user('client_id')]);
        }
        $this->set(compact('galery','evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Galery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $galery = $this->Galeries->get($id);
        if ($this->Galeries->delete($galery)) {
            $this->Flash->success(__('The galery has been deleted.'));
        } else {
            $this->Flash->error(__('The galery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function souvenir($idEncode, $addPhoto = "" ){
        $this->viewBuilder()->setLayout('galerie-souvenir');
        
        $id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT)); 
        
        $galery = $this->Galeries->get($id, [
            'contain' => ['Evenements'=>['RsConfigurations']]
        ]);
        $evenements = $galery->evenements;
        $collection = new Collection($evenements);
        $listeIdEvenement = $collection->extract('id');
        $listeIdEvenement = $listeIdEvenement->toList();
        
        
        $rsConfiguration = $evenements[0]->rs_configuration;
        //debug($rsConfigurations);
        //die;
        $key = $this->request->getQuery('key');
        $dateOrder = $this->request->getQuery('dateOrder');
        $sourceGal = $this->request->getQuery('sourceGal');
        $visiteur = $this->request->getQuery('visiteur');
        
        $optionsFiltre['listeIdEvenement'] = $listeIdEvenement;
        $optionsFiltre['key'] = $key;
        $optionsFiltre['dateOrder'] = $dateOrder;
        $optionsFiltre['sourceGal'] = $sourceGal;
        $optionsFiltre['visiteur'] = $visiteur;
        //debug($optionsFiltre);die;
   
        
        $this->loadModel('Photos');
        $this->paginate = [
            'limit' => 40,
            'finder' => [
                'souvenir' => $optionsFiltre
            ],
            'conditions' =>['Photos.deleted' => false, 'Photos.is_in_corbeille'=> false]//,'Photos.is_optin_galerie' => true
        ];
      
        
        $queue = time();
        
        $photos = $this->paginate($this->Photos);
        $page = $this->request->getQuery('page');
        if(empty($page)){
            $page = 1 ; 
        }
        
        
        $evenementList = $this->Photos->Evenements->find('list',['valueField'=>'nom'])->where(['id IN' => $listeIdEvenement]);
        $galerieCommentaire = $this->Galeries->GalerieCommentaires->newEntity();
        
        $this->loadModel('Visiteurs');
        $visiteurs = $this->Visiteurs->find('list',['valueField' => 'full_name'])
                                ->where(['Visiteurs.evenement_id' => $listeIdEvenement[0]])
                                ->group(['Visiteurs.email']);
        $nbrContactEmail = 0;               
        if(!empty($listeIdEvenement)){
            $idPhotos = $this->Photos->find('list')
                                ->where(['Photos.evenement_id IN' => $listeIdEvenement])
                                ->toArray();
            if(!empty($idPhotos)){
                $listContactEmail = $this->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
                                                        
                $nbrContactEmail = count($listContactEmail);
            }
        }
         
        $this->set(compact('galery','photos','rsConfiguration','page','evenementList','key', 'dateOrder','galerieCommentaire','queue','idEncode','listeIdEvenement','sourceGal','visiteurs','visiteur','nbrContactEmail'));
        
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $this->render('liste_item');
            
        }else if($addPhoto == 'addPhoto'){
            $this->loadModel('Visiteurs');
            $visiteur = $this->Visiteurs->newEntity();
            $this->set(compact('visiteur'));
            $this->render('ajout_photo');
        }
    }

    public function apercu() {
        $this->loadModel('Photos');
        $this->viewBuilder()->setLayout('galerie-souvenir-apercu');
        
        $photos = collection([]);
        $idEncode = null;
        $queue = time();
        $sourceGal = $this->request->getQuery('sourceGal');
        $dateOrder = $this->request->getQuery('dateOrder');
        $visiteurs = collection([]);
        $galerieCommentaire = $this->Galeries->GalerieCommentaires->newEntity();

        if ($this->request->is('post')) {
            (new Folder(self::PATH_GALERIE_BANIERE_APERCU))->delete();
            $data = $this->request->getData();

            if(!empty($data['img_banniere_file'])){
                $fileData = $this->request->getData('img_banniere_file');
                if(!empty($fileData['name'])) {
                    $res = $this->uploadImgBanniere($fileData, false, self::PATH_GALERIE_BANIERE_APERCU);
                    if($res['success']){
                        $data['img_banniere'] = $res['filename'];
                    }
                }else{
                    $data['img_banniere'] = null;
                }
            }

            $galery = $this->Galeries->newEntity();
            $galery = $this->Galeries->patchEntity($galery, $data);
            $galery->id = false;

            $evenements = $galery->evenements;
            $collection = collection($evenements);
            $listeIdEvenement = $collection->extract('id')->toArray();
            $evenementList = $this->Photos->Evenements->find('list', ['valueField'=>'nom'])->where(['id IN' => $listeIdEvenement]);

            
            $this->request->getSession()->write('galerie_apercu', $galery);

        } else {
            if ($galeryInsession = $this->request->getSession()->read('galerie_apercu')) {
                $galery = $galeryInsession;

                $evenements = $galery->evenements;
                $collection = collection($evenements);
                $listeIdEvenement = $collection->extract('id')->toArray();
                $evenementList = $this->Photos->Evenements->find('list', ['valueField'=>'nom'])->where(['id IN' => $listeIdEvenement]);
            } else {
                return $this->redirect(['action' => 'add']);
            }
        }


        $this->set(compact('photos', 'galery', 'idEncode', 'queue', 'sourceGal', 'visiteurs', 'dateOrder', 'evenementList', 'galerieCommentaire'));
    }
    
    public function savePhotoVisiteur($idEncode){
        $this->loadModel('Visiteurs');
        $visiteur = $this->Visiteurs->newEntity();
        if ($this->request->is('post')) {
            $visiteur = $this->Visiteurs->patchEntity($visiteur, $this->request->getData());
            //debug($visiteur); die;
            if ($this->Visiteurs->save($visiteur)) {
                $this->Flash->success(__('Photo visiteur enregistrée.'));
                foreach($visiteur->photos as $photo){
                    $source = WWW_ROOT."import".DS."galleries".DS."tmp".DS.$photo->evenement_id.DS.$photo->name;
                    if(file_exists($source)){
                        $destination = WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS.$photo->name;
                        copy($source,$destination);
                    }
                }

                
            }else{
                $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer plus tard.'));
            }
            
        }
        return $this->redirect(['action' => 'souvenir',$idEncode]);
    }
    
    public function uploadPhotoTmp($idEvenement, $isMustModerateVal){
        $this->autoRender = false; // We don't render a view
        $res['success'] = false;
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            //$destination = UPLOAD_TMP . DS . $idEvenement;
            $destination = WWW_ROOT."import".DS."galleries".DS."tmp".DS.$idEvenement.DS;
            $dir         = new Folder($destination, true, 0755);
           
            ///debug($file);die;
            $photoValidate = true;
            if($isMustModerateVal){
                $photoValidate = false;
            }
             
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;
                
                if(move_uploaded_file($tmp, $destination_path)){
                        $res['success'] = true;
                        $res['filename'] = $filename;
                        $res['is_validate'] = $photoValidate;
                        $res['name_origne'] = $filenameOrigine;
                        $res['name_in_csv'] = $filenameOrigine;
                        $res['source_upload'] = 'galerie';
                        
                        echo json_encode($res);
                }
            }
        }
    }
    
    public function uploadPhoto($idEvenement, $queue, $isMustModerateVal)
    {
        $this->autoRender = false; // We don't render a view
        $res['success'] = false;
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            //$destination = UPLOAD_TMP . DS . $idEvenement;
            $destination = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
            $dir         = new Folder($destination, true, 0755);
           
            ///debug($file);die;
            $photoValidate = true;
            if($isMustModerateVal){
                $photoValidate = false;
            }
             
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;
                
                if(!strpos($file, "x2")){
                    if(move_uploaded_file($tmp, $destination_path)){
                        
                        $photo = array();
                            $photo['queue'] = $queue;
                            $photo['evenement_id'] = $idEvenement;
                            $photo['name_origne'] = $filenameOrigine;
                            $photo['name_in_csv'] = $filenameOrigine;
                            $photo['name'] = $filename;
                            $photo['source_upload'] = 'galerie';
                            $photo['is_validate'] = $photoValidate;
                        $this->loadModel('Photos');
                        $entity = $this->Photos->newEntity($photo);
                        if($this->Photos->save($entity)){
                            $res['success'] = true;
                            $res['filename'] = $filename;
                            echo json_encode($res);
                        }else{
                            //debug($entity);
                        }
                    }
                }
                
                
            }
           
            
            
        }
    }
    
    
 
        
   
    
    
    public function popupImage($idPhoto, $idGalerry){
        $this->viewBuilder()->setLayout('popup-photo-galerie');
        $this->loadModel('Photos');
        $photo = $this->Photos->get($idPhoto,['contain'=>['Evenements'=>['RsConfigurations']]]);
        
        $this->loadModel('Galeries');
        $galery = $this->Galeries->get($idGalerry);
        
        $this->loadModel('PhotoCommentaires');
        $optionsFiltre['idPhoto'] = $photo->id;
        $this->paginate = [
            'finder' => [
                'filtre' => $optionsFiltre
            ],
            'order' => ['created' => 'desc']
        ];
        $photoCommentaires = $this->paginate($this->PhotoCommentaires);
        $photoCommentaire = $this->PhotoCommentaires->newEntity();
        $maxLimit = 25;
        
        $this->set(compact('photo','galery','photoCommentaires','photoCommentaire','maxLimit'));
    }
    
	
	
	// Ajax pour création du zip de l'album photo
	public function ajaxGenerationZipFront(){
		$this -> autoRender = false;
		/*
		 * @Paul
		 * Projet : https://trello.com/c/l6H6mZ3K/573-g%C3%A9n%C3%A9ration-url-des-photos-zipper
		 * Description : Génération zip + envoi mail pour téléchargement albums photos d'un event
		 * 06/08/19
		 *
		 */
		if(!empty($this -> request -> getData('mail'))){
			// Envoi mail
			$destinateurs = trim($this -> request -> getData('mail'));
			
			$idGalerie = $this -> request -> getData('idGalerie');
			$source = $this -> request -> getData('source');
			$queue = $this -> request -> getData('queue');
			$userIdConnected = $this->Auth->user('id');
			
			$link = $this -> utilities -> slEncryption(serialize(['time' => time(), 'email' => $destinateurs, 'idGalerie' => $idGalerie, 'source' => $source, 'queue' => $queue,'user_idConnected' => $userIdConnected]));
			$contenu = '';
			
			if($destinateurs && filter_var($destinateurs, FILTER_VALIDATE_EMAIL)){
				// Génération du zip
				$shell = new ShellDispatcher();
				$output = $shell->run(['cake', 'photo', 'generateZipFront', $idGalerie]);
				// Récupération du nom de l'evenement
				$this -> loadModel('Galeries');
				$galery = $this->Galeries->get($idGalerie, [
					'contain' => ['Evenements']
				]);
				$nom_event = '';
				if(!empty($galery->evenements)){
					$nom_event = $galery->evenements[0]['nom'];
				}
				
				if (0 === $output) {
					$front_domaine = Configure::read('url_front_domaine');
					// Envoi mail
					$contenu .= ''.
					'<table style="border-collapse:collapse;width:100%;min-width:100%;height:auto" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">'.
						'<tbody>'.
							'<tr>'.
								'<td style="padding-top:20px" width="100%" valign="top" bgcolor="#ffffff">'.
									'<table  style="border-collapse:collapse;margin:0 auto" width="580" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">'.
										'<tbody>'.
											'<tr>'.
												'<td style="padding:0" valign="top" bgcolor="#ffffff" align="center">'.
													'<h2 style="margin-top:45px;margin-bottom: 45px;">Galerie de photo pour votre événement '.$nom_event.'</h2>'.
												'</td>'.
											'</tr>'.
											'<tr>'.
												'<td style="padding:0" valign="top" bgcolor="#ffffff" align="center">'.
													'Votre fichier de téléchargement est maintenant prêt. Veuillez cliquer sur ce bouton pour pouvoir le télécharger.'.
												'</td>'.
											'</tr>'.
											'<tr>'.
												'<td style="padding:0" valign="top" bgcolor="#ffffff" align="center">'.
													'<a href="'.$front_domaine.'e/f/download/'.$link.'" style="display:block;padding:15px 40px;background-color:#eb2162;color:#FFF;width:160px;margin:auto;margin-top:45px;margin-bottom:45px;text-decoration:none;border-radius:5px">&nbsp;Télécharger&nbsp;</a>'.
												'</td>'.
											'</tr>'.
											'<tr>'.
												'<td style="padding:0" valign="top" bgcolor="#ffffff" align="center">'.
													'Celui-ci a une durée de 7 jours.'.
												'</td>'.
											'</tr>'.
											'<tr>'.
												'<td style="padding:0" valign="top" bgcolor="#ffffff" align="center">'.
													'Nous vous remercions pour votre confiance.'.
												'</td>'.
											'</tr>'.
										'</tbody>'.
									'</table>'.
								'</td>'.
							'</tr>'.
						'</tbody>'.
					'</table>';
					
					$email = new Email('default');
					$email->setViewVars(['contenu' => $contenu])
						->setTemplate('downloadaccess')
						->setEmailFormat('html')
						->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
						->setSubject('Votre galerie photo de votre événement')
						->setTransport('mailjet')
						->setTo($destinateurs);
					$email->send();
					// $this->Flash->success('Le lien de téléchargement direct a été envoyé avec succès. Ceci expirera dans 7 jours.');
				} else {
					// $this->Flash->error('Une erreur est survenue.');
				}
				
			}
			
		}
		exit;
	}
	
	public function downloadLienEncrypte($parametre){
		//ob_clean();
		set_time_limit(0);
		ini_set('upload_max_filesize', '6400M');
		ini_set('post_max_size', '6400M');
		ini_set('memory_limit', '6400M');
		   
		//$this->response = $this->response->withDisabledCache();
		//$this->response = $this->response->withSharable(true, 3600000);
		//ob_end_clean();

			
		$parametre = trim($parametre);
		if(!empty($parametre)){
			$params = unserialize($this -> utilities -> slDecryption($parametre));
			if(!empty($params['idGalerie']) && $params['idGalerie'] > 0){
				$galery = $this->Galeries->get($params['idGalerie'], [
					'contain' => ['Evenements']
				]);
				$outZipPath =  WWW_ROOT."import".DS."download".DS.$galery->slug.'.zip';
				if(file_exists($outZipPath)){
					$response = $this->response->withFile(
						$outZipPath,
						['download' => true, 'name' => $galery->slug.'.zip']
					);
					//On ne va plus fare une boucle car à 99% des cas une galerie n'a qu'un seul événement
					if(!empty($params['user_idConnected'])){
						$data['user_id'] = $params['user_idConnected']; // JY : J'ai commenté car l'id n'est pas là et ça crée une erreur qui fait peter le truc
						$data['galerie_id'] = $galery->id;
						$data['source_download'] = 2;
						$data['ip'] = $this->request->clientIp();
						$data['queue'] = $params['queue'] ? $params['queue'] : time();
						$data['evenement_id'] = $galery->evenements[0]->id;
						$download = $this->Galeries->GalerieDownloads->newEntity($data);
						$this->Galeries->GalerieDownloads->save($download);
					}
					return $response;
					
					/*header('Pragma: public');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private', false);
					header('Content-Transfer-Encoding: binary');
					header('Content-Disposition: attachment; filename="'.$galery->slug.'.zip"');
					header("Content-length:".filesize($outZipPath));
					header('Content-Type: application/zip'); // ZIP file
					header('Content-Type: application/octet-stream');
					
					$chunkSize = 1024 * 1024;
					$handle = fopen($outZipPath, 'rb');
					while (!feof($handle))
					{
						$buffer = fread($handle, $chunkSize);
						echo $buffer;
						ob_flush();
						flush();
					}
					fclose($handle);
					exit;*/
					
					

				}else{
					echo '<div style="width: 100%;text-align:center;margin-top: 50px;">'.
						'<strong style="color:red;font-size:25px;margin-bottom:20px;display:block;">Le fichier n\'existe plus dans le serveur.</strong><br/>'.
						'<a href="https://www.selfizee.fr">Voir le site</a><br/>'.
						'<a href="https://www.selfizee.fr"><img src="/img/images/selfizee.png" style="margin-top: 15px;"></a>'.
					'</div>';
					exit;
				}
			}
		}
	}
	
    public function downloadLienEncrypteOld($parametre){
		$continue = false;
		if(trim($parametre)){
			$params = unserialize($this -> utilities -> slDecryption($parametre));
			if($params){
				// Vérification expiration
				if(!empty($params['time'])){
					$date_mail = $params['time'];
					$now = time();
					// Intervale de 7 jours
					$intervalle = 7 * 24 * 60 * 60;
					if($now - $date_mail >= $intervalle){
						echo ''.
						'<div style="width: 100%;text-align:center;margin-top: 50px;">
							<strong style="color:red;font-size:25px;margin-bottom:20px;display:block;">Désolé, ce lien de téléchargement est déjà expiré.</strong><br/>'.
							'<a href="https://www.selfizee.fr">Voir le site</a><br/>'.
							'<a href="https://www.selfizee.fr"><img src="/img/images/selfizee.png" style="margin-top: 15px;"></a>'.
						'</div>';
						exit;
					}
				}else{
					echo '<div style="width: 100%;text-align:center;margin-top: 50px;">
						<strong style="color:red;font-size:25px;margin-bottom:20px;display:block;">Une erreur est survenue.</strong><br/>'.
						'<a href="https://www.selfizee.fr">Voir le site</a><br/>'.
						'<a href="https://www.selfizee.fr"><img src="/img/images/selfizee.png" style="margin-top: 15px;"></a>'.
					'</div>';
					exit;
				}
				
				if(!empty($params['idGalerie']) && $params['idGalerie'] > 0){
					$id = $params['idGalerie'];
					$source = $params['source'] ? $params['source'] : 2;
					$queue = $params['queue'] ? $params['queue'] : time();
					$continue = true;
				}else{
					echo '<div style="width: 100%;text-align:center;margin-top: 50px;">
						<strong style="color:red;font-size:25px;margin-bottom:20px;display:block;">Une erreur est survenue.</strong><br/>'.
						'<a href="https://www.selfizee.fr">Voir le site</a><br/>'.
						'<a href="https://www.selfizee.fr"><img src="/img/images/selfizee.png" style="margin-top: 15px;"></a>'.
					'</div>';
					exit;
				}
				
			}
		}
        
		if($continue){
			$this->viewBuilder()->setLayout('galerie-souvenir');
			$galery = $this->Galeries->get($id, [
				'contain' => ['Evenements']
			]);
		   
			$evenements = $galery->evenements;
			$collection = new Collection($evenements);
			$listeIdEvenement = $collection->extract('id');
			$listeIdEvenement = $listeIdEvenement->toList();
			
			$outZipPath =  WWW_ROOT."import".DS."download".DS.$galery->slug.'.zip';
			
			if(!file_exists($outZipPath)){
				echo '<div style="width: 100%;text-align:center;margin-top: 50px;">'.
					'<strong style="color:red;font-size:25px;margin-bottom:20px;display:block;">Le fichier n\'existe plus dans le serveur.</strong><br/>'.
					'<a href="https://www.selfizee.fr">Voir le site</a><br/>'.
					'<a href="https://www.selfizee.fr"><img src="/img/images/selfizee.png" style="margin-top: 15px;"></a>'.
				'</div>';
				exit;
				// $photos = $this->Galeries->Evenements->Photos->find()
											// ->where(['evenement_id IN' => $listeIdEvenement,'is_in_corbeille' => false,'deleted' => false]);
				// $zipFile = new ZipArchive();
				// $zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
				// foreach($photos as $photo){
					// $filePath = $photo->uri_photo;
					// $fileName = pathinfo($filePath,  PATHINFO_BASENAME );
					// $zipFile->addFile($filePath, $fileName);
				// }
				// $zipFile->close();
			}
			
			$response = $this->response->withFile(
				$outZipPath,
				['download' => true, 'name' => $galery->slug.'.zip']
			);
			
			foreach($listeIdEvenement as $idEvt){
				$data['user_id'] = $this->Auth->user('id');
				$data['galerie_id'] = $id;
				$data['source_download'] = $source;
				$data['ip'] = $this->request->clientIp();
				$data['queue'] = $queue;
				$data['evenement_id'] = $idEvt;
				$download = $this->Galeries->GalerieDownloads->newEntity($data);
				$this->Galeries->GalerieDownloads->save($download);
			}

			$this->loadModel('InfosDownloadsGalerieSouvenirs');
			$infosDownload = $this->InfosDownloadsGalerieSouvenirs->newEntity();
			$infosDownload->nom = $this->request->getQuery('nom');
			$infosDownload->prenom = $this->request->getQuery('prenom');
			$infosDownload->email = $this->request->getQuery('email');
			$infosDownload->galerie_id = $this->request->getQuery('galerie_id');
			$this->InfosDownloadsGalerieSouvenirs->save($infosDownload);

			return $response;
        }else{
			echo '<div style="width: 100%;text-align:center;margin-top: 50px;">
				<strong style="color:red;font-size:25px;margin-bottom:20px;display:block;">Une erreur est survenue.</strong><br/>'.
				'<a href="https://www.selfizee.fr">Voir le site</a><br/>'.
				'<a href="https://www.selfizee.fr"><img src="/img/images/selfizee.png" style="margin-top: 15px;"></a>'.
			'</div>';
		}
        exit;
    }
	
    public function download($id = null, $source = 2 , $queue = null){

        if(empty($queue)){
            $queue = time();
        }
        
        $this->viewBuilder()->setLayout('galerie-souvenir');
        $galery = $this->Galeries->get($id, [
            'contain' => ['Evenements']
        ]);
       
        $evenements = $galery->evenements;
        $collection = new Collection($evenements);
        $listeIdEvenement = $collection->extract('id');
        $listeIdEvenement = $listeIdEvenement->toList();
        
         //debug($listeIdEvenement); die;
        
        $photos = $this->Galeries->Evenements->Photos->find()
                                    ->where(['evenement_id IN' => $listeIdEvenement,'is_in_corbeille' => false,'deleted' => false]);

        $newdir = WWW_ROOT."import".DS."download";
        new Folder($newdir, true, 0777);
        $outZipPath =  $newdir.DS.$galery->slug.'.zip';

        
		// Si le fichier existe déjà on telecharger directement sinon on le crée.
		if(!file_exists($outZipPath)){
			$zipFile = new ZipArchive();
			$zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
			foreach($photos as $photo){
				$filePath = $photo->uri_photo;
				$fileName = pathinfo($filePath,  PATHINFO_BASENAME );
				$zipFile->addFile($filePath, $fileName);
			}
			$zipFile->close();
        }
		
        $response = $this->response->withFile(
            $outZipPath,
            ['download' => true, 'name' => $galery->slug.'.zip']
        );
        
        foreach($listeIdEvenement as $idEvt){
            $data['user_id'] = $this->Auth->user('id');
            $data['galerie_id'] = $id;
            $data['source_download'] = $source;
            $data['ip'] = $this->request->clientIp();
            $data['queue'] = $queue;
            $data['evenement_id'] = $idEvt;
            $download = $this->Galeries->GalerieDownloads->newEntity($data);
            $this->Galeries->GalerieDownloads->save($download);
        }

        $this->loadModel('InfosDownloadsGalerieSouvenirs');
        $infosDownload = $this->InfosDownloadsGalerieSouvenirs->newEntity();
        $infosDownload->nom = $this->request->getQuery('nom');
        $infosDownload->prenom = $this->request->getQuery('prenom');
        $infosDownload->email = $this->request->getQuery('email');
        $infosDownload->galerie_id = $this->request->getQuery('galerie_id');
        $this->InfosDownloadsGalerieSouvenirs->save($infosDownload);

        return $response;
        
        
    }
    
    public function diapo($idEncode, $idPhoto = null){
        $this->viewBuilder()->setLayout('diapo');
        
        $id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT)); 
        
        $galery = $this->Galeries->get($id, [
            'contain' => ['Evenements'=>['RsConfigurations']]
        ]);
        $evenements = $galery->evenements;
        $collection = new Collection($evenements);
        $listeIdEvenement = $collection->extract('id');
        $listeIdEvenement = $listeIdEvenement->toList();
        
        $optionsFiltre['listeIdEvenement'] = $listeIdEvenement;
        $optionsFiltre['key'] = "";
        $optionsFiltre['dateOrder'] = "";
        
   
        
        $this->loadModel('Photos');
        $this->paginate = [
            'limit' => 40,
            'finder' => [
                'souvenir' => $optionsFiltre
            ]
        ];
        
        $photos = $this->paginate($this->Photos);
        $this->set(compact('photos','galery'));
    }
    
    
    public function shareMail(){
        $this->autoRender=false;
        $email = new Email();

        $email->viewVars(['content' => $this->request->data["content"],
            "sharelink"=>$this->request->data['img_share'],"img"=>$this->request->data["img"]])
            ->template('share_image')
            ->emailFormat('html')
            ->from(["contact@selfizee.fr" => "SELFIZEE"])
            ->to($this->request->data['email'])
            ->subject('Partage photo');
        if($email->send()){
            die(json_encode(["success"=>true]));
        }
        die(json_encode(["success"=>false]));
    }

	public function post(){
		$slug = $this->request->getParam('slug');
		$idEvenement = $this->request->getParam('id_event');
		//debug($this->request);die;
		$this->loadModel('EvenementPosts');
		$post = $this->EvenementPosts->find('all')
											->where(['EvenementPosts.slug' => $slug])                                        
                                            ->where(['EvenementPosts.evenement_id' => $idEvenement])
											->first();
											
		if(!$post){
			$this->viewBuilder()->setLayout('page_introuvable');
		} else {
			$banniere_title = $post->titre;
			$contenu = $post->contenus;
            $this->viewBuilder()->setLayout('page-specifique');
			$this->set(compact('contenu','banniere_title'));
		}	
	}
    
    /**
     * WS Get Galerie event 
     *
     */

    public function getGalerie($id){
        $this->viewBuilder()->setLayout('ajax');
        //debug($this->request);die;
        $res[] = null;
        //$id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT)); 
        
        $galery = $this->Galeries->get($id, [
            'contain' => ['Evenements'=>['RsConfigurations']]
        ]);
        $evenements = $galery->evenements;
        $collection = new Collection($evenements);
        $listeIdEvenement = $collection->extract('id');
        $listeIdEvenement = $listeIdEvenement->toList();
        
        $rsConfiguration = $evenements[0]->rs_configuration;        
        $optionsFiltre['listeIdEvenement'] = $listeIdEvenement;
        $optionsFiltre['key'] = "";
        $optionsFiltre['dateOrder'] = "";
        $optionsFiltre['sourceGal'] = "";
        $optionsFiltre['visiteur'] = "";
        
        $this->loadModel('Photos');
        $this->paginate = [
            'limit' => 40,
            'finder' => [
                'souvenir' => $optionsFiltre
            ],
            'conditions' =>['Photos.deleted' => false, 'Photos.is_in_corbeille'=> false],//,'Photos.is_optin_galerie' => true
            'order'=>['created' => 'DESC']
        ];
        $queue = time();
        
        $photos = $this->paginate($this->Photos);
        $this->set(compact('photos'));
    }   
  

}
