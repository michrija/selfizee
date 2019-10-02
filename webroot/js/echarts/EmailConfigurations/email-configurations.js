$(document).ready(function() {
	var domaine = $('#id_baseUrl').val();
    document.emojiSource = domaine + "js/tam-emoji/img";
    
    $(".colorpicker").asColorPicker();
    
    
    $('.colorpicker').on('asColorPicker::change', function (e) {
        
      // on value change 
      if($(this).hasClass('kl_forIcon')){
        console.log('miova ee');
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
   

    $('.textarea_editor').summernote({
        // Toolbar here
        //dialogsInBody: true,
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
            console.log('originalLink '+originalLink);
                return originalLink; // return original link 
        },
        callbacks: {
            onChange: function(contents, $editable) {
              console.log('onChange:', contents, $editable);
              var cleanContent = cleanPastedLink(contents);
              
            },
    
            onPaste: function(e) {
               
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                console.log('bufferText '+bufferText);
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
                }, 10);*/

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
                    console.log(imageData);
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
                    console.log(datas);
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


});