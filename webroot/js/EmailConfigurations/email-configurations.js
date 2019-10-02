
$(document).ready(function() {

	var domaine = $('#id_baseUrl').val();
    document.emojiSource = domaine + "js/tam-emoji/img";
    
    $(".colorpicker").asColorPicker();
    
    
    $('.colorpicker').on('asColorPicker::change', function (e) {
        
      // on value change 
      if($(this).hasClass('kl_forIcon')){
     
         $(this).closest('.kl_forIconBlock').find('button').css('background', $(this).val());
      }
    });
    
    /*var myCustomTemplates = {
      html : function(locale) {
        return "<li>" +
               "<div class='btn-group'>" +
               "<a class='btn' data-wysihtml5-action='change_view' title='" + locale.html.edit + "'><i class='fa fa-code'></i></a>" +
               "</div>" +
               "</li>";
      }
    }

    $('.textarea_editor').wysihtml5({ "image": false,'outdent': false,'html': true,customTemplates: myCustomTemplates, useParserRules : false});
   */

    /*$('.textarea_editor').summernote({
        // Toolbar here
        //dialogsInBody: true,
        disableDragAndDrop : false,
        lang: 'fr-FR', // default: 'en-US'
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            //['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr', 'emoji']],
            ['view', ['fullscreen', 'codeview' ]],   // remove codeview button
            //['help', ['help']]
        ],
        popover: {
            image: [
                ['custom', ['imageAttributes']],
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },
        lang: 'fr-FR', //fr-FR en-US Change to your chosen language
        imageAttributes:{
            icon:'<i class="note-icon-pencil"/>', // note-icon-pencil
            removeEmpty: false, // true = remove attributes | false = leave empty if present
            disableUpload: true // true = don't display Upload Options | Display Upload Options
        },
        height: 300,
        onCreateLink : function(originalLink) {
           
                return originalLink; // return original link 
        },
        callbacks: {
            onChange: function(contents, $editable) {
             
              var cleanContent = cleanPastedLink(contents);
              
            },
    
            onPaste: function(e) {
               
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
               
                document.execCommand('insertText', false, bufferText);
                
               /* var thisNote = $(this);
                var updatePastedText = function(someNote){
                    var original = someNote.code();
                    var cleaned = cleanPastedLink(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
                    console.log('cleaned '+cleaned);
                    someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
                };
                setTimeout(function () {
                    //this kinda sucks, but if you don't do a setTimeout, 
                    //the function is called before the text is really pasted.
                    updatePastedText(thisNote);
                }, 10);/

            }
            ,
            onImageUpload: function(files) {
                   // alert('upload ateto');
                    editor = $(this);
                    imgUpload(files[0], editor);
                },
            onMediaDelete : function(target) {                
                var url = target[0].src.split("/");
                var filename = url[url.length - 1];
                //alert(filename);
                imgDelete(filename);
            }
        }
    });
    //$('.textarea_editor').summernote('disable');
    */
    var baseUrl = $("#id_baseUrl").val();
    tinymce.init({
        selector: '.textarea_editor',
        language: 'fr_FR',
        menubar: false,
        plugins: 'preview fullpage emoticons searchreplace autolink directionality visualblocks visualchars fullscreen image link media  template  table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists  wordcount  imagetools textpattern noneditable help charmap quickbars code',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist  | forecolor backcolor casechange   removeformat  |  emoticons | fullscreen  preview  | insertfile image  pageembed link table | code',
        images_upload_url: baseUrl +'emailConfigurations/uploadfileInEditor',
        relative_urls : false,
        remove_script_host : false,
        convert_urls : false,
        branding: false
    });

   

    function imgUpload(uploadedImage, editor){
        var baseUrl = $("#id_baseUrl").val();
        var datas = new FormData();
        datas.append("imageField", uploadedImage);
        //console.log(datas);
        $.ajax({
                url: baseUrl+"emailConfigurations/uploadImgEditeur",
                cache: false,
                contentType: false,
                processData: false,
                data: datas,
                type: "post",
                success: function(imageData) {
                    var imageData = JSON.parse(imageData);
                 
                    if(imageData.success){
                        var imageUrl = imageData.url;
                        var image = $('<img>').attr('src', imageUrl);
                        //console.log(imageUrl);
                        //console.log(image);
                        $(editor).summernote("insertNode", image[0]);
                        var input = '<input type="hidden" value="'+imageData.filename+'" name="img_contents[]">';
                        $("#img_name_content").append(input);
                    } else {
                        alert("Une erreur est survenue. Veuillez réessayer.");
                    }
                },
                error: function(datas) {
                    alert('Error');
                 
                }
        });
    }

    function imgDelete(imageName){
        //var input = '<input type="hidden" value="'+imageName+'" name="img_contents_to_delete[]">';
        //$("#img_name_content").append(input);

        var baseUrl = $("#id_baseUrl").val();
        var datas = new FormData();
        datas.append("imageName", imageName);
        //console.log(datas);
        $.ajax({
                url: baseUrl+"emailConfigurations/deleteImgEditeur",
                cache: false,
                contentType: false,
                processData: false,
                data: datas,
                type: "post",
                success: function(imageData) {
                    var imageData = JSON.parse(imageData);
                    if(!imageData.success){ //if delete on edit
                        var input = '<input type="hidden" value="'+imageName+'" name="img_contents_to_delete[]">';
                        $("#img_name_content").append(input);
                    }
                },
                error: function(datas) {
                    alert('Error');
                }
        });
    }



    function cleanPastedLink(original){
         var baseUrl = $("#base_url").val();
         var res = original.replace(baseUrl+"email-configurations/add/[[lien_partage]]", "[[lien_partage]]"); 
         return res;
    }


    $("#model_email").change(function() {
        BASE_URL = $("#base_url").val();

        var model_email = $("#model_email").val();
        //alert(model_email);
        if(model_email !== "") {
            $.ajax({
                url: BASE_URL + 'clientsModelesEmails/getModele',
                data: {
                    model_email: model_email
                },
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    //console.log(data);
                    $("#email-expediteur").val(data.email_expediteur);
                    $("#nom-expediteur").val(data.nom_expediteur);
                    $("#objet").val(data.objet);
                    $("#is_photo_en_pj").val(data.is_photo_en_pj);
                    $("#content").text('<p>'+data.content+'</p>');
                    $(".note-editor .note-editable").html('<p>'+data.content+'</p>');
                    $("#couleur_fond_editeur").val(data.couleur_fond_editeur);
                }
            })
        }
    });
    
    $("#id_isHasCodePromo").change(function(){
        if($(this).is(':checked')){
            $("#id_ifCodePromoActive").removeClass("hide");
        }else{
            $("#id_ifCodePromoActive").addClass("hide");
        }
    });

    $("#id_isHasCouleurFond").change(function(){
        if($(this).is(':checked')){
            $("#id_couleurFondPerso").removeClass("hide");
        }else{
            $("#id_couleurFondPerso").addClass("hide");
        }
    });

    $("#id_isBlocSahreActive").change(function(){
        if($(this).is(':checked')){
            $("#id_pickerColorIconShare").removeClass("hide");
        }else{
            $("#id_pickerColorIconShare").addClass("hide");
        }
    });


    //id_dateHeureEnvoi
    $(".kl_dateHeureDenvoi").datetimepicker({
        language : 'fr'
    });
    $("#id_activeDateEnvoi").change(function(){
        if($(this).is(':checked')){
            $("#id_dateHeureEnvoi").removeClass('hide');
        }else{
            $("#id_dateHeureEnvoi").addClass('hide');
        }
    });


    //Eexpediteur Email
    $("#id_expedtieurList").change(function(){
        if($(this).val() == 'createnew'){
            $("#newAdresse").modal('show');
            $("#id_isNewAdresse").removeAttr('checked');
        }else{
            var selectedClass = $(this).children("option:selected").attr('class');
            if(selectedClass == 'kl_isNewAdress'){
                $("#id_isNewAdresse").attr('checked','checked');
            }else{
                $("#id_isNewAdresse").removeAttr('checked');
            }
        }
    });

    $("#saveNewAdresse").click(function(){
         var newAdress = $("#email_new_adresse").val();
         var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
         if(newAdress.length){
            if(pattern.test(newAdress)){
                $("#id_isNewAdresse").attr('checked','checked');
                $("#id_expedtieurList").append('<option class="kl_isNewAdress" selected="selected" value="'+newAdress+'">'+newAdress+'</option>');
                $("#newAdresse").modal('hide'); 
            }else{
                $("#id_textError").html('Veuillez saisir une adresse e-mail valide');
            }
            
         }else{
            $("#id_textError").html('Le champ email est obligatoire');
         }
    });

    $("#id_addMinuatureLienParam").click(function(){
        var urlImage = domaine+'img/miniature_lien.png';
        addParam(urlImage);
        return false;
    });

    $("#id_addSelectedParam").click(function(){
        var urlImage = domaine+$(".kl_listeChoixParam").val();
        addParam(urlImage);
        return false;
    });

    $("#id_addBlocIncitation").click(function(){
        var urlImage = domaine+'img/bloc_incitation.png';
        addParam(urlImage);
        return false;
    });

    function addParam(urlImage){
       /* $('.textarea_editor').summernote('editor.saveRange');
        // Editor loses selected range (e.g after blur)
        $('.textarea_editor').summernote('editor.restoreRange');
        $('.textarea_editor').summernote('editor.focus');
       // $('.textarea_editor').summernote('editor.insertText', '<a href="#"><i class="fa fa-calendar" /></a>');
        $('.textarea_editor').summernote('insertImage', urlImage);*/

        var editor = tinymce.activeEditor;                // get editor instance
        var range = editor.selection.getRng();                  // get range
        var newNode = editor.getDoc().createElement ( "img" );  // create img node
        newNode.src=urlImage;                           // add src attribute
        range.insertNode(newNode); 
    }

});