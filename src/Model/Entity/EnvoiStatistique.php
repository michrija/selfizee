<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnvoiStatistique Entity
 *
 * @property int $id
 * @property bool $is_opened
 * @property \Cake\I18n\FrozenTime $opened_at
 * @property \Cake\I18n\FrozenTime $arrived_at
 * @property int $envoi_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Envois $envois
 */
class EnvoiStatistique extends Entity
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
        'is_opened' => true,
        'opened_at' => true,
        'arrived_at' => true,
        'envoi_id' => true,
        'created' => true,
        'modified' => true,
        'envois' => true
    ];
}
