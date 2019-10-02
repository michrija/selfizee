<?php

$dernier_maj = ($last_modified && $last_modified != '-') ? '- Date de dernière mise à jour : '.$last_modified->format('d/m/Y').' à ' . $last_modified->format('H').'h'.$last_modified->format('i') : '';

?>
<div class="sf-contenu">
	<div class="sf-contenu-recap text-center clearfix">
		<h3><strong>Récapitulatif des données relatives à l’adresse :</strong></h3>
		<h4><?php echo $email; ?></h4>
		<p><?php echo count($photos); ?> photo<?php echo count($photos) > 1 ? 's' : '' ?> sur <?php echo $nb_evt; ?> événement<?php echo $nb_evt > 1 ? 's' : ''; ?> <?php echo $dernier_maj; ?></p>
	</div>
	<div class="sf-contenu-detail clearfix">
		<?php
			$init = 
			$buffer = '';
			foreach($photos as $photo_item){
				$email_propose = 
				$date_prise = ' - ';
				
				if($init != $photo_item->photo->evenement->id){
					$init = $photo_item->photo->evenement->id;
					$buffer .= '<h3>Evénement : '.$photo_item->photo->evenement->nom.'</h3>'.
					'<nav><span class="text-muted">'.count($event_gpt[$init]).' photo'.(count($event_gpt[$init]) > 1 ? 's' : '').'<span> | <a href="#" class="text-muted"><u>Supprimer les informations liées à cet adresse de cet événement</u></a></nav>';
				}
				
				
				if(!empty($photo_item->photo->date_prise_photo)){
					$date_prise = str_replace(':', 'h', $photo_item->photo->heure_prise_photo);
				}
				if(!empty($photo_item->email_propose)){
					$email_propose = $photo_item->email_propose;
				}
				
				$buffer .= ''.
					'<div class="sf-contenu-bloc-img">'.
						'<figure class="clearfix row">'.
							'<div class="col-md-6">'.
								'<img src="'.$photo_item->photo->url_thumb_souv.'" alt="'.$photo_item->photo->created.'">'.
							'</div>'.
							'<figcaption class="col-md-6">'.
								'<h5>Date de prise de la photo :</h5>'.
								'<p>'.$date_prise.'</p>'.
								'<h5>Conditions d\'utilisation :</h5>'.
								'<p>'.
									'Les conditions d’utilisations ont été acceptées<br/>'.
									'<a class="text-muted" href="#"><u>Cliquez pour consulter la politique de confidentialité fournisseur.</u></a>'.
								'</p>'.
								'<h5>Données enregistrées:</h5>'.
								'<p>'.$email_propose.'</p>'.
								'<a class="text-muted" href="#"><u>Supprimer les données et autorisations liées à cet e-mail pour cet événement</u></a>'.
							'</figcaption>'.
						'</figure>'.
					'</div>';
			}
			echo $buffer;
		?>
	</div>
</div>	