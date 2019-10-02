<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConfigborneHasFiltre Entity
 *
 * @property int $id
 * @property int|null $config_borne_id
 * @property int|null $filtre_id
 *
 * @property \App\Model\Entity\ConfigBorne $config_borne
 * @property \App\Model\Entity\Filtre $filtre
 */
class ConfigborneHasFiltre extends Entity
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
        'config_borne_id' => true,
        'filtre_id' => true,
        'config_borne' => true,
        'filtre' => true
    ];
}
