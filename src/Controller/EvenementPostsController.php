<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use Cake\Utility\Text;
use Cake\Routing\Router;

/**
 * EvenementPosts Controller
 *
 * @property \App\Model\Table\EvenementPostsTable $EvenementPosts
 *
 * @method \App\Model\Entity\EvenementPost[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvenementPostsController extends AppController
{

	public function isAuthorized($user)
    {
		$isConfiguration = true;
		$this -> set(compact('isConfiguration'));
		return parent::isAuthorized($user);
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Evenements']
        ];
        $evenementPosts = $this->paginate($this->EvenementPosts);

        $this->set(compact('evenementPosts'));
    }

	public function liste($idEvenement = null){
		$this->paginate = [
			'contain' => ['Evenements']
		];
	
		if($idEvenement){
			$this -> paginate = [
				'conditions' => ['evenement_id' => $idEvenement]
			];
			$evenement = $this->EvenementPosts->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
		}
		$evenementPosts = $this->paginate($this->EvenementPosts);

        //$url_rgpd = "https://rgpd.selfizee.fr/";
        //$url_content_domaine = is_null(Configure::read('url_content_domaine')) ? '/' : Configure::read('url_content_domaine');
        $url_content_domaine = is_null(Configure::read('url_front_domaine')) ? '/' : Configure::read('url_front_domaine');
        $this->set(compact('evenementPosts', 'idEvenement', 'evenement', 'url_content_domaine'));
        $this->set('isConfiguration',true);
	}
	
    /**
     * View method
     *
     * @param string|null $id Evenement Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evenementPost = $this->EvenementPosts->get($id, [
            'contain' => ['Evenements']
        ]);

        $this->set('evenementPost', $evenementPost);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement)
    {
        $evenementPost = $this->EvenementPosts->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            //$data['slug'] = $this::createSlug($data['titre']);
            //debug($data);die;
            $slug_exist = $this->EvenementPosts->find('all')
                                                ->where(['EvenementPosts.slug' => $data['slug']])                                                
                                                ->where(['EvenementPosts.evenement_id' => $idEvenement])
                                                ->first();
            if($slug_exist){
                $post_list_like_same_slug = $this->EvenementPosts->find('all')
                                                ->where(['slug LIKE' => '%'.$data['slug']])                                                
                                                ->where(['EvenementPosts.evenement_id' => $idEvenement])
                                                ->toArray();
                $post_list_like_same_slug_2 = $this->EvenementPosts->find('all')
                                                ->where(['slug LIKE' => '%'.$data['slug'].'-%'])
                                                ->where(['EvenementPosts.evenement_id' => $idEvenement])
                                                ->toArray();
                //debug($post_list_like_same_slug_2);die;
                $new_index = count($post_list_like_same_slug) + 1;
                if($post_list_like_same_slug_2) {
                    $new_index = count($post_list_like_same_slug) + count($post_list_like_same_slug_2) + 1;
                }
                $new_slug = $data['slug']."-".$new_index;
                $data['slug']  = $new_slug;
                //debug($new_slug);die;
            }

            $evenementPost = $this->EvenementPosts->patchEntity($evenementPost, $data );
            $evenementPost->evenement_id = $idEvenement;
            if ($this->EvenementPosts->save($evenementPost)) {

                //===== save_img_contenu
                if(!empty($data['img_contents'])){                     
                    $destination = WWW_ROOT."import".DS."img_gestion_contenu".DS. $idEvenement.DS.$evenementPost->id.DS;
                    $dir         = new Folder($destination, true, 0755);
                    //debug($dir);die;
                    foreach ($data['img_contents'] as $key => $img) {
                        # code...
                        $destination_path = $dir->pwd() . $img;
                        //debug(UPLOAD_TMP .DS. $img);debug($destination_path);die;
                        if(file_exists(UPLOAD_TMP .DS. $img)){
                            if (copy(UPLOAD_TMP .DS. $img, $destination_path)) {
                                    unlink(UPLOAD_TMP .DS. $img);
                                    if(substr_count($data['contenus'], 'upload/tmp') > 0) {
                                        $url_img_tmp = array('upload/tmp');
                                        $url_img_exact = array('import/img_gestion_contenu/'.$idEvenement.'/'.$evenementPost->id);
                                        $data['contenus'] = str_replace($url_img_tmp, $url_img_exact, $data['contenus']);
                                    } 
                            }
                        }
                    }
                }
                //updat url img 
                $evenementPost->contenus = $data['contenus'];
                $this->EvenementPosts->save($evenementPost);

                $this->Flash->success(__('The evenement post has been saved.'));
                return $this->redirect(['action' => 'liste', $idEvenement]);
            }
            $this->Flash->error(__('The evenement post could not be saved. Please, try again.'));
        }
        //$evenements = $this->EvenementPosts->Evenements->find('list', ['limit' => 200]);
		$evenement = $this->EvenementPosts->Evenements->get($idEvenement,['contain'=>['Galeries','Fonctionnalites']]);
        $this->set(compact('evenementPost', 'idEvenement', 'evenement'));
        $this->set('isConfiguration',true);

    }

    /**
     * Edit method
     *
     * @param string|null $id Evenement Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evenementPost = $this->EvenementPosts->get($id, [
            'contain' => []
        ]);
        //$old_slug = $evenementPost->slug;
        $idEvenement = $evenementPost->evenement_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //$data['slug'] = $this::createSlug($data['titre']);
            //debug($old_slug);die;
            $slug_exist = $this->EvenementPosts->find('all')
                                                ->where(['EvenementPosts.slug' => $data['slug']])                                         
                                                ->where(['EvenementPosts.evenement_id' => $idEvenement])
                                                ->first();
            if($slug_exist){
                $post_list_like_same_slug = $this->EvenementPosts->find('all')
                                                ->where(['slug LIKE' => '%'.$data['slug']])                                                
                                                ->where(['EvenementPosts.evenement_id' => $idEvenement])
                                                ->toArray();
                $post_list_like_same_slug_2 = $this->EvenementPosts->find('all')
                                                ->where(['slug LIKE' => '%'.$data['slug'].'-%'])
                                                ->where(['EvenementPosts.evenement_id' => $idEvenement])
                                                ->toArray();
                //debug($post_list_like_same_slug_2);die;
                $new_index = count($post_list_like_same_slug) + 1;
                if($post_list_like_same_slug_2) {
                    $new_index = count($post_list_like_same_slug) + count($post_list_like_same_slug_2) + 1;
                }
                $new_slug = $data['slug']."-".$new_index;
                $data['slug']  = $new_slug;
            }


            //===== Supp _img_contenu
            if (!empty($data['img_contents_to_delete'])) {
                $listImgToDelete = $data['img_contents_to_delete'];
                foreach ($listImgToDelete as $img) {

                    if(file_exists(UPLOAD_TMP .DS. $img)){
                            unlink(UPLOAD_TMP .DS. $img);
                    }

                    if(file_exists(WWW_ROOT."import".DS."img_gestion_contenu".DS. $idEvenement .DS. $id .DS. $img)){
                            unlink(WWW_ROOT."import".DS."img_gestion_contenu".DS. $idEvenement .DS. $id .DS. $img);
                    }
                }
            }

            $evenementPost = $this->EvenementPosts->patchEntity($evenementPost, $data );
            if ($this->EvenementPosts->save($evenementPost)) {

                //===== save_img_contenu
                if(!empty($data['img_contents'])){                     
                    $destination = WWW_ROOT."import".DS."img_gestion_contenu".DS. $idEvenement.DS.$evenementPost->id.DS;
                    $dir         = new Folder($destination, true, 0755);
                    //debug($dir);die;
                    foreach ($data['img_contents'] as $key => $img) {
                        # code...
                        $destination_path = $dir->pwd() . $img;
                        //debug(UPLOAD_TMP .DS. $img);debug($destination_path);die;
                        if(file_exists(UPLOAD_TMP .DS. $img)){
                            if (copy(UPLOAD_TMP .DS. $img, $destination_path)) {
                                    unlink(UPLOAD_TMP .DS. $img);
                                    if(substr_count($data['contenus'], 'upload/tmp') > 0) {
                                        $url_img_tmp = array('upload/tmp');
                                        $url_img_exact = array('import/img_gestion_contenu/'.$idEvenement.'/'.$evenementPost->id);
                                        $data['contenus'] = str_replace($url_img_tmp, $url_img_exact, $data['contenus']);
                                    } 
                            }
                        }
                    }
                }
                //updat url img 
                $evenementPost->contenus = $data['contenus'];
                $this->EvenementPosts->save($evenementPost);

                $this->Flash->success(__('The evenement post has been saved.'));

                return $this->redirect(['action' => 'liste', $idEvenement]);
            }
            $this->Flash->error(__('The evenement post could not be saved. Please, try again.'));
        }
        //$evenements = $this->EvenementPosts->Evenements->find('list', ['limit' => 200]);
		$evenement = $this->EvenementPosts->Evenements->get($idEvenement);
        $this->set(compact('evenementPost', 'idEvenement', 'evenement'));
        $this->set('isConfiguration',true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evenement Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evenementPost = $this->EvenementPosts->get($id);
        $idEvenement = $evenementPost->evenement_id;
        if ($this->EvenementPosts->delete($evenementPost)) {
            $this->Flash->success(__('The evenement post has been deleted.'));
        } else {
            $this->Flash->error(__('The evenement post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'liste', $idEvenement]);
    }


    public function uploadImgEditeur(){

        $this->autoRender = false;
        $res ['success'] = false;
        $file   = $this->request->getData('imageField');
        //debug($file);die;
        //echo json_encode($file);die;

        $destination = WWW_ROOT."upload".DS."tmp".DS;
        $dir         = new Folder($destination, true, 0755);
             
        if(empty($file['error']) && !empty($file['name'])){
                $filenameOrigine    = $file['name'];
                $tmp = $file['tmp_name'];
               
                $pathinfos        = pathinfo($file['name']);
                $file             = $pathinfos['filename'];
                $extension        = $pathinfos['extension'];
                $filename         = Text::uuid()."." . $extension;
                $destination_path = $destination . $filename;

                if(move_uploaded_file($tmp, $destination_path)){
                    $res ['success'] = true;
                    $res ['filename'] = $filename;
                    $res ['url'] = Router::url('/', true)."upload/tmp/".$filename;
                }               
        }
        //debug($res);die;
        echo json_encode($res); 
    }

    public function deleteImgEditeur(){

        $this->autoRender = false;
        $res ['success'] = false;
        $file   = $this->request->getData('imageName');
        //debug($file);die;
        if(file_exists(UPLOAD_TMP .DS. $file)){
            unlink(UPLOAD_TMP .DS. $file);
            $res ['success'] = true;
        }
        echo json_encode($res); 
    }
}

