<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HistoriqueConnexion Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $galerie_id
 * @property int $evenement_id
 * @property string $queue
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Galery $galery
 * @property \App\Model\Entity\Evenement $evenement
 */
class HistoriqueConnexion extends Entity
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
        'galerie_id' => true,
        'evenement_id' => true,
        'queue' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'galery' => true,
        'evenement' => true
    ];
}
