$(document).ready(function(){

    $("#id_modele_vierge").click(function () {
        if ($(this).prop('checked')) {
            $("#id_modele_existant").prop('checked', false);
            $("#list_modeles").hide();
            $("#list_modeles").attr('required', false);
        }
    });


    $("#list_modeles").hide();
    $("#id_modele_existant").click(function () {
        if ($(this).prop('checked')) {
            $("#id_modele_vierge").prop('checked', false);
            $("#list_modeles").show();
            $("#list_modeles").attr('required', true);
        } else {
            $("#list_modeles").hide();
            $("#list_modeles").attr('required', false);
        }
    });

});