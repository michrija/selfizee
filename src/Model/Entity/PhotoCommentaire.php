<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PhotoCommentaire Entity
 *
 * @property int $id
 * @property string $commentateur_name
 * @property string $commentaire
 * @property int $photo_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Photo $photo
 */
class PhotoCommentaire extends Entity
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
        'photo_id' => true,
        'created' => true,
        'modified' => true,
        'photo' => true
    ];
}
