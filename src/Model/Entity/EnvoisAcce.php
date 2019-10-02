<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnvoisAcce Entity
 *
 * @property int $id
 * @property string|null $destinateurs
 * @property int|null $user_id
 * @property int|null $evenement_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Evenement $evenement
 */
class EnvoisAcce extends Entity
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
        'destinateurs' => true,
        'user_id' => true,
        'evenement_id' => true,
        'created' => true,
        'user' => true,
        'evenement' => true
    ];
}
