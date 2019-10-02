<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Expediteurs Controller
 *
 * @property \App\Model\Table\ExpediteursTable $Expediteurs
 *
 * @method \App\Model\Entity\Expediteur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExpediteursController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $query = $this->Expediteurs->find('all');
        if(!empty($this->Auth->user('client_id'))){
           $query = $query->where(['client_id' => $this->Auth->user("client_id")]);
        }      
        $expediteurs = $this->paginate($query);

        $this->set(compact('expediteurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Expediteur id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expediteur = $this->Expediteurs->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('expediteur', $expediteur);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $expediteur = $this->Expediteurs->newEntity();
        if ($this->request->is('post')) {
            $expediteur = $this->Expediteurs->patchEntity($expediteur, $this->request->getData());
            if ($this->Expediteurs->save($expediteur)) {
                $this->Flash->success(__('Expediteur e-mail enregisté'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer plus tard.'));
        }
        $clients = $this->Expediteurs->Clients->find('list', ['limit' => 200]);
        $this->set(compact('expediteur', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expediteur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $expediteur = $this->Expediteurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expediteur = $this->Expediteurs->patchEntity($expediteur, $this->request->getData());
            if ($this->Expediteurs->save($expediteur)) {
                $this->Flash->success(__('Expediteur e-mail enregisté'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer plus tard.'));
        }
        $clients = $this->Expediteurs->Clients->find('list', ['limit' => 200]);
        $this->set(compact('expediteur', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expediteur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expediteur = $this->Expediteurs->get($id);
        if ($this->Expediteurs->delete($expediteur)) {
            $this->Flash->success(__('Expediteur e-mail enregisté.'));
        } else {
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
