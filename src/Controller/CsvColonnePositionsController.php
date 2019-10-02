<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CsvColonnePositions Controller
 *
 * @property \App\Model\Table\CsvColonnePositionsTable $CsvColonnePositions
 *
 * @method \App\Model\Entity\CsvColonnePosition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CsvColonnePositionsController extends AppController
{
    
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['liste','add','delete', 'edit'])) {
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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function liste($idEvenement)
    {
        $evenement = $this->CsvColonnePositions->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $options['idEvenement'] = $idEvenement;
        $this->paginate = [
            'contain' => ['CsvColonnes', 'Evenements'],
            'finder' => [
                'filtre' => $options
            ]
        ];
        $csvColonnePositions = $this->paginate($this->CsvColonnePositions);

        $this->set(compact('csvColonnePositions','evenement','idEvenement'));
        $this->set('isConfiguration',true);
    }

//    /**
//     * View method
//     *
//     * @param string|null $id Csv Colonne Position id.
//     * @return \Cake\Http\Response|void
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $csvColonnePosition = $this->CsvColonnePositions->get($id, [
//            'contain' => ['CsvColonnes', 'Evenements']
//        ]);
//
//        $this->set('csvColonnePosition', $csvColonnePosition);
//    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement )
    {
        $csvColonnePosition = $this->CsvColonnePositions->newEntity();
        /*if(!empty($idEvenement)){
            $evenement = $this->CsvColonnePositions->Evenements->get($idEvenement);
            $csvColonnePositionsFind = $this->CsvColonnePositions->find()->where(['evenement_id'=>$idEvenement])->first();
            if($csvColonnePositionsFind){
                $csvColonnePosition = $csvColonnePositionsFind;
            }
        }*/
       $idCsvColonnes = null;
       if(!empty($idEvenement)){
            $evenement = $this->CsvColonnePositions->Evenements->get($idEvenement);
            $idCsvColonnes = $this->CsvColonnePositions
                                    ->find('list',['valueField'=>'csv_colonne_id'])
                                    ->where(['evenement_id'=>$idEvenement])
                                    ->toArray();
           
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $csvColonnePosition = $this->CsvColonnePositions->patchEntity($csvColonnePosition, $this->request->getData());
            if ($this->CsvColonnePositions->save($csvColonnePosition)) {
                $this->Flash->success(__('The csv colonne position has been saved.'));

                return $this->redirect(['action' => 'liste', $csvColonnePosition->evenement_id]);
            }
            $this->Flash->error(__('The csv colonne position could not be saved. Please, try again.'));
        }
        $csvColonnes = $this->CsvColonnePositions->CsvColonnes->find('list', ['valueField' => 'nom']);
        if(!empty($idCsvColonnes)){
            $csvColonnes = $csvColonnes->where(['CsvColonnes.id NOT IN' => $idCsvColonnes]);
        }
        
        $evenements = $this->CsvColonnePositions->Evenements->find('list', ['valueField' => 'nom']);
        $this->set(compact('csvColonnePosition', 'csvColonnes', 'evenements','idEvenement','evenement'));
        $this->set('isConfiguration',true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Csv Colonne Position id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($idEvenement, $id = null)
    {
        
       
        
        $csvColonnePosition = $this->CsvColonnePositions->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $csvColonnePosition = $this->CsvColonnePositions->patchEntity($csvColonnePosition, $this->request->getData());
           
            if ($this->CsvColonnePositions->save($csvColonnePosition)) {
                $this->Flash->success(__('The csv colonne position has been saved.'));

                return $this->redirect(['action' => 'liste', $csvColonnePosition->evenement_id]);
            }
            $this->Flash->error(__('The csv colonne position could not be saved. Please, try again.'));
        }
        $csvColonnes = $this->CsvColonnePositions->CsvColonnes->find('list', ['valueField' => 'nom']);
        $this->set('idEvenement',$csvColonnePosition->evenement_id );
        $this->set(compact('csvColonnePosition', 'csvColonnes'));
        $this->set('isConfiguration',true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Csv Colonne Position id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($idEvenement, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $csvColonnePosition = $this->CsvColonnePositions->get($id);
        if ($this->CsvColonnePositions->delete($csvColonnePosition)) {
            $this->Flash->success(__('The csv colonne position has been deleted.'));
        } else {
            $this->Flash->error(__('The csv colonne position could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste',$idEvenement]);
    }
}
