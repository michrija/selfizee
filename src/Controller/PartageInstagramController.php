<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Collection\Collection;

/**
 * ContactServices Controller
 *
 * @property \App\Model\Table\ContactServicesTable $ContactServices
 *
 * @method \App\Model\Entity\ContactService[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartageInstagramController extends AppController 
{

    public function isAuthorized($user)
    {

        $action = $this->request->getParam('action');

        return true;
        // Par d�faut, on refuse l'acc�s.
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PartageInstagram']
        ]; 
    }

    /**
     * View method
     *
     * @param string|null $id Contact Service id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partageInstagram = $this->PartageInstagram->get($id, [
            'contain' => ['PartageInstagram']
        ]);

        $this->set('partageInstagram', $partageInstagram);
    }

    public function instagrampartage()
    {
        $this->viewBuilder()->setLayout('instagram');
    }

    public function instagrammobile($token = null)
    {

        $this->loadModel('Photos');
        $photo = $this->Photos->find()
                        ->where(['token' => $token])
                        ->first();
        //debug($photo);die;

        $this->viewBuilder()->setLayout('instagrammobile');
        $this->set('photo', $photo);
    }
}
