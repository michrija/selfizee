$(window).on('load', function(){
	$('body').backDetect(function(){
		alert('test');
	});
});

$(document).ready(function(){
	$idEvenement = $('#idEvenement').val();
	
	$('.sf-other-options-icon').on('click', function(){
		$(this).find('.fa').toggleClass('show');
		$('#sf-other-options').toggleClass('show');
	});
	
	/* DEBUT : EXPORT AND SAVE CANVAS */
	$('.sf-canvas-export').on('click', function(e){
		e.preventDefault();
		var type_export = $(this).data('tp');
		var $data = {
			'type_export': type_export,
			'idEvenement': $idEvenement
		};
		$('.sf-loading-spinner').removeClass('hide');
		
		canvas2.loadFromJSON(JSON.stringify(canvas.toJSON(['rectType'])), function(){canvas2.renderAll()}, function(o, object) {
			if((object.type == 'rect' && object.width == WIDTH_ZONE_PHOTO) || (object.type == 'image' && object.src == domaine+'img/confbornes/editeurs/icons/photo-ico.png')){
				object.set({
					globalCompositeOperation: 'destination-out'
				});
			}
		});
		
		setTimeout(function(){
			dataPng = dataJpg = '';
			
			dataPng = canvas2.toDataURL({
				format: 'png',
				quality: 1,
				multiplier: 2
			});
			dataJpg = canvas.toDataURL({
				format: 'jpg',
				quality: 1,
				multiplier: 2
			});
			
			$data = {
				'type_export': type_export,
				'idEvenement': $idEvenement,
				'dataPng': dataPng,
				'dataJpg': dataJpg
			};
			
			if(type_export == 'view'){
				$('.sf-loading-spinner').addClass('hide');
				var titre = 'Aperçus créas';
				var contenu = '<img class="img-responsive sf-apercus-photo" src="'+dataPng+'">';
				var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
				ouvrirModal(titre, contenu, footer, false, true);
			}else if(type_export == 'save'){
				$.ajax({
					type: 'post',
					url: '/configuration-bornes/export-creas',
					
					dataType: 'json',
					data: $data,
					
					beforeSend: function(){
						
					},
					success: function(reponse){
						$('.sf-loading-spinner').addClass('hide');
						var titre = '';
						var contenu = '';
						var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
						// Si l'image n'est pas enregistrée
						if(reponse == false){
							titre = '<strong class="text-danger">Attention</strong>';
							contenu = '<strong class="text-danger"><small>L\'enregistrement de l\'image a rencontré un problème.<br/>'+
								'Veuillez consulter l\'administrateur du système pour corriger le problème.<br/>'+
								'Nous vous remercions pour votre compréhension.'+
							'</small></strong>';
							ouvrirModal(titre, contenu, footer, false, false);
						}else{
							titre = '<strong class="text-success">Aperçus avec photo</strong>';
							contenu = '<img class="img-responsive sf-apercus-photo" src="'+reponse+'">';
							ouvrirModal(titre, contenu, footer, false, true);
						}
					}
				});
			}else if(type_export == 'download'){
				// Use XMLHttpRequest instead of Jquery $ajax
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					var a;
					if (xhttp.readyState === 4 && xhttp.status === 200) {
						$('.sf-loading-spinner').addClass('hide');
						// Trick for making downloadable link
						a = document.createElement('a');
						a.href = window.URL.createObjectURL(xhttp.response);
						// Give filename you wish to download
						a.download = $.now() + ".png";
						// a.download = $.now() + ".zip";
						a.style.display = 'none';
						document.body.appendChild(a);
						a.click();
					}
				};
				// Post data to URL which handles post request
				xhttp.open("POST", '/configuration-bornes/export-creas');
				xhttp.setRequestHeader("Content-Type", "application/json");
				// You should set responseType as blob for binary responses
				xhttp.responseType = 'blob';
				xhttp.send(JSON.stringify($data));
			}
		}, 1500);
	});
	/* FIN SAVE CANVAS */
	
	/* DEBUT : DECLARATION DES VARIABLES GLOBALES */
		var domaine = $('#baseUrl').val();
		var init_color = true;
		var zIndex = 2;
		const STEP = 1;
		const WIDTH_ZONE_PHOTO = 720;

		var Direction = {
			LEFT: 0,
			UP: 1,
			RIGHT: 2,
			DOWN: 3
		};
		var filters = [
			'grayscale', 'invert', 'remove-color', 'sepia', 'brownie',
			'brightness', 'contrast', 'saturation', 'noise', 'vintage',
			'pixelate', 'blur', 'sharpen', 'emboss', 'technicolor',
			'polaroid', 'blend-color', 'gamma', 'kodachrome',
			'blackwhite', 'blend-image', 'hue', 'resize'
		];
		
		var width_canvas = 800;
		var height_canvas = 600;
		var canvas = new fabric.Canvas('template', {
			backgroundColor: '#FFFFFF'
		});
		canvas.setDimensions({width: width_canvas});
		
		var canvas2 = new fabric.Canvas('templatePNG');
		canvas2.setDimensions({width: width_canvas});
	/* FIN DECLARATION */
	
	/* DEBUT : UTILITIES MISE EN FORME VIEW */
		$('#sf-font-family').selectpicker();
		
		$(".select2").select2({
			placeholder: 'Sélectionner thème(s)'
		});
		
		// Evènement pour afficher les photos liés à des tags
		$('.sf-search-tag').on('click', function(){
			var objet = $(this);
			var parent_bloc = objet.parent().parent().parent().parent();
			var item = parent_bloc.data('item');
			var tags = $('#sf-tags-'+item).val();
			
			var bloc_initial = parent_bloc.find('.sf-elt-initial');
			var bloc_tag = parent_bloc.find('.sf-elt-tag');
			if(tags.length){
				bloc_initial.addClass('hide');
				bloc_tag.html('<div class="text-center m-t-10"><img src="/img/gallery/spinner.gif" style="width:80px;"></div>').removeClass('hide');
				
				// Ajax pour récupérer
				$.ajax({
					type: 'post',
					url: '/configuration-bornes/ajax-liste-photo',
					
					data: {
						'editeur_tp_id': item,
						'tags': tags
					},
					
					beforeSend: function(){
						
					},
					success: function(data){
						console.log(data);
						bloc_tag.html(data);
					}
				});
			}else{
				bloc_initial.removeClass('hide');
				bloc_tag.addClass('hide').html('');
			}
		});
		
		// slim scroll
		$('#sf-object tbody td').slimScroll({
			height: '280px'
		});
		
		// Color picker et event
		$('.colorpicker2').asColorPicker();
		$('#sf-font-color').asColorPicker();
		
		// Position du loader pour enregistrement automatique
		$('.sf-enregistrement-auto').css({right: parseInt($('.sf-editeur-menu-droite').width()) + 10});
		
		$('.sf-menu').on('click', function(){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('#sf-object tbody').hide(300);
				$('#sf-object').css({
					'bottom': '-255px'
				});
			}else{
				$(this).addClass('active');
				$('#sf-object tbody').show(300);
				$('#sf-object').css({
					'bottom': '30px'
				});
			}
		});
		
		// Evenement pour cacher les blocs
		$('.sf-bloc-remove').on('click', function(e){
			$(this).parent().parent().parent().parent().css({
				left: '120%'
			});
			$('#accordion2').css({
				'visibility': 'visible'
			});
			refresh_canvas();
		});
		
		$('#nestable').nestable({
			group: 1,
			maxDepth: 1
		}).on('change', ordonner);
		
		// Evenement pour déplacer un div
		$("#sf-object thead").mouseup(function(e){
			$(document).unbind( "mousemove" );
		});

		$("#sf-object thead").mousedown(function(){
			var objet = $(this);
			var _parent = objet.parent().parent();
			$(document).mousemove(function(e){
				_parent.css({
					top: parseInt(e.pageY) - 10,
					left: parseInt(e.pageX) - 120 
				});
			});
		});
		
		// Evenement pour afficher les calques d'objets
		$('.sf-calque-dobjet').on('click', function(e){
			e.preventDefault();
			var id = $(this).attr('href');
			$(id).toggleClass('hide');
		});
	/* FIN UTILITIES */
	
	
	/* DEBUT : TOUCHE CLAVIER */
		fabric.util.addListener(document.body, 'keydown', function (options) {
			var key = options.which || options.keyCode;
			var obj = canvas.getActiveObject();
			
			if(obj != null && !$(".form-control").is(":focus")){
				// Echap
				if(key == 27){
					options.preventDefault();
					$('.sf-bloc-remove').trigger('click');
				}else if (key === 37) {
					options.preventDefault();
					moveSelected(Direction.LEFT);
				} else if (key === 38) {
					options.preventDefault();
					moveSelected(Direction.UP);
				} else if (key === 39) {
					options.preventDefault();
					moveSelected(Direction.RIGHT);
				} else if (key === 40) {
					options.preventDefault();
					moveSelected(Direction.DOWN);
				}
				// suppression
				else if(key === 8){
					if(obj.get('type') != 'i-text'){
						options.preventDefault();
						$('#remove_layers').trigger('click');
					}
				}
				else if(key === 46){
					options.preventDefault();
					$('#remove_layers').trigger('click');
				}
				// Confirm suppression
				else if(key == 13 && $('#informationModal').length){
					$('#sf-confirm').trigger('click');
				}
			}
		});
	/* FIN TOUCHE */
	
	
	/* DEBUT : PROTOTYPE DU PLUGIN */
		// Get object by id
		fabric.Canvas.prototype.getItem = function(id) {
			var object = null,
				objects = this.getObjects();

			for (var i = 0, len = this.size(); i < len; i++) {
				if (objects[i].id && objects[i].id === id) {
					object = objects[i];
					break;
				}
			}

			return object;
		};
		fabric.Object.prototype.getZIndex = function() {
			return canvas.getObjects().indexOf(this);
		}

		// Definition des largeurs controls
		fabric.Object.prototype.set({
			transparentCorners: false,
			cornerColor: '#ed195f',
			borderColor: '#ed195f',
			cornerSize: 5,
			padding: 5
		});
	/* FIN PROTOTYPE */
	
	
	/* DEBUT : INITIALISATION CANVAS */
		// Récupération dans la bd
		var initial = false;
		// Si vide
		if(!json_editeur){
			initial = true;
		}else{
			canvas_elements = JSON.parse(json_editeur);
		}
		
		if(false){
			/* Position cadre photo (fixed) + photo */
			rectangle = new fabric.Rect({
				id: '1',
				left: 40,
				top: 40,
				fill: 'rgb(70,70,70)',
				width: WIDTH_ZONE_PHOTO,
				height: 430,
				selectable: false,
				statefullCache: true,
				hasControls: false,
				
				// globalCompositeOperation: 'destination-out',
			});
			canvas.add(rectangle);
			/* appareil photo */
			fabric.Image.fromURL(domaine+'img/confbornes/editeurs/icons/photo-ico.png', function(ico) {
				ico.set({
					id: '2',
					top: 226,
					selectable: false,
					hasControls: false,
					statefullCache: true
				});
				canvas.add(ico);
				ico.centerH();
			});
		}else if(initial){
			canvas_elements = {
				'objects':[
					{
						type: 'rect',
						id: '1',
						left: 40,
						top: 40,
						fill: 'rgb(70,70,70)',
						width: WIDTH_ZONE_PHOTO,
						height: 430,
						selectable: false,
						statefullCache: true,
						hasControls: false,
					},
					{
						type: 'image',
						id: '2',
						top: 226,
						left: 400,
						originX: 'center',
						selectable: false,
						src: domaine+'img/confbornes/editeurs/icons/photo-ico.png',
						hasControls: false,
						statefullCache: true
					}
				],
				'background': '#FFFFFF'
			}
		}
		
		var item = zIndex; 
		canvas.loadFromJSON(canvas_elements, canvas.renderAll.bind(canvas), function(o, object) {
			item++;
			if((object.type == 'rect' && object.width == WIDTH_ZONE_PHOTO) || (object.type == 'image' && object.src == domaine+'img/confbornes/editeurs/icons/photo-ico.png')){
				object.set({
					selectable: false,
					statefullCache: true,
					hasControls: false
				});
			}else{
				object.set({
					id: item
				});
			}
		});
		
		// Boucle json pour créer les éléments d'objets calques
		setTimeout(function(){
			if(!initial){
				$('#sf-calcque-vide').addClass('hide');
			}
			canvas.forEachObject(function(object, index, objects){
				if((object.type == 'rect' && object.width == WIDTH_ZONE_PHOTO) || (object.type == 'image' && object.src == domaine+'img/confbornes/editeurs/icons/photo-ico.png')){
						// object.set({
							// globalCompositeOperation: 'source-atop'
						// });
				}else{
					item++;
					// Chargement calque selon l'ordre
					id = object.id;
					if(object.type == 'i-text'){
						$('#sf-object-element').append('<li class="dd-item" id="id-'+id+'" data-item="'+item+'">'+
							'<div class="dd3-content"><i class="fa fa-font"></i> &nbsp;Text</div>'+
							'<div class="dd-handle dd3-handle"></div>'+
						'</li>');
					}else if(object.type == 'image'){
						$('#sf-object-element').append('<li class="dd-item" id="id-'+id+'" data-item="'+item+'">'+
							'<div class="dd3-content"><i class="fa fa-picture-o"></i> &nbsp;Image</div>'+
							'<div class="dd-handle dd3-handle"></div>'+
						'</li>');
					}
				}
			});
		}, 2000);
	/* FIN INITIALISATION CANVAS */
	
	
	
	/* DEBUT : ENREGISTREMENT AUTOMATIQUE pour chaque 20s */
		setInterval(function(){
			if(canvas.backgroundImage != null)
				canvas.backgroundImage.opacity = 0.9;
			
			if($idEvenement){
				$.ajax({
					type: 'post',
					url: '/configuration-bornes/enregistrement-auto',
					
					data: {
						'idEvenement': $idEvenement,
						'canvas_elements': JSON.stringify(canvas.toJSON(['rectType']))
					},
					dataType: 'json',
					
					beforeSend: function(){
						$('.sf-enregistrement-auto').css({
							display: 'block'
						});
						$('#sf-enregistrement-auto-progress').html('<div class="progress no-margin"><div class="progress-bar bg-danger wow animated progress-animated" style="width: 100%; height:6px;" role="progressbar"> <span class="sr-only"></span> </div></div>');
					},
					success: function(data){
						setTimeout(function(){
							$('.sf-enregistrement-auto').css({
								display: 'none'
							});
							$('#sf-enregistrement-auto-progress').html('');
						}, 2000);
						if(data != 1){
							var titre = '<strong class="text-danger">Attention</strong>';
							var contenu = '<strong><small class="text-danger">' +
								'L\'enregistrement automatique a rencontré un problème.<br/>'+
								'Veuillez quitter cette interface s\'il vous plait et consulter l\'administrateur du système.<br/>'+
								'Nous vous remercions pour votre compréhension.'+
							'</small></strong>';
							var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
							ouvrirModal(titre, contenu, footer, false, false);
						}
					}
				});
			}
		}, 15000);
	/* FIN ENREGISTREMENT AUTOMATIQUE */
	
	
	/* DEBUT : DISPOSITION MENU ET SES ANIMATIONS  */
		$('.sf-to-collapse-trigger').trigger('click');
		$('.sf-to-collapse').on('click', function(e){
			e.preventDefault();
			var objet = $(this);
			var ordre_parent = objet.data('order');
			
			if(objet.hasClass('collapsed')){
				$('.sf-to-collapse').addClass('collapsed');
				$('.sf-accordion .collapse').removeClass('show');
				setTimeout(function(){
					objet.removeClass('collapsed');
					objet.parent().parent().parent().find('.collapse').addClass('show');
				}, 10);
				
				var total_card = $('.sf-card-menu').length;
				
				$('.sf-card-menu').each(function(){
					var ordre_tp = $(this).data('order');
					if(ordre_tp > ordre_parent){
						var i = ordre_tp == 1 ? 0 : 1;
						
						$(this).css({
							position: 'absolute',
							bottom: ((total_card - (ordre_tp + 1)) * 45 + i),
							width: '100%'
						});
					} else {
						$(this).css({
							position: 'relative',
							bottom: 'unset'
						});
					}
				});
			}else{
				$('.sf-card-menu').each(function(){
					$(this).css({
						position: 'relative',
						bottom: 'unset'
					});
				});
			}
		});
		$('.sf-fond-option').on('click', function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			if($(this).hasClass('open')){
				$(this).removeClass('open');
				$(href).hide(200);
			}else{
				$('.sf-fond-option').removeClass('open');
				$('.sf-fond-option-menu').hide(200);
				$(this).addClass('open');
				$(href).show(200);
			}
		});
		$('.sf-fond-option-1').on('click', function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			if($(this).hasClass('open')){
				$(this).removeClass('open');
				$(href).hide(200);
			}else{
				$('.sf-fond-option-1').removeClass('open');
				$('.sf-fond-option-1-menu').hide(200);
				$(this).addClass('open');
				$(href).show(200);
			}
		});
	/* FIN DISPOSITION MENU */
	
	
	/* DEBUT : EVENEMENT CANVAS - OBJETS ET MISE EN FORME */
		// delete object
		$('#remove_layers').on('click', function(e){
			e.preventDefault();
			var obj = canvas.getActiveObject();
			
			if(obj != null){
				var titre = 'Suppression objet';
				var contenu = ''+
					'<small><strong class="text-danger">Voulez-vous vraiment supprimer cet objet?</strong></small>'+
					'<br/>'+
					'<div class="text-center sf-load hide">'+
						'<strong class="text-primary"><small>Veuillez patienter s\'il vous plaît. . .</small></strong><br/>'+
						'<img src="/img/loading_anim.gif" style="width: 50px;">'+
					'</div>';
					
				var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</button><button class="btn btn-danger" id="sf-confirm">Supprimer</button>';
				ouvrirModal(titre, contenu, footer, false, false);
				var id = obj.id;
				$('#sf-confirm').on('click', function(){
					$('.sf-load').removeClass('hide');
					setTimeout(function(){
						removeLayersSelected(obj);
						$('#id-'+id).remove();
						if($('#sf-object-element li').length == 0){
							$('#sf-calcque-vide').removeClass('hide');
						}
						$('.close').trigger('click');
						ordonner();
					}, 300);				
				});
			}
		});
		
		// Duplicate object
		$('#duplique_layers').on('click', function(e){
			e.preventDefault();
			var id = $.now();
			var obj = canvas.getActiveObject();
			obj.clone(function(obj_cp){
				obj_cp.set('id', id);
				obj_cp.set("top", obj.top - 15);
				obj_cp.set("left", obj.left + 75);				
				canvas.add(obj_cp);
				canvas.renderAll();
			});
			
			var item = $('#sf-object-element li').length;
			item += zIndex;
			if(obj.get('type') == "image"){
				$('#sf-object-element').append('<li class="dd-item" id="id-'+id+'" data-item="'+item+'">'+
					'<div class="dd3-content"><i class="fa fa-picture-o"></i> &nbsp;Image</div>'+
					'<div class="dd-handle dd3-handle"></div>'+
				'</li>');
			}else if(obj.get('type') == 'i-text'){
				$('#sf-object-element').append('<li class="dd-item" id="id-'+id+'" data-item="'+item+'">'+
					'<div class="dd3-content"><i class="fa fa-font"></i> &nbsp;Text</div>'+
					'<div class="dd-handle dd3-handle"></div>'+
				'</li>');				
			}
			
		});
		
		// Lock / Unlock object
		$('#lock_layers').on('click', function(e){
			e.preventDefault();
			var $button = $(this);
			var obj = canvas.getActiveObject();
			
			if(obj != null){
				var icon = $button.find('.fa');
				if(icon.length){
					if(icon.hasClass('fa-lock')){
						obj.set({
							'lock': true,
							'hasControls': false,
							'lockMovementY': true,
							'lockMovementX': true
						});
						
						if(obj.get('type') == 'i-text'){
							obj.set({
								'editable': false
							});
						}
						
						icon.removeClass('fa-lock').addClass('fa-unlock');
						$button.attr('data-original-title', 'Dévérouiller ce calque').tooltip('show');
						$('#sf-zone-texte').css({'left': '150%'});
						$('#accordion2').css({'visibility': 'visible'});
					}else{
						obj.set({
							'lock': false,
							'hasControls': true,
							'lockMovementY': false,
							'lockMovementX': false
						});
						
						if(obj.get('type') == 'i-text'){
							obj.set({
								'editable': true
							});
						}
						
						icon.addClass('fa-lock').removeClass('fa-unlock');
						$button.attr('data-original-title', 'Vérouiller ce calque').tooltip('show');
						$('#sf-zone-texte').css({'left': 0});
						$('#accordion2').css({'visibility': 'hidden'});
					}
				}
				canvas.renderAll();
			}
		});
		
		// Event selection event
		canvas.on('selection:updated', function(e) {
			onObjectSelected(e, canvas);
			var o = e.target;
			if(o != null){
				$('#sf-object-element li').removeClass('active');
				$('#id-'+o.id).addClass('active');
			}
			
			o.setControlsVisibility({
				'mt': false,
				'mb': false,
				'ml': false,
				'mr': false,
			});
			
			// Attribution des valeurs
			var instance = $('#sf-object-opacity').data("ionRangeSlider");
			instance.update({
				from: (o.get('opacity') * 100)
			});
			var w = o.width * o.scaleX;
			var h = o.height * o.scaleY;
			$('#sf-object-format-w').val(parseInt(w));
			$('#sf-object-format-h').val(parseInt(h));
			$('#sf-object-format-x').val(parseInt(o.left));
			$('#sf-object-format-y').val(parseInt(o.top));
			
			// Flip horizontal
			if(o.flipX){
				$('#flipX').prop('checked', true);
			}else{
				$('#flipX').prop('checked', false);
			}
			// Flip vertical
			if(o.flipY){
				$('#flipY').prop('checked', true);
			}else{
				$('#flipY').prop('checked', false);
			}
			
			// Gamma
			if(o.filters != undefined){
				var couleur = o.filters[0]['gamma'];
				var instance_r = $('#sf-object-gamma-rouge').data("ionRangeSlider");
				instance_r.update({
					from: couleur[0]
				});
				var instance_v = $('#sf-object-gamma-vert').data("ionRangeSlider");
				instance_v.update({
					from: couleur[1]
				});
				var instance_b = $('#sf-object-gamma-bleu').data("ionRangeSlider");
				instance_b.update({
					from: couleur[2]
				});
			}
			
			// changement d'icone au moment où on vérouille/déverouille l'objet
			var icon = $('#lock_layers').find('.fa');
			if(typeof o.lock != 'undefined' && o.lock){
				if(icon.hasClass('fa-lock')){
					icon.removeClass('fa-lock').addClass('fa-unlock');
					$('#lock_layers').attr('data-original-title', 'Dévérouiller ce calque');
				}
				
				if(o.get('type') == 'i-text'){
					o.set({
						'editable': false
					});
				}
				$('#sf-zone-texte').css({
					left: '150%'
				});
				$('#accordion2').css({
					'visibility': 'visible'
				});
			}else{
				if(!icon.hasClass('fa-lock')){
					icon.removeClass('fa-unlock').addClass('fa-lock');
					$('#lock_layers').attr('data-original-title', 'Vérouiller ce calque');
				}
				if(o.get('type') == 'i-text'){
					o.set({
						'editable': true
					});
				}
				$('#sf-zone-texte').css({
					left: 0
				});
				$('#accordion2').css({
					'visibility': 'hidden'
				});
			}
			
			if(o.get('type') == 'i-text'){
				init_color = false;
				$('.sf-zone-txt').removeClass('hide');
				
				// Saturation de couleur seulement pour les images
				$('.sf-img-option').addClass('hide');
				
				// Attribution des valeurs
				$('#sf-font-size').val(o['fontSize']);
				$('#sf-font-color').asColorPicker('val', o['fill']);
				$('#sf-font-family').val(o['fontFamily']);
				
				var pos = o.textAlign;
				$('.sf-font-alignement').css('color', '#54667a');
				$('.sf-font-alignement-'+pos).css('color', '#e72763');
				
				var font_style = o.fontStyle;
					switch(font_style){
						case 'normal':
							$('.sf-font-style.fa-font').css('color', '#e72763');
							$('.sf-font-style.fa-italic').css('color', '#54667a');
						break;
						case 'italic':
							$('.sf-font-style.fa-italic').css('color', '#e72763');
							$('.sf-font-style.fa-font').css('color', '#54667a');
						break;
					}
				var font_weight = o.fontWeight;
					if(font_weight == 'bold'){
						$('.sf-font-style.fa-bold').css('color', '#e72763');
					}else{
						$('.sf-font-style.fa-bold').css('color', '#54667a');
					}
				
			}else{
				$('.sf-img-option').removeClass('hide');
				$('.sf-zone-txt').addClass('hide');
			}
			
			o.on('mousedown', function(options) {
				onObjectSelected(e, canvas);
				o.on('mousemove', function(g){
					$('#sf-object-format-x').val(parseInt(g.target.left));
					$('#sf-object-format-y').val(parseInt(g.target.top));
					g.target.setCoords();
					showImageTools(g.target, canvas);
				});
			});
			o.on('mouseup', function(){
				onObjectSelected(e, canvas);
				canvas.isDrawingMode = false;
				o.off('mousemove');
			});
		});
		canvas.on('selection:created', function(e) {
			init_color = true;
			onObjectSelected(e, canvas);
			var o = canvas.getActiveObject();
			
			o.setControlsVisibility({
				'mt': false,
				'mb': false,
				'ml': false,
				'mr': false,
			});
			
			if(o != null){
				$('#sf-object-element li').removeClass('active');
				$('#id-'+o.id).addClass('active');
			}
			
			// Attribution des valeurs
			var instance = $('#sf-object-opacity').data("ionRangeSlider");
			instance.update({
				from: (o.get('opacity') * 100)
			});
			var w = o.width * o.scaleX;
			var h = o.height * o.scaleY;
			$('#sf-object-format-w').val(parseInt(w));
			$('#sf-object-format-h').val(parseInt(h));
			$('#sf-object-format-x').val(parseInt(o.left));
			$('#sf-object-format-y').val(parseInt(o.top));
			
			// Flip horizontal
			if(o.flipX){
				$('#flipX').prop('checked', true);
			}else{
				$('#flipX').prop('checked', false);
			}
			// Flip vertical
			if(o.flipY){
				$('#flipY').prop('checked', true);
			}else{
				$('#flipY').prop('checked', false);
			}
			
			// Gamma
			if(o.filters != undefined){
				var couleur = o.filters[0]['gamma'];
				var instance_r = $('#sf-object-gamma-rouge').data("ionRangeSlider");
				instance_r.update({
					from: couleur[0]
				});
				var instance_v = $('#sf-object-gamma-vert').data("ionRangeSlider");
				instance_v.update({
					from: couleur[1]
				});
				var instance_b = $('#sf-object-gamma-bleu').data("ionRangeSlider");
				instance_b.update({
					from: couleur[2]
				});
			}
			
			// changement d'icon au moment où on vérouille/déverouille l'objet
			var icon = $('#lock_layers').find('.fa');
			if(typeof o.lock != 'undefined' && o.lock){
				if(icon.hasClass('fa-lock')){
					icon.removeClass('fa-lock').addClass('fa-unlock');
					$('#lock_layers').attr('data-original-title', 'Dévérouiller ce calque');
				}
				
				if(o.get('type') == 'i-text'){
					o.set({
						'editable': false
					});
				}
				$('#sf-zone-texte').css({
					left: '150%'
				});
				$('#accordion2').css({
					'visibility': 'visible'
				});
			}else{
				if(!icon.hasClass('fa-lock')){
					icon.removeClass('fa-unlock').addClass('fa-lock');
					$('#lock_layers').attr('data-original-title', 'Vérouiller ce calque');
				}
				
				if(o.get('type') == 'i-text'){
					o.set({
						'editable': true
					});
				}
				$('#sf-zone-texte').css({
					left: 0
				});
				$('#accordion2').css({
					'visibility': 'hidden'
				});
			}
			
			if(o.get('type') == 'i-text'){
				$('.sf-zone-txt').removeClass('hide');
				
				// Seulement pour les images
				$('.sf-img-option').addClass('hide');
				
				// Attribution des valeurs
				$('#sf-font-size').val(o['fontSize']);
				$('#sf-font-color').asColorPicker('val', o['fill']);
				$('#sf-font-family').val(o['fontFamily']);
				
				var pos = o.textAlign;
				$('.sf-font-alignement').css('color', '#54667a');
				$('.sf-font-alignement-'+pos).css('color', '#e72763');
				
				var font_style = o.fontStyle;
					switch(font_style){
						case 'normal':
							$('.sf-font-style.fa-font').css('color', '#e72763').attr('data-active', 'true');
							$('.sf-font-style.fa-italic').css('color', '#54667a').attr('data-active', 'false');
						break;
						case 'italic':
							$('.sf-font-style.fa-italic').css('color', '#e72763').attr('data-active', 'true');
							$('.sf-font-style.fa-font').css('color', '#54667a').attr('data-active', 'false');
						break;
					}
				var font_weight = o.fontWeight;
					if(font_weight == 'bold'){
						$('.sf-font-style.fa-bold').css('color', '#e72763').attr('data-active', 'true');
					}else{
						$('.sf-font-style.fa-bold').css('color', '#54667a').attr('data-active', 'false');
					}
			}else{
				$('.sf-zone-txt').addClass('hide');
				$('.sf-img-option').removeClass('hide');
			}
			canvas.renderAll();
			o.on('mousedown', function(options) {
				onObjectSelected(e, canvas);
				o.on('mousemove', function(g){
					$('#sf-object-format-x').val(parseInt(g.target.left));
					$('#sf-object-format-y').val(parseInt(g.target.top));
					g.target.setCoords();
					showImageTools(g.target, canvas);
				});
			});
			o.on('mouseup', function(){
				onObjectSelected(e, canvas);
				canvas.isDrawingMode = false;
				o.off('mousemove');
			});
		});
		canvas.on('selection:cleared', function(e) {
			$('#sf-object-element li').removeClass('active');
			init_color = true;
			$('#sf-font-color').asColorPicker('val', '');
			$('.sf-object-format').val('');
			onSelectionCleared(canvas);
			$('.sf-bloc-remove').trigger('click');
		});
		canvas.on('mouse:over', function(e){
			if(e.target != null){
				var ref = e.target.id;
				if(
					$.inArray(ref, ['1', '2']) > -1 || 
					(e.target.type == 'rect' && e.target.width == WIDTH_ZONE_PHOTO) || 
					(e.target.type == 'image' && e.target.src == domaine+'img/confbornes/editeurs/icons/photo-ico.png')
				){
					
				}else{
					obj = e.target;
					obj._renderControls(canvas.contextTop, {
						hasControls: false
					});
					canvas.renderAll();
				}
			}
		});
		canvas.on('mouse:out', function(e){
			if(e.target != null){
				var ref = e.target.id;
				if(
					$.inArray(ref, ['1', '2']) > -1 || 
					(e.target.type == 'rect' && e.target.width == WIDTH_ZONE_PHOTO) || 
					(e.target.type == 'image' && e.target.src == domaine+'img/confbornes/editeurs/icons/photo-ico.png')
				){
					
				}else{
					canvas.clearContext(canvas.contextTop);
				}
			}
		});
		canvas.on('mouse:down', function(e){
			canvas.clearContext(canvas.contextTop);
		});
		// Resize object
		canvas.on('object:scaling', function(e){
			var obj = e.target;
			w = obj.width * obj.scaleX;
			h = obj.height * obj.scaleY;
			$('#sf-object-format-w').val(parseInt(w));
			$('#sf-object-format-h').val(parseInt(h));
		});
		
		
		function onObjectSelected(e, canvas){
			showImageTools(e.target, canvas);
		}
		function onSelectionCleared(side){
			$('#customBox').hide();
		}
		
		function removeLayers(index){
			canvas.getObjects()[index].remove();
		}
		function removeLayersSelected(obj){
			canvas.remove(obj);
		}

		
		// Fonction pour faire apparaitre le loading au moment de chargement de l'objet
		function showloading(coords){
			$('#sf-editeur-loading').show();
			$('#sf-editeur-loading').css({
				top: coords.top,
				left: coords.left,
				width: coords.width,
				height: coords.height
			});
		}
		
		function showImageTools (e, side) {
			moveImageTools(e, side);
		}
		function moveImageTools (e, side) {
			var coords = getObjPosition(e, side);
			var top = coords.bottom+4;
			var left = coords.left;			
			$('#customBox').show();
			$('#customBox').css({top: top, left: left});
		}

		function getObjPosition (e, side) {
			var rect = e.getBoundingRect();
			var offset = side.calcOffset();
			var bottom = offset._offset.top + rect.top + rect.height;
			var right = offset._offset.left + rect.left + rect.width;
			var left = offset._offset.left + rect.left;
			var top = offset._offset.top + rect.top;
			return {left: left, top: top, right: right, bottom: bottom};
		}
		
		/* Application filtre */
		function applyFilterValue(index, value) {
			var obj = canvas.getActiveObject();
			obj.filters[0]['gamma'] = value;
			obj.applyFilters();
			canvas.renderAll();
		}
		
		// Change background
		$('.sf-bg').on('click', function(e){
			e.preventDefault();
			var tp = $(this).data('tp');
			
			switch(tp){
				case 'color':
					var color = $(this).data('color');
					canvas.backgroundColor = color;
					canvas.setBackgroundImage(0, canvas.renderAll.bind(canvas));
				break;
				case 'image':
					var href = $(this).data('href');
					
					var percent = parseInt($('#sfValeurPercent').text());
					var width_act = width_canvas * percent / 100;
					var height_act = height_canvas * percent / 100;
					
					canvas.backgroundColor = '#FFFFFF';
					canvas.setBackgroundImage(href, canvas.renderAll.bind(canvas), {
						left: 0,
						top: 0,
						width: width_act,
						height: height_act,
						repeat: 'repeat',
						originX: 'left',
						originY: 'top',
						opacity: 0.1
					});
					$('#sf-editeur-canvas-loading').show();
					setTimeout(function(){
						canvas.backgroundImage.opacity = 0.9;
						canvas.renderAll();
						$('#sf-editeur-canvas-loading').hide();
					}, 2000);
				break;
			}
			
			canvas.renderAll();
		});
		$('#sf-bg-color-pers').on('click', function(){
			$('#sf-bg-color-pers-input').trigger('click');
		});
		$('#sf-bg-color-pers-input').on('asColorPicker::change', function (e) {
			var couleur = $(this).val();
			
			if(jQuery.trim(couleur) != '' && init_color){
				canvas.backgroundColor = couleur;
				canvas.setBackgroundImage(0, canvas.renderAll.bind(canvas));
				canvas.renderAll();
			}
		});
		
		// Add Text
		$('.sf-add-text').on('click', function(e){
			e.preventDefault();
			var size = $(this).data('size');
			
			var id = $.now();
			
			var color = $(this).data('color');
			var iTextSample = new fabric.IText('Votre texte', {
				type: 'i-text',
				id: id,
				left: 100,
				top: 100,
				fontFamily: 'Indie Flower',
				fontSize: size,
				fill: color,
				textAlign: 'center',
			});
			canvas.add(iTextSample);
			
			var item = $('#sf-object-element li').length;
			item += zIndex;
			$('#sf-calcque-vide').addClass('hide');
			
			$('#sf-object-element').append('<li class="dd-item" id="id-'+id+'" data-item="'+item+'">'+
				'<div class="dd3-content"><i class="fa fa-font"></i> &nbsp;Text</div>'+
				'<div class="dd-handle dd3-handle"></div>'+
			'</li>');
		});
		
		// Add Photos
		$('.sf-elt').on('click', function(e){
			e.preventDefault();
			var url_img = $(this).data('href');
			
			fabric.Image.fromURL(url_img, function(img) {
				
				var ratio = 1;
				if(img.width > 1000){
					ratio = 0.3
				}else if(img.width > 600){
					ratio = 0.5;
				}else if(img.width > 300){
					ratio = 0.7;
				}else if(img.width > 200){
					ratio = 0.8;
				}
				
				var larg = img.width * ratio;
				var haut = img.height * ratio;
				var id = $.now();
				
				img.set({
					id: id,
					top: 40,
					left: 60,
					scaleX: larg / img.width,
					scaleY: haut / img.height
				});				
				
				// Définition filtre
				var filter = new fabric.Image.filters.Gamma({
					gamma: [1, 1, 1]
				});
				img.filters.push(filter);
				img.applyFilters();
				
				var coords_img = getObjPosition(img, canvas);
				var coords = {
					'top': coords_img.top,
					'left': coords_img.left,
					'width': larg,
					'haut': haut
				};
				showloading(coords);
				setTimeout(function(){
					$('#sf-editeur-loading').hide();
					canvas.add(img);
					var item = $('#sf-object-element li').length;
					item += zIndex;
					$('#sf-calcque-vide').addClass('hide');
					
					$('#sf-object-element').append('<li class="dd-item" id="id-'+id+'" data-item="'+item+'">'+
						'<div class="dd3-content"><i class="fa fa-picture-o"></i> &nbsp;Image</div>'+
						'<div class="dd-handle dd3-handle"></div>'+
					'</li>');
				}, 1000);
				
			});
		});
		
		/*
		 * Evenement ITEXT
		 */
			// taille
			$('#sf-font-size').on('change', function(){
				var obj = canvas.getActiveObject();
				if(obj != null){
					obj.set({
						fontSize: $(this).val()
					});
					showImageTools(obj, canvas);
					canvas.renderAll();
				}
			});
			// couleur
			$('#sf-font-color').on('asColorPicker::change', function (e) {
				var obj = canvas.getActiveObject();
				var couleur = $(this).val();
				
				if(obj != null){
					if(jQuery.trim(couleur) != '' && init_color){
						obj.set({
							fill: $(this).val()
						});
						canvas.renderAll();
					}else if(!init_color){
						obj.set({
							fill: obj.fill
						});
						canvas.renderAll();
						init_color = true;
					}
				}
			});
			// family
			$('#sf-font-family').on('change', function (e) {
				var family = $(this).val();
				var obj = canvas.getActiveObject();
				
				if(obj != null){
					obj.set({
						fontFamily: family
					});
					canvas.renderAll();
				}
			});
			// style
			$('.sf-font-style').on('click', function(){
				var element = $(this);
				
				var valeur = element.data('style');
				var obj = canvas.getActiveObject();
				
				if(obj != null){
					if(valeur == 'bold'){
						var is_active = element.attr('data-active');
						if(is_active == 'false'){
							obj.set({
								fontWeight: 'bold'
							});
							$('.sf-font-style.fa-bold').css('color', '#e72763').attr('data-active', 'true');
						}else{
							obj.set({
								fontWeight: 'normal'
							});
							$('.sf-font-style.fa-bold').css('color', '#54667a').attr('data-active', 'false');
						}
					}else{
						switch(valeur){
							case 'normal':
								obj.set({
									fontStyle: 'normal'
								});
								$('.sf-font-style.fa-font').css('color', '#e72763').attr('data-active', 'true');
								$('.sf-font-style.fa-italic').css('color', '#54667a').attr('data-active', 'false');
							break;
							case 'italic':
								obj.set({
									fontStyle: 'italic'
								});
								$('.sf-font-style.fa-italic').css('color', '#e72763').attr('data-active', 'true');
								$('.sf-font-style.fa-font').css('color', '#54667a').attr('data-active', 'false');
							break;
						}
					}
					canvas.renderAll();
				}
			});
			// Alignement
			$('.sf-font-alignement').on('click', function(e){
				var obj = canvas.getActiveObject();
				if(obj != null){
					var pos = $(this).data('pos');
					$('.sf-font-alignement').css('color', '#54667a');
					$('.sf-font-alignement-'+pos).css('color', '#e72763');
					
					
					obj.set({
						textAlign: pos
					});
					canvas.renderAll();
				}
			});
			
		
		/*
		 * Evenement communs d'objets
		 */
			// Opacité
			$("#sf-object-opacity").ionRangeSlider({
				type: "single",
				min: 0,
				max: 100,
				from: 100,
				keyboard: false,
				onStart: function(data) {
					
				},
				onChange: function(data) {
					var obj = canvas.getActiveObject();
					if(obj != null){
						obj.set({
							opacity: (data.from / 100)
						});
						canvas.renderAll();
					}
				},
			});
			// Filtre gamma
			$(".sf-object-gamma").ionRangeSlider({
				type: "single",
				min: 0.01,
				max: 2.2,
				from: 1,
				step: 0.01,
				keyboard: false,
				onStart: function(data) {
					
				},
				onChange: function(data) {
					var obj = canvas.getActiveObject();
					if(obj != null){
						var $input = data.input;
						var valeur = data.from;
						var tp = $input.prop('name');
						var couleur = obj.filters[0]['gamma'];
						switch(tp){
							case 'r':
								couleur[0] = valeur;
							break;
							case 'v':
								couleur[1] = valeur;
							break;
							case 'b':
								couleur[2] = valeur;
							break;
						}
						applyFilterValue(17, couleur);
					}
				},
			});
			
			// Superposition
			$('.sf-object-position').on('click', function(){
				var pos = $(this).data('pos');
				var obj = canvas.getActiveObject();
				if(obj != null){
					var ref = obj.id;
					var li = $('#id-'+ref);
					var item = parseInt(li.data('item'));
					switch(pos){
						// Premier plan
						case 0:
							$('#sf-object-element').append(li.clone());
							li.remove();
						break;
						// En avant
						case 1:
							var to_dest = item - (zIndex - 1);
							longueur_list = $('#sf-object-element li').length;
							if(to_dest < longueur_list){
								$(li.clone()).insertAfter($('#sf-object-element li').eq(to_dest));
							}else{
								$('#sf-object-element').append(li.clone());
							}
							li.remove();
						break;
						// En arrière
						case 2:
							var to_dest = item - (zIndex + 2);
							if(to_dest > -1){
								$(li.clone()).insertAfter($('#sf-object-element li').eq(to_dest));
								li.remove();
							}else{
								$('#sf-object-element').prepend(li);
							}
						break;
						// En arrière plan
						case 3:
							$('#sf-object-element').prepend(li);
						break;
					}
					ordonner();
				}
			});
			
			// Modification format widht/height/posX/posY
			$('.sf-object-format').on('input', function(e){
				e.preventDefault();
				var input = $(this);
				var valeur = input.val();
				
				var o = canvas.getActiveObject();
				if(o != null && valeur){
					var w = o.get('width');
					var h = o.get('height');
					switch(input.data('tp')){
						case 'w':
							hauteur = h * valeur / w;
							o.scaleToHeight(hauteur, true);
							o.scaleToWidth(valeur, true);
							$('#sf-object-format-h').val(parseInt(hauteur));
						break;
						case 'h':
							largeur = w * valeur / h;
							o.scaleToHeight(valeur, true);
							o.scaleToWidth(largeur, true);
							$('#sf-object-format-w').val(parseInt(largeur));
						break;
						case 'x':
							o.set('left', parseInt(valeur));
							$('#sf-object-format-x').val(parseInt(valeur));
						break;
						case 'y':
							o.set('top', parseInt(valeur));
							$('#sf-object-format-y').val(parseInt(valeur));
						break;
					}
					o.setCoords();
					showImageTools(o, canvas);
					canvas.renderAll();
				}
			});
		
			// Flip X Y
			$('.sf-object-flip').on('change', function(){
				var tp = $(this).data('tp');
				var isChecked = $(this).prop('checked');
				var obj = canvas.getActiveObject();
				
				if(obj != null){
					if(tp == 'x'){
						obj.toggle('flipX');
					}else if(tp == 'y'){
						obj.toggle('flipY');
					}
					canvas.renderAll();
				}
			});
		
		/* CALQUES */
		$('body').on('click', '#sf-object-element li', function(e){
			e.preventDefault();
			
			var item = parseInt($(this).data('item'));
			var id = $(this).attr('id');
			var ref = id.replace('id-', '');
			$('#sf-object-element li').removeClass('active');
			$(this).addClass('active');
			canvas.forEachObject(function(obj) {
				if(typeof obj.id != 'undefined' && obj.id && obj.id == ref) {
					canvas.setActiveObject(obj);
					canvas.renderAll();
					return false;
				}
			});
		});
		
		// Effet zoom
		$('.sf-percent').on('click', function(e){
			e.preventDefault();
			
			var tp = $(this).data('tp');
			var percent = parseInt($('#sfValeurPercent').text());
			
			if(tp == 'minus'){
				percent -= 10;
			}else{
				percent += 10;
			}
			
			var zoom = (percent / 100);		
			$('#sfValeurPercent').text(percent);
			
			var width_act = width_canvas * percent / 100;
			var height_act = height_canvas * percent / 100;
			canvas.setDimensions({width: width_act, height: height_act});
			
			canvas.setZoom(zoom);
			
			if(canvas.getActiveObject() != null){
				showImageTools(canvas.getActiveObject(), canvas);
			}
			
		});
		
	/* FIN EVENEMENT CANVAS */
	
	
	/* DEBUT : DECLARATION FONCTION UTILE */
		// Function pour mettre à jour l'ordre dans la liste des calques d'objets
		function ordonner(){
			var i = zIndex;
			$('#sf-object-element li').each(function(){
				var objet = $(this);
				
				var id = objet.attr('id');
				var ref = id.replace('id-', '');
				canvas.forEachObject(function(obj) {
					if(typeof obj.id != 'undefined' && obj.id && obj.id == ref) {
						canvas.moveTo(obj, i);
						return false;
					}
				});
				
				objet.attr('data-item', i);
				i++;
			});
			canvas.renderAll();
		}
		
		function refresh_canvas(){
			canvas.discardActiveObject();
			canvas.renderAll(); 
		}
		
		/* Dessine une image dans un rectangle */
		function loadPattern(rect, url) {
			fabric.util.loadImage(url, function(img) {
				rect.fill = new fabric.Pattern({
					source: img,
					repeat: 'repeat',
				});
				canvas.renderAll();
			});
		}

		/* deplacement objets selectionnés */
		function moveSelected(direction) {
			var activeObject = canvas.getActiveObject();

			if (activeObject) {
				switch (direction) {
					case Direction.LEFT:
						var x = activeObject.get('left') - STEP;
						activeObject.set('left', x);
						$('#sf-object-format-x').val(parseInt(x));
					break;
					case Direction.UP:
						var y = activeObject.get('top') - STEP;
						activeObject.set('top', y);
						$('#sf-object-format-y').val(parseInt(y));
					break;
					case Direction.RIGHT:
						var x = activeObject.get('left') + STEP;
						activeObject.set('left', x);
						$('#sf-object-format-x').val(parseInt(x));
					break;
					case Direction.DOWN:
						var y = activeObject.get('top') + STEP;
						activeObject.set('top', y);
						$('#sf-object-format-y').val(parseInt(y));
					break;
				}
				activeObject.setCoords();
				showImageTools(activeObject, canvas);
				canvas.renderAll();
			} else {
				console.log('no object selected');
			}
		}
	/* FIN FONCTION */
	
});