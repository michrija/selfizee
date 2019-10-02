<?php use Cake\Routing\Router; ?>
<div class="col-md-12 pl-0">
    <div class="kl_titreAnimationSelected">Animation : Polaroid</div>
</div>
<div class="row col-12 m-t-15 hide">
                <?php
                echo $this->Form->control('configuration_animations.3.type_cadre',[
                    'type'=>'hidden',
                    'default' => 0
                  ]);
                ?>
</div>
<div class="kl_cadreSimple cadre-pers row col-12 m-t-15">
   <label class="col-md-12 p-l-0 kl_labelCustom">2 - Cadre :</label>
   
   
	<div class="col-md-4">
        <?php 
            $urlCadreSimple = null;
			$cadre_overlay = '';
			$cadre = [];
            if(!empty($configurationBorne->configuration_animations[3]->cadres)){
                    $cadre = $configurationBorne->configuration_animations[3]->cadres[0];
                    $fileName = $configurationBorne->configuration_animations[3]->cadres[0]->file_name;
					if(trim($fileName) != ''){
						$urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
					}
				$cadre_overlay = trim($cadre->file_name) && trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-image:url(/import/config_bornes/'.$evenement->id.'/cadres/'.$cadre->file_name.');background-size:cover;background-position:center;">' : (trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-size:cover;background-position:center;">' : '');
         ?>
            <input type="hidden" value="<?= $cadre->id ?>" name="configuration_animations[3][cadres][0][id]" />
            <input type="hidden" value="<?= $cadre->ordre ?>" name="configuration_animations[3][cadres][0][ordre]" />
            <input type="hidden" class="cadre-filename-pers" value="<?= $cadre->file_name ?>" name="configuration_animations[3][cadres][0][file_name]" />
        <?php }?>
		<input type="file" name="img_cadre_simplePolaroid" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
    </div>
	<div class="col-md-4">
		<div class="label-overlay-pers">
			<label class="custom-control custom-checkbox">
				<input type="checkbox" class="kl_cadre_check-pers custom-control-input" <?php echo (isset($cadre->file_overlay) && trim($cadre->file_overlay) != '') ? 'checked="checked"' : ''; ?>>
				<span class="custom-control-label"> Créer un overlay</span>
			</label>
			<?php if(isset($cadre->file_overlay) && trim($cadre->file_overlay) != ''){ ?>
			<button class="btn btn-danger waves-effect waves-light kl_cadre_overlay_overlay-pers" type="button"><span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer overlay</button><br/>
			<?php }else{ ?>
			<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload overlay</button><br/>
			<?php } ?>
			<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
			
			<?php // Fichier de l'overlay ?>
			<input type="file" class="fichier_overlay-pers hide" accept="image/png">
			<input type="hidden" class="cadre-overlay-pers file_overlay-pers" value="<?php echo (isset($cadre->file_overlay) && trim($cadre->file_overlay) != '') ? $cadre->file_overlay : ''; ?>" name="configuration_animations[3][cadres][0][file_overlay]">
			
			<?php // Image test à venir ?>
			<input type="file" class="fichier-pers hide" accept="image/gif, image/jpeg, image/png">
			
		</div>
	</div>
	<div class="col-sm-4 kl_cadre_overlay-pers"><?php echo $cadre_overlay; ?></div>
   
	<?php if(false){ ?>
    <div class="col-md-12">
        <?php 
            $urlCadreSimple = null;
            if(!empty($configurationBorne->configuration_animations[3]->cadres)){
                    $cadre = $configurationBorne->configuration_animations[3]->cadres[0];
                    $fileName = $configurationBorne->configuration_animations[3]->cadres[0]->file_name;
                    $urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
         ?>
            <input type="hidden" value="<?= $cadre->id ?>" name="configuration_animations[3][cadres][0][id]" />
            <input type="hidden" value="<?= $cadre->ordre ?>" name="configuration_animations[3][cadres][0][ordre]" />
            <input type="hidden" value="<?= $cadre->file_name ?>" name="configuration_animations[3][cadres][0][file_name]" />
        <?php }?>
		<?php if(false){ ?>
        <input type="file" name="img_cadre_simplePolaroid" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="jpg jpeg"/>
        <?php } ?>
		<input type="file" name="img_cadre_simplePolaroid" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
    </div>
	<?php } ?>
</div>
<div class="col-12">
    <br /><hr><br />
</div>