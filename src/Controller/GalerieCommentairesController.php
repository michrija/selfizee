<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GalerieCommentaires Controller
 *
 * @property \App\Model\Table\GalerieCommentairesTable $GalerieCommentaires
 *
 * @method \App\Model\Entity\GalerieCommentaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalerieCommentairesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('ajax');
        $idGalerie = $this->request->getQuery("idGalerie");
        $options['idGalerie'] = $idGalerie;
        
        $maxLimit = $this->request->getQuery("maxLimit");
        if(empty($maxLimit)){
            $maxLimit = 25;
        }
        $this->paginate = [
            'maxLimit' => $maxLimit,
            'contain' => ['Galeries'],
            'finder' => [
                'filtre' => $options
            ],
            'order' => ['created' => 'desc']
            
        ];
        $galerieCommentaires = $this->paginate($this->GalerieCommentaires);

        $this->set(compact('galerieCommentaires','maxLimit'));
    }

    /**
     * View method
     *
     * @param string|null $id Galerie Commentaire id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $galerieCommentaire = $this->GalerieCommentaires->get($id, [
            'contain' => ['Galeries']
        ]);

        $this->set('galerieCommentaire', $galerieCommentaire);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $galerieCommentaire = $this->GalerieCommentaires->newEntity();
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $res['success'] = false;
        if ($this->request->is('post')) {
            $galerieCommentaire = $this->GalerieCommentaires->patchEntity($galerieCommentaire, $this->request->getData());
            if ($this->GalerieCommentaires->save($galerieCommentaire)) {
                $res['msg']= __('The galerie commentaire has been saved.');
                $res['success'] = true;
    
            }else{
                $res['msg'] = __('The galerie commentaire could not be saved. Please, try again.');
            } 
        }
        echo json_encode($res);
    }

    /**
     * Edit method
     *
     * @param string|null $id Galerie Commentaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $galerieCommentaire = $this->GalerieCommentaires->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $galerieCommentaire = $this->GalerieCommentaires->patchEntity($galerieCommentaire, $this->request->getData());
            if ($this->GalerieCommentaires->save($galerieCommentaire)) {
                $this->Flash->success(__('The galerie commentaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The galerie commentaire could not be saved. Please, try again.'));
        }
        $galeries = $this->GalerieCommentaires->Galeries->find('list', ['limit' => 200]);
        $this->set(compact('galerieCommentaire', 'galeries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Galerie Commentaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $galerieCommentaire = $this->GalerieCommentaires->get($id);
        if ($this->GalerieCommentaires->delete($galerieCommentaire)) {
            $this->Flash->success(__('The galerie commentaire has been deleted.'));
        } else {
            $this->Flash->error(__('The galerie commentaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
