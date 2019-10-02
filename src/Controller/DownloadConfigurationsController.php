<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DownloadConfigurations Controller
 *
 * @property \App\Model\Table\DownloadConfigurationsTable $DownloadConfigurations
 *
 * @method \App\Model\Entity\DownloadConfiguration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DownloadConfigurationsController extends AppController
{

    public function isAuthorized($user)
    {
        // Par défaut, on refuse l'accès.
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Evenements']
        ];
        $downloadConfigurations = $this->paginate($this->DownloadConfigurations);

        $this->set(compact('downloadConfigurations'));
    }

    /**
     * View method
     *
     * @param string|null $id Download Configuration id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $downloadConfiguration = $this->DownloadConfigurations->get($id, [
            'contain' => ['Evenements']
        ]);

        $this->set('downloadConfiguration', $downloadConfiguration);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $downloadConfiguration = $this->DownloadConfigurations->newEntity();
        $evenement = null;
        if(!empty($idEvenement)){
            $evenement = $this->DownloadConfigurations->Evenements->get($idEvenement);//debug($evenement);die;
            $downloadConfigurationFind = $this->DownloadConfigurations->find()->where(['evenement_id'=>$idEvenement])->first();
            if($downloadConfigurationFind){
                $downloadConfiguration = $downloadConfigurationFind;
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $downloadConfiguration = $this->DownloadConfigurations->patchEntity($downloadConfiguration, $this->request->getData());
            if ($this->DownloadConfigurations->save($downloadConfiguration)) {
                $this->Flash->success(__('The download configuration has been saved.'));

                return $this->redirect(['action' => 'add', $idEvenement]);

            }
            $this->Flash->error(__('The download configuration could not be saved. Please, try again.'));
        }
        $evenements = $this->DownloadConfigurations->Evenements->find('list',['valueField'=>'nom']);
        $this->set(compact('downloadConfiguration', 'evenements', 'evenement','idEvenement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create($idClient = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $downloadConfiguration = $this->DownloadConfigurations->newEntity();
        $client = null;
        if(!empty($idClient)){
            $client = $this->DownloadConfigurations->Clients->get($idClient);//debug($client);die;
            $downloadConfigurationFind = $this->DownloadConfigurations->find()->where(['client_id'=>$idClient])->first();
            if($downloadConfigurationFind){
                $downloadConfiguration = $downloadConfigurationFind;
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $downloadConfiguration = $this->DownloadConfigurations->patchEntity($downloadConfiguration, $this->request->getData());
            if ($this->DownloadConfigurations->save($downloadConfiguration)) {
                $this->Flash->success(__('The download configuration has been saved.'));

                return $this->redirect(['action' => 'create', $idClient]);

            }
            $this->Flash->error(__('The download configuration could not be saved. Please, try again.'));
        }
        $clients = $this->DownloadConfigurations->Clients->find('list',['valueField'=>'nom']);
        //$client = $this->DownloadConfigurations->Clients->get($idClient);
        //debug($client);die;

        $this->loadModel('ClientsModelesEmails');
        $countModeleEmail = $this->ClientsModelesEmails->find('all')
                                            ->where(['ClientsModelesEmails.client_id' => $idClient])
                                            ->count();
        
        $this->loadModel('ClientsModelesSmss');
        $countModeleSms = $this->ClientsModelesSmss->find('all')
                                            ->where(['ClientsModelesSmss.client_id' => $idClient])
                                            ->count();
     
        $this->loadModel('ClientsCustoms');
        $custom = $this->ClientsCustoms->find('all')->where(['client_id'=>$idClient])->first();
                            
        $this->set(compact('countModeleEmail','countModeleSms','custom'));
        $this->set(compact('downloadConfiguration', 'client', 'clients','idClient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Download Configuration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $downloadConfiguration = $this->DownloadConfigurations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $downloadConfiguration = $this->DownloadConfigurations->patchEntity($downloadConfiguration, $this->request->getData());
            if ($this->DownloadConfigurations->save($downloadConfiguration)) {
                $this->Flash->success(__('The download configuration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The download configuration could not be saved. Please, try again.'));
        }
        $evenements = $this->DownloadConfigurations->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('downloadConfiguration', 'evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Download Configuration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $downloadConfiguration = $this->DownloadConfigurations->get($id);
        if ($this->DownloadConfigurations->delete($downloadConfiguration)) {
            $this->Flash->success(__('The download configuration has been deleted.'));
        } else {
            $this->Flash->error(__('The download configuration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
