<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MajInfoRgpd Entity
 *
 * @property int $id
 * @property int|null $photo_id
 * @property string|null $champ_modifie
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $modifieur
 *
 * @property \App\Model\Entity\Photo $photo
 */
class MajInfoRgpd extends Entity
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
        'photo_id' => true,
        'champ_modifie' => true,
        'created' => true,
        'modified' => true,
        'modifieur' => true,
        'photo' => true
    ];
}
