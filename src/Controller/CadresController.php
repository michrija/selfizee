<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cadres Controller
 *
 * @property \App\Model\Table\CadresTable $Cadres
 *
 * @method \App\Model\Entity\Cadre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CadresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ConfigurationBornes']
        ];
        $cadres = $this->paginate($this->Cadres);

        $this->set(compact('cadres'));
    }

    /**
     * View method
     *
     * @param string|null $id Cadre id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cadre = $this->Cadres->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('cadre', $cadre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cadre = $this->Cadres->newEntity();
        if ($this->request->is('post')) {
            $cadre = $this->Cadres->patchEntity($cadre, $this->request->getData());
            if ($this->Cadres->save($cadre)) {
                $this->Flash->success(__('The cadre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cadre could not be saved. Please, try again.'));
        }
        $configurationBornes = $this->Cadres->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('cadre', 'configurationBornes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cadre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cadre = $this->Cadres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cadre = $this->Cadres->patchEntity($cadre, $this->request->getData());
            if ($this->Cadres->save($cadre)) {
                $this->Flash->success(__('The cadre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cadre could not be saved. Please, try again.'));
        }
        $configurationBornes = $this->Cadres->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('cadre', 'configurationBornes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cadre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cadre = $this->Cadres->get($id);
        if ($this->Cadres->delete($cadre)) {
            $this->Flash->success(__('The cadre has been deleted.'));
        } else {
            $this->Flash->error(__('The cadre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
