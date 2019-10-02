<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EvenementStatCampaigns Controller
 *
 * @property \App\Model\Table\EvenementStatCampaignsTable $EvenementStatCampaigns
 *
 * @method \App\Model\Entity\EvenementStatCampaign[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvenementStatCampaignsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Evenements', 'Sources']
        ];
        $evenementStatCampaigns = $this->paginate($this->EvenementStatCampaigns);

        $this->set(compact('evenementStatCampaigns'));
    }

    /**
     * View method
     *
     * @param string|null $id Evenement Stat Campaign id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evenementStatCampaign = $this->EvenementStatCampaigns->get($id, [
            'contain' => ['Evenements', 'Sources']
        ]);

        $this->set('evenementStatCampaign', $evenementStatCampaign);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evenementStatCampaign = $this->EvenementStatCampaigns->newEntity();
        if ($this->request->is('post')) {
            $evenementStatCampaign = $this->EvenementStatCampaigns->patchEntity($evenementStatCampaign, $this->request->getData());
            if ($this->EvenementStatCampaigns->save($evenementStatCampaign)) {
                $this->Flash->success(__('The evenement stat campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evenement stat campaign could not be saved. Please, try again.'));
        }
        $evenements = $this->EvenementStatCampaigns->Evenements->find('list', ['limit' => 200]);
        $sources = $this->EvenementStatCampaigns->Sources->find('list', ['limit' => 200]);
        $this->set(compact('evenementStatCampaign', 'evenements', 'sources'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Evenement Stat Campaign id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evenementStatCampaign = $this->EvenementStatCampaigns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evenementStatCampaign = $this->EvenementStatCampaigns->patchEntity($evenementStatCampaign, $this->request->getData());
            if ($this->EvenementStatCampaigns->save($evenementStatCampaign)) {
                $this->Flash->success(__('The evenement stat campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evenement stat campaign could not be saved. Please, try again.'));
        }
        $evenements = $this->EvenementStatCampaigns->Evenements->find('list', ['limit' => 200]);
        $sources = $this->EvenementStatCampaigns->Sources->find('list', ['limit' => 200]);
        $this->set(compact('evenementStatCampaign', 'evenements', 'sources'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Evenement Stat Campaign id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evenementStatCampaign = $this->EvenementStatCampaigns->get($id);
        if ($this->EvenementStatCampaigns->delete($evenementStatCampaign)) {
            $this->Flash->success(__('The evenement stat campaign has been deleted.'));
        } else {
            $this->Flash->error(__('The evenement stat campaign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
