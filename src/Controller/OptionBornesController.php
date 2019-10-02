<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OptionBornes Controller
 *
 * @property \App\Model\Table\OptionBornesTable $OptionBornes
 *
 * @method \App\Model\Entity\OptionBorne[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionBornesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $optionBornes = $this->paginate($this->OptionBornes);

        $this->set(compact('optionBornes'));
    }

    /**
     * View method
     *
     * @param string|null $id Option Borne id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $optionBorne = $this->OptionBornes->get($id, [
            'contain' => []
        ]);

        $this->set('optionBorne', $optionBorne);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add( $id= null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        //$this->loadModel('Evenements');
        //$evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $optionBorne = $this->OptionBornes->newEntity();
        $optionBorneFind = $this->OptionBornes->find()
                                            ->last();
        if(!empty($optionBorneFind)){
            $optionBorne = $optionBorneFind;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $optionBorne = $this->OptionBornes->patchEntity($optionBorne, $this->request->getData());
            if ($this->OptionBornes->save($optionBorne)) {
                $this->Flash->success(__('The option borne has been saved.'));

                return $this->redirect(['action' => 'add', $optionBorne->id]);
            }
            $this->Flash->error(__('The option borne could not be saved. Please, try again.'));
        }
        $this->set(compact('optionBorne'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Option Borne id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $optionBorne = $this->OptionBornes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $optionBorne = $this->OptionBornes->patchEntity($optionBorne, $this->request->getData());
            if ($this->OptionBornes->save($optionBorne)) {
                $this->Flash->success(__('The option borne has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The option borne could not be saved. Please, try again.'));
        }
        $this->set(compact('optionBorne'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Option Borne id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $optionBorne = $this->OptionBornes->get($id);
        if ($this->OptionBornes->delete($optionBorne)) {
            $this->Flash->success(__('The option borne has been deleted.'));
        } else {
            $this->Flash->error(__('The option borne could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
