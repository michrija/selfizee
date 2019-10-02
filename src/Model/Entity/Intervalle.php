<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Intervalle Entity
 *
 * @property int $id
 * @property string $intervalle
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Cron[] $crons
 */
class Intervalle extends Entity
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
        'intervalle' => true,
        'created' => true,
        'modified' => true,
        'crons' => true
    ];
}
