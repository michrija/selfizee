<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PageConfigFonds Controller
 *
 * @property \App\Model\Table\PageConfigFondsTable $PageConfigFonds
 *
 * @method \App\Model\Entity\PageConfigFond[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PageConfigFondsController extends AppController
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
        $pageConfigFonds = $this->paginate($this->PageConfigFonds);
		
        $this->set(compact('pageConfigFonds', 'isGlobal'));
    }

    /**
     * View method
     *
     * @param string|null $id Page Config Fond id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pageConfigFond = $this->PageConfigFonds->get($id, [
            'contain' => []
        ]);

        $this->set('pageConfigFond', $pageConfigFond);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pageConfigFond = $this->PageConfigFonds->newEntity();
        if ($this->request->is('post')) {
            $pageConfigFond = $this->PageConfigFonds->patchEntity($pageConfigFond, $this->request->getData());
            if ($this->PageConfigFonds->save($pageConfigFond)) {
                $this->Flash->success(__('The page config fond has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page config fond could not be saved. Please, try again.'));
        }
        $this->set(compact('pageConfigFond'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Config Fond id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pageConfigFond = $this->PageConfigFonds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pageConfigFond = $this->PageConfigFonds->patchEntity($pageConfigFond, $this->request->getData());
            if ($this->PageConfigFonds->save($pageConfigFond)) {
                $this->Flash->success(__('The page config fond has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page config fond could not be saved. Please, try again.'));
        }
        $this->set(compact('pageConfigFond'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Config Fond id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageConfigFond = $this->PageConfigFonds->get($id);
        if ($this->PageConfigFonds->delete($pageConfigFond)) {
            $this->Flash->success(__('The page config fond has been deleted.'));
        } else {
            $this->Flash->error(__('The page config fond could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
