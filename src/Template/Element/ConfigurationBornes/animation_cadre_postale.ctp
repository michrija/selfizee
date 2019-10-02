<?php use Cake\Routing\Router; ?>
<?php $this->Html->css('nestable/nestable.css', ['block' => true]) ?>
<?= $this->Html->script('nestable/jquery.nestable.js', ['block' => true]); ?>
<div class="col-md-12 pl-0">
    <div class="kl_titreAnimationSelected">Animation : Carte postale</div>
</div>
<div class="row col-12 m-t-15">
    <label class="col-md-12 p-l-0 kl_labelCustom">1 - Type de cadre :</label>
    <div class="col-md-12">
            <div class="row" id="id_customChexCadre">
                <?php
                echo $this->Form->control('configuration_animations.0.type_cadre',[
                    'type'=>'radio',
                    'templates'=>[
                        'inputContainer' => '{{content}}',
                        'nestingLabel' => '{{hidden}}<label class="custom-control custom-radio col-sm-5" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
                    ],
                    'options'=>[
                        ['value' => 0, 'text' => 'Paysage','class'=>'kl_paysageCadre custom-control-input'],
                        ['value' => 1, 'text' => 'Portait','class'=>'kl_portraitCadre custom-control-input'],
                    ],
                    'label'=>false,
                    'default' => 0
                  ]);
                  
                    //echo $this->Form->control('configuration_animations.0.cadres.0.ordre'); 
                ?>
            </div>
    </div>
</div>
<div class="col-12">
    <hr><br />
</div>
<div class="kl_cadreMultiple row col-12">
    <label class="col-md-12 p-l-0 kl_labelCustom">2 - Cadres :</label>
    <div class="col-md-12">
	<?php // Nouvelle version : upload cadre ?>
        <div class="kl_labelDesc">Vous pouvez ajouter autant de cadres que souhaités.</div>
        <div class="kl_info_1"><em>Rappel : Format image : .png (avec fond transparent) - Dimensions : 1844 x 1200px - 72dpi - Couleurs : RVB</em></div>
		
		<div class="dd myadmin-dd" id="nestable-menu" style="max-width: unset;">
			<ol class="dd-list">
			<?php 
				// debug($configurationBorne->configuration_animations); 
				if(!empty($configurationBorne->configuration_animations[0])){
					$i=0;
					foreach($configurationBorne->configuration_animations[0]->cadres as $key => $cadre){ 
						$cadre_overlay = '';
						if(trim($cadre->file_name) != '' || trim($cadre->file_overlay) != ''){
							// var_dump($cadre->id);
							$cadre_overlay = trim($cadre->file_name) && trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-image:url(/import/config_bornes/'.$evenement->id.'/cadres/'.$cadre->file_name.');background-size:cover;background-position:center;">' : (trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-size:cover;background-position:center;">' : '');
			?>
			<li class="dd-item" data-id="<?php echo $i; ?>">
				<div class="dd-handle">
					<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i> </button>
				</div>
				<div class="row bg-light kl_cadre col-sm-12" data-id="<?php echo $i; ?>">
					<button type="button" class="btn btn-danger btn-circle kl-bloc-remove"><i class="fa fa-times"></i> </button>
					<div class="col-sm-4">
						<div class="kl_cadre_dropzone_tmp kl_cadre_dropzone dropzone <?php  echo !empty($cadre->file_name) ? 'hide' : ''; ?>"></div>
						<div class="kl_cadre_uploaded">
							<?php if(!empty($cadre->file_name)){ ?>
							<img class="cadre-image" src="/import/config_bornes/<?php echo $evenement->id; ?>/cadres/<?php echo $cadre->file_name; ?>">
							<?php } ?>
						</div>
						<div id="id_oneCadre_<?php echo $i; ?>">
							<input type="hidden" class="cadre-id" value="<?= $cadre->id ?>" name="configuration_animations[0][cadres][<?= $i ?>][id]" />
						</div>
						
					</div>
					<div class="col-sm-4">
						<div class="label-overlay">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="kl_cadre_check custom-control-input" id="klCadreChk<?php echo $i; ?>" <?php echo (trim($cadre->file_overlay) != '') ? 'checked="checked"' : ''; ?>>
								<span class="custom-control-label"> Créer un overlay</span>
							</label>
							<?php if(trim($cadre->file_overlay) != ''){ ?>
							<button class="btn btn-danger waves-effect waves-light kl_cadre_overlay_overlay" type="button"><span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer overlay</button><br/>
							<?php }else{ ?>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload overlay</button><br/>
							<?php } ?>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
							
							<?php // Fichier de l'overlay ?>
							<input type="file" class="fichier_overlay hide" accept="image/png">
							<input type="hidden" class="cadre-overlay file_overlay" value="<?= $cadre->file_overlay; ?>" name="configuration_animations[0][cadres][<?= $i ?>][file_overlay]">
							<input type="hidden" class="cadre-ordre" id="cadre-ordre-<?php echo $i; ?>" value="<?= $cadre->ordre ?>" name="configuration_animations[0][cadres][<?= $i ?>][ordre]" />
							<input type="hidden" class="cadre-filename filename" id="cadre-filename-<?php echo $i; ?>" value="<?= $cadre->file_name ?>" name="configuration_animations[0][cadres][<?= $i ?>][file_name]" />
							
							<?php // Image test à venir ?>
							<input type="file" class="fichier hide" accept="image/gif, image/jpeg, image/png">
							
							<div class="kl_cadre_remove <?php echo trim($cadre->file_name) ? '' : 'hide'; ?>"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Supprimer ce cadre?</a></div>
						</div>
					</div>
					<div class="col-sm-4 kl_cadre_overlay"><?php echo $cadre_overlay; ?></div>
				</div>
			</li>
			<?php
							$i++;
						}
					}
				}else{
			?>
			<li class="dd-item" data-id="0">
				<div class="dd-handle">
					<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i> </button>
				</div>
				<div class="row bg-light kl_cadre col-sm-12" data-id="0">
					<button type="button" class="btn btn-danger btn-circle kl-bloc-remove"><i class="fa fa-times"></i> </button>
					<div class="col-sm-4">
						<div class="kl_cadre_dropzone_tmp kl_cadre_dropzone dropzone"></div>
						<div class="kl_cadre_uploaded"></div>
					</div>
					<div class="col-sm-4">
						<div class="label-overlay">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="kl_cadre_check custom-control-input" id="klCadreChk0" >
								<span class="custom-control-label"> Créer un overlay</span>
							</label>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload overlay</button><br/>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
							
							<?php // Fichier de l'overlay ?>
							<input type="file" class="fichier_overlay hide" accept="image/png">
							<input type="hidden" value="" name="configuration_animations[0][cadres][0][file_overlay]" class="file_overlay">
							<input type="hidden" class="cadre-ordre" id="cadre-ordre-0" value="0" name="configuration_animations[0][cadres][0][ordre]" />
							<input type="hidden" class="cadre-filename filename" id="cadre-filename-0" value="0" name="configuration_animations[0][cadres][0][file_name]" />
							
							<input type="file" class="fichier hide" accept="image/gif, image/jpeg, image/png">
							<div class="kl_cadre_remove hide"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Supprimer ce cadre?</a></div>
						</div>
					</div>
					<div class="col-sm-4 kl_cadre_overlay"></div>
				</div>
			</li>
			<?php } ?>
			
			</ol>
			
		</div>
			
			
		<div class="row" id="kl_cadre_ajout_div"><button type="button" class="btn btn-outline-danger" id="kl_cadre_ajout"><i class="fa fa-plus"></i> Personnaliser un nouvel cadre et overlay</button></div>
	<?php // Fin nouvelle version ?>
	
	
	
	<?php // debut version 1 : upload multiple cadres ?>
	<?php if(false){ ?>
        <div class="kl_labelDesc">Vous pouvez ajouter autant de cadres que souhaités. Gérez l’ordre d’affichage en glissant / déposant.</div>
        <div class="id_cadreDropzoneAndPreview">
            <div id="id_uploadCadreMuliple" class="dropzone sortable">
                <?php 
                // debug($configurationBorne->configuration_animations);
                if(!empty($configurationBorne->configuration_animations[0])){
                foreach($configurationBorne->configuration_animations[0]->cadres as $key => $cadre){ 
                    if(!empty($cadre->file_name)){
                    ?>
                    <div class="dz-preview dz-processing dz-image-preview dz-complete" id="id_oneCadre_<?= $cadre->id ?>">
                       <div class="dz-image"><img data-dz-thumbnail="" class="kl_editCadre" alt="" src="<?= Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$cadre->file_name ?>"></div>
                       <a class="dz-remove kl_deleteEdit" href="javascript:undefined;" data-dz-remove="" data-cadreid="<?= $cadre->id ?>">Remove file</a>
                       <input type="hidden" class="" value="<?= $cadre->id ?>" name="configuration_animations[0][cadres][<?= $key ?>][id]" />
                       <input type="hidden" class="" value="<?= $cadre->ordre ?>" name="configuration_animations[0][cadres][<?= $key ?>][ordre]" />
                       <input type="hidden" class="" value="<?= $cadre->file_name ?>" name="configuration_animations[0][cadres][<?= $key ?>][file_name]" />
                    </div>
                <?php }}} ?>
            </div>
            
        </div>
		
        <div class="kl_info">Rappel : Format image : .png (avec fond transparent) - Dimensions : 1844 x 1200px - 72dpi - Couleurs : RVB</div>
	<?php } ?>
	<?php // fin version 1 ?>
        
    </div>
</div>
<div class="col-12">
    <br/><hr><br/>
</div>

