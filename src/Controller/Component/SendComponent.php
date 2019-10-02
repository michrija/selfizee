<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use \Mailjet\Resources;
use Base64Url\Base64Url;

class SendComponent extends Component{
    
    public $components = ['Smsenvoi','Utilities'];
    
    public function sms($photo,  $contact, $smsConfiguration,  $forceToSend = false, $queue = null, $sourceExecution="auto", $user_id = 0){
        //die;
        $returnResult = false;
        if($photo->id > 213583 && $photo->is_optin_sms ){ //213583 // && $photo->is_optin_sms
            $this->Envois = TableRegistry::get('Envois');
            $isAlreadySent = $this->Envois->find()
                                            ->where(['contact_id' => $contact->id, 'envoi_type' => 'sms'])
                                            ->first();
            if($forceToSend){
                $isAlreadySent = false;
            }
            
            //var_dump($isAlreadySent);
            
            //if(!$isAlreadySent && in_array($contact->telephone,['+261342109101','+33630682013','033630682013','33630682013','630682013','0630682013'])){
              if(!$isAlreadySent){  
                $nomEvenement = $photo->evenement->nom;
        
                
                $nomEmmetteur = 'SELFIZEE';
                $message = 'Retrouvez votre photo '.$nomEvenement.': [[lien_partage]] ';
                if(!empty($smsConfiguration)){
                    
                    if(!empty($smsConfiguration->expediteur)){
                        $nomEmmetteur = $smsConfiguration->expediteur;
                    }
                    
                    if(!empty($smsConfiguration->contenu)){
                        $message = $smsConfiguration->contenu;
                    }
                    
                }
                
                
                
                $shareLink = $photo->url_photo_souvenir_shell.'?c='.Base64Url::encode($contact->id);
                $message = str_replace('[[lien_partage]]', $shareLink, $message);
                
                $numeroDestinataire = trim($contact->telephone);
                $numeroDestinataire = str_replace(" ", "", $numeroDestinataire);
                $codepaysDefault   = "+33";
                if (strpos($numeroDestinataire, "+") !== false) {
                    $numeroDestinataire = $numeroDestinataire;
                } else {
                    $numeroDest         = substr($numeroDestinataire, 1);
                    $numeroDestinataire = $codepaysDefault . $numeroDest;
                }
                
                $result = $this->Smsenvoi->sendSMS($numeroDestinataire, $message, 'PREMIUM', $nomEmmetteur);
                //debug($result);
                if($result['success']){
                    $returnResult = true;
					$dataEnvoi['user_id'] = $user_id;
                    $dataEnvoi['contact_id'] = $contact->id;
                    $dataEnvoi['envoi_type'] = 'sms';
                    $dataEnvoi['is_force_envoi'] =  $forceToSend;
                    $dataEnvoi['message_id_in_smsenvoi'] = $result['message_id'];
                    $dataEnvoi['queue'] = $queue;
                    $dataEnvoi['source_envoi'] = $sourceExecution;
                    $envoi = $this->Envois->newEntity($dataEnvoi);
                    $this->Envois->save($envoi);
                }
            }
        
        }
        return $returnResult;
    }
    
    public function email($photo, $contact , $emailConfiguration, $forceToSend = false, $queue = null, $sourceExecution = 'auto', $user_id = 0){
        //var_dump($emailConfiguration);
        //die;
        //die;
        $returnResult = false;
        if($photo->id > 214677 && $photo->is_optin_email ){ //213583 // && $photo->is_optin_email
            $this->Envois = TableRegistry::get('Envois');
            $isAlreadySentExiste = $this->Envois->find()
                                    ->where(['contact_id' => $contact->id, 'envoi_type' => 'email'])
                                    ->first();
            
            if($forceToSend){
                $isAlreadySentExiste = false;
            }
             //var_dump($isAlreadySentExiste); 
            //if(!$isAlreadySentExiste && in_array($contact->email,['jeanyves@loesys.fr','zanakolonajym@gmail.com','s.mahe@loesys.fr','s.mahe@konitys.fr'])){
              if(!$isAlreadySentExiste) {
                //var_dump($emailConfiguration->toArray()); 
                $message = "Bonjour,<br>  <p>Voici votre photo. <a href='[[lien_partage]]'>Cliquer ici</a> </p><p><em>[[miniature]]</em><br></p>";
                $subject = 'Votre photo depuis SELFIZEE';
                $sender = "contact@selfizee.fr";
                $sendername = "SELFIZEE";
                $code = null;
                $this->CodePromos = TableRegistry::get('CodePromos');
                if(!empty($emailConfiguration) ){
                    //debug($emailConfiguration->toArray()); die;
                    
                    //
                    //debug($emailConfiguration);
                    if($emailConfiguration->is_has_code_promo){
                        
                        $code = $this->CodePromos->find()
                                            ->where(['CodePromos.email_configuration_id' => $emailConfiguration->id,
                                                     'CodePromos.is_deja_attribue' => false,
                                                     'CodePromos.code_promo <>' => '',
                                                     'CodePromos.code_promo IS NOT' => NULL
                                                    ])
                                            ->first();
                        
                        if(!empty($emailConfiguration->content_code_promo && !empty($code))){
                            $message = $emailConfiguration->content_code_promo;
                            $message    = str_replace('[[promo]]', $code->code_promo, $message);
                        }
                    }else{
                       if(!empty($emailConfiguration->content)){
                            $message = $emailConfiguration->content;
                        } 
                    }
                    
                    
                    
                    if(!empty($emailConfiguration->objet)){
                        $subject = $emailConfiguration->objet;
                    }
                    
                    if(!empty($emailConfiguration->email_expediteur)){
                        $sender = $emailConfiguration->email_expediteur;
                    }
                    
                    if(!empty($emailConfiguration->nom_expediteur)){
                        $sendername = $emailConfiguration->nom_expediteur;
                    }
                }
                $miniature = '<img src="'.$photo->url_photo_shell.'" alt="Votre photo"  width="200px" style="dislpay:block;"/>';
                if($photo->type_media == 'video'){
                    $miniature = '<img src="'.$photo->url_miniature_video.'" alt="Votre vidéo"  width="200px" style="dislpay:block;"/>';
                }
                $minlink    = '<a href="' .$photo->url_photo_souvenir_shell.'" >'.$miniature.'</a>';
               
                $message    = str_replace('[[nom]]', $contact->nom, $message);
                $message    = str_replace('[[email]]', $contact->email, $message);
                $message    = str_replace('[[prenom]]', $contact->prenom, $message);
                $message    = str_replace('[[miniature]]', $miniature, $message);
                $message    = str_replace('[[lien_partage]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[lien_partage_img]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[miniature_lien]]', $minlink, $message);

                //Pour les nouveaux code en images
                $message    = str_replace('<img src="'.Configure::read('url_admin_domaine').'img/nom.png" style="width: 150px;">', $contact->nom, $message);
                $message    = str_replace('<img src="'.Configure::read('url_admin_domaine').'img/prenom.png" style="width: 150px;">', $contact->prenom, $message);
                $message    = str_replace('<img src="'.Configure::read('url_admin_domaine').'img/param_email.png" style="width: 150px;">', $contact->email, $message);
                $message    = str_replace('<img src="'.Configure::read('url_admin_domaine').'img/miniature.png" style="width: 150px;">', $miniature, $message);
                $message    = str_replace('<img src="'.Configure::read('url_admin_domaine').'img/lien_page_souvenir.png" style="width: 150px;">', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('<img src="'.Configure::read('url_admin_domaine').'img/miniature_lien.png" style="width: 150px;">', $minlink, $message);

                for($s=1; $s<= 7; $s++){
                    $survey = 'survey'.$s;
                    $message    = str_replace('[[survey'.$s.']]', $photo->$survey, $message);
                }
                
                //$couleur_btn_download = $emailConfiguration->couleur_btn_download;
                
                /**Share link **/
                $btnShareLinkContent = '<table style="border-collapse:collapse;max-width:240px!important" cellspacing="0" cellpadding="0" border="0">'.
				  '<tbody>'.
					'<tr>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;max-width:240px!important" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="'.Configure::read('url_front_domaine').'photos/download/'.$photo->id.'">'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_btn_download, 1).'&source=download.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="'.$photo->url_photo_souvenir_shell.'">'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_facebook, 1).'&source=facebook.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="https://twitter.com/intent/tweet?url='.$photo->url_photo.'">'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_twitter, 1).'&source=twitter.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="'.Configure::read("url_front_domaine").'partages/instagram/'.$photo->token.'" title="Partager sur Instagram" >'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_instagram, 1).'&source=instagram.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					'</tr>'.
				  '</tbody>'.
				'</table>';
                
                $message    = str_replace('[[share]]', $btnShareLinkContent, $message);
                $destinataire = $contact->email;

                if($photo->evenement->is_rgpd_actif)  {
                    $linkRgdp = Configure::read('url_rgpd_domaine') . 'e/inf/' . $this->Utilities->slEncryption(serialize(['email' => $destinataire, 'time' => time()]));

                    $linkDonnes = Configure::read('url_rgpd_domaine').'politique-de-traitement-des-donnees/'.$this->Utilities->slEncryption(serialize($photo->evenement_id));

                    $message = $message."<p style='text-align:center;'>Accédez à la gestion de vos données personnelles en lien avec la réglementation RGPD : <a href='".$linkRgdp."'>accès à mon espace </a></p>
                        <p style='text-align:center;'>Consulter la politique de traitement des données : <a href='".$linkDonnes."'>accès à la documentation</a></p>";

                }

                
                
                
                if(!$photo->evenement->is_marque_blanche)  {
                    
                    $this->ClientsSignaturesEmails = TableRegistry::get('ClientsSignaturesEmails');
                    $signature = $this->ClientsSignaturesEmails->find('all')->where(['client_id'=>$photo->evenement->client_id])->first();
                    if($signature && $signature->is_active_modif_signature) {
                        $message = $message.$signature->signature_email;
                    } else {
                        $message = $message .'<div style="color:#474747">
                            <p>E-mail envoyé depuis la borne photo Selfizee : </p>
                            <p><strong>Soirées professionnelles et privées dans toute la France : </strong></p>
                            <p>soirées événementielles, salons et foires, séminaires, événements sportifs, mariages, anniversaires ...</p>
                            <p><a href="https://www.selfizee.fr" style="color:#f00e5d">www.selfizee.fr</a></p>   
                        </div>';
                    }
                }

                
                
                $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
                $apisecret = '1787d0ef5b8602e692cc86895494bb12';
                
                $mj = new \Mailjet\Client($apikey, $apisecret);
                
                if(!empty($emailConfiguration->couleur_fond_editeur)){
                    $message = '<div style=" padding : 15px; background-color:'.$emailConfiguration->couleur_fond_editeur.'">'.$message.'</div>';
                }
                
                $body = [
                    'FromEmail' => $sender,
                    'FromName' => $sendername,
                    'Subject' => $subject,
                    'Html-part' => $message,
                    /*'Recipients' => [
                        [
                            'Email' => $destinataire
                        ]
                    ],*/
                    'To' =>  $destinataire,
                    'Mj-campaign' => $photo->evenement->slug,
                    'X-Mailjet-TrackOpen'=>1,
                    'X-Mailjet-TrackClick'=>1,
                ];
                
                if(!empty($emailConfiguration)){    
                    if ($emailConfiguration->is_photo_en_pj && is_file($photo->uri_photo) && file_exists($photo->uri_photo) && !empty($photo->uri_photo) ) {
                        
                        $filename_pj = $photo->name_origne;

                         // == Pour 2552, 2553
                         //== get nom photo pour selection le copie en crop ou l inverse
                         $this->Photos = TableRegistry::get('Photos');
                         $nom_photo = $photo->name_origne;
                         $nom_photo = explode('.', $nom_photo);
                         $nom_ph = $nom_photo['0'];
                         $ext_ph = $nom_photo['1'];    
                         //Pour 2552: Utilise pour avoir le matricule dans l'email de la photo et sa copie (croppee)              
                         $is_pj_name_pesonalise = false;  
                         $matricule_vraie = ""; 

                         //=== Pour 2552 :Modifier le nom du pj par le Matricule
                        if(in_array($photo->evenement->id, ['2552', '2562'])){
                            $this->Contacts = TableRegistry::get('Contacts');
                            $contact_photo = $this->Contacts->find()
                                            ->where(['photo_id' => $photo->id])
                                            ->first();
                            if($contact_photo) {
                                $matricule = $this->before("@", $contact_photo->email);
                                $lettre_2_first = substr($matricule, 0, 2);
                                if($lettre_2_first == "S5" && strlen($matricule) == 7) {
                                    $is_pj_name_pesonalise = true;
                                    $matricule_vraie = $matricule; // copie matricule //temp
                                    //debug($matricule);die;
                                    $matricule = $matricule."-F";
                                    if($photo->is_croppee) {
                                        $matricule = $matricule."-P";
                                    } 
                                    $filename_pj = $matricule.'.'.$ext_ph;
                                }                                
                            }                                                  
                            
                            debug('PJ N.1 : '.$filename_pj);//die;
                        }

                        $body['Attachments'] = [[
                            'Content-type'=>  mime_content_type($photo->uri_photo),
                            'Filename'=>$filename_pj,
                            'content' =>  base64_encode(file_get_contents($photo->uri_photo))
                        ]];
                        //====== rajout 2em PJ pour 2160
                        if($photo->evenement->id == 2160) {
                            $photo_name = $photo->name_origne;
                            $photo_name = explode(".", $photo_name);                          
                            $photo_name_2 = "";
                            if($photo_name[1] == "jpg") {
                                $photo_name_2 = $photo_name[0].".gif";
                            } else if($photo_name[1] == "gif") {
                                $photo_name_2 = $photo_name[0].".jpg";
                            }
                            if(file_exists(WWW_ROOT . "import" . DS . "galleries" . DS . '2160/'.$photo_name_2)) {
                                $body['Attachments'][] = [ 
                                    'Content-type'=> mime_content_type(WWW_ROOT . "import" . DS . "galleries" . DS . '2160/'.$photo_name_2),
                                    'Filename'=>  $photo_name_2,
                                    'content' => base64_encode(file_get_contents(WWW_ROOT . "import" . DS . "galleries" . DS . '2160/'.$photo_name_2))
                                ];
                            }
                            //debug($body);die;
                        }
                        //=======================

                         //====== test copie email 2562 (Event test)
                         //=== Event vrai : 2552, 2553
                        if(in_array($photo->evenement->id, ['2552', '2553', '2562'])){                           
                            if($photo->is_croppee) {     
                                //get normal
                                $photo_non_crop = $this->Photos->find()
                                    ->where(['evenement_id' => $photo->evenement->id, 'name_origne LIKE' => $nom_ph.'%',  'is_croppee' => false ])
                                    ->first();
                                $photo_2 = $photo_non_crop;
                                debug("Croppe : ".$photo_2->is_croppee." Copie : ".$photo_2->uri_photo);

                                if($photo_2){
                                    $filename_pj_copie = $nom_ph.".jpg";//$photo_2->name_origne;
                                    
                                    if($is_pj_name_pesonalise) {
                                        $nom_photo_copie = explode('.', $photo_2->name_origne);
                                        $ext_ph_copie = $nom_photo_copie['1'];                 
                                        $matricule = $matricule_vraie."-F";
                                        $filename_pj_copie = $matricule.'.jpg'; //$matricule.'.'.$ext_ph_copie; 
                                        //debug('PJ N.2 : '.$filename_pj_copie);
                                    }
                                    debug("PJ N.2 COPIE (Originale) : ".$filename_pj_copie);                                   
                                    if(file_exists(WWW_ROOT . "import" . DS . "galleries" . DS . $photo->evenement->id . DS .$photo_2->name_origne)) {
                                        $body['Attachments'][] = [ 
                                            'Content-type'=> mime_content_type(WWW_ROOT . "import" . DS . "galleries" . DS . $photo->evenement->id . DS .$photo_2->name_origne),
                                            'Filename'=>  $filename_pj_copie,
                                            'content' => base64_encode(file_get_contents(WWW_ROOT . "import" . DS . "galleries" . DS . $photo->evenement->id . DS .$photo_2->name_origne))
                                        ];
                                    }
                                }                                

                            } else {
                                //get croppée
                                $photo_crop = $this->Photos->find()
                                    ->where(['evenement_id' => $photo->evenement->id, 'name_origne LIKE' => $nom_ph.'%',  'is_croppee' => true ])
                                    ->first();
                                $photo_2 = $photo_crop;
                                debug("Croppe : ".$photo_2->is_croppee." Copie : ".$photo_2->uri_photo);
                                
                                if($photo_2){
                                    $filename_pj_copie = $nom_ph.".jpg";//$photo_2->name_origne;
                                    if($is_pj_name_pesonalise) {                              
                                        $nom_photo_copie = explode('.', $photo_2->name_origne);
                                        $ext_ph_copie = $nom_photo_copie['1'];                 
                                        $matricule = $matricule_vraie."-P";
                                        $filename_pj_copie = $matricule.'.jpg'; //$matricule.'.'.$ext_ph_copie; 
                                        //debug('PJ N.2 : '.$filename_pj_copie);
                                    }
                                    debug("PJ N.2 COPIE (CROPPEE) : ".$filename_pj_copie);
                                    if(file_exists(WWW_ROOT . "import" . DS . "galleries" . DS . $photo->evenement->id . DS . 'crop/'.$photo_2->name_origne)) {
                                        $body['Attachments'][] = [ 
                                            'Content-type'=> mime_content_type(WWW_ROOT . "import" . DS . "galleries" . DS . $photo->evenement->id . DS . 'crop/'.$photo_2->name_origne),
                                            'Filename'=>  $filename_pj_copie,
                                            'content' => base64_encode(file_get_contents(WWW_ROOT . "import" . DS . "galleries" . DS . $photo->evenement->id . DS . 'crop/'.$photo_2->name_origne))
                                        ];
                                    }
                                }
                            }
                            
                            //== debug
                            debug("NBR PJ : ".count($body['Attachments']));
                            //foreach($body['Attachments'] as $pj ){
                                //debug($pj['Filename']);
                            //}
                        }

                    }
                }               
                    
                //====== Rajout carbone Copie 
                if($photo->evenement->id == 2562) {
                   //$body['Recipients'][]['Email'] = "naejbrandi@gmail.com";                   
                   $body['Cc'] = 'naejbrandi@gmail.com';
               }
               //
               if(in_array($photo->evenement->id, ['2552', '2553'])){
                   $body['Cc'] = 'com@ca-cotesdarmor.fr';//''; // 'celest1.pr@gmail.com';
               }
                
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                $response->success();
                //debug($response->getStatus());
                //debug($response->getData());
                
                if($response->getStatus()==200){
                    $returnResult = true;
                    $res = $response->getData();
                    //debug($res);
                    $dataEnvoi['message_id_in_mailjet'] = $res['Sent'][0]['MessageID'];
                    $dataEnvoi['user_id'] = $user_id;
                    $dataEnvoi['contact_id'] = $contact->id;
                    $dataEnvoi['envoi_type'] = 'email';
                    $dataEnvoi['is_force_envoi'] =  $forceToSend;
                    $dataEnvoi['queue'] = $queue;
                    $dataEnvoi['source_envoi'] = $sourceExecution;
                    $envoi = $this->Envois->newEntity($dataEnvoi);
                    $this->Envois->save($envoi);
                    
                    //Code promo attribue
                    if(!empty($code) && $emailConfiguration->is_has_code_promo){
                        $code->is_deja_attribue = true;
                        $code->photo_id = $photo->id;
                        $code->envoi_id = $envoi->id;
                        $this->CodePromos->save($code);
                    }
                    
                }
                //var_dump($contact->email);
            }
        
        }
        
        return $returnResult;
    }

    //=== To get chaine avant et apres @ dans l'email
    public function after($char, $inthat)
    {
        if (!is_bool(strpos($inthat, $char)))
        return substr($inthat, strpos($inthat,$char)+strlen($char));
    }
    public function before($char, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $char));
    }

    public function emailDebug($photo, $contact , $emailConfiguration, $forceToSend = false, $queue = null, $sourceExecution = 'auto', $user_id = 0){
        //var_dump($emailConfiguration);
        //die;
        //die;
        $returnResult = false;
        if($photo->id > 214677 && $photo->is_optin_email ){ //213583 // && $photo->is_optin_email
            $this->Envois = TableRegistry::get('Envois');
            $isAlreadySentExiste = $this->Envois->find()
                                    ->where(['contact_id' => $contact->id, 'envoi_type' => 'email'])
                                    ->first();
            
            if($forceToSend){
                $isAlreadySentExiste = false;
            }
             //var_dump($isAlreadySentExiste); 
            //if(!$isAlreadySentExiste && in_array($contact->email,['jeanyves@loesys.fr','zanakolonajym@gmail.com','s.mahe@loesys.fr','s.mahe@konitys.fr'])){
              if(!$isAlreadySentExiste) {
                //var_dump($emailConfiguration->toArray()); 
                $message = "Bonjour,<br>  <p>Voici votre photo. <a href='[[lien_partage]]'>Cliquer ici</a> </p><p><em>[[miniature]]</em><br></p>";
                $subject = 'Votre photo depuis SELFIZEE';
                $sender = "contact@selfizee.fr";
                $sendername = "SELFIZEE";
                $code = null;
                $this->CodePromos = TableRegistry::get('CodePromos');
                if(!empty($emailConfiguration) ){
                    //debug($emailConfiguration->toArray()); die;
                    
                    //
                    //debug($emailConfiguration);
                    if($emailConfiguration->is_has_code_promo){
                        
                        $code = $this->CodePromos->find()
                                            ->where(['CodePromos.email_configuration_id' => $emailConfiguration->id,
                                                     'CodePromos.is_deja_attribue' => false,
                                                     'CodePromos.code_promo <>' => '',
                                                     'CodePromos.code_promo IS NOT' => NULL
                                                    ])
                                            ->first();
                        
                        if(!empty($emailConfiguration->content_code_promo && !empty($code))){
                            $message = $emailConfiguration->content_code_promo;
                            $message    = str_replace('[[promo]]', $code->code_promo, $message);
                        }
                    }else{
                       if(!empty($emailConfiguration->content)){
                            $message = $emailConfiguration->content;
                        } 
                    }
                    
                    
                    
                    if(!empty($emailConfiguration->objet)){
                        $subject = $emailConfiguration->objet;
                    }
                    
                    if(!empty($emailConfiguration->email_expediteur)){
                        $sender = $emailConfiguration->email_expediteur;
                    }
                    
                    if(!empty($emailConfiguration->nom_expediteur)){
                        $sendername = $emailConfiguration->nom_expediteur;
                    }
                }
                $miniature = '<img src="'.$photo->url_photo_shell.'" alt="Votre photo"  width="200px" style="dislpay:block;"/>';
                if($photo->type_media == 'video'){
                    $miniature = '<img src="'.$photo->url_miniature_video.'" alt="Votre vidéo"  width="200px" style="dislpay:block;"/>';
                }
                $minlink    = '<a href="' .$photo->url_photo_souvenir_shell.'" >'.$miniature.'</a>';
               
                $message    = str_replace('[[nom]]', $contact->nom, $message);
                $message    = str_replace('[[email]]', $contact->email, $message);
                $message    = str_replace('[[prenom]]', $contact->prenom, $message);
                $message    = str_replace('[[miniature]]', $miniature, $message);
                $message    = str_replace('[[lien_partage]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[lien_partage_img]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[miniature_lien]]', $minlink, $message);

                for($s=1; $s<= 7; $s++){
                    $survey = 'survey'.$s;
                    $message    = str_replace('[[survey'.$s.']]', $photo->$survey, $message);
                }
                
                //$couleur_btn_download = $emailConfiguration->couleur_btn_download;
                
                /**Share link **/
                $btnShareLinkContent = '<table style="border-collapse:collapse;max-width:240px!important" cellspacing="0" cellpadding="0" border="0">'.
				  '<tbody>'.
					'<tr>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;max-width:240px!important" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="'.Configure::read('url_front_domaine').'photos/download/'.$photo->id.'">'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_btn_download, 1).'&source=download.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="'.$photo->url_photo_souvenir_shell.'">'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_facebook, 1).'&source=facebook.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="https://twitter.com/intent/tweet?url='.$photo->url_photo.'">'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_twitter, 1).'&source=twitter.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					  '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
						'<p  style="line-height:14.25pt">'.
							'<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
								'<a href="'.Configure::read("url_front_domaine").'partages/instagram/'.$photo->token.'" title="Partager sur Instagram" >'.
									'<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_instagram, 1).'&source=instagram.png"  width="50" border="0">'.
								'</a>'.
							'</span>'.
						'</p>'.
					  '</td>'.
					'</tr>'.
				  '</tbody>'.
				'</table>';
                
                $message    = str_replace('[[share]]', $btnShareLinkContent, $message);
                $destinataire = $contact->email;

                if($photo->evenement->is_rgpd_actif)  {
                    $linkRgdp = Configure::read('url_rgpd_domaine') . 'e/inf/' . $this->Utilities->slEncryption(serialize(['email' => $destinataire, 'time' => time()]));

                    $linkDonnes = Configure::read('url_rgpd_domaine').'politique-de-traitement-des-donnees/'.$this->Utilities->slEncryption(serialize($photo->evenement_id));

                    $message = $message."<p style='text-align:center;'>Accédez à la gestion de vos données personnelles en lien avec la réglementation RGPD : <a href='".$linkRgdp."'>accès à mon espace </a></p>
                        <p style='text-align:center;'>Consulter la politique de traitement des données : <a href='".$linkDonnes."'>accès à la documentation</a></p>";

                }

                
                
                
                if(!$photo->evenement->is_marque_blanche)  {
                    
                    $this->ClientsSignaturesEmails = TableRegistry::get('ClientsSignaturesEmails');
                    $signature = $this->ClientsSignaturesEmails->find('all')->where(['client_id'=>$photo->evenement->client_id])->first();
                    if($signature && $signature->is_active_modif_signature) {
                        $message = $message.$signature->signature_email;
                    } else {
                        $message = $message.'
                        <div style="color:#474747">
                            <p>E-mail envoyé depuis la borne photo Selfizee : </p>
                            <p><strong>Soirées professionnelles et privées dans toute la France : </strong></p>
                            <p>soirées événementielles, salons et foires, séminaires, événements sportifs, mariages, anniversaires ...</p>
                            <p><a href="https://www.selfizee.fr" style="color:#f00e5d">www.selfizee.fr</a></p>
                        </div>';
                    }
                    debug($message);
                }

                
                
                $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
                $apisecret = '1787d0ef5b8602e692cc86895494bb12';
                
                $mj = new \Mailjet\Client($apikey, $apisecret);
                
                if(!empty($emailConfiguration->couleur_fond_editeur)){
                    $message = '<div style=" padding : 15px; background-color:'.$emailConfiguration->couleur_fond_editeur.'">'.$message.'</div>';
                }
                
                $body = [
                    'FromEmail' => $sender,
                    'FromName' => $sendername,
                    'Subject' => $subject,
                    'Html-part' => $message,
                    'Recipients' => [
                        [
                            'Email' => $destinataire
                        ]
                    ],
                    'Mj-campaign' => $photo->evenement->slug,
                    'X-Mailjet-TrackOpen'=>1,
                    'X-Mailjet-TrackClick'=>1,
                ];

                
                if(!empty($emailConfiguration)){    
                    if ($emailConfiguration->is_photo_en_pj && is_file($photo->uri_photo) && file_exists($photo->uri_photo) && !empty($photo->uri_photo) ) {
                        
                        $body['Attachments'] = [[
                            'Content-type'=>  mime_content_type($photo->uri_photo),
                            'Filename'=>$photo->name_origne,
                            'content' =>  base64_encode(file_get_contents($photo->uri_photo))
                        ]];
                        //====== rajout 2em PJ pour 2160
                        if($photo->evenement->id == 2160) {
                            $photo_name = $photo->name_origne;
                            $photo_name = explode(".", $photo_name);                          
                            $photo_name_2 = "";
                            if($photo_name[1] == "jpg") {
                                $photo_name_2 = $photo_name[0].".gif";
                            } else if($photo_name[1] == "gif") {
                                $photo_name_2 = $photo_name[0].".jpg";
                            }
                            if(file_exists(WWW_ROOT . "import" . DS . "galleries" . DS . '2160/'.$photo_name_2)) {
                                $body['Attachments'][] = [ 
                                    'Content-type'=> mime_content_type(WWW_ROOT . "import" . DS . "galleries" . DS . '2160/'.$photo_name_2),
                                    'Filename'=>  $photo_name_2,
                                    'content' => base64_encode(file_get_contents(WWW_ROOT . "import" . DS . "galleries" . DS . '2160/'.$photo_name_2))
                                ];
                            }
                            //debug($body);die;
                        }
                        //=======================
                    }
                }
                
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                debug($response);
                $response->success();
                //debug($response->getStatus());
                
                if($response->getStatus()==200){
                    $returnResult = true;
                    $res = $response->getData();
                    //debug($res);
                    $dataEnvoi['message_id_in_mailjet'] = $res['Sent'][0]['MessageID'];
                    $dataEnvoi['user_id'] = $user_id;
                    $dataEnvoi['contact_id'] = $contact->id;
                    $dataEnvoi['envoi_type'] = 'email';
                    $dataEnvoi['is_force_envoi'] =  $forceToSend;
                    $dataEnvoi['queue'] = $queue;
                    $dataEnvoi['source_envoi'] = $sourceExecution;
                    $envoi = $this->Envois->newEntity($dataEnvoi);
                    //$this->Envois->save($envoi);
                    
                    //Code promo attribue
                    if(!empty($code) && $emailConfiguration->is_has_code_promo){
                        $code->is_deja_attribue = true;
                        $code->photo_id = $photo->id;
                        $code->envoi_id = $envoi->id;
                        //$this->CodePromos->save($code);
                    }
                    
                }
                //var_dump($contact->email);
            }
        
        }
        
        return $returnResult;
    }

    public function emailPropose($photo, $contact , $emailConfiguration, $forceToSend = false, $queue = null, $sourceExecution = 'auto'){
        //var_dump($emailConfiguration);
        //die;
        //die;
        $returnResult = false;
        if($photo->id > 214677  ){ //213583
            $this->Envois = TableRegistry::get('Envois');
            $isAlreadySentExiste = $this->Envois->find()
                                    ->where(['contact_id' => $contact->id, 'envoi_type' => 'email'])
                                    ->first();

              if($isAlreadySentExiste) {
                //var_dump($emailConfiguration->toArray()); 
                $message = "Bonjour,<br>  <p>Voici votre photo. <a href='[[lien_partage]]'>Cliquer ici</a> </p><p><em>[[miniature]]</em><br></p>";
                $subject = 'Votre photo depuis SELFIZEE';
                $sender = "contact@selfizee.fr";
                $sendername = "SELFIZEE";
                if(!empty($emailConfiguration) ){
                    //debug($emailConfiguration->toArray()); die;
                    if(!empty($emailConfiguration->content)){
                        $message = $emailConfiguration->content;
                    }
                    
                    if(!empty($emailConfiguration->objet)){
                        $subject = $emailConfiguration->objet;
                    }
                    
                    if(!empty($emailConfiguration->email_expediteur)){
                        $sender = $emailConfiguration->email_expediteur;
                    }
                    
                    if(!empty($emailConfiguration->nom_expediteur)){
                        $sendername = $emailConfiguration->nom_expediteur;
                    }
                }
                $miniature = '<img src="'.$photo->url_photo_shell.'" alt="Votre photo"  width="200px" style="dislpay:block;"/>';
                if($photo->type_media == 'video'){
                    $miniature = '<img src="'.$photo->url_miniature_video.'" alt="Votre vidéo"  width="200px" style="dislpay:block;"/>';
                }
                $minlink    = '<a href="' .$photo->url_photo_souvenir_shell.'" >'.$miniature.'</a>';
               
                $message    = str_replace('[[nom]]', $contact->nom, $message);
                $message    = str_replace('[[email]]', $contact->email_propose, $message);
                $message    = str_replace('[[prenom]]', $contact->prenom, $message);
                $message    = str_replace('[[miniature]]', $miniature, $message);
                $message    = str_replace('[[lien_partage]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[lien_partage_img]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[miniature_lien]]', $minlink, $message);
                
                $destinataire = $contact->email_propose;
                
                
                if(!$photo->evenement->is_marque_blanche)  {

                    $this->ClientsSignaturesEmails = TableRegistry::get('ClientsSignaturesEmails');
                    $signature = $this->ClientsSignaturesEmails->find('all')->where(['client_id'=>$photo->evenement->client_id])->first();
                    if($signature && $signature->is_active_modif_signature) {
                        $message = $message.$signature->signature_email;
                    } else {
                        $message = $message .'<div style="color:#474747">
                            <!--<br />
                            <a href="https://selfizee.fr" target="_blank">
                                <img scr= "'.Configure::read('url_front_domaine').'/webroot/email/logo.png" "alt"="Selfizee" "style"="display:block" />
                            </a>-->
                            <p>E-mail envoyé depuis la borne photo Selfizee : </p>
                            <p><strong>Soirées professionnelles et privées dans toute la France : </strong></p>
                            <p>soirées événementielles, salons et foires, séminaires, événements sportifs, mariages, anniversaires ...</p>
                            <p><a href="https://www.selfizee.fr" style="color:#f00e5d">www.selfizee.fr</a></p>   
                        </div>';
                    }
                } 
                
                $apikey = '182ed20eaa36eb16e8ec9d78a4a17dd1';
                $apisecret = '1787d0ef5b8602e692cc86895494bb12';
                
                $mj = new \Mailjet\Client($apikey, $apisecret);
                
                $body = [
                    'FromEmail' => $sender,
                    'FromName' => $sendername,
                    'Subject' => $subject,
                    'Html-part' => $message,
                    'Recipients' => [
                        [
                            'Email' => $destinataire
                        ]
                    ],
                    'Mj-campaign' => $photo->evenement->slug,
                    'X-Mailjet-TrackOpen'=>1,
                    'X-Mailjet-TrackClick'=>1,
                ];

                
                if(!empty($emailConfiguration)){    
                    if ($emailConfiguration->is_photo_en_pj && is_file($photo->uri_photo) && file_exists($photo->uri_photo) && !empty($photo->uri_photo) ) {
                        
                        $body['Attachments'] = [[
                            'Content-type'=>  mime_content_type($photo->uri_photo),
                            'Filename'=>$photo->name_origne,
                            'content' =>  base64_encode(file_get_contents($photo->uri_photo))
                        ]];
                    }
                }
                
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                $response->success();
                
                if($response->getStatus()==200){
                    $returnResult = true;
                    $res = $response->getData();
                    //debug($res);
                    $dataEnvoi['message_id_in_mailjet'] = $res['Sent'][0]['MessageID'];
                    $dataEnvoi['contact_id'] = $contact->id;
                    $dataEnvoi['envoi_type'] = 'email';
                    $dataEnvoi['is_force_envoi'] =  $forceToSend;
                    $dataEnvoi['queue'] = $queue;
                    $dataEnvoi['source_envoi'] = $sourceExecution;
                    $envoi = $this->Envois->get($isAlreadySentExiste->id);
                    //debug($envoi);debug($dataEnvoi);
                    $envoi = $this->Envois->patchEntity($envoi, $dataEnvoi);
                    $this->Envois->save($envoi);           
                }
                //var_dump($contact->email);
            }
        
        }
        
        return $returnResult;
    }
    
    public function emailOld($photo, $contact , $emailConfiguration, $forceToSend = false){
        //var_dump($emailConfiguration);
        //die;
        //die;
        if($photo->id > 214677  ){ //213583
            $this->Envois = TableRegistry::get('Envois');
            $isAlreadySentExiste = $this->Envois->find()
                                    ->where(['contact_id' => $contact->id, 'envoi_type' => 'email'])
                                    ->first();
            
            if($forceToSend){
                $isAlreadySentExiste = false;
            }
             //var_dump($isAlreadySentExiste); 
            //if(!$isAlreadySentExiste && in_array($contact->email,['jeanyves@loesys.fr','zanakolonajym@gmail.com','s.mahe@loesys.fr','s.mahe@konitys.fr'])){
              if(!$isAlreadySentExiste) {
                //var_dump($emailConfiguration->toArray()); 
                $message = "Bonjour,<br>  <p>Voici votre photo. <a href='[[lien_partage]]'>Cliquer ici</a> </p><p><em>[[miniature]]</em><br></p>";
                $subject = 'Votre photo depuis SELFIZEE';
                $sender = "contact@selfizee.fr";
                $sendername = "SELFIZEE";
                if(!empty($emailConfiguration) ){
                    //debug($emailConfiguration->toArray()); die;
                    if(!empty($emailConfiguration->content)){
                        $message = $emailConfiguration->content;
                    }
                    
                    if(!empty($emailConfiguration->objet)){
                        $subject = $emailConfiguration->objet;
                    }
                    
                    if(!empty($emailConfiguration->email_expediteur)){
                        $sender = $emailConfiguration->email_expediteur;
                    }
                    
                    if(!empty($emailConfiguration->nom_expediteur)){
                        $sendername = $emailConfiguration->nom_expediteur;
                    }
                }
                $miniature = '<img src="'.$photo->url_photo_shell.'" alt="Votre photo"  width="200px" style="dislpay:block;"/>';
                if($photo->type_media == 'video'){
                    $miniature = '<img src="'.$photo->url_miniature_video.'" alt="Votre vidéo"  width="200px" style="dislpay:block;"/>';
                }
                $minlink    = '<a href="' .$photo->url_photo_souvenir_shell.'" >'.$miniature.'</a>';
               
                $message    = str_replace('[[nom]]', $contact->nom, $message);
                $message    = str_replace('[[email]]', $contact->email, $message);
                $message    = str_replace('[[prenom]]', $contact->prenom, $message);
                $message    = str_replace('[[miniature]]', $miniature, $message);
                $message    = str_replace('[[lien_partage]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[lien_partage_img]]', $photo->url_photo_souvenir_shell, $message);
                $message    = str_replace('[[miniature_lien]]', $minlink, $message);
                
                $destinataire = $contact->email;
                
                //($sendername); 
                
                $email = new Email();
                $email
                    ->setFrom([$sender => $sendername])
                    ->setDomain('event.selfizee.fr')
                    ->setViewVars(['content' => $message,'evenement'=>$photo->evenement])
                    ->setTemplate('remotevent')
                    ->setEmailFormat('html')
                   
                    ->setTo($destinataire);
                
                if(!empty($emailConfiguration)){    
                    if ($emailConfiguration->is_photo_en_pj) {
                        $email->setAttachments($photo->uri_photo);
                    }
                }
        
                $email->setSubject($subject)
                    ->setTransport('mailjet')
                    ->addHeaders(
                        array(
                            "X-MAILJET-CAMPAIGN" => $photo->evenement->slug,
                            "X-MJ-CUSTOMID" => $contact->id,
                            'X-Mailjet-TrackOpen'=>2,
                            'X-Mailjet-TrackClick'=>2,
                            )
                    );
                
                //var_dump($email);
                
                if ($email->send()) {
                    $dataEnvoi['contact_id'] = $contact->id;
                    $dataEnvoi['envoi_type'] = 'email';
                    $dataEnvoi['is_force_envoi'] =  $forceToSend;
                    $envoi = $this->Envois->newEntity($dataEnvoi);
                    $this->Envois->save($envoi);
                    
                }
                //var_dump($contact->email);
            }
        
        }
    }
    
    public function emailTest($destinataire, $nom, $prenom, $emailConfiguration ){
            //var_dump($emailConfiguration->toArray()); 
            $rs = false;
            
            $message = "Bonjour,<br>  <p>Voici votre photo. Cliquer <a hre='[[lien_partage]]'>ici</a> </p><p><em>[[miniature]]</em><br></p>";
            $subject = 'Votre photo depuis SELFIZEE';
            $sender = "contact@selfizee.fr";
            $sendername = "SELFIZEE";
            $code = null;
            $this->CodePromos = TableRegistry::get('CodePromos');
            if(!empty($emailConfiguration)){
                //debug($emailConfiguration->toArray()); die;
                if($emailConfiguration->is_has_code_promo){
                    
                    $code = $this->CodePromos->find()
                                        ->where(['CodePromos.email_configuration_id' => $emailConfiguration->id,
                                                 'CodePromos.is_deja_attribue' => false,
                                                 'CodePromos.code_promo <>' => '',
                                                 'CodePromos.code_promo IS NOT' => NULL
                                                ])
                                        ->first();
                    
                    if(!empty($emailConfiguration->content_code_promo && !empty($code))){
                        $message = $emailConfiguration->content_code_promo;
                        $message    = str_replace('[[promo]]', $code->code_promo, $message);
                    }
                }else{
                   if(!empty($emailConfiguration->content)){
                        $message = $emailConfiguration->content;
                    } 
                }

                /*if(!empty($emailConfiguration->content)){
                    $message = $emailConfiguration->content;
                }*/
                
                if(!empty($emailConfiguration->objet)){
                    $subject = $emailConfiguration->objet;
                }
                
                if(!empty($emailConfiguration->email_expediteur)){
                    $sender = $emailConfiguration->email_expediteur;
                }
                
                if(!empty($emailConfiguration->nom_expediteur)){
                    $sendername = $emailConfiguration->nom_expediteur;
                }
            }
            $urlSouvenirTest = Configure::read('url_front_domaine').'t/'.$emailConfiguration->evenement_id;
            $urlPhotoTest  = Configure::read('url_front_domaine').'img/test.jpg';
            
            $miniature = '<img src="'.$urlPhotoTest.'" alt="Votre photo"  width="200px" style="dislpay:block;"/>';
            if($photo->type_media == 'video'){
                    $miniature = '<img src="'.$photo->url_miniature_video.'" alt="Votre vidéo"  width="200px" style="dislpay:block;"/>';
            }
            $minlink    = '<a href="' .$urlSouvenirTest.'" >'.$miniature.'</a>';
           
            $message    = str_replace('[[nom]]', $nom, $message);
            $message    = str_replace('[[email]]', $destinataire, $message);
            $message    = str_replace('[[prenom]]', $prenom, $message);
            $message    = str_replace('[[miniature]]', $miniature, $message);
            $message    = str_replace('[[lien_partage]]', $urlSouvenirTest, $message);
            $message    = str_replace('[[lien_partage_img]]', $urlSouvenirTest, $message);
            $message    = str_replace('[[miniature_lien]]', $minlink, $message);

            if($emailConfiguration->evenement->is_rgpd_actif)  {
                    $linkRgdp = Configure::read('url_rgpd_domaine') . 'e/inf/' . $this->Utilities->slEncryption(serialize(['email' => $destinataire, 'time' => time()]));

                    $linkDonnes = Configure::read('url_rgpd_domaine').'politique-de-traitement-des-donnees/'.$this->Utilities->slEncryption(serialize($emailConfiguration->evenement->id));

                    $message = $message."<p style='text-align:center;'>Accédez à la gestion de vos données personnelles en lien avec la réglementation RGPD : <a href='".$linkRgdp."'>accès à mon espace </a></p><br>
                        <p style='text-align:center;'>Consulter la politique de traitement des données : <a href='".$linkDonnes."'>accès à la documentation</a></p>";

                }

            for($s=1; $s<= 7; $s++){
                    $survey = 'survey'.$s;
                    $message    = str_replace('[[survey'.$s.']]', "", $message);
            }
            
            /**Share link **/
            $btnShareLinkContent = '<table style="border-collapse:collapse;max-width:240px!important" cellspacing="0" cellpadding="0" border="0">'.
                  '<tbody>'.
                    '<tr>'.
                      '<td style="padding:0cm 3.75pt 0cm 3.75pt;max-width:240px!important" valign="top">'.
                        '<p  style="line-height:14.25pt">'.
                            '<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
                                '<a href="'.Configure::read('url_front_domaine').'photos/download/'.$photo->id.'">'.
                                    '<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_btn_download, 1).'&source=download.png"  width="50" border="0">'.
                                '</a>'.
                            '</span>'.
                        '</p>'.
                      '</td>'.
                      '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
                        '<p  style="line-height:14.25pt">'.
                            '<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
                                '<a href="'.$photo->url_photo_souvenir_shell.'">'.
                                    '<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_facebook, 1).'&source=facebook.png"  width="50" border="0">'.
                                '</a>'.
                            '</span>'.
                        '</p>'.
                      '</td>'.
                      '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
                        '<p  style="line-height:14.25pt">'.
                            '<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
                                '<a href="https://twitter.com/intent/tweet?url='.$photo->url_photo.'">'.
                                    '<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_twitter, 1).'&source=twitter.png"  width="50" border="0">'.
                                '</a>'.
                            '</span>'.
                        '</p>'.
                      '</td>'.
                      '<td style="padding:0cm 3.75pt 0cm 3.75pt;word-break:break-word" valign="top">'.
                        '<p  style="line-height:14.25pt">'.
                            '<span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#222222">'.
                                '<a href="'.Configure::read("url_front_domaine").'partages/instagram/'.$photo->token.'" title="Partager sur Instagram" >'.
                                    '<img src="'.Configure::read('url_front_domaine').'photos/editorColorIcon?color='.substr($emailConfiguration->couleur_share_instagram, 1).'&source=instagram.png"  width="50" border="0">'.
                                '</a>'.
                            '</span>'.
                        '</p>'.
                      '</td>'.
                    '</tr>'.
                  '</tbody>'.
                '</table>';
                
            $message    = str_replace('[[share]]', $btnShareLinkContent, $message);


            if(!empty($emailConfiguration->couleur_fond_editeur)){
                    $message = '<div style=" padding : 15px; background-color:'.$emailConfiguration->couleur_fond_editeur.'">'.$message.'</div';
            }

           

            
            
            //($sendername); 
            
            $email = new Email();
            $email
                ->setFrom([$sender => $sendername])
                ->setDomain('event.selfizee.fr')
                ->setViewVars(['content' => $message,'evenement'=>$emailConfiguration->evenement])
                ->setTemplate('remotevent')
                ->setEmailFormat('html')
                ->setTo($destinataire);
                
            if ($emailConfiguration->is_photo_en_pj) {
                $email->setAttachments(WWW_ROOT.'img/test.jpg');
            }
    
            $email->setSubject($subject)
                ->setTransport('mailjet');
            
            //var_dump($email); die;
            
            if ($email->send()) {
                
                $rs = true;
                
            }
            
            return $rs;
    }
    
    public function smsTest($destinataire, $smsConfiguration){
        
        $rs = false;
        $nomEvenement = $smsConfiguration->evenement->nom;
        
        
        $nomEmmetteur = 'SELFIZEE';
        $message = 'Retrouvez votre photo '.$nomEvenement.': [[lien_partage]] ';
        if(!empty($smsConfiguration)){
            
            if(!empty($smsConfiguration->expediteur)){
                $nomEmmetteur = $smsConfiguration->expediteur;
            }
            
            if(!empty($smsConfiguration->contenu)){
                $message = $smsConfiguration->contenu;
            }
            
        }
        
        
        $shareLink = Configure::read('url_front_domaine').'t/'.$smsConfiguration->evenement_id;
        $message = str_replace('[[lien_partage]]', $shareLink, $message);
        
        $numeroDestinataire = trim($destinataire);
        $numeroDestinataire = str_replace(" ", "", $numeroDestinataire);
        $codepaysDefault   = "+33";
        if (strpos($numeroDestinataire, "+") !== false) {
            $numeroDestinataire = $numeroDestinataire;
        } else {
            $numeroDest         = substr($numeroDestinataire, 1);
            $numeroDestinataire = $codepaysDefault . $numeroDest;
        }
        
        $result = $this->Smsenvoi->sendSMS($numeroDestinataire, $message, 'PREMIUM', $nomEmmetteur);
        //debug($result);
        if($result['success']){
           $rs = true;
        }
        
        return $rs;
    }

    public function galerie($evenement, $destinataires) {

        date_default_timezone_set('Europe/Paris');
        $success = false;
        //$this->loadModel('GalerieEmails');
        $this->GalerieEmails = TableRegistry::get('GalerieEmails');
        $email = new Email('default');
            $email->setViewVars(['slug' => $evenement->slug])
                ->setTemplate('sendgalerie')
                ->setEmailFormat('html')
                ->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
                ->setSubject('Selfizee : Accès à votre galerie '.$evenement->slug)
                ->setTransport('mailjet')
                ->setTo($destinataires);
                if ($email->send()) {
                    $success = true;

                    $galery_email = $this->GalerieEmails->newEntity();
                    $galery_email->date = date('Y-m-d H:i:s');
                    $galery_email->galerie_id = $evenement->galeries[0]->id;
                    $galery_email->client_id = $evenement->client->id;
                    $galery_email->evenement_id = $evenement->id;
                    $galery_email->destinateurs = implode(", ", $destinataires);
                    $this->GalerieEmails->save($galery_email);
                }

        return $success;
    }

}