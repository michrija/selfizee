<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ImageFond Entity
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $file_name
 * @property string|null $nom_origine
 * @property string|null $chemin
 * @property int|null $nbr_pose
 * @property int|null $theme_id
 * @property int|null $format_id
 * @property int|null $catalogue_id
 * @property int|null $configuration_animation_id
 * @property int|null $configuration_borne_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Theme $theme
 * @property \App\Model\Entity\Format $format
 * @property \App\Model\Entity\Catalogue $catalogue
 * @property \App\Model\Entity\ConfigurationAnimation $configuration_animation
 * @property \App\Model\Entity\ConfigurationBorne $configuration_borne
 */
class ImageFond extends Entity
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
        'type' => true,
        'file_name' => true,
        'nom_origine' => true,
        'chemin' => true,
        'nbr_pose' => true,
        'theme_id' => true,
        'format_id' => true,
        'catalogue_id' => true,
        'configuration_animation_id' => true,
        'configuration_borne_id' => true,
        'created' => true,
        'modified' => true,
        'theme' => true,
        'format' => true,
        'catalogue' => true,
        'configuration_animation' => true,
        'configuration_borne' => true
    ];
}
