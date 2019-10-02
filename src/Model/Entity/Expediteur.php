<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expediteur Entity
 *
 * @property int $id
 * @property string $email
 * @property bool $is_create_in_mailjet
 * @property bool $is_validate_sent_in_mailjet
 * @property int $client_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Client $client
 */
class Expediteur extends Entity
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
        'email' => true,
        'is_create_in_mailjet' => true,
        'is_validate_sent_in_mailjet' => true,
        'client_id' => true,
        'created' => true,
        'modified' => true,
        'client' => true
    ];
}
