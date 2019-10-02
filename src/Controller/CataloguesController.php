<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use Cake\Collection\Collection;
use Cake\Core\Configure;

/**
 * Catalogues Controller
 *
 * @property \App\Model\Table\CataloguesTable $Catalogues
 *
 * @method \App\Model\Entity\Catalogue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CataloguesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function liste($idClient)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $catalogues = $this->paginate($this->Catalogues);        
        $this->paginate = [
            'contain' => ['Formats', 'Themes', 'Evenements', 'ImageFonds', 'EcranAccueils', 'EcranFiltres', 'EcranVisualisationPhotos', 'EcranChoixFondVerts', 'EcranRemerciements'],
            'conditions' =>['Catalogues.client_id'=>$idClient]
        ];
        
        $catalogues = $this->paginate($this->Catalogues);
        /*foreach ($catalogues as $catalogue) {
            debug($catalogue->id);
        }*/
        //die;
        //debug(count($catalogues));die;
        
        $client = $this->Catalogues->Clients->get($idClient,['contain'=>[]]);

        $this->set(compact('catalogues', 'idClient', 'client'));
    }

    /**
     * View method
     *
     * @param string|null $id Catalogue id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $catalogue = $this->Catalogues->get($id, [
            'contain' => ['ConfigBornes']
        ]);

        $this->set('catalogue', $catalogue);
    }

    public function depl() {
        $ecran_catalogues = $this->Catalogues->ImageFonds->find('all')->contain(['Catalogues']);
        //debug($ecran_catalogues->toArray());die;

        foreach($ecran_catalogues as $key => $ecran){
            $path_old = PATH_CONFIG_BORNE . $ecran->catalogue->evenement_id . DS . 'image_fonds' . DS;
            $path_new = PATH_CONFIG_BORNE . $ecran->catalogue->evenement_id  . DS . 'ecrans_catalogue' . DS;
            if (!is_dir($path_new)) mkdir($path_new, 0777);

            if (copy($path_old . $ecran->file_name, $path_new . $ecran->file_name)) {
                unlink($path_old . $ecran->file_name);
                $ecran->chemin = $path_new . $ecran->file_name;
                $this->Catalogues->ImageFonds->save($ecran);
                debug('save ecran cat: => '.$ecran->catalogue->evenement_id );
            }            
        }
        die;
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idClient, $idCatalogue = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $catalogue = $this->Catalogues->newEntity();       
        $client = $this->Catalogues->Clients->get($idClient,['contain'=>[]]);
        $is_new = true;
        if($idCatalogue) {            
            $catalogueFind = $this->Catalogues->get($idCatalogue, [
                'contain' => ['ImageFonds', 'EcranAccueils', 'EcranFiltres', 'EcranVisualisationPhotos', 'EcranChoixFondVerts', 'EcranRemerciements', 'Themes']
            ]);
            if(!empty($catalogueFind)){
                $catalogue = $catalogueFind;
                $is_new = false;
            }
        }
        //debug($catalogue);die;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if($is_new){
                $user_id = $this->Auth->user()['id'];
                $data['user_id'] = $user_id;
            }
            //debug($data);die;

            //=== Import image fonds 
            if (!is_dir(PATH_CONFIG_BORNE)) mkdir(PATH_CONFIG_BORNE, 0777);
            $path_image_fonds = PATH_CONFIG_BORNE . 'ecran_catalogue' . DS . $idClient . DS ;
            if (!is_dir($path_image_fonds)) mkdir($path_image_fonds, 0777, true);
            
             if (!empty($data['image_fonds_files'])){
                foreach ($data['image_fonds_files'] as $key => $image_fond){
                    if (!empty($image_fond['name'])) {
                        $extension = pathinfo($image_fond['name'], PATHINFO_EXTENSION);
                        $filename = Text::uuid() . "." . $extension;
                        if (move_uploaded_file($image_fond['tmp_name'], $path_image_fonds . $filename)) {
                            $data['image_fonds'][$key]['file_name'] = $filename;
                            $data['image_fonds'][$key]['nom_origine'] = $image_fond['name'];
                            $data['image_fonds'][$key]['chemin'] = $path_image_fonds . $filename;
                        }
                    }
                }
            }

            //debug($data);die;
            
            $catalogue = $this->Catalogues->patchEntity($catalogue, $data, [
                'associated' => ['ImageFonds', 'Themes']
            ]);
            //debug($catalogue);die;
            if ($this->Catalogues->save($catalogue)) {
                
                //== Suppression fond
                if (!empty($data['fond_to_delete'])) {
                    for ($i = 0; $i < count($data['fond_to_delete']); $i++) {
                        if (!empty($data['fond_to_delete'][$i])) {
                            $id = intval($data['fond_to_delete'][$i]);
                            $fond_to_delele = $this->Catalogues->ImageFonds->get($id);
                            $this->Catalogues->ImageFonds->delete($fond_to_delele);
                        }
                    }
                }

                $this->Flash->success(__('Le modèle de mise en page a été enregistré.'));//The catalogue has been saved.

                return $this->redirect(['action' => 'liste', $idClient]);
            } else {
                debug($catalogue);die;
            }
            $this->Flash->error(__('Le modèle de mise en page n\'a pas été enregistré. Veuillez réessayer.'));
        }

        $themes = $this->Catalogues->Themes->find('list', ['valueField' => 'nom'])->where(['client_id' => $idClient]);//debug($themes);die
        //debug($themes->toArray());die;
        $formats = $this->Catalogues->Formats->find('list', ['valueField' => 'nom']);
        $catalogues = $this->Catalogues->find('list', ['valueField' => 'nom']);
        
        //$this->set('isConfiguration',true);
        $this->set(compact('catalogue', 'themes', 'formats', 'catalogues', 'is_new', 'idClient', 'client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Catalogue id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $catalogue = $this->Catalogues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $catalogue = $this->Catalogues->patchEntity($catalogue, $this->request->getData());
            if ($this->Catalogues->save($catalogue)) {
                $this->Flash->success(__('The catalogue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The catalogue could not be saved. Please, try again.'));
        }
        $this->set(compact('catalogue'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Catalogue id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $catalogue = $this->Catalogues->get($id);
        $idClient = $catalogue->client_id;
        if ($this->Catalogues->delete($catalogue)) {
            $this->Flash->success(__('Le modèle a été supprimé.'));
        } else {
            $this->Flash->error(__('The catalogue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste', $idClient]);
    }
}
