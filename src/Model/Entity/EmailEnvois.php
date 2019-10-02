<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailEnvois Entity
 *
 * @property int $total_envoi
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class EmailEnvois extends Entity
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
        'total_envoi' => true,
        'evenement_id' => true,
        'evenement' => true
    ];
}
