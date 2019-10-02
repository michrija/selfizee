<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Envois Entity
 *
 * @property int $id
 * @property int $contact_id
 * @property string $envoi_type
 * @property bool $is_force_envoi
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Contact $contact
 */
class Envois extends Entity
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
        'user_id' => true,
        'contact_id' => true,
        'envoi_type' => true,
        'is_force_envoi' => true,
        'created' => true,
        'modified' => true,
        'contact' => true,
        'message_id_in_mailjet' => true,
        'message_id_in_smsenvoi' => true,
        'envoi_statistiques' => true,
        'envoi_statistique' => true,
        'queue' => true,
        'source_envoi' => true
    ];
}
