<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EditeurTemplates Controller
 *
 * @property \App\Model\Table\EditeurTemplatesTable $EditeurTemplates
 *
 * @method \App\Model\Entity\EditeurTemplate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EditeurTemplatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $editeurTemplates = $this->paginate($this->EditeurTemplates);

        $this->set(compact('editeurTemplates'));
    }

    /**
     * View method
     *
     * @param string|null $id Editeur Template id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $editeurTemplate = $this->EditeurTemplates->get($id, [
            'contain' => []
        ]);

        $this->set('editeurTemplate', $editeurTemplate);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	$this->viewBuilder()->setLayout('sans_menu');
    	$this->loadModel('EditeurTemplates');
    	$typeTemplate = $this->EditeurTemplates->find('list',['keyField' => 'id', 'valueField' => 'type_editeur_template']);
        $editeurTemplate = $this->EditeurTemplates->newEntity();
        if ($this->request->is('post')) {
            $editeurTemplate = $this->EditeurTemplates->patchEntity($editeurTemplate, $this->request->getData());
            if ($this->EditeurTemplates->save($editeurTemplate)) {
                $this->Flash->success(__('The editeur template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The editeur template could not be saved. Please, try again.'));
        }
        $this->set(compact('editeurTemplate','typeTemplate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Editeur Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $editeurTemplate = $this->EditeurTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $editeurTemplate = $this->EditeurTemplates->patchEntity($editeurTemplate, $this->request->getData());
            if ($this->EditeurTemplates->save($editeurTemplate)) {
                $this->Flash->success(__('The editeur template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The editeur template could not be saved. Please, try again.'));
        }
        $this->set(compact('editeurTemplate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Editeur Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $editeurTemplate = $this->EditeurTemplates->get($id);
        if ($this->EditeurTemplates->delete($editeurTemplate)) {
            $this->Flash->success(__("La photo a été supprimée"));
        } else {
            $this->Flash->error(__("La photo n'a pa pu être supprimée"));
        }

        return $this->redirect(['action' => 'index']);
    }
}
