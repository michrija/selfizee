<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FondVert Entity
 *
 * @property int $id
 * @property string $file_name
 * @property int $ordre
 * @property int $configuration_borne_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ConfigurationBorne $configuration_borne
 */
class FondVert extends Entity
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
        'file_name' => true,
        'ordre' => true,
        'configuration_borne_id' => true,
        'created' => true,
        'modified' => true,
        'configuration_borne' => true
    ];
}
