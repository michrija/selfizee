<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

/**
 * EvenementCrea Entity
 *
 * @property int $id
 * @property int $evenement_id
 * @property string|null $canvas_elements
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Evenement $evenement
 */
class EvenementCrea extends Entity
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
        'canvas_elements' => true,
        'created' => true,
		'file_put_content' => true,
        'modified' => true,
        'evenement' => true
    ];
	
	protected $_virtual = ['file_png', 'file_jpg', 'file_download_png', 'file_download_jpg'];
	
	protected function _getFileDownloadPng(){
		$file_download = WWW_ROOT . 'import' . DS . 'config_bornes' . DS . $this -> evenement_id . DS . 'creas' . DS;
		if($this->file_put_content != ''){
			$file_download .= $this -> file_put_content . '.png';
		}
		return $file_download;
	}
	protected function _getFileDownloadJpg(){
		$file_download = WWW_ROOT . 'import' . DS . 'config_bornes' . DS . $this -> evenement_id . DS . 'creas' . DS;
		if($this->file_put_content != ''){
			$file_download .= $this -> file_put_content . '.jpg';
		}
		return $file_download;
	}
	
    protected function _getFilePng(){
		$file_png = Configure::read('url_admin_domaine').'import/config_bornes/'.$this->evenement_id.'/creas/';
		if($this->file_put_content != ''){
			$file_png .= $this->file_put_content.'.png';
		}
		return $file_png;
    }
	
    protected function _getFileJpg(){
		$file_jpg = Configure::read('url_admin_domaine').'import/config_bornes/'.$this->evenement_id.'/creas/';
		if($this->file_put_content != ''){
			$file_jpg .= $this->file_put_content.'.jpg';
		}
		return $file_jpg;
    }
}
