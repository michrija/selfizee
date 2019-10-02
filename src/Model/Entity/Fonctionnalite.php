<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fonctionnalite Entity
 *
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property string|null $texte_helper
 * @property string $titre_link
 * @property string $link
 * @property int $ordre
 *
 * @property \App\Model\Entity\FonctionaliteEvenement[] $fonctionalite_evenements
 */
class Fonctionnalite extends Entity
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
        'nom' => true,
        'description' => true,
        'texte_helper' => true,
        'titre_link' => true,
        'link' => true,
        'ordre' => true,
        'fonctionalite_evenements' => true
    ];
}
