<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Collection\Collection;

use Base64Url\Base64Url;
 
/**
 * ContactServices Controller
 *
 * @property \App\Model\Table\ContactServicesTable $ContactServices
 *
 * @method \App\Model\Entity\ContactService[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartagesController extends AppController
{

    public function isAuthorized($user)
    {

        $action = $this->request->getParam('action');

        return true;

        return parent::isAuthorized($user);
    }

     public function instagram($token = null, $is_mobile = 0)
    {


        $this->loadModel('Photos');
        $photo = $this->Photos->find()
                        ->contain(['Evenements'=>['RsConfigurations','PageSouvenirs','Galeries']])
                        ->where(['token' => $token])
                        ->first();
        //sdebug($photo);die;

        $this->viewBuilder()->setLayout('instagram');

        $this->set('photo', $photo);
        $this->set('is_mobile', $is_mobile);
    }     

}          
