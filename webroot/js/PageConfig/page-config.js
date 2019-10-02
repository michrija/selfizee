$(document).ready(function(){
	$(".colorpicker1").asColorPicker();
	
	$('.dropify').dropify({
        messages: {
            default: 'Glissez-déposez votre cadre ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });
	
	$('.dropify-clear').on('click', function(){
		$('#fichier').val('');
		$('#fichier-tmp').attr('required', true);
	});
});