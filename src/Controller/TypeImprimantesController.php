<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeImprimantes Controller
 *
 * @property \App\Model\Table\TypeImprimantesTable $TypeImprimantes
 *
 * @method \App\Model\Entity\TypeImprimante[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeImprimantesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $typeImprimantes = $this->paginate($this->TypeImprimantes);

        $this->set(compact('typeImprimantes'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Imprimante id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeImprimante = $this->TypeImprimantes->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('typeImprimante', $typeImprimante);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeImprimante = $this->TypeImprimantes->newEntity();
        if ($this->request->is('post')) {
            $typeImprimante = $this->TypeImprimantes->patchEntity($typeImprimante, $this->request->getData());
            if ($this->TypeImprimantes->save($typeImprimante)) {
                $this->Flash->success(__('The type imprimante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type imprimante could not be saved. Please, try again.'));
        }
        $this->set(compact('typeImprimante'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Imprimante id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeImprimante = $this->TypeImprimantes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeImprimante = $this->TypeImprimantes->patchEntity($typeImprimante, $this->request->getData());
            if ($this->TypeImprimantes->save($typeImprimante)) {
                $this->Flash->success(__('The type imprimante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type imprimante could not be saved. Please, try again.'));
        }
        $this->set(compact('typeImprimante'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Imprimante id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeImprimante = $this->TypeImprimantes->get($id);
        if ($this->TypeImprimantes->delete($typeImprimante)) {
            $this->Flash->success(__('The type imprimante has been deleted.'));
        } else {
            $this->Flash->error(__('The type imprimante could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
