Dropzone.autoDiscover = false;
var baseUrl ;

$(document).ready(function(){
	 baseUrl = $("#id_baseUrl").val();
      
     $(".select2").select2();
	
    $(".kl_oneAnimation").click(function(){
        var idSelected = $(this).attr('data-key');
        $(".kl_oneAnimation").removeClass('selected');
        $(this).addClass('selected');
        $('#id_typeAnimation').val(idSelected);
        
        $(".kl_theAnimation").addClass("hide");
        $(".kl_theAnimation_"+idSelected).removeClass("hide");
        $(".kl_configAnimationCommun").removeClass("hide");
        $(".kl_siFonfVertMisePage").addClass('hide');
        
        if(idSelected == 6){
            $("#id_pageChoixConfiguration").removeClass("hide");
        }else if(idSelected == 5){
             $(".kl_siFonfVertMisePage").removeClass('hide');
        }else{
             $("#id_pageChoixConfiguration").addClass("hide");
        }
        
        dynamiqueDecomptePhoto(idSelected);
        
        //dynamiqueEtape2(idSelected);
        //alert('huhu'+ $.trim($(this).text()));
        //$(".kl_typeAnimationSelectedValue").text($.trim($(this).text()));
    });

    // $('.sortable').sortable();
    
    uploadMultipleCadre();
    
    uploadFondVert();
    
    /*$("#id_mutliconfiguration").change(function(){
        var val = $(this).val();
        $(".kl_multiposeOuBandellete").removeClass('hide');
        if(val == 1 || val == 3){
            $('#id_nombreDePose').empty();
            $('#id_nombreDePose').append('<option value="">Séléctionner</option><option value="3">3</option><option value="4">4</option>');
        }else if(val == 2 || val == 4){
            $('#id_nombreDePose').empty();
            $('#id_nombreDePose').append('<option value="">Séléctionner</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        }
    });*/
    
	
	
	
	/*
	 * Début
	 * Projet : uplad Cadre + Overlay
	 * date de modification : 09-fév-2019
	 * 
	 * author: Paul
	 */
	var idEvenement = 0;
	if($("#id_evenmentConf").length)
		idEvenement = $("#id_evenmentConf").val();
	// Duplication du formulaire ajout cadre
	$('#kl_cadre_ajout').click(function(){
		// var last = $('body').find('.kl_cadre').last();
		var last = $('body').find('#nestable-menu .dd-item').last();
		var id = 0;
		
		if(last.length)
			id = parseInt(last.attr('data-id')) + 1;
		
		var nb_dp = $.now();
		var bloc = ''+
		'<li class="dd-item" data-id="'+id+'">'+
			'<div class="dd-handle">'+
				'<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i> </button>'+
			'</div>'+
			'<div class="row bg-light kl_cadre col-sm-12" data-id="'+id+'">'+
				'<button type="button" class="btn btn-danger btn-circle kl-bloc-remove"><i class="fa fa-times"></i> </button>'+
				'<div class="col-sm-4">'+
					'<div class="kl_cadre_dropzone_tmp_'+nb_dp+' kl_cadre_dropzone dropzone"></div>'+
					'<div class="kl_cadre_uploaded"></div>'+
				'</div>'+
				'<div class="col-sm-4">'+
					'<div class="label-overlay">'+
						'<label class="custom-control custom-checkbox">'+
							'<input type="checkbox" class="kl_cadre_check custom-control-input" id="klCadreChk'+id+'" >'+
							'<span class="custom-control-label"> Créer un overlay</span>'+
						'</label>'+
						'<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload overlay</button>'+
						'<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>'+
						'<input type="file" class="fichier_overlay hide" accept="image/png">'+
						'<input type="hidden" value="" name="configuration_animations[0][cadres]['+id+'][file_overlay]" class="file_overlay" accept="image/png">'+
						'<input type="hidden" value="'+id+'" name="configuration_animations[0][cadres]['+id+'][ordre]" class="cadre-ordre" accept="image/png">'+
						'<input type="hidden" class="cadre-filename filename" id="cadre-filename-'+id+'" value="" name="configuration_animations[0][cadres]['+id+'][file_name]" />'+
						'<input type="file" class="fichier hide">'+
						'<div class="kl_cadre_remove hide"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Supprimer ce cadre?</a></div>'+
					'</div>'+
				'</div>'+
				'<div class="col-sm-4 kl_cadre_overlay"></div>'+
			'</div>'+
		'</li>';
		
		if(last.length)
			last.after(bloc);
		else{
			// $('.kl_info_1').after(bloc);
			$('#nestable-menu .dd-list').html(bloc);
		}
		
		var drop_cadre_0 = $('.kl_cadre_dropzone_tmp_'+nb_dp).dropzone({
			url: baseUrl+"/configuration-bornes/uploadMultipleCadre/"+idEvenement,
			paramName: "file",
			addRemoveLinks : true,
			acceptedFiles : "image/png",
			thumbnailWidth: null,
			thumbnailHeight: null,
			maxFiles: 1,
			dictDefaultMessage : "Glissez ou cliquez ici pour ajouter",
			init: function() {
				
				this.on("thumbnail", function(file, dataUrl) {
					$('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
					var tyCadreValue = $("input[name='configuration_animations[0][type_cadre]']:checked").val();
					if(tyCadreValue == 0){ // Paysage
						if(file.height < file.width){
							if(file.acceptDimensions() !== undefined)
								file.acceptDimensions();
						}else{
							file.rejectDimensions('Paysage');
						}
					}else if(tyCadreValue == 1){ // Portait
						if(file.width < file.height){
							file.acceptDimensions();
						}else{
							file.rejectDimensions('Portait');
						}
					}
					
				});
			  
				this.on('completemultiple', function(file, json) {
					$('.sortable').sortable('enable');
				});
				this.on('success', function(file, json) {
					
				});            
				$('.dz-image').css({"width":"100%", "height":"auto"});
				
				this.on('addedfile', function(file) {
					
				});

				this.on('drop', function(file) {
					console.log('File',file)
				}); 
			},
			success: function (file, result, data) {
				var obj = jQuery.parseJSON(result);
				newFilename = obj.name;
				var self = drop_cadre_0;
				// self.parent().parent().find('.label-overlay').removeClass('hide');

				if (obj.success) {
					self.css({
						display: 'none'
					});
					self.parent().find('.kl_cadre_uploaded').html('<img class="cadre-image" src="/import/config_bornes/'+idEvenement+'/cadres/'+newFilename+'">');
					
					// Mettre à jour l'cadre + overlay si l'overlay y est
					var is_overlay_existe = self.parent().parent().find('.file_overlay').val();
					if(is_overlay_existe != ''){
						var imgae = self.parent().parent().find('.kl_cadre_overlay img');
						$(imgae).css({'background-image': 'url(/import/config_bornes/'+idEvenement+'/cadres/'+newFilename+')'});
						// $(imgae).parent().css({'border': ''});
					}else{
						self.parent().parent().find('.kl_cadre_overlay').html('');
					}
					
					var nameFile = obj.name;
					var customId = parseInt(self.parent().parent().attr('data-id'));
					
					self.parent().parent().find('.cadre-filename').val(nameFile);
					
					self.parent().parent().find('.kl_cadre_remove').removeClass('hide');
				} else {
					this.removeFile(file);
					alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
				}
			},
			accept: function(file, done) {
				file.acceptDimensions = done;
				file.rejectDimensions = function(format) {
					done('Vous devez uploader un cadre '+format);
				};
			}
		});
	});
	Dropzone.autoDiscover = false;
	
	$('.kl_cadre_dropzone_tmp').each(function(){
		var objet = $(this);
		objet.dropzone({
			url: baseUrl+"/configuration-bornes/uploadMultipleCadre/"+idEvenement,
			paramName: "file",
			addRemoveLinks : true,
			acceptedFiles : "image/png",
			thumbnailWidth: null,
			thumbnailHeight: null,
			maxFiles: 1,
			dictDefaultMessage : "Glissez ou cliquez ici pour ajouter",
			init: function() {
				
				this.on("thumbnail", function(file, dataUrl) {
					$('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
					var tyCadreValue = $("input[name='configuration_animations[0][type_cadre]']:checked").val();
					if(tyCadreValue == 0){ // Paysage
						if(file.height < file.width){
							if(file.acceptDimensions() !== undefined)
								file.acceptDimensions();
						}else{
							file.rejectDimensions('Payasage');
						}
					}else if(tyCadreValue == 1){ // Portait
						if(file.width < file.height){
							file.acceptDimensions();
						}else{
							file.rejectDimensions('Portait');
						}
					}
					
				});
			  
				this.on('completemultiple', function(file, json) {
					$('.sortable').sortable('enable');
				});
				this.on('success', function(file, json) {
					
				});            
				$('.dz-image').css({"width":"100%", "height":"auto"});
				
				this.on('addedfile', function(file) {
					
				});

				this.on('drop', function(file) {
					console.log('File',file)
				}); 
			},
			success: function (file, result, data) {
				var obj = jQuery.parseJSON(result);
				newFilename = obj.name;
				var self = objet;
				// self.parent().parent().find('.label-overlay').removeClass('hide');

				if (obj.success) {
					self.css({
						display: 'none'
					});
					self.parent().find('.kl_cadre_uploaded').html('<img class="cadre-image" src="/import/config_bornes/'+idEvenement+'/cadres/'+obj.name+'">');
					
					// Mettre à jour l'cadre + overlay si l'overlay y est
					var imgae = self.parent().parent().find('.kl_cadre_overlay img');
					
					// Mise en forme anle image ajout
					if(imgae.length)
						$(imgae).css({'background-image': 'url(/import/config_bornes/'+idEvenement+'/cadres/'+obj.name+')'});
					
					var nameFile = obj.name;
					var customId = parseInt(self.parent().parent().attr('data-id'));
					
					self.parent().parent().find('.cadre-filename').val(obj.name);
					
					self.parent().parent().find('.kl_cadre_remove').removeClass('hide');
				} else {
					this.removeFile(file);
					alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
				}
			},
			accept: function(file, done) {
				file.acceptDimensions = done;
				file.rejectDimensions = function(format) {
					done('Vous devez uploader un cadre '+format);
				};
			}
		});
	});
	$('body').on('click', '.kl_cadre_overlay_photo', function(){
		$(this).parent().find('.fichier').trigger('click');
	})
	// Image à venir pour test des overlay + cadre
	$('body').on('change', '.fichier', function(e){
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if (file) {
			reader.readAsDataURL(file);
		}
		reader.addEventListener("load", function(){
			var cadre = $(objet).parent().parent().parent().find('.cadre-image').attr('src');
			objet.parent().parent().parent().find('.kl_cadre_overlay').html('<img src="'+cadre+'" style="width:100%;background-image:url('+reader.result+');background-size:cover;background-position:center;">');
		}, false);
	});
	$('body').on('change', '.kl_cadre_check', function(e){
		var isChecked = $(this).is(":checked");
		var bouton_overlay = $(this).parent().parent().find('.kl_cadre_overlay_overlay');
		var bouton = $(this).parent().parent().find('.kl_cadre_overlay_photo');
		if(isChecked){
			if(bouton_overlay.length){
				console.log(bouton_overlay.hasClass('hide'));
				bouton_overlay.removeClass('hide');
			}
			bouton.removeClass('hide');
		}else{
			bouton_overlay.addClass('hide');
			bouton.addClass('hide');
		}
	});
	// Suppression ou upload fichier overlay
	$('body').on('click', '.kl_cadre_remove', function(e){
		e.preventDefault();
		var objet = this;
		var gparent = $(objet).parent().parent().parent();
		var file = gparent.find('.filename').val();
		var idEvent = $("#id_evenmentConf").val();
		
		// Suppression des cadres déjà enregistrer dans BDD
		var position = $(objet).parent().parent().parent().attr('data-id');
		if($('#id_oneCadre_'+position).length){
			// $(objet).parent().addClass('hide');
			gparent.find('.kl_cadre_uploaded').html('');
			// On ne suupprime pas le div contenant les informations il suffit de les initialiser à vide.
			// $('#id_oneCadre_'+position).remove();
			gparent.find('.dz-remove').simulateClick('click');
			
			gparent.find('.cadre-filename').val('');
			gparent.find('.kl_cadre_dropzone').css({display: 'block'});
		}else{
			// Ajax pour supprimer le fichier
			$.ajax({
				url:'/configuration-bornes/deleteCadre/'+idEvent,
				type:'post',
				
				dataType: 'json',
				data: {'file':file},
				
				success: function(result){
					if(result === true){
						gparent.find('.dz-remove').simulateClick('click');
						gparent.find('.cadre-filename').val('');
						gparent.find('.kl_cadre_uploaded').html('');
						gparent.find('.kl_cadre_dropzone').css({display: 'block'});
						$(objet).addClass('hide');
						// Supprimer l'image aperçus
						var img_tmp = gparent.find('.kl_cadre_overlay img');
						var is_overlay_existe = gparent.find('.file_overlay').val();
						
						if(is_overlay_existe != ''){
							img_tmp.css({'background-image': 'none'});
							// img_tmp.parent().css({'border': 'solid 1px grey'});
						}else{
							gparent.find('.kl_cadre_overlay').html('');
						}
					}else{
						alert('impossible de supprimer le fichier');
					}
				},
				error: function(){
					
				}
			});
		}
	});
	$('body').on('click', '.kl_cadre_overlay_overlay', function(e){
		e.preventDefault();
		var objet = this;
		// Si la class a btn-secondary
		if($(objet).hasClass('btn-secondary')){
			var file_overlay = $(objet).parent().find('.fichier_overlay');
			$(file_overlay).trigger('click');
		}else{
			var idEvent = $("#id_evenmentConf").val();
			// Ne pas supprimer le fichier (en ce moment)
			var file_overlay = $(this).parent().find('.file_overlay').val();
			file_overlay = '';
			// Ajax pour supprimer le fichier
			$.ajax({
				url:'/configuration-bornes/deleteCadre/'+idEvent,
				type:'post',
				
				dataType: 'json',
				data: {'file':file_overlay},
				
				success: function(result){
					if(result === true){
						var gparent = $(objet).parent().parent().parent();
						// gparent.find('.dz-remove').simulateClick('click');
						$(objet).removeClass('btn-danger').addClass('btn-secondary').html('<span class="btn-label"><i class="fa fa-download"></i></span>Upload overlay');
						$(objet).parent().find('.file_overlay').val('');
						$(objet).parent().find('.kl_cadre_check').removeAttr('disabled');
						var cadre = gparent.find('.cadre-image').attr('src');
						if(typeof cadre != 'undefined')
							gparent.find('.kl_cadre_overlay').html('<img src="'+cadre+'" style="width:100%;">');
						else{
							gparent.find('.kl_cadre_overlay').html('');
							// gparent.find('.kl_cadre_overlay').css({'border': 'none'});
						}
					}else{
						alert('impossible de supprimer le fichier');
					}
				},
				error: function(){
					
				}
			});
		}
	});
	// Création overlay
	$('body').on('change', '.fichier_overlay', function(e){
		var img = $(this).parent().parent().parent().find('.cadre-image');
		var width_cadre = 0;
		var height_cadre = 0;
		var cadre = '';
		
		if(img.length){
			// alert('Veuillez d\'abord ajouter un cadre avant de continuer...');
			// return false;
			width_cadre = img[0].naturalWidth;
			height_cadre = img[0].naturalHeight;
			cadre = img.attr('src');
		}
		
		
		// image overlay upload-er
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if(file){
			reader.readAsDataURL(file);
		}
		// console.log(file['type']);
		// return false;
		reader.addEventListener("load", function(){
			var id = $.now();
			
			var iamge = '<img src="'+reader.result+'" id="'+id+'" class="hide">';
			
			var paren = objet.parent().parent().parent().find('.kl_cadre_overlay');
			paren.html('<img id="kl-loading" src="/img/loading_anim.gif" style="width:100px;height:100px;">');
			paren.after(iamge);
			
			setTimeout(function(){
				var height_tmp = $('#'+id)[0].naturalHeight;
				var width_tmp = $('#'+id)[0].naturalWidth;
				
				// Vérifier si les résolutions sont compatibles
				if($(objet)[0].files[0].type == 'image/png'){
					if((width_cadre == 0 && height_cadre == 0) || (width_cadre == width_tmp && height_cadre == height_tmp)){
						// Ajax upload photos
						var idEvent = $("#id_evenmentConf").val();
						var file_data = $(objet).prop("files")[0];   
						var form_data = new FormData();
						form_data.append("file", file_data);
						$.ajax({
							url: "/configuration-bornes/uploadMultipleCadreOverlay/"+idEvent,
							type: 'post',
							
							cache: false,
							contentType: false,
							processData: false,
							
							data: form_data,  							
							dataType: 'json',
							
							success: function(result){
								if(result['success']){
									paren.html('<img src="'+reader.result+'" style="width:100%;background-image:url('+cadre+');background-size:cover;background-position:center;">');
									$(objet).parent().find('.kl_cadre_overlay_overlay').removeClass('btn-secondary').addClass('btn-danger').html('<span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer overlay');
									$(objet).parent().find('.kl_cadre_check').attr('disabled', 'disabled');
									$(objet).parent().find('.file_overlay').val(result['name']);
								}else{
									alert('Erreur au niveau de l\'upload...');
								}
							}
						});	
					}else{
						alert('Les résolutions du cadre et l\'overlay ne sont pas identiques');
						$('#kl-loading').remove();
					}
				}else{
					alert('Veuillez upload-er des images png...');
					$('#kl-loading').remove();
				}
			}, 800);
			
		}, false);
		
	});
	//Suppression bloc container cadre+overlay
	$('body').on('click', '.kl-bloc-remove', function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	// Modification de l'ordre
	$('#nestable-menu').nestable({
		maxDepth: 1
	}).on('change', function(e){
		$i = 0;
		$('#nestable-menu .dd-item').each(function(){
			var objet = $(this);
			objet.attr('data-id', $i);
			
			// Modification rang...
			objet.find('.kl_cadre').attr('data-id', $i);
			objet.find('.cadre-ordre').val($i);
			$i++;
		});
	});
	/*
	 * Fin cadre + overlay
	 */
	
	
	/*
	 * Début
	 * Projet : gestion des cadres en multishoot
	 * url : https://trello.com/c/h7A09YsM/356-formulaire-config-borne-gestion-des-cadres-en-multishoot
	 * date de modification : 18-fév-2019
	 * 
	 * author: Paul
	 */
	
	$('body').on('change', '.kl_cadre_check-pers', function(){
		var isChecked = $(this).is(":checked");
		var bouton_overlay = $(this).parent().parent().find('.kl_cadre_overlay_overlay-pers');
		if(isChecked){
			if(bouton_overlay.length){
				bouton_overlay.removeClass('hide');
			}
		}else{
			bouton_overlay.addClass('hide');
		}
	});
	
	$('body').on('click', '.kl_cadre_overlay_overlay-pers', function(){
		var objet = $(this);
		
		// Action supprimer
		if($(objet).hasClass('btn-danger')){
			var idEvent = $("#id_evenmentConf").val();
			// Ne pas supprimer le fichier (en ce moment)
			var file_overlay = $(this).parent().find('.file_overlay-pers').val();
			file_overlay = '';
			// Ajax pour supprimer le fichier
			$.ajax({
				url:'/configuration-bornes/deleteCadre/'+idEvent,
				type:'post',
				
				dataType: 'json',
				data: {'file':file_overlay},
				
				success: function(result){
					if(result === true){
						var gparent = $(objet).parent().parent().parent();
						// gparent.find('.dz-remove').simulateClick('click');
						$(objet).removeClass('btn-danger').addClass('btn-secondary').html('<span class="btn-label"><i class="fa fa-download"></i></span>Upload overlay');
						$(objet).parent().find('.file_overlay-pers').val('');
						$(objet).parent().find('.kl_cadre_check-pers').removeAttr('disabled');
						var cadre = gparent.find('.dropify-render img').attr('src');
						if(typeof cadre != 'undefined')
							gparent.find('.kl_cadre_overlay-pers').html('<img src="'+cadre+'" style="width:100%;">');
						else{
							gparent.find('.kl_cadre_overlay-pers').html('');
						}
					}else{
						alert('impossible de supprimer le fichier');
					}
				},
				error: function(){
					
				}
			});
		}
		// Action ajout
		else{
			$(objet).parent().parent().parent().find('.fichier_overlay-pers').trigger('click');
		}
	});
	// Cadre + overlay
	$('body').on('change', '.fichier_overlay-pers', function(){
		var img = $(this).parent().parent().parent().find('.dropify-render img');
		var width_cadre = 0;
		var height_cadre = 0;
		var cadre = '';
		
		if(img.length){
			width_cadre = img[0].naturalWidth;
			height_cadre = img[0].naturalHeight;
			cadre = img.attr('src');
		}
		
		// image overlay upload-er
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if(file){
			reader.readAsDataURL(file);
		}
		
		reader.addEventListener("load", function(){
			var id = $.now();
			
			var iamge = '<img src="'+reader.result+'" id="'+id+'" class="hide">';
			
			var paren = objet.parent().parent().parent().find('.kl_cadre_overlay-pers');
			paren.html('<img id="kl-loading" src="/img/loading_anim.gif" style="width:100px;height:100px;">');
			paren.after(iamge);
			
			setTimeout(function(){
				var height_tmp = $('#'+id)[0].naturalHeight;
				var width_tmp = $('#'+id)[0].naturalWidth;
				
				// Vérifier si les résolutions sont compatibles
				if($(objet)[0].files[0].type == 'image/png'){
					if((width_cadre == 0 && height_cadre == 0) || (width_cadre == width_tmp && height_cadre == height_tmp)){
						// Ajax upload photos
						var idEvent = $("#id_evenmentConf").val();
						var file_data = $(objet).prop("files")[0];   
						var form_data = new FormData();
						form_data.append("file", file_data);
						$.ajax({
							url: "/configuration-bornes/uploadMultipleCadreOverlay/"+idEvent,
							type: 'post',
							
							cache: false,
							contentType: false,
							processData: false,
							
							data: form_data,  							
							dataType: 'json',
							
							success: function(result){
								if(result['success']){
									paren.html('<img src="'+reader.result+'" style="width:100%;background-image:url('+cadre+');background-size:cover;background-position:center;">');
									$(objet).parent().find('.kl_cadre_overlay_overlay-pers').removeClass('btn-secondary').addClass('btn-danger').html('<span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer overlay');
									$(objet).parent().find('.kl_cadre_check-pers').attr('disabled', 'disabled');
									$(objet).parent().find('.file_overlay-pers').val(result['name']);
								}else{
									alert('Erreur au niveau de l\'upload...');
								}
							}
						});	
					}else{
						alert('Les résolutions du cadre et l\'overlay ne sont pas identiques');
						$('#kl-loading').remove();
					}
				}else{
					alert('Veuillez upload-er des images png...');
					$('#kl-loading').remove();
				}
			}, 800);
			
		}, false);
	});
	// Supprimer cadre
	$('body').on('click', '.cadre-pers .dropify-clear', function(){
		var gparent = $(this).parent().parent().parent();
		var img_tmp = gparent.find('.kl_cadre_overlay-pers img');
		var is_overlay_existe = gparent.find('.file_overlay-pers').val();
		gparent.find('.cadre-filename-pers').val('');
		
		if(is_overlay_existe != ''){
			img_tmp.css({'background-image': 'none'});
		}else{
			gparent.find('.kl_cadre_overlay-pers').html('');
		}
	});
	// changement d'etat fichier cadre
	$('body').on('change', '.cadre-pers .dropifyCadre', function(){
		var gparent = $(this).parent().parent().parent();
		var objet = $(this);
		var img_tmp = gparent.find('.kl_cadre_overlay-pers img');
		var is_overlay_existe = gparent.find('.file_overlay-pers').val();
		if(is_overlay_existe != ''){
			var cadre = '';
			setTimeout(function(){
				var img = objet.parent().find('.dropify-render img');
				var resolution_ok = true;
				if(img.length && resolution_ok){
					cadre = img.attr('src');
				}
				img_tmp.css({'background-image': 'url('+cadre+')'});
			}, 500);
		}
	});
	/*
	 * Fin
	 */
	
	/*
	 * Début
	 * Projet : Configuration borne
	 * date de modification : 08-mar-2019
	 * 
	 * author: Paul
	 */
	$(".colorpicker2").asColorPicker();
	$(".colorpicker2").on('asColorPicker::change', function (e){
		var couleur = $(this).asColorPicker('val');
		$('.bloc-colorpicker2 .form-control').css('color', couleur);
	});
	$(".colorpicker1").asColorPicker();
	$(".colorpicker1").on('asColorPicker::change', function (e){
		var couleur = $(this).asColorPicker('val');
		$(this).parent().parent().parent().parent().parent().parent().find('.sf-apercus').css('background-color', couleur);
		var couleur_test = config_fondpage[$(this).parent().parent().parent().parent().parent().find('.sf-fond-page select').val()];
		if(couleur != couleur_test)
			$(this).parent().parent().parent().parent().parent().find('.sf-fond-page select').val('');
	});
	$('.sf-mp-avance').on('change', function(){
		var isChecked = $(this).is(":checked");
		if(isChecked){
			$('#sf-mp-avance').removeClass('hide');
		}else{
			$('#sf-mp-avance').addClass('hide');
		}
	});
	
	// Upload bouton
	$('.sf-img-bouton').on('click', function(e){
		e.preventDefault();
		$('#sf-img-bouton').trigger('click');
	});
	$('#sf-img-bouton').on('change', function(){
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if(file){
			reader.readAsDataURL(file);
		}
		reader.addEventListener("load", function(){
			objet.parent().parent().parent().parent().find('.sf-apercus').html('<div class="sf-bloc-button-upload"><img class="sf-bouton-center" src="'+reader.result+'"></div>');
			$('#id_boutonaccueil').val('');
		});
	});
	// Upload image de fond
	$('.sf-img-fond-button').on('click', function(e){
		e.preventDefault();
		$(this).parent().find('.sf-img-fond').trigger('click');
	});
	$('.sf-img-fond').on('change', function(){
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if(file){
			reader.readAsDataURL(file);
		}
		reader.addEventListener("load", function(){
			objet.parent().find('.sf-img-fond-button-supp').removeClass('hide');
			objet.parent().parent().parent().parent().find('.sf-apercus').css({
				'background-image': 'url('+reader.result+')',
			});
		});
	});
	// Supprimer image de fond
	$('.sf-img-fond-button-supp').on('click', function(e){
		e.preventDefault();
		var objet = $(this);
		objet.parent().parent().parent().parent().find('.sf-apercus').css('background-image', 'unset');
		objet.parent().find('.sf-img-fondBD').val('');
		objet.addClass('hide');
	});
	$('.sf-img-button-supp').on('click', function(e){
		e.preventDefault();
		var objet = $(this);
		objet.parent().parent().parent().parent().find('.sf-apercus').html('');
		objet.parent().find('#sf-img-bouton-bd').val('');
		objet.addClass('hide');
		$('#id_boutonaccueil').val('');
	});
	
	// Choix parmis la liste des fonds
	$('#id_boutonaccueil').on('change', function(e){
		var objet = $(this);
		// Récupérer les caractéristiques
		var choix = objet.val();
		if(choix){
			objet.parent().parent().parent().parent().find('.sf-apercus').html('<div class="sf-bloc-button-upload"><img class="sf-bouton-center" src="/import/config_pages/boutons/'+config_boutons[choix]+'"></div>');
			$('#sf-img-bouton').val('');
		}
	});
	// Choix parmis la liste des fonds
	$('.sf-fond-page select').on('change', function(e){
		var objet = $(this);
		// Récupérer les caractéristiques
		var choix = objet.val();
		
		if(choix == ''){
			objet.parent().parent().parent().parent().find('.sf-apercus').css({
				'background-color': 'unset'
			});
			objet.parent().parent().parent().find('.colorpicker1').val('');
		}else{
			// Modification aperçus
			var couleur = objet.val();
			if(typeof config_fondpage != 'undefined'){
				couleur = config_fondpage[couleur];
				objet.parent().parent().parent().parent().find('.sf-apercus').css({
					'background-color': couleur
				});
				objet.parent().parent().parent().find('.colorpicker1').asColorPicker('set', couleur);
			}
		}
	});
	/*
	 * Fin
	 */
	
    $("#id_mutliconfiguration").change(function(){
        $(".kl_theAnimation").addClass("hide");
        $(".kl_theAnimation_6").removeClass("hide");
        var val = $(this).val();
        if(val == 1){
            $(".kl_theAnimation_1,.kl_theAnimation_3").removeClass("hide");
        }else if(val == 2){
            $(".kl_theAnimation_1,.kl_theAnimation_2").removeClass("hide");
        }else if(val == 3){
            $(".kl_theAnimation_4,.kl_theAnimation_3").removeClass("hide");
        }else if(val == 4){
            $(".kl_theAnimation_4,.kl_theAnimation_2").removeClass("hide");
        }
    });
    
    $('.dropifyCadre').dropify({
        messages: {
            default: 'Glissez-déposez votre cadre ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });
    
    
    $("#id_nombreDePose_multipose").change(function(){
        $(".kl_listeDispositionVignette").removeClass('hide');
        $(".kl_oneDispostionMultipose").addClass('hide');
        var nbrPose = $(this).val();
        
        
        $(".kl_dispositionVignette_"+nbrPose+"_pourAnimation_2").removeClass('hide');
        $("#id_dispositionvignetteMuliposeValue").val("");
    });
    
    $("#id_nombreDePose_bandelette").change(function(){
        $("#id_dispositionVignetteBandelette").removeClass('hide');
        $(".kl_oneDispostionBandelette").addClass('hide');
        var nbrPose = $(this).val();
        //alert('.kl_dispositionVignette_'+nbrPose+'_pourAnimation_3');
        
        $(".kl_dispositionVignette_"+nbrPose+"_pourAnimation_3").removeClass('hide');
        $("#id_dispositionvignetteBandeletteValue").val("");
    });
    
    
     $(".kl_oneDispostion").click(function(){
        var idSelected = $(this).attr('data-key');
        var animationId = $(this).attr('data-animation');
        
        $(".kl_oneDispostion").removeClass('selected');
        $(this).addClass('selected');
        $('#id_dispositionvignette_'+animationId).val(idSelected);
    });
    
    
    //id_siPriseDeCoordronnee
   $('input[type=radio][name=is_prise_coordonnee]').change(function() {
        if (this.value == 1) {
            $("#id_siPriseDeCoordronnee").removeClass('hide');
            $("#id_decompteTimeOut").val(120);
        }else {
            $("#id_siPriseDeCoordronnee").addClass('hide');
            $("#id_decompteTimeOut").val(80);
        }
   });
   
   //is_impression_auto
   $('input[type=radio][name=is_impression_auto]').change(function() {
        if (this.value == 1) {
            $("#id_nbrImpressionAuto").removeClass('hide');
        }else {
            $("#id_nbrImpressionAuto").addClass('hide');
        }
   });
   
   //id_nbrMaxMultiImpression
   $('input[type=radio][name=is_multi_impression]').change(function() {
        if (this.value == 1) {
            $("#id_nbrMaxMultiImpression").removeClass('hide');
        }else {
            $("#id_nbrMaxMultiImpression").addClass('hide');
        }
   });
   
   //id_nbrMaxPhoto
    $('input[type=radio][name=has_limite_impression]').change(function() {
        if (this.value == 1) {
            $("#id_nbrMaxPhoto").removeClass('hide');
        }else {
            $("#id_nbrMaxPhoto").addClass('hide');
        }
   });
   
    //fILTRE
   $('input[type=radio][name=is_filtre]').change(function() {
        if (this.value == 1) {
            $("#id_choixDesFiltreSiOui").removeClass('hide');
        }else {
            $("#id_choixDesFiltreSiOui").addClass('hide');
        }
   });
   //Limit Filtre
   var limit = 7;
    $('input.kl_checkBoxFiltre').on('change', function(evt) {
        //alert('console text');
       //if($(this).siblings(':checked').length >= limit) {
        $(".kl_erroMaxFiltre").addClass("hide");
        if($('input[type=checkbox].kl_checkBoxFiltre:checked').length >= limit){
           this.checked = false;
           $(".kl_erroMaxFiltre").removeClass("hide");
       }
    });
   
   //id_siImpression
   $('input[type=radio][name=is_impression]').change(function() {
        //alert('hahaha' + this.value);
        if (this.value == 1) {
            $("#id_siImpression").removeClass('hide');
        }else {
            $("#id_siImpression").addClass('hide');
        }
   });
   
   deleteCadreOne();
   
function generateCustomId() {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2, 9);
}


function uploadFondVert(){
    
    var idEvenement = $("#id_evenmentConf").val();
    var i = 0;
     
    $('#id_uploadFondVert').dropzone({ 
        url: baseUrl+"/configuration-bornes/uploadFondVert/"+idEvenement,
        paramName: "file",
        thumbnailWidth : 200,
        thumbnailHeight : 200,
        addRemoveLinks : true,
        acceptedFiles : "image/png",
        init: function() {
          this.on('completemultiple', function(file, json) {
            //alert('aa');
            $('.sortable').sortable('enable');
          });
          this.on('success', function(file, json) {
            
          });
          
          this.on('addedfile', function(file) {
           
          });
          
          this.on('drop', function(file) {
            console.log('File',file)
          }); 
        },
        success: function (file, result, data) {
                var obj = jQuery.parseJSON(result);
                newFilename = obj.name;
                if (obj.success) {
                    var nameFile = obj.name;
                    var ordre = $('#id_uploadFondVert .dz-preview').length + 1; 
                    var customId = generateCustomId();
                    $(file.previewTemplate).append('<input type="hidden" class="" value="' + ordre + '" name="fond_verts[' + customId + '][ordre]" /><input type="hidden" class="" value="' + nameFile + '" name="fond_verts[' + customId + '][file_name]" />');
                } else {
                    this.removeFile(file);
                    alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
                }
                i++;
        }
    });
}
   
function uploadMultipleCadre(){
    //uploadMultipleCadre
    var idEvenement = $("#id_evenmentConf").val();
     var i = 0;
    $('#id_uploadCadreMuliple').dropzone({ 
        
        url: baseUrl+"/configuration-bornes/uploadMultipleCadre/"+idEvenement,
        paramName: "file",
        //previewsContainer: '.visualizacao', 
        //previewTemplate : $('#id_templatePreview').html(),
        //thumbnailWidth : 200,
        //thumbnailHeight : 200,
        addRemoveLinks : true,
        acceptedFiles : "image/png",
        thumbnailWidth: null,
        thumbnailHeight: null,
        dictDefaultMessage : "Glissez ou cliquez ici pour ajouter",
        init: function() {
            
            this.on("thumbnail", function(file, dataUrl) {
                //alert('huhu');
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
                var tyCadreValue = $("input[name='configuration_animations[0][type_cadre]']:checked").val();
                //alert('tyCadreValue '+tyCadreValue);
                if(tyCadreValue == 0){ // Paysage
                    if(file.height < file.width){
                        file.acceptDimensions();
                    }else{
                        file.rejectDimensions('Payasage');
                    }
                }else if(tyCadreValue == 1){ // Portait
                    if(file.width < file.height){
                        file.acceptDimensions();
                    }else{
                        file.rejectDimensions('Portait');
                    }
                }
                
            });   
          
          this.on('completemultiple', function(file, json) {
            //alert('aa');
            $('.sortable').sortable('enable');
          });
          this.on('success', function(file, json) {
            
          });            $('.dz-image').css({"width":"100%", "height":"auto"});
          
          this.on('addedfile', function(file) {
           
          });
          
          this.on('drop', function(file) {
            console.log('File',file)
          }); 
        },
        success: function (file, result, data) {
                var obj = jQuery.parseJSON(result);
                newFilename = obj.name;
                if (obj.success) {
                    var nameFile = obj.name;
                    var ordre = $('#id_uploadCadreMuliple .dz-preview').length + 1; 
                    var customId = generateCustomId();
                    $(file.previewTemplate).append('<input type="hidden" class="" value="' + ordre + '" name="configuration_animations[0][cadres]['+customId+'][ordre]" /><input type="hidden" class="" value="' + nameFile + '" name="configuration_animations[0][cadres]['+customId+'][file_name]" />');
                } else {
                    this.removeFile(file);
                    alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
                }
                i++;
        },
       accept: function(file, done) {
          file.acceptDimensions = done;
          file.rejectDimensions = function(format) {
            done('Vous devez uploader un cadre '+format);
          };
        },
        
    });
}
    
});

function deleteCadreOne(){
    $(".kl_deleteEdit").click(function(){
        var cadreId = $(this).attr('data-cadreid');
        $("#id_oneCadre_"+cadreId).remove();
    });
}

function dynamiqueDecomptePhoto(idSelected){
    if(idSelected == 2 || idSelected == 3 ){
            $(".kl_deComptePriseDePhoto").val(6);
    }else if(idSelected == 5){
        $(".kl_deComptePriseDePhoto").val(9);
    }else if(idSelected ==6 ){
    }else if(idSelected == 1 || idSelected == 4){
        $(".kl_deComptePriseDePhoto").val(8);
    } 
}

function dynamiqueEtape2(idSelected){
     /***
        * Desactive les options
        ***/
        
        $(".kl_multiposeOuBandellete").addClass('hide');
        $(".kl_siFondVert").addClass('hide');
        $(".kl_siMultiConfiguration").addClass('hide');
        $(".kl_cadreSimple").removeClass('hide');
        $(".kl_cadreMultiple").addClass('hide');
        $(".kl_siFonfVertMisePage").addClass('hide');
        $(".kl_oneDispostion").addClass("hide");
        
       
        if(idSelected == 2 || idSelected == 3 ){
            $(".kl_multiposeOuBandellete").removeClass('hide');
            
            if(idSelected == 2){ // Multipose
                $('#id_nombreDePose').empty();
                $('#id_nombreDePose').append('<option value="">Séléctionner</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
            }else if(idSelected == 3){ // Bandelette
                $('#id_nombreDePose').empty();
                $('#id_nombreDePose').append('<option value="">Séléctionner</option><option value="3">3</option><option value="4">4</option>');
            }
            $(".kl_dispositionVignettePourAnimation_"+idSelected).removeClass('hide');
            $(".kl_deComptePriseDePhoto").val(6);
            $("#id_type_cadre").addClass("hide");
        }else if(idSelected == 5){
            $(".kl_siFondVert").removeClass('hide');
            $(".kl_siFonfVertMisePage").removeClass('hide');
            $(".kl_deComptePriseDePhoto").val(9);
            $("#id_type_cadre").removeClass("hide");
        }else if(idSelected ==6 ){
            $(".kl_siMultiConfiguration").removeClass('hide');
            $("#id_type_cadre").removeClass("hide");
        }else if(idSelected == 1){
            $(".kl_cadreSimple").addClass('hide');
            $(".kl_cadreMultiple").removeClass('hide');
            $(".kl_deComptePriseDePhoto").val(8);
            $("#id_type_cadre").removeClass("hide");
        }else if(idSelected == 4){
            $(".kl_deComptePriseDePhoto").val(8);
            $("#id_type_cadre").addClass("hide");
        }  
        
        
}
    $(":input").bind('focusout', function () {
    var maxa = $("#nbr-max-photo").val();
    if (maxa > 999) {
    	alert('La avaleur maximale ne doit pas depasser 999');
    	$('#nbr-max-photo').val(1);
    }else if (maxa < 1) {
    	alert('la valeur minimale doit être 1');
    	$('#nbr-max-photo').val(1);
    }
});

// Trigger evenement click 
$.fn.simulateClick = function() {
    return this.each(function() {
        if('createEvent' in document) {
            var doc = this.ownerDocument,
                evt = doc.createEvent('MouseEvents');
            evt.initMouseEvent('click', true, true, doc.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
            this.dispatchEvent(evt);
        } else {
            this.click();
        }
    });
}
