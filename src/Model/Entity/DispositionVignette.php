<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DispositionVignette Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $file_name
 * @property int $nbr_pose
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenDate $modified
 *
 * @property \App\Model\Entity\ConfigurationBorne[] $configuration_bornes
 */
class DispositionVignette extends Entity
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
        'file_name' => true,
        'nbr_pose' => true,
        'created' => true,
        'modified' => true,
        'configuration_bornes' => true
    ];
}
