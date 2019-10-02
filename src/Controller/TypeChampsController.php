<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeChamps Controller
 *
 * @property \App\Model\Table\TypeChampsTable $TypeChamps
 *
 * @method \App\Model\Entity\TypeChamp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeChampsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $typeChamps = $this->paginate($this->TypeChamps);

        $this->set(compact('typeChamps'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Champ id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeChamp = $this->TypeChamps->get($id, [
            'contain' => ['Champs']
        ]);

        $this->set('typeChamp', $typeChamp);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeChamp = $this->TypeChamps->newEntity();
        if ($this->request->is('post')) {
            $typeChamp = $this->TypeChamps->patchEntity($typeChamp, $this->request->getData());
            if ($this->TypeChamps->save($typeChamp)) {
                $this->Flash->success(__('The type champ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type champ could not be saved. Please, try again.'));
        }
        $this->set(compact('typeChamp'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Champ id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeChamp = $this->TypeChamps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeChamp = $this->TypeChamps->patchEntity($typeChamp, $this->request->getData());
            if ($this->TypeChamps->save($typeChamp)) {
                $this->Flash->success(__('The type champ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type champ could not be saved. Please, try again.'));
        }
        $this->set(compact('typeChamp'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Champ id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeChamp = $this->TypeChamps->get($id);
        if ($this->TypeChamps->delete($typeChamp)) {
            $this->Flash->success(__('The type champ has been deleted.'));
        } else {
            $this->Flash->error(__('The type champ could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
