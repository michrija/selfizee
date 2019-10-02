<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Filesystem\Folder;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\RegenerateImageComponent;
use App\Controller\Component\SendComponent; 
use Cake\Core\Configure;
use \Mailjet\Resources;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;

class MailjetShell extends Shell
{
    
    public function getStatOfContact(){
        $this->loadModel('Contacts');
        $contacts = $this->Contacts->find()
                                ->where(['Contacts.email IS NOT' => NULL, 'Contacts.email <> '=>''])
                                ->order(['Contacts.id' => 'DESC'])
                                ->matching('Envois')
                                ->distinct(['Contacts.id']);
                                
       

        foreach($contacts as $contact){
            if(!empty($contact->email)){
                var_dump($contact->id);
                $res = $this->getStatByMessage($contact->id);
                var_dump($res);
            }
        }
    }
    
    public function getStatOfEnvoi(){
        $this->loadModel('Envois');
        $envois = $this->Envois->find()
                            ->contain(['Contacts'])
                            ->where([
                                    'Envois.envoi_type' => 'email',
                                    'Envois.message_id_in_mailjet <>'=>'',
                                    'Envois.message_id_in_mailjet IS NOT'=>NULL
                            ])
                            /*->notMatching('EnvoiStatistiques')*/;
                            
        foreach($envois as $envoi){
            $res = $this->getStatByMessage($envoi->message_id_in_mailjet);
            //debug($res); die;
            //debug($res['OpenedAt']);
            //debug($res['ArrivedAt']);
            if( !empty($res['OpenedAt']) && !empty($res['ArrivedAt']) ){
                
                $OpenedAt  = new FrozenTime($res['OpenedAt'], 'Europe/Paris');
                $ArrivedAt = new FrozenTime($res['ArrivedAt'], 'Europe/Paris');
                
                $dataStat['is_opened'] = true;
                $dataStat['opened_at'] = $OpenedAt;
                $dataStat['arrived_at'] = $ArrivedAt;
                $dataStat['envoi_id'] = $envoi->id;
                
                //debug($dataStat);
                
                $envoiStat = $this->Envois->EnvoiStatistiques->newEntity($dataStat);
                die;
                if($this->Envois->EnvoiStatistiques->save($envoiStat)){
                    $this->out('Stat saved');
                }else {
                     ///debug($envoiStat);
                }
            }
        }
        
    }
    
    public function getStatByMessage($id) {
       $body = [
                "method" => "VIEW",
                "ID" => $id
            ];
        
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        
        $mj = new \Mailjet\Client($apikey, $apisecret);
        /*$mj = new \Mailjet\Client($apikey,
                          $apisecret, true, 
                          ['url' => "www.mailjet.com", 'version' => 'v3', 'call' => false]
                        );*/
        
        //$response = $mj->get(Resources::$Message, ['id' => $id]);
        $response = $mj->get(Resources::$Messagehistory,['id' => $id]);
        $response->success() ;
        $_result = $response->getData();
        debug($_result);
        debug( $response );
        //debug($this->getOpenInformationById($_id));die();
        if($response->getStatus()==200){
            $_result = $response->getData();
            debug($_result);
            
            $_result[0]['info'] = $this->getOpenInformationById($id);
            
            return $_result;
        }
        return [];
    }
    
    public  function getOpenInformationById($id) {
        //debug($id);
//        $body = [
//            "method" => "VIEW",
//            "Filters"=>["MessageID"=>$id ],
//            //"id" => $id
//           
//        ];
        
        $body = [
            "method" => "VIEW",
            "Filters"=>[
                "MessageID"=>$id 
            ]
        ];
        
        //debug($body);
        
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $response = $mj->get(Resources::$Clickstatistics,$body);
        $response->success() ;
        $result = $response->getData();
        debug($result);
        if($response->getStatus()==200){
            debug($result);
            if(!empty($result)){
                //$_last = count($_result)-1;
                return $result[0];
                //return UtilsComponent::convertDateTimeToTimestamp($_result[$_last]["OpenedAt"]);
            }
        }
        return  [];
        //debug($_result);
    }
    
    /*public function getStatByMessage($id) {
        
        
            
        $body = [
            "method" => "VIEW",
            "Filters"=>[
                "MessageID"=>$id 
            ]
        ];
        
            
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        
        $mj = new \Mailjet\Client($apikey, $apisecret);
       
        $response = $mj->get(Resources::$Openinformation,$body);
        $response->success();
        var_dump($response->getStatus());
        
        //debug($this->getOpenInformationById($_id));die();
        if($response->getStatus()== 200){
            $res = $response->getData();
            var_dump($response->getData());
            //$_result[0]['info'] = $this->getOpenInformationById($_id);
            //var_dump($_result);
            return $res;
        }
        return null;
    }*/
    
    public function getAllStatByCampaign(){
        $this->loadModel('Evenements');
        $evenements = $this->Evenements->find('all')->order(['Evenements.id' => 'DESC']);
        
        foreach($evenements as $evenement){
            //$_album = $this->Albums->get(179);
            $stats = $this->getStatByCampaign($evenement->slug);
            //var_dump($stats); //
        }
    }
    
    
    /**
     * 
     * **/
     public function getInfoCampaign($customCampaingId){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $response = $mj->get(Resources::$Campaign, ['id' => $customCampaingId]);
        $response->success() ;
        $res = $response->getData();
        $campaignId = null;
        if($response->getStatus()==200){
            if(!empty($res)){
               if(!empty($res[0])){
                     $campaignId = $res[0]['ID'];
                }
               
            }
        }
        return $campaignId;
        
     }
    
    /**
     * Stat campagne Qui marche 
     * */
    
    public function statCounterByCampain($evenement){
        
        $campaignId = $this->getInfoCampaign($evenement->slug);
        //debug($campaignId);
        if(!empty($campaignId)){
            $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
            $apisecret = '1787d0ef5b8602e692cc86895494bb12';
            
            $mj = new \Mailjet\Client($apikey, $apisecret);
            
            if($evenement->id == 1539 ){
                $campaignId = 3047132;
            }
            
            $body = [
                "Filters"=>[
                    'SourceID' => "".$campaignId."",
                    'CounterSource' => 'Campaign',
                    'CounterTiming' => 'Message',
                    'CounterResolution' => 'Lifetime'
                ]
            ];
            
            $response = $mj->get(Resources::$Statcounter,$body);
            $response->success() ;
            $result = $response->getData();
            if($response->getStatus()==200){
                if(!empty($result)){
                    $res = $result[0];
                    $this->loadModel('EvenementStatCampaigns');
                    $data['evenement_id'] = $evenement->id;
                    $data['event_click_delay'] = $res["EventClickDelay"];
                    $data['event_clicked_count'] = $res["EventClickedCount"];
                    $data['event_open_delay'] = $res["EventOpenDelay"];
                    $data['event_opened_count'] = $res["EventOpenedCount"];
                    $data['event_spam_count'] = $res["EventSpamCount"];
                    $data['event_unsubscribed_count'] = $res["EventUnsubscribedCount"];
                    $data['event_workflow_exited_count'] = $res["EventWorkflowExitedCount"];
                    $data['message_blocked_count'] = $res["MessageBlockedCount"];
                    $data['message_clicked_count'] = $res["MessageClickedCount"];
                    $data['message_deferred_count'] = $res["MessageDeferredCount"];
                    $data['message_hard_bounced_count'] = $res["MessageHardBouncedCount"];
                    $data['message_opened_count'] = $res["MessageOpenedCount"];
                    $data['message_queued_count'] = $res["MessageQueuedCount"];
                    $data['message_sent_count'] = $res["MessageSentCount"];
                    $data['message_soft_bounced_count'] = $res["MessageSoftBouncedCount"];
                    $data['message_spam_count'] = $res["MessageSpamCount"];
                    $data['message_unsubscribed_count'] = $res["MessageUnsubscribedCount"];
                    $data['message_workflow_exited_count'] = $res["MessageWorkFlowExitedCount"];
                    $data['source_id'] = $res["SourceID"];
                    $data['total'] = $res["Total"];
                    
                    $evenementStatCampaignFind = $this->EvenementStatCampaigns->find()
                                                                            ->where(['evenement_id' => $evenement->id])
                                                                            ->first();
                                                                            
                    $evenementStatCampaign = $this->EvenementStatCampaigns->newEntity($data);
                    if($evenementStatCampaignFind){
                        $evenementStatCampaign = $this->EvenementStatCampaigns->patchEntity($evenementStatCampaignFind, $data);
                    }
                    
                    if($this->EvenementStatCampaigns->save($evenementStatCampaign)){
                        $this->out('Stat save for evenement '.$evenement->id);
                        return true;
                    }
                }
            }
            return false;
        }
    }
    
    public function getStatByWebhooksEvent(){
        $this->loadModel('EnvoiEmailStatistiques');
        $evoiEmailStats = $this->EnvoiEmailStatistiques
										->find('all')
                                        ->where(['mj_campaign_id IS NOT' =>NULL ,
                                                'customcampaign IS NOT' => NULL,
                                                'is_stat_campain_update' => false
												])
										->distinct(['EnvoiEmailStatistiques.customcampaign']);
		$this->loadModel('Evenements');
		foreach($evoiEmailStats as $evoiEmailStat){
			$evenement = $this->Evenements->find()
										->where(['slug'=>$evoiEmailStat->customcampaign])
										->first();
			if($evenement){
				if($this->statCounterByCampain($evenement)){
				    $evoiEmailStat->is_stat_campain_update = true;
                    $this->EnvoiEmailStatistiques->save($evoiEmailStat);
				}
			}
		}                               
    }
    
    public function getStatOfAll(){
        $this->loadModel('Evenements');
        $evenements = $this->Evenements->find('all')->order(['Evenements.id'=>'DESC']);
        foreach($evenements as $evenement){
            $this->statCounterByCampain($evenement);
        }
    }
    
    public function getStatByCampaign($campaignName){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        
        $mj = new \Mailjet\Client($apikey,
                          $apisecret, true, 
                          ['url' => "www.mailjet.com", 'version' => 'v3', 'call' => false]
                        );
                        
        //var_dump($campaignName);
        //$mj = new \Mailjet\Client($apikey, $apisecret);
        $response = $mj->get(Resources::$Campaignstatistics,["id"=>$campaignName]);
        $response->success() ;
        //echo 'huhu';
        if($response->getStatus() == 200){
            return $response->getData();
        }else{
            return null;
        }
    }
    
     public function getStatOfAllMessageByCampaignId($CampaignID){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $params['Filters']['CustomCampaign'] = $CampaignID;
        $response = $mj->get(Resources::$Messagestatistics,$params);
        $response->success() ;
        
        $statData = array();
        if($response->getStatus()==200){
           
            $theData = $response->getData();
            $data = $theData[0];            
            //debug($data);
            $deliveredCount = $data['DeliveredCount'];
            if($deliveredCount){
                
                $statData['delivere_count']  = $deliveredCount;
                $statData['opened_percent']    = $deliveredCount>0?round($data['OpenedCount']*100/$deliveredCount,2):0;
                $statData['delivered_percent'] = $data['ProcessedCount']>0?round($deliveredCount*100/$data['ProcessedCount'],2):0;
                $statData['clicked_percent']   = $deliveredCount>0?round($data['ClickedCount']*100/$deliveredCount,2):0;
                $statData['blocked_percent']   = $data['ProcessedCount']>0?round($data['BlockedCount']*100/$data['ProcessedCount'],2):0;
                $statData['spam_percent']      = $data['ProcessedCount']>0?round($data['SpamComplaintCount']*100/$data['ProcessedCount'],2):0;
                $statData['average_click_delays'] = $data['AverageClickDelay'];
                $statData['average_open_delays'] = $data['AverageOpenDelay'];
                $statData['average_opened_count']= $data['AverageOpenedCount'];
            }
            
        }
        
        //debug($statData);
        return $statData;
    }
    
    public function getStatOfAllEvenement($idEvenement = null){
        $this->loadModel('Evenements');
        $evenements = $this->Evenements->find('all')
                                ->notMatching('EmailStatistiques');
                                
        if(!empty($idEvenement)){
            $evenements = $evenements->where(['Evenements.id' => $idEvenement]);
        }
        
        $this->loadModel('EmailStatistiques');
        
        foreach($evenements as $evenement){
            $res = $this->getStatOfAllMessageByCampaignId($evenement->slug);
            if(!empty($res)){
                $res['evenement_id'] = $evenement->id;
                $emailStatistique = $this->EmailStatistiques->newEntity($res);
                if($this->EmailStatistiques->save($emailStatistique)){
                    $this->out('Stat saved for evenement => '.$evenement->id);
                }else {
                    $this->out('Erreur de sauvegarde pour '.$evenement->id);
                }
            }
        }
        
    }
    
    public function inscirptionWebHooks($eventType){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $body = [
            'EventType' => $eventType,
            'Url' => "https://manager.selfizee.fr/MailjetHooks/event",
            'Version' => "2"
        ];
        $response = $mj->post(Resources::$Eventcallbackurl, ['body' => $body]);
        $response->success();
        var_dump($response->getData());
    }
    
    
    public function creatSubCount(){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $body = [
            'ACL' => "",
            'IsActive' => true,
            'Name' => "Test api key "
        ];
        
        $response = $mj->post(Resources::$Apikey, ['body' => $body]);
        $response->success();
         var_dump($response->getData());
    }
    
    public function createSender($email){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $body = [
            'Email' => $email
        ];
        
        $response = $mj->post(Resources::$Sender, ['body' => $body]);
        $response->success();
         var_dump($response->getData());
    }
    
     public function validateSender($sender_email){
        $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
        $apisecret = '1787d0ef5b8602e692cc86895494bb12';
        $mj = new \Mailjet\Client($apikey, $apisecret);
        
        $body = [
            'sender_email' => $sender_email
        ];
        
        $response = $mj->post(Resources::$SenderValidate, ['body' => $body]);
        $response->success();
         var_dump($response->getData());
    }
    
    
}