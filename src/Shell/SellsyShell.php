<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\SellsyCurlComponent;
use Cake\I18n\Date;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Routing\Router;

/**
 * Simple console wrapper around Psy\Shell.
 */
class SellsyShell extends Shell
{

    /**
     * Start the shell and interactive console.
     *
     * @return int|null
     */
    public function client()
    {
        $this->loadModel('Clients');
        $this->loadModel('ClientContacts');
        
        $requestClientPagination = array(
            'method' => 'Client.getList',
            'params' => array()
        );
        $this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
        $reponseClientPagination = $this->sellsyCurlComponent->requestApi($requestClientPagination);
        if($reponseClientPagination->status == "success"){
            $response = $reponseClientPagination->response;
            $infos = isset($response->infos) ? $response->infos : null;
            $nbrPage = isset($infos->nbpages) ? $infos->nbpages : 0;
            for ($i = 1; $i <= $nbrPage; $i++) {
                $requestClient = array(
                    'method' => 'Client.getList',
                    'params' => array(
                        'pagination' => array(
                            'pagenum' => $i,
                            'nbperpage' => 100
                        ))
                );
                $this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
                $reponseClient = $this->sellsyCurlComponent->requestApi($requestClient);
                $theReponse = $reponseClient->response;
                $clients = isset($theReponse->result) ? $theReponse->result : null;
                
                //debug($_clients_result);
                
                if (!empty($clients)) {
                    foreach ($clients as $idSellsy => $client) {
                        
                        //debug(intval($idSellsy));
                        
                        $clientContacts = isset($client->contacts) ? $client->contacts : null;
                        $clientContacts = $clientContacts != null ? json_decode(json_encode($clientContacts), true) : null;
                        $clientContacts = is_array($clientContacts) ? array_values($clientContacts) : null;
                        $clientContact = $clientContacts != null && isset($clientContacts[0]) ? (object)$clientContacts[0] : null;
                        
                       
                        $clientToInsert['nom'] = isset($client->name) ? $client->name : null;
                        $clientToInsert['prenom'] = isset($clientContact->forename) ? $clientContact->forename : null;
                        //$clientToInsert['url_img_profil'] = isset($clientContact->pic) ? $clientContact->pic : null;
                        $clientToInsert['cp'] = isset($client->addr_zip) ? intval($client->addr_zip) : null;
                        $clientToInsert['email'] = isset($clientContact->email) ? $clientContact->email : null;
                        $clientToInsert['ville'] = isset($client->addr_town) ? $client->addr_town : null;
                        $clientToInsert['telephone'] = isset($clientContact->tel) ? $clientContact->tel : null;
                        $clientToInsert['mobile'] = isset($clientContact->mobile) ? $clientContact->mobile : null;
                        $clientToInsert['country'] = isset($client->addr_countryname) ? $client->addr_countryname : null;
                        $clientToInsert['adresse'] = isset($client->addr_part1) ? $client->addr_part1 : null;
                        $clientToInsert['adresse_2'] = isset($client->addr_part2) ? $client->addr_part2 : null;
                        $clientToInsert['siren'] = isset($client->siren) ? $client->siren : null;
                        $clientToInsert['siret'] = isset($client->siret) ? $client->siret : null;
                        $clientToInsert['id_in_sellsy'] = $idSellsy;
                        $clientToInsert['delete_in_sellsy'] = false; //si sellsy retourne le client, c'est � dire que cen'est pas encore supprimer depuis sellsy'''
                        $clientToInsert['client_type'] = $client->type;
                        $clientToInsert["client_contacts"]  = array();
                        
                        //debug($client->contacts);die;
                        //contact user
                        if(isset($client->contacts)){
                            $listeContact = array();
                           
                            foreach($client->contacts as $key => $contact){
                                $oneContact = array();
                                $oneContact["nom"] = $contact->name;
                                $oneContact["prenom"] = $contact->forename;
                                $oneContact["position"] = $contact->position;
                                $oneContact["email"] = $contact->email;
                                $oneContact["tel"] = $contact->tel;
                                $oneContact["mobile"] = $contact->mobile;
                                $oneContact["civilite"] = $contact->civil;
                                $idInSellsy = $contact->id;
                                $oneContact["id_in_sellsy"] = $key;
                                $oneContact["deleted_in_sellsy"] = false;
                                $contactFind = $this->ClientContacts->find('all')->where(["id_in_sellsy" => intval($key)])->first();
                                if($contactFind){
                                    $oneContact["id"] = $contactFind->id;
                                }
                                //debug($oneContact);
                                array_push($listeContact, $oneContact);
                            }
                            $clientToInsert["client_contacts"] = $listeContact;
                        }
                        
                        $clientEntity = $this->Clients->newEntity();
                        $ClientFind= $this->Clients->find('all')->where(["id_in_sellsy" => intval($idSellsy)])->contain(['ClientContacts'])->first();
                        if($ClientFind){
                            $clientToInsert['id'] = $ClientFind->id;
                            $clientEntity  = $ClientFind;
                        }
                        //debug($clientToInsert); 
                        $clientEntity = $this->Clients->patchEntity($clientEntity, $clientToInsert, ['validate' => false],
                                                                            ['associated' => ['ClientContacts']]
                                                                    );
                        //debug($clientEntity); 
                        if ($this->Clients->save($clientEntity)) {
                            //var_dump($clientToInsert);
                            $this->out('sauver .'.$clientEntity->id);
                        }else{
                            debug($clientEntity); die;
                        }
                    }
                    
                }
            }
            
        }
        

        $this->out('fin.');
        return true;
    }
    
    
    public function document( $type = 'invoice'){ // OR Estimate
    
    	$this->loadModel('Documents');
    	$this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
    	$request = array(
    		'method' => 'Document.getList',
    		'params' => array(
    			'doctype' => $type
    		)
    	);
        
        if($type == 'invoice'){
            //$request['params']['search']['steps'] = array('');
        }else{ //estimate
            //$request['params']['search']['steps'] = array('accepted','invoiced');
        }
        
    	$documents = $this->sellsyCurlComponent->requestApi($request);
    	
    	$nbrPageResponses = $documents->response;
    	$infos = isset($nbrPageResponses->infos) ? $nbrPageResponses->infos : null;
    	$nbrPage = isset($infos->nbpages) ? $infos->nbpages : 0;
    	
    	//Mettre � jour tous les clients. Marquer suprimer depuis sellsy
    	if(!empty($nbrPageResponses)){
    		$this->Documents->updateAll(
    		['deleted_in_sellsy' => true],
    		['id >'=>0]);
    	}
        
        
    	$this->out('Lancement...');
    	for ($i = 1; $i <= $nbrPage; $i++) {
    		$requestDoc = array(
    			'method' => 'Document.getList',
    			'params' => array(
    				'doctype' => $type,
    				'pagination' => array(
    					'pagenum' => $i,
    					'nbperpage' => 100
    				)
    			)
    		);
            if($type == 'invoice'){
                //$requestDoc['params']['search']['steps'] = array('');
            }else{ //estimate
                $requestDoc['params']['search']['steps'] = array('accepted','invoiced');
            }
        
    		$this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
    		$documents = $this->sellsyCurlComponent->requestApi($requestDoc);
    	   /* debug($documents);
    		die;*/
    		if(!empty($documents)){
    			 
    	
    				$documentsResponses = $documents->response;
    				$documentsResult = isset($documentsResponses->result) ? $documentsResponses->result : null;
    				
    				//debug($documentsResponses); die;
    				
    				if ($documentsResult != null) {
    					foreach ($documentsResult as $idSellsy => $item) {
    						$documentsInsert['objet'] = isset($item->subject) ? $item->subject : null;
    						$documentsInsert['date'] = isset($item->displayedDate) ? $item->displayedDate : null;
    						$documentsInsert['montant_ttc'] = isset($item->totalAmount) ? floatval($item->totalAmount) : null;
                            $documentsInsert['montant_ht'] = $item->totalAmountTaxesFree;
    						$documentsInsert['id_in_sellsy'] = $idSellsy;
    						$documentsInsert['deleted_in_sellsy'] = false;
                            $documentsInsert['type_document'] = $type;
                            $documentsInsert['step'] = isset($item->step) ? $item->step : null;
                            $documentsInsert['ident'] = $item->ident;

                            //debug($idSellsy ." => ".$item->ident);
    						 //get public link
    						$requestLink = array(
    								'method' => 'Document.getPublicLink',
    								'params' => array(
    									'doctype' => $type,
    									'docid' => $idSellsy,
    								)
    						);
    						$this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
    						$link = $this->sellsyCurlComponent->requestApi($requestLink);
    						//debug($link);
    						$linkReponse = "";
    						if($link){
    						   $linkReponse = $link->response; 
    						}
    						
    						//debug($linkReponse);
    						$documentsInsert['url_sellsy'] = "https://www.sellsy.fr/".$linkReponse;
    						
    						$idClient = isset($item->thirdid) ? $item->thirdid : null;
    						
    						$clientFind = $this->Documents->Clients->find()->where(["id_in_sellsy" => intval($idClient)])->first();
    						if ($clientFind) {
    							$clientId = $clientFind->id;
    							$documentsInsert['client_id'] = $clientId;
    							
    							$document = $this->Documents->newEntity();
    							$docFind = $this->Documents->find('all')->where(["id_in_sellsy" => intval($idSellsy)])->first();
    							if ($docFind) {
    								$document = $docFind;
    							}
    							$document = $this->Documents->patchEntity($document, $documentsInsert, ['validate' => false]);
    						   
    							
    							if ($this->Documents->save($document)) {
    								$this->out('sauver .'.$document->id);
    								debug($document->id_in_sellsy." => ".$document->ident);

    							}
    						}
    					   
    					}
    					
    				}
    		}
    		
    	}
        $this->out('Terminer...');
    	
    }

    public function document2( $type = 'invoice'){ // OR Estimate

        $this->loadModel('Documents');
        $this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
        $request = array(
            'method' => 'Document.getList',
            'params' => array(
                'doctype' => $type
            )
        );

        if($type == 'invoice'){
            //$request['params']['search']['steps'] = array('');
        }else{ //estimate
            //$request['params']['search']['steps'] = array('accepted','invoiced');
        }

        $documents = $this->sellsyCurlComponent->requestApi($request);

        $nbrPageResponses = $documents->response;
        $infos = isset($nbrPageResponses->infos) ? $nbrPageResponses->infos : null;
        $nbrPage = isset($infos->nbpages) ? $infos->nbpages : 0;

        //Mettre � jour tous les clients. Marquer suprimer depuis sellsy
        if(!empty($nbrPageResponses)){
            $this->Documents->updateAll(
                ['deleted_in_sellsy' => true],
                ['id >'=>0]);
        }


        $this->out('Lancement...');
        for ($i = 1; $i <= $nbrPage; $i++) {
            $requestDoc = array(
                'method' => 'Document.getList',
                'params' => array(
                    'doctype' => $type,
                    'pagination' => array(
                        'pagenum' => $i,
                        'nbperpage' => 100
                    )
                )
            );
            if($type == 'invoice'){
                //$requestDoc['params']['search']['steps'] = array('');
            }else{ //estimate
                $requestDoc['params']['search']['steps'] = array('accepted','invoiced');
            }

            $this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
            $documents = $this->sellsyCurlComponent->requestApi($requestDoc);

            debug($documents);die;

            if(!empty($documents)){


                $documentsResponses = $documents->response;
                $documentsResult = isset($documentsResponses->result) ? $documentsResponses->result : null;

                //debug($documentsResponses); die;

                if ($documentsResult != null) {
                    foreach ($documentsResult as $idSellsy => $item) {
                        $documentsInsert['objet'] = isset($item->subject) ? $item->subject : null;
                        $documentsInsert['date'] = isset($item->displayedDate) ? $item->displayedDate : null;
                        $documentsInsert['montant_ttc'] = isset($item->totalAmount) ? floatval($item->totalAmount) : null;
                        $documentsInsert['montant_ht'] = $item->totalAmountTaxesFree;
                        $documentsInsert['id_in_sellsy'] = $idSellsy;
                        $documentsInsert['deleted_in_sellsy'] = false;
                        $documentsInsert['type_document'] = $type;
                        $documentsInsert['step'] = isset($item->step) ? $item->step : null;

                        //get public link
                        $requestLink = array(
                            'method' => 'Document.getPublicLink',
                            'params' => array(
                                'doctype' => $type,
                                'docid' => $idSellsy,
                            )
                        );
                        $this->sellsyCurlComponent = new SellsyCurlComponent(new ComponentRegistry());
                        $link = $this->sellsyCurlComponent->requestApi($requestLink);
                        //debug($link);
                        $linkReponse = "";
                        if($link){
                            $linkReponse = $link->response;
                        }

                        //debug($linkReponse);
                        $documentsInsert['url_sellsy'] = "https://www.sellsy.fr/".$linkReponse;

                        $idClient = isset($item->thirdid) ? $item->thirdid : null;

                        $clientFind = $this->Documents->Clients->find()->where(["id_in_sellsy" => intval($idClient)])->first();
                        if ($clientFind) {
                            $clientId = $clientFind->id;
                            $documentsInsert['client_id'] = $clientId;

                            $document = $this->Documents->newEntity();
                            $docFind = $this->Documents->find('all')->where(["id_in_sellsy" => intval($idSellsy)])->first();
                            if ($docFind) {
                                $document = $docFind;
                            }
                            $document = $this->Documents->patchEntity($document, $documentsInsert, ['validate' => false]);


                            if ($this->Documents->save($document)) {
                                $this->out('sauver .'.$document->id);
                            }
                        }

                    }

                }
            }

        }
        $this->out('Terminer...');

    }
   
    

    
   
}
