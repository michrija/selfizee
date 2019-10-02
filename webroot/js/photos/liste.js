$(document).ready(function() {
    //alert('Je passe ici');
    var idEvenement = 0;
	// Téléchargement photos via galerie
	$('#sf-download-album').on('click', function(e){
		e.preventDefault();
		var titre = 'Génération lien de téléchargement';
		var contenu = '<div class="form-group">'+
			'<label for="champ_email_download_zip" class="control-label">Veuillez saisir votre adresse e-mail (<strong class="text-danger">*</strong>)</label>'+
			'<input type="email" id="champ_email_download_zip" class="form-control" placeholder="exemple@email.com">'+
			'<span class="help-block"><small>Après la validation du formulaire, le fichier sera généré automatiquement. Nous vous prions d\'attendre quelques minutes pour cliquer sur le lien généré depuis l\'email envoyé.</small></span>'+
			'<div id="notification"></div>'+
		'</div>';
		var footer = '<button type="button" class="btn btn-default" data-dismiss="modal" id="sf-fermer-modal">Fermer</button><button class="btn btn-secondary" id="valide_form_reponse">Valider</button>';
		ouvrirModal(titre, contenu, footer, false, false);
		idEvenement = $(this).data('evt');
		
	});
	$('body').on('click', '#valide_form_reponse', function(e){
		e.preventDefault();
		var mail = $.trim($('#informationModal').find('#champ_email_download_zip').val());
		if(mail != '' && idEvenement){
			$(this).addClass('disabled');
			// $('#sf-form-download').append('<input type="hidden" name="mail" value="'+mail+'">').submit();
			$.ajax({
				type: 'post',
				url: '/Photos/ajax-generation-zip',
				
				data: {
					'mail': mail,
					'idEvenement': idEvenement
				},
				dataType: 'json',
				
				beforeSend: function(){
					$('#notification').html('<div class="text-center m-t-20"><span class="text-info">Veuillez patienter s\'il vous plait . . .</span><br/><img src="/img/loading_anim.gif"></div>');						
				},
				success: function(){
					
				}
			});
			setTimeout(function(){
				$('#notification').html('<div class="alert alert-success m-t-20">Le lien de téléchargement direct du fichier sera envoyé à cet email dès que le fichier soit prêt. Ce lien aura expiré dans 7 jours.</div>');
			}, 2500);
			setTimeout(function(){$('#informationModal').find('#sf-fermer-modal').trigger('click');}, 5000);
		}else{
			$('#notification').html('<div class="alert alert-danger m-t-20">Le champ émail est recquis.</div>');
		}
	});
	
    $(".kl_viewImage").magnificPopup({ 
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
    
    /*var $grid = $('.kl_listePhoto').masonry({
      // options
      itemSelector: '.kl_onePhoto',
      columnWidth: 260,
      percentPosition: true
    });*/
    
    $("#id_photoListe").mpmansory(
				{
					childrenClass: 'kl_onePhoto', // default is a div
					columnClasses: 'padding', //add classes to items
					breakpoints:{
						lg: 2, 
						md: 2, 
						sm: 6,
						xs: 12
					},
					distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
					onload: function (items) {
						//make somthing with items
					} 
				}
	);

    
    $(".kl_deletePhoto").click(function(){
       if(confirm("Etes vous sûr de vouloir supprimer ?")) {
            var URL_BASE = $("#id_baseUrl").val();
            var idTodelete = $(this).attr('data-item');
            var queue = $(this).attr('data-queue');
            if(idTodelete){
                $.ajax({
                    url: URL_BASE+"photos/corbeilleAjax/"+idTodelete+"/"+queue,
                    type: 'POST',
                    beforeSend : function(){
                       //$(sender).find(".kl_loader").removeClass("hide");
                    },
                    success: function (data, textStatus, jqXHR) {

                           //$("#id_contentContact").empty();
                        var data = $.parseJSON(data);
                        $("#id_onePhoto_"+idTodelete).remove();
                        //$("#nbr_photos").text(data.nbr_photos+" Photo(s)");
                        $(".kl_totalNbr").text(data.nbr_photos);
                   ///////////////////////////////////////////////////////////                             
                        $(".kl_totalNbrImpres").text(data.nbr_impres);
                   ///////////////////////////////////////////////////////////     
                        //$grid.masonry();
                         $("#id_photoListe").mpmansory(
            				{
            					childrenClass: 'kl_onePhoto', // default is a div
            					columnClasses: 'padding', //add classes to items
            					breakpoints:{
            						lg: 3, 
            						md: 3, 
            						sm: 6,
            						xs: 12
            					},
            					distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
            					onload: function (items) {
            						//make somthing with items
            					} 
            				}
            		);

                        var contenuItems = $("#id_photoListe .padding");
                        console.log("Total div: "+contenuItems.length);
                        $.each(contenuItems, function (index, elem) {
                            var div = $(elem);
                            if($(div).html() === "") {
                                console.log("deleted :"+index);
                                console.log($(div).html());
                                $(div).remove();
                            }
                            //console.log(index+ " :"+$(div).html());
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //console.log(textStatus);
                        alert("Une erreur est survenue. Veuillez réessayer.")
                    }
                });
            }
       }
       return false;
    });
    
    //Suppresion d'une image dans le popup d'une photo
    $("body").delegate(".kl_deleteInPopupImage", "click", function(){
        var idTodelete = $(this).attr("id").slice(12);
        deleteInPopup(this, idTodelete);
    });

    $("#id_filtreToActive").change(function(){
        if($(this).is(':checked')){
            $("#id_blocFormFiltre").removeClass('hide'); 
        }else{
            $("#id_blocFormFiltre").addClass('hide');
        }
        
    });
    
    function deleteInPopup(sender, idTodelete){
        var URL_BASE = $("#id_baseUrl").val();
        $.ajax({
            url: URL_BASE+"photos/corbeilleAjax/"+idTodelete,
            type: 'POST',
            beforeSend : function(){
               $(sender).find(".kl_loader").removeClass("hide");
            },
            success: function (data, textStatus, jqXHR) {
                    $.magnificPopup.instance.next();
                    $("#id_onePhoto_"+idTodelete).remove();
                    //var msnry = $('.kl_listePhoto').data('masonry');
                    $grid.masonry();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    }

});

