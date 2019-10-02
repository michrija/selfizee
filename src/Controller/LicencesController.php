<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * Licences Controller
 *
 * @property \App\Model\Table\LicencesTable $Licences
 *
 * @method \App\Model\Entity\Licence[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LicencesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //$licences = $this->paginate($this->Licences);

        //$this->set(compact('licences'));

        $id_borne = 12589;
        $id_borne_encode = rtrim(strtr(base64_encode($id_borne), '+/', '-_'), '=');
        $id_borne_encode = strtoupper($id_borne_encode);
        $duree_licence = "3ANS";
        $somme = 1000 ;
        //debug($id_borne_encode);die;

        //== Randow prefixe
        $prefixe = rand(1,999);
        $count = strlen($prefixe);
        if($count == 1 ) {
            $prefixe = '00'.$prefixe;
        } else
        if($count == 2 ) {
            $prefixe = '0'.$prefixe;
        }
        //debug("Prefix : ".$prefixe);

        //== Suffixe 
        $suffixe = $somme - intVal($prefixe);
        $count_suffixe = strlen($suffixe);
        if($count_suffixe == 1 ) {
            $suffixe = '00'.$suffixe;
        } else
        if($count_suffixe == 2 ) {
            $suffixe = '0'.$suffixe;
        }
        //debug("Suffixe  : ".$suffixe);
        $numero_de_serie_non_crypte = $prefixe.$id_borne_encode.$duree_licence.$suffixe;   //== numéro de série généré non crypté  //Ex: '889125893ANS111';
        debug("Numero de serie non crypté  : ".$numero_de_serie_non_crypte);//die;   
        
        $numero_de_serie_crypte = $this->toEncrypt($numero_de_serie_non_crypte, true);
        debug("Numero de serie crypté : ".$numero_de_serie_crypte);die;
    }
    
    //== Encrypter chaine
    public function toEncrypt($originalValue, $upper)
    {
        $numero_de_serie_non_crypte_array = str_split($originalValue);
        //== Intervertir char  
        $numero_de_serie_crypte_array = array_map( array($this, 'convertChar'), $numero_de_serie_non_crypte_array);
        $numero_de_serie_crypte = implode('', $numero_de_serie_crypte_array);
        //debug($numero_de_serie_array);//die;//debug($numero_de_serie_crypte_array);die;

        if(!$upper) {
            $numero_de_serie_crypte = strtolower($numero_de_serie_crypte);
        }

        return $numero_de_serie_crypte;
    }

    //== Interchanger chaq char 
    // "il sera synchro via nextcloud" ==> cad qu'on va faire des scripts pour importer les photos croppées ?
    // "mais juste un idetifiant" ==> "identifiant" est une colonne dans le csv (data.csv) ?
    public function convertChar($char)
    {
        $toReturn = "";
        $permuterChar = [
           'A' => 'E', 'B' => 'F','C' => 'G', 'D' => 'H',   'E' => 'I',  'F' => 'J',  'G' => 'K', 'H' => 'L',
           'I' => 'M', 'J' => 'N',   'K' => 'O','L' => 'P','M' => 'Q',   'N' => 'R', 'O' => 'S', 'P' => 'T',
           'Q' => 'U', 'R' => 'V', 'S' => 'W','T' => 'X','U' => 'Y','V' => 'Z','W' => 'A','X' => 'B',
           'Y' => 'C','Z' => 'D',
           '1' => '5', '2' => '6','3' => '7', '4' => '8', '5' => '9','6' => '0','7' => '1','8' => '2',
           '9' => '3', '0' => '4','' => '&',
       ];

       $toReturn = $permuterChar[$char];
       return $toReturn;
    }

    /**
     * WS save
     */
    public function save()
    {
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $res ['success'] = false;
        $licence = $this->Licences->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $is_to_upper = true;
            if(isset($data['is_upper'])) $is_to_upper = $data['is_upper'];

            $id_borne = $data['id_borne'];
            $id_borne_encode = rtrim(strtr(base64_encode($id_borne), '+/', '-_'), '=');
            $id_borne_encode = strtoupper($id_borne_encode);
            $duree_licence = $data['duree']."ANS";
            $somme = 1000 ;

            //== Randow prefixe
            $prefixe = rand(1,999);
            $count = strlen($prefixe);
            if($count == 1 ) {
                $prefixe = '00'.$prefixe;
            } else
            if($count == 2 ) {
                $prefixe = '0'.$prefixe;
            }
            //== Suffixe 
            $suffixe = $somme - intVal($prefixe);
            $count_suffixe = strlen($suffixe);
            if($count_suffixe == 1 ) {
                $suffixe = '00'.$suffixe;
            } else
            if($count_suffixe == 2 ) {
                $suffixe = '0'.$suffixe;
            }
            //debug("Suffixe  : ".$suffixe);
            $numero_de_serie_non_crypte = $prefixe.$id_borne_encode.$duree_licence.$suffixe;
            $data['numero_serie_non_crypte'] = $numero_de_serie_non_crypte;
            
            $numero_de_serie_crypte = $this->toEncrypt($numero_de_serie_non_crypte, $is_to_upper);
            $data['numero_serie_crypte'] = $numero_de_serie_crypte;

            $licence = $this->Licences->patchEntity($licence, $data);
            if ($this->Licences->save($licence)) {
                $res ['success'] = true;
                //$res ['licence'] = $licence;
                $res ['id_borne'] = $licence->id_borne;
                $res ['id_borne_encode'] = strtoupper( rtrim(strtr(base64_encode($id_borne), '+/', '-_'), '='));
                $res ['numero_serie_non_crypte'] = $licence->numero_serie_non_crypte; 
                $res ['numero_serie_crypte'] = $licence->numero_serie_crypte;
            }
        }
        echo json_encode($res);
    }
     /**
     * WS GET licence by idBorne
     */
    public function get($id_borne)
    {
        $res = [];
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $licence = $this->Licences->find()->where(['id_borne' => $id_borne])->first();
        if($licence) {
            $res ['id_borne'] = $licence->id_borne;
            $res ['id_borne_encode'] = strtoupper( rtrim(strtr(base64_encode($licence->id_borne), '+/', '-_'), '='));
            $res ['numero_serie_non_crypte'] = $licence->numero_serie_non_crypte; 
            $res ['numero_serie_crypte'] = $licence->numero_serie_crypte; 
        }
        echo json_encode($res);
    }
    /**
     * WS Get all licence
     */
    public function getAll()
    {
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $licences = $this->Licences->find('all');
        $collection = new Collection($licences);
        $licences = $collection->extract(function($licence){
            $lic ['id_borne'] = $licence->id_borne;
            $lic ['id_borne_encode'] = strtoupper( rtrim(strtr(base64_encode($licence->id_borne), '+/', '-_'), '='));
            $lic ['numero_serie_non_crypte'] = $licence->numero_serie_non_crypte; 
            $lic ['numero_serie_crypte'] = $licence->numero_serie_crypte;

            return $lic;
        });

        echo json_encode($licences);
    }
    /**
     * WS delete licence
     */
    public function deleteLicence($id_borne = null)
    {
        $res ['success']= false;
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        if ($this->request->is('post')) {
            $id_borne = $this->request->data['id_borne'];
            $licence = $this->Licences->find()->where(['id_borne' => $id_borne])->first();
            //echo json_encode($licence);die;
            if($licence) {
                if($this->Licences->delete($licence)){
                    $res ['success']= true;
                }
            }
        }
        echo json_encode($res);
    }

    /**
     * WS SAVE encrypt  from soft by idBorne
     */
    public function encryptFromSoft()
    {
        $res ['success'] = false;
		$this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $licence = $this->Licences->find()->where([
                            'id_borne' => $data['id_borne'], 
                            'numero_serie_non_crypte IS NOT' =>NULL,
                            'numero_serie_non_crypte !='=> '',
                            'numero_serie_crypte IS NOT' =>NULL,
                            'numero_serie_crypte !='=> ''
                ])->first();
            
            if($licence) {
                $licence->numero_serie_crypte_from_soft = $data['numero_serie_crypte_from_soft'];
                if ($this->Licences->save($licence)) {
                    $res ['success'] = true;
                    $res ['licence'] = $licence;
                }
            }
        }
        echo json_encode($res);
    }



    /**
     * View method
     *
     * @param string|null $id Licence id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $licence = $this->Licences->get($id, [
            'contain' => []
        ]);

        $this->set('licence', $licence);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $licence = $this->Licences->newEntity();
        if ($this->request->is('post')) {
            $licence = $this->Licences->patchEntity($licence, $this->request->getData());
            if ($this->Licences->save($licence)) {
                $this->Flash->success(__('The licence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The licence could not be saved. Please, try again.'));
        }
        $this->set(compact('licence'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Licence id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $licence = $this->Licences->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $licence = $this->Licences->patchEntity($licence, $this->request->getData());
            if ($this->Licences->save($licence)) {
                $this->Flash->success(__('The licence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The licence could not be saved. Please, try again.'));
        }
        $this->set(compact('licence'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Licence id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $licence = $this->Licences->get($id);
        if ($this->Licences->delete($licence)) {
            $this->Flash->success(__('The licence has been deleted.'));
        } else {
            $this->Flash->error(__('The licence could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
