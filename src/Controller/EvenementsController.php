<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Collection\Collection;
use Cake\Core\Configure;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;
use Cake\Utility\Text;
use Cake\Utility\Inflector;
use Cake\Database\Expression\QueryExpression;
use Cake\View\Helper\PaginatorHelper;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use Cake\Console\ShellDispatcher;

use Cake\Network\Http\Client;

/**
 * Evenements Controller
 *
 * @property \App\Model\Table\EvenementsTable $Evenements
 *
 * @method \App\Model\Entity\Evenement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvenementsController extends AppController
{
	
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        //debug($action);die;

        if($user['role_id'] == 1 && $action == 'acces' ) {
            return true;
        }

        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['edit', 'delete','view','timelineEvent','tdbr'])) {
                    $idEvenement = $this->request->getParam('pass.0');
                    $clientId = $user['client_id'];
                    $this->loadModel('Evenements');
                    $evenement = $this->Evenements->get($idEvenement);
                    //debug($evenement->client_id); debug($clientId); die;
                    if($clientId == $evenement->client_id)  {
                        return true;
                    }
            }
            if (in_array($action, ['add', 'index', 'aVenir','timeline', 'statistique'])) {
                // die();
                return true;
            }
        }
		
		if($action == 'statistique'){
			$this->viewBuilder()->setLayout(null);
			$this->response->header(array('Content-type' => 'application/pdf'));
			ini_set('memory_limit', '1024M');
			set_time_limit(0);
		}
		if($action == 'png')
			$this->viewBuilder()->setLayout(false);

        // debug($user);
        // die();
        // ==== ACCES EVENT et Accès compte client
        if($user['role_id'] == 5 || $user['role_id'] == 7) {
            if($action == 'edit' && $user['is_active_acces_config'] == true) {
                return true;
            }

            if($action == 'view' && $user['is_active_acces_event'] == true) {
                return true;
            }

            if($action == 'timeline' && $user['is_active_acces_timeline'] == true) {
                return true;
            }
        }

        if ($user['role_id'] == 7) {
            if ($action == 'index' && $user['is_active_acces_event'] == true) {
                return true;
            }

            if ($action == 'add' && $user['is_active_acces_creation_event'] == true) {
                return true;
            }
        }


        if($action == 'forceLoginAdmin' || $action == 'board'){
            return true;
        }
		
        // Par d�faut, on refuse l'acc�s.
        return parent::isAuthorized($user);
    }

    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
       
        $key = trim($this->request->getQuery('key'));
        $pageSouv = $this->request->getQuery('pageSouv');
        $emailConf = $this->request->getQuery('emailConf');
        $smsConf = $this->request->getQuery('smsConf');
        $envoiConf = $this->request->getQuery('envoiConf');
        $fbAutoConf = $this->request->getQuery('fbAutoConf');
        $photoExiste = $this->request->getQuery('photoExiste');
        $clientType = $this->request->getQuery('clientType');
        $passe = $this->request->getQuery('passe');
        $date = $this->request->getQuery('date');
        $date_debut = $this->request->getQuery('date_debut');
        $date_fin = $this->request->getQuery('date_fin');
        $periode = $this->request->getQuery('periode');
        $isGlobal = $this->request->getQuery('isGlobal');
        $filtre_avances = $this->request->getQuery('filtre_avances');
        $periodeType = $this->request->getQuery('periodeType');
  
        $date_debut0 = ""; $date_fin0 ="";
        if(!empty($periode)){
            $dates = explode(' - ', $periode);
            if(count($dates) == 2) {
                $date_debut0 = $dates[0];
                $date_fin0 = $dates[1];
                $date_debut = explode('/', $dates[0]);
                $date_fin = explode('/', $dates[1]);

                $date_debut = $date_debut[2] . "-" . $date_debut[1] . "-" . $date_debut[0];
                $date_fin = $date_fin[2] . "-" . $date_fin[1] . "-" . $date_fin[0];
             
            }
        }

        $clientId = $this->request->getQuery('clientId');
        if(empty($clientId)){
            if($this->Auth->user('client_id')){
                $clientId = $this->Auth->user('client_id');
            }
        }


        $currentAuth = $this->Auth->user();
        $this->loadModel('Users');
        if (isset($currentAuth['role_id']) && $currentAuth['role_id'] == 7) {
            $clientParrain = $this->Users->findById($currentAuth['parent_id'])->first();
            if ($clientParrain) {
                $clientId = $clientParrain['client_id'];
            }
        }

        $options['key'] = $key;
        $options['pageSouv'] = $pageSouv;
        $options['emailConf'] = $emailConf;
        $options['smsConf'] = $smsConf;
        $options['envoiConf'] = $envoiConf;
        $options['fbAutoConf'] = $fbAutoConf;
        $options['photoExiste'] = $photoExiste;
        $options['clientId'] = $clientId;
        $options['clientType'] = $clientType;
        $options['passe'] = $passe;
        $options['date'] = $date;
        $options['date_debut'] = $date_debut;
        $options['date_fin'] = $date_fin;
        $options['isGlobal'] = $isGlobal;
        $options['periodeType'] = $periodeType;

        $this->viewBuilder()->setLayout('sans_menu');
        $this->paginate = [
            //'limit' => 100,
            'contain' => [
                'Photos'=>['Contacts'],
                'Clients',
                'Galeries'=>['Users'],
                'EmailEnvois', 'SmsEnvois','ContactEvenements', 
                'FacebookAutos'=>['FacebookAutoSuivis'],
                'EmailConfigurations','SmsConfigurations','Crons',
                'TimelinesEnvoiSmss','TimelinesEnvoiMails','TimelinesImportContacts', 'TimelinesUploadPhotos', 'Timelines'
            ],
            'finder'=>[
                'filtre' => $options
            ],
            'order'=>['Evenements.id'=>'desc']
        ];
        $evenements = $this->paginate($this->Evenements);
        //debug($evenements->toList());die;
		//debug($this->Paginator->getController());die;
		
        $totalPhotos = 0;
		
		//======= Optimisation (modifs) Count photos && photo apercu
		$allIdEvenements = (new Collection($evenements))->extract('id');
		$allIdEvenements = $allIdEvenements->toList();//debug($allIdEvenements);die;
		$allPhotos = (new Collection($evenements))->extract('photos');
		$allPhotos = $allPhotos->toList();
		$allPhotos = array_combine($allIdEvenements, $allPhotos);//debug($allPhotos);die;
		$allCountPhotos = array_map('count', $allPhotos);
		$totalPhotos = array_sum($allCountPhotos);
		//== apercu photo
		$getApercuPhotoEvent = function($photos){
			$collection = (new Collection( $photos))->filter(function ($photo, $key) {
				return file_exists(WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS.$photo->name) && 
				((filesize(WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS.$photo->name)/1024) > 4);
			});
			$photo_apercu = null;
			if($collection->last()) {
				$photo_apercu = $collection->last()->url_thumb_popup;
			}
			return $photo_apercu;
		};
		$apercuPhotoEvents = array_map($getApercuPhotoEvent, $allPhotos);
		//debug($apercuPhotoEvents);die;
		
        $keyInVal = intval($key);
        //debug($keyInVal);
        if(is_int($keyInVal) && !empty($keyInVal)){
            $eventTableau = $evenements->toArray();
            if(!empty($eventTableau) && count($eventTableau) == 1){
                $id = $eventTableau[0]->id;
                //return $this->redirect(['controller'=>'Evenements','view'=>$id]);
                return $this->redirect(['action' => 'view', $id]);
            }
        }

        $this->set(compact('evenements','key','pageSouv','emailConf','smsConf','envoiConf','fbAutoConf','photoExiste','clientType','passe', 'date', 'date_debut', 'date_fin', 'date_debut0', 'date_fin0','isGlobal', 'filtre_avances', 'periodeType', 'totalPhotos' ));
		$this->set(compact('apercuPhotoEvents', 'allIdEvenements'));
		//$this->render('index_1');
	}
	

	/*
	* Ajax get info count
	**/
	public function getInfoSynthseEvent()
    {
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
		$data = $this->request->getData();
		//debug($data);die;
		$counts = [];	
        $totalContacts = 0;
        $totalSmsEnvoyes = 0;
        $totalEmailEnvoyes = 0;
		$totalPublications = 0;

		if(!empty($data['ids'])) {
			$evenements_ids = $data['ids'];
            $this->loadModel('SmsEnvois');
            $smsEnvois = $this->SmsEnvois->find();//debug($smsEnvois);die;
            $smsEnvois = $smsEnvois->select(['total_sms_envoi' => $smsEnvois->func()->sum('total_envoi')])->where(['evenement_id in' => $evenements_ids])->toArray();
			$totalSmsEnvoyes = intval($smsEnvois[0]->total_sms_envoi);
			$counts ['totalSmsEnvoyes'] = $totalSmsEnvoyes;

            $this->loadModel('EmailEnvois');
            $emailEnvois = $this->EmailEnvois->find();
            $emailEnvois = $emailEnvois->select(['total_email_envoi' => $emailEnvois->func()->sum('total_envoi')])->where(['evenement_id in' => $evenements_ids])->toArray();
            $totalEmailEnvoyes = intval($emailEnvois[0]->total_email_envoi);
			$counts ['totalEmailEnvoyes'] = $totalEmailEnvoyes;

            $this->loadModel('ContactEvenements');
            $contactEvenements = $this->ContactEvenements->find();
            $contactEvenements = $contactEvenements->select(['total_contact' => $contactEvenements->func()->sum('total_contact')])->where(['evenement_id in' => $evenements_ids])->toArray();
            $totalContacts = intval($contactEvenements[0]->total_contact);
			$counts ['totalContacts'] = $totalContacts;

			$this->loadModel('FacebookAutoSuivis');
			$fbAutoSuivis = $this->FacebookAutoSuivis->find('all')
							->matching('FacebookAutos', function ($q) use ($evenements_ids){
								return $q->where(['FacebookAutos.evenement_id IN'  => $evenements_ids]);
							})
							->count();
			$counts ['totalPublications'] = $fbAutoSuivis;

		}

		echo json_encode($counts);
	}

	public function getGalerieEventToSend($idEvenement){
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
		$evenement = $this->Evenements->get($idEvenement, ['contain'=>['Galeries', 'Clients']]);
		echo json_encode($evenement);
	}
    
	public function aVenir()
    {
        $key = trim($this->request->getQuery('key'));
        $pageSouv = $this->request->getQuery('pageSouv');
        $emailConf = $this->request->getQuery('emailConf');
        $smsConf = $this->request->getQuery('smsConf');
        $envoiConf = $this->request->getQuery('envoiConf');
        $fbAutoConf = $this->request->getQuery('fbAutoConf');
        $photoExiste = $this->request->getQuery('photoExiste');
        $clientType = $this->request->getQuery('clientType');
        $passe = 1;
        $date = $this->request->getQuery('date');
        $date_debut = $this->request->getQuery('date_debut');
        $date_fin = $this->request->getQuery('date_fin');
        $periode = $this->request->getQuery('periode');
        $isGlobal = $this->request->getQuery('isGlobal');
        $filtre_avances = $this->request->getQuery('filtre_avances');
        $periodeType = $this->request->getQuery('periodeType');
        //debug($periodeType);die;
        //debug($date_debut);die;
        $date_debut0 = ""; $date_fin0 ="";
        if(!empty($periode)){
            $dates = explode(' - ', $periode);
            if(count($dates) == 2) {
                $date_debut0 = $dates[0];
                $date_fin0 = $dates[1];
                $date_debut = explode('/', $dates[0]);
                $date_fin = explode('/', $dates[1]);

                $date_debut = $date_debut[2] . "-" . $date_debut[1] . "-" . $date_debut[0];
                $date_fin = $date_fin[2] . "-" . $date_fin[1] . "-" . $date_fin[0];
                //debug($date_debut);die;
            }
        }

        $clientId = $this->request->getQuery('clientId');
        if(empty($clientId)){
            if($this->Auth->user('client_id')){
                $clientId = $this->Auth->user('client_id');
            }
        }

        $options['key'] = $key;
        $options['pageSouv'] = $pageSouv;
        $options['emailConf'] = $emailConf;
        $options['smsConf'] = $smsConf;
        $options['envoiConf'] = $envoiConf;
        $options['fbAutoConf'] = $fbAutoConf;
        $options['photoExiste'] = $photoExiste;
        $options['clientId'] = $clientId;
        $options['clientType'] = $clientType;
        $options['passe'] = $passe;
        $options['date'] = $date;
        $options['date_debut'] = $date_debut;
        $options['date_fin'] = $date_fin;
        $options['isGlobal'] = $isGlobal;
        $options['periodeType'] = $periodeType;

        $this->viewBuilder()->setLayout('sans_menu');
        $this->paginate = [
            //'limit' => 100,
            'contain' => [
                'Photos'=>['Contacts'],
                'Clients',
                'Galeries'=>['Users'],
                'EmailEnvois', 'SmsEnvois','ContactEvenements', 
                'FacebookAutos'=>['FacebookAutoSuivis'],
                'EmailConfigurations','SmsConfigurations','Crons',
                'TimelinesEnvoiSmss','TimelinesEnvoiMails','TimelinesImportContacts', 'TimelinesUploadPhotos', 'Timelines'
            ],
            'finder'=>[
                'filtre' => $options
            ],
            'order'=>['Evenements.id'=>'desc']
        ];
        $evenements = $this->paginate($this->Evenements);
        //debug($evenements);die;
        //debug($this->Paginator->getController());die;

        $totalPhotos = 0;		
		//======= Optimisation (modifs) Count photos && photo apercu
		$allIdEvenements = (new Collection($evenements))->extract('id');
		$allIdEvenements = $allIdEvenements->toList();
		//debug($allIdEvenements);die;
		$allPhotos = (new Collection($evenements))->extract('photos');
		$allPhotos = $allPhotos->toList();
		$allPhotos = array_combine($allIdEvenements, $allPhotos);//debug($allPhotos);die;
		$allCountPhotos = array_map('count', $allPhotos);
		$totalPhotos = array_sum($allCountPhotos);
		/*$getApercuPhotoEvent = function($photos){
			$collection = (new Collection( $photos))->filter(function ($photo, $key) {
				return file_exists(WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS.$photo->name) && 
				((filesize(WWW_ROOT."import".DS."galleries".DS. $photo->evenement_id.DS.$photo->name)/1024) > 4);
			});
			$photo_apercu = null;
			if($collection->last()) {
				$photo_apercu = $collection->last()->url_thumb_popup;
			}
			return $photo_apercu;
		};
		$apercuPhotoEvents = array_map($getApercuPhotoEvent, $allPhotos);*/

        //debug($evenements);die;
        $keyInVal = intval($key);
        //debug($keyInVal);
        if(is_int($keyInVal) && !empty($keyInVal)){
            $eventTableau = $evenements->toArray();
            if(!empty($eventTableau) && count($eventTableau) == 1){
                $id = $eventTableau[0]->id;
                //return $this->redirect(['controller'=>'Evenements','view'=>$id]);
                return $this->redirect(['action' => 'view', $id]);
            }
        }

        $this->set(compact('evenements','key','pageSouv','emailConf','smsConf','envoiConf','fbAutoConf','photoExiste','clientType','passe', 'date', 'date_debut', 'date_fin', 'date_debut0', 'date_fin0','isGlobal', 'filtre_avances', 'periodeType', 'totalPhotos' ));
		$this->set(compact('allIdEvenements'));
		$this->render('index');
    }

    public function index2()
    {
        $passe = $this->request->getQuery('passe');
        $options['passe'] = $passe;
        
        $this->paginate = [
            //'limit' => 100,
            'contain' => [
                'TimelinesUploadPhotos',
                'TimelinesImportContacts',
                'TimelinesEnvoiMails',
                'TimelinesEnvoiSmss',
                'Timelines'
            ],
            'finder'=>[
                'filtre' => $options
            ],
            'order'=>['Evenements.id'=>'desc']
        ];
        $evenements = $this->paginate($this->Evenements);
        debug($evenements->count());
        debug($evenements);die;

    }


    /**
     * View method
     *
     * @param string|null $id Evenement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     
    public function tbdr($idEvenement = null){
        
       /* $evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Photos','Crons','FacebookAutos'=>['FacebookAutoSuivis'],'Galeries']
        ]);*/
        
        $evenement = $this->Evenements->find()->contain([
                    'Crons'
                    ,'FacebookAutos'=>['FacebookAutoSuivis'],'Galeries'
                    ,'Photos' => function (Query $q) {
                        return $q->order(['Photos.id' => 'DESC','Photos.date_prise_photo' => 'DESC']);
                    }
                ])
                ->where(['Evenements.id' => $idEvenement])
                ->first();
        
        
        $this->set(compact('evenement','idEvenement'));
    }
    
    public function view($idEvenement = null)
    {
        $this->redirect(['action'=>'board', $idEvenement]);
        //$this->redirect(['action' => 'board', $evenement->id]);


        $evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Photos','Crons','FacebookAutos'=>['FacebookAutoSuivis'],'Galeries']
        ]);

        /*$photo_last = $this->Evenements->Photos->find('all', ['valueField'=> 'created'])->where(['evenement_id'=>$idEvenement])->last();
        $pub_facebook = $this->Evenements->FacebookAutos->find('all', ['valueField'=> 'created'])->where(['evenement_id'=>$idEvenement])->last();
        debug($pub_facebook);die;*/
        
        $nbrPhoto = count($evenement->photos);
        $nbrContact = 0;
        $nbrContactEmail = 0;
        $nbrContactTel = 0;
        $nbrEmailEnvoye =0;
        $nbrEmailOuvert = 0;
        $nbrSmsEnvoye = 0;
        $nbrSmsOuvert = 0;
        $nbrTelechargementPhoto = 0;
        $nbrPageVue = 0;
        $smsDeliveryPercent = 0;
        $smsNotDeliveryPercent = 0;
        if($nbrPhoto){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $contactList = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos])
                                                        ->toArray();
                                                        
            $nbrContact = count($contactList);
            
            
            $nbrContactEmail = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $nbrContactTel = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.telephone IS NOT' => NULL])
                                            ->notEq('Contacts.telephone', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            if($nbrContact){
                $this->loadModel('EmailEnvois');
                $emailEnvoi = $this->EmailEnvois->find()
                                                        ->where(['evenement_id' => $idEvenement])
                                                        ->first();
                if(!empty($emailEnvoi)){
                    $nbrEmailEnvoye = $emailEnvoi->total_envoi;
                    $nbrEmailOuvert = $emailEnvoi->total_ouvert;
                }
                
                $this->loadModel('SmsEnvois');                                   
                $smsEnvoi = $this->SmsEnvois->find()
                                        ->where(['evenement_id' => $idEvenement])
                                        ->first();
                if(!empty($smsEnvoi)){
                    $nbrSmsEnvoye = $smsEnvoi->total_envoi;
                    $nbrSmsOuvert = $smsEnvoi->total_ouvert;
                }
            }
            
            $nbrTelechargementPhoto = $this->Evenements->Photos->PhotoDownloads->find()
                                                        ->where(['PhotoDownloads.photo_id IN' => $idPhotos])
                                                        ->count();
            
            $nbrPageVue = $this->Evenements->Photos->PhotoVues->find()
                                                    ->where(['PhotoVues.photo_id IN' => $idPhotos])
                                                    //->distinct(['PhotoVues.photo_id'])
                                                    ->count();
                                                    
                                                    
            /** Stat sms **/
            $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                        ->toArray();
            $nbrContactSms = count($listContactSms);
            $idEnvoiSms = null;
            if(!empty($nbrContactSms)){
                $idEnvoiSms = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find('list')
                                                        ->where(['contact_id IN' => $listContactSms])
                                                        ->toArray();
                $nbrSmsEnvoye = count($idEnvoiSms);
            } 
            
            // Vérifier si la table SmsStatistique existe
			$connection = ConnectionManager::get('default');
			$liste_tables = $connection->getSchemaCollection()->listTables();
			
			if(!empty($idEnvoiSms) && (in_array('sms_stats', $liste_tables) || in_array('sms_statistiques', $liste_tables))){
                $this->loadModel('SmsStatistiques');
                $smsDelivery= $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 1])
                                    ->count();
                                    
                
                $smsNotDelivery = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 2])
                                    ->count();
                
                $smsUnKnow = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 0])
                                    ->count();   
            }
            
            if(!empty($nbrSmsEnvoye)){
                    if(!empty($smsDelivery)){
                        $smsDeliveryPercent = round($smsDelivery/$nbrSmsEnvoye*100);
                    }
                    if(!empty($smsNotDelivery)){
                        $smsNotDeliveryPercent = round($smsNotDelivery/$nbrSmsEnvoye*100);
                    }
                    if(!empty($smsUnKnow)){
                        $smsUnKnowPercent = round($smsUnKnow/$nbrSmsEnvoye*100);
                    }
            }
            
        }
        
        $this->loadModel('EvenementStatCampaigns');
        $eventStatCampaign = $this->EvenementStatCampaigns->find()
                                            ->where(['evenement_id' => $evenement->id])
                                            ->first();
                                            
        /***/
        $this->loadModel('Timelines');
        $timeline = $this->Timelines->find()
                                ->order(['date_timeline' => 'DESC'])
                                ->where(['date_timeline <>'=>'','date_timeline IS NOT' =>NULL])
                                ->where(['evenement_id' => $idEvenement])
                                ->first();
        $this->loadmodel('Photos');
        $photoEnAttenteValidation = $this->Photos->find()
                                            ->where(['evenement_id' => $idEvenement,'is_validate' => false,'Photos.deleted' => 0, 'Photos.is_in_corbeille' => 0])
                                            ->count();
        $this->set(compact('photoEnAttenteValidation'));
        $this->set('isConfiguration',false);
        $this->set(compact('nbrTelechargementPhoto','nbrSmsOuvert','nbrEmailOuvert','nbrPageVue'));
        $this->set(compact('evenement','nbrPhoto','nbrContact','nbrEmailEnvoye','nbrSmsEnvoye','idEvenement','nbrContactEmail','nbrContactTel'));
        $this->set(compact('eventStatCampaign'));
        $this->set(compact('smsDeliveryPercent','smsNotDeliveryPercent'));
        $this->set(compact('timeline'));
    }
    
	
	/*
	 * Début
	 * Projet : Génération rendu pdf stats
	 * url : https://trello.com/c/WqnTaK0S/325-g%C3%A9n%C3%A9rer-un-rapport-pdf-de-stats-campagne-client-marketing
	 * url : https://trello.com/c/Cz0HBY7I/161-mettre-en-place-lapi-de-detection-des-visages-pour-avoir-les-stats-sur-le-nombre-de-personnes-de-sourire-ages-etc
	 * date de modification : 06-fév-2019
	 * 
	 * author: Paul
	 */
	
	public function png(){
		$points = [];
		if(count($this -> request -> params) && isset($this -> request -> params['points']))
			$points = $this -> request -> params['points'];
		$this -> set(compact('points'));
	}
	
	public function statistique($str_idEvenement = '', $nom='fichier.pdf'){
		$this->loadComponent('Utilities');
		$data_tp = @unserialize($this->Utilities->slDecryption($str_idEvenement));
		$idEvenement = null;
		$redirect = false;
		if(false){
			// Rédirection
			$redirect = true;
		}else{
			$idEvenement = $data_tp['idEvenement'];
		}
		
		if($idEvenement){
			
		}else{
			return $this->redirect(['action' => 'index']);
			exit;
		}
		
		$this->viewBuilder()
			->className('Dompdf.Pdf')
			->layout('Dompdf.default')
			->options(['config' => [
				'filename' => $idEvenement,
				'render' => 'browser',
				'size' => 'A4',
				'orientation' => 'landscape'
		]]);
		
		$evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Photos' => ['PhotoStatistiques'],'Crons','FacebookAutos'=>['FacebookAutoSuivis'],'Galeries']
        ]);
		
		// Nombre de photos
		$nbrPhoto = count($evenement->photos);
		// Nombre d'impression effectuée.
		$nbrImp = $evenement->print_counter ? $evenement->print_counter : '-';
		$nbrContact = 
        $nbrContactEmail = 
        $nbrContactTel = 
        $nbrEmailEnvoye = 
        $nbrEmailOuvert = 
        $nbrSmsOuvert = '-';
        $nbrSmsEnvoye = 0;
        $nbrTelechargementPhoto = 0;
        $nbrPageVue = 0;
		
		// Statistique démographie
		// Age
		$nbrPersonnes = 
		$nbrMoins20 = 
		$nbr20_30 = 
		$nbr30_40 = 
		$nbr40_60 = 
		$nbrPlus60 = 
		$age_moyen =
		
		//Emotion
		$nbrSourire = 
		$nbrNeutre = 
		$nbrColere = 
		$nbrPeur = 
		$nbrSurpris = 
		$nbrTriste = 
		
		// Sexe
		$nbrHommes = 
		$nbrFemmes = 0;
		
		
		$hommePourcent = 
		$femmePourcent = 
		
		$moins_20Pourcent = 
		$v_tPourcent = 
		$t_qPourcent = 
		$q_sPourcent = 
		$plus_60Pourcent = 
		
		$sourirePourcent = 
		$neutrePourcent = 
		$colerePourcent = 
		$peurPourcent = 
		$surprisPourcent = 
		$tristePourcent = 0;
		
		
		$smsDelivery = 
		$smsNotDelivery  = 
		$smsClicked  = '-';
		$smsClickedPourcent = 
        $smsDeliveryPercent = 
        $smsNotDeliveryPercent = 0;
		
		
		$total = 0;
		$delivredPourcent = 0;
		$ouvertPourcent = 0;
		$clickPourcent = 0;
		$blockedPourcent = 0;
		$spamPourcent = 0;
		$hardBouncePourcent = 0;
		$softBouncePourcent = 0;
		$messageDeferredPourcent = 0;
		$messageUnsubscribedPourcent = 0;
		$messageSentCount = "-";
		$messageOpenedCount  = "-";
		$messageClickedCount = 0;
		$boucePourcent = 0;
		
		
		// initialisation variable
		$txt_rec_ouv_mail = 
		$txt_ouv_clic_mail = '--:--:--';
		$nbrMoyenneDouverture = '-';
		
		// Top domaine
		$topDomaine = [];
		
		$buffer = '';
		
		$img = '<img src="'.WWW_ROOT.'/img/logo.png" alt="Logo Selfizee" style="width: 60%;">';
		
		$entete = ''.
		'<div style="clear:both;">'.
			'<div style="width:50%;display:inline-block;"><img src="'.WWW_ROOT.'/img/logo.png" alt="Logo Selfizee" style="width: 400px;"/></div>'.
			'<div style="width:50%;display:inline-block;text-align:right;"><h2>'.$evenement->nom.'</h2></div>'.
		'</div>';
		
        if($nbrPhoto){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
			
            $contactList = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos])
                                                        ->toArray();
                                                        
            $nbrContact = count($contactList);
            
            
            $nbrContactEmail = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $nbrContactTel = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.telephone IS NOT' => NULL])
                                            ->notEq('Contacts.telephone', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
			
			/*
			 * Système avant pour récuperer le nombre des sms envoyés
			 */
			if($nbrContact && false){
                $this->loadModel('EmailEnvois');
                $emailEnvoi = $this->EmailEnvois->find()
                                                        ->where(['evenement_id' => $idEvenement])
                                                        ->first();
                if(!empty($emailEnvoi)){
                    $nbrEmailEnvoye = $emailEnvoi->total_envoi;
                    $nbrEmailOuvert = $emailEnvoi->total_ouvert;
                }
                
                $this->loadModel('SmsEnvois');                                   
                $smsEnvoi = $this->SmsEnvois->find()
                                        ->where(['evenement_id' => $idEvenement])
                                        ->first();
                if(!empty($smsEnvoi)){
                    $nbrSmsEnvoye = $smsEnvoi->total_envoi;
                    $nbrSmsOuvert = $smsEnvoi->total_ouvert;
                }
            }
			
			// Récupération nombre sms envoyé pareil comme dans statistique sms :: RENDU PDF
            $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                        ->toArray();
            $nbrContactSms = count($listContactSms);
            $idEnvoiSms = null;
            if(!empty($nbrContactSms)){
                $idEnvoiSms = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find('list')
                                                        ->where(['contact_id IN' => $listContactSms])
                                                        ->toArray();
                $nbrSmsEnvoye = count($idEnvoiSms);
            }
			// Vérifier si la table SmsStatistique existe
			$connection = ConnectionManager::get('default');
			$liste_tables = $connection->getSchemaCollection()->listTables();
			
			if(!empty($idEnvoiSms) && (in_array('sms_stats', $liste_tables) || in_array('sms_statistiques', $liste_tables))){
                $this->loadModel('SmsStatistiques');
                $smsDelivery= $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 1])
                                    ->count();
                                    
                
                $smsNotDelivery = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 2])
                                    ->count();
                
                $smsUnKnow = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 0])
                                    ->count();  
                                    
                $smsClicked = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 3])
                                    ->count();  
            }
            
            if(!empty($nbrSmsEnvoye) && $nbrSmsEnvoye){
                    if(!empty($smsDelivery)){
                        $smsDeliveryPercent = round($smsDelivery/$nbrSmsEnvoye*100);
                    }
                    if(!empty($smsNotDelivery)){
                        $smsNotDeliveryPercent = round($smsNotDelivery/$nbrSmsEnvoye*100);
                    }
                    if(!empty($smsUnKnow)){
                        $smsUnKnowPercent = round($smsUnKnow/$nbrSmsEnvoye*100);
                    }
                    
                    if(!empty($smsClicked)){
                        $smsClickedPourcent = round($smsClicked/$nbrSmsEnvoye*100);
                    }
            }
			// Fin récupération stat sms
			
			// Information statistique démographie
			if(!empty($evenement->photos)){
				foreach($evenement->photos as $item){
					if(!empty($item->photo_statistique)){
						$nbrHommes += $item->photo_statistique->nb_homme;
						$nbrFemmes += $item->photo_statistique->nb_femme;
						$nbrMoins20 += $item->photo_statistique->moins_20;
						$nbr20_30 += $item->photo_statistique->a_20_30;
						$nbr30_40 += $item->photo_statistique->a_30_40;
						$nbr40_60 += $item->photo_statistique->a_40_60;
						$nbrPlus60 += $item->photo_statistique->plus_60;
						$age_moyen += $item->photo_statistique->age_total;
						
						$nbrSourire += $item->photo_statistique->nb_sourire;
						$nbrNeutre += $item->photo_statistique->nb_neutre;
						$nbrColere += $item->photo_statistique->nb_colere;
						$nbrPeur += $item->photo_statistique->nb_peur;
						$nbrSurpris += $item->photo_statistique->nb_surpris;
						$nbrTriste += $item->photo_statistique->nb_triste;
					}
				}
			}
			
			if($nbrHommes || $nbrFemmes){
				$nbrPersonnes = $nbrHommes + $nbrFemmes;
				$hommePourcent = $nbrHommes * 100 / $nbrPersonnes;
				$hommePourcent = round($hommePourcent, 0);
				$femmePourcent = $nbrFemmes * 100 / $nbrPersonnes;
				$femmePourcent = round($femmePourcent, 0);
				
				$age_moyen = $age_moyen / $nbrPersonnes;
				$age_moyen = round($age_moyen, 0);
				
				$moins_20Pourcent = $nbrMoins20 * 100 / $nbrPersonnes;
				$moins_20Pourcent = round($moins_20Pourcent, 0);
				$v_tPourcent = $nbr20_30 * 100 / $nbrPersonnes;
				$v_tPourcent = round($v_tPourcent, 0);
				$t_qPourcent = $nbr30_40 * 100 / $nbrPersonnes;
				$t_qPourcent = round($t_qPourcent, 0);
				$q_sPourcent = $nbr40_60 * 100 / $nbrPersonnes;
				$q_sPourcent = round($q_sPourcent, 0);
				$plus_60Pourcent = $nbrPlus60 * 100 / $nbrPersonnes;
				$plus_60Pourcent = round($plus_60Pourcent, 0);
				
				$totalSentiment = $nbrSourire + $nbrNeutre + $nbrColere + $nbrPeur + $nbrSurpris + $nbrTriste;
				$sourirePourcent = $nbrSourire * 100 / $totalSentiment;
				$sourirePourcent = round($sourirePourcent, 0);
				$neutrePourcent = $nbrNeutre * 100 / $totalSentiment;
				$neutrePourcent = round($neutrePourcent, 0);
				$colerePourcent = $nbrColere * 100 / $totalSentiment;
				$colerePourcent = round($colerePourcent, 0);
				$peurPourcent = $nbrPeur * 100 / $totalSentiment;
				$peurPourcent = round($peurPourcent, 0);
				$surprisPourcent = $nbrSurpris * 100 / $totalSentiment;
				$surprisPourcent = round($surprisPourcent, 0);
				$tristePourcent = $nbrTriste * 100 / $totalSentiment;
				$tristePourcent = round($tristePourcent, 0);
			}
			
			// début Top domaine
			$listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
                                                        
            $nbrContactEmail_tmp = count($listContactEmail);
            
            if(!empty($nbrContactEmail_tmp) && $nbrContactEmail_tmp){
				$listeContactWhoHasEmail =  $this->Evenements->Photos->Contacts->find('all')
															->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>'']);
			
				$topDomaine = $listeContactWhoHasEmail->select([
									'domaine' => $listeContactWhoHasEmail->func()->substring_index([
															'Contacts.email' => 'literal' ,
															'@',
															-1 => 'literal'
														]),
														
									'email_count' => $listeContactWhoHasEmail->func()->count('*'),
									
									
							   ])
							  ->where(['Contacts.id IN' => $listContactEmail])
							   ->group('domaine')
							   ->order(['email_count' => 'DESC'])
							   ->limit(5);
			}
			// fin top domaine
			
		}else{
			$nbrPhoto = '-';
		}
		$color_theme = '#f10f5e';
		$color_gris = 'color:#555;';
		
		$this->loadModel('EvenementStatCampaigns');
        $eventStatCampaign = $this->EvenementStatCampaigns->find()
                                            ->where(['evenement_id' => $evenement->id])
                                            ->first();
		if(!empty($eventStatCampaign)){
			$total = $eventStatCampaign->total;
			$messageSentCount = $eventStatCampaign->message_sent_count;
			$messageOpenedCount = $eventStatCampaign->message_opened_count;
			$messageClickedCount = $eventStatCampaign->message_clicked_count;
			$messageBlockedCount = $eventStatCampaign->message_blocked_count;
			$messageSpamCount = $eventStatCampaign->message_spam_count;
			$messageHardBouncedCount  = $eventStatCampaign->message_hard_bounced_count ;
			$messageSoftBouncedCount = $eventStatCampaign->message_soft_bounced_count;
			$messageDeferredCount = $eventStatCampaign->message_deferred_count;
			$messageUnsubscribedCount = $eventStatCampaign->event_unsubscribed_count;
			
			if(!empty($total) && $total){
				$delivredPourcent = ($messageSentCount*100) / $total;
				// $delivredPourcent = round($delivredPourcent, 2);
				$delivredPourcent = round($delivredPourcent, 0);
				
				$blockedPourcent = ($messageBlockedCount*100) / $total;
				// $blockedPourcent = round($blockedPourcent, 2);
				$blockedPourcent = round($blockedPourcent, 0);
				
				$hardBouncePourcent = ($messageHardBouncedCount*100)/$total; 
				// $hardBouncePourcent = round($hardBouncePourcent, 2);
				$hardBouncePourcent = round($hardBouncePourcent, 0);
				
				$softBouncePourcent = ($messageSoftBouncedCount*100) /$total;
				// $softBouncePourcent = round($softBouncePourcent, 2);
				$softBouncePourcent = round($softBouncePourcent, 0);
				
				$bouceCount = $messageHardBouncedCount + $messageSoftBouncedCount;
				$boucePourcent = ($bouceCount*100)/$total;
				// $boucePourcent = round($boucePourcent, 2);
				$boucePourcent = round($boucePourcent, 0);
				
				$messageDeferredPourcent = ($messageDeferredCount*100) / $total;
				// $messageDeferredPourcent = round($messageDeferredPourcent, 2);
				$messageDeferredPourcent = round($messageDeferredPourcent, 0);
				
				if(!empty($messageSentCount) && $messageSentCount){
					$ouvertPourcent = ($messageOpenedCount*100)/ $messageSentCount;
					// $ouvertPourcent = round($ouvertPourcent, 2);
					$ouvertPourcent = round($ouvertPourcent, 0);
					
					$messageUnsubscribedPourcent = ($messageUnsubscribedCount *100) / $messageSentCount;
					// $messageUnsubscribedPourcent = round($messageUnsubscribedPourcent, 2);
					$messageUnsubscribedPourcent = round($messageUnsubscribedPourcent, 0);
					
					$spamPourcent = ($messageSpamCount*100)/ $messageSentCount;
					// $spamPourcent = round($spamPourcent, 2);
					$spamPourcent = round($spamPourcent, 0);
				}
				
				if(!empty($messageOpenedCount) && $messageOpenedCount){
					$clickPourcent = ($messageClickedCount*100) / $messageOpenedCount;
					// $clickPourcent = round($clickPourcent, 2);
					$clickPourcent = round($clickPourcent, 0);
					// Nombre moyenne d'ouverture mail
					$nbrMoyenneDouverture = $messageSentCount / $messageOpenedCount;
					$nbrMoyenneDouverture = round($nbrMoyenneDouverture, 2);
				} 
				
			}
			
			// reception et ouverture mail
			$openClick = $eventStatCampaign->event_open_delay;
			if(!empty($openClick)){
				$txt_rec_ouv_mail = date("h:i\':s\'\'",$openClick);
			}
			// fin reception et ouverture mail
			
			// ouverture et click mail
			$moyenClick = $eventStatCampaign->event_click_delay;
			if(!empty($moyenClick)){
				$txt_ouv_clic_mail = date("h:i\':s\'\'",$moyenClick);
			}
			// fin reception et ouverture mail
			
		}
		
		$moins_20Pourcent_ = $moins_20Pourcent;
		$v_tPourcent_ = $v_tPourcent;
		$t_qPourcent_ = $t_qPourcent;
		$q_sPourcent_ = $q_sPourcent;
		$plus_60Pourcent_ = $plus_60Pourcent;
		
		if($moins_20Pourcent == 0){
			$moins_20Pourcent_ = 0.2;
		}
		if($v_tPourcent == 0){
			$v_tPourcent_ = 0.2;
		}
		if($t_qPourcent == 0){
			$t_qPourcent_ = 0.2;
		}
		if($q_sPourcent == 0){
			$q_sPourcent_ = 0.2;
		}
		if($plus_60Pourcent == 0){
			$plus_60Pourcent_ = 0.2;
		}
		
		// Création image chart
		$points = [$moins_20Pourcent_, $v_tPourcent_, $t_qPourcent_, $q_sPourcent_, $plus_60Pourcent_];
		// Envoie de tous les paramètres dans la génération des images pour le pdf
		$this -> requestAction('/evenements/png', ['points'=> $points, 'return']);
		
		
		$txt_topDomaine = '';
		$i = 1;
		if(!empty($topDomaine)){
			foreach($topDomaine as $domaine){
				if(!empty($domaine->domaine) && trim($domaine->domaine)){
					$txt_topDomaine .= '<li>'.$i.' '.h($domaine->domaine).'</li>';
					$i++;
					if($i == 8)
						break;
				}
			}
		}
		
		$entete = ''.
			'<h4 class="entete">'.$evenement->nom.'</h4>';
		
		
		$d_modif = !empty($evenement->modified) ? '<span class="gris" style="display:inline-block;position:absolute;right: 18px;font-size: 26px;margin-top:25px;">Date de dernière mise à jour : '.$evenement->modified->format('d/m/Y à H').'h'.$evenement->modified->format('i').'</span>' : '';
		$d_modif_1 = !empty($evenement->modified) ? '<span class="gris" style="font-size: 26px;margin-top:25px;">Date de dernière mise à jour : '.$evenement->modified->format('d/m/Y à H').'h'.$evenement->modified->format('i').'</span>' : '';
		
		// Longueur par défaut du progrèss bar
		$cpc = 278;
		// Progress pour delivres, ouverts, cliques
		$w_d = floatval($delivredPourcent) ? intval(($delivredPourcent * $cpc)/100) : 2;
		$w_o = floatval($ouvertPourcent) ? intval(($ouvertPourcent * $cpc)/100) : 2;
		$w_c = floatval($clickPourcent) ? intval(($clickPourcent * $cpc)/100) : 2;
		
		
		// Contenu de l'email
		$emails = '';
		if($total){
			$emails = ''.
			'<div style="page-break-before: always;"></div>'.
			$entete.
			'<h2 class="sous-entete">[ Stats e-mails ]</h2>'.
			'<p class="paragraphe">Données relatives à l\'envoi des photos par e-mail.</p>'.
			'<div class="full padding">'.
				'<div class="sf-email-bloc-0 sf-email-bloc-total">'.
					'<p class="text-center" style="padding-top:16px;">'.
						'<span style="font-size:70px;font-weight:bold;">'.$total.'</span><br/>'.
						'<strong>e-mails</strong>'.
					'</p>'.
					'<p style="margin-top: 10px;text-align:center;" class="txt-gris">TOTAL</p>'.
				'</div>'.
				'<div class="sf-email-bloc-0">'.
					'<p class="full text-center" style="padding:16px 20px 0 20px;">'.
						'<span class="sf-email-bloc-pc-1">'.$delivredPourcent.'%</span>'.
						'<span class="sf-email-bloc-pc-2">'.$messageSentCount.'</span>'.
						'<div class="progress">'.
							'<div style="background-color:#E72763;width:'.$w_d.'px;height:30px;"></div>'.
						'</div>'.
					'</p>'.
					'<p style="margin-top: 37px;text-align:center;text-transform:uppercase;" class="txt-gris">Délivrés</p>'.
				'</div>'.
				'<div class="sf-email-bloc-0">'.
					'<p class="full text-center" style="padding:16px 20px 0 20px;">'.
						'<span class="sf-email-bloc-pc-1">'.$ouvertPourcent.'%</span>'.
						'<span class="sf-email-bloc-pc-2">'.$messageOpenedCount.'</span>'.
						'<div class="progress">'.
							'<div style="background-color:#E72763;width:'.$w_o.'px;height:30px;"></div>'.
						'</div>'.
					'</p>'.
					'<p style="margin-top: 37px;text-align:center;text-transform:uppercase;" class="txt-gris">Ouverts</p>'.
				'</div>'.
				'<div class="sf-email-bloc-0">'.
					'<p class="full text-center" style="padding:16px 20px 0 20px;">'.
						'<span class="sf-email-bloc-pc-1">'.$clickPourcent.'%</span>'.
						'<span class="sf-email-bloc-pc-2">'.$messageClickedCount.'</span>'.
						'<div class="progress">'.
							'<div style="background-color:#E72763;width:'.$w_c.'px;height:30px;"></div>'.
						'</div>'.
					'</p>'.
					'<p style="margin-top: 37px;text-align:center;text-transform:uppercase;" class="txt-gris">Cliqués</p>'.
				'</div>'.
				'<div class="sf-email-bloc-1">'.
					'<div class="sf-bloc-0-enfant" style="margin-top: 50px;margin-bottom:4px;">'.
						'<div class="enfant-1" style="width:64%;">Bloqués</div><div class="enfant-1" style="width:30%;">'.$blockedPourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:64%;">Spam</div><div class="enfant-1" style="width:30%;">'.$spamPourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:64%;">Erreur permanente</div><div class="enfant-1" style="width:30%;">'.$hardBouncePourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:64%;">Erreur temporaire</div><div class="enfant-1" style="width:30%;">'.$softBouncePourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:64%;">Renvoi</div><div class="enfant-1" style="width:30%;">'.$messageDeferredPourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:64%;">Désabonné</div><div class="enfant-1" style="width:30%;">'.$messageUnsubscribedPourcent.'%</div>'.
					'</div>'.
				'</div>'.
			'</div>'.
			'<div class="full text-center txt-gris" style="margin-top: 80px;">'.
				'<div class="sf-email-bloc-2">'.
					'<p class="text-center" style="font-size:48px;">'.$txt_rec_ouv_mail.'</p>'.
					'<div class="text-center">'.
						'<p style="font-size:24px;">Temps moyen entre la réception <br/>et l\'ouverture de l\'email</p>'.
					'</div>'.
				'</div>'.
				'<div class="sf-email-bloc-2" style="border-left:solid 8px #ECECEC;border-right:solid 8px #ECECEC;">'.
					'<p class="text-center" style="font-size:48px;">'.$txt_ouv_clic_mail.'</p>'.
					'<div class="text-center">'.
						'<p style="font-size:24px;">Temps moyen entre l\'ouverture <br/>et le clic dans l\'email</p>'.
					'</div>'.
				'</div>'.
				'<div class="sf-email-bloc-2">'.
					'<p class="text-center" style="font-size:48px;">'.$nbrMoyenneDouverture.'</p>'.
					'<div class="text-center">'.
						'<p style="font-size:24px;">Nombre moyen d\'ouvertures <br/>par e-mail envoyé</p>'.
					'</div>'.
				'</div>'.
			'</div>'.
			'<div class="bottom-0">'.
				'<img src="'.WWW_ROOT.'/img/logo.png">'.
				$d_modif.
			'</div>';
		}
		
		// Longuer par défaut du progrèss bar
		$cpc = 278;
		// Progress pour delivres, ouverts, cliques
		$s_d = floatval($smsDeliveryPercent) ? intval(($smsDeliveryPercent * $cpc)/100) : 2;
		$s_o = floatval($smsNotDeliveryPercent) ? intval(($smsNotDeliveryPercent * $cpc)/100) : 2;
		$s_c = floatval($smsClickedPourcent) ? intval(($smsClickedPourcent * $cpc)/100) : 2;
		// Sms
		$sms = '';
		if($nbrSmsEnvoye > 0){
			$sms = ''.
			'<div style="page-break-before: always;"></div>'.
			$entete.
			'<h2 class="sous-entete">[ Stats sms ]</h2>'.
			'<p class="paragraphe">Données relatives à l\'envoi de sms.</p>'.
			'<div class="full padding sf-sms-bloc">'.
				'<div class="sf-email-bloc-0 sf-email-bloc-total">'.
					'<p class="text-center" style="padding-top:16px;">'.
						'<span style="font-size:70px;font-weight:bold;">'.$nbrSmsEnvoye.'</span><br/>'.
						'<strong>sms</strong>'.
					'</p>'.
					'<p style="margin-top: 10px;text-align:center;" class="txt-gris">TOTAL</p>'.
				'</div>'.
				'<div class="sf-email-bloc-0">'.
					'<p class="full text-center" style="padding:16px 20px 0 20px;">'.
						'<span class="sf-email-bloc-pc-1">'.$smsDeliveryPercent.'%</span>'.
						'<span class="sf-email-bloc-pc-2">'.$smsDelivery.'</span>'.
						'<div class="progress">'.
							'<div style="background-color:#E72763;width:'.$s_d.'px;height:30px;"></div>'.
						'</div>'.
					'</p>'.
					'<p style="margin-top: 37px;text-align:center;text-transform:uppercase;" class="txt-gris">Délivrés</p>'.
				'</div>'.
				'<div class="sf-email-bloc-0">'.
					'<p class="full text-center" style="padding:16px 20px 0 20px;">'.
						'<span class="sf-email-bloc-pc-1">'.$smsNotDeliveryPercent.'%</span>'.
						'<span class="sf-email-bloc-pc-2">'.$smsNotDelivery.'</span>'.
						'<div class="progress">'.
							'<div style="background-color:#E72763;width:'.$s_o.'px;height:30px;"></div>'.
						'</div>'.
					'</p>'.
					'<p style="margin-top: 37px;text-align:center;text-transform:uppercase;" class="txt-gris">Non délivrés</p>'.
				'</div>'.
				'<div class="sf-email-bloc-0">'.
					'<p class="full text-center" style="padding:16px 20px 0 20px;">'.
						'<span class="sf-email-bloc-pc-1">'.$smsClickedPourcent.'%</span>'.
						'<span class="sf-email-bloc-pc-2">'.$smsClicked.'</span>'.
						'<div class="progress">'.
							'<div style="background-color:#E72763;width:'.$s_c.'px;height:30px;"></div>'.
						'</div>'.
					'</p>'.
					'<p style="margin-top: 37px;text-align:center;text-transform:uppercase;" class="txt-gris">Cliqués</p>'.
				'</div>'.
			'</div>'.
			'<div class="bottom-0">'.
				'<img src="'.WWW_ROOT.'/img/logo.png">'.
				$d_modif.
			'</div>';
		}
		// détection de visage
		$visage = '';
		$cpc1 = 540;
		$d_h = floatval($hommePourcent) ? intval(($hommePourcent * $cpc1)/100) : 2;
		$d_f = floatval($femmePourcent) ? intval(($femmePourcent * $cpc1)/100) : 2;
		if($nbrHommes || $nbrFemmes){
			$visage = ''.
			'<div style="page-break-before: always;"></div>'.
			$entete.
			'<h2 class="sous-entete">[ Démographie ]</h2>'.
			'<p class="paragraphe">Informations population des utilisateurs de la borne photo.</p>'.
			
			'<div class="full padding sf-demo-bloc">'.
				'<div class="sf-inline-block sf-demo-bloc-0">'.
					'<p class="text-center">'.
						'<span style="font-size:70px;font-weight:bold;">'.$nbrPersonnes.'</span><br/>'.
						'<strong>Personne'.($nbrPersonnes > 1 ? 's' : '').'</strong><br/>'.
						'<span style="text-align:center;font-size: 25px;">sur les photos</span>'.
					'</p>'.
				'</div>'.
				
				'<div class="sf-inline-block sf-demo-bloc-0">'.
					'<div class="sf-inline-block text-right" style="width: 50%;margin-top:40px;padding-right: 35px;">'.
						'<img src="'.WWW_ROOT.'img/icon/man.png" style="width: 120px;">'.
					'</div>'.
					'<div class="sf-inline-block" style="width: 50%;margin-top: 25px;">'.
						'<strong style="font-size: 42px;">'.$hommePourcent.'%</strong><br/>'.
						'<span style="text-align:center;font-size: 22px;">HOMMES</span>'.
					'</div>'.
				'</div>'.
				
				'<div class="sf-inline-block sf-demo-bloc-0">'.
					'<div class="sf-inline-block text-right" style="width: 50%;margin-top:40px;padding-right: 35px;">'.
						'<img src="'.WWW_ROOT.'img/icon/woman.png" style="width: 120px;">'.
					'</div>'.
					'<div class="sf-inline-block" style="width: 50%;margin-top: 25px;">'.
						'<strong style="font-size: 42px;">'.$femmePourcent.'%</strong><br/>'.
						'<span style="text-align:center;font-size: 22px;">FEMMES</span>'.
					'</div>'.
				'</div>'.
				
				'<div class="sf-inline-block sf-demo-bloc-1">'.
					'<div>'.
						'<div class="sf-inline-block text-right sf-bloc-sexe">H</div>'.
						'<div class="sf-inline-block text-right sf-bloc-sexe-prog" style="width: '.$cpc1.'px;">'.
							'<div class="progress1">'.
								'<div style="background-color:#E72763;width:'.$d_h.'px;height:52px;"></div>'.
							'</div>'.
						'</div>'.
					'</div>'.
					'<div style="margin-top:-106px;">'.
						'<div class="sf-inline-block text-right sf-bloc-sexe">F</div>'.
						'<div class="sf-inline-block text-right sf-bloc-sexe-prog" style="width: '.$cpc1.'px;">'.
							'<div class="progress1">'.
								'<div style="background-color:#E72763;width:'.$d_f.'px;height:52px;"></div>'.
							'</div>'.
						'</div>'.
					'</div>'.
				'</div>'.
				
			'</div>'.
			
			
			'<div class="full padding" style="margin-top:40px;">'.
				'<div class="sf-inline-block" style="width:340px;padding-right: 110px;margin-top:-30px;">'.
					'<ul class="text-right gris liste">'.
						'<li class="li-1">- 20 ans ('.$moins_20Pourcent.'%)</li>'.
						'<li class="li-2">20 - 30 ans ('.$v_tPourcent.'%)</li>'.
						'<li class="li-3">30 - 40 ans ('.$t_qPourcent.'%)</li>'.
						'<li class="li-4">40 - 60 ans ('.$q_sPourcent.'%)</li>'.
						'<li class="li-5">+ 60 ans ('.$plus_60Pourcent.'%)</li>'.
					'</ul>'.
				'</div>'.
				'<div class="sf-inline-block" style="width:890px;">'.
					'<div class="sf-inline-block text-center;" style="width:490px;">'.
						'<img src="'.WWW_ROOT.'/transparent.png" style="width:650px;">'.
					'</div>'.
					'<div class="sf-inline-block text-center" style="width:400px;position:absolute;margin-top:80px;">'.
						'<span style="font-size:50px;">'.$age_moyen.' ans</span><br/>'.
						'<span style=""><span style="text-transform:uppercase;">â</span>ge moyen estimé</span>'.
					'</div>'.
				'</div>'.
				'<div class="sf-inline-block" style="border-left:solid 8px #ECECEC;">'.
					'<ul class="liste1">'.
						'<li><img src="'.WWW_ROOT.'/img/icon/sourire.png">'.$sourirePourcent.'% sourires</li>'.
						'<li><img src="'.WWW_ROOT.'/img/icon/neutre.png" style="width: 40px;">'.$neutrePourcent.'% neutres</li>'.
						'<li><img src="'.WWW_ROOT.'/img/icon/colere.png" style="width: 40px;">'.$colerePourcent.'% colères</li>'.
						'<li><img src="'.WWW_ROOT.'/img/icon/surpris.png" style="width: 40px;">'.$surprisPourcent.'% surpris</li>'.
						'<li><img src="'.WWW_ROOT.'/img/icon/triste.png" style="width: 40px;">'.$tristePourcent.'% triste</li>'.
						'<li><img src="'.WWW_ROOT.'/img/icon/peur.png" style="width: 40px;">'.$peurPourcent.'% peurs</li>'.
					'</ul>'.
				'</div>'.
			'</div>'.
			
			
			'<div class="bottom-0">'.
				'<img src="'.WWW_ROOT.'/img/logo.png">'.
				$d_modif.
			'</div>';
		}
		
		$TexteOptin = '';
		if($idEvenement == 2403){
			$TexteOptin = '10 Opt-in commerciaux ';
		}
		
		// Contenu statistique global
		$global = ''.
		$entete.
		'<h2 class="sous-entete">[ Stats globales ]</h2>'.
		'<p class="paragraphe">Vue d\'ensemble de votre événement :</p>'.
		'<div class="full padding" style="margin-top: 260px;">'.
			'<div class="text-center sf-global">'.
				'<img src="'.WWW_ROOT.'/img/icon/polaroid.png" style="width: 230px;"><br/>'.
				'<p class="sf-nb-detail">'.$nbrPhoto.'</p>'.
				'<h2 class="gris" style="margin-top:-50px;">photo'.($nbrPhoto > 1 ? 's' : '').'</h2>'.
				'<span style="color:white;font-size:26px;">-</span>'.
			'</div>'.
			'<div class="text-center sf-global sf-global-mil">'.
				'<img src="'.WWW_ROOT.'/img/icon/printer.png" style="width: 230px;"><br/>'.
				'<p class="sf-nb-detail">'.$nbrImp.'</p>'.
				'<h2 class="gris" style="margin-top:-50px;">impression'.($nbrImp > 1 ? 's' : '').'</h2>'.
				'<span style="color:white;font-size:26px;">-</span>'.
			'</div>'.
			'<div class="text-center sf-global">'.
				'<img src="'.WWW_ROOT.'/img/icon/database.png" style="width: 230px;"><br/>'.
				'<p class="sf-nb-detail">'.$nbrContact.'</p>'.
				'<h2 class="gris" style="margin-top:-50px;">contact'.($nbrContact > 1 ? 's' : '').' collecté'.($nbrContact > 1 ? 's' : '').'</h2>'.
				'<span style="font-size:26px;">'.$TexteOptin.'</span>'.				
			'</div>'.
		'</div>'.
		'<div class="bottom-0">'.
			'<img src="'.WWW_ROOT.'/img/logo.png">'.
			$d_modif.
		'</div>';
		
		// Rendu final
		$buffer1 = ''.
		'<section class="bloc-0">'.
			'<div class="bloc-0-1">'.
				'<div class="titre text-center"><h1 class="text-center">'.$evenement->nom.'</h1></div>'.
			'</div>'.
			'<div class="bloc-0-2 text-center">'.
				'<h2 class="gris">[ Rapport de stats événement ]</h2>'.
				'<p class="gris"><strong>'.(!empty($evenement->date_debut) ? $evenement->date_debut->format('d/m/Y') : '').'</strong></p>'.
				'<p>'.$d_modif_1.'</p>'.
				'<div class="bottom"><img src="'.WWW_ROOT.'/img/logo.png"></div>'.
			'</div>'.
		'</section>'.
		'<div style="page-break-before: always;"></div>'.
		$global.
		$emails.
		$sms.
		$visage;
		
		
		
		$contenu = $buffer1;
		$this->set(compact('contenu'));
	}
	
	public function simulation($id_evenement = 0){
		if(intval($id_evenement) == 0)
			exit;
		// exit;
		$this->loadModel('Photos');
		$this->loadModel('PhotoStatistiques');
		$photos_pro = $this -> Photos -> find('all')
			->where([
				'Photos.is_stat_traite' => false,
				'Clients.client_type' => 'corporation',
				'Photos.is_validate' => true,
				'Photos.is_in_corbeille' => false,
				'Photos.deleted' => false,
				'Photos.type_media' => 'photo',
				'Photos.evenement_id' => $id_evenement
			])
			->contain(['Evenements'=>'Clients']);
		
		$i = 0;
		foreach($photos_pro as $photo_item){
			$i++;
			// $uriBase = 'https://westcentralus.api.cognitive.microsoft.com/face/v1.0/detect';
			$uriBase = 'https://francecentral.api.cognitive.microsoft.com/face/v1.0/detect';
			// $ocpApimSubscriptionKey = '5c7edca917024fa2816d9fc7c997a977';
			$ocpApimSubscriptionKey = 'f020c500740e40b9a081d0107d48a47d';
			
			$ch = curl_init($uriBase);
			$url_photo = $photo_item->url_thumb_popup;
			// $url_photo = 'https://thumbs.dreamstime.com/z/groupe-de-personnes-la-ligne-d-arriv%C3%A9e-de-croisement-45890554.jpg';
			
			if(!file_exists($photo_item->uri_photo))
				continue;
				
			$json = json_encode(['url' => $url_photo]);
			$params = ['returnFaceAttributes' => 'age,gender,emotion', 'returnFaceLandmarks' => false];
			
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', '', 'Ocp-Apim-Subscription-Key: ' . $ocpApimSubscriptionKey));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
			curl_setopt($ch, CURLOPT_URL, $uriBase.'?' . http_build_query($params));
			$result = curl_exec($ch);
			curl_close($ch);

			$reponse = json_decode($result);
			$json_rep = json_encode($reponse, JSON_PRETTY_PRINT);
			$json_array = json_decode($json_rep, TRUE);
			// var_dump($json_array);exit;
			if(!array_key_exists('error', $json_array)){
				$nb_homme = 
				$nb_femme = 
				
				$moins_20 = 
				$v_t = 
				$t_q = 
				$q_s = 
				$plus_60 = 
				
				$nb_sourire = 
				$nb_neutre = 
				$nb_triste = 
				$nb_colere = 
				$nb_surpris = 
				$nb_peur = 0;
				$age_total = 0;
				
				$face_array = [];
				$photo_id = $photo_item->id;
				
				foreach($json_array as $face_item){
					
					// Classement par sexe
					if($face_item['faceAttributes']['gender'] == 'male'){
						$nb_homme++;
					}elseif($face_item['faceAttributes']['gender'] == 'female'){
						$nb_femme++;
					}
					
					if($nb_homme || $nb_femme){
						$age_total += $face_item['faceAttributes']['age'];
						// Classement par age
						if($face_item['faceAttributes']['age'] < 20){
							$moins_20++;
						}elseif($face_item['faceAttributes']['age'] >= 20 && $face_item['faceAttributes']['age'] < 30){
							$v_t++;
						}elseif($face_item['faceAttributes']['age'] >= 30 && $face_item['faceAttributes']['age'] < 40){
							$t_q++;
						}elseif($face_item['faceAttributes']['age'] >= 40 && $face_item['faceAttributes']['age'] < 60){
							$q_s++;
						}elseif($face_item['faceAttributes']['age'] >= 60){
							$plus_60++;
						}
						
						// Classement par emotion
						$max = max($face_item['faceAttributes']['emotion']);
						foreach($face_item['faceAttributes']['emotion'] as $key  => $item){
							if($item == $max){
								$emot = $key;
								break;
							}
						}
						if($key == 'happiness'){
							$nb_sourire++;
						}elseif($key == 'neutral'){
							$nb_neutre++;
						}elseif($key == 'sadness'){
							$nb_triste++;
						}elseif($key == 'surprise'){
							$nb_surpris++;
						}elseif($key == 'fear'){
							$nb_peur++;
						}elseif($key == 'anger'){
							$nb_colere++;
						}
						
					}
				}
				$stat_globale = $json_rep;
				// s'il existe au moins une personne => enregistrement
				if($nb_homme || $nb_femme){
					$face_array = [
						'photo_id' => $photo_id,
						'nb_homme' => $nb_homme,
						'nb_femme' => $nb_femme,
						'moins_20' => $moins_20,
						'a_20_30' => $v_t,
						'a_30_40' => $t_q,
						'a_40_60' => $q_s,
						'plus_60' => $plus_60,
						'age_total' => $age_total,
						'nb_sourire' => $nb_sourire,
						'nb_neutre' => $nb_neutre,
						'nb_triste' => $nb_triste,
						'nb_surpris' => $nb_surpris,
						'nb_peur' => $nb_peur,
						'nb_colere' => $nb_colere,
						'stat_globale' => $stat_globale,
					];
					
					$photoStatistique = $this->PhotoStatistiques->newEntity();
					$photoStatistique = $this->PhotoStatistiques->patchEntity($photoStatistique, $face_array);
					$this->PhotoStatistiques->save($photoStatistique);
				}
				
				$data_update = ['is_stat_traite' => true];
				$photo = $this->Photos->get($photo_id, [
					'contain' => []
				]);
				$photo = $this->Photos->patchEntity($photo, $data_update);
				$this->Photos->save($photo);
				
				if($i == 4){
					$i = 0;
					sleep(4);
				}
				
			}else{
				var_dump($json_array);
				exit;
			}
		}
		exit;
	}
	
	public function statistique_v0($idEvenement = null, $nom='fichier.pdf'){
		$this->viewBuilder()
			->className('Dompdf.Pdf')
			->layout('Dompdf.default')
			->options(['config' => [
				'filename' => $idEvenement,
				'render' => 'browser',
				'size' => 'A4',
				'orientation' => 'landscape'
		]]);
		
		
		$evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Photos','Crons','FacebookAutos'=>['FacebookAutoSuivis'],'Galeries']
        ]);
		
		// parametrage @points : [0]:délivres, [1]:clique, [2]:ouvert, [3]:erreur
		$points = [];
		
		// Nombre de photos
		$nbrPhoto = count($evenement->photos);
		// Nombre d'impression effectuée.
		$nbrImp = 4;
		$nbrContact = 0;
        $nbrContactEmail = 0;
        $nbrContactTel = 0;
        $nbrEmailEnvoye =0;
        $nbrEmailOuvert = 0;
        $nbrSmsEnvoye = 0;
        $nbrSmsOuvert = 0;
        $nbrTelechargementPhoto = 0;
        $nbrPageVue = 0;
        $smsDeliveryPercent = 0;
        $smsNotDeliveryPercent = 0;
		$options = [];
		
		
		$total = 0;
		$delivredPourcent = 0;
		$ouvertPourcent = 0;
		$clickPourcent = 0;
		$blockedPourcent = 0;
		$spamPourcent = 0;
		$hardBouncePourcent = 0;
		$softBouncePourcent = 0;
		$messageDeferredPourcent = 0;
		$messageUnsubscribedPourcent = 0;
		$messageSentCount = "-";
		$messageOpenedCount  = "-";
		$messageClickedCount = 0;
		$boucePourcent = 0;
		
		
		
		// initialisation variable
		$txt_rec_ouv_mail = 
		$txt_ouv_clic_mail = '--:--:--';
		$nbrMoyenneDouverture = 0;
		
		// Top domaine
		$topDomaine = [];
		
		$buffer = '';
		
		$img = '<img src="'.WWW_ROOT.'/img/logo.png" alt="Logo Selfizee" style="width: 60%;">';
		
		$entete = ''.
		'<div style="clear:both;">'.
			'<div style="width:50%;display:inline-block;"><img src="'.WWW_ROOT.'/img/logo.png" alt="Logo Selfizee" style="width: 400px;"/></div>'.
			'<div style="width:50%;display:inline-block;text-align:right;"><h2>'.$evenement->nom.'</h2></div>'.
		'</div>';
		
		
		
        if($nbrPhoto){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $contactList = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos])
                                                        ->toArray();
                                                        
            $nbrContact = count($contactList);
            
            
            $nbrContactEmail = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $nbrContactTel = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.telephone IS NOT' => NULL])
                                            ->notEq('Contacts.telephone', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
			
									
			if($nbrContact){
                $this->loadModel('EmailEnvois');
                $emailEnvoi = $this->EmailEnvois->find()
                                                        ->where(['evenement_id' => $idEvenement])
                                                        ->first();
                if(!empty($emailEnvoi)){
                    $nbrEmailEnvoye = $emailEnvoi->total_envoi;
                    $nbrEmailOuvert = $emailEnvoi->total_ouvert;
                }
                
                $this->loadModel('SmsEnvois');                                   
                $smsEnvoi = $this->SmsEnvois->find()
                                        ->where(['evenement_id' => $idEvenement])
                                        ->first();
                if(!empty($smsEnvoi)){
                    $nbrSmsEnvoye = $smsEnvoi->total_envoi;
                    $nbrSmsOuvert = $smsEnvoi->total_ouvert;
                }
            }
			
			// début Top domaine
			$listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
                                                        
            $nbrContactEmail_tmp = count($listContactEmail);
            
            if(!empty($nbrContactEmail_tmp) && $nbrContactEmail_tmp){
				$listeContactWhoHasEmail =  $this->Evenements->Photos->Contacts->find('all')
															->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>'']);
			
				$topDomaine = $listeContactWhoHasEmail->select([
									'domaine' => $listeContactWhoHasEmail->func()->substring_index([
															'Contacts.email' => 'literal' ,
															'@',
															-1 => 'literal'
														]),
														
									'email_count' => $listeContactWhoHasEmail->func()->count('*'),
									
									
							   ])
							  ->where(['Contacts.id IN' => $listContactEmail])
							   ->group('domaine')
							   ->order(['email_count' => 'DESC'])
							   ->limit(5);
			}
			// fin top domaine
			
		}
		$color_theme = '#f10f5e';
		$color_gris = 'color:#555;';
		
		$this->loadModel('EvenementStatCampaigns');
        $eventStatCampaign = $this->EvenementStatCampaigns->find()
                                            ->where(['evenement_id' => $evenement->id])
                                            ->first();
		if(!empty($eventStatCampaign)){
			$total = $eventStatCampaign->total;
			$messageSentCount = $eventStatCampaign->message_sent_count;
			$messageOpenedCount = $eventStatCampaign->message_opened_count;
			$messageClickedCount = $eventStatCampaign->message_clicked_count;
			$messageBlockedCount = $eventStatCampaign->message_blocked_count;
			$messageSpamCount = $eventStatCampaign->message_spam_count;
			$messageHardBouncedCount  = $eventStatCampaign->message_hard_bounced_count ;
			$messageSoftBouncedCount = $eventStatCampaign->message_soft_bounced_count;
			$messageDeferredCount = $eventStatCampaign->message_deferred_count;
			$messageUnsubscribedCount = $eventStatCampaign->event_unsubscribed_count;
			
			if(!empty($total) && $total){
				$delivredPourcent = ($messageSentCount*100) / $total;
				$delivredPourcent = round($delivredPourcent, 2);
				
				$blockedPourcent = ($messageBlockedCount*100) / $total;
				$blockedPourcent = round($blockedPourcent, 2);
				
				$hardBouncePourcent = ($messageHardBouncedCount*100)/$total; 
				$hardBouncePourcent = round($hardBouncePourcent, 2);
				
				$softBouncePourcent = ($messageSoftBouncedCount*100) /$total;
				$softBouncePourcent = round($softBouncePourcent, 2);
				
				$bouceCount = $messageHardBouncedCount + $messageSoftBouncedCount;
				$boucePourcent = ($bouceCount*100)/$total;
				$boucePourcent = round($boucePourcent, 2);
				
				$messageDeferredPourcent = ($messageDeferredCount*100) / $total;
				$messageDeferredPourcent = round($messageDeferredPourcent, 2);
				
				if(!empty($messageSentCount) && $messageSentCount){
					$ouvertPourcent = ($messageOpenedCount*100)/ $messageSentCount;
					$ouvertPourcent = round($ouvertPourcent, 2);
					
					$messageUnsubscribedPourcent = ($messageUnsubscribedCount *100) / $messageSentCount;
					$messageUnsubscribedPourcent = round($messageUnsubscribedPourcent, 2);
					
					$spamPourcent = ($messageSpamCount*100)/ $messageSentCount;
					$spamPourcent = round($spamPourcent, 2);
				}
				
				if(!empty($messageOpenedCount) && $messageOpenedCount){
					$clickPourcent = ($messageClickedCount*100) / $messageOpenedCount;
					$clickPourcent = round($clickPourcent, 2);
					// Nombre moyenne d'ouverture mail
					$nbrMoyenneDouverture = $messageSentCount / $messageOpenedCount;
					$nbrMoyenneDouverture = round($nbrMoyenneDouverture, 2);
				} 
				
			}
			
			// reception et ouverture mail
			$openClick = $eventStatCampaign->event_open_delay;
			if(!empty($openClick)){
				$txt_rec_ouv_mail = date("h:i\':s\'\'",$openClick);
			}
			// fin reception et ouverture mail
			
			// ouverture et click mail
			$moyenClick = $eventStatCampaign->event_click_delay;
			if(!empty($moyenClick)){
				$txt_ouv_clic_mail = date("h:i\':s\'\'",$moyenClick);
			}
			// fin reception et ouverture mail
			
		}
		
		
		// Parametrage de l'options
		$options['nbrContact'] = $nbrContact;
		$options['nbrContactTel'] = $nbrContactTel;
		$options['nbrContactEmail'] = $nbrContactEmail;
		$options['nbrSmsEnvoye'] = $nbrSmsEnvoye;
		$options['nbrSmsOuvert'] = $nbrSmsOuvert;
		$options['nbrImp'] = $nbrImp;
		$options['nbrEmailEnvoye'] = $nbrEmailEnvoye;
		$options['nbrEmailOuvert'] = $nbrEmailOuvert;
		$options['nbrTelechargementPhoto'] = $nbrTelechargementPhoto;
		$options['nbrPageVue'] = $nbrPageVue;
		$options['smsDeliveryPercent'] = $smsDeliveryPercent;
		$options['smsNotDeliveryPercent'] = $smsNotDeliveryPercent;
		
		$options['delivredPourcent'] = $delivredPourcent;
		$options['ouvertPourcent'] = $ouvertPourcent;
		$options['clickPourcent'] = $clickPourcent;
		$options['boucePourcent'] = $boucePourcent;
		
		if($delivredPourcent || $ouvertPourcent || $clickPourcent || $boucePourcent)
			$points = [$delivredPourcent, $ouvertPourcent, $clickPourcent, $boucePourcent];
		else
			$points = [$delivredPourcent, $ouvertPourcent, $clickPourcent, $boucePourcent, 0, 100];
		
		$config = ['options'=>$options, 'points'=>$points];
		
		// Envoie de tous les paramètres dans la génération des images pour le pdf
		$this -> requestAction('/evenements/png/', ['points'=> $config, 'return']);
		
		
		$txt_topDomaine = '';
		$i = 1;
		if(!empty($topDomaine)){
			foreach($topDomaine as $domaine){
				if(!empty($domaine->domaine) && trim($domaine->domaine)){
					$txt_topDomaine .= '<li>'.$i.' '.h($domaine->domaine).'</li>';
					$i++;
					if($i == 8)
						break;
				}
			}
		}
			
		$buffer .= ''.
		'<div style="width: 100%;padding: 150px 80px;">'.
			'<div style="width: 50%;display: inline-block; text-align:center;">'.
				$img.
				'<h1 style="padding: 98px 0 22px;font-weight:normal;">'.$evenement->nom.'</h1>'.
				'<div style="position:absolute;bottom:10px;text-align:left;padding-left:160px;">'.
					'<h1 style="font-weight:normal;"><span style="display:inline-block;width:50px;text-align:right;">'.$nbrPhoto.'</span> <span style="display:inline-block;">Photo'.($nbrPhoto > 1 ? 's' : '').'</span></h1>'.
					'<h1 style="font-weight:normal;"><span style="display:inline-block;width:50px;text-align:right;">'.$nbrImp.'</span> <span style="display:inline-block;">Impression'.($nbrImp > 1 ? 's' : '').'</span></h1>'.
				'</div>'.
			'</div>'.
			'<div style="width: 50%;display: inline-block; text-align:center;">'.
				'<img src="'.WWW_ROOT.'/img/banner.jpg" style="width:100%;" alt="Logo Selfizee">'.
			'</div>'.
		'</div>'.
		
		'<div style="page-break-before: always;"></div>'.
		'<div style="width:100%;">'.
			$entete.
			'<div style="position:absolute;bottom: 200px;width:100%;font-weight:normal;">'.
				'<div style="width:1360px;height:auto;background-color:#888;padding:10px;margin-bottom:20px;"><img src="chart.png" style="width: 100%;"></div>'.
				'<div style="width:80%;padding-top:60px;">'.
					'<div class="txt">'.
						$nbrContact.'<br/>'.
						'contact'.($nbrContact > 1 ? 's' : '').
					'</div>'.
					'<div class="txt">'.
						$nbrContactEmail.'<br/>'.
						'email'.($nbrContactEmail > 1 ? 's' : '').
					'</div>'.
					'<div class="txt">'.
						$nbrEmailEnvoye.'<br/>'.
						'email'.($nbrEmailEnvoye > 1 ? 's' : '').' '.'envoyé'.($nbrEmailEnvoye > 1 ? 's' : '').
					'</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
		'<div style="page-break-before: always;"></div>'.
		'<div style="width:100%;font-weight:normal;">'.
			$entete.
			'<div style="width:100%;margin-top: 35px;">'.
				'<ul class="sf-liste-pers">'.
					'<li class="active" style="color:'.$color_theme.';">Email notification</li>'.
					'<li>Sms notification</li>'.
				'</ul>'.
			'</div>'.
			'<div style="width:100%;padding:200px 30px;">'.
				'<div class="sf-bloc-0" style="background-color:'.$color_theme.';">'.
					'<p style="text-align:center;margin-top: 80px;">'.$total.'<br/>E-mails</p>'.
					'<p style="margin-top: 20px;text-align:center;">TOTAL</p>'.
				'</div>'.
				'<div class="sf-bloc-0"  style="border:solid 1px #F2F2F2;">'.
					'<img src="1-delivre.png">'.
					'<p class="nb">'.$messageSentCount.'</p>'.
					'<p class="sf-bloc-0-detail" style="color:rgb(60,162,186);">Délivrés</p>'.
				'</div>'.
				'<div class="sf-bloc-0"  style="border:solid 1px #F2F2F2;">'.
					'<img src="1-ouvert.png">'.
					'<p class="nb">'.$messageOpenedCount.'</p>'.
					'<p class="sf-bloc-0-detail" style="color:rgb(164,52,1);">Ouvert</p>'.
				'</div>'.
				'<div class="sf-bloc-0"  style="border:solid 1px #F2F2F2;">'.
					'<img src="1-click.png">'.
					'<p class="nb">'.$messageClickedCount.'</p>'.
					'<p class="sf-bloc-0-detail" style="color:rgb(16,187,5);">Cliqués</p>'.
				'</div>'.
				'<div class="sf-bloc-0" style="background-color:'.$color_theme.';width:480px;">'.
					'<div class="sf-bloc-0-enfant" style="padding-top: 40px;">'.
						'<div class="enfant-1" style="width:60%;">Bloqués</div><div class="enfant-1" style="width:34%;">'.$blockedPourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:60%;">Spam</div><div class="enfant-1" style="width:34%;">'.$spamPourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:60%;">Erreur permanente</div><div class="enfant-1" style="width:34%;">'.$hardBouncePourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:60%;">Erreur temporaire</div><div class="enfant-1" style="width:34%;">'.$softBouncePourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:60%;">Renvoi</div><div class="enfant-1" style="width:34%;">'.$messageDeferredPourcent.'%</div>'.
					'</div>'.
					'<div class="sf-bloc-0-enfant">'.
						'<div class="enfant-1" style="width:60%;">Désabonné</div><div class="enfant-1" style="width:34%;">'.$messageUnsubscribedPourcent.'%</div>'.
					'</div>'.
				'</div>'.
			'</div>'.
			'<div style="width:100%;padding:10px;clear:both;">'.
				'<div style="width:22%;display:inline-block;margin-right:2%;height:200px;">'.
					'<h4><span style="border-bottom: solid 2px '.$color_theme.';display:inline-block;padding-bottom: 15px;text-transform:uppercase;'.$color_gris.'">Top Domaines</span></h4>'.
					'<ul style="font-size:25px;list-style-type:none;'.$color_gris.'">'.
						$txt_topDomaine.
					'</ul>'.
				'</div>'.
				'<div style="width:22%;display:inline-block;border:solid 1px #F2F2F2;height:150px;margin-right:2%;height:200px;">'.
					'<p class="nb-pers" style="color:#40A0BB;">'.$txt_rec_ouv_mail.'</p>'.
					'<div class="nb-pers-lib" style="background-color:'.$color_theme.'">'.
						'<p>Temps moyen entre la réception et ouverture de l\'email</p>'.
					'</div>'.
				'</div>'.
				'<div style="width:22%;display:inline-block;border:solid 1px #F2F2F2;height:150px;margin-right:2%;height:200px;">'.
					'<p class="nb-pers" style="color:#555;">'.$txt_ouv_clic_mail.'</p>'.
					'<div class="nb-pers-lib" style="background-color:black;">'.
						'<p>Temps moyen entre l\'ouverture et le clic dans l\'email</p>'.
					'</div>'.
				'</div>'.
				'<div style="width:22%;display:inline-block;border:solid 1px #F2F2F2;height:200px;">'.
					'<p class="nb-pers" style="color:#999;">'.$nbrMoyenneDouverture.'</p>'.
					'<div class="nb-pers-lib" style="background-color:#999;">'.
						'<p>Nombre moyen d\'ouvertures par <br/>e-mail envoyé</p>'.
					'</div>'.
				'</div>'.
			'</div>'.
		'</div>';
		
		$contenu = $buffer;
		$this->set(compact('contenu'));
	}
	
	public function lanceTacheCronStatistique(){
		$this -> autoRender = false;
		$shell = new ShellDispatcher();
        $output = $shell->run(['cake', 'evenement']);
	}
	
	/*
	 * Fin
	 */
	
	
    public function timeline($idEvenement=null, $type = null){
		// echo 
			// '<div style="font-size: 22px; margin-bottom: 25px;">Cette fonctionnalité est pour le moment en maintenance. <br/>Nous vous remercions pour votre compréhension. </div>'.
			// '<input type="button" value="Retour à la page précédente"  onclick = "history.back()" style="font-size: 17px;">';
		// exit;
        
        if ($idEvenement == null || $idEvenement == 0) {
            $this->viewBuilder()->setLayout('sans_menu');
        } 

        $timelines = $this->Evenements->Timelines->find()
                                    ->where([
                                            'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
                                            'Timelines.source_timeline IS NOT' => NULL, 'Timelines.source_timeline <>'=>''
                                        ])
                                    ->order(['Timelines.date_timeline' => 'DESC'])
                                   ->contain(['Evenements', 'Users' => ['Clients']])
									->limit(250)
									->page(1);                
        $evenement = null;
        if(!empty($idEvenement)){
            $timelines = $timelines->where(['Timelines.evenement_id' => $idEvenement]);
            $evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries', 'Fonctionnalites']]);
        }
		

        $queryType = $this->request->getQuery('type');
        if(!empty($queryType)){
            $queryType = array_keys($queryType);
            $timelines = $timelines->where(['Timelines.type_timeline IN' => $queryType]);
        }

		// les type de timeline possible (1 - 10)
		$nb_menu_left = [];
		if(!empty($idEvenement)){
			for($i = 1; $i < 12; $i++){
				$timeline_tp = $this->Evenements->Timelines->find();
				$timeline_tp->select(['sum_nbr' => $timeline_tp->func()->sum('nbr')])
					->where([
						'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
						'Timelines.source_timeline IS NOT' => NULL, 'Timelines.source_timeline <>'=>'',
						'Timelines.evenement_id' => $idEvenement,
						'Timelines.type_timeline' => $i
					]);
				$nb_menu_left[$i] = $timeline_tp->first()->sum_nbr;
			}
		}else{
			for($i = 1; $i < 12; $i++){
				$timeline_tp = $this->Evenements->Timelines->find();
				$timeline_tp->select(['sum_nbr' => $timeline_tp->func()->sum('nbr')])
					->where([
						'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
						'Timelines.source_timeline IS NOT' => NULL, 'Timelines.source_timeline <>'=>'',
						'Timelines.type_timeline' => $i
					]);
				$nb_menu_left[$i] = $timeline_tp->first()->sum_nbr;
			}
		}

        $this->set('isTimeLinePage', true);
        $this->set(compact('evenement','idEvenement','timelines','type', 'nb_menu_left', 'queryType'));
    }
	
	public function ajaxTimeline(){
		ob_start();
		$replace_bloc = 
		$actionDateLast = 
		$id_replace_bloc = 
		$buffer_synth = '';
		
		$bloc_1 = false;
		$this -> autoRender = false;
		$page = 1;
		$nbr = [];
		
		$initial = 
		$idEvenement = 
		$nbr_1 = 
		$nbr_2 = 
		$nbr_3 = 
		$nbr_4 = 
		$nbr_5 = 
		$nbr_6 = 
		$nbr_7 = 
		$nbr_8 = 
		$nbr_9 = 0;
		
		if(!empty($this -> request -> data)){
			$idEvenement = !empty($this -> request -> data['idEvenement']) ? $this -> request -> data['idEvenement'] : 0;
			$type = $this -> request -> data['type'];
			$nbr = @unserialize(base64_decode(base64_decode(base64_decode($this -> request -> data['nbr']))));
			$page = $this -> request -> data['page'];
			$actionDateLast = $this -> request -> data['actionDateLast'];
			$id_replace_bloc = Inflector::slug($actionDateLast, '-');
			
			if($nbr){
				$nbr_1 = $nbr['nbr_1'];
				$nbr_2 = $nbr['nbr_2'];
				$nbr_3 = $nbr['nbr_3'];
				$nbr_4 = $nbr['nbr_4'];
				$nbr_5 = $nbr['nbr_5'];
				$nbr_6 = $nbr['nbr_6'];
				$nbr_7 = $nbr['nbr_7'];
				$nbr_8 = $nbr['nbr_8'];
				$nbr_9 = $nbr['nbr_9'];
			}
		}
		
		$timelines = $this->Evenements->Timelines->find()
                                    ->where([
                                            'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
                                            'Timelines.source_timeline IS NOT' => NULL, 'Timelines.source_timeline <>'=>''
                                        ])
                                    ->order(['Timelines.date_timeline' => 'DESC'])
                                    ->contain(['Evenements', 'Users' => ['Clients']])
									->limit(250)
									->page($page);
        $evenement = null;
        if($idEvenement > 0){
            $timelines = $timelines->where(['Timelines.evenement_id' => $idEvenement]);
            $evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        }
		
        if(!empty($type)){
            $timelines = $timelines->where(['Timelines.type_timeline' => $type]);
        }
		
		
		$init = $actionDateLast;
		$buffer = 
		$ss_texte = 
		$texte = '';
		$i=0;
		
		if(!count($timelines->toArray())){
			echo json_encode(['est_vide' => true]);
			exit;
		}

		foreach($timelines as $timeline){
			$i++;
			if(is_null($timeline->date_timeline))
				continue;
			
			$initial++;
			
			if($init != $timeline->date_timeline->format('d/m/Y')){
				$now = new Date();
				$date_auj = $now -> format('d/m/Y');
				$hier = new Date('-1 day');
				$date_hier = $hier -> format('d/m/Y');
				
				setlocale(LC_TIME, 'fr_FR.utf8','fra'); 
				$date = strftime("%d %B %Y", strtotime($timeline->date_timeline->format('Y-m-d H:i:s')));
				
				$texte = ($timeline->date_timeline->format('d/m/Y') == $date_auj ? 'Aujourd\'hui' : ($timeline->date_timeline->format('d/m/Y') == $date_hier ? 'Hier' : $date));
				$ss_texte = ($timeline->date_timeline->format('d/m/Y') == $date_auj ? 'Aujourd\'hui' : ($timeline->date_timeline->format('d/m/Y') == $date_hier ? 'Hier' : $timeline->date_timeline->format('d/m/Y')));
				
				$bloc_date = ''.
				'<div class="message-item message-item-0">'.
					'<div class="message-inner-0">'.
						'<div class="qa-message-content">'.
							$texte.
						'</div>'.
					'</div>'.
				'</div>';
				$bloc_date_synth = ''.
				'<div class="message-item-1 message-item-0">'.
					'<div class="message-inner-0">'.
						'<div class="qa-message-content">'.
							$texte.
						'</div>'.
					'</div>'.
				'</div>';
				
				$buffer .= $bloc_date;
				$init = $timeline->date_timeline->format('d/m/Y');
				
				$data_synth = '';
				if($i != 1 && ($nbr_1 || $nbr_2 || $nbr_3 || $nbr_4 || $nbr_5 || $nbr_6 || $nbr_7 || $nbr_8 || $nbr_9)){
					// Photos uploads
					if($nbr_1 > 0){
						$pl = $nbr_1 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-image-multiple"></i> '.$nbr_1 . ' photo'.$pl.' uploadée'.$pl.'</span>';
					}
					// contact
					if($nbr_2 > 0){
						$pl = $nbr_2 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-contacts"></i> '. $nbr_2 . ' contact'.$pl.' uploadé'.$pl.'</span>';
					}
					// envoi email
					if($nbr_3 > 0){
						$pl = $nbr_3 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-telegram"></i> '. $nbr_3 . ' email'.$pl.' envoyé'.$pl.'</span>';
					}
					// envoi sms
					if($nbr_4 > 0){
						$pl = $nbr_4 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-cellphone-iphone"></i> '. $nbr_4 . ' sms envoyé'.$pl.'</span>';
					}
					// Photo supprimée
					if($nbr_5 > 0){
						$pl = $nbr_5 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-delete-empty"></i> '. $nbr_5. ' photo'.$pl.' supprimée'.$pl.'</span>';
					}
					// Connexion galérie souvenir
					if($nbr_6 > 0){
						$pl = $nbr_6 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-login"></i> '. $nbr_6 . ' connexion'.$pl.' de la galerie souvenir</span>';
					}
					// Téléchargement photo
					if($nbr_7 > 0){
						$pl = $nbr_7 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_7. ' téléchargement'.$pl.' photo</span>';
					}
					if($nbr_8 > 0){
						$pl = $nbr_8 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_8.' téléchargement'.$pl.' de tous les média</span>';
					}
					// Facebook
					if($nbr_9 > 0){
						$pl = $nbr_9 > 1 ? 's' : '';
						$data_synth .= '<span><i class="mdi mdi-facebook-box"></i> '. $nbr_9 . ' photo'.$pl.' uploadée'.$pl.'</span>';
					}
						
					// Remplacement bloc
					if($bloc_1){
						$replace_bloc = $data_synth;
						$bloc_1 = false;
					}
					// Incrementation du bloc précendente
					else{
						$buffer_synth .= $init == '' ? '' : $data_synth.'</div>';
					}
				}
				
				$buffer_synth .= $bloc_date_synth;
				$buffer_synth .= '<div class="kl_filtreParActiviteBoc kl_filtre_vue" id="'.(Inflector::slug($init, '-')).'">';
				
				$initial = 
				$nbr_1 = $nbr_2 = $nbr_3 = $nbr_4 = $nbr_5 = $nbr_6 = $nbr_7 = $nbr_8 = $nbr_9 = 0;
			}else{
				$ss_texte = $init;
				$bloc_1 = ($i == 1 || $bloc_1) ? true : false;
			}
			
			$nom = 
			$depuis ="";
			if($timeline->source_timeline == 'bo' ){
				$depuis = "depuis l'espace administration";
				$nom = '<small class="text-muted"><strong><i class="fa fa-user"></i> Par Selfizee</strong></small>';
			}else if($timeline->source_timeline == 'auto' || $timeline->source_timeline == 'upload'){
				$depuis = " depuis la borne";
			}else if($timeline->source_timeline == 2){
				$depuis = "depuis la galerie souvenir";
				$nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
			}else if($timeline->source_timeline == 1){
				$depuis = 'depuis la page souvenir';
				$nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
			}else if($timeline->source_timeline == "galerie"){
				$depuis = "depuis la galerie";
				$nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
			}else if($timeline->source_timeline == 'rgpd'){
				$depuis = 'depuis la page RGPD';
				$nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
			}
			
			$source = "";
			//debug($timeline->type_timeline);
			switch ($timeline->type_timeline) {
				case 1: // upload photo
					$source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
					$nbr_1+= $timeline->nbr;
					break;
				case 2: //contact
					$source = $timeline->nbr > 1 ? "contacts uploadés" : "contact uploadé";
					$nbr_2 += $timeline->nbr;
					break;
				case 3: // envoi email
					$source = $timeline->nbr > 1 ? "emails envoyés" : "email envoyé";
					$nbr_3 += $timeline->nbr;
					break;
				case 4 : // sms envoyé
					$source = $timeline->nbr > 1 ? "sms envoyés" : "sms envoyé";
					$nbr_4 += $timeline->nbr;
					break;
				case 5 :
					$source = $timeline->nbr > 1 ? "photos supprimées" : "photo supprimée";
					$nbr_5 += $timeline->nbr;
					break;
				case 6 :
					$source = 'connexion de la galerie souvenir';
					$nbr_6 += $timeline->nbr;
					break;
				case 7:
					$source = $timeline->nbr > 1 ? "téléchargements photo" : "téléchargement photo";
					$nbr_7 += $timeline->nbr;
					break;
				case 8:
					$source = $timeline->nbr > 1 ? "téléchargements de tous les média" : "téléchargement de tous les média";
					$nbr_8 += $timeline->nbr;
					$depuis = "depuis la galerie souvenir";
					break;
				case 9:
					$source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
					$nbr_9 += $timeline->nbr;
					$depuis = "automatiquement sur facebook";
					break;
			}
			
			if(!empty($timeline->user)){
				// Client
				if(!empty($timeline->user->client))
					$nom = '<small class="text-muted"><strong><i class="fa fa-user-circle"></i> Par '. $timeline->user->client->nom . '</strong></small>';
				// Admin
				else
																													
								
					$nom = '<small class="text-muted"><strong><i class="fa fa-user"></i> Par Selfizee</strong></small>';
				
			   
			  
			 
			}
			
			$buffer .= ''.
			'<div class="text-right">'.$ss_texte.''.$timeline->date_timeline->format(' - H:i').'</div>'.
			'<div class="message-item" id="type_'.$timeline->type_timeline.'">'.
				'<div class="message-inner">'.
					'<div class="qa-message-content">'.
						''.(!empty($timeline->evenement) ? $timeline->evenement->slug.' : ' : "").' '.$timeline->nbr." ". $source.' '.$depuis.($nom ? ' - '. $nom : '').
					'</div>'.
				'</div>'.
			'</div>';
			
		}
		
		$data_synth = '';
		if($i && ($nbr_1 || $nbr_2 || $nbr_3 || $nbr_4 || $nbr_5 || $nbr_6 || $nbr_7 || $nbr_8 || $nbr_9)){
			// Photos uploads
			if($nbr_1 > 0){
				$pl = $nbr_1 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-image-multiple"></i> '.$nbr_1 . ' photo'.$pl.' uploadée'.$pl.'</span>';
			}
			// contact
			if($nbr_2 > 0){
				$pl = $nbr_2 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-contacts"></i> '. $nbr_2 . ' contact'.$pl.' uploadé'.$pl.'</span>';
			}
			// envoi email
			if($nbr_3 > 0){
				$pl = $nbr_3 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-telegram"></i> '. $nbr_3 . ' email'.$pl.' envoyé'.$pl.'</span>';
			}
			// envoi sms
			if($nbr_4 > 0){
				$pl = $nbr_4 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-cellphone-iphone"></i> '. $nbr_4 . ' sms envoyé'.$pl.'</span>';
			}
			// Photo supprimée
			if($nbr_5 > 0){
				$pl = $nbr_5 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-delete-empty"></i> '. $nbr_5. ' photo'.$pl.' supprimée'.$pl.'</span>';
			}
			// Connexion galérie souvenir
			if($nbr_6 > 0){
				$pl = $nbr_6 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-login"></i> '. $nbr_6 . ' connexion'.$pl.' de la galerie souvenir</span>';
			}
			// Téléchargement photo
			if($nbr_7 > 0){
				$pl = $nbr_1 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_7. ' téléchargement'.$pl.' photo</span>';
			}
			if($nbr_8 > 0){
				$pl = $nbr_8 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_8.' téléchargement'.$pl.' de tous les média</span>';
			}
			// Facebook
			if($nbr_9 > 0){
				$pl = $nbr_9 > 1 ? 's' : '';
				$data_synth .= '<span><i class="mdi mdi-facebook-box"></i> '. $nbr_9 . ' photo'.$pl.' uploadée'.$pl.'</span>';
			}
			
			// Remplacement bloc
			if($bloc_1){
				$replace_bloc = $data_synth;
				$bloc_1 = false;
			}
			// Incrementation du bloc précendente
			else{
				$buffer_synth .= $data_synth.'</div>';
			}
		}
		
		$nbr['nbr_1'] = $nbr_1;
		$nbr['nbr_2'] = $nbr_2;
		$nbr['nbr_3'] = $nbr_3;
		$nbr['nbr_4'] = $nbr_4;
		$nbr['nbr_5'] = $nbr_5;
		$nbr['nbr_6'] = $nbr_6;
		$nbr['nbr_7'] = $nbr_7;
		$nbr['nbr_8'] = $nbr_8;
		$nbr['nbr_9'] = $nbr_9;
		
		
		// initialisation données
		$reponse = [
			'v_detail' => $buffer,
			'v_synthetique' => $buffer_synth,
			'page_next' => ($page + 1),
			'init' => $init,
			'type' => $type,
			
			'nbr' => base64_encode(base64_encode(base64_encode(serialize($nbr)))),
			
			'replace_bloc' => $replace_bloc,
			'id_replace_bloc' => $id_replace_bloc,
			
			'actionDateLast' => $actionDateLast
		];
		
		echo json_encode($reponse);
		exit;
	}

    public function nbMenuLeft($idEvenement){
        $nb_menu_left = [];
        for($i = 1; $i < 11 ; $i++){
            $timeline_tp = $this->Evenements->Timelines->find();
            $timeline_tp->select(['sum_nbr' => $timeline_tp->func()->sum('nbr')])
                ->where([
                    'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
                    'Timelines.source_timeline IS NOT' => NULL, 'Timelines.source_timeline <>'=>'',
                    'Timelines.evenement_id' => $idEvenement,
                    'Timelines.type_timeline' => $i
                ]);
            $nb_menu_left[$i] = $timeline_tp->first()->sum_nbr;
        }
        debug($nb_menu_left);die;
    }

    public function acces($idEvenement=null){
        //$this->viewBuilder()->setLayout('sans_menu');
        $this->loadModel('Users');
        $this->loadModel('ContenusEmails');

        $users = $this->Users->find()->where(['evenement_id'=>$idEvenement, 'role_id' => 5,  'is_for_event' => true]);        
        $contenu_email = $this->ContenusEmails->find()->first();
        $contenu = "";
        if($contenu_email) {
            $contenu = $contenu_email->contenu;
        }
        //debug($users->toArray());die;
        /*if(empty($users->toArray())){
            return $this->setAction('addAcces', $idEvenement); //$this->redirect(['action' => 'addAcces', $idEvenement]);
        }*/

        $evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Fonctionnalites']
        ]);
        $this->set('isAccesPage', true);
        $this->set(compact('evenement', 'users', 'idEvenement', 'contenu'));
    }

     public function addAcces($idEvenement=null, $idAcces = null){

        $this->viewBuilder()->setLayout('default');
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        $default_login = "";

        $evenement = null;
        if(!empty($idEvenement)){
             $evenement = $this->Evenements->get($idEvenement, [
                'contain' => ['Fonctionnalites']
            ]);
        }

        $is_edit = false;
        if(!empty($idEvenement) && !empty($idAcces)){
            $userFind = $this->Users->find()->where(['id'=>$idAcces, 'evenement_id'=>$idEvenement, 'role_id' => 5 , 'is_for_event' => true])->first();
            if($userFind){
                $user = $userFind;
                $is_edit = true;
            }
        }

        $login_default_exist = $this->Users->find()->where(['username'=>$evenement->slug])->first();
        if(!$login_default_exist) {
            $default_login  = $evenement->slug;
        }
        //debug($evenement); die;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['evenement_id'] = $evenement->id;
            $data['role_id'] = 5;
            $data['is_for_event'] = true;
            //debug($data); // die;
            $user = $this->Users->patchEntity($user, $data);
            //debug($user); die;
            if ($this->Users->save($user)) {

                $this->Flash->success(__('The accees has been saved.'));
                return $this->redirect(['action' => 'acces', $evenement->id]);
            } else {
                debug($user); die;
            }
            $this->Flash->error(__('The accees could not be saved. Please, try again.'));
        }

        $this->set('isAccesPage', true);
        $this->set(compact('evenement', 'user', 'idEvenement', 'is_edit', 'default_login'));
    }

    public function deleteAcces($id= null){
        $this->loadModel('Users');
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);       
        $event_id = $user->evenement_id;
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The acces has been deleted.'));
        } else {
            $this->Flash->error(__('The acces could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'acces', $event_id]);
    }

    public function forceLogin($id){
        $this->loadModel('Users');
        $user = $this->Users->get($id);
        if(!empty($user)){
            //debug($user);die;
            $this->Flash->success(__('Vous être connecté en tant que : ').$user->username);
            $this->Auth->setUser($user);
            return $this->redirect(['controller'=>'Evenements','action'=> 'board', $user->evenement_id ]);
        }        
    }

    public function forceLoginAdmin(){
        $this->loadModel('Users');
        $user = $this->Users->get(1);
        if(!empty($user)){
            //debug($user);die;
            $this->Flash->success(__('Vous être connecté en tant que : ').$user->username);
            $this->Auth->setUser($user);
            return $this->redirect(['controller'=>'Evenements','action'=> 'index']);
        }        
    }

    public function sendAcces(){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('acceEmails');
        $this->loadModel('Users');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $user = $this->Users->get($data['user_id']);

            $codes = ["[[LOGIN]]", "[[PASS]]"];
            $acces = [$user->username, $user->password_visible];
            $data['commentaire'] = str_replace($codes, $acces, $data['commentaire']);
            //debug($data);die;
            $destinateurs = [];
            if(!empty($data['destinateurs'])){
                $dests = explode(',', $data['destinateurs']);
                //debug($dest_multiple);
                foreach ($dests as $email){
                    $email = trim($email);
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //==email valide
                        //debug($email_multi);
                        $destinateurs [] = $email;
                    }
                }
            }
            
            $evenement = $this->Evenements->get($data['evenement_id']);
            $this->loadmodel('EnvoisAcces');
            $envoi_acces = $this->EnvoisAcces->newEntity();
            $envoi_acces->commentaire = $data['commentaire'];
            $envoi_acces->user_id = $data['user_id'];
            $envoi_acces->evenement_id = $data['evenement_id'];
            $envoi_acces->destinateurs = implode(", ", $destinateurs);

            $email = new Email('default');
            $email->setViewVars(['contenu' => $data['commentaire']])
                ->setTemplate('sendacces')
                ->setEmailFormat('html')
                ->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
                ->setSubject('Selfizee : Accès à votre event '.$evenement->slug)
                ->setTransport('mailjet')
                ->setTo($destinateurs);
                if ($email->send()) {
                    $this->EnvoisAcces->save($envoi_acces);
                    $this->Flash->success(__('The acces has been sent.'));
                } else {
                    $this->Flash->error(__('The acces could not be sent.'));
                }

            return $this->redirect(['action' => 'acces', $evenement->id]);
        }
        //$this->set('slug', $evenement->slug );
    }
    
    public function timelineEvent($idEvenement){
        $type = $this->request->getQuery('type');
        
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $timelines = $this->Evenements->Timelines->find()
                                    ->where([
                                            'Timelines.evenement_id' => $idEvenement,
                                            'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
                                            'Timelines.source_timeline IS NOT' => NULL, 'Timelines.queue <>'=>''
                                        ])
                                    ->order(['Timelines.date_timeline' => 'DESC']);
        if(!empty($type)){
            $timelines = $timelines->where(['Timelines.type_timeline' => $type]);
        }
        $this->set(compact('evenement','idEvenement','timelines','type'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $this->viewBuilder()->setLayout('sans_menu');
        $evenement = $this->Evenements->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
			$data['user_id'] = $this -> Auth -> user('id');
            
            $start = $this->request->getData('start');
            if(!empty($start)){
                $startArray = explode("-",$start);
                if(count($startArray) == 3){
                    $data['date_debut'] = new Time($startArray[2].'-'.$startArray[1].'-'.$startArray[0]);
                }
            }
            $end = $this->request->getData('end');
            if(!empty($end)){
                $endArray = explode("-",$end);
                if(count($endArray) == 3){
                    $data['date_fin'] = new Time($endArray[2].'-'.$endArray[1].'-'.$endArray[0]);
                }
            }

            // debug($data);
            // die();
            $evenement = $this->Evenements->patchEntity($evenement, $data,['associated'=>['Galeries.Users', 'Users','Fonctionnalites' ] ]);
            if ($this->Evenements->save($evenement)) {
                //Créer les dossier CSV et gallerie
                $filecsv = WWW_ROOT . "import".DS."csv" . DS . strtoupper($evenement->slug) . DS ;
                $dirCsv = new Folder($filecsv, true, 0755);
                $pathPictures = WWW_ROOT."import".DS."galleries".DS. $evenement->id.DS;
                $dirPictures  = new Folder($pathPictures, true, 0755);
                
                //Dossier source
                $sourceDirPath = Configure::read('source_photo').strtoupper($evenement->id) . DS ;
                $sourceDir = new Folder($sourceDirPath, true, 0755);
                
                $this->Flash->success(__('The evenement has been saved.'));
            

                if ($this->Auth->user('role_id') == 7 && $this->Auth->user('is_active_acces_config ') == false) {
                    return $this->redirect(['controller' => 'Evenements', 'action' => 'add']);
                }
                return $this->redirect(['controller'=>'Configurations','action' => 'board', $evenement->id]);
            }
            $this->Flash->error(__('The evenement could not be saved. Please, try again.'));
        }

        $this->loadModel('Users');
        $userParrentId = $this->Auth->user('parent_id');
        $clientParrentId = false;
        if ($userParrentId && $this->Auth->user('role_id') == 7) {
            $clientParrentId = @$this->Users->findById($userParrentId)->first()->client_id;
        }

        $clients = $this->Evenements->Clients->find('list', ['valueField' => 'nom']);
        $fonctionnalites = $this->Evenements->Fonctionnalites->find('all');

        $typeEvenements = $this->Evenements->TypeEvenements->find('list',['valueField' => 'nom']);
        $idClient = $this->Auth->user('client_id');
        if(!empty($idClient)){
            $typeEvenements = $typeEvenements->where(['client_id' => $idClient]);
        }

        $this->set(compact('evenement', 'clients','fonctionnalites','typeEvenements', 'clientParrentId'));
    }
    
    /**
     * WS de cr�ation d'�venement depuis le CRM
     * **/
    public function save(){
        
        $data = $this->request->getData();
        $idClientInSellsy = $this->request->getData('id_client_in_sellsy');
        $client = $this->Evenement->Clients->find()->where(['id_in_sellsy' => $idClientInSellsy])
                                            ->first();
        $res['error'] = 1;
        $evenement = null;
        if($client){
            $data['client_id'] = $client->id;
            $evenement = $this->Evenements->newEntity($data);
            if($this->Evenements->save($evenement)){
                $res['error'] = 0;
            }
        }
        $this->set([
            'res' => $res,
            'evenement' => $evenement,
            '_serialize' => ['evenement', 'res']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evenement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($idEvenement = null)
    {
        
		$this->loadComponent('Utilities');
		$utilities = $this->Utilities;
        
		$evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Clients','Users', 'Galeries' => 'Users', 'EvenementPolitiques', 'Fonctionnalites']
        ]);

        $idGalery = $evenement->galeries[0]->id;

        $evenement->start = (new Time($evenement->date_debut))->format('d-m-Y');
        $evenement->end = (new Time($evenement->date_fin))->format('d-m-Y');

        $oldSlug = trim($evenement->slug);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
           // debug($data);die;
            /*$user = $data['user'];
            if(empty($user['username']) || empty($user['password'])){
                if($user['username'] == $evenement->user->username ){
                    unset($data['user']);
                }
            }*/
            $newSlug = trim($data['slug']);
            $data['galeries'][0]['nom'] = $data['nom'];
            $evenement = $this->Evenements->patchEntity($evenement, $data, ['associated' => ['Clients', 'Galeries.Users', 'EvenementPolitiques', 'Fonctionnalites']]);
            $evenement->galeries[0]->id = $idGalery;

            if ($this->Evenements->save($evenement)) {
                /*if($newSlug != $oldSlug){ // On renomme le dossier si l'id a chang�
                     $oldPath = WWW_ROOT . "import".DS."csv" . DS . strtoupper($oldSlug) . DS ;
                     $newPath = WWW_ROOT . "import".DS."csv" . DS . strtoupper($newSlug) . DS ;
                     rename($oldPath, $newPath);
                }*/
                
				// Enregistrement de la politique de confidentialité rgpd du client
				if(!empty($data['evenement_politique']) && trim($data['evenement_politique']) != ''){
					$this -> loadModel('EvenementPolitiques');
					$contenu = trim($data['evenement_politique']);
					$nom_client = trim($data['nom_client']);
					$data_tmp = $this -> EvenementPolitiques -> find()
					->where([
						'evenement_id' => $evenement->id
					])->toArray();
					// Mise à jour
					if(count($data_tmp)){
						$data_update = [
							'contenu' => $contenu,
							'nom_client' => $nom_client
						];
						$event_politique = $this->EvenementPolitiques->find()
						->where(['evenement_id' => $evenement->id])
						->first();
						$event_politique = $this->EvenementPolitiques->patchEntity($event_politique, $data_update);
						$this->EvenementPolitiques->save($event_politique);
					}
					// Création Politique
					else{
						$data_politique = [
							'evenement_id' => $evenement->id,
							'contenu' => $contenu,
							'nom_client' => $nom_client
						];
						$event_politique = $this->EvenementPolitiques->newEntity();
						$event_politique = $this->EvenementPolitiques->patchEntity($event_politique, $data_politique);
						$this->EvenementPolitiques->save($event_politique);
					}
				}
				
                $this->Flash->success(__('The evenement has been saved.'));

                return $this->redirect(['action' => 'edit',$evenement->id ]);
            }
            $this->Flash->error(__('The evenement could not be saved. Please, try again.'));
        }

        $typeEvenements = $this->Evenements->TypeEvenements->find('list',['valueField' => 'nom']);
        $clients = $this->Evenements->Clients->find('list', ['valueField' => 'nom']);
        $fonctionnalites = $this->Evenements->Fonctionnalites->find('all');
        //debug($evenement ->toArray());die;

        $this->set(compact('evenement', 'clients','idEvenement', 'utilities', 'fonctionnalites', 'typeEvenements'));
        $this->set('isConfiguration',true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evenement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     
    public function delete($id= null){
        $this->request->allowMethod(['post', 'delete']);
        $evenement = $this->Evenements->get($id);
		$evenement->deleted = true;
        if ($this->Evenements->save($evenement)) {
            $this->Flash->success(__('The evenement has been deleted.'));
        } else {
            $this->Flash->error(__('The evenement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
	public function deleteAbke($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evenement = $this->Evenements->get($id);
        if ($this->Evenements->delete($evenement)) {
            $this->Flash->success(__('The evenement has been deleted.'));
        } else {
            $this->Flash->error(__('The evenement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function send(){
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = false;
        $evenement = $this->Evenements->newEntity();
		//debug($res);die;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
			//debug($data);die;
			
			$findClient = $this->Evenements->Clients->find()
											->where(['id_in_sellsy' => $data['id_client_in_sellsy']])
											->first();
			//debug($findClient);
			if($findClient){
				$data['client_id'] = $findClient->id;
				$data['slug'] = strtoupper(Text::slug($data['nom'] ));
				
				$findSlug = $this->Evenements->find()
										->where(['slug'=>$data['slug']])
										->first();
				if($findSlug){
					$data['slug'] = $data['slug'].'-2';
				}
				
				$data['galeries'] = [
					[
						'nom' => $data['nom'],
						'slug' => $data['slug'],
						'titre' => $data['nom'],
						'user' => [
							'username' => $data['slug'],
							'password' => $data['slug'],
							'role_id' => '3'
						]
					]
				];
				
				$evenement = $this->Evenements->patchEntity($evenement, $data,['associated'=>['Galeries.Users', 'Users' ] ]);
				//debug($evenement); die;
				if ($this->Evenements->save($evenement)) {
					//Créer les dossier CSV et gallerie
					$filecsv = WWW_ROOT . "import".DS."csv" . DS . strtoupper($evenement->slug) . DS ;
					$dirCsv = new Folder($filecsv, true, 0755);
					$pathPictures = WWW_ROOT."import".DS."galleries".DS. $evenement->id.DS;
					$dirPictures  = new Folder($pathPictures, true, 0755);
					
					//Dossier source
					$sourceDirPath = Configure::read('source_photo').strtoupper($evenement->id) . DS ;
					$sourceDir = new Folder($sourceDirPath, true, 0755);
					
					$res['message'] = __('The evenement has been saved.');
					
					/**
					 * Création galerie et accès galerie
					 * */

					$res['success'] = true;
				}else{
					//debug($evenement->errors);
					$res['success'] = false;
					$res['message'] = 'Message d\'enregistrement';
				}
			}else{
				$res['success'] = false;
				$res['message'] = 'Le client n\'existe pas encore dans notre base';
			}
            
        }else{
			$res['success'] = false;
			$res['message'] = 'Veuillez utiliser une methode poste';
		}
        echo json_encode($res);
    }


    public function saveDocumentFromWebhooks(){
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = false;

        $this->loadModel('Documents');
        $document = $this->Documents->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //debug($data);die;

            $docFind = $this->Documents->find('all')->where(["id_in_sellsy" => intval($data['document']['id_in_sellsy'])])->first();
            if ($docFind) {
                $data['document']['id'] = $docFind->id;
                $document = $docFind;
            }
            $document = $this->Documents->patchEntity($document, $data['document'], ['validate' => false]);
            if ($this->Documents->save($document)) {
                $res ['success'] = true;
            }                
        }
        echo json_encode($res);
    }

    public function saveClientFromCrm(){
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = false;

        $this->loadModel('Clients');
        $client = $this->Clients->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $clientToInsert = $data['client'];
            if(isset($data['client']['client_contacts'])){
                            $listeContact = array();
                           
                            foreach($data['client']['client_contacts'] as $key => $contact){
                                unset($contact['client_id']);
                                $oneContact = array();
                                $oneContact = $contact;

                                $this->loadModel('ClientContacts');
                                $contactFind = $this->ClientContacts->find('all')->where(["id_in_sellsy" => intval($contact['id_in_sellsy'])])->first();
                                if($contactFind){
                                    $oneContact["id"] = $contactFind->id;
                                }
                                //debug($oneContact);
                                array_push($listeContact, $oneContact);
                            }
                            $clientToInsert["client_contacts"] = $listeContact;
            }

            //debug($clientToInsert);die;
            $clientFind = $this->Clients->find('all')->where(["id_in_sellsy" => intval($clientToInsert['id_in_sellsy'])])->contain(['ClientContacts'])->first();
            if ($clientFind) {
                $clientToInsert["id"] = $clientFind->id;
                $client = $clientFind;
            }
            $client = $this->Clients->patchEntity($client, $clientToInsert, ['validate' => false, ['associated' => ['ClientContacts']]]);
            //debug($client);die;
            if ($this->Clients->save($client)) {
                $res ['id_in_event'] = $client->id;
                $res ['success'] = true;
            }                
        }
        echo json_encode($res);
    }

    public function saveContactFromCrm(){
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = false;

        $this->loadModel('ClientContacts');
        $client_contact = $this->ClientContacts->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //debug($data);die;

            $contactFind = $this->ClientContacts->find('all')->where(["id_in_sellsy" => intval($data['contact']['id_in_sellsy'])])->first();
            if ($contactFind) {
                $data['contact']['id'] = $contactFind->id;
                $client_contact = $contactFind;
            }
            //debug($contactFind);die;
            $client_contact = $this->ClientContacts->patchEntity($client_contact, $data['contact'], ['validate' => false]);
            //debug($client_contact);die;
            if ($this->ClientContacts->save($client_contact)) {
                $res ['id_in_event'] = $client_contact->id;
                $res ['success'] = true;
            }               
        }
        echo json_encode($res);
    }
	
	
	
	/*
	 * Création WS pour appli mobile
	 * Projet : https://trello.com/c/YNKo1NHF/460-cr%C3%A9er-ws-pour-appli-selfizee-pro
	 *
	 * mercredi 10 avril 2019
	 * autor : Paul
	 */
	// statistique pour dashbord
	public function statGlobal($idEvenement){
		$evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Photos']
        ]);
		// Nombre de photos
		$nbrPhoto = count($evenement->photos);
		// Nombre d'impression effectuée.
		$nbrImp = $evenement->print_counter ? $evenement->print_counter : 0;
		// Nombre de contact collectés
		$nbrContact = 0;
		
		if($nbrPhoto){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
			
            $contactList = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
				->where(['photo_id IN' => $idPhotos])
				->toArray();
                                                        
            $nbrContact = count($contactList);
		}
		
		echo json_encode([
			'nbrPhoto' => $nbrPhoto,
			'nbrImp' => $nbrImp,
			'nbrContact' => $nbrContact
		]);
		exit;
	}
	
	// statistique résumé pour email / sms / démographie
	public function statResume($idEvenement){
		$evenement = $this->Evenements->get($idEvenement, [
            'contain' => ['Photos' => 'PhotoStatistiques', 'FacebookAutos'=>['FacebookAutoSuivis']]
        ]);
        
        $nbrPhoto = count($evenement->photos);
		$nbrImp = $evenement->print_counter ? $evenement->print_counter : 0;
        $nbrContact = 0;
        $nbrContactEmail = 0;
        $nbrContactTel = 0;
        $nbrEmailEnvoye =0;
        $nbrEmailOuvert = 0;
        $nbrSmsEnvoye = 0;
        $nbrSmsOuvert = 0;
		
		
        $nbrTelechargementPhoto = 0;
        $nbrPageVue = 0;
        $smsDeliveryPercent = 0;
        $smsNotDeliveryPercent = 0;
		
        if($nbrPhoto){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $contactList = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos])
                                                        ->toArray();
                                                        
            $nbrContact = count($contactList);
            
            $nbrContactEmail = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $nbrContactTel = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.telephone IS NOT' => NULL])
                                            ->notEq('Contacts.telephone', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            if($nbrContact){
                $this->loadModel('EmailEnvois');
                $emailEnvoi = $this->EmailEnvois->find()
                                                        ->where(['evenement_id' => $idEvenement])
                                                        ->first();
                if(!empty($emailEnvoi)){
                    $nbrEmailEnvoye = $emailEnvoi->total_envoi;
                }
                
            }
            
            /** Stat sms **/
            $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                        ->toArray();
            $nbrContactSms = count($listContactSms);
            $idEnvoiSms = null;
            if(!empty($nbrContactSms)){
                $idEnvoiSms = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find('list')
                                                        ->where(['contact_id IN' => $listContactSms])
                                                        ->toArray();
                $nbrSmsEnvoye = count($idEnvoiSms);
            } 
            
            // Vérifier si la table SmsStatistique existe
			$connection = ConnectionManager::get('default');
			$liste_tables = $connection->getSchemaCollection()->listTables();
			
			if(!empty($idEnvoiSms) && (in_array('sms_stats', $liste_tables) || in_array('sms_statistiques', $liste_tables))){
                $this->loadModel('SmsStatistiques');
                $smsDelivery= $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 1])
                                    ->count();
                                    
                
                $smsNotDelivery = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 2])
                                    ->count();
                
                $smsUnKnow = $this->SmsStatistiques->find()
                                    ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms,'SmsStatistiques.statut'=> 0])
                                    ->count();   
            }
            
            if(!empty($nbrSmsEnvoye)){
                    if(!empty($smsDelivery)){
                        $smsDeliveryPercent = round($smsDelivery/$nbrSmsEnvoye*100);
                    }
                    if(!empty($smsNotDelivery)){
                        $smsNotDeliveryPercent = round($smsNotDelivery/$nbrSmsEnvoye*100);
                    }
                    if(!empty($smsUnKnow)){
                        $smsUnKnowPercent = round($smsUnKnow/$nbrSmsEnvoye*100);
                    }
            }
            
        }
        
        $this->loadModel('EvenementStatCampaigns');
        $eventStatCampaign = $this->EvenementStatCampaigns->find()
                                            ->where(['evenement_id' => $evenement->id])
                                            ->first();
        
		/* Stat emaill */
		$total = 0;
		$delivredPourcent = 0;
		$ouvertPourcent = 0;
		$clickPourcent = 0;
		$blockedPourcent = 0;
		$spamPourcent = 0;
		$hardBouncePourcent = 0;
		$softBouncePourcent = 0;
		$messageDeferredPourcent = 0;
		$messageUnsubscribedPourcent = 0;
		$messageSentCount = "-";
		$messageOpenedCount  = "-";
		$messageClickedCount = 0;
		$boucePourcent = 0;
		
		if(!empty($eventStatCampaign)){
			$total = $eventStatCampaign->total;
			$messageSentCount = $eventStatCampaign->message_sent_count;
			$messageOpenedCount = $eventStatCampaign->message_opened_count;
			$messageClickedCount = $eventStatCampaign->message_clicked_count;
			$messageBlockedCount = $eventStatCampaign->message_blocked_count;
			$messageSpamCount = $eventStatCampaign->message_spam_count;
			$messageHardBouncedCount  = $eventStatCampaign->message_hard_bounced_count ;
			$messageSoftBouncedCount = $eventStatCampaign->message_soft_bounced_count;
			$messageDeferredCount = $eventStatCampaign->message_deferred_count;
			$messageUnsubscribedCount = $eventStatCampaign->event_unsubscribed_count;
			
			if(!empty($total)){
				$delivredPourcent = ($messageSentCount*100) / $total;
				$delivredPourcent = round($delivredPourcent, 2);
				
				$blockedPourcent = ($messageBlockedCount*100) / $total;
				$blockedPourcent = round($blockedPourcent, 2);
				
				$hardBouncePourcent = ($messageHardBouncedCount*100)/$total; 
				$hardBouncePourcent = round($hardBouncePourcent, 2);
				
				$softBouncePourcent = ($messageSoftBouncedCount*100) /$total;
				$softBouncePourcent = round($softBouncePourcent, 2);
				
				$bouceCount = $messageHardBouncedCount + $messageSoftBouncedCount;
				$boucePourcent = ($bouceCount*100)/$total;
				$boucePourcent = round($boucePourcent, 2);
				
				$messageDeferredPourcent = ($messageDeferredCount*100) / $total;
				$messageDeferredPourcent = round($messageDeferredPourcent, 2);
				
				if(!empty($messageSentCount)){
					$ouvertPourcent = ($messageOpenedCount*100)/ $messageSentCount;
					$ouvertPourcent = round($ouvertPourcent, 2);
					
					$messageUnsubscribedPourcent = ($messageUnsubscribedCount *100) / $messageSentCount;
					$messageUnsubscribedPourcent = round($messageUnsubscribedPourcent, 2);
					
					$spamPourcent = ($messageSpamCount*100)/ $messageSentCount;
					$spamPourcent = round($spamPourcent, 2);
				}
				
				if(!empty($messageOpenedCount)){
					$clickPourcent = ($messageClickedCount*100) / $messageOpenedCount;
					$clickPourcent = round($clickPourcent, 2);
				}
				
			}
		}
		
		
		$isFacebookActive = 'Non';
		if(count($evenement->facebook_autos)){
			$isFacebookActive = 'Oui';
		}
		$nbrFbAutoPoste = 0;
		foreach($evenement->facebook_autos as $fb_auto){
			$nbrFbAutoPoste = $nbrFbAutoPoste + count($fb_auto->facebook_auto_suivis);
		}
		
		
		$hommePourcent = 
		$femmePourcent = 

		$moins_20Pourcent = 
		$v_tPourcent = 
		$t_qPourcent = 
		$q_sPourcent = 
		$plus_60Pourcent = 

		$sourirePourcent = 
		$neutrePourcent = 
		$colerePourcent = 
		$peurPourcent = 
		$surprisPourcent = 
		$age_moyen = 
		$tristePourcent = 0;
		if(!empty($evenement->photos)){
			$nbrPersonnes = 
			$nbrMoins20 = 
			$nbr20_30 = 
			$nbr30_40 = 
			$nbr40_60 = 
			$nbrPlus60 = 
			$age_moyen =

			//Emotion
			$nbrSourire = 
			$nbrNeutre = 
			$nbrColere = 
			$nbrPeur = 
			$nbrSurpris = 
			$nbrTriste = 
			$nbrHommes = 
			$nbrFemmes = 0;
			foreach($evenement->photos as $item){
				if(!empty($item->photo_statistique)){
					$nbrHommes += $item->photo_statistique->nb_homme;
					$nbrFemmes += $item->photo_statistique->nb_femme;
					$nbrMoins20 += $item->photo_statistique->moins_20;
					$nbr20_30 += $item->photo_statistique->a_20_30;
					$nbr30_40 += $item->photo_statistique->a_30_40;
					$nbr40_60 += $item->photo_statistique->a_40_60;
					$nbrPlus60 += $item->photo_statistique->plus_60;
					$age_moyen += $item->photo_statistique->age_total;
					
					$nbrSourire += $item->photo_statistique->nb_sourire;
					$nbrNeutre += $item->photo_statistique->nb_neutre;
					$nbrColere += $item->photo_statistique->nb_colere;
					$nbrPeur += $item->photo_statistique->nb_peur;
					$nbrSurpris += $item->photo_statistique->nb_surpris;
					$nbrTriste += $item->photo_statistique->nb_triste;
				}
			}
			
			if($nbrHommes || $nbrFemmes){
				$nbrPersonnes = $nbrHommes + $nbrFemmes;
				$hommePourcent = $nbrHommes * 100 / $nbrPersonnes;
				$hommePourcent = round($hommePourcent, 0);
				$femmePourcent = $nbrFemmes * 100 / $nbrPersonnes;
				$femmePourcent = round($femmePourcent, 0);
				
				$age_moyen = $age_moyen / $nbrPersonnes;
				$age_moyen = round($age_moyen, 0);
				
				$moins_20Pourcent = $nbrMoins20 * 100 / $nbrPersonnes;
				$moins_20Pourcent = round($moins_20Pourcent, 0);
				$v_tPourcent = $nbr20_30 * 100 / $nbrPersonnes;
				$v_tPourcent = round($v_tPourcent, 0);
				$t_qPourcent = $nbr30_40 * 100 / $nbrPersonnes;
				$t_qPourcent = round($t_qPourcent, 0);
				$q_sPourcent = $nbr40_60 * 100 / $nbrPersonnes;
				$q_sPourcent = round($q_sPourcent, 0);
				$plus_60Pourcent = $nbrPlus60 * 100 / $nbrPersonnes;
				$plus_60Pourcent = round($plus_60Pourcent, 0);
				
				$totalSentiment = $nbrSourire + $nbrNeutre + $nbrColere + $nbrPeur + $nbrSurpris + $nbrTriste;
				$sourirePourcent = $nbrSourire * 100 / $totalSentiment;
				$sourirePourcent = round($sourirePourcent, 0);
				$neutrePourcent = $nbrNeutre * 100 / $totalSentiment;
				$neutrePourcent = round($neutrePourcent, 0);
				$colerePourcent = $nbrColere * 100 / $totalSentiment;
				$colerePourcent = round($colerePourcent, 0);
				$peurPourcent = $nbrPeur * 100 / $totalSentiment;
				$peurPourcent = round($peurPourcent, 0);
				$surprisPourcent = $nbrSurpris * 100 / $totalSentiment;
				$surprisPourcent = round($surprisPourcent, 0);
				$tristePourcent = $nbrTriste * 100 / $totalSentiment;
				$tristePourcent = round($tristePourcent, 0);
			}
		}
		
		echo json_encode([
			'nbrPhoto' => $nbrPhoto,
			'nbrImp' => $nbrImp,
			'nbrContact' => $nbrContact,
			'nbrContactEmail' => $nbrContactEmail,
			'nbrContactTel' => $nbrContactTel,
			'nbrEmailEnvoye' => $nbrEmailEnvoye,
			'nbrSmsEnvoye' => $nbrSmsEnvoye,
			
			'email' => [
                'messageDeliveryCount' => $messageSentCount,
				'deliveryPercent' => $delivredPourcent,
                'messageOpenedCount' => $messageOpenedCount,
				'ouvertPercent' => $ouvertPourcent,
                'messageClickedCount' => $messageClickedCount,
				'clickPercent' => $clickPourcent,
                "blockedPourcent" => $blockedPourcent,
                "spamPourcent" => $spamPourcent,
                "hardBouncePourcent" => $hardBouncePourcent,
                "softBouncePourcent" => $softBouncePourcent,
                "messageDeferredPourcent" => $messageDeferredPourcent,
                "messageUnsubscribedPourcent" => $messageUnsubscribedPourcent,
                "boucePourcent" => $boucePourcent,
			],
			'sms' => [
				'deliveryPercent' => $smsDeliveryPercent,
				'erreurPercent' => $smsNotDeliveryPercent
			],
			'facebook' => [
				'isFacebookActive' => $isFacebookActive,
				'nbrFbAutoPoste' => $nbrFbAutoPoste
			],
			'demographie' => [
                'nbrPersonnes' => $nbrPersonnes,
                'nbrHommes' => $nbrHommes,
				'hommePercent' => $hommePourcent,
                'nbrFemmes' => $nbrFemmes,
				'femmePercent' => $femmePourcent,
				'age_moyen' => $age_moyen,
				'age_moins_20Percent' => $moins_20Pourcent,
				'age_20_30Percent' => $v_tPourcent,
				'age_30_40Percent' => $t_qPourcent,
				'age_40_60Percent' => $q_sPourcent,
				'age_plus_60Percent' => $plus_60Pourcent,
				'sourirePercent' => $sourirePourcent,				
				'neutrePercent' => $neutrePourcent,				
				'colerePercent' => $colerePourcent,				
				'peurPercent' => $peurPourcent,				
				'surprisPercent' => $surprisPourcent,				
				'tristePercent' => $tristePourcent				
			]
		]);
		
		exit;
	}

	public function newdesign()
    {
        $this->viewBuilder()->setLayout('nouveau_template');
	}

	public function newdesign2()
    {
		$this->viewBuilder()->setLayout('nouveau_template');
		$this->render('newdesign');
	}


    public function board($idEvenement){
        $evenement = $this->Evenements->get($idEvenement, [
			'contain' => [
					'Fonctionnalites','Crons','FacebookAutos'=>['FacebookAutoSuivis'],'Galeries',
					'Photos' => function($q) { return $q->order(['id' => 'DESC'])->limit(6);}
			]
        ]);

        $this->loadModel('Timelines');
        $timeline = $this->Timelines->find()
                                ->order(['date_timeline' => 'DESC'])
                                ->where(['date_timeline <>'=>'','date_timeline IS NOT' =>NULL])
                                ->where(['evenement_id' => $idEvenement])
                                ->first();

        $listIdFonctionnaliteActive = null;
        if(!empty($evenement->fonctionnalites)){
            $collection = new Collection($evenement->fonctionnalites);
            $ids = $collection->extract(function ($fonctionnalite) {
                return $fonctionnalite->id;
            });
            $listIdFonctionnaliteActive = $ids->toArray();
        }

        $nbrPhoto = count($evenement->photos);
        $nbrContact = 0;
        $nbrContactEmail = 0;
        $nbrPersonnes = 0;
        if($nbrPhoto){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $contactList = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos])
                                                        ->toArray();
                                                        
            $nbrContact = count($contactList);

            $nbrContactEmail = $this->Evenements->Photos->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $idPhotos])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
            $this->loadModel('PhotoStatistiques');                                   
            $qr     =   $this->PhotoStatistiques->find('all');
            $res    =   $qr->select([
                                'sum_homme' =>$qr->func()->sum('nb_homme'),
                                'sum_femme' => $qr->func()->sum('nb_femme')
                            ])
                        ->where(['PhotoStatistiques.photo_id IN' => $idPhotos])
                        ->first(); 
            $nbrPersonnes = $res->sum_homme + $res->sum_femme;


            if($nbrContactEmail){
                $this->loadModel('EvenementStatCampaigns');
                $eventStatCampaign = $this->EvenementStatCampaigns->find()
                                            ->where(['evenement_id' => $evenement->id])
                                            ->first();
            }
        }

        $this->set(compact('evenement','idEvenement','timeline','nbrPhoto','nbrContact','listIdFonctionnaliteActive','nbrContactEmail','eventStatCampaign','nbrPersonnes'));
        //$this->set('isConfiguration',false);
    }

    public function getByCodeLogiciel($codeLogiciel){
        Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
        FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
        Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable Date
        FrozenDate::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable Date

        $evenement = $this->Evenements->find('all')
                                         ->where(['code_logiciel' => $codeLogiciel])
                                         ->first();
        $res['success'] = false;
        if(!empty($evenement)){
            $res['success'] = true;
            $res['evenement'] = $evenement;
        }else{
            $res['success'] = false;
            $res['message'] = 'Evenement non trouvé';
        }
        $this->set(compact('res'));

	}
	
	public function rejoindreEvent() {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $res['success'] = false;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //debug($user);die;
            //$this->loadModel('Evenements');
            $evenement = $this->Evenements->find('all')
                                        ->contain(['Photos'])
                                        ->where(['code_logiciel' => $data['code_event'] ])
                                        ->first();
            if($evenement) {
                $res['success'] = true;
                $envtNew = array();
                $nbrPhoto = intval($evenement->photo_count);
                $nbrContact = 0;
                if($nbrPhoto){
                    $collection = new Collection($evenement->photos);
                    $id = $collection->extract('id');
                    $idPhotos = $id->toList();
                    
                    $contactList = $this->Evenements->Photos->Contacts
                                            ->find('list',['valueField' => 'id'])
                                            ->where(['photo_id IN' => $idPhotos])
                                            ->toArray();
                    $nbrContact = count($contactList);
                }
                $envtNew['id'] = $evenement->id;
                $envtNew['nom'] = $evenement->nom;
                $envtNew['slug'] = $evenement->slug;
                $envtNew['code_logiciel'] = $evenement->code_logiciel;
                $envtNew['date_debut'] = empty($evenement->date_debut) ? "" : $evenement->date_debut->format('d/m/Y');
                $envtNew['date_fin'] = empty($evenement->date_fin) ? "" : $evenement->date_fin->format('d/m/Y');
                $envtNew['nbr_photo'] = $nbrPhoto;
                $envtNew['nbr_impression'] = $evenement->print_counter;
                $envtNew['nbr_contact'] = $nbrContact;
                
                $res['evenement'] = $envtNew;
            } 
        }
        echo json_encode($res);
        //$this->set(compact('res'));
    }
	
}
