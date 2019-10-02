<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $role_id
 * @property int $evenement_id
 * @property int $galerie_id
 * @property int $client_id
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Evenement $evenement
 * @property \App\Model\Entity\Galery $galery
 * @property \App\Model\Entity\Client $client
 */
class User extends Entity
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
        /*'username' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'role_id' => true,
        'evenement_id' => true,
        'galerie_id' => true,
        'client_id' => true,
        'role' => true,
        'evenement' => true,
        'galery' => true,
        'client' => true*/
        'id' => false,
        '*' => true
       
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($value)
    {
        $value = $this->password_visible;
        //debug($value);die;
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
    
 
}
