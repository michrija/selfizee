<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InfosDownloadsGalerieSouvenir Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property int $galerie_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Galery $galery
 */
class InfosDownloadsGalerieSouvenir extends Entity
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
        'telephone' => true,
        'email' => true,
        'galerie_id' => true,
        'created' => true,
        'galery' => true
    ];
}
