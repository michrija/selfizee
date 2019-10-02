<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ConfigurationAnimations Controller
 *
 * @property \App\Model\Table\ConfigurationAnimationsTable $ConfigurationAnimations
 *
 * @method \App\Model\Entity\ConfigurationAnimation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigurationAnimationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DispositionVignettes', 'ConfigurationBornes']
        ];
        $configurationAnimations = $this->paginate($this->ConfigurationAnimations);

        $this->set(compact('configurationAnimations'));
    }

    /**
     * View method
     *
     * @param string|null $id Configuration Animation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configurationAnimation = $this->ConfigurationAnimations->get($id, [
            'contain' => ['DispositionVignettes', 'ConfigurationBornes']
        ]);

        $this->set('configurationAnimation', $configurationAnimation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configurationAnimation = $this->ConfigurationAnimations->newEntity();
        if ($this->request->is('post')) {
            $configurationAnimation = $this->ConfigurationAnimations->patchEntity($configurationAnimation, $this->request->getData());
            if ($this->ConfigurationAnimations->save($configurationAnimation)) {
                $this->Flash->success(__('The configuration animation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The configuration animation could not be saved. Please, try again.'));
        }
        $dispositionVignettes = $this->ConfigurationAnimations->DispositionVignettes->find('list', ['limit' => 200]);
        $configurationBornes = $this->ConfigurationAnimations->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('configurationAnimation', 'dispositionVignettes', 'configurationBornes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuration Animation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configurationAnimation = $this->ConfigurationAnimations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configurationAnimation = $this->ConfigurationAnimations->patchEntity($configurationAnimation, $this->request->getData());
            if ($this->ConfigurationAnimations->save($configurationAnimation)) {
                $this->Flash->success(__('The configuration animation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The configuration animation could not be saved. Please, try again.'));
        }
        $dispositionVignettes = $this->ConfigurationAnimations->DispositionVignettes->find('list', ['limit' => 200]);
        $configurationBornes = $this->ConfigurationAnimations->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('configurationAnimation', 'dispositionVignettes', 'configurationBornes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuration Animation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configurationAnimation = $this->ConfigurationAnimations->get($id);
        if ($this->ConfigurationAnimations->delete($configurationAnimation)) {
            $this->Flash->success(__('The configuration animation has been deleted.'));
        } else {
            $this->Flash->error(__('The configuration animation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
