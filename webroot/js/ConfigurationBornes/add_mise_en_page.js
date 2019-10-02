Dropzone.autoDiscover = false;
var baseUrl ;
$(document).ready(function(){
    $('#id_uploadAllPage').dropzone({ 
        url: baseUrl+"/ConfigurationBornes/uploadMiseEnPageAll",
        paramName: "uploadfile",
        dictDefaultMessage: "Importer les écrans",
        //previewsContainer: '.visualizacao', 
        //previewTemplate : $('.preview').html(),
        init: function() {
          this.on('completemultiple', function(file, json) {
           
          });
          this.on('success', function(file, json) {
            alert('success '+file);
          });
          
          this.on('addedfile', function(file) {
           alert('addedfile '+file);
          });
          
          this.on('drop', function(file) {
            console.log('File',file)
          }); 
        }
    });
    
    $(".dropify").dropify({
        messages: {
            default: 'Glissez-déposez votre image ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });
});