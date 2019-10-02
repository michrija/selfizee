$(document).ready(function(){
    $("#id_login").bind('blur keyup change', function() {
        var value = $.trim($(this).val().toUpperCase());
        $(this).val(value);
        $("#id_password").val(value);
    });
});