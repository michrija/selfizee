$(document).ready(function(){
    $('.textarea_editor').wysihtml5({"image": false});
    $('.textarea_editor2').wysihtml5({"image": false});
    $('.textarea_editor3').wysihtml5({"image": false});
    $('.textarea_editor4').wysihtml5({"image": false});
    $(".colorpicker").asColorPicker();

    // Translated
    $('.dropify').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });

    $(".select2").select2();
});