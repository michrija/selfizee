<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    
	public $utilities;
    protected $allowAction = array();
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
		$this->loadComponent('Utilities');
		$utilities = $this->Utilities;
		$this -> utilities = $utilities;			  
        
        /*if(!empty($this->request->getParam('lang'))){
            if($this->request->getParam('lang') == 'fr'){
                I18n::setLocale('fr_FR');
            }else if($this->request->getParam('lang') == 'en'){
                I18n::setLocale('en_US');
            }
        }else{
            I18n::setLocale('fr_FR');
        }*/
        
        

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
             'loginRedirect' => [
                'controller' => 'Evenements',
                'action' => 'index'  // redirecting if success
            ],
             // Si pas autoris?, on renvoit sur la page pr?c?dente 
             'unauthorizedRedirect' => $this->referer()
        ]);

        // Permet ? l'action "display" de notre PagesController de continuer
        // ? fonctionner. Autorise ?galement les actions "read-only".

        $this->allowAction = ['login','logout','show','save','testPageSouvenir','download','send','event','saveClientFromCrm','saveContactFromCrm', 'addResponse', 'instagram','editorColorIcon','cookiees'];
        $action_ws = ['connexion', 'getGalerie', 'getContacts', 'listing', 'statGlobal', 'statResume', 'statistique', 'post', 'downloadByEvenementZip', 'save', 'get', 'getAll', 'deleteLicence', 'encryptFromSoft', 'downloadLienEncrypte','getByCodeLogiciel', 'rejoindreEvent'];
        $this->allowAction = array_merge($this->allowAction, $action_ws);

        //debug($this->allowAction);die;

        $this->Auth->allow($this->allowAction);
        $userConnected = $currentUser = $this->Auth->user();
        $is_active_add_client = false;

        if (!empty($userConnected['client_id'])) {
            $this->loadModel('Clients');
            $this->Clients->findById($userConnected['client_id'])->first();
            $is_active_add_client = $this->Clients->findById($userConnected['client_id'])->first()->is_active_add_client;
        }


        // debug($userConnected);
        // die();
        //debug($userConnected);
        if($userConnected['role_id'] != 5){
            $userConnected['is_active_acces_config'] = 1;
            $userConnected['is_active_acces_event'] = 1;
            $userConnected['is_active_acces_edit_photo'] = 1;
            $userConnected['is_active_acces_send_email'] = 1;
            $userConnected['is_active_acces_send_sms'] = 1;
            $userConnected['is_active_acces_data'] = 1;
            $userConnected['is_active_acces_timeline'] = 1;
            $userConnected['is_active_acces_stat'] = 1;
            $userConnected['is_active_acces_affichage_photo'] = 1;
        }
        //Pr test
        //$userConnected['is_active_acces_stat'] = 0;
        //$userConnected['is_active_acces_edit_photo'] = 0;
        //$userConnected['is_active_acces_data'] = 0;

        $controller = $this->request->param('controller');
        $action = $this->request->param('action');
        $controllerAction = $controller.'/'.$action;
        $this->set(compact('userConnected', 'currentUser', 'is_active_add_client', 'controller', 'action', 'controllerAction'));
        
        $this->loadModel('Timelines');
        $notifications = $this->Timelines->find()
                                    ->where([
                                            'Timelines.queue IS NOT' => NULL, 'Timelines.queue <>'=>'',
                                            'Timelines.source_timeline IS NOT' => NULL, 'Timelines.queue <>'=>''
                                        ])
                                    ->order(['Timelines.date_timeline' => 'DESC'])
                                    ->contain(['Evenements'])
                                    ->limit(4);
        $this->set(compact('notifications'));

         
    }
    
    public function isAuthorized($user)
    {
        //debug($user);
        if($user['role_id'] == 1){
            return true;
        }
        //Par d�faut, on refuse l'acc�s.
        return false;
    }
}
