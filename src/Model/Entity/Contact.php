<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $telephone
 * @property string $code_pays
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $photo_id
 *
 * @property \App\Model\Entity\Photo $photo
 */
class Contact extends Entity
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
        'email' => true,
        'telephone' => true,
        'code_pays' => true,
        'created' => true,
        'modified' => true,
        'photo_id' => true,
        'photo' => true,
        'queue' => true,
        'source_upload' => true,
        'email_propose' => true,
        'is_email_error' => true,
        'email_old' => true,
		'deleted_via_rgpd' => true,
		'deleted_date' => true
    ];
}
