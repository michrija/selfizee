<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Galery Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $slug
 * @property string $is_public
 * @property string $titre
 * @property string $sous_titre
 * @property string $couleur
 * @property string $img_banniere
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Galery extends Entity
{
    const PATH_GALERIE_BANIERE_APERCU = WWW_ROOT."import".DS."galleries".DS."head_apercu". DS;

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
        'nom' => true,
        'slug' => true,
        'is_public' => true,
        'titre' => true,
        'sous_titre' => true,
        'couleur' => true,
        'img_banniere' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
        'user' => true,
        'evenements' => true,
        'is_livredor_active' => true,
        'invited_can_upload_photo' => true,
        'is_photo_invited_must_moderate' => true,
        'email_to_notify' => true,
    ];
    
    protected function _getUrlBanniere()
    {
        return Router::url('/', true).'/import/galleries/head/album-'.$this->_properties['id']."/".$this->_properties['img_banniere'] ; 
    }
    
    protected function _getUrlBanniereSouvenir(){
        
        if(!empty($this->_properties['img_banniere'])){
            return Router::url('/', true).'/import/galleries/head/album-'.$this->_properties['id']."/".$this->_properties['img_banniere'] ;
        }else{
            return Router::url('/', true).'/webroot/img/images_banGal.jpg' ;
        }
    }

    protected function _getUrlBanniereSouvenirApercu(){
        
        if(!empty($this->_properties['img_banniere'])){
            return '/import/galleries/head_apercu/'.$this->_properties['img_banniere'] ;
        }else{
            return '/img/images_banGal.jpg' ;
        }
    }
    
    protected function _getIdEncode(){
          return rtrim(strtr(base64_encode($this->_properties['id']), '+/', '-_'), '='); 
    }
    
     protected function _getSlug($slug)
    {
        return strtoupper($slug);
    }
    
     protected function _getNom($nom)
    {
        return strtoupper($nom);
    }
    
    
}
