<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Champs Controller
 *
 * @property \App\Model\Table\ChampsTable $Champs
 *
 * @method \App\Model\Entity\Champ[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChampsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TypeChamps', 'TypeDonnees', 'ConfigurationBornes']
        ];
        $champs = $this->paginate($this->Champs);

        $this->set(compact('champs'));
    }

    /**
     * View method
     *
     * @param string|null $id Champ id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $champ = $this->Champs->get($id, [
            'contain' => ['TypeChamps', 'TypeDonnees', 'ConfigurationBornes']
        ]);

        $this->set('champ', $champ);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $champ = $this->Champs->newEntity();
        if ($this->request->is('post')) {
            debug($this->request->getData()); die;
            $champ = $this->Champs->patchEntity($champ, $this->request->getData());
            if ($this->Champs->save($champ)) {
                $this->Flash->success(__('The champ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The champ could not be saved. Please, try again.'));
        }
        $typeChamps = $this->Champs->TypeChamps->find('list', ['limit' => 200]);
        $typeDonnees = $this->Champs->TypeDonnees->find('list', ['limit' => 200]);
        $configurationBornes = $this->Champs->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('champ', 'typeChamps', 'typeDonnees', 'configurationBornes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Champ id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $champ = $this->Champs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $champ = $this->Champs->patchEntity($champ, $this->request->getData());
            if ($this->Champs->save($champ)) {
                $this->Flash->success(__('The champ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The champ could not be saved. Please, try again.'));
        }
        $typeChamps = $this->Champs->TypeChamps->find('list', ['limit' => 200]);
        $typeDonnees = $this->Champs->TypeDonnees->find('list', ['limit' => 200]);
        $configurationBornes = $this->Champs->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('champ', 'typeChamps', 'typeDonnees', 'configurationBornes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Champ id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $champ = $this->Champs->get($id);
        if ($this->Champs->delete($champ)) {
            $this->Flash->success(__('The champ has been deleted.'));
        } else {
            $this->Flash->error(__('The champ could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
