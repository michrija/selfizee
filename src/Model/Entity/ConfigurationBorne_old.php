<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConfigurationBorne Entity
 *
 * @property int $id
 * @property int $evenement_id
 * @property int $type_animation_id
 * @property int $nbr_pose
 * @property int $disposition_vignette
 * @property int $multiconfiguration_id
 * @property int $decompte_prise_photo
 * @property int $decompte_time_out
 * @property bool $is_reprise_photo
 * @property bool $is_prise_coordonnee
 * @property bool $is_impression
 * @property bool $is_multi_impression
 * @property int $nbr_max_impression
 * @property int $nbr_max_photo
 * @property string $texte_impression
 * @property bool $is_impression_auto
 * @property int $nbr_copie_impression_auto
 * @property int $type_imprimante_id
 * @property int $model_borne_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\TypeAnimation $type_animation
 * @property \App\Model\Entity\Multiconfiguration $multiconfiguration
 * @property \App\Model\Entity\TypeImprimante $type_imprimante
 * @property \App\Model\Entity\ModelBorne $model_borne
 * @property \App\Model\Entity\Cadre[] $cadres
 * @property \App\Model\Entity\Champ[] $champs
 * @property \App\Model\Entity\Ecran[] $ecrans
 * @property \App\Model\Entity\FiltreConfigurationBorne[] $filtre_configuration_bornes
 * @property \App\Model\Entity\FondVert[] $fond_verts
 */
class ConfigurationBorne extends Entity
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
        'evenement_id' => true,
        'type_animation_id' => true,
        'nbr_pose' => true,
        'multiconfiguration_id' => true,
        'decompte_prise_photo' => true,
        'decompte_time_out' => true,
        'is_reprise_photo' => true,
        'is_prise_coordonnee' => true,
        'titre_formulaire' => true,
        'is_impression' => true,
        'is_multi_impression' => true,
        'nbr_max_impression' => true,
        'nbr_max_photo' => true,
        'texte_impression' => true,
        'is_impression_auto' => true,
        'nbr_copie_impression_auto' => true,
        'type_imprimante_id' => true,
        'model_borne_id' => true,
        'evenement' => true,
        'type_animation' => true,
        'multiconfiguration' => true,
        'type_imprimante' => true,
        'model_borne' => true,
        'cadres' => true,
        'champs' => true,
        'ecrans' => true,
        'filtre_configuration_bornes' => true,
        'fond_verts' => true,
        'disposition_vignette' => true,
        'disposition_vignette_id' => true
    ];*/
    
    protected $_accessible = [
        'id' => false,
        '*' =>true
    ];
}
