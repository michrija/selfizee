<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Licence Entity
 *
 * @property int $id
 * @property string|null $id_borne
 * @property string|null $duree
 * @property string|null $numero_serie_non_crypte
 * @property string|null $numero_serie_crypte
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Licence extends Entity
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
        'id_borne' => true,
        'duree' => true,
        'numero_serie_non_crypte' => true,
        'numero_serie_crypte' => true,
        'created' => true,
        'modified' => true
    ];

    protected function _getIdEncode(){
        return rtrim(strtr(base64_encode($this->_properties['id']), '+/', '-_'), '=');
    }

}
