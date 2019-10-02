<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConfigurationBornesFiltre Entity
 *
 * @property int $id
 * @property int|null $filtre_id
 * @property int|null $configuration_borne_id
 *
 * @property \App\Model\Entity\Filtre $filtre
 * @property \App\Model\Entity\ConfigurationBornesOld $configuration_bornes_old
 */
class ConfigurationBornesFiltre extends Entity
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
        'filtre_id' => true,
        'configuration_borne_id' => true,
        'filtre' => true,
        'configuration_bornes_old' => true
    ];
}
