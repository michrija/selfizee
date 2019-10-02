<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DownloadConfiguration Entity
 *
 * @property int $id
 * @property bool $is_oblig_ajout_infos_av_down
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class DownloadConfiguration extends Entity
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
        'is_oblig_ajout_infos_av_down' => true,
        'evenement_id' => true,
        'evenement' => true,
        'client_id' =>true,
        'client' => true,
        'is_nom_active' => true,
        'is_prenoms_active' => true,
        'is_tel_active' => true,
        'is_email_active' => true,
        'is_optin_active' => true,
    ];
}
