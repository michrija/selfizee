$(document).ready(function(){

    
   $( "body" ).on( "click", "ul#id_navTab > li > a", function() {
    
        $("#id_navTab li").removeClass('active');
        $(this).addClass('active');
        
        var toAdctiDiv = $(this).attr('data-to');
        $(".kl_contentTab").addClass('hide');
        $("#"+toAdctiDiv).removeClass('hide');
        
        return false;
    });
    
    
    
    
    //Suppresion du contact de la photo dans le popup
    $("body").delegate(".kl_deleteContactPhoto", "click", function(){
        var idTodelete = $(this).attr("id").slice(18);
        deleteContactInPopup(this, idTodelete);
    });

    //====== Suppression photos multiple
    /*$("#id_checkAll").change(function(){
        //alert('');
        if($(this).is(":checked")){
            $(".kl_onePhoto_checked").attr("checked",true).prop('checked', true);            
            $("#id_btn_delete_all").addClass('hide');
        }else{
            $(".kl_onePhoto_checked").attr("checked",false).prop('checked', false);        
            $("#id_btn_delete_all").removeClass('hide');
        }
        generateUrlToDelete();
    });*/

    $("#id_checkAll").on('ifChanged', function(e){
        //alert();
		var elCheck = Boolean(e.currentTarget.checked);
		if(elCheck){
			$(".kl_onePhoto_checked").iCheck('check');
			$('#id_photosSelected').removeClass('hide').css('display', 'block');           
            $("#id_btn_delete_all").addClass('hide');
		}else{
			$(".kl_onePhoto_checked").iCheck('uncheck');
			$('#id_photosSelected').addClass('hide').css('display', 'none'); 
            $("#id_btn_delete_all").removeClass('hide');
		}
		generateUrlToDelete();
	});
	$('.kl_onePhoto_checked').on('ifChanged', function(e){
		var elCheck = Boolean(e.currentTarget.checked);
		generateUrlToDelete();
    });
    //==========
    $(".kl_onePhoto_checked").change(function(){
        generateUrlToDelete();
    });

});

function generateUrlToDelete(){
    //alert('lol');
    
    var idEvenement = $("#id_evenement").val();
    var baseUrl = $("#id_baseUrl").val();
    var urlDefaultAction = baseUrl+'photos/deletePhotosSelected/'+idEvenement+"/1";
    var list = "list[]=";
    var selected = 0;
    var allCheckBox = 0;
    $( ".kl_onePhoto_checked" ).each(function( index, value ) {
        allCheckBox++;
        if($(this).is(":checked")){
            list = list + '&list[]='+$(this).val();
            selected ++;
        }
    });
    var urlActionGenerated = urlDefaultAction + '?'+list;
    $("#id_photosSelected").find('form').attr('action', urlActionGenerated);
    
    if(selected >0){
        $('#id_photosSelected').removeClass('hide').css('display', 'block');            
        $("#id_btn_delete_all").addClass('hide');
    }else{
        $("#id_photosSelected").addClass('hide');           
        $('#id_photosSelected').addClass('hide').css('display', 'none'); 
        $("#id_btn_delete_all").removeClass('hide');
    }
    
    /*if(allCheckBox == selected){ // Si tout est cheched
        $("#id_chekAll").attr("checked",true).prop('checked', true);
    }else{ // Si rien est cheched
        $("#id_chekAll").attr("checked",false).prop('checked', false);
    }*/
    
}

function deleteContactInPopup(sender, idTodelete){
    var URL_BASE = $("#id_baseUrl").val();
    $.ajax({
        url: URL_BASE+"contacts/deleteAjax/"+idTodelete,
        type: 'POST',
        beforeSend : function(){
           $(sender).find(".kl_loader").removeClass("hide");
        },
        success: function (data, textStatus, jqXHR) {
               $("#id_contentContact").empty();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}
