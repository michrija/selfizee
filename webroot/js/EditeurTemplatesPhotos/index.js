$(document).ready(function(){
	$(".sf-type_image").select2({
		placeholder: "Type d'image"
	});
	$(".sf-tag").select2({
		placeholder: "Sélectionner tags"
	});
	
	$('.sf-add-tags').on('click', function(e){
		e.preventDefault();
		var img = $(this).data('img');
		var tag_selected = $(this).data('tag');
		var photo_id = $(this).data('id');
		
		var options = '';
		if(tags){
			$.each(tags, function(key, value){
				selected = $.inArray(parseInt(key), tag_selected) == -1 ? '' : 'selected="selected"';
				options += '<option value="'+key+'" '+selected+'>'+value+'</option>';
			});
		}
		
		var titre = 'Lier des tags à cette photo';
		var contenu = ''+
			'<div class="text-center sf-bg-grey"><img class="img-responsive" src="'+img+'"></div>'+
			'<div class="m-t-15">'+
				'<select id="sf-tag-select" class="sf-tag-select" multiple="multiple" style="width: 100%;">'+
					options +
				'</select>'+
			'</div>'+
			'<span class="help-block"><small><em>Vous avez la possibilité d\'ajouter d\'autres tags.</em></small></span>'+
			'<div id="sf-alert" class="m-t-15"></div>'+
			'<div class="text-center sf-load m-t-15 hide">'+
				'<strong class="text-primary"><small>Veuillez patienter s\'il vous plaît. . .</small></strong><br/>'+
				'<img src="/img/loading_anim.gif" style="width: 50px;">'+
			'</div>';
			
		var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</default><button class="btn btn-info" id="sf-confirm">Enregistrer</button>';
		ouvrirModal(titre, contenu, footer, false, false);
		
		$('.sf-tag-select').select2({
			placeholder: 'Sélectionner au moins un tag',
			tags: true
		});
		
		$('#sf-confirm').on('click', function(){
			var obj = $(this);
			var selects = $('#sf-tag-select').val();
			if(selects.length){
				$.ajax({
					url: '/editeur-templates-photos/lie-tag',
					type: 'post',
					
					data: {
						'tag_id': selects,
						'photo_id': photo_id
					},
					dataType: 'json',
					
					beforeSend: function(){
						obj.addClass('disabled');
						$('.sf-load').removeClass('hide');
					},
					success: function(data){
						if(data){
							$('#EditeurTemplatePhotoForm').submit();
						}else{
							$('#sf-alert').html('<div class="alert alert-danger">Une erreur est survenue lors de l\'enregistrement.</div>');
							$('.sf-load').addClass('hide');
						}
					}
				});
			}else{
				$('#sf-alert').html('<div class="alert alert-danger">Sélectionner au moins un tag pour continuer.</div>');
			}
		});
		
	});
});
