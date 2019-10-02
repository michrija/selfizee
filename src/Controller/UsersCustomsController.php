<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersCustoms Controller
 *
 * @property \App\Model\Table\UsersCustomsTable $UsersCustoms
 *
 * @method \App\Model\Entity\UsersCustom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersCustomsController extends AppController
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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $usersCustoms = $this->paginate($this->UsersCustoms);

        $this->set(compact('usersCustoms'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Custom id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersCustom = $this->UsersCustoms->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersCustom', $usersCustom);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $usersCustom = $this->UsersCustoms->newEntity();
        $custom = $this->UsersCustoms->find('all')->where(['user_id'=>$user_id])->first();
        if($custom){
            $usersCustom = $custom;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;
            /*if(!empty($data['img_banniere_file'])){
                $fileData = $this->request->getData('img_banniere_file');
                if(!empty($fileData['name'])) {
                    $res = $this->uploadImgBanniere($fileData,$usersCustom->id);
                    if($res['success']){
                        $data['gs_img_banniere'] = $res['filename'];
                    }
                }else{
                    $data['gs_img_banniere'] = null;
                }
            }*/
            //debug($usersCustom);die;
            $usersCustom = $this->UsersCustoms->patchEntity($usersCustom, $data);
            if ($this->UsersCustoms->save($usersCustom)) {
                $this->Flash->success(__('The users custom has been saved.'));

                return $this->redirect(['action' => 'add', $user_id]);
            }
            $this->Flash->error(__('The users custom could not be saved. Please, try again.'));
        }
        $users = $this->UsersCustoms->Users->find('list', ['limit' => 200]);
        $user = $this->UsersCustoms->Users->get($user_id);
        $this->set(compact('usersCustom', 'users', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Custom id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $usersCustom = $this->UsersCustoms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersCustom = $this->UsersCustoms->patchEntity($usersCustom, $this->request->getData());
            if ($this->UsersCustoms->save($usersCustom)) {
                $this->Flash->success(__('The users custom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users custom could not be saved. Please, try again.'));
        }
        $users = $this->UsersCustoms->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersCustom', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Custom id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersCustom = $this->UsersCustoms->get($id);
        if ($this->UsersCustoms->delete($usersCustom)) {
            $this->Flash->success(__('The users custom has been deleted.'));
        } else {
            $this->Flash->error(__('The users custom could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
