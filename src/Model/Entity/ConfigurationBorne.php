<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConfigBorne Entity
 *
 * @property int $id
 * @property int|null $evenement_id
 * @property int $type_mise_en_page_id
 * @property int $catalogue_id
 * @property int|null $decompte_prise_photo
 * @property bool|null $is_reprise_photo
 * @property bool|null $is_incrustation_fond_vert
 * @property bool|null $is_prise_coordonnee
 * @property string|null $titre_formulaire
 * @property bool|null $is_impression
 * @property bool|null $is_multi_impression
 * @property int|null $nbr_max_multi_impression
 * @property bool|null $has_limite_impression
 * @property int|null $nbr_max_photo
 * @property string|null $texte_impression
 * @property bool|null $is_impression_auto
 * @property int|null $nbr_copie_impression_auto
 * @property int|null $decompte_time_out
 * @property string|null $num_borne
 * @property int|null $taille_ecran_id
 * @property int|null $type_imprimante_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\TypeMiseEnPage $type_mise_en_page
 * @property \App\Model\Entity\Catalogue $catalogue
 * @property \App\Model\Entity\TailleEcran $taille_ecran
 * @property \App\Model\Entity\TypeImprimante $type_imprimante
 * @property \App\Model\Entity\Cadre[] $cadres
 * @property \App\Model\Entity\Champ[] $champs
 * @property \App\Model\Entity\ConfigborneHasFiltre[] $configborne_has_filtres
 * @property \App\Model\Entity\ConfigborneHasTypeanimation[] $configborne_has_typeanimations
 * @property \App\Model\Entity\Ecran[] $ecrans
 * @property \App\Model\Entity\FondVert[] $fond_verts
 * @property \App\Model\Entity\ImageFondVert[] $image_fond_verts
 */
class ConfigBorne extends Entity
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
        /*'evenement_id' => true,
        'type_mise_en_page_id' => true,
        'catalogue_id' => true,
        'decompte_prise_photo' => true,
        'is_reprise_photo' => true,
        'is_incrustation_fond_vert' => true,
        'is_prise_coordonnee' => true,
        'titre_formulaire' => true,
        'is_impression' => true,
        'is_multi_impression' => true,
        'nbr_max_multi_impression' => true,
        'has_limite_impression' => true,
        'nbr_max_photo' => true,
        'texte_impression' => true,
        'is_impression_auto' => true,
        'nbr_copie_impression_auto' => true,
        'decompte_time_out' => true,
        'num_borne' => true,
        'taille_ecran_id' => true,
        'type_imprimante_id' => true,
        'evenement' => true,
        'type_mise_en_page' => true,
        'catalogue' => true,
        'taille_ecran' => true,
        'type_imprimante' => true,
        'cadres' => true,
        'champs' => true,
        'configborne_has_filtres' => true,
        'configborne_has_typeanimations' => true,
        'ecrans' => true,
        'fond_verts' => true,
        'image_fond_verts' => true*/        
        'id' => false,
        '*' => true
    ];
}
