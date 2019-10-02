<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File; 
use Cake\Core\Configure;
/**
 * PageSouvenirs Controller
 *
 * @property \App\Model\Table\PageSouvenirsTable $PageSouvenirs
 *
 * @method \App\Model\Entity\PageSouvenir[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PageSouvenirsController extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['uploadImgBanniere', 'add'])) {
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
   /* public function index()
    {
        $pageSouvenirs = $this->paginate($this->PageSouvenirs);

        $this->set(compact('pageSouvenirs'));
    }
*/
    /**
     * View method
     *
     * @param string|null $id Page Souvenir id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function view($id = null)
    {
        $pageSouvenir = $this->PageSouvenirs->get($id, [
            'contain' => ['Evenements']
        ]);

        $this->set('pageSouvenir', $pageSouvenir);
    }*/

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $defaultCouleurFond = "";
        $defaultCouleurDownloadLink = "";
        $pageSouvenir = $this->PageSouvenirs->newEntity();
        if(!empty($idEvenement)){
            $evenement = $this->PageSouvenirs->Evenements->get($idEvenement,['contain'=>['Galeries',"Fonctionnalites"]]);
            $pageSouvenirFind = $this->PageSouvenirs->find('all',
             ['contain'=>['Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins']]
            ])->where(['evenement_id'=>$idEvenement])->first();
            if($pageSouvenirFind){
                $pageSouvenir = $pageSouvenirFind;
            }else{
                 $role = $this->Auth->user('role_id');
                 if($role == 2){
                    $this->loadModel('ClientsCustoms');
                    $clientInSession = $this->Auth->user('client_id');
                    $defaultPageSouvenir = $this->ClientsCustoms->find('all')->where(['client_id'=>$clientInSession])->first();
                    if($defaultPageSouvenir){
                        $defaultCouleurFond = $defaultPageSouvenir->ps_couleur_de_fond;
                        $defaultCouleurDownloadLink = $defaultPageSouvenir->ps_couleur_download_link;
                    }
                 }   
            }
        }
        
        //debug($defaultPageSouvenir); die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            // debug($data);die;
            //Image Bannière
            $fileData = $data['imagebaniere_file'];
            if (!empty($fileData) && !empty($fileData['name'])) {
                $res = $this->uploadImgBanniere($idEvenement,$fileData);
                if($res['success']){
                    $data['img_banniere'] = $res['filename'];
                }else{
                    $data['img_banniere'] = "";
                }
            }elseif(empty($data['img_banniere'])){
                $data['img_banniere'] = "";
            }
			
            //Image bandeau
            $fileData = $data['imagebandeau_file'];
            if (!empty($fileData) && !empty($fileData['name'])) {
                $res = $this->uploadImgBanniere($idEvenement,$fileData, true);
                if($res['success']){
                    $data['img_bandeau'] = $res['filename'];
                }else{
                    $data['img_bandeau'] = "";
                }
            }elseif(empty($data['img_bandeau'])){
                $data['img_bandeau'] = "";
            }
			
			// Compatibilité url vidéo au navigateur
			if(!empty($data['url_video']) && trim($data['url_video']) != ''){
				
				// Youtube video
				$data['url_video'] = str_replace("watch?v=", "embed/", trim($data['url_video']));
				// Dailymotion video
				$pos = strpos(trim($data['url_video']), 'dailymotion.com/embed');
				if($pos === false){
					$data['url_video'] = str_replace("dailymotion.com", "dailymotion.com/embed", trim($data['url_video']));
				}
				// Vimeo video
				$pos = strpos(trim($data['url_video']), 'player.vimeo.com/video');
				if($pos === false){
					$data['url_video'] = str_replace("vimeo.com", "player.vimeo.com/video", trim($data['url_video']));
				}
				
			}    

            $pageSouvenir = $this->PageSouvenirs->patchEntity($pageSouvenir, $data, ['associated'=>['Champs', 'Champs.ChampOptions']]);
            $pageSouvenir = $this->PageSouvenirs->save($pageSouvenir);
            
            if ($pageSouvenir) {
              $rsConfiguration = $this->PageSouvenirs->RsConfigurations->newEntity();
              if ($rsConfigurationFinded = $this->PageSouvenirs->RsConfigurations->findByPageSouvenirIdAndEvenementId($pageSouvenir->id, $idEvenement)->first()) {
                  $rsConfiguration = $rsConfigurationFinded;
              }

              $save = $data['rs_configuration'];
              $save['evenement_id'] = $idEvenement;
              $save['page_souvenir_id'] = $pageSouvenir->id;

              $pageSouvenir = $this->PageSouvenirs->RsConfigurations->patchEntity($rsConfiguration, $save, ['validate' => false]);

              if(!$rsConfiguration->errors()) {
                    $this->PageSouvenirs->RsConfigurations->save($rsConfiguration);
              }

              $this->Flash->success(__('The page souvenir has been saved.'));

              return $this->redirect(['action' => 'add', $pageSouvenir->evenement_id ]);
            }
            $this->Flash->error(__('The page souvenir could not be saved. Please, try again.'));
        }
        $evenements = $this->PageSouvenirs->Evenements->find('list',['valueField'=>'nom']);

        $this->loadModel('EmailConfigurations');
        $emailConfiguration = $this->EmailConfigurations->find()->where(['evenement_id'=>$idEvenement])->first();
        
        if (isset($emailConfiguration->evenement_id)) {
            $urlSouvenir = Configure::read('url_front_domaine').'t/'.$emailConfiguration->evenement_id;
        }

        //========================== 
        $this->loadModel('TypeChamps');
        $typeChamps = $this->TypeChamps->find('list',['valueField' => 'nom'])->where(['id !=' => 3]);
        
        $this->loadModel('TypeDonnees');
        $typeDonnees = $this->TypeDonnees->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeOptins');
        $typeOptins = $this->TypeOptins->find('list',['valueField'=>'titre']);
        $this->set(compact('typeChamps', 'typeDonnees', 'typeOptins', 'urlSouvenir'));
        //================================
        $this->set(compact('pageSouvenir','idEvenement','evenements','evenement','defaultCouleurFond','defaultCouleurDownloadLink'));
        $this->set('isConfiguration',true);
    }
    
    private function uploadImgBanniere($idEvenement, $fileData, $is_bandeau = false) {
        $this->loadComponent("RegenerateImage");
        //debug($fileData);die;
        $res['success'] = false;
		$dos_parent = $is_bandeau ? 'bandeau' : 'head';
		$width = $is_bandeau ? 1280 : 1100;
        if (!empty($fileData['name'])) {
           $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);
            if (in_array($extension, array('jpg', 'jpeg', 'png'))) {
                $filename         = Text::uuid().'.'. $extension;
                $destination      = WWW_ROOT . 'import'.DS.'galleries'.DS. $dos_parent . DS . $idEvenement . DS ;
                if(is_dir($destination)){
                    $dir              = new Folder($destination);
                    $dir->delete();
                }     
                $dir              = new Folder($destination, true, 0755);
                $destinationPath = $dir->pwd() . DS . $filename;
                //debug($fileData);
                if(move_uploaded_file($fileData['tmp_name'], $destinationPath)){
                    $destinationFile   = WWW_ROOT . 'import'.DS.'galleries'.DS. $dos_parent . DS . $idEvenement . DS . "crop_" . $filename;
                    $this->RegenerateImage->_image_quality = $extension;
                    $this->RegenerateImage->resize($destinationPath,$destinationFile,$width,150);
					
					if($is_bandeau){
						// Création thumbnails pour un bandeau
						$destinationFileThumb   = WWW_ROOT . 'import'.DS.'galleries'.DS. $dos_parent . DS . $idEvenement . DS . "thumb_" . $filename;
						$this->RegenerateImage->_image_quality = $extension;
						$this->RegenerateImage->resize($destinationPath,$destinationFileThumb,400,150);
					}
					
                    $res['success'] = true;
                    $res['filename'] = $filename;
                }
            }
        }
        return $res;
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Souvenir id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
   /* public function edit($id = null)
    {
        $pageSouvenir = $this->PageSouvenirs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pageSouvenir = $this->PageSouvenirs->patchEntity($pageSouvenir, $this->request->getData());
            if ($this->PageSouvenirs->save($pageSouvenir)) {
                $this->Flash->success(__('The page souvenir has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page souvenir could not be saved. Please, try again.'));
        }
        $this->set(compact('pageSouvenir'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Souvenir id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     *
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageSouvenir = $this->PageSouvenirs->get($id);
        if ($this->PageSouvenirs->delete($pageSouvenir)) {
            $this->Flash->success(__('The page souvenir has been deleted.'));
        } else {
            $this->Flash->error(__('The page souvenir could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
