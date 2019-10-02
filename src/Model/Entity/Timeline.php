<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timeline Entity
 *
 * @property int $nbr
 * @property int $type_timeline
 * @property \Cake\I18n\FrozenTime $date_timeline
 * @property string $queue
 * @property int $evenement_id
 * @property string $source_timeline
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class Timeline extends Entity
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
        'nbr' => true,
        'user_id' => true,
        'type_timeline' => true,
        'date_timeline' => true,
        'queue' => true,
        'evenement_id' => true,
        'source_timeline' => true,
        'evenement' => true
    ];
}
