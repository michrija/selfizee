$(document).ready(function(){

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
            icon:'<i class="note-icon-link"/>', // note-icon-pencil
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
              //var cleanContent = cleanPastedLink(contents);
              
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
                url: baseUrl+"evenementPosts/uploadImgEditeur",
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
                url: baseUrl+"evenementPosts/deleteImgEditeur",
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
    

    $("#id_title").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#id_slug',
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
            $("#id_slug").val(text.toLowerCase());
        }
    });
    
    /*$("#id_nomEvenement").bind('blur keyup change', function() {
        $(this).val($(this).val().toUpperCase());
    });*/
     
    
});





