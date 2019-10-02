<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersModelesEmails Controller
 *
 * @property \App\Model\Table\UsersModelesEmailsTable $UsersModelesEmails
 *
 * @method \App\Model\Entity\UsersModelesEmail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersModelesEmailsController extends AppController
{

    public function isAuthorized($user)
    {
        // Par défaut, on refuse l'accès.
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($user_id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $this->paginate = [
            'contain' => ['Users'],
            'conditions'=>['UsersModelesEmails.user_id'=>$user_id]
        ];
        $usersModelesEmails = $this->paginate($this->UsersModelesEmails);


        $user = $this->UsersModelesEmails->Users->get($user_id);
        $this->set(compact('usersModelesEmails', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Modeles Email id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersModelesEmail = $this->UsersModelesEmails->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersModelesEmail', $usersModelesEmail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $usersModelesEmail = $this->UsersModelesEmails->newEntity();
        if ($this->request->is('post')) {
            $usersModelesEmail = $this->UsersModelesEmails->patchEntity($usersModelesEmail, $this->request->getData());
            if ($this->UsersModelesEmails->save($usersModelesEmail)) {
                $this->Flash->success(__('The users modeles email has been saved.'));

                return $this->redirect(['action' => 'index', $user_id]);
            }
            $this->Flash->error(__('The users modeles email could not be saved. Please, try again.'));
        }
        $users = $this->UsersModelesEmails->Users->find('list', ['limit' => 200]);
        $user = $this->UsersModelesEmails->Users->get($user_id);
        $this->set(compact('usersModelesEmail', 'users', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Modeles Email id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($user_id = null, $id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $usersModelesEmail = $this->UsersModelesEmails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersModelesEmail = $this->UsersModelesEmails->patchEntity($usersModelesEmail, $this->request->getData());
            if ($this->UsersModelesEmails->save($usersModelesEmail)) {
                $this->Flash->success(__('The users modeles email has been saved.'));

                return $this->redirect(['action' => 'index', $user_id]);
            }
            $this->Flash->error(__('The users modeles email could not be saved. Please, try again.'));
        }
        $users = $this->UsersModelesEmails->Users->find('list', ['limit' => 200]);
        $user = $this->UsersModelesEmails->Users->get($user_id);
        $this->set(compact('usersModelesEmail', 'users', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Modeles Email id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $user_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersModelesEmail = $this->UsersModelesEmails->get($id);
        if ($this->UsersModelesEmails->delete($usersModelesEmail)) {
            $this->Flash->success(__('The users modeles email has been deleted.'));
        } else {
            $this->Flash->error(__('The users modeles email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $user_id]);
    }
}
