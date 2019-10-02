<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GalerieCommentaire Entity
 *
 * @property int $id
 * @property string $commentateur_name
 * @property string $commentaire
 * @property int $galerie_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Galery $galery
 */
class GalerieCommentaire extends Entity
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
        'commentateur_name' => true,
        'commentaire' => true,
        'galerie_id' => true,
        'created' => true,
        'modified' => true,
        'galery' => true
    ];
}
