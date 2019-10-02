<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CsvColonnes Controller
 *
 * @property \App\Model\Table\CsvColonnesTable $CsvColonnes
 *
 * @method \App\Model\Entity\CsvColonne[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CsvColonnesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $csvColonnes = $this->paginate($this->CsvColonnes);

        $this->set(compact('csvColonnes'));
    }

    /**
     * View method
     *
     * @param string|null $id Csv Colonne id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $csvColonne = $this->CsvColonnes->get($id, [
            'contain' => ['CsvColonnePositions']
        ]);

        $this->set('csvColonne', $csvColonne);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $csvColonne = $this->CsvColonnes->newEntity();
        if ($this->request->is('post')) {
            $csvColonne = $this->CsvColonnes->patchEntity($csvColonne, $this->request->getData());
            if ($this->CsvColonnes->save($csvColonne)) {
                $this->Flash->success(__('The csv colonne has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The csv colonne could not be saved. Please, try again.'));
        }
        $this->set(compact('csvColonne'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Csv Colonne id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $csvColonne = $this->CsvColonnes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $csvColonne = $this->CsvColonnes->patchEntity($csvColonne, $this->request->getData());
            if ($this->CsvColonnes->save($csvColonne)) {
                $this->Flash->success(__('The csv colonne has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The csv colonne could not be saved. Please, try again.'));
        }
        $this->set(compact('csvColonne'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Csv Colonne id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $csvColonne = $this->CsvColonnes->get($id);
        if ($this->CsvColonnes->delete($csvColonne)) {
            $this->Flash->success(__('The csv colonne has been deleted.'));
        } else {
            $this->Flash->error(__('The csv colonne could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
