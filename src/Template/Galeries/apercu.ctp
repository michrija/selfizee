<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>
<?= $this->Html->script('Galeries/souvenir.js?'.time(), ['block' => true]); ?>
<?php if(empty($photos->toArray())){?>
   <div class="text-center kl_aucunePhotos"> <img src="/event-selfizee-v2/img/pasAlbums.png" alt="Aucune photo"></div>
<?php }else{?>
    <div id="id_etatRequest" class="none fini"></div>
    <ul class="tiles-wrap animated" id="gallerie" >
        <?php 
        foreach($photos as $key => $photo){
            echo $this->element('one_photo',['photo'=>$photo, 'key'=>$key,'galery' => $galery,'rsConfiguration' => $rsConfiguration,'queue' => $queue]);    
        }
        ?>
    </ul>
    <input type="hidden" id="id_totalPage" value="<?= $this->Paginator->counter('{{pages}}'); ?>" />
    <input type="hidden" id="id_currentPage" value="<?= $this->Paginator->counter('{{page}}'); ?>" />
    
    
    
    <div id="id_loading" >
        <?=  $this->Html->image('load_img.svg'); ?>
    </div>
    <?= $this->element('popup_email_photo') ?>
<?php } ?> 

<input type="hidden" id="id_galerieId" value="<?php $galery->id ?>" />
<style type="text/css">
.sf-video {
    text-align: center !important;
	background-size: cover !important;
	background-repeat: no-repeat !important;
	background-position: center !important;
}
.close{
	display: none;
}
</style>