$(document).ready(function() {
    //alert('Je passe ici');
    
     $(".kl_viewImage").magnificPopup({
        type: 'ajax',
        closeOnBgClick  : false,
        settings: {cache:true, async:true},
        gallery: {
          enabled:true
        },
        preload: [1,3],
        image: {
            markup: '<div class="mfp-figure kl_figure">'+
                    '<div class="mfp-close"></div>'+
                    '<div class="mfp-img"></div>'+
                    '<div class="mfp-bottom-bar">'+
                      '<div class="mfp-title"></div>'+
                      '<div class="mfp-counter"></div>'+
                    '</div>'+
                  '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
        
            cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.
        
            titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
          // Or the function that should return the title. For example:
          // titleSrc: function(item) {
          //   return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
          // }
        
            verticalFit: true, // Fits image in area vertically
        
            tError: '<a href="%url%">The image</a> could not be loaded.' // Error message
        }
    });
})