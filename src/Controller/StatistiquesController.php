<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Collection\Collection;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * FacebookAutos Controller
 *
 * @property \App\Model\Table\FacebookAutosTable $FacebookAutos
 *
 * @method \App\Model\Entity\FacebookAuto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatistiquesController extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['generale','email','emailViaWebhooks','sms', 'statGeographique', 'statDevice', 'statSource', 'recapGraphique', 'detailStatEmail'])) {
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

        //==== ACCES EVENT
        if($user['role_id'] == 5) {
            if(in_array($action, ['email','sms', 'statGeographique', 'statDevice', 'statSource', 'recapGraphique', 'detailStatEmail'])
             && $user['is_active_acces_event'] == true && $user['is_active_acces_stat'] == true) {
                return true;
            }
        }
        
  
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    
    public function generale($idEvenement ){
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $this->set(compact('evenement','idEvenement'));
    }
    
	public function demographie($idEvenement = null){
		
		$this -> loadModel('Evenements');
		$evenement = $this -> Evenements ->get($idEvenement,[
			'contain' => ['Fonctionnalites','Photos' => ['PhotoStatistiques']]
		]);
		
		$this->set(compact('evenement', 'idEvenement'));
	}
	
    public function email($idEvenement = null){
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries','Fonctionnalites']
                                       ]);
        if(!empty($evenement->photos)){
            
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
                                                        
            $nbrContactEmail = count($listContactEmail);
            
            if(!empty($nbrContactEmail)){
                
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
                          
            $this->loadModel('EvenementStatCampaigns');
            $eventStatCampaign = $this->EvenementStatCampaigns->find()
                                            ->where(['evenement_id' => $evenement->id])
                                            ->first();
            }
        }
        $this->set(compact('evenement','idEvenement','topDomaine','eventStatCampaign'));
    }
    
    public function emailViaWebhooks($idEvenement = null){
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                       ]);
        $nbrContactEmail = 0; 
        $nbrEmailEnvoye = 0;
        $delivredPourcent = 0;
        $ouvertPourcent = 0;
        $clickPourcent = 0;
        $spamPourcent = 0;
        $blockedPourcent = 0;
        
        $nbrEmailSent = 0;
        $nbrEmailOuvert = 0;
        $nbrEmailClick = 0;
        $moyenOuverture = "";
        $moyenClick = "";
        $nbrMoyenneDouverture = "";
        
        if(!empty($evenement->photos)){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
                                                        
            $nbrContactEmail = count($listContactEmail);
            
            if(!empty($nbrContactEmail)){
                $idEmailEnvoi = $this->Evenements->Photos->Contacts->ContactEmailsEnvois->find('list')
                                                        ->where(['contact_id IN' => $listContactEmail])
                                                        ->toArray();
                $nbrEmailEnvoye = count($idEmailEnvoi);
               
                
                if(!empty($nbrEmailEnvoye)){
                    $envoiEmailStatistiques = $this->loadModel('EnvoiEmailStatistiques');
                    
                    $nbrEmailSent = $this->EnvoiEmailStatistiques->find()
                                            ->where(['EnvoiEmailStatistiques.envoi_id IN' => $idEmailEnvoi,'EnvoiEmailStatistiques.event_type'=>'sent'])
                                            ->group('EnvoiEmailStatistiques.envoi_id')
                                            ->count();
                    $delivredPourcent = ($nbrEmailSent *100) / $nbrContactEmail;
                    $delivredPourcent = round($delivredPourcent, 2);
                    
                    if(!empty($nbrEmailSent)){
                        $nbrEmailOuvert = $this->EnvoiEmailStatistiques->find()
                                                ->where(['EnvoiEmailStatistiques.envoi_id IN' => $idEmailEnvoi,'EnvoiEmailStatistiques.event_type'=>'open'])
                                                ->group('EnvoiEmailStatistiques.envoi_id')
                                                ->count();
                        $ouvertPourcent = ($nbrEmailOuvert*100) / $nbrEmailSent;
                        $ouvertPourcent = round($ouvertPourcent, 2);
                    }
                    
                    if(!empty($nbrEmailOuvert)){                    
                        $nbrEmailClick = $this->EnvoiEmailStatistiques->find()
                                                ->where(['EnvoiEmailStatistiques.envoi_id IN' => $idEmailEnvoi,'EnvoiEmailStatistiques.event_type'=>'click'])
                                                ->group('EnvoiEmailStatistiques.envoi_id')
                                                ->count();
                        $clickPourcent = ($nbrEmailClick*100) / $nbrEmailOuvert;
                        $clickPourcent = round($clickPourcent, 2);
                    }
                    $idEmailEnvoiList = Text::toList($idEmailEnvoi,",",",");
                    $connection = ConnectionManager::get('default');
                    if(!empty($nbrEmailSent) && !empty($nbrEmailOuvert)){
                       /* $subquery  = $this->EnvoiEmailStatistiques
                                                ->find()
                                                ->select(function (\Cake\ORM\Query $query) {
                                                    return [
                                                        'diffSentOpen' => $query->newExpr(
                                                            'TIMESTAMPDIFF(SECOND, EnvoiEmailStatistiques.date_event, OpenEmailStatistiques.date_event)'
                                                        )
                                                    ];
                                                })
                                                ->leftJoinWith('OpenEmailStatistiques')
                                                ->where(['EnvoiEmailStatistiques.event_type'=>'sent','EnvoiEmailStatistiques.envoi_id IN' => $idEmailEnvoi])
                                                ->group(['EnvoiEmailStatistiques.envoi_id']);
                                                
                        $query = $this->EnvoiEmailStatistiques->find()->select(['latitude' => 'latitude_test'])->from(['sub' => $subQuery]);
                        */
                        
                        
                        $sql = 'SELECT FROM_UNIXTIME(AVG(diffSentOpen),"%h:%i\':%s\'\'") as moyenOuvert FROM (SELECT TIMESTAMPDIFF(SECOND, sentStat.date_event, openStat.date_event) as diffSentOpen FROM `envoi_email_statistiques` as sentStat LEFT JOIN `envoi_email_statistiques` as openStat ON( openStat.envoi_id = sentStat.envoi_id AND openStat.event_type="open" ) WHERE sentStat.event_type ="sent" AND  sentStat.envoi_id IN('.$idEmailEnvoiList.') GROUP BY  sentStat.envoi_id) as theDiff';
                        $results = $connection->execute($sql)->fetchAll('assoc');
                        if(!empty($results)){
                            $res = $results[0];
                            if(!empty($res)){
                                $moyenOuverture = $res['moyenOuvert'];
                            }
                        }
                    }
                    
                    if(!empty($nbrEmailOuvert) && !empty($nbrEmailClick)){
                        $sql= 'SELECT FROM_UNIXTIME(AVG(diffOpenClick),"%h:%i\':%s\'\'") as moyenClick FROM (SELECT TIMESTAMPDIFF(SECOND, openStat.date_event, clickStat.date_event) as diffOpenClick FROM `envoi_email_statistiques` as clickStat LEFT JOIN `envoi_email_statistiques` as openStat ON( openStat.envoi_id = clickStat.envoi_id AND openStat.event_type="open" ) WHERE clickStat.event_type ="click" AND  clickStat.envoi_id IN('.$idEmailEnvoiList.') GROUP BY clickStat.envoi_id) as theDiff ';
                        $results = $connection->execute($sql)->fetchAll('assoc');
                        if(!empty($results)){
                            $res = $results[0];
                            if(!empty($res)){
                                $moyenClick = $res['moyenClick'];
                            }
                        }
                    }
                    if(!empty($nbrEmailOuvert)){
                        $nbrMoyenneDouverture = $nbrEmailSent / $nbrEmailOuvert;
                        $nbrMoyenneDouverture = round($nbrMoyenneDouverture, 2);
                    }
                    
                    
                    $nbrEmailSpam = $this->EnvoiEmailStatistiques->find()
                                            ->where(['EnvoiEmailStatistiques.envoi_id IN' => $idEmailEnvoi,'EnvoiEmailStatistiques.event_type'=>'spam'])
                                            ->group('EnvoiEmailStatistiques.envoi_id')
                                            ->count();
                    $spamPourcent = ($nbrEmailSpam*100) / $nbrContactEmail;
                    $spamPourcent = round($spamPourcent, 2);
        
                    $nbrEmailBlocked = $this->EnvoiEmailStatistiques->find()
                                            ->where(['EnvoiEmailStatistiques.envoi_id IN' => $idEmailEnvoi,'EnvoiEmailStatistiques.event_type'=>'blocked'])
                                            ->group('EnvoiEmailStatistiques.envoi_id')
                                            ->count();   
                    $blockedPourcent = ($nbrEmailBlocked*100) / $nbrContactEmail;
                    $blockedPourcent = round($blockedPourcent, 2);          
                }
                
                
                
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
            
            
            
        }
        $this->set(compact('moyenOuverture','moyenClick','nbrMoyenneDouverture'));
        $this->set(compact("topDomaine","nbrEmailSent","nbrEmailOuvert", "nbrEmailClick"));
        $this->set(compact("nbrContactEmail","nbrEmailEnvoye", "delivredPourcent","ouvertPourcent","clickPourcent", "spamPourcent","blockedPourcent"));
        $this->set(compact('evenement','idEvenement'));
    }
    
    public function emailOld($idEvenement= null){
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);
        
        $emailStat = $this->Evenements->EmailStatistiques->find('all')
                                            ->where(['EmailStatistiques.evenement_id' => $idEvenement])
                                            ->contain(['Evenements'])
                                            ->first();
                                            
        $nbrContactEmail = 0;
        $nbrContactSms = 0;
        $nbrEmailEnvoye =0;
        $nbrSmsEnvoye = 0;
        
        if(!empty($evenement->photos)){
            
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
                                                        
            $nbrContactEmail = count($listContactEmail);
    
                                                        
            
            if(!empty($nbrContactEmail)){
                $nbrEmailEnvoye = $this->Evenements->Photos->Contacts->EmailEnvois->find()
                                                        ->where(['contact_id IN' => $listContactEmail])
                                                        ->count();
                
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
            
           
            
            //debug($listeContactWhoHasEmail);die;
            
        }
   
            
        $this->set(compact('evenement','idEvenement','emailStat','nbrContactEmail','nbrContactSms','nbrEmailEnvoye','topDomaine'));
    }
    
    public function sms($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries','Fonctionnalites']]);
        
        $nbrContactSms = 0;
        $nbrSmsEnvoye = 0;
        $smsDeliveryPercent = 0;
        $smsNotDeliveryPercent = 0;
        $smsUnKnowPercent = 0;
        $smsClicked = 0;
        $smsClickedPourcent = 0;

        $smsDelivery = 0;
        $smsNotDelivery = 0;

        // Vérifier si la table SmsStatistique existe
        $connection = ConnectionManager::get('default');
        $liste_tables = $connection->getSchemaCollection()->listTables();
        
        if(!empty($evenement->photos) && (in_array('sms_stats', $liste_tables) || in_array('sms_statistiques', $liste_tables))){
            
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
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
            
			$connection = ConnectionManager::get('default');
			$liste_tables = $connection->getSchemaCollection()->listTables();
			
			if(!empty($idEnvoiSms)){
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
                    
                    if(!empty($smsClicked)){
                        $smsClickedPourcent = round($smsClicked/$nbrSmsEnvoye*100);
                    }
            }
        }
        $this->set(compact('evenement','idEvenement','nbrSmsEnvoye', 'smsDeliveryPercent','smsNotDeliveryPercent','smsUnKnowPercent','smsClickedPourcent'));
        $this->set(compact('smsDelivery', 'smsNotDelivery', 'smsClicked'));
    }
    
    public function detailStatEmail($idEvenement, $idContact){
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Galeries']
                                        ]);
                                        
        $this->loadModel('Contacts');
        $contact = $this->Contacts->get($idContact);
                                        
        $this->loadModel('Envois');
        
        
        $envois = $this->Envois->find()
                                ->where(['envoi_type'=>'email','contact_id'=>$idContact])
                                ->toArray();
                                
        $collection = new Collection($envois);
        $id = $collection->extract('id');
        $envoiId = $id->toList();
        $dates  = $collection->extract('created');
        $dateEnvois = $dates->toList();
            
        $statistiques = null;
        if(!empty($envoiId)){
            $this->loadModel('EnvoiEmailStatistiques');
            $statistiques = $this->EnvoiEmailStatistiques->find()
                                            ->where(['EnvoiEmailStatistiques.envoi_id IN' => $envoiId])
                                            ->order(['EnvoiEmailStatistiques.date_event'=>'DESC'])
                                            ->group(['EnvoiEmailStatistiques.date_event','EnvoiEmailStatistiques.event_type']);
                                            
        }
        $this->set(compact('evenement','idEvenement'));
        $this->set(compact('statistiques','contact','dateEnvois'));
    }
    

    //============= STAT GOOGLE ANALYTICS

    public function geographique($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
       	
       	$this->loadComponent('GoogleAnalyticsTracking');
        //$stats = $this->GoogleAnalyticsTracking->getPageEvenementsByCountry($idEvenement);
       	$stats = null;
        $galerie_encode = $this->getGalerie($idEvenement);
        if(!empty($galerie_encode)) $stats = $this->GoogleAnalyticsTracking->getGaleriesByCountry($galerie_encode);

        //debug($stats);die;
        /*if(!empty($stats)){
        	foreach ($stats as $key => $stat) {
        		debug($stat);
        	}
        }die;*/
                  
        $this->set(compact('evenement','idEvenement', 'stats'));
    }

    public function device($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $this->loadComponent('GoogleAnalyticsTracking');
        //$stats = $this->GoogleAnalyticsTracking->getDeviceEvenements($idEvenement);

       	$stats = null;
        $galerie_encode = $this->getGalerie($idEvenement);
        if(!empty($galerie_encode)) $stats = $this->GoogleAnalyticsTracking->getDeviceGaleries($galerie_encode);
        //debug($stats);die;
                  
        $operatingSystemes = $this->GoogleAnalyticsTracking->getOs();
        $this->set(compact('evenement','idEvenement', 'stats', 'operatingSystemes'));
    }


    public function navigateur($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $this->loadComponent('GoogleAnalyticsTracking');
        //$stats = $this->GoogleAnalyticsTracking->getDeviceEvenements($idEvenement);

        $stats = null;
        $galerie_encode = $this->getGalerie($idEvenement);
        if(!empty($galerie_encode)) $stats = $this->GoogleAnalyticsTracking->getNavigateurGaleries($galerie_encode);
        //debug($stats);die;
        $browsers = $this->GoogleAnalyticsTracking->getBrowser();//debug($browsers);die;
        $this->set(compact('evenement','idEvenement', 'stats', 'browsers'));
    }

    public function source($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $this->loadComponent('GoogleAnalyticsTracking');
        //$stats = $this->GoogleAnalyticsTracking->getTrafficSourceEvenements($idEvenement);

       	$stats = null;
        $galerie_encode = $this->getGalerie($idEvenement);
        if(!empty($galerie_encode)) $stats = $this->GoogleAnalyticsTracking->getTrafficSourceGaleries($galerie_encode);
        //debug($stats);die;
                  
        $this->loadComponent('GoogleAnalytics');
        $canaux = $this->GoogleAnalytics->getCanaux();//debug($canaux);die;

        $this->set(compact('evenement','idEvenement', 'stats', 'canaux'));
    }

    public function getGalerie($idEvenement = null)
    {
        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getPageGaleriesSouvenir();
        //$id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT)); 

        $this->loadModel('Galeries');
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement, [
                        'contain' => ['Galeries']
                ]);
        $galeries = $evenement->galeries;
        $collection = new Collection($galeries);
        $listeIdGalerie = $collection->extract('id');
        $listeIdGalerie = $listeIdGalerie->toList();
    
        //debug($galeries);die;//debug($listeIdGalerie);die;
        $stat_evenements = []; $galerie_id_encode = "";

        if(!empty($stats)){
            foreach ($stats as $key => $stat) {
                $page_path = $stat[0];
                $stat_array = explode('/', $page_path);   
                $idEncode = $stat_array[count($stat_array)-1]; 
                $id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT));            
                //debug($idEncode." ==> ".$id);
                if(in_array($id, $listeIdGalerie)){
                    //$stat_evenements[] = $stat;
                    $galerie_id_encode = $idEncode;
                }
            }
        }
        //die;
        /*if(!empty($stat_evenements)) {
            return $stat_evenements['0']['0'];          
        }*/
        //return null;
        return $galerie_id_encode;
    }



    //===== STAT GOOGLE ¨PAGE SOUV

    public function statGeographique($idEvenement)
    {
        $this->loadModel('Evenements');
        //$evenement = $this->Evenements->find('all',['contain'=>['Photos','Galeries']])->where(['id'=>$idEvenement])->toArray();
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $stats = null;
        $this->loadComponent('GoogleAnalyticsTracking');
        if(!empty($evenement)) $stats = $this->GoogleAnalyticsTracking->getStatGeographique($idEvenement);

        //debug($stats);die;
        /*if(!empty($stats)){
            foreach ($stats as $key => $stat) {
                debug($stat);
            }
        }die;*/
                  
        $this->set(compact('evenement','idEvenement', 'stats'));
        $this->render('geographique');
    }

    public function statDevice($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $stats = null;
        $this->loadComponent('GoogleAnalyticsTracking');
        if(!empty($evenement)) $stats = $this->GoogleAnalyticsTracking->getStatDevice($idEvenement);                  

        $operatingSystemes = $this->GoogleAnalyticsTracking->getAllOperatingSystems();
        $this->set(compact('evenement','idEvenement', 'stats', 'operatingSystemes'));
        $this->render('device');
    }

    public function statNavigateur($idEvenement = null)
    {

        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $stats = null;
        $this->loadComponent('GoogleAnalyticsTracking');
        if(!empty($evenement)) $stats = $this->GoogleAnalyticsTracking->getStatNavigateur($idEvenement);

        $browsers = $this->GoogleAnalyticsTracking->getAllBrowsers();//debug($browsers);die;
        $this->set(compact('evenement','idEvenement', 'stats', 'browsers'));
        $this->render('navigateur');
    }

    public function statSource($idEvenement = null)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $stats = null;
        $this->loadComponent('GoogleAnalyticsTracking');
        if(!empty($evenement)) $stats = $this->GoogleAnalyticsTracking->getStatSource($idEvenement);

        $this->loadComponent('GoogleAnalytics');
        $canaux = $this->GoogleAnalyticsTracking->getAllSources();//debug($canaux);die;

        $this->set(compact('evenement','idEvenement', 'stats', 'canaux'));
        $this->render('source');
    }

    //============ STAT RECAP QUOTIDIENNE

     public function recapGraphique($idEvenement = null, $page = 1)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $listeIdPhoto = $this->Photos->find('list', ['valueField'=> 'id'])->where(['evenement_id IN' =>$idEvenement, 'is_in_corbeille'=>false, 'deleted'=>false])->toArray();
        //debug($listeIdPhoto);die;
        $date_debut = $evenement->date_debut->format('Y-m-d');
        $date_fin = $evenement->date_fin->format('Y-m-d');
        $dates = []; $stats = [];
        $i = 0;
        $date1 = new \DateTime($date_debut);
        $date2 = new \DateTime($date_fin);
        $interval = $date1->diff($date2);
        $diff = $interval->format('%a');
        //debug(intval($diff));die;
        $total_y = 10;
        $nbr_pagination = 1;
        if($diff > 10) $nbr_pagination = ceil($diff / $total_y);

        $i= 0;
        if($page>1){
            $i = $total_y * ($page - 1);
        }
        //debug($diff); die;
        //debug($total_y*$page);

        for($i;$i < ($total_y*$page); $i++){

            $date = date('Y-m-d', strtotime( $date_debut. ' +'.($i).' day'));
            if($date >= $date_debut && $date <= $date_fin) {
                $dates[] = $date;

                $photos_prises = $this->Photos->find('all')->where(['DATE(created)' => $date, 'deleted'=> false, 'is_in_corbeille'=>false, 'evenement_id' =>$idEvenement])->toArray();
                $email_envoyes = $this->Contacts->find('all')
                                  ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                  ->matching('Envois', function ($q) use($date) { return $q->where(['Envois.envoi_type' => 'email', 'DATE(Envois.created)' => $date]);})
                                  ->toArray();

                $sms_envoyes = $this->Contacts->find('all')
                                ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                ->matching('Envois', function ($q) use($date) { return $q->where(['Envois.envoi_type' => 'sms', 'DATE(Envois.created)' => $date]);})
                                ->toArray();

                $photo_telechargees = $this->Contacts->find('all')
                                ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                ->matching('Photos.PhotoDownloads', function ($q) use($date) { return $q->where(['DATE(PhotoDownloads.created)' => $date]);})
                                ->toArray();

                
                $stat = [];
                $stat['period'] = $date;
                $stat['photos_prises'] = count($photos_prises);
                $stat['email_envoyes'] = count($email_envoyes);
                $stat['sms_envoyes'] = count($sms_envoyes);
                $stat['photo_telechargees'] = count($photo_telechargees);
                //$stats[$date] = $stat;
                $stats[] = $stat;
            }
        }

        //debug($stats);die;

        $axe_y = ['photos_prises', 'email_envoyes', 'sms_envoyes', 'photo_telechargees'];
        $labels = ['Photos prises', 'Email envoyes', 'Sms envoyes', 'Photos telechargees'];
        //debug(gettype($dates));die;
        //debug($stats);die;
        $stat_quotidienne = $this->recapStatQuotidienne($idEvenement);

        $this->set(compact('evenement','idEvenement', 'stats', 'axe_y', 'labels', 'stat_quotidienne', 'nbr_pagination', 'page'));
    }

    public function recapStatQuotidienne($idEvenement = null)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Photos','Galeries']]);
        $listeIdPhoto = $this->Photos->find('list', ['valueField'=> 'id'])->where(['evenement_id IN' =>$idEvenement, 'is_in_corbeille'=>false, 'deleted'=>false])->toArray();
        //debug($listeIdPhoto);die;
        $date = $evenement->date_debut->format('Y-m-d');
        $date_fin = $evenement->date_fin->format('Y-m-d');

        $date = new Date();
        $date = $date->format('Y-m-d');

        $photos_prises = $this->Photos->find('all')->where(['DATE(created)' => $date, 'deleted'=> false, 'is_in_corbeille'=>false, 'evenement_id' =>$idEvenement])->toArray();
        $email_envoyes = $this->Contacts->find('all')
                              ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                              ->matching('Envois', function ($q) use($date) { return $q->where(['Envois.envoi_type' => 'email', 'DATE(Envois.created)' => $date]);})
                              ->toArray();

        $sms_envoyes = $this->Contacts->find('all')
                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                            ->matching('Envois', function ($q) use($date) { return $q->where(['Envois.envoi_type' => 'sms', 'DATE(Envois.created)' => $date]);})
                            ->toArray();

        $photo_telechargees = $this->Contacts->find('all')
                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                            ->matching('Photos.PhotoDownloads', function ($q) use($date) { return $q->where(['DATE(PhotoDownloads.created)' => $date]);})
                            ->toArray();
        $stat = [];
        $stat['photos_prises_now'] = count($photos_prises);
        $stat['email_envoyes_now'] = count($email_envoyes);
        $stat['sms_envoyes_now'] = count($sms_envoyes);
        $stat['photo_telechargees_now'] = count($photo_telechargees);

        return $stat;
    }

    public function statQuot($idEvenement = null)
    {
        $date_now = new Date(); //"2019-02-01"
        $date_now = $date_now->format('Y-m-d');
        //debug();die; //Time::now()
        $this->loadModel('Photos');
        $this->loadModel('Contacts');

        $photos_prises_par_jr = $this->Photos->find('all')->where(['DATE(created)' => $date_now, 'deleted'=> false, 'evenement_id' =>$idEvenement])->toArray();
    
        $listeIdPhoto = $this->Photos->find('list', ['valueField'=> 'id'])->where(['evenement_id IN' =>$idEvenement, 'is_in_corbeille'=>false, 'deleted'=>false])->toArray();
        //debug($listeIdPhoto);die;
        //'contain' => [//'Photos','ContactEmailsEnvois','ContactSmsEnvois', 'Envois'//=> ['EnvoiEmailStatistiques','EnvoiEmailStatDelivres','SmsStatistiquesDelivres']]

        $email_envoyes = $this->Contacts->find('all')
                              ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                              ->matching('Envois', function ($q) use($date_now) { return $q->where(['Envois.envoi_type' => 'email', 'DATE(Envois.created)' => $date_now]);})
                              ->toArray();

        $sms_envoyes = $this->Contacts->find('all')
                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                            ->matching('Envois', function ($q) use($date_now) { return $q->where(['Envois.envoi_type' => 'sms', 'DATE(Envois.created)' => $date_now]);})
                            ->toArray();

        $photo_telechargees = $this->Contacts->find('all')
                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                            ->matching('Photos.PhotoDownloads', function ($q) use($date_now) { return $q->where(['DATE(PhotoDownloads.created)' => $date_now]);})
                            ->toArray();


        debug("Photo prises ==> ".count($photos_prises_par_jr));//die;
        debug("Email envoye ==> ".count($email_envoyes));
        debug("SMS envoye ==> ".count($sms_envoyes));
        debug("Photo telechargee ==> ".count($photo_telechargees));die;
        debug(count($contacts->toArray()));die;
    }    
}