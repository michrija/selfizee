<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GalerieDownload Entity
 *
 * @property int $id
 * @property int $galerie_id
 * @property int $source_download
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Galery $galery
 */
class GalerieDownload extends Entity
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
        'source_download' => true,
        'created' => true,
        'modified' => true,
        'galery' => true,
        'queue' => true,
        'evenement_id' => true,
        'evenement' =>true
    ];
}
