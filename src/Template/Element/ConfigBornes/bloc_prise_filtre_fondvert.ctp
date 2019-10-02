	
	<div class="col-md-12 cf_prise sf-bd-t no-padding">
        <div class="card-body no-padding-left no-padding-right p-t-40">
            <div class="col-sm-12 m-b-40 no-padding">
				<h5>Prise de photo</h5>
			</div>
			<!--h4 class="card-title bold">Prise de photo</h4-->
            <div class="">           
                <h6 class="">Décompte prise de photo (secondes)</h6>
                <div class="row col-md-4">
                    <!--<input type="number" name="decompte_prise_photo[]" id="decompte-prise-photo" class="form-control">-->
                    <?php $decompte_prise_photo = 8; if(!empty($configurationBorne->decompte_prise_photo)) $decompte_prise_photo = $configurationBorne->decompte_prise_photo; ?>
                    <?php echo $this->Form->control('decompte_prise_photo', ["label"=>false, "type"=>"text", "class" =>"form-control sf-form-mini", 'value' => $decompte_prise_photo, 'maxlength' => 3]); ?>
                </div><br>
                
                <h6 class="">Autoriser la reprise de photo</h6>
                <div class="col-md-4 row">
                <?php //$is_reprise_photo = null; if($configurationBorne->is_reprise_photo) $is_reprise_photo = 1; ?>
                    
					<label class="custom-control custom-radio m-r-40">
                        <input type="radio" name="is_reprise_photo" value="1" class="custom-control-input" <?php echo ($configurationBorne->is_reprise_photo == 1 ? "checked='checked'" : "");?>><span class="custom-control-label">Oui</span>
                    </label>
					<label class="custom-control custom-radio">
                        <input type="radio" name="is_reprise_photo" value="0" class="custom-control-input" <?php echo ($configurationBorne->is_reprise_photo == 0 ? "checked='checked'" : "");?>>
                    <span class="custom-control-label">Non</span></label>
                    
                    <?php
                            /*echo $this->Form->radio(
                                'is_reprise_photo',
                                [
                                    ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input m-r-40'],
                                    ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                ],
                                ['default' => 1,'label' =>'']
                            );*/
                    ?>

                </div>
            </div>
        </div>
    </div>
	<hr  class="cf_prise">      
    
    <div class="col-md-12 cf_filtre no-padding">
        <div class="card-body no-padding-left no-padding-right">
            <div class="col-sm-12 no-padding">
				<h5>Filtres de couleurs</h5>
                <?php	
                    use Cake\Collection\Collection;
                    use Cake\Routing\Router;
                    $filtres_ids = [];
                    if(!empty($configurationBorne->filtres)) {
                        $collection = new Collection($configurationBorne->filtres);
                        $filtres_ids = $collection->extract('id');
                        $filtres_ids = $filtres_ids->toList();
                    }					
				?>
			</div>
			<div class="col-sm-12 no-padding">
				<p class="control-label m-b-20">Offrez à vos utilisateurs la possibilité de choisir un filtre de couleur. Vous pouvez choisir plusieurs. Si un seul est choisit, l'effet s'appliquera automatiquement.</p>
			</div>
			<!--h4 class="card-title ">Filtres de couleurs</h4>
            <h6 class="">Offrez à vos utilisateurs la possibilité de choisir un filtre de couleur. Vous pouvez choisir plusieurs. Si un seul est choisit, l'effect s'appliquera automatiquement.</h6-->
            <?php 
                foreach($filtres as $key => $filtre) {
                    //debug($filtre);
                    $classe_filtre = 
                    $label =  "";
                    if($key == 1) {
						$classe_filtre = 'cf_filtre_couleur';
                        $label = "Affiche la photo en couleur";
                    }
                    if($key == 2) {
						$classe_filtre = 'cf_filtre_noir_et_blanc';
                        $label = "Applique un filtre Noir & blanc sur la photo";
                    }
                    if($key == 3) {
						$classe_filtre = 'cf_filtre_sepia';
                        $label = "Applique un filtre Sepia sur la photo";
                    }
                    ?>
                    <div class="<?php echo $classe_filtre ?> p-t-15 p-b-15">
                        <div class="row">
                            <div class="col-md-2 m-a">
								<label class="custom-control custom-checkbox" >
									<input name="filtres[_ids][]" id="<?php echo md5($key); ?>"  value="<?= $key ?>" type="checkbox" class="custom-control-input cf_filtres" <?php echo (in_array($key, $filtres_ids) ? 'checked="checked"' : ''); ?> >
									<?php echo '<span class="custom-control-label m-l-10">'.$filtre.'</span>'; ?>
								</label>
                            </div>
                            <div class="col-md-4 no-padding m-a">
                                <label for="<?php echo md5($key); ?>"><?php echo $label; ?></label>
                            </div>
                            <div class="col-md-6">
                                <img src="/img/gallery/gallery_calque.jpg" alt="" width="23%">
                            </div>
                        </div>
                    </div>
             <?php  }  ?>
        </div>
    </div>
	 <!--<hr class="cf_filtre">

        <div class="col-md-12 cf_fond_vert no-padding">
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
            </div><br>

            <div class="cf_images_fond_vert hide">
                <h6><strong>Image(s) de fond : </strong></h6>
                <p>Vous pouvez ajouter autant d'images que souhaité .<br>
                <em>Rappel : Format Image : jpg - Dimensions : 1900X1020px - 72dpl - Couleurs : RVB</em></p>
                <div class="dropzone kl_blocDropzone cf_anim_bloc_dz_fv" id="dropzone_fond_vert"></div>

                <?php // Edition image FV ?>
                <?php if(!empty($configurationBorne->fond_verts)){ ?>
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
    -->