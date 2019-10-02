<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visiteur Entity
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $email
 *
 * @property \App\Model\Entity\Photo[] $photos
 */
class Visiteur extends Entity
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
        'full_name' => true,
        'email' => true,
        'photos' => true,
        'evenement_id' => true,
        'is_notification_send' => true
    ];
}
