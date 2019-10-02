$('.btn-apercu').click(function(event) {
    baseUrl = $('form.form-galerie').attr('base-url');
    $('form.form-galerie').attr('target', '_blank').attr('action', baseUrl+'galeries/apercu').promise().then(function (arg) {
        $('form.form-galerie').submit();
    });
});