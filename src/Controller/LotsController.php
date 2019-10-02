<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;

use Cake\Core\Configure;

/**
 * Lots Controller
 *
 * @property \App\Model\Table\LotsTable $Lots
 *
 * @method \App\Model\Entity\Lot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LotsController extends AppController 
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {        
        $this->viewBuilder()->setLayout('sans_menu'); 
        $cle = $this->request->getQuery('cle');
        $optionsFiltre['cle'] = $cle;
        

        $this->set(compact('lots'));

        //$optionsFiltre['listeLotsId'] = $lots;
        $this->paginate = [
            'finder' => [
                'filtre' => $optionsFiltre
            ],
            'order' =>['id'=>'desc']
        ];       
        $lots = $this->paginate($this->Lots);

        $this->set(compact('lots','cle'));
    }

    /**
     * View method
     *
     * @param string|null $id Lot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $lot = $this->Lots->get($id, [
            'contain' => []
        ]);

        $this->set('lot', $lot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /*********************************/
        //$evenement = $this->Evenements->get($idEvenement);
        /*********************************/
        $this->viewBuilder()->setLayout('sans_menu');
        $lot = $this->Lots->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //debug($data);
            if (!empty($data['photo_file']['name'])) {
                $extension = pathinfo($data['photo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $path = 'uploadLot/';
                if (move_uploaded_file($data['photo_file']['tmp_name'], $path . $newFilename)) {
                    $data['photo'] = $newFilename;
                }

            }
            //debug($data);die;
            $lot = $this->Lots->patchEntity($lot, $data);
            if ($this->Lots->save($lot)) {
                $this->Flash->success(__('Sauvegarde avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le lot ne peut pas être sauvegardé.'));
        }
        $this->set(compact('lot'));
/*********************************/
        $this->loadModel('Evenements');
        $nom_event = $this->Evenements->find('list', ['valueField' => 'nom']);
        //debug($nom_event->toArray());die;
        $this->set(compact('evenement', 'nom_event'));
/*********************************/
    }

// $clients = $this->Evenements->Clients->find('list', ['valueField' => 'nom']);
// $this->set(compact('evenement', 'clients'));

// $evenement = $this->Evenements->patchEntity($evenement, $data);

// $clients = $this->Evenements->Clients->find('list', ['valueField' => 'nom']);
// $this->set(compact('evenement', 'clients','idEvenement'));

    /**
     * Edit method
     *
     * @param string|null $id Lot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $lot = $this->Lots->get($id, [
            'contain' => []
        ]);
        //debug($lot);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);
            if (!empty($data['photo_file']['name'])) {
                $extension = pathinfo($data['photo_file']['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $path = 'uploadLot/';
                if (move_uploaded_file($data['photo_file']['tmp_name'], $path . $newFilename)) {
                    $data['photo'] = $newFilename;
                }
            }
            $lot = $this->Lots->patchEntity($lot, $data);
            if ($this->Lots->save($lot)) {
                $this->Flash->success(__('Modification avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de modifier.'));
        }
        $this->set(compact('lot'));
        $this->loadModel('Evenements');
        $nom_event = $this->Evenements->find('list', ['valueField' => 'nom']);
        //debug($nom_event->toArray());die;
        $this->set(compact('evenement', 'nom_event'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lot = $this->Lots->get($id);
        if ($this->Lots->delete($lot)) {
            $this->Flash->success(__('The lot has been deleted.'));
        } else {
            $this->Flash->error(__('The lot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function importcsvlot()
    {
        $this->viewBuilder()->setLayout('sans_menu');

        //$stripeCsvFile = $this->StripeCsvFiles->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->getData();
            //date_default_timezone_set('Europe/Paris');
            $heure_now = date("H:i:s");
            //$data['date_import'] = $data['date_import'] . " " . $heure_now;
            //debug($data);die;
            $newFilename = "";

            //======= Upload file
            if (!is_dir(PATH_STRIPES_CSV_LOT)) {
                mkdir(PATH_STRIPES_CSV_LOT, 0777);
            }
            if (!empty($data['stripe_csv_file']['name'])) {
                $filename = $data['stripe_csv_file']['name'];
                $filename2 = $data['stripe_csv_file']['tmp_name'];
                $file = fopen($filename2, "r");
                        if ($file) {
                            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                                //debug($getData);
                                $lot = $this->Lots->newEntity();
                                //if (count($getData) > 15 && $getData[0] != "id") {
                                //debug($getData);  
                                //$lot->date_import = $data['date_import'];
                                //$lot->filename = $newFilename;
                                //$lot->filename_origin = $data['stripe_csv_file']['name'];

                                //$lot->id = $getData[];
                                // $lot->evenement_id = $getData[0];
                                $lot->nom = $getData[0]; 

            /*$colonne = trim($colonne);
            if(strpos(strtolower($colonne), "c:\\") !== false){
            $cheminPhotoInCSv = $colonne;
            //$nomPhoto = pathinfo($cheminPhotoInCSv,  PATHINFO_BASENAME);
            $cheminExpoded = explode('\\',$cheminPhotoInCSv);
            $nomPhoto = end($cheminExpoded);
            $nomPhoto = trim($nomPhoto);*/

                                $lot->photo = $getData[1];
                                //$var = $this->importPhotoViaCsv($getData[2]);
                                //debug($var);die;
                                $lot->quantite = $getData[2];
                                $lot->type_gain = $getData[3];
                                $lot->probabilite_gain = $getData[4];
                                if ($lot->type_gain == "probabilié") {
                                    $getData[5] = null;
                                }else if ($lot->type_gain == "instant gagnant") {
                                    $lot->date_deb_gain = $getData[5];
                                }
                                //$lot->date_deb_gain = $getData[5];
                                $lot->evenement_id = $getData[6];

        // $destintionPath = ;

        // $source = Configure::read('source_photo_lots').DS; 
                                

                                //debug($getData);

                                if($this->Lots->save($lot)) {
                                    //$this->Flash->success(__('Importation avec succès'));
                                    //debug("ligne ==>".$lot->id);
                                } else {
                                    $this->Flash->error(__('The stripe csv file could not be saved. Please, try again.'));//debug("not saved");
                                }

               // }
                    //$this->Flash->error(__('The stripe csv file could not be saved. Please, try again.'));
                }
            }//die;
            //$this->Flash->error(__('The stripe csv file could not be saved. Please, try again.'));
        }
        $this->set(compact('stripeCsvFile'));
    }
}

// public function importPhotoViaCsv(){
        
            // $colonne = trim($colonne);
            // if(strpos(strtolower($colonne), "c:\\") !== false){
            // $cheminPhotoInCSv = $colonne;
            // //$nomPhoto = pathinfo($cheminPhotoInCSv,  PATHINFO_BASENAME);
            // $cheminExpoded = explode('\\',$cheminPhotoInCSv);
            // $nomPhoto = end($cheminExpoded);
            // $nomPhoto = trim($nomPhoto);
        // }      
    // }
}