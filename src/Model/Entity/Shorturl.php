<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shorturl Entity
 *
 * @property int $id
 * @property int $spd_id
 * @property string $token
 * @property string $url
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Spd $spd
 */
class Shorturl extends Entity
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
        'spd_id' => true,
        'token' => true,
        'url' => true,
        'created' => true,
        'spd' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
