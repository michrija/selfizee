<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\I18n\Date;
use Cake\I18n\Time;
/**
 * Crons Controller
 *
 * @property \App\Model\Table\CronsTable $Crons
 *
 * @method \App\Model\Entity\Cron[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CronsController extends AppController
{

//    /**
//     * Index method
//     *
//     * @return \Cake\Http\Response|void
//     */
//    public function index()
//    {
//        $this->paginate = [
//            'contain' => ['Evenements', 'Intervalles']
//        ];
//        $crons = $this->paginate($this->Crons);
//
//        $this->set(compact('crons'));
//    }
//
//    /**
//     * View method
//     *
//     * @param string|null $id Cron id.
//     * @return \Cake\Http\Response|void
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $cron = $this->Crons->get($id, [
//            'contain' => ['Evenements', 'Intervalles']
//        ]);
//
//        $this->set('cron', $cron);
//    }


    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['add','manuel'])) {
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
             if (in_array($action, ['add','manuel']) && ( $user['is_active_acces_send_email'] == true || $user['is_active_acces_send_sms'] == true) ) {
                return true;
            }
        }

        // Par d�faut, on refuse l'acc�s.
        return parent::isAuthorized($user);
    }

    public  function testCP() {

        date_default_timezone_set('Europe/Paris');
        debug(Time::now());
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        ->contain([
                                            'CronsProgrammes' => function ($q) {
                                                return $q->where([
                                                    'CronsProgrammes.date_programme <=' => Time::now(),
                                                    'CronsProgrammes.is_active_envoi_programme'=>true]);
                                            }
                                        ]);
        //debug($evenements->toArray()[0]->crons_programme->is_sms_cron_programme);
        debug($evenements->toArray());die;

    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $cron = $this->Crons->newEntity();
        $this->loadModel('CronsProgrammes');
        $cron_programme = $this->CronsProgrammes->newEntity();
        if(!empty($idEvenement)){
            $evenement = $this->Crons->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
            $cronFind = $this->Crons->find()->where(['evenement_id'=>$idEvenement])->first();
            if($cronFind){
                $cron = $cronFind;
            }

            $cron_programme_find = $this->CronsProgrammes->find()->where(['evenement_id'=>$idEvenement])->first();
            if($cron_programme_find){
                $cron_programme = $cron_programme_find;
            }
        }
        //debug($cron_programme);die;
        
  //      $cronTextToEdit = "";
//        if(!empty($cronFind)){
//              $cron = $cronFind;
//              
//                switch ($cronFind->intervalle_id) {
//                    case 1: // 5 mn
//                        $cronText ="*/5 * * * *";
//                        break;
//                    case 2: // 10 mn
//                        $cronText = "*/10 * * * *";
//                        break;
//                    case 3: // 30 mn
//                        $cronText = "*/30 * * * *";
//                        break;
//                    case 4: // 1h
//                        $cronText = "0 */1 * * *";
//                        break;
//                }
//                
//                if(!empty($cronText)){
//                    //$cronTextToEdit = $cronText.' wget -O - http://event.selfizee.fr/cadre-data/uploadDataborneNoCsvWs/'.$idEvenement;
//                    $cronTextToEdit = $cronText.' cd ' .Configure::read('chemin_public_html').' && bin/cake photo import '.$idEvenement.' '.intval($cron->is_cron_email)." ".intval($cron->is_cron_sms);
//                }
//        }
        if ($this->request->is(['patch', 'post', 'put'])) { 
            debug($this->request->getData());
            $cron = $this->Crons->patchEntity($cron, $this->request->getData());
            $cron_programme = $this->CronsProgrammes->patchEntity($cron_programme, $this->request->getData());
            //debug($cron_programme);die;
            if ($this->Crons->save($cron)) {
                $this->CronsProgrammes->save($cron_programme);
                //if(!empty($cronTextToEdit) || !$cron->is_active){
//                    $this->loadComponent('Crontab');
//                    $this->Crontab->removeJob($cronTextToEdit);
//                }

                $this->Flash->success(__('The cron has been saved.'));

                return $this->redirect(['action' => 'add', $idEvenement]);
            }
            $this->Flash->error(__('The cron could not be saved. Please, try again.'));
        }
        $evenements = $this->Crons->Evenements->find('list');
        $intervalles = $this->Crons->Intervalles->find('list', ['valueField' => 'intervalle']);
        $this->set(compact('cron', 'cron_programme', 'evenements', 'intervalles','idEvenement','evenement'));
         $this->set('isConfiguration',true);
    }
    
    public function manuel($idEvenement){
        $evenement = $this->Crons->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);
        $nbrContactEmail = 0;
        $nbrContactSms = 0;
        $nbrEmailEnvoye =0;
        $nbrSmsEnvoye = 0;
        $nbrEmailNotDelivry = 0;
        
        if(!empty($evenement->photos)){
            
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            $this->loadModel('Evenements');
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
             * Liste email non delivr�s
             * **/ 
             if(!empty($nbrEmailEnvoye)){
                $nbrEmailNotDelivry = $this->Evenements->Photos->Contacts->find()
                                                        ->where(['contact_id IN' => $listContactEmail])
                                                        ->notMatching('Envois.EnvoiEmailStatDelivres')
                                                        ->count();
             }
             
                                               
            
        }
        $this->loadModel('EnvoiManuels');
        $envoiManuel = $this->EnvoiManuels->newEntity();
                                                        
        $this->set(compact('idEvenement','evenement','nbrContactEmail','nbrContactSms','nbrEmailEnvoye','nbrSmsEnvoye','envoiManuel','nbrEmailNotDelivry'));
    }

	
    public function manuelTest($idEvenement){
        $evenement = $this->Crons->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);
        $nbrContactEmail = 0;
        $nbrContactSms = 0;
        $nbrEmailEnvoye =0;
        $nbrSmsEnvoye = 0;
        $nbrEmailNotDelivry = 0;
        
        if(!empty($evenement->photos)){
            
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            $this->loadModel('Evenements');
            $listContactEmail = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();
            $nbrContactEmail = count($listContactEmail);
                                                        
            $listContactSms = $this->Evenements->Photos->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'telephone IS NOT' => 'NULL','telephone <>'=>''])
                                                        ->toArray();
            $nbrContactSms = count($listContactSms);
		    debug("nbrContactEmail :".$nbrContactEmail);
                                                        
            
            if(!empty($nbrContactEmail)){
                $nbrEmailEnvoye = $this->Evenements->Photos->Contacts->ContactEmailsEnvois->find()
                                                        ->where(['contact_id IN' => $listContactEmail])
                                                        ->count();


                $emailEnvoye = $this->Evenements->Photos->Contacts->ContactEmailsEnvois->find('list', ['valueField' => 'id'])
                                                        ->where(['contact_id IN' => $listContactEmail])
                                                        ->toArray();
            }
            
		debug("nbrEmailEnvoye :".$nbrEmailEnvoye);
		debug(implode(',',$emailEnvoye));


            if(!empty($nbrContactSms)){
                $nbrSmsEnvoye = $this->Evenements->Photos->Contacts->ContactSmsEnvois->find()
                                                        ->where(['contact_id IN' => $listContactSms])
                                                        ->count();
            }   
            
            /**
             * Liste email non delivr�s
             * **/ 
             if(!empty($nbrEmailEnvoye)){
                $nbrEmailNotDelivry = $this->Evenements->Photos->Contacts->find()
                                                        ->where(['contact_id IN' => $listContactEmail])
                                                        ->notMatching('Envois.EnvoiEmailStatDelivres')
                                                        ->count();

                                                        
                $EmailDelivry = $this->Evenements->Photos->Contacts->find('list', ['valueField' => 'id'])
                ->where(['contact_id IN' => $listContactEmail])
                ->matching('Envois.EnvoiEmailStatDelivres')
                ->toArray();
             }
		debug("nbrEmailNotDelivry :".$nbrEmailNotDelivry);
		debug($EmailDelivry);
		die;
             
                                               
            
        }
        $this->loadModel('EnvoiManuels');
        $envoiManuel = $this->EnvoiManuels->newEntity();
                                                        
        $this->set(compact('idEvenement','evenement','nbrContactEmail','nbrContactSms','nbrEmailEnvoye','nbrSmsEnvoye','envoiManuel','nbrEmailNotDelivry'));
    }
//
//    /**
//     * Edit method
//     *
//     * @param string|null $id Cron id.
//     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $cron = $this->Crons->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $cron = $this->Crons->patchEntity($cron, $this->request->getData());
//            if ($this->Crons->save($cron)) {
//                $this->Flash->success(__('The cron has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The cron could not be saved. Please, try again.'));
//        }
//        $evenements = $this->Crons->Evenements->find('list', ['limit' => 200]);
//        $intervalles = $this->Crons->Intervalles->find('list', ['limit' => 200]);
//        $this->set(compact('cron', 'evenements', 'intervalles'));
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Cron id.
//     * @return \Cake\Http\Response|null Redirects to index.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $cron = $this->Crons->get($id);
//        if ($this->Crons->delete($cron)) {
//            $this->Flash->success(__('The cron has been deleted.'));
//        } else {
//            $this->Flash->error(__('The cron could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
//    }
}
