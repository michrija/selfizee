<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PhotoDownload Entity
 *
 * @property int $id
 * @property int $photo_id
 * @property string $ip
 * @property int $source_download
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Photo $photo
 */
class PhotoDownload extends Entity
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
        'photo_id' => true,
        'ip' => true,
        'source_download' => true,
        'created' => true,
        'modified' => true,
        'photo' => true,
        'queue' => true
    ];
}
