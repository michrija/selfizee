<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FacebookAutoSuivis Controller
 *
 * @property \App\Model\Table\FacebookAutoSuivisTable $FacebookAutoSuivis
 *
 * @method \App\Model\Entity\FacebookAutoSuivi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacebookAutoSuivisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FacebookAutos', 'Photos']
        ];
        $facebookAutoSuivis = $this->paginate($this->FacebookAutoSuivis);

        $this->set(compact('facebookAutoSuivis'));
    }

    /**
     * View method
     *
     * @param string|null $id Facebook Auto Suivi id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facebookAutoSuivi = $this->FacebookAutoSuivis->get($id, [
            'contain' => ['FacebookAutos', 'Photos']
        ]);

        $this->set('facebookAutoSuivi', $facebookAutoSuivi);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facebookAutoSuivi = $this->FacebookAutoSuivis->newEntity();
        if ($this->request->is('post')) {
            $facebookAutoSuivi = $this->FacebookAutoSuivis->patchEntity($facebookAutoSuivi, $this->request->getData());
            if ($this->FacebookAutoSuivis->save($facebookAutoSuivi)) {
                $this->Flash->success(__('The facebook auto suivi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facebook auto suivi could not be saved. Please, try again.'));
        }
        $facebookAutos = $this->FacebookAutoSuivis->FacebookAutos->find('list', ['limit' => 200]);
        $photos = $this->FacebookAutoSuivis->Photos->find('list', ['limit' => 200]);
        $this->set(compact('facebookAutoSuivi', 'facebookAutos', 'photos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Facebook Auto Suivi id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facebookAutoSuivi = $this->FacebookAutoSuivis->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facebookAutoSuivi = $this->FacebookAutoSuivis->patchEntity($facebookAutoSuivi, $this->request->getData());
            if ($this->FacebookAutoSuivis->save($facebookAutoSuivi)) {
                $this->Flash->success(__('The facebook auto suivi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facebook auto suivi could not be saved. Please, try again.'));
        }
        $facebookAutos = $this->FacebookAutoSuivis->FacebookAutos->find('list', ['limit' => 200]);
        $photos = $this->FacebookAutoSuivis->Photos->find('list', ['limit' => 200]);
        $this->set(compact('facebookAutoSuivi', 'facebookAutos', 'photos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Facebook Auto Suivi id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facebookAutoSuivi = $this->FacebookAutoSuivis->get($id);
        if ($this->FacebookAutoSuivis->delete($facebookAutoSuivi)) {
            $this->Flash->success(__('The facebook auto suivi has been deleted.'));
        } else {
            $this->Flash->error(__('The facebook auto suivi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
