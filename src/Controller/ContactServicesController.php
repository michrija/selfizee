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
class ContactServicesController extends AppController
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
        $this->viewBuilder()->setLayout('contact');
        $contactService = $this->ContactServices->newEntity();
        if ($this->request->is('post')) {
            $contactService = $this->ContactServices->patchEntity($contactService, $this->request->getData());
            //debug($contactService->email);die;
           /* if ($this->ContactServices->save($contactService)) {*/

                //=== SEND EMAIL CONTACT
                $email = new Email('default');
                $email
                    ->setFrom(["contact@selfizee.fr" => 'Contact de '.$contactService->email])
                    ->setSubject('Message de '.$contactService->nom.' ('.$contactService->email.')')
                    ->setTransport('mailjet')
                    ->setTo("contact@selfizee.fr");
                //debug($email);die;
                if ($email->send($contactService->message)) {
                    $this->ContactServices->save($contactService);
                    
                    $email_reponse = new Email('default');                    
                    $email_reponse
                        ->setTemplate('contact_service')
                        ->setEmailFormat('html')
                        ->setFrom(["contact@selfizee.fr" => 'Service contact selfizee'])
                        ->setSubject('Service contact selfizee')
                        ->setTransport('mailjet') 
                        ->setTo($contactService->email);
                        if ($email_reponse->send()) {
                            $this->Flash->success(__('Your message has been sent.'));
                        }
                } else {
                    $this->Flash->error(__('Your message has not been sent.'));
                }
                //$this->Flash->success(__('The contact service has been saved.'));
                return $this->redirect(['action' => 'index']);
           /* }*/
            //$this->Flash->error(__('The contact service could not be saved. Please, try again.'));
        }
        $this->set(compact('contactService'));
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
        $contactService = $this->ContactServices->get($id, [
            'contain' => []
        ]);

        $this->set('contactService', $contactService);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactService = $this->ContactServices->newEntity();
        if ($this->request->is('post')) {
            $contactService = $this->ContactServices->patchEntity($contactService, $this->request->getData());
            if ($this->ContactServices->save($contactService)) {
                $this->Flash->success(__('The contact service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact service could not be saved. Please, try again.'));
        }
        $this->set(compact('contactService'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Service id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactService = $this->ContactServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactService = $this->ContactServices->patchEntity($contactService, $this->request->getData());
            if ($this->ContactServices->save($contactService)) {
                $this->Flash->success(__('The contact service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact service could not be saved. Please, try again.'));
        }
        $this->set(compact('contactService'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Service id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactService = $this->ContactServices->get($id);
        if ($this->ContactServices->delete($contactService)) {
            $this->Flash->success(__('The contact service has been deleted.'));
        } else {
            $this->Flash->error(__('The contact service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function googleAnalytics($id = null)
    {
        $this->loadComponent('GoogleAnalytics');
        $profile = $this->GoogleAnalytics->getProfile();
        $browserAndOs = $this->GoogleAnalytics->getPageviews();

        debug($browserAndOs);die;
    }

     public function getPageGaleriesSouvenir0($id = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $profile = $this->GoogleAnalyticsTracking->getPageGaleriesSouvenir();

        debug($profile);die;
    }

    public function getPageEvenements($id = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $profile = $this->GoogleAnalyticsTracking->getPageEvenements();

        debug($profile);die;
    }

    public function getPageGaleriesByCountry($id = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $profile = $this->GoogleAnalyticsTracking->getPageGaleriesByCountry();

        debug($profile);die;
    }

    public function getPageEvenementsByCountry($idEvenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $profile = $this->GoogleAnalyticsTracking->getPageEvenementsByCountry($idEvenement);

        debug($profile);die;
    }

    public function getDeviceEvenements($idEvenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $profile = $this->GoogleAnalyticsTracking->getDeviceEvenements($idEvenement);

        debug($profile);die;
    }


    public function getTrafficSourceEvenements($idEvenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $profile = $this->GoogleAnalyticsTracking->getTrafficSourceEvenements($idEvenement);

        debug($profile);die;
        //$this->getGalerie($idEvenement);
    }


    public function getGalerie($idEvenement = null)
    {
        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getPageGaleriesSouvenir();
        //$id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT)); 

        $this->loadModel('Galeries');
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement, [
                        'contain' => ['Galeries']
                ]);
        $galeries = $evenement->galeries;
        $collection = new Collection($galeries);
        $listeIdGalerie = $collection->extract('id');
        $listeIdGalerie = $listeIdGalerie->toList();
    
        //debug($galeries);die;//debug($listeIdGalerie);die;
        $stat_evenements = []; $galerie_id_encode = "";

        if(!empty($stats)){
            foreach ($stats as $key => $stat) {
                $page_path = $stat[0];
                $stat_array = explode('/', $page_path);   
                $idEncode = $stat_array[count($stat_array)-1]; 
                $id = base64_decode(str_pad(strtr($idEncode, '-_', '+/'), strlen($idEncode) % 4, '=', STR_PAD_RIGHT));            
                //debug($idEncode." ==> ".$id);
                if(in_array($id, $listeIdGalerie)){
                    $stat_evenements[] = $stat;
                    $galerie_id_encode = $idEncode;
                }
            }
        }
        //die;
        /*if(!empty($stat_evenements)) {
            return $stat_evenements['0']['0'];          
        }*/
        //return null;
        return $galerie_id_encode;
    }

    public function getDeviceGaleries($idEvenement)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $pathGalerie = $this->getGalerie($idEvenement);
        $profile = $this->GoogleAnalyticsTracking->getDeviceGaleries($pathGalerie);

        debug($profile);die;
    }

    public function getGaleriesByCountry($idEvenement)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $pathGalerie = $this->getGalerie($idEvenement);
        //debug($pathGalerie);die;
        $profile = $this->GoogleAnalyticsTracking->getGaleriesByCountry2($pathGalerie);

        debug($profile);die;
    }


    public function getPageGaleriesSouvenir()
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getPageGaleriesSouvenir();

        debug($stats);die;
    }


    //=====================
    public function checkEmail($email = null)
    {

        if(!$email) {
            $email = "test@gmail.com";
        }
        $after = $this->after("@", $email);
        $before = $this->before("@", $email);///debug($before);die;
        $after = str_split($after);

        $gmail = "gmail.com";
        $gmail = str_split($gmail);
        $proposition = "";

        //debug(implode('',$gmail));die;

        //====== Gmail 
        if ( ($after[0] == $gmail[0]) && ($after[1] == $gmail[1]) ) { // gm

            if (($after[2] != $gmail[2])) { // !a
                $proposition = implode('',$gmail);
            }

            if (($after[2] == $gmail[2]) && ($after[3] != $gmail[3])) { // a !i
                $proposition = implode('',$gmail);
            }

            if (($after[2] == $gmail[2]) && ($after[3] == $gmail[3]) && ($after[4] != $gmail[4])) { // ai !l
                $proposition = implode('',$gmail);
            }

        }

        $yahoo = "yahoo.fr";
        $yahoo = str_split($yahoo);
        //====== Yahoo 
        if ( ($after[0] == $yahoo[0]) && ($after[1] == $yahoo[1]) ) { // ya

            if (($after[2] == $yahoo[2]) && ($after[3] == $yahoo[3]) && ($after[4] != $yahoo[4])) { //ho !o
                $proposition = implode('',$yahoo);
            }

            if (($after[2] == $yahoo[2]) && ($after[3] != $yahoo[3])) { // h
                $proposition = implode('',$yahoo);                
            }    
        }

        $wanadoo = "wanadoo.fr";
        $wanadoo = str_split($wanadoo);
        //====== Wanadoo 
        if ( ($after[0] == $wanadoo[0]) && ($after[1] == $wanadoo[1]) ) { //wa

            if (($after[2] == $wanadoo[2]) && ($after[3] == $wanadoo[3]) && ($after[4] == $wanadoo[4]) && ($after[4] != $wanadoo[4])) { //nad
                $proposition = implode('',$wanadoo);
            }

            if (($after[2] == $wanadoo[2]) &&($after[3] == $wanadoo[3]) && ($after[4] == $wanadoo[4]) && ($after[4] == $wanadoo[4]) && ($after[5] != $wanadoo[5])) { // nado !o
                $proposition = implode('',$wanadoo);
            }  
        }

        $orange = "orange.fr";
        $orange = str_split($orange);
        //====== Yahoo 
        if ( ($after[0] == $orange[0]) && ($after[1] == $orange[1]) ) { // or

            if (($after[2] == $orange[2]) && ($after[3] == $orange[3]) && ($after[4] != $orange[4])) { // an
                $proposition = implode('',$orange);
            }

            if (($after[2] == $orange[2]) && ($after[3] == $orange[3]) && ($after[4] == $orange[4]) && ($after[5] != $orange[5])) { // ang
                $proposition = implode('',$orange);
            }
        }

        $hotmail = "hotmail.fr";
        $hotmail = str_split($hotmail);
        //====== Yahoo 
        if ( ($after[0] == $hotmail[0]) && ($after[1] == $hotmail[1]) ) { // ho

            if (($after[2] == $hotmail[2]) && ($after[3] == $hotmail[3]) && ($after[4] != $hotmail[4])) { // tm
                $proposition = implode('',$hotmail);
            }

            if (($after[2] == $hotmail[2]) && ($after[3] == $hotmail[3]) && ($after[4] == $hotmail[4]) && ($after[5] != $hotmail[5])) { // tma
                $proposition = implode('',$hotmail);
            }

            if (($after[2] == $hotmail[2]) && ($after[3] == $hotmail[3]) && ($after[4] == $hotmail[4]) && ($after[5] == $hotmail[5]) && ($after[6] != $hotmail[6]) ) { // tmai
                $proposition = implode('',$hotmail);
            }
        }

        if(!empty($proposition)){
            $proposition = $before."@".$proposition;
        }
        //debug($proposition);die;
        return $proposition;

    }

    //=====================
    public function checkEmail2($email)
    {
        $nom_de_domaine = $this->after("@", $email);
        $user_email = $this->before("@", $email);
        $adresse = $this->before(".", $nom_de_domaine);
        $extension = $this->after(".", $nom_de_domaine);
        //debug($adresse);die;

        $adresse_array = str_split($adresse);
        $nom_de_domaine_array = str_split($nom_de_domaine);
        //debug($nom_de_domaine); //debug($adresse);die;

        $this->loadModel('NomDeDomaines');
        $list_nom_de_domaines = $this->NomDeDomaines->find('list',['valueField'=>'nom_de_domaine'])->toArray();
        //debug($list_nom_de_domaines);die;

        $gmail = "gmail";
        $gmail = str_split($gmail);
        $proposition = "";
        $list_extensions = [];
        
        if(!in_array($nom_de_domaine, $list_nom_de_domaines)) {
            foreach ($list_nom_de_domaines as $key => $ndd) {
                $ndd_ext = $this->after(".", $ndd);
                if(!in_array($ndd_ext, $list_extensions)) $list_extensions [] = $ndd_ext;
                $ndd = $this->before(".", $ndd);
                $ndd = str_split($ndd);
                //debug(count($ndd));  //debug($ndd);
                if((count($adresse_array) >= 2)) {
                    if ( ($adresse_array[0] == $ndd[0]) && ($adresse_array[1] == $ndd[1]) ) {
                            $proposition = implode('',$ndd);
                    }

                    /*if ( (!empty($adresse_array[4])) && (count($ndd) == 5)) {// gmail ; yahoo + ..
                            if( ($adresse_array[2] == $ndd[2]) && ($adresse_array[3] == $ndd[3]) && ($adresse_array[4] == $ndd[4]) && ($nom_de_domaine_array[5] != '.')) {//
                            $proposition = implode('',$ndd);
                        } 
                    }

                    if ( (!empty($adresse_array[5])) && (count($ndd) == 6)) {// gmail ; yahoo + ..
                            if( ($adresse_array[2] == $ndd[2]) && ($adresse_array[3] == $ndd[3]) && ($adresse_array[4] == $ndd[4]) &&
                            ($adresse_array[5] == $ndd[5]) && ($nom_de_domaine_array[6] != '.')) {// 
                            $proposition = implode('',$ndd);
                        } 
                    }

                    if ( (!empty($adresse_array[6])) && (count($ndd) == 7)) {// hotmail ; wanadoo + ..
                            if( ($adresse_array[2] == $ndd[2]) && ($adresse_array[3] == $ndd[3]) && ($adresse_array[4] == $ndd[4]) &&
                            ($adresse_array[5] == $ndd[5]) &&  ($adresse_array[6] == $ndd[6]) && 
                            ($nom_de_domaine_array[7] != '.')) {// 
                            $proposition = implode('',$ndd);
                        } 
                    }*/
                }   
            }
        }

        if(!empty($proposition)){
            $list_extensions = ['fr', 'com', 'net', 'paris', 'eu'];
            $extension_array = str_split($extension);
            if(!in_array($extension, $list_extensions)) {
                foreach ($list_extensions as $key => $ext) {
                    # code...
                    $ext = str_split($ext);
                    if($extension_array[0] == $ext[0]){
                        $extension = implode('',$ext);                     
                    }
                }
            }
            
            $proposition = $user_email."@".$proposition.".".$extension;
        }

        //debug($list_extensions);die;
        debug($proposition);die;
        return $proposition;
    }

    public function checkEmailNotSent($idEvenement)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');

        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);

        $emailNotDelivry = "null";
        //debug($evenement);
        if(!empty($evenement->photos)){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();

            $emailNotDelivry = $this->Contacts->find('list', ['valueField'=>'email'])->where(['contact_id IN' => $listContactEmail])
                                                        ->notMatching('Envois.EnvoiEmailStatDelivres')->toArray();
        }
        //debug($emailNotDelivry);die;
        if(!empty($emailNotDelivry)){
            foreach ($emailNotDelivry as $key => $email) {
                if(!empty($this->checkEmail($email))){
                    debug( $key." . Email : ".$email."     ======> Proposition : ".$this->checkEmail($email));                   
                } else {
                    debug($key." . Email : ".$email);                   
                }
            }
            //debug($emails);
            die;
        }
        debug($emailNotDelivry);die;
    }

    public function contactEmailNotSent($idEvenement)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');

        $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);

        $listContactEmailNotSent = "";
        //debug($evenement);
        if(!empty($evenement->photos)){
            $collection = new Collection($evenement->photos);
            $id = $collection->extract('id');
            $idPhotos = $id->toList();
            
            $listContactEmail = $this->Contacts->find('list',['valueField' => 'id'])
                                                        ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                        ->toArray();

            $listContactEmailNotSent = $this->Contacts->find('list', ['valueField'=>'id'])->where(['contact_id IN' => $listContactEmail])
                                                        ->notMatching('Envois.EnvoiEmailStatDelivres')->toArray();
        }
        
        //debug($listContactEmailNotSent);die;
        return $listContactEmailNotSent;
    }

    public function after($char, $inthat)
    {
        if (!is_bool(strpos($inthat, $char)))
        return substr($inthat, strpos($inthat,$char)+strlen($char));
    }

    public function before($char, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $char));
    }

    public function editeur() { 
        $this->viewBuilder()->setLayout('editeur');
    }

    public function lojikacond() { 
        $this->viewBuilder()->setLayout('lojikacond');
    }


    //======= TEST STAT GOOGLE PAGE SOUVENIR

    public function getStatGeographique($id_evenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getStatGeographique($id_evenement);

        debug($stats);die;
    }

    public function getStatDevice($id_evenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getStatDevice($id_evenement);

        debug($stats);die;
    }

    public function getStatNavigateur($id_evenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getStatNavigateur($id_evenement);

        debug($stats);die;
    }

    public function getStatSource($id_evenement = null)
    {

        $this->loadComponent('GoogleAnalyticsTracking');
        $stats = $this->GoogleAnalyticsTracking->getStatSource($id_evenement);

        debug($stats);die;
    }
}
