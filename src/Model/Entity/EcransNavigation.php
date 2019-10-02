<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EcransNavigation Entity
 *
 * @property int $id
 * @property int|null $config_borne_id
 * @property string|null $page_accueil_image_fond
 * @property string|null $page_accueil_couleur_fond
 * @property int|null $page_config_fond_id
 * @property string|null $page_accueil_image_btn
 * @property int|null $page_config_bouton_id
 * @property int|null $page_config_police_id
 * @property string|null $page_prise_photos_image_fond
 * @property string|null $page_prise_photos_couleur_fond
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ConfigBorne $config_borne
 * @property \App\Model\Entity\PageConfigFond $page_config_fond
 * @property \App\Model\Entity\PageConfigBouton $page_config_bouton
 * @property \App\Model\Entity\PageConfigPolice $page_config_police
 */
class EcransNavigation extends Entity
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
        /*'config_borne_id' => true,
        'page_accueil_image_fond' => true,
        'page_accueil_couleur_fond' => true,
        'page_config_fond_id' => true,
        'page_accueil_image_btn' => true,
        'page_config_bouton_id' => true,
        'page_config_police_id' => true,
        'page_prise_photos_image_fond' => true,
        'page_prise_photos_couleur_fond' => true,
        'created' => true,
        'modified' => true,
        'config_borne' => true,
        'page_config_fond' => true,
        'page_config_bouton' => true,
        'page_config_police' => true*/
        'id' => false,
        '*' => true
    ];
}
