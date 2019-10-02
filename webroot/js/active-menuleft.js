// Add active to link, depends on current url
var current = window.location.href.split('?')[0];


$('ul#id_menuLeftList li a').each(function(){
    var self = $(this);
    // if the current path is like this link, make it active
    linkPath = self.attr('href').split('?')[0];
    // console.log(self.attr('href'))
    // console.log(linkPath)
    if(linkPath == current){
        if (!self.parents('ul').hasClass('inner-menu')) {
            self.addClass('pink-active').css({'color' : '#ed195f'});
            self.parents('li.li-menu').first().addClass('li-active');
        } else
        if (self.parents('ul').hasClass('inner-menu')) {
            self.parents('li').first().addClass('degrade-sousmenu').css({'color' : '#ed195f'});
            self.parents('li.li-menu').first().addClass('li-active');
        }
    }
});

$('.degrade-sousmenu').parents('.li-menu').first().addClass('li-active')


// If li contain data-active (for other pages in the same active context)
$('li[data-active]').each(function(e) {
    self = $(this);
    keyWords = eval($(this).attr('data-active'));
    var params = window.location.href.split('/');

    if (intersect(keyWords, params).length != 0) {

        self.addClass('active').promise().then(function () {
            self.parents('.treeview').first().addClass('active');
        });

    }
}); 
$('.treeview-menu').find('.active').parents('.treeview').first().addClass('active');


// Menu left
var main = function() {

    $('.navbar-toggler').click(function() {
        if (!$(this).hasClass('activem')) {
            $('.menu').animate({left:'0px'}, 200);
            $('#main-wrapper > .sansMenu , #main-wrapper > .page-content .page-inner-content').animate({left:'145px'});
            $(this).addClass('activem')
        } else {
            $('.menu').animate({left:'-145px'}, 200);
            $('#main-wrapper > .sansMenu , #main-wrapper > .page-content .page-inner-content').animate({left:'0px'}, 200);
            $(this).removeClass('activem')
        }
    });

};

$(document).ready(main);