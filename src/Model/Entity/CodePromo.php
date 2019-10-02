<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CodePromo Entity
 *
 * @property int $id
 * @property string|null $code_promo
 * @property int $email_configuration_id
 * @property bool|null $is_deja_attribue
 * @property int|null $photo_id
 * @property int|null $envoi_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modifed
 *
 * @property \App\Model\Entity\EmailConfiguration $email_configuration
 */
class CodePromo extends Entity
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
        'code_promo' => true,
        'email_configuration_id' => true,
        'is_deja_attribue' => true,
        'photo_id' => true,
        'envoi_id' => true,
        'created' => true,
        'modifed' => true,
        'email_configuration' => true
    ];
}
