<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RsConfigurations Controller
 *
 * @property \App\Model\Table\RsConfigurationsTable $RsConfigurations
 *
 * @method \App\Model\Entity\RsConfiguration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RsConfigurationsController extends AppController
{

//    /**
//     * Index method
//     *
//     * @return \Cake\Http\Response|void
//     */
//    public function index()
//    {
//        $this->paginate = [
//            'contain' => ['Evenements']
//        ];
//        $rsConfigurations = $this->paginate($this->RsConfigurations);
//
//        $this->set(compact('rsConfigurations'));
//    }
//
//    /**
//     * View method
//     *
//     * @param string|null $id Rs Configuration id.
//     * @return \Cake\Http\Response|void
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $rsConfiguration = $this->RsConfigurations->get($id, [
//            'contain' => ['Evenements']
//        ]);
//
//        $this->set('rsConfiguration', $rsConfiguration);
//    }

    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['add'])) {
                    $idEvenement = $this->request->getParam('pass.0');
                    $clientId = $user['client_id'];
                    $this->loadModel('Evenements');
                    $evenement = $this->Evenements->get($idEvenement);
                    //debug($evenement->client_id); debug($clientId); die;
                    if($clientId == $evenement->client_id)  {
                        return true;
                    }              
            }
        }
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement)
    {
        $rsConfiguration = $this->RsConfigurations->newEntity();
        if(!empty($idEvenement)){
            $evenement = $this->RsConfigurations->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
            $rsConfigurationFind = $this->RsConfigurations->find()->where(['evenement_id'=>$idEvenement])->first();
            if($rsConfigurationFind){
                $rsConfiguration = $rsConfigurationFind;
            }
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rsConfiguration = $this->RsConfigurations->patchEntity($rsConfiguration, $this->request->getData());
            if ($this->RsConfigurations->save($rsConfiguration)) {
                $this->Flash->success(__('The rs configuration has been saved.'));

                return $this->redirect(['action' => 'add' , $idEvenement]);
            }
            $this->Flash->error(__('The rs configuration could not be saved. Please, try again.'));
        }
        $evenements = $this->RsConfigurations->Evenements->find('list');
        $this->set(compact('rsConfiguration', 'evenements','evenement','idEvenement'));
        $this->set('isConfiguration',true);
    }

//    /**
//     * Edit method
//     *
//     * @param string|null $id Rs Configuration id.
//     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $rsConfiguration = $this->RsConfigurations->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $rsConfiguration = $this->RsConfigurations->patchEntity($rsConfiguration, $this->request->getData());
//            if ($this->RsConfigurations->save($rsConfiguration)) {
//                $this->Flash->success(__('The rs configuration has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The rs configuration could not be saved. Please, try again.'));
//        }
//        $evenements = $this->RsConfigurations->Evenements->find('list', ['limit' => 200]);
//        $this->set(compact('rsConfiguration', 'evenements'));
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Rs Configuration id.
//     * @return \Cake\Http\Response|null Redirects to index.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $rsConfiguration = $this->RsConfigurations->get($id);
//        if ($this->RsConfigurations->delete($rsConfiguration)) {
//            $this->Flash->success(__('The rs configuration has been deleted.'));
//        } else {
//            $this->Flash->error(__('The rs configuration could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
//    }
}
