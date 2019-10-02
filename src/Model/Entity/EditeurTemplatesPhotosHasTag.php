<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EditeurTemplatesPhotosHasTag Entity
 *
 * @property int $id
 * @property int $editeur_template_photo_id
 * @property int $tag_id
 *
 * @property \App\Model\Entity\EditeurTemplatePhoto $editeur_template_photo
 * @property \App\Model\Entity\Tag $tag
 */
class EditeurTemplatesPhotosHasTag extends Entity
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
        'editeur_template_photo_id' => true,
        'tag_id' => true,
        'editeur_template_photo' => true,
        'tag' => true
    ];
}
