<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeClients Controller
 *
 * @property \App\Model\Table\TypeClientsTable $TypeClients
 *
 * @method \App\Model\Entity\TypeClient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeClientsController extends AppController
{
public function initialize(array $config = [])
    {
        $this->viewBuilder()->setLayout('sans_menu');
        parent::initialize($config);
        $this->loadModel('TypeClients');
    }


     public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['view'])) { 
                    $id = $this->request->getParam('pass.0');
                    $idCurrentClient = $user['client_id'];
                    
                    if($idCurrentClient == $id)  {
                        return true;
                    }              
            }
        }

        if (in_array($action, ['editProfile'])) { 
            return true;
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

        $typeClients = $this->paginate($this->TypeClients);

        $this->set(compact('typeClients'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeClient = $this->TypeClients->newEntity();
        if ($this->request->is('post')) {
             $data= $this->request->getData();
             $typeClient = $this->TypeClients->patchEntity($typeClient, $data);
            if ($this->TypeClients->save($typeClient)) {
                $this->Flash->success(__('The type client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type client could not be saved. Please, try again.'));
        }
        $this->set(compact('typeClient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeClient = $this->TypeClients->get($id);
        if ($this->TypeClients->delete($typeClient)) {
            $this->Flash->success(__('The type client has been deleted.'));
        } else {
            $this->Flash->error(__('The type client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
