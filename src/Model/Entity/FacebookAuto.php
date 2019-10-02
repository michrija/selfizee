<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FacebookAuto Entity
 *
 * @property int $id
 * @property int $evenement_id
 * @property string $id_in_facebook
 * @property string $token_facebook
 * @property string $id_album_in_facebook
 * @property string $name_in_facebook
 * @property string $name_album_in_facebook
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\FacebookAutoSuivi[] $facebook_auto_suivis
 */
class FacebookAuto extends Entity
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
        'evenement_id' => true,
        'id_in_facebook' => true,
        'token_facebook' => true,
        'id_album_in_facebook' => true,
        'name_in_facebook' => true,
        'name_album_in_facebook' => true,
        'evenement' => true,
        'facebook_auto_suivis' => true,
        'is_active' => true,
        'date_debut' => true,
        'date_fin' => true,
        'intervalle_id' => true,
        'created' => true,
        'modified' => true,
        'evenement' => true,
        'intervalle' => true,
        'is_programmee' => true,
        'date_programmee' => true

    ];
}
