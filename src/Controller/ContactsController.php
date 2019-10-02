<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use ZipArchive;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Expression\QueryExpression;
use Cake\Collection\Collection;
use Cake\Console\ShellDispatcher;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\SendInfoComponent;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    
    public function isAuthorized($user)
    { 
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['liste','formulaire','deleteSelected','deleteAll','delete','uploadCsv','export','voirCsv','deleteCsv', 'exportCsv'])) {
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

        //==== ACCES EVENT && acces sous client
        if($user['role_id'] == 5 || $user['role_id'] == 7) {
            if(in_array($action, ['liste','formulaire','deleteSelected','deleteAll','delete','uploadCsv','export','voirCsv','deleteCsv']) && $user['is_active_acces_data'] == true) {
                $idEvenement = $this->request->getParam('pass.0');
                if($idEvenement == $user['evenement_id']){
                    return true;
                }
            }
        }
        
        if(in_array($action,['deleteAjax','addAjax', 'envoyeAvecEmailProposeAjax', 'getContactPhotoAjax'])){
            return true;
        }
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    
    /**
     * Formulaire method
     *
     * @return \Cake\Http\Response|void
     */
     
     public function formulaire($idEvenement)
    {
        $filtre = $this->request->getQuery('filtre');
        $key = $this->request->getQuery('key');
        $is_postable_on_facebook = $this->request->getQuery('is_postable_on_facebook');
        $is_optin_galerie = $this->request->getQuery('is_optin_galerie');
        $is_option_email_sms = $this->request->getQuery('is_option_email_sms');
        $is_optin_email = $this->request->getQuery('is_optin_email');
        $is_optin_sms = $this->request->getQuery('is_optin_sms');
        $periodeType = $this->request->getQuery('periodeType');
        $periode = $this->request->getQuery('periode');
        
        $date_debut = null;
        $date_fin = null;
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
        
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false])->toArray();
        if($idEvenement==2403){
             $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false,'survey7'=>'Yes'])->toArray();
        }
        
        $countAllContact = 0;
        $countContactEmail = 0;
        $countContactTel = 0;
        if(!empty($listeIdPhoto)){
            $countAllContact = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->count();
        
            $countContactEmail = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $countContactTel = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.telephone IS NOT' => NULL])
                                            ->notEq('Contacts.telephone', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $isEmailNotVide =   $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->where(['Contacts.email IS NOT' => NULL,'Contacts.email <>' => ''])
                                    ->count();
            if($isEmailNotVide){
                $isSurvey1ContentEmail = $this->Contacts->Photos->find('all')
                                        ->where(['Photos.evenement_id IN' => $idEvenement])
                                        ->where(['Photos.survey1 IS NOT' => NULL,'Photos.survey1 <>' => ''])
                                        ->count();
            }
        }
        
        $countAllSurveyNotEmpty = array();
        for($survey =1; $survey <=7 ; $survey++ ){
            $nom = 'survey'.$survey;
            $countSurveyNotEmpty = $this->Contacts->Photos->find()
                                            ->where([
                                                'Photos.evenement_id' => $idEvenement,
                                                'Photos.'.$nom.' IS NOT' => NULL,
                                                'Photos.'.$nom.' <>' => ''
                                            ])->count();
            $countAllSurveyNotEmpty[$nom] = $countSurveyNotEmpty;
            
        }
        
        $options['listeIdPhoto'] = $listeIdPhoto;
        $options['key'] = $key;
        $options['is_postable_on_facebook'] = $is_postable_on_facebook;
        $options['is_optin_galerie'] = $is_optin_galerie;
        $options['is_option_email_sms'] = $is_option_email_sms;
        $options['is_optin_email'] = $is_optin_email;
        $options['is_optin_sms'] = $is_optin_sms;
        $options['date_debut'] = $date_debut;
        $options['date_fin'] = $date_fin;
        $options['periode'] = $periode;
        
        
        $this->paginate = [
            'contain' => ['Photos'],
            'finder' => [
                'formulaire' => $options
            ],
            'conditions' => ['Photos.evenement_id' => $idEvenement],
            'order' =>['Contacts.id' =>'DESC'],
        ];
        
        if($idEvenement == 2403){
            $this->paginate['conditions'] = ['Photos.evenement_id' => $idEvenement, 'Photos.survey7' => 'Yes'];
        }
        $contacts = $this->paginate($this->Contacts);
        
         //Position colonne 
        $this->loadModel('CsvColonnePositions');
        $csvColonnePositions = $this->CsvColonnePositions->find('all')
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->group(['CsvColonnePositions.csv_colonne_id']);
                                        
        $listeIdColonne = $this->CsvColonnePositions->find('list',['valueField' => 'csv_colonne_id'])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->group(['CsvColonnePositions.csv_colonne_id'])
                                        ->toArray();
        $listePositionChamp = $this->CsvColonnePositions->find('list',['keyField'=>'position' ,'valueField' => 'csv_colonne.nom'])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->toArray();
                                        
        $listePositionDefinie = $this->CsvColonnePositions->find('list',['valueField' => 'position'])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->group(['CsvColonnePositions.csv_colonne_id'])
                                        ->toArray();
                                        
       
        $this->set(compact("is_optin_galerie","is_optin_email","is_optin_sms","is_option_email_sms","is_postable_on_facebook","periodeType",'periode'));
        $this->set(compact('filtre','key','countAllSurveyNotEmpty','listeIdColonne','listePositionDefinie','isEmailNotVide','isSurvey1ContentEmail'));
        $this->set(compact('countAllContact','countContactEmail','countContactTel','csvColonnePositions','listePositionChamp'));
        $this->set(compact('evenement','idEvenement','contacts','options'));
        if($idEvenement==2403){
            $this->render('formulaire_2403');
        }
    }
     
     
    

    /**
     * Liste method
     *
     * @return \Cake\Http\Response|void
     */
    public function liste($idEvenement)
    {
        $filtre = $this->request->getQuery('filtre');
        $key = $this->request->getQuery('key');
        $emailEnvoye = $this->request->getQuery('emailEnvoye');
        $smsEnvoye = $this->request->getQuery('smsEnvoye');
        $optin = $this->request->getQuery('optin');
        $emailOuvert = $this->request->getQuery('emailOuvert');
        $smsOuvert = $this->request->getQuery('smsOuvert');
        $photoTelechargee = $this->request->getQuery('photoTelechargee');
        $emailClick = $this->request->getQuery('emailClick');
        $spam = $this->request->getQuery('spam');
        $is_filtreAvance = $this->request->getQuery('is_filtreAvance');
        $sent = $this->request->getQuery('sent');
        $blocked = $this->request->getQuery('blocked');
        $hardBounce = $this->request->getQuery('hardBounce');
        $bounce = $this->request->getQuery('bounce');
        $countBoucnceTmp = $this->request->getQuery('countBoucnceTmp');
        $unsub = $this->request->getQuery('unsub');
        $smsDelivred = $this->request->getQuery('smsDelivred');
        $smsClicked = $this->request->getQuery('smsClicked');
        $is_postable_on_facebook = $this->request->getQuery('is_postable_on_facebook');
        $is_optin_galerie = $this->request->getQuery('is_optin_galerie');
        $is_option_email_sms = $this->request->getQuery('is_option_email_sms');
        $is_optin_email = $this->request->getQuery('is_optin_email');
        $is_optin_sms = $this->request->getQuery('is_optin_sms');
        
        $customSort = $this->request->getQuery('customSort');
        $customDirection = $this->request->getQuery('customDirection');

        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false])->toArray();
        $countAllContact = 0;
        $nbrEmailEnvoye = 0;
        $nbrEmailOuvert = 0;
        $nbrSmsEnvoye = 0;
        $nbrSmsOuvert = 0;
        $countContactEmail = 0;
        $countContactTel = 0;
        $idContactSmsDelivre = null;
        if(!empty($listeIdPhoto)){
            $countAllContact = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->count();
                                    
            //debug($countAllContact); die;
                                    
                                    
           /* $ttse = $this->Contacts->find()
                                            ->select(['contact_id' =>'Contacts.id' ])
                                            ->where( ['Contacts.photo_id IN'=>$listeIdPhoto])
                                            ->toArray();
            if(!empty($ttse)){
                $liste = json_encode($ttse);
                $array = json_decode($liste, TRUE);
                 debug($array);die;
            }*/
                                            
           
                                            
                                            
            //debug($countAllContact); die;
            //.envoi_type' => "sms"
            $countContactEmail = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.email IS NOT' => NULL])
                                            ->notEq('Contacts.email', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            $countContactTel = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->where(function (QueryExpression $exp) {
                                        $orConditions = $exp->or_(['Contacts.telephone IS NOT' => NULL])
                                            ->notEq('Contacts.telephone', "");
                                        return $exp
                                            ->add($orConditions);
                                    })
                                    ->count();
                                    
            if(!empty($countAllContact)){
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
            
            
               $idEnvoiEmail = $this->Contacts->find('list')
                                    ->matching('Envois', function ($q) {
                                        return $q->where(['Envois.envoi_type' => 'email']);
                                    })
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->toArray();
                $options['idEnvoiEmail'] = $idEnvoiEmail;
                //debug($idEnvoiEmail);
                
                $options['idConctatEmailDelivre'] = null;
                $options['idConctatEmailOuvert'] = null;
                $options['idConctatEmailClique'] = null;
                $options['idContactSmsDelivre'] = null;
               // debug($idEnvoiEmail); die;
                if(!empty($idEnvoiEmail)){
                    $idConctatEmailDelivre =  $this->Contacts->Envois->find('list',['valueField' => 'contact_id'])
                                                    ->matching('EnvoiEmailStatDelivres')
                                                    ->where(['Envois.contact_id IN' => $idEnvoiEmail])
                                                    ->toArray();
                    $options['idConctatEmailDelivre'] = $idConctatEmailDelivre;
                    
                   
                    if(!empty($idConctatEmailDelivre)){
                        $idConctatEmailOuvert =  $this->Contacts->Envois->find('list',['valueField' => 'contact_id'])
                                                    ->matching('EnvoiEmailStatOuvertures')
                                                    ->where(['Envois.contact_id IN' => $idConctatEmailDelivre])
                                                    ->toArray();
                        $options['idConctatEmailOuvert'] = $idConctatEmailOuvert;
                        if(!empty($idConctatEmailOuvert)){
                            $idConctatEmailClique = $this->Contacts->Envois->find('list',['valueField' => 'contact_id'])
                                                    ->matching('EnvoiEmailStatClicks')
                                                    ->where(['Envois.contact_id IN' => $idConctatEmailOuvert])
                                                    ->toArray();
                    
                            $options['idConctatEmailClique'] = $idConctatEmailClique;
                        }
                    }
                    
                    
                     
                }
                
               /* $idContactEmailEnvoye = $this->Contacts->find('list')
                                            ->matching('Envois', function ($q) {
                                                return $q->where(['Envois.envoi_type' => 'email']);
                                            })
                                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                            ->toArray();
                $options['idContactEmailEnvoye'] = $idContactEmailEnvoye;*/
                
                
                //phto dowload
                $listeIdPhotoDownloaded = $this->Contacts->Photos->PhotoDownloads
                                                        ->find('list',['valueField' => 'photo_id'])
                                                        ->where(['PhotoDownloads.photo_id IN' => $listeIdPhoto])
                                                        ->toArray();
                $options['listeIdPhotoDownloaded'] = $listeIdPhotoDownloaded;
                
                
                $idContactSmsEnvoye = $this->Contacts->find('list')
                                            ->matching('Envois', function ($q) {
                                                return $q->where(['Envois.envoi_type' => 'sms']);
                                            })
                                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                            ->toArray();
                $options['idContactSmsEnvoye'] = $idContactSmsEnvoye;
                
                if(!empty($idContactSmsEnvoye)){
                    $idEnvoiSms = $this->Contacts->ContactSmsEnvois->find('list')
                                                            ->where(['contact_id IN' => $idContactSmsEnvoye])
                                                            ->toArray();
                    $connection = ConnectionManager::get('default');
                    $liste_tables = $connection->getSchemaCollection()->listTables();
                    
                    if(in_array('sms_stats', $liste_tables) || in_array('sms_statistiques', $liste_tables)){
                        $idContactSmsDelivre = $this->Contacts->Envois->find("list",['valueField'=>'contact_id'])
                                                ->matching('SmsStatistiques', function ($q) {
                                                    return $q->where(['SmsStatistiques.statut' => 1]);
                                                })
                                                ->where(['SmsStatistiques.envoi_id IN' => $idEnvoiSms])
                                                ->toArray();
                    }
                                        
                    $options['idContactSmsDelivre'] = array_unique($idContactSmsDelivre);
                }
                
                
                
        }
        
        
        $options['listeIdPhoto'] = $listeIdPhoto;
        $options['key'] = $key;
        $options['smsEnvoye'] = $smsEnvoye;
        $options['emailEnvoye'] = $emailEnvoye;
        $options['emailClick'] = $emailClick;
        $options['optin'] = $optin;
        $options['emailOuvert'] = $emailOuvert;
        $options['smsOuvert'] = $smsOuvert;
        $options['photoTelechargee'] = $photoTelechargee;
        $options['spam'] = $spam;
        $options['sent'] = $sent;
        $options['blocked'] = $blocked;
        $options['hardBounce'] = $hardBounce;
        $options['bounce'] = $bounce;
        $options['countBoucnceTmp'] = $countBoucnceTmp;
        $options['unsub'] = $unsub;
        $options['customSort'] = $customSort;
        $options['customDirection'] = $customDirection;
        $options['smsDelivred'] = $smsDelivred;
        $options['smsClicked'] = $smsClicked;
        $options['is_postable_on_facebook'] = $is_postable_on_facebook;
        $options['is_optin_galerie'] = $is_optin_galerie;
        $options['is_option_email_sms'] = $is_option_email_sms;
        $options['is_optin_email'] = $is_optin_email;
        $options['is_optin_sms'] = $is_optin_sms;
        $options['OR']['deleted_via_rgpd'] = NULL;
        $options['OR']['deleted_via_rgpd'] = false;
     
        
        
        
        $this->paginate = [
            'contain' => ['Photos'=>['PhotoDownloads'],'ContactEmailsEnvois','ContactSmsEnvois','Envois' => ['EnvoiEmailStatistiques','EnvoiEmailStatDelivres','EnvoiEmailStatOuvertures','EnvoiEmailStatClicks','EnvoiEmailStatBlockeds','EnvoiEmailStatErreurPermanentes','EnvoiEmailStatErreurTemporaires','SmsStatistiquesDelivres','EnvoiEmailStatBounces']],
            'finder' => [
                'filtre' => $options
            ],
            'order' =>['Contacts.id' =>'DESC'],
            /*'sortWhitelist' => [
                'photo_id', 'email','telephone', 'Photos.heure_prise_photo', 'ContactEmailsEnvois.id'
            ]*/
            'sortWhitelist' => [
                'id',
                'photo_id',
                'email',
                'telephone',
                'Photos.date_prise_photo',
                'ContactEmailsEnvois.id'
            ],
        ];
        
        //debug( $this->paginate); die;
        
        $contacts = $this->paginate($this->Contacts);
        /*if($idEvenement == 1387){
            //debug($contacts); die;
        }*/
        $listContactEmailNotSent = $this->contactEmailNotSent($idEvenement);
        //debug($listContactEmailNotSent);die;
        
        //Position colonne 
        $this->loadModel('CsvColonnePositions');
        $csvColonnePositions = $this->CsvColonnePositions->find('all')
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->group(['CsvColonnePositions.csv_colonne_id']);
                                        
                      
        $this->set(compact("is_optin_galerie","is_optin_email","is_optin_sms","is_option_email_sms","is_postable_on_facebook"));
        $this->set(compact('contacts','idEvenement','evenement','key','emailEnvoye','smsEnvoye','optin', 'emailOuvert', 'photoTelechargee','emailClick','spam','countAllContact', 'listContactEmailNotSent','csvColonnePositions'));
        $this->set(compact( "nbrEmailEnvoye","nbrEmailOuvert","nbrSmsEnvoye","nbrSmsOuvert","countContactEmail","countContactTel",'is_filtreAvance','sent','options','blocked','hardBounce','unsub','customDirection','idContactSmsDelivre' ,'filtre'));
    }

    
    //==== Liste email propose
    public function contactEmailNotSent($idEvenement)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');

        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);

        $listContactEmailNotSent = array();
        //debug($evenement);
        if(!empty($evenement->photos)){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
            if(!empty($listContactEmail)){

                $listContactEmailNotSent = $this->Contacts->find('list', ['valueField'=>'email_propose'])
                                                ->where([
                                                     'contact_id IN' => $listContactEmail,
                                                     'is_email_checked IS NOT' => NULL,
                                                     'email_propose IS NOT' => NULL,
                                                     'nom_de_domaine_id IS NOT' => NULL,
                                                     'email_old IS' => NULL // pas encore remplacer
                                                ])
                                                ->notMatching('Envois.EnvoiEmailStatDelivres')
                                                ->toArray();
            }
        }
        
        //debug($listContactEmailNotSent);die;
        return $listContactEmailNotSent;
    }

    public function contactEmailNotSent2($idEvenement)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');

        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);

        $listContactEmailNotSent = array();
        //debug($evenement);
        if(!empty($evenement->photos)){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
            //debug($listContactEmail);
            if(!empty($listContactEmail)){

                $listContactEmailNotSent = $this->Contacts->find('list', ['valueField'=>'email_propose'])
                                                ->where(['contact_id IN' => $listContactEmail,
                                                     'is_email_checked IS NOT' => NULL,
                                                     'email_propose IS NOT' => NULL,
                                                     'nom_de_domaine_id IS NOT' => NULL,
                                                     'email_old IS' => NULL // pas encore remplacer
                                                 ])
                                                ->notMatching('Envois.EnvoiEmailStatDelivres')
                                                ->toArray();
            }
        }
        
        debug($listContactEmailNotSent);die;
        return $listContactEmailNotSent;
    }
    
    public function voirCsv($idEvenement){
       // $evenement = $this->Contacts->Photos->Evenements->get($idEvenement);
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        
        $source = Configure::read('source_photo').$idEvenement.DS;
        $pathCsv = $source.'data.csv';
        
        $csv = false;
        $urlCsv = "";
        if (file_exists($pathCsv)) { // Source depuis l'ancien chemin
            $csv = true;
            $dataCsv = date('d/m/Y - H\h:i:s', filemtime($pathCsv)); //Y-m-d H:i:s
            $tmpCsv  = new Folder(WWW_ROOT.'import'.DS.'csv'.DS.'tmp'.DS.$idEvenement.DS, true, 0755);
            if(file_exists($tmpCsv->pwd().'data.csv')){
                unlink($tmpCsv->pwd().'data.csv');
            }

            if(copy($pathCsv, $tmpCsv->pwd().'data.csv')){
                $urlCsv = Configure::read('url_admin_domaine').'import/csv/tmp/'.$idEvenement.'/data.csv';
            }
        }else{
            ///home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev//b61/files/1671/Data/data.csv
             //pour le nouveau système (chemin), il faut tout boucler
             for($numBorne = 1;$numBorne<=200;$numBorne++){
                $source = Configure::read('source_photo_cloud').DS.'b'.$numBorne.DS.'files'.DS.$idEvenement.DS.'Data'.DS;
                $pathCsv = $source.'data.csv';
                 if (file_exists($pathCsv)) {
                    $tmpCsv  = new Folder(WWW_ROOT.'import'.DS.'csv'.DS.'tmp'.DS.$idEvenement.DS, true, 0755);

                    if(file_exists($tmpCsv->pwd().'data.csv')){
                        unlink($tmpCsv->pwd().'data.csv');
                    }
                    $csv = true;
                    $dataCsv = date('d/m/Y - H\h:i:s', filemtime($pathCsv));
                  
                    if(copy($pathCsv, $tmpCsv->pwd().'data.csv')){
                        $urlCsv = Configure::read('url_admin_domaine').'import/csv/tmp/'.$idEvenement.'/data.csv';
                    }
                    break;
                }
             }
        }
        $this->set(compact('idEvenement','evenement','csv','dataCsv','urlCsv'));
    }

    public function downloaAndSeeCsv($idEvenement){
        $tmpCsv  = new Folder(WWW_ROOT.'import'.DS.'csv'.DS.'tmp'.DS.$idEvenement.DS, true, 0755);

        $this->response = $this->response->withDisabledCache();

        $response = $this->response->withFile(
                $tmpCsv->pwd().'data.csv',
                ['download' => true, 'name' => 'data.csv']
            );
        return $response;
    }
    
    public function deleteCsv($idEvenement){
        $source = Configure::read('source_photo').$idEvenement.DS;
        $pathCsv = $source.'data.csv';
        if(unlink($pathCsv)){
            $this->Flash->success(__('Csv Supprimé avec succès.'));
            
        }else{
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer.'));
        }
        
        return $this->redirect(['action' => 'voirCsv',$idEvenement]);
    }
    
    public function downloadByContact($idEvenement){
        
        $key = $this->request->getQuery('key');
        $emailEnvoye = $this->request->getQuery('emailEnvoye');
        $smsEnvoye = $this->request->getQuery('smsEnvoye');
        $optin = $this->request->getQuery('optin');
        
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement);
        $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false])->toArray();
        $options['listeIdPhoto'] = $listeIdPhoto;
        $options['key'] = $key;
        $options['smsEnvoye'] = $smsEnvoye;
        $options['emailEnvoye'] = $emailEnvoye;
        $options['optin'] = $optin;
        
        $contacts = $this->Contacts->find('filtre',$options)
                                    ->contain(['Photos','EmailEnvois','SmsEnvois']);
        
        $outZipPath =  WWW_ROOT."import".DS."download".DS.$evenement->slug.'.zip';
        if(file_exists($outZipPath)){
            unlink($outZipPath);
        }
     
        
        $zipFile = new ZipArchive();
        $zipFile->open($outZipPath, ZIPARCHIVE::CREATE);
        
        foreach($contacts as $contact){
            $photo = $contact->photo;
            $filePath = $photo->uri_photo;
            $fileName = pathinfo($filePath,  PATHINFO_BASENAME );
            $zipFile->addFile($filePath, $fileName);
        }
        $zipFile->close();
        
        $response = $this->response->withFile(
            $outZipPath,
            ['download' => true, 'name' => $evenement->slug.'.zip']
        );
        
        return $response;
                                    
                                    
    }
    
    public function exportCsv($idEvenement){
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement);
        $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false])->toArray();
        if($idEvenement == 2403){
                //$contacts = $contacts->where(['Photos.survey7' => 'Yes']);
                $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false,'Photos.survey7' => 'Yes'])->toArray();
        }
        $this->loadModel('CsvColonnePositions');
        $listePositionChamp = $this->CsvColonnePositions->find('list',['keyField'=>'position' ,'valueField' => 'csv_colonne.nom'])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->toArray();
                                        
        $key = $this->request->getQuery('key');
        $is_postable_on_facebook = $this->request->getQuery('is_postable_on_facebook');
        $is_optin_galerie = $this->request->getQuery('is_optin_galerie');
        $is_option_email_sms = $this->request->getQuery('is_option_email_sms');
        $is_optin_email = $this->request->getQuery('is_optin_email');
        $is_optin_sms = $this->request->getQuery('is_optin_sms');
        $periodeType = $this->request->getQuery('periodeType');
        $periode = $this->request->getQuery('periode');
        
        $date_debut = null;
        $date_fin = null;
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
        
        $contacts = null;
        if(!empty($listeIdPhoto)){
            $options['listeIdPhoto'] = $listeIdPhoto;
            $options['key'] = $key;
            $options['is_postable_on_facebook'] = $is_postable_on_facebook;
            $options['is_optin_galerie'] = $is_optin_galerie;
            $options['is_option_email_sms'] = $is_option_email_sms;
            $options['is_optin_email'] = $is_optin_email;
            $options['is_optin_sms'] = $is_optin_sms;
            $options['date_debut'] = $date_debut;
            $options['date_fin'] = $date_fin;
            
            //debug($options); die;
            
            $contacts = $this->Contacts
                                    ->find('formulaire', $options)
                                    ->order(['Contacts.id'=>'DESC'])
                                    ->contain(['Photos']);
            
        
            //Position colonne 
            $this->loadModel('CsvColonnePositions');
            $csvColonnePositions = $this->CsvColonnePositions->find('all')
                                            ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                            ->contain(['CsvColonnes'])
                                            ->group(['CsvColonnePositions.csv_colonne_id']);
                                        
            $listeIdColonne = $this->CsvColonnePositions->find('list',['valueField' => 'csv_colonne_id'])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->group(['CsvColonnePositions.csv_colonne_id'])
                                        ->toArray();
                                        
            $listePositionDefinie = $this->CsvColonnePositions->find('list',['valueField' => 'position'])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->contain(['CsvColonnes'])
                                        ->group(['CsvColonnePositions.csv_colonne_id'])
                                        ->toArray();
                                        
            $isEmailNotVide =   $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->where(['Contacts.email IS NOT' => NULL,'Contacts.email <>' => ''])
                                    ->count();
            if($isEmailNotVide){
                $isSurvey1ContentEmail = $this->Contacts->Photos->find('all')
                                        ->where(['Photos.evenement_id IN' => $idEvenement])
                                        ->where(['Photos.survey1 IS NOT' => NULL,'Photos.survey1 <>' => ''])
                                        ->count();
            }
            
            $countAllSurveyNotEmpty = array();
            for($survey =1; $survey <=7 ; $survey++ ){
                $nom = 'survey'.$survey;
                $countSurveyNotEmpty = $this->Contacts->Photos->find()
                                                ->where([
                                                    'Photos.evenement_id' => $idEvenement,
                                                    'Photos.'.$nom.' IS NOT' => NULL,
                                                    'Photos.'.$nom.' <>' => ''
                                                ])->count();
                $countAllSurveyNotEmpty[$nom] = $countSurveyNotEmpty;
                
            }
            
            
            $_header = array();     
                $_header[] = "Photo";
                $_header[] = "E-mail";
                $_header[] = "Tel";
                $_header[] = "Date photo";
               /* if(in_array(1, $listeIdColonne)){
                    $_header[] = "Opt-in réseaux sociaux";
                }
                
                if(in_array(2, $listeIdColonne)){
                    $_header[] = "Opt-in galerie";
                }
                
                if(in_array(3, $listeIdColonne)){
                    $_header[] = "Opt-in E-mail";
                    $_header[] = "Opt-in Sms";
                }
                
                if(in_array(4, $listeIdColonne)){
                    $_header[] = "Opt-in E-mail";
                }
                
                if(in_array(5, $listeIdColonne)){
                    $_header[] = "Opt-in Sms";
                }
               */
                
                                
                    
                foreach($countAllSurveyNotEmpty as $key =>  $countSurveyNotEmpty){
                    $num  = substr($key, -1);
                    if($countSurveyNotEmpty /*&& !in_array($num, $listePositionDefinie )*/) {
                        $champName = 'Champ '.$num;
                        if(isset($listePositionChamp[$num])){
                            $champName = $listePositionChamp[$num];
                        }
                        $_header[] = $champName;
                    }
                }
                    
                
            $data = array();
            if(!empty($contacts)){
                    foreach($contacts as $contact){
                        $ligne = array();
                            $ligne['photo'] = $contact->photo->name_origne;
                            $ligne['email'] = $contact->email;
                            $ligne['telephone'] = $contact->telephone;
                            $ligne['date_photo'] = !empty($contact->photo->date_prise_photo) ? $contact->photo->date_prise_photo->format('d-m-y').$contact->photo->heure_prise_photo->format(' à H \h i') : "";
                            /*if(in_array(1, $listeIdColonne)){
                                $ligne["is_postable_on_facebook"] = $contact->photo->is_postable_on_facebook ? "Oui" : "Non";
                            }
                            
                            if(in_array(2, $listeIdColonne)){
                                $ligne["is_optin_galerie"] = $contact->photo->is_optin_galerie ? "Oui" : "Non";
                            }
                            
                            if(in_array(3, $listeIdColonne)){
                                $ligne["is_optin_email"] = $contact->photo->is_optin_email ? "Oui" : "Non";
                                $ligne["is_optin_sms"] = $contact->photo->is_optin_sms ? "Oui" : "Non";
                            }
                            
                            if(in_array(4, $listeIdColonne)){
                                $ligne["is_optin_email"] = $contact->photo->is_optin_email ? "Oui" : "Non";
                            }
                            
                            if(in_array(5, $listeIdColonne)){
                                $ligne["is_optin_sms"] = $contact->photo->is_optin_sms ? "Oui" : "Non";
                            }*/
                            
                                    
                            foreach($countAllSurveyNotEmpty as $key =>  $countSurveyNotEmpty){
                                //$num  = substr($key, -1);
                                if($countSurveyNotEmpty /*&& !in_array($num, $listePositionDefinie )*/) {
                                    $ligne[$key] = $contact->photo->$key;
                                }
                            }
                        array_push($data, $ligne);
                    }
                
            }
            
            $_serialize = 'data';
            $_dataEncoding = 'UTF-8';
            $_csvEncoding = 'UTF-8';
            $_bom = true;
            $_delimiter = ';'; 
            
            $this->setResponse($this->getResponse()->withDownload($evenement->slug.'.csv'));
            $this->viewBuilder()->setClassName('CsvView.Csv');
            $this->set(compact('data', '_serialize', '_header','_dataEncoding','_csvEncoding','_bom','_delimiter'));
                                        
       
        }
            
    }
    
    
    public function export($idEvenement){
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement);
        $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false])->toArray();
        
        $key = $this->request->getQuery('key');
        $emailEnvoye = $this->request->getQuery('emailEnvoye');
        $smsEnvoye = $this->request->getQuery('smsEnvoye');
        $optin = $this->request->getQuery('optin');
        $emailOuvert = $this->request->getQuery('emailOuvert');
        $smsOuvert = $this->request->getQuery('smsOuvert');
        $photoTelechargee = $this->request->getQuery('photoTelechargee');
        $emailClick = $this->request->getQuery('emailClick');
        $spam = $this->request->getQuery('spam');
        $is_filtreAvance = $this->request->getQuery('is_filtreAvance');
        $sent = $this->request->getQuery('sent');
        $blocked = $this->request->getQuery('blocked');
        $hardBounce = $this->request->getQuery('hardBounce');
        $bounce = $this->request->getQuery('bounce');
        $countBoucnceTmp = $this->request->getQuery('countBoucnceTmp');
        $unsub = $this->request->getQuery('unsub');
        $smsDelivred = $this->request->getQuery('smsDelivred');
        $smsClicked = $this->request->getQuery('smsClicked');
        $is_postable_on_facebook = $this->request->getQuery('is_postable_on_facebook');
        $is_optin_galerie = $this->request->getQuery('is_optin_galerie');
        $is_option_email_sms = $this->request->getQuery('is_option_email_sms');
        $is_optin_email = $this->request->getQuery('is_optin_email');
        $is_optin_sms = $this->request->getQuery('is_optin_sms');
        
        $contacts = null;
        if(!empty($listeIdPhoto)){
            
            $options['listeIdPhoto'] = $listeIdPhoto;
            $options['key'] = $key;
            $options['smsEnvoye'] = $smsEnvoye;
            $options['emailEnvoye'] = $emailEnvoye;
            $options['emailClick'] = $emailClick;
            $options['optin'] = $optin;
            $options['emailOuvert'] = $emailOuvert;
            $options['smsOuvert'] = $smsOuvert;
            $options['photoTelechargee'] = $photoTelechargee;
            $options['spam'] = $spam;
            $options['sent'] = $sent;
            $options['blocked'] = $blocked;
            $options['hardBounce'] = $hardBounce;
            $options['bounce'] = $bounce;
            $options['countBoucnceTmp'] = $countBoucnceTmp;
            $options['unsub'] = $unsub;
            $options['smsDelivred'] = $smsDelivred;
            $options['smsClicked'] = $smsClicked;
            $options['customSort'] = null;
            $options['customDirection'] = null;
            $options['idConctatEmailDelivre'] = null;
            $options['idConctatEmailOuvert'] = null;
            $options['idConctatEmailClique'] = null;
            $options['idContactEmailEnvoye'] = null;
            $options['listeIdPhotoDownloaded'] = null;
            $options['is_postable_on_facebook'] = $is_postable_on_facebook;
            $options['is_optin_galerie'] = $is_optin_galerie;
            $options['is_option_email_sms'] = $is_option_email_sms;
            $options['is_optin_email'] = $is_optin_email;
            $options['is_optin_sms'] = $is_optin_sms;
        
            /*$contacts = $this->Contacts->find('all')
                            ->contain(['Photos','ContactEmailsEnvois','ContactSmsEnvois'])
                            ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                            ->toArray();*/
            $contacts = $this->Contacts
                                    ->find('filtre', $options)
                                    ->contain(['Photos'=>['PhotoDownloads'],'ContactEmailsEnvois','ContactSmsEnvois','Envois' => ['EnvoiEmailStatistiques','EnvoiEmailStatDelivres','EnvoiEmailStatOuvertures','EnvoiEmailStatClicks']]);
                                    
           
        }
        // photo / date & heure / email / portable ... (champs form) / email envoyé / sms envoyé / 
        //$_header = ['Photo',  'Email','Téléphone','E-mail envoyé', 'Sms envoyé'];
        //"Photo","E-mail","Tel","Date photo","E-mail envoyé","E-mail délivré","E-mail ouvert","E-mail cliqué","Sms envoyé","Sms ouvert","Photo téléchargée"
        $_header = ["Photo","E-mail","Tel","Date photo","E-mail envoyé","E-mail délivré","E-mail ouvert","E-mail cliqué","Sms envoyé","Sms ouvert","Photo téléchargée"];
         /**
         * Opt-in Header
         * */
        $this->loadModel('CsvColonnePositions');
        $listeIdColonne = $this->CsvColonnePositions->find('list',['valueField' => 'csv_colonne_id' ])
                                        ->where(['CsvColonnePositions.evenement_id' => $idEvenement])
                                        ->group(['CsvColonnePositions.csv_colonne_id'])
                                        ->toArray();
        if(in_array(1, $listeIdColonne)){
            array_push($_header, "Opt-in réseaux sociaux");
        }
        
        if(in_array(1, $listeIdColonne)){
            array_push($_header, "Opt-in galerie");
        } 
        if(in_array(3, $listeIdColonne)){
            array_push($_header, "Opt-in réseaux E-mail");
            array_push($_header, "Opt-in réseaux Sms");
        }else{
             if(in_array(4, $listeIdColonne)){
                array_push($_header, "Opt-in E-mail");
             } 
            if(in_array(5, $listeIdColonne)){
                array_push($_header, "Opt-in Sms");
            }
        }
        $data = array();
        if(!empty($contacts)){
            foreach($contacts as $contact){
                $ligne = array();
                    $ligne['photo'] = $contact->photo->name_origne;
                    $ligne['email'] = $contact->email;
                    $ligne['telephone'] = $contact->telephone;
                    $ligne['date_photo'] = !empty($contact->photo->date_prise_photo) ? $contact->photo->date_prise_photo->format('d-m-y').$contact->photo->heure_prise_photo->format(' à H \h i') : "";
                    
                    $ligne['email_envoye'] = 'Non';
                    if(count($contact->contact_email_envois)){
                        $datePhraseEmail = $contact->contact_email_envois[0]->created->format('d-m-y à H\hi');
                        $ligne['email_envoye'] = 'Oui ('.$datePhraseEmail.')';
                    }
                    $ligne['email_delivre'] = 'Non';
                    $ligne['email_ouvert'] ='Non';
                    $ligne['email_clique'] ='Non';
                    if(count($contact->envois)){
                        if(!empty($contact->envois[0]->envoi_email_stat_delivres)){
                            $datePhraseEmailDelivre = $contact->envois[0]->envoi_email_stat_delivres[0]->date_event->format('d-m-y à H\hi');
                            $ligne['email_delivre'] = 'Oui ('.$datePhraseEmailDelivre.')';
                        }
                        
                        if(!empty($contact->envois[0]->envoi_email_stat_ouvertures)){
                            $datePhraseEmail = $contact->envois[0]->envoi_email_stat_ouvertures[0]->date_event->format('d-m-y à H\hi');
                            $ligne['email_ouvert'] = 'Oui ('.$datePhraseEmail.')';
                        }
                        
                        if(!empty($contact->envois[0]->envoi_email_stat_clicks)){
                            $datePhraseEmail = $contact->envois[0]->envoi_email_stat_clicks[0]->date_event->format('d-m-y à H\hi');
                            $ligne['email_clique'] = 'Oui ('.$datePhraseEmail.')';
                        }
                    }
                    
                    $ligne['sms_envoye'] = 'Non';
                    $ligne['sms_ouvert'] = 'Non';
                    if(count($contact->contact_sms_envois)){
                        $datePhraseSms = $contact->contact_sms_envois[0]->created->format('d-m-y à H \h i');
                        $ligne['sms_envoye'] = 'Oui ('.$datePhraseSms.')';
                        
                        $datePhraseSms = $contact->contact_sms_envois[0]->created->format('d-m-y à H\hi');
                        $ligne['sms_ouvert'] = 'Oui ('.$datePhraseSms.')';
                    }
                    
                    $ligne['photo_telechargee'] = 'Non';
                    if(count($contact->photo->photo_downloads)){
                        $ligne['photo_telechargee'] = 'Oui ('.count($contact->photo->photo_downloads).' fois)';
                    }
                    
                    /**
                     * Opt-in Content
                     * */
                    if(in_array(1, $listeIdColonne)){
                        $ligne['is_postable_on_facebook'] = $contact->photo->is_postable_on_facebook ? "Oui" : "Non";;
                    }
                    
                    if(in_array(1, $listeIdColonne)){
                        $ligne['is_optin_galerie'] = $contact->photo->is_optin_galerie ? "Oui" : "Non";;
                    } 
                    if(in_array(3, $listeIdColonne)){
                        $ligne['is_optin_email'] = $contact->photo->is_optin_email ? "Oui" : "Non";;
                        $ligne['is_optin_sms'] = $contact->photo->is_optin_sms ? "Oui" : "Non";;
                    }else{
                         if(in_array(4, $listeIdColonne)){
                            $ligne['is_optin_email'] = $contact->photo->is_optin_email ? "Oui" : "Non";;
                         } 
                        if(in_array(5, $listeIdColonne)){
                            $ligne['is_optin_sms'] = $contact->photo->is_optin_sms ? "Oui" : "Non";;
                        }
                    }
                                    
                                    
                                    
                                    
                    
                    
                array_push($data, $ligne);
            }
        }
        
       
        
        $_serialize = 'data';
        $_dataEncoding = 'UTF-8';
        $_csvEncoding = 'UTF-8';
        $_bom = true;
        $_delimiter = ';'; 
        
        $this->setResponse($this->getResponse()->withDownload($evenement->slug.'.csv'));
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize', '_header','_dataEncoding','_csvEncoding','_bom','_delimiter'));
        
        
    }

//    /**
//     * View method
//     *
//     * @param string|null $id Contact id.
//     * @return \Cake\Http\Response|void
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $contact = $this->Contacts->get($id, [
//            'contain' => ['Photos']
//        ]);
//
//        $this->set('contact', $contact);
//    }
//
//    /**
//     * Add method
//     *
//     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
//     */
//    public function add($idEvenement = null)
//    {
//        if(!empty($idEvenement)){
//            $evenement = $this->Evenements->get($idEvenement);
//        }
//        $contact = $this->Contacts->newEntity();
//        if ($this->request->is('post')) {
//            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
//            if ($this->Contacts->save($contact)) {
//                $this->Flash->success(__('The contact has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
//        }
//        $photos = $this->Contacts->Photos->find('list', ['limit' => 200]);
//        $this->set(compact('contact', 'photos','idEvenement', 'evenement'));
//    }
//
//    /**
//     * Edit method
//     *
//     * @param string|null $id Contact id.
//     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $contact = $this->Contacts->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
//            if ($this->Contacts->save($contact)) {
//                $this->Flash->success(__('The contact has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
//        }
//        $photos = $this->Contacts->Photos->find('list', ['limit' => 200]);
//        $this->set(compact('contact', 'photos'));
//    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($idEvenement = null, $id = null, $isInFormulaire = false)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }
        if($isInFormulaire){
            return $this->redirect(['action' => 'formulaire', $idEvenement]);
        }else{
            return $this->redirect(['action' => 'liste', $idEvenement]);
        }
        
    }
    

    
    public function deleteSelected($idEvenement, $isDepuisFormulaire = false){
        //$this->request->allowMethod(['post', 'delete']);
        $selected = $this->request->getQuery('list');
        $selected = array_unique($selected);
        $selected = array_filter($selected);
        $selected = array_values($selected);
        
        
        if(!empty($selected)){
            if($this->Contacts->deleteAll(['id IN' => $selected])){
                $this->Flash->success(__('All selected contact has been deleted.'));
            }else{
                $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
            }
        }
        if($isDepuisFormulaire){
            return $this->redirect(['action' => 'formulaire', $idEvenement]);
        }else{
            return $this->redirect(['action' => 'liste', $idEvenement]);
        }
        
    }
    
    public function deleteAll($idEvenement, $isDepuisFormulaire = false){
        $this->request->allowMethod(['post', 'delete']);
        
        $listePhotoEvenement = $this->Contacts->Photos->find('list',['valueField'=>'id'])
                                            ->where(['evenement_id' => $idEvenement])
                                            ->toArray();
        //debug($listePhotoEvenement);ide;
        if(!empty($listePhotoEvenement)){
            if($this->Contacts->deleteAll(['photo_id IN' => $listePhotoEvenement])){
                $this->Flash->success(__('All  contacts has been deleted.'));
            }else{
                $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
            }
        }
        if($isDepuisFormulaire){
             return $this->redirect(['action' => 'formulaire', $idEvenement]); 
        }else{
             return $this->redirect(['action' => 'liste', $idEvenement]); 
        }
                                              
        
        
    }
    
    public function deleteAjax( $id )
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        $res['success'] = false;
        if ($this->Contacts->delete($contact)) {
            $res['success'] = true;
        }
        echo json_encode($res);
    }

    public function getContactPhotoAjax()
    {
        # code...
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $res['success'] = false;
        $res['email'] = "";
        $res['telephone'] = "";
        $res['id_contact'] = "";
        if ($this->request->is('post')) {
            $photo = $this->Contacts->Photos->get($this->request->getData()['photo_id'],['contain'=>['Contacts']]);
            if(!empty($photo->contacts)){
                $res['success'] = true;
                $res['email'] = $photo->contacts[0]->email;
                $res['telephone'] = $photo->contacts[0]->telephone;
                $res['id_contact'] = $photo->contacts[0]->id;
            }
        }
        //debug($res);
        echo json_encode($res);
    }
    
    public function addAjax(){
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $contact = $this->Contacts->newEntity();
        $res['success'] = false;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if(!empty($data['id_contact'])){ // Contact exist == contact de la photo
                $contact = $this->Contacts->get($data['id_contact']);
            }
            //debug($data);die;
            $contact = $this->Contacts->patchEntity($contact, $data);
            //debug($contact);die;
            if ($this->Contacts->save($contact)) {      
                    //$res['success'] = true;       
                    //Send email and sms
                    $this->loadModel('Photos');
                    $photo = $this->Photos->find()
                                        ->where(['Photos.id'=>$contact->photo_id])
                                        ->contain(['Contacts','Evenements'])
                                        ->first();
                    
                    $idEvenement = $this->request->getData('evenement_id');
                    $this->loadModel('SmsConfigurations');
                    $smsConfiguration = $this->SmsConfigurations->find()->where(['evenement_id'=>$idEvenement])
                                                                    ->contain(['Evenements'])
                                                                    ->first();
                    
                    $this->loadModel('EmailConfigurations');
                    $emailConfiguration = $this->EmailConfigurations->find()->where(['evenement_id'=>$idEvenement])
                                                                    ->contain(['Evenements'])
                                                                    ->first();
                    
                    //$this->Send = new SendComponent(new ComponentRegistry());
                    $this->loadComponent('Send');
                    //Il ne reste qu'à l'envoyé après le repas
                    if(!empty($contact->email)  ){
                        //echo 'je passe ici';
                        if(!empty($data['id_contact'])){
                            $resEmail = $this->Send->email($photo, $contact, $emailConfiguration, true);
                        } else {                            
                            $resEmail = $this->Send->email($photo, $contact, $emailConfiguration);
                        }
                     }
                     //Envoi de sms au contact
                     //debug($contact); die;
                     if(!empty($contact->telephone)){
                        if(!empty($data['id_contact'])){
                            $resSms = $this->Send->sms($photo, $contact, $smsConfiguration, true);
                        } else {
                            $resSms = $this->Send->sms($photo, $contact, $smsConfiguration);                            
                        }
                     }

                    if( (!empty($contact->email) && $resEmail) || (!empty($contact->telephone) && $resSms)  ){
                            $res['success'] = true;
                    }
                
            }
        }        
        echo json_encode($res);
    }

    //=== Test check crdt sms
    public function checkCredit($idClient = null){
        $this->SendInfo = new SendInfoComponent(new ComponentRegistry());
        $infoCreditClient = $this->SendInfo->infoDetailClient($idClient);
        //$infoCreditEvent = $this->SendInfo->infoDetailEvent($idClient);
        debug($infoCreditClient);die;
    }

    public function getInfoCreditSms($idClient = null){
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $this->SendInfo = new SendInfoComponent(new ComponentRegistry());
        $infoCreditClient = $this->SendInfo->infoDetailClient($idClient);
        echo json_encode($infoCreditClient);
    }

    public function envoyeAvecEmailProposeAjax(){
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $res['success'] = false;
        if ($this->request->is('post')) {
            $contact = $this->Contacts->get($this->request->getData()['contact_id']);
                            //Send email and sms
                    $this->loadModel('Photos');
                    $photo = $this->Photos->find()
                                        ->where(['Photos.id'=>$contact->photo_id])
                                        ->contain(['Contacts','Evenements'])
                                        ->first();
                     //debug($photo);
                    
                    $idEvenement = $this->request->getData()['evenement_id'];                            
                    $this->loadModel('EmailConfigurations');
                    $emailConfiguration = $this->EmailConfigurations->find()->where(['evenement_id'=>$idEvenement])
                                                                    ->contain(['Evenements'])
                                                                    ->first();

                     //debug($emailConfiguration);
                    $this->loadComponent('Send');

                     if(!empty($contact->email_propose)){
                        //echo 'je passe ici';
                        $resEmail = $this->Send->emailPropose($photo, $contact, $emailConfiguration);
                        if($resEmail){
                            $contact->email_old = $contact->email;
                            $contact->email = $contact->email_propose;
                            $res['success'] = true;
                            $this->Contacts->save($contact);
                        }
                        //debug($resEmail);die;
                     }                
        
        }
        
        echo json_encode($res);   
    }
    
    
    public function uploadCsv($idEvenement){
        //$this->autoRender = false;
        if(!empty($_FILES['csv_file'])){
            $file = $_FILES['csv_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            //debug($ext); die;
            if($ext == 'csv'){
               
                $path = WWW_ROOT.'import'.DS.'csv'.DS. $idEvenement.DS ;
                if (!is_dir($path)) {
                    $dir = new Folder($path, true, 0755);
                }
                
                $path = $path . 'data.csv';
                if(move_uploaded_file($file['tmp_name'], $path)) {
                    $user_id = $this -> Auth -> user('id');
                    //debug($path); 
                    //$this->importContactViaCsv($idEvenement, $path);
                    $shell = new ShellDispatcher();
                    $output = $shell->run(['cake','photo', 'importContactViaCsv',$idEvenement, true, 0,  $path, $user_id]);
                    $this->Flash->success('Import réussi : '.$output.' Contact(s)' );
                    
                } else{
                    $this->Flash->error(__('Une erreur est survenue lors de l\'upload. Veuillez réessayer'));
                }
            }else{
                $this->Flash->error(__('Veuillez uploader un fichier csv.'));
            }
            
        }else{
           $this->Flash->error(__('Veuillez séléctionner un fichier csv.')); 
        }
        return $this->redirect(['action' => 'formulaire', $idEvenement]);
    }
    
    public function importContactViaCsv($idEvenement , $pathCsv){
        $this->loadModel('Photos');
        if(file_exists($pathCsv)){
            $csv = array_map('str_getcsv', file($pathCsv));               
            array_shift($csv);
            $datas = array();
            
            $queue = time();
            foreach($csv as $numLigne => $ligne){
                $photo = array();
                $photo['contacts'][0]['source_upload'] = "bo";
                $photo['contacts'][0]['queue'] = $queue;
                $photo['contacts'][0]['email'] = null;
                $photo['contacts'][0]['telephone'] = null;
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
                       
                        $photo['name_in_csv'] = $nomPhoto;
                    }
                
                    
                }
                //debug($photo); die;
                
                if(!empty($photo['name_in_csv'])){
                    
                    //debug($photo);die;
                    /**
                     * On vérifie si l'import de la photo est déjà faite'
                     * */
                     if( !empty( $photo['contacts'][0]['telephone']) || !empty($photo['contacts'][0]['email']) ){
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
                                                                    ])      
                                                            ->first();
                         //debug($photoFind); 
                         
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
                $this->Flash->success(__('Import réussi : '.count($datas).' Contact(s)' ));
                //$this->sendEmailAndSmsEvenement($idEvenement, $sendEmail, $sendSms);
            }else{
                $this->Flash->error(__('Aucun contact importé ou contact déjà existant dans la base.'));
            }
            
        }
        
    }

    public function importer($idEvenement = null)
    {
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement);
        $this->set(compact('evenement', 'idEvenement'));
    }

    /*
    *  WS - Liste Contacts
    *
    */

    public function getContacts($idEvenement)
    {
        $this->viewBuilder()->setLayout('ajax');
        $evenement = $this->Contacts->Photos->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $listeIdPhoto = $this->Contacts->Photos->find('list',['valueField' => 'id'])->where(['evenement_id' => $idEvenement,'is_in_corbeille'=>false,'deleted'=>false])->toArray();
        /*if(!empty($listeIdPhoto)){
            $countAllContact = $this->Contacts->find('all')
                                    ->where(['Contacts.photo_id IN' => $listeIdPhoto])
                                    ->count();
        }*/
        
        $options['listeIdPhoto'] = $listeIdPhoto;
        $this->paginate = [
            'contain' => ['Photos'],
            'finder' => [
                'filtreWs' => $options
            ],
            'order' =>['Contacts.id' =>'DESC']
        ];
        
        $contacts = $this->paginate($this->Contacts);
        //debug($contacts->count());die;
        $this->set(compact('contacts'));
    }
}
