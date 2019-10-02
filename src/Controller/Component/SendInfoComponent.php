<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Collection\Collection;

class SendInfoComponent extends Component{

	//=== GET DETAIL INFO ENVOI EVENT: NBR SMS Dispo, nbrContactEmailEnvoye, sns, ..
    public function infoDetailEvent($id){
        //ini_set('memory_limit', '512M');
        //set_time_limit(0);

        //$this->loadModel('Evenements');
        $this->Evenements = TableRegistry::get('Evenements');
        $evenement = $this->Evenements->find('all', ['contain'=>['Photos', 'SmsConfigurations']])->where(['Evenements.id'=>$id])->first();

        $isActiveLimiteNbrSms = false;
        $nbrSmsMax = 0;
        $nbrContactEmail = 0;
        $nbrContactSms = 0;
        $nbrEmailEnvoye =0;
        $nbrSmsEnvoye = 0;
        $nbrEmailNotDelivry = 0;
        $nbrSmsDisponible = 0;
        $infoDetailEvent = [];

        if($evenement) {
            if(!empty($evenement->sms_configuration) && $evenement->sms_configuration->is_active_limite_nbr_sms) {
                $nbrSmsMax = $evenement->sms_configuration->nbr_max_sms;
                $isActiveLimiteNbrSms = $evenement->sms_configuration->is_active_limite_nbr_sms;
            }

            if(!empty($evenement->photos)){
                        
                        $collection = new Collection($evenement->photos);
                        $id = $collection->extract('id');
                        $idPhotos = $id->toList();
                        $listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                                    ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                                    ->toArray();
                        $nbrContactEmail = count($listContactEmail);
                                                                    
                        $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                                    ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                                    ->toArray();
                        $nbrContactSms = count($listContactSms);
                        
                        if(!empty($nbrContactEmail)){
                            $nbrEmailEnvoye = $this->Evenements->Photos->Contacts->ContactEmailsEnvois->find()
                                                                    ->where(['contact_id IN' => $listContactEmail])
                                                                    ->count();
                        }
                        
                        if(!empty($nbrContactSms)){
                            $nbrSmsEnvoye = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find()
                                                                    ->where(['contact_id IN' => $listContactSms])
                                                                    ->count();
                        }   
                        
                        /**
                         * Liste email non delivrés
                         * **/ 
                         if(!empty($nbrEmailEnvoye)){
                            $nbrEmailNotDelivry = $this->Evenements->Photos->Contacts->find()
                                                                    ->where(['contact_id IN' => $listContactEmail])
                                                                    ->notMatching('Envois.EnvoiEmailStatDelivres')
                                                                    ->count();
                         }
            }
            //debug($infoDetailClient);die;
        }
        if($nbrSmsMax > 0) $nbrSmsDisponible = $nbrSmsMax - $nbrSmsEnvoye;
        $infoDetailEvent ['event'] = $evenement->id ;
        $infoDetailEvent ['nbrContactEmail'] = $nbrContactEmail ;
        $infoDetailEvent ['nbrContactSms'] = $nbrContactSms;
        $infoDetailEvent ['nbrEmailEnvoye'] = $nbrEmailEnvoye ;
        $infoDetailEvent ['nbrSmsEnvoye'] = $nbrSmsEnvoye;
        $infoDetailEvent ['nbrEmailNotDelivry'] = $nbrEmailNotDelivry ;
        $infoDetailEvent ['nbrSmsMax'] = $nbrSmsMax ;
        $infoDetailEvent ['nbrSmsDisponible'] = $nbrSmsDisponible ;
        $infoDetailEvent ['isActiveLimiteNbrSms'] = $isActiveLimiteNbrSms ;

        //debug($infoDetailEvent);die;
        return $infoDetailEvent;
     }

      //=== GET DETAIL INFO ENVOI CLIENT: crdt dispo, 
    public function infoDetailClient($id){
        //ini_set('memory_limit', '512M');
        //set_time_limit(0);

        //$this->loadModel('Evenements');
        $this->Clients = TableRegistry::get('Clients');
        $this->Evenements = TableRegistry::get('Evenements');
        $client = $this->Clients->find('all', [
                                                'contain'=>[
                                                    'Evenements'=>['Photos', 'SmsConfigurations'],
                                                    'Users',
                                                    'Credits' => function ($q) {
                                                         return $q->select(['client_id', 'total_credit' => $q->func()->sum('credit')])->where(['etat'=>1]);
                                                        }
                                                ]
                                            ])
                                            ->where(['Clients.id'=>$id])
                                            ->first();
     
        $credit_client = 0;
        $nbrTotalContactEmail = 0;
        $nbrTotalContactSms = 0;
        $nbrTotalEmailEnvoye =0;
        $nbrTotalSmsEnvoye = 0;
        $nbrTotalEmailNotDelivry = 0;
        $creditDisponible = 0;

        $totalCreditEvent = 0;
        $totalSmsEnvoyesEventNotActiveNbrMax = 0;

        $infoDetailClient = [];
        //debug("Credits : ".$credit_client);
        if($client) {
            $infoDetailClient ['client'] = $client->id ;    
            if(!empty($client->credits)) {
                $credit_client = $client->credits[0]->total_credit;
            }

            foreach ($client->evenements as $key => $evenement) {
                    //$infoEvent = $this->infoDetailEvent($evenement->id);debug($infoEvent);

                    //=== Total credit event (nbr_max sms) si limite nbr sms activé
                    if(!empty($evenement->sms_configuration) && $evenement->sms_configuration->is_active_limite_nbr_sms) {
                        $totalCreditEvent = $totalCreditEvent + $evenement->sms_configuration->nbr_max_sms;
                    }

                    $nbrContactEmail = 0;
                    $nbrContactSms = 0;
                    $nbrEmailEnvoye =0;
                    $nbrSmsEnvoye = 0;
                    $nbrEmailNotDelivry = 0;

                    if(!empty($evenement->photos)){
                            
                            $collection = new Collection($evenement->photos);
                            $id = $collection->extract('id');
                            $idPhotos = $id->toList();
                            $listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                                        ->toArray();
                            $nbrContactEmail = count($listContactEmail);
                                                                        
                            $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                                        ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                                        ->toArray();
                            $nbrContactSms = count($listContactSms);
                            
                            if(!empty($nbrContactEmail)){
                                $nbrEmailEnvoye = $this->Evenements->Photos->Contacts->ContactEmailsEnvois->find()
                                                                        ->where(['contact_id IN' => $listContactEmail])
                                                                        ->count();
                            }
                            
                            if(!empty($nbrContactSms)){
                                $nbrSmsEnvoye = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find()
                                                                        ->where(['contact_id IN' => $listContactSms])
                                                                        ->count();
                            }   
                            
                            /**
                             * Liste email non delivrés
                             * **/ 
                             if(!empty($nbrEmailEnvoye)){
                                $nbrEmailNotDelivry = $this->Evenements->Photos->Contacts->find()
                                                                        ->where(['contact_id IN' => $listContactEmail])
                                                                        ->notMatching('Envois.EnvoiEmailStatDelivres')
                                                                        ->count();
                             }
                    }

                    //=== Total sms envoyes par event si limite nbr sms desactivé
                    if(empty($evenement->sms_configuration) || !$evenement->sms_configuration->is_active_limite_nbr_sms) {
                        $totalSmsEnvoyesEventNotActiveNbrMax = $totalSmsEnvoyesEventNotActiveNbrMax + $nbrSmsEnvoye;
                    }

                    $nbrTotalContactEmail = $nbrTotalContactEmail + $nbrContactEmail;
                    $nbrTotalContactSms = $nbrTotalContactSms + $nbrContactSms;
                    $nbrTotalEmailEnvoye = $nbrTotalEmailEnvoye + $nbrEmailEnvoye;
                    $nbrTotalSmsEnvoye = $nbrTotalSmsEnvoye + $nbrSmsEnvoye;
                    $nbrTotalEmailNotDelivry = $nbrTotalEmailNotDelivry + $nbrEmailNotDelivry;
            }
        }

        if($credit_client > 0) $creditDisponible = $credit_client - ($totalCreditEvent + $totalSmsEnvoyesEventNotActiveNbrMax); //nbrTotalSmsEnvoye
            //debug("Credits disponible : ".$creditDisponible);die;            
        $infoDetailClient ['nbrTotalContactEmail'] = $nbrTotalContactEmail ;
        $infoDetailClient ['nbrTotalContactSms'] = $nbrTotalContactSms;
        $infoDetailClient ['nbrTotalEmailEnvoye'] = $nbrTotalEmailEnvoye ;
        $infoDetailClient ['nbrTotalSmsEnvoye'] = $nbrTotalSmsEnvoye; //totalCreditUtilises
        $infoDetailClient ['nbrTotalEmailNotDelivry'] = $nbrTotalEmailNotDelivry ;
        $infoDetailClient ['totalCredit'] = $credit_client ;
        $infoDetailClient ['totalNbrMaxSmsEvent'] = $totalCreditEvent;
        $infoDetailClient ['totalSmsEnvoyesEventNotActiveNbrMax'] = $totalSmsEnvoyesEventNotActiveNbrMax;
        $infoDetailClient ['creditDisponible'] = $creditDisponible;
        
        //debug($infoDetailClient);die;
        return $infoDetailClient;
     }

     //=== GET LES SMS ENVOIES
    public function getAllSmsEnvoyes($id){
        //ini_set('memory_limit', '512M');//set_time_limit(0);
      
        $this->Clients = TableRegistry::get('Clients');
        $this->Evenements = TableRegistry::get('Evenements');
        $client = $this->Clients->find('all', ['contain'=>['Evenements'=>['Photos']]])->where(['Clients.id'=>$id])->first();
        $lastSmsEnvoye = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find('all', [
            'contain' => [
                'Contacts'=>[
                    'Photos'=> ['Evenements'  => function ($q) use ($id) { return $q->where(['client_id'=>$id]);} ]
            ]
        ]
        ])->limit('1')->order(['ContactSmsEnvois.created' => 'DESC'])->first();        
      
        $array = [];
        if(!empty($lastSmsEnvoye)) {
            $event_last = $lastSmsEnvoye->contact->photo->evenement_id;//debug($event_last);die;
            $derniers_envois = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find('all');          
            $derniers_envois = $derniers_envois->select(['date_dernier_envoi'=>$derniers_envois->func()->max('ContactSmsEnvois.created')]);
            $derniers_envois = $derniers_envois->contain([
                    'Contacts'=>[
                        'Photos'=> ['Evenements'  => function ($q) use ($event_last) { return $q->select(['evenement'=> 'Evenements.nom'])->where(['Evenements.id'=>$event_last]);} ],                        
                        'queryBuilder' => function ($q) { return $q->select(['nbr_envois' => $q->func()->count('*')]);} 
                    ]
            ])->first();
            //debug($derniers_envois);
            $array ['derniers_envois'] = $derniers_envois;

            $les_envois = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find('all', [
                'contain' => [
                    'Contacts'=>[
                        'Photos'=> ['Evenements'  => function ($q) use ($id, $event_last) { return $q->where(['client_id'=>$id, 'Evenements.id'=>$event_last]);} ]
                    ]
                ]
            ])->order(['ContactSmsEnvois.created' => 'DESC'])->toArray();
            //debug($les_envois);die;
            $array ['les_envois'] = $les_envois;

        }
        //debug($array);die;
        /*if($client) {
            foreach ($client->evenements as $key => $evenement) { 

                    if(!empty($evenement->photos)){                           
                            $collection = new Collection($evenement->photos);
                            $id = $collection->extract('id');
                            $idPhotos = $id->toList();                                                                        
                            $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                                        ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                                        ->toArray();
                            //debug($listContactSms);       
                            if(!empty(count($listContactSms))){
                                $smsEnvoye = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find()
                                                                        ->where(['contact_id IN' => $listContactSms])
                                                                        ->toArray();
                                debug(count($smsEnvoye));
                            }
                    }
            }
        }die;*/

        return $array;
     }
    

}