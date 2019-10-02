<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SmsConfigurations Controller
 *
 * @property \App\Model\Table\SmsConfigurationsTable $SmsConfigurations
 *
 * @method \App\Model\Entity\SmsConfiguration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SmsConfigurationsController extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);

        if(in_array($user['role_id'], $autorised ) ) {
            if (in_array($action, ['add'])) {
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

        // $filtersActions = ['add'];
        // $authorisedRole = [2];

        // if (in_array($user['role_id'], $authorisedRole)) {
        //     return true;
        // }
        // Par défaut, on refuse l'accès.
        // return parent::isAuthorized($user);
        

        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    

 //   /**
//     * Index method
//     *
//     * @return \Cake\Http\Response|void
//     */
//    public function index()
//    {
//        $smsConfigurations = $this->paginate($this->SmsConfigurations);
//
//        $this->set(compact('smsConfigurations'));
//    }
//
//    /**
//     * View method
//     *
//     * @param string|null $id Sms Configuration id.
//     * @return \Cake\Http\Response|void
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $smsConfiguration = $this->SmsConfigurations->get($id, [
//            'contain' => ['Evenements']
//        ]);
//
//        $this->set('smsConfiguration', $smsConfiguration);
//    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $smsConfiguration = $this->SmsConfigurations->newEntity();
        $evenement = null;
        if(!empty($idEvenement)){
            $evenement = $this->SmsConfigurations->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
            $smsConfigurationFind = $this->SmsConfigurations->find()->where(['evenement_id'=>$idEvenement])->first();
            if($smsConfigurationFind){
                $smsConfiguration = $smsConfigurationFind;
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            //Date d'envoi
            $data = $this->request->getData();
            $dataEnvoiFr = trim($this->request->getData('date_heure_envoi'));
            if(!empty($dataEnvoiFr)){
                $dateEnvoi = $this->DateFR2DateSQL($dataEnvoiFr);
                $data['date_heure_envoi'] = $dateEnvoi;
            }

            $isEnvoiPlannifie = $this->request->getData('is_envoi_plannifie');
            if(empty($isEnvoiPlannifie)){
                $data['date_heure_envoi'] = null;
            }

            $smsConfiguration = $this->SmsConfigurations->patchEntity($smsConfiguration, $data);
            //debug($this->request->getData()); die;
            if ($this->SmsConfigurations->save($smsConfiguration)) {
                $this->Flash->success(__('The sms configuration has been saved.'));

                return $this->redirect(['action' => 'add',$smsConfiguration->evenement_id ]);
            }
            $this->Flash->error(__('The sms configuration could not be saved. Please, try again.'));
        }
        $evenements = $this->SmsConfigurations->Evenements->find('list',['valueField'=>'nom']);
        $clientsModelesSmss = $this->SmsConfigurations->ClientsModelesSmss->find('list', ['valueField'=>'nom_modele'])->where(['client_id'=> $evenement->client_id]);

        // Info crédit client
        $this->loadComponent('SendInfo');
        $client = null;
        $dernieres_demande_crdt = null;


        $connectedUser = $this->Auth->user();
        $role_user_connected = $connectedUser['role_id'];
        $client_id = $connectedUser['client_id'];

        // src credits/creditsms/id_client, 
        // il faut que l'utilisateur connecté soit client sinon pas d'info crédit
        if(!empty($idClient)) {
            $client = $this->Clients->get($idClient);
            $infoCreditClient = $this->SendInfo->infoDetailClient($idClient);
        }

        if($role_user_connected == 2){
            $idClient = $this->Auth->user()['client_id'];
            $infoCreditClient = $this->SendInfo->infoDetailClient($idClient);
        }


        $this->set(compact('smsConfiguration','idEvenement','evenements', 'client_id', 'evenement', 'clientsModelesSmss'));
        $this->set('isConfiguration',true);
    }

    public  function DateFR2DateSQL ($date) {
          //$date = '29/12/1990 23:30';
          //29/12/1990 23:30
          $day    = substr($date,0,2);
          $month  = substr($date,3,2);
          $year   = substr($date,6,4);
          $hour   = substr($date,11,2);
          $minute = substr($date,14,2);
          $second = substr($date,18,2);
            //debug($hour.'-'.$minute.'-'.$second.'-'.$month.'-'.$day.'-'.$year);die;

          $timestamp= mktime($hour,$minute,$second,$month,$day,$year);
          return date('Y-m-d H:i:s',$timestamp);  
    }
    
    public function sendSmsTest($idEvenement){
         
         if ($this->request->is(['patch', 'post', 'put'])) {
            $idEvenement = $this->request->getData('evenement_id');
            $destinataire = $this->request->getData('destinataire');
          
            
            if(!empty($destinataire) && !empty($idEvenement)){
                $this->loadComponent('Send');
                $smsConfiguration = $this->SmsConfigurations->find()
                                                    ->where(['evenement_id'=> $idEvenement])
                                                    ->contain(['Evenements'])
                                                    ->first();
                                                  
                if(!empty($smsConfiguration)){
                    $res = $this->Send->smsTest($destinataire, $smsConfiguration);
                    if($res){
                        $this->Flash->success(__('SMS de test envoyé'));
                    }else{
                        $this->Flash->error(__('SMS de test non envoyé. Veuillez réessayer'));
                    }
                }else{
                    $this->Flash->error(__("Avant de faire un test d'envoi. Veuillez enregister votre configuration."));
                }
            }else{
                 $this->Flash->error(__('Champ numéro obligatoire'));
            }
         }
         return $this->redirect(['action' => 'add',$idEvenement]);
    }

  //  /**
//     * Edit method
//     *
//     * @param string|null $id Sms Configuration id.
//     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $smsConfiguration = $this->SmsConfigurations->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $smsConfiguration = $this->SmsConfigurations->patchEntity($smsConfiguration, $this->request->getData());
//            if ($this->SmsConfigurations->save($smsConfiguration)) {
//                $this->Flash->success(__('The sms configuration has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The sms configuration could not be saved. Please, try again.'));
//        }
//        $this->set(compact('smsConfiguration'));
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Sms Configuration id.
//     * @return \Cake\Http\Response|null Redirects to index.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $smsConfiguration = $this->SmsConfigurations->get($id);
//        if ($this->SmsConfigurations->delete($smsConfiguration)) {
//            $this->Flash->success(__('The sms configuration has been deleted.'));
//        } else {
//            $this->Flash->error(__('The sms configuration could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
//    }
}
