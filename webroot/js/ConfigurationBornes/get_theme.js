$(document).ready(function(){
	$(".sf-bloc-theme-images").slimScroll({
		height: '320px'
	});
	
	var type_borne = $('#sf-type-borne').val();
	
	/* .trigger('click'); */
	
	$('.sf-borne-onglet a').on('click', function(){
		var obj = $(this);
		$('.sf-borne-onglet li').removeClass('active');
		obj.parent().addClass('active');
		var id = obj.attr('href');
		
		var type_borne = id.replace('#', '');
		$('#sf-type-borne').val(type_borne);
		
		$('.sf-bloc-detail-borne').addClass('hide');
		$(id).removeClass('hide');
	});
	$('#tp-'+type_borne).trigger('click');
});