<div class="row card cf_anim" id="id_add_anim">   
    <div class="col-sm-12 no-padding">
		<h5>Type animation </h5>
	</div>
    <div class="col-md-12 no-padding">
        <?php 
            echo $this->Form->control('type_animations[_ids][]', ['options'=> $typeAnimationsList, 'required' => true,  'multiple' => false,'label' => false, 'id' => 'id_nouv_choix_type_anim']);
        ?>
    </div>

    <!-- Nombre de poses -->
    <div class="col-sm-12 no-padding cf_nbr_pose hide">
		<h5>Nombres de poses </h5>   
     <?php 
        $nbr_pose = null;
        if(!empty($configurationBorne->configuration_animations5)){
            $nbr_pose = $configurationBorne->configuration_animations5[0]->nbr_pose;
        }
     ?>
        <?php // Multipose
            $nbrPoses = [2 => 2, 3 => 3, 4 => 4 ];
            echo $this->Form->control('configuration_animations.5.nbr_pose', ['options' => $nbrPoses, 'value'=> $nbr_pose, 'label' => false, 'empty'=> 'Séléctionner', 'class'=>'custom-select hide', 'id'=>'id_nbrDePose_multishoot_2']);
        ?>

        <?php  // Marque page
            $nbrPoses = [ 3 => 3, 4 => 4 ];
            echo $this->Form->control('configuration_animations.3.nbr_pose', ['options' => $nbrPoses, 'value'=> $nbr_pose, 'label' => false, 'empty'=> 'Séléctionner','class'=>'custom-select hide', 'id'=>'id_nbrDePose_marque_pg_2']);
        ?>
	
        <div class="kl_listeDispositionVignette_2 row <?= !empty($configurationBorne->configuration_animations5[0]->disposition_vignette_id) ? "":"hide" ?>" >
            <label class="col-md-12 kl_labelCustom">Disposition des vignettes </label>
            <?php 
            $optionDispositions = array();
            //debug($dispositionVignettes);
            //debug($configurationBorne->nb_pose_mulipose);
            foreach($dispositionVignettes as $disposition){ 
                if($disposition->type_animation_id == 5){ 
                    $kl_selected = "";
                    $kl_hide = "hide";
                    if(!empty($configurationBorne->configuration_animations5[0])){
                        if($disposition->id == $configurationBorne->configuration_animations5[0]->disposition_vignette_id){
                            $kl_selected = "selected";
                        } 
                        if($disposition->nbr_pose == $configurationBorne->configuration_animations5[0]->nbr_pose){
                            $kl_hide = "";
                        }
                    }
            ?>
                <div data-animation="<?= $disposition->type_animation_id ?>" class="col-md-2 kl_oneDispostionMultipose_2 kl_oneDispostion kl_dispositionVignette_<?= $disposition->nbr_pose ?>_pourAnimation_<?= $disposition->type_animation_id ?>  kl_dispositionVignette_<?= $disposition->nbr_pose ?> <?= $kl_selected." ".$kl_hide ?>" data-key="<?= $disposition->id ?>" id="id_siposition_<?= $disposition->id ?>">
                    <?= $this->Html->image('disposition_vignettes/'.$disposition->file_name, ['alt' => $disposition->id,'class' => 'kl_imageDisposition']); ?>
                </div>
            <?php 
                $optionDispositions[$disposition->id] = $disposition->id;
                } else
                
                if($disposition->type_animation_id == 3){
                    $kl_selected = "";
                    $kl_hide = "hide";
                    if(!empty($configurationBorne->configuration_animations3[0])){
                        if($disposition->id == $configurationBorne->configuration_animations3[0]->disposition_vignette_id){
                            $kl_selected = "selected";
                        } 
                        if($disposition->nbr_pose == $configurationBorne->configuration_animations3[0]->nbr_pose){
                            $kl_hide = "";
                        }
                    }
                    ?>
                        <div data-animation="<?= $disposition->type_animation_id ?>" class="col-md-2 kl_oneDispostionBandelette_2 kl_oneDispostion kl_dispositionVignette_<?= $disposition->nbr_pose ?>_pourAnimation_<?= $disposition->type_animation_id ?>  kl_dispositionVignette_<?= $disposition->nbr_pose ?> <?= $kl_selected." ".$kl_hide  ?>" data-key="<?= $disposition->id ?>" id="id_siposition_<?= $disposition->id ?>">
                            <?= $this->Html->image('disposition_vignettes/'.$disposition->file_name, ['alt' => $disposition->id,'class' => 'kl_imageDisposition']); ?>
                        </div>
                    <?php 
                        $optionDispositions[$disposition->id] = $disposition->id;
                }
            } 
            
            ?>
            <div class="col-md-12 hide">
                <?= $this->Form->control('configuration_animations.5.disposition_vignette_id',['label' => 'Dispositon vignette', 'options'=>$optionDispositions, 'empty'=>'Séléctionner', 'class'=>'no-style', 'id'=>'id_dispositionvignette_5']); ?>
            </div>

            <div class="col-md-12 hide">
                <?= $this->Form->control('configuration_animations.3.disposition_vignette_id',['label' => 'Dispositon vignette', 'options'=>$optionDispositions, 'empty'=>'Séléctionner', 'class'=>'no-style', 'id'=>'id_dispositionvignette_3']); ?>
            </div>
        </div>
	</div>

    <!-- Fin Nombre de pose -->
    <div class="col-sm-12 no-padding">
				<h5><!--Cadre portrait --></h5>
	</div>
    <div class="col-md-12 cf_cadre no-padding">
        <div class="card-body no-padding-left no-padding-right">
        <div class="cf_anim_bloc_cadre bloc_cadre_anim"  id="bloc_cadre_anim_0">               
				<div class="card-body bloc_btn_option_cadre">
					<ul class="list-inline pull-right">
						<li> <a href="#" class="btn_suppr_cadre" id="btn_suppr_cadre_0" data-typeanimation="0">Supprimer ce cadre</a> </li>
					</ul>
				</div>
				<div class="row kl_cadreSimple cadre-pers">
					<div class="col-md-4 bloc_file">
						<?php
							$urlCadreSimple = null;
							$cadre_overlay = '';
							$cadre = [];?>
						<?php ?>						
						<input type="hidden" name="" value="" class="form-control input_type_animation_config" >
                		<input type="hidden" name="" value="" class="form-control input_type_cadre">
						<input type="file" name="" class="dropifyCadre input_cadre_file" data-default-file=""   data-allowed-file-extensions="png" />
					</div>
					<div class="col-md-4 bloc_ajout_overlay">
						<div class="label-overlay-pers">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="kl_cadre_check-pers custom-control-input">
								<span class="custom-control-label"> Ajouter un overlay</span>
							</label>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Importer overlay</button><br/>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
							
							<?php // Fichier de l'overlay ?>
							<input type="file" class="fichier_overlay-pers hide" accept="image/png">
							<input type="hidden" class="cadre-overlay-pers file_overlay-pers input_file_overlay" value="" name="" >
							
							<?php // Image test à venir ?>
							<input type="file" class="fichier-pers hide" accept="image/gif, image/jpeg, image/png">
							
						</div>
					</div>
					<div class="col-sm-4 kl_cadre_overlay-pers"><?php echo $cadre_overlay; ?></div>
				</div>			
            </div>
        </div>        
    </div>
</div>

<!--- COPY SRC
<div class="row card cf_anim">    
    <div class="col-md-12 cf_nbr_pose no-padding">
    <?php 
            echo $this->Form->control('type_animations[_ids][]', ['options'=> $typeAnimationsList, 'required' => true,  'multiple' => false,'label' => 'Type animation', 'id' => 'id_nouv_choix_type_anim']);
        ?>
    </div>
    <div class="col-sm-12 no-padding">
				<h5><!--Cadre portrait -></h5>
	</div>
    <div class="col-md-12 cf_cadre no-padding">
        <div class="card-body no-padding-left no-padding-right">
        <div class="cf_anim_bloc_cadre bloc_cadre_anim"  id="bloc_cadre_anim_0">               
				<div class="card-body bloc_btn_option_cadre">
					<!--<ul class="list-inline pull-right">
						<li> <a href="#" class="btn_ajout_autre_cadre" data-owner="2" data-typeanimation="id_cf_anim_carte_postale_portrait">Ajouter un autre cadre</a></li>
						<li> <a href="#" class="btn_suppr_cadre" id="btn_suppr_cadre_0">Supprimer ce cadre</a> </li>
					</ul>->
				</div>
				<div class="row kl_cadreSimple cadre-pers">
					<div class="col-md-4 bloc_file">
						<?php
							$urlCadreSimple = null;
							$cadre_overlay = '';
							$cadre = [];?>
						<?php ?>						
						<input type="hidden" name="configuration_animations[1][type_animation_id]" value="1" class="form-control input_type_animation_config" >
                		<input type="hidden" name="configuration_animations[1][type_cadre]" value="1" class="form-control input_type_cadre">
						<input type="file" name="configuration_animations[1][cadre_file][]" class="dropifyCadre input_cadre_file" data-default-file=""   data-allowed-file-extensions="png" />
					</div>
					<div class="col-md-4 bloc_ajout_overlay">
						<div class="label-overlay-pers">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="kl_cadre_check-pers custom-control-input">
								<span class="custom-control-label"> Ajouter un overlay</span>
							</label>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Importer overlay</button><br/>
							<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
							
							<?php // Fichier de l'overlay ?>
							<input type="file" class="fichier_overlay-pers hide" accept="image/png">
							<input type="hidden" class="cadre-overlay-pers file_overlay-pers input_file_overlay" value="" name="configuration_animations[1][cadres][0][file_overlay]" >
							
							<?php // Image test à venir ?>
							<input type="file" class="fichier-pers hide" accept="image/gif, image/jpeg, image/png">
							
						</div>
					</div>
					<div class="col-sm-4 kl_cadre_overlay-pers"><?php echo $cadre_overlay; ?></div>
				</div>			
            </div>
        </div>        
    </div>
</div>

-->