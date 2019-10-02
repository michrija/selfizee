$('#marque').click(function(event) {
	if ($('#marque').is(':checked')) {
	  $('.codeCouleur').removeClass('d-none');
    }else {
	$('.codeCouleur').addClass('d-none');
    }
});