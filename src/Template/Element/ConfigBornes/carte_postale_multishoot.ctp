<?php use Cake\Routing\Router; ?>
<div class="row card cf_anim_multishoot" id="id_cf_anim_multishoot">
    <div class="col-sm-12 no-padding">
		<h4 class="">Carte postale multishoot</h4>
	</div>
    <div class="col-sm-12 no-padding">
		<h5>Nombres de poses </h5>
	</div>
    <div class="col-md-12 cf_nbr_pose no-padding">    
     <?php 
        $nbr_pose = null;
        if(!empty($configurationBorne->configuration_animations5)){
            $nbr_pose = $configurationBorne->configuration_animations5[0]->nbr_pose;
        }
     ?>
    <?php
        $nbrPoses = [2 => 2, 3 => 3, 4 => 4 ];
        echo $this->Form->control('configuration_animations.5.nbr_pose', ['options' => $nbrPoses, 'value'=> $nbr_pose, 'label' => false, 'empty'=> 'Séléctionner', 'id'=>'id_nbrDePose_multishoot']);
        ?>
	</div>
	
    <div class="kl_listeDispositionVignette row <?= !empty($configurationBorne->configuration_animations5[0]->disposition_vignette_id) ? "":"hide" ?>" >
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
            <div data-animation="<?= $disposition->type_animation_id ?>" class="col-md-2 kl_oneDispostionMultipose kl_oneDispostion kl_dispositionVignette_<?= $disposition->nbr_pose ?>_pourAnimation_<?= $disposition->type_animation_id ?>  kl_dispositionVignette_<?= $disposition->nbr_pose ?> <?= $kl_selected." ".$kl_hide ?>" data-key="<?= $disposition->id ?>" id="id_siposition_<?= $disposition->id ?>">
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
    </div>

    <div class="col-md-12 cf_cadre no-padding cadre-pers">
        <div class="card-body no-padding-left no-padding-right">
			<div class="col-sm-12 no-padding">
				<h5>Visuel </h5>
			</div>
            <?php if($is_new || empty($configurationBorne->configuration_animations5[0]->cadres)) { ?>
                <div class="cf_anim_bloc_cadre bloc_cadre_anim"  id="bloc_cadre_anim_0">               
                    <div class="card-body bloc_btn_option_cadre">
                        <ul class="list-inline pull-right">
                            <li> <a href="#" class="btn_ajout_autre_cadre" data-owner="5" data-typeanimation="id_cf_anim_multishoot">Ajouter un autre cadre</a></li>
                            <li> <a href="#" class="btn_suppr_cadre" id="btn_suppr_cadre_0" data-typeanimation="5">Supprimer ce cadre</a> </li>
                        </ul>
                    </div>               
                    <div class="row">
                        <div class="col-md-4 bloc_file">
                            <?php 
                                $urlCadreSimple = null;
                                $cadre_overlay = '';
                                $cadre = [];
                                /* debug($configurationBorne); */
                                if(!empty($configurationBorne->configuration_animations5[0]->cadres)){
                                        $cadre = $configurationBorne->configuration_animations5[0]->cadres[0];
                                        $fileName = $configurationBorne->configuration_animations5[0]->cadres[0]->file_name;
                                        if(trim($fileName) != '')
                                            $urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                        
                                        $cadre_overlay = trim($cadre->file_name) && trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-image:url(/import/config_bornes/'.$evenement->id.'/cadres/'.$cadre->file_name.');background-size:cover;background-position:center;">' : (trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-size:cover;background-position:center;">' : '');
                            ?>
                                <input type="hidden" value="<?= $cadre->id ?>" name="configuration_animations[5][cadres][0][id]" />
                                <input type="hidden" value="<?= $cadre->ordre ?>" name="configuration_animations[5][cadres][0][ordre]" />
                                <input type="hidden" class="cadre-filename-pers" value="<?php echo (!empty($cadre->file_name) ? $cadre->file_name : ''); ?>" name="configuration_animations[5][cadres][0][file_name]" />
                            <?php }?>
                                                
                            <?php	
                                if(!empty($configurationBorne->configuration_animations5[0])){                          
                                    echo '<input type="hidden" name="configuration_animations[5][id]" value="'.$configurationBorne->configuration_animations5[0]->id.'">' ;                      
                                } 
                            ?>						
                            <input type="hidden" name="configuration_animations[5][type_animation_id]" value="5" class="form-control">
                            <input type="file" name="configuration_animations[5][cadre_file][]" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
                        </div>
                        <div class="col-md-4 bloc_ajout_overlay">
                            <div class="label-overlay-pers">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="kl_cadre_check-pers custom-control-input" <?php echo (isset($cadre->file_overlay) && trim($cadre->file_overlay) != '') ? 'checked="checked"' : ''; ?>>
                                    <span class="custom-control-label"> Ajouter un overlay</span>
                                </label>
                                <?php if(isset($cadre->file_overlay) && trim($cadre->file_overlay) != ''){ ?>
                                <button class="btn btn-danger waves-effect waves-light kl_cadre_overlay_overlay-pers" type="button"><span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer overlay</button><br/>
                                <?php }else{ ?>
                                <button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Importer overlay</button><br/>
                                <?php } ?>
                                <button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
                                
                                <?php // Fichier de l'overlay ?>
                                <input type="file" class="fichier_overlay-pers hide" accept="image/png">
                                <input type="hidden" class="cadre-overlay-pers file_overlay-pers" value="<?php echo (isset($cadre->file_overlay) && trim($cadre->file_overlay) != '') ? $cadre->file_overlay : ''; ?>" name="configuration_animations[5][cadres][0][file_overlay]">
                                
                                <?php // Image test à venir ?>
                                <input type="file" class="fichier-pers hide" accept="image/gif, image/jpeg, image/png">
                                
                            </div>
                        </div>
                        <div class="col-sm-4 kl_cadre_overlay-pers"><?php echo $cadre_overlay; ?></div>
                    </div>

                </div>
            
			<?php } else { ?>
				<?php  
					if(!empty($configurationBorne->configuration_animations5[0]->cadres)){
						foreach($configurationBorne->configuration_animations5[0]->cadres as $ordre => $cadre){
							echo $this->Form->control('cadre_to_delete.'.($ordre),["type"=>"hidden","id"=>"cadre_to_delete_".$ordre]);?>
							<?php 
								$urlCadreSimple = null;
								$cadre_overlay = '';
								$fileName = $cadre->file_name;
								if(trim($fileName) != ''){
									$urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
								}
								$cadre_overlay = trim($cadre->file_name) && trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-image:url(/import/config_bornes/'.$evenement->id.'/cadres/'.$cadre->file_name.');background-size:cover;background-position:center;">' : (trim($cadre->file_overlay) ? '<img src="/import/config_bornes/'.$evenement->id.'/cadres/'. $cadre->file_overlay .'" style="width:100%;background-size:cover;background-position:center;">' : '');
							?>
							
							<div class="cf_anim_bloc_cadre bloc_cadre_anim"  id="bloc_cadre_anim_<?= $ordre ?>" <?php if($ordre != 0) echo 'style="margin-top: 10px;"' ;?>>
											<!--<div class="cf_blocDropzone">                    
												<p class="">Glissez ou cliquez ici pour ajouter </p>
											</div>  -->
											<div class="card-body bloc_btn_option_cadre">
												<ul class="list-inline pull-right">
												<?php if($ordre == 0) echo '<li> <a href="#" class="btn_ajout_autre_cadre" data-owner="5"  data-typeanimation="id_cf_anim_multishoot">Ajouter un autre cadre</a></li>' ; ?>
													<li> <a href="#" class="btn_suppr_cadre" id="btn_suppr_cadre_<?= $ordre ?>" data-owner="<?= $cadre->id ?>" data-typeanimation="5" >Supprimer ce cadre</a> </li>
												</ul>
											</div>
											<div class="row kl_cadreSimple  cadre-pers">
												<div class="col-md-4 bloc_file">
														<input type="hidden" value="<?= $cadre->id ?>" name="configuration_animations[5][cadres][<?= $ordre ?>][id]" />
														<input type="hidden" value="<?= $cadre->ordre ?>" name="configuration_animations[5][cadres][<?= $ordre ?>][ordre]" />
														<input type="hidden" class="cadre-filename-pers" value="<?= $cadre->file_name ?>" name="configuration_animations[5][cadres][<?= $ordre ?>][file_name]" />
													
													<?php	
														if(!empty($configurationBorne->configuration_animation5[0])){                          
															echo '<input type="hidden" name="configuration_animations[5][id]" value="'.$configurationBorne->configuration_animations5[0]->id.'">' ;                      
														}
													?>
													<input type="hidden" name="configuration_animations[5][type_animation_id]" value="5" class="form-control">
													<input type="hidden" name="configuration_animations[5][type_cadre]" value="1" class="form-control">
													<input type="file" name="configuration_animations[5][cadre_file][]" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
												</div>
												<div class="col-md-4 bloc_ajout_overlay">
													<div class="label-overlay-pers">
														<label class="custom-control custom-checkbox">
															<input type="checkbox" class="kl_cadre_check-pers custom-control-input" <?php echo (isset($cadre->file_overlay) && trim($cadre->file_overlay) != '') ? 'checked="checked"' : ''; ?>>
															<span class="custom-control-label"> Ajouter un overlay</span>
														</label>
														<?php if(isset($cadre->file_overlay) && trim($cadre->file_overlay) != ''){ ?>
														<button class="btn btn-danger waves-effect waves-light kl_cadre_overlay_overlay-pers" type="button"><span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer overlay</button><br/>
														<?php }else{ ?>
														<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_overlay-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Importer overlay</button><br/>
														<?php } ?>
														<button class="btn btn-secondary waves-effect waves-light kl_cadre_overlay_photo-pers hide" type="button"><span class="btn-label"><i class="fa fa-download"></i></span>Upload photo</button>
														
														<?php // Fichier de l'overlay ?>
														<input type="file" class="fichier_overlay-pers hide" accept="image/png">
														<input type="hidden" class="cadre-overlay-pers file_overlay-pers" value="<?php echo (isset($cadre->file_overlay) && trim($cadre->file_overlay) != '') ? $cadre->file_overlay : ''; ?>" name="configuration_animations[5][cadres][<?= $ordre ?>][file_overlay]">
														
														<?php // Image test à venir ?>
														<input type="file" class="fichier-pers hide" accept="image/gif, image/jpeg, image/png">
														
													</div>
												</div>
												<div class="col-sm-4 kl_cadre_overlay-pers"><?php echo $cadre_overlay; ?></div>
											</div>											
							</div>

						<?php } ?>					
					<?php } ?>
			<?php } ?>
        </div>
    </div>

    <?php //echo $this->element('ConfigBornes/bloc_prise_filtre_fondvert'); ?>
</div>