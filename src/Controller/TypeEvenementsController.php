<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeEvenements Controller
 *
 * @property \App\Model\Table\TypeEvenementsTable $TypeEvenements
 *
 * @method \App\Model\Entity\TypeEvenement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeEvenementsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $query = $this->TypeEvenements->find('all');
        if(!empty($this->Auth->user('client_id'))){
           $query = $query->where(['client_id' => $this->Auth->user("client_id")]);
        }           
        $typeEvenements = $this->paginate($query);

        $this->set(compact('typeEvenements'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Evenement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeEvenement = $this->TypeEvenements->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('typeEvenement', $typeEvenement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $typeEvenement = $this->TypeEvenements->newEntity();
        if ($this->request->is('post')) {
            $typeEvenement = $this->TypeEvenements->patchEntity($typeEvenement, $this->request->getData());
            if ($this->TypeEvenements->save($typeEvenement)) {
                $this->Flash->success(__('Catégorie d\'événement enregistrée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer plus tard.'));
        }
        $clients = $this->TypeEvenements->Clients->find('list', ['limit' => 200]);
        $this->set(compact('typeEvenement', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Evenement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $typeEvenement = $this->TypeEvenements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeEvenement = $this->TypeEvenements->patchEntity($typeEvenement, $this->request->getData());
            if ($this->TypeEvenements->save($typeEvenement)) {
                $this->Flash->success(__('Catégorie d\'événement enregistrée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer plus tard.'));
        }
        $clients = $this->TypeEvenements->Clients->find('list', ['limit' => 200]);
        $this->set(compact('typeEvenement', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Evenement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeEvenement = $this->TypeEvenements->get($id);
        if ($this->TypeEvenements->delete($typeEvenement)) {
            $this->Flash->success(__('The type evenement has been deleted.'));
        } else {
            $this->Flash->error(__('The type evenement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
