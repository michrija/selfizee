$(".tab-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "Submit"
    }
    , onFinished: function (event, currentIndex) {
       swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            
    }
});


var form = $(".validation-wizard").show();


var isEdit = $("#id_isEdit").val();
 isEnableAllSteps = false;
if(isEdit == 1){
    isEnableAllSteps = true;
}

$wizard = $(".validation-wizard");
$wizard.steps({
    headerTag: "h6", 
    bodyTag: "section",
    transitionEffect: "fade", 
    titleTemplate: '<span class="step">#index#</span> #title#',
    enableAllSteps :isEnableAllSteps,
    labels: {
        finish: "Enregistrer",
        next: 'Suivant',
        previous : 'Précédent'
    }, 
    onStepChanging: function (event, currentIndex, newIndex) {
        //return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        var currentStep = $(".validation-wizard").steps("getStep", currentIndex);
        /*var out = '';
         for (var i in currentStep) {
         out += i + ": " + currentStep[i] + "\n";
         }
        alert(out);*/
        
        
        
        
        
    
        if(currentIndex == 0){
            var typeAnimation = $('#id_typeAnimation').val();
            if(typeAnimation.length){
                return true
            }else{
                alert("Vous devez choisir une type d'animation");
                return false;
            }
        }else if(currentIndex == 2 ){ // Prise de coordonées
            var isPriseDeCoordonee = $('input[type=radio][name=is_prise_coordonnee]:checked').val();
            var id_titreForme = $("#id_titreForme").val();
            var countChampAdded = $(".kl_oneChampAdded ").length;
            
            //alert('isPriseDeCoordonee '+isPriseDeCoordonee+" countChampAdded"+countChampAdded+" id_titreForme"+id_titreForme);
            
            if(isPriseDeCoordonee == 1){
                if(!id_titreForme.length || !countChampAdded){
                    alert("Vous devez renseigner le titre du formulaire et ajouter au moins un champ");
                    return false;
                }
            }
            return true;
        }else{
            return true;
        }
    }, 
    onFinishing: function (event, currentIndex) {
        return form.validate().settings.ignore = ":disabled", form.valid()
    }, 
    onFinished: function (event, currentIndex) {
         //swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        $("#id_configurationForm").submit();
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
        var currentStep = $wizard.steps("getStep", currentIndex);
        window.location.hash = "step"+currentIndex;
    }
    
});


$(window).on('hashchange', function(){
    
        //alert( location.hash );
        
  var hash = location.hash.replace("#", "");

  $steps = $wizard.data("steps");

  if (hash == "") {
    var firstStep = $wizard.steps("getStep", 0);
    //hash = firstStep.title;
    hash = "step0";
  }
  
  var indexHash = hash.slice(4) ;
  
  $("#id_configurationForm-t-"+indexHash).get(0).click();
  
 
});

//change option 


        
/*, $(".validation-wizard").validate({
    ignore: "input[type=hidden]"
    , errorClass: "text-danger"
    , successClass: "text-success"
    , highlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , errorPlacement: function (error, element) {
        error.insertAfter(element)
    }
    , rules: {
        email: {
            email: !0
        }
    }
})*/