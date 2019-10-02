<?php
namespace App\Controller; 

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\Core\Configure;
use Cake\Mailer\Email;

class RgpdController extends AppController
{
	
	public function initialize(){
		$this->viewBuilder()->setLayout('client');
		
		$title = 'RGPD - Selfizee';
		$meta_title = 'RGPD - Selfizee';
		
		if($this->request->getParam('action') == 'tester'){
			parent::initialize();
			$this->viewBuilder()->setLayout('sans_menu');
		}
		
		$domaine = is_null(Configure::read('url_rgpd_domaine')) ? '/' : Configure::read('url_rgpd_domaine');
		$showPreFooter = true;
		$this -> set(compact(
			'title', 'meta_title', 'domaine','showPreFooter'
		));
	}
	
	// Liste des médias liés à un contact
    public function informations($email_tp = ''){
		$this->loadComponent('Utilities');
		$utilities = $this->Utilities;
		$event_gpt = 
		$photos = [];
		$nb_evt = 0;
		$email = 
		$last_modified = '-';
		$expired = false;
		$info_liste = true;
		$domaine = Configure::read('url_rgpd_domaine');
		
		$data_tp = @unserialize($utilities->slDecryption($email_tp));
		
		$positionChamps = [];
		
		// Vérification de la date d'expiration
		if($data_tp && !empty($data_tp['time'])){
			$date_mail = $data_tp['time'];
			$now = time();
			// Intervale de 7 jours
			$intervalle = 7 * 24 * 60 * 60;
			if($now - $date_mail >= $intervalle){
				$expired = true;
			}
		}
		
		if($data_tp && !empty($data_tp['email']) && !$expired){
			$this -> loadModel('Contacts');
			$email = $data_tp['email'];
			$photos = $this -> Contacts -> find('all')
				->contain(['Photos' => ['Evenements' => 'EvenementPolitiques', 'PhotoStatistiques']])//=> ['CsvColonnePositions'=> 'csvColonnes' ]
				->where([
					'Contacts.email' => $email,
					'Contacts.deleted_via_rgpd IS NULL OR Contacts.deleted_via_rgpd = 0'
				])
				->order(['Photos.evenement_id' => 'DESC'])
				->toArray();
			
			$event = [];
			foreach($photos as $photo_item){
				$last_modified = ($last_modified != '-' && strtotime($last_modified) >= strtotime($photo_item->photo->modified)) ? $last_modified : $photo_item->photo->modified;
				if(!empty($photo_item->photo)){
					$event_gpt[$photo_item->photo->evenement_id][] = $photo_item->photo->evenement->nom;
					if(!in_array($photo_item->photo->evenement_id, $event))
						$event[] = $photo_item->photo->evenement_id;
				}
			}
			$nb_evt = count($event);

			$this -> loadModel('CsvColonnePositions');
			foreach($event as $ev) {
				$listePositionChamp = $this->CsvColonnePositions->find('list',['keyField'=>'position' ,'valueField' => 'csv_colonne.nom'])
										->where(['CsvColonnePositions.evenement_id' => $ev])
										->contain(['CsvColonnes'])
										->toArray();
				if(!empty($listePositionChamp)) $positionChamps [$ev] = $listePositionChamp;
			}
		}

		$banniere_title = 'gestion des données RGPD';
		$this -> set(
			compact(
				'photos', 'event_gpt', 'nb_evt', 'last_modified', 'email', 'utilities',
				'banniere_title',
				'domaine',
				'info_liste', 'email_tp', 'positionChamps',
				'expired'
			)
		);
	}
	
	public function download($params = NULL){
		if($params){
			$this->loadComponent('Utilities');
			$utilities = $this->Utilities;
			$data_tmp = @unserialize($utilities -> slDecryption($params));
			$photo_id = 0;
			
			if(!empty($data_tmp) && isset($data_tmp['idPhoto'])){
				$photo_id = $data_tmp['idPhoto'];
			}
			if($photo_id){
				$this -> loadModel('Photos');
				$photo_tmp = $this -> Photos -> find('all')
				->where(['id' => $photo_id])
				->first();
				
				if(!empty($photo_tmp)){
					$file_path = WWW_ROOT.'import' .DS. 'galleries' .DS. $photo_tmp -> evenement_id .DS. $photo_tmp -> name;
					
					$response = $this->response->withFile($file_path, [
						'download' => true,
						'name' => $photo_tmp->name,
					]);
					return $response;
				}
			}
		}else{
			exit;
		}
	}
	
	public function tester(){
		$this->loadComponent('Utilities');
		
		$utilities = $this->Utilities;
		
		$this -> loadModel('Contacts');
		$contacts = $this -> Contacts -> find('all')
			->where([
				'email IS NOT NULL',
				'email <>' => '',
				'photo_id > 0',
				'deleted_via_rgpd IS NULL OR deleted_via_rgpd = 0'
			])
			->order(['id' => 'DESC'])
			->limit(40)
			->distinct('email')
			->toArray();
		
		$this -> set(
			compact('contacts', 'utilities')
		);
	}
	
	// Inscription formulaire pour rgpd
	public function inscription(){
		$showPreFooter = false;
		$banniere_title = 'Interface de gestion des données utilisateurs - RGPD';
		
		if(isset($this -> request -> data['email']) && trim($this -> request -> data['email'])){
			$email = trim($this -> request -> data['email']);
			// Vérification dans la base de données
			$this -> loadModel('Contacts');
			$contact = $this -> Contacts -> find('all')
				-> where([
					'email' => $email
				])
				->first();
				
			if($contact){
				$this->loadComponent('Utilities');
				$utilities = $this->Utilities;

				$destinateurs = trim($contact['email']);
				$linkRgpd = Configure::read('url_rgpd_domaine') . 'e/inf/' . $utilities->slEncryption(serialize(['email' => $destinateurs, 'time' => time()]));
				
				
				$contenu = '<br/>';
				$contenu .= 'Bonjour,';
				
				$contenu .= '<br/><br/>';
				
				$contenu .= '<p style="color:#474747;">Suite à votre demande, voici le lien permettant d\'acceder à la gestion de vos données collectées sur la plateforme de la borne photo Selfizee : <a href="'.$linkRgpd.'">'.$linkRgpd.'</a></p>';
				
				$contenu .= '<p style="color:#474747;">Celui-ci a une durée de 7 jours, pour y accéder à nouveau merci de réitérer votre demande sur notre plateforme RGPD : <a href="'.Configure::read('url_rgpd_domaine').'">'.Configure::read('url_rgpd_domaine').'</a></p>';
				
				$contenu .= '<p style="color:#474747;">Vous retrouverez sur cette plateforme l\'ensemble des informations liées à la politique de traitement des données, ainsi que notre charte de conformité à la réglementation européenne.</p>';
				
				$contenu .= '<p style="color:#474747;">Nous vous remercions pour votre confiance.</p>';
				$contenu .= '<br/>';
				
				$contenu .= '<p style="color:#474747;">L\'équipe Selfizee</p>';
				
				// Envoi mail
				$email = new Email('default');
				$email->setViewVars(['contenu' => $contenu, 'no_logo_header' => true])
					->setTemplate('sendacces')
					->setEmailFormat('html')
					->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
					->setSubject('Interface de gestion des données utilisateurs')
					->setTransport('mailjet')
					->setTo($destinateurs);
				$email->send();
				// exit;
			}
			
			$retour = '<div class="text-center">'.
				'<div class="sf-container-icon"><img src="/img/icon/sf-fusee-sending.png"></div>'.
			'</div>'.
			'<p class="text-success sf-rgpd-para-size-1">'.
				'Demande effectuée avec succès. '.
			'</p>'.
			'<p class="text-success sf-rgpd-para-size-1">'.
				'Si votre adresse e-mail est bien enregistrée dans notre base, vous allez recevoir un e-email vous permettant d’accéder à la gestion de vos données.'.
			'</p>';
			
			echo json_encode($retour);
			exit;
		}
		
		$this -> set(
			compact(
				'banniere_title',
				'showPreFooter'
			)
		);
	}
	
	// Suppression des données du client via l'interface rgpd (listing des médias liées à des événements)
	public function suppression(){
		$this -> autoRender = false;
		$retour = ['error' => true];
		
		if(!empty($this -> request -> data)){
			$this -> loadModel('Contacts');
			$this->loadComponent('Utilities');
			$utilities = $this->Utilities;
			
			$datas = @unserialize($utilities->slDecryption($this -> request -> data['info']));
			
			if($datas){
				$is_all = $datas['is_all'];
				$email = $datas['email'];
				$evenement_id = $datas['evenement_id'];
				$this -> loadModel('Evenements');
				$event = $this -> Evenements -> get($evenement_id,[ 'contain' => ['Clients']]);
				$event_name = $event-> nom;
				$email_client = $event->client->email;
				
				$deleted_date = date('Y-m-d H:i:s');
				
				if($is_all == 0){
					// Suppression d'une ligne
					$ref_contact = $datas['id'];
					$data_update = [
						'deleted_via_rgpd' => 1,
						'deleted_date' => $deleted_date,
					];
					
					$contact = $this->Contacts->get($ref_contact, [
						'contain' => []
					]);
					$contact = $this->Contacts->patchEntity($contact, $data_update);
					$this->Contacts->save($contact);
					
					if($contact->photo_id){
						// Mise à jour optin de chaque photo
						$this -> loadModel('Photos');
						$photo_update = [
							'is_optin_sms' => 0,
							'is_optin_email' => 0,
							'is_optin_galerie' => 0,
							'deleted_via_rgpd' => 1,
							'queue_rgpd' => strtotime($deleted_date),
							'deleted_date_rgpd' => $deleted_date,
						];
						
						$photo_mdl = $this->Photos->get($contact->photo_id, [
							'contain' => []
						]);

												
						$email_visiteur = $this -> request -> data ['email_visiteur'];
						$photo_name = $photo_mdl->name_origne;	
							
						$photo_mdl = $this->Photos->patchEntity($photo_mdl, $photo_update);
						$this->Photos->save($photo_mdl);
						if($this->Photos->save($photo_mdl)){
							//== Send email notif
							$contenu_email = '<p>Bonjour, </p>';
							$contenu_email = $contenu_email.'<p>La photo <strong>'.$photo_name.'</strong> de l\'événement <strong>'.$event_name.'</strong> est supprimée dans la page photo rgpd par le contact <strong>('.$email_visiteur.')</strong>. </p>';
						
							$email = new Email('default');
							$email->setViewVars(['contenu' => $contenu_email])
								->setTemplate('sendacces')
								->setEmailFormat('html')
								->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
								->setSubject('Selfizee : Suppression photo dans Rgpd')
								->setTransport('mailjet')
								->setTo(['celest1.pr@gmail.com']); //$email_client //, 's.mahe@konitys.fr'
								if ($email->send()) {
								}		
							}
						}
				}elseif($is_all == 1){
					// Suppression de tous les enregistrement contact
					$contacts = $this -> Contacts -> find('all')
						->where([
							'Contacts.email' => $email,
							'Contacts.photo_id > 0',
							'Contacts.deleted_via_rgpd IS NULL OR Contacts.deleted_via_rgpd = 0'
						])
						->contain(['Photos' => function ($q) use ($evenement_id) {
								return $q
								->where(['Photos.evenement_id' => $evenement_id]);
							}
						])->toArray();
					
					$photos_supprimees = [];

					foreach($contacts as $contact_item){
						$data_update = [
							'deleted_via_rgpd' => 1,
							'deleted_date' => $deleted_date,
						];
						$contact = $this->Contacts->get($contact_item->id, [
							'contain' => []
						]);
						$contact = $this->Contacts->patchEntity($contact, $data_update);
						$this->Contacts->save($contact);
						
						// Mise à jour optin de chaque photo
						$this -> loadModel('Photos');
						$photo_update = [
							'is_optin_sms' => 0,
							'is_optin_email' => 0,
							'is_optin_galerie' => 0,
							'deleted_via_rgpd' => 1,
							'queue_rgpd' => strtotime($deleted_date),
							'deleted_date_rgpd' => $deleted_date,
						];
						
						$photo_mdl = $this->Photos->get($contact_item->photo->id, [
							'contain' => []
						]);
						$photo_mdl = $this->Photos->patchEntity($photo_mdl, $photo_update);
						if($this->Photos->save($photo_mdl)){
							$photos_supprimees [] = $photo_mdl->name_origne;
						}
					}

					
					//== Send email notif
					$photos_supprimees = implode(", ", $photos_supprimees);
					$contenu_email = '<p>Bonjour, </p>';
					$contenu_email = $contenu_email.'<p>Les photos <strong>'.$photos_supprimees.'</strong> de l\'événement <strong>'.$event_name.'</strong> sont supprimées dans la page photo rgpd par le contact ('.$email.'). </p>';
				
					$email_notif = new Email('default');
					$email_notif->setViewVars(['contenu' => $contenu_email])
						->setTemplate('sendacces')
						->setEmailFormat('html')
						->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
						->setSubject('Selfizee : Suppression photo dans Rgpd')
						->setTransport('mailjet')
						->setTo('celest1.pr@gmail.com'); //$email_client / s.mahe@konitys.fr
						if ($email_notif->send()) {
						}					
					
				}
				$retour = ['error' => false];
			}
		}
		
		echo json_encode($retour);
	}

public function edition($id){
		
		$this -> autoRender = false;
		$res['id'] = $id;
		$this -> loadModel('Photos');
		$photo = $this->Photos->get($id, [
			'contain' => ['Evenements']
		]);
		$event_name = $photo->evenement->nom;

		$this -> loadModel('CsvColonnePositions');
		$listePositionChamp = $this->CsvColonnePositions->find('list',['keyField'=>'position' ,'valueField' => 'csv_colonne.nom'])
										->where(['CsvColonnePositions.evenement_id' => $photo->evenement_id])
										->contain(['CsvColonnes'])
										->toArray();
		$photo->liste_position_champ = $listePositionChamp;
		//echo json_encode($photo->survey1);die;	
		
		$res ['success'] = false;
		if ($this->request->is(['post']) ) {
			$data = $this -> request -> data;
			$data_photo = $photo->toArray();
			unset($data_photo['evenement']);
			//debug($data_photo);die;
			$data_photo['survey1'] = $data['survey1'];
			$data_photo['survey2'] = $data['survey2'];
			$data_photo['survey3'] = $data['survey3'];
			$data_photo['survey4'] = $data['survey4'];
			$data_photo['survey5'] = $data['survey5'];
			$data_photo['survey6'] = $data['survey6'];
			$data_photo['survey7'] = $data['survey7'];

			$photo = $this->Photos->patchEntity($photo, $data_photo);
				
			$champ_modifies = $photo->getDirty();
			$get_champ_survey = function($ligne) {
				$seg = substr($ligne, 0, 6);
				$result = null;
				if($seg == "survey"){					
					$result = $ligne;
				}
				return $result;
			};

			$champ_modifies = array_map($get_champ_survey, $champ_modifies);
			$champ_modifies = array_filter($champ_modifies);
			//debug($champ_modifies);die;	

			if(!empty($champ_modifies)) {
				if($this->Photos->save($photo)) {
					$res ['success'] = true;
					$res ['photo'] = $photo;						
					$this -> loadModel('MajInfoRgpds');
					$maj_info = $this->MajInfoRgpds->newEntity();
					$maj_info->champ_modifie = implode(',', $champ_modifies);
					$maj_info->photo_id = $photo->id;
					$maj_info->modifieur = $data['email_visiteur'];
					$this->MajInfoRgpds->save($maj_info);
					$res ['maj'] = $maj_info;

					//== Send email notif
					$modifs_champ = implode(", ", $champ_modifies);
					$contenu_email = '<p>Bonjour, </p>';
					$contenu_email = $contenu_email.'<p>Une modification est faite dans la page photo rgpd sur la photo <strong>'.$photo->name_origne.'</strong> de l\'événement <strong>'.$event_name.'</strong> par le contact <strong>('.$data['email_visiteur'].')</strong>. </p>';
					$contenu_email = $contenu_email.'<p>Le(s) champ(s) modifié(s) sont: '.$modifs_champ.' .</p>';
					$email = new Email('default');
					$email->setViewVars(['contenu' => $contenu_email])
						->setTemplate('sendacces')
						->setEmailFormat('html')
						->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
						->setSubject('Selfizee : Modification photo')
						->setTransport('mailjet')
						->setTo(['celest1.pr@gmail.com', 's.mahe@konitys.fr']);
						if ($email->send()) {
						}						
				}
			}			
			echo json_encode($res);die;
		}
		echo json_encode($photo);
	}

	public function exportData($email_tp = ''){
		$this->response->download("datas.csv");
		$this->layout = 'ajax';
		$this->loadComponent('Utilities');
		$utilities = $this->Utilities;
		$data_tp = @unserialize($utilities->slDecryption($email_tp));
		//debug($data_tp);die;
		$datas = [];
		if($data_tp && !empty($data_tp['email'])){
			$this -> loadModel('Contacts');
			$email = $data_tp['email'];
			$photos = $this -> Contacts -> find('all')
				->contain(['Photos' => 'Evenements'])
				->where([
					'Contacts.email' => $email,
					'Contacts.deleted_via_rgpd IS NULL OR Contacts.deleted_via_rgpd = 0'
				])
				->order(['Photos.evenement_id' => 'DESC'])
				->toArray();//debug($photos);die;
			$event = [];
			$url_photos = [];
			if(!empty($photos)){
				$datas [0]['email'] = "Email";
				$datas [0]['evenement'] = "Evenement";
				$datas [0]['nom_photo'] = "Nom de la photo";
				$datas [0]['url_photo'] = "Lien de la photo";
				$datkeas [0]['datetime_photo'] = "Date prise";
	
				foreach($photos as $photo_item){
					$url_photos[] = $photo_item->photo->url_photo_souvenir;
					$datas [$photo_item->id]['email'] = $photo_item->email;
					$datas [$photo_item->id]['evenement'] = $photo_item->photo->evenement->nom;
					$datas [$photo_item->id]['nom_photo'] = $photo_item->photo->name_origne;
					$datas [$photo_item->id]['url_photo'] = $photo_item->photo->url_photo_souvenir;
					
					$datePhoto = '';
			        if(!empty($photo_item->photo->date_prise_photo)){
			            $datePhoto = $photo_item->photo->date_prise_photo->format('d/m/Y');
			        }
			        $heurePhoto = '';
			        if(!empty($photo_item->photo->heure_prise_photo)){
			                $heurePhoto = $photo_item->photo->heure_prise_photo->format('H\hi');
			        }
					$datas [$photo_item->id]['datetime_photo'] = $datePhoto." ".$heurePhoto;
				}
			}

			//debug($datas);die;
		}
		
		$this->set(compact('datas'));
	}


	public function politiqueDeCookies(){
		$titre ="Selfizee – Politique relative à l’utilisation des Cookies";
		$banniere_title = "Politique de cookies";
		
		
		
		$meta_title = 'Politique de cookies – Photobooth - Selfizee';
		$meta_desc = "Nous utilisons des cookies ou d'autres technologies similaires pour faire fonctionner notre site et améliorer l'usage que vous en faites en le personnalisant. La présente politique explique le type de cookies que nous utilisons et comment nous les gérons";
		
		$this->viewBuilder()->setLayout('conditions');
    	$this->set(compact('banniere_title','titre', 'meta_title', 'meta_desc'));

	}
	
	public function politique($event_detail = '')
    {
    	$banniere_title = 'POLITIQUE  DE  TRAITEMENT  DES DONNÉES';
    	$titre = "Selfizee – Politique de  Traitement  des Données";
		
		$event_politique = [];
		$domaine = Configure::read('url_rgpd_domaine');
		$idEvenement = 0;
		if(trim($event_detail)){
			$this->loadComponent('Utilities');
			$utilities = $this->Utilities;
			$domaine = Configure::read('url_rgpd_domaine');
			
			$data_tp = @unserialize($utilities->slDecryption($event_detail));
			$idEvenement = $data_tp['idEvenement'];	
		}
		
		if($idEvenement){
			$this -> loadModel('EvenementPolitiques');
			$event_politique = $this->EvenementPolitiques->find()
			->where(['evenement_id' => $idEvenement])
			->first();
			
		}
		
		if($event_politique){
			$banniere_title .= trim($event_politique -> nom_client) ? ' de '.$event_politique -> nom_client : ' du fournisseur';
		}else{
			$banniere_title .= ' de SELFIZEE';
		}
		
		$meta_title = 'Politique de traitement des données RGPD – Photobooth – Borne photo Selfizee';
		$meta_desc = '';
		
    	$this->viewBuilder()->setLayout('conditions');
    	$this->set(compact('banniere_title','titre', 'event_politique', 'domaine', 'meta_title', 'meta_desc'));
    }

    public function charteRgdp(){
		$active = 'engagement';
    	$titre = 'CHARTE DE CONFORMITÉ AU RGPD';
    	$banniere_title = 'CHARTE DE CONFORMITÉ AU RGPD';
		
    	$this->viewBuilder()->setLayout('conditions');
    	$this->set(compact('banniere_title','titre', 'active'));
    }
    public function charteRgdpMoyen(){
		$active = 'moyen';
    	$titre = 'CHARTE DE CONFORMITÉ AU RGPD';
    	$banniere_title = 'CHARTE DE CONFORMITÉ AU RGPD';
		
    	$this->viewBuilder()->setLayout('conditions');
    	$this->set(compact('banniere_title','titre', 'active'));
    }

    public function charteRgdp2(){
    	$titre = 'CHARTE DE CONFORMITÉ AU RGPD';
    	$banniere_title = 'CHARTE DE CONFORMITÉ AU RGPD';
		
    	$this->viewBuilder()->setLayout('conditions');
    	$this->set(compact('banniere_title','titre'));
    }

    /*public function post(){
		$slug = $this->request->getParam('slug');
		//debug($slug);die;
		$this->loadModel('EvenementPosts');
		$post = $this->EvenementPosts->find('all')
				             ->where(['EvenementPosts.slug' => $slug])
					     ->first();
    										
		if(!$post){
			$this->viewBuilder()->setLayout('page_introuvable');
		} else {
			$banniere_title = $post->titre;
			$contenu = $post->contenus;		
			$this->viewBuilder()->setLayout('conditions');
			$this->set(compact('contenu','banniere_title'));
		}
    }*/


    public function gestionDesDonnees(){
    	$titre = 'GESTION DES DONNÉES PERSONNELLES';
    	$banniere_title = 'GESTION DES DONNÉES PERSONNELLES';

	$is_page_gestion_donnees = 1;		
    	$this->viewBuilder()->setLayout('conditions');
    	$this->set(compact('banniere_title','titre', 'is_page_gestion_donnees'));
   }

}
