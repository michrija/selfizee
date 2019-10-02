<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EnvoiManuels Controller
 *
 * @property \App\Model\Table\EnvoiManuelsTable $EnvoiManuels
 *
 * @method \App\Model\Entity\EnvoiManuel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnvoiManuelsController extends AppController
{


      public function isAuthorized($user)
    {
        
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
        $envoiManuels = $this->paginate($this->EnvoiManuels);

        $this->set(compact('envoiManuels'));
    }

    /**
     * View method
     *
     * @param string|null $id Envoi Manuel id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $envoiManuel = $this->EnvoiManuels->get($id, [
            'contain' => ['Evenements', 'ContactToSendManuels']
        ]);

        $this->set('envoiManuel', $envoiManuel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $envoiManuel = $this->EnvoiManuels->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            //get liste contact not send for this event
            $this->loadModel('Photos');
            $idPhoto = $this->Photos->find('list',['valueField' => 'id'])
                                ->where(['evenement_id' => $this->request->getData('evenement_id'),'is_in_corbeille'=>false,'deleted'=>false])
                                ->toArray();
            //var_dump($idPhoto); die;
            if(!empty($idPhoto)){
                $contacts = $this->Photos->Contacts->find()
                                            ->select(['contact_id' =>'Contacts.id' ])
                                            ->where( ['Contacts.photo_id IN'=>$idPhoto]);
                
                
                                            //->toArray();
                $isForceEnvoi = $this->request->getData('is_force_envoi');
                $isEmail = $this->request->getData('is_email');
                
                if(!$isForceEnvoi){
                    //debug($isEmail); die;
                    if($isEmail){
                        $contacts = $contacts->where(['Contacts.email IS NOT' => NULL , 'Contacts.email <>' => ''])
                                        ->notMatching('ContactEmailsEnvois');
                    }
                    
                    $isSms = $this->request->getData('is_sms');
                    if($isSms){
                        $contacts = $contacts->where(['Contacts.telephone IS NOT' => NULL , 'Contacts.telephone <>' => ''])
                                        ->notMatching('ContactSmsEnvois');
                    }
                    
                    
                    $isReenvoi = $this->request->getData('is_reenvoie_notsent');
                    if($isReenvoi){
                        /*$contacts = $contacts
                                        ->where(['Contacts.email IS NOT' => NULL , 'Contacts.email <>'=> ''])
                                        ->notMatching('Envois.EnvoiEmailStatDelivres');*/
                                        
                        $contacts = $this->Photos->Contacts->find()
                                                            ->select(['contact_id' =>'Contacts.id' ])
                                                            ->where(['Contacts.photo_id IN' => $idPhoto])
                                                            ->distinct(['Contacts.id'])
                                                            ->notMatching('Envois.EnvoiEmailStatDelivres');
                    }
                }else{
                    
                    if($isEmail){
                        $contacts = $contacts->where(['Contacts.email IS NOT' => NULL , 'Contacts.email <>' => '']);
                                        //->notMatching('ContactEmailsEnvois');
                    }
                    
                    $isSms = $this->request->getData('is_sms');
                    if($isSms){
                        $contacts = $contacts->where(['Contacts.telephone IS NOT' => NULL , 'Contacts.telephone <>' => '']);
                                        //->notMatching('ContactSmsEnvois');
                    }
                    
                    
                    $isReenvoi = $this->request->getData('is_reenvoie_notsent');
                    if($isReenvoi){
                        /*$contacts = $contacts
                                        ->where(['Contacts.email IS NOT' => NULL , 'Contacts.email <>'=> ''])
                                        ->notMatching('Envois.EnvoiEmailStatDelivres');*/
                                        
                        $contacts = $this->Photos->Contacts->find()
                                                            ->select(['contact_id' =>'Contacts.id' ])
                                                            ->where(['Contacts.photo_id IN' => $idPhoto])
                                                            ->distinct(['Contacts.id']);
                                                            //->notMatching('Envois.EnvoiEmailStatDelivres');
                    }
                    
                }
                
                
                $contacts = $contacts->toArray();
                //var_dump($contacts); die;
                
                if(!empty($contacts)){
                    
                    $json = json_encode($contacts);
                    $contacts = json_decode($json, TRUE);
                    $data['contact_to_send_manuels'] = $contacts;
                }else{
                    $this->Flash->error(__('Aucun contact à envoyer. Veuillez réessayer plus tard.'));
                    return $this->redirect(['controller' => 'Crons', 'action' => 'manuel',$this->request->getData('evenement_id') ]);
                    
                }
                
            }
            
            
            $envoiManuel = $this->EnvoiManuels->patchEntity($envoiManuel, $data);
                                
            //debug($envoiManuel); die;
            
            if ($this->EnvoiManuels->save($envoiManuel)) {
                $this->Flash->success(__('Envoi manuel lancé.'));
            }else{
                $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer plus tard.'));  
            }
            return $this->redirect(['controller' => 'Crons', 'action' => 'manuel',$this->request->getData('evenement_id') ]);
        }
        $evenements = $this->EnvoiManuels->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('envoiManuel', 'evenements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Envoi Manuel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $envoiManuel = $this->EnvoiManuels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $envoiManuel = $this->EnvoiManuels->patchEntity($envoiManuel, $this->request->getData());
            if ($this->EnvoiManuels->save($envoiManuel)) {
                $this->Flash->success(__('The envoi manuel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The envoi manuel could not be saved. Please, try again.'));
        }
        $evenements = $this->EnvoiManuels->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('envoiManuel', 'evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Envoi Manuel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $envoiManuel = $this->EnvoiManuels->get($id);
        if ($this->EnvoiManuels->delete($envoiManuel)) {
            $this->Flash->success(__('The envoi manuel has been deleted.'));
        } else {
            $this->Flash->error(__('The envoi manuel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
