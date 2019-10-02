<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientContact Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $position
 * @property string $email
 * @property string $tel
 * @property int $client_id
 * @property int $id_in_sellsy
 * @property bool $deleted_in_sellsy
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Client $client
 */
class ClientContact extends Entity
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
        'prenom' => true,
        'position' => true,
        'email' => true,
        'tel' => true,
        'client_id' => true,
        'id_in_sellsy' => true,
        'deleted_in_sellsy' => true,
        'created' => true,
        'modified' => true,
        'client' => true
    ];
}
