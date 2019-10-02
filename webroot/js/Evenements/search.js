$(document).ready(function() {
    //===== COULEUR BTN SEARCH
    $(".rechreche_global").on('focus', function () {
        $('.kl_btnSearch').css('background', '#fff');
    });
    $(".rechreche_global").on('focusout', function () {
        $('.kl_btnSearch').css('background', '#ddd');
        $('.kl_btnSearch').css('border', '0px !important');
    });
});