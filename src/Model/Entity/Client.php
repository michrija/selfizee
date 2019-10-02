<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $adresse
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Evenement[] $evenements
 * @property \App\Model\Entity\User[] $users
 */
class Client extends Entity
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
        '*' => true
    ];

    protected function _getUrlLogoHeaderPageGalerie()
    {
        return Router::url('/', true).'/import/clients/'.$this->_properties['logo_header_page_galerie'] ;
    }

    protected function _getUrlLogoPageBo()
    {
        return Router::url('/', true).'/import/clients/'.$this->_properties['logo_page_bo'] ;
    }

    protected function _getUrlFavicon()
    {
        return Router::url('/', true).'/import/clients/'.$this->_properties['favicon'] ;
    }

    protected function _getUrlImgFondLogin()
    {
        return Router::url('/', true).'/import/clients/'.$this->_properties['img_fond_login'] ;
    }

    protected function _setUrlBo($urlBo){
        if(!empty($urlBo)){
            $urlBo = parse_url($urlBo, PHP_URL_HOST);
        }
        return $urlBo;
    }
}
