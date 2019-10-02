$(function () {
   $(".tooltipeTimeline").tooltip();
	
	$('.sf-control-caractere').on('input', function(){
		var obj = $(this).parent().find('#sf-control-caractere-restant');
		var size = $(this).attr('maxlength');
		var texte = $(this).val();
		console.log(texte);
		console.log(texte.length);
		if(texte.length <= size){
			obj.text(parseInt(size) - parseInt(texte.length));
		}
		
	});
	
	$('.sf-menu').on('click', function(e){
		e.preventDefault();
		var objet = $(this);
		
		if(objet.hasClass('active')){
			objet.removeClass('active');
			/* $('#sf-menu-contenu').addClass('hide').removeClass('sf-menu-tohide'); */
			$('#sf-menu-contenu').hide(200);
			$('body').css('overflow-y', 'auto');
			$('.sf-menu-link').removeClass('hide');
		}else{
			objet.addClass('active');
			/* $('#sf-menu-contenu').addClass('sf-menu-tohide').removeClass('hide'); */
			$('#sf-menu-contenu').show(200);
			$('.sf-menu-link').addClass('hide');
			$('body').css('overflow-y', 'hidden');
		}
	});
	
	$(".sf-scroll-to").click(function (e){
		e.preventDefault();
		var id = jQuery(this).attr('href');
		$('html, body').animate({
			scrollTop: $(id).offset().top
		}, 600);
	});
	
	setTimeout(function(){
		var obj = $('.cc-banner').find('.cc-link');
		obj.css('display', 'none');
		$('.cc-compliance').css('display', 'none');
		// var _link = $('.cc-compliance').html();
		var _html = '<div class="cc-compliances"><a aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss sf-default">Ok</a><a class="sf-send" href="https://rgpd.selfizee.fr/politique-relative-a-utilisation-des-cookies">Plus de détails</a></div>';
		$(_html).insertAfter('.cc-compliance');
		// _html.find('.cc-dismiss').addClass('sf-default');
	}, 100);
	
    jQuery('#sf-post').on('submit', function(e){
		e.preventDefault();
		var objet = jQuery(this);
		var email = objet.find('#sf-email').val();
		
		if(jQuery.trim(email) != ''){
			jQuery.ajax({
				url: '/rgpd/inscription',
				type: 'post',
				
				data: {
					'email': jQuery.trim(email)
				},
				dataType: 'json',
				
				beforeSend: function(){
					jQuery('#sf-bloc-replace').html('<img style="margin-top: 65px;" src="/img/load-mobile.svg">');
				},
				success: function(data){
					setTimeout(function(){
						jQuery('#sf-bloc-replace').html(data);
					}, 400);
				},
				error: function(){
					
				}
			});
		}
		
	});
});