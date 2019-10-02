<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactEvenements Controller
 *
 * @property \App\Model\Table\ContactEvenementsTable $ContactEvenements
 *
 * @method \App\Model\Entity\ContactEvenement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactEvenementsController extends AppController
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
        $contactEvenements = $this->paginate($this->ContactEvenements);

        $this->set(compact('contactEvenements'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Evenement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactEvenement = $this->ContactEvenements->get($id, [
            'contain' => ['Evenements']
        ]);

        $this->set('contactEvenement', $contactEvenement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactEvenement = $this->ContactEvenements->newEntity();
        if ($this->request->is('post')) {
            $contactEvenement = $this->ContactEvenements->patchEntity($contactEvenement, $this->request->getData());
            if ($this->ContactEvenements->save($contactEvenement)) {
                $this->Flash->success(__('The contact evenement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact evenement could not be saved. Please, try again.'));
        }
        $evenements = $this->ContactEvenements->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('contactEvenement', 'evenements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Evenement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactEvenement = $this->ContactEvenements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactEvenement = $this->ContactEvenements->patchEntity($contactEvenement, $this->request->getData());
            if ($this->ContactEvenements->save($contactEvenement)) {
                $this->Flash->success(__('The contact evenement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact evenement could not be saved. Please, try again.'));
        }
        $evenements = $this->ContactEvenements->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('contactEvenement', 'evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Evenement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactEvenement = $this->ContactEvenements->get($id);
        if ($this->ContactEvenements->delete($contactEvenement)) {
            $this->Flash->success(__('The contact evenement has been deleted.'));
        } else {
            $this->Flash->error(__('The contact evenement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
