<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Console\ShellDispatcher;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Date;
use Cake\Utility\Text;
use Cake\Core\Configure;
use ZipArchive;
use Cake\I18n\Time;
use Base64Url\Base64Url;
use Cake\Mailer\Email;

/**
 * Photos Controller
 *
 * @property \App\Model\Table\PhotosTable $Photos
 *
 * @method \App\Model\Entity\Photo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhotosController extends AppController
{
    
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['liste','add','deleteAll','viderCorbeille','restaurerCorbeille','import','uploadPhoto','downloadByEvenement'])) {
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
      

        if($user['role_id'] == 5 || $user['role_id'] == 7){
            if(in_array($action, ['liste']) && $user['is_active_acces_affichage_photo'] == true ){ 
                return true;
            }

            if(in_array($action, ['add','deleteAll','viderCorbeille','restaurerCorbeille','import','uploadPhoto','downloadByEvenement'])
                 && $user['is_active_acces_event'] == true && $user['is_active_acces_edit_photo'] == true) {
                return true;
            }
        }
        
        if(in_array($action,['delete','restaurer','corbeille','download','show','get','deleteSelected', 'updateDateHeurePrise','corbeilleAjax','valider', 'refuser'])){
            return true;
        }
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    

	// Ajax pour création du zip de l'album photo
	public function ajaxGenerationZip(){
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
			$idEvenement = $this -> request -> getData('idEvenement');
			$link = $this -> utilities -> slEncryption(serialize(['time' => time(), 'email' => $destinateurs, 'idEvenement' => $idEvenement]));
			$contenu = '';
			
			if($destinateurs && filter_var($destinateurs, FILTER_VALIDATE_EMAIL)){
				// Génération du zip
				$shell = new ShellDispatcher();
				$output = $shell->run(['cake', 'photo', 'generateZip', $idEvenement]);
				if (0 === $output) {
					$front_domaine = Configure::read('url_front_domaine');
					$evenement = $this->Photos->Evenements->get($idEvenement,['contain'=>[]]);
					$nom_event = !empty($evenement) ? $evenement->nom : '';
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
													'<a href="'.$front_domaine.'e/download/'.$link.'" style="display:block;padding:15px 40px;background-color:#eb2162;color:#FFF;width:160px;margin:auto;margin-top:45px;margin-bottom:45px;text-decoration:none;border-radius:5px">&nbsp;Télécharger&nbsp;</a>'.
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
    
    public function liste($idEvenement){   
        
        $evenement = $this->Photos->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
       
        $visiteur = $this->request->getQuery('visiteur');
        $sourceGal = $this->request->getQuery('sourceGal');
        $filtre = $this->request->getQuery('filtre');
        $corbeille = $this->request->getQuery('corbeille');
        $queue = $this->request->getQuery('queue');
        $is_validate = $this->request->getQuery('is_validate');
        $periode = $this->request->getQuery('periode');

        $options['sourceGal'] = $sourceGal;
        $options['visiteur'] = $visiteur;
        $options['idEvenement'] = $idEvenement;
        $options['corbeille'] = $corbeille;
        $options['is_validate'] = $is_validate;
        $options['periode'] = $periode;
        //debug($options);

        $this->paginate = [
            'limit' => 100,
            'contain' => ['Evenements'],
            'finder' => [
                'filtre' => $options
            ],
            'order' => ['date_prise_photo' => 'asc','heure_prise_photo' => 'asc'],

        ];
        $photos = $this->paginate($this->Photos);


        $countAllPhotoOfEvenement = $this->Photos->find('all')
                                                    ->where([
                                                        'Photos.evenement_id' => $idEvenement,
                                                        'Photos.type_media' => 'photo'])
                                                    ->count();
        $countAllVideoOfEvenement = $this->Photos->find('all')
                                                    ->where([
                                                        'Photos.evenement_id' => $idEvenement,
                                                        'Photos.type_media' => 'video'])
                                                    ->count();
        $countPhotoNonValider = $this->Photos->find()
                                            ->where(['Photos.is_validate' => false,'Photos.evenement_id' => $idEvenement])
                                            ->count();

        $countPhotoInCorbeille = $this->Photos->find()
                                            ->where(['Photos.is_in_corbeille' => true,'Photos.evenement_id' => $idEvenement])
                                            ->count();
       
        $this->loadModel('Visiteurs');
        $visiteurs = $this->Visiteurs->find('list',['valueField' => 'full_name'])
                                ->where(['Visiteurs.evenement_id' => $idEvenement])
                                ->group(['Visiteurs.email']);
                                
        $this->set(compact('photos','date_debut','date_fin','idEvenement','evenement','queue','countAllPhotoOfEvenement',"visiteurs",'visiteur','sourceGal',"countPhotoNonValider",'countAllVideoOfEvenement','filtre','countPhotoInCorbeille','periode'));

        if(!empty($corbeille)){
            $this->render('corbeille');
        }else if($is_validate == "0"){
            $this->render('avalider');
        }
    }



    /**
     * View method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function show($token)
    {      
        $this->viewBuilder()->setLayout('page-souvenir');
        $photo = $this->Photos->find()
                        ->contain(['Evenements'=>['RsConfigurations','PageSouvenirs','Galeries']])
                        ->where(['token' => $token])
                        ->first();
                        //debug($photo);die;
        //($photo->evenement->page_souvenir->lien_extern);die;

        if(!empty($photo)){
            $dataVue['photo_id'] = $photo->id;
            $dataVue['ip_viewer'] = $this->request->clientIp();
            $photoVue = $this->Photos->PhotoVues->newEntity($dataVue);
            //$this->Photos->PhotoVues->save($photoVue);

            $is_required = 0;
            $couleur_download_link = "#000";
            $is_actif = "#";

            $this->loadModel('Evenements');
            $this->loadModel('DownloadConfigurations');
            $this->loadModel('PageSouvenirs');
            $evenement = $this->Evenements->get($photo->evenement_id);
            $pageSouvenir = $this->PageSouvenirs->find('all',
                ['contain'=>['Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins']]
                ])->where(['evenement_id'=>$photo->evenement_id])->first();
            //$downloadConfigurationFind = $this->DownloadConfigurations->find()->where(['evenement_id'=>$photo->evenement_id])->first();
            /*if($downloadConfigurationFind){
                $is_required = $downloadConfigurationFind->is_oblig_ajout_infos_av_down;
            }*/
            //debug($pageSouvenir->champs);die;
            if($pageSouvenir){
                $is_required = $pageSouvenir->is_active_form_down;
                $couleur_download_link = $pageSouvenir->couleur_download_link;
                $is_actif = $photo->evenement->page_souvenir->lien_extern;
            }
            // Pour la stat de clique 
            $idContactCrypted = $this->request->getQuery('c'); // Get contact id crypted
            if(!empty($idContactCrypted)){
                $idContact = Base64Url::decode($idContactCrypted);
                $this->loadModel('Envois');
                $envoiSmsDeCeContact = $this->Envois->find()
                                                        ->where(['Envois.contact_id' => $idContact,'Envois.envoi_type' => 'sms'])
                                                        ->first();
                if(!empty($envoiSmsDeCeContact)){
                    $smsStat['envoi_id'] = $envoiSmsDeCeContact->id;
                    $smsStat['statut']  = 3; // click
					$connection = ConnectionManager::get('default');
					$liste_tables = $connection->getSchemaCollection()->listTables();
					
					if(!empty($idEnvoiSms) && (in_array('sms_stats', $liste_tables) || in_array('sms_statistiques', $liste_tables))){
						$smsStatistique = $this->Envois->SmsStatistiques->newEntity($smsStat);
						$this->Envois->SmsStatistiques->save($smsStatistique);
					}
                }
            }

            $this->set('photo', $photo);
            $this->set('pageSouvenir', $pageSouvenir);
            $this->set('couleur_download_link', $couleur_download_link);
            $this->set('is_actif', $is_actif);
            //$this->set('downloadConfiguration', $downloadConfigurationFind);
            $this->set('is_required', $is_required);
        }else{
            //Photo non trouvée
            $this->redirect('/');
        }
        //$this->set('photo', $photo);                 
    }
    
    public function testPageSouvenir($idEvenement){
        $this->viewBuilder()->setLayout('test-page-souvenir');
        $evenement = $this->Photos->Evenements->get($idEvenement,['contain' =>['RsConfigurations','PageSouvenirs','Galeries']]);
        // $urlPhotoTest  = Configure::read('url_front_domaine').'img/test.jpg';
        $urlPhotoTest  = '/img/test.jpg';
        $this->set(compact('evenement','urlPhotoTest'));
    }
    
   

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement)
    {
        //$evenement = $this->Photos->Evenements->get($idEvenement,);
        $evenement = $this->Photos->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $this->set(compact('evenement','idEvenement'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
//    public function edit($id = null)
//    {
//        $photo = $this->Photos->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
//            if ($this->Photos->save($photo)) {
//                $this->Flash->success(__('The photo has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The photo could not be saved. Please, try again.'));
//        }
//        $evenements = $this->Photos->Evenements->find('list', ['limit' => 200]);
//        $this->set(compact('photo', 'evenements'));
//    }


    public function valider($id){
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        $photo->is_validate = true;
        if ($this->Photos->save($photo)) {
            $this->Flash->success(__('La photo est validée'));
        } else {
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer.'));
        }

        return $this->redirect(['action' => 'liste',$photo->evenement_id,'?'=>['is_validate'=>0]]);
    }
    
    
    public function refuser($id){
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        $photo->is_validate = false;
        $photo->deleted = true;
        if ($this->Photos->save($photo)) {
            $this->Flash->success(__('La photo a été refusée.'));
        } else {
            $this->Flash->error(__('The photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste',$photo->evenement_id,'?'=>['is_validate'=>0]]);
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        $photo->deleted = true;
        if ($this->Photos->save($photo)) {
            $this->Flash->success(__('La photo a été supprimée.'));
        } else {
            $this->Flash->error(__('The photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste',$photo->evenement_id]);
    }

    //Supprimer WS
    public function supprimer()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $res['sucess'] = false;
        if ($this->request->is(['post', 'delete'])) {
            $id = $this->request->getDat('id');
            if(!empty($id)){
                $photo = $this->Photos->get($id);
                $photo->deleted = true;
                if ($this->Photos->save($photo)) {
                    $res['message'] = 'La photo a été supprimée.';
                    $res['sucess'] = true;

                } else {
                    $res['message'] = 'Une erreur est survenue. Veuillez réessayer';
                    $res['sucess'] = true;
                }
            }else{
                $res['sucess'] = false;
                $res['message'] = 'Id to delete required';
            }
        }
        echo json_encode($res);
    }

    public function deletePhotosSelected($idEvenement){
        //$this->request->allowMethod(['post', 'delete']);
        $selected = $this->request->getQuery('list');
        $selected = array_unique($selected);
        $selected = array_filter($selected);
        $selected = array_values($selected);
        //debug($selected);die;      
        
        if(!empty($selected)){
            if($this->Photos->deleteAll(['id IN' => $selected])){
                $this->Flash->success(__('Les médias séléctionnés ont été supprimés.'));
                return $this->redirect(['action' => 'liste', $idEvenement]);
            }else{
                $this->Flash->error(__('Les médias séléctionnés n\'ont pas été supprimés. Veuillez réessayer.'));
            }
        }        
    }
    
    public function restaurer($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        $photo->is_in_corbeille = false;
        if ($this->Photos->save($photo)) {
            $this->Flash->success(__('Photo restaurée.'));
        } else {
            $this->Flash->error(__('Please, try again.'));
        }

        return $this->redirect(['action' => 'liste',$photo->evenement_id]);
    }
    
    public function  corbeilleAll($idEvenement, $queue = null){
        $this->request->allowMethod(['post', 'delete']);
        $queue = time();
         
        $this->Photos->updateAll(
            [  // fields
				'user_id' => $this->Auth->user('id'),
                'is_in_corbeille' => true,
                'queue_crobeille' => $queue,
                'date_corbeille' => Time::now()
            ],
            [  // conditions
                'evenement_id' => $idEvenement
            ]
        );
        
        $this->Flash->success(__('Toute est supprimée.'));

        return $this->redirect(['action' => 'liste',$idEvenement]);
    }
    
    public function deleteAll($idEvenement){
        
        $this->request->allowMethod(['post', 'delete']);
        $queue = time();
         
        $this->Photos->updateAll(
            [  // fields
                'deleted' => true,
                //'queue_deleted' => $queue
            ],
            [  // conditions
                'evenement_id' => $idEvenement
            ]
        );
        
        $this->Flash->success(__('Toute est supprimée.'));

        return $this->redirect(['action' => 'liste',$idEvenement]);
    }
    
    
    public function viderCorbeille($idEvenement = null)
    {
        $this->request->allowMethod(['post', 'delete']);
               
        $this->Photos->updateAll(
            [  // fields
                'deleted' => true,
            ],
            [  // conditions
                'is_in_corbeille' => true
            ]
        );
        $this->Flash->success(__('La corbeille est vidée.'));

        return $this->redirect(['action' => 'liste',$idEvenement]);
    }
    
    
    
    public function restaurerCorbeille($idEvenement = null)
    {
        $this->request->allowMethod(['post', 'delete']);
               
        $this->Photos->updateAll(
            [  // fields
                'is_in_corbeille' => false,
            ],
            [  // conditions
                'is_in_corbeille' => true
            ]
        );
        $this->Flash->success(__('Toutes les photos sont restaurées.'));

        return $this->redirect(['action' => 'liste',$idEvenement]);
    }
    
    public function corbeille($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        $photo->is_in_corbeille = true;
        if ($this->Photos->save($photo)) {
            $this->Flash->success(__('The photo has been deleted.'));
        } else {
            $this->Flash->error(__('The photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste',$photo->evenement_id]);
    }
    
    public function envoi($idEvenement, $sentEmail  = false,  $sentSms= false, $forceEnvoi = false){
        $shell = new ShellDispatcher();
		$user_id = $this->Auth->user('id');
        $output = $shell->run(['cake', 'photo', 'sendEmailAndSmsEvenement', $idEvenement, $sentEmail , $sentSms, $forceEnvoi, 'bo', $user_id]);
 
        if (0 === $output) {
            if($sentEmail && $sentSms){
                $this->Flash->success('E-mail & SMS envoyé');
            }else if($sentEmail){
                $this->Flash->success('E-mail  envoyé');
            }else if($sentSms){
                $this->Flash->success('SMS envoyé');
            }
            
        } else {
            $this->Flash->error('Une erreur est survenue.');
        }
        $this->redirect(['controller'=>'crons','action'=>'manuel', $idEvenement]);
    }
    
    public function importPhoto($idEvenement){
        $evenement = $this->Photos->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $shell = new ShellDispatcher();
        $output = $shell->run(['cake', 'photo', 'importPhoto', $idEvenement]);
 
        if (0 === $output) {
            $this->Flash->success('Photos importées');
        } else {
            $this->Flash->error('Une erreur est survenue.');
        }
        $this->redirect(['controller'=>'Photos','action'=>'liste', $idEvenement]);
    }

    public function testHeurePrise(){
        date_default_timezone_set('Europe/Paris');
        $date = new \DateTime();
        //$date->setTimestamp(intval("28363.jpg"));
        $date->setTimestamp(intval("30396.jpg"));
        $heure = $date->format('H:i:s');
        //debug($heure);die;
    }

    public function checkHeurePrise(){
        date_default_timezone_set('Europe/Paris');
        $date = new \DateTime();

        $name_origne = "1491-2019-1-29-67234.jpg";//$photo->name_origne;
        $name_origne = "2019-1-29-67234.jpg";
        $name_origne = "2019-4-25-43541.jpg";
            $name_array = explode('-', $name_origne);
            $nbr = count($name_array);
            //debug($name_array);die;

            if($name_array[0] == "1491" && count($name_array) == 5) {
                //debug($photo);die;
                $date->setTimestamp(intval($name_array[4]));
                $heure = $date->format('H:i:s');
                debug($heure);die;
                $photo->date_prise_photo = date($name_array[1] . "-" . $name_array[2] . "-" . $name_array[3]);
                $photo->heure_prise_photo = $heure;
                if ($this->Photos->save($photo)) {
                    $this->out('Ok avec id event => '.$photo->id);
                }
            }else if($name_array[0] == date('Y') && count($name_array) == 4){
                $date->setTimestamp(intval($name_array[3]));
                $heure = $date->format('H:i:s');
                debug($heure);die;
                $photo->date_prise_photo = date($name_array[0] . "-" . $name_array[1] . "-" . $name_array[2]);
                $photo->heure_prise_photo = $heure;
                if ($this->Photos->save($photo)) {
                    $this->out('Ok => '.$photo->id);
                }
            }
    }
    
//    public function import($idEvenement, $forceEnvoi = false){
//        $evenement = $this->Photos->Evenements->get($idEvenement);
//        $destintionPath = WWW_ROOT."import".DS."galleries".DS. $evenement->id.DS;
//        
//        $this->loadModel('CsvColonnePositions');
//        $positionChampFacebook = $this->CsvColonnePositions->find()
//                                                            ->where(['evenement_id'=>$evenement->id,'csv_colonne_id'=>1])
//                                                            ->first();
//        
//        //$source = SOURCE_ROOT.DS.$evenement->id.DS;
//         $source = Configure::read('source_photo').$evenement->id.DS;
//         
//        $cheminDuCsv = $source.'data.csv';
//        //debug($cheminDuCsv);die;
//        if(file_exists($cheminDuCsv)){
//            $csv = array_map('str_getcsv', file($cheminDuCsv));
//            array_shift($csv);
//            //debug($csv);die;
//            $datas = array();
//            foreach($csv as $numLigne => $ligne){
//               //debug($numLigne);
//                $photo = array();
//                $photo['evenement_id'] = $evenement->id;
//                $photo['date_prise_photo'] = trim($ligne[0]);
//                $photo['heure_prise_photo'] = trim($ligne[1]);
//                $photo['name_origne'] = null;
//                $photo['name'] = null;
//                $photo['is_postable_on_facebook'] = false;
//                $photo['contacts'] = array();
//                $positionDeLemail = 0; // Pour l'optin
//                foreach($ligne as $position => $colonne){
//                   
//                    $colonne = trim($colonne);
//                    
//                    //Prendre l' email dans la ligne
//                    if(filter_var($colonne, FILTER_VALIDATE_EMAIL)){
//                        $photo['contacts'][0]['email'] = $colonne;
//                        $positionDeLemail = $position;
//                    }
//                    
//                    //Prendre le téléphone 
//                    if(preg_match("/^[0-9]{10}$/", $colonne)){
//                        $photo['contacts'][0]['tel'] = $colonne;
//                    }
//                    
//                    //Prendre le nom de l'image
//                    if(strpos($colonne, "c:\\") !== false){
//                        $cheminPhotoInCSv = $colonne;
//                        //$nomPhoto = pathinfo($cheminPhotoInCSv,  PATHINFO_BASENAME);
//                        //$nomPhoto = basename($cheminPhotoInCSv);
//                        $cheminExpoded = explode('\\',$cheminPhotoInCSv);
//                        $nomPhoto = end($cheminExpoded);
//                        $nomPhoto = trim($nomPhoto);
//                        
//                        /**
//                         * Si via Batch ou Via FTP
//                         * */
//                         
//                        if(file_exists($source.$nomPhoto)){ // Via ftp
//                            $photo['name_origne'] =  $nomPhoto;
//                            $photo['name'] = $nomPhoto;
//                        }else if(file_exists($source."Default_".$nomPhoto)){ // Via BATCH
//                            $photo['name_origne'] =  "Default_".$nomPhoto;
//                            $photo['name'] =  "Default_".$nomPhoto;
//                        }else if(file_exists($source."Default-".$nomPhoto)){
//                            $photo['name_origne'] =  "Default-".$nomPhoto;
//                            $photo['name'] =  "Default-".$nomPhoto;
//                        }
//                        $photo['name_in_csv'] = $nomPhoto;
//                    }
//                    
//                    //Option : postable sur FB : is_postable_on_facebook
//                    
//                    if(!empty($positionChampFacebook)){
//                        $postionFbauto = $positionChampFacebook->position;
//                        $realPostionDeLOption =  $positionDeLemail  + ($postionFbauto-1);
//                        if(isset($ligne[$realPostionDeLOption])){
//                            $valueFbauto = $ligne[$realPostionDeLOption];
//                            if(!empty($valueFbauto)){
//                                if($valueFbauto == '"Yes"' || $valueFbauto == 'Yes' ){
//                                      $photo['is_postable_on_facebook'] =  true;
//                                }
//                            }
//                        }
//                    }
//                    
//                }
//               
//                //debug($photo); die;
//                
//                if(!empty($photo['name_origne'])){
//                    
//                    /**
//                     * On vérifie si l'import de la photo est déjà faite'
//                     * */
//                     $isExiste = $this->Photos->find()->where([ 'name_origne'=> $photo['name_origne'], 
//                                                                'date_prise_photo'=>$photo['date_prise_photo'],
//                                                                'heure_prise_photo' => $photo['heure_prise_photo'],
//                                                                'evenement_id' => $evenement->id
//                                                                ])->first();
//                     
//                     if(!$isExiste){
//                        /**
//                        *  si la photo est copié en l'ajout dans le tableau photos pour être insérer 
//                        * en une seule transation
//                        * **/
//                        $cheminSourcePhoto = $source.$photo['name_origne'];
//                        //debug($cheminSourcePhoto);die;
//                        $destintionPathFile = $destintionPath.$photo['name_origne'];
//                        if (copy($cheminSourcePhoto, $destintionPathFile)) {
//                            /**
//                             * Enregister les photos
//                             * */
//                            $entity = $this->Photos->newEntity($photo,['associated'=>['Contacts']]);
//                            if($this->Photos->save($entity)){
//                                array_push($datas, $photo);
//                            }
//                            
//                        }
//                     }
//                }
//                
//                
//                
//            }
//            
//            if(count($datas)){
//                
//                $this->Flash->success(__('Import réussi : '.count($datas).' Photo(s)' ));
//            }else{
//                $this->Flash->error(__('Toutes les photos du CSV sont importées'));
//            }
//            
//            if($forceEnvoi){
//                    $shell = new ShellDispatcher();
//                    $output = $shell->run(['cake', 'photo', 'sendEmailAndSmsEvenement', $idEvenement, true, true, true]);
//             
//                    if (0 === $output) {
//                        $this->Flash->success('E-mail reenvoyé');
//                    } else {
//                        $this->Flash->error('E-mail non envoyé.');
//                    }
//            }
//          
//        }else{
//            //debug($source);die;
//            $this->Flash->error(__('Le Fichier CSV n\'est pas trouvé.'));
//        }
//        $this->redirect(['controller'=>'crons','action'=>'add', $evenement->id]);
//    }

    /*public function find($id){
        //$this->viewBuilder()->setLayout('ajax');
        $photo = $this->Photos->get($id,['contain'=>['Contacts']]);
        debug($photo);die;
        $this->set(compact('photo'));
    }*/

    public function get($id){
        //$this->viewBuilder()->setLayout('ajax');
        $photo = $this->Photos->get($id,['contain'=>['Contacts','PhotoDownloads', 'Evenements'=>['Clients']]]);
        $this->set(compact('photo'));
    }
    
   
    
    public function download($id, $source = null, $queue = null){
        $photo = $this->Photos->get($id);
        if(empty($queue)){
            $queue = time();
        }
        
        $response = $this->response->withFile(
            $photo->uri_photo,
            ['download' => true, 'name' => $photo->name]
        );
        
        if($source){
			$data['user_id'] = $this->Auth->user('id');
            $data['photo_id'] = $id;
            $data['source_download'] = $source;
            $data['ip'] = $this->request->clientIp();
            $data['queue'] = $queue;
            $download = $this->Photos->PhotoDownloads->newEntity($data);
            $da = $this->Photos->PhotoDownloads->save($download);
        }

        //=== Save form modal in Donwload page souv 
            /*$this->loadModel('InfosDownloadsPageSouvenirs');
            $infosDownload = $this->InfosDownloadsPageSouvenirs->newEntity();
            $infosDownload->nom = $this->request->getQuery('nom');
            $infosDownload->prenom = $this->request->getQuery('prenom');
            $infosDownload->telephone = $this->request->getQuery('telephone');
            $infosDownload->email = $this->request->getQuery('email');
            $infosDownload->optin = $this->request->getQuery('optin');
            $infosDownload->photo_id = $this->request->getQuery('photo_id');
            $infosDownload->evenement_id = $this->request->getQuery('evenement_id');
            $this->InfosDownloadsPageSouvenirs->save($infosDownload);*/

        return $response;
    }

    public function downloadFromModalPageSouvenir($id){
        $photo = $this->Photos->get($id);
        if(empty($queue)){
            $queue = time();
        }
        
        $response = $this->response->withFile(
            $photo->uri_photo,
            ['download' => true, 'name' => $photo->name]
        );
        
        //=== Save form modal in Donwload page souv 
            $this->loadModel('InfosDownloadsPageSouvenirs');
            $infosDownload = $this->InfosDownloadsPageSouvenirs->newEntity();
            $infosDownload->nom = $this->request->getQuery('nom');
            $infosDownload->prenom = $this->request->getQuery('prenom');
            $infosDownload->telephone = $this->request->getQuery('telephone');
            $infosDownload->email = $this->request->getQuery('email');
            $infosDownload->optin = $this->request->getQuery('optin');
            $infosDownload->photo_id = $this->request->getQuery('photo_id');
            $infosDownload->evenement_id = $this->request->getQuery('evenement_id');
            $this->InfosDownloadsPageSouvenirs->save($infosDownload);
        

        return $response;
    }
    
    public function downloadByEvenement($idEvenment){
        
        $date = $this->request->getSession()->read('dates');
        $photos = $this->Photos->find()->where(['evenement_id'=>$idEvenment,'is_in_corbeille' => false,'deleted' => false, "Photos.date_prise_photo >=" => isset($date['date_debut']) ? $date['date_debut'] :null, "Photos.date_prise_photo <=" =>  isset($date['date_fin']) ? $date['date_fin'] :null]);
       
        $evenement = $this->Photos->Evenements->get($idEvenment,['contain'=>['Galeries']]);
        
         $newdir = WWW_ROOT."import".DS."download";
         new Folder($newdir, true, 0777);
        $outZipPath =  $newdir.DS.$evenement->slug.'.zip';
        
        $zipFile = new ZipArchive();
        $zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
        foreach($photos as $photo){
            $filePath = $photo->uri_photo;
            $fileName = pathinfo($filePath,  PATHINFO_BASENAME );
            $zipFile->addFile($filePath, $fileName);
        }
   
        $zipFile->close();
        
        $response = $this->response->withFile(
            $outZipPath,
            ['download' => true, 'name' => $evenement->slug.'.zip']
        );
        $this->request->getSession()->delete('dates');
        return $response;
    }
    
 
	/*
	 * @Paul
	 * Projet : https://trello.com/c/l6H6mZ3K/573-g%C3%A9n%C3%A9ration-url-des-photos-zipper
	 * Description : Génération zip + envoi mail pour téléchargement albums photos d'un event
	 * 06/08/19
	 *
	 */
	public function downloadByEvenementZip($parametre = ''){
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
				
				if(!empty($params['idEvenement'])){
					$this -> loadModel('Evenements');
					$idEvenement = $params['idEvenement'];
					$evenement = $this -> Evenements -> find()
					->where(['id' => $idEvenement])
					->contain([])
					->first();
					if(!empty($evenement)){
						$outZipPath =  WWW_ROOT."import".DS."download".DS.$evenement->slug.'.zip';
						
						$response = $this->response->withFile(
							$outZipPath,
							['download' => true, 'name' => $evenement->slug.'.zip']
						);
						return $response;
					}
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
		exit;
	}
	
    public function uploadPhoto($idEvenement, $queue)
    {   
        
        //ini_set('max_execution_time', '999');

        $this->autoRender = false; // We don't render a view
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            //$destination = UPLOAD_TMP . DS . $idEvenement;
            $destination = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
            $dir         = new Folder($destination, true, 0755);
           
            $video_files = ['mp4','MP4', 'flv', 'FLV', 'avi', 'AVI', 'mpg', 'MPG'];
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;
                //debug($extension);die;

                ini_set('memory_limit', '1128M');
                ini_set('upload_max_filesize', '900M');
                ini_set('post_max_size ', '1024M');
                if(!strpos($file, "x2")){
                    if(move_uploaded_file($tmp, $destination_path)){
                        
                        $photo = array();
							$photo['user_id'] = $this->Auth->user('id');
                            $photo['queue'] = $queue;
                            $photo['evenement_id'] = $idEvenement;
                            $photo['name_origne'] = $filenameOrigine;
                            $photo['name_in_csv'] = $filenameOrigine;
                            $photo['name'] = $filename;
                            $photo['source_upload'] = 'bo'; 
                            //== If VIDEO
                            if(in_array($extension, $video_files)){
                                $photo['type_media'] = "video";

                                //======= Generation miniature video
                                $filename_miniature = explode(".", $filename);
                                $filename_miniature = $filename_miniature[0].".jpg";
                                $is_installed_ffmpeg = $this->isFfmpegInstalled();
                                echo json_encode($is_installed_ffmpeg);
                                if(file_exists($destination_path) && $is_installed_ffmpeg){
                                    
                                    $destinationMiniautre = WWW_ROOT."import".DS."galleries".DS. $idEvenement .DS.'miniature_video'.DS;
                                    $dir_miniature         = new Folder($destinationMiniautre, true, 0755);
                                    $destinationMiniautre_path = $dir_miniature->pwd() . DS . $filename_miniature;

                                    $this->loadComponent('PHPFFMpeg');
                                    $ffmpeg = $this->PHPFFMpeg->getFFMpeg();
                                    $video = $ffmpeg->open($destination_path);
                                    $mediaFrame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10));
                                    $vignette =   $mediaFrame->save($destinationMiniautre_path);

                                    if($vignette->getTimeCode() && file_exists($destinationMiniautre_path)){
                                        $photo['is_miniature_video_generated'] = true;
                                        $photo['miniature_video'] = $filename_miniature;
                                        //echo json_encode($is_installed_ffmpeg);
                                    }
                                }
                                /*$filename_miniature = explode(".", $filename);
                                $filename_miniature = $filename_miniature[0].".jpg";
                                $is_installed_ffmpeg = $this->isFfmpegInstalled();

                                if(file_exists($destination_path) && $is_installed_ffmpeg){
                                    
                                    $destinationMiniautre = WWW_ROOT."import".DS."galleries".DS. $idEvenement .DS.'miniature_video'.DS;
                                    $dir_miniature         = new Folder($destinationMiniautre, true, 0755);
                                    $destinationMiniautre_path = $dir_miniature->pwd() . DS . $filename_miniature;

                                    $this->loadComponent('PHPFFMpeg');
                                    $ffmpeg = $this->PHPFFMpeg->getFFMpeg();
                                    $video = $ffmpeg->open($destination_path);
                                    $mediaFrame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10));
                                    $vignette =   $mediaFrame->save($destinationMiniautre_path);

                                    if($vignette->getTimeCode() && file_exists($destinationMiniautre_path)){
                                        $photo['is_miniature_video_generated'] = true;
                                        $photo['miniature_video'] = $filename_miniature;
                                        //echo json_encode($is_installed_ffmpeg);
                                    }
                                }*/
                        }
                        $entity = $this->Photos->newEntity($photo);
                        if($this->Photos->save($entity)){
                            echo json_encode($filename);

                        }else{
                            //debug($entity);
                        }
                    }
                }
            }
            
        }
    }

    
    public function uploadMediaTmp($idEvenement, $queue)
    {
        $res["success"] = false;
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;

            if (!empty($data)) {
                $file = $data["file"];
                $fileTmpName = $file['name'];
                $infoFile = pathinfo($fileTmpName);
                $tempFileExtension = $infoFile["extension"];
                $newName = Text::uuid() . '_'. $queue .'.' . $tempFileExtension;

                $path_tmp = WWW_ROOT . 'import' . DS . 'galleries '. DS .' tmp' . DS . $idEvenement. DS;
                if (!is_dir($path_tmp)) mkdir($path_tmp, 0777, true);
                $destantionFileName = $path_tmp . $newName;
                $tmpFilePath = $file['tmp_name'];
                if (move_uploaded_file($tmpFilePath, $destantionFileName)) {
                    $res["success"] = true;
                    $res["name"] = $newName;
                    $res["name_origine"] = $fileTmpName;
                }
            }
        }
        echo json_encode($res);
    }
    
    public function uploadMedia($idEvenement)
    {   
        //ini_set('max_execution_time', '999');
        $this->autoRender = false; // We don't render a view
        if ($this->request->is(['patch', 'post', 'put'])) {
            $destination = WWW_ROOT."import".DS."galleries".DS. $idEvenement.DS;
            $dir         = new Folder($destination, true, 0755);
                    
            $video_files = ['mp4','MP4', 'flv', 'FLV', 'avi', 'AVI', 'mpg', 'MPG'];
            if (!empty($data['medias_files'])) {
                $path_tmp = WWW_ROOT . 'import' . DS . 'galleries '. DS .' tmp' . DS . $idEvenement. DS;
                foreach($data['medias_files'] as $key => $file) {   
                    if (copy($path_tmp . $fond_vert_file , $path_fond_vert . $fond_vert_file)) {
                        $data['fond_verts'][$key]['file_name'] = $fond_vert_file;
                        $data['fond_verts'][$key]['ordre'] = $key;
                    }

                    if(empty($file['error']) && !empty($file['name'])){
                        $filenameOrigine    = $file['name'];
                        $tmp = $file['tmp_name'];
                       
                        $pathinfos        = pathinfo($file['name']);
                        $file             = $pathinfos['filename'];
                        $extension        = $pathinfos['extension'];
                        $filename         = Text::uuid()."." . $extension;
                        $destination_path = $dir->pwd() . DS . $filename;
                        //debug($extension);die;
        
                        ini_set('memory_limit', '1128M');
                        ini_set('upload_max_filesize', '900M');
                        ini_set('post_max_size ', '1024M');
                        if(!strpos($file, "x2")){
                            if(move_uploaded_file($tmp, $destination_path)){
                                
                                $photo = array();
                                    $photo['user_id'] = $this->Auth->user('id');
                                    $photo['queue'] = $queue;
                                    $photo['evenement_id'] = $idEvenement;
                                    $photo['name_origne'] = $filenameOrigine;
                                    $photo['name_in_csv'] = $filenameOrigine;
                                    $photo['name'] = $filename;
                                    $photo['source_upload'] = 'bo'; 
                                    //== If VIDEO
                                    if(in_array($extension, $video_files)){
                                        $photo['type_media'] = "video";
        
                                        //======= Generation miniature video
                                        $filename_miniature = explode(".", $filename);
                                        $filename_miniature = $filename_miniature[0].".jpg";
                                        $is_installed_ffmpeg = $this->isFfmpegInstalled();
                                        echo json_encode($is_installed_ffmpeg);
                                        if(file_exists($destination_path) && $is_installed_ffmpeg){
                                            
                                            $destinationMiniautre = WWW_ROOT."import".DS."galleries".DS. $idEvenement .DS.'miniature_video'.DS;
                                            $dir_miniature         = new Folder($destinationMiniautre, true, 0755);
                                            $destinationMiniautre_path = $dir_miniature->pwd() . DS . $filename_miniature;
        
                                            $this->loadComponent('PHPFFMpeg');
                                            $ffmpeg = $this->PHPFFMpeg->getFFMpeg();
                                            $video = $ffmpeg->open($destination_path);
                                            $mediaFrame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10));
                                            $vignette =   $mediaFrame->save($destinationMiniautre_path);
        
                                            if($vignette->getTimeCode() && file_exists($destinationMiniautre_path)){
                                                $photo['is_miniature_video_generated'] = true;
                                                $photo['miniature_video'] = $filename_miniature;
                                                //echo json_encode($is_installed_ffmpeg);
                                            }
                                        }
                                }
                                $entity = $this->Photos->newEntity($photo);
                                if($this->Photos->save($entity)){
                                    echo json_encode($filename);
        
                                }else{
                                    //debug($entity);
                                }
                            }
                        }
                    }

                }
            }
            
        }
    }

    public function isFfmpegInstalled(){
        $is_installed_ffmpeg = false;
        $command = "dpkg -s ffmpeg";
        
        if(function_exists('system'))
        {
            ob_start();
            system($command , $return_var);
            $output = ob_get_contents();
            ob_end_clean();
            //debug($return_var);die;
            if(!$return_var){ 
                $is_installed_ffmpeg = true;
            }
        } 
        else if(function_exists('exec'))
        {
            exec($command , $output , $return_var); //debug($output);die;
            if(!empty($output)){
                if(!$return_var){ //if($output[0] == "Package: ffmpeg"){
                    $is_installed_ffmpeg = true;
                    //debug($output[0]);
                }
            }
        }
        else if(function_exists('passthru'))
        {
            ob_start();
            passthru($command , $return_var);
            $output = ob_get_contents();
            ob_end_clean();
            if(!$return_var){ 
                $is_installed_ffmpeg = true;
            }
        } else if(function_exists('shell_exec'))
        {
            $output = shell_exec($command);
            //$output = explode('\n ', $output);
            if($output != null){ 
                $is_installed_ffmpeg = true;
            }
        }

        return $is_installed_ffmpeg;    
    }

    public function getFFMpeg()
    {
        $this->loadComponent('FFMpeg');
        $path = "/var/www/event-selfizee-v2/webroot/import/galleries/786/1f660d5f-256b-46b3-9a63-14fff46ea9ad.mp4";
        //$ffmpeg = $this->FFMpeg->getDuration();
        $video = $this->FFMpeg->setMovie($path);
        $duration = $video->getDuration();
        $videoFrame = $video->getFrameCount();
        //$videoWidth = $video->getWidth();
        //$videoHeight = $video->getHeight();
        //$ffmpeg = $this->FFMpeg->test(WWW_ROOT."import/galleries/779/b267c08f-faac-4218-9dfa-76b74c4fe673.mp4");

        /*debug($videoWidth);
        debug($videoHeight);*/
        debug($duration);die;
    }

    public function getPHPFFMpeg()
    {

        $is_installed_ffmpeg = $this->isFfmpegInstalled();
        debug($is_installed_ffmpeg);die;
        /*if(function_exists('exec'))
        {
            $command = "dpkg -s ffmpeg";
            exec($command , $output , $return_var); //debug($return_var);die;
            if(!empty($output)){
                if($output[0] == "Package: ffmpeg"){
                    $is_installed_ffmpeg = true;
                    //debug($output[0]);
                }
            }
        }*/
        die;


        $file = "1f660d5f-256b-46b3-9a63-14fff46ea9ad.jpg";
        $file = explode(".", $file);
        debug($file[0]);die;
        $path = "/var/www/event-selfizee-v2/webroot/import/galleries/786/1f660d5f-256b-46b3-9a63-14fff46ea9ad.mp4";
        //$ffmpeg = $this->FFMpeg->getDuration();
        $destinationMiniautre = WWW_ROOT."import".DS."galleries".DS. "786".DS.'miniature_video'.DS;
        $dir         = new Folder($destinationMiniautre, true, 0755);

        $destinationMiniautre_path = $dir->pwd() . DS . "1f660d5f-256b-46b3-9a63-14fff46ea9ad.jpg";

        $this->loadComponent('PHPFFMpeg');
        $path = "/var/www/event-selfizee-v2/webroot/import/galleries/786/1f660d5f-256b-46b3-9a63-14fff46ea9ad.mp4";
        //$path = "/var/www/event-selfizee-v2/webroot/import/galleries/786/da75bff6-e465-4618-9e90-27789e9fd709.mp4";

        $ffmpeg = $this->PHPFFMpeg->getFFMpeg();//debug($ffmpeg);die;
        $video = $ffmpeg->open($path); //$video = $this->PHPFFMpeg->setMovie($path);
        $mediaFrame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10));
        $vignette =   $mediaFrame->save($destinationMiniautre_path);
        if($vignette->getTimeCode()){
            debug($vignette->getTimeCode());
        } else {
            debug('');
        }
        die;
    }

    //== Exemple cron generation vignette video
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
                        debug($video->evenement_id);
                    }
                }
            }  
        }
        die;        
    }
    
    public function corbeilleAjax($id, $queue = null){
        //debug($id);
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        $photo->user_id = $this->Auth->user('id');
        $photo->is_in_corbeille = true;
        $photo->queue_crobeille = $queue;
        $photo->date_corbeille = Time::now();
        $res['sucess'] = false;
        if ($this->Photos->save($photo)) {
           $res['sucess'] = true;
        } else {
            $res['sucess'] = false;
        }

        //
        /*$photos = $this->Photos->find('all', [
            'limit' => 100,
            'contain' => ['Evenements'],
            'order' => ['date_prise_photo' => 'asc','heure_prise_photo' => 'asc'],
            'conditions' => ['evenement_id' =>$photo->evenement_id]
        ]);*/
        /*$options['idEvenement'] = $photo->evenement_id;
        $options['corbeille'] = null;
        $this->paginate = [
            'limit' => 100,
            'contain' => ['Evenements'],
            'finder' => [
                'filtre' => $options
            ],
            'order' => ['date_prise_photo' => 'asc','heure_prise_photo' => 'asc']
        ];
        $photos = $this->paginate($this->Photos);*/
        $total = $this->Photos->find()->where(['evenement_id' => $photo->evenement_id,'Photos.deleted' =>false,'Photos.is_in_corbeille'=>false])->count();
        $res['nbr_photos'] = $total;

        echo json_encode($res);
    }
    
    public function deleteSelected()
    {
         $this->autoRender = false;
         if ($this->request->is(['post']) ) {
            $list = $this->request->data["list"];
            $listArray = explode(",", $list);
            $res['sucess'] = false;
            $result  = $this->Photos->deleteAll(['id IN' => $listArray]);
            if($result){
                $res['sucess'] = true;
            }
    
           echo json_encode($res);
        }
    }

    public function updateDateHeurePrise ($limit =null){

        $photosSansDateHeurePrises = $this->Photos->find("all")->where(['date_prise_photo IS'=> NULL, 'heure_prise_photo IS'=> NULL])->limit($limit);
        //debug(explode('-', $photosSansDateHeurePrises->toArray()[1]->name_origne));die;
        $date = new \DateTime();
        foreach ($photosSansDateHeurePrises as $key => $photo){
            $name_fichier = $photo->name_origne;
            $name_array = explode('-', $photo->name_origne);
            $nbr = count($name_array);
            debug($name_fichier);

            //if($name_array[0] == '2018' && array_key_exists(3, $name_array)) {
            if($name_array[0] == '2018' && count($name_array) == 4) {
                $date->setTimestamp(intval($name_array[3]));
                $heure = $date->format('H:i:s');
                $photo->date_prise_photo = date($name_array[0] . "-" . $name_array[1] . "-" . $name_array[2]);
                $photo->heure_prise_photo = $heure;
                if ($this->Photos->save($photo)) {
                    debug($photo->id);
                };
            }

        }die;
    }
    
    
   /* public function editorColorIcon($color){
        //$file = 'http://www.animeviews.com/images/pops/image.png';
        $colorRgb = $this->hexToRgb($color);
        $targetR = $colorRgb['r'];
        $targetG = $colorRgb['g'];
        $targetB = $colorRgb['b'];
        
        $file = WWW_ROOT.'img'.DS.'icon'.DS.'facebook.png';
        
        /*$im_src = imagecreatefrompng( $file );

        $width = imagesx($im_src);
        $height = imagesy($im_src);
    
        $im_dst = imagecreatefrompng( $file );
    
        // Note this:
        // Let's reduce the number of colors in the image to ONE
        imagefilledrectangle( $im_dst, 0, 0, $width, $height, 0xFFFFFF );
    
        for( $x=0; $x<$width; $x++ ) {
            for( $y=0; $y<$height; $y++ ) {
    
                $alpha = ( imagecolorat( $im_src, $x, $y ) >> 24 & 0xFF );
    
                $col = imagecolorallocatealpha( $im_dst,
                    $targetR - (int) ( 1.0 / 255.0  * $alpha * (double) $targetR ),
                    $targetG - (int) ( 1.0 / 255.0  * $alpha * (double) $targetG ),
                    $targetB - (int) ( 1.0 / 255.0  * $alpha * (double) $targetB ),
                    $alpha
                    );
    
                if ( false === $col ) {
                    die( 'sorry, out of colors...' );
                }
    
                imagesetpixel( $im_dst, $x, $y, $col );
    
            }
    
        }
    
        imagepng( $im_dst);
        imagedestroy($im_dst);*
        
        $im = imagecreatefrompng($file);
        imagetruecolortopalette($im, false, 255);
        $ig = imagecolorat($im, 0, 0);
        imagecolorset($im, $ig, $targetR, $targetG, $targetB);
        $ig = imagecolorat($im, 0, 0);
        imagecolortransparent($im, $ig);
        
        imagepng($im);
        
        header('Content-Type: image/png');
        header('Content-Length: ' . filesize($im));
        readfile($im);
        imagedestroy($im);
    }*/
    
    public function editorColorIcon(){
        
         $newColor = $this->request->getQuery('color');
         $source = $this->request->getQuery('source');
        
         header('Content-Type: image/png');
         $this->autoRender = false;
        
        $colorRgb = $this->hexToRgb($newColor);
        $toRed = $colorRgb['r'];
        $toGreen = $colorRgb['g'];
        $toBlue = $colorRgb['b'];
        
        
        $filePathIn = WWW_ROOT.'img'.DS.'icon'.DS.$source;
        
        $imageCopy = imagecreatefrompng($filePathIn);
        $im_dst = imagecreatefrompng($filePathIn);
        $width = imagesx($imageCopy);
        $height = imagesy($imageCopy);
        // Note this: FILL IMAGE WITH TRANSPARENT BG
        imagefill($im_dst, 0, 0, IMG_COLOR_TRANSPARENT);
        imagesavealpha($im_dst, true);
        imagealphablending($im_dst, true);
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($imageCopy, $x, $y);
                $colorOldRGB = imagecolorsforindex($imageCopy, $rgb);
                $alpha = $colorOldRGB["alpha"];
                $colorNew = imagecolorallocatealpha($imageCopy, $toRed, $toGreen, $toBlue, $alpha);
                $flagFoundColor = true;
                $colorOld = imagecolorallocatealpha(
                    $imageCopy,
                    $colorOldRGB["red"],
                    $colorOldRGB["green"],
                    $colorOldRGB["blue"],
                    0
                );
                $color2Change = imagecolorallocatealpha(
                    $imageCopy,
                    0,
                    0,
                    0,
                    0
                );
                $flagFoundColor = ($color2Change == $colorOld);
                if ($flagFoundColor) {
                    imagesetpixel($im_dst, $x, $y, $colorNew);
                }
            }
        }
        imagepng($im_dst);
        
       
        header('Content-Length: ' . filesize($im_dst));
        readfile($im_dst);
        imagedestroy($im_dst);
    }
    
    public function hexToRgb ($hex){
          $color['r'] = hexdec(substr($hex,0,2));
          $color['g'] = hexdec(substr($hex,2,2));
          $color['b'] = hexdec(substr($hex,4,2));
          return $color;
    }
    
	
	
	/*
	 * Création WS pour appli mobile
	 * Projet : https://trello.com/c/YNKo1NHF/460-cr%C3%A9er-ws-pour-appli-selfizee-pro
	 *
	 * mercredi 10 avril 2019
	 * autor : Paul
	 */
	// Liste des photos 
	public function listing($idEvenement){
        $photos = $this->Photos->find('all')
			->order(['date_prise_photo' => 'asc','heure_prise_photo' => 'asc'])
			->where([
				'evenement_id' => $idEvenement,
				'is_in_corbeille' => false,
				'is_validate' => true,
				'deleted' => false,
			])
			->select(['id'
				, 'name_origne', 'name', 'name_in_csv', 'evenement_id', 'token'
			])
			->toArray();
		
        echo json_encode($photos);
		exit;
	}
	
}
