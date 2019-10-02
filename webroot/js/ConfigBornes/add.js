Dropzone.autoDiscover = false;
var baseUrl ;
$(document).ready(function(){
     baseUrl = $("#id_baseUrl").val();
     $('[data-toggle="tooltip"]').tooltip();
      
     $(".select2").select2();
    
    $('.dropify_cadre, .dropify_fond_verts, .dropify_fond_page_accueil, .dropify_btn_page_accueil, .dropify_fond_page_prise_photo').dropify({
        messages: {
            default: 'Glissez-déposez votre cadre ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });

    //==== TYPE MISE EN PAGE

    if($('input[type=radio][name=type_mise_en_page_id]:checked').val() == 1){
        $('.catalogue_cadre').removeClass('hide');
        $('.config_animation').addClass('hide');
    } else {
        $('.catalogue_cadre').addClass('hide');
        $('.config_animation').removeClass('hide');
    }
    if($('input[type=radio][name=type_mise_en_page_id]:checked').val() == 4){
        $('.cf_cadre').addClass('hide');
    } else {
        $('.cf_cadre').removeClass('hide');
    }

   $('input[type=radio][name=type_mise_en_page_id]').change(function() {
        if (this.value == 1) { // || this.value == 3
            $('.catalogue_cadre').removeClass('hide');
            $('.config_animation').addClass('hide');
        } else { 
            $('.catalogue_cadre').addClass('hide');
            $('.config_animation').removeClass('hide');
        }

        if($(this).val() == 4){
            $('.cf_cadre').addClass('hide');
        } else {
            $('.cf_cadre').removeClass('hide');
        }
    });

    // DISABLE INPUT    
    /*$('#id_cf_anim_carte_postale_paysage').find('input, select, radio, checkbox').attr("disabled", true);
    $('#id_cf_anim_carte_postale_portrait').find('input, select, radio, checkbox').attr("disabled", true);
    $('#id_cf_anim_marque_page').find('input, select, radio, checkbox').attr("disabled", true);
    $('#id_cf_anim_palaroid').find('input, select, radio, checkbox').attr("disabled", true);
    $('#id_cf_anim_multishoot').find('input, select, radio, checkbox').attr("disabled", true);*/

    //CHECK TYPE ANIMATION 
    //MODE EDITION
    var type_animations_ids_selected = [];   
    var type_anim_selected_list = $('.config_animation').find('.check_type_anim:checked');
    if(type_anim_selected_list.length > 1) $('.cf_anim_tab').removeClass('hide');
    $.each(type_anim_selected_list, function (index, elem) {
        var input = $(elem);
        var id = input.attr('id');
        var id_type_animation =  id.split('_')[2];
        if(id_type_animation !== undefined) type_animations_ids_selected.push(id_type_animation);
        console.log('id_type_animation : '+id_type_animation);            
    }); 
    //alert(type_animations_ids_selected);
    //console.log('LISTES : '+type_animations_ids_selected);
    for( var i = 1; i <= 5; i++){
        //if in list
        var active_tab = false;
        if(jQuery.inArray(i+"", type_animations_ids_selected) !== -1) {
            var key = type_animations_ids_selected.indexOf(i+"");
            $('li.cf_anim_tab_'+i).removeClass('hide');
            //$('li.cf_anim_tab_'+i+' span.num_tab').text(key + 1);
            console.log('key : '+key);
            if(key == 0){
                //alert(i);
                $('li.cf_anim_tab_'+i+' a').addClass('active show');
                $('div.cf_anim_tab_content_'+i).addClass('active show');
                console.log('cf_anim_tab_'+i);
            }
        } else {              
            $('div.cf_option_tab_anim ul.cf_anim_tab li.cf_anim_tab_'+i).addClass('hide');
        }
    }
    
    //=== && Update num tab
    var tabs_final_selected = $('.cf_option_tab_anim').find('.cf_anim_tab li:not(.hide)');        
    $.each(tabs_final_selected, function (index, elem) {
        var input = $(elem);
            //=== Update num tab
           var num_tab =  input.find('span.num_tab');
           num_tab.text(index + 1);          
    });

    // CHECK ANIMATION
    // MODE SELECTION 
   /* $('.sf-bg-animation').click(function() {

        var type_animations_ids_selected = [];        
        var type_anim_selected_list = $('.config_animation').find('.check_type_anim:checked');
        //console.log(type_anim_selected_list.length);

        $.each(type_anim_selected_list, function (index, elem) {
            var input = $(elem);
            var id = input.attr('id');
            var id_type_animation =  id.split('_')[2];
            if(id_type_animation !== undefined) type_animations_ids_selected.push(id_type_animation);
            console.log('id_type_animation : '+id_type_animation);            
        });        
        
        var current_checked = $(this).find('input[type=checkbox]').attr("id");
        var current_checked =  current_checked.split('_')[2]; 
        if($(this).hasClass('active')){
            for( var i = 0; i < type_animations_ids_selected.length; i++){ 
                if ( type_animations_ids_selected[i] === current_checked) {
                    type_animations_ids_selected.splice(i, 1);
                }
             }			
		}else{	
            if(jQuery.inArray(current_checked, type_animations_ids_selected) == -1) type_animations_ids_selected.push(current_checked);
        }        
        //console.log('LISTES : '+type_animations_ids_selected);
        
        //== gestion affichage tab selected
        $('ul.cf_anim_tab li.nav-item a').removeClass('active show');
        $('div.cf_anim_content div.tab-pane').removeClass('active show');
        for( var i = 1; i <= 5; i++){
            //if in list
            if(jQuery.inArray(i+"", type_animations_ids_selected) !== -1) {
                var key = type_animations_ids_selected.indexOf(i+"");
                $('li.cf_anim_tab_'+i).removeClass('hide'); 
                //$('li.cf_anim_tab_'+i+' span.num_tab').text(key + 1);
                //console.log('key : '+key);
                if(key == 0){
                    $('li.cf_anim_tab_'+i+' a').addClass('active show');
                    $('div.cf_anim_tab_content_'+i).addClass('active show');
                }
            } else {              
                $('div.cf_option_tab_anim ul.cf_anim_tab li.cf_anim_tab_'+i).addClass('hide');
            }
        }

        //=== && Update num tab
        var tabs_final_selected = $('.cf_option_tab_anim').find('.cf_anim_tab li:not(.hide)');        
        $.each(tabs_final_selected, function (index, elem) {
            var input = $(elem);
                //=== Update num tab
               var num_tab =  input.find('span.num_tab');
               num_tab.text(index + 1);             
        });
    }); */
    
    //==== AJOUT ONGLET
    $('#id_add_anim').find('input:not(input[type=file]), select, radio, checkbox').attr("disabled", true);
    $('.btn_ajout_autre_cadre').on('click', function () {
        $('#id_add_anim').find('input, select, radio, checkbox').attr("disabled", false);// active champs        

        $('.cf_anim_tab').removeClass('hide');
        $('.add_animation').removeClass('hide');
        $('.add_animation a').click();

        var type_animations = [];
        type_animations["1"] =  'Carte postale paysage';
        type_animations["2"] =  'Carte postale portrait';
        type_animations["3"] =  'Marque-Page';
        type_animations["4"] =  'Polaroid';
        type_animations["5"] =  'Carte postale multishoot';
        //console.log(type_animations);

        var type_animation_selected = [];
        var tabs_selected = $('ul.cf_anim_tab').find('li:not(.hide)');        
        $.each(tabs_selected, function (index, elem) {
            var tab = $(elem);
            if(tab.attr('data-owner') != ""){
                type_animation_selected.push(tab.attr('data-owner'));
            }
        });

        $("#id_nouv_choix_type_anim").empty();
        
        //$("#id_nouv_choix_type_anim").append("<option value='0' selected='selected'>Séléctionner</option>");
        for(var i =1; i < type_animations.length; i++){
            //not in array
            if(jQuery.inArray(i+"", type_animation_selected) == -1) {
                console.log(i);
                $("#id_nouv_choix_type_anim").append("<option value='"+i+"'>"+type_animations[i]+"</option>");
            }
        }
        console.log(type_animation_selected);
        $('#id_nouv_choix_type_anim').change();

    });
    
    //$("#id_nouv_choix_type_anim > [value=1]").attr("selected", "true");
    //=== id_nouv_choix_type_anim
    $('#id_nouv_choix_type_anim').change( function(){
        //=== 
        var type_anim = $(this).val();
        //=== Active/Desactive champ
        $('.bloc_ajout_overlay').removeClass('hide');
        $('.cf_nbr_pose').addClass('hide');
         //NBR POSES        
         $('#add_animation #id_nbrDePose_marque_pg_2, #add_animation .kl_oneDispostionBandelette').addClass('hide');
         $('#add_animation #id_nbrDePose_multishoot_2, #add_animation .kl_oneDispostionMultipose').addClass('hide');
         
        if(type_anim == 1){
            $('#id_cf_anim_carte_postale_paysage').find('input, select, radio, checkbox').attr("disabled", true);
        } else
        if(type_anim == 2){
            $('#id_cf_anim_carte_postale_portrait').find('input, select, radio, checkbox').attr("disabled", true);
        } else
        if(type_anim == 3){
            $('#id_cf_anim_marque_page').find('input, select, radio, checkbox').attr("disabled", true);
            $('.bloc_ajout_overlay').addClass('hide');
            // NBR POSE            
            $('.cf_nbr_pose').removeClass('hide');
            $('#add_animation #id_nbrDePose_marque_pg_2, #add_animation .kl_oneDispostionBandelette').removeClass('hide');
            $('#add_animation #id_nbrDePose_multishoot_2, #add_animation .kl_oneDispostionMultipose').addClass('hide');
        } else
        if(type_anim == 4){
            $('#id_cf_anim_palaroid').find('input, select, radio, checkbox').attr("disabled", true);
        } else
        if(type_anim == 5){
            $('#id_cf_anim_multishoot').find('input, select, radio, checkbox').attr("disabled", true);
            //NBR POSE
            $('.cf_nbr_pose').removeClass('hide');
            $('#add_animation #id_nbrDePose_marque_pg_2, #add_animation .kl_oneDispostionBandelette').addClass('hide');
            $('#add_animation #id_nbrDePose_multishoot_2, #add_animation .kl_oneDispostionMultipose').removeClass('hide');
        }
        
        var lists = ['Carte postale paysage','Carte postale portrait', 'Marque-Page','Polaroid ','Carte postale multishoot'];
        var taille_img =  ['60px', '37px', '39px', '37px', '60px'];
        //alert(type_anim);
        $('.cf_anim_tab_6 img.img_anim').attr('src', '/img/confbornes/animations/animation-'+type_anim+'.png');
        $('.cf_anim_tab_6 img.img_anim').attr('width', taille_img[type_anim - 1]);
        $('#titre_anim_tab').text(lists[type_anim - 1]);

        //$('.cf_anim_tab_6 .icon_check_tab').addClass('hide');
        if(type_anim == 3 || type_anim == 4  || type_anim == 2){
            $('.cf_anim_tab_6 .icon_check_tab').css('position', 'relative');
            $('.cf_anim_tab_6 .icon_check_tab').css('top', '11px');
            $('.cf_anim_tab_6 .icon_check_tab').css('left', '-38px');
        } else {            
            $('.cf_anim_tab_6 .icon_check_tab').css('position', 'relative');
            $('.cf_anim_tab_6 .icon_check_tab').css('top', '11px');
            $('.cf_anim_tab_6 .icon_check_tab').css('left', '-62px');
        }
        
        //==== Update name input
        var list_inputs = $('#add_animation').find('input');
        $.each(list_inputs, function (index, elem) {
            var input = $(elem);
            var set_name;
            console.log(type_anim);
            if(type_anim != 0){
                if(input.hasClass('input_type_animation_config')){
                    set_name = 'configuration_animations['+type_anim+'][type_animation_id]';
                    input.attr('name', set_name);
                    input.val(type_anim);
                }
                if(input.hasClass('input_type_cadre')){
                    set_name = 'configuration_animations['+type_anim+'][type_cadre]';
                    input.attr('name', set_name);
                    input.val('');
                    if(type_anim == "1"){  
                        input.val('0'); 
                    } 
                    if(type_anim == "2"){ 
                        input.val('1');
                    }
                }            
                if(input.hasClass('input_cadre_file')){
                    set_name = 'configuration_animations['+type_anim+'][cadre_file][]';
                    input.attr('name', set_name);
                }            
                if(input.hasClass('input_file_overlay')){
                    set_name = 'configuration_animations['+type_anim+'][cadres][0][file_overlay]';
                    input.attr('name', set_name);
                }
            } else {
                input.attr('name', "");
                input.val("");
            }
        });
    });

    //== SUPPR ONGLET type animation
    $(document).on('click', '.btn_suppr_cadre', function () {
        var type_anim = $(this).attr('data-typeanimation');
        //alert(type_anim);        
        if(confirm("Voulez-vous supprimer ?")) {
            if(type_anim != "0") { // nouv vide
                var typeanim_to_delete = '<input type="hidden" name="typeanim_to_delete[]" value="'+type_anim+'">';
                $('.cf_anim_tab').append(typeanim_to_delete);
                //== Hide and desactive 
                $('.cf_anim_tab_'+type_anim).addClass('hide');
                $('.cf_anim_tab_'+type_anim+' a').removeClass('active show');
                $('div.cf_anim_tab_content_'+type_anim).removeClass('active show').addClass('hide');                
            } else {
                $('.cf_anim_tab_6').addClass('hide');
                $('.cf_anim_tab_content_6, .cf_anim_tab_6 a').removeClass('active show');
                $('.add_animation').addClass('hide');
                $('#id_add_anim').find('input, select, radio, checkbox').attr("disabled", true);
            }
            //== Active tab first        
            var tab_first_id = $('ul.cf_anim_tab li:not(.hide):first').attr('data-owner');
            $('.cf_anim_tab_'+tab_first_id+' a' ).addClass('active show');
            $('div.cf_anim_tab_content_'+tab_first_id).addClass('active show');
        }
    });

    //=== Gestion bloc commun
    /*$('.cf_option_tab_anim li.nav-item').click(function() {
        var id =  $(this).attr('id');
        var numero_onglet = $(this).find('span.num_tab').text();
        //alert(numero_onglet);
        if(numero_onglet === "1") {
            $('div.cf_anim_content .cf_prise').removeClass('hide');
            $('div.cf_anim_content .cf_filtre').removeClass('hide');
            $('div.cf_anim_content .cf_fond_vert').removeClass('hide');
        } else {
            $('div.cf_anim_content .cf_prise').addClass('hide');
            $('div.cf_anim_content .cf_filtre').addClass('hide');
            $('div.cf_anim_content .cf_fond_vert').addClass('hide');
        }
    });*/
    //=== IS COORDONNES

    if($('input[type=radio][name=is_prise_coordonnee]:checked').val() == 1){
        $('.kl_champs').removeClass('hide');
    } else {
        $('.kl_champs').addClass('hide');
    }

   $('input[type=radio][name=is_prise_coordonnee]').change(function() {
        if (this.value == 1) {
            $('.kl_champs').removeClass('hide');
        } else {
            $('.kl_champs').addClass('hide');
        }
    });

     //=== FILTRE
     var filtres_selected_list = $('.cf_filtre_couleur').find('input:checked');
    if(filtres_selected_list.length) {
        //alert(filtres_selected_list.length);
        $('.ecran_pg_filtre').removeClass('hide');
    } else {
        $('.ecran_pg_filtre').addClass('hide');
    }
   $('input.cf_filtres').click(function() {
    var filtres_selected_list = $('.cf_filtre_couleur').find('input:checked');
        if(filtres_selected_list.length) {
            //alert(filtres_selected_list.length);
            $('.ecran_pg_filtre').removeClass('hide');
        } else {
            $('.ecran_pg_filtre').addClass('hide');
        }
    });

    //=== IS INCRUSTATIONS FOND VERT
     
    /*var dz_preview = $('.kl_blocDropzone').find('div.dz-preview div.dz-image img');
    alert(dz_preview.length);*/
    if($('input[type=radio][name=is_incrustation_fond_vert]:checked').val() == 1){
        $('.cf_images_fond_vert').removeClass('hide');
        $('.ecran_pg_choix_fv').removeClass('hide');
    } else {
        $('.cf_images_fond_vert').addClass('hide');
    }

   $('input[type=radio][name=is_incrustation_fond_vert]').change(function() {
      
        if (this.value == 1) {
            $('.cf_images_fond_vert').removeClass('hide');
            $('.ecran_pg_choix_fv').removeClass('hide');
        } else { 
            $('.cf_images_fond_vert').addClass('hide');
            $('.ecran_pg_choix_fv').addClass('hide');
        }
    });

    //cf_impression
    
    if($('input[type=radio][name=is_impression]:checked').val() == 1){
        $('.cf_impression').removeClass('hide');
    } else {
        $('.cf_impression').addClass('hide');
    }

   $('input[type=radio][name=is_impression]').change(function() {
        if (this.value == 1) {
            $('.cf_impression').removeClass('hide');
        } else {
            $('.cf_impression').addClass('hide');
        }
    });

    //Activ nbrMaxMultiImpression
    
    if($('input[type=radio][name=is_multi_impression]:checked').val() == 1){
        $('#id_nbrMaxMultiImpression').removeClass('hide');
    } else {
        $('#id_nbrMaxMultiImpression').addClass('hide');
    }

   $('input[type=radio][name=is_multi_impression]').change(function() {
        if (this.value == 1) {
            $('#id_nbrMaxMultiImpression').removeClass('hide');
        } else {
            $('#id_nbrMaxMultiImpression').addClass('hide');
        }
    });

    //Activ desc nbr max photo
    
    if($('input[type=radio][name=has_limite_impression]:checked').val() == 1){
        $('#id_nbrMaxPhoto').removeClass('hide');
    } else {
        $('#id_nbrMaxPhoto').addClass('hide');
    }

   $('input[type=radio][name=has_limite_impression]').change(function() {
        if (this.value == 1) {
            $('#id_nbrMaxPhoto').removeClass('hide');
        } else {
            $('#id_nbrMaxPhoto').addClass('hide');
        }
    });

    //Activ desc nbr impression auto
    
    if($('input[type=radio][name=is_impression_auto]:checked').val() == 1){
        $('.nbr_copie_impr_auto').removeClass('hide');
    } else {
        $('.nbr_copie_impr_auto').addClass('hide');
    }

   $('input[type=radio][name=is_impression_auto]').change(function() {
        if (this.value == 1) {
            $('.nbr_copie_impr_auto').removeClass('hide');
        } else {
            $('.nbr_copie_impr_auto').addClass('hide');
        }
    });

    //=== MULTISHOOT NBR POSE & DISPOSITION 
    $("#id_nbrDePose_multishoot").change(function(){
        $(".kl_listeDispositionVignette").removeClass('hide');
        $(".kl_listeDispositionVignette .kl_oneDispostionMultipose").addClass('hide');
        var nbrPose = $(this).val();
        //console.log("kl_dispositionVignette_"+nbrPose+"_pourAnimation_"); 
        
        if(nbrPose == 4) {
            $(".kl_labelCustom").addClass('hide');  
        } else {
            $(".kl_labelCustom").removeClass('hide');
        }    
        
        $(".kl_listeDispositionVignette  .kl_dispositionVignette_"+nbrPose+"_pourAnimation_5").removeClass('hide');
        $("#id_dispositionvignetteMuliposeValue").val("");
    });
    //=== MRQUE PAGE NBR POSE & DISPOSITION 
    $("#id_nbrDePose_marque_pg").change(function(){
        $("#id_dispositionVignetteBandelette, .kl_listeDispositionVignette").removeClass('hide');
        $(".kl_listeDispositionVignette  .kl_oneDispostionBandelette").addClass('hide');
        var nbrPose = $(this).val();
        //alert('.kl_dispositionVignette_'+nbrPose+'_pourAnimation_3');
        if(nbrPose == 4) {
            $(".kl_labelCustom").addClass('hide');  
        } else {
            $(".kl_labelCustom").removeClass('hide');
        } 
        
        $(".kl_listeDispositionVignette  .kl_dispositionVignette_"+nbrPose+"_pourAnimation_3").removeClass('hide');
        $("#id_dispositionvignetteBandeletteValue").val("");
    });  
    
    //
    $("#id_nbrDePose_multishoot_2").change(function(){
        $(".kl_listeDispositionVignette_2").removeClass('hide');
        $(".kl_listeDispositionVignette_2 .kl_oneDispostionMultipose_2").addClass('hide');
        $(".kl_listeDispositionVignette_2 .kl_oneDispostionBandelette_2").addClass('hide');//hide marque page
        var nbrPose = $(this).val();
        //console.log("kl_dispositionVignette_"+nbrPose+"_pourAnimation_"); 
        
        if(nbrPose == 4) {
            $(".kl_labelCustom").addClass('hide');  
        } else {
            $(".kl_labelCustom").removeClass('hide');
        }    
        
        console.log(".kl_dispositionVignette_"+nbrPose+"_pourAnimation_5");
        $(".kl_listeDispositionVignette_2 .kl_dispositionVignette_"+nbrPose+"_pourAnimation_5").removeClass('hide');
        $("#id_dispositionvignetteMuliposeValue").val("");
    });  
    
    $("#id_nbrDePose_marque_pg_2").change(function(){
        $(".kl_listeDispositionVignette_2").removeClass('hide');
        $(".kl_listeDispositionVignette_2 .kl_oneDispostionBandelette_2").addClass('hide');
        $(".kl_listeDispositionVignette_2 .kl_oneDispostionMultipose_2").addClass('hide'); //hide multipose
        var nbrPose = $(this).val();
        //alert('.kl_dispositionVignette_'+nbrPose+'_pourAnimation_3');
        if(nbrPose == 4) {
            $(".kl_labelCustom").addClass('hide');
        } else {
            $(".kl_labelCustom").removeClass('hide');
        } 
        
        $(".kl_listeDispositionVignette_2 .kl_dispositionVignette_"+nbrPose+"_pourAnimation_3").removeClass('hide');
        $("#id_dispositionvignetteBandeletteValue").val("");
    }); 
    
     $(".kl_oneDispostion").click(function(){
        var idSelected = $(this).attr('data-key');
        var animationId = $(this).attr('data-animation');
        
        $(".kl_oneDispostion").removeClass('selected');
        $(this).addClass('selected');
        $('#id_dispositionvignette_'+animationId).val(idSelected);
        console.log("#id_dispositionvignette_"+animationId);
    });

    //==== Edition Img Fond vert    
    var isEdit = $("#id_isEdit").val();
    if(isEdit == 1){
        $(window).on('load', function() {
        //$('.bloc_edit_img_fv').insertAfter($('.cf_blocDropzone'));
        var img_fv_list = $('.bloc_edit_img_fv').find('div.img_fv_edit');
            $.each(img_fv_list, function (index, elem) {
                var div = $(elem);         
                var id_elem =    $(elem).attr('id');
                //console.log($('#'+id_elem));
                $('#'+id_elem).insertAfter($('.kl_blocDropzone .dz-default'));    
            });
        });
    }
    //=== Suppr image fv
    $(".cf_delete_img_fv").click(function () {
        var idTodelete = $(this).attr('id').split('_')[3]; //alert(idTodelete);
        if(idTodelete){
            var cf = confirm('Voulez-vous vouloir supprimer ?');
            if(cf){
                var theInput = '<input type="checkbox" name="imgFvToDelete[]" value="' + idTodelete + '" checked />';
                $(".kl_listeFvToDelete").append(theInput);
                $("#img_fv_" + idTodelete).hide();
            }
        }
    });


    //==== Ecran    
    //Page accueil

	/*
    if($('#id_choix_fond_page_accueil').val() == 1){
        $('#id_page_accueil_image_fond').removeClass('hide');
        $('#id_page_accueil_couleur_fond').addClass('hide');
    }

    $('#id_choix_fond_page_accueil').change(function(){
        if($(this).val() == 1){
            $('#id_page_accueil_image_fond').removeClass('hide');
            $('#id_page_accueil_couleur_fond').addClass('hide');
        } else { 
            $('#id_page_accueil_image_fond').addClass('hide');
            $('#id_page_accueil_couleur_fond').removeClass('hide');
        }
    });

    if($('#id_choix_btn_page_accueil').val() == 1){
        $('#id_page_accueil_image_btn').removeClass('hide');
        $('#id_page_accueil_couleur_btn').addClass('hide');
    }

    $('#id_choix_btn_page_accueil').change(function(){
        if($(this).val() == 1){
            $('#id_page_accueil_image_btn').removeClass('hide');
            $('#id_page_accueil_couleur_btn').addClass('hide');
        } else { 
            $('#id_page_accueil_image_btn').addClass('hide');
            $('#id_page_accueil_couleur_btn').removeClass('hide');
        }
    });

    //Page Prise photos

    if($('#id_choix_fond_page_prise_photo').val() == 1){
        $('#id_page_prise_photos_image_fond').removeClass('hide');
        $('#id_page_prise_photos_couleur_fond').addClass('hide');
    }

    $('#id_choix_fond_page_prise_photo').change(function(){
        if($(this).val() == 1){
            $('#id_page_prise_photos_image_fond').removeClass('hide');
            $('#id_page_prise_photos_couleur_fond').addClass('hide');
        } else { 
            $('#id_page_prise_photos_image_fond').addClass('hide');
            $('#id_page_prise_photos_couleur_fond').removeClass('hide');
        }
    });
	*/

    /*var isEdit = $("#id_isEdit").val();
    if(isEdit == 1){
        $(".kl_blocDropzone .dz-default.dz-message").append($('.kl_oneImgeToDelete'));
    }*/

    //=== Upload fond vert
    var evenement_id = $('#evenement-id').val();
    var myDropzone = new Dropzone("div#dropzone_fond_vert", { //id_images_fond_vert
    //$("div#id_images_fond_vert").dropzone({
        url: baseUrl + 'configurationBornes/uploadImagesFondVerts/'+evenement_id,
        paramName: "file",
        addRemoveLinks : true,
        acceptedFiles : ".jpg, .JPG",
        thumbnailWidth: null,
        thumbnailHeight: null,
        //maxFiles: 1,
        //uploadMultiple: true,
        dictDefaultMessage : "Glissez ou cliquez ici pour ajouter",
        init: function() {
            this.on('addedfile', function (file) {
                //alert('init');
                /*if (this.files.length > 2) {
                 this.removeFile(this.files[0]);
                 }
                var maxsize = 25 * 1024 * 1024;
                if (file.size > maxsize) {
                    this.removeFile(file);
                    alert('Fichier trop gros. Veuillez réessayer.');
                //}*/
            });

            this.on('removedfile', function (file) {
                this.removeFile(this.file);
            });
        },

        success: function (file, reponse) {
            console.log('image uploaded');
            console.log(reponse);
            //alert(reponse);
            var obj = jQuery.parseJSON(reponse);
            if (obj.success) {
                var nameFile = obj.name;
                var nameInput = '<input type="hidden" class="" value="' + nameFile + '" name="image_fond_verts_files[]" />';
                $(".dz-preview:last-child").append(nameInput);
            } else {
                this.removeFile(file);
                alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
            }
        },

        accept: function (file, done) {
            done();
        },

        dictRemoveFile: "Supprimer",
        dictCancelUpload: "Annuler",
        //dictDefaultMessage: "<span class='kl_parcourir'>Ajouter une image</span>"
        dictDefaultMessage: "<div class='cf_blocDropzone' id=''>"+
                            "<p><i class='mdi mdi-cloud-upload fa-3x'></i><br>"+
                                "Glissez ou cliquez ici pour ajouter </p>"+
                            "</div>"
        //dictDefaultMessage: "<p>Glissez ou cliquez ici pour ajouter </p>"
    });

    //==== Duplication cadre
    
    /*$('.btn_ajout_autre_cadre').on('click', function () {
        var id_type_anim = $(this).attr('data-owner');
        var type_animation = $(this).attr('data-typeanimation');
        console.log(type_animation);
       
        //var clone = $("[id ^='bloc_cadre_anim']:last").clone();
        var clone = $("div#"+type_animation+" [id ^='bloc_cadre_anim']:last").clone();
        //console.log(clone);return;
        //=== 
        //var idLast = $("[id ^='bloc_cadre_anim']:last").attr('id');
        var idLast = $("div#"+type_animation+" [id ^='bloc_cadre_anim']:last").attr('id');
        //console.log(idLast);return;
        var idLast = idLast.split('_');
        var numNouv = parseInt(idLast[3]) + 1;
        $(clone).find('.btn_suppr_cadre').attr('id', "btn_suppr_cadre_" + numNouv);
        $(clone).find('.btn_suppr_cadre').attr('data-owner', '');

        clone.find('.bloc_file').remove();
        clone.find('.btn_ajout_autre_cadre').remove();
        clone.find('.label-overlay-pers').remove(); 
        clone.find('.kl_cadre_overlay-pers img').remove();

        $(clone).attr('id', "bloc_cadre_anim_" + (numNouv));
        $(clone).attr('style', 'margin-top: 10px;');
        clone.insertAfter("div#"+type_animation+"  .bloc_cadre_anim:last");
        //$('html,body').animate({scrollTop: $(eltClone).offset().top}, 1000);
        
        var inputFileNouv = 
        '<div class="col-md-4 bloc_file">  '+
                '<input type="file" name="configuration_animations['+id_type_anim+'][cadre_file][]"  id=""  class="dropify_cadre" data-allowed-file-extensions="png" >'+
        '</div>';
        $(inputFileNouv).insertBefore(clone.find(".bloc_ajout_overlay"));
        $('.dropify_cadre').dropify();

        if(id_type_anim != 3) {
            var labelOverlay = 
            '<div class="label-overlay-pers">'+
                '<label class="custom-control custom-checkbox">'+
                    '<input type="checkbox" class="kl_cadre_check-pers custom-control-input">'+
                    '<span class="custom-control-label"> Ajouter un overlay</span>'+
                '</label>'+
                '<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Importer overlay</button><br>'+
                '<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>'+
                
                '<input type="file" class="fichier_overlay-pers hide" accept="image/png">'+
                '<input type="hidden" class="cadre-overlay-pers file_overlay-pers" value="" name="configuration_animations['+id_type_anim+'][cadres][][file_overlay]">'+        
                '<input type="file" class="fichier-pers hide" accept="image/gif, image/jpeg, image/png">'+
            '</div>';
            $(labelOverlay).appendTo(clone.find(".bloc_ajout_overlay"));
        }
    });*/

     //==== suppression Cadre
    /*$(document).on('click', '.btn_suppr_cadre', function () {
        var id_bloc = $(this).attr('id');
        var id_cadre = $(this).attr('data-owner');
        //console.log(id_bloc);
        var ord_bloc  = id_bloc.split('_')[3]; 
        if(confirm("Are you want to delete ?")) {
            if(id_cadre !== undefined && id_cadre !== "") {
                console.log("Bloc : "+id_bloc + "Id : "+id_cadre);
                $("#cadre_to_delete_" + ord_bloc).val(id_cadre);
                $("#bloc_cadre_anim_" + ord_bloc).hide("blind");
                $("#bloc_cadre_anim_" + ord_bloc).remove();
            }  else {
                console.log("Bloc : "+id_bloc);
                $("#bloc_cadre_anim_" + ord_bloc).hide("blind");
                $("#bloc_cadre_anim_" + ord_bloc).remove();
            } 
        }
    });*/

    //CHOIX CATALOGUE DE MISE EN PAGE
    //===== ACtivation theme mise en page
    $('body').delegate('.btn_active_theme', 'click', function(){
        var obj = $(this);
        var id = obj.attr('id');
        id_cat = id.split('_')[3];
        console.log("this id:"+id_cat);
        
        var list_checks = $('.catalogue_ecran').find('.check_active_theme');
        $.each(list_checks, function (index, elem) {
            var check = $(elem);
            var id = check.attr('id').split('_')[1];
            if(id !== id_cat) {
                check.attr('checked', false);
                console.log("Autre check id:"+id);
            }
        });

        var list_btns =  $('.catalogue_ecran').find('.btn_active_theme');
        $.each(list_btns, function (index, elem) {
            var btn = $(elem);
            var id = btn.attr('id').split('_')[3];
            if(id !== id_cat) {
                if(btn.hasClass('active')){
                    btn.removeClass('active');
                    console.log("Desactive autre btn id:"+id);
                    btn.find('i').removeClass('fa-times');
                    btn.find('i').addClass('fa-check');
                    btn.text('');
                    btn.append('<i class="fa fa-check"></i> Activer ce thème');
                }
                //btn.find('i').removeClass('fa-check');
                //console.log("Autre btn id:"+id);
            }
        });

        if(obj.hasClass('active')){
            obj.removeClass('active');
            $('input#catalogue_'+id_cat).val("");
            $('input#catalogue_'+id_cat).attr("checked", false);
            $('.is_active_theme').val("0");
            //obj.find('i').removeClass('fa-times');
            //obj.find('i').addClass('fa-check');
            obj.text('');
            obj.append('<i class="fa fa-check"></i> Activer ce thème');

            //=== IF BTN IN POPUP
            if(obj.hasClass('btn_in_view')){
                //Moddif etat btn in list
                $('#btn_active_theme_'+id_cat).removeClass('active');
                $('#btn_active_theme_'+id_cat).text('');
                $('#btn_active_theme_'+id_cat).append('<i class="fa fa-check"></i> Activer ce thème');
            }
		}else{
			obj.addClass('active');
            $('#catalogue_'+id_cat).attr("checked", true);
            $('.is_active_theme').val("1");
            //obj.find('i').removeClass('fa-check');
            //obj.find('i').addClass('fa-times');
            obj.text('');
            obj.append('<i class="fa fa-times"></i> Desactiver ce thème');
            //obj.text('Desactiver ce theme');
             //=== IF BTN IN POPUP
            if(obj.hasClass('btn_in_view')){
                //Moddif etat btn in list
                $('#btn_active_theme_'+id_cat).addClass('active');
                $('#btn_active_theme_'+id_cat).text('');
                $('#btn_active_theme_'+id_cat).append('<i class="fa fa-times"></i> Desactiver ce thème');
            }
		}
    });


    //CHOIX CATALOGUE DE CADRE
    //===== ACtivation theme mise en page
    $('body').delegate('.btn_active_catalogue_cadre', 'click', function(){
        var obj = $(this);
        var id = obj.attr('id');
        id_cat = id.split('_')[3];
        console.log("this id:"+id_cat);
        
        var list_checks = $('.catalogue_cadre').find('.check_active_catCadre');
        $.each(list_checks, function (index, elem) {
            var check = $(elem);
            var id = check.attr('id').split('_')[1];
            if(id !== id_cat) {
                check.attr('checked', false);
                console.log("Autre check id:"+id);
            }
        });

        var list_btns =  $('.catalogue_cadre').find('.btn_active_catalogue_cadre');
        $.each(list_btns, function (index, elem) {
            var btn = $(elem);
            var id = btn.attr('id').split('_')[3];
            if(id !== id_cat) {
                if(btn.hasClass('active')){
                    btn.removeClass('active');
                    console.log("Desactive autre btn id:"+id);
                    btn.find('i').removeClass('fa-times');
                    btn.find('i').addClass('fa-check');
                    btn.text('');
                    btn.append('<i class="fa fa-check"></i> Choisir ce cadre');
                }
            }
        });

        if(obj.hasClass('active')){
            obj.removeClass('active');
            $('input#catalogueCadre_'+id_cat).val("");
            $('input#catalogueCadre_'+id_cat).attr("checked", false);
            $('.is_active_catalogueCadre').val("0");
            obj.text('');
            obj.append('<i class="fa fa-check"></i> Choisir ce cadre');
		}else{
			obj.addClass('active');
            $('#catalogueCadre_'+id_cat).attr("checked", true);
            $('.is_active_catalogueCadre').val("1");
            obj.text('');
            obj.append('<i class="fa fa-times"></i> Desactiver ce cadre');
		}
    });

    //====== RECHERCHE CATALOGUE MISE EN PAGE ECRANS
    
    //== Saisir text
    var val_init_input_key;
    $('#id_search_txt_cat').on('focusin', function(){
        val_init_input_key =  $(this).val();
    });

    var client_id = $('#client_id_cat').val();
    $('#id_search_txt_cat').on('focusout', function(){ //focusout
        var key = $(this).val();
        if(key !== val_init_input_key){
            var themes = [];
            var list_themes = $('body').find('.cat_theme:checked');
            $.each(list_themes, function (index, elem) {
                var val = $(elem).val();
                themes.push(parseInt(val));
            });
            themes = JSON.stringify(themes);
            themes = JSON.parse(themes);
            var datas = {};
            datas ['themes'] = themes;
            datas ['key'] = key;

            $.ajax({
                type: 'GET',
                url: baseUrl + 'configurationBornes/rechercheCatalogue/'+evenement_id+'/'+client_id,
                data: datas,
                //dataType: "json",
                timeout: 15000,
                beforeSend: function( xhr ) {
                    //debut
                    $('.bloc_loader').removeClass('hide');
                },
                success: function(data) {
                    $('#id_content_cat_mep').empty().html(data);
                    var count_cat = $('#count_cat').val();
                    $('#count_theme').text( count_cat +" "+(parseInt(count_cat) > 1 ? 'modèles': 'modèle'));
                    setMagnificPopup();    
                    $('.bloc_loader').addClass('hide');           
                },
                error: function(jqXHR, textStatus){
                    console.log(textStatus);
                }
            });
        }
    });

    //== Click theme Anniv, Mariage, Pro 
    $('.cat_theme').click(function(){    
        var themes = [];
        var list_themes = $('body').find('.cat_theme:checked');
        $.each(list_themes, function (index, elem) {
            var val = $(elem).val();
            themes.push(parseInt(val));
        });
        /*themes = JSON.stringify(themes);
        themes = JSON.parse(themes);*/
        var datas = {};
        datas ['themes'] = themes;
        var key =  $('#id_search_txt_cat').val();
        datas ['key'] = key;
                
        $.ajax({
            type: 'GET',
            url: baseUrl + 'configurationBornes/rechercheCatalogue/'+evenement_id+'/'+client_id,
            data: datas,
            //dataType: "json",
            timeout: 15000,
            beforeSend: function( xhr ) {
                //debut
                $('.bloc_loader').removeClass('hide');
            },
            success: function(data) {
                $('#id_content_cat_mep').empty().html(data);
                var count_cat = $('#count_cat').val();
                $('#count_theme').text( count_cat +" "+(parseInt(count_cat) > 1 ? 'modèles': 'modèle'));
                setMagnificPopup();
                $('.bloc_loader').addClass('hide');
            },
            error: function(jqXHR, textStatus){
                console.log(textStatus);
                $('.bloc_loader').addClass('hide');
            }                
        });
    });

    //=== RECHERCHE CATALOGUE CADRE
    //== Saisir text
    var val_init_input_key;
    $('#id_txt_search_cat_cadre').on('focusin', function(){
        val_init_input_key =  $(this).val();
    });

    $('#id_txt_search_cat_cadre').on('focusout', function(){ //focusout
        var key = $(this).val();
        //alert('');
        if(key !== val_init_input_key){
            ajaxRechercheCadre(evenement_id);  
        }
    });

    //== Click theme format
    $('.format_cat_cadre').click(function(){
        ajaxRechercheCadre(evenement_id);
    });

    //== Click nbr Pose
    $('.prise_photo_cat_cadre').click(function(){
        var val = $(this).val();
        console.log('.pose_'+val);
        $('.format_cat_cadre').css('display', 'none');
        var nbr_poses = $('body').find('.prise_photo_cat_cadre:checked');
        $.each(nbr_poses, function (index, elem) {
            var valeur = $(elem).val();
            $('.pose_'+valeur).css('display', 'inline');
        });
        ajaxRechercheCadre(evenement_id);
    });

    //== Change theme
    $('#id_theme_cat_cadre').change(function(){
        ajaxRechercheCadre(evenement_id);        
    });

    function ajaxRechercheCadre(evenement_id){
        //get txt key
        var key = $('#id_txt_search_cat_cadre').val();
         //get format
         var formats = [];
         var list_formats = $('body').find('.format_cat_cadre:checked');
         $.each(list_formats, function (index, elem) {
             var val = $(elem).val();
             formats.push(parseInt(val));
         });
         //get nbr Pose
         var nbrPoses = [];
         var list_nbr_poses = $('body').find('.prise_photo_cat_cadre:checked');
         $.each(list_nbr_poses, function (index, elem) {
             var val = $(elem).val();
             nbrPoses.push(parseInt(val));
         });
         //get theme
         var theme = $('#id_theme_cat_cadre').val();
         var datas = {};
         datas ['formats'] = formats;
         datas ['nbrPoses'] = nbrPoses;
         datas ['theme'] = theme;
         datas ['key'] = key;
         console.log(datas);

        $.ajax({
            type: 'GET',
            url: baseUrl + 'configurationBornes/rechercheCatalogueCadre/'+evenement_id+'/'+client_id,
            data: datas,
            //dataType: "json",
            timeout: 15000,
            beforeSend: function( xhr ) {
                //debut
                $('.bloc_loader_cat_cadre').removeClass('hide');
            },
            success: function(data) {
                $('#id_content_cat_cadre').empty().html(data);
                var count_cat_cadre = $('#count_cat_cadre_rech').val();                
                $('#count_cat_cadre').text( count_cat_cadre +" "+(parseInt(count_cat_cadre) > 1 ? 'modèles': 'modèle'));
                setMagnificPopup();    
                $('.bloc_loader_cat_cadre').addClass('hide');        
            },
            error: function(jqXHR, textStatus){
                console.log(textStatus);
            }
        });
    }

    //==== POST FORM AJAX
    $('#id_post_form').on('click', function(){
        var is_ajax = 1;
        var formData = $("#configuration_bornes_form_id")[0];
        //var formData = $("#configuration_bornes_form_id").serializeArray();//JSON.stringify
        //formData = jQuery.parseJSON(formData);
        console.log( new FormData( $("#configuration_bornes_form_id")[0]));
        $.ajax({
            type: 'POST',
            url: baseUrl + 'configurationBornes/add/'+evenement_id+'/'+is_ajax,
            data: new FormData( formData ),
            processData: false,
            contentType: false,
            //dataType: "json",
            timeout: 15000,
            beforeSend: function( XMLHttpRequest ) {
                //debut
                //Upload progress
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                  // For handling the progress of the upload
                  myXhr.upload.addEventListener('progress', function (e) {
                    //console.log(e);
                    if (e.lengthComputable) {
                        var prog = e.loaded / e.total * 100 + '%';
                        console.log(e.loaded / e.total * 100 + '%');
                        $('.cf_progress_sauve').css('width', prog );
                      $('progress').attr({
                        value: e.loaded,
                        max: e.total,
                      });
                    }
                  }, false);
                }
                return myXhr;
              },
            /*xhrFields: {
                onprogress: function (e) {
                    console.log(e);
                    if (e.lengthComputable) {
                    console.log(e.loaded / e.total * 100 + '%');
                    }
                }
            },*/
            success: function(data) {
                data = jQuery.parseJSON(data);
                //console.log(data);
                if(data.success){
                    //location.reload(true);
                }
                
            },
            error: function(jqXHR, textStatus){
                console.log(textStatus);
            }                
        });

    });

    //== Suppression ecran page 
    $(document).on("click", ".suppr_fond_page", function() {
        var conf = confirm('Voulez-vous vraiment supprimer ?');
        var type_page = $(this).attr('data-owner');
        var img_fond = $('#'+type_page).val();
        var input = '<input type="hidden" name="page_to_delete['+type_page+']" value="'+img_fond+'" >';
        if(conf) {
            $('.page_to_delete').append(input);
            if(type_page == "btn_acceuil"){
                $('.sf-bloc-button-upload').addClass('hide');
            } else {
                $('#bloc_'+type_page+' .sf-bloc-apercus').attr('style', '');
            }
        }
    });
});

function setMagnificPopup (){
    $(".kl_viewTheme, .kl_viewCatCadre").magnificPopup({ 
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
}