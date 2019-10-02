<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CatalogueTheme Entity
 *
 * @property int $id
 * @property int $catalogue_id
 * @property int $theme_id
 *
 * @property \App\Model\Entity\Catalogue $catalogue
 * @property \App\Model\Entity\Theme $theme
 */
class CatalogueTheme extends Entity
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
        'catalogue_id' => true,
        'theme_id' => true,
        'catalogue' => true,
        'theme' => true
    ];
}
