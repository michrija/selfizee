$(document).ready(function(){
    

     $(".note-editor").addClass('hide');
    if($("#is-active-modif-signature").attr('checked') == "checked"){
        $("#signature-email, .note-editor").removeClass('hide');
    }

    $("#is-active-modif-signature").click(function () {
        if ($(this).prop('checked')) {
            $("#signature-email, .note-editor").removeClass('hide');
        } else {
            $("#signature-email, .note-editor").addClass('hide');
        }
    });



    if($("#is_marque_blanche").attr('checked') == "checked"){
        $(".marque_blanche").removeClass('hide');
    }

    $("#is_marque_blanche").click(function () {
        if ($(this).prop('checked')) {
            $(".marque_blanche").removeClass('hide');
        } else {
            $(".marque_blanche").addClass('hide');
        }
    });

    if($("#is_active_form").attr('checked') == "checked"){
        $(".champs_formulaire").removeClass('hide');
    }

    $("#is_active_form").click(function () {
        if ($(this).prop('checked')) {
            $(".champs_formulaire").removeClass('hide');
        } else {
            $(".champs_formulaire").addClass('hide');
        }
    });

    // Translated
    $('.dropify').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });


    $('#id_debutContrat').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
        language: 'fr'

    });

    $(".colorpicker").asColorPicker();
});

