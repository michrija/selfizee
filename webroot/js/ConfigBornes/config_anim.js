Dropzone.autoDiscover = false;
var baseUrl ;
$(document).ready(function(){
    baseUrl = $("#id_baseUrl").val();
    
    $('.dropify_cadre').dropify({
        messages: {
            default: 'Glissez ou cliquez ici pour ajouter',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, une erreur est survenue'
        }
    });

    //alert('');
    //=== Integr
    
    var evenement_id = $('#evenement-id').val();
   /* var myDropzone2 = new Dropzone("div#dropzone_fond_vert", { //#dropzone_fond_vert
        //$("div#id_images_fond_vert").dropzone({
            url: baseUrl + 'configurationBornes/uploadImagesFondVerts/'+evenement_id,
            paramName: "file",
            addRemoveLinks : true,
            acceptedFiles : ".jpg, .JPG",
            thumbnailWidth: null,
            thumbnailHeight: null,
            //maxFiles: 1,
            //uploadMultiple: true,
            //dictDefaultMessage : "Glissez ou cliquez ici pour ajouter",
            init: function() {
                this.on('addedfile', function (file) {
                });
    
                this.on('removedfile', function (file) {
                    this.removeFile(this.file);
                });
            },
    
            success: function (file, reponse) {
                console.log('image uploaded');
                console.log(reponse);
                var obj = jQuery.parseJSON(reponse);
                if (obj.success) {
                    var nameFile = obj.name;
                    var nameInput = '<input type="hidden" class="" value="' + nameFile + '" name="image_fond_verts_files[]" />';
                    $(".dz-preview:last-child").append(nameInput);
                } else {
                    this.removeFile(file);
                    alert('Erreur sur la connexion. Veuillez reverifier puis réessayer.');
                }
            },
    
            accept: function (file, done) {
                done();
            },
    
            dictRemoveFile: "Supprimer",
            dictCancelUpload: "Annuler",
            //dictDefaultMessage: "<span class='kl_parcourir'>Ajouter une image</span>"
            dictDefaultMessage: "<div class='cf_blocDropzone' id='dropzone_fond_vert'>"+
                                "<p><i class='mdi mdi-cloud-upload fa-3x'></i><br>"+
                                   "Glissez ou cliquez ici pour ajouter </p>"+
                               "</div>"
            //dictDefaultMessage: "<p>Glissez ou cliquez ici pour ajouter </p>"
        });*/

});