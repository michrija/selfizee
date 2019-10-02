<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Filesystem\Folder;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\RegenerateImageComponent;
use App\Controller\Component\SendComponent; 
use Cake\Core\Configure;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Collection\Collection;

class GalerieShell extends Shell
{
    
    public function generateAcess(){
        
        $this->loadModel('Galeries');
        $galeries = $this->Galeries->find('all')
                                    ->contain('Users');
        //debug(count($galeries->toArray()));
        foreach($galeries as $galerie){
            /*$this->loadModel('Users');
            $user = $this->Users->find()
                            ->where(['galerie_id' => $galerie->id])
                            ->first();*/
            
            $user = $galerie->user;
            
            //debug($user);
            //$this->out('je passe');
            
            $data['username'] = strtoupper(trim($galerie->slug));
            $data['password'] = strtoupper(trim($galerie->slug));
            $data['role_id'] = 3;
            $data['galerie_id'] = $galerie->id;
            
            $this->loadModel('Users');
            if(!empty($user)){
                 $data['id'] = $user->id;
                 $entity = $this->Users->patchEntity($user, $data);
                 if($this->Users->save($entity)){
                    $this->out('Update Galerie '.$galerie->id);
                 }
                   
            }else{
                $entity = $this->Users->newEntity($data);
                if($this->Users->save($entity)){
                    $this->out('Save Galerie '.$galerie->id);
                }
            }
            
            
            
            
              
                
            
        }
    }

    public function EnvoiGalerie($idEvenement = null)
    {
        $this->loadModel('Evenements');
        $evenements  = $this->Evenements->find('all')
                                        ->contain([
                                            'Galeries',
                                            //'Clients'=>['ClientContacts'],
                                            'Photos' => function ($q) {
                                                return $q->order(['Photos.created'=> 'DESC'])->limit(1);
                                                //->where(['DATE_ADD(Photos.created, INTERVAL 1 DAY) <=' => Time::now()]);
                                            }
                                        ])
                                        ->where(['Evenements.id >' => 1543]);
        if(!empty($idEvenement)){
            $evenements = $evenements->where(['Evenements.id' => $idEvenement]);
        }
        //debug(count($evenements->toArray()));die;
        $this->loadModel('GalerieEmails');
        $event_have_emails_gal = $this->GalerieEmails->find('list', ['valueField'=>'evenement_id'])->toArray();

        foreach($evenements as $evenement){         
            if( !in_array($evenement->id, $event_have_emails_gal) && !empty($evenement->photos)){
                $emails = [];
                if(!empty($evenement->client->client_contacts)){
                    $collection = new Collection($evenement->client->client_contacts);
                    $emails = $collection->extract('email');
                    $emails = $emails->toList();
                }
                //debug($emails);die;
                $date_derniere_photo = $evenement->photos[0]['created'];                
                $date_envoi_galerie = date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($date_derniere_photo->format('Y-m-d H:i:s')))));
                $date_envoi_galerie = new \DateTime($date_envoi_galerie);
                $date_now = new \DateTime();
                //debug(Time::now());die;

                if($date_envoi_galerie <= $date_now) {
                    $this->out("OK OK OK");
                    $this->out($date_derniere_photo);
                    $this->out($evenement->id." ==>");
                    debug($date_envoi_galerie);

                    // $emails = ['celest1.pr@gmail.com'];
                    if(!empty($emails)){    
                        $this->Send = new SendComponent(new ComponentRegistry());                    
                        $sendGalerie = $this->Send->galerie($evenement, $emails);
                        $this->out("Send Ev_".$evenement->id." => ".$sendGalerie);
                        //die;
                    }
                }
            }
        }
    }
    
}