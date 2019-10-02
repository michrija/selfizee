$(document).ready(function(){
    $('.selectpicker').selectpicker();
    
    $("#galerieCommentaire").submit(function(e){
        e.preventDefault();
        var commentateurName = $("#id_commentateurName").val();
        var commentaire = $("#id_commentaire").val();
        if(commentateurName && commentaire){
            $.ajax({
                type: "POST",
                url: URL_BASE+'/galerieCommentaires/add',
                data: $('#galerieCommentaire').serialize(),
                dataType :'json'
                
            }) .done(function( data ) {
                //alert( "Data Saved: " + msg );
                if(data.success){
                    $("#id_commentateurName").val("");
                    $("#id_commentaire").val("");
                    getListCommentaireOfGalerie();
                }else{
                    alert("Une erreur est survenue. Veuillez réessayer.")
                }
            });
        }
        return false;
    });
    
    $( "#id_contentCommentaire" ).on( "change", "#id_maxLimit", function() {
        var maxLimit = $(this).val();
        getListCommentaireOfGalerie(maxLimit);
    });
    
    getListCommentaireOfGalerie();
});

function getListCommentaireOfGalerie(maxLimit = 25){
    var idGalerie = $('#id_galerieId').val();
    $.ajax({
        type: "GET",
        url: URL_BASE+'/galerieCommentaires',
        data: "idGalerie="+idGalerie+"&maxLimit="+maxLimit,         
    }) 
    .done(function( data ) {
        $("#id_contentCommentaire").html(data);
    });
}