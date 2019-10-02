<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Filtre Entity
 *
 * @property int $id
 * @property string $nom
 * @property int $filtre_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\FiltreConfigurationBorne[] $filtre_configuration_bornes
 */
class Filtre extends Entity
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
        'nom' => true,
        'filtre_type' => true,
        'created' => true,
        'modified' => true,
        'filtre_configuration_bornes' => true
    ];
}
