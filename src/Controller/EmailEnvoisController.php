<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EmailEnvois Controller
 *
 * @property \App\Model\Table\EmailEnvoisTable $EmailEnvois
 *
 * @method \App\Model\Entity\EmailEnvois[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailEnvoisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Evenements']
        ];
        $emailEnvois = $this->paginate($this->EmailEnvois);

        $this->set(compact('emailEnvois'));
    }

    /**
     * View method
     *
     * @param string|null $id Email Envois id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailEnvois = $this->EmailEnvois->get($id, [
            'contain' => ['Evenements']
        ]);

        $this->set('emailEnvois', $emailEnvois);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailEnvois = $this->EmailEnvois->newEntity();
        if ($this->request->is('post')) {
            $emailEnvois = $this->EmailEnvois->patchEntity($emailEnvois, $this->request->getData());
            if ($this->EmailEnvois->save($emailEnvois)) {
                $this->Flash->success(__('The email envois has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email envois could not be saved. Please, try again.'));
        }
        $evenements = $this->EmailEnvois->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('emailEnvois', 'evenements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Envois id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailEnvois = $this->EmailEnvois->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailEnvois = $this->EmailEnvois->patchEntity($emailEnvois, $this->request->getData());
            if ($this->EmailEnvois->save($emailEnvois)) {
                $this->Flash->success(__('The email envois has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email envois could not be saved. Please, try again.'));
        }
        $evenements = $this->EmailEnvois->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('emailEnvois', 'evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Envois id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailEnvois = $this->EmailEnvois->get($id);
        if ($this->EmailEnvois->delete($emailEnvois)) {
            $this->Flash->success(__('The email envois has been deleted.'));
        } else {
            $this->Flash->error(__('The email envois could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
