$(document).ready(function(){
    $(".colorpicker").asColorPicker();
     // Translated
    $('.dropify').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });

    //==== MODULE SAISIE DE FORM avant téléchargement 
    if($("#is_active_form_down").attr('checked') == "checked"){
        $(".btn-addchamp, #id_listeChampAdded, #activRenseign").removeClass('hide');
    }

    $("#is_active_form_down").click(function () {
        if ($(this).prop('checked')) {
            $(".btn-addchamp, #id_listeChampAdded, #activRenseign").removeClass('hide');
        } else {
            $(".btn-addchamp, #id_listeChampAdded, #activRenseign").addClass('hide');
        }
    });


    //==== MODULE VIDEO PUB
    if($("#is_active_video_pub").attr('checked') == "checked"){
        $(".url-video").removeClass('hide');
    }

    $("#is_active_video_pub").click(function () {
        if ($(this).prop('checked')) {
            $(".url-video").removeClass('hide');
        } else {
            $(".url-video").addClass('hide');
        }
    });

//lien extern

    if($("#is_active_lienextern").attr('checked') == "checked"){
        $(".lien_extern").removeClass('hide');
    }

    $("#is_active_lienextern").click(function () {
        if ($(this).prop('checked')) {
            $(".lien_extern").removeClass('hide');
        } else {
            $(".lien_extern").addClass('hide');
        }
    });



	
	$('.dropify-clear').on('click', function(){
		var objet = $(this);
		var img_banniere = objet.parent().parent().find('input[name="img_banniere"]');
		var img_bandeau = objet.parent().parent().find('input[name="img_bandeau"]');
		
		if(img_bandeau.length){
			img_bandeau.val('');
		}
		
		if(img_banniere.length){
			img_banniere.val('');
		}
	});
});


// Step
var form = $(".tab-wizard").show();
$(".tab-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '#title#'
    , enablePagination: false
    , labels: {
        finish: "terminer",
        next : 'Continuer',
        previous : 'Précédent'
    }
    , onStepChanging: function (event, currentIndex, newIndex) {
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    }
    , onFinishing: function (event, currentIndex) {
        return form.validate().settings.ignore = ":disabled", form.valid()
    }
    , onFinished: function (event, currentIndex) {
         //swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        $("#id_creationEvenementForm").submit();
    }
});