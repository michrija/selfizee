<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evenement Entity
 *
 * @property int $id
 * @property int $client_id
 * @property string $nom
 * @property string $slug
 * @property bool $is_marque_blanche
 * @property bool $is_data_acces
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\PageSouvenir $page_souvenir
 * @property \App\Model\Entity\EmailConfiguration $email_configuration
 * @property \App\Model\Entity\SmsConfiguration $sms_configuration
 * @property \App\Model\Entity\Cron[] $crons
 * @property \App\Model\Entity\Photo[] $photos
 * @property \App\Model\Entity\User[] $users
 */
class Evenement extends Entity
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
        /*'client_id' => true,
        'nom' => true,
        'slug' => true,
        'is_marque_blanche' => true,
        'is_data_acces' => true,
        'created' => true,
        'modified' => true,
        'client' => true,
        'page_souvenir' => true,
        'email_configuration' => true,
        'sms_configuration' => true,
        'crons' => true,
        'photos' => true,
        'user' => true,
        'galeries' => true,
        'date_debut' => true,
        'date_fin' => true,
        'lieu' => true,
        'deleted' => true,
        'print_counter' => true*/        
        'id' => false,
        '*' => true
    ];
    
    protected function _getSlug($slug)
    {
        return strtoupper($slug);
    }
    
     protected function _getNom($nom)
    {
        return mb_strtoupper($nom);
    }

    protected function _setNom($nom){
        //$datatoCrypted = microtime();
        //$codeLogiciel  = strtoupper(hash("crc32b", $datatoCrypted));
    	$codeLogiciel = $this->generateCodeLogiciel();
        $this->set('code_logiciel', $codeLogiciel);
        return $nom;
    }

    private function generateCodeLogiciel($length = 4) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&#*$@';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
    
    
}
