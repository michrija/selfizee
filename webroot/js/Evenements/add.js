$(document).ready(function(){


    
    $(".select2").select2();
    
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
    
    var form = $(".tab-wizard").show();
    $(".tab-wizard").steps({
        headerTag: "h6"
        , bodyTag: "section"
        , transitionEffect: "fade"
        , titleTemplate: '#title#'
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
    $(".tab-wizard").validate({
        ignore: "input[type=hidden]"
        , errorClass: "text-danger"
        , successClass: "text-success"
        , highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        }
        , unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        }
        , errorPlacement: function (error, element) {
            error.insertAfter(element)
        }
        , rules: {
            email: {
                email: !0
            }
        }
    });
  



    $('#date-range').datepicker({
        toggleActive: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        language : 'fr'     
    });




        $("#id_nomEvenement").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#id_identifiantEvemenemt',
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
            console.warn('This warn is a callback: ' + text);
            $("#id_identifiantEvemenemt").val(text.toUpperCase());
            $("#id_theUserName").val(text.toUpperCase());
            $("#id_slugGalerie").val(text.toUpperCase());
            $(".kl_sameValue").val(text.toUpperCase());
        }
    });
    
    /*$("#id_nomEvenement").bind('blur keyup change', function() {
        $(this).val($(this).val().toUpperCase());
    });*/
    
    $("#id_identifiantEvemenemt").change(function(){
        var options = {
            maintainCase: true,
            separator: '-',
            lang: 'fr',
            custom: {
               '&': 'ET'
             },            
                                    
        };
                
        var theSlug = getSlug($(this).val(), options);
        
        $("#id_identifiantEvemenemt").val(theSlug.toUpperCase());
        $("#id_theUserName").val(theSlug.toUpperCase());
        $("#id_slugGalerie").val(theSlug.toUpperCase());
        $(".kl_sameValue").val(theSlug.toUpperCase());
    });
    
    $("#id_nomEvenement").change(function(){
         $("#id_titreGalerie").val($(this).val());
         $("#id_nomGaleire").val($(this).val());
         
    });

    // $('.form-control-feedback').each(function(index, el) {
    //     if ($(this).html() != undefined && $(this).html() != '') {
    //         labelContent = $(this).parents('.form-group').find('label').first().text();
    //         innerContent = $(this).text();
    //         $(this).parents('.card-body').prepend('<span class="text-danger">Nom évenement: '+innerContent+'</span>')
    //     }
    // });
    
});




