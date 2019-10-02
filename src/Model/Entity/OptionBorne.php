<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OptionBorne Entity
 *
 * @property int $id
 * @property string $chemin_dossier_assets
 * @property string $chemin_dossier_events
 * @property string $fichier_setting_base
 * @property string $ftp_server
 * @property string|resource $ftp_username
 * @property string $ftp_password
 * @property string $ftp_port
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class OptionBorne extends Entity
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
        'chemin_dossier_assets' => true,
        'chemin_dossier_events' => true,
        'fichier_setting_base' => true,
        'chemin_dossier_presets' => true,
        'ftp_server' => true,
        'ftp_username' => true,
        'ftp_password' => true,
        'ftp_port' => true,
        'created' => true,
        'modified' => true
    ];
}
