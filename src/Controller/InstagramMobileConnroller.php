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
class InstagramMobileController extends AppController
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

    public function instagrammobiles0()
    {
        $this->viewBuilder()->setLayout('instagrammobile');
    }


    public function instagrammobile($token)
    {    
        $this->loadModel('Photos');
        $photo = $this->Photos->find()
                        ->contain(['Evenements'=>['RsConfigurations','PageSouvenirs','Galeries']])
                        ->where(['token' => $token])
                        ->first();
        debug($photo);die;

        if(!empty($photo)){
            $dataVue['photo_id'] = $photo->id;
            $photoVue = $this->Photos->PhotoVues->newEntity($dataVue);

            $is_required = 0;
            $couleur_download_link = "#000";
            $is_actif = "#";

            $this->loadModel('Evenements');
            $this->loadModel('DownloadConfigurations');
            $this->loadModel('PageSouvenirs');
            $evenement = $this->Evenements->get($photo->evenement_id);
            $pageSouvenir = $this->PageSouvenirs->find('all',
                ['contain'=>['Champs'=>['TypeChamps','TypeDonnees','ChampOptions','TypeOptins','CustomOptins']]
                ])->where(['evenement_id'=>$photo->evenement_id])->first();
            }

            $this->set('photo', $photo);
        }     

    }          
