<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersModelesSmss Controller
 *
 * @property \App\Model\Table\UsersModelesSmssTable $UsersModelesSmss
 *
 * @method \App\Model\Entity\UsersModelesSms[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersModelesSmssController extends AppController
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
            'conditions'=>['UsersModelesSmss.user_id'=>$user_id]
        ];
        $usersModelesSmss = $this->paginate($this->UsersModelesSmss);

        $user = $this->UsersModelesSmss->Users->get($user_id);
        $this->set(compact('usersModelesSmss', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Modeles Sms id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersModelesSms = $this->UsersModelesSmss->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersModelesSms', $usersModelesSms);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $usersModelesSms = $this->UsersModelesSmss->newEntity();
        if ($this->request->is('post')) {
            $usersModelesSms = $this->UsersModelesSmss->patchEntity($usersModelesSms, $this->request->getData());
            if ($this->UsersModelesSmss->save($usersModelesSms)) {
                $this->Flash->success(__('The users modeles sms has been saved.'));

                return $this->redirect(['action' => 'index', $user_id]);
            }
            $this->Flash->error(__('The users modeles sms could not be saved. Please, try again.'));
        }
        $users = $this->UsersModelesSmss->Users->find('list', ['limit' => 200]);
        $user = $this->UsersModelesSmss->Users->get($user_id);
        $this->set(compact('usersModelesSms', 'users', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Modeles Sms id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($user_id = null, $id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $usersModelesSms = $this->UsersModelesSmss->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersModelesSms = $this->UsersModelesSmss->patchEntity($usersModelesSms, $this->request->getData());
            if ($this->UsersModelesSmss->save($usersModelesSms)) {
                $this->Flash->success(__('The users modeles sms has been saved.'));

                return $this->redirect(['action' => 'index', $user_id]);
            }
            $this->Flash->error(__('The users modeles sms could not be saved. Please, try again.'));
        }
        $users = $this->UsersModelesSmss->Users->find('list', ['limit' => 200]);
        $user = $this->UsersModelesSmss->Users->get($user_id);
        $this->set(compact('usersModelesSms', 'users', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Modeles Sms id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $user_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersModelesSms = $this->UsersModelesSmss->get($id);
        if ($this->UsersModelesSmss->delete($usersModelesSms)) {
            $this->Flash->success(__('The users modeles sms has been deleted.'));
        } else {
            $this->Flash->error(__('The users modeles sms could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $user_id]);
    }
}
