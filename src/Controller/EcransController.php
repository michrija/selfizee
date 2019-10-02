<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ecrans Controller
 *
 * @property \App\Model\Table\EcransTable $Ecrans
 *
 * @method \App\Model\Entity\Ecran[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EcransController extends AppController
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
        $ecrans = $this->paginate($this->Ecrans);

        $this->set(compact('ecrans'));
    }

    /**
     * View method
     *
     * @param string|null $id Ecran id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ecran = $this->Ecrans->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('ecran', $ecran);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ecran = $this->Ecrans->newEntity();
        if ($this->request->is('post')) {
            $ecran = $this->Ecrans->patchEntity($ecran, $this->request->getData());
            if ($this->Ecrans->save($ecran)) {
                $this->Flash->success(__('The ecran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ecran could not be saved. Please, try again.'));
        }
        $configurationBornes = $this->Ecrans->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('ecran', 'configurationBornes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ecran id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ecran = $this->Ecrans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ecran = $this->Ecrans->patchEntity($ecran, $this->request->getData());
            if ($this->Ecrans->save($ecran)) {
                $this->Flash->success(__('The ecran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ecran could not be saved. Please, try again.'));
        }
        $configurationBornes = $this->Ecrans->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('ecran', 'configurationBornes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ecran id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ecran = $this->Ecrans->get($id);
        if ($this->Ecrans->delete($ecran)) {
            $this->Flash->success(__('The ecran has been deleted.'));
        } else {
            $this->Flash->error(__('The ecran could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
