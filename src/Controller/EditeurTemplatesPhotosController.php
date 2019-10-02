<?php
namespace App\Controller;

include (ROOT.DS.'plugins'.DS.'imageMagician'.DS.'php_image_magician.php');

use App\Controller\AppController;
use Cake\Utility\Text;
use \Cake\Utility\Inflector;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * EditeurTemplatesPhotos Controller
 *
 * @property \App\Model\Table\EditeurTemplatesPhotosTable $EditeurTemplatesPhotos
 *
 * @method \App\Model\Entity\EditeurTemplatesPhoto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EditeurTemplatesPhotosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($tagId= null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
		$this->paginate = [
			'contain' => ['EditeurTemplates','Tags','EditeurTemplatesPhotosHasTags']
		];
		$conditions = [];
		
		if(!empty($this -> request -> data)){
			// Filtre par type d'image
			if(!empty($this -> request -> data['editeur_template_id'])){
				$conditions['editeur_template_id IN'] = $this -> request -> data['editeur_template_id'];
			}
			// Filtre par tags
			if(!empty($this -> request -> data['tag_id'])){
				$this -> paginate['finder'] = ['tags' => ['tag_id' => $this -> request -> data['tag_id']]];
			}
			
		}
		else{
			if(!is_null($tagId)){
				$this -> paginate['finder'] = ['tags' => ['tag_id' => $tagId]];
			}
		}
		
		if(count($conditions)){
			$this -> paginate['conditions'] = $conditions;
		}
		$editeurTemplatesPhotos = $this->paginate($this->EditeurTemplatesPhotos);			
		
		$editeurTemplates = $this->EditeurTemplatesPhotos->EditeurTemplates->find('list', ['limit' => 200,'groupField'=>'type_menu']);
		$editeurTags = $this->EditeurTemplatesPhotos->Tags->find('list',['valueField'=>'nom']);
		
        $this->set(compact('editeurTemplatesPhotos', 'editeurTags', 'editeurTemplates'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $editeurPath = WWW_ROOT.'img'.DS.'editeurs';

        $editeurTemplatesPhoto = $this->EditeurTemplatesPhotos->newEntity();
        if (!is_null($id)) {
             $editeurTemplatesPhoto = $this->EditeurTemplatesPhotos->findById($id)->contain(['Tags'])->first();

        }
        $body = ['status' => 'error'];

        if ($this->request->is(['post','put'])) {
            $this->viewBuilder()->setLayout(false);
            $data = $this->request->getData();
 
            if (!empty($data['file']) && !empty($data['editeur_template_id'])) {

                $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                $newFilename = Text::uuid() . "." . $extension;
                $editeurphoto = $this->EditeurTemplatesPhotos->EditeurTemplates->findById($data['editeur_template_id'])->first();
                $folderEditeur = Inflector::slug(strtolower(Text::slug($editeurphoto->type_editeur)), '_');

                $path = Text::slug($editeurphoto->type_menu).DS.$folderEditeur;
                $targetFilePath = $editeurPath.DS.$path.DS.$newFilename;
                $targetFolder = new Folder($editeurPath.DS.$path, true, 0777);


                $data['file'] = substr($data['file'], strpos($data['file'], ',') + 1);
                $file = base64_decode($data['file']);
                if (file_put_contents($targetFilePath, $file)) {
                    $magicianObj = new \imageLib($targetFilePath);
                    $magicianObj->resizeImage(120, 120, 3);
                    $thumbnailPath = $editeurPath.DS.$path.DS.'thumbnails'.DS.$newFilename;
                    $targetFolder = new Folder($editeurPath.DS.$path.DS.'thumbnails', true, 0777);
                    $magicianObj->saveImage($thumbnailPath, 100);
                    $data['file'] = $data['thumbnail'] = $newFilename;

                    $editeurTemplatesPhoto = $this->EditeurTemplatesPhotos->patchEntity($editeurTemplatesPhoto, $data, ['associated' => ['Tags']]);

                    if (!$editeurTemplatesPhoto->getErrors()) {
                      $editeurTemplatesPhotosEntity = $this->EditeurTemplatesPhotos->save($editeurTemplatesPhoto);
						if (!empty($data['tags'])) {
							$this->loadModel('Tags');
							$this->loadModel('EditeurTemplatesPhotosHasTags');
							$hastags = $this->EditeurTemplatesPhotosHasTags->newEntity();
							foreach ($data['tags'] as $key => $tag) {
								// Si $tag == nombre
								if(is_numeric($tag)){
									$save['editeur_template_photo_id'] = $editeurTemplatesPhotosEntity->id;
									$save['tag_id'] = intval($tag);
									$res = $this->EditeurTemplatesPhotosHasTags->patchEntity($hastags, $save);
									$this->EditeurTemplatesPhotosHasTags->save($res);
								}
								// Sinon on enregistre d'abord le tag
								else{
									// vérifier si le tag existe déjà
									$tagEntity = $this->Tags->find()
									->where(['nom' => trim($tag)])
									->first();
									
									if(empty($tagEntity)){
										$save_tag = [
											'nom' => trim($tag)
										];
										$tags_tp = $this->Tags->newEntity();
										$res_tag = $this->Tags->patchEntity($tags_tp, $save_tag);
										$tagEntity = $this->Tags->save($res_tag);
									}
									
									$save['editeur_template_photo_id'] = $editeurTemplatesPhotosEntity->id;
									$save['tag_id'] = $tagEntity->id;
									$res = $this->EditeurTemplatesPhotosHasTags->patchEntity($hastags, $save);
									$this->EditeurTemplatesPhotosHasTags->save($res);
								}
							}
						}
                        $body = ['status' => 'success'];
                    }
                };

            }

            return $this->response->withType('application/json')->withStringBody(json_encode($body));
        }
        $tags = $this->EditeurTemplatesPhotos->Tags->find('list',['valueField'=>'nom']);

        $editeurTemplates = $this->EditeurTemplatesPhotos->EditeurTemplates->find('list', ['limit' => 200,'groupField'=>'type_menu']);
        $this->set(compact('editeurTemplatesPhoto', 'editeurTemplates','tags'));
    }

	public function lieTag(){
		$this -> autoRender = false;
		$no_error = false;
		if(!empty($this -> request -> data['tag_id']) && !empty($this -> request -> data['photo_id'])){
			
			$photo_id = intval($this -> request -> data['photo_id']);
			$tag_tp = $this -> request -> data['tag_id'];
			
			$list_tag_bd = $this -> EditeurTemplatesPhotos -> EditeurTemplatesPhotosHasTags -> find('list', [
				'conditions' => ['editeur_template_photo_id' => $photo_id], 
				'valueField' => 'tag_id'
			])->toArray();
			
			$this->loadModel('Tags');
			$this->loadModel('EditeurTemplatesPhotosHasTags');
			if(count($list_tag_bd)){
				// list des tag à supprimer
				$tag_to_delete = array_diff($list_tag_bd, $tag_tp);
				foreach($tag_to_delete as $has_tag_id => $value){
					$to_delete = $this->EditeurTemplatesPhotosHasTags->get($has_tag_id);
					// if(!empty($to_delete))
						$this->EditeurTemplatesPhotosHasTags->delete($to_delete);
				}
				
				// List des tag à ajouter
				$tag_to_add = array_diff($tag_tp, $list_tag_bd);
				foreach($tag_to_add as $tag_id){
					
					// Si $tag == nombre
					if(is_numeric($tag_id)){
						$save['editeur_template_photo_id'] = $photo_id;
						$save['tag_id'] = intval($tag_id);
						$hastags = $this->EditeurTemplatesPhotosHasTags->newEntity();
						$res = $this->EditeurTemplatesPhotosHasTags->patchEntity($hastags, $save);
						$this->EditeurTemplatesPhotosHasTags->save($res);
					}
					// Sinon on enregistre d'abord le tag
					else{
						// vérifier si le tag existe déjà
						$tagEntity = $this->Tags->find()
						->where(['nom' => trim($tag_id)])
						->first();
						
						if(empty($tagEntity)){
							$save_tag = [
								'nom' => trim($tag_id)
							];
							$tags_tp = $this->Tags->newEntity();
							$res_tag = $this->Tags->patchEntity($tags_tp, $save_tag);
							$tagEntity = $this->Tags->save($res_tag);
						}
						
						$save = [
							'editeur_template_photo_id' => $photo_id,
							'tag_id' => $tagEntity->id
						];
						$hastags = $this->EditeurTemplatesPhotosHasTags->newEntity();
						$res = $this->EditeurTemplatesPhotosHasTags->patchEntity($hastags, $save);
						$this->EditeurTemplatesPhotosHasTags->save($res);
					}
				}
			}
			// Ajouter Tous
			else{
				foreach($tag_tp as $tag_id){
					
					// Si $tag == nombre
					if(is_numeric($tag_id)){
						$save['editeur_template_photo_id'] = $photo_id;
						$save['tag_id'] = intval($tag_id);
						$hastags = $this->EditeurTemplatesPhotosHasTags->newEntity();
						$res = $this->EditeurTemplatesPhotosHasTags->patchEntity($hastags, $save);
						$this->EditeurTemplatesPhotosHasTags->save($res);
					}
					// Sinon on enregistre d'abord le tag
					else{
						// vérifier si le tag existe déjà
						$tagEntity = $this->Tags->find()
						->where(['nom' => trim($tag_id)])
						->first();
						
						if(empty($tagEntity)){
							$save_tag = [
								'nom' => trim($tag_id)
							];
							$tags_tp = $this->Tags->newEntity();
							$res_tag = $this->Tags->patchEntity($tags_tp, $save_tag);
							$tagEntity = $this->Tags->save($res_tag);
						}
						
						$save = [
							'editeur_template_photo_id' => $photo_id,
							'tag_id' => $tagEntity->id
						];
						$hastags = $this->EditeurTemplatesPhotosHasTags->newEntity();
						$res = $this->EditeurTemplatesPhotosHasTags->patchEntity($hastags, $save);
						$this->EditeurTemplatesPhotosHasTags->save($res);
					}
				}
			}
			$no_error = true;
		}
		echo json_encode($no_error);
	}

    /**
     * Delete method
     *
     * @param string|null $id Editeur Templates Photo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $editeurTemplatesPhoto = $this->EditeurTemplatesPhotos->get($id, ['contain' =>['EditeurTemplates','EditeurTemplatesPhotosHasTags']]);

        $linkFile = WWW_ROOT.'img'.DS.'editeurs'.$editeurTemplatesPhoto->get('filePath');
        $thumbFile = WWW_ROOT.'img'.DS.'editeurs'.$editeurTemplatesPhoto->get('fileThumbnailPath');

        // $file = (new File($linkFile))->delete();
        // $thumb = (new File($thumbFile))->delete();
		// Il ne faut pas supprimer la photo mais changer juste l'etat car elle peut-être déjà utilisée dans un créa
		$save = ['is_deleted' => true];
		$editeurTemplatesPhoto_tp = $this->EditeurTemplatesPhotos->patchEntity($editeurTemplatesPhoto, $save);
		
        // if ($this->EditeurTemplatesPhotos->delete($editeurTemplatesPhoto)) {
        if ($this->EditeurTemplatesPhotos->save($editeurTemplatesPhoto_tp)) {
            $this->Flash->success(__("La photo a été supprimée"));
        } else {
            $this->Flash->error(__('The editeur templates photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);

    }

}
