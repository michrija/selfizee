<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PageConfigPolice Entity
 *
 * @property int $id
 * @property string $nom_police
 * @property string|null $css_specification
 * @property string $url_police
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class PageConfigPolice extends Entity
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
        'nom_police' => true,
        'css_specification' => true,
        'url_police' => true,
        'created' => true,
        'modified' => true
    ];
}
