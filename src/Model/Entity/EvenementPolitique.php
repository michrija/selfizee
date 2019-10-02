<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EvenementPolitique Entity
 *
 * @property int $id
 * @property int $evenement_id
 * @property string $contenu
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class EvenementPolitique extends Entity
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
        'evenement_id' => true,
        'contenu' => true,
        'nom_client' => true,
        'created' => true,
        'modified' => true,
        'evenement' => true
    ];
}
