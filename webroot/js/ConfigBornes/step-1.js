var form = $("#configurateur_id").show();
 
form.steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "slideLeft",  
    autoFocus: true,  
    enableAllSteps: true,
    enablePagination: false,
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        return true;
    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {
        // Used to skip the "Warning" step if the user is old enough.
        
    },
    onFinishing: function (event, currentIndex)
    {
        
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
});