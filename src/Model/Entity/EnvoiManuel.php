<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnvoiManuel Entity
 *
 * @property int $id
 * @property string $email_notify
 * @property int $evenement_id
 * @property bool $is_email
 * @property bool $is_sms
 * @property bool $is_force_envoi
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\ContactToSendManuel[] $contact_to_send_manuels
 */
class EnvoiManuel extends Entity
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
        'email_notify' => true,
        'evenement_id' => true,
        'is_email' => true,
        'is_sms' => true,
        'is_force_envoi' => true,
        'created' => true,
        'modified' => true,
        'evenement' => true,
        'contact_to_send_manuels' => true,
        'is_all_send' => true,
        'is_reenvoie_notsent' => true
    ];
}
