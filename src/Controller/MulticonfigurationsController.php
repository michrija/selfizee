<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Multiconfigurations Controller
 *
 * @property \App\Model\Table\MulticonfigurationsTable $Multiconfigurations
 *
 * @method \App\Model\Entity\Multiconfiguration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MulticonfigurationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $multiconfigurations = $this->paginate($this->Multiconfigurations);

        $this->set(compact('multiconfigurations'));
    }

    /**
     * View method
     *
     * @param string|null $id Multiconfiguration id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $multiconfiguration = $this->Multiconfigurations->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('multiconfiguration', $multiconfiguration);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $multiconfiguration = $this->Multiconfigurations->newEntity();
        if ($this->request->is('post')) {
            $multiconfiguration = $this->Multiconfigurations->patchEntity($multiconfiguration, $this->request->getData());
            if ($this->Multiconfigurations->save($multiconfiguration)) {
                $this->Flash->success(__('The multiconfiguration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multiconfiguration could not be saved. Please, try again.'));
        }
        $this->set(compact('multiconfiguration'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Multiconfiguration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $multiconfiguration = $this->Multiconfigurations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $multiconfiguration = $this->Multiconfigurations->patchEntity($multiconfiguration, $this->request->getData());
            if ($this->Multiconfigurations->save($multiconfiguration)) {
                $this->Flash->success(__('The multiconfiguration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multiconfiguration could not be saved. Please, try again.'));
        }
        $this->set(compact('multiconfiguration'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Multiconfiguration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $multiconfiguration = $this->Multiconfigurations->get($id);
        if ($this->Multiconfigurations->delete($multiconfiguration)) {
            $this->Flash->success(__('The multiconfiguration has been deleted.'));
        } else {
            $this->Flash->error(__('The multiconfiguration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
