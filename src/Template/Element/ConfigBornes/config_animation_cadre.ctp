<div class="row card cf_anim">
    <div class="col-md-12 cf_cadre no-padding">
        <div class="card-body no-padding-left no-padding-right">
			<div class="col-sm-12 no-padding">
				<h5>Cadre paysage</h5>
			</div>
			<!--h4 class="card-title ">Cadre paysage</h4-->
            <h6 class="">.Rappel : Format image : .png (avec fond transparent) - Dimensions : 1844 X 1200px - 720dpi - Couleurs : RVB</h6>
            <div class="cf_anim_bloc_cadre">
                <!--<div class="cf_blocDropzone">                    
                    <p class="">Glissez ou cliquez ici pour ajouter </p>
                </div>  -->
                <div class="row ">
                    <div class="col-sm-4">
                        <div class="cf_blocDropify">
                            <input  type="file" name="cadres_file" class="dropify_cadre" accept=".jpg, .jpeg" data-height="120" data-default-file="">
                        </div>
                    </div>
                    <div class="col-sm-4">           
                        <a href="#" class="" onclick="return false;">Ajouter un overlay</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
	<hr>

    <div class="col-md-12 cf_prise no-padding">
        <div class="card-body no-padding-left no-padding-right">
            <div class="col-sm-12 m-b-40 no-padding">
				<h5>Prise de photo</h5>
			</div>
			<!--h4 class="card-title bold">Prise de photo</h4-->
            <div class="">           
                <h6 class="">Décompte prise de photo (secondes)</h6>
                <div class="col-md-4 row">
                    <!--<input type="number" name="decompte_prise_photo" id="decompte-prise-photo" class="form-control">-->
                    <?php echo $this->Form->control('decompte_prise_photo', ["label"=>false,"type"=>"number", "class" =>"form-control" ]); ?>
                </div><br>
                
                <h6 class="">Autoriser la reprise de photo</h6>
                <div class="col-md-4 row">
                    <!--<input type="hidden" name="is_reprise_photo" value="" class="form-control"-->
					<label class="custom-control custom-radio m-r-40" for="is-reprise-photo-1"><input type="radio" name="is_reprise_photo" value="1" class="custom-control-input" id="is-reprise-photo-1"><span class="custom-control-label">Oui</span></label>
					<label class="custom-control custom-radio" for="is-reprise-photo-0"><input type="radio" name="is_reprise_photo" value="0" class="custom-control-input" id="is-reprise-photo-0" checked="checked"><span class="custom-control-label">Non</span></label>
                    <?php
                            // echo $this->Form->radio(
                                // 'is_reprise_photo',
                                // [
                                    // ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input m-r-40'],
                                    // ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                // ],
                                // ['default' => 1,'label' =>'']
                            // );
                    ?>

                </div>
            </div>
        </div>
    </div>
	<hr>            

    
    <div class="col-md-12 cf_filtre no-padding">
        <div class="card-body no-padding-left no-padding-right">
            <div class="col-sm-12 no-padding">
				<h5>Filtres de couleurs</h5>
			</div>
			<div class="col-sm-12">
				<p class="control-label m-b-20">Offrez à vos utilisateurs la possibilité de choisir un filtre de couleur. Vous pouvez choisir plusieurs. Si un seul est choisit, l'effect s'appliquera automatiquement.</p>
			</div>
			<!--h4 class="card-title ">Filtres de couleurs</h4>
            <h6 class="">Offrez à vos utilisateurs la possibilité de choisir un filtre de couleur. Vous pouvez choisir plusieurs. Si un seul est choisit, l'effect s'appliquera automatiquement.</h6-->
            <div class="cf_filtre_couleur p-15">
                <div class="row ">
                    <div class="col-md-3">
                        <input name="filtres[_ids][]"  value="1" type="checkbox" ><label class="m-l-20"> Couleur </label>
                    </div>
                    <div class="col-md-4 no-padding">
                        <label class="">Affiche la photo en couleur</label>
                    </div>
                    <div class="col-md-4">
                        <img src="/img/gallery/gallery_calque.jpg" alt="" width="40%">
                    </div>
                </div>
            </div>
            <div class="cf_filtre_noir_et_blanc p-15">
				<div class="row ">
                    <div class="col-md-3 cf_content_filtre">
                        <input  name="filtres[_ids][]" value="2" type="checkbox"><label class="m-l-20"> Noir & blanc </label>
                    </div>
                    <div class="col-md-4 no-padding cf_content_filtre">
                        <label class="">Applique un filtre Noir & blanc sur la photo</label>
                    </div>
                    <div class="col-md-4 cf_content_filtre">
                        <img src="/img/gallery/gallery_calque.jpg" alt="" width="40%">
                    </div>
                </div>
            </div>
            <div class="cf_filtre_sepia p-15">
				<div class="row ">
                    <div class="col-md-3 cf_content_filtre">
                        <input  name="filtres[_ids][]" value="3" type="checkbox" ><label class="m-l-20"> Sepia </label>
                    </div>
                    <div class="col-md-4 no-padding cf_content_filtre">
                        <label class="">Applique un filtre Sepia sur la photo</label>
                    </div>
                    <div class="col-md-4 cf_content_filtre">
                        <img src="/img/gallery/gallery_calque.jpg" alt="" width="40%">
                    </div>
                </div>
            </div>
        </div>
    </div>
	<hr>
    
    <div class="col-md-12 cf_fond_vert no-padding">
        <div class="card-body no-padding-left no-padding-right">
            <div class="col-sm-12 no-padding">
				<h5>Incrustation fond verts</h5>
			</div>
			<div class="col-sm-12 no-padding">
				<p class="control-label m-b-20">L'animation photo fond vert consiste à prendre en photo une personne ou un groupe de personnes sur un fond vert ou bleu uni qui est automatiquement remplacé par un ou plusieurs fonds photos en accord avec la thématique de l'évèvenement. <strong>Attention vous devez bien posseder un fond vert pour utiliser cette fonctionnalité !</strong></p>
			</div>
			<!--h4 class="">Incrustation fond verts</h4>
            <h6 class="">L'animation phot fond vert consiste à prendre en photo une personne ou un groupe de personnes sur un fond vert ou bleu uni qui est automatiquement remplacé par un ou plusieurs fonds photos en accord avec la thématique 
            de l'évèvenement. <strong>Attention vous devez bien posseder un fond vert pour utiliser cette fonctionnalité !</strong></h6><br-->
            <div class="col-md-4 row">
				<!--<input type="hidden" name="is_reprise_photo" value="" class="form-control"-->
				<label class="custom-control custom-radio m-r-40" for="is_incrustation_fond_vert-1"><input type="radio" name="is_incrustation_fond_vert" value="1" class="custom-control-input" id="is_incrustation_fond_vert-1" checked="checked"><span class="custom-control-label">Oui</span></label>
				<label class="custom-control custom-radio" for="is_incrustation_fond_vert-0"><input type="radio" name="is_incrustation_fond_vert" value="0" class="custom-control-input" id="is_incrustation_fond_vert-0"><span class="custom-control-label">Non</span></label>
                <?php
                    // echo $this->Form->radio(
                    // 'is_incrustation_fond_vert',
                    // [
                        // ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                        // ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                    // ],
                    // ['default' => 1,'label' =>'']
                    // );
                ?>
            </div><br>

            <h6><strong>Images de fond : </strong></h6>
            <p>Vous pouvez ajouter autant d'images que souhaité .<br>
            <em>Rappel : Format Image : jpg - Dimensions : 1900X1020px - 72dpl - Couleurs : RVB</em></p>
            <div class="dropzone kl_blocDropzone cf_anim_bloc_cadre" id="dropzone_fond_vert"></div>
        </div>
    </div>

     <!--<div class="col-sm-12">
        <div class="dropzone kl_blocDropzone cf_anim_bloc_cadre" id="dropzone_fond_vert"></div>
    </div>-->


</div>