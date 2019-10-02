<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Intervalles Controller
 *
 * @property \App\Model\Table\IntervallesTable $Intervalles
 *
 * @method \App\Model\Entity\Intervalle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MailjetHooksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function event()
    {
        Log::info('Appel mailjet', ['scope' => ['webhooksmailjet']]);
        $this->loadModel('Envois');
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = false;
        if ($this->request->is('post')) {
            $events = $this->request->getData(); 
            //Log::warning('Data postée '.debug($events), ['scope' => ['webhooksmailjet']]);
            $datas = array();
            foreach($events as $event){
                $envoi = $this->Envois->find()
                                    ->where(['envoi_type' =>'email','message_id_in_mailjet' => $event['MessageID'] ])
                                    ->first();
                if($envoi){
                    $dataStat['envoi_id'] = $envoi->id;
                    $dataStat['event_type'] = $event['event'];
                    $dataStat['mj_campaign_id'] = $event['mj_campaign_id'];
                    $dataStat['customcampaign'] = $event['customcampaign'];
                    
                    $dataStat['date_event'] = date("Y-m-d H:i:s",$event['time'] );
                    $dataStat['error'] = isset($event['error']) ? $event['error'] : "";
                    if($event['event'] == 'bounce'){
                        $dataStat['blocked'] = isset($event['blocked']) ? $event['blocked'] : 0; //$event['blocked'];
                        $dataStat['hard_bounce'] = isset($event['hard_bounce']) ? $event['hard_bounce'] : 0;// $event['hard_bounce'];
                        $dataStat['error_related_to'] = isset($event['error_related_to']) ? $event['error_related_to'] : ""; //$event['error_related_to'];
                    }
                    array_push($datas, $dataStat);
                }
            }
            
            if(!empty($datas)){
                $entities = $this->Envois->EnvoiEmailStatistiques->newEntities($datas);
                
                /*//debug($entities); die;*/
                
                
                $envoiEmailStatistiques = $this->Envois->EnvoiEmailStatistiques;
                $res = $envoiEmailStatistiques->getConnection()->transactional(function () use ($envoiEmailStatistiques, $entities) {
                    foreach ($entities as $entity) {
                        if($envoiEmailStatistiques->save($entity, ['atomic' => false])=== false){
                            return false;
                        }
                    }
                });
            
                if ($res === false) {
                    Log::warning('Problème de save ', ['scope' => ['webhooksmailjet']]);
                    return  $this->response->withStatus(500);
                }else{
                    return  $this->response->withStatus(200);
                }
            }
        }else{
             Log::warning('Pas un post ', ['scope' => ['webhooksmailjet']]);
        }
        return  $this->response->withStatus(200);
        //echo json_encode($res);
    }
    
}