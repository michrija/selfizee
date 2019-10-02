<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;


/**
 * Champs Controller
 *
 * @property \App\Model\Table\ChampsTable $Champs
 *
 * @method \App\Model\Entity\Champ[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigurationsController  extends AppController
{
    
    public function isAuthorized($user)
    {
        
        $action = $this->request->getParam('action');
        $autorised = array(1,2,4);
        if(in_array($user['role_id'], $autorised ) ){
            if (in_array($action, ['board'])) {
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

        // Accès évenement et Accès compte sous client

        if ($user['role_id'] == 5 || $user['role_id'] == 7) {
            if ($user['is_active_acces_config'] == true) {
                return true;
            }
        }



        // Par d�faut, on refuse l'acc�s.
        return parent::isAuthorized($user);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function board($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);

        //Pour récuperer la date de dernière mise à jour de 'événement
        $this->loadModel('Timelines');
        $timeline = $this->Timelines->find()
                                ->order(['date_timeline' => 'DESC'])
                                ->where(['date_timeline <>'=>'','date_timeline IS NOT' =>NULL])
                                ->where(['evenement_id' => $idEvenement])
                                ->first();

        //Recap configuration borne
        $this->loadModel('ConfigurationBornes');
        $configurationBorne = $this->ConfigurationBornes->find()
                ->contain( ['TypeAnimations'])
                ->where(['ConfigurationBornes.evenement_id' => $idEvenement ])
                ->first();
                
        $this->set(compact('configurationBorne'));

        //Récupération de l'info de chaque fonctionnalité activiée
        $listIdFonctionnaliteActive = null;
        if(!empty($evenement->fonctionnalites)){

            $collection = new Collection($evenement->fonctionnalites);
            $ids = $collection->extract(function ($fonctionnalite) {
                return $fonctionnalite->id;
            });
            $listIdFonctionnaliteActive = $ids->toArray();
            //Email info
            $emailConfig = null;
            if(in_array(1,$listIdFonctionnaliteActive )){
                $this->loadModel('EmailConfigurations');
                $emailConfig = $this->EmailConfigurations->find()
                                            ->where(['evenement_id' => $idEvenement])
                                            ->first();
                $this->set(compact('emailConfig'));
            }

            //Sms info
            $smsConfig = null;
            if(in_array(2,$listIdFonctionnaliteActive )){
                $this->loadModel('SmsConfigurations');
                $smsConfig = $this->SmsConfigurations->find()
                                            ->where(['evenement_id' => $idEvenement])
                                            ->first();
                $this->set(compact('smsConfig'));
            }

            //Galeir souvenir
            $galerieSouvenirConf = null;
            if(in_array(4,$listIdFonctionnaliteActive )){
                $this->loadModel('Galeries');
                $galerieSouvenirConf = $this->Galeries->find()
                                ->matching('Evenements', function ($q) use($idEvenement) {
                                        return $q->where(['Evenements.id' => $idEvenement]);
                                })
                                ->first();
                $this->set(compact('galerieSouvenirConf'));
            }

            //Page souvenir
            $pageSouvenirConfig = null;
            if(in_array(5,$listIdFonctionnaliteActive )){
                $this->loadModel('PageSouvenirs');
                $pageSouvenirConfig = $this->PageSouvenirs->find('all')
                                            ->where(['evenement_id'=>$idEvenement])
                                            ->first();
                $this->set(compact('pageSouvenirConfig'));
            }

            //Page souvenir
            $facebookAutoConfig = null;
            if(in_array(9,$listIdFonctionnaliteActive )){
                $this->loadModel('FacebookAutos');
                $facebookAutoConfig = $this->FacebookAutos->find('all')
                                                ->where(['evenement_id'=>$idEvenement])
                                                ->toArray();
                $this->set(compact('facebookAutoConfig'));
            }

            //Evenements post
            $evenementPostConfig = null;
            if(in_array(10,$listIdFonctionnaliteActive )){
                $this->loadModel('EvenementPosts');
                $evenementPostConfig = $this->EvenementPosts->find('all')
                                                ->where(['evenement_id'=>$idEvenement])
                                                ->toArray();
                $this->set(compact('evenementPostConfig'));
            }




        }


        $fonctionnalites = $this->Evenements->Fonctionnalites->find('all');

        $this->set('isConfiguration',true);
        $this->set(compact('idEvenement','evenement','timeline','listIdFonctionnaliteActive','fonctionnalites'));
    }


    public function liste($idEvenement)
    {
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $evenement = $this->Evenements->patchEntity($evenement, $this->request->getData(),['associated'=>['Fonctionnalites' ] ]);
            if ($this->Evenements->save($evenement)) {
                    $this->Flash->success(__('Fonctionnalités activées.'));
                    return $this->redirect(['controller'=>'Configurations','action' => 'board', $evenement->id]);
            }else{
                debug($evenement); die;
            }
            $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer.'));
        }

        $fonctionnalites = $this->Evenements->Fonctionnalites->find('all');

        $listIdFonctionnaliteActive = null;
        if(!empty($evenement->fonctionnalites)){
            $collection = new Collection($evenement->fonctionnalites);
            $ids = $collection->extract(function ($fonctionnalite) {
                return $fonctionnalite->id;
            });
            $listIdFonctionnaliteActive = $ids->toArray();
        }

        $this->set('isConfiguration',true);
        $this->set(compact('idEvenement','evenement','fonctionnalites','listIdFonctionnaliteActive'));
    }

    public function partage(){
        $this->viewBuilder()->setLayout('sans_menu');
    }

    public function create(){
        $configurationBorne = null;
        $this->set('configurationBorne',$configurationBorne);
        $this->viewBuilder()->setLayout('sans_menu');
    }

    
    public function add($idEvenement, $is_ajax = false)
    {
        $this->loadModel('ConfigurationBornes');
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
        $this->viewBuilder()->setLayout('sans_menu');
        //$this->render('/Configurations/create');
        //$this->render('/Configurations/add');
    }
}
