<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientsModelesSms Entity
 *
 * @property int $id
 * @property string $nom_modele
 * @property string $expediteur
 * @property string $contenu
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $client_id
 * @property int $nb_caractere
 * @property int $nbr_sms
 *
 * @property \App\Model\Entity\Client $client
 */
class ClientsModelesSms extends Entity
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
        'nom_modele' => true,
        'expediteur' => true,
        'contenu' => true,
        'created' => true,
        'modified' => true,
        'client_id' => true,
        'nb_caractere' => true,
        'nbr_sms' => true,
        'client' => true
    ];
}
