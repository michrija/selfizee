<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * ClientsCustom Entity
 *
 * @property int $id
 * @property int $client_id
 * @property string $signature_email
 * @property string $ps_publicite
 * @property string $ps_bandeau_par_defaut
 * @property string $ps_couleur_de_fond
 * @property string $gs_nom
 * @property string $gs_slug
 * @property string $gs_is_public
 * @property string $gs_titre
 * @property string $gs_sous_titre
 * @property string $gs_couleur
 * @property string $gs_img_banniere
 * @property bool $gs_is_livredor_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Client $client
 */
class ClientsCustom extends Entity
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
        'client_id' => true,
        'signature_email' => true,
        'ps_publicite' => true,
        'ps_bandeau_par_defaut' => true,
        'ps_couleur_de_fond' => true,
        'ps_couleur_download_link' => true,
        'gs_nom' => true,
        'gs_slug' => true,
        'gs_is_public' => true,
        'gs_titre' => true,
        'gs_sous_titre' => true,
        'gs_couleur' => true,
        'gs_img_banniere' => true,
        'gs_is_livredor_active' => true,
        'created' => true,
        'modified' => true,
        'client' => true
    ];


    protected function _getUrlBanniere()
    {
        return Router::url('/', true).'/import/galleries/head/album-'.$this->_properties['id']."/".$this->_properties['gs_img_banniere'] ;
    }
}
