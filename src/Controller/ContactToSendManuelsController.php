<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactToSendManuels Controller
 *
 * @property \App\Model\Table\ContactToSendManuelsTable $ContactToSendManuels
 *
 * @method \App\Model\Entity\ContactToSendManuel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactToSendManuelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Contacts', 'EnvoiManuels']
        ];
        $contactToSendManuels = $this->paginate($this->ContactToSendManuels);

        $this->set(compact('contactToSendManuels'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact To Send Manuel id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactToSendManuel = $this->ContactToSendManuels->get($id, [
            'contain' => ['Contacts', 'EnvoiManuels']
        ]);

        $this->set('contactToSendManuel', $contactToSendManuel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactToSendManuel = $this->ContactToSendManuels->newEntity();
        if ($this->request->is('post')) {
            $contactToSendManuel = $this->ContactToSendManuels->patchEntity($contactToSendManuel, $this->request->getData());
            if ($this->ContactToSendManuels->save($contactToSendManuel)) {
                $this->Flash->success(__('The contact to send manuel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact to send manuel could not be saved. Please, try again.'));
        }
        $contacts = $this->ContactToSendManuels->Contacts->find('list', ['limit' => 200]);
        $envoiManuels = $this->ContactToSendManuels->EnvoiManuels->find('list', ['limit' => 200]);
        $this->set(compact('contactToSendManuel', 'contacts', 'envoiManuels'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact To Send Manuel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactToSendManuel = $this->ContactToSendManuels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactToSendManuel = $this->ContactToSendManuels->patchEntity($contactToSendManuel, $this->request->getData());
            if ($this->ContactToSendManuels->save($contactToSendManuel)) {
                $this->Flash->success(__('The contact to send manuel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact to send manuel could not be saved. Please, try again.'));
        }
        $contacts = $this->ContactToSendManuels->Contacts->find('list', ['limit' => 200]);
        $envoiManuels = $this->ContactToSendManuels->EnvoiManuels->find('list', ['limit' => 200]);
        $this->set(compact('contactToSendManuel', 'contacts', 'envoiManuels'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact To Send Manuel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactToSendManuel = $this->ContactToSendManuels->get($id);
        if ($this->ContactToSendManuels->delete($contactToSendManuel)) {
            $this->Flash->success(__('The contact to send manuel has been deleted.'));
        } else {
            $this->Flash->error(__('The contact to send manuel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
