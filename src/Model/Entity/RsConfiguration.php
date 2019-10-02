<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RsConfiguration Entity
 *
 * @property int $id
 * @property string $desc_facebook
 * @property string $desc_twiter
 * @property string $hashtag_twitter
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class RsConfiguration extends Entity
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
        'desc_facebook' => true,
        'page_souvenir_id' => true,
        'desc_twiter' => true,
        'hashtag_twitter' => true,
        'created' => true,
        'modified' => true,
        'evenement_id' => true,
        'evenement' => true
    ];
}
