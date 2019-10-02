$(document).ready(function(){
    $(".kl_imageQuiChange").change(function(){
            
            var destination = $($(this).attr('data-destination'));
            readURL(this, destination);
    });
});
function readURL(input, destination) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            destination.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}