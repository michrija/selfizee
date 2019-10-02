<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * PageConfigBouton Entity
 *
 * @property int $id
 * @property string|null $tag
 * @property string $fichier
 * @property bool|null $est_supprimer
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class PageConfigBouton extends Entity
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
        'tag' => true,
        'fichier' => true,
        'created' => true,
        'modified' => true
    ];
	
	protected function _getUrlBouton()
    {
        $url =  Router::url('/', true).'import/config_pages/boutons';
        return $url;
    }
	
}
