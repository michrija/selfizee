<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CatalogueCadreTheme Entity
 *
 * @property int $id
 * @property int $catalogue_cadre_id
 * @property int $theme_id
 *
 * @property \App\Model\Entity\CatalogueCadre $catalogue_cadre
 * @property \App\Model\Entity\Theme $theme
 */
class CatalogueCadreTheme extends Entity
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
        'catalogue_cadre_id' => true,
        'theme_id' => true,
        'catalogue_cadre' => true,
        'theme' => true
    ];
}
