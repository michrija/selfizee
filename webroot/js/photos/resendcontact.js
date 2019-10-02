$(document).ready(function() {
     var baseUrl = $("#id_baseUrl").val();
    //alert("huhu");
    //$("#id_saveAndSendContact").click(function(){
    $( "body" ).on( "click", "#id_saveAndSendContact", function() {
        if(!$(this).hasClass("disable")){
         var emailValue = $("#id_emailToSend").val();
         var smsValue = $("#id_smsToSend").val();
         var photoId = $("#id_photoId").val();
         var evenementId = $("#id_evenementId").val();
         var id_contact = $("#id_contact").val();
         
         if(emailValue.length || smsValue.length ){
            var isEmailValide = validateEmail(emailValue);
            if(emailValue.length && !isEmailValide ){
                $("#id_errorValue").html('Email invalide');
                return false
            }
            //send data 
            var myKeyVals = { "email" : emailValue, "telephone" : smsValue,"photo_id" : photoId,"evenement_id" : evenementId, "id_contact": id_contact };
            $.ajax({
                  type: 'POST',
                  url: baseUrl+"contacts/addAjax",
                  data: myKeyVals,
                  dataType: "json",
                  beforeSend: function( xhr ) {
                    //$("#id_saveAndSendContact").addClass("disable");
                    $("#id_saveAndSendContact").attr("disabled", true);
                    $('.msg_retour').empty();
                  },
                  success: function(data) { 
                    if(data.success){
                        //alert("Save Complete");                                                
                        $('.msg_retour').append('<div class="alert alert-success">Photo envoyée.</div>');
                        setTimeout(function () {$('#sendSave').modal('hide');$('#id_annuler').click();}, 3000);
                        //alert('Photo envoyée.');
                    }else{
                        $('.msg_retour').append('<div class="alert alert-danger">Photo non envoyée. Veuillez réessayer.</div>');
                        setTimeout(function () {$('.msg_retour').empty();}, 3000);                        
                    }
                    //$("#id_saveAndSendContact").removeClass("disable");
                    $("#id_saveAndSendContact").attr("disabled", false);                    
                    setTimeout(function () {$('.msg_retour').empty();}, 4000);
                  },
                  error: function(data) { 
                    alert("Une erreur est survenue. Veuillez réessayer.");
                  }
            });
            
         }else{
            $("#id_errorValue").html('Veuillez fournir au moins un e-mail ou un téléphone');
         }
         
         return false;
         }
    });

    //autre contact
    $( "body" ).on( "click", "#is-contact-0", function() {
    //$("#is-contact-0").click(function(){
        alert('Par ici :)');
        $("#id_emailToSend").val("");
        $("#id_smsToSend").val("");
     });
    
    //a un contact existant
    $( "body" ).on( "click", "#id_contact_photo", function() {
     //$("#is-contact-1").click(function(){
         var photoId = $("#id_photoId").val();
         var evenementId = $("#id_evenementId").val();

         var myKeyVals = {"photo_id" : photoId,"evenement_id" : evenementId };
            $.ajax({
                  type: 'POST',
                  url: baseUrl+"contacts/getContactPhotoAjax",
                  data: myKeyVals,
                  dataType: "json",                  
                  beforeSend: function( xhr ) {
                    $("#id_saveAndSendContact").attr("disabled", true);
                    $("#id_autre_contact").attr("disabled", true);
                  },
                  success: function(data) { 
                    if(data.success){
                        //alert(data);
                        $("#id_emailToSend").val(data.email);
                        $("#id_smsToSend").val(data.telephone);
                        $("#id_contact").val(data.id_contact);
                    }else{
                        alert("Une erreur est survenue. Veuillez réessayer.");
                    }   
                    $("#id_saveAndSendContact").attr("disabled", false); 
                    $("#id_autre_contact").attr("disabled", false);                 
                  }
            });
         $(".kl_form_resend").removeClass('hide');
     });

    $( "body" ).on( "click", "#id_autre_contact", function() {
     //$("#is-contact-1").click(function(){
         $("#id_contact").val('');
        if($(this).prop('checked')) {
             $(".kl_form_resend").removeClass('hide');
             $("#id_emailToSend").val("");
             $("#id_smsToSend").val("");         
        } else {
             $(".kl_form_resend").addClass('hide');            
        }
     });

    $( "body" ).on( "click", "#id_annuler", function() {
        $("#id_contact").val('');
        $(".kl_form_resend").addClass('hide');
        $("#id_emailToSend").val("");
        $("#id_smsToSend").val(""); 
        $('#sendSave').modal('hide');
    });

    //== Get info credit client (btn affiche popup modal)
    $(document).on("click", ".btn_envoi_photo", function() {
        var id_client = $(this).attr('data-owner');
        //alert(id_event);
        $('#id_smsToSend').attr('disabled', false);
        $.ajax({
            type: 'GET',
            url: baseUrl+"contacts/getInfoCreditSms/"+id_client,
            dataType: "json",
            beforeSend: function( xhr ) {
                //debut
                $('.info_crdt_sms').empty();
                $("#id_saveAndSendContact").attr("disabled", true); 
            },
            success: function(data) {
                var infos = data;
                //alert(infos.totalCredit);
                var info_sms = "";
                if(infos.creditDisponible > 0) {
                    var info_sms = '<span class="help-block"><small>Si vous envoyez la photo par SMS, ceci créditera un sms sur votre compte. Crédit restant : '+infos.creditDisponible+' sms</small></span>';
                } else {
                    var info_sms = '<span class="help-block"><small>Vous ne pouvez pas envoyer par sms car votre compte de crédit SMS est insuffisant. <a href="/credits/buy-sms/'+infos.client+'" target="_blank" style="text-decoration: underline;color: #54667a;">Créditer</a>.</small></span>';
                    $('#id_smsToSend').attr('disabled', true);
                }
                $('.info_crdt_sms').append(info_sms); 
                $("#id_saveAndSendContact").attr("disabled", false); 
            }
        });
    });
});


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}