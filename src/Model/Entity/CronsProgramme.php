<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CronsProgramme Entity
 *
 * @property int $id
 * @property bool $is_active_envoi_programme
 * @property bool $is_email_cron_programme
 * @property bool $is_sms_cron_programme
 * @property \Cake\I18n\FrozenTime|null $date_programme
 * @property int|null $evenement_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class CronsProgramme extends Entity
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
        'is_active_envoi_programme' => true,
        'is_email_cron_programme' => true,
        'is_sms_cron_programme' => true,
        'date_programme' => true,
        'evenement_id' => true,
        'evenement' => true,
        'created' => true,
        'modified' => true
    ];
}
