<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FondVerts Controller
 *
 * @property \App\Model\Table\FondVertsTable $FondVerts
 *
 * @method \App\Model\Entity\FondVert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FondVertsController extends AppController
{
    
    
    public function upload(){
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = true;
        echo json_encode($res);
    }

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
        $fondVerts = $this->paginate($this->FondVerts);

        $this->set(compact('fondVerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Fond Vert id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fondVert = $this->FondVerts->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('fondVert', $fondVert);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fondVert = $this->FondVerts->newEntity();
        if ($this->request->is('post')) {
            $fondVert = $this->FondVerts->patchEntity($fondVert, $this->request->getData());
            if ($this->FondVerts->save($fondVert)) {
                $this->Flash->success(__('The fond vert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fond vert could not be saved. Please, try again.'));
        }
        $configurationBornes = $this->FondVerts->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('fondVert', 'configurationBornes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fond Vert id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fondVert = $this->FondVerts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fondVert = $this->FondVerts->patchEntity($fondVert, $this->request->getData());
            if ($this->FondVerts->save($fondVert)) {
                $this->Flash->success(__('The fond vert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fond vert could not be saved. Please, try again.'));
        }
        $configurationBornes = $this->FondVerts->ConfigurationBornes->find('list', ['limit' => 200]);
        $this->set(compact('fondVert', 'configurationBornes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fond Vert id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fondVert = $this->FondVerts->get($id);
        if ($this->FondVerts->delete($fondVert)) {
            $this->Flash->success(__('The fond vert has been deleted.'));
        } else {
            $this->Flash->error(__('The fond vert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
