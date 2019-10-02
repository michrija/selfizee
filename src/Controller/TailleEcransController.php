<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TailleEcrans Controller
 *
 * @property \App\Model\Table\TailleEcransTable $TailleEcrans
 *
 * @method \App\Model\Entity\TailleEcran[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TailleEcransController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tailleEcrans = $this->paginate($this->TailleEcrans);

        $this->set(compact('tailleEcrans'));
    }

    /**
     * View method
     *
     * @param string|null $id Taille Ecran id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tailleEcran = $this->TailleEcrans->get($id, [
            'contain' => ['ConfigurationBornes']
        ]);

        $this->set('tailleEcran', $tailleEcran);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tailleEcran = $this->TailleEcrans->newEntity();
        if ($this->request->is('post')) {
            $tailleEcran = $this->TailleEcrans->patchEntity($tailleEcran, $this->request->getData());
            if ($this->TailleEcrans->save($tailleEcran)) {
                $this->Flash->success(__('The taille ecran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taille ecran could not be saved. Please, try again.'));
        }
        $this->set(compact('tailleEcran'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Taille Ecran id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tailleEcran = $this->TailleEcrans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tailleEcran = $this->TailleEcrans->patchEntity($tailleEcran, $this->request->getData());
            if ($this->TailleEcrans->save($tailleEcran)) {
                $this->Flash->success(__('The taille ecran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taille ecran could not be saved. Please, try again.'));
        }
        $this->set(compact('tailleEcran'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Taille Ecran id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tailleEcran = $this->TailleEcrans->get($id);
        if ($this->TailleEcrans->delete($tailleEcran)) {
            $this->Flash->success(__('The taille ecran has been deleted.'));
        } else {
            $this->Flash->error(__('The taille ecran could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
