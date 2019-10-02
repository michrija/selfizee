<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use Cake\Collection\Collection;
use Cake\Core\Configure;

/**
 * ConfigBornes Controller
 *
 * @property \App\Model\Table\ConfigBornesTable $ConfigBornes
 *
 * @method \App\Model\Entity\ConfigBorne[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigBornesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Evenements', 'TypeMiseEnPages', 'Catalogues', 'TailleEcrans', 'TypeImprimantes']
        ];
        $configBornes = $this->paginate($this->ConfigBornes);

        $this->set(compact('configBornes'));
    }

    public function configAnimationCadre($idEvenement)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $evenement = $this->ConfigBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        //$this->set(compact('evenement', 'idEvenement'));
        
    }
    
    public function configAnimationCadreEdit($idEvenement)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $evenement = $this->ConfigBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        //$this->set(compact('evenement', 'idEvenement'));
        
    }

    public function configAnim($idEvenement)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $evenement = $this->ConfigBornes->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        //$this->set(compact('evenement', 'idEvenement'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Config Borne id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configBorne = $this->ConfigBornes->get($id, [
            'contain' => ['Evenements', 'TypeMiseEnPages', 'Catalogues', 'TailleEcrans', 'TypeImprimantes', 'Cadres', 'Champs', 'ConfigborneHasFiltres', 'ConfigborneHasTypeanimations', 'Ecrans', 'FondVerts', 'ImageFondVerts']
        ]);

        $this->set('configBorne', $configBorne);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement)
    {
        $configBorne = $this->ConfigBornes->newEntity();
        $evenement = $this->ConfigBornes->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $configBorneFind = $this->ConfigBornes->find()
                                ->contain( ['TypeAnimations','Cadres', 'Filtres', 'Champs', 'Champs.ChampOptions','Champs.CustomOptins','FondVerts','EcransNavigations'])
                                ->where(['evenement_id' => $idEvenement ])
                                ->first();
        $is_new = true;
        if(!empty($configBorneFind)){
            $configBorne = $configBorneFind;
            $is_new = false;
        }
        //debug($configBorne);die;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['ecrans_navigation']['is_active_page_accueil_image_fond'] = $data['choix_fond_page_accueil'];
            $data['ecrans_navigation']['is_active_page_accueil_image_btn_fond'] = $data['choix_btn_page_accueil'];
            $data['ecrans_navigation']['is_active_page_prise_photo_image_fond'] = $data['choix_fond_page_prise_photo'];
            //debug($data);die;

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
                    $data['cadres'][0]['file_name'] = $newFilename; 
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
            
            //debug($data);//die;

            $configBorne = $this->ConfigBornes->patchEntity($configBorne, $data, [
                'associated'=>['TypeAnimations','Cadres', 'Filtres', 'Champs', 'Champs.ChampOptions','Champs.CustomOptins','FondVerts','EcransNavigations']
            ]);
            //debug($configBorne);die;

            if ($this->ConfigBornes->save($configBorne)) {
                //debug($configBorne);die;
                $this->Flash->success(__('The config borne has been saved.'));

                return $this->redirect(['action' => 'add', $idEvenement]);
            }
            $this->Flash->error(__('The config borne could not be saved. Please, try again.'));
        }
        
        $typeMiseEnPages = $this->ConfigBornes->TypeMiseEnPages->find('list', ['valueField' => 'nom']);
        $mEnpOption = function($val) use ($typeMiseEnPages){
            $key = array_keys($typeMiseEnPages->toArray(), $val)[0];
            $mEnp['value'] = $key;
            $mEnp['text'] = $val;
            $mEnp['class'] = 'custom-control-input';
            return $mEnp;
        };
        $mEnpOptions = array_map($mEnpOption, $typeMiseEnPages->toArray());//debug($mEnpOptions);die;

        $catalogues = $this->ConfigBornes->Catalogues->find('list', ['valueField' => 'nom']);
        $typeAnimations = $this->ConfigBornes->TypeAnimations->find('list',['valueField' => 'nom']);//debug($typeAnimations->toArray());die;
        $filtres = $this->ConfigBornes->Filtres->find('list',['valueField' => 'nom'])->limit(3);
        $tailleEcrans = $this->ConfigBornes->TailleEcrans->find('list', ['valueField' => 'valeur']);
        $typeImprimantes = $this->ConfigBornes->TypeImprimantes->find('list', ['valueField' => 'nom']);
        $this->loadModel('TypeChamps');
        $typeChamps = $this->TypeChamps->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeDonnees');
        $typeDonnees = $this->TypeDonnees->find('list',['valueField' => 'nom']);
        
        $this->loadModel('TypeOptins');
        $typeOptins = $this->TypeOptins->find('list',['valueField'=>'titre']);
        $this->set(compact('mEnpOptions', 'is_new', 'configBorne', 'evenement', 'typeMiseEnPages', 'catalogues', 'tailleEcrans', 'typeImprimantes', 'idEvenement', 'typeAnimations', 'filtres', 'typeChamps', 'typeDonnees', 'typeOptins'));
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
                if (!is_dir($path_tmp)) mkdir($path_tmp, 0777);
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

    /**
     * Edit method
     *
     * @param string|null $id Config Borne id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configBorne = $this->ConfigBornes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configBorne = $this->ConfigBornes->patchEntity($configBorne, $this->request->getData());
            if ($this->ConfigBornes->save($configBorne)) {
                $this->Flash->success(__('The config borne has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The config borne could not be saved. Please, try again.'));
        }
        $evenements = $this->ConfigBornes->Evenements->find('list', ['limit' => 200]);
        $typeMiseEnPages = $this->ConfigBornes->TypeMiseEnPages->find('list', ['limit' => 200]);
        $catalogues = $this->ConfigBornes->Catalogues->find('list', ['limit' => 200]);
        $tailleEcrans = $this->ConfigBornes->TailleEcrans->find('list', ['limit' => 200]);
        $typeImprimantes = $this->ConfigBornes->TypeImprimantes->find('list', ['limit' => 200]);
        $this->set(compact('configBorne', 'evenements', 'typeMiseEnPages', 'catalogues', 'tailleEcrans', 'typeImprimantes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Config Borne id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configBorne = $this->ConfigBornes->get($id);
        if ($this->ConfigBornes->delete($configBorne)) {
            $this->Flash->success(__('The config borne has been deleted.'));
        } else {
            $this->Flash->error(__('The config borne could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
