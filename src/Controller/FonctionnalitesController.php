<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fonctionnalites Controller
 *
 * @property \App\Model\Table\FonctionnalitesTable $Fonctionnalites
 *
 * @method \App\Model\Entity\Fonctionnalite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FonctionnalitesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $fonctionnalites = $this->paginate($this->Fonctionnalites);

        $this->set(compact('fonctionnalites'));
    }

    /**
     * View method
     *
     * @param string|null $id Fonctionnalite id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fonctionnalite = $this->Fonctionnalites->get($id, [
            'contain' => ['FonctionaliteEvenements']
        ]);

        $this->set('fonctionnalite', $fonctionnalite);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fonctionnalite = $this->Fonctionnalites->newEntity();
        if ($this->request->is('post')) {
            $fonctionnalite = $this->Fonctionnalites->patchEntity($fonctionnalite, $this->request->getData());
            if ($this->Fonctionnalites->save($fonctionnalite)) {
                $this->Flash->success(__('The fonctionnalite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fonctionnalite could not be saved. Please, try again.'));
        }
        $this->set(compact('fonctionnalite'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fonctionnalite id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fonctionnalite = $this->Fonctionnalites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnalite = $this->Fonctionnalites->patchEntity($fonctionnalite, $this->request->getData());
            if ($this->Fonctionnalites->save($fonctionnalite)) {
                $this->Flash->success(__('The fonctionnalite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fonctionnalite could not be saved. Please, try again.'));
        }
        $this->set(compact('fonctionnalite'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fonctionnalite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fonctionnalite = $this->Fonctionnalites->get($id);
        if ($this->Fonctionnalites->delete($fonctionnalite)) {
            $this->Flash->success(__('The fonctionnalite has been deleted.'));
        } else {
            $this->Flash->error(__('The fonctionnalite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
