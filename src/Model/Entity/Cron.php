<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cron Entity
 *
 * @property int $id
 * @property bool $is_active
 * @property bool $is_cron_email
 * @property bool $is_cron_sms
 * @property \Cake\I18n\FrozenTime $date_debut
 * @property \Cake\I18n\FrozenTime $date_fin
 * @property int $evenement_id
 * @property int $intervalle_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\Intervalle $intervalle
 */
class Cron extends Entity
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
        'is_active' => true,
        'is_cron_email' => true,
        'is_cron_sms' => true,
        'date_debut' => true,
        'date_fin' => true,
        'evenement_id' => true,
        'intervalle_id' => true,
        'created' => true,
        'modified' => true,
        'evenement' => true,
        'intervalle' => true
    ];
}
