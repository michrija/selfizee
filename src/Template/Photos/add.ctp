<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('photos/add.js', ['block' => true]); ?>
    
<?php
$titrePage = "Ajout de medias" ;


/*$this->start('actionTitle2'); 
    echo '<div class="row m-b-10"><div class="col-md-12 col-12 align-self-rigth">';
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Enregistrer',['action'=>'liste', $evenement->id],['escape'=>false,"class"=>"btn pull-right btn-success m-r-10" ]);                           
    echo '</div></div>';
$this->end();*/
?>
<!-- <div class=" row">
        <div class="col-md-3 col-8 align-self-center ">
            <h3 class="text-themecolor m-b-10 m-t-0 titre_page kl_newTitrePage p-0">Ajout de medias</h3>
        </div>
        <div class="clearfix"></div>
</div> -->
<div class="container-alert d-none" onclick="this.classList.add('d-none')">
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div class="message"></div>
    </div>
    <!-- JS Callback alert -->
</div>
<!-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <div class="ml-2">
                        <h4 class=""><?php// $titrePage ?></h4>
                    
                        <div class="clearfix"></div>
                    </div>
               
           
            </div>
        </div>
    </div>
</div> -->


<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left ml-1"><?= $titrePage ?></h4>
      
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <h4 class="card-title"> Importer vos médias (photos, vidéos) </h4> 
                <input type="hidden" id="event_id" value="<?= $evenement->id ?>"/> 
                <input type="hidden" id="queue_id" value="<?= time() ?>"/>                
                <div class="dropzone" id="id_dropzone">
                  <div class="dz-message p-0" data-dz-message><div class="logo"><?php echo $this->Html->image("icon/icon_upload.png", ['fullBase' => true]);  ?></div><span> Glissez-déposez un fichier ici ou cliquez</span></div> 
                 </div>
                <div class="dz-progress">
                   <span class="dz-upload" data-dz-uploadprogress=""></span>
                </div>
            </div>
                <div class="progress progress_upload_media hide">
                  <div class="progress-bar" style="width:0%;height:14px;background-color: #e72763 !important;"></div>
                </div>
        </div>
    </div>
</div>
<div class="row m-b-10">
 
        <div class="col-md-12 col-12 align-self-rigth">
                <?php
                    //echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Enregistrer',['action'=>'liste', $evenement->id],['escape'=>false,"class"=>"btn pull-right btn-success m-r-10 addPhoto" ]);
                ?>
                <button type="button" class="btn pull-right btn-success m-r-10 addPhoto"><i class="mdi mdi-plus-circle"></i> Envoyer</button>
        </div>
 
    <div class="clearfix"></div>
</div>
<style>
.dropzone {
    border: 1px solid rgba(0, 0, 0, 0.3);
}

.dz-progress {
    display: none;
}
</style>
