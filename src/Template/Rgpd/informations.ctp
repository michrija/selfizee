<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>
<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>

<?= $this->Html->css('politiques/pol.css?t='.time(), ['block' => true]) ?>
<?= $this->Html->script('Rgpd/informations.js?'.time(), ['block' => true]); ?>

<?php

$dernier_maj = ($last_modified && $last_modified != '-') ? '- Date de dernière mise à jour : '.$last_modified->format('d/m/Y').' à ' . $last_modified->format('H').'h'.$last_modified->format('i') : '';

?>
<div class="alert alert-success sl-msg-success hide" onclick="this.classList.add('hidden')" style="position: fixed;top: 0px;width: 100%;z-index: 1000;">Modification avec succés.</div>
<div class="container">
	<aside class="sl-body-box">
		<div class="sf-contenu">
			<div class="sf-contenu-recap text-center clearfix">
				<?php if(!$expired){ ?>
				<h3><strong>Récapitulatif des données relatives à l’adresse :</strong></h3>
				<h4><?php echo $email; ?></h4>
				<p><?php echo count($photos); ?> photo<?php echo count($photos) > 1 ? 's' : '' ?> sur <?php echo $nb_evt; ?> événement<?php echo $nb_evt > 1 ? 's' : ''; ?> <?php echo $dernier_maj; ?></p>
				<?php } ?>
				
				<?php 
					if($nb_evt > 0) {
						echo $this->Html->link('Exporter les données', [
								'controller' => 'rgpd', 
								'action' => 'exportData', $email_tp,
								'ext' => 'csv'
							], ['class'=>'text-muted']);
					}
					?>
			</div>
			<div class="sf-contenu-detail clearfix">
				<?php
					$init = 
					$buffer = '';
					$i = 0;
					$j = 0;
					foreach($photos as $photo_item){
						$i++;
						$prenom = 
						$nom = 
						$telephone = 
						$email_propose = 
						$date_prise = ' - ';
						if($init != $photo_item->photo->evenement->id){
							$init = $photo_item->photo->evenement->id;
							$j++;
							
							$enc_1 = $i % 2 == 0 ? (time() * rand(1, 587419) * $photo_item->photo->evenement->id) : md5(md5($photo_item->photo->evenement->id));
							$enc_2 = $i % 2 == 0 ? md5(md5($photo_item->photo->evenement->id)) : (time() * rand(587420, 58741940) * $photo_item->photo->evenement->id);
							
							$ref_tt = [
								'tt_diff' => $enc_1,
								'evenement_id' => $init,
								'email' => $email,
								'is_all' => 1,
								'nbr' => count($event_gpt[$init]),
								'tt_diff_2' => $enc_2
							];
							
							$separateur_event = "<hr style='padding: 20px;'>";
							if($j > 1) $buffer .= $separateur_event;
							$buffer .= '<h3>Evénement : '.$photo_item->photo->evenement->nom.'</h3>'.
							'<nav><span class="text-muted">'.count($event_gpt[$init]).' photo'.(count($event_gpt[$init]) > 1 ? 's' : '').'<span> | <a href="#" class="text-muted sf-supp-inf sf-link-effet-survol" data-tp="s" data-rf="'.$utilities->slEncryption(serialize($ref_tt)).'">Supprimer les informations liées à cet adresse de cet événement</a></nav>';
						}
						
						
						if(!empty($photo_item->photo->date_prise_photo)){
							$date_prise = str_replace(':', 'h', $photo_item->photo->heure_prise_photo);
						}
						// Email
						if(!empty($photo_item->email_propose)){
							$email_propose = '<p style="margin-bottom:0">'.$photo_item->email_propose.'</p>';
						}
						// Nom
						if(!empty($photo_item->nom)){
							$nom = '<p style="margin-bottom:0">'.$photo_item->nom.'</p>';
						}
						// Prénoms
						if(!empty($photo_item->prenom)){
							$prenom = '<p style="margin-bottom:0">'.$photo_item->prenom.'</p>';
						}
						// Téléphone
						if(!empty($photo_item->telephone)){
							$telephone = '<p">'.$photo_item->telephone.'</p>';
						}
						
						$ref_un = [
							'diff' => (time() * rand(1, 4590088) * $photo_item->id),
							'id' => $photo_item->id,
							'evenement_id' => $photo_item->photo->evenement->id,
							'email' => $email,
							'is_all' => 0,
							'nbr' => 1,
							'diff2' => (time() * rand(4590089, 45978576) * $photo_item->id)
						];
						$parametre = ['idEvenement' => $photo_item->photo->evenement->id];

						$optin = [0=>'Non', 1=>'Oui'];
						$portable = $photo_item->telephone;
						if(empty($photo_item->telephone)) $portable = ' - ';				
						$champAffiche = [];
						$champAffiche2 = "";
						$affiche_edition = "";
						
						//$positionChampEventCourant = $positionChamps[$photo_item->photo->evenement_id];
						$champExist = [];
						if(!empty($photo_item->email)){
							$champAffiche2 = $champAffiche2.'<span> E-mail : '.$photo_item->email.'</span><br>';
							$champExist[] = $photo_item->email;
						}
						if(!empty($photo_item->telephone)){
							$champAffiche2 = $champAffiche2.'<span> Portable : '.$photo_item->telephone.'</span><br>';
							$champExist[] = $photo_item->telephone;
						}
						if (array_key_exists($photo_item->photo->evenement_id, $positionChamps) && !empty($positionChamps[$photo_item->photo->evenement_id])) {	
													if(in_array($email, ['celest1.pr@gmail.com', 's.mahe@konitys.fr', 'zanakolonajym@gmail.com'])) 								$affiche_edition = '<a class="text-muted sf-edit-inf" href="#" data-rf="'.$photo_item->photo->id.'"  data-ml="'.$email.'"><u>Editer les données</u></a><br>';

							$champs = $positionChamps[$photo_item->photo->evenement_id];
							for($s =1 ; $s <= 7; $s++){								
								$survey = 'survey'.$s;
								if(!empty($photo_item->photo->$survey) && array_key_exists($s, $champs)) {
									$nomChamp = $champs[$s];
									$champAffiche [$nomChamp] = $photo_item->photo->$survey;
									if($photo_item->photo->$survey == "Yes" || $photo_item->photo->$survey == "yes" || $photo_item->photo->$survey == "YES") $champAffiche [$nomChamp] = "Oui";
									
									if(!in_array($champAffiche [$nomChamp], $champExist)) $champAffiche2 = $champAffiche2.'<span>'.$nomChamp.' : '.$champAffiche [$nomChamp].'</span><br>';
								}else{
									if(!empty($photo_item->photo->$survey)){
										$surveyChamp = $photo_item->photo->$survey;
										if($surveyChamp == "Yes" || $surveyChamp == "yes" || $surveyChamp == "YES") $surveyChamp = "Oui";
										if(!in_array($surveyChamp , $champExist)) $champAffiche2 = $champAffiche2.'<span> Champ '.$s.' : '.$surveyChamp.'</span><br>';
									}
								}
							}
						}
						if(empty($champAffiche2)) $champAffiche2 = " - <br>";
						
						$politique_client = !empty($photo_item->photo->evenement->evenement_politique) ? '<br/><a class="text-muted sf-link-effet-survol" href="'.$domaine.'politique-de-traitement-des-donnees/'.$utilities->slEncryption(serialize($parametre)).'">Consulter la politique de confidentialité '.($photo_item->photo->evenement->evenement_politique->nom_client ? 'de '.$photo_item->photo->evenement->evenement_politique->nom_client : 'du fournisseur').'</a>' : '';
						
						// $media = '<img id="'.$photo_item->id.'" photo-id="'.$photo_item->photo->id.'" src="'.$photo_item->photo->url_thumb_souv.'" alt="'.$photo_item->photo->created.'">';
						$media = '<img class="sf-photo-detail" data-tp="0" data-src="'.$photo_item->photo->url_thumb_popup.'" id="'.$photo_item->id.'" data-ref="'.$utilities->slEncryption(serialize(['idPhoto' => $photo_item->photo_id])).'" src="'.$photo_item->photo->url_thumb_souv.'" alt="'.$photo_item->photo->created.'">';
						
						$md = 0;
						if($photo_item->photo->type_media == 'video'){
							$md = 1;
							$media = '<div class="sf-container-video sf-photo-detail text-center" data-tp="1" data-poster="'.$photo_item->photo->url_miniature_video.'" data-src="'.$photo_item->photo->url_thumb_popup.'" style="background-image:url('.$photo_item->photo->url_miniature_video.');" id="'.$photo_item->id.'" data-ref="'.$utilities->slEncryption(serialize(['idPhoto' => $photo_item->photo_id])).'" ><img src="/img/icon-play.png"></div>';
						}
						
						// Démographie liée à la photo
						$demographie = '';
						if($photo_item->photo->photo_statistique){
							$stat = $photo_item->photo->photo_statistique;
							$nb_homme = $stat -> nb_homme;
							$nb_femme = $stat -> nb_femme;
							$age_total = $stat -> age_total;
							$nb_sourire = $stat -> nb_sourire;
							$nb_neutre = $stat -> nb_neutre;
							$nb_triste = $stat -> nb_triste;
							$nb_surpris = $stat -> nb_surpris;
							$nb_peur = $stat -> nb_peur;
							$nb_colere = $stat -> nb_colere;
														
							$total = $nb_homme + $nb_femme;
							
							$pourcentage_homme = $nb_homme * 100 / $total;
							$pourcentage_homme = round($pourcentage_homme, 0);
							$pourcentage_femme = $nb_femme * 100 / $total;
							$pourcentage_femme = round($pourcentage_femme, 0);
							
							$age_moyen = $age_total / $total;
							$age_moyen = round($age_moyen, 0);
							
							$pourcentage_sourire = $nb_sourire * 100 / $total;
							$pourcentage_sourire = round($pourcentage_sourire, 0);
							$pourcentage_neutre = $nb_neutre * 100 / $total;
							$pourcentage_neutre = round($pourcentage_neutre, 0);
							$pourcentage_triste = $nb_triste * 100 / $total;
							$pourcentage_triste = round($pourcentage_triste, 0);
							$pourcentage_surpris = $nb_surpris * 100 / $total;
							$pourcentage_surpris = round($pourcentage_surpris, 0);
							$pourcentage_peur = $nb_peur * 100 / $total;
							$pourcentage_peur = round($pourcentage_peur, 0);
							$pourcentage_colere = $nb_colere * 100 / $total;
							$pourcentage_colere = round($pourcentage_colere, 0);
							
							$demographie .= $nb_homme ? '<span> Homme : '.$pourcentage_homme.'%</span><br/>' : '';
							$demographie .= $nb_femme ? '<span> Femme : '.$pourcentage_femme.'%</span><br/>' : '';
							$demographie .= $age_moyen ? '<span> Age moyen : '.$age_moyen.' ans</span><br/>' : '';
							
							$demographie .= $nb_sourire ? '<span> Sourire : '.$pourcentage_sourire.'%</span><br/>' : '';
							$demographie .= $nb_neutre ? '<span> Neutre : '.$pourcentage_neutre.'%</span><br/>' : '';
							$demographie .= $nb_triste ? '<span> Triste : '.$pourcentage_triste.'%</span><br/>' : '';
							$demographie .= $nb_surpris ? '<span> Surpris : '.$pourcentage_surpris.'%</span><br/>' : '';
							$demographie .= $nb_peur ? '<span> Peur : '.$pourcentage_peur.'%</span><br/>' : '';
							$demographie .= $nb_colere ? '<span> Sourire : '.$pourcentage_colere.'%</span><br/>' : '';
							
						}
						
						$buffer .= ''.
							'<div class="sf-contenu-bloc-img">'.
								'<figure class="clearfix row">'.
									'<div class="col-md-6">'.
										$media.
									'</div>'.
									'<figcaption class="col-md-6">'.
										'<h5>Date de prise de la photo :</h5>'.
										'<p>'.$date_prise.'</p>'.
										'<h5>Conditions d\'utilisation :</h5>'.
										'<p>'.
											// 'Les conditions d’utilisations ont été acceptées<br/>'.
											'<a class="text-muted sf-link-effet-survol" href="'.$domaine.'politique-de-traitement-des-donnees" target="_blank">Consulter la politique de confidentialité de Selfizee</a>'.
											$politique_client.
										'</p>'.
										'<h5>Données enregistrées:</h5>'.
										/*
										$prenom.
										$nom.
										$email_propose.
										$telephone.
										'<p><a class="text-muted sf-supp-inf" href="#" data-rf="'.$utilities->slEncryption(serialize($ref_un)).'"><u>Supprimer les données et autorisations liées à cet e-mail pour cet événement</u></a></p>'.
										=======*/
										//'<p>'.$email_propose.'</p>'.
										//'<span>Portable : '.$portable.'</span><br>'. 
										$champAffiche2.
										//'<span>Optin Email : '.$optin[$photo_item->photo->is_optin_email].'</span><br>'.
										//'<span>Optin Sms : '.$optin[$photo_item->photo->is_optin_sms].'</span><br>'.
										//'<span>Optin Facebook : '.$optin[$photo_item->photo->is_postable_on_facebook].'</span><br>'.
										(trim($demographie) ? '<h5 style="margin-top:15px;">Données démographiques</h5><h6>Estimation statistique intelligence artificielle : </h6>'.$demographie : '').
										$affiche_edition.
										'<a class="text-muted sf-supp-inf sf-link-effet-survol" href="#" data-md="'.$md.'" data-rf="'.$utilities->slEncryption(serialize($ref_un)).'"  data-ml="'.$email.'">Supprimer les données et autorisations liées à cet e-mail pour cet événement</a>'.
									'</figcaption>'.
								'</figure>'.
							'</div>';
					}
					
					if($expired){
						$buffer = '<div class="alert alert-danger">'.
							'<h3 class="text-danger"><i class="fa fa-info-circle"></i> Information</h3> Ce lien est déjà expiré. Pour y accéder à nouveau merci de réitérer votre demande sur <a href="'.$domaine.'" class="text-info">'.$domaine.'</a>'.
						'</div>';
					}
					
					if(trim($buffer) == ''){
						$buffer = '<div class="alert alert-warning">'.
								'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Attention</h3> Vous n\'avez aucun média et aucun événement en ce moment.'.
							'</div>';
					}
					
					echo $buffer;
				?>
				<?php echo $this -> Form -> create('politique', ['id' => 'sf-politique-form']); ?>
				<input type="hidden" value="" name="idEvenement">
				<?php echo $this -> Form -> end(); ?>
			</div>
		</div>	
	</aside>
</div>
