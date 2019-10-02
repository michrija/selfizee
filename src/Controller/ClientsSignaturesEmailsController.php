<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClientsSignaturesEmails Controller
 *
 * @property \App\Model\Table\ClientsSignaturesEmailsTable $ClientsSignaturesEmails
 *
 * @method \App\Model\Entity\ClientsSignaturesEmail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsSignaturesEmailsController extends AppController
{

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
        $clientsSignaturesEmails = $this->paginate($this->ClientsSignaturesEmails);

        $this->set(compact('clientsSignaturesEmails'));
    }

    /**
     * View method
     *
     * @param string|null $id Clients Signatures Email id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsSignaturesEmail = $this->ClientsSignaturesEmails->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('clientsSignaturesEmail', $clientsSignaturesEmail);
    }


    public function add($client_id = null)
    {
        $clientsSignaturesEmail = $this->ClientsSignaturesEmails->newEntity();
        $this->viewBuilder()->setLayout('page_config_user');
        $custom = $this->ClientsSignaturesEmails->find('all')->where(['client_id'=>$client_id])->first();
        //debug($custom);die;
        if($custom){
            $clientsSignaturesEmail = $custom;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['client_id'] = $client_id;

            $clientsSignaturesEmail = $this->ClientsSignaturesEmails->patchEntity($clientsSignaturesEmail, $data);
            if ($this->ClientsSignaturesEmails->save($clientsSignaturesEmail)) {
                $this->Flash->success(__('The clients custom has been saved.'));

                return $this->redirect(['action' => 'add', $client_id]);
            } else {
                //debug($clientsCustom);die;
            }
            $this->Flash->error(__('The clients custom could not be saved. Please, try again.'));
        }

        $client = $this->ClientsSignaturesEmails->Clients->get($client_id);
        $this->set(compact('clientsSignaturesEmail', 'clients', 'client'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add0()
    {
        $clientsSignaturesEmail = $this->ClientsSignaturesEmails->newEntity();
        if ($this->request->is('post')) {
            $clientsSignaturesEmail = $this->ClientsSignaturesEmails->patchEntity($clientsSignaturesEmail, $this->request->getData());
            if ($this->ClientsSignaturesEmails->save($clientsSignaturesEmail)) {
                $this->Flash->success(__('The clients signatures email has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients signatures email could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsSignaturesEmails->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientsSignaturesEmail', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clients Signatures Email id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientsSignaturesEmail = $this->ClientsSignaturesEmails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsSignaturesEmail = $this->ClientsSignaturesEmails->patchEntity($clientsSignaturesEmail, $this->request->getData());
            if ($this->ClientsSignaturesEmails->save($clientsSignaturesEmail)) {
                $this->Flash->success(__('The clients signatures email has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients signatures email could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsSignaturesEmails->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientsSignaturesEmail', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clients Signatures Email id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsSignaturesEmail = $this->ClientsSignaturesEmails->get($id);
        if ($this->ClientsSignaturesEmails->delete($clientsSignaturesEmail)) {
            $this->Flash->success(__('The clients signatures email has been deleted.'));
        } else {
            $this->Flash->error(__('The clients signatures email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
