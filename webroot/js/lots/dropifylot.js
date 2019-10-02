$('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });

$('#pblt_gain').hide();
$('#hr_gain').hide();

val = $("#tp_gain option:selected").val();
if (val == "probabilité") {
    $('#pblt_gain').show();
    $('#hr_gain').hide();        	
   }else if (val == "instant gagnant") {
   	$('#pblt_gain').hide();
    $('#hr_gain').show();
}
 
$('#tp_gain').change( function(){
   val = $("#tp_gain option:selected").val();
   if (val == 1) {
  	$('#pblt_gain').show();
    $('#hr_gain').hide();    
   }else if (val == 2) {
   	$('#pblt_gain').hide();
    $('#hr_gain').show();
   }else if (val == 0) {
   	$('#pblt_gain').hide();
    $('#hr_gain').hide();
   }

   if (val == "probabilité") {
    $('#pblt_gain').show();
    $('#hr_gain').hide();
    $('hr_gain').val() == '';    	
   }else if (val == "instant gagnant") {
   	$('#pblt_gain').hide();
    $('#hr_gain').show();
	}
});