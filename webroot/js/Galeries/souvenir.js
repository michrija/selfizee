$(document).ready(function(){
	
	$('body').on('click', '.sf-download-front', function(e){
		e.preventDefault();
		
		var idGalerie = $(this).data('id');
		var source = $(this).data('source');
		var queue = $(this).data('queue');
		
		var titre = 'Génération lien de téléchargement';
		var contenu = '<div class="form-group">'+
			'<label for="champ_email_download_zip" class="control-label">Veuillez saisir votre adresse e-mail (<strong class="text-danger">*</strong>)</label>'+
			'<input type="email" id="champ_email_download_zip" class="form-control" placeholder="exemple@email.com">'+
			'<span class="help-block"><small>Après la validation du formulaire, le fichier de téléchargement sera généré automatiquement. Vous recevrez un lien dans votre boite mail pour le télécharger. Attention le délai peut varier en fonction du nombre de photos de votre événement.</small></span>'+
			'<div id="notification"></div>'+
		'</div>';
		var footer = '<button type="button" class="btn btn-default" data-dismiss="modal" id="sf-fermer-modal">Fermer</button><button class="btn btn-primary" id="valide_form_reponse">Valider</button>';
		
		ouvrirModal(titre, contenu, footer, false, false);
		
		$('#valide_form_reponse').on('click', function(){
			e.preventDefault();
			var mail = $.trim($('#informationModal').find('#champ_email_download_zip').val());
			if(mail != '' && idGalerie > 0){
				$(this).addClass('disabled');
				$.ajax({
					type: 'post',
					url: '/Galeries/ajax-generation-zip-front',
					
					data: {
						'mail': mail,
						'idGalerie': idGalerie,
						'source': source,
						'queue': queue,
					},
					dataType: 'json',
					
					beforeSend: function(){
						$('#notification').html('<div class="text-center m-t-20"><span class="text-info">Veuillez patienter s\'il vous plait . . .</span><br/><img src="/img/loading_anim.gif"></div>');						
					},
					success: function(){
						
					}
				});
				setTimeout(function(){
					$('#notification').html('<div class="alert alert-success m-t-20">Génération en cours du fichier. Le lien de téléchargement direct du fichier sera envoyé à cet email dès que le fichier sera prêt. Ce lien aura une durée de validité de 7 jours.</div>');
				}, 2500);
				setTimeout(function(){$('#informationModal').find('#sf-fermer-modal').trigger('click');}, 8000);
			}else{
				$('#notification').html('<div class="alert alert-danger m-t-20">Le champ émail est recquis.</div>');
			}
		});
	}); 
        
});
