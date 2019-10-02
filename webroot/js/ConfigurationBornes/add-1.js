var nombre_champ = 1;
$(document).ready(function(){
	
	// Ajouter un champ
	$('input[type=radio][name=is_prise_coordonnee]').change(function() {
        if (this.value == 1) {
            $("#id_siPriseDeCoordronnee").removeClass('hide');
            $("#id_decompteTimeOut").val(120);
        }else {
            $("#id_siPriseDeCoordronnee").addClass('hide');
            $("#id_decompteTimeOut").val(80);
        }
	});
	
	
	// Réinitialisation des configs bornes
	$('#sf-reinstall-config').on('click', function(e){
		e.preventDefault();
		var titre = 'Réinitialisation';
		var contenu = '<small><strong>Vous êtes sur le point de réinitialiser la mise en page par défaut.</strong></small>'+
			'<br/>'+
			'<small><strong>Etes-vous sur de vouloir continuer?</strong></small>'+
			'<br/>'+
			'<div class="alert alert-warning m-t-15"><small>Attention la réinitialisation ne prendra effet que si on poste le formulare.</small></div>'+
			'<div class="text-center sf-load hide">'+
				'<strong class="text-primary"><small>Veuillez patienter s\'il vous plaît. . .</small></strong><br/>'+
				'<img src="/img/loading_anim.gif" style="width: 50px;">'+
			'</div>';
			
		var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</default><button class="btn btn-danger" id="sf-confirm">Réinitialiser</button>';
		ouvrirModal(titre, contenu, footer, false, false);
		
		$('#sf-confirm').on('click', function(ev){
			$('.sf-load').removeClass('hide');
			setTimeout(function(){
				ev.preventDefault();
				$('.close').trigger('click');
			}, 1000);
		});
	});

	
	//=== Edition
	//(Un type anym nouv)
	/*var type_anim_selected_list2 = $('.config_animation').find('.check_type_anim:checked');
	$.each(type_anim_selected_list2, function (index, elem) {
		var input = $(elem);
		var i = input.val();
		console.log(input.attr('id'));
		$('li.cf_anim_tab_'+i).removeClass('hide');
		$('li.cf_anim_tab_'+i+' a').addClass('active show');
		$('div.cf_anim_tab_content_'+i).addClass('active show');   
	});*/
	
	// Choix type de cadre
	$('.sf-bg-animation').on('click', function(){
		var obj = $(this);
		// $('.sf-bg-animation').removeClass('active');

		//=== get type animation current selected and les remettre à zero (false)
		var type_anim_selected_list = $('.config_animation').find('.check_type_anim:checked');
        $.each(type_anim_selected_list, function (index, elem) {
			var input = $(elem);
			var i = input.val();		
			$('div.cf_option_tab_anim ul.cf_anim_tab li.cf_anim_tab_'+i).addClass('hide'); //And set to hide tab correspond
            input.attr('checked', false);          
		});
		
		/*=== Son Exellence @Paul */
		if(obj.hasClass('active')){
			obj.removeClass('active');
			obj.find('input[type=checkbox]').prop("checked", false);
		}else{
			$('.sf-bg-animation').removeClass('active');
			$('.check_type_anim').prop('checked', false);
			obj.addClass('active');
			obj.find('input[type=checkbox]').prop("checked", true);
		}
		/*===== */

		/** Get type animation selected on click
		* gestion affichage tab selected
		* reinitailise tab and reactive to type selected corresponds
		*/
        $('ul.cf_anim_tab li.nav-item a').removeClass('active show');
		$('div.cf_anim_content div.tab-pane').removeClass('active show');
		var type_anim_selected_last = $('.config_animation').find('.check_type_anim:checked');
        $.each(type_anim_selected_last, function (index, elem) {
			//alert(index);
			var input = $(elem);
			var i = input.val();
            //console.log(i); 
			console.log(input.attr('id'));
			$('li.cf_anim_tab_'+i).removeClass('hide');
			$('li.cf_anim_tab_'+i+' a').addClass('active show');
			$('div.cf_anim_tab_content_'+i).addClass('active show');      
		});
		
	});
	
	// Personnaliser une animation
	$('.sf-button-personnalise').on('click', function(){
		$(this).parent().parent().find('.sf-etat-actuel').toggleClass('hide');
		$(this).parent().parent().find('.sf-etat-personnaliser').toggleClass('hide');
	});
	
	// Choix type input
	
	$('.sf-select-form-input').on('change', function(){
		var obj = $(this);
		var selected = obj.val();
				
		$(obj.parent().parent().find('.sf-select-form-input-type')).each(function(){
			var obj_child = $(this);
			console.log(obj_child);
			if(obj_child.hasClass('sf-select-form-input-'+selected)){
				obj_child.removeClass('hide');
			}else{
				obj_child.addClass('hide');
			}
		});
		// obj.find('.sf-select-form-input-'+selected).removeClass('hide');
	});
	
	// Upload image de fond pour écran
	$('.sf-fond-fichier').on('change', function(){
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if(file){
			reader.readAsDataURL(file);
		}
		reader.addEventListener("load", function(){
			// objet.parent().find('.sf-img-fond-button-supp').removeClass('hide');
			/*objet.parent().parent().parent().parent().parent().find('.sf-bloc-apercus').css({
				'background-image': 'url('+reader.result+')',
			});*/
			objet.parent().parent().parent().parent().parent().find('.sf-bloc-apercus img:first').attr('src',reader.result);

		});
	});
	// Upload bouton pour écran
	$('.sf-bouton-fichier').on('change', function(){
		var objet = $(this);
		var file    = $(this)[0].files[0];
		var reader  = new FileReader();
		if(file){
			reader.readAsDataURL(file);
		}
		reader.addEventListener("load", function(){
			objet.parent().parent().parent().parent().parent().find('.sf-bloc-apercus .sf-bloc-button-upload').html('<img class="sf-bouton-center" src="'+reader.result+'">');
		});
	});
	
	// Colorpicker
	$(".colorpicker2").asColorPicker();
	$(".colorpicker2").on('asColorPicker::change', function (e){
		var couleur = $(this).asColorPicker('val');
		$(this).parent().parent().parent().parent().parent().parent().find('.sf-bloc-apercus').css({'background-color': couleur, 'background-image': 'unset'});
	});
	

	// apercus thème
	$(".kl_viewTheme").on('mouseover', function(){
		var id_cat_aperc = $(this).attr('id').split('_')[3];
		console.log(id_cat_aperc);
		var is_active = 0;
		if($("#btn_active_theme_"+id_cat_aperc).hasClass('active')) {
			is_active = 1;
		}

		$(".kl_viewTheme").magnificPopup({
			type: 'ajax',
			closeOnBgClick  : false,
			settings: {cache:true, async:true},
			gallery: {
			enabled:true
			},
			preload: [1,3],
			image: {
				markup: '<div class="mfp-figure kl_figure">'+
						'<div class="mfp-close"></div>'+
						'<div class="mfp-img"></div>'+
						'<div class="mfp-bottom-bar">'+
						'<div class="mfp-title"></div>'+
						'<div class="mfp-counter"></div>'+
						'</div>'+
					'</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
			
				cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.
			
				titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
			// Or the function that should return the title. For example:
			// titleSrc: function(item) {
			//   return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
			// }
			
				verticalFit: true, // Fits image in area vertically
			
				tError: '<a href="%url%">The image</a> could not be loaded.' // Error message
			},
			ajax: {
				settings: {
				type: 'POST',
				data: { 
					is_active : is_active
				}
				}
			}
		});	
	});

	$('.kl_viewCatCadre').magnificPopup({
		type: 'ajax',
		closeOnBgClick  : false,
		settings: {cache:true, async:true},
		gallery: {
		enabled:true
		},
		preload: [1,3],
		image: {
			markup: '<div class="mfp-figure kl_figure">'+
					'<div class="mfp-close"></div>'+
					'<div class="mfp-img"></div>'+
					'<div class="mfp-bottom-bar">'+
					'<div class="mfp-title"></div>'+
					'<div class="mfp-counter"></div>'+
					'</div>'+
				'</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
		
			cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.
		
			titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
		// Or the function that should return the title. For example:
		// titleSrc: function(item) {
		//   return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
		// }
		
			verticalFit: true, // Fits image in area vertically
		
			tError: '<a href="%url%">The image</a> could not be loaded.' // Error message
		}
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	 * Début
	 * Projet : uplad Cadre + Overlay
	 * date de modification : 09-fév-2019
	 * 
	 * author: Paul
	 */
	var idEvenement = 0;
	if($("#evenement-id").length)
		idEvenement = $("#evenement-id").val();
	// Duplication du formulaire ajout cadre
	/* $('#kl_cadre_ajout').click(function(){
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
	}); */
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
		var idEvent = $("#evenement-id").val();
		
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
			var idEvent = $("#evenement-id").val();
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
						var idEvent = $("#evenement-id").val();
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
	/* $('#nestable-menu').nestable({
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
	}); */
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
			var idEvent = $("#evenement-id").val();
			console.log(idEvent);
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
						var idEvent = $("#evenement-id").val();
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
	
	$('.dropifyCadre').dropify({
        messages: {
            default: 'Glissez-déposez votre cadre ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });
	
	
	
});