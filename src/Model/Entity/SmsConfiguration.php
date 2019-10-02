<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SmsConfiguration Entity
 *
 * @property int $id
 * @property string $expediteur
 * @property string $contenu
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement[] $evenements
 */
class SmsConfiguration extends Entity
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
        'expediteur' => true,
        'contenu' => true,
        'created' => true,
        'modified' => true,
        'evenement_id' => true,
        'evenements' => true,
        'nbr_sms' => true,
        'nb_caractere' => true,
        'limiter_un_sms' => true,
        'is_active' => true,
        'date_heure_envoi' => true,
        'clients_modeles_sms_id' => true,
        'is_envoi_plannifie' => true
    ];
}
