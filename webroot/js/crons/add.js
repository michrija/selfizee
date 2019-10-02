$(document).ready(function(){
    $('input[type=radio][name=is_active]').change(function() {
        if (this.value == '1') { //Oui
            $("#id_activeCron").removeClass("hide");
        }
        else if (this.value == '0') { // Non
             $("#id_activeCron").addClass("hide");
        }
    });

    $('input[type=radio][name=is_active_envoi_programme]').change(function() {
        if (this.value == '1') { //Oui
            $("#id_activeCronProgramme").removeClass("hide");
        }
        else if (this.value == '0') { // Non
             $("#id_activeCronProgramme").addClass("hide");
        }
    });

});