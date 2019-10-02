//Dropzone.autoDiscover = false;
//$(document).ready(function(){
    //alert('bobota');
    // "myAwesomeDropzone" is the camelized version of the HTML element's ID
    
    //alert('Dropzone '+Dropzone.options.myAwesomeDropzone );
    
    /*Dropzone.options.myAwesomeDropzone = {
      paramName: "file", // The name that will be used to transfer the file
      init: function (file) {
        alert('');
      },
      accept: function(file, done) {
        alert('===> '+file.name);
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        }
        else { done(); }
      }
    };*/

/*    var baseUrl = $("#id_baseUrl").val();
    var event_id = $("#event_id").val();
    var queue_id = $("#queue_id").val();
   // Dropzone.prototype.defaultOptions.dictDefaultMessage = "<i class='mdi mdi-arrow-up-bold-circle'></i> Glissez-déposez un fichier ici ou cliquez";
    $("div#id_dropzone").dropzone({
            url: baseUrl + "photos/uploadPhoto/" + event_id + "/"+ queue_id,
            addRemoveLinks: true,
            dictRemoveFile: 'supprimer',
            timeout:180000,
            maxFilesize: 1024,

            success: function (file, result, data) {
            },

            init: function (file) {
              
                     this.on('addedfile', function (file) {
                    //alert('init');
                    //alert(file.size);
                    var maxsize = 512 * 1024 * 1024;
                    if (file.size > maxsize) {
                        this.removeFile(file);
                        alert('Fichier trop gros. Veuillez réessayer.');
                    }
                });
           
             
            },
            acceptedFiles: ".png, .jpg, .jpeg, .gif, .GIF, .PNG, .JPG, .JPEG, .mp4, .MP4", //.flv, .FLV, .avi, .AVI, .mpg, .MPG
    });*/


//});


Dropzone.autoDiscover = false;
    var baseUrl = $("#id_baseUrl").val();
    var event_id = $("#event_id").val();
    var queue_id = $("#queue_id").val();
//srcUrl = $("div.dropzone").attr('data-srcurl');
targetUrl = baseUrl + "photos/uploadPhoto/" + event_id + "/"+ queue_id;

var nbr_files = 0;
var nbr_success = 0;
var progress_upload = 0;
$("div.dropzone").dropzone({
    url: targetUrl,
    paramName: "file",
    addRemoveLinks : true,
    autoProcessQueue: false,
    acceptedFiles : "image/jpeg,image/png,image/gif,image/jpeg",
    thumbnailWidth: null,
    thumbnailHeight: null,
    maxFiles: 100,
    parallelUploads: 100,
    timeout: 3600000,
    dictRemoveFile: 'Suppression',
    dictInvalidFileType: "Vous ne pouvez pas importez ce type de fichier",    
    accept: function (file, done) {
        nbr_files = this.files.length;
        //console.log();
        done();
    },
    init: function (e) {
        dropzone = this;
        /*$('.dz-clickable').click(function(event) {
            $('.progress').css("display",'none');
        });*/
        $(".addPhoto").click(function (e) { 
            console.log("Nbr files : "+nbr_files);
            //$('.progress').css("display",'block');
            $('.progress_upload_media').removeClass('hide');
            e.preventDefault();
            e.preventDefault();
            e.stopPropagation();
            $('.dz-progress').css("display",'block');
            dropzone.processQueue();
        });
        this.on("thumbnail", function(file, dataUrl) {
            $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
            $('.dz-image').last().find('img').attr('src', file.dataURL);
        });
    },
    totaluploadprogress: function(file, progress, bytesSent) {
        $(".addPhoto").addClass('hide');
        progress_upload = file;
        $('.progress-bar').css('width', "0.2%" );
        //$(".progress-bar").width(file + '%');
        //$(".progress-bar").text(Math.round(file) + '%');
        /*console.log("progress :");
        console.log(file);
        console.log(progress);
        console.log(bytesSent);*/

    },
    success: function (file, reponse) {
        //console.log(file.status);
        if(file.status == "success") {
            nbr_success = nbr_success + 1;
            pg = (nbr_success * 100) / nbr_files;
            //$(".progress-bar").width(pg + '%');
            $('.progress-bar').css('width', pg +"%" );
            $(".progress-bar").text(Math.round(pg) + '%');
            //console.log(pg);
        }

        //console.log(file.status + " : N. "+nbr_success);
        var msg_success = '<div class="alert alert-success msg_success_upload_media">Les photos ont été uploadées.</div>';
        if(nbr_success == nbr_files ) {            
            $(msg_success).insertBefore('.progress_upload_media');            
            setTimeout(function () { window.location.href = baseUrl+"photos/liste/"+event_id ;}, 4000);
            $(".addPhoto").removeClass('hide');
        }
    }
});
