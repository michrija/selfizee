<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Catalogue Entity
 *
 * @property int $id
 * @property string|null $nom
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ConfigBorne[] $config_bornes
 */
class Catalogue extends Entity
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
        /*'nom' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'config_bornes' => true*/
    ];
}
