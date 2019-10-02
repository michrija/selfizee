<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DispositionVignettes Controller
 *
 * @property \App\Model\Table\DispositionVignettesTable $DispositionVignettes
 *
 * @method \App\Model\Entity\DispositionVignette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DispositionVignettesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dispositionVignettes = $this->paginate($this->DispositionVignettes);

        $this->set(compact('dispositionVignettes'));
    }

    /**
     * View method
     *
     * @param string|null $id Disposition Vignette id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dispositionVignette = $this->DispositionVignettes->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('dispositionVignette', $dispositionVignette);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dispositionVignette = $this->DispositionVignettes->newEntity();
        if ($this->request->is('post')) {
            $dispositionVignette = $this->DispositionVignettes->patchEntity($dispositionVignette, $this->request->getData());
            if ($this->DispositionVignettes->save($dispositionVignette)) {
                $this->Flash->success(__('The disposition vignette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The disposition vignette could not be saved. Please, try again.'));
        }
        $this->set(compact('dispositionVignette'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Disposition Vignette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dispositionVignette = $this->DispositionVignettes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dispositionVignette = $this->DispositionVignettes->patchEntity($dispositionVignette, $this->request->getData());
            if ($this->DispositionVignettes->save($dispositionVignette)) {
                $this->Flash->success(__('The disposition vignette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The disposition vignette could not be saved. Please, try again.'));
        }
        $this->set(compact('dispositionVignette'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Disposition Vignette id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dispositionVignette = $this->DispositionVignettes->get($id);
        if ($this->DispositionVignettes->delete($dispositionVignette)) {
            $this->Flash->success(__('The disposition vignette has been deleted.'));
        } else {
            $this->Flash->error(__('The disposition vignette could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
