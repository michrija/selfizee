<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Themes Controller
 *
 * @property \App\Model\Table\ThemesTable $Themes
 *
 * @method \App\Model\Entity\Theme[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThemesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function liste($idClient = null)
    {
        $this->paginate = [
            'contain' => [],
            'conditions' =>['client_id'=>$idClient]
        ];

        $themes = $this->paginate($this->Themes);
        $this->loadModel('Clients');
        $client = $this->Clients->get($idClient,['contain'=>[]]);
        $this->viewBuilder()->setLayout('sans_menu');
        $this->set(compact('themes', 'client'));
    }

    /**
     * View method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $theme = $this->Themes->get($id, [
            'contain' => ['ImageFonds']
        ]);

        $this->set('theme', $theme);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idClient, $idTheme = null)
    {
        $theme = $this->Themes->newEntity();
        $this->loadModel('Clients');
        $client = $this->Clients->get($idClient,['contain'=>[]]);
        $is_new = true;
        if($idTheme) {            
            $themeFind = $this->Themes->get($idTheme, [
                'contain' => []
            ]);
            if(!empty($themeFind)){
                $theme = $themeFind;
                $is_new = false;
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if($is_new){
                $user_id = $this->Auth->user()['id'];
                $data['user_id'] = $user_id;
            }
            
            $theme = $this->Themes->patchEntity($theme, $data);
            if ($this->Themes->save($theme)) {
                $this->Flash->success(__('The theme has been saved.'));

                return $this->redirect(['action' => 'liste', $idClient]);
            }
            $this->Flash->error(__('The theme could not be saved. Please, try again.'));
        }
        $this->viewBuilder()->setLayout('sans_menu');
        $this->set(compact('theme', 'client', 'is_new'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $theme = $this->Themes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $theme = $this->Themes->patchEntity($theme, $this->request->getData());
            if ($this->Themes->save($theme)) {
                $this->Flash->success(__('The theme has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theme could not be saved. Please, try again.'));
        }
        $this->set(compact('theme'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $theme = $this->Themes->get($id);
        $idClient = $theme->client_id;
        if ($this->Themes->delete($theme)) {
            $this->Flash->success(__('The theme has been deleted.'));
        } else {
            $this->Flash->error(__('The theme could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste', $idClient]);
    }
}
