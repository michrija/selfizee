<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Filtres Controller
 *
 * @property \App\Model\Table\FiltresTable $Filtres
 *
 * @method \App\Model\Entity\Filtre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FiltresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $filtres = $this->paginate($this->Filtres);

        $this->set(compact('filtres'));
    }

    /**
     * View method
     *
     * @param string|null $id Filtre id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $filtre = $this->Filtres->get($id, [
            'contain' => ['FiltreConfigurationBornes']
        ]);

        $this->set('filtre', $filtre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $filtre = $this->Filtres->newEntity();
        if ($this->request->is('post')) {
            $filtre = $this->Filtres->patchEntity($filtre, $this->request->getData());
            if ($this->Filtres->save($filtre)) {
                $this->Flash->success(__('The filtre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The filtre could not be saved. Please, try again.'));
        }
        $this->set(compact('filtre'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Filtre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $filtre = $this->Filtres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $filtre = $this->Filtres->patchEntity($filtre, $this->request->getData());
            if ($this->Filtres->save($filtre)) {
                $this->Flash->success(__('The filtre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The filtre could not be saved. Please, try again.'));
        }
        $this->set(compact('filtre'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Filtre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $filtre = $this->Filtres->get($id);
        if ($this->Filtres->delete($filtre)) {
            $this->Flash->success(__('The filtre has been deleted.'));
        } else {
            $this->Flash->error(__('The filtre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
