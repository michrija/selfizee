<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use Cake\Collection\Collection;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\I18n\Date;
use Cake\I18n\Time;
use ZipArchive;

/**
 * ConfigurationBornes Controller
 *
 * @property \App\Model\Table\ConfigurationBornesTable $ConfigurationBornes
 *
 * @method \App\Model\Entity\ConfigurationBorne[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigurationBornesController extends AppController
{
    public $paginate = array(
		'limit' => 20,
		'page' => 1
	);
	
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if(in_array($action, ["add","uploadEcran" ,"toDuplicate", "uploadCadreSimple", "uploadMultipleCadre", "uploadFondVert","uploadMiseEnPageAll","deleteCadre","generateConfig","recapitulatif"])) {
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
        
        if(in_array($action,['uploadEcran',''])){
            return true;
        }
        // Par défaut, on refuse l'accès.
        return parent::isAuthorized($user);
    }
    
	public function maile(){
		
	}
	
    
    public function toDuplicate($idEvenement){
        if ($this->request->is('post')) {
            $configurationToCopy = $this->request->getData('configuration_borne_id');
            return $this->redirect(['action' => 'add',$idEvenement, $configurationToCopy]);
        }
    }

	public function editeurTemplate($idEvenement = null){
		$evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites','EvenementCreas']]);
		$this->viewBuilder()->setLayout('editeur');
		
		$domaine = Configure::read('url_admin_domaine');
		
		// Liste des menus et sous-menus classés par 20
		$this -> loadModel('EditeurTemplates');
		$this -> loadModel('EditeurTemplatesPhotos');
		$editeurTemplates = $this->EditeurTemplates->find('list', ['valueField' => 'titre_menu', 'groupField'=>'type_menu'])->toArray();
		
		$editeurPhotos = [];
		if(!empty($editeurTemplates)){
			// Parcours des photos par blocs de 20 des editeur_templates(fonds, elements, contours)
			foreach($editeurTemplates as $editeur_item){
				foreach($editeur_item as $id => $item){
					$this -> paginate['conditions'] = [
						'editeur_template_id' => $id
					];
					$this -> paginate['contain'] = ['EditeurTemplates'];
					$editeurphotos_bd = $this -> paginate($this->EditeurTemplatesPhotos);
					$editeurPhotos[$id] = $editeurphotos_bd;
				}
			}
		}
		$tags = $this->EditeurTemplatesPhotos->Tags->find('list',['valueField'=>'nom']);
		
		$this -> set(compact('evenement', 'idEvenement', 'domaine', 'editeurTemplates', 'editeurPhotos', 'tags'));
	}
	
	public function enregistrementAuto(){
		$this -> autoRender = false;
		$error = 0;
		if(!empty($this -> request -> getData('idEvenement')) && !empty($this -> request -> getData('canvas_elements'))){
			// Vérifier si l'editeur est modifier par quelqu'un d'autre
			$idEvenement = $this -> request -> getData('idEvenement');
			$this -> loadModel('Evenements');
			$this -> loadModel('EvenementCreas');
			$evenement = $this->Evenements->get($idEvenement, ['contain' => ['EvenementCreas']]);
			
			// Si la crea n'existe pas encore on enregistre
			if(empty($evenement->evenement_crea)){
				$save = [
					'evenement_id' => $idEvenement,
					'canvas_elements' => $this -> request -> getData('canvas_elements')
				];
				$evt_creas = $this->EvenementCreas->newEntity();
				$res = $this->EvenementCreas->patchEntity($evt_creas, $save);
				$this->EvenementCreas->save($res);
				
				$event_update = ['is_lock_crea' => true];
				$evt = $this -> Evenements -> patchEntity($evenement, $event_update);
				$this->Evenements->save($evt);
			}
			// Sinon
			else{
				$evt_creas = $this->EvenementCreas->get($evenement->evenement_crea->id);
				$save = [
					'canvas_elements' => $this -> request -> getData('canvas_elements')
				];
				$res = $this->EvenementCreas->patchEntity($evt_creas, $save);
				$this->EvenementCreas->save($res);
			}
			$error = 1;
		}
		
		echo json_encode($error);
	}
	
	// Export et download creas
	public function exportCreas(){
		$this -> autoRender = false;
		$retour = false;
		
		if(!empty($this -> request -> getData())){
			$idEvenement = $this -> request -> getData('idEvenement');
			
			if($idEvenement){
				$evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['EvenementCreas']]);
				if(!empty($evenement) && !empty($evenement->evenement_crea)){
					$dataPng = $this -> request -> getData('dataPng');
					$dataJpg = $this -> request -> getData('dataJpg');
					
					$file_put_content = trim($evenement->evenement_crea->file_put_content);
					$fichier_png = $evenement->evenement_crea->get('file_png');
					if($file_put_content == ''){
						$file_put_content = Text::uuid();
						// Mise à jour table crea
						$this -> loadModel('EvenementCreas');
						$evt_creas = $this->EvenementCreas->get($evenement->evenement_crea->id);
						$save = [
							'file_put_content' => $file_put_content
						];
						$res = $this->EvenementCreas->patchEntity($evt_creas, $save);
						$this->EvenementCreas->save($res);
						$fichier_png .= $file_put_content.'.png';
					}
					
					$filePng = $file_put_content . '.png';
					$fileJpg = $file_put_content . '.jpg';

					$path_root = WWW_ROOT . 'import' . DS . 'config_bornes' . DS . $idEvenement . DS . 'creas';
					$targetFolder = new Folder($path_root, true, 0777);

					// remove "data:image/png;base64,"
					$uriJpg =  substr($dataJpg,strpos($dataJpg,",", 1));
					$uriPng =  substr($dataPng,strpos($dataPng,",", 1));

					// save to file
					file_put_contents($path_root . DS . $fileJpg, base64_decode($uriJpg));
					file_put_contents($path_root . DS . $filePng, base64_decode($uriPng));
					
					switch($this -> request -> getData('type_export')){
						// Sauvegarde dans un fichier
						case 'save':
							$retour = $fichier_png;
						break;
						// Téléchargement en pièce jointe
						case 'download':
							$this->response->file($evenement->evenement_crea->get('file_download_png'),array('download' => true, 'name' => $file_put_content.'.png'));
							return $this->response;
							exit;
						break;
					}
				}
			}
		}
		
		echo json_encode($retour);
	}
	
	// Liste des photos pour chaque sous categories éléments::photos, éléments::illustrations, fonds:photo, ...
	public function ajaxListePhoto(){
		$res = false;
		$photos = [];
		
		if(!empty($this -> request -> getData('editeur_tp_id')) && !empty($this -> request -> getData('tags'))){
			$this -> loadModel('EditeurTemplatesPhotos');
			$this->paginate = [
				'contain' => ['EditeurTemplates']
			];
			$this -> paginate['conditions'] = [
				'editeur_template_id' => $this -> request -> getData('editeur_tp_id')
			];
			$this -> paginate['finder'] = ['tags' => ['tag_id' => $this -> request -> getData('tags')]];
			
			$photos = $this -> paginate($this->EditeurTemplatesPhotos);
		}
		$this -> set(compact(['photos']));
	}
    
    public function addOld($idEvenement, $idtoCopy = null){
        $evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $configurationBorne = $this->ConfigurationBornes->newEntity();
        $configurationBorneInBase = $this->ConfigurationBornes->find()
                                                            ->contain(['TypeAnimations','ConfigurationAnimations'=>['Cadres'], 'Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins'],'FondVerts','Ecrans','Filtres'])
                                                            ->where(['evenement_id' => $idEvenement])
                                                            ->first();
        if(!empty($configurationBorneInBase)){
            $configurationBorne = $configurationBorneInBase;
        }
        
        if(!empty($idtoCopy) && $idtoCopy){
            $configurationBorne = $this->ConfigurationBornes->find()
                                                            ->contain(['TypeAnimations','ConfigurationAnimations'=>['Cadres'], 'Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins'],'FondVerts','Ecrans','Filtres'])
                                                            ->where(['ConfigurationBornes.id' => $idtoCopy])
                                                            ->first();
        }
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $data = $this->request->getData();
            //debug($data);die;

			// Cadre postal
			$tmp = [];
			if(!empty($data["configuration_animations"][0]["cadres"])){
				foreach($data["configuration_animations"][0]["cadres"] as $ordre => $cadre){
					if(isset($cadre['file_name']) && isset($cadre['file_name']) || isset($cadre['file_overlay']) && isset($cadre['file_overlay'])){
						$tmp[$ordre] = $cadre;
					}
				}
			}
			
			$data["configuration_animations"][0]["cadres"] = $tmp;
			
            //Cadre Mulipose
			// var_dump($data["configuration_animations"][1]["cadres"]);
			// exit;
            $fileDataMultipose = $this->request->getData("img_cadre_simpleMultipose");
            if (!empty($fileDataMultipose) && !empty($fileDataMultipose['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataMultipose);
                if($res['success']){
                    //$data ['cadres'][0]['file_name'] = $res['filename'];
                    $data["configuration_animations"][1]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
            //Cadre Bandelette
            $fileDataBandelette = $this->request->getData("img_cadre_simpleBandelette");
            if (!empty($fileDataBandelette) && !empty($fileDataBandelette['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataBandelette);
                if($res['success']){
                    $data["configuration_animations"][2]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
            //Cadre Polaroid
            $fileDataPolariod = $this->request->getData("img_cadre_simplePolaroid");
            if (!empty($fileDataPolariod) && !empty($fileDataPolariod['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataPolariod);
                if($res['success']){
                    $data["configuration_animations"][3]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
            //Cadre Animation fond vert
            $fileDataFondVert = $this->request->getData("img_cadre_simpleFondVert");
            if (!empty($fileDataFondVert) && !empty($fileDataFondVert['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataFondVert);
                if($res['success']){
                    $data["configuration_animations"][4]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
			
			/*
			 * début étape 5
			 */
			
            //Ecrans Accueil
            $fileDataImagedefondAccueil = $data['imagedefondAccueil'];
            if (!empty($fileDataImagedefondAccueil) && !empty($fileDataImagedefondAccueil['name']) && $fileDataImagedefondAccueil['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataImagedefondAccueil, "BG_ACCUEIL.jpg");
                if($res['success']){
                    $data['ecran']['page_accueil'] = $res['filename'];
                }   
            }
            
             //Boutton Accueil
            $fileBtnAccueil = $data['btnaccueil'];
            if (!empty($fileBtnAccueil) && !empty($fileBtnAccueil['name']) && $fileBtnAccueil['size']) {
                $res = $this->uploadEcran($idEvenement,$fileBtnAccueil, "bouton.png", ['png']);
                if($res['success']){
                    $data['ecran']['btn_page_accueil'] = $res['filename'];
                }   
            }
            
             //Page choix Configuraton
            $fileDataImagedefondChoixConf = !empty($data['imageDeChoixConfiguration']) ? $data['imageDeChoixConfiguration'] : [];
            if (!empty($fileDataImagedefondChoixConf) && !empty($fileDataImagedefondChoixConf['name']) && !empty($fileDataImagedefondChoixConf['size']) && $fileDataImagedefondChoixConf['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataImagedefondChoixConf, "BG_LAYOUT.jpg");
                //debug($res);
                if($res['success']){
                    $data['ecran']['page_choix_configuration'] = $res['filename'];
                }   
            }
            
            //Prise de photo
            $fileDataPrisePhoto = $data['imageDeFondPrisePhoto'];
            if (!empty($fileDataPrisePhoto) && !empty($fileDataPrisePhoto['name']) && $fileDataPrisePhoto['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataPrisePhoto, "BG_PRISE.jpg");
                //debug($res);
                if($res['success']){
                    $data['ecran']['page_prise_photo'] = $res['filename'];
                }   
            }
            
            //Visualisation
            $fileDataVisulisation = !empty($data['imageDeFondVisualisation']) ? $data['imageDeFondVisualisation'] : [];
            if (!empty($fileDataVisulisation) && !empty($fileDataVisulisation['name']) && !empty($fileDataVisulisation['size']) && $fileDataVisulisation['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataVisulisation, "BG_FOND.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_prise_photo_visualisation'] = $res['filename'];
                }   
            }
            
            //Filtre
            $fileDatachoixFiltre = !empty($data['choixFiltre']) ? $data['choixFiltre'] : [];
            if (!empty($fileDatachoixFiltre) && !empty($fileDatachoixFiltre['name']) && !empty($fileDatachoixFiltre['size']) && $fileDatachoixFiltre['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDatachoixFiltre, "BG_FILTRE.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_choix_filtre'] = $res['filename'];
                }   
            }
            
            //Remerciement
            $fileFondRemerciement = !empty($data['fondRemerciement']) ? $data['fondRemerciement'] : [];
            if (!empty($fileFondRemerciement) && !empty($fileFondRemerciement['name']) && !empty($fileFondRemerciement['size']) && $fileFondRemerciement['size']) {
                $res = $this->uploadEcran($idEvenement,$fileFondRemerciement, "BG_MERCI.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_remerciement'] = $res['filename'];
                }   
            }
			
            //Fond vert
            $fileFondFondVert = !empty($data['fondFondVert']) ? $data['fondFondVert'] : [];
            if (!empty($fileFondFondVert) && !empty($fileFondFondVert['name']) && $fileFondFondVert['size']) {
                $res = $this->uploadEcran($idEvenement,$fileFondFondVert, "BG_FOND_VERT.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_choix_fond_vert'] = $res['filename'];
                }   
            }
			
			// Parametrage avancé pour titre
			if(empty($data['ecran']['page_filtre_titre_avance'])){
				$data['ecran']['page_filtre_titre_avance'] = null;
			}
			// Pour toutes les pages
			if(empty($data['ecran']['choix_all_pages'])){
				$data['ecran']['choix_all_pages'] = null;
			}
			
			/*
			 * fin étape 5
			 */
            
			
            //debug($configurationBorne->type_animation);
            /*$configAnimationAGarder = $data['configuration_animations'][$configurationBorne->type_animation->id];
            $data['configuration_animations']= array();
            $data['configuration_animations'][$configurationBorne->type_animation->id]  = $configAnimationAGarder;*/
            
            // debug($data['ecran']);
            
            $configurationBorne = $this->ConfigurationBornes->patchEntity($configurationBorne, $data,[
                                                                'associated'=>['TypeAnimations', 'Champs','Champs.ChampOptions','Champs.CustomOptins','FondVerts','Ecrans','Filtres','ConfigurationAnimations','ConfigurationAnimations.Cadres']
                                                                ]);
            // debug($configurationBorne); die;
            if($this->ConfigurationBornes->save($configurationBorne)) {
                $this->Flash->success(__('The configuration borne has been saved.'));

                return $this->redirect(['action' => 'generateConfig', $idEvenement]);
            }else{
                $this->Flash->error(__('The configuration borne could not be saved. Please, try again.'));
                //debug($configurationBorne);
                //die;
            }
            
        }
        
        $typeAnimations = $this->ConfigurationBornes->TypeAnimations->find('list',['valueField' => 'nom']);
        
        $multiconfigurations = $this->ConfigurationBornes->ConfigurationAnimations->Multiconfigurations->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeChamps');
        $typeChamps = $this->TypeChamps->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeDonnees');
        $typeDonnees = $this->TypeDonnees->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeOptins');
        $typeOptins = $this->TypeOptins->find('list',['valueField'=>'titre']);
        
      
        $filtres = $this->ConfigurationBornes->Filtres->find('list',['valueField' => 'nom'])
                                                            ->where(['filtre_type' => 0]);
                                                            
        $filtreAvancees = $this->ConfigurationBornes->Filtres->find('list',['valueField' => 'nom'])
                                                            ->where(['filtre_type' => 1]);
        
        
        $modelBornes = $this->ConfigurationBornes->ModelBornes->find('list',['valueField' => 'nom']);
        
        $tailleEcrans = $this->ConfigurationBornes->TailleEcrans->find('list',['valueField' => 'valeur']);
        
        $typeImprimantes = $this->ConfigurationBornes->TypeImprimantes->find('list',['valueField' => 'nom']);
       
        
        $dispositionVignettes = $this->ConfigurationBornes->ConfigurationAnimations->DispositionVignettes->find('all');
        
        $listeEvenement = $this->ConfigurationBornes->Evenements->find('list',['valueField'=>'slug','keyField'=>'configuration_borne.id'])
                                                            ->contain(['ConfigurationBornes'])
                                                            ->matching('ConfigurationBornes');
        //debug($listeEvenement->toArray());die;
        
		$this -> loadModel('PageConfigFonds');
		$this -> loadModel('PageConfigBoutons');
		$this -> loadModel('PageConfigPolices');
		$config_fondpage = $this -> PageConfigFonds -> find('list',['valueField'=>'couleur','keyField'=>'id']);
		$config_boutons_tmp = $this -> PageConfigBoutons -> find('all');
		$config_bouton_options = $config_boutons = [];
		foreach($config_boutons_tmp as $config_bouton){
			$config_bouton_options[$config_bouton['id']] = trim($config_bouton['tag']) ? trim($config_bouton['tag']) : trim($config_bouton['fichier']);
			$config_boutons[$config_bouton['id']] = $config_bouton['fichier'];
		}
		
		$config_police = $this -> PageConfigPolices -> find('list',['valueField'=>'nom_police','keyField'=>'id']);
		$config_fontsize = [
			'20px' => '20px',
			'25px' => '25px',
			'30px' => '30px'
		];
		
		$config_margin = [];
		for($i = 0; $i <= 30; $i++){
			$value = $i + 10;
			$config_margin[$value.'px'] = $value.'px';
		}
		$this -> set(compact('config_fondpage', 'config_boutons', 'config_bouton_options', 'config_fontsize', 'config_police', 'config_margin'));
        
        $this->set(compact('idEvenement','evenement','configurationBorne', 'typeAnimations','multiconfigurations','typeChamps','typeDonnees','dispositionVignettes','filtres','modelBornes','typeImprimantes','tailleEcrans','filtreAvancees','listeEvenement','configurationBorneInBase','typeOptins'));
        $this->set('isConfiguration',true);
        $this->render('add_copy');
    }
    
	public function addNew0($idEvenement){
		$evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $configurationBorne = $this->ConfigurationBornes->newEntity();
        $configurationBorneInBase = $this->ConfigurationBornes->find()
                                                            ->contain(['TypeAnimations','ConfigurationAnimations'=>['Cadres'], 'Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins'],'FondVerts','Ecrans','Filtres'])
                                                            ->where(['evenement_id' => $idEvenement])
                                                            ->first();
        if(!empty($configurationBorneInBase)){
            $configurationBorne = $configurationBorneInBase;
        }
        
        if(!empty($idtoCopy) && $idtoCopy){
            $configurationBorne = $this->ConfigurationBornes->find()
                                                            ->contain(['TypeAnimations','ConfigurationAnimations'=>['Cadres'], 'Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins'],'FondVerts','Ecrans','Filtres'])
                                                            ->where(['ConfigurationBornes.id' => $idtoCopy])
                                                            ->first();
        }
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $data = $this->request->getData();
            // debug($data);die;

			// Cadre postal
			$tmp = [];
			if(!empty($data["configuration_animations"][0]["cadres"])){
				foreach($data["configuration_animations"][0]["cadres"] as $ordre => $cadre){
					if(isset($cadre['file_name']) && isset($cadre['file_name']) || isset($cadre['file_overlay']) && isset($cadre['file_overlay'])){
						$tmp[$ordre] = $cadre;
					}
				}
			}
			
			$data["configuration_animations"][0]["cadres"] = $tmp;
			
            //Cadre Mulipose
			// var_dump($data["configuration_animations"][1]["cadres"]);
			// exit;
            $fileDataMultipose = $this->request->getData("img_cadre_simpleMultipose");
            if (!empty($fileDataMultipose) && !empty($fileDataMultipose['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataMultipose);
                if($res['success']){
                    //$data ['cadres'][0]['file_name'] = $res['filename'];
                    $data["configuration_animations"][1]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
            //Cadre Bandelette
            $fileDataBandelette = $this->request->getData("img_cadre_simpleBandelette");
            if (!empty($fileDataBandelette) && !empty($fileDataBandelette['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataBandelette);
                if($res['success']){
                    $data["configuration_animations"][2]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
            //Cadre Polaroid
            $fileDataPolariod = $this->request->getData("img_cadre_simplePolaroid");
            if (!empty($fileDataPolariod) && !empty($fileDataPolariod['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataPolariod);
                if($res['success']){
                    $data["configuration_animations"][3]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
            //Cadre Animation fond vert
            $fileDataFondVert = $this->request->getData("img_cadre_simpleFondVert");
            if (!empty($fileDataFondVert) && !empty($fileDataFondVert['name'])) {
                $res = $this->uploadCadreSimple($idEvenement, $fileDataFondVert);
                if($res['success']){
                    $data["configuration_animations"][4]["cadres"][0]['file_name'] = $res['filename'];
                }   
            }
            
			
			/*
			 * début étape 5
			 */
			
            //Ecrans Accueil
            $fileDataImagedefondAccueil = $data['imagedefondAccueil'];
            if (!empty($fileDataImagedefondAccueil) && !empty($fileDataImagedefondAccueil['name']) && $fileDataImagedefondAccueil['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataImagedefondAccueil, "BG_ACCUEIL.jpg");
                if($res['success']){
                    $data['ecran']['page_accueil'] = $res['filename'];
                }   
            }
            
             //Boutton Accueil
            $fileBtnAccueil = $data['btnaccueil'];
            if (!empty($fileBtnAccueil) && !empty($fileBtnAccueil['name']) && $fileBtnAccueil['size']) {
                $res = $this->uploadEcran($idEvenement,$fileBtnAccueil, "bouton.png", ['png']);
                if($res['success']){
                    $data['ecran']['btn_page_accueil'] = $res['filename'];
                }   
            }
            
             //Page choix Configuraton
            $fileDataImagedefondChoixConf = !empty($data['imageDeChoixConfiguration']) ? $data['imageDeChoixConfiguration'] : [];
            if (!empty($fileDataImagedefondChoixConf) && !empty($fileDataImagedefondChoixConf['name']) && !empty($fileDataImagedefondChoixConf['size']) && $fileDataImagedefondChoixConf['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataImagedefondChoixConf, "BG_LAYOUT.jpg");
                //debug($res);
                if($res['success']){
                    $data['ecran']['page_choix_configuration'] = $res['filename'];
                }   
            }
            
            //Prise de photo
            $fileDataPrisePhoto = $data['imageDeFondPrisePhoto'];
            if (!empty($fileDataPrisePhoto) && !empty($fileDataPrisePhoto['name']) && $fileDataPrisePhoto['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataPrisePhoto, "BG_PRISE.jpg");
                //debug($res);
                if($res['success']){
                    $data['ecran']['page_prise_photo'] = $res['filename'];
                }   
            }
            
            //Visualisation
            $fileDataVisulisation = !empty($data['imageDeFondVisualisation']) ? $data['imageDeFondVisualisation'] : [];
            if (!empty($fileDataVisulisation) && !empty($fileDataVisulisation['name']) && !empty($fileDataVisulisation['size']) && $fileDataVisulisation['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDataVisulisation, "BG_FOND.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_prise_photo_visualisation'] = $res['filename'];
                }   
            }
            
            //Filtre
            $fileDatachoixFiltre = !empty($data['choixFiltre']) ? $data['choixFiltre'] : [];
            if (!empty($fileDatachoixFiltre) && !empty($fileDatachoixFiltre['name']) && !empty($fileDatachoixFiltre['size']) && $fileDatachoixFiltre['size']) {
                $res = $this->uploadEcran($idEvenement,$fileDatachoixFiltre, "BG_FILTRE.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_choix_filtre'] = $res['filename'];
                }   
            }
            
            //Remerciement
            $fileFondRemerciement = !empty($data['fondRemerciement']) ? $data['fondRemerciement'] : [];
            if (!empty($fileFondRemerciement) && !empty($fileFondRemerciement['name']) && !empty($fileFondRemerciement['size']) && $fileFondRemerciement['size']) {
                $res = $this->uploadEcran($idEvenement,$fileFondRemerciement, "BG_MERCI.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_remerciement'] = $res['filename'];
                }   
            }
			
            //Fond vert
            $fileFondFondVert = !empty($data['fondFondVert']) ? $data['fondFondVert'] : [];
            if (!empty($fileFondFondVert) && !empty($fileFondFondVert['name']) && $fileFondFondVert['size']) {
                $res = $this->uploadEcran($idEvenement,$fileFondFondVert, "BG_FOND_VERT.jpg");
                //debug($res); die;
                if($res['success']){
                    $data['ecran']['page_choix_fond_vert'] = $res['filename'];
                }   
            }
			
			// Parametrage avancé pour titre
			if(empty($data['ecran']['page_filtre_titre_avance'])){
				$data['ecran']['page_filtre_titre_avance'] = null;
			}
			// Pour toutes les pages
			if(empty($data['ecran']['choix_all_pages'])){
				$data['ecran']['choix_all_pages'] = null;
			}
			
			/*
			 * fin étape 5
			 */
            
			
            //debug($configurationBorne->type_animation);
            /*$configAnimationAGarder = $data['configuration_animations'][$configurationBorne->type_animation->id];
            $data['configuration_animations']= array();
            $data['configuration_animations'][$configurationBorne->type_animation->id]  = $configAnimationAGarder;*/
            
            // debug($data['ecran']);
            
            $configurationBorne = $this->ConfigurationBornes->patchEntity($configurationBorne, $data,[
                                                                'associated'=>['TypeAnimations', 'Champs','Champs.ChampOptions','Champs.CustomOptins','FondVerts','Ecrans','Filtres','ConfigurationAnimations','ConfigurationAnimations.Cadres']
                                                                ]);
            // debug($configurationBorne); die;
            if($this->ConfigurationBornes->save($configurationBorne)) {
                $this->Flash->success(__('The configuration borne has been saved.'));

                return $this->redirect(['action' => 'generateConfig', $idEvenement]);
            }else{
                $this->Flash->error(__('The configuration borne could not be saved. Please, try again.'));
                //debug($configurationBorne);
                //die;
            }
            
        }
        
        $typeAnimations = $this->ConfigurationBornes->TypeAnimations->find('list',['valueField' => 'nom']);
        
        $multiconfigurations = $this->ConfigurationBornes->ConfigurationAnimations->Multiconfigurations->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeChamps');
        $typeChamps = $this->TypeChamps->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeDonnees');
        $typeDonnees = $this->TypeDonnees->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeOptins');
        $typeOptins = $this->TypeOptins->find('list',['valueField'=>'titre']);
        
      
        $filtres = $this->ConfigurationBornes->Filtres->find('list',['valueField' => 'nom'])
                                                            ->where(['filtre_type' => 0]);
                                                            
        $filtreAvancees = $this->ConfigurationBornes->Filtres->find('list',['valueField' => 'nom'])
                                                            ->where(['filtre_type' => 1]);
        
        
        $modelBornes = $this->ConfigurationBornes->ModelBornes->find('list',['valueField' => 'nom']);
        
        $tailleEcrans = $this->ConfigurationBornes->TailleEcrans->find('list',['valueField' => 'valeur']);
        
        $typeImprimantes = $this->ConfigurationBornes->TypeImprimantes->find('list',['valueField' => 'nom']);
       
        
        $dispositionVignettes = $this->ConfigurationBornes->ConfigurationAnimations->DispositionVignettes->find('all');
        
        $listeEvenement = $this->ConfigurationBornes->Evenements->find('list',['valueField'=>'slug','keyField'=>'configuration_borne.id'])
                                                            ->contain(['ConfigurationBornes'])
                                                            ->matching('ConfigurationBornes');
        //debug($listeEvenement->toArray());die;
        
		$this -> loadModel('PageConfigFonds');
		$this -> loadModel('PageConfigBoutons');
		$this -> loadModel('PageConfigPolices');
		$config_fondpage = $this -> PageConfigFonds -> find('list',['valueField'=>'couleur','keyField'=>'id']);
		$config_boutons_tmp = $this -> PageConfigBoutons -> find('all');
		$config_bouton_options = $config_boutons = [];
		foreach($config_boutons_tmp as $config_bouton){
			$config_bouton_options[$config_bouton['id']] = trim($config_bouton['tag']) ? trim($config_bouton['tag']) : trim($config_bouton['fichier']);
			$config_boutons[$config_bouton['id']] = $config_bouton['fichier'];
		}
		
		$config_police = $this -> PageConfigPolices -> find('list',['valueField'=>'nom_police','keyField'=>'id']);
		$config_fontsize = [
			'20px' => '20px',
			'25px' => '25px',
			'30px' => '30px'
		];
		
		$config_margin = [];
		for($i = 0; $i <= 30; $i++){
			$value = $i + 10;
			$config_margin[$value.'px'] = $value.'px';
		}
		$this -> set(compact('config_fondpage', 'config_boutons', 'config_bouton_options', 'config_fontsize', 'config_police', 'config_margin'));
        
        $this->set(compact('idEvenement','evenement','configurationBorne', 'typeAnimations','multiconfigurations','typeChamps','typeDonnees','dispositionVignettes','filtres','modelBornes','typeImprimantes','tailleEcrans','filtreAvancees','listeEvenement','configurationBorneInBase','typeOptins'));
        $this->set('isConfiguration',true);
    }
	
    public function uploadEcran($idEvenement,$fileData, $fileNameDestination, $autorisedExtension = array('jpg', 'jpeg')){
        
        $res['success'] = false;
        if (!empty($fileData['name'])) {
           $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);
           //debug($extension);
            if (in_array($extension, $autorisedExtension)) {
                $filename         = $fileNameDestination;
                $destination = WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS;    
                $dir              = new Folder($destination, true, 0755);
                $destinationPath = $dir->pwd() . DS . $filename;
                //debug($fileData);
                if(move_uploaded_file($fileData['tmp_name'], $destinationPath)){
                    $res['success'] = true;
                    $res['filename'] = $filename;
                }
            }
        }
        return $res;
    }
    
    
    public function uploadCadreSimple($idEvenement,$fileData){
        
        $res['success'] = false;
        if (!empty($fileData['name'])) {
           $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);
            if (in_array($extension, array('jpg', 'jpeg', 'png'))) {
                $filename         = Text::uuid().'.'. $extension;
                $destination = WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS;
               /* if(is_dir($destination)){
                    $dir              = new Folder($destination);
                    $dir->delete();
                } */    
                $dir              = new Folder($destination, true, 0755);
                $destinationPath = $dir->pwd() . DS . $filename;
                //debug($fileData);
                if(move_uploaded_file($fileData['tmp_name'], $destinationPath)){
                    $res['success'] = true;
                    $res['filename'] = $filename;
                }
            }
        }
        return $res;
    }
    
    public function uploadMultipleCadre($idEvenement){
        $this->autoRender = false; // We don't render a view
        $res["success"] = false;
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            //$destination = UPLOAD_TMP . DS . $idEvenement;
            $destination = WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS;
            $dir         = new Folder($destination, true, 0755);
           
            ///debug($file);die;
             
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;

                if(move_uploaded_file($tmp, $destination_path)){
                    $res["success"] = true;
                    $res["name"] = $filename;
                }
            }
        }
        echo json_encode($res);
    }
    
    
    public function uploadFondVert($idEvenement){
        $this->autoRender = false; // We don't render a view
        $res["success"] = false;
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            //$destination = UPLOAD_TMP . DS . $idEvenement;
            $destination = WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS;
            $dir         = new Folder($destination, true, 0755);
           
            ///debug($file);die;
             
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;

                if(move_uploaded_file($tmp, $destination_path)){
                    $res["success"] = true;
                    $res["name"] = $filename;
                }
            }
        }
        echo json_encode($res);
        
    }
    
    
    public function uploadMiseEnPageAll($idEvenement){
        $this->autoRender = false; // We don't render a view
        $res["success"] = false;
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            //$destination = UPLOAD_TMP . DS . $idEvenement;
            $destination = WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS;
            $dir         = new Folder($destination, true, 0755);
           
            ///debug($file);die;
             
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;

                if(move_uploaded_file($tmp, $destination_path)){
                    $res["success"] = true;
                    $res["name"] = $filename;
                }
            }
        }
        echo json_encode($res);
    }
	
    /*
	 * Début
	 * Projet : modification dépots cadres + overlay
	 * url : https://trello.com/c/v8rydwoN/347-modification-d%C3%A9pots-cadres-overlay
	 * date de modification : 13-fév-2019
	 * 
	 * author: Paul
	 */
	// Ajax pour suppression fichier uploader
	public function deleteCadre($idEvenement){
		$this->autoRender = false;
		$result = false;
		if($this->request->is('ajax') && isset($this -> request -> data['file'])){
			$file = $this -> request -> data['file'];
			@unlink(WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS.$file);
			$result = true;
		}
		echo json_encode($result);
	}
	// Function pour upload overlay
	public function uploadMultipleCadreOverlay($idEvenement){
        $this->autoRender = false;
        $res["success"] = false;
        if ($this->request->is('ajax')) {
            $file   = $this->request->getData("file");
            $destination = WWW_ROOT."import".DS."config_bornes".DS.$idEvenement.DS."cadres".DS;
            $dir         = new Folder($destination, true, 0755);
             
            if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = 'overlay-'.Text::uuid()."." . $extension;
                $destination_path = $dir->pwd() . DS . $filename;

                if(move_uploaded_file($tmp, $destination_path)){
                    $res["success"] = true;
                    $res["name"] = $filename;
                }
            }
        }
        echo json_encode($res);
    }
	/*
	 * Fin 
	 */
	
    public function generateConfig($idEvenement){
                
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement);
        
        $this->loadModel('OptionBornes');
        $optionBorne = $this->OptionBornes->find()
                                            ->last();
        
        $configurationBorne = $this->ConfigurationBornes->find()
                                                            ->contain(['TypeAnimations','ConfigurationAnimations'=>['Cadres'], 'Champs'=>['TypeChamps','TypeDonnees','ChampOptions'],'FondVerts','Ecrans','Filtres'])
                                                            ->where(['evenement_id' => $idEvenement])
                                                            ->first();
        
        //$settings = new Folder(Configure::read('destination_config_borne').$idEvenement.DS."Settings".DS, true, 0755);
        
        
        if(!empty($optionBorne)){
            //dossier bornes
        
            $content = $optionBorne->fichier_setting_base;
            if(!empty($content)){
                $content = str_replace('[[idEvenement]]', $idEvenement, $content);
                $content = str_replace('[[dossierEvenement]]', $optionBorne->chemin_dossier_events, $content);
                $content = str_replace('[[dossier_assets]]', $optionBorne->chemin_dossier_assets, $content);
                //[[chemin_dossier_presets]]
                $content = str_replace('[[chemin_dossier_presets]]', $optionBorne->chemin_dossier_presets, $content);
                
                //FTPServer=[[FTPServer]]
                $content = str_replace('[[FTPServer]]', $optionBorne->ftp_server, $content);
                //FTPUsername=[[FTPUsername]]
                $content = str_replace('[[FTPUsername]]', $optionBorne->ftp_username, $content);
                //FTPPassword=[[FTPPassword]]
                $content = str_replace('[[FTPPassword]]', $optionBorne->ftp_password, $content);
                 //ftp_port
                $port = !empty($optionBorne->ftp_port) ? $optionBorne->ftp_port : "21";
                $content = str_replace('[[FTPPort]]',$port, $content);
                
                //[[FTPDirectory]]
                $content = str_replace('[[FTPDirectory]]','/'.$idEvenement.'/', $content);
                
                //enableFTP
                $enableFTP = 0;
                if(!empty($optionBorne->ftp_server) && !empty($optionBorne->ftp_username) && !empty($optionBorne->ftp_password)
                    && !empty($optionBorne->ftp_password) && !empty($optionBorne->ftp_port)
                ){
                    $enableFTP = 1;
                }
                $content = str_replace('[[enableFTP]]',$enableFTP, $content);
                
                if(!empty($configurationBorne)){
                    
                    $settings = new Folder(Configure::read('destination_config_borne')."b".$configurationBorne->num_borne.DS."files".DS."_Settings".DS, true, 0755);
         
                    //Copie Fichier
                    $this->copieFichier($configurationBorne);
                    
                    
                    //[[presetName]]
                    $preseFileName = "";
                    if($configurationBorne->type_animation_id == 1){ // Cadre postal
                        $preseFileName = "1-CADRE.preset";
                    }else if($configurationBorne->type_animation_id == 2){ // Cadre postal multipose
                        if(!empty($configurationBorne->configuration_animations[1])){
                            $nbrPose = $configurationBorne->configuration_animations[1]->nbr_pose;
                            if($nbrPose == 2){
                                if($configurationBorne->configuration_animations[1]->disposition_vignette_id == 2){
                                     $preseFileName = "2-MULTI-2SHOT-BAS.preset";
                                }else if($configurationBorne->configuration_animations[1]->disposition_vignette_id == 3){
                                    $preseFileName = "3-MULTI-2SHOT-HAUT.preset";
                                }else if($configurationBorne->configuration_animations[1]->disposition_vignette_id == 4){
                                    $preseFileName = "4-MULTI-2SHOT-GAUCHE.preset";
                                }else if($configurationBorne->configuration_animations[1]->disposition_vignette_id == 5){
                                    $preseFileName = "5-MULTI-2SHOT-DROIT.preset";
                                }
                            }else if($nbrPose == 3){
                                if($configurationBorne->configuration_animations[1]->disposition_vignette_id == 6
                                    || $configurationBorne->configuration_animations[1]->disposition_vignette_id == 7
                                    || $configurationBorne->configuration_animations[1]->disposition_vignette_id == 10
                                ){
                                    $preseFileName = "6-MULTI-3SHOT-GAUCHE.preset";
                                }else if($configurationBorne->configuration_animations[1]->disposition_vignette_id == 8
                                    || $configurationBorne->configuration_animations[1]->disposition_vignette_id == 9){
                                    $preseFileName = "7-MULTI-3SHOT-DROIT.preset";
                                }
                            }
                            
                        }
                    }else if($configurationBorne->type_animation_id == 3){ // Bandelette
                          if($nbrPose == 3){
                             $preseFileName = "8-BANDELETTE-RECTANGULAIRE.preset";
                          }else if($nbrPose == 4){
                             $preseFileName = "11-BANDELETTE-CARREE.preset";
                          }
                    }else if($configurationBorne->type_animation_id == 4){
                        
                    }
                    $content = str_replace('[[presetName]]', $preseFileName, $content);
                    
                    //[[enableFilters]]
                    $enableFiltersValue = intval($configurationBorne->is_filtre);
                    $content = str_replace('[[enableFilters]]', $enableFiltersValue, $content);
                    
                    
                    $collection = new Collection($configurationBorne->filtres);
                    $idFiltreActiveExtrat = $collection->extract('id');
                    $idFiltreActive = $idFiltreActiveExtrat->toList();

                    $filtreActive = array();
                    for($i=1; $i<19; $i++ ){
                            $activeValue = 0;
                            if(in_array($i, $idFiltreActive)){
                                $activeValue = 1;
                            }
                            $filtreActive[] = "enableFilter".$i."=".$activeValue;
                    }
                    $filtreActiveText = implode("\n",$filtreActive);
                    $content = str_replace('[[filtres]]', $filtreActiveText, $content);
                    
                    
                    $enablePrintValue = intval($configurationBorne->is_impression);
                    $content = str_replace('[[enablePrint]]', $enablePrintValue, $content);
                    
                    $maxPrintsPerEvent = !empty($configurationBorne->nbr_max_photo) ? $configurationBorne->nbr_max_photo:0;
                    $content = str_replace('[[maxPrintsPerEvent]]', $maxPrintsPerEvent, $content);
                    
                    $printingText= !empty($configurationBorne->texte_impression) ? $configurationBorne->texte_impression : "Impression...";
                    $content = str_replace('[[printingText]]', $printingText, $content);
                    
                    //[limitPrintButton]] //[maxNumPrints]] en attente de reposne
                   
                    $content = str_replace('[[limitPrintButton]]', intval($configurationBorne->is_multi_impression), $content);
                    
                    $maxNumPrints = $configurationBorne->nbr_max_multi_impression;
                    $content = str_replace('[[maxNumPrints]]', $maxNumPrints, $content);
                     
                    //[[AutoPrint]]
                    $autoPrintValue = intval($configurationBorne->is_impression_auto);
                    $content = str_replace('[[AutoPrint]]', $autoPrintValue, $content);
                    
                    //surveySessionTime
                    $content = str_replace('[[surveySessionTime]]', $configurationBorne->decompte_time_out, $content);
                    
                    //enableSurvey
                    $enableSurveyValue = intval($configurationBorne->is_prise_coordonnee);
                    $content = str_replace('[[enableSurvey]]', $enableSurveyValue, $content);
                    
                    //[[secBetweenPics]]
                    $content = str_replace('[[secBetweenPics]]', $configurationBorne->decompte_prise_photo, $content);
                    
                    //numCopies
                    $numCopies = !empty($configurationBorne->nbr_copie_impression_auto) ? $configurationBorne->nbr_copie_impression_auto : 1;
                    $content = str_replace('[[numCopies]]', $numCopies, $content);
                    
                    //sharingTimeout
                    $content = str_replace('[[sharingTimeout]]', $configurationBorne->decompte_time_out, $content);
                    
                    //allowRetakes
                    $content = str_replace('[[allowRetakes]]', intval($configurationBorne->is_reprise_photo), $content);
                    
                    //surveyTitle
                    $surveyTitleValue = !empty($configurationBorne->titre_formulaire) ? $configurationBorne->titre_formulaire : "Veuillez renseigner vos coordonnées";
                    $content = str_replace('[[surveyTitle]]', $surveyTitleValue, $content);
                    
                    $champs = $configurationBorne->champs;
                    $questions = array();
                    $surveyEmailList = array();
                    $surveyYNList = array();
                    $surveyMCList = array();
                    $MCAnswerAll = array();
                    for($i=1; $i<8; $i++ ){
                            $question = "";
                            $surveyEmailValue = 0;
                             $MCAnswer = array();
                            if(isset($champs[$i-1])){
                                $question = $champs[$i-1]->nom;
                                $surveyEmailList[$i] = 'surveyEmail'.$i.'=0';
                                $surveyYNList[$i] = 'surveyYN'.$i.'=0';
                                $surveyMCList[$i] = 'SurveyMC'.$i.'=0';
                               
                                for($j=1; $j< 5; $j++ ){
                                    $MCAnswer[$j] = 'MC'.$i.'Answer'.$j.'=';
                                }
                                
                                $MCAnswerTxt =  implode("\n",$MCAnswer);
                                $surveyMCList[$i] = $surveyMCList[$i] ."\n".$MCAnswerTxt;
                                       
                                $typeChampId = $champs[$i-1]->type_champ_id ;
                                    if($typeChampId == 1) {
                                        $typeDonneId = $champs[$i-1]->type_donnee_id ;
                                        if($typeDonneId == 1){
                                            $surveyEmailList[$i] = 'surveyEmail'.$i.'=1';
                                        }
                                    }else if($typeChampId == 3){
                                        $surveyYNList[$i] = 'surveyYN'.$i.'=1';
                                    }else if($typeChampId == 2 || $typeChampId == 4){
                                        $surveyMCList[$i] = 'SurveyMC'.$i.'=1';
                                       //$surveyMCList[$i]['choixPossible'] = array();
                                       if(!empty($champs[$i-1]->champ_options)){
                                            foreach($champs[$i-1]->champ_options as $key => $option){
                                                if(isset( $MCAnswer[$key+1])){
                                                    $MCAnswer[$key+1] = $MCAnswer[$key+1] .$option->nom;
                                                }
                                                
                                            }
                                       }
                                       $MCAnswerTxt =  implode("\n",$MCAnswer);
                                       $surveyMCList[$i] = $surveyMCList[$i] ."\n".$MCAnswerTxt;
                                    }
                            }
                            $questions[] = "question".$i."=".$question;
                            array_push($MCAnswerAll, $MCAnswer);
                    }
                    $lesQuestions = implode("\n",$questions);
                    $content = str_replace('[[questions]]', $lesQuestions, $content);
                    //[[surveyEmail]]
                    $surveyEmailTxt = implode("\n",$surveyEmailList);
                    $content = str_replace('[[surveyEmail]]', $surveyEmailTxt, $content);
                    //[[surveyYN]]
                    $surveyYNTxt = implode("\n",$surveyYNList);
                    $content = str_replace('[[surveyYN]]', $surveyYNTxt, $content);
                    //[[SurveyMC]]
                    $SurveyMCTxt = implode("\n",$surveyMCList);
                    $content = str_replace('[[SurveyMC]]', $SurveyMCTxt, $content);
                    //[[MCAnswer]]
                    /*$MCAnswerTxt = "";
                    foreach($MCAnswerAll as $oneMCAnswer){
                        $MCAnswerTxt = $MCAnswerTxt . implode("\n",$oneMCAnswer);
                    }
                    $content = str_replace('[[MCAnswer]]', $MCAnswerTxt, $content);*/
                    
                }
            }
            
            $fileName = $evenement->id.'.setting';
            $fichierSetting = fopen($settings->pwd().$fileName,"wb");
            $content_encoded = iconv( mb_detect_encoding( $content ), 'Windows-1252//TRANSLIT', $content );
            
            fwrite($fichierSetting,$content_encoded);
            fclose($fichierSetting);
            $this->Flash->success(__('Fichier regénéré.'));
            
            //Synchronisation next Clode
            ///usr/bin/php7.2 -c "/home/manager-selfizee/domains/upload.selfizee.fr/etc/php7.2/php.ini" "/home/manager-selfizee/domains/upload.selfizee.fr/public_html/occ" files:scan --path="/home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/borne/files/1258"
            shell_exec('/usr/bin/php7.2 -c "/home/manager-selfizee/domains/upload.selfizee.fr/etc/php7.2/php.ini" "/home/manager-selfizee/domains/upload.selfizee.fr/public_html/occ" files:scan --path="/home/manager-selfizee/domains/upload.selfizee.fr/public_html/dev/files/'.$idEvenement.'"');
        }
        return true;
       //return $this->redirect(['action' => 'add', $idEvenement]);
                                            
        
    }
    
    public function copieFichier($configurationBorne){
        //debug($configurationBorne);  die;
        
         $settings = new Folder(Configure::read('destination_config_borne')."b".$configurationBorne->num_borne.DS."files".DS."_Settings".DS, true, 0755);
            
        
        //Création des dossier si ce n'est pas encore prêt
        $frames = new Folder(Configure::read('destination_config_borne')."b".$configurationBorne->num_borne.DS."files".DS."_Assets".DS.$configurationBorne->evenement_id.DS."Frames".DS, true, 0755);
        $buttons = new Folder(Configure::read('destination_config_borne')."b".$configurationBorne->num_borne.DS."files".DS."_Assets".DS.$configurationBorne->evenement_id.DS."Buttons".DS, true, 0755);
        $backgrounds = new Folder(Configure::read('destination_config_borne')."b".$configurationBorne->num_borne.DS."files".DS."_Assets".DS.$configurationBorne->evenement_id.DS."Backgrounds".DS, true, 0755);
        $greenscreen = new Folder(Configure::read('destination_config_borne')."b".$configurationBorne->num_borne.DS."files".DS."_Assets".DS.$configurationBorne->evenement_id.DS."Greenscreen".DS, true, 0755);
        
        
        //copie cadre 
        $sourceCadre  = WWW_ROOT."import".DS."config_bornes".DS.$configurationBorne->evenement_id.DS."cadres".DS;
        if($configurationBorne->type_animation_id == 1){
            $configAnimation = $configurationBorne->configuration_animations[0];
            $cadres = $configAnimation->cadres;
            foreach($cadres as $key => $cadre){
                $num = $key+1;
                @copy($sourceCadre.$cadre->file_name, $frames->pwd().'cadre'.$num.'.png');
				// Copie overlay
                @copy($sourceCadre.$cadre->file_overlay, $frames->pwd().'overlay'.$num.'.png');
            }
        }else if($configurationBorne->type_animation_id == 4){ // Polariod
            $index = $configurationBorne->type_animation_id - 1;
            $configAnimation = $configurationBorne->configuration_animations[$index];
            $cadres = $configAnimation->cadres;
            if(!empty($cadres)){
                @copy($sourceCadre.$cadres[0]->file_name, $frames->pwd().'polaroid.jpg');
				// Copie overlay
                @copy($sourceCadre.$cadres[0]->file_overlay, $frames->pwd().'p-overlay.png');
            }
            
        }else{
            $index = $configurationBorne->type_animation_id - 1;
            $configAnimation = $configurationBorne->configuration_animations[$index];
            $cadres = $configAnimation->cadres;
            if(!empty($cadres)){
                @copy($sourceCadre.$cadres[0]->file_name, $frames->pwd().'cadre.png');
				// Copie overlay
                @copy($sourceCadre.$cadres[0]->file_overlay, $frames->pwd().'overlay.png');
            }
        }
        
        //copie fond vert
        if($configurationBorne->type_animation_id == 5){
            foreach($configurationBorne->fond_verts as $key => $fondVert){
                $num = $key+1;
                copy($sourceCadre.$fondVert->file_name, $greenscreen->pwd().'fond'.$num.'.png');
            }
        }
        
        //copie Background et bouton
        if(!empty($configurationBorne->ecran)){
            $ecran = $configurationBorne->ecran;
            //Page Acceuil 
            if(!empty($ecran->page_accueil)){
                copy($sourceCadre.$ecran->page_accueil, $backgrounds->pwd().'BG_ACCUEIL.jpg');
            }else{ // Par défaut
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_ACCUEIL.jpg', $backgrounds->pwd().'BG_ACCUEIL.jpg');
            }
            
            //Choix Configuratin
            if(!empty($ecran->page_choix_configuration)){
                 copy($sourceCadre.$ecran->page_choix_configuration, $backgrounds->pwd().'BG_LAYOUT.jpg');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_LAYOUT.jpg', $backgrounds->pwd().'BG_LAYOUT.jpg');
            }
            
            //page_prise_photo
            if(!empty($ecran->page_prise_photo)){
                 copy($sourceCadre.$ecran->page_prise_photo, $backgrounds->pwd().'BG_PRISE.jpg');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_PRISE.jpg', $backgrounds->pwd().'BG_PRISE.jpg');
            }
            
            //page_prise_photo_visualisation
            if(!empty($ecran->page_prise_photo_visualisation)){
                 copy($sourceCadre.$ecran->page_prise_photo_visualisation, $backgrounds->pwd().'BG_FOND.jpg');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_FOND.jpg', $backgrounds->pwd().'BG_FOND.jpg');
            }
            
            //page_choix_filtre
            if(!empty($ecran->page_choix_filtre)){
                 copy($sourceCadre.$ecran->page_choix_filtre, $backgrounds->pwd().'BG_FILTRE.jpg');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_FILTRE.jpg', $backgrounds->pwd().'BG_FILTRE.jpg');
            }
            
            //page_remerciement
            if(!empty($ecran->page_remerciement)){
                 copy($sourceCadre.$ecran->page_remerciement, $backgrounds->pwd().'BG_MERCI.jpg');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_MERCI.jpg', $backgrounds->pwd().'BG_MERCI.jpg');
            }
            
            //page_choix_fond_vert
            if(!empty($ecran->page_choix_fond_vert)){
                 copy($sourceCadre.$ecran->page_choix_fond_vert, $backgrounds->pwd().'BG_FOND_VERT.jpg');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_FOND_VERT.jpg', $backgrounds->pwd().'BG_FOND_VERT.jpg');
            }
            
            //copie Bouton
            if(!empty($ecran->btn_page_accueil)){
                copy($sourceCadre.$ecran->btn_page_accueil, $buttons->pwd().'bouton.png');
            }else{
                copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'btn_accueil.png', $backgrounds->pwd().'bouton.png');
            }
        }else{
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_ACCUEIL.jpg', $backgrounds->pwd().'BG_ACCUEIL.jpg');
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_LAYOUT.jpg', $backgrounds->pwd().'BG_LAYOUT.jpg');
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_PRISE.jpg', $backgrounds->pwd().'BG_PRISE.jpg');
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_FOND.jpg', $backgrounds->pwd().'BG_FOND.jpg');
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_FILTRE.jpg', $backgrounds->pwd().'BG_FILTRE.jpg');
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_MERCI.jpg', $backgrounds->pwd().'BG_MERCI.jpg');
            copy(WWW_ROOT.'img'.DS.'confbornes'.DS.'BG_FOND_VERT.jpg', $backgrounds->pwd().'BG_FOND_VERT.jpg');
        }
        
        
        
    }
    public function recapitulatif($idEvenement){
        $evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $this->set(compact('evenement','idEvenement'));
        $this->set('isConfiguration',true);
    }


    
    public function configAnim($idEvenement)
    {
        //$this->viewBuilder()->setLayout('sans_menu');
        $evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        //$this->set(compact('evenement', 'idEvenement'));
    }

    public function configAnimationCadreEdit($idEvenement)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        //$this->set(compact('evenement', 'idEvenement'));
        $this->render('/ConfigBornes/config_animation_cadre_edit');
    }

    
	public function getTheme($theme_id){
        //debug($this->request->getData());//die;
        $is_active = intVal($this->request->getData()['is_active']);
        //=== Catalogur ecran       
        $catalogue = $this->ConfigurationBornes->Catalogues->get($theme_id, [ 'contain' => ['Formats', 'Themes', 'Evenements', 'ImageFonds']]);

        /*$ecran = $this->ConfigurationBornes->EcransNavigations->find()
                                ->where(['catalogue_id' => $theme_id, 'is_active_catalogue_mep' => true])
                                ->first();
        $is_active = false ;
        if($ecran){
            $is_active = true;
        }*/

		$this->set(compact('catalogue', 'is_active'));
    }

    public function viewTheme($theme_id){
        //=== Catalogur ecran
        $catalogue = $this->ConfigurationBornes->Catalogues->get($theme_id, [ 'contain' => ['Formats', 'Themes', 'Evenements', 'ImageFonds']]);

        $ecran = $this->ConfigurationBornes->EcransNavigations->find()
                                ->where(['catalogue_id' => $theme_id, 'is_active_catalogue_mep' => true])
                                ->first();
		$this->set(compact('catalogue'));
    }

    public function viewCatalogueCadre($cat_id){
        //=== Catalogur ecran
        $this->loadModel('CatalogueCadres');
        $catalogueCadre = $this->CatalogueCadres->get($cat_id);
		$this->set(compact('catalogueCadre'));
    }

    
    
    /**
     * Save ajax
     *
     */
    public function saveAjax($idEvenement)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            debug($data);die;
        }

    }
    /**
     * Nouveau config borne method
     *
     */
    public function add($idEvenement, $is_ajax = false)
    {
        $configurationBorne = $this->ConfigurationBornes->newEntity();
        $evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        
        $configBorneFind = $this->ConfigurationBornes->find()
                                ->contain( ['TypeAnimations','ConfigurationAnimations' =>['Cadres'], 'ConfigurationAnimations1' =>['Cadres'],'ConfigurationAnimations2' =>['Cadres'],'ConfigurationAnimations3' =>['Cadres'],'ConfigurationAnimations4' =>['Cadres'], 
                                    'ConfigurationAnimations5' =>['Cadres'],
                                 'Filtres', 'Champs' => [ 'TypeChamps', 'TypeDonnees', 'ChampOptions','CustomOptins'],'FondVerts','EcransNavigations' => ['Catalogues' => ['ImageFonds', 'EcranRemerciements', 'EcranVisualisationPhotos', 'EcranChoixFondVerts', 'EcranFiltres', 'EcranPrisePhotos', 'EcranAccueils']],'TypeMiseEnPages'])
                                ->where(['ConfigurationBornes.evenement_id' => $idEvenement ])
                                ->first();
        $is_new = true;
        if(!empty($configBorneFind)){
            $configurationBorne = $configBorneFind;
            $is_new = false;
        }
        //debug($configurationBorne);die;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if(isset($data['choix_fond_page_accueil']))  $data['ecrans_navigation']['is_active_page_accueil_image_fond'] = $data['choix_fond_page_accueil'];
            if(isset($data['choix_btn_page_accueil'])) $data['ecrans_navigation']['is_active_page_accueil_image_btn_fond'] = $data['choix_btn_page_accueil'];
            if(isset($data['choix_fond_page_prise_photo']))  $data['ecrans_navigation']['is_active_page_prise_photo_image_fond'] = $data['choix_fond_page_prise_photo'];
            if(isset($data['choix_fond_page_filtre']))  $data['ecrans_navigation']['is_active_page_filtre_image_fond'] = $data['choix_fond_page_filtre'];
            if(isset($data['choix_fond_page_remerc']))  $data['ecrans_navigation']['is_active_page_remerc_image_fond'] = $data['choix_fond_page_remerc'];
            if(isset($data['choix_fond_page_choix_fv']))  $data['ecrans_navigation']['is_active_page_choix_fv_image_fond'] = $data['choix_fond_page_choix_fv'];
            if(isset($data['choix_fond_page_vis_photo']))  $data['ecrans_navigation']['is_active_page_vis_photo_image_fond'] = $data['choix_fond_page_vis_photo'];
            //debug($data['type_animations_ids']);
            //debug($data);//die;
            
            // Import cadre          
            $path_config_borne = WWW_ROOT . 'import' . DS . 'config_bornes' . DS . $idEvenement . DS;
            if (!is_dir(WWW_ROOT . 'import' . DS . 'config_bornes')) mkdir(WWW_ROOT . 'import' . DS . 'config_bornes', 0777);
            if (!is_dir($path_config_borne)) mkdir($path_config_borne, 0777);
            $path_cadre = $path_config_borne . 'cadres' .DS;
            if (!is_dir($path_cadre)) {
                mkdir($path_cadre, 0777);
            }

            if(!empty($data['typeanim_to_delete'])){
                foreach( $data['type_animations']['_ids'] as $c => $typeanim){
                    if(in_array($typeanim, $data['typeanim_to_delete'])) {
                        unset($data['type_animations']['_ids'][$c]);
                    }
                }
            }
            //debug($data);//die;

           foreach($data['configuration_animations'] as $id_anim => $configuration_animation ){
               if(in_array($id_anim, $data['type_animations']['_ids'])) {
                    foreach($configuration_animation['cadre_file'] as $ordre => $cadre_file) {
                        if(!empty($cadre_file['name'])){
                            $cadres = [];
                            $extension = pathinfo($cadre_file['name'], PATHINFO_EXTENSION);
                            $newFilename = Text::uuid() . "." . $extension;
                            if (move_uploaded_file($cadre_file['tmp_name'], $path_cadre . $newFilename)) {
                                //$cadres['file_name'] = $newFilename;
                                //$cadres['ordre'] = 0;
                                //$data['configuration_animations'][$id_anim]['cadres'][] =  $cadres;
                                $data['configuration_animations'][$id_anim]['cadres'][$ordre]['file_name'] = $newFilename;
                                $data['configuration_animations'][$id_anim]['cadres'][$ordre]['ordre'] = $ordre;
                            }
                        }
                    }
                } else {
                    unset($data['configuration_animations'][$id_anim]);
                }
           }
           //debug($data);//die;

            // Import fond verts
            $path_fond_vert = $path_config_borne . 'fond_verts' .DS;
            if (!is_dir($path_fond_vert)) {
                mkdir($path_fond_vert, 0777);
            }            
            if (!empty($data['image_fond_verts_files'])) {
                $path_tmp = WWW_ROOT . 'import' . DS . 'config_bornes/tmp/';
                foreach($data['image_fond_verts_files'] as $key => $fond_vert_file) {   
                    if (copy($path_tmp . $fond_vert_file , $path_fond_vert . $fond_vert_file)) {
                        $data['fond_verts'][$key]['file_name'] = $fond_vert_file;
                        $data['fond_verts'][$key]['ordre'] = $key;
                    }
                }
            }

            // Import image FOND page acceuiL 
            $path_ecrans = $path_config_borne . 'ecrans' .DS;
            if (!is_dir($path_ecrans)) {
                mkdir($path_ecrans, 0777);
            }
            if (!empty($data['image_fond_page_accueil_file']['name'])) {
                $extension = pathinfo($data['image_fond_page_accueil_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_accueil_file']['tmp_name'], $path_ecrans . $newFilename)) {                    
                        $data['ecrans_navigation']['page_accueil_image_fond'] = $newFilename; 
                }
            }

            // Import image BOUTTON page acceuiL          
            if (!is_dir($path_ecrans)) {
                mkdir($path_ecrans, 0777);
            }
            if (!empty($data['image_btn_page_accueil_file']['name'])) {
                $extension = pathinfo($data['image_btn_page_accueil_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_btn_page_accueil_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_accueil_image_btn'] = $newFilename;
                }
            }

            // Import image FOND page Prise photo 
            if (!empty($data['image_fond_page_prise_photo_file']['name'])) {
                $extension = pathinfo($data['image_fond_page_prise_photo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_prise_photo_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_prise_photos_image_fond'] = $newFilename;
                }
            }

            // Import image FOND page FILTRE
            if (!empty($data['image_fond_page_filtre_file']['name'])) { // image_fond_page_remerc_file
                $extension = pathinfo($data['image_fond_page_filtre_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_filtre_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_filtre_image_fond'] = $newFilename;
                }
            }

            // Import image FOND page REMERCIEMENT
            if (!empty($data['image_fond_page_remerc_file']['name'])) { // 
                $extension = pathinfo($data['image_fond_page_remerc_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_remerc_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_remerc_image_fond'] = $newFilename;
                }
            }
            
            // Import image FOND page CHOIX FOND VERT
            if (!empty($data['image_fond_page_choix_fv_file']['name'])) { // 
                $extension = pathinfo($data['image_fond_page_choix_fv_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_choix_fv_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_choix_fv_image_fond'] = $newFilename;
                }
            }

            // Import image FOND page VISUALISATION PHOTO
            if (!empty($data['image_fond_page_vis_photo_file']['name'])) { // 
                $extension = pathinfo($data['image_fond_page_vis_photo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_vis_photo_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_vis_photo_image_fond'] = $newFilename;
                }
            }

            //debug($data);//die;

            $configurationBorne = $this->ConfigurationBornes->patchEntity($configurationBorne, $data, [
                'associated'=>['TypeAnimations', 'ConfigurationAnimations.Cadres', 'Filtres', 'Champs', 'Champs.ChampOptions','Champs.CustomOptins','FondVerts','EcransNavigations']
            ]);
            
            //debug($configurationBorne);die;
            $res ['success'] = false;
            if ($this->ConfigurationBornes->save($configurationBorne)) {
                //debug($configurationBorne);die;

                //=== SUppression IMG FOND VERT            
                if (!empty($data["imgFvToDelete"])) {
                    foreach ($data["imgFvToDelete"] as $idImage) {
                        $image_fv = $this->ConfigurationBornes->FondVerts->get($idImage);
                        if ($this->ConfigurationBornes->FondVerts->delete($image_fv)) {
                            unlink($path_fond_vert . $image_fv->file_name);
                        }
                    }
                }
                //== Suppression cadre
                if (!empty($data['cadre_to_delete'])) {
                    for ($i = 0; $i < count($data['cadre_to_delete']); $i++) {
                        if (!empty($data['cadre_to_delete'][$i])) {
                            $id = intval($data['cadre_to_delete'][$i]);
                            $this->loadModel('Cadres');
                            $cadre_to_delele = $this->Cadres->get($id);
                            $this->Cadres->delete($cadre_to_delele);
                        }
                    }
                }

                //== Suppression img fond ecran
                if(!empty($data['page_to_delete'])) {
                    $ecran = $this->ConfigurationBornes->EcransNavigations->get($configurationBorne->ecrans_navigation->id);
                    foreach ($data["page_to_delete"] as $type_page => $img_fond) {
                        if(file_exists($path_ecrans . $img_fond )){
                            unlink($path_ecrans . $img_fond);

                            if($type_page == "page_acceuil" ) {
                                //$data['ecrans_navigation']['page_accueil_image_fond'] = "";
                                $ecran->page_accueil_image_fond = NULL;
                            } else
                            if($type_page == "btn_acceuil" ) {
                                //$data['ecrans_navigation']['page_accueil_image_btn'] = "";
                                $ecran->page_accueil_image_btn = NULL;
                            } else
                            if($type_page == "page_prise_photo" ) {
                                //$data['ecrans_navigation']['page_prise_photo_image_fond'] = "";      
                                $ecran->page_prise_photos_image_fond = NULL;
                            } else
                            if($type_page == "page_filtre" ) {
                                //$data['ecrans_navigation']['page_filtre_image_fond'] = "";
                                $ecran->page_filtre_image_fond = NULL;
                            } else
                            if($type_page ==  "page_choix_fv") {
                                //$data['ecrans_navigation']['page_choix_fv_image_fond'] = "";
                                $ecran->page_choix_fv_image_fond = NULL;          
                            } else
                            if($type_page == "page_vis_photo" ) {
                                //$data['ecrans_navigation']['page_vis_photo_image_fond'] = "";       
                                $ecran->page_vis_photo_image_fond = NULL;
                            } else        
                            if($type_page == "page_remerc" ) {
                                //$data['ecrans_navigation']['page_remerc_image_fond'] = ""; 
                                $ecran->page_remerc_image_fond = NULL;   
                            }                            
                        }
                    }
                    $this->ConfigurationBornes->EcransNavigations->save($ecran);
                }

                $res ['is_generate_file'] = false;
                //$is_generated = $this->generateConfig($idEvenement);
                if($is_ajax){
                    $res ['success'] = true;
                    //$res ['is_generate_file'] = $is_generated;
                    $res ['configuration_borne'] = $configurationBorne;
                } else {
                    $this->Flash->success(__('La configuration a été enregistrée.'));// The config borne has been saved.
                    return $this->redirect(['action' => 'add', $idEvenement]);
                }
            }

            //retour
            if($is_ajax){
                echo json_encode($res);die;
            }

            if(!$is_ajax) $this->Flash->error(__('La configuration n\'a pas pu être enregistrée. Veuillez réessayer.'));//The config borne could not be saved. Please, try again.
        }
        
        $typeMiseEnPages = $this->ConfigurationBornes->TypeMiseEnPages->find('list', ['valueField' => 'nom']);
        $mEnpOption = function($val) use ($typeMiseEnPages){
            $key = array_keys($typeMiseEnPages->toArray(), $val)[0];
            $mEnp['value'] = $key;
            $mEnp['text'] = $val;
            $mEnp['class'] = 'custom-control-input';
            return $mEnp;
        };
        $mEnpOptions = array_map($mEnpOption, $typeMiseEnPages->toArray());//debug($mEnpOptions);die;

        $typeAnimations = $this->ConfigurationBornes->TypeAnimations->find('all');//debug($typeAnimations->toArray());die;
        $typeAnimationsList = $this->ConfigurationBornes->TypeAnimations->find('list', ['valueField' => 'nom']);//debug($typeAnimationsList->toArray());die;
        
        $filtres = $this->ConfigurationBornes->Filtres->find('list',['valueField' => 'nom'])->limit(3);
        $tailleEcrans = $this->ConfigurationBornes->TailleEcrans->find('list', ['valueField' => 'valeur']);
        $typeImprimantes = $this->ConfigurationBornes->TypeImprimantes->find('list', ['valueField' => 'nom']);
        $this->loadModel('TypeChamps');
        $typeChamps = $this->TypeChamps->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeDonnees');
        $typeDonnees = $this->TypeDonnees->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeOptins');
        $typeOptins = $this->TypeOptins->find('list',['valueField'=>'titre']);
        
        $dispositionVignettes = $this->ConfigurationBornes->ConfigurationAnimations->DispositionVignettes->find('all');

        //=== Catalogue ecran
        $this->loadModel('Catalogues');        
        $catalogues = $this->Catalogues->find('all', [ 'contain' => ['Formats', 'Themes', 'Evenements', 'ImageFonds']])->where(['Catalogues.client_id' => $evenement->client_id]);
        $this->loadModel('CatalogueCadres');        
        $catalogueCadres = $this->CatalogueCadres->find('all', [ 'contain' => ['Formats', 'Themes', 'Evenements']])->where(['CatalogueCadres.client_id' => $evenement->client_id]); //'evenement_id' => $idEvenement
        $themeCatalogues = $this->CatalogueCadres->Themes->find('list', ['valueField' => function ($theme) { return ucfirst($theme->nom) ;}])->where(['client_id' =>  $evenement->client_id]);// debug($themeCatalogues->toArray());die;
        $formatCatalogues = $this->CatalogueCadres->Formats->find('list', ['valueField' => 'nom']);
        //debug($dispositionVignettes->toArray());die;
        $this->set(compact('mEnpOptions', 'is_new', 'configurationBorne', 'evenement', 'typeMiseEnPages', 'catalogues', 'catalogueCadres', 'themeCatalogues', 'formatCatalogues', 'tailleEcrans', 'typeImprimantes', 'idEvenement', 'typeAnimations', 'typeAnimationsList', 'filtres', 'typeChamps', 'typeDonnees', 'typeOptins', 'dispositionVignettes'));
        $this->set('isConfiguration',true);
        //=== new design        
        //$this->viewBuilder()->setLayout('sans_menu');
        //$this->render('/Configurations/create');
        //$this->render('/Configurations/add');
    } 

    public function rechercheCatalogue($idEvenement, $idClient) {        
        $res["success"] = false;
        $this->viewBuilder()->setLayout('ajax');
        //$this->autoRender = false;
        $key = $this->request->getQuery('key');
        $themes = $this->request->getQuery('themes');
        //debug($themes);die;

        $configurationBorne = $this->ConfigurationBornes->find()
                                ->contain( ['TypeAnimations','ConfigurationAnimations' =>['Cadres'], 'ConfigurationAnimations1' =>['Cadres'],'ConfigurationAnimations2' =>['Cadres'],'ConfigurationAnimations3' =>['Cadres'],'ConfigurationAnimations4' =>['Cadres'], 
                                    'ConfigurationAnimations5' =>['Cadres'],
                                 'Filtres', 'Champs' => [ 'TypeChamps', 'TypeDonnees', 'ChampOptions','CustomOptins'],'FondVerts','EcransNavigations','TypeMiseEnPages'])
                                ->where(['evenement_id' => $idEvenement ])
                                ->first();

        $catalogues = $this->ConfigurationBornes->Catalogues->find('all')
                                                ->contain(['Formats', 'Evenements', 'ImageFonds', 'Themes']);
                                                if(!empty( $themes )) {
                                                 $catalogues = $catalogues->matching('Themes', function ($q) use ($themes) {                                                   
                                                            return $q->where(['Themes.id IN' => $themes]);
                                                    });
                                                }
                                                $catalogues =  $catalogues->where(['Catalogues.client_id' => $idClient]);
                                                if(empty( $themes )) {
                                                    $catalogues = $catalogues->where(['OR' => ['Catalogues.nom LIKE' => "%".$key."%", 'Catalogues.description LIKE' => "%".$key."%"]]);
                                                }
                                                /* else if(empty($key)) {
                                                    $catalogues = $catalogues->where(['OR' => ['Catalogues.theme_id IN' => $themes]]);
                                                } else {
                                                    $catalogues = $catalogues->where(['OR' => ['Catalogues.nom LIKE' => "%".$key."%", 'Catalogues.description LIKE' => "%".$key."%", 'Catalogues.theme_id IN' => $themes]]);
                                                }*/
                                                //->toArray();,
        //debug($catalogues);die;
        $this->set(compact('catalogues', 'configurationBorne', 'key'));
    }

    public function rechercheCatalogueCadre($idEvenement, $idClient) {        
        $res["success"] = false;
        $this->viewBuilder()->setLayout('ajax');
        //$this->autoRender = false;
        $key = $this->request->getQuery('key');
        $theme = $this->request->getQuery('theme');
        $formats = $this->request->getQuery('formats');
        $nbr_poses = $this->request->getQuery('nbrPoses');
        //debug($themes);die;
        //debug($this->request);die;

        $configurationBorne = $this->ConfigurationBornes->find()
                                ->contain( ['TypeAnimations','ConfigurationAnimations' =>['Cadres'], 'ConfigurationAnimations1' =>['Cadres'],'ConfigurationAnimations2' =>['Cadres'],'ConfigurationAnimations3' =>['Cadres'],'ConfigurationAnimations4' =>['Cadres'], 
                                    'ConfigurationAnimations5' =>['Cadres'],
                                 'Filtres', 'Champs' => [ 'TypeChamps', 'TypeDonnees', 'ChampOptions','CustomOptins'],'FondVerts','EcransNavigations','TypeMiseEnPages'])
                                ->where(['evenement_id' => $idEvenement ])
                                ->first();
        
        $this->loadModel('CatalogueCadres');
        $catalogueCadres = $this->CatalogueCadres->find('all')
                                                ->contain(['Formats', 'Evenements', 'Themes'])
                                                ->where(['CatalogueCadres.client_id' => $idClient]);
                                                $catalogueCadres = $catalogueCadres->where(['CatalogueCadres.titre LIKE' => "%".$key."%"]);
                                                if(!empty($theme)) {
                                                 $catalogueCadres = $catalogueCadres->matching('Themes', function ($q) use ($theme) {                                                   
                                                            return $q->where(['Themes.id' => $theme]);
                                                    });
                                                }
                                                if(!empty($formats)) {
                                                    $catalogueCadres = $catalogueCadres->where(['format_id IN' => $formats]);
                                                }
                                                if(!empty($nbr_poses)) {
                                                    $catalogueCadres = $catalogueCadres->where(['nbr_pose IN' => $nbr_poses]);
                                                }                                                
        //$catalogueCadres = $catalogueCadres->toArray();
        //debug($catalogueCadres);die;
        $this->set(compact('catalogueCadres', 'configurationBorne', 'key'));
    }

    /*
	 * Ajax pour supprimer un champ
	 * @idEvenement : id de l'event
	 * @idToRemove : to Remove
	 */
	public function suppressionChamp(){
		$error = true;
		
		if($this->request->is(['post', 'put'])){
			$data = $this -> request -> getData();
			if(!empty($data) && $data['idEvenement'] && $data['idToRemove']){
				$idEvenement = $data['idEvenement'];
				$idToRemove = $data['idToRemove'];
				
				$this -> loadModel('Champs');
				$champ = $this->Champs->get($idToRemove);
				$error = $this -> Champs -> delete($champ) ? false : $error;
			}
		}
		
		echo json_encode($error);
		exit;
	}
	
    public function uploadImagesFondVerts($idEvenement)
    {
        $res["success"] = false;
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;

            if (!empty($data)) {
                $file = $data["file"];
                $fileTmpName = $file['name'];
                $infoFile = pathinfo($fileTmpName);
                $tempFileExtension = $infoFile["extension"];
                $newName = Text::uuid() . '.' . $tempFileExtension;

                $path_tmp = WWW_ROOT . 'import' . DS . 'config_bornes/tmp/';
                if (!is_dir($path_tmp)) mkdir($path_tmp, 0777, true);
                $destantionFileName = $path_tmp . $newName;
                $tmpFilePath = $file['tmp_name'];
                if (move_uploaded_file($tmpFilePath, $destantionFileName)) {
                    $res["success"] = true;
                    $res["name"] = $newName;
                }
            }
        }

        echo json_encode($res);
    }

    public function step()
    {
        $this->viewBuilder()->setLayout('sans_menu');
    }
    public function save($idEvenement)
    {
        $configurationBorne = $this->ConfigurationBornes->newEntity();
        $evenement = $this->ConfigurationBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $configBorneFind = $this->ConfigurationBornes->find()
                                ->contain( ['TypeAnimations', 'ConfigurationAnimations' =>['Cadres'], 'Filtres', 'Champs', 'Champs.ChampOptions','Champs.CustomOptins','FondVerts','EcransNavigations'])
                                ->where(['evenement_id' => $idEvenement ])
                                ->first();
        $is_new = true;
        if(!empty($configBorneFind)){
            $configurationBorne = $configBorneFind;
            $is_new = false;
        }
        //debug($configurationBorne);die;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['ecrans_navigation']['is_active_page_accueil_image_fond'] = $data['choix_fond_page_accueil'];
            $data['ecrans_navigation']['is_active_page_accueil_image_btn_fond'] = $data['choix_btn_page_accueil'];
            $data['ecrans_navigation']['is_active_page_prise_photo_image_fond'] = $data['choix_fond_page_prise_photo'];
            debug($data);die;

            // Import cadre            
            $path_config_borne = WWW_ROOT . 'import' . DS . 'config_bornes' . DS . $idEvenement . DS;
            if (!is_dir(WWW_ROOT . 'import' . DS . 'config_bornes')) mkdir(WWW_ROOT . 'import' . DS . 'config_bornes', 0777);
            if (!is_dir($path_config_borne)) mkdir($path_config_borne, 0777);
            $path_cadre = $path_config_borne . 'cadres' .DS;
            if (!is_dir($path_cadre)) {
                mkdir($path_cadre, 0777);
            }
            if (!empty($data['cadres_file']['name'])) {
                $extension = pathinfo($data['cadres_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['cadres_file']['tmp_name'], $path_cadre . $newFilename)) {
                    $data['configuration_animations'][0]['cadres'][0]['file_name'] = $newFilename;
                }
            }

            // Import fond verts
            $path_fond_vert = $path_config_borne . 'fond_verts' .DS;
            if (!is_dir($path_fond_vert)) {
                mkdir($path_fond_vert, 0777);
            }            
            if (!empty($data['image_fond_verts_files'])) {
                $path_tmp = WWW_ROOT . 'import' . DS . 'config_bornes/tmp/';
                foreach($data['image_fond_verts_files'] as $key => $fond_vert_file) {   
                    if (copy($path_tmp . $fond_vert_file , $path_fond_vert . $fond_vert_file)) {
                        $data['fond_verts'][$key]['file_name'] = $fond_vert_file;
                        $data['fond_verts'][$key]['ordre'] = $key;
                    }
                }
            }

            // Import image FOND page acceuiL 
            $path_ecrans = $path_config_borne . 'ecrans' .DS;
            if (!is_dir($path_ecrans)) {
                mkdir($path_ecrans, 0777);
            }
            if (!empty($data['image_fond_page_accueil_file']['name'])) {
                $extension = pathinfo($data['image_fond_page_accueil_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_accueil_file']['tmp_name'], $path_ecrans . $newFilename)) {                    
                        $data['ecrans_navigation']['page_accueil_image_fond'] = $newFilename; 
                }
            }

            // Import image BOUTTON page acceuiL          
            if (!is_dir($path_ecrans)) {
                mkdir($path_ecrans, 0777);
            }
            if (!empty($data['image_btn_page_accueil_file']['name'])) {
                $extension = pathinfo($data['image_btn_page_accueil_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_btn_page_accueil_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['page_accueil_image_btn'] = $newFilename;
                }
            }

            // Import image FOND page Prise photo  
            if (!is_dir($path_ecrans)) {
                mkdir($path_ecrans, 0777);
            }
            if (!empty($data['image_fond_page_prise_photo_file']['name'])) {
                $extension = pathinfo($data['image_fond_page_prise_photo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                if (move_uploaded_file($data['image_fond_page_prise_photo_file']['tmp_name'], $path_ecrans . $newFilename)) {                   
                    $data['ecrans_navigation']['image_fond_page_prise_photo_file'] = $newFilename;
                }
            }
            
            //debug($data);die;

            $configurationBorne = $this->ConfigurationBornes->patchEntity($configurationBorne, $data, [
                'associated'=>['TypeAnimations', 'ConfigurationAnimations.Cadres', 'Filtres', 'Champs', 'Champs.ChampOptions','Champs.CustomOptins','FondVerts','EcransNavigations']
            ]);
            //debug($configurationBorne);die;

            if ($this->ConfigurationBornes->save($configurationBorne)) {
                //debug($configurationBorne);die;
                $this->Flash->success(__('The config borne has been saved.'));

                return $this->redirect(['action' => 'save', $idEvenement]);
            }
            $this->Flash->error(__('The config borne could not be saved. Please, try again.'));
        }
        
        $typeMiseEnPages = $this->ConfigurationBornes->TypeMiseEnPages->find('list', ['valueField' => 'nom']);
        $mEnpOption = function($val) use ($typeMiseEnPages){
            $key = array_keys($typeMiseEnPages->toArray(), $val)[0];
            $mEnp['value'] = $key;
            $mEnp['text'] = $val;
            $mEnp['class'] = 'custom-control-input';
            return $mEnp;
        };
        $mEnpOptions = array_map($mEnpOption, $typeMiseEnPages->toArray());//debug($mEnpOptions);die;

        $catalogues = $this->ConfigurationBornes->Catalogues->find('list', ['valueField' => 'nom']);
        $typeAnimations = $this->ConfigurationBornes->TypeAnimations->find('list',['valueField' => 'nom']);//debug($typeAnimations->toArray());die;
        $filtres = $this->ConfigurationBornes->Filtres->find('list',['valueField' => 'nom'])->limit(3);
        $tailleEcrans = $this->ConfigurationBornes->TailleEcrans->find('list', ['valueField' => 'valeur']);
        $typeImprimantes = $this->ConfigurationBornes->TypeImprimantes->find('list', ['valueField' => 'nom']);
        $this->loadModel('TypeChamps');
        $typeChamps = $this->TypeChamps->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeDonnees');
        $typeDonnees = $this->TypeDonnees->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeOptins');
        $typeOptins = $this->TypeOptins->find('list',['valueField'=>'titre']);
        $configBorne = $configurationBorne;
        $this->set(compact('mEnpOptions', 'is_new', 'configBorne', 'evenement', 'typeMiseEnPages', 'catalogues', 'tailleEcrans', 'typeImprimantes', 'idEvenement', 'typeAnimations', 'filtres', 'typeChamps', 'typeDonnees', 'typeOptins'));
    } 
}
