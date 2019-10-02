<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>
<div class="col-md-12 cf_fond_vert">
    <div class="card-body no-padding-left no-padding-right">
        <div class="col-sm-12 no-padding">
            <h5>Incrustation fond vert</h5>
        </div>
        <div class="col-sm-12 no-padding">
            <p class="control-label m-b-20">L'animation photo fond vert consiste à prendre en photo une personne ou un groupe de personnes sur un fond vert ou bleu uni qui est automatiquement remplacé par un ou plusieurs fonds photos en accord avec la thématique de l'évèvenement. <strong>Attention vous devez bien posseder un fond vert pour utiliser cette fonctionnalité !</strong></p>
        </div>
        <div class="col-md-4 row">
            <label class="custom-control custom-radio m-r-40">
                    <input type="radio" name="is_incrustation_fond_vert" value="1" class="custom-control-input" <?php echo ($configurationBorne->is_incrustation_fond_vert == 1 ? "checked='checked'" : "");?>><span class="custom-control-label">Oui</span>
                </label>
                <label class="custom-control custom-radio">
                    <input type="radio" name="is_incrustation_fond_vert" value="0" class="custom-control-input" <?php echo ($configurationBorne->is_incrustation_fond_vert == 0 ? "checked='checked'" : "");?>>
                <span class="custom-control-label">Non</span></label>
            <?php
            ?>
        </div><br>

        <div class="cf_images_fond_vert hide">
            <h6><strong>Image(s) de fond : </strong></h6>
            <p>Vous pouvez ajouter autant d'images que souhaité .<br>
            <em>Rappel : Format Image : jpg - Dimensions : 1900X1020px - 72dpl - Couleurs : RVB</em></p>
            <div class="dropzone kl_blocDropzone cf_anim_bloc_dz_fv" id="dropzone_fond_vert"></div>

            <!-- Edition image FV -->
            <?php 
                if(!empty($configurationBorne->fond_verts)){  ?>
                <div class="kl_listeFvToDelete hide" ></div>
                <div class="bloc_edit_img_fv row">
                        <?php foreach($configurationBorne->fond_verts as  $fond_vert){                                
                            $url_img_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/fond_verts/'.$fond_vert->file_name; 
                            $style_affich_img = "background-image: url('".$url_img_fond."');background-size: cover;max-width: 134px;height: 120px;";?>                               
                            <div class="col-sm-2 dz-preview kl_oneImgeToDelete img_fv_edit" style="<?= $style_affich_img ?>" id="img_fv_<?= $fond_vert->id ?>">
                                <?php //echo $this->Html->image($url_img_fond, ['width' => 128, 'heigth'=>128,'id'=>'id_img_toDelete_'.$fond_vert->id]); ?>                                    
                                <a id="id_img_fv_<?= $fond_vert->id ?>" class="cf_delete_img_fv kl_deleteImgEdit" style="cursor: pointer;"><i class="fa fa-trash"></i></a>
                            </div>
                        <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>