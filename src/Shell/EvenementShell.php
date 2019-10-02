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
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\Time;
use Cake\Mailer\Email;

/**
 * Simple console wrapper around Psy\Shell.
 */
class EvenementShell extends Shell
{
	
    /**
     * Start the shell and interactive console.
     *
     * @return int|null
     */
	 
	public function initialize(){
        parent::initialize();
        $this->loadModel('Evenements');
		$this->loadModel('Photos');
		$this->loadModel('PhotoStatistiques');
    }
	
    public function main()
    {
		date_default_timezone_set('Europe/Paris');
		$time = new Time('-20 days');
		$date_intervalle = $time->format('Y-m-d H:i:s');
		
		$tmp = [];
		
        $evenements = $this -> Evenements -> find('all')
			->where([
				'Evenements.deleted' => 0,
				'Clients.client_type' => 'corporation',
				'Evenements.date_debut >' => $date_intervalle
			])
			->contain(['Clients']);
		
		foreach($evenements as $evenement_item){
			$id_evenement = $evenement_item -> id;
			$photos_pro = $this -> Photos -> find('all')
				->where([
					'Photos.is_stat_traite' => false,
					'Photos.is_validate' => true,
					'Photos.is_in_corbeille' => false,
					'Photos.deleted' => false,
					'Photos.type_media' => 'photo',
					'Photos.evenement_id' => $id_evenement
				])->toArray();
			
			$i = 0;
			
			if(count($photos_pro)){
				$evt_photos = [];
				foreach($photos_pro as $photo_item){
					$i++;
					// $uriBase = 'https://westcentralus.api.cognitive.microsoft.com/face/v1.0/detect';
					$uriBase = 'https://francecentral.api.cognitive.microsoft.com/face/v1.0/detect';
					// $ocpApimSubscriptionKey = '5c7edca917024fa2816d9fc7c997a977';
					$ocpApimSubscriptionKey = 'f020c500740e40b9a081d0107d48a47d';
					
					$ch = curl_init($uriBase);
					$url_photo = $photo_item->url_photo_shell;
					// $url_photo = 'https://thumbs.dreamstime.com/z/groupe-de-personnes-la-ligne-d-arriv%C3%A9e-de-croisement-45890554.jpg';
					
					if(!file_exists($photo_item->uri_photo))
						continue;
						
					$json = json_encode(['url' => $url_photo]);
					$params = ['returnFaceAttributes' => 'age,gender,emotion', 'returnFaceLandmarks' => false];
					
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', '', 'Ocp-Apim-Subscription-Key: ' . $ocpApimSubscriptionKey));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
					curl_setopt($ch, CURLOPT_URL, $uriBase.'?' . http_build_query($params));
					$result = curl_exec($ch);
					curl_close($ch);

					$reponse = json_decode($result);
					$json_rep = json_encode($reponse, JSON_PRETTY_PRINT);
					$json_array = json_decode($json_rep, TRUE);
					// var_dump($json_array);exit;
					if(!array_key_exists('error', $json_array)){
						$nb_homme = 
						$nb_femme = 
						
						$moins_20 = 
						$v_t = 
						$t_q = 
						$q_s = 
						$plus_60 = 
						
						$nb_sourire = 
						$nb_neutre = 
						$nb_triste = 
						$nb_colere = 
						$nb_surpris = 
						$nb_peur = 0;
						$age_total = 0;
						
						$face_array = [];
						$photo_id = $photo_item->id;
						
						foreach($json_array as $face_item){
							
							// Classement par sexe
							if($face_item['faceAttributes']['gender'] == 'male'){
								$nb_homme++;
							}elseif($face_item['faceAttributes']['gender'] == 'female'){
								$nb_femme++;
							}
							
							if($nb_homme || $nb_femme){
								$age_total += $face_item['faceAttributes']['age'];
								// Classement par age
								if($face_item['faceAttributes']['age'] < 20){
									$moins_20++;
								}elseif($face_item['faceAttributes']['age'] >= 20 && $face_item['faceAttributes']['age'] < 30){
									$v_t++;
								}elseif($face_item['faceAttributes']['age'] >= 30 && $face_item['faceAttributes']['age'] < 40){
									$t_q++;
								}elseif($face_item['faceAttributes']['age'] >= 40 && $face_item['faceAttributes']['age'] < 60){
									$q_s++;
								}elseif($face_item['faceAttributes']['age'] >= 60){
									$plus_60++;
								}
								
								// Classement par emotion
								$max = max($face_item['faceAttributes']['emotion']);
								foreach($face_item['faceAttributes']['emotion'] as $key  => $item){
									if($item == $max){
										$emot = $key;
										break;
									}
								}
								if($key == 'happiness'){
									$nb_sourire++;
								}elseif($key == 'neutral'){
									$nb_neutre++;
								}elseif($key == 'sadness'){
									$nb_triste++;
								}elseif($key == 'surprise'){
									$nb_surpris++;
								}elseif($key == 'fear'){
									$nb_peur++;
								}elseif($key == 'anger'){
									$nb_colere++;
								}
								
							}
						}
						$stat_globale = $json_rep;
						// s'il existe au moins une personne => enregistrement
						if($nb_homme || $nb_femme){
							$face_array = [
								'photo_id' => $photo_id,
								'nb_homme' => $nb_homme,
								'nb_femme' => $nb_femme,
								'moins_20' => $moins_20,
								'a_20_30' => $v_t,
								'a_30_40' => $t_q,
								'a_40_60' => $q_s,
								'plus_60' => $plus_60,
								'age_total' => $age_total,
								'nb_sourire' => $nb_sourire,
								'nb_neutre' => $nb_neutre,
								'nb_triste' => $nb_triste,
								'nb_surpris' => $nb_surpris,
								'nb_peur' => $nb_peur,
								'nb_colere' => $nb_colere,
								'stat_globale' => $stat_globale,
							];
							
							$photoStatistique = $this->PhotoStatistiques->newEntity();
							$photoStatistique = $this->PhotoStatistiques->patchEntity($photoStatistique, $face_array);
							$this->PhotoStatistiques->save($photoStatistique);
						}
						
						$data_update = ['is_stat_traite' => true];
						$photo = $this->Photos->get($photo_id, [
							'contain' => []
						]);
						$photo = $this->Photos->patchEntity($photo, $data_update);
						$this->Photos->save($photo);
						
						if($i == 4){
							$i = 0;
							sleep(4);
						}
						$evt_photos[] = $photo;
					}else{
						if($json_array['error']['code'] == 'InvalidImage'){
							continue;
						}else{
							var_dump($json_array);
							exit;
						}
					}
				}
				
				if(count($evt_photos)){
					$tmp[] = $id_evenement;
				}
				// break;
			}
		}
		
		if(count($tmp)){
			$destinateurs = 'pauled8250188@gmail.com';
			$contenu = 'Evenements traités : '.implode(', ', $tmp);
			// Envoi mail
			$email = new Email('default');
			$email->setViewVars(['contenu' => $contenu])
				->setTemplate('sendacces')
				->setEmailFormat('html')
				->setFrom(["contact@selfizee.fr" => 'SELFIZEE '])
				->setSubject('Liste des événement traités pour la détection de visage')
				->setTransport('mailjet')
				->setTo($destinateurs);
			// $email->send();
		}
		
    }
	
}
