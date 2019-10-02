var sharelink = null;
var img_list = [];


function load_img_thumbnail_completed(position_img,call_back){
    if(t_img.length>position_img){
        loading(position_img+1);
        //console.log(t_img[position_img]);
        var $img = $("<img>",{src:t_img[position_img],            
            onload:'load_img_thumbnail_completed('+(position_img+1)+','+call_back+')'});
        $("#img_bloc_"+position_img).prepend($img);
    }else{
        $("#loading").html('');
        call_back(position_img);
        return true;
    }
}

function load_img_completed(position_img,call_back){
    if(img_list.length>position_img){
        var $item_carousel = $("#item_carousel"); 
        //loading(position_img+1);
        //console.log(t_img[position_img]);
        var $img = $("<img>",{src:img_list[position_img],            
            onload:'load_img_completed('+(position_img+1)+','+call_back+')'});
        var $div_item = $("<div>",{class:"item"});
        var $div_action = $("<div>",{class:"kl_actionBtn"});
        var $ul = $("<ul>");
//        var li_like  = $("<li>",{html:"<a><img src='"+URL_BASE+"webroot/img/likeBtn.png'></a>"});
//        var li_down  = $("<li>",{html:"<a><img src='"+URL_BASE+"webroot/img/down.png'></a>"});
//        var li_loop  = $("<li>",{html:"<a><img src='"+URL_BASE+"webroot/img/loopBtn.png'></a>"});
               
        if(position_img==0){
            $item_carousel.html('');
            $div_item.addClass('active');  
        }

        $div_item.attr("position",position_img);
        $item_carousel.append($div_item);

        $div_item.append($img);
        $div_action.append($ul);
        $div_item.append($div_action);
    }else{
        $("#loading").html('');
        call_back(position_img);
        return true;
    }
}

function loading(pos){
    $img = $("<img>",{src:URL_BASE+"webroot/img/load_img.svg"});
    $("#loading").html($img);
}
function getPluginCommentFb(){
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        //console.log(fjs);
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.7&appId=663316557166239";/**test 663316557166239**/
        console.log("js =>"+js);
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));      
}
window.fbAsyncInit = function() {
          FB.init({
            //   appId      : '251319891920842',
             // channelUrl : 'http://selfizee.piloconsult.fr/',
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
              console.log("connected");
                             FB.api('/me?fields=name,email', function(res) {       
                                   console.log(res.email);
                                   console.log(res.name);
                                   console.log(res.id);

                          });          
                                FB.api('/me/picture?type=normal', function(response) {

                       console.log(response.data.url);

                  });
              //SUCCESS     
          }    
          else if (response.status === 'not_authorized') 
          {
               console.log("not_authorized");    
              //FAILED
          } else 
          {
               console.log("UNKNOWN ERROR");    
              //UNKNOWN ERROR
          }
      }); 

    FB.getLoginStatus(function(response) {
        if (response.status === 'getLoginStatus connected') {
          console.log("connected");
          var uid = response.authResponse.userID;
          var eid = response.authResponse.emailID;
          var accessToken = response.authResponse.accessToken;
          console.log(uid);
          console.log(accessToken);    
        } else if (response.status === 'not_authorized') {
            console.log("getLoginStatus not authorized");
          // the user is logged in to Facebook, 
          // but has not authenticated your app
        } else {
             console.log("getLoginStatus not logged in");
          // the user isn't logged in to Facebook.
        }
    });    
};
function share(url){
FB.ui({
       method: 'share',
       href: url,
       oauth: true
     }, 
     function(response){
         if(response && !response.error_message){
             console.log("Post shared");
             //var base_Url  =URL_BASE ;
             var uri       = url;
                FB.api('/me?fields=name,email,picture', function(res) {       
                        console.log(res.email);
                        console.log(res.name);
                        console.log(res.id);
                        console.log(res.picture.data.url);
                        var avatar_url  = escape(res.picture.data.url);
                       $.ajax({
                           url: URL_BASE + 'images/facebook',
                           type: 'post',
                           data:'_mail=' + res.email + '&_name=' + res.name  + '&_fid=' + res.id + '&_avatar=' + avatar_url + '&_uri=' + uri,
                           datatype: 'json',
                           success: function(response){

                           }                                    
                       });
               });
         }else{
              console.log("Post cancelled");
         }
     });
}

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/fr_FR/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
   
/**Gallerie**/
$(document).ready(function(){
    var image_active = null;
    
    function getShortLink(url_post,selector){
        var t_url = url_post.split("/");
        var event   = t_url[t_url.length-2];
        var img   = t_url[t_url.length-1];
        
        //var $div_comment = $('<div>',{class:"fb-comments"});
        $.post(URL_BASE+'cadre-data/getShareLink/',{url:url_post,img:img,event:event},function(data){ 
         
          sharelink = data.substr(1,data.length-2);
          if(typeof selector !=="undefined"){
            
            var $twitter = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_twitter");
            var $googleplus = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_googlePlus");
            var $pinterest = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_pinterest");
            var $mail = selector.children(".kl_hoverImg").children(".pull-right").children(".kl_shareImage").children(".kl_boxShare").children(".kl_email");
            var link_twitter = $twitter.attr("href");
            var link_google_plus = $googleplus.attr("href");
            $twitter.attr("href",link_twitter.replace("sharelink",sharelink));
            $googleplus.attr("href",link_google_plus.replace("shareLink",sharelink));
            $pinterest.attr("href","https://www.pinterest.com/pin/create/button/?url="+encodeURI(sharelink)+"&media="+encodeURI(sharelink)+"&description=Votre description");
            $mail.attr("href","mailto:?body="+sharelink);
          }
          $('meta[property="og:url"]').attr("content",sharelink);
          
          
          /*$div_comment.attr('data-colorscheme',"dark");
          $div_comment.attr('data-numposts',"5");
          $('.kl_conComment').html($div_comment);*/
        });
    }
    function getCommentViewFb(url_post){
        $.get(URL_BASE+"album-data/getViewCommentFb",{url:url_post},function(result){
            $('.kl_conComment').html(result);
            FB.XFBML.parse();
            //console.log( FB);
            var btnFbHeight = $("#id_like>span").innerHeight();
            if (btnFbHeight > 20){
                $(".kl_btnModal > a").css("padding","6px 38px 5px 15px");
            } else
            {
                $(".kl_btnModal > a").css("padding","2px 38px 2px 15px");
            }
            
        });
    }
    
    function getUserPost(spd_id){
        $.getJSON(URL_BASE+"album-data/getUserPost/"+spd_id,null,function(result){
           //console.log(result); 
           $("#user_posted").html(result.login);
           $("#date_post").html((result.spd_date).replace(" "," à "));
        });
    }
    
    if(typeof is_galerie!=="undefined"){
       
        if(t_img.length>0){
            load_img_thumbnail_completed(0,function(res){   
               
               $('#wookmark1').wookmark({
                   itemWidth: 320,
                   offset: 7,
                   outerOffset: 3
               });
               
            $('#wookmark1>li>img').each(function(pos){
               img_list[pos] =  $(this).attr('src').replace("thumbnails/thumb_",""); 
            });
                load_img_completed(0,function(result){
                    console.log(result);
                });
           }); 
        }
    }
    $('.carousel').carousel({
        interval: false
    }); 
    $( "#wookmark1 > li" )
      .mouseover(function() {
        $( this ).addClass( "in" );
    })
    .mouseout(function() {
        $( this ).removeClass( "in" );
    })
    .click(function(){
          //console.log(this);
          $(".item.active").removeClass("active");
          image_active= $("#item_carousel>div[position='"+$(this).attr("data-wookmark-id")+"']");
          image_active.addClass("active");
          $('.fb-comments').attr('data-href',image_active.children('img').attr('src'));     
          getUserPost($(this).attr('spd_id'));
          //console.log($(this).attr('id'));
      });
        $(".left").click(function(){
            var size_item = $("#item_carousel>*").length;
            var position = parseInt($("#item_carousel>.item.active").attr('position'));
            var curent   = position==0?size_item-1:position-1;
            image_active= $("#item_carousel>div[position='"+curent+"']");
            $('.fb-comments').attr('data-href',image_active.children('img').attr('src'));
            getUserPost($("#wookmark1 li[data-wookmark-id='"+curent+"']").attr('spd_id'));
            getCommentViewFb(image_active.children('img').attr('src'));
            getShortLink(image_active.children('img').attr('src'));
        });

        $(".right").click(function(){
            var size_item = $("#item_carousel>*").length;
            var position = parseInt($("#item_carousel>.item.active").attr('position'));
            var curent   = position==size_item-1?0:position+1;
            image_active= $("#item_carousel>div[position='"+curent+"']");
            $('.fb-comments').attr('data-href',image_active.children('img').attr('src'));
            getUserPost($("#wookmark1 li[data-wookmark-id='"+curent+"']").attr('spd_id'));
            getCommentViewFb(image_active.children('img').attr('src'));
            getShortLink(image_active.children('img').attr('src'));
            //console.log(curent);
        }); 
      
    $('#id_modalGalerie').on('shown.bs.modal', function (e) {
        //var winHeight = $(window).height();
        var winWidth = $(window).width();
        if (winWidth>768){
         var modalDialogHeight = $('.modal-dialog').height();
            //$(".kl_conLeftModal").height(modalDialogHeight-136);
            //$(".carousel-inner .item > img").css("max-height","250");
        }
         getCommentViewFb(image_active.children('img').attr('src'));
         getShortLink(image_active.children('img').attr('src'));
         

    });
    $("#cadre_id,#cadre_id_mobile").change(function(){
        location.href = URL_BASE+"album-data/galerie-souvenir/"+($(this).val());
    });
    
             
    $('#modalShare').on('shown.bs.modal',function(){
        getPluginCommentFb();
        getShortLink(image_active.children('img').attr('src'));
        
    });
    
    $("#btn_partage_fb,.kl_btn_partage_fb,.kl_facebook").click(function(){
        share(sharelink);
    });
    
    $(".kl_socialHeader>li").click(function(){
        $('#modalShare').modal('hide');
    });
    $( ".navbar-header" ).click(function() {
      $( "#menuMobile" ).toggle( "fade" ).css("display","block","!important");
    });
    $( ".kl_shareImage" )
      .mouseover(function() {
        var current_img = $( this ).parent().parent().parent().children('img');
        $( this ).addClass( "in" );
    })
    .mouseout(function() {
        $( this ).removeClass( "in" );
    });
    
     $( ".kl_shareImage" ).children("a")
      .mouseover(function() {
        var parent_shareImg = $( this ).parent().parent().parent().parent();
        var current_img = parent_shareImg.children('img');
      // console.log(current_img);
       getShortLink(current_img.attr('src').replace("thumbnails/thumb_",""),parent_shareImg);
    });

    if($('.kl_descriptionImages').text().trim() ==""){
        $('.kl_descriptionImages').remove();
    }
    
});
