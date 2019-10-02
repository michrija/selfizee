$(document).ready(function(){

    $(".kl_checkSelfizee").click(function(){
        var idSelected = $(this).attr('id').slice(12);
        if($(this).hasClass('kl_disable')){
            $('#id_selecteFonctionnaite option[value="'+idSelected+'"]').attr("selected", "selected");
            $(this).find('.kl_texteAremplacer').text('Désactiver');
            //fa-times
            $(this).find('.fa').removeClass('fa-check').addClass('fa-times-circle');
        }else{
           $('#id_selecteFonctionnaite option[value="'+idSelected+'"]').removeAttr("selected"); 
            $(this).find('.kl_texteAremplacer').text('Activer');
             //fa-check
            $(this).find('.fa').removeClass('fa-times-circle').addClass('fa-check');
        }
        $(this).toggleClass('kl_disable');
        return false;
    });
	    
});