<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Envois Controller
 *
 * @property \App\Model\Table\EnvoisTable $Envois
 *
 * @method \App\Model\Entity\Envois[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnvoisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Contacts']
        ];
        $envois = $this->paginate($this->Envois);

        $this->set(compact('envois'));
    }

    /**
     * View method
     *
     * @param string|null $id Envois id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $envois = $this->Envois->get($id, [
            'contain' => ['Contacts']
        ]);

        $this->set('envois', $envois);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $envois = $this->Envois->newEntity();
        if ($this->request->is('post')) {
            $envois = $this->Envois->patchEntity($envois, $this->request->getData());
            if ($this->Envois->save($envois)) {
                $this->Flash->success(__('The envois has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The envois could not be saved. Please, try again.'));
        }
        $contacts = $this->Envois->Contacts->find('list', ['limit' => 200]);
        $this->set(compact('envois', 'contacts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Envois id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $envois = $this->Envois->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $envois = $this->Envois->patchEntity($envois, $this->request->getData());
            if ($this->Envois->save($envois)) {
                $this->Flash->success(__('The envois has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The envois could not be saved. Please, try again.'));
        }
        $contacts = $this->Envois->Contacts->find('list', ['limit' => 200]);
        $this->set(compact('envois', 'contacts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Envois id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $envois = $this->Envois->get($id);
        if ($this->Envois->delete($envois)) {
            $this->Flash->success(__('The envois has been deleted.'));
        } else {
            $this->Flash->error(__('The envois could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
