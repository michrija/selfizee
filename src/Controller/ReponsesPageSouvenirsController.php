<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * ReponsesPageSouvenirs Controller
 *
 * @property \App\Model\Table\ReponsesPageSouvenirsTable $ReponsesPageSouvenirs
 *
 * @method \App\Model\Entity\ReponsesPageSouvenir[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReponsesPageSouvenirsController extends AppController
{

     public function isAuthorized($user)
    {        
        // Par d�faut, on autorise.
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function liste($idEvenement = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $this->set('isConfiguration',true);
        $this->paginate = [
            'contain' => ['ChampOptions', 'Champs', 'Photos', 'PageSouvenirs']
        ];
        $reponsesPageSouvenirs = $this->paginate($this->ReponsesPageSouvenirs);
        //debug($reponsesPageSouvenirs);die;
        $this->loadModel('PageSouvenirs');
        $evenement = $this->PageSouvenirs->Evenements->get($idEvenement,['contain'=>['Galeries']]);
        $page_souvenir = $this->PageSouvenirs->find()->where(['evenement_id'=>$idEvenement])->first();
        //debug($page_souvenir);die;

        $champs = [];
        $reponses_list = [];
        if($page_souvenir) {
            $pagesouvenir_id = $page_souvenir->id;
            $reponses = $this->ReponsesPageSouvenirs->find('all', ['contain' => ['ChampOptions', 'Champs', 'Photos', 'PageSouvenirs']]);
            if(!empty($pagesouvenir_id)){
                $reponses = $reponses->where(['ReponsesPageSouvenirs.page_souvenir_id' => $pagesouvenir_id ]);

                $champs = $this->ReponsesPageSouvenirs->Champs->find()->where(['page_souvenir_id' => $pagesouvenir_id ])->order('type_champ_id');

                $collection = new Collection($champs);
                $champs = $collection->extract('nom')->toArray();
                //debug($champs);
            }
            //debug($champs);

            $collection = new Collection($reponses);
            $reponses = $collection->sortBy('champ.type_champ_id', SORT_ASC);       
            //debug($reponses->toArray());die;

            $collection = new Collection($reponses);
            $reponses = $collection->groupBy('queque')->toArray();
            //debug($reponses);die;
            
            foreach ($reponses as $key => $reponse) {
                $ligne = [];
                foreach ($reponse as $key => $rep) {
                    if(!empty($rep->value_text)) {
                        $ligne[] = $rep->value_text;                
                    }
                    if(!empty($rep->champ_option_id)) {
                        $ligne[] = $rep->champ_option->nom;                
                    }                
                }
                //debug($rep);
                $ligne['photo'] = $rep->photo->url_thumb_bo;
                $ligne['photo_name'] = $rep->photo->name_origne;
                $ligne['page_souvenir'] = $rep->page_souvenir_id;
                $ligne['queque'] = $rep->queque;
                $ligne['date'] = $rep->created->format('d/m/Y H:i:s');
                //$ligne[] = $rep->id;
                $reponses_list [] = $ligne;
            }
        }
        //debug($reponses_list);die;

        $this->set(compact('reponsesPageSouvenirs', 'champs', 'reponses_list', 'evenement', 'idEvenement' ));
    }

    /**
     * View method
     *
     * @param string|null $id Reponses Page Souvenir id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reponsesPageSouvenir = $this->ReponsesPageSouvenirs->get($id, [
            'contain' => ['ChampOptions', 'Champs', 'Photos', 'PageSouvenirs']
        ]);

        $this->set('reponsesPageSouvenir', $reponsesPageSouvenir);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addResponse()
    {
        $this->loadModel('Photos');
        $photo = null;
        if ($this->request->is('post')) { 
            $data = $this->request->getData();
            $photo = $this->Photos->get($data['photo_id']);
            $reponses = [];
            if(!empty($data['value_text'])){
                foreach ($data['value_text'] as $key => $value) {
                    $reponse ['value_text'] = $value[0];
                    $reponse ['champ_option_id'] = "";
                    $reponse ['champ_id'] = $key;
                    $reponse ['page_souvenir_id'] = $data['page_souvenir_id'];
                    $reponse ['photo_id'] = $data['photo_id'];
                    $reponse ['queque'] = time();
                    $reponses[] = $reponse;
                    //debug($reponse);                    
                }
            }

            if(!empty($data['champ_option_id'])){
                foreach ($data['champ_option_id'] as $key => $value) {
                    $reponse ['value_text'] = "";
                    $reponse ['champ_option_id'] = $value;
                    $reponse ['champ_id'] = $key;
                    $reponse ['page_souvenir_id'] = $data['page_souvenir_id'];
                    $reponse ['photo_id'] = $data['photo_id'];
                    $reponse ['queque'] = time();
                    $reponses[] = $reponse;
                    //debug($reponse);                    
                }
            }
            //debug($reponses);die;
            //debug($data);die;
            $reponsesPageSouvenirs = $this->ReponsesPageSouvenirs->newEntities($reponses);
            $reponsesPageSouvenirs = $this->ReponsesPageSouvenirs->patchEntities($reponsesPageSouvenirs, $reponses);
            //debug($reponsesPageSouvenirs);die;
            $i = 0;
            foreach ($reponsesPageSouvenirs as $key => $reponsesPageSouvenir) {
                # code...
                if ($this->ReponsesPageSouvenirs->save($reponsesPageSouvenir)) {
                    $i = $i + 1;
                }            
            }

            if($i > 0 && count($reponsesPageSouvenirs) >= $i){             
                 $response = $this->response->withFile(
                    $photo->uri_photo,
                    ['download' => true, 'name' => $photo->name]
                );
                $this->Flash->success(__('The reponses has been saved.'));
                return $response;         
            } else {
                $this->Flash->error(__('The reponses could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('reponsesPageSouvenir'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Reponses Page Souvenir id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reponsesPageSouvenir = $this->ReponsesPageSouvenirs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reponsesPageSouvenir = $this->ReponsesPageSouvenirs->patchEntity($reponsesPageSouvenir, $this->request->getData());
            if ($this->ReponsesPageSouvenirs->save($reponsesPageSouvenir)) {
                $this->Flash->success(__('The reponses page souvenir has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reponses page souvenir could not be saved. Please, try again.'));
        }
        $champOptions = $this->ReponsesPageSouvenirs->ChampOptions->find('list', ['limit' => 200]);
        $champs = $this->ReponsesPageSouvenirs->Champs->find('list', ['limit' => 200]);
        $photos = $this->ReponsesPageSouvenirs->Photos->find('list', ['limit' => 200]);
        $pageSouvenirs = $this->ReponsesPageSouvenirs->PageSouvenirs->find('list', ['limit' => 200]);
        $this->set(compact('reponsesPageSouvenir', 'champOptions', 'champs', 'photos', 'pageSouvenirs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reponses Page Souvenir id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reponsesPageSouvenir = $this->ReponsesPageSouvenirs->get($id);
        if ($this->ReponsesPageSouvenirs->delete($reponsesPageSouvenir)) {
            $this->Flash->success(__('The reponses page souvenir has been deleted.'));
        } else {
            $this->Flash->error(__('The reponses page souvenir could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
