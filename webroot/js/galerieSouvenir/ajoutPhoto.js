Dropzone.autoDiscover = false;
$(document).ready(function(){
  uploadPhoto();

});

function uploadPhoto(){
    //console.log('Je passe ici oui');
    var idEvenement = $("#id_evenementFirst").val();
    var queue = $("#id_queue").val();
    var isMustModerateVal = $("#id_mustModerate").val();
    var i = 0;
     
    $('#id_uploadPhoto').dropzone({ 
       // url: URL_BASE +"/galeries/uploadPhoto/"+idEvenement+"/"+queue+"/"+isMustModerateVal,
        url: URL_BASE +"/galeries/uploadPhotoTmp/"+idEvenement+"/"+isMustModerateVal,
        paramName: "file",
        thumbnailWidth : 200,
        thumbnailHeight : 200,
        addRemoveLinks : false,
        acceptedFiles : "image/*",
        dictDefaultMessage : "Glissez ou cliquez ici pour ajouter",
        dictCancelUpload : "Annuler",
        init: function() {
          this.on('completemultiple', function(file, json) {
            //alert('aa');
            //$('.sortable').sortable('enable');
          });
          this.on('success', function(file, json) {
            
          });
          
          this.on('addedfile', function(file) {
           
          });
          
          this.on('drop', function(file) {
            //console.log('File',file)
          }); 
        },
        success: function (file, result, data) {
                var obj = jQuery.parseJSON(result);
                newFilename = obj.name;
                if (obj.success) {
                    var nameFile = obj.filename;
                    var name_origne = obj.name_origne;
                    var name_in_csv = obj.name_in_csv;
                    var source_upload = obj.source_upload;
                    var queue = $("#id_queue").val();
                    var idEvenement = $("#id_evenementFirst").val();
                    var is_validate = obj.is_validate;
                    
                    var ordre = $('#id_uploadFondVert .dz-preview').length + 1; 
                    var customId = generateCustomId();
                    var    html = '<input type="hidden" class="" value="' + nameFile + '" name="photos[' + customId + '][name]" />';
                    html = html + '<input type="hidden" class="" value="' + name_origne + '" name="photos[' + customId + '][name_origne]" />';
                    html = html + '<input type="hidden" class="" value="' + name_in_csv + '" name="photos[' + customId + '][name_in_csv]" />';
                    html = html + '<input type="hidden" class="" value="' + source_upload + '" name="photos[' + customId + '][source_upload]" />';
                    html = html + '<input type="hidden" class="" value="' + queue + '" name="photos[' + customId + '][queue]" />';
                    html = html + '<input type="hidden" class="" value="' + idEvenement + '" name="photos[' + customId + '][evenement_id]" />';
                    html = html + '<input type="hidden" class="" value="' + is_validate + '" name="photos[' + customId + '][is_validate]" />';
                    
                    
                    $(file.previewTemplate).append(html);
                    
                } else {
                    this.removeFile(file);
                    alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
                }
                i++;
        }
    });
}

function generateCustomId() {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2, 9);
}