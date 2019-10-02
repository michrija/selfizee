$(document).ready(function() {

	     //alert("");   
      $("#imgg").on('contextmenu', function(e){ 
        return false; 
      });

      $('#valide_form_reponse').click(function(){
      	$('#modalBeforeDownload').modal('hide');
      });
	  
	$('.a2a_button_linkedin_share_btn').on('click', function(e){
		e.preventDefault();
		var objet = $(this);
		$('#a2a_button_linkedin_share').find('span.IN-widget span').trigger('click');
		console.log('eto');
	});
});