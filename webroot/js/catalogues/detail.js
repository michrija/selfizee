
Dropzone.autoDiscover = false;
var baseUrl ;
$(document).ready(function(){
     baseUrl = $("#id_baseUrl").val();
    
    $('body').delegate('#tp-borne-spherik', 'click', function(){        
        //$('#tp-borne-spherik').click(function(){
            $('.sf-bloc-apercu_ecran_spherik').removeClass('hide');
            $('.sf-bloc-apercu_ecran_classik').addClass('hide');
        });
        $('body').delegate('#tp-borne-classik', 'click', function(){      
        //$('#tp-borne-classik').click(function(){
            $('.sf-bloc-apercu_ecran_classik').removeClass('hide');
            $('.sf-bloc-apercu_ecran_spherik').addClass('hide');
        });
        
        $('body').delegate('.img_fond img', 'click', function(){
            var img_src = $(this).attr('src');
            //alert();
            var style_img = "position: absolute;top: 0;bottom: 0;margin: auto;";
            var img = '<img class="img-responsive sf-cursor " src="'+img_src+'" style="'+style_img+'">';
            $('.sf-bloc-apercu_ecran_classik, .sf-bloc-apercu_ecran_spherik').text('');
            $('.sf-bloc-apercu_ecran_classik, .sf-bloc-apercu_ecran_spherik').append(img);
            console.log('background-image: url('+img_src+');background-size: cover;z-index:1000;');
            //$('.sf-bloc-apercu_ecran').css('background-image: url('+img+');background-size: cover;z-index:1000;');
        });
});