$(document).ready(function(){

	/*$( ".kl_InputLogin" ).on('keydown', function(e) {
	  	//alert( "Handler for .focus() called." );
	  	var valeur = $(this).val();
	  	if(valeur.length){
	  		$(this).removeClass('empty');
	  	}else{
	  		$(this).addClass('empty');
	  	}
	});
	*/

	$( ".kl_InputLogin" ).keyup(function( event ) {
	 	var valeur = $(this).val();
	 	var id= $(this).attr('id');
	  	if(valeur.length){
	  		$(this).removeClass('empty');
	  		$(".kl_loginForm label[for="+id+"]").show();
	  		$(".kl_loginForm label[for="+id+"]").removeClass('active').addClass('out');
	  	}else{
	  		$(this).addClass('empty');
	  		$(".kl_loginForm label[for="+id+"]").hide();
	  		$(".kl_loginForm label[for="+id+"]").addClass('active').removeClass('out');
	  	}
	}).keydown(function( event ) {
	 	var valeur = $(this).val();
	 	var id= $(this).attr('id')
	  	if(valeur.length){
	  		$(this).removeClass('empty');
	  		$(".kl_loginForm label[for="+id+"]").show();
	  		$(".kl_loginForm label[for="+id+"]").removeClass('active').addClass('out');
	  	}else{
	  		$(this).addClass('empty');
	  		$(".kl_loginForm label[for="+id+"]").hide();
	  		$(".kl_loginForm label[for="+id+"]").addClass('active').removeClass('out');
	  	}
	});

});