<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PhotoCommentaires Controller
 *
 * @property \App\Model\Table\PhotoCommentairesTable $PhotoCommentaires
 *
 * @method \App\Model\Entity\PhotoCommentaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhotoCommentairesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('ajax');
        $idPhoto = $this->request->getQuery("idPhoto");
        $options['idPhoto'] = $idPhoto;
        
        $maxLimit = $this->request->getQuery("maxLimit");
        if(empty($maxLimit)){
            $maxLimit = 25;
        }
        $this->paginate = [
            'maxLimit' => $maxLimit,
            'finder' => [
                'filtre' => $options
            ],
            'order' => ['created' => 'desc']
            
        ];
        
        $photoCommentaires = $this->paginate($this->PhotoCommentaires);

        $this->set(compact('photoCommentaires','maxLimit'));
    }

    /**
     * View method
     *
     * @param string|null $id Photo Commentaire id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $photoCommentaire = $this->PhotoCommentaires->get($id, [
            'contain' => ['Photos']
        ]);

        $this->set('photoCommentaire', $photoCommentaire);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $photoCommentaire = $this->PhotoCommentaires->newEntity();
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $res['success'] = false;
        if ($this->request->is('post')) {
            $photoCommentaire = $this->PhotoCommentaires->patchEntity($photoCommentaire, $this->request->getData());
            if ($this->PhotoCommentaires->save($photoCommentaire)) {
                $res['msg']= __('The photo commentaire has been saved.');
                $res['success'] = true;
            }else{
                $res['msg'] = __('The photo commentaire could not be saved. Please, try again.');
            }
        }
        echo json_encode($res);
    }

    /**
     * Edit method
     *
     * @param string|null $id Photo Commentaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $photoCommentaire = $this->PhotoCommentaires->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $photoCommentaire = $this->PhotoCommentaires->patchEntity($photoCommentaire, $this->request->getData());
            if ($this->PhotoCommentaires->save($photoCommentaire)) {
                $this->Flash->success(__('The photo commentaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photo commentaire could not be saved. Please, try again.'));
        }
        $photos = $this->PhotoCommentaires->Photos->find('list', ['limit' => 200]);
        $this->set(compact('photoCommentaire', 'photos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Photo Commentaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photoCommentaire = $this->PhotoCommentaires->get($id);
        if ($this->PhotoCommentaires->delete($photoCommentaire)) {
            $this->Flash->success(__('The photo commentaire has been deleted.'));
        } else {
            $this->Flash->error(__('The photo commentaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
