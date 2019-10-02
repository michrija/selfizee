<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EvenementStatCampaign Entity
 *
 * @property int $id
 * @property int $evenement_id
 * @property string $event_click_delay
 * @property int $event_clicked_count
 * @property string $event_open_delay
 * @property int $event_opened_count
 * @property int $event_spam_count
 * @property int $event_unsubscribed_count
 * @property int $event_workflow_exited_count
 * @property int $message_blocked_count
 * @property int $message_clicked_count
 * @property int $message_deferred_count
 * @property int $message_hard_bounced_count
 * @property int $message_opened_count
 * @property int $message_queued_count
 * @property int $message_sent_count
 * @property int $message_soft_bounced_count
 * @property int $message_spam_count
 * @property int $message_unsubscribed_count
 * @property int $message_workflow_exited_count
 * @property int $source_id
 * @property int $total
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\Source $source
 */
class EvenementStatCampaign extends Entity
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
        'event_click_delay' => true,
        'event_clicked_count' => true,
        'event_open_delay' => true,
        'event_opened_count' => true,
        'event_spam_count' => true,
        'event_unsubscribed_count' => true,
        'event_workflow_exited_count' => true,
        'message_blocked_count' => true,
        'message_clicked_count' => true,
        'message_deferred_count' => true,
        'message_hard_bounced_count' => true,
        'message_opened_count' => true,
        'message_queued_count' => true,
        'message_sent_count' => true,
        'message_soft_bounced_count' => true,
        'message_spam_count' => true,
        'message_unsubscribed_count' => true,
        'message_workflow_exited_count' => true,
        'source_id' => true,
        'total' => true,
        'evenement' => true,
        'source' => true
    ];
}
