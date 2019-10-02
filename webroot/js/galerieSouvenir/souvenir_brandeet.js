var winwidth = parseInt($(window).width());
var winheight = parseInt($(window).height());
var sharelink = null;
var current_spd_id = 0;
var email_like = null;
var current_url_img ="";
var month_fr = ["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];
var thumb_selected =null;
var t_imgLoaded = {};
var post_shortLink = null;
function verify_select_type_search(selector){
    if(parseInt($(selector).val())>0){
        $("input[name='q']").removeAttr("readonly");
        $('#search_btn').removeAttr('disabled');
    }else{
        $("input[name='q']").attr("readonly");
        $('#search_btn').attr('disabled','disabled');
    }
}

function add_url_fbShare(url){$('meta[property="og:url"]').attr("content",url);}

function open_popupShare(url){
    var w = h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url, 'Partage', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    //window.open(url,'Partage','menubar=no,toolbar=no,resizable=yes,scrollbars=yes, width=600, height=600');
}

function getWindowWidth() {
        return Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
}
function option_print_pictureWookmark (container){
    var wookmark = null;


    wookmark = new Wookmark(container, {
        offset: 2, // Optional, the distance between grid items
        itemWidth: function(){
            if(winwidth<1023) {
                //console.log("inferieur 1024");
                    return '49.5%';
            }else if(winwidth==1024){
                //console.log("Superieur 1023");
                return '24.7%';
            }else if(winwidth>1025 && winwidth<1400){
                //console.log("Superieur 1025");
                return '24.8%';
            }else if(winwidth>1400){
                console.log("Superieur 1400");
                return '24.8%';
            }
        }, // Optional, the width of a grid item
        //outerOffset: 3,
        autoResize: true,
        flexibleWidth:true,
		align: function(){
			if(winwidth<1023) {
                console.log("h inferieur 1023");
                    return 'center';
            }else if(winwidth==1024){
                console.log("h egal 1024");
                return 'left';
            }else if(winwidth>1025 && winwidth<1400){
                console.log("h Superieur 1025");
                return 'left';
            }else{
                return 'center';
            }
			
		}
    });



    return wookmark;

}

function option_print_pictureWookmark_withScolle (){
	
	var wookmark,
          container = '#gallerie',
          $container = $(container),
          $window = $(window),
          $document = $(document),
		  isCharge = false;
	
	var idEvenement = $("#id_evenement").val();
	
	$container.magnificPopup({
       delegate: 'li:not(.inactive) a.kl_toAgrandir',
        type: 'ajax',
		tClose: 'Fermer (Esc)',
		tLoading:'<div id="id_modalGalerie" class="chargement_popup_gal"> <div class="modal-dialog" role="document"> <div class="modal-content kl_modalContent_desktop"> <div class="kl_btnModal hide-desk"><ul><li id="btn_down_picture"><a href="/selfizee/images/download?i=Default_2016-9-12-67234.jpg&amp;_e=Dev-test&amp;_u="><i class="my_icon_Download-01"></i>Télécharger</a></li><li id="id_comment_picture"><a><i class="fa fa-comment"></i>Commenter</a></li><li id="id_share_picture" class="kl_popup_shareImg"><a href="#" class="kl_popup_shareImg"><i class="my_icon_Share-01"></i> Partager</a><div class="kl_boxShare"><a class="kl_email" id="email_popup" data-target="#modalMail"img="'+URL_BASE+'webroot/import/galleries/19/thumbnails/thumb_Default_2016-9-12-67234.jpg"><i class="fa fa-envelope"></i></a><a disabled="disabled" href="https://plus.google.com/share?url=shareLink" title="Partager Google+" class="kl_googlePlus"><i class="fa fa-google-plus-square "></i></a><a disabled="disabled" href="#" class="kl_pinterest" data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" desc_share="description="><i class="fa fa-pinterest-square "></i></a><a disabled="disabled" link-popup="https://twitter.com/intent/tweet?url=shareLink&amp;text=&amp;hashtags=" class="kl_twitter"><i class="fa fa-twitter-square "></i></a><a href="#" class="kl_facebook" disabled="disabled"><i class="fa fa-facebook-square "></i></a></div></li></ul><div class="clearfix"></div></div><button type="button" class="close kl_toClose"><span>×</span></button> <div class="col-md-8 col-sm-6 kl_conLeftModal"> <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> <div class="kl_mobileShow_popupLoad">' +
        '<img src="'+URL_BASE+'webroot/img/load-mobile.svg" alt="" width="55px"/></div> ' +
        '<div id="id_loading_popup"><img src="'+URL_BASE+'webroot/img/load_img.svg" alt=""/></div> ' +
        '<div class="bloc_content"> <div class="kl_btnModal text-center">' +
        ' <ul class="hide"> ' +
        '<li id="btn_down_picture"> <a href="/selfizee/images/download?i=Default_2016-9-12-69156.jpg&amp;_e=Dev-test&amp;_u="><i class="my_icon_Download-01"></i>Télécharger</a> </li><li id="id_share_picture" class="kl_popup_shareImg"> <a href="#" class="kl_popup_shareImg"> <i class="my_icon_Share-01"></i> Partager</a> <div class="kl_boxShare"> <a class="kl_email" id="email_popup" data-target="#modalMail"img="'+URL_BASE+'webroot/import/galleries/19/thumbnails/thumb_Default_2016-9-12-69156.jpg"> <i class="fa fa-envelope"></i></a> <a disabled="disabled" href="https://plus.google.com/share?url=shareLink" title="Partager Google+" class="kl_googlePlus"><i class="fa fa-google-plus-square "></i></a> <a disabled="disabled" href="#" class="kl_pinterest" data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" desc_share="description="> <i class="fa fa-pinterest-square "></i> </a> <a disabled="disabled" link-popup="https://twitter.com/intent/tweet?url=shareLink&amp;text=&amp;hashtags=" class="kl_twitter"> <i class="fa fa-twitter-square "></i> </a> <a href="#" class="kl_facebook" disabled="disabled"><i class="fa fa-facebook-square "></i></a> </div></li><li> <a href="/selfizee/slide-show?album=test"><i class="my_icon_play3"></i>Diaporama</a> </li></ul>' +
        '<div class="pictureLoaded_popup"></div>' +
        ' <div class="clearfix"></div></div></div><div id="item_carousel" class="carousel-inner text-center" role="listbox"> </div></div></div><div class="col-md-4 col-sm-6 kl_conRightModal"> <div class="kl_rightModal"> <div class="kl_boxHeaderModal"> <div class="text-center kl_titleHeader"> <span class="kl_border_bottom"></span> </div></div><div class="kl_blocFbModal"> <div class="kl_conComment"> <div id="commebt_fb" class="fb-comments" data-href="http://localhost/selfizee/2661_picture" data-colorscheme="dark" data-numposts="5" data-width="100%"></div></div><div class="kl_formCommentaire"> <h4>Laisser un commentaire</h4> <form class="kl_commentaire" id="comment_picture_form" method="post"> <textarea placeholder="Votre commentaire *" name="content" required="required"></textarea> <input placeholder="Votre nom *" name="name" required="required" type="text"> <input name="spd_id" value="2661" type="hidden"> <input value="Commenter" type="submit"> </form> </div><div class="kl_contCommentaire hidden" id="bloc_comment_picture"> </div></div></div></div><div class="clearfix"></div></div>' +
        '<div class="modal-content kl_modalContent_mobile hide"> <button type="button" class="close kl_toClose"><span>×</span></button> <div class="kl_infoMobile"> <img src="'+URL_BASE+'webroot/img/information.png"> <i class="fa fa-angle-left"></i> </div><div class="kl_contInfo"> <div class="kl_descImage text-center">Photo prise par <span id="user_posted"></span> le <label id="date_post"></label></div><div class="kl_contTitle"> <h4>Titre ou légende :</h4> <span>Lorem ipsum</span> </div><div class="kl_contTitle"> <h4>Description :</h4> <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span> </div><div class="kl_contTitle"> <h4>Mot clés :</h4> <span>Mot clé1 - Mot clé2 - Mot clé3</span> </div></div><div class="col-md-7 col-sm-6 kl_conLeftModal"> <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> <div id="item_carousel" class="carousel-inner text-center" role="listbox"><img class="kl_theRealImage"><i class="my_icon_Download-01"></i>Télécharger</a> ' +
        '</li>' +
        '<li id="id_comment_picture"><a><i class="fa fa-comment"></i>Commenter</a></li>' +
        '<li id="id_share_picture" class="kl_popup_shareImg"> <a href="#" class="kl_popup_shareImg"> <i class="my_icon_Share-01"></i> Partager</a> <div class="kl_boxShare"> <a class="kl_email" id="email_popup" data-target="#modalMail" img="'+URL_BASE+'webroot/import/galleries/19/thumbnails/thumb_Default_2016-9-12-69156.jpg"> <i class="fa fa-envelope"></i></a> <a disabled="disabled" href="https://plus.google.com/share?url=shareLink" title="Partager Google+" class="kl_googlePlus"><i class="fa fa-google-plus-square "></i></a> <a disabled="disabled" href="#" class="kl_pinterest" data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" desc_share="description="> <i class="fa fa-pinterest-square "></i> </a> <a disabled="disabled" link-popup="https://twitter.com/intent/tweet?url=shareLink&amp;text=&amp;hashtags=" class="kl_twitter"> <i class="fa fa-twitter-square "></i> </a> <a href="#" class="kl_facebook" disabled="disabled"><i class="fa fa-facebook-square "></i></a>' +
        '</div>' +
        '</li>' +
        '</ul><div class="pictureLoaded_popup"></div>'+
        '<div class="clearfix"></div></div></div></div><div class="col-md-5 col-sm-6 kl_conRightModal"> <div class="kl_rightModal"> <div class="kl_closeComment pull-right"><i class="fa fa-reply"></i></div><div class="kl_blocFbModal"> <div class="kl_nbrVue" id="picture_view"> 20 vues pour cette photo actuellement </div><div class="kl_conComment"> <div class="kl_formCommentaire"> <h4>Laisser un commentaire</h4> <form class="kl_commentaire" id="comment_picture_formMobile" method="post"> <textarea placeholder="Votre commentaire *" name="content" required="required"></textarea> <input placeholder="Votre nom *" name="name" required="required" type="text"> <input name="spd_id" value="2661" type="hidden"> <input value="Commenter" type="submit"> </form> </div><div class="kl_contCommentaire hidden" id="bloc_comment_pictureMobile"> </div></div></div></div></div><div class="clearfix"></div></div></div></div>',
        showCloseBtn: false,
        closeOnBgClick : false,
        closeOnContentClick : false,
		gallery: {
			tPrev: 'Précédent',
			tNext: 'Suivant',
			tCounter: '%curr% sur %total%',
			 enabled: true
		},
		image: {
			tError: 'Une erreur sur l\'image.'
		},
		ajax: {
			tError: 'Une erreur est survenue, veuillez réessayer.',
			settings:{cache:true}
		}
	});
	imagesLoaded(container, function () {
        wookmark = option_print_pictureWookmark(container);
		$("#id_loading").addClass("hide");
		isCharge = true;


        //Quand la premeière photo est chargée, charge automatiquement les autres
        //console.log('tout est chargé');
        //onScrollToBottom();
	});

   function onScrollToBottom() {
	   
       var idGallery = $('#id_gallery').val();

	   
        // Check if we're within 100 pixels of the bottom edge of the broser window.
        var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
            closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

		//var page = $( "#id_currentPage" ).val() ;
        var page = $( "li.kl_onePhoto:last-child" ).attr('current_page') ;
		//console.log('the current page '+page);
		var thePage = parseInt(page) + 1;
		var requestSent = false;
		var window_height = document.body.offsetHeight;
		var window_height_in = 0;
        
        var totalPage = $("#id_totalPage").val();
        var pageMax = parseInt(totalPage) + 1;
        
        //alert('ici mec');
        /*console.log('closeToBottom '+closeToBottom);
        console.log('thePage '+thePage);
        console.log('requestSent '+requestSent);
        console.log('isCharge '+isCharge);
		console.log('$("#id_etatRequest").hasClass("fini") '+$("#id_etatRequest").hasClass("fini"));*/
        
        if (thePage < pageMax && closeToBottom && !isNaN(thePage) && !requestSent && $("#id_etatRequest").hasClass("fini") && isCharge ) {
			
			$("#id_etatRequest").removeClass("fini");
			$("#id_loading").removeClass("hide");

            //console.log('je me lance');

			$.ajax({
			  // url: URL_BASE + 'galeries/listes/'+idEvenement+'/'+thePage+location.search,
			   url : URL_BASE +"/galeries/souvenir/"+idGallery+'/?page='+thePage,
			   type: 'get',
			   datatype: 'html',
			   success: function(response){
					//console.log("sucess");
					var $theContent = $(response);
                   //$grid.append( $theContent ).masonry( 'appended', $theContent );
                   $container.append($theContent);
                    //console.log($theContent);
                    
                   imagesLoaded(container, function () {


                           wookmark.initItems();
                           wookmark.layout(true, function () {
                               // Fade in items after layout
                               setTimeout(function() {
                                   $theContent.css('opacity', 1);
                                   $("#id_etatRequest").addClass("fini");
                                   $("#id_loading").addClass("hide");
                               }, 300);
                           });

                       //wookmark =   option_print_pictureWookmark(container);

                   });

			   }                                    
			});
	   
          

          
        }
	};
	// Capture scroll event.
	$window.bind('scroll.wookmark', onScrollToBottom);
	
	 
	$( "body" ).on( "click", ".kl_toClose", function() {
		$.magnificPopup.close(); // Close popup that is currently opened (shorthand)
		//console.log("je tente de fermer");
	});


	
	
			
	//$(".mfp-content").click(function(e) {
	/*$('body').on('mouseover', '.kl_theRealImage', function( event ) {
		console.log('je passe par ici');

		//setTimeout(function() {



	//	}, 150);
	});*/



}
   /**
       * When scrolled all the way to the bottom, add more tiles
       */
function onScroll($container,$window,$document,wookmark) {
	// Check if we're within 100 pixels of the bottom edge of the broser window.
	var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
		closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

	if (closeToBottom) {
	  // Get the first then items from the grid, clone them, and add them to the bottom of the grid
	  var $items = $('li', $container),
		  $firstTen = $items.slice(0, 10).clone().css('opacity', 0);
	  $container.append($firstTen);

	  wookmark.initItems();
	  wookmark.layout(true, function () {
		// Fade in items after layout
		setTimeout(function() {
		  $firstTen.css('opacity', 1);
		}, 300);
	  });
	}
}


function exec_swipe(){
    var magnificPopup = $.magnificPopup.instance;
    $(".kl_theRealImage").swipe( {
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            //console.log("swipe right");
            reloadPicture();
            magnificPopup.next();
        },

        swipeRight:function(event, direction, distance, duration, fingerCount) {
            //console.log("swipe left");
            reloadPicture();
            magnificPopup.prev();
        },
    });
}

function getParamUri(){
    //console.log(location);
    var result = {};
    var param_q = location.search.replace("?","");
    var param_uri = location.pathname.split("/");
    if( param_uri[param_uri.length-1]!==""){
        result.param=param_uri[param_uri.length-1];
    }
    if(param_q !==""){
        result.q=param_q;
    }
    return result;
}
function load_img_completed(position_img,call_back){
    if(t_img.length>position_img){
        loading(position_img+1);
        if(position_img>0){
            option_print_pictureWookmark();
        }
        //console.log(position_img);
        var $img = $("<img>",{src:t_img[position_img],            
            onload:'load_img_completed('+(position_img+1)+','+call_back+')',class:'kl_thumb_picture'});
        $("#img_bloc_"+position_img).prepend($img);
    }else{
        $("#loading").html('');
        option_print_pictureWookmark();
        call_back(position_img);
        return true;
    }
    //position_img++;
}

function load_picture(pos,call_back){
    if(t_img.length>pos){
        var $item_carousel = $("#item_carousel");
        var $div_item = $("<div>",{class:"item"});
        var $div_action = $("<div>",{class:"kl_actionBtn"});
        var $ul = $("<ul>");
        var src_img =  t_img[pos].replace("thumbnails/thumb_","");
        var $img = $("<img>",{src:src_img,onload:'load_picture('+(pos+1)+','+call_back+')'});
        if(pos==0){
            $item_carousel.html('');
            $div_item.addClass('active');
        }
        //console.log(pos);
        /* if($(this).parent().attr("data-wookmark-id")==$(image_active).attr("data-wookmark-id")){
         $div_item.addClass('active');
         }*/
        $div_item.attr("position",pos);
        $item_carousel.append($div_item);
        //$(this).clone().appendTo($div_item);
        $div_item.append($img);
        //$ul.append(li_like,li_down,li_loop);
        $div_action.append($ul);
        $div_item.append($div_action);

    }else{
        call_back(pos);
        return true;
    }

}

function loading_picture(selector){
    //console.log("Loading => "+pos);
    $img = $("<img>",{src:URL_BASE+"webroot/img/load_img.svg",class:'loading_pic'});
    selector.html($img);
}

function remove_loading(id_img){
    var parent = $("#"+id_img).parent();
    var img_loading = parent.children("img.loading_pic");
    img_loading.remove();
    //console.log(img_loading);
}
function loading(pos){
//    console.log("Loading => "+pos);
    $img = $("<img>",{src:URL_BASE+"webroot/img/load_img.svg"});
    $("#loading").html($img);
}
function getPluginCommentFb(){
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];

        //console.log(fjs);
        if (d.getElementById(id)){

            return;
        }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.7&appId="+663316557166239;/**test 663316557166239**/
        //console.log("js =>"+js);

        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));      
}

function getPopupMail(selector){


        if($(selector).attr('disabled')=="disabled"){
            return;
        }
       // thumb_selected = $(this).parent().parent().parent().parent().parent().children('img')
        // thumb_selected  = $(this).parent().parent().parent().parent().children('img');
          current_url_img = thumb_selected.attr('src');
          $('#modalMail').modal('show');
}

window.fbAsyncInit = function() {
          FB.init({
            // appId      : '251319891920842',
             //channelUrl : 'http://selfizee.piloconsult.fr/',
             appId      : '663316557166239',
             channelUrl : 'http://selfizee.fr/',
              xfbml      : true,
              status     : true,
              cookie     : true,
              oauth      : true,
              version    : 'v2.7'
          });

      FB.Event.subscribe('auth.authResponseChange', function(response){
           if (response.status === 'connected') 
          {
              //console.log("connected");
                             FB.api('/me?fields=name,email', function(res) {       
                                   //console.log(res.email);
                                   //console.log(res.name);
                                   //console.log(res.id);

                          });          
                                FB.api('/me/picture?type=normal', function(response) {

                       //console.log(response.data.url);

                  });
              //SUCCESS     
          }    
          else if (response.status === 'not_authorized') 
          {
            //console.log("not_authorized");    
              //FAILED
          } else 
          {
               //console.log("UNKNOWN ERROR");    
              //UNKNOWN ERROR
          }
      }); 

    FB.getLoginStatus(function(response) {
        if (response.status === 'getLoginStatus connected') {
          //console.log("connected");
          var uid = response.authResponse.userID;
          var eid = response.authResponse.emailID;
          var accessToken = response.authResponse.accessToken;
          //console.log(uid);
          //console.log(accessToken);    
        } else if (response.status === 'not_authorized') {
            //console.log("getLoginStatus not authorized");
          // the user is logged in to Facebook, 
          // but has not authenticated your app
        } else {
             //console.log("getLoginStatus not logged in");
          // the user isn't logged in to Facebook.
        }
    });    
//    FB.Event.subscribe('message.send', function(targetUrl) {
//    _gaq.push(['_trackSocial', 'facebook', 'send', targetUrl]);
//  });
};

function share(url){
    //alert('url'+url);
FB.ui({
        method: 'share_open_graph',
        action_type: 'share',
        action_properties: JSON.stringify({
            object:url,
        }),
       href: url,
       oauth: true,
       display:"popup"
     }, 
     function(response){
         if(response && !response.error_message){
             //console.log("Post shared",url);
             //console.log(response);
             //var base_Url  =URL_BASE ;
             ga('send', 'social', 'Facebook', 'send',url);
            // _gaq.push(['_trackSocial', 'facebook', 'send', url]);
             /*ga('send', {
                'hitType': 'social',
                'socialNetwork': 'facebook',
                'socialAction': 'share',
                'socialTarget': url,
             });*/
             //var uri       = url;
                FB.api('/me?fields=name,email,picture', function(res) {       
                     
                        //console.log(res);
                      //  var avatar_url  = escape(res.picture.data.url);
                       $.ajax({
                           url: URL_BASE + 'galeries/saveShared/facebook',
                           type: 'post',
                           data:{url:url},
                           datatype: 'json',
                           success: function(response){
                                //console.log();
                           }                                    
                       });
               });
         }else{
              //console.log("Post cancelled");
         }
     });
}

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    //console.log(fjs);
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.7&appId="+273309153040053;/**test 663316557166239**/
    //console.log("js =>"+js);
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
function getShortLink(url_post,selector,spd_id,call_back){
    var t_url = url_post.split("/");
    var event   = t_url[t_url.length-2];
    var img   = t_url[t_url.length-1];
    var link_twitter = null;
    if(selector !==null) {
        if(typeof selector=="string"){
            selector = $('#'+selector);
        }
        //console.log(selector);
        if(selector.attr('id')=='id_share_picture'){
            console.log(selector.children('.kl_boxShare').children(".kl_twitter"));
            var $twitter = selector.children('.kl_boxShare').children(".kl_twitter");
            var $googleplus = selector.children('.kl_boxShare').children(".kl_googlePlus");
            var $pinterest = selector.children('.kl_boxShare').children(".kl_pinterest");
            var $mail = selector.children('.kl_boxShare').children(".kl_email");
            var $facebook = selector.children('.kl_boxShare').children(".kl_facebook");
        }else{
            var $twitter = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_twitter");
            var $googleplus = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_googlePlus");
            var $pinterest = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_pinterest");
            var $mail = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_email");
            var $facebook = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_facebook");
        }
        console.log($twitter);
        link_twitter = $twitter.attr("link-popup");
        var link_google_plus = $googleplus.attr("href");
        $facebook.attr("disabled","disabled").addClass("kl_socialNetwork_loading");
        $pinterest.attr("disabled","disabled").addClass("kl_socialNetwork_loading");
        $mail.attr("disabled","disabled").addClass("kl_socialNetwork_loading");
        $twitter.attr("disabled","disabled").addClass("kl_socialNetwork_loading");
        $googleplus.attr("disabled","disabled").addClass("kl_socialNetwork_loading");

    }
   // console.log(link_twitter);
    //var $div_comment = $('<div>',{class:"fb-comments"});
    if(post_shortLink !==null){
        post_shortLink.abort();
    }
    post_shortLink = $.post(URL_BASE+'CadreData/getShareLink/'+spd_id,{url:url_post,img:img,event:event},
        function(data){
            sharelink = data;
            if(selector !==null){
                $twitter.attr("link-popup",link_twitter.replace("shareLink",sharelink));
                $twitter.removeAttr("disabled").removeClass("kl_socialNetwork_loading");
                $googleplus.attr("href",link_google_plus.replace("shareLink",sharelink));
                $googleplus.removeAttr("disabled").removeClass("kl_socialNetwork_loading");
                //$pinterest.attr("onclick","open_popupShare('https://www.pinterest.com/pin/create/button/?url="+encodeURI(url_post)+"&media="+encodeURI(url_post)+"&description=Votre description')");
                $pinterest.attr("link-popup","https://www.pinterest.com/pin/create/button/?url="+encodeURI(url_post)+"&media="+encodeURI(url_post)+"&"+$pinterest.attr("desc_share"));
                $pinterest.removeAttr("disabled").removeClass("kl_socialNetwork_loading");
                //$mail.attr("href","mailto:?body="+$mail.attr("desc_share")+"<br>"+sharelink);
                $mail.removeAttr("disabled").removeClass("kl_socialNetwork_loading");
                $facebook.removeAttr("disabled").removeClass("kl_socialNetwork_loading");
            }
            $('meta[property="og:url"]').attr("content",sharelink);
            $('meta[property="og:image"]').attr("content",data.url_image);
            //  $('textarea[name="content"]').val(sharelink);
            $('#link_share').val(sharelink);
            //console.log(sharelink);
            if(typeof call_back !== "undefined")
                call_back();
            //console.log("url à partager=>"+sharelink);
            //console.log($('meta[property="og:url"]'));
            /*$div_comment.attr('data-colorscheme',"dark");
         $div_comment.attr('data-numposts',"5");
         $('.kl_conComment').html($div_comment);*/
    },"json");
}
function popupMobile(){
        if(winwidth >= 770) {
            $(".kl_modalContent_mobile").hide();
                $('.kl_modalContent_desktop').show();
        }
        if(winwidth <= 769){
                $('.kl_modalContent_desktop').hide();
            $(".kl_modalContent_mobile").show();
                var commentHeight = winheight - 40 + "px";
                /*$('.kl_conComment').slimScroll({
                    height: commentHeight
                }); */       
                
                $(".kl_modalContent_mobile .carousel-inner").css("height",winheight-40+"px");
                
                
                
        }
        if(winwidth == 1024){
            $('.kl_modalContent_desktop').hide();
            $(".kl_modalContent_mobile").show();
            }  

    $(".kl_theRealImage").on("load",function(){
        //console.log($(this).attr('spd_id'));
        t_imgLoaded[$(this).attr('spd_id')]=$(this);

    });

}
function heightPopup(){
	var windHeight = $(window).height();
	//$('#item_carousel').css('height',windHeight);
}

function comment_picture(data,maxLimit){
    $.post(URL_BASE+"picture-comments/add-ajax?maxLimit="+maxLimit,data,function(data_result,status,xhr){
        // $("textarea[name='content'],input[name='name']").val('');
        //console.log(data_result);
        displayComment(data_result,"picture");
    },"json");
}

function getComment_picture(spd_id){
    /*$.ajax(,{

     });*/

    $.ajax({
        url: URL_BASE+"picture-comments/get-comments?id_picture="+spd_id+"&maxLimit="+$("#maxLimit_picture").val(),
        type: 'post',

        datatype: 'json',
        success: function(result){
            //console.log(typeof result);
            displayComment(result,"picture");
        }
    });
    /*$.getJSON(URL_BASE+"album-comments/get-comments?ad_id="+ad_id+"&maxLimit="+maxLimit,null,function(result){

     });*/
}

function displayComment(result,type){
    //console.log(typeof result);
    if(typeof result !=="object"){
        data = $.parseJSON(result);
    }else
    if(typeof result =="string"){
        data = $.parseJSON(result);
    }else{
        data = result;
    }
    //console.log(data);
   // return;
    if(data.length==0){
        $('.kl_liste_commentaire').addClass("hidden");
        $('.kl_contCommentaire').addClass("hidden");
        return;
    }
    $('.kl_liste_commentaire').removeClass("hidden");
    $('.kl_contCommentaire').removeClass("hidden");

    if(type=="picture"){
        $("#bloc_comment_picture,#bloc_comment_pictureMobile").html('');
        $("#count_comment_picture,#count_comment_pictureMobile").html(data.length>1?data.length+" commentaires":data.length+" commentaire");
        var $a_repondre = $("<a>",{html:"Laisser un commentaire",class:"kl_replyComm",href:"#comment_picture_form"});
        $.each(data,function(key,comment){
            var $date = new Date(parseInt(comment.comment_date_add)*1000);
            var $div_container = $('<div>',{class:"kl_blocCommentaire"});
            var $div_content = $('<div>',{cl1ass:"kl_BlocComm"});
            var $div_name = $("<div>",{html:comment.name,class:"kl_nameCom"});
            var $div_date = $("<div>",{html:($date.getDate())+' '+month_fr[$date.getMonth()]+" "+
            $date.getFullYear()+' '+$date.getHours()+'H'+$date.getMinutes(),
                class:"kl_dateCom"});
            var $div_text = $("<div>",{html:comment.content,class:"kl_textCom"});

            $div_content.append($div_name,$div_date,$div_text);
            $div_container.html($div_content);
            if(key==data.length-1){
                $div_content.append($a_repondre);
            }

            $("#bloc_comment_picture,#bloc_comment_pictureMobile").append($div_container);
        });
    }else{
        $("#bloc_comment").html('');
        $("#count_comment").html(data.length>1?data.length+" commentaires":data.length+" commentaire");
        var $a_repondre = $("<a>",{html:"Laisser un commentaire",class:"kl_replyComm",href:"#comment_form"});
        $.each(data,function(key,comment){
            var $date = new Date(parseInt(comment.comment_date_add)*1000);
            var $div_container = $('<div>',{class:"kl_blocCommentaire"});
            var $div_content = $('<div>',{cl1ass:"kl_BlocComm"});
            var $div_name = $("<div>",{html:comment.name,class:"kl_nameCom"});
            var $div_date = $("<div>",{html:($date.getDate())+' '+month_fr[$date.getMonth()]+" "+
            $date.getFullYear()+' '+$date.getHours()+'H'+$date.getMinutes(),
                class:"kl_dateCom"});
            var $div_text = $("<div>",{html:comment.content,class:"kl_textCom"});

            $div_content.append($div_name,$div_date,$div_text);
            $div_container.html($div_content);
            if(key==data.length-1){
                $div_content.append($a_repondre);
            }

            $("#bloc_comment").append($div_container);
        });

    }

}

function reloadPicture(popup_currItem){
  /*var modal_existe = $("#id_modalGalerie");
  $("div.mfp-preloader").html(modal_existe.clone());*/
    var next_spd_id = 0;
    var next_item = null;
    var magnific_popup = $.magnificPopup.instance;
    if(typeof popup_currItem=="undefined"){
        next_item = magnific_popup.currItem.index;
    }else{
        next_item =popup_currItem;
    }

    var $loading_popupDiv = magnific_popup.preloader.children().children().children(".kl_modalContent_desktop").children(".kl_conLeftModal").children().children("#id_loading_popup");

    //next_item += next_option;
    next_item = next_item%magnific_popup.items.length;

  /*  if(next_option==-1){
         next_spd_id = $(magnific_popup.items[next_item]).attr("spd_id");
    }else{*/
        if(typeof (magnific_popup.items[next_item]).el =="undefined"){
            next_spd_id = $(magnific_popup.items[next_item]).attr("id_picture");
        }else{
            next_spd_id = (magnific_popup.items[next_item]).el.attr("id_picture");
        }

//    }

//    console.log(t_imgLoaded,next_spd_id);
    if(t_imgLoaded.hasOwnProperty(next_spd_id)){
        $loading_popupDiv.html('');
        $(".pictureLoaded_popup").html(t_imgLoaded[next_spd_id]);
        //console.log($loading_popupDiv,t_imgLoaded[next_spd_id]);
        //$("body").remove(".mfp-preloader");
        return magnific_popup.preloader;
    }else{
        $(".pictureLoaded_popup").html("");
        $("#id_loading_popup").html('<img src="'+URL_BASE+'webroot/img/load_img.svg" alt=""/>');
    }
}

/**Gallerie**/
$(document).ready(function(){
   
   //alert('je passe par ici');
	if($(window).width() < 767){
		heightPopup();
	}
    $(window).resize(function() {
        //resize just happened, pixels changed
        //console.log("je oasse par ici");
        winwidth = parseInt($(window).width());
        option_print_pictureWookmark("#gallerie");
		if($(window).width() < 767){
			heightPopup();
		}
		popupMobile();

    });
    $('body').on('click','button.mfp-arrow.mfp-arrow-right,button.mfp-arrow.mfp-arrow-left',function(e){
        e.preventDefault();

        reloadPicture();

        // magnific_popup.preloader.html(content_html) ;
    });



    	       $('body').on('click', '#id_comment_picture', function() {
                    $(".kl_conRightModal").css("top","0px");
                });
                $('body').on('click', '.kl_closeComment', function() {
                    $(".kl_conRightModal").css("top","100%");
                });
                $('body').on('click', '.kl_infoMobile', function() {
                        if ($(this).hasClass('in')) {
                            $('.kl_infoMobile').removeClass('in');
                            $(this).removeClass('in');
                            $(".kl_contInfo").css("left","-100%");
                        } else {
                            $('.kl_infoMobile').removeClass('in');
                            $(this).addClass('in');
                            $(".kl_contInfo").css("left","0px");
                        }
            
                        return false;
                    }
                );
                $('#id_share_picture').click(
                    function () {
                        if ($(this).hasClass('in')) {
                            $('#id_share_picture').removeClass('in');
                            $(this).removeClass('in');
                        } else {
                            $('#id_share_picture').removeClass('in');
                            $(this).addClass('in');
                        }
            
                        return false;
                    }
                );
    var winheight = parseInt($(window).height());
    $('.selectpicker').selectpicker();
    
    if(winwidth > 768) {
        //$(".kl_modalContent_mobile").remove();
        $(window).scroll(function () {
            if ($(this).scrollTop() > winheight) {
                $(".kl_menu").addClass("kl_fix");
            } else {
                $(".kl_menu").removeClass("kl_fix");
            }
        }); 
    }
    if(winwidth < 768) {
        // $(".kl_modalContent_mobile").remove();
        $(window).scroll(function () {
            if ($(this).scrollTop() > winheight) {
                //$(".kl_topGalerie .navbar-header").addClass("kl_fix");
                $(".kl_topGalerie").addClass("kl_mobileFix");
            } else {
                $(".kl_topGalerie .navbar-header").removeClass("kl_fix");
                $(".kl_topGalerie").removeClass("kl_mobileFix");
            }
        }); 
        $("#id_filtre").appendTo("#id_menuLoupe");
        /*$('#id_galerie,#id_galerie_mobile').click( function(){
            $('#id_filtre').css('display','block');
        });
        $('#id_remerciement,#id_remerciement_mobile').click( function(){
             $('#id_filtre').css('display','none');
         });*/
    }
    $('#id_galerie,#id_galerie_mobile').click( function(){
        $('.kl_blocRemerciement').css('display','none');
        $('.kl_imagesListe').css('display','block');
        $('#id_filtre').css('opacity','1');
        $(this).addClass('active');
        $('#id_remerciement,#id_remerciement_mobile').removeClass('active');
	});
    $('#id_remerciement,#id_remerciement_mobile').click( function(){
        if($(this).attr('class')!=="active"){
            //getComment_album(album_id,$("#maxLimit").val());
        }
        $('.kl_imagesListe').css('display','none');
        $('.kl_blocRemerciement').css('display','block');
        $('#id_filtre').css('opacity','0');
        $(this).addClass('active');
        $('#id_galerie,#id_galerie_mobile').removeClass('active');

       

	});
    $(".kl_navbar_header li:not('.kl_partageSocial')").click(function(){
        $("#menuMobile").css("display","none");
    });
    
    var image_active = null;
    

    function getCommentViewFb(spd_id){
        //return;
        $.get(URL_BASE+"album-data/picture_viewewCommentFb",{spd_id:spd_id},function(result){
            $('.kl_conComment').html(result);
            $("#btn_partage_fb").removeAttr("disabled");
            FB.XFBML.parse();
            //console.log( FB);
           /* var btnFbHeight = $("#id_like>span").innerHeight();
            if (btnFbHeight > 20){
                $(".kl_btnModal > a").css("padding","6px 38px 5px 15px");
            } else
            {
                $(".kl_btnModal > a").css("padding","2px 38px 2px 15px");
            }*/
            
        });
    }

    function comment_album(data,maxLimit){
        $.post(URL_BASE+"galerie-comments/add-ajax?maxLimit="+maxLimit,data+'&album_id='+album_id,function(data_result,status,xhr){
           // $("textarea[name='content'],input[name='name']").val('');
           // console.log(data_result);
            displayComment(data_result);
        },"json");
    }



    function getComment_album(ad_id,maxLimit){
        /*$.ajax(,{

        });*/

        $.ajax({
            url: URL_BASE+"galerie-comments/get-comments?album_id="+ad_id+"&maxLimit="+maxLimit,
            type: 'post',

            datatype: 'json',
            success: function(result){
                displayComment(result);
            }
        });
        /*$.getJSON(URL_BASE+"album-comments/get-comments?ad_id="+ad_id+"&maxLimit="+maxLimit,null,function(result){

        });*/
    }



    function likes_local(spd_id,email){
        $.post(URL_BASE+"picture-likes/add-ajax",{spd_id:spd_id,email:email},function(data_result,status,xhr){
            // $("textarea[name='content'],input[name='name']").val('');
             console.log(data_result);
            $('#btn_like').html(data_result.count);
            //displayComment(data_result);
        },"json");
    }

    function getLike_picture(spd_id){
        $.getJSON(URL_BASE+"picture-likes/getCountLike/"+spd_id,null,function(data_result){
            if(data_result.count)
                $('#btn_like').html(data_result.count);
        });
    }

    function getEmailInSession(){
        $.getJSON(URL_BASE+"picture-likes/getEmailLike/",null,function(data_result){
            if(data_result.email!==0){
                   email_like = data_result.email;
            }
        });
    }
    
    function getUserPost(spd_id){
        $('.kl_descImage').html("");
        $.getJSON(URL_BASE+"album-data/getUserPost/"+spd_id,null,function(result){
           //console.log(result); 
           //$("#user_posted").html(result.login);
          // $("#date_post").html((result.spd_date).replace(" "," à "));
                $('.kl_descImage').html("Photo prise par <span id='user_posted'>"+(result.login)+"</span> le <label id='date_post'>" +
                    (result.spd_date).replace(" "," à ")+"</label>");
        });
    }

    function getCountViewPicture(spd_id){
        $.getJSON(URL_BASE+"picture-likes/setViewPicture",{spd_id:spd_id},function(result){
            $("#picture_view").html(result.count>1?result.count+" vues pour cette photo actuellement":result.count+" vue pour cette photo actuellement");
            //$("#user_posted").html(result.login);
            //$("#date_post").html((result.spd_date).replace(" "," à "));
        });
    }



    function getDataLeftClick(){
        var size_item = $("#item_carousel>*").length;
        var position = parseInt($("#item_carousel>.item.active").attr('position'));
        var curent   = position==0?size_item-1:position-1;
        var li_item  = $("#img_bloc_"+curent);
        image_active= $("#item_carousel>div[position='"+curent+"']");
        current_spd_id=$("#gallerie li[data-wookmark-id='"+curent+"']").attr('spd_id');
        $("#carousel-example-generic").carousel('pause');
        $('.fb-comments').attr('data-href',image_active.children('img').attr('src'));
        $('#btn_down_picture').html(li_item.children('.kl_hoverImg').children("ul").children(".kl_down_picture").children(".kl_saveImg").clone());
        $('#btn_down_picture').children('a').append("<i class='my_icon_Download-01'></i> Télécharger");
        $("#btn_partage_fb").attr("disabled","disabled");
        $("#id_share_picture").html(li_item.children('.kl_hoverImg').children("ul").children(".kl_shareImage").children(".kl_boxShare").clone());
        $("#id_share_picture").prepend("<a href='#' class='kl_popup_shareImg'><i class='my_icon_Share-01'></i> Partager</a>");
        getUserPost(current_spd_id);
        getCountViewPicture(current_spd_id);
        //  getCommentViewFb(image_active.children('img').attr('src'));
        getShortLink(image_active.children('img.kl_picture_carousel').attr('src'),null,current_spd_id,function(){
            getCommentViewFb(current_spd_id);
        });

    }

    function getDataRightClick(){
        var size_item = $("#item_carousel>*").length;
        var position = parseInt($("#item_carousel>.item.active").attr('position'));
        var curent   = position==size_item-1?0:position+1;
        var li_item  = $("#img_bloc_"+curent);
        image_active= $("#item_carousel>div[position='"+curent+"']");
        $("#carousel-example-generic").carousel('pause');
        current_spd_id = $("#gallerie li[data-wookmark-id='"+curent+"']").attr('id_picture');
        $('.fb-comments').attr('data-href',image_active.children('img').attr('src'));
        $('#btn_down_picture').html(li_item.children('.kl_hoverImg').children("ul").children(".kl_down_picture").children(".kl_saveImg").clone());
        $('#btn_down_picture').children('a').append("<i class='my_icon_Download-01'></i> Télécharger");
        $("#id_share_picture").html(li_item.children('.kl_hoverImg').children("ul").children(".kl_shareImage").children(".kl_boxShare").clone());
        $("#id_share_picture").prepend("<a href='#' class='kl_popup_shareImg'><i class='my_icon_Share-01'></i> Partager</a>");
        $("#btn_partage_fb").attr("disabled","disabled");
        getUserPost(current_spd_id);
        getCountViewPicture(current_spd_id);
        getShortLink(image_active.children('img.kl_picture_carousel').attr('src'),null,current_spd_id,function(){
            getCommentViewFb(current_spd_id);
        });
    
	}
	
	option_print_pictureWookmark_withScolle();
	
  /*  
    if(typeof is_galerie!=="undefined"){
       
        if(t_img.length>0){

           load_img_completed(0,function(res){
               var $item_carousel = $("#item_carousel");

            /*   load_picture(0,function(res){
                  console.log(res);
               });

                $('#gallerie>li>img').each(function(pos){
                   var $div_item = $("<div>",{class:"item"});
                   var $div_action = $("<div>",{class:"kl_actionBtn"});
                   var $ul = $("<ul>");
                   var src_img =  $(this).attr('src').replace("thumbnails/thumb_","thumbnails/thumb_popup_");
                   var $img = $("<img>",{src:src_img,id:"img_pos_"+pos,onload:'remove_loading("img_pos_'+pos+'")',class:"kl_picture_carousel"});
                   if(pos==0){
                       $item_carousel.html('');
                       $div_item.addClass('active');
                   }
                   //console.log(pos);

                   $div_item.attr("position",pos);
                   $item_carousel.append($div_item);
                   //$(this).clone().appendTo($div_item);
                   loading_picture($div_item);
                   $div_item.append($img);
                   //$ul.append(li_like,li_down,li_loop);
                   $div_action.append($ul);
                   $div_item.append($div_action);
               });
           }); 
        }
    }
   */

   $('.carousel').carousel({
        interval: false,
        keyboard:true
    }); 
    /*$( "#gallerie > li" )
      .mouseover(function() {
        $( this ).addClass( "in" );
    })
    .mouseout(function() {
        $( this ).removeClass( "in" );
    })*/
	
	$('body').on('mouseover', '#gallerie > li', function( event ) {
		$( this ).addClass( "in" );
	}).on('mouseout', '#gallerie > li', function( event ) {
		$( this ).removeClass( "in" );
	});

	
	
    $( "#gallerie > li" ).click(function(){
        var size_item = $("#item_carousel>*").length;
        var position = parseInt($("#item_carousel>.item.active").attr('position'));
        var curent   = position==size_item-1?0:position+1;
        var li_item  = $("#img_bloc_"+curent);
        $("#btn_partage_fb").attr("disabled","disabled");
        $(".item.active").removeClass("active");
        image_active= $("#item_carousel>div[position='"+$(this).attr("data-wookmark-id")+"']");
        image_active.addClass("active");
        $('.fb-comments').attr('data-href',image_active.children('img').attr('src'));
            current_spd_id = $(this).attr('id_picture');
        $('#btn_down_picture').html($(this).children('.kl_hoverImg').children("ul").children(".kl_down_picture").children(".kl_saveImg").clone());
        $('#btn_down_picture').children('a').append("<i class='my_icon_Download-01'></i> Télécharger");
        $("#id_share_picture").html(li_item.children('.kl_hoverImg').children("ul").children(".kl_shareImage").children(".kl_boxShare").clone());
        $("#id_share_picture").prepend("<a href='#' class='kl_popup_shareImg'><i class='my_icon_Share-01'></i> Partager</a>");
      });
        $(".left").click(function(){
            $("#comment_fb").html('');
            getDataLeftClick();
        });

        $(".right").click(function(){
            $("#comment_fb").html('');
            getDataRightClick();
            //console.log(li_item);
        }); 
      //$(".kl_hoverImg").click(function(){ $('#id_modalGalerie').modal('show');})
    $('#id_modalGalerie').on('shown.bs.modal', function (e) {
        //var winHeight = $(window).height();
        var winWidth = $(window).width();
        if (winWidth>768){
         var modalDialogHeight = $('.modal-dialog').height();
            //$(".kl_conLeftModal").height(modalDialogHeight-136);
            //$(".carousel-inner .item > img").css("max-height","250");
        }
        $("#comment_fb").html('');
        getUserPost(current_spd_id);

        getLike_picture(current_spd_id);
        //getEmailInSession();
        getCountViewPicture(current_spd_id);
        //console.log(image_active.children('img.kl_picture_carousel').attr('src'));
         getShortLink(image_active.children('img.kl_picture_carousel').attr('src'),null,current_spd_id,function(){
             getCommentViewFb(current_spd_id);
         });

    });
    $("#cadre_id,#cadre_id_mobile").change(function(){
        location.href = URL_BASE+"galeries/listes/"+($(this).val());
    });
    
             
   /* $('#modalShare').on('shown.bs.modal',function(){
        //getPluginCommentFb();
        getShortLink(image_active.children('img').attr('src'),null,current_spd_id,function(){
            getCommentViewFb($('meta[property="og:url"]').attr("content"));
        });
        
    });*/
    
    $("body").on('click','.kl_facebook_share',function(e){
        var sharelink = $(this).attr('data-urltoshare');
        
        share(sharelink);
        
        return false;
    });
    
    $("body").on('click','#btn_partage_fb,.kl_btn_partage_fb,.kl_facebook',function(e){
        if($(this).attr("disabled") == "disabled"){
            e.preventDefault();
            return
        }
        /**Permission FB**/
        if($(this).attr('class')=="kl_facebook"){
            var blockParent = $(this).parents(".kl_onePhoto");
            current_url_img = $(blockParent).children("img").attr("src");
            $("textarea[name='messages']").val("");
            $(".alert-success").addClass("hidden");         
            $("#img_share_fb>img").attr('src',current_url_img);
            $('#link_share_fb').val(current_url_img);
            $("#modalFb").modal('show');
            share(sharelink);
            return ;
        }
        /**End**/
        share(sharelink);
        return;
    });
    /**Permission Fb**/
    $("#form_post_fb").submit(function(e){
        e.preventDefault();
        var data = $("#form_post_fb").serializeArray();
        var currentSelected = $("#fb_page_name>option:selected");
        data.push({name:"access_token",value:currentSelected.attr('access_token')},{name:"id_fb_page_externe",value:currentSelected.attr('id_fb_page_externe')});
        
        $(".kl_loadingMail").html('<img src="'+URL_BASE+'webroot/img/load_img.svg" />');
        $.post(URL_BASE+"galeries/share-img-fb",data,function(result){
            if(result.success==true){
                //$(".alert-success").html('');
                $("textarea[name='messages']").val("");
                $(".alert-success").removeClass("hidden");                
            }else{
                $(".alert-dange").removeClass("hidden");
            }
            $(".kl_loadingMail").html('');
        },'json');
    });
    /**End**/
    $(".kl_socialHeader>li").click(function(){
        $('#modalShare').modal('hide');
    });
    
    $( ".kl_topGalerie .navbar-toggle" ).click(function() {
      $( "#menuMobile" ).toggle( "fade" ).css("display","block","!important");
      $(".kl_blockNoir").toggle("fade").css("display","block","!important");
    });
    $( "#id_btnFilter" ).click(function() {
      $( "#id_filtre" ).toggle( "fade" ).css("display","block","!important");
    });
    
    /*$( "#id_btnFilter" ).click(function() {
      $( "#id_menuCenter" ).toggle( "fade" ).css("display","block","!important");
    });*/
    $("body")
      .on("mouseover",".kl_shareImage",function() {
        var current_img = $( this ).parent().parent().parent().children('img');
        $( this ).addClass( "in" );
    })
    .mouseout(function() {
        $( this ).removeClass( "in" );
    });
    
    /*$("body")
      .on("mouseover",".kl_shareImage>a",function() {
        var parent_shareImg = $( this ).parent().parent().parent().parent();
        var current_img = parent_shareImg.children('img');
        current_spd_id=parent_shareImg.attr('spd_id');
       getShortLink(current_img.attr('src').replace("thumbnails/thumb_",""),parent_shareImg,current_spd_id);
    });*/

    $('body').on('mouseover','#id_share_picture',function(){
        //var parent_shareImg = $("#id_share_picture");
        //var current_img = parent_shareImg.children('img');
      //  current_spd_id=parent_shareImg.attr('spd_id');
      //  console.log(current_spd_id);
       // getShortLink(current_url_img,parent_shareImg,current_spd_id);
        $(this).addClass("in");
    });


    $('body').on('mouseout','#id_share_picture',function(){
        $(this).removeClass("in");
    });


    $("body").on('click','.kl_replyComm',function(){
        var theid = $(this).attr('href');
        $('body, html').animate({scrollTop:$(theid).offset().top - 80},1000,null,function(){
            $("textarea[name='content']").trigger("focus");
        });

    });

    /*
    $("#comment_form").submit(function(e){
        e.preventDefault();
        comment_album($(this).serialize(),$("#maxLimit").val());
        document.getElementById("comment_form").reset();
    });*/

    $("body").on("submit","#comment_picture_form,#comment_picture_formMobile",function(e){
        e.preventDefault();
        comment_picture($(this).serialize(),$("#maxLimit").val());
        document.getElementById($(this).attr("id")).reset();
    })
    $("#maxLimit").change(function(){
       getComment_album(album_id,$(this).val());
    });
    $("body").on("change","#maxLimit_picture,#maxLimit_pictureMobile",function(){
        //getComment_picture($("input[name='spd_id']").val());
    });

   /* $("#type_query").change(function(){
        verify_select_type_search(this);
    });*/

    $("#btn_like").click(function(){
        var email = prompt("Entrer Votre e-mail svp...", "example@example.com");
        if(email_like !=null){
            if (email != null) {
                email_like = email;
                //console.log(email);
            }
        }
        likes_local(current_spd_id,email);

    });


    $('a.kl_btnVoir_photo').click(function(){
		var theid = $(this).attr('href');
        $('body, html').animate({scrollTop:$(theid).offset().top -90},1000);
        
	});
    
    $(".kl_select_triSouvernir,.kl_select_triVisiteur").change(function(){
        $("#id_theFiltre").submit();
    });


   /* $("#select_tri").change(function(){
        var param_existe = getParamUri();
        var is_noOrder   = true;
        var idGallery = $('#id_gallery').val();
        var url = URL_BASE+"galeries/souvenir/";
        console.log(param_existe.q,param_existe.param);
        if(typeof param_existe.param !=="undefined"){
            url += param_existe.param+"?order="+$(this).val();
            is_noOrder = false;
            console.log(param_existe.param);
        }
        if(typeof param_existe.q !=="undefined" && is_noOrder){
//            if()
            console.log(param_existe);
            url += (typeof param_existe.param !=="undefined"?"&":"?")+param_existe.q.replace(/order=0|order=1/,"?order="+$(this).val());
            //return;
        }
        
        if(is_noOrder){
            url += "?order="+$(this).val();
            is_noOrder = false;
            console.log(param_existe);
            //return;
        }

        //console.log(url);
        location.href = url;
    });*/

    $('#id_modalGalerie,body').keypress(function(ev){
        $("#comment_fb").html('');
        if(ev.keyCode==37){
            reloadPicture();
            //console.log("left");

        }
        if(ev.keyCode == 39){
//            reloadPicture(1);
//            $.magnificPopup.instance.next();
            //console.log("right");
            reloadPicture();
        }
    });
    $.magnificPopup.instance.open=function(c){
        /*var magnific_popup =this;
        magnific_popup.currItem={
            el: c.el,
            finished:true,
            index:c.el.parents('.kl_onePhoto').attr('data-wookmark-id'),
            parsed:true,
            preloaded:true,
            src:c.el.attr("href"),
            type:"ajax"
        };
        console.log(magnific_popup['currItem'],magnific_popup);*/
        //  reloadPicture($.magnificPopup.instance.currItem.index);
        $.magnificPopup.proto.open.call(this,c);
        reloadPicture();
        //console.log(c);
    };
    $.magnificPopup.instance.next = function(e) {
        //console.log(this.items.length);
        var magnific_popup = this;
        var idEvenement = $("#id_cadreSelected").val();
        var page = $( "li.kl_onePhoto:last-child" ).attr('current_page') ;
        //console.log('the current page '+page);
        var thePage = 0;
        //console.log("postion =>"+magnific_popup.currItem.index);
        //console.log(magnific_popup.items.length);
        if(magnific_popup.currItem.index==magnific_popup.items.length-1){

            /*$.getJSON(URL_BASE+"album-data/getNextId?current_id="+(this.currItem.el.attr('spd_id')),null,function(result){
             console.log(result);
             if(result.length>0){
             // $.magnificPopup.proto.next.call(this);
             }
             });*/
             page = 1;
            thePage = parseInt(page) + 1;

            var container = '#gallerie',
                $container = $(container);

            if (!isNaN(thePage) &&  $("#id_etatRequest").hasClass("fini")) {
                $("#id_etatRequest").removeClass("fini");
                $.ajax({
                   // url: URL_BASE + 'galeries/listes/'+idEvenement+'/'+thePage+location.search,
					url : URL_BASE +"album-data/galerie-souvenir/"+idEvenement+'/'+thePage+location.search,
                    type: 'get',
                    datatype: 'html',
                    success: function(response){
                        //console.log("sucess");
                        if(response.trim()!==""){
                            var $theContent = $(response);
                            //$grid.append( $theContent ).masonry( 'appended', $theContent );
                            $container.append($theContent);
                            imagesLoaded(container, function () {

                                wookmark = option_print_pictureWookmark(container);
                                wookmark.initItems();
                                wookmark.layout(true, function () {
                                    // Fade in items after layout
                                    setTimeout(function() {
                                        $theContent.css('opacity', 1);
                                        $("#id_etatRequest").addClass("fini");
                                        $("#id_loading").addClass("hide");
                                    }, 300);
                                });

                                //wookmark =   option_print_pictureWookmark(container);
                                var parent_picture_next = $.magnificPopup.instance.currItem.el.parents(".kl_onePhoto").next();
                                var el = parent_picture_next.children(".kl_hoverImg").children(".kl_contAgr").children(".kl_agrandir").children("a");
                                magnific_popup.items.push({el:el,
                                    finished:true,
                                    index:magnific_popup.items.length,
                                    parsed:true,
                                    preloaded:true,
                                    src:el.attr("href"),
                                    type:"ajax"
                                });
                                $.magnificPopup.proto.next.call(magnific_popup);
                            });
                        }
                    }
                });
            }
//            $.magnificPopup.proto.next.call(magnific_popup);
            return;

        }else{
             $.magnificPopup.proto.next.call(magnific_popup);
        }

    };


   /* $(".carousel").swipe({

        swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
            $("#comment_fb").html('');
            if (direction == 'left'){
               // console.log("left");
//                $(this).carousel('prev');
                $(this).carousel('next');
                $(this).carousel({interval: false});
                getDataRightClick();


            }
            if (direction == 'right'){
               // console.log("right");
                $(this).carousel('prev');
                $(this).carousel({interval: false});
                getDataLeftClick();
            }

        },
        allowPageScroll:"vertical"
    });*/


    $("body").on('click','.kl_pinterest,.kl_twitter',function (e) {

        //console.log($(this));
        var url = $("meta[property='og:url']").attr("content");
        var currClass = $(this).attr("class");
        if($(this).attr("disabled")=="disabled"){
            e.preventDefault();
            return;
        }
        
       
        open_popupShare($(this).attr("link-popup"));
        /*switch(currClass){
            case "kl_pinterest":
                    ga('send', 'social', 'Pinterest', 'send', url);
                    $.ajax({
                           url: URL_BASE + 'galeries/saveShared/pinterest',
                           type: 'post',
                           data:{url:url},
                           datatype: 'json',
                           success: function(response){
                                console.log(response);
                           }                                    
                       });
                break;
            case "kl_twitter":
                     ga('send', 'social', 'Twitter', 'Tweet',url);
                     $.ajax({
                           url: URL_BASE + 'galeries/saveShared/twitter',
                           type: 'post',
                           data:{url:url},
                           datatype: 'json',
                           success: function(response){
                                console.log(response);
                           }                                    
                       });
                break;
        }*/
        return;
    });

    $("body").on('click','.kl_googlePlus',function(e) {
        e.preventDefault();
        if ($(this).attr("disabled") == "disabled") {

            return;
        }
        var url = $("meta[property='og:url']").attr("content");
         ga('send', 'social', 'Googleplus', 'send',url);
        //console.log($(this));
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
        return false;
    });
    $("#form_mailShare").submit(function(e){
        e.preventDefault();
        //data = $("#form_mailShare").serialize();
        $.post(URL_BASE+"galeries/share-mail",$("#form_mailShare").serialize(),function(result){
            //$(".kl_loadingMail").html('<img src="'+URL_BASE+'webroot/img/load_img.svg" />');
            if(result.success==true){
                $("input[name='name'],input[name='lastname'],input[name='sender'],input[name='email']," +
                    "input[name='subject'],textarea[name='content']").val("");
                $(".alert-success").html('L\'email a bien été envoyé. Votre destinataire va recevoir un email contenant un lien vers la photo.');
                $(".alert-success").removeClass("hidden");
               $(".kl_loadingMail").html('');
                $(".kl_loadingMail").empty();
                var url = $("meta[property='og:url']").attr("content");
                ga('send', 'social', 'Mail', 'send',url);

            }else{
                $(".alert-danger").html("Erreur lors de l'envoi du mail, veuillez réesayer.");
                $(".alert-dange").removeClass("hidden");
                $(".kl_loadingMail").empty();
                $(".kl_loadingMail").html('');
            }
            //$(".kl_loadingMail").html('');
            //$(".kl_loadingMail").empty();
        },'json');

    });
    $('#modalMail').on("shown.bs.modal",function(){
        $.magnificPopup.close();
        $(".alert-success,.alert-dange").addClass("hidden");
        $("input[name='email']," +
            'textarea[name="content"]').val("");
        $(".kl_loadingMail").html('');
        //console.log(current_url_img);
        $('input[name="img"]').val(current_url_img);
        $("#img_share>img").attr('src',current_url_img);
    });
    
    var winheight = parseInt($(window).height());
     
        if(winwidth > 768) {
           // $(".kl_modalContent_mobile").remove();
            $(window).scroll(function () {
                if ($(this).scrollTop() > winheight) {
                    $(".kl_menu").addClass("kl_fix");
                } else {
                    $(".kl_menu").removeClass("kl_fix");
                }
            }); 
        }
    
    
    
    
    $('.kl_conComment').slimScroll({
            height: '470px'
    });
    $('body').on('click','.kl_email',function(e){
       var extension = "";
        if($(this).attr('disabled')=="disabled"){
            return;
        }
        if( $(this).attr('id') !=="email_popup"){
            thumb_selected = $(this).parent().parent().parent().parent().parent().children('img');
            current_url_img = thumb_selected.attr('src');
            extension = current_url_img.split('.').pop();
        }else{
            current_url_img = $(this).attr('img');
            extension = current_url_img.split('.').pop();
        }
        if(extension.trim()!=="" && extension=="mp4")
            current_url_img = current_url_img.replace(extension,extension+".jpg");
       // thumb_selected  = $(this).parent().parent().parent().parent().children('img');
        console.log(current_url_img);
        $('#modalMail').modal('show');
        return;
    });

   /* $('#modalMail').on("shown.bs.modal",function(){
        //var t_uri = image_active.children('img.kl_picture_carousel').attr('src').split('/');
      // var t_uri = thumb_selected;
        //var url = t_uri[0]+'//'+t_uri[1]+''+t_uri[2]+'/'+t_uri[3]+'/'+t_uri[4]+'/'+t_uri[5]+"/thumbnails/thumb_"+t_uri[6];
       // var picture_name = t_uri[t_uri.length-1];
       // var folder       = t_uri[t_uri.length-4]+"/"+t_uri[t_uri.length-3]+"/"+t_uri[t_uri.length-2];
       // var url = URL_BASE+folder+"/thumbnails/thumb_"+picture_name; //online

    });*/


    /*$(".kl_toAgrandir").click(function(){
        console.log($(this).parent().parent().parent().parent().children('img'));
        thumb_selected= $(this).parent().parent().parent().parent().children('img');
        current_url_img = thumb_selected.attr('src').replace("thumbnails/thumb_","");
        //image_active.addClass("active");
    });*/
    $('.mfp-close').click(function(){
        $('#id_modalGalerie').modal('hide');
        return;
    });

	//console.log('refresh');
});
