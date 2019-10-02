$(document).ready(function(){

    function augmenterHauteur() {
        return {
            "load": function () {
                var iframe = $(this.composer.iframe);
                var body = $(this.composer.element);
                iframe.css({
                    'height': '60px',
                });
                body.bind('keypress keyup keydown paste change focus blur', function(e) {
                    iframe.height('46px');
                });
            }
        }
    }

    $(".colorpicker").asColorPicker();
    $('.textarea_editor').wysihtml5({"image": false,
        "events": augmenterHauteur()
    });
    $('.textarea_editor2').wysihtml5({"image": false,
        "events": augmenterHauteur()
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
    
    $(".select2").select2();
    
     $("#id_nomGalerie").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#id_identifiantGalerie',
        space: '-',
        prefix: '',
        suffix: '',
        replace: '',
        AND: 'et',
        options: {
            maintainCase : true,
            lang :'fr'
        },
        callback: function(text) {
            //console.warn('This warn is a callback: ' + text);
            $("#id_identifiantGalerie").val(text.toUpperCase());
            $("#id_loginGalerie").val(text.toUpperCase());
            $("#id_passwordGalerie").val(text.toUpperCase());
        }
    });
    
    
    $("#id_identifiantGalerie").change(function(){
        var options = {
    	    maintainCase: true,
    	    separator: '-',
            lang: 'fr',
            custom: {
	           '&': 'ET'
	         },            
                                    
    	};
                
        var theSlug = getSlug($(this).val(), options);
        $(this).val(theSlug.toUpperCase());
        $("#id_loginGalerie").val(theSlug.toUpperCase());
        $("#id_passwordGalerie").val(theSlug.toUpperCase());
    });
    
     $("#id_invited_can_upload_photo").change(function(){
       if($(this).is(':checked')){
            $('.kl_showIfCan').removeClass("hide");
       }else{
            $('.kl_showIfCan').addClass("hide");
            $(".kl_showIfModerate").addClass("hide");
       }
       $('#id_is_photo_invited_must_moderate').prop('checked', false); // Unchecks it
       $(".kl_showIfModerate > input").val("");
    });
    
    //kl_showIfModerate
    $("#id_is_photo_invited_must_moderate").change(function(){
        if($(this).is(':checked')){
            $('.kl_showIfModerate').removeClass("hide");
        }else{
            $('.kl_showIfModerate').addClass("hide");
       }
       $("#id_email_to_notify").val("");
    });
    
        
});
