//TEST
var form = $("#example-advanced-form").show();

//var steps = $('#configuration_bornes_form_id div.steps');
//$('.config_step').empty().appendTo(steps);

form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    autoFocus: true
});

//=====
var isEdit = $("#id_isEdit").val();
 isEnableAllSteps = false;
if(isEdit == 1){
    isEnableAllSteps = true;
}
var type_mise_en_page = $('input[type=radio][name=type_mise_en_page_id]:checked').val();
var evenement_id = $('#evenement-id').val();
var is_cancel = 0;
var is_retour_possible = 0;


var form = $("#configuration_bornes_form_id").show();
 
 form.steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    titleTemplate: '<span class="step">#index#</span> #title#',
    enableAllSteps :isEnableAllSteps,
    enableKeyNavigation:false,
    labels: {
        previous : 'Précédent',
        next: 'Suivant',
        finish: "Annuler" //Enregistrer
    }, 
    onFinished: function (event, currentIndex)
    {
        //$("#configuration_bornes_form_id").submit();

        //== Revenir au premier step quand on annule  //=== Check if cancel last btn        
        if($('.actions ul li:last').attr('data-owner') == "is_cancel"){ 
            is_cancel = 1; // Bloque ajax set to true av retour au  etap 1
            is_retour_possible = 1; // set to true av retour au  etap 1
            $('.cf_progress_sauve').css('width', "0.1%" ); //revert progress bar
            $('.actions ul li:nth-of-type(3n+2) a').text('Suivant'); //revert btn continu
            $('.steps ul li:first a').click();//retour au etap 1

            alert("Enregistrement annulé.");

            // Revert etat initial apres quelques sec. 
            setTimeout(function () { 
                is_cancel = 0;console.log("Revert is_cancel to :"+is_cancel);
                is_retour_possible = 0;console.log("Revert is_retour_possible to :"+is_retour_possible);
            }, 11000);            
        }
    },
    onStepChanging: function (event, currentIndex, newIndex)
     {
		// Modif Paul 
		/*
		 * Skype Seb : Sébastien, 12:02 16-10-2019
		 * ID Event : 837
		 */
		type_mise_en_page = $('input[type=radio][name=type_mise_en_page_id]:checked').val();
		
        console.log('currentIndex : ' + currentIndex);
        console.log('newIndex : ' + newIndex);
        /*console.log('is_retour_possible : ' + is_retour_possible);*/

        if(newIndex == 6){ //5
            $('.actions ul li:nth-child(2) a').text('Enregistrer');
        } else {
            $('.actions ul li:nth-child(2) a').text('Suivant');
        }

        /*if(currentIndex == 6) {
            $(form).on('keyDown', function(event) {
                alert(eventObject.key);
                if(event.key == "ArrowRight"){
                    alert('Eq Save');
                    event.preventDefault();
                }
            });
        }*/

        //Cacher last step if
        if(newIndex != 7 && currentIndex != 7){ //6
            $('.steps ul li:last').css('display', 'none');
        }
        //retour first if is_retour_possible
        if(newIndex == 0 && currentIndex == 7 && is_retour_possible){ //6
            $('.steps ul li:last').css('display', 'none');
        }

        //On ne peut plus revenir en arriere quand on est sur le step enregistrer sauf annuler.
        if(currentIndex == 7 && newIndex < 7){ //6
            //alert('On ne peut plus revenir.');
            if(!is_retour_possible){
                return false;
            }
        }

        if(newIndex == 7){  //6         
            //Afficher dern etap : Enregistrement
            $('.steps ul li:last').css('display', 'inline');
            //Btn last 
            $('.actions ul li:last').attr('data-owner', 'is_cancel');
            //=== initialisation            
            $('.bloc_etape_sauve i').addClass('hide');
            $('.bloc_etape_sauve small').css('font-weight', '');
            $('.cf_progress_text_0').text("Enregistrement ...");
            $('.cf_progress_sauve').css('width', "0.1%" );
            
            var n1 = Math.floor(Math.random() * 20);
            console.log(n1);
            if(!is_cancel){
                
                //== Active etap 1
                $('.etape_sauve_conf_1 i.fa-spin').removeClass('hide');
                $('.etape_sauve_conf_1 small').css('font-weight', '700');

                setTimeout(function () {                
                    $('.cf_progress_sauve').css('width', n1+'%');
                    $('.cf_progress_text').text("");
                    $('.cf_progress_text').text(n1+' %');
                     //== Fin  etap 1
                    $('.etape_sauve_conf_1 i.fa-spin').addClass('hide');
                    $('.etape_sauve_conf_1 i.fa-check').removeClass('hide');
                    //== Active etap 2
                    $('.etape_sauve_conf_2 i.fa-spin').removeClass('hide');
                    $('.etape_sauve_conf_2 small').css('font-weight', '700');
                }, 3000);

                /*setTimeout(function () {                
                    $('.cf_progress_sauve').css('width', n1+'%');
                    $('.cf_progress_text').text("");
                    $('.cf_progress_text').text(n1+' %');
                }, 3500)*/

                var n2 = n1 + Math.floor(Math.random() * 45); 
                setTimeout(function () {                
                    $('.cf_progress_sauve').css('width', n2+'%');
                    $('.cf_progress_text').text("");
                    $('.cf_progress_text').text(n2+' %');                   
                     //== Fin etap 2
                    $('.etape_sauve_conf_2 i.fa-spin').addClass('hide');
                    $('.etape_sauve_conf_2 i.fa-check').removeClass('hide');                   
                    //== Active etap 3    
                    $('.etape_sauve_conf_3 i.fa-spin').removeClass('hide');
                    $('.etape_sauve_conf_3 small').css('font-weight', '700');
                }, 6000);

                /*var n3 = n2 + Math.floor(Math.random() * 60);           
                setTimeout(function () {                
                    $('.cf_progress_sauve').css('width', n3+'%');
                    $('.cf_progress_text').text("");
                    $('.cf_progress_text').text(n3+' %');                    
                  
                     //== Fin etap 3
                    //$('.etape_sauve_conf_3 i.fa-spin').addClass('hide');
                    //$('.etape_sauve_conf_3 i.fa-check').removeClass('hide');
                }, 9000);*/
            }

            var is_ajax = 1;
            //==== POST FORM AJAX
            var progression_count;
            var is_ajax = 1;
            var formData = $("#configuration_bornes_form_id")[0];
            //var formData = $("#configuration_bornes_form_id").serializeArray();
            //Set timeout 5 sec avant post
            setTimeout(function () {
                if(!is_cancel){
                    console.log("is_cancel : "+ is_cancel);
                    //Update btn dernier :data-owner  (remove is_cancel)
                    $('.actions ul li:last').attr('data-owner', 'is_finished');
                    $('.actions ul li:last a').text('Ok');
                    $('.actions ul li:last a').addClass('hide');

                    $.ajax({
                        type: 'POST',
                        url: baseUrl + 'configurationBornes/add/'+evenement_id+'/'+is_ajax,
                        data: new FormData( formData ),
                        processData: false,
                        contentType: false,
                        //dataType: "json",
                        //timeout: 15000,
                        beforeSend: function( XMLHttpRequest ) {
                        },
                        xhr: function () {
                            var myXhr = $.ajaxSettings.xhr();
                            if (myXhr.upload) {
                                // For handling the progress of the upload
                                myXhr.upload.addEventListener('progress', function (e) {
                                    //console.log(e);
                                    if (e.lengthComputable) {
                                        progression_count = e.loaded / e.total * 100;
                                        console.log(progression_count + '%');
                                        $('.cf_progress_sauve').css('width', progression_count + "%" );
                                        $('.cf_progress_text').text(progression_count+ '%');
                                    }
                                }, false);
                            }
                            return myXhr;
                        },
                        success: function(data) {   
                            data = jQuery.parseJSON(data);
                            console.log(data);
                            if(data.success && progression_count == 100){
                                //== Fin etap 3
                               $('.etape_sauve_conf_3 i.fa-spin').addClass('hide');
                               $('.etape_sauve_conf_3 i.fa-check').removeClass('hide');
                               
                                $('.cf_progress_text_0').text("");
                                $('.cf_progress_text_0').append('<i class="fa fa-check-circle"></i>  Enregistrement reussi.');
                    
                                //alert('La configuration a été enregistrée.');
                                var alert_flash = '<div class="alert alert-success" onclick="this.classList.add('+'hidden'+')">La configuration a été enregistrée.</div>';
                                $(alert_flash).insertAfter('.page-content #id_theSousMenu');
                                setTimeout(function () {location.reload(true);}, 3000);
                                //location.reload(true);
                            } else {
                                $('.cf_progress_text_0').text("");
                                $('.cf_progress_text_0').append('<i class="fa fa-times"></i>  Echec de l\'enregistrement.');
                                //alert('La configuration n\'a pas pu être enregistrée. Veuillez réessayer.');
                                is_retour_possible = 1;
                                //Update btn dernier :data-owner  (revert to is_cancel)
                                $('.actions ul li:last').attr('data-owner', 'is_cancel');
                                $('.actions ul li:last a').text('Annuler');
                                $('.actions ul li:last a').removeClass('hide');                                

                                var alert_flash = '<div class="alert alert-danger" onclick="this.classList.add('+'hidden'+')">La configuration n\'a pas été enregistrée. Veuillez réessayer</div>';
                                $(alert_flash).insertAfter('.page-content #id_theSousMenu');
                                setTimeout(function () {  
                                    $('.page-content .alert').remove();
                                    $('.steps ul li:first a').click();//retour au etap 1
                                    $('.cf_progress_sauve').css('width', "0.1%" ); //revert progress bar
                                    $('.actions ul li:nth-of-type(3n+2) a').text('Suivant'); //revert btn continu
                                    $('.cf_progress_text_0').text("Enregistrement ...");
                                }, 3000);
                            }
                        },
                        error: function(jqXHR, textStatus){
                            console.log(textStatus);console.log(jqXHR.statusText);
                            alert(jqXHR.statusText+'. Veuillez réessayer.');
                            is_retour_possible = 1;                            
                            //Update btn dernier :data-owner  (revert to is_cancel)
                            $('.actions ul li:last').attr('data-owner', 'is_cancel');
                            $('.actions ul li:last a').text('Annuler');
                            $('.actions ul li:last a').removeClass('hide');  

                            $('.cf_progress_sauve').css('width', "0.1%" ); //revert progress bar
                            $('.actions ul li:nth-of-type(3n+2) a').text('Suivant'); //revert btn continu

                            $('.steps ul li:first a').click();//retour au etap 1
                            $('.cf_progress_text_0').text("Enregistrement ...");
                        }                
                    });
                } else {
                    console.log("is_cancel : "+ is_cancel);
                } 
            }, 10000);
        }

        /*if(newIndex == 1 && type_mise_en_page == 1){
            //alert(type_mise_en_page);
            var btn_next_choix_cat_cadre = '<li id="btn_choix_cat_cadre_to_choix_anim"><a href="#" role="">Suivant</a></li>';            
            setTimeout(function () {
                $('.actions ul li:nth-child(2)').css('display', 'none');
                $(btn_next_choix_cat_cadre).insertAfter($('.actions ul li:nth-child(2)'));
            }, 1000);
        }*/

        if(currentIndex == 0){            
            //alert(type_mise_en_page);
            if(type_mise_en_page != undefined ){
                return true;
            }else{
                alert("Vous devez choisir une mise en page");
                return false;
            }
        } else if(currentIndex == 1 && newIndex > 1 ){
            var type_anim_selected_list = $('.config_animation').find('.check_type_anim:checked');
            if(type_mise_en_page == 2 || type_mise_en_page == 3 ){//
                if(type_anim_selected_list.length){
                    return true;
                } else {
                    alert("Vous devez choisir une type animation");
                    return false;
                }
            } else 
            if(type_mise_en_page == 1){ // if type_mep 1, 4
                var cat_cadre_active =  $('.catalogue_cadre').find('.btn_active_catalogue_cadre.active');
                if(cat_cadre_active.length) {
                    return true;
                } else {
                    alert("Vous devez choisir un visuel");
                    return false;
                }
                
            } else {
                return true;
            }
        } else {
            return true;
        }
        
        /*if(currentIndex == 2){
                var dz_preview = $('.kl_blocDropzone').find('div.dz-preview div.dz-image img');
                if(dz_preview.length) {
                    $('.ecran_pg_choix_fv').removeClass('hide');
                } else {
                    $('.ecran_pg_choix_fv').removeClass('hide');
                }
        }*/

     },     
    onStepChanged: function (event, currentIndex, priorIndex) {
        var currentStep = form.steps("getStep", currentIndex);
        window.location.hash = "step"+(currentIndex+1);
    }
     /*onStepChanged: function (event, currentIndex, priorIndex)
     {
         // Used to skip the "Warning" step if the user is old enough.
         if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
         {
             form.steps("next");
         }
         // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
         if (currentIndex === 2 && priorIndex === 3)
         {
             form.steps("previous");
         }
     },
     onFinishing: function (event, currentIndex)
     {
         form.validate().settings.ignore = ":disabled";
         return form.valid();
     },
     onFinished: function (event, currentIndex)
     {
         alert("Submitted!");
     }*/
 });
 /*.validate({
     errorPlacement: function errorPlacement(error, element) { element.before(error); },
     rules: {
         confirm: {
             equalTo: "#password-2"
         }
     }
 });*/