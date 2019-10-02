<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CronsProgrammes Controller
 *
 * @property \App\Model\Table\CronsProgrammesTable $CronsProgrammes
 *
 * @method \App\Model\Entity\CronsProgramme[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CronsProgrammesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $cronsProgrammes = $this->paginate($this->CronsProgrammes);

        $this->set(compact('cronsProgrammes'));
    }

    /**
     * View method
     *
     * @param string|null $id Crons Programme id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cronsProgramme = $this->CronsProgrammes->get($id, [
            'contain' => []
        ]);

        $this->set('cronsProgramme', $cronsProgramme);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cronsProgramme = $this->CronsProgrammes->newEntity();
        if ($this->request->is('post')) {
            $cronsProgramme = $this->CronsProgrammes->patchEntity($cronsProgramme, $this->request->getData());
            if ($this->CronsProgrammes->save($cronsProgramme)) {
                $this->Flash->success(__('The crons programme has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crons programme could not be saved. Please, try again.'));
        }
        $this->set(compact('cronsProgramme'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Crons Programme id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cronsProgramme = $this->CronsProgrammes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cronsProgramme = $this->CronsProgrammes->patchEntity($cronsProgramme, $this->request->getData());
            if ($this->CronsProgrammes->save($cronsProgramme)) {
                $this->Flash->success(__('The crons programme has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crons programme could not be saved. Please, try again.'));
        }
        $this->set(compact('cronsProgramme'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Crons Programme id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cronsProgramme = $this->CronsProgrammes->get($id);
        if ($this->CronsProgrammes->delete($cronsProgramme)) {
            $this->Flash->success(__('The crons programme has been deleted.'));
        } else {
            $this->Flash->error(__('The crons programme could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
