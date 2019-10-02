<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersModelesEmail Entity
 *
 * @property int $id
 * @property string $nom_modele
 * @property string $email_expediteur
 * @property string $nom_expediteur
 * @property string $objet
 * @property string $content
 * @property bool $is_photo_en_pj
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class UsersModelesEmail extends Entity
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
        'nom_modele' => true,
        'email_expediteur' => true,
        'nom_expediteur' => true,
        'objet' => true,
        'content' => true,
        'is_photo_en_pj' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'user' => true
    ];
}
