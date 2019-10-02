$(document).ready(function(){
    /*$(".kl_btnSearch").on('mouseover', function () {
        if ($(".rechreche_global").is(":focus")) {
            //alert('');
           $('.kl_btnSearch').css('background','#fff');
        }
    });
    $(".kl_btnSearch").on('mouseout', function () {
        $('.kl_btnSearch').css('background','#ddd');
    });*/

    /*$('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });*/

    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        locale: {
            format: "DD/MM/YYYY",
            separator: " - ",
            applyLabel: "Valider",
            cancelLabel: "Annuler",
            weekLabel: "W",
            daysOfWeek: ["d", "l", "ma", "me", "j", "v", "s"],
            monthNames: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            firstDay: 1
        },
        autoUpdateInput: false,
        /*startDate: new Date(),
        endDate: new Date(),*/
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-inverse'
    });

    $('.input-daterange-datepicker').on('apply.daterangepicker', function (ev, picker) {
        var dateDebut = picker.startDate.format('DD/MM/YYYY');
        var dateFin = picker.endDate.format('DD/MM/YYYY');
        $(this).val(dateDebut + ' - ' + dateFin);
        /*$('#datedebut').val(dateDebut);
        $('#datefin').val(dateFin);*/
    });

    $('.input-daterange-datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });



    if($("#is_affiche_filtre_avances").attr('checked') === "checked" ){
        $(".filtre_avances").removeClass('hide');
    }

    $("#is_affiche_filtre_avances").click(function () {
        if ($(this).prop('checked')) {
            $(".filtre_avances").removeClass('hide');
        } else {
            $(".filtre_avances").addClass('hide');
        }
    });

   
    $("#id_periodeChoix").change(function(){
        
        if($(this).val() == 'x'){
            $("#id_datePickerMois").removeClass('hide');
        }else{
            $("#id_datePickerMois").addClass('hide');
        }
    });

    $("#id_periodeChoixPhoto").change(function(){
        
        if($(this).val() == 'x'){
            $("#id_datePickerMois").removeClass('hide');
        }else{
            $("#id_datePickerMois").addClass('hide');
        }
    });
    
    $("#id_eventListSwitcher input[type='radio']").on('change', function(){
		var state = $(this).val();
		if(state == '0'){
			$(".kl_vueEvenement").removeClass("hide");
			$(".kl_vueConfiguration").addClass("hide");
		}else{
			$(".kl_vueEvenement").addClass("hide");
			$(".kl_vueConfiguration").removeClass("hide");
		}
	});

    $("#id_eventListSwitcher input[type='checkbox']").bootstrapSwitch({
        onSwitchChange : function(event, state){
            if(state){
                $(".kl_vueEvenement").removeClass("hide");
                $(".kl_vueConfiguration").addClass("hide");
            }else{
                $(".kl_vueEvenement").addClass("hide");
                $(".kl_vueConfiguration").removeClass("hide");
            }
        }
    });

    //=== SOUS MENU CONTEXTUELLE
    $('.kl_menu_context').hide();
    $(".table-hover tbody tr").mouseover(function (){
        //alert();
        var id = $(this).attr('id');
        id_event = id.split('_')[2];
        //alert(id_event);
        //$('#kl_menu_context_'+id_event).removeClass('hide');
        $('#kl_menu_context_'+id_event).show();
        //$('.kl_menu_context').not('#kl_menu_context_'+id_event).addClass('hide');
        $('.kl_menu_context').not('#kl_menu_context_'+id_event).hide();

    });
    $(".table-hover tbody tr").mouseleave(function (){
        $('.kl_menu_context').addClass('hide');
    });

    $('.popover-dismiss').popover({
      trigger: 'focus'
    });

    $('.kl_icon_option').tooltip();

    $('body').on('mousedown', '.popover', function(e) {
        e.preventDefault()
    });


    //===========================================
	
	/*
	 * Début
	 * Projet : Virer les paramètres hors filtre
	 * url : https://trello.com/c/LahqopLw/205-optimiser-urls-pour-virer-les-param%C3%A8tres-dans-les-pages-hors-filtres
	 * date de modification : 06-mar-2019
	 * 
	 * author: Paul
	 */
	$('#filtreBtn').on('click', function(e){
		e.preventDefault();
		var url = $('#evenementForm').attr('action');
		var index = url.indexOf('?');
		url = url.substr(0, index);
		var is_checked = $('#is_affiche_filtre_avances').prop('checked');
		
		var filtre = '';
		var filtre_key = $('#keys').val();
		var filtre_clienttype = $('#clienttype').val();
		var filtre_periodeType = $('#id_periodeChoix').val();
		var filtre_periode = '';
		var filtre_passe = '';
		var filtre_avances = '';
		var filtre_pageSouvenir = '';
		var filtre_emailConf = '';
		var filtre_smsConf = '';
		var filtre_envoiConf = '';
		var filtre_fbAutoConf = '';
		var filtre_photoExiste = '';
		
		if(is_checked){
			filtre_avances = 1;
			filtre_periode = $('#periode').val();
			filtre_passe = $('#passe').val();
			filtre_pageSouvenir = $('#pageSouvenir').val();
			filtre_emailConf = $('#emailConf').val();
			filtre_smsConf = $('#smsConf').val();
			filtre_envoiConf = $('#envoiConf').val();
			filtre_fbAutoConf = $('#fbAutoConf').val();
			filtre_photoExiste = $('#photoExiste').val();
		}
		
		filtre += $.trim(filtre_key) != '' ? (filtre == '' ? '?' : '&') + 'key='+filtre_key : '';
		filtre += $.trim(filtre_clienttype) != '' ? (filtre == '' ? '?' : '&') + 'clientType='+filtre_clienttype : '';
		filtre += $.trim(filtre_periodeType) != '' ? (filtre == '' ? '?' : '&') + 'periodeType='+filtre_periodeType : '';
		filtre += $.trim(filtre_periode) != '' ? (filtre == '' ? '?' : '&') + 'periode='+filtre_periode : '';
		filtre += $.trim(filtre_passe) != '' ? (filtre == '' ? '?' : '&') + 'passe='+filtre_passe : '';
		filtre += $.trim(filtre_avances) != '' ? (filtre == '' ? '?' : '&') + 'filtre_avances='+filtre_avances : '';
		filtre += $.trim(filtre_pageSouvenir) != '' ? (filtre == '' ? '?' : '&') + 'pageSouv='+filtre_pageSouvenir : '';
		filtre += $.trim(filtre_emailConf) != '' ? (filtre == '' ? '?' : '&') + 'emailConf='+filtre_emailConf : '';
		filtre += $.trim(filtre_smsConf) != '' ? (filtre == '' ? '?' : '&') + 'smsConf='+filtre_smsConf : '';
		filtre += $.trim(filtre_envoiConf) != '' ? (filtre == '' ? '?' : '&') + 'envoiConf='+filtre_envoiConf : '';
		filtre += $.trim(filtre_fbAutoConf) != '' ? (filtre == '' ? '?' : '&') + 'fbAutoConf='+filtre_fbAutoConf : '';
		filtre += $.trim(filtre_photoExiste) != '' ? (filtre == '' ? '?' : '&') + 'photoExiste='+filtre_photoExiste : '';
		
		if($.trim(filtre) != ''){
			url += filtre;
			$('#evenementForm').attr('action', url);
			setTimeout(function(){
				$('#evenementForm').submit();
			},120);
		}else{
			return false;
		}
    });
    
    //== Modif affichage vue event & vue config (pour optimisation)
    $('label.btn_vu_event').click(function (){
        $('.col_vue_event').removeClass('hide');
        $('.col_vue_config').addClass('hide');
    });

    $('label.btn_vu_config').click(function (){
        $('.col_vue_config').removeClass('hide');
        $('.col_vue_event').addClass('hide');
    });

    //==== Ajax get info count

    var baseUrl = $("#id_baseUrl").val();
    $(window).on('load', function() {        
            var idsEvents = $('#id_evenements_ids').val();
            if( idsEvents != undefined) {
                idsEvents = JSON.parse(idsEvents);
                var ids = {};
                ids ['ids'] = idsEvents;
                console.log(ids);
                $.ajax({
                    type: 'POST',
                    url: baseUrl+"evenements/getInfoSynthseEvent",
                    data: ids,
                    dataType: "json",
                    beforeSend: function( xhr ) {
                        //debut
                    },
                    success: function(data) {
                    console.log(data);
                    if(data.totalContacts != undefined){
                        $('#id_count_contacts').text(data.totalContacts);
                        $('.kl_count_contacts').removeClass('hide');
                    }
                    if(data.totalEmailEnvoyes != undefined){
                        $('#id_count_email_envoyes').text(data.totalEmailEnvoyes);
                        $('.kl_count_email_envoyes').removeClass('hide');
                    }
                    if(data.totalEmailEnvoyes != undefined){
                        $('#id_count_sms_envoyes').text(data.totalSmsEnvoyes);
                        $('.kl_count_sms_envoyes').removeClass('hide');
                    } 
                    if(data.totalPublications != undefined){
                        $('#id_count_publications').text(data.totalPublications);
                        $('.kl_count_publications').removeClass('hide');
                    }
                    //fin gif
                    }
                });
            }
    });

    //==== Envoi email galerie
   // $('body').delegate('btn_envoi_email_gal', 'click', function(){
    $(document).on("click", ".btn_envoi_email_gal", function() {
        var id_event = $(this).attr('data-owner');
        $('#envoiEMail .modal-body').empty();
        //alert(id_event);
        $.ajax({
            type: 'GET',
            url: baseUrl+"evenements/getGalerieEventToSend/"+id_event,
            dataType: "json",
            beforeSend: function( xhr ) {
                //debut
                $("#btn_envoi_gal").attr("disabled", true);
                $('#envoiEMail .modal-body').append('<div> <i class="fa fa-spin fa-spinner"></i> Loading ...</div>');
            },
            success: function(data) {
                var evenement = data;
                $('#envoiEMail #galery_id').val(evenement.galeries[0].id);
                $('#envoiEMail #evenement_id').val(evenement.id);//modal-body
                var body = null;
                
                var input_gal = '<input type="hidden" name="galery_id" id="galery_id" value="'+evenement.galeries[0].id+'">';
                var input_event = '<input type="hidden" name="evenement_id" id="evenement_id" value="'+evenement.id+'">';
                if(evenement.client.email != "" && evenement.client.email != null){
                    body = '<h4>Etes-vous sûr de vouloir envoyer à </h4>'+
                    '<div class="form-group">'+
                        '<label for="recipient-name" class="control-label">Client:</label>'+
                        '<input type="email" name="destinateur" class="form-control" value="'+evenement.client.email+'" readonly="readonly">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="message-text" class="control-label">Autre(s) :</label>'+
                        '<input type="text" name="destinateurs_mutliple" class="form-control">'+
                        '<span class="help-block"><small>Pour mettre plusieurs destinataires veuillez séparer les e-mails d\'une virgule.</small></span>'+
                    '</div>';
                    
                } else {

                    body = '<div class="form-group">'+
                           '<label for="message-text" class="control-label">Email(s) *:</label>'+
                            '<input type="text" name="destinateurs_mutliple" class="form-control" required>'+
                            '<span class="help-block"><small>Pour mettre plusieurs destinataires veuillez séparer les e-mails d\'une virgule.</small></span>'+
                        '</div>';
                }                
                $('#envoiEMail .modal-body').empty();
                $("#btn_envoi_gal").attr("disabled", false);
                $('#envoiEMail .modal-body').append(input_gal);
                $('#envoiEMail .modal-body').append(input_event);
                $('#envoiEMail .modal-body').append(body);           
            }
        });

    });

    //== Suppression evenement 
    $(document).on("click", ".bnt_suppr_event", function() {
        var id_event = $(this).attr('data-owner');
        var conf = confirm('Voulez-vous vraiment supprimer l\'événement '+id_event+ " ?");
        var form_suppr = '<form name="post_5d77eb1ad6384191992398'+id_event+'" id="form_del_'+id_event+'" style="display:none;" method="post" action="/evenements/delete/'+id_event+'">'+
                            '<input type="hidden" name="_method" value="POST" class="form-control">'+
                         '</form>';
        if(conf) {
            $(this).append(form_suppr);
            $('#form_del_'+id_event).submit();
        }
    });
});