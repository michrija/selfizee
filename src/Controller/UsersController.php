<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Collection\Collection;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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
            'contain' => ['Roles', 'Evenements', 'Galeries', 'Clients'],
            'conditions' => ['role_id'=>3]
        ];
        $users = $this->paginate($this->Users);
        //debug($users);die;

        $this->viewBuilder()->setLayout('sans_menu');
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('page_config_user');
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Evenements', 'Galeries', 'Clients']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $evenements = $this->Users->Evenements->find('list', ['limit' => 200]);
        $galeries = $this->Users->Galeries->find('list', ['limit' => 200]);
        $clients = $this->Users->Clients->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'evenements', 'galeries', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $evenements = $this->Users->Evenements->find('list', ['limit' => 200]);
        $galeries = $this->Users->Galeries->find('list', ['limit' => 200]);
        $clients = $this->Users->Clients->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'evenements', 'galeries', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     public function login($isLoginGalerie = 0)
    {
        //parse_url('www.huhu.fr/test');
        $url = \Cake\Core\Configure::read('url_admin_domaine');
        $host = Router::getRequest(true)->host();
        if ($url != $host) {
            $this->loadModel('Clients');
            $client = $this->Users->Clients->find()->where(['url_bo'=>$host])->first();
            if (!empty($client['url_bo'])) {
                $this->set(compact('client'));
            }
        }
        /*$client = null;
        if(!empty($idClient)){
            $client = $this->Users->Clients->find()->where(['id'=>$idClient])->first();
            $this->set(compact('client'));
        }*/

        if($isLoginGalerie){
            if ($this->request->is('post')) {
                
                
                
                $user = $this->Auth->identify();
                if ($user) {
                    
                    $galery = $this->Users->Galeries->find()
                                            ->contain(['Evenements'])
                                            ->where(['id'=>$user['galerie_id']])
                                            ->first();
                    if($galery){
                        $this->Auth->setUser($user);
                        /**
                         * Save historique de connexion
                         * */
                         $this->loadModel('HistoriqueConnexions');
                         //debug($user); die;
                            $historique['user_id'] = $user['id'];
                            $historique['galerie_id'] = $galery->id;
                            $historique['evenement_id'] = $galery->evenements[0]->id;
                            $historique['queue'] = time();
                         $historiqueEntity = $this->HistoriqueConnexions->newEntity($historique);
                         $this->HistoriqueConnexions->save($historiqueEntity);
                         
                        
                        return $this->redirect(['controller'=>'Galeries','action'=> 'souvenir',$galery->id_encode]);
                    }else{
                        $this->Flash->error(__("Identifiant incorrect"));
                    }
                    
                } else {
                    $this->Flash->error(__("Identifiant incorrect"));
                }
                
            }
            
            if($isLoginGalerie == 1){
                $this->viewBuilder()->setLayout('gallerylogin');
                $this->render('../Galeries/login');
            }else{
                $this -> set([
                    'title' => 'RGPD - Selfizee',
                    'banniere_title' => 'Interface de gestion des données utilisateurs - RGPD'
                ]);
                $this->viewBuilder()->setLayout('client');
                $this->render('../Rgpd/inscription');
            } 
            
        }else{
            $this->viewBuilder()->setLayout('login');
            if ($this->request->is('post')) {
                $user = $this->Auth->identify();
                //debug($user);die;
                if ($user) {
                    if(!empty($client)){
                        $user['client'] = $client;  
                    }
                    $this->Auth->setUser($user);
                    if($user['role_id'] = 5 && !empty($user['evenement_id'])){
                        //debug($user);die;
                        if($user['evenement_id']==2403){
                            return $this->redirect(['controller' => 'Contacts', 'action' => 'formulaire', $user['evenement_id']]);
                        }
                        //return $this->redirect(['controller' => 'Evenements', 'action' => 'view', $user['evenement_id']]);
                        return $this->redirect(['controller' => 'Evenements', 'action' => 'board', $user['evenement_id']]);
                        
                    }
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error(__("Nom d'utilisateur ou mot de passe incorrect"));
                }
            }
        }
        
    }
    
     public function logout($isGalerie = false)
    {
        $this->Flash->success(__("You have been disconnected."));
        if($isGalerie){
            
            return $this->redirect([
                'controller' => 'Users',
                'action' => 'login', 1,
                '_host' => Configure::read('front_domaine'),
            ]);  
        }else{
            return $this->redirect($this->Auth->logout());
        }
        
        
    }
    
    public function board(){
        $id = $this->Auth->user('id');
        $this->viewBuilder()->setLayout('sans_menu');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $idClient = $this->Auth->user('client_id');
        $client = $this->Clients->get($idClient);
        $this->set(compact('user','client'));
    }

    public function settings($id)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if(empty($data['password']) ){
                unset($data['password']);
            }
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'settings',$id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

     public function settingsEmailAcces()
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $this->loadModel('ContenusEmails');
        $email_pre_rentre = $this->ContenusEmails->newEntity();
        $email_pre_rentre_find = $this->ContenusEmails->find()->first();
        if($email_pre_rentre_find) {
            $email_pre_rentre = $email_pre_rentre_find;
        }
        //debug($email_pre_rentre);die;


        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);  die;
            $email_pre_rentre = $this->ContenusEmails->patchEntity($email_pre_rentre, $data);
            //debug($user); die;
            if ($this->ContenusEmails->save($email_pre_rentre)) {

                $this->Flash->success(__('Successfully saved.'));
                return $this->redirect(['action' => 'settingsEmailAcces']);
            }
            $this->Flash->error(__('Not saved. Please, try again.'));
        }

        $this->set(compact('email_pre_rentre'));
    }

    /**
     * connexion WS
     *
     */
    public function connexion() {
        $this->viewBuilder()->setLayout('ajax');
        $res['success'] = false;
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            //debug($user);die;
            if ($user) {
                if(!empty($user['client_id'])){
                    //debug($user);die;
                    $res['success'] = true;
                    $res['user'] = $user;
                    $this->loadModel('Evenements');
                    $evenements = $this->Evenements->find('all')
                                                ->contain(['Photos'])
                                                ->where(['client_id' => $user['client_id'] ]);
                    $evenementListe = array();
                    if(!empty($evenements)){
                        foreach($evenements as $evenement){
                            $envtNew = array();
                            $nbrPhoto = intval($evenement->photo_count);
                            $nbrContact = 0;
                            if($nbrPhoto){
                                $collection = new Collection($evenement->photos);
                                $id = $collection->extract('id');
                                $idPhotos = $id->toList();
                                
                                $contactList = $this->Evenements->Photos->Contacts
                                                        ->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos])
                                                        ->toArray();
                                $nbrContact = count($contactList);
                            }
                            $envtNew['id'] = $evenement->id;
                            $envtNew['nom'] = $evenement->nom;
                            $envtNew['slug'] = $evenement->slug;
                            $envtNew['code_logiciel'] = $evenement->code_logiciel;
                            $envtNew['date_debut'] = empty($evenement->date_debut) ? "" : $evenement->date_debut->format('d/m/Y');
                            $envtNew['date_fin'] = empty($evenement->date_fin) ? "" : $evenement->date_fin->format('d/m/Y');
                            $envtNew['nbr_photo'] = $nbrPhoto;
                            $envtNew['nbr_impression'] = $evenement->print_counter;
                            $envtNew['nbr_contact'] = $nbrContact;

                            array_push($evenementListe, $envtNew);
                        }
                    }
                    $res['user']['evenements'] = $evenementListe;
                }
            }
        }
        //echo json_encode($res);
        $this->set(compact('res'));
    }

}
