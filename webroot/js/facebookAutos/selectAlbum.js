$(document).ready(function(){
    //alert("je passe par ici");
    $("#id_pageFacebook").change(function(){
        var id = $(this).val();
        $("#id_page_"+id).prop('checked', true);
        $("#id_page_name_"+id).prop('checked', true);
    });
    
    $("#id_listeAlbums").change(function(){
        var value = $(this).val();
        //alert("the value "+value);
        if(value == 'create'){
            $("#id_createAlbum").removeClass("hide");
            $("#id_isCreation").prop('checked', true);
        }else{
            $("#id_createAlbum").addClass("hide");
            $("#id_isCreation").prop('checked', false);
            $("#id_album_name_"+value).prop('checked', true);
        }
    });
    
    $("#id_createNew").click(function(){
        $("#id_createAlbum").removeClass("hide");
        $("#id_isCreation").prop('checked', true);
        $("#id_listeAlbums").val('create');
        $('#id_listeAlbums').trigger('change');
    });
    
    
    
    $(".select2").select2();
    
   
    
    $('input[type=radio][name=is_active]').change(function() {
        if (this.value == '1') { //Oui
            $("#id_toActiveCron").removeClass("hide");
        }
        else if (this.value == '0') { // Non
             $("#id_toActiveCron").addClass("hide");
        }
    });

    $('input[type=radio][name=is_programmee]').change(function() {
        if (this.value == '1') { //Oui
            $("#id_activeEnvoiProgramme").removeClass("hide");
        }
        else if (this.value == '0') { // Non
             $("#id_activeEnvoiProgramme").addClass("hide");
        }
    }); 
});