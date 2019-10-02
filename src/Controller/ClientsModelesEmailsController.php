<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClientsModelesEmails Controller
 *
 * @property \App\Model\Table\ClientsModelesEmailsTable $ClientsModelesEmails
 *
 * @method \App\Model\Entity\ClientsModelesEmail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsModelesEmailsController extends AppController
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
            
            if(in_array($action,['delete','getModele'])){
             //if($action == 'delete'){ // Pour le moment
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
            'conditions'=>['ClientsModelesEmails.client_id'=>$client_id]
        ];
        $clientsModelesEmails = $this->paginate($this->ClientsModelesEmails);
        $client = $this->ClientsModelesEmails->Clients->get($client_id);
        $this->viewBuilder()->setLayout('page_config_user');

        $modeles = $this->ClientsModelesEmails->find('list', ['valueField'=>'nom_modele'])->where(['client_id'=> $client_id]);
        //debug($modeles->toArray());die;
        $this->set(compact('clientsModelesEmails', 'client', 'modeles'));
    }

    /**
     * View method
     *
     * @param string|null $id Clients Modeles Email id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsModelesEmail = $this->ClientsModelesEmails->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('clientsModelesEmail', $clientsModelesEmail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($client_id = null)
    {

        $this->viewBuilder()->setLayout('page_config_user');

        $modele_existant = trim($this->request->getQuery('modele_id'));
        $clientsModelesEmail = $this->ClientsModelesEmails->newEntity();
        if($modele_existant){
            $clientsModelesEmail = $this->ClientsModelesEmails->get($modele_existant);
            $clientsModelesEmail->isNew('true');
            $clientsModelesEmail->nom_modele = "";
            $clientsModelesEmail->id  = null;
            $clientsModelesEmail->client_id  = null;
            //debug($clientsModelesEmail);die;
        }
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            $clientsModelesEmail = $this->ClientsModelesEmails->patchEntity($clientsModelesEmail, $this->request->getData());
            if ($this->ClientsModelesEmails->save($clientsModelesEmail)) {
                $this->Flash->success(__('The clients modeles email has been saved.'));

                return $this->redirect(['action' => 'index', $client_id]);
            }
            $this->Flash->error(__('The clients modeles email could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsModelesEmails->Clients->find('list', ['limit' => 200]);
        $client = $this->ClientsModelesEmails->Clients->get($client_id);
        $this->set(compact('clientsModelesEmail', 'clients', 'client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clients Modeles Email id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($client_id = null, $id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $clientsModelesEmail = $this->ClientsModelesEmails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsModelesEmail = $this->ClientsModelesEmails->patchEntity($clientsModelesEmail, $this->request->getData());
            if ($this->ClientsModelesEmails->save($clientsModelesEmail)) {
                $this->Flash->success(__('The clients modeles email has been saved.'));

                return $this->redirect(['action' => 'index', $client_id]);
            }
            $this->Flash->error(__('The clients modeles email could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsModelesEmails->Clients->find('list', ['limit' => 200]);
        $client = $this->ClientsModelesEmails->Clients->get($client_id);
        $this->set(compact('clientsModelesEmail', 'clients', 'client'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clients Modeles Email id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $client_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsModelesEmail = $this->ClientsModelesEmails->get($id);
        if ($this->ClientsModelesEmails->delete($clientsModelesEmail)) {
            $this->Flash->success(__('The clients modeles email has been deleted.'));
        } else {
            $this->Flash->error(__('The clients modeles email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $client_id]);
    }


    public function getModele($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        if($this->request->is('post')) {
            $clientsModelesEmail = $this->ClientsModelesEmails->get($this->request->getData()['model_email']);
            echo json_encode($clientsModelesEmail);
        }
    }
}
