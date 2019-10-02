$(document).ready(function(){
    $(".kl_champObli").addClass('hide');
    
    $("#id_type_optin_value").change(function(){
        var idOptinVal = $(this).val();
        if(idOptinVal == 6){
            $("#id_customOptin").removeClass("hide");
        }else{
            $("#id_customOptin").addClass("hide");
        } 
    });
    
    $("#id_type_champ").change(function(){
        var idOptionVal = $(this).val();
        $(".k_oneOption").val("");
        if(idOptionVal == 1 || idOptionVal == 3){
            $("#id_listeOption").addClass('hide');
        }else {
             $("#id_listeOption").removeClass('hide');
        }
         
        if(idOptionVal == 1){
            $("#id_theTypeDeDonnees").removeClass("hide");
        }else{
            $("#id_theTypeDeDonnees").addClass("hide");
        }
        
        if(idOptionVal == 3){
            $("#id_theTypeOptin").removeClass("hide");
        }else{
            $("#id_theTypeOptin").addClass("hide");
        }
    });
    
    // $("#id_listeChampAdded").sortable()
    // .on( "sortstop", function( event, ui ) {
        // reOrdone();
    // });
    
    $("#id_ToaddChamp").click(function(){
         var typeChamp = $("#id_type_champ").val();
         var nomChamp = $('#id_nom_champ').val();
         var typeDonnee = $("#id_type_donnee").val();
         var typeChampText = $("#id_type_champ option:selected").text();
         var typeDonneeText = $("#id_type_donnee option:selected").text();
         var required = $('.isRequiredValue:checked').val();
         var typeOptin = $("#id_type_optin_value").val();
         var typeOptinText = $("#id_type_optin_value option:selected").text();
         var textePersonnaliseVal = $("#id_customOptinValue").val();
         //console.log(required);
         //alert(required);

         //alert(typeChamp.length+''+nomChamp.length +''+typeDonnee.length);/
         
         var isTypeDonnePasRequired = true;
         if(typeChamp == 1 ){
             isTypeDonnePasRequired = false;
             if(typeDonnee.length){
                isTypeDonnePasRequired = true;
             }
         }
         
         if(typeChamp.length && nomChamp.length && isTypeDonnePasRequired ){
            var ordre = $(".kl_oneListe").length +  1;
            /**
            * champ pour l'insertion
            **/
            var htmlToAdd = typeof $("#id_editionForm") != 'undefined' && $("#id_editionForm").val() ? '<input type="hidden" id="id_IdChampIdAdded" name="champs['+ordre+'][id]" value="'+($("#id_editionForm").val())+'" />' : '';
            htmlToAdd += '<input type="hidden" id="id_typeChampIdAdded" name="champs['+ordre+'][type_champ_id]" value="'+typeChamp+'" />';
            htmlToAdd += '<input type="hidden" id="id_nomChampAdded" name="champs['+ordre+'][nom]"  value="'+nomChamp+'" />';
            htmlToAdd += '<input type="hidden" id="id_typeDonneIdAdded" name="champs['+ordre+'][type_donnee_id]"  value="'+typeDonnee+'" />';
            htmlToAdd += '<input type="hidden" id="id_ordreAdded" name="champs['+ordre+'][ordre]"  value="'+typeDonnee+'" />';
            htmlToAdd += '<input type="hidden" id="id_is_required" name="champs['+ordre+'][is_required]"  value="'+required+'" />';
            htmlToAdd += '<input type="hidden" id="id_type_optin" name="champs['+ordre+'][type_optin_id]"  value="'+typeOptin+'" />';
            if(typeOptin == 6){
                htmlToAdd = htmlToAdd + '<input type="hidden" id="id_type_optin" name="champs['+ordre+'][custom_optin][titre]"  value="'+textePersonnaliseVal+'" />';
            }
            //$("#id_listeChampAdded").append(htmlToAdd);
            var choixPossible = [];
            $( ".k_oneOption" ).each(function( index ) {
                var optionName = $( this ).val() ;
                if(optionName.length){
                    htmlToAdd = htmlToAdd + '<input type="hidden" class="kl_oneChoixPossible" name="champs['+ordre+'][champ_options]['+index+'][nom]"  value="'+optionName+'" />';
                    choixPossible[index] = optionName;
                }
            });
            
            /**
            * Champ pour affichage
            **/
            
            var choixPossibleStr = "";
            if(choixPossible.length){
                choixPossibleStr = "- Choix Possible : "+choixPossible.join(',');
            }
            
            var typeDonneSrtValue = "";
            if(typeChamp == 1){
                typeDonneSrtValue = 'Type de données : '+typeDonneeText;
            }
            
            var typeOptinSrtValue = "";
            if(typeChamp == 3){
                typeOptinSrtValue = 'Type de données : '+typeOptinText;
            }
            
            if(typeOptin == 6){
                
                typeOptinSrtValue = typeOptinSrtValue + " : "+textePersonnaliseVal;
            }

            var is_required = "";
            if(required == 1){
                is_required = 'Obligatoire : Oui';
            } else {
                is_required = 'Obligatoire : Non';
            }
            
            var idCustom = customId();
            var toAddedAffichage = '<div class="col-md-12 kl_oneChampAdded m-t-15" >'+
                '<div class="kl_indexChamp">'+ordre+'</div>'+
                '<div class="kl_infoChamp">'+
                    '<div class="kl_titreChamp">'+nomChamp+'</div>'+
                    '<div class="kl_infoChampAdded">Type de champ : '+typeChampText+' - '+typeDonneSrtValue+typeOptinSrtValue+choixPossibleStr+' - '+is_required+'</div>'+
                '</div>'+
                '<div class="kl_actionsChamp absolute">'+
                    '<a class="btn btn-actionChamp float-right m-r-5 kl_editChamp" data-customid="'+idCustom+'" href="#"><i class="mdi mdi-lead-pencil"></i></a>'+
                    '<a class="btn btn-actionChamp float-right m-r-5 kl_deleteChamp" date-customid="'+idCustom+'" href="#"><i class="mdi mdi-delete"></i></a>'+
                '</div>'+
            '</div>';
            htmlToAdd = '<div class="kl_oneListe" id="id_idChampAdded_'+idCustom+'" >'+toAddedAffichage+htmlToAdd+'</div>';
            
            
            
            $("#id_type_champ").val("");
            $('#id_nom_champ').val("");
            $("#id_type_donnee").val("");
            $(".k_oneOption").val("");
            $("#id_ToaddChamp").text('Ajouter');
            
            var idToEdit = $("#id_editionForm").val();
            //alert('idToEdit '+idToEdit);
            if(idToEdit.length ){
                $("#id_listeChampAdded #id_idChampAdded_"+idToEdit).replaceWith(htmlToAdd);
            }else{
               $("#id_listeChampAdded").append(htmlToAdd); 
            }
            reOrdone();
            $("#id_editionForm").val("");
            $(".kl_champObli,#id_theTypeDeDonnees,#id_listeOption").addClass('hide');
            $('#id_addChamp').modal('toggle');
         }else{
            $(".kl_champObli").removeClass('hide');
         }
         return false;
    });
    
	// Evènement pour ajout champ
	$('#id_addChamp_popup').on('click', function(){
		setTimeout(function(){
			$('#id_addChamp').find('.form-control').val('');
			$('#id_addChamp').find('.custom-select').val('');
		}, 100);
	});
	
    addOption();
    deleteOneOptionAdded();
    deleteOneChamp();
    lengthTitreForm();
    editChamp();
});

function editChamp(){
    $( "body" ).delegate( ".kl_editChamp", "click", function() { 
        var idToRemove = $(this).attr('data-customid');
        
        var idTypeChampId = $("#id_idChampAdded_"+idToRemove+ " #id_typeChampIdAdded").val();
        var idNomChamp = $("#id_idChampAdded_"+idToRemove+ " #id_nomChampAdded").val();
        var idTypeDonne = $("#id_idChampAdded_"+idToRemove+ " #id_typeDonneIdAdded").val();
        var idOrdre = $("#id_idChampAdded_"+idToRemove+ " #id_ordreAdded").val();
        var isRequired = $("#id_idChampAdded_"+idToRemove+ " #id_is_requiredAdded").val();
        //isRequired = parseInt(isRequired);
        var idOptinId = $("#id_idChampAdded_"+idToRemove+ " #id_type_optinAdded").val();
        var listeOption = "";
        $("#id_idChampAdded_"+idToRemove+ " .kl_oneChoixPossible").each(function(index ){
            var optionVal = $(this).val();
            if(optionVal.length){
                var position = index + 1;
                listeOption = listeOption + '<div class="form-group">'+
                                    '<label for="option-1" class="control-label">Option '+position+'</label>'+
                                    '<input type="text" value="'+optionVal+'" name="option_'+index+'" class="k_oneOption form-control" id="option-'+index+'"> '+
                                    '<span class="help-block"><small></small></span>'+
                                '</div>';
            }
        });
        
        //alert('listeOption '+listeOption);
        
        $("#id_type_champ").val(idTypeChampId);
        if(idTypeChampId == 3){
            $("#id_theTypeOptin").removeClass('hide');
            $("#id_theTypeOptin #id_type_optin_value").val(idOptinId);
        }
        $("input[name=is_required][value=" + isRequired + "]").prop('checked', true);
        
        $('#id_nom_champ').val(idNomChamp);
        $("#id_type_donnee").val(idTypeDonne);
        $(".kl_isEdition").attr('checked','checked');
        $("#id_editionForm").val(idToRemove);
        $("#id_listeOption").addClass('hide');
        if(listeOption.length){
            $("#id_listeOption").removeClass('hide');
            $("#id_theListeOption").html(listeOption);
        }
        $("#id_ToaddChamp").text('Modifier');
        $("#id_addChamp").modal();
        
        return false;
    });
}

function lengthTitreForm(){
    $("#id_titreForme").on("keyup", function(){
        var input_val		= $(this).val();
		var input_val_length	= $(this).val().length;
        $(".kl_resteTitreForm").text(200 - input_val_length);
    });
}

function reOrdone(){
    $("#id_listeChampAdded .kl_oneChampAdded").each(function(index ){
            $(this).find('.kl_indexChamp').html(index+1);
            $(this).find('#id_ordreAdded').val(index+1);
    });
}

function deleteOneChamp(){
    //$("#id_priseCoordonnees .kl_deleteChamp" ).on( "click", function() {
    $( "body" ).delegate( ".kl_deleteChamp", "click", function(e) { 
		e.preventDefault();
		var idToRemove = $(this).attr('date-customid');
		var titre_champ = $(this).parent().parent().find('.kl_titreChamp').text();
		
		if(idToRemove){
			var idEvenement = $("#evenement-id").val();
			var titre = '<strong class="text-danger">Suppression champ '+(typeof titre_champ != 'undefined' ? ': '+titre_champ : '')+'</strong>';
			var contenu = '<small><strong>Vous êtes sur le point de supprimer un champ.</strong></small>'+
				'<br/>'+
				'<small><strong>Etes-vous sur de vouloir supprimer?</strong></small>'+
				'<br/>'+
				'<div class="alert alert-danger m-t-15">'+
					'<small>Attention la suppression d\'un champ est irreversible. Si vous le supprimer, on ne peut plus le récupérer.'+
					'<br/>'+
					'Vous devez recréer si vous voulez le restaurer.'+
					'</small>'+
				'</div>'+
				'<div class="m-t-15">'+
					'<small><strong>Veuillez cliquer sur le bouton SUPPRIMER pour confirmer ou FERMER si vous voulez annuler la suppression.</strong></small>'+
				'</div>'+
				'<div class="text-center sf-load hide">'+
					'<strong class="text-primary"><small>Veuillez patienter s\'il vous plaît. . .</small></strong><br/>'+
					'<img src="/img/loading_anim.gif" style="width: 50px;">'+
				'</div>';
				
			var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</default><button class="btn btn-danger" id="sf-confirm">Supprimer</button>';
			
			ouvrirModal(titre, contenu, footer, false, false);
			
			$('#sf-confirm').on('click', function(ev){
				// Ajax pour supprimer un champ
				$.ajax({
					url: '/configuration-bornes/suppression-champ',
					type: 'post',
					
					data: {
						'idToRemove': idToRemove,
						'idEvenement': idEvenement
					},
					dataType: 'json',
					
					beforeSend: function(){
						$('.sf-load').removeClass('hide');
					},
					success: function(data){
						if(!data){
							setTimeout(function(){
								$("#id_idChampAdded_"+idToRemove).remove();
								reOrdone();
								$('.close').trigger('click');
							}, 1000);
						}
					}
				});
			});
		}
	
       //alert('ça fait mal '+idToRemove);
    });
}

function addOption(){
    $("#id_addOption").click(function(){
        var idCustom = customId();
        var countOtion = $('.k_oneOption').length + 1 ;
        var oneOption = '<div class="form-group kl_oneOptionAdded" id="id_addOption_'+idCustom+'"><label for="option-'+countOtion+'" class="control-label">Option '+countOtion+'</label><input name="option_'+countOtion+'" class="k_oneOption form-control" id="option-'+countOtion+'" type="text"> <span class="help-block"><small></small></span><a data-remove="'+idCustom+'" class="kl_deleteOption" href="#">X</a></div>';
        $("#id_theListeOption").append(oneOption);
    });
    
}

function deleteOneOptionAdded(){
    //kl_deleteOption
     $( "body" ).delegate( ".kl_deleteOption", "click", function() { 
            var idToRemove = $(this).attr('data-remove');
            $("#id_addOption_"+idToRemove).remove();
     });
}

function addInputText(nomChamp){
    var inputText = '<div class="col-md-8"><div class="form-group"><label  class="control-label">'+nomChamp+'</label><input  class="form-control" type="text"> <span class="help-block"><small></small></span></div></div>';
    return inputText;
}

function addCheckBox(nomChamp){
    var oneOption = "";
    $( ".k_oneOption" ).each(function( index ) {
        var optionName = $( this ).val() ;
        
        if(optionName.length){
            oneOption = '<div class="m-b-10">'+
                    		'<label class="custom-control custom-checkbox">'+
                    			'<input class="custom-control-input" type="checkbox">'+
                    			'<span class="custom-control-label">'+optionName+'</span>'+
                    		'</label>'+
                    	'</div>'+oneOption;
            
        }
        
    });
    
    if(!oneOption.length){
        alert('Vous devez au moins mettre une option');
        return false;
    }else{
        return '<label>'+nomChamp+'</label><div class="col-sm-12">'+oneOption+'</div>';
    }

}

function addRadioBox(nomChamp){
    var oneOption = "";
    $( ".k_oneOption" ).each(function( index ) {
        var optionName = $( this ).val() ;
        
        if(optionName.length){
            oneOption = '<div class="m-b-10">'+
                            '<label class="custom-control custom-radio">'+
                                '<input id="radio1" name="radio" class="custom-control-input" type="radio">'+
                                '<span class="custom-control-label">Toggle this custom radio</span>'+
                            '</label>'+
                        '</div>'+oneOption;
        }
        
    });
    
    if(!oneOption.length){
        alert('Vous devez au moins mettre une option');
        return false;
    }else{
        return '<label>'+nomChamp+'</label><div class="col-sm-12">'+oneOption+'</div>';
    }
}

function addSelectBox(nomChamp){
    var oneOption = "";
    $( ".k_oneOption" ).each(function( index ) {
        var optionName = $( this ).val() ;
        if(optionName.length){
            oneOption = '<option value="'+index+'">'+optionName+'</option>'+oneOption;
        }
    });
    
    if(!oneOption.length){
        alert('Vous devez au moins mettre une option');
        return false;
    }else{
        return '<div class="col-md-8"><label>'+nomChamp+'</label><select class="col-12 custom-select">'+oneOption+'</select></div>';
    }
            
}

function customId() {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2, 9);
}
