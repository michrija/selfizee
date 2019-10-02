<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ModelBornes Controller
 *
 * @property \App\Model\Table\ModelBornesTable $ModelBornes
 *
 * @method \App\Model\Entity\ModelBorne[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModelBornesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $modelBornes = $this->paginate($this->ModelBornes);

        $this->set(compact('modelBornes'));
    }

    /**
     * View method
     *
     * @param string|null $id Model Borne id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modelBorne = $this->ModelBornes->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('modelBorne', $modelBorne);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modelBorne = $this->ModelBornes->newEntity();
        if ($this->request->is('post')) {
            $modelBorne = $this->ModelBornes->patchEntity($modelBorne, $this->request->getData());
            if ($this->ModelBornes->save($modelBorne)) {
                $this->Flash->success(__('The model borne has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The model borne could not be saved. Please, try again.'));
        }
        $this->set(compact('modelBorne'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Model Borne id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modelBorne = $this->ModelBornes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modelBorne = $this->ModelBornes->patchEntity($modelBorne, $this->request->getData());
            if ($this->ModelBornes->save($modelBorne)) {
                $this->Flash->success(__('The model borne has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The model borne could not be saved. Please, try again.'));
        }
        $this->set(compact('modelBorne'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Model Borne id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modelBorne = $this->ModelBornes->get($id);
        if ($this->ModelBornes->delete($modelBorne)) {
            $this->Flash->success(__('The model borne has been deleted.'));
        } else {
            $this->Flash->error(__('The model borne could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
