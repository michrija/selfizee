(function($) {

$('.conditional1').hide();
$('.conditional2').hide();
$('.conditional3').hide();
$('.conditional4').hide();
$('.conditional5').hide();
$('.conditional6').hide();
$('.main-wrapper').hide();
$('.fql').hide();
$('#transmis').hide();

$('#is_active_form_down').click( function(){
  if (($(this).is(':checked'))) {
     $('.main-wrapper').show();
     $('#transmis').hide();
     $('.shown').hide();

    var nomChamp = $('#id_nom_champ').val();
    var nomChamps = $('#aimSelf').val(nomChamp);

  }else{
    $('.main-wrapper').hide();
  }
  });

$("#id_ToaddChamp").click( function(){
    $('.fql').show();
    $('.valTra').hide();
    var nomChamp = $('#id_nom_champ').val();
  });

childs_of_bloc_champs = document.getElementById("id_listeChampAdded").childNodes.length;

$("#id_addChamp_popup").click( function(){ 


  if ( childs_of_bloc_champs > 1) {
    $('.fql').show();
    $('.valTra').hide();
  }
  var blocs_form = $('body').find('.kl_oneListe');

  $('#choix-select').empty();
  $.each(blocs_form, function (index, element){
    var elem = $(element);
    var nom_champ = $(element).find("#id_nomChampAdded").val();
    var type_champ = $(element).find("#id_typeChampIdAdded").val();
    var nom_champ = $(element).find("#id_nomChampAdded").val();
    var type_donnee = $(element).find("#id_typeDonneIdAdded").val();
    var is_req = $(element).find("#id_is_required").val();

    console.log(nom_champ);
    console.log(type_champ);    
    console.log(type_donnee);
    console.log(is_req);
    console.log("===================");

    var countOtion = $('.custom-select').val().length;

    $('#choix-select').append($('<option>', {
      value: index + 1,
      text: nom_champ
    }));
    //return false;
    });
});

$('#id_type_champ').change(function(){
  if($(this).val()){

    if($(this).val() == 1){

    }else if ($(this).val() == 2) {

    }else if ($(this).val() == 3) {

    }else if ($(this).val() == 4) {

    }else if ($(this).val() == 5) {

    }
  }
});

$('#id_type_donnee').change(function(){
  if($(this).val()){    
    if ($(this).val() == 1) {

    }else if($(this).val() == 2){
    
    }else if($(this).val() == 3){
    
    }else if($(this).val() == 4){
    
    }else if($(this).val() == 5){
    
    }
  }
});

$('#choix-select').change(function(){
  var blocs_form = $('body').find('.kl_oneListe');
  val = $("#choix-select option:selected").val();
  //alert(val);

  $.each(blocs_form, function (index, element){

      if(val){
             if (val == index+1) {
            /*mi affiche ny questionnaire logique*/
              $('.shown').show(is_req);
            /*************************************/
  /**********************************maka n valeur anat boucle********************************/
              var elem = $(element);
              var nom_champ = $(element).find("#id_nomChampAdded").val();
              type_champ = $(element).find("#id_typeChampIdAdded").val();
              var nom_champ = $(element).find("#id_nomChampAdded").val();
              var type_donnee = $(element).find("#id_typeDonneIdAdded").val();
              var is_req = $(element).find("#id_is_required").val();
  /**********************************maka n valeur anat boucle********************************/
   
   /**********************************mtad n valeurn reo option********************************/

             var choix_possibles = $(element).find('.kl_oneChoixPossible');
             var opts = [];
              $.each(choix_possibles, function (index, element){               
                var opt = $(element).val();
                opts.push(opt);


           });   
              if (type_champ == "2" || type_champ == "4" || type_champ == "5") {
                 $('#translateTo1').text(opts[0]);
                 $('#translateTo2').text(opts[1]);
                } else{
                  $('.shown').hide();
                }

             }
      }

    });
});

  $("#id_yes").click( function(){
    $('.conditional').show();
    $('.conditional3').hide();
  });


  $("#id_no").click( function(){
    $('.conditional').hide();
    $('.conditional3').show();
  });


  $("#checkSur").click( function(){
    $('.conditional1').show();
    $('.conditional2').hide();
  });

  $("#checkPSur").click( function(){
    $('.conditional1').hide();
    $('.conditional2').show();
  });

  $("#checkYes").click( function(){
    $('.conditional4').show();
    $('.conditional5').hide();
  });

  $("#checkNo").click( function(){
    $('.conditional4').hide();
    $('.conditional5').show();
  });
  $('#selectId').on('change', function () {
     var selectVal = $("#selectId option:selected").val();
     if (selectVal == 'yes') {
      $('.conditional6').show();
     }else if (selectVal == 'no') {
      $('.conditional6').hide();
     }
});
    $("#id_yess").click( function(){
      $('.conditional4').show();
      $('.conditional5').hide();
  });


  $("#id_noo").click( function(){
    $('.conditional4').hide();
    $('.conditional5').show();
  });
  /*$("#id_addChamp").click( function(){
    var nbClick = 0;
    nbClick++;
   document.getElementById("nbClick").innerHTML = nbClick;
   if (nbClick > 1) {
    $('#qlActive').show();
   }else if (nbClick <= 1) {
    $('#qlActive').hide();
   }
  });*/
        












  $.fn.conditionize = function(options){ 
    
     var settings = $.extend({
        hideJS: true
    }, options );
    
    $.fn.showOrHide = function(listenTo, listenFor, $section) {
      if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == listenFor ) { 
        $section.slideDown();
      }
      else if ($(listenTo + ":checked").val() == listenFor) {
        $section.slideDown();
      }
      else {
        $section.slideUp();
      }
    } 

    return this.each( function() {
      var listenTo = "[name=" + $(this).data('cond-option') + "]";
      var listenFor = $(this).data('cond-value');
      var $section = $(this);
  
      //Set up event listener
      $(listenTo).on('change', function() {
        $.fn.showOrHide(listenTo, listenFor, $section);
      });
      //If setting was chosen, hide everything first...
      if (settings.hideJS) {
        $(this).hide();
      }
      //Show based on current value on page load
      $.fn.showOrHide(listenTo, listenFor, $section);
    });
  }
}(jQuery));
  
 $('.conditional').conditionize();