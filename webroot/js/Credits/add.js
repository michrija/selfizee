$(document).ready(function(){

    
    $(".select2").select2();

    
    var form = $(".tab-wizard").show();
    $(".tab-wizard").steps({
        headerTag: "h6"
        , bodyTag: "section"
        , transitionEffect: "fade"
        , titleTemplate: '#title#'
        , labels: {
            finish: 'terminer',
            next : '<span class="next">Continuer</span>',
            previous : '<span class="prevT">Précédent</span>'
        }
        , onStepChanging: function (event, currentIndex, newIndex) {
          // checkValue();
          // removeClassPay();
            checkValueOnchange();
            //rediretToApiStripe(currentIndex, newIndex);
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        }
        , onFinishing: function (event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        }
        , onFinished: function (event, currentIndex) {
           
            if(!$('#mep_cadre_catalogue').is(':checked')){
                $("#payment-form").submit();
            }else {
              rediretToApiStripe();
            }
             //swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
             
        }
    });
/*    $(".tab-wizard").validate({
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
    });*/
  
    //ici Rija
  /*    $('.pay').click(function(event) {
       $('.next').click();
     }); */ 
      address= $('.adressName').text();
      code= $('.adressCode').text();
      cp= $('.adresscp').text();
      adresseTexts = $('.adresseText').val(address +' \n'+ code +' \n'+ cp);
      adresseText =adresseTexts.val();
      $('.editAdress').click(function(event) {
       $('.adressName').addClass('d-none');
       $('.adressCode').addClass('d-none');
       $('.adresscp').addClass('d-none');
       $('.adresseText').removeClass('d-none');
     });
      check= $('.card').hasClass('active-price');
      var price=0;
      var sms =0;
       if (check==true) {
         
         price =$('.active-price').attr('data-price');
         sms =$('.active-price').attr('data-sms');
         campagne =$('.campagne').val();
         ajax(price,sms,campagne,adresseText);

       }
    $('.price-box').click(function(event) { 
        event.preventDefault();
        price = $(this).attr('data-price');
        sms = $(this).attr('data-sms');
        campagne =$('.campagne').val();
        ajax(price,sms,campagne,adresseText);
        $('.price-box').removeClass('bg-danger active-price')
        $(this).addClass('bg-danger active-price');
        $('.check-data-id').val($(this).attr('data-id'));
    });

    firstPriceHref = $('.price-box:eq(0)');
    $('.check-data-id').val(firstPriceHref.attr('data-id'));
    function ajax(price,sms,campagne,adresseText){
      var priceTtc =price*1.2
      priceTtc = priceTtc.toFixed(2);
      url = $('.url').attr('href');
      $.get(url, {priceTtc:priceTtc,price:price,nbr_sms:sms,campagne:campagne,title:adresseText},function(data) {
       
        $('.sms').text(data.nbr_sms);
        $('.price').text(data.price);
        $('.montant').text(data.price +' €');
        
        var tva =data.price * 0.2;
        tva=tva.toFixed(2);
        $('.tva').text(tva +' €');
        var ttc =data.price * 1.2;
        ttc= ttc.toFixed(2);
        $('.total').text(ttc +' €');

     });
    }

  $('.checkChange').on('keyup , change', function (event){
     if($(this).hasClass('sms')){
        var sms = $(this).val();
        var price = $('.price').val();
     }else{
       var price = $(this).val();
       var sms = $('.sms').val();
     }
      campagne =$('.campagne').val();
     ajax(price,sms,campagne,adresseText);
  });
  $('.editer').click(function(e) {
    e.preventDefault();
    $('.prevT').trigger('click');
  });
  $('.adresseText').on('keyup , change', function(event) {
     event.preventDefault();
     adresseText =$('.adresseText').val();
     ajax(price,sms,campagne,adresseText);
  });

 function checkValueOnchange(){

  //$('.cb').removeClass('d-none');
  if ($('#mep_cadre_catalogue').is(':checked')) {
  $('.Confirmation').removeClass('d-none');
  $('.message').addClass('d-none');
  $('.cb').removeClass('d-none');
  }
   $('input[name="type_mise_en_page_id"]').click(function(event) {
        if ($(this).is(':checked')) {
           value = $(this).val();
          if (value==1) {
            $('.cb').removeClass('d-none');
            $('.cheque').addClass('d-none');
            $('.virement').addClass('d-none');
            $('.Confirmation').removeClass('d-none');
            $('.message').addClass('d-none');
            $('#mep_cadre_catalogue').attr('checked');
          }else if (value==2) {
            $('.cb').addClass('d-none');
            $('.cheque').removeClass('d-none');
            $('.virement').addClass('d-none');
            $('.Confirmation').addClass('d-none');
            $('.message').removeClass('d-none');
            $('#mep_cadre_catalogue').removeAttr('checked');
          }else {
             $('.cb').addClass('d-none');
            $('.cheque').addClass('d-none');
            $('.virement').removeClass('d-none');
            $('.Confirmation').addClass('d-none');
            $('.message').removeClass('d-none');
            $('#mep_cadre_catalogue').removeAttr('checked');
          }

        }
    }); 
 } 
 function rediretToApiStripe(){
  url = $('.valider').attr('href');
  window.location.href = url;
 }  

});
