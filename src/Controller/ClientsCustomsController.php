<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClientsCustoms Controller
 *
 * @property \App\Model\Table\ClientsCustomsTable $ClientsCustoms
 *
 * @method \App\Model\Entity\ClientsCustom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsCustomsController extends AppController
{

    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['pageSouvenir','galerieSouvenir','add'])) {
                    $id = $this->request->getParam('pass.0');
                    $idCurrentClient = $user['client_id'];
                    
                    if($idCurrentClient == $id)  {
                        return true;
                    }               
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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients']
        ];
        $clientsCustoms = $this->paginate($this->ClientsCustoms);

        $this->set(compact('clientsCustoms'));
    }

    /**
     * View method
     *
     * @param string|null $id Clients Custom id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsCustom = $this->ClientsCustoms->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('clientsCustom', $clientsCustom);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($client_id = null)
    {
        $clientsCustom = $this->ClientsCustoms->newEntity();
        $this->viewBuilder()->setLayout('page_config_user');
        $custom = $this->ClientsCustoms->find('all')->where(['client_id'=>$client_id])->first();
        if($custom){
            $clientsCustom = $custom;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $clientsCustom = $this->ClientsCustoms->patchEntity($clientsCustom, $data);
            if ($this->ClientsCustoms->save($clientsCustom)) {
                $this->Flash->success(__('The clients custom has been saved.'));

                return $this->redirect(['action' => 'add', $client_id]);
            }
            $this->Flash->error(__('The clients custom could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsCustoms->Clients->find('list', ['limit' => 200]);
        $client = $this->ClientsCustoms->Clients->get($client_id);
        $this->set(compact('clientsCustom', 'clients', 'client'));
    }

    /**
     * AageSouvenir method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function pageSouvenir($client_id = null)
    {
        $clientsCustom = $this->ClientsCustoms->newEntity();
        $this->viewBuilder()->setLayout('page_config_user');
        $custom = $this->ClientsCustoms->find('all')->where(['client_id'=>$client_id])->first();
        if($custom){
            $clientsCustom = $custom;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $clientsCustom = $this->ClientsCustoms->patchEntity($clientsCustom, $data);
            if ($this->ClientsCustoms->save($clientsCustom)) {
                $this->Flash->success(__('The clients custom has been saved.'));

                return $this->redirect(['action' => 'pageSouvenir', $client_id]);
            } else {
                debug($clientsCustom);die;
            }
            $this->Flash->error(__('The clients custom could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsCustoms->Clients->find('list', ['limit' => 200]);
        $client = $this->ClientsCustoms->Clients->get($client_id);
        $this->set(compact('clientsCustom', 'clients', 'client'));
    }

    /**
     * GallerieSouvenir method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function galerieSouvenir($client_id = null)
    {
        $clientsCustom = $this->ClientsCustoms->newEntity();
        $this->viewBuilder()->setLayout('page_config_user');
        $custom = $this->ClientsCustoms->find('all')->where(['client_id'=>$client_id])->first();
        if($custom){
            $clientsCustom = $custom;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $clientsCustom = $this->ClientsCustoms->patchEntity($clientsCustom, $data);
            if ($this->ClientsCustoms->save($clientsCustom)) {
                $this->Flash->success(__('The clients custom has been saved.'));

                return $this->redirect(['action' => 'galerieSouvenir', $client_id]);
            }
            $this->Flash->error(__('The clients custom could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsCustoms->Clients->find('list', ['limit' => 200]);
        $client = $this->ClientsCustoms->Clients->get($client_id);
        $this->set(compact('clientsCustom', 'clients', 'client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clients Custom id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientsCustom = $this->ClientsCustoms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsCustom = $this->ClientsCustoms->patchEntity($clientsCustom, $this->request->getData());
            if ($this->ClientsCustoms->save($clientsCustom)) {
                $this->Flash->success(__('The clients custom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients custom could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsCustoms->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientsCustom', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clients Custom id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsCustom = $this->ClientsCustoms->get($id);
        if ($this->ClientsCustoms->delete($clientsCustom)) {
            $this->Flash->success(__('The clients custom has been deleted.'));
        } else {
            $this->Flash->error(__('The clients custom could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
