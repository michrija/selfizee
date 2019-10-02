<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;
use Cake\Core\Configure;

/**
 * Photo Entity
 *
 * @property int $id
 * @property string $name_origne
 * @property string $name
 * @property bool $is_postable_on_facebook
 * @property bool $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\Contact[] $contacts
 */
class Photo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => false,
        '*' =>true
    ];
    
    protected $_virtual = ['url_photo','url_thumb_bo','url_photo_souvenir','uri_photo','url_thumb_popup','url_thumb_souv','url_photo_shell','url_photo_souvenir_shell', 'url_photo_local','url_miniature_video',];
    
    
    protected function _getUrlPhotoSouvenir(){
        return Configure::read('url_front_domaine').'p/'.$this->_properties['token'];
    }
    
    protected function _getUrlPhotoSouvenirShell(){
        return Configure::read('url_front_domaine').'p/'.$this->_properties['token'];
    }

    //url_miniature_video
    protected function _getUrlMiniatureVideo(){
        if(isset($this->_properties['miniature_video'])){
            $miniautreVideo = $this->_properties['miniature_video'];
            $miniaturePath = WWW_ROOT."import".DS."galleries".DS. $this->_properties['evenement_id'].DS.'miniature_video'.DS.$miniautreVideo;
            if(!empty($miniautreVideo) && file_exists($miniaturePath)){
                return Configure::read('url_front_domaine').'import/galleries/'.$this->_properties['evenement_id']."/miniature_video/".$this->_properties['miniature_video'] ; 
            }  
        }
        return Configure::read('url_front_domaine').'img/paysage.png';
    }
    
    protected function _getUrlPhoto()
    {

        if(isset($this->_properties['is_croppee']) && $this->_properties['is_croppee']) { // modif CA22

            return Configure::read('url_front_domaine').'import/galleries/'.$this->_properties['evenement_id'].'/crop/'.$this->_properties['name'] ;
        }
        return Configure::read('url_front_domaine').'import/galleries/'.$this->_properties['evenement_id']."/".$this->_properties['name'] ; 
    }
//////////////////////////////////////////////////////
    protected function _getUrlPhotoLocal()
    {
        return Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/".$this->_properties['name'] ; 
    }
  ///////////////////////////////////////////////////  
    protected function _getUrlPhotoShell()
    {

        if(isset($this->_properties['is_croppee']) && $this->_properties['is_croppee']) { // modif CA22

            return Configure::read('url_front_domaine').'import/galleries/'.$this->_properties['evenement_id'].'/crop/'.$this->_properties['name'] ;
        }
        return Configure::read('url_front_domaine').'import/galleries/'.$this->_properties['evenement_id']."/".$this->_properties['name'] ; 
    }
    
    protected function _getUrlThumbBo()
    {
        $urlBo =  Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/".$this->_properties['name'] ;
        if(isset($this->_properties['is_croppee']) && $this->_properties['is_croppee']) { // modif CA22
            $urlBo = Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id'].'/crop/'.$this->_properties['name'] ;
            return $urlBo;
        }
        
        //debug($urlBo)
        $path = WWW_ROOT."import".DS."galleries".DS. $this->_properties['evenement_id'].DS.'thumbnails'.DS.'thumb_bo_'.$this->_properties['name'];

        if(file_exists($path)){
            $urlBo = Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/thumbnails/thumb_bo_".$this->_properties['name'];
        }
        return $urlBo;
    }
    
     protected function _getUrlThumbSouv()
    {
        $urlBo =  Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/".$this->_properties['name'] ;
        

        if(isset($this->_properties['is_croppee']) && $this->_properties['is_croppee']) { // modif CA22

            $urlBo = Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id'].'/crop/'.$this->_properties['name'] ;
            return $urlBo;
        }
        //debug($urlBo)
        $path = WWW_ROOT."import".DS."galleries".DS. $this->_properties['evenement_id'].DS.'thumbnails'.DS.'thumb_souv_'.$this->_properties['name'];
        if(file_exists($path)){
            $urlBo = Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/thumbnails/thumb_souv_".$this->_properties['name'];
        }
        return $urlBo;
    }
    
     protected function _getUrlThumbPopup()
    {
        $urlBo =  Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/".$this->_properties['name'] ;
        if(isset($this->_properties['is_croppee']) && $this->_properties['is_croppee']) { // modif CA22
            $urlBo = Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id'].'/crop/'.$this->_properties['name'] ;
            return $urlBo;
        }
        //debug($urlBo)
        $path = WWW_ROOT."import".DS."galleries".DS. $this->_properties['evenement_id'].DS.'thumbnails'.DS.'thumb_popup_'.$this->_properties['name'];
        if(file_exists($path)){
            $urlBo = Router::url('/', true).'import/galleries/'.$this->_properties['evenement_id']."/thumbnails/thumb_popup_".$this->_properties['name'];
        }
        return $urlBo;
    }
    
    protected function _setName($name){
        
        $mt = microtime();
        $token     = hash("crc32", $mt);
        $this->set('token', $token);
        return $name;
    }
    
    
    protected function _getUriPhoto()
    {
        if(isset($this->_properties['is_croppee']) && $this->_properties['is_croppee']) { // modif CA22
            return WWW_ROOT . "import" . DS . "galleries" . DS . $this->_properties['evenement_id'] . DS. 'crop' . DS .$this->_properties['name'];
        }
        return WWW_ROOT . "import" . DS . "galleries" . DS . $this->_properties['evenement_id'] . DS . $this->_properties['name'];
    }
}
