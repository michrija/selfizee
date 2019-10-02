<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\Collection\Collection;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        $autorised = array(1,2);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['view'])) { 
                    $id = $this->request->getParam('pass.0');
                    $idCurrentClient = $user['client_id'];
                    
                    if($idCurrentClient == $id)  {
                        return true;
                    }              
            }

            if (in_array($action, ['forceLogin', 'addAcces', 'accesList', 'forceLoginFromAccess'])) {
                return true;
            }
        }

        if (in_array($action, ['editProfile'])) { 
            return true;
        }

        if($user['role_id'] == 2) {
            if($action == 'accesList' && $user['is_active_add_client'] == true) {
                return true;
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
    public function index()
    {
        $this->loadModel('TypeClients');
        $namekey = $this->request->getQuery('name');
        $typekey = $this->request->getQuery('type');
        $clientId = $this->Auth->user("client_id");
        $typeclient = $this->TypeClients->find('list',['keyField' => 'id', 'valueField' => 'type']);
        $typeclientValue = $this->TypeClients->find()->toArray();
        $typeclientcombined = (new Collection($typeclientValue))->combine('id', 'type');

        $this->viewBuilder()->setLayout('sans_menu');

        $client = $this->Clients
            ->find('all')
            ->contain([
                'Evenements',
                'Users' => 'Roles',
            ]) ;

        if (!is_null($namekey)) {
            $client->andWhere(['Clients.nom LIKE' => '%'.$namekey.'%']);

        }
        if (!is_null($typekey)) {
            $client->andWhere(['Clients.client_type_id ' => $typekey]);
        }

        if (!is_null($clientId)) {
            $client->andWhere(['Clients.parent_id' => $clientId]);
        }

        $clients = $this->paginate($client);
        $this->set(compact('clients','typeclient','typeclientcombined','namekey'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        return $this->redirect(['action' => 'board', $id]);

        $this->viewBuilder()->setLayout('page_config_user');
        $client = $this->Clients->get($id, [
            'contain' => ['Evenements', 'Users']
        ]);
        
        $this->loadModel('ClientsModelesEmails');
        $countModeleEmail = $this->ClientsModelesEmails->find('all')
                                            ->where(['ClientsModelesEmails.client_id' => $id])
                                            ->count();
        
        $this->loadModel('ClientsModelesSmss');
        $countModeleSms = $this->ClientsModelesSmss->find('all')
                                            ->where(['ClientsModelesSmss.client_id' => $id])
                                            ->count();
     
        $this->loadModel('ClientsCustoms');
        $custom = $this->ClientsCustoms->find('all')->where(['client_id'=>$id])->first();
                            
        $this->set(compact('countModeleEmail','countModeleSms','custom'));
        $this->set('client', $client);
    }

    public function board($idClient = null){
        if(empty($idClient)){
            $idClient = $this->Auth->user("client_id");
        }
        $this->viewBuilder()->setLayout('sans_menu');

        $client = $this->Clients->get($idClient, [
            'contain' => ['Evenements', 'Users']
        ]);
        $this->set('client', $client);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idClient = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $this->loadModel('TypeClients');
        $this->loadModel('ContactPrincipales');
        $typeclient = $this->TypeClients->find('list',['keyField' => 'id', 'valueField' => 'type']);
        $client = $this->Clients->newEntity();

        if ($idClient) {
            $client = $this->Clients->findById($idClient)->contain(['Users', 'ContactPrincipales'])->first();
            unset($client->user->password);
            $this->Clients->Users->validator('default')->allowEmpty('password');
        }


        $contact = $this->ContactPrincipales->newEntity();
       
        if ($this->request->is(['post', 'patch', 'put'])) {
            $data = $this->request->getData();
            $data['user']['is_active_custom_marque_blanche'] = @$data['user']['is_active_custom_marque_blanche'] == 1 ? true : false;
            $data['is_active_add_client'] = @$data['is_active_add_client'] == 1 ? true : false;

      
            //=== Upload
            $uploadDest = WWW_ROOT.DS.'import'.DS.'clients'.DS;
            $dir              = new Folder($uploadDest, true, 0755);
            $uploadPath = $dir->pwd();

            if (!empty($data['logo_header_page_galerie_file']['name'])) {
                $extension = pathinfo($data['logo_header_page_galerie_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['logo_header_page_galerie_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['logo_header_page_galerie'] = $newFilename;
                }
            }
            if (!empty($data['logo_page_bo_file']['name'])) {
                $extension = pathinfo($data['logo_page_bo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['logo_page_bo_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['logo_page_bo'] = $newFilename;
                }
            }
            if (!empty($data['favicon_file']['name'])) {
                $extension = pathinfo($data['favicon_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['favicon_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['favicon'] = $newFilename;
                }
            }

            if (!empty($data['img_fond_login_file']['name'])) {
                $extension = pathinfo($data['img_fond_login_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['img_fond_login_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['img_fond_login'] = $newFilename;
                }
            }
            
            $data['parent_id'] = $clientId = $this->Auth->user("client_id");
            $data['date_debut_contact'] = !empty($data['date_debut_contact']) ? \DateTime::createFromFormat('d/m/Y', $data['date_debut_contact'])->format('Y-m-d') : null;
            $clientEntity = $this->Clients->patchEntity($client, $data, ['associated' => ['Users','ContactPrincipales']]);
            
            if (empty(array_filter($data['contact_principale']))) {
                unset($clientEntity->contact_principale);
            }

            if (!$clientEntity->getErrors()) {
                $saveclient = $this->Clients->save($clientEntity);
                if ($saveclient) {
                    $this->Flash->success(__('The client has been saved.'));
                    // return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }

        }
        $this->set(compact('client','typeclient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $client = $this->Clients->get($id, [
            'contain' => ['Users']
        ]);
        //debug($client);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $data = $this->request->getData();
            if (!empty($data['logo_header_page_galerie_file']['name'])) {
                $extension = pathinfo($data['logo_header_page_galerie_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $uploadPath = 'import/clients/';
                if (move_uploaded_file($data['logo_header_page_galerie_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['logo_header_page_galerie'] = $newFilename;
                }
            }
            if (!empty($data['logo_page_bo_file']['name'])) {
                $extension = pathinfo($data['logo_page_bo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $uploadPath = 'import/clients/';
                if (move_uploaded_file($data['logo_page_bo_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['logo_page_bo'] = $newFilename;
                }
            }
            if (!empty($data['favicon_file']['name'])) {
                $extension = pathinfo($data['favicon_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $uploadPath = 'import/clients/';
                if (move_uploaded_file($data['favicon_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['favicon'] = $newFilename;
                }
            }

            if(empty($data['user']['password'])){
                unset($data['user']['password']);
            }
            //debug($data); die;
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    public function editProfile($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $client = $this->Clients->get($id, [
            'contain' => ['Users']
        ]);
        //debug($client);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $data = $this->request->getData();
            if (!empty($data['logo_header_page_galerie_file']['name'])) {
                $extension = pathinfo($data['logo_header_page_galerie_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $uploadPath = 'import/clients/';
                if (move_uploaded_file($data['logo_header_page_galerie_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['logo_header_page_galerie'] = $newFilename;
                }
            }
            if (!empty($data['logo_page_bo_file']['name'])) {
                $extension = pathinfo($data['logo_page_bo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $uploadPath = 'import/clients/';
                if (move_uploaded_file($data['logo_page_bo_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['logo_page_bo'] = $newFilename;
                }
            }
            if (!empty($data['favicon_file']['name'])) {
                $extension = pathinfo($data['favicon_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $uploadPath = 'import/clients/';
                if (move_uploaded_file($data['favicon_file']['tmp_name'],  $uploadPath. $newFilename)) {
                    $data['favicon'] = $newFilename;
                }
            }

            if(empty($data['user']['password'])){
                unset($data['user']['password']);
            }
            //debug($data); die;
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'editProfile', $client->id]);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function forceLogin($id){
        $client = $this->Clients->get($id,['contain'=>['Users']]);
        $user_connecte = $client->user->toArray();
        $user_connecte ['client'] = $client;

        if(!empty($client->user)){
            $this->Flash->success(__('Vous être connecté en tant que : ').$client->nom);
            $this->Auth->setUser($user_connecte);
            return $this->redirect(['controller' => 'Evenements','action'=> 'index']);
        }else{
            $this->Flash->error(__('Veuillez d\'abord créer un compte de connexion pour ce client.'));
            return $this->redirect(['controller'=>'Clients','action'=> 'edit', $id]);
        }
    }

    public function forceLoginFromAccess($user_id)
    {
        $this->loadModel('Users');
        $user = $this->Users->get($user_id);
        if(!empty($user)){
            //debug($user);die;
            $this->Flash->success(__('Vous être connecté en tant que : ').$user->username);
            $this->Auth->setUser($user);
            return $this->redirect(['controller'=> 'Evenements', 'action'=> 'index' ]);
        }      
    }

    public function accesList()
    {
        $this->loadModel('Users');
        $currentAuthID = $this->request->Session()->read('Auth.User.id');
        $this->viewBuilder()->setLayout('sans_menu');
        $users = $this->Users->find()->where(['parent_id' => $currentAuthID, 'role_id' => 7]);        
        $this->loadModel('ContenusEmails');
        $contenu_email = $this->ContenusEmails->find()->first();
        $contenu = "";

        if($contenu_email) {
            $contenu = $contenu_email->contenu;
        }

        if($users->count() == 0){
            return $this->redirect(['action' => 'add-acces']);
        }
        
        $this->set(compact('users', 'contenu'));
    }

    public function addAcces($userId=null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        $currentAuthID = $this->request->Session()->read('Auth.User.id');
        if (!is_null($userId)) {
            $user = $this->Users->findById($userId)->first();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['role_id'] = 7;
            $data['parent_id'] = $currentAuthID;
            $data['password'] = $data['password_visible'];
            // debug($data);  die;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {

                $this->Flash->success(__('The accees has been saved.'));
                return $this->redirect(['action' => 'acces-list']);
            }/* else {
                debug($user); die;
            }*/
            $this->Flash->error(__('The accees could not be saved. Please, try again.'));
        }
        
        $this->set(compact('client', 'user'));
    }
     public function deleteAcces($id= null){
        $this->loadModel('Users');
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);       
        $event_id = $user->evenement_id;
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The acces has been deleted.'));
        } else {
            $this->Flash->error(__('The acces could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'accesList', $event_id]);
    }

}
