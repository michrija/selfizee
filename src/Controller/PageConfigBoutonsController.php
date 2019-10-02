<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;

/**
 * PageConfigBoutons Controller
 *
 * @property \App\Model\Table\PageConfigBoutonsTable $PageConfigBoutons
 *
 * @method \App\Model\Entity\PageConfigBouton[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PageConfigBoutonsController extends AppController
{

	public function initialize(){
		parent::initialize();
		$this->viewBuilder()->setLayout('sans_menu');
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $pageConfigBoutons = $this->paginate($this->PageConfigBoutons);

        $this->set(compact('pageConfigBoutons'));
    }

    /**
     * View method
     *
     * @param string|null $id Page Config Bouton id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pageConfigBouton = $this->PageConfigBoutons->get($id, [
            'contain' => []
        ]);

        $this->set('pageConfigBouton', $pageConfigBouton);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pageConfigBouton = $this->PageConfigBoutons->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			
			$file   = $this->request->getData("fichier_tmp");
			
			if($file['size']){
				$tmp = $file['tmp_name'];
				
				$destination = WWW_ROOT.'import'.DS.'config_pages'.DS.'boutons';
				$dir         = new Folder($destination, true, 0755);
				
				$pathinfos        = pathinfo($file['name']);
				$extension        = $pathinfos['extension'];
				$filename         = Text::uuid()."." . $extension;
				$destination_path = $dir->pwd() . DS . $filename;
				
				if(move_uploaded_file($tmp, $destination_path)){
					$data['fichier'] = $filename;
					$pageConfigBouton = $this->PageConfigBoutons->patchEntity($pageConfigBouton, $data);
					if ($this->PageConfigBoutons->save($pageConfigBouton)) {
						$this->Flash->success(__('The page config bouton has been saved.'));

						return $this->redirect(['action' => 'index']);
					}
					$this->Flash->error(__('The page config bouton could not be saved. Please, try again.'));
				}
			}else{
				$this->Flash->error(__('No file to upload. Please, try again.'));
			}
        }
        $this->set(compact('pageConfigBouton'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Config Bouton id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pageConfigBouton = $this->PageConfigBoutons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			
			$file   = $this->request->getData("fichier_tmp");
			if($file['size']){
				$tmp = $file['tmp_name'];
				
				$destination = WWW_ROOT.'import'.DS.'config_pages'.DS.'boutons';
				$dir         = new Folder($destination, true, 0755);
				
				$pathinfos        = pathinfo($file['name']);
				$extension        = $pathinfos['extension'];
				$filename         = Text::uuid()."." . $extension;
				$destination_path = $dir->pwd() . DS . $filename;
				
				if(move_uploaded_file($tmp, $destination_path)){
					// Supprimer l'ancien fichier
					@unlink($destination.DS.$pageConfigBouton['fichier']);
					
					$data['fichier'] = $filename;
					$pageConfigBouton = $this->PageConfigBoutons->patchEntity($pageConfigBouton, $data);
					if ($this->PageConfigBoutons->save($pageConfigBouton)) {
						$this->Flash->success(__('The page config bouton has been saved.'));

						return $this->redirect(['action' => 'index']);
					}
					$this->Flash->error(__('The page config bouton could not be saved. Please, try again.'));
				}
			}else{
				$pageConfigBouton = $this->PageConfigBoutons->patchEntity($pageConfigBouton, $data);
				if ($this->PageConfigBoutons->save($pageConfigBouton)) {
					$this->Flash->success(__('The page config bouton has been saved.'));

					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('The page config bouton could not be saved. Please, try again.'));
			}
        }
        $this->set(compact('pageConfigBouton'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Config Bouton id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageConfigBouton = $this->PageConfigBoutons->get($id);
        if ($this->PageConfigBoutons->delete($pageConfigBouton)) {
			// Supprimer le fichier
			@unlink(WWW_ROOT.DS.'import'.DS.'config_pages'.DS.'boutons'.DS.$pageConfigBouton['fichier']);
            $this->Flash->success(__('The page config bouton has been deleted.'));
        } else {
            $this->Flash->error(__('The page config bouton could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
