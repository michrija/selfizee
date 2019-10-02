Dropzone.autoDiscover = false;
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

    
    //===== GESTION DOCUMENTS
    $('.btn_suppr_bloc:first').hide();
    //$('.btn_suppr_bloc_edit:first').hide();

    $('.btn_ajout_autre_fond').on('click', function () {

        var clone = $("[id ^='bloc_image_fond']:last").clone();
        //===== gestion titre du form
        var idLast = $("[id ^='bloc_image_fond']:last").attr('id');
        console.log(idLast);
        var idLast = idLast.split('_');
        var numNouv = parseInt(idLast[3]) + 1;

        $(clone).find('.btn_suppr_bloc').attr('id', "btn_suppr_bloc_" + numNouv);
        clone.find('.btn_suppr_bloc').show();//=== affichage btn suppr 

        $(clone).find('.btn_suppr_doc_edit').attr('id', "btn_suppr_bloc_" + numNouv);
        $(clone).find('.btn_suppr_doc_edit').show();

        var inputs = clone.find('input');
        var selects = clone.find('select');
        clone.find('button').remove();

        var inputFileName = "";
        var inputFileId = "";
        $.each(selects, function (index, elem) {
            var input = $(elem);
            var id = input.attr('id');
            //alert(id);
            var ids = id.split('-');
            var num = parseInt(ids[2]);
            
            if(input.attr('type') === "file"){
                image_fonds_files
                var nouvId = "image_fonds_files_" +(num + 1);
                input.attr('id', nouvId);
                inputFileId = nouvId;
            } else {
                var nouvName = "image_fonds[" + (num + 1) + "][type]";
                var nouvId = "image-fonds-" +(num + 1)+ "-type";
                input.attr('id', nouvId);
                input.attr('name', nouvName);
            }
            input.val("");
        });
        
        $.each(inputs, function (index, elem) {
            //alert($(elem).attr('class'));
            if ($(elem).hasClass('id_fond')) {
                $(elem).remove();
            }        
        });

        clone.find('.bloc_fond').remove();
        clone.find('.btn_ajout_autre_fond').remove();

        $(clone).attr('id', "bloc_image_fond_" + (numNouv));
        clone.insertAfter('.bloc_image_fond:last');
        $( '<hr class="divider_bloc_'+ (numNouv)+' m-t-30 m-b-30">' ).insertBefore('.bloc_image_fond:last');
        //var inputFileNouv = '<div class="col-md-4 bloc_dropify"><label>Fichier :</label></label><input type="file" class="dropify" name="' + inputFileName + '" id="' + inputFileId + '" data-height="100"></div>';
        
        var inputFileNouv = '<div class="col-md-4 bloc_fond">  '+                            
            '<div class="cf_blocDropify">'+
                '<input  type="file" name="image_fonds_files[]" id="' + inputFileId + '" class="dropify_image_fond" accept="image/*" required="required" >'+
            '</div>'+
        '</div>';

        $(inputFileNouv).insertBefore(".bloc_type_fond:last");
        $('.dropify_image_fond').dropify({
            messages: {
                default: 'Glissez-déposez votre cadre ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, une erreur est survenue'
            }
        });
    });

     //==== suppression bloc
     $(document).on('click', '.btn_suppr_bloc', function () {
        var id = $(this).attr('id');//alert(id);
        var numDate = id.split('_')['3'];
        $("#bloc_image_fond_" + numDate).hide("blind");
        $("#bloc_image_fond_" + numDate).remove();
        $('.divider_bloc_' + numDate).remove();
    });

    $(document).on('click', '.btn_suppr_bloc_edit', function () {
        var id = $(this).attr('id');
        console.log(id);
        var numDate = id.split('_')[3];
        var idDate = id.split('_')[4];
        if(confirm("Are you want to delete ?")) {
            $("#fond_to_delete_" + numDate).val(idDate);
            $("#bloc_image_fond_" + numDate).hide("blind");
            $("#bloc_image_fond_" + numDate).remove();
            $('.divider_bloc_' + numDate).remove();
        }
    });

    
    $(".kl_viewTheme").magnificPopup({ 
        type: 'ajax',
        closeOnBgClick  : false,
        settings: {cache:true, async:true},
        gallery: {
        enabled:true
        },
        preload: [1,3],
        image: {
            markup: '<div class="mfp-figure kl_figure">'+
                    '<div class="mfp-close"></div>'+
                    '<div class="mfp-img"></div>'+
                    '<div class="mfp-bottom-bar">'+
                    '<div class="mfp-title"></div>'+
                    '<div class="mfp-counter"></div>'+
                    '</div>'+
                '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
        
            cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.
        
            titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
        // Or the function that should return the title. For example:
        // titleSrc: function(item) {
        //   return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
        // }
        
            verticalFit: true, // Fits image in area vertically
        
            tError: '<a href="%url%">The image</a> could not be loaded.' // Error message
        }
    });

});