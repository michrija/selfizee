   var url = $('#url').attr('href');
   Dropzone.options.dropzoneFrom={
       autoProcessQueue: false,
       uploadMultiple: true,
       maxFilesize: 10,
       maxFile:2,
       init: function(){
           var submitButton = document.querySelector('#submit-all');
           dropzoneFrom = this;
           submitButton.addEventListener('click', function(){
            dropzoneFrom.processQueue();
           });
           this.on('complete',function(){
               alert('retrter')
            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles.length == 0){
                   var _this = this;
                   _this.removeAllFiles();
               }
           });
       }
   }