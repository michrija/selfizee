<?php
namespace App\Controller;
include (ROOT.DS.'plugins'.DS.'stripe-php'.DS.'init.php');
use App\Controller\AppController;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\SendInfoComponent;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Credits Controller
 *
 * @property \App\Model\Table\CreditsTable $Credits
 *
 * @method \App\Model\Entity\Credit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CreditsController extends AppController
{

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        $filtersActions = ['buySms']; 
        $authorisedRole = [1,2];


        if (in_array($action, $filtersActions)) {
            if (in_array($user['role_id'], $authorisedRole)) {
                return true;
            }
            return false;
        }

        // on authorise toutes actions saufs si dans les filtersActions le role des users est parmi $authorisedRole
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($client_id=null)
    {
        $user_connected = $this->Auth->user();
        $options = [];
        if($user_connected['role_id'] == 2){
            $options['client_id'] = is_null($client_id) ? $user_connected['client_id']:$client_id ;
        }
        $this->paginate = [
            'contain' => ['Clients'],
            'order' => ['created'=> 'DESC'],
            'limit' => 5,
            'finder'=>[
                'filtre' => $options
            ]
        ];
        $credits = $this->paginate($this->Credits);
     
        $this->viewBuilder()->setLayout('sans_menu');
        $this->set(compact('credits'));
    }

    public function stripe()
    {
       $this->viewBuilder()->setLayout(false);
       $smsInfos = $this->request->session()->read('data_infos');
        $image =  Router::url('/', true).'img/bg_login.png';
     
        $url =  Router::url(['action'=>'validatePaiment'], true);
        $this->viewBuilder()->setLayout('sans_menu');
        $smsInfos = $this->request->session()->read('data_infos');
        \Stripe\Stripe::setApiKey('sk_test_D5Qo28gGjwe2SFd7Lcp9F8uX00TSNF0vlW');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
            'name' => 'Test Selfizee',
            'description' => 'S\'il vous plaît faire votre paiement',
            'amount' => $smsInfos['price']*100,
            'images'=>['https://stripe-camo.global.ssl.fastly.net/86b3495b299027a36286ad5cfb0d54b747571664/68747470733a2f2f66696c65732e7374726970652e636f6d2f66696c65732f665f746573745f454f4e63426e43434a6475527a59646f5451733947464c6d'],
            'currency' => 'EUR',
            'quantity' => 1,
        ]],
        'success_url' => $url,
        'cancel_url' => 'https://example.com/cancel',
        ]);

        $this->set(compact('smsInfos','session'));
    }

    /**
     * View method
     *
     * @param string|null $id Credit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $credit = $this->Credits->get($id, [
            'contain' => ['Clients']
        ]);
        $this->set('credit', $credit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idClient = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $credit = $this->Credits->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //debug($data);die;
            $credit = $this->Credits->patchEntity($credit, $data);
            if ($this->Credits->save($credit)) {
                $this->Flash->success(__('The credit has been saved.'));

                return $this->redirect(['controller' => 'credits', 'action' => 'index']);
            }
            $this->Flash->error(__('The credit could not be saved. Please, try again.'));
        }

        $client = null;
        if(!empty($idClient)) {
            $this->loadModel('Clients');
            $client = $this->Clients->get($idClient);
        }

        $is_demande = false;
        $clients = $this->Credits->Clients->find('list', ['valueField' => 'nom', 'contain'=>['Users']]);
        $this->set(compact('credit', 'clients', 'client', 'is_demande'));
    }

    public function demande($idClient = null)
    {   
        $is_demande = true;
        $this->viewBuilder()->setLayout('sans_menu');
        $credit = $this->Credits->newEntity();
        //$page_retour = $this->referer();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //debug($data);die;
            $credit = $this->Credits->patchEntity($credit, $data);
            if ($this->Credits->save($credit)) {
                $this->Flash->success(__('The demande has been saved.'));

                //return $this->redirect($this->referer());
                return $this->redirect(['controller'=>'Credits', 'action'=>'index']);
            }
            $this->Flash->error(__('The demande could not be saved. Please, try again.'));
        }

        $client = null;
        if(!empty($idClient)) {
            $this->loadModel('Clients');
            $client = $this->Clients->get($idClient);    
        }
        $role_user_connected = $this->Auth->user()['role_id'];
        if($role_user_connected == 2){ 
            $client = $this->Clients->get($this->Auth->user()['client_id']);             
        }
        
        $clients = $this->Credits->Clients->find('list', ['valueField' => 'nom', 'contain'=>['Users']]);
        $this->set(compact('credit', 'clients', 'client', 'is_demande'));
        $this->render('add');
    }


    public function buySms($eventId=null,$client_id = null)
    {
    
        if (is_null($client_id)) {
            $this->Flash->error("Paramètre client manquant dans l'url");
            return $this->redirect($this->referer());
        }
       
        $this->loadModel('SmsTarifs');
        $this->loadModel('Evenements');
        $this->viewBuilder()->setLayout('sans_menu');
        if ($this->request->is('post')) {
            $data = $this->request->getData(); // contient sms_tarif_id

            $data['client_id'] = $client_id;
            $this->request->session()->write('priceSmsChoice', $data);
            return $this->redirect(['action' => 'order-sms']);
        }

        $smsPrices = $this->SmsTarifs->find();
        $evenements = $this->Evenements->findById($eventId)->first();
       
        $campagne =$evenements->nom;

        $this->set(compact('smsPrices','campagne','eventId','client_id'));
    }

    /**
     * VISA NUMBER TEST CARD 4242 4242 4242 4242 12/21/123
     */
    public function orderSms($id = null)
    {

        $this->loadModel('SmsTarifs');

        $this->viewBuilder()->setLayout('sans_menu');
        if (!$this->request->session()->read('priceSmsChoice')) {
       
            return $this->redirect(['action' => 'buy-sms']);
        }

        $priceSms = $this->request->session()->read('priceSmsChoice');

        $smsInfos = $this->SmsTarifs->findById($priceSms['sms_tarif_id'])->first();

        $this->request->session()->write('smsInfos', $smsInfos);
       
        $this->set(compact('smsInfos'));
    }

    public function validatePaiment($eventId=null,$client_id = null)
    {
    
        if ($this->request->session()->read('data_infos') == false) {
            return $this->redirect(['action' => 'buy-sms']);
        }
        $smsInfos = $this->request->session()->read('data_infos');
        
        $this->loadModel('Users');
        $userConnected = $this->Auth->user();
        
        $clientInfos = $this->Users->findById($userConnected['id'])->contain(['Roles', 'Clients'])->first();
       
        $email = @$clientInfos->email;
      
           
       // $amount = $smsInfos->get('priceTTC'); // tva à 20 %
       // $amount = $smsInfos['priceTtc']; // tva à 20 %
        

        $data = [
            'prix' =>  $smsInfos['priceTtc'],
            'credit' => $smsInfos['nbr_sms'],
            'evenement_name' => $smsInfos['campagne'],
            'adress_invoice' => $smsInfos['adress'],
            'client_id' => @$clientInfos->client->id,
            'evenement_id' => @$eventId,
            'etat' => 0 // car paiement instantané  par carte VISA
        ];
      
        $creditEntity = $this->Users->Credits->newEntity($data, ['validate' => false]);
      
        if(!$creditEntity->errors()) {
           $this->Users->Credits->save($creditEntity);
           
                 $email_reponse = new Email('default');                    
                    $email_reponse
                        ->setTemplate('email_template')
                        ->setEmailFormat('html')
                        ->setFrom(["contact@selfizee.fr" => 'Service contact selfizee'])
                        ->setSubject('Service contact selfizee')
                        ->setTransport('mailjet');
                        if(!is_null($email)){
                            $email_reponse->setTo($email);
                            if ($email_reponse->send()) {
                                $this->Flash->success(__('Your message has been sent.'));
                               }
                        }
                      
                    $email_reponse = new Email('default');                    
                    $email_reponse
                        ->setTemplate('email_toadmin')
                        ->setEmailFormat('html')
                        ->setFrom(["contact@selfizee.fr" => 'Service contact selfizee'])
                        ->setSubject('Service contact selfizee')
                        ->setTransport('mailjet');
                        $email_reponse->setTo('sylowdev@gmail.com');
                        $email_reponse->send();
                           

        $this->Flash->success("Achat effectué, votre compte a été crédité de ".$smsInfos['nbr_sms']." SMS");

        return $this->redirect(['action' => 'creditsms',$eventId,$clientInfos->client->id]);
        }     
          $this->Flash->set('Le paiement n\'a pa pu être effectué', ['element' => 'alert', 'key' => 'default', 'params' => ['class' => 'alert alert-danger']]);
        return $this->redirect(['action' => 'buy-sms']);        

    }

    public function validate($id = null)
    {
        $credit = $this->Credits->get($id, [
            'contain' => []
        ]);
        $credit->etat = 1;
        if ($this->Credits->save($credit)) {
                $this->Flash->success(__('The credit has been validate.'));

                return $this->redirect(['action' => 'index']);
        }
    }

     public function creditsms($eventId=null,$client_id = null)
    {
        $this->loadModel('Clients');
        $role_user_connected = $this->Auth->user()['role_id'];
        $data = $this->request->getSession()->read('data_infos');
        $infoCreditClient = [];
        $this->SendInfo = new SendInfoComponent(new ComponentRegistry());;

        $client = null;
        $dernieres_demande_crdt = null;
        if(!empty($idClient)) {
            $client = $this->Clients->get($idClient);
            $infoCreditClient = $this->SendInfo->infoDetailClient($idClient);
        }
        if($role_user_connected == 2){
            $client = $this->Clients->get($this->Auth->user()['client_id']);
            $infoCreditClient = $this->SendInfo->infoDetailClient($this->Auth->user()['client_id']);
            $dernieres_demande_crdt = $this->Credits->find('all')->where(['client_id'=>$this->Auth->user()['client_id']])->limit('5')->order(['id' => 'DESC']);
            $derniersEnvoyes = $this->SendInfo->getAllSmsEnvoyes($this->Auth->user()['client_id']);
           
        }
        $derniersEnvoyes['price']=$data['price'];
        $this->viewBuilder()->setLayout('sans_menu');
        $this->set(compact('infoCreditClient', 'client', 'dernieres_demande_crdt', 'derniersEnvoyes','eventId'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Credit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('sans_menu');
        $credit = $this->Credits->get($id, [
            'contain' => ['Clients']
        ]);
        //debug($credit);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //debug($data);die;
            $credit = $this->Credits->patchEntity($credit, $data);
            if ($this->Credits->save($credit)) {
                $this->Flash->success(__('The credit has been saved.'));

                return $this->redirect(['controller' => 'credits', 'action' => 'index']);
            }
            $this->Flash->error(__('The credit could not be saved. Please, try again.'));
        }
        $client = $credit->client;

        $clients = $this->Credits->Clients->find('list', ['valueField' => 'nom', 'contain'=>['Users']]);
        $this->set(compact('credit', 'clients', 'client', 'is_demande'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Credit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $credit = $this->Credits->get($id);
        if ($this->Credits->delete($credit)) {
            $this->Flash->success(__('The credit has been deleted.'));
        } else {
            $this->Flash->error(__('The credit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function addPriceWithSms()
    {
     $price = $this->request->getQuery('price');
     $sms = $this->request->getQuery('nbr_sms');
     $priceTtc = $this->request->getQuery('priceTtc');
     $campagne = $this->request->getQuery('campagne');
     $adress = $this->request->getQuery('title');
    
     $this->request->getSession()->write('data_infos.price', $price);
     $this->request->getSession()->write('data_infos.nbr_sms',$sms);
     $this->request->getSession()->write('data_infos.priceTtc',$priceTtc);
     $this->request->getSession()->write('data_infos.campagne',$campagne);
     $this->request->getSession()->write('data_infos.adress',$adress);
     $data = $this->request->getSession()->read('data_infos');
     $body='success';
      return $this->response->withType('application/json')->withStringBody(json_encode($data));
    }
    public function facture($creditId = null)
    {
        $credit = $this->Credits->get($creditId);
     
        $this->request->getSession()->write('data_sms.price', $credit->prix);
        $this->request->getSession()->write('data_sms.nbr_sms', $credit->credit);
        $this->request->getSession()->write('data_sms.adress_invoice', $credit->adress_invoice);

        $this->viewBuilder()->setLayout(false);
             $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.default')
            ->options(['config' => [
                'filename' => 'rija',
                'render' => 'browser',
                'size' => 'A4',
                'orientation' => 'landscape'
        ]]);
    }        
    
}
