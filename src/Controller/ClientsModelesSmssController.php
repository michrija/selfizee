<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClientsModelesSmss Controller
 *
 * @property \App\Model\Table\ClientsModelesSmssTable $ClientsModelesSmss
 *
 * @method \App\Model\Entity\ClientsModelesSms[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsModelesSmssController extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['index','add','edit'])) { 
                    $id = $this->request->getParam('pass.0');
                    $idCurrentClient = $user['client_id'];
                    
                    if($idCurrentClient == $id)  {
                        return true;
                    }              
            }
            if(in_array($action, ['delete','getModele'])){ // Pour le moment
                return true;
            }
            
        }
        
  
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($client_id = null)
    {
        $this->paginate = [
            'contain' => ['Clients'],
            'conditions'=>['ClientsModelesSmss.client_id'=>$client_id]
        ];
        $clientsModelesSmss = $this->paginate($this->ClientsModelesSmss);
        $client = $this->ClientsModelesSmss->Clients->get($client_id);
        $this->viewBuilder()->setLayout('page_config_user');

        $modeles = $this->ClientsModelesSmss->find('list', ['valueField'=>'nom_modele'])->where(['client_id' => $client_id]);

        $this->set(compact('clientsModelesSmss', 'client', 'modeles'));
    }

    /**
     * View method
     *
     * @param string|null $id Clients Modeles Sms id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsModelesSms = $this->ClientsModelesSmss->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('clientsModelesSms', $clientsModelesSms);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($client_id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $client = $this->ClientsModelesSmss->Clients->get($client_id);
        $clientsModelesSms = $this->ClientsModelesSmss->newEntity();

        $modele_existant = trim($this->request->getQuery('modele_id'));
        if($modele_existant){
            $clientsModelesSms = $this->ClientsModelesSmss->get($modele_existant);
            $clientsModelesSms->isNew('true');
            $clientsModelesSms->nom_modele = "";
            $clientsModelesSms->id  = null;
            $clientsModelesSms->client_id  = null;
            //debug(ClientsModelesSmss);die;
        }

        if ($this->request->is('post')) {
            $clientsModelesSms = $this->ClientsModelesSmss->patchEntity($clientsModelesSms, $this->request->getData());
            if ($this->ClientsModelesSmss->save($clientsModelesSms)) {
                $this->Flash->success(__('The clients modeles sms has been saved.'));

                return $this->redirect(['action' => 'index', $client_id]);
            }
            $this->Flash->error(__('The clients modeles sms could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsModelesSmss->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientsModelesSms', 'clients', 'client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clients Modeles Sms id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($client_id = null, $id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $client = $this->ClientsModelesSmss->Clients->get($client_id);
        $clientsModelesSms = $this->ClientsModelesSmss->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsModelesSms = $this->ClientsModelesSmss->patchEntity($clientsModelesSms, $this->request->getData());
            if ($this->ClientsModelesSmss->save($clientsModelesSms)) {
                $this->Flash->success(__('The clients modeles sms has been saved.'));

                return $this->redirect(['action' => 'index', $client_id]);
            }
            $this->Flash->error(__('The clients modeles sms could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsModelesSmss->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientsModelesSms', 'clients', 'client'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clients Modeles Sms id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $client_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsModelesSms = $this->ClientsModelesSmss->get($id);
        if ($this->ClientsModelesSmss->delete($clientsModelesSms)) {
            $this->Flash->success(__('The clients modeles sms has been deleted.'));
        } else {
            $this->Flash->error(__('The clients modeles sms could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $client_id]);
    }


    public function getModele($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        if($this->request->is('post')) {
            $clientsModelesSms = $this->ClientsModelesSmss->get($this->request->getData()['model_sms']);
            echo json_encode($clientsModelesSms);
        }
    }
}
