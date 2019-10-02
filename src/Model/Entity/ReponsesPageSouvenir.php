<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReponsesPageSouvenir Entity
 *
 * @property int $id
 * @property string|null $value_text
 * @property int|null $champ_option_id
 * @property int|null $champ_id
 * @property int|null $photo_id
 * @property int|null $page_souvenir_id
 * @property string|null $queque
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\ChampOption $champ_option
 * @property \App\Model\Entity\Champ $champ
 * @property \App\Model\Entity\Photo $photo
 */
class ReponsesPageSouvenir extends Entity
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
        'value_text' => true,
        'champ_option_id' => true,
        'champ_id' => true,
        'photo_id' => true,
        'page_souvenir_id' => true,
        'queque' => true,
        'created' => true,
        'champ_option' => true,
        'champ' => true,
        'photo' => true
    ];
}
