$(document).ready(function(){
    
    $('#id_envoiManuel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var isEmail = button.data('email'); // Extract info from data-* attributes
        var isSms = button.data('sms');
        var isForce = button.data('force');
        var is_reenvoie_notsent = button.data('reenvoi');
          
        var modal = $(this);
        modal.find('.modal-body input[name=is_email]').prop( "checked", isEmail );
        modal.find('.modal-body input[name=is_sms]').prop( "checked", isSms );
        modal.find('.modal-body input[name=is_force_envoi]').prop( "checked", isForce );
        modal.find('.modal-body input[name=is_reenvoie_notsent]').prop( "checked", is_reenvoie_notsent );
        
        
    });
    
    //hide.bs.modal
    $('#id_envoiManuel').on('hide.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.modal-body input[name=is_email]').prop( "checked", false );
        modal.find('.modal-body input[name=is_sms]').prop( "checked", false );
        modal.find('.modal-body input[name=is_force_envoi]').prop( "checked", false );
        modal.find('.modal-body input[name=is_reenvoie_notsent]').prop( "checked", false );
    });
    
    $("#id_submitEnvoiManuel").submit(function(){
        alert('huhuhuhu');
        //id_paramEnvoiManuel
        var isEmail = $("#id_paramEnvoiManuel input[name=is_email]").val();
        var isSms = $("#id_paramEnvoiManuel input[name=is_sms]").val();
        var isForce = $("#id_paramEnvoiManuel input[name=is_force_envoi]").val();
        if( isForce){
            if(confirm("Etes vous sûr de vouloir tout reenvoyer ?")){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    });
});