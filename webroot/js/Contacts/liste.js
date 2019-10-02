$(document).ready(function(){
    $("#id_chekAll").change(function(){
        if($(this).is(":checked")){
            $(".kl_OneContact").attr("checked",true).prop('checked', true);
        }else{
            $(".kl_OneContact").attr("checked",false).prop('checked', false);
        }
        generateUrlToDelete();
    });
    
    
    $(".kl_OneContact").change(function(){
        generateUrlToDelete();
    });

    $("#id_filtreToActive").change(function(){
        if($(this).is(':checked')){
            $("#id_blocFormFiltre").removeClass('hide'); 
        }else{
            $("#id_blocFormFiltre").addClass('hide');
        }
        
    });
    
    $("#id_avanceFiltre").change(function(){
        if($(this).is(':checked')){
            $(".kl_avanceFiltre").removeClass('hide'); 
        }else{
            $(".kl_avanceFiltre").addClass('hide');
        }
        
    });
    
    //id_tableContact
   // $('#id_tableContact').fixedHeaderTable({ footer: true, cloneHeadToFoot: true, altClass: 'odd', autoShow: false });
   
    /*var clone = $('.tableContact').clone();
    $('#tete').append(clone);
    
    var elements = $('#tete > table > tbody').children();
    $(elements).not(':first').remove();
    console.log(elements);*/
    
      /**
    * Scroll to fixed header
    */
    
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {fixedHeaderTable()};
   
    // Get the header
    var header = $("#id_headeToFixed");
    var wdthHead = header.width();
    // Get the offset position of the navbar
    var sticky = header.offsetTop;
    
    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function fixedHeaderTable() {
        console.log('window.pageYOffset ==>'+window.pageYOffset);
        
      if (window.pageYOffset >= 365) {
        header.addClass("fixed");
        header.css('width', wdthHead);
        $("#id_headeToFixed > #entete_table").css('width', wdthHead);
        //$("#id_bodyConctTable")
      } else {
        header.removeClass("fixed");
      }
    } 
    
    //id_bodyConctTable
    $( "#id_bodyConctTable > tr > td" ).each(function( index ) {
       //console.log( index + ": " + $( this ).text() );
       var currentWidth = $(this).width();
       $("#id_headeToFixed tr th").eq(index).css('width', currentWidth);
       $(this).css('width', currentWidth);
    });
    
});

function generateUrlToDelete(){
    //alert('lelele');
    
    
    var idEvenement = $("#id_evenement").val();
    var baseUrl = $("#id_baseUrl").val();
    var urlDefaultAction = baseUrl+'contacts/deleteSelected/'+idEvenement;
    var list = "list[]=";
    var selected = 0;
    var allCheckBox = 0;
    $( ".kl_OneContact" ).each(function( index, value ) {
        allCheckBox++;
        if($(this).is(":checked")){
            list = list + '&list[]='+$(this).val();
            selected ++;
        }
    });
    var urlActionGenerated = urlDefaultAction + '?'+list;
    $("#id_contactSelected").find('form').attr('action', urlActionGenerated);
    
    if(selected >0){
        
        $("#id_contactSelected").removeClass('hide');
    }else{
        $("#id_contactSelected").addClass('hide');
    }
    
    if(allCheckBox == selected){ // Si tout est cheched
        $("#id_chekAll").attr("checked",true).prop('checked', true);
    }else{ // Si rien est cheched
        $("#id_chekAll").attr("checked",false).prop('checked', false);
    }
    
  
    
    
}