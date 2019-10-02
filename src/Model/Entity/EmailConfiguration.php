<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailConfiguration Entity
 *
 * @property int $id
 * @property string $email_expediteur
 * @property string $nom_expediteur
 * @property string $objet
 * @property string $content
 * @property bool $is_photo_en_pj
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $evenement_id
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class EmailConfiguration extends Entity
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
        'email_expediteur' => true,
        'nom_expediteur' => true,
        'objet' => true,
        'content' => true,
        'is_photo_en_pj' => true,
        'created' => true,
        'modified' => true,
        'evenement_id' => true,
        'evenement' => true,
        'clients_modeles_email_id' => true,
        'is_has_code_promo' => true,
        'content_code_promo' => true,
        'code_promos' => true,
        'couleur_download_link' => true,
        'couleur_fond_editeur' => true,
        'couleur_btn_download' => true,
        'couleur_share_facebook' => true,
        'couleur_share_twitter' => true,
        'couleur_share_instagram' => true,
        'is_active' => true,
        'date_heure_envoi' => true,
        'is_blocshare_active' => true,
        'is_has_couleur_fond' => true,
        'is_envoi_plannifie' => true
    ];
    
    protected function _getContent($content)
    {
        $content =  str_replace( 'href=" ', 'href="', $content);
        $content =  str_replace( "href=' ", "href='", $content);
        return $content;
    }
}
