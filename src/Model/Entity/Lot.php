<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Lot Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $photo
 * @property int $quantite
 * @property string|null $type_gain
 * @property string|null $probabilite_gain
 * @property \Cake\I18n\FrozenTime|null $date_deb_gain
 */ 
class Lot extends Entity 
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
        'evenement_id' => true,
        'nom' => true,
        'photo' => true,
        'quantite' => true,
        'type_gain' => true,
        'probabilite_gain' => true,
        'date_deb_gain' => true        
    ];

    protected $_virtual = ['url_viewer_photo'];

    protected function _getUrlViewerPhoto(){
        $url = "";
        $filename = $this->_properties['photo'];

        //debug(PATH_LOT . $filename);die;

        if(!empty($filename) && file_exists(PATH_LOT . $filename)){
            $url = Router::url('/',true)."uploadLot/".$filename;
        }
        return $url;
    }
}
