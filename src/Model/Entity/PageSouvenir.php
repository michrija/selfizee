<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * PageSouvenir Entity
 *
 * @property int $id
 * @property string $couleur_fond_entete
 * @property string $couleur_fond
 * @property string $img_banniere
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement[] $evenements
 */
class PageSouvenir extends Entity
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
        'couleur_fond_entete' => true,
        'couleur_fond' => true,
        'couleur_download_link' => true,
        'img_banniere' => true,
        'img_bandeau' => true,
        'url_video' => true,
        'created' => true,
        'modified' => true,
        'evenement_id' => true,
        'evenements' => true,
        'is_active_form_down' => true,
        'is_active_video_pub' => true,
        'champs' => true,
        'lien_extern' => true,
        'is_active_lienextern' => true
    ];
    
    protected function _getUrlBanniere()
    {
        return Router::url('/', true).'/import/galleries/head/'.$this->_properties['evenement_id']."/".$this->_properties['img_banniere'] ; 
    }
	
    protected function _getUrlBandeau()
    {
        return Router::url('/', true).'/import/galleries/bandeau/'.$this->_properties['evenement_id']."/".$this->_properties['img_bandeau'] ; 
    }
}
