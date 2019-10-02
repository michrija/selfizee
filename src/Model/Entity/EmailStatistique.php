<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailStatistique Entity
 *
 * @property int $id
 * @property int $evenement_id
 * @property float $opened_percent
 * @property float $delivered_percent
 * @property float $clicked_percent
 * @property float $blocked_percent
 * @property float $spam_percent
 * @property float $average_click_delays
 * @property float $average_open_delays
 * @property float $average_opened_count
 * @property float $delivere_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class EmailStatistique extends Entity
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
        'evenement_id' => true,
        'opened_percent' => true,
        'delivered_percent' => true,
        'clicked_percent' => true,
        'blocked_percent' => true,
        'spam_percent' => true,
        'average_click_delays' => true,
        'average_open_delays' => true,
        'average_opened_count' => true,
        'delivere_count' => true,
        'created' => true,
        'modified' => true,
        'evenement' => true
    ];
}
