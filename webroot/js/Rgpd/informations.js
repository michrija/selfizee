$(document).ready(function(){
	
	/* Apercus du détail de l'image */
	$('.sf-photo-detail').on('click', function(){
		var objet = $(this);
		var ref = objet.data('ref');
		var src = objet.data('src');
		var tp = objet.data('tp');
		var tp_media = 'photo';
		var media = '<img style="max-width: 100%;max-height: 600px;" src="'+src+'" alt="Image non disponible">';
		var extension = src.substr((src.lastIndexOf('.')+1));
		if(tp == 1){
			var poster = objet.data('poster');
			media = '<video style="max-width: 100%;max-height: 600px;" controls poster="'+poster+'"><source src="'+src+'" type="video/'+extension+'"></video>';
		}
		
		var titre = 'Aperçus '+tp_media;
		var contenu = '<div class="text-center" style="max-width: 100%;">'+media+'</div>';
		var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</button><a href="/rgpd/download/'+ref+'" class="btn btn-primary"><i class="fa fa-download"></i>Télecharger</a>';
		ouvrirModal(titre, contenu, footer, true, true);
		$('#informationModal').find('.modal-header').css('display', 'none');
	});
	
	$('.sf-supp-inf').on('click', function(e){
		e.preventDefault();
		
		var media = 'votre photo';
		var media_tc = 'photo';
		var is_feminin = true;
		var is_session = false;
		var objet = $(this);
		var rf = objet.attr('data-rf');
		var email_visiteur = objet.attr('data-ml');
		var tp = objet.data('tp');
		var md = objet.data('md');
		
		if(typeof tp != 'undefined' && tp == 's'){
			is_session = true;
			media_tc = 'session';
		}
		
		if(typeof md != 'undefined' && md == "1"){
			is_feminin = false;
			media = 'votre vidéo';
			media_tc = 'vidéo';
		}
		
		var footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>'+
		'<button type="button" class="btn btn-danger" id="sf-supprimer-rgpd">Supprimer</button>';
		var header = 'Supprimer les données '+(is_session ? 'de la session' : (is_feminin ? ' de la photo' : ' du vidéo'));
		
		var contenu = '<div class="alert alert-warning">'+
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
				'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Attention</h3> Attention, vous êtes sur le point de supprimer toutes vos données ainsi que tous vos fichiers multimédias liés à cet'+(is_feminin ? 'te' : '')+' '+media_tc+' !'+
			'</div>';
		contenu += '<div class="alert alert-info">'+
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
				'<h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> Avant de supprimer, avez-vous pensé à télécharger '+media+'? Une fois supprimé'+(is_feminin ? 'e' : '')+', vous ne pourrez plus '+(is_feminin ? 'la' : 'le')+' télécharger.'+
			'</div>';
		contenu += '<p>Toutes vos données ainsi que tous vos fichiers multimédias liés à cet'+(is_feminin ? 'te' : '')+' '+media_tc+' seront supprimés de manière irrévocable.</p>'+
			'<p>Êtes-vous certain de vouloir les supprimer définitivement?</p>';
		ouvrirModal(header, contenu, footer, true, true);
		
		
		$('#sf-supprimer-rgpd').on('click', function(e){
			e.preventDefault();
			$(this).addClass('disabled');
			$.ajax({
				url: '/e/inf/suppression/cont-em',
				type: 'post',
				
				data: {'info': rf, 'email_visiteur':email_visiteur},
				dataType: 'json',
				
				beforeSend: function(){
					$('body').find('.close').trigger('click');
				},
				success: function(reponse){
					if(typeof reponse['error'] != 'undefined'){
						window.location.href = window.location.href;
					}
				},
				complete: function(){
					
				}
			});
		});
		
	});


	//===== Edition info photo

	$('.sf-edit-inf').on('click', function(e){

		var footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>'+
		'<button type="button" class="btn btn-primary" id="sf-edit-rgpd">Modifer</button>';
		var header = 'Edition les données ';
		
		var contenu = '';

		//ouvrirModal(header, contenu, footer, true, true);
		
		e.preventDefault();
		var objet = $(this);
		var id_photo = objet.attr('data-rf');
		var getUrl = window.location;
		var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
		//alert(baseUrl);

		$(this).addClass('disabled');
		$.ajax({
			url: baseUrl+'rgpd/edition/'+id_photo,
			type: 'get',		
			dataType: 'json',
			
			beforeSend: function(){
				$('body').find('.close').trigger('click');
			},
			success: function(data){				
				//console.log(data.id);	
				var champs = data.liste_position_champ;			
				$.each(data, function (clef, valeur) {
					var label = clef.substring(0, 6);
					var numChamp = clef.substring(6, 7);
					if(label == "survey"){
						//console.log(clef);

						if(valeur == "" || valeur == null) valeur = "";
						var label =  'Champ '+numChamp;
						for(var i=1;i<=7; i++){							
							var survey = 'survey'+i;
							if(champs.hasOwnProperty(i) && survey == clef){
								label = champs[i];
							}
						}

						var champ =
						'<div class="form-group" style="margin-bottom:0.5rem !important;">'+
							'<label for="id_title" class="control-label">'+label+' : </label>'+
							'<input type="text" name="champ_'+numChamp+'" id="id_champ_'+numChamp+'" class="form-control" value="'+valeur+'">'+
						'</div>';
						contenu +=champ
					}
				});
				ouvrirModal(header, contenu, footer, true, false);
			},
			complete: function(){
				
			}
		});

		//$('#sf-edit-rgpd').on('click', function(e){
		$('body').delegate('#sf-edit-rgpd', 'click', function(e){
			//alert(e);
			e.preventDefault();
			var id_photo = objet.attr('data-rf');
			var email_visiteur = objet.attr('data-ml');

			var getUrl = window.location;
			var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";

			$(this).addClass('disabled');
			$.ajax({
				url: baseUrl+'rgpd/edition/'+id_photo,
				type: 'post',			
				data: {
					'survey1': $('#id_champ_1').val(),
					'survey2': $('#id_champ_2').val(),
					'survey3': $('#id_champ_3').val(),
					'survey4': $('#id_champ_4').val(),
					'survey5': $('#id_champ_5').val(),
					'survey6': $('#id_champ_6').val(),
					'survey7': $('#id_champ_7').val(),
					'email_visiteur' : email_visiteur
				},
				dataType: 'json',
				
				beforeSend: function(){
					//$('body').find('.close').trigger('click');
				},
				success: function(reponse){
					//console.log(reponse);
					if(reponse.success){
						//alert('Modification avec success');
						$('#informationModal').modal('hide');					
						setTimeout(function(){ $('.sl-msg-success').removeClass('hide'); }, 2000);		
						setTimeout(function(){ location.reload(); }, 3000);				
						//location.reload();
					} else {
						$('#informationModal').modal('hide');
					}
				},
				complete: function(){
					
				}
			});
		});

		
	});

	
	
});
