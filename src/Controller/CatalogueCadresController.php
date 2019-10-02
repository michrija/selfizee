<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use Cake\Collection\Collection;
use Cake\Core\Configure;

/**
 * CatalogueCadres Controller
 *
 * @property \App\Model\Table\CatalogueCadresTable $CatalogueCadres
 *
 * @method \App\Model\Entity\CatalogueCadre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CatalogueCadresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function liste($idClient)
    {
        $this->paginate = [
            'contain' => ['Formats', 'Evenements', 'Themes'],
            'conditions' =>['CatalogueCadres.client_id'=>$idClient]
        ];
        $catalogueCadres = $this->paginate($this->CatalogueCadres);
        $client = $this->CatalogueCadres->Clients->get($idClient,['contain'=>[]]);
        //debug($catalogueCadres);die;

        $this->viewBuilder()->setLayout('sans_menu');
        $this->set(compact('catalogueCadres', 'idClient', 'client'));
    }

    /**
     * View method
     *
     * @param string|null $id Catalogue Cadre id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $catalogueCadre = $this->CatalogueCadres->get($id, [
            'contain' => ['Formats', 'Evenements', 'Themes']
        ]);

        $this->set('catalogueCadre', $catalogueCadre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idClient, $idCatalogue = null)
    {
        $catalogueCadre = $this->CatalogueCadres->newEntity();
        $client = $this->CatalogueCadres->Clients->get($idClient,['contain'=>[]]);
        $is_new = true;
        if($idCatalogue) {            
            $catalogueFind = $this->CatalogueCadres->get($idCatalogue, [
                'contain' => ['Themes']
            ]);
            if(!empty($catalogueFind)){
                $catalogueCadre = $catalogueFind;
                $is_new = false;
            }
        }
        //debug($catalogueCadre);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if($is_new){
                $user_id = $this->Auth->user()['id'];
                $data['user_id'] = $user_id;
            }
            //debug($data);die;
            
            //=== Import cadre 
            if (!is_dir(PATH_CONFIG_BORNE)) mkdir(PATH_CONFIG_BORNE, 0777);
            $path_cadre_cat = PATH_CONFIG_BORNE . 'cadre_catalogue' . DS . $idClient . DS  ;
            if (!is_dir($path_cadre_cat)) mkdir($path_cadre_cat, 0777, true);
            
             if (!empty($data['catalogue_cadre_file'])){
                $cadre = $data['catalogue_cadre_file'];
                if (!empty($cadre['name'])) {
                    $extension = pathinfo($cadre['name'], PATHINFO_EXTENSION);
                    $filename = Text::uuid() . "." . $extension;
                    if (move_uploaded_file($cadre['tmp_name'], $path_cadre_cat . $filename)) {
                        $data['file_name'] = $filename;
                        $data['nom_origine'] = $cadre['name'];
                        $data['chemin'] = $path_cadre_cat . $filename;
                    }
                }
            }
            $catalogueCadre = $this->CatalogueCadres->patchEntity($catalogueCadre, $data, ['associated'=>['Themes']]);
            //debug($data);
            //debug($catalogueCadre);die;

            if ($this->CatalogueCadres->save($catalogueCadre)) {
                $this->Flash->success(__('Le modèle de cadre a été enregistré.'));//The catalogue has been saved.

                return $this->redirect(['action' => 'liste', $idClient]);
            }
            $this->Flash->error(__('Le modèle de cadre n\'a pas été enregistré. Veuillez réessayer.'));
        }

        $this->viewBuilder()->setLayout('sans_menu');
        $themes = $this->CatalogueCadres->Themes->find('list', ['valueField' => 'nom'])->where(['client_id' => $idClient]);
        //debug($themes->toArray());die;
        $formats = $this->CatalogueCadres->Formats->find('list', ['valueField' => 'nom']);
        $catalogues = $this->CatalogueCadres->find('list', ['valueField' => 'nom']);
        
        $this->set('isConfiguration',true);
        $this->set(compact('catalogueCadre', 'formats', 'themes', 'is_new','idClient', 'client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Catalogue Cadre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $catalogueCadre = $this->CatalogueCadres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $catalogueCadre = $this->CatalogueCadres->patchEntity($catalogueCadre, $this->request->getData());
            if ($this->CatalogueCadres->save($catalogueCadre)) {
                $this->Flash->success(__('The catalogue cadre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The catalogue cadre could not be saved. Please, try again.'));
        }
        $formats = $this->CatalogueCadres->Formats->find('list', ['limit' => 200]);
        $evenements = $this->CatalogueCadres->Evenements->find('list', ['limit' => 200]);
        $this->set(compact('catalogueCadre', 'formats', 'evenements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Catalogue Cadre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $catalogueCadre = $this->CatalogueCadres->get($id);
        $idClient = $catalogueCadre->client_id;
        if ($this->CatalogueCadres->delete($catalogueCadre)) {
            $this->Flash->success(__('le modèle a été supprimé.'));
        } else {
            $this->Flash->error(__('The catalogue cadre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste', $idClient]);
    }
}
