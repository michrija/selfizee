<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CatalogueCadre Entity
 *
 * @property int $id
 * @property string|null $titre
 * @property string|null $file_name
 * @property string|null $nom_origine
 * @property string|null $chemin
 * @property int|null $nbr_pose
 * @property string|null $type_cadre
 * @property int|null $format_id
 * @property int|null $evenement_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Format $format
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\CatalogueCadreTheme[] $catalogue_cadre_themes
 */
class CatalogueCadre extends Entity
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
        /*'titre' => true,
        'file_name' => true,
        'nom_origine' => true,
        'chemin' => true,
        'nbr_pose' => true,
        'type_cadre' => true,
        'format_id' => true,
        'evenement_id' => true,
        'created' => true,
        'modified' => true,
        'format' => true,
        'evenement' => true,
        'catalogue_cadre_themes' => true*/
        'id' => false,
        '*' => true
    ];
}
