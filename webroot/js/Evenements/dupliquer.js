$(document).ready(function(){
	console.log('je passe ici');

	$("#id_nom_dup").stringToSlug({
	    setEvents: 'keyup keydown blur',
	    getPut: '#id_slug_dup',
	    space: '-',
	    prefix: '',
	    suffix: '',
	    replace: '',
	    AND: 'et',
	    options: {
	        maintainCase : true,
	        lang :'fr'
	    },
	    callback: function(text) {
	        $("#id_slug_dup").val(text.toUpperCase());
	    }
	});
});