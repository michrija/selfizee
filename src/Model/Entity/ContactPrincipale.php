<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactPrincipale Entity
 *
 * @property int $id
 * @property string|null $contact_name
 * @property string|null $adresse
 * @property string|null $email
 * @property string|null $mobile
 * @property \Cake\I18n\FrozenTime|null $created
 * @property int|null $contact_client_id
 *
 * @property \App\Model\Entity\ContactClient $contact_client
 */
class ContactPrincipale extends Entity
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
        'id' => false,
        '*' => true
    ];
}
