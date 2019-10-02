<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PhotoStatistique Entity
 *
 * @property int $id
 * @property int $photo_id
 * @property int|null $nb_homme
 * @property int|null $nb_femme
 * @property int $moins_20
 * @property int $20_30
 * @property int $30_40
 * @property int $40_60
 * @property int $plus_60
 * @property int $nb_sourire
 * @property int $nb_neutre
 * @property int $nb_triste
 * @property int $nb_surpris
 * @property int $nb_peur
 * @property int $nb_colere
 * @property string|null $stat_globale
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Photo $photo
 */
class PhotoStatistique extends Entity
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
        'photo_id' => true,
        'nb_homme' => true,
        'nb_femme' => true,
        'moins_20' => true,
        'a_20_30' => true,
        'a_30_40' => true,
        'a_40_60' => true,
        'age_total' => true,
        'plus_60' => true,
        'nb_sourire' => true,
        'nb_neutre' => true,
        'nb_triste' => true,
        'nb_surpris' => true,
        'nb_peur' => true,
        'nb_colere' => true,
        'stat_globale' => true,
        'created' => true,
        'modified' => true,
        'photo' => true
    ];
}
