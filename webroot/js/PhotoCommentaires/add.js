$(document).ready(function(){
   
   $(document).on( "submit", "#photoCommentaires", function(e) {
        e.preventDefault();
        var commentateurName = $("#id_commentateurNamePhoto").val();
        var commentaire = $("#id_commentairePhoto").val();
        if(commentateurName && commentaire){
            $.ajax({
                type: "POST",
                url: URL_BASE+'/photoCommentaires/add',
                data: $('#photoCommentaires').serialize(),
                dataType :'json'
                
            }) .done(function( data ) {
                if(data.success){
                    $("#id_commentateurNamePhoto").val("");
                    $("#id_commentairePhoto").val("");
                    var idPhoto = $("#id_theIdPhoto").val();
                    getListCommentaireOfPicture(idPhoto);
                }else{
                    alert("Une erreur est survenue. Veuillez réessayer.")
                }
            });
        }
        return false;
    });
    
    
     $(document).on( "change", "#id_maxLimitPhoto", function() {
        var maxLimit = $(this).val();
        var idPhoto = $("#id_theIdPhoto").val();
        getListCommentaireOfPicture(idPhoto, maxLimit);
    });
    
    
});

function getListCommentaireOfPicture(idPhoto,maxLimit = 25){
    
    $.ajax({
        type: "GET",
        url: URL_BASE+'/photoCommentaires',
        data: "idPhoto="+idPhoto+"&maxLimit="+maxLimit,         
    }) 
    .done(function( data ) {
        $("#id_blocCommentairePhotos").html(data);
    });
}