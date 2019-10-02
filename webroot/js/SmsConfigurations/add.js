$(document).ready(function(){
    //alert('je passe');
    $('#id_contentSMS').on("keyup", function(){
            //alert("upp");
            $(".kl_lbl_sms_nbre").removeClass("hide");
			var input_val		= $(this).val();
			var input_val_length	= $(this).val().length;
			var root_char_nbre	= $('#id_baseUrl').val().length;
			var token_link		= 10;
			var link_char_sup	= root_char_nbre + token_link;
			var max_length 		= 320;
			var total_char		= input_val_length;
			var sms_count		= 1;
			$('.kl_lbl_sms_nbre').removeClass('kl_red');
			if (input_val.indexOf("[[lien_partage]]") >= 0){
			     
				 max_length -= link_char_sup ;
				 total_char		= link_char_sup + input_val_length;		
			}
			if(total_char > 160){
				sms_count+= 1;
				$('.kl_lbl_sms_nbre').addClass('kl_red');	
			}
            console.log(sms_count);
			$(this).attr('maxlength',max_length);
			$("#id_sms_nbre").val(sms_count);
			$('#id_char_val').val(total_char);
	});


    $("#model_sms").change(function() {
        BASE_URL = $("#base_url").val();

        var model_sms = $("#model_sms").val();
        if(model_sms !== "") {
            $.ajax({
                url: BASE_URL + 'clientsModelesSmss/getModele',
                data: {
                    model_sms: model_sms
                },
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    //console.log(data);
                    $("#expediteur").val(data.expediteur);
                    $("#id_contentSMS").val(data.contenu);
                    $("#id_char_val").val(data.nb_caractere);
                    $("#id_sms_nbre").val(data.nbr_sms);
                }
            })
        }
    });

    $(".kl_dateHeureDenvoi").datetimepicker({
        language : 'fr'
    });

    //id_dateHeureEnvoi
    $("#id_activeDateEnvoi").change(function(){
        if($(this).is(':checked')){
            $("#id_dateHeureEnvoi").removeClass('hide');
        }else{
            $("#id_dateHeureEnvoi").addClass('hide');
        }
    });

   
});
