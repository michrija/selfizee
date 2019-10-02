<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeDonnees Controller
 *
 * @property \App\Model\Table\TypeDonneesTable $TypeDonnees
 *
 * @method \App\Model\Entity\TypeDonnee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeDonneesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $typeDonnees = $this->paginate($this->TypeDonnees);

        $this->set(compact('typeDonnees'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Donnee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeDonnee = $this->TypeDonnees->get($id, [
            'contain' => ['Champs']
        ]);

        $this->set('typeDonnee', $typeDonnee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeDonnee = $this->TypeDonnees->newEntity();
        if ($this->request->is('post')) {
            $typeDonnee = $this->TypeDonnees->patchEntity($typeDonnee, $this->request->getData());
            if ($this->TypeDonnees->save($typeDonnee)) {
                $this->Flash->success(__('The type donnee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type donnee could not be saved. Please, try again.'));
        }
        $this->set(compact('typeDonnee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Donnee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeDonnee = $this->TypeDonnees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeDonnee = $this->TypeDonnees->patchEntity($typeDonnee, $this->request->getData());
            if ($this->TypeDonnees->save($typeDonnee)) {
                $this->Flash->success(__('The type donnee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type donnee could not be saved. Please, try again.'));
        }
        $this->set(compact('typeDonnee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Donnee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeDonnee = $this->TypeDonnees->get($id);
        if ($this->TypeDonnees->delete($typeDonnee)) {
            $this->Flash->success(__('The type donnee has been deleted.'));
        } else {
            $this->Flash->error(__('The type donnee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
