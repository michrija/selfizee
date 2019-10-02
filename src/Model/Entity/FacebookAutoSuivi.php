<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FacebookAutoSuivi Entity
 *
 * @property int $id
 * @property int $facebook_auto_id
 * @property int $photo_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modifed
 *
 * @property \App\Model\Entity\FacebookAuto $facebook_auto
 * @property \App\Model\Entity\Photo $photo
 */
class FacebookAutoSuivi extends Entity
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
        'facebook_auto_id' => true,
        'photo_id' => true,
        'created' => true,
        'modifed' => true,
        'facebook_auto' => true,
        'photo' => true,
        'queue' => true
    ];
}
