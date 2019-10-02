<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Champ Entity
 *
 * @property int $id
 * @property int $type_champ_id
 * @property string $nom
 * @property int $type_donnee_id
 * @property int $ordre
 * @property int $configuration_borne_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\TypeChamp $type_champ
 * @property \App\Model\Entity\TypeDonnee $type_donnee
 * @property \App\Model\Entity\ConfigurationBorne $configuration_borne
 */
class Champ extends Entity
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
    /*protected $_accessible = [
        'type_champ_id' => true,
        'nom' => true,
        'type_donnee_id' => true,
        'ordre' => true,
        'configuration_borne_id' => true,
        'created' => true,
        'modified' => true,
        'type_champ' => true,
        'type_donnee' => true,
        'configuration_borne' => true,
        'champ_option' => true,
        'champ_options' => true
    ];*/
    
     protected $_accessible = [
        'id' => false,
        '*' =>true
    ];
}
