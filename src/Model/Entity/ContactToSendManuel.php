<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactToSendManuel Entity
 *
 * @property int $id
 * @property int $contact_id
 * @property int $envoi_manuel_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Contact $contact
 * @property \App\Model\Entity\EnvoiManuel $envoi_manuel
 */
class ContactToSendManuel extends Entity
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
        'contact_id' => true,
        'envoi_manuel_id' => true,
        'created' => true,
        'modified' => true,
        'contact' => true,
        'envoi_manuel' => true,
        'is_send' => true
    ];
}
