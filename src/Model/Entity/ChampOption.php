<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChampOption Entity
 *
 * @property int $id
 * @property string $nom
 * @property int $champ_id
 *
 * @property \App\Model\Entity\Champ $champ
 */
class ChampOption extends Entity
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
        'nom' => true,
        'champ_id' => true,
        'champ' => true
    ];*/
    
    
     protected $_accessible = [
        'id' => false,
        '*' =>true
    ];
}
