$(document).ready(function(){


    // Deplace video upload apres photo 
    var photo_upload = $('ul.kl_listeFiltre li:nth-child(2)');
    var video_upload = $('ul.kl_listeFiltre li:nth-child(12)');
    $(video_upload).insertAfter($(photo_upload));
    
    setTimeout(function(){
        $('.sf-bloc-detaille').addClass('hide');    //$('.sf-bloc-synth').addClass('hide'); 
    }, 200);
    $("#klVueTimeline input[type='radio']").on('change', function(){
        var state = $(this).val();
        console.log(state);
        if(state == '1'){
            $(".sf-bloc-detaille").removeClass("hide");
            $(".sf-bloc-synth").addClass("hide");
            $('.message-item::before');
            $('.message-item-0').removeClass('message-item-1').addClass('message-item');
        }else{
            $(".sf-bloc-detaille").addClass("hide");
            $(".sf-bloc-synth").removeClass("hide");
            $('.message-item-0').removeClass('message-item').addClass('message-item-1');
        }
    });
    
    $(window).scroll(function(){
        
        var y = $(window).scrollTop();
        var wh = $(window).height();
        var dh = $(document).height();
        var isFin = $('#isFin').val();
        
        if((dh == y + wh) && isFin == 1){
            var page = $('#page_next').val();
            var idEvenement = $('#idEvenement').val();
            var type = $('#sf-type').val();
            var actionDateLast = $('#actionDateLast').val();
            var nbr = $('#nbr').val();
            
            $.ajax({
                url: '/evenements/ajax_timeline',
                type: 'post',
                
                async: false,
                
                data: {
                    'idEvenement': idEvenement,
                    'type': type,
                    'page': page,
                    'actionDateLast': actionDateLast,
                    'nbr': nbr
                },
                dataType: 'json',
                
                success: function(data){
                    if(typeof data['est_vide'] != 'undefined'){
                        $('#isFin').val(0);
                    }else{
                        $('.sf-bloc-detaille').append(data['v_detail']);
                        $('.sf-bloc-detaille').append(data['v_synth']);
                        $('#page_next').val(data['page_next']);
                        $('#actionDateLast').val(data['init']);
                        $('#nbr').val(data['nbr']);
                        
                        if(typeof data['replace_bloc'] != 'undefined' && $.trim() != data['replace_bloc'])
                            $('#'+data['id_replace_bloc']).html(data['replace_bloc']);
                        
                        if(typeof data['v_synthetique'] != 'undefined' && $.trim() != data['v_synthetique']){
                            setTimeout(function(){
                                $('.sf-bloc-synth').append(data['v_synthetique']);
                            }, 200);
                        }
                        $('#isFin').val(1);
                    }
                        
                },
                beforeSend: function(){
                    $('#sf-loading').removeClass('hide');
                    $('#isFin').val(2);
                },
                complete: function(){
                    $('#sf-loading').addClass('hide');
                }
            });
        }
        
    });
   
    $('.kl_filtreParActiviteBoc input.custom-control-input').click(function(event) {
   
        $(this).parents('form').submit();
    });    
     
        $("#filtre").click(function () {
        if ($(this).prop('checked')) {
            $(".filtre").removeClass('d-none');
        } else {
            $(".filtre").addClass('d-none');
        }
    });

   if ($('.col-filtre input.custom-control-input').is(':checked')) {
        $(".filtre").removeClass('d-none');
        $("input[name='filtre']").attr('checked','checked');
   }


  $("#id_filtreActive").change(function(e){
     if($(this).is(':checked')){
        $("#id_filtreToActive").removeClass('hide');
     }else{
        $("#id_filtreToActive").addClass('hide');
     }
  });

});