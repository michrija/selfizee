<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PageConfigPolices Controller
 *
 * @property \App\Model\Table\PageConfigPolicesTable $PageConfigPolices
 *
 * @method \App\Model\Entity\PageConfigPolice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PageConfigPolicesController extends AppController
{
	
	public function initialize(){
		parent::initialize();
		$this->viewBuilder()->setLayout('sans_menu');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $pageConfigPolices = $this->paginate($this->PageConfigPolices);

        $this->set(compact('pageConfigPolices'));
    }

    /**
     * View method
     *
     * @param string|null $id Page Config Police id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pageConfigPolice = $this->PageConfigPolices->get($id, [
            'contain' => []
        ]);

        $this->set('pageConfigPolice', $pageConfigPolice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pageConfigPolice = $this->PageConfigPolices->newEntity();
        if ($this->request->is('post')) {
            $pageConfigPolice = $this->PageConfigPolices->patchEntity($pageConfigPolice, $this->request->getData());
            if ($this->PageConfigPolices->save($pageConfigPolice)) {
                $this->Flash->success(__('The page config police has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page config police could not be saved. Please, try again.'));
        }
        $this->set(compact('pageConfigPolice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Config Police id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pageConfigPolice = $this->PageConfigPolices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pageConfigPolice = $this->PageConfigPolices->patchEntity($pageConfigPolice, $this->request->getData());
            if ($this->PageConfigPolices->save($pageConfigPolice)) {
                $this->Flash->success(__('The page config police has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page config police could not be saved. Please, try again.'));
        }
        $this->set(compact('pageConfigPolice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Config Police id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageConfigPolice = $this->PageConfigPolices->get($id);
        if ($this->PageConfigPolices->delete($pageConfigPolice)) {
            $this->Flash->success(__('The page config police has been deleted.'));
        } else {
            $this->Flash->error(__('The page config police could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
