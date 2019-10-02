<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GalerieEmail Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $destinateurs
 * @property int $galerie_id
 *
 * @property \App\Model\Entity\Galery $galery
 */
class GalerieEmail extends Entity
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
        'date' => true,
        'destinateurs' => true,
        'galerie_id' => true,
        'galery' => true,
        'client_id' => true,
        'evenement_id' => true
    ];
}
