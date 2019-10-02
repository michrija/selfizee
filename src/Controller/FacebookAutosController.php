<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Core\Configure;
/**
 * FacebookAutos Controller
 *
 * @property \App\Model\Table\FacebookAutosTable $FacebookAutos
 *
 * @method \App\Model\Entity\FacebookAuto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacebookAutosController extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['liste','add','delete'])) {
                    $idEvenement = $this->request->getParam('pass.0');
                    $clientId = $user['client_id'];
                    $this->loadModel('Evenements');
                    $evenement = $this->Evenements->get($idEvenement);
                    //debug($evenement->client_id); debug($clientId); die;
                    if($clientId == $evenement->client_id)  {
                        return true;
                    }               
            }else if($action == 'selectAlbums' ){
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
    public function liste($idEvenement)
    {
        //Pour récupérer l'id après la redirection faceook
        $session = $this->getRequest()->getSession();
        $session->write('idEvenement', $idEvenement);
        
        $options['idEvenement'] = $idEvenement;
        $this->paginate = [
            'contain' => ['Evenements','FacebookAutoSuivis'],
            'finder' => [
                'filtre' => $options
            ]
        ];
        $facebookAutos = $this->paginate($this->FacebookAutos);
        $evenement = $this->FacebookAutos->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $this->set(compact('facebookAutos','idEvenement','evenement'));
        $this->set("FB_URL_AUTORISATION", "https://graph.facebook.com/oauth/authorize?"
        . "client_id=".FB_API_ID."&scope=publish_pages,manage_pages,pages_show_list,user_friends&redirect_uri=".Router::url('/', true).'facebook-autos/selectAlbums');
        $this->set('isConfiguration',true);
    }
    
    public function selectAlbums(){
        
        $session = $this->getRequest()->getSession();
        $idEvenement = $session->read('idEvenement');
        if(!empty($idEvenement)){
            $evenement = $this->FacebookAutos->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
            if ($this->request->is('post')) {
                $idPageFacebook = $this->request->getData('pageFacebook');
                $tokenPageFacebook = $this->request->getData('tokePageFacebook');
                $namePageFacebook = $this->request->getData('namePageFacebook');
                if(!empty($idEvenement) && !empty($idPageFacebook) && !empty($namePageFacebook)){
                    return $this->redirect(['action' => 'add', $idEvenement, $idPageFacebook,$namePageFacebook, $tokenPageFacebook]);
                }else{
                    $this->Flash->error(__('Les deux champs sont obligatoire.'));
                }
            }else{
                if(!empty($this->request->getQuery('code')) ){
                    //echo 'je passe';
                    $this->loadComponent('Facebook');
                    $access = $this->Facebook->getAccessToken($this->request->getQuery('code'),FB_API_ID,FB_API_SECRET,Router::url('/', true)."facebook-autos/selectAlbums");
                    //$access = json_decode($access);
                    
                    if(isset($access->error) ){
                        return $this->redirect(['action' => 'liste', $idEvenement]);
                        $this->Flash->error($access->error->message);
                    }else{
                        if(property_exists($access,'access_token')){
    
                            $allPageFacebook   = $this->Facebook->getMyAccountsComplete($access->access_token);
                            //debug($allPageFacebook);
                            //die;
                            $this->set(compact('allPageFacebook'));
                        }
                    }
                    
                }else{
                        return $this->redirect("https://graph.facebook.com/oauth/authorize?"
                        . "client_id=".FB_API_ID."&scope=publish_pages,publish_actions,manage_pages,pages_show_list&redirect_uri=".Router::url('/', true).'facebook-auto/selectAlbums');
                }
            }
            
            $this->set('title', "Connexion à facebook");
             
            $this->loadModel("CadreData");
            $evenements = $this->FacebookAutos->Evenements->find('list',[
                                                        'keyField' => 'id',
                                                        'valueField' => 'nom'
                                                        ]
                                                )->order(['id'=>'desc']);
            $this->set(compact('evenements','idEvenement','evenement'));
            $this->set('isConfiguration',true);
        }
       
        
     }

//    /**
//     * View method
//     *
//     * @param string|null $id Facebook Auto id.
//     * @return \Cake\Http\Response|void
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $facebookAuto = $this->FacebookAutos->get($id, [
//            'contain' => ['Evenements', 'FacebookAutoSuivis']
//        ]);
//
//        $this->set('facebookAuto', $facebookAuto);
//    }
    
    public function add($idEvenement, $idPageFacebook, $namePageFacebook, $tokenPageFacebook ){
        
        if(empty($idEvenement) || empty($idPageFacebook) || empty($tokenPageFacebook) || empty($namePageFacebook) ){
            $this->Flash->error(__('Veuillez fournir les deux champs.'));
            return $this->redirect(['action' => 'selectAlbums']);
        }
        $this->loadComponent('Facebook');
        
        $result = $this->Facebook->getAlbumListe($tokenPageFacebook,$idPageFacebook,false,false,1000);
        //debug($result);die;
        if(empty($result)){
            $this->Flash->error(__('Une erreur s\'est produite. Veuillez réessayer.'));
            return $this->redirect(['action' => 'selectAlbums']);
        }
        $intervalles = $this->FacebookAutos->Intervalles->find('list', ['valueField' => 'intervalle']);
        $fbAlbums = $result['data'];
        $this->set('fbAlbums',$fbAlbums);
        $this->set(compact('idAlbumPiktoo','idPageFacebook','tokenPageFacebook','namePageFacebook','intervalles'));
        $this->set('title', "Connexion à facebook");
        
        
        $facebookAuto = $this->FacebookAutos->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $isCreation = $this->request->getData('is_creation');
            if($isCreation){
                $newNameAlbum = $this->request->getData('new_album_name');
                if(empty($newNameAlbum)){
                    $this->Flash->error(__('Le nom du nouvel album ne peut pas être vide.'));
                    return;
                }
                $newAlbumDesc = $this->request->getData('new_album_description');
                
                $data['name_album_in_facebook']  = $newNameAlbum;
                $albumNew = $this->Facebook->addAlbum($tokenPageFacebook,$idPageFacebook,$newNameAlbum,$newAlbumDesc);
                if(empty($albumNew['id'])){
                    $this->Flash->error(__('Une erreur s\'est produite. Veuillez réessayer.'));
                    return;
                }else{
                  $data['id_album_in_facebook'] = $albumNew['id']; 
                }
                
            }
            $facebookAuto = $this->FacebookAutos->patchEntity($facebookAuto, $data);
            if ($this->FacebookAutos->save($facebookAuto)) {
               // $this->loadComponent('Crontab');
               // $cronTextToEdit = "*/7 * * * * cd /home/event/public_html/ && bin/cake AutoPostFacebook postByIdFacebookAuto ".$facebookAuto->id;
                //$this->Crontab->addJob($cronTextToEdit);
                        
                $this->Flash->success(__('Configuration ajoutée avec succès.'));

                return $this->redirect(['action' => 'liste',$facebookAuto->evenement_id]);
            }
            $this->Flash->error(__('The facebook auto could not be saved. Please, try again.'));
        }
        
        if(!empty($idEvenement)){
            $evenement = $this->FacebookAutos->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        }
        //debug($facebookAuto); die;
        $evenements = $this->FacebookAutos->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('facebookAuto', 'evenements','evenement','idEvenement'));
        $this->set('isConfiguration',true);    
        
    
    }

//    /**
//     * Add method
//     *
//     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
//     */
//    public function addOld($idEvenement = null)
//    {
//        if(!empty($idEvenement)){
//            $evenement = $this->FacebookAutos->Evenements->get($idEvenement);
//        }
//        $facebookAuto = $this->FacebookAutos->newEntity();
//        if ($this->request->is('post')) {
//            $facebookAuto = $this->FacebookAutos->patchEntity($facebookAuto, $this->request->getData());
//            if ($this->FacebookAutos->save($facebookAuto)) {
//                $this->Flash->success(__('The facebook auto has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The facebook auto could not be saved. Please, try again.'));
//        }
//        $evenements = $this->FacebookAutos->Evenements->find('list', ['limit' => 200]);
//        $this->set(compact('facebookAuto', 'evenements','evenement','idEvenement'));
//    }

    /**
     * Edit method
     *
     * @param string|null $id Facebook Auto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
//    public function edit($id = null)
//    {
//        $facebookAuto = $this->FacebookAutos->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $facebookAuto = $this->FacebookAutos->patchEntity($facebookAuto, $this->request->getData());
//            if ($this->FacebookAutos->save($facebookAuto)) {
//                $this->Flash->success(__('The facebook auto has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The facebook auto could not be saved. Please, try again.'));
//        }
//        $evenements = $this->FacebookAutos->Evenements->find('list', ['limit' => 200]);
//        $this->set(compact('facebookAuto', 'evenements'));
//    }

    /**
     * Delete method
     *
     * @param string|null $id Facebook Auto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($idEvenement, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facebookAuto = $this->FacebookAutos->get($id);
        if ($this->FacebookAutos->delete($facebookAuto)) {
           
            switch ($facebookAuto->intervalle_id) {
                    case 1: // 5 mn
                        $cronText ="*/5 * * * *";
                        break;
                    case 2: // 10 mn
                        $cronText = "*/10 * * * *";
                        break;
                    case 3: // 30 mn
                        $cronText = "*/30 * * * *";
                        break;
                    case 4: // 1h
                        $cronText = "0 */1 * * *";
                        break;
            }

            if(!empty($cronText)){
                $cronTextToEdit = $cronText.' cd ' .Configure::read('chemin_public_html').' && bin/cake AutoPostFacebook postByIdFacebookAuto '.$facebookAuto->id;
                $this->loadComponent('Crontab');
                $this->Crontab->removeJob($cronTextToEdit);
            }
             
            
            
            $this->Flash->success(__('The facebook auto has been deleted.'));
        } else {
            $this->Flash->error(__('The facebook auto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste', $facebookAuto->evenement_id]);
    }
}
