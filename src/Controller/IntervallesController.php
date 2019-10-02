<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Intervalles Controller
 *
 * @property \App\Model\Table\IntervallesTable $Intervalles
 *
 * @method \App\Model\Entity\Intervalle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IntervallesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $intervalles = $this->paginate($this->Intervalles);

        $this->set(compact('intervalles'));
    }

    /**
     * View method
     *
     * @param string|null $id Intervalle id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $intervalle = $this->Intervalles->get($id, [
            'contain' => ['Crons']
        ]);

        $this->set('intervalle', $intervalle);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $intervalle = $this->Intervalles->newEntity();
        if ($this->request->is('post')) {
            $intervalle = $this->Intervalles->patchEntity($intervalle, $this->request->getData());
            if ($this->Intervalles->save($intervalle)) {
                $this->Flash->success(__('The intervalle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The intervalle could not be saved. Please, try again.'));
        }
        $this->set(compact('intervalle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Intervalle id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $intervalle = $this->Intervalles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $intervalle = $this->Intervalles->patchEntity($intervalle, $this->request->getData());
            if ($this->Intervalles->save($intervalle)) {
                $this->Flash->success(__('The intervalle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The intervalle could not be saved. Please, try again.'));
        }
        $this->set(compact('intervalle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Intervalle id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $intervalle = $this->Intervalles->get($id);
        if ($this->Intervalles->delete($intervalle)) {
            $this->Flash->success(__('The intervalle has been deleted.'));
        } else {
            $this->Flash->error(__('The intervalle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
