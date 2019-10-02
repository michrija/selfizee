<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContenusEmails Controller
 *
 * @property \App\Model\Table\ContenusEmailsTable $ContenusEmails
 *
 * @method \App\Model\Entity\ContenusEmail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContenusEmailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $contenusEmails = $this->paginate($this->ContenusEmails);

        $this->set(compact('contenusEmails'));
    }

    /**
     * View method
     *
     * @param string|null $id Contenus Email id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contenusEmail = $this->ContenusEmails->get($id, [
            'contain' => []
        ]);

        $this->set('contenusEmail', $contenusEmail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $contenusEmail = $this->ContenusEmails->newEntity();
        if ($this->request->is('post')) {
            $contenusEmail = $this->ContenusEmails->patchEntity($contenusEmail, $this->request->getData());
            if ($this->ContenusEmails->save($contenusEmail)) {
                $this->Flash->success(__('The contenus email has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contenus email could not be saved. Please, try again.'));
        }
        $this->set(compact('contenusEmail'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contenus Email id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $this->viewBuilder()->setLayout('sans_menu');
        $contenusEmail = $this->ContenusEmails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contenusEmail = $this->ContenusEmails->patchEntity($contenusEmail, $this->request->getData());
            if ($this->ContenusEmails->save($contenusEmail)) {
                $this->Flash->success(__('The contenus email has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contenus email could not be saved. Please, try again.'));
        }
        $this->set(compact('contenusEmail'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contenus Email id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contenusEmail = $this->ContenusEmails->get($id);
        if ($this->ContenusEmails->delete($contenusEmail)) {
            $this->Flash->success(__('The contenus email has been deleted.'));
        } else {
            $this->Flash->error(__('The contenus email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getContenus($id) {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;

        $contenu_email = 
        $contenu_email = $this->ContenusEmails->find('list', ['valueField'=>'contenu'])->where(['id'=>$id])->toArray();
        if(!empty($contenu_email)) {
            $contenu_email = array_values($contenu_email);
            //$contenu_email = $contenu_email[0];        
        }
        echo json_encode($contenu_email);
    }
}
