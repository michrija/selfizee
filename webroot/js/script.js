// WebFont load
WebFont.load({
    google: {
        "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
    },
    active: function() {
        sessionStorage.fonts = true;
    }
});

// begin::Global Config(global config for global JS sciprts)

var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "dark": "#282a3c",
            "light": "#ffffff",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
            "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
        }
    }
};

// Delete crud by AJAX 
function flash(message, className) {
    return '<div class="clear-mg alert alert-'+className+' alert-dismissible">'+message+' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>';
}

function deleteObject(element, message) {
    if (confirm(message === undefined ? "Etes vous sur de vouloir supprimer?" : message)) {
        self = $(element);
        $.get(self.attr('href'), function(data, xhr) {
            if (data.status == "success") {
            	currentRowTr = self.parents('tr').eq(0).remove();
            }
        });
        return false;
    }
}

// Alert dissmiss after few seconds
function removeAlert() {
    setTimeout(function () {
        $('.alert').remove();
    }, 4000);
}

removeAlert();

// Add active to link, depends on current url

$(window).bind("load", function() {

    var current = window.location.href.split('?')[0];
    
    // dans pages projet/commandes/crea/graphism/
    $('.kt-wizard-v1__nav-item').each(function(){
        var self = $(this);
        // if the current path is like this link, make it active
        linkPath = self.attr('href').split('?')[0];
        if(linkPath == current){
            self.attr('data-ktwizard-state', 'current');
        }
    });

    // dans pages 
    $('.nav-tabs > .nav-item > a.text-dark').each(function(index, el) {
        var self = $(this);
        // if the current path is like this link, make it active
        linkPath = self.attr('href').split('?')[0];
        if(linkPath == current){
            self.addClass('active bg-secondary');
        } 
    });

    // Reset url on input select change
    $('select.reset-url').on('change', function(event) {
        event.preventDefault();
        val = $(this).val();
        currentUrl = $('div[data-url]').attr('data-url')+"/";
        window.location = currentUrl+val;
    });
    /**
     * set input class : multi-upload, and dirpath
     * @param {[type]} dirpath [description]
     */
});

function setMultiUpload(dirpath) {
    urlMultiUpload = $('div#js-pass').attr('data-url-multiupload');
    urlRemoveMultiupload = $('div#js-pass').attr('data-url-removeupload');
    // enable fileuploader plugin
    $('input.multi-upload').fileuploader({
        limit: 20,
        extensions: ['jpg', 'jpeg', 'png'],
        maxSize: 50,
        captions: {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here',
            or: 'or',
            button: 'Browse files',
        },
        changeInput: '<div class="fileuploader-input">' +
          '<div class="fileuploader-input-inner">' +
              '<div class="fileuploader-main-icon"></div>' +
              '<h3 class=""><span>Glisser ou déposer vos fichiers</span></h3>' + // class="fileuploader-input-caption"
              '<p>ou</p>' +
              '<div class="fileuploader-input-button"><span>Parcourez vos fichiers</span></div>' +
          '</div>' +
      '</div>',
        theme: 'default',
        upload: {
            url: urlMultiUpload+'/?path='+dirpath,
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: function(item, listEl, parentEl, newInputEl, inputEl) {
                $('.error-message').remove();
                $('.fileuploader').prepend('<div class="alert alert-danger notif-progress"> <button type="button text-white" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> &nbsp;&nbsp; Fichier en cours d`importation, veuillez attendre que les fichiers soient bien importés avant de soumettre le formulaire. </div>')
                return true;
            },
            onSuccess: function(result, item) {
                var data = {};
                
                try {
                    data = result;
                } catch (e) {
                    data.hasWarnings = true;
                }
                
                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                    div = item.html.find('.column-title > div:first-child').text(data.files[0].name);
                    toReplace = div.text().replace('innostudio.de_', '');
                    div.text(toReplace)
                    $('.notif-progress').remove();
                }
                
                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings[warning]);
                    }
                    
                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }
                
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');
                
                if(progressBar.length) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }
                
                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');
                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        onRemove: function(item) {
            $.post(urlRemoveMultiupload+'/?path='+dirpath, {file: item.name }, function (data) {
                console.log(data)
            });
        },
    });
}


$('input[type="date"]').on('click', function(){
    return false;
});
