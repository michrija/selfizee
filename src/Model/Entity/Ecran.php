<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ecran Entity
 *
 * @property int $id
 * @property string $page_accueil
 * @property string $btn_page_accueil
 * @property string $page_prise_photo
 * @property string $page_prise_photo_visualisation
 * @property string $page_choix_filtre
 * @property string $page_remerciement
 * @property string $page_choix_fond_vert
 * @property int $configuration_borne_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ConfigurationBorne $configuration_borne
 */
class Ecran extends Entity
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
        'page_accueil' => true,
        'btn_page_accueil' => true,
		
		'page_config_fond_accueil_id' => true,
		'page_config_fond_accueil_couleur' => true,
		'btn_page_accueil_id' => true,
		'choix_all_pages' => true,
		
		'page_config_fond_prise_photo_id' => true,
		'page_config_fond_prise_photo_couleur' => true,
		'page_config_fond_filtre_id' => true,
		'page_config_fond_filtre_couleur' => true,
		'page_filtre_titre' => true,
		'page_filtre_titre_couleur' => true,
		'page_filtre_titre_avance' => true,
		'page_filtre_titre_police_id' => true,
		'page_filtre_titre_taille' => true,
		'page_filtre_titre_left' => true,
		'page_filtre_titre_right' => true,
		
		
        'page_prise_photo' => true,
        'page_prise_photo_visualisation' => true,
        'page_choix_filtre' => true,
        'page_remerciement' => true,
        'page_choix_fond_vert' => true,
        'configuration_borne_id' => true,
        'created' => true,
        'modified' => true,
        'configuration_borne' => true,
        'page_choix_configuration' => true
    ];
}
