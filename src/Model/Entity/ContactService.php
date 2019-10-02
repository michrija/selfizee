<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactService Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $email
 * @property string $objet
 * @property string $message
 */
class ContactService extends Entity
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
        'nom' => true,
        'email' => true,
        'objet' => true,
        'message' => true
    ];
}
