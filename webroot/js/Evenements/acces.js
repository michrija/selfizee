$(document).ready(function(){

    if($("#is_active_acces_event").attr('checked') == "checked"){
        $(".acces_detail").removeClass('hide');
    }

    $("#is_active_acces_event").click(function () {
        if ($(this).prop('checked')) {
            $(".acces_detail").removeClass('hide');
        } else {
            $(".acces_detail").addClass('hide');
        }
    });

    //=== Gestion PASSWORD
    $("body").on( "keypress", "#password_visible", function() {
        var pass = $(this).val();
        $("#password").val(pass);
    });
    
    $("body").on( "click", "#id_generateMotDePasse", function() {
        var pass = generer_password();
        //alert(pass);
        $("#password_visible, #password").val(pass);
        return false;
    });

    $('.btn-envoye_acces_event').click(function () {
        var btn_id = $(this).attr('id');
        //var login = btn_id.split('_')['1'];
        //var password = btn_id.split('_')['2'];
        var user = btn_id.split('_')['1'];
        var event = btn_id.split('_')['2'];
        
        $('#user_to_send').val(user);
        $('#evenement_to_send').val(event);
        //alert(login+"-"+password);
    });

    /*$('#password_visible').on('paste', function(e){
        var content = '';
          if (isIE()) {
            //IE allows to get the clipboard data of the window object.
            content = window.clipboardData.getData('text');
          } else {
            //This works for Chrome and Firefox.
            content = e.originalEvent.clipboardData.getData('text/plain');
          }
         //alert(content);
         var pass = $(this).val();
         $("#password").val(pass);
    });
    function isIE(){
        var ua = window.navigator.userAgent;
        return ua.indexOf('MSIE ') > 0 || ua.indexOf('Trident/') > 0 || ua.indexOf('Edge/') > 0
    }*/

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
            ['insert', ['link', 'picture', 'hr']],
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
            onPaste: function(e) {
               
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                console.log('bufferText '+bufferText);
                document.execCommand('insertText', false, bufferText);
            }
        }
    });
});


function generer_password() {
    var ok = 'azertyupqsdfghjkmwxcvbn23456789AZERTYUPQSDFGHJKMWXCVBN';
    var pass = '';
    longueur = 5;
    for(i=0;i<longueur;i++){
        var wpos = Math.round(Math.random()*ok.length);
        pass+=ok.substring(wpos,wpos+1);
    }
    //document.getElementById(champ_cible).value = pass;
    return pass;
}