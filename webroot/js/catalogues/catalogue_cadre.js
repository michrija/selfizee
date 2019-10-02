var baseUrl ;
$(document).ready(function(){
     baseUrl = $("#id_baseUrl").val();
      
     $(".select2").select2();
    
    $('.dropify_image_fond').dropify({
        messages: {
            default: 'Glissez-déposez votre cadre ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });
});