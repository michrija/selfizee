<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Cake\Core\Configure;

/**
 * EditeurTemplatesPhoto Entity
 *
 * @property int $id
 * @property string|null $file
 * @property int $editeur_template_id
 *
 * @property \App\Model\Entity\EditeurTemplate $editeur_template
 */
class EditeurTemplatesPhoto extends Entity
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
        'id' => false,
        '*' => true,
    ];

	protected $_virtual = ['file_path', 'file_thumbnail_path'];
	
    protected function _getFilePath()
    {
        if (isset($this->editeur_template)) {
            $folderTypeEditeur = Inflector::slug(strtolower(Text::slug($this->editeur_template->type_editeur)), '_').'/';
			
			$file_path = Configure::read('url_admin_domaine').'img/editeurs/'.Text::slug($this->editeur_template->type_menu).'/'.$folderTypeEditeur.'/'.$this->file;
            return $file_path;
        }
    }

    protected function _getFileThumbnailPath()
    {
        if (isset($this->editeur_template)) {
            $folderTypeEditeur = Inflector::slug(strtolower(Text::slug($this->editeur_template->type_editeur)), '_').'/';
			
			$file_thumbnail_path = Configure::read('url_admin_domaine').'img/editeurs/'.Text::slug($this->editeur_template->type_menu).'/'.$folderTypeEditeur.'thumbnails/'.$this->file;
            return $file_thumbnail_path;
        }
        
    }
}
