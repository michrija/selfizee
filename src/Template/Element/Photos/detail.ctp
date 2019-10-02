<div class="kl_contentDetail  kl_contentTab" id="id_contentDetail">
    <?php
		$media = $photo->type_media == 'video' ? 'la vidéo' : 'la photo';
		$titre_media = $photo->type_media == 'video' ? 'Vidéo' : 'Photo';
        $datePhoto = '';
        if(!empty($photo->date_prise_photo)){
            $datePhoto = $photo->date_prise_photo->format('d/m/Y');
        }
        if(!empty($datePhoto)){
    ?>
    <div class="kl_titreDetail"><?php echo $titre_media; ?> prise le :</div>
    <div class="kl_reponseDetail">
        <?php echo $datePhoto;?>
    </div>
    <?php } ?>
    
    <?php
        $heurePhoto = '';
        if(!empty($photo->heure_prise_photo)){
                $heurePhoto = $photo->heure_prise_photo->format('H\hi');
        }
        if(!empty($heurePhoto)){
     ?>
    <div class="kl_titreDetail">Heure :</div>
    <div class="kl_reponseDetail">
        <?php echo $heurePhoto; ?>
    </div>
    <?php } ?>
    
    <?php if(!empty($photo->is_postable_on_facebook)){ ?>
    <div class="kl_titreDetail">Opt-in :</div>
    <div class="kl_reponseDetail">
    <?php
        echo $photo->is_postable_on_facebook ? 'Oui':'Non';
    ?>
    </div>
    <?php } ?>
    
    <div class="kl_contDtl">
        <?php if($userConnected['is_active_acces_edit_photo']){ ?>
            <button class="kl_deleteInPopupImage" id="id_pictuPop_<?= $photo->id ?>">
                <i class="fa fa-trash"></i> supprimer <?php echo $media; ?>
                <?= $this->Html->image('loading_bl.svg', ['class' => 'hide kl_loader']); ?>
            </button>
        <?php } ?>
        
        <div class="kl_text-center">
            <a href="<?= $photo->url_photo_souvenir ?>" class='btn btn-success  kl_lienPagesouvenir' target='_blank'><i class="fa fa-file-image-o" aria-hidden="true"></i> Page souvenir</a>
        </div>
        
        <div class="kl_text-center">                        
            <?= $this->Html->link('<i class="fa fa-cloud-download" aria-hidden="true"></i> Télécharger '.$media,['controller' => 'Photos', 'action' => 'download', $photo->id],['escapeTitle'=>false,'class'=>'btn btn-success  kl_lienDownloadFile' ]); ?>
        </div>
        <?php if(in_array($userConnected['role_id'], ['1', '2'])){ ?>
        <div class="kl_text-center">
            <button type="button" class="btn btn-success btn_envoi_photo" data-owner="<?= $photo->evenement->client_id ?>" data-toggle="modal" data-target="#sendSave" data-whatever="@mdo" ><i class="mdi mdi-near-me"></i> <?= __('Envoyer à') ?></button>
        </div>
        <?php } ?>
    </div>
</div>
<?php echo $this->element('Photos/resend_email',['photo' => $photo]) ?>