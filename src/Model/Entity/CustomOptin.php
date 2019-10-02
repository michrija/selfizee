<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomOptin Entity
 *
 * @property int $int
 * @property int $champ_id
 * @property string $titre
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modifed
 *
 * @property \App\Model\Entity\Champ $champ
 */
class CustomOptin extends Entity
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
        'champ_id' => true,
        'titre' => true,
        'created' => true,
        'modifed' => true,
        'champ' => true
    ];
}
