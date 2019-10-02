<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SmsEnvois Controller
 *
 * @property \App\Model\Table\SmsEnvoisTable $SmsEnvois
 *
 * @method \App\Model\Entity\SmsEnvois[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SmsEnvoisController extends AppController
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
        $smsEnvois = $this->paginate($this->SmsEnvois);

        $this->set(compact('smsEnvois'));
    }

    /**
     * View method
     *
     * @param string|null $id Sms Envois id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $smsEnvois = $this->SmsEnvois->get($id, [
            'contain' => ['Evenements']
        ]);

        $this->set('smsEnvois', $smsEnvois);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $smsEnvois = $this->SmsEnvois->newEntity();
        if ($this->request->is('post')) {
            $smsEnvois = $this->SmsEnvois->patchEntity($smsEnvois, $this->request->getData());
            if ($this->SmsEnvois->save($smsEnvois)) {
                $this->Flash->success(__('The sms envois has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sms envois could not be saved. Please, try again.'));
        }
        $evenements = $this->SmsEnvois->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('smsEnvois', 'evenements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sms Envois id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $smsEnvois = $this->SmsEnvois->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $smsEnvois = $this->SmsEnvois->patchEntity($smsEnvois, $this->request->getData());
            if ($this->SmsEnvois->save($smsEnvois)) {
                $this->Flash->success(__('The sms envois has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sms envois could not be saved. Please, try again.'));
        }
        $evenements = $this->SmsEnvois->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('smsEnvois', 'evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sms Envois id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $smsEnvois = $this->SmsEnvois->get($id);
        if ($this->SmsEnvois->delete($smsEnvois)) {
            $this->Flash->success(__('The sms envois has been deleted.'));
        } else {
            $this->Flash->error(__('The sms envois could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
