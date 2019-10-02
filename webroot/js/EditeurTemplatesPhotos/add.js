Dropzone.autoDiscover = false;

srcUrl = $("div.dropzone").attr('data-srcurl');
targetUrl = srcUrl+"/editeur-templates-photos/add/";

$("div.dropzone").dropzone({
    url: targetUrl,
    paramName: "file",
    addRemoveLinks : true,
    autoProcessQueue: false,
    acceptedFiles : "image/jpg,image/png,image/gif,image/jpeg",
    thumbnailWidth: null,
    thumbnailHeight: null,
    maxFiles: 100,
    parallelUploads: 100,
    dictRemoveFile: 'Suppression',
    dictDefaultMessage: 'Cliquer ou glisser vos fichiers ici',
    dictInvalidFileType: "Vous ne pouvez pas importez ce type de fichier",

    init: function (e) {

        dropzone = this;
        $(".submit-multi").click(function (e) {
            e.preventDefault();
            e.preventDefault();
            e.stopPropagation();
            if ($('select[name="editeur_template_id"]').val() == '') {
				var titre = '<strong class="text-danger">Attention</strong>';
                var contenu = '<small class="text-danger">Veuillez sélectionner le type d\'image pour continuer.</small>';
				var footer = '<button class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
				ouvrirModal(titre, contenu, footer, false, false);
            } else {
                dropzone.processQueue();
				$('.btn').addClass('disabled');
				$('.to-deactive').addClass('disabled');
				$('#tags').select2({'disabled': true});
            }
        });

        this.on("thumbnail", function(file, dataUrl) {
            $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
            $('.dz-image').last().find('img').attr('src', file.dataURL);
        });

        this.on('success', function(file, dataUrl) {
            fileContent = file.dataURL;
            fileName = file.name;
            editeur_template_id = $('select[name="editeur_template_id"]').val();
            tags = $('select[name="tags[]"]').val();
            console.log(tags)
            var data = $('#form-photos').serializeArray();

            data = {'file': fileContent, 'editeur_template_id': editeur_template_id, 'name': fileName,'tags':tags};
            $.post(targetUrl, data, function(data, textStatus, xhr) {
                if (data.status == 'success') {
                    $('.container-alert')
                        .removeClass('d-none')
                        .find('.alert')
                        .addClass('alert-success')
                        .find('.message')
                        .html('Vos photos ont été enregistrées')
                    ;
					$('.btn').removeClass('disabled');
					$('.to-deactive').removeClass('disabled');
					$('#tags').select2({'disabled': false});
                }
            });
        });
    },

});

$(".select2").select2({
	tags: true
});
