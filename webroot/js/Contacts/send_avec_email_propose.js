$(document).ready(function() {
     var baseUrl = $("#id_baseUrl").val();
    $( "body" ).on( "click", ".kl_sendAvecEmailPropose", function() {
        
         var contact_id = $(this).attr('id').split('_')[2];
         var evenement_id = $("#evenement_id_"+contact_id).val();      
         
         var myKeyVals = { "evenement_id" : evenement_id, "contact_id" : contact_id };
         //console.log(window.location.href);
         console.log(myKeyVals);
         //return;
         $.ajax({
                  type: 'POST',
                  url: baseUrl+"contacts/envoyeAvecEmailProposeAjax",
                  data: myKeyVals,
                  dataType: "json",
                  beforeSend: function( xhr ) {
                    //$("#id_saveAndSendContact").addClass("disable");
                  },
                  success: function(data) { 
                    if(data.success){
                        //alert("Save Complete");
                        //$('#sendSave').modal('hide');
                         window.location.reload();
                    }else{
                        alert("Une erreur est survenue. Veuillez réessayer.");
                    }                     
                  }
            });
         //return false;
    });

});


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}