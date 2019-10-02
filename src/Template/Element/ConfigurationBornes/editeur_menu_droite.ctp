<div class="col-xl-2 col-lg-3 sf-editeur-menu-droite">
	<div id="sf-other-options">
		<div class="sf-other-options-icon"><i class="fa fa-angle-double-left"></i></div>
		<div class="sf-other-options-choice">
			<a href="#" class="m-b-10 sf-canvas-export" data-tp="save"><i class="fa fa-save m-r-10"></i><small>Enregistrer</small></a>
			<a href="#" class="m-b-10 sf-canvas-export" data-tp="view"><i class="fa fa-eye m-r-10"></i><small>Aperçus</small></a>
			<a href="#" class="sf-canvas-export" data-tp="download"><i class="fa fa-download m-r-10"></i><small>Télécharger</small></a>
		</div>
	</div>
	<div id="accordion2" class="accordion sf-accordion" role="tablist" aria-multiselectable="true">
		<div class="card no-border sf-card-menu" data-order="0">
			<div class="card-header" role="tab" id="headingOne">
				<h5 class="mb-0 text-uppercase">
					<a class="sf-to-collapse hide sf-to-collapse-trigger" data-toggle="collapse" data-parent="#accordion2" data-order="0" href="#collapse1" aria-expanded="false" aria-controls="collapseOne">
						<i class="fa fa-building m-r-10"></i>Fonds
						<i class="mdi mdi-chevron-down pull-right"></i>
					</a>
				</h5>
			</div>
			<div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="headingOne">
				<div class="card-body no-padding">
					<ul class="list-group m-t-5 m-b-5">
						<li class="list-group-item no-radius sf-fond-couleur">
							<a class="sf-fond-option open" href="#color">Couleurs unies</a>
							<div id="color" class="sf-fond-option-menu">
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="#FFFFFF" type="button" style="background-color: #FFFFFF;">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(0, 150, 135)" type="button" style="background-color: rgb(0, 150, 135);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(181, 34, 179)" type="button" style="background-color: rgb(181, 34, 179);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(18, 81, 255)" type="button" style="background-color: rgb(18, 81, 255);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(255, 237, 71)" type="button" style="background-color: rgb(255, 237, 71);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(143, 134, 52)" type="button" style="background-color: rgb(143, 134, 52);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(209, 201, 132)" type="button" style="background-color: rgb(209, 201, 132);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(209, 132, 164)" type="button" style="background-color: rgb(209, 132, 164);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(214, 57, 122)" type="button" style="background-color: rgb(214, 57, 122);">&nbsp;</button>
								<button class="btn btn-circle sf-bg" data-tp="color" data-color="rgb(138, 41, 81)" type="button" style="background-color: rgb(138, 41, 81);">&nbsp;</button>
								<button class="btn btn-circle btn-secondary sf-abs-font" id="sf-bg-color-pers" data-tp="color" type="button"><i class="fa fa-plus"></i></button>
								<input value="#8a2951" type="hidden" id="sf-bg-color-pers-input" class="colorpicker2">
							</div>
						</li>
						
						<?php 
						if(!empty($editeurTemplates['fonds'])){
							foreach($editeurTemplates['fonds'] as $id => $item){
								if(!empty($editeurPhotos[$id])){
						?>
									<li class="list-group-item sf-fond-image" data-item="<?php echo $id ?>">
										<a class="sf-fond-option" href="#fond-<?php echo $id; ?>"><?php echo $item; ?></a>
										<div id="fond-<?php echo $id; ?>" class="sf-fond-option-menu hide">
											<?php
											echo $this->Form->control('tags', [
												'type' => 'select',
												'multiple' => true,
												'options' => $tags,
												'class' => 'select2 form-control col-md-12',
												'label' => false,
												'name' => false,
												'id' => 'sf-tags-'.$id,
												'hiddenField' => false,
												'style' => 'width: 100%;',
												'templates' => [
													'inputContainer' => '<div class="row sf-bloc-ligne"><div class="col-md-12" style="padding:8px;">{{content}}<i class="fa fa-search sf-search-tag"></i></div></div>',
												]
											]);
											?>
											<div class="sf-elt-initial">
											<?php 
											$i = 1;
											$init = true;
											$buffer = '';
											foreach($editeurPhotos[$id] as $photo_item){
												if($init){
													$buffer .= '<div class="row sf-bloc-ligne">';
													$init = false;
												}
												
												if($i == 3){
													$buffer .= '</div><div class="row sf-bloc-ligne">';
													$i = 1;
												}
												
												$buffer .= '<a href="#" class="sf-bg col-sm-6" data-tp="image" data-href="'.$photo_item->file_path.'">'.
													'<figure>'.
														'<img src="'.$photo_item->file_thumbnail_path.'">'.
													'</figure>'.
												'</a>';
												
												$i++;
											}
											$buffer .= '</div>';
											?>
											<?php echo $buffer; ?>
											</div>
											<div class="sf-elt-tag hide">
											</div>
										</div>
									</li>
						<?php 
								} 
							} 
						} 
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="card no-border-bottom no-border-left no-border-right sf-card-menu" data-order="1">
			<div class="card-header" role="tab" id="headingTwo">
				<h5 class="mb-0 text-uppercase">
					<a class="collapsed sf-to-collapse" data-toggle="collapse" data-parent="#accordion2" href="#collapse2" data-order="1" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fa fa-circle-o m-r-15"></i>Éléments
						<i class="mdi mdi-chevron-down pull-right"></i>
					</a>
				</h5>
			</div>
			<div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
				<div class="card-body no-padding">
					<ul class="list-group m-t-5 m-b-5">
						<?php 
						$is_open = true;
						if(!empty($editeurTemplates['éléments'])){
							foreach($editeurTemplates['éléments'] as $id => $item){
								if(!empty($editeurPhotos[$id])){
						?>
							<li class="list-group-item no-radius sf-fond-couleur">
								<a class="sf-fond-option-1 <?php echo $is_open ? 'open' : '' ?>" href="#elt-<?php echo $id; ?>"><?php echo $item; ?></a>
								<div id="elt-<?php echo $id; ?>" class="sf-fond-option-1-menu <?php echo $is_open ? '' : 'hide' ?>">
									<div class="sf-elt-initial">
								<?php 
									$is_open = false;
									$i = 1;
									$init = true;
									$buffer = '';
									foreach($editeurPhotos[$id] as $photo_item){
										if($init){
											$buffer .= '<div class="row sf-bloc-ligne">';
											$init = false;
										}
										
										if($i == 3){
											$buffer .= '</div><div class="row sf-bloc-ligne">';
											$i = 1;
										}
										
										$buffer .= '<a href="#" class="sf-elt col-sm-6" data-tp="image" data-href="'.$photo_item->file_path.'">'.
											'<figure>'.
												'<img src="'.$photo_item->file_thumbnail_path.'">'.
											'</figure>'.
										'</a>';
										
										$i++;
									}
									$buffer .= '</div>';
									?>
									<?php echo $buffer; ?>
									</div>
									<div class="sf-elt-tag hide">
									</div>
								</div>
							</li>
						<?php 
								}
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="card no-border-bottom no-border-left no-border-right sf-card-menu" data-order="2">
			<div class="card-header" role="tab" id="headingThree">
				<h5 class="mb-0 text-uppercase">
					<a class="collapsed sf-to-collapse" data-toggle="collapse" data-parent="#accordion2" data-order="2" href="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fa fa-barcode m-r-15"></i>Contours
						<i class="mdi mdi-chevron-down pull-right"></i>
					</a>
				</h5>
			</div>
			<div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="card-body">
					<div id="elt-contours" class="sf-fond-option-2-menu">
					<?php
					if(!empty($editeurTemplates['contours'])){
						foreach($editeurTemplates['contours'] as $id => $item){
							if(!empty($editeurPhotos[$id])){
					?>
						<?php 
						$i = 1;
						$init = true;
						$buffer = '';
						foreach($editeurPhotos[$id] as $photo_item){
							if($init){
								$buffer .= '<div class="row sf-bloc-ligne">';
								$init = false;
							}
							
							if($i == 3){
								$buffer .= '</div><div class="row sf-bloc-ligne">';
								$i = 1;
							}
							
							$buffer .= '<a href="#" class="sf-elt col-sm-6" data-tp="image" data-href="'.$photo_item->file_path.'">'.
								'<figure>'.
									'<img src="'.$photo_item->file_thumbnail_path.'">'.
								'</figure>'.
							'</a>';
							
							$i++;
						}
						$buffer .= '</div>';
						?>
						<?php echo $buffer; ?>
					<?php 
							}
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="card no-border-left no-border-right sf-card-menu" data-order="3">
			<div class="card-header" role="tab" id="headingThree">
				<h5 class="mb-0 text-uppercase">
					<a class="collapsed sf-to-collapse" data-toggle="collapse" data-parent="#accordion2" data-order="3" href="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fa fa-text-height m-r-15"></i>Textes
						<i class="mdi mdi-chevron-down pull-right"></i>
					</a>
				</h5>
			</div>
			<div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="card-body no-padding">
					<ul class="list-group m-t-5 m-b-5">
						<li class="list-group-item no-radius">
							<h1 class="sf-add-text" data-size="36" data-color="#22DD22"><a class="sf-color-black" href="#">Votre texte</a></h1>
						</li>
						<li class="list-group-item no-radius">
							<h2 class="sf-add-text" data-size="24" data-color="#2222DD"><a class="sf-color-black" href="#">Votre texte</a></h2>
						</li>
						<li class="list-group-item no-radius">
							<h3 class="sf-add-text" data-size="21" data-color="#DD2222"><a class="sf-color-black" href="#">Votre texte</a></h3>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="sf-editeur-menu-droite-enfant" id="sf-zone-texte">
		<div class="card no-border-top no-border-left no-border-right">
			<div class="card-header no-radius bg-white sf-zone-txt">
				<h5 class="mb-0 text-uppercase">Zone de texte <i class="fa fa-times-circle pull-right sf-cursor sf-bloc-remove"></i></h5>
			</div>
			<div class="card-body no-padding sf-zone-txt">
				<ul class="list-group">
					<li class="list-group-item no-border bg-gris">
						Police
						<select class="m-t-5 form-control" id="sf-font-family">
							<option style="font-family: 'Oswold';-moz-font-family:'Oswold';" value="Oswold">Oswold</option>
							<option style="font-family: 'Indie Flower';" value="Indie Flower">Indie Flower</option>
							<option style="font-family: 'Gayathri';" value="Gayathri">Gayathri</option>
							<option style="font-family: 'Playfair Display';" value="Playfair Display">Playfair Display</option>
							<option style="font-family: 'Anton';" value="Anton">Anton</option>
							<option style="font-family: 'Lobster';" value="Lobster">Lobster</option>
							<option style="font-family: 'Pacifico';" value="Pacifico">Pacifico</option>
							<option style="font-family: 'Dancing Script';" value="Dancing Script">Dancing Script</option>
							<option style="font-family: 'Shadows Into Light';" value="Shadows Into Light">Shadows Into Light</option>
							<option style="font-family: 'Amatic SC';" value="Amatic SC">Amatic SC</option>
							<option style="font-family: 'Modak';" value="Modak">Modak</option>
							<option style="font-family: 'Permanent Marker';" value="Permanent Marker">Permanent Marker</option>
							<option style="font-family: 'Caveat';" value="Caveat">Caveat</option>
							<option style="font-family: 'Great Vibes';" value="Great Vibes">Great Vibes</option>
							<option style="font-family: 'Cookie';" value="Cookie">Cookie</option>
							<option style="font-family: 'Gloria Hallelujah';" value="Gloria Hallelujah">Gloria Hallelujah</option>
							<option style="font-family: 'Sacramento';" value="Sacramento">Sacramento</option>
							<option style="font-family: 'Bangers';" value="Bangers">Bangers</option>
							<option style="font-family: 'Handlee';" value="Handlee">Handlee</option>
							<option style="font-family: 'Schoolbell';" value="Schoolbell">Schoolbell</option>
							<option style="font-family: 'Architects Daughter';" value="Architects Daughter">Architects Daughter</option>
						</select>
					</li>
					<li class="list-group-item no-border bg-gris">
						Taille
						<input type="number" class="form-control m-t-5" value="16" id="sf-font-size">
					</li>
					<li class="list-group-item no-border bg-gris">
						Style
						<div class="m-t-5">
							<i class="sf-cursor fa fa-bold m-r-15 sf-font-style" data-active="false" data-style="bold" data-toggle="tooltip" title="Gras" data-placement="bottom"></i>
							<i class="sf-cursor fa fa-italic m-r-15 sf-font-style" data-active="false" data-style="italic" data-toggle="tooltip" title="Italique" data-placement="bottom"></i>
							<i class="sf-cursor fa fa-font sf-font-style" data-active="false" data-style="normal" data-toggle="tooltip" title="Normal" data-placement="bottom"></i>
						</div>
					</li>
					<li class="list-group-item no-border bg-gris">
						Couleur
						<input type="text" class="form-control colorpicker2 m-t-5" id="sf-font-color" value="">
					</li>
					<li class="list-group-item no-border bg-gris">
						Alignement
						<div class="m-t-5">
							<i class="sf-cursor fa fa-align-left m-r-15 sf-font-alignement sf-font-alignement-left" data-pos="left" data-toggle="tooltip" title="Alignement gauche" data-placement="bottom"></i>
							<i class="sf-cursor fa fa-align-center m-r-15 sf-font-alignement sf-font-alignement-center" data-pos="center" data-toggle="tooltip" title="Centré" data-placement="bottom"></i>
							<i class="sf-cursor fa fa-align-right m-r-15 sf-font-alignement sf-font-alignement-right" data-pos="right" data-toggle="tooltip" title="Alignement droite" data-placement="bottom"></i>
							<i class="sf-cursor fa fa-align-justify sf-font-alignement sf-font-alignement-justify" data-pos="justify" data-toggle="tooltip" title="Justifié" data-placement="bottom"></i>
						</div>
					</li>
				</ul>
			</div>
			<div class="card-header no-radius bg-white">
				<h5 class="mb-0 text-uppercase">Visibilité <i class="fa fa-times-circle pull-right sf-cursor sf-bloc-remove"></i></h5>
			</div>
			<div class="card-body no-padding">
				<ul class="list-group">
					<li class="list-group-item no-border bg-gris">
						Opacité
						<div class="m-t-5">
							<input id="sf-object-opacity">
						</div>
					</li>
				</ul>
			</div>
			<div class="card-header no-radius bg-white">
				<h5 class="mb-0 text-uppercase">Disposition</h5>
			</div>
			<div class="card-body no-padding">
				<ul class="list-group">
					<li class="list-group-item no-border bg-gris">
						Disposition de l'objet
						<div class="m-t-5">
							<div class="sf-object-disposition form-inline">
								<img src="/img/confbornes/editeurs/icons/premier-plan.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-position" data-pos="0" data-toggle="tooltip" title="Premier plan" data-placement="bottom">
								<img src="/img/confbornes/editeurs/icons/avancer.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-position" data-pos="1" data-toggle="tooltip" title="En avant" data-placement="bottom">
								<img src="/img/confbornes/editeurs/icons/reculer.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-position" data-pos="2" data-toggle="tooltip" title="En arrière" data-placement="bottom">
								<img src="/img/confbornes/editeurs/icons/arriere-plan.png" class="sf-cursor sf-opacity-60 sf-object-position" data-pos="3" data-toggle="tooltip" title="Arrière plan" data-placement="bottom">
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="card-header no-radius bg-white">
				<h5 class="mb-0 text-uppercase">Format</h5>
			</div>
			<div class="card-body no-padding">
				<ul class="list-group">
					<li class="list-group-item no-border bg-gris">
						<div class="m-t-5 row">
							<div class="col-sm-6">
								<label class="control-label">Largeur</label>
								<input type="number" value="" data-tp="w" data-val="" class="form-control sf-object-format" id="sf-object-format-w">
							</div>
							<div class="col-sm-6">
								<label class="control-label">Hauteur</label>
								<input type="number" value="254" data-tp="h" data-val="" class="form-control sf-object-format" id="sf-object-format-h">
							</div>
						</div>
					</li>
					<li class="list-group-item no-border bg-gris">
						<div class="m-t-5 row">
							<div class="col-sm-6">
								<label class="control-label">PosX</label>
								<input type="number" value="254" data-tp="x" data-val="" class="form-control sf-object-format" id="sf-object-format-x">
							</div>
							<div class="col-sm-6">
								<label class="control-label">PosY</label>
								<input type="number" value="254" data-tp="y" data-val="" class="form-control sf-object-format" id="sf-object-format-y">
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="card-header no-radius bg-white">
				<h5 class="mb-0 text-uppercase">Transformation</h5>
			</div>
			<div class="card-body no-padding">
				<ul class="list-group">
					<li class="list-group-item no-border bg-gris">
						<!--Transformation de l'objet
						<div class="m-t-5">
							<div class="sf-object-transformation form-inline">
								<img src="/img/confbornes/editeurs/icons/flip-x.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-transformation">
								<img src="/img/confbornes/editeurs/icons/flip-x-1.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-transformation">
								<img src="/img/confbornes/editeurs/icons/flip-y.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-transformation">
								<img src="/img/confbornes/editeurs/icons/flip-y-1.png" class="sf-cursor m-r-20 sf-opacity-60 sf-object-transformation">
							</div>
						</div-->
						<div class="m-t-5 row">
							<div class="col-sm-6">
								<label class="control-label">Horizontal</label>
								<div class="onoffswitch">
									<input type="checkbox" class="onoffswitch-checkbox sf-object-flip" data-tp="x" id="flipX">
									<label class="onoffswitch-label flipX" for="flipX">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="control-label">Vertical</label>
								<div class="onoffswitch">
									<input type="checkbox" class="onoffswitch-checkbox sf-object-flip" data-tp="y" id="flipY">
									<label class="onoffswitch-label flipY" for="flipY">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="card-header no-radius bg-white sf-img-option">
				<h5 class="mb-0 text-uppercase">Teinte/Saturation</h5>
			</div>
			<div class="card-body no-padding sf-img-option">
				<ul class="list-group">
					<li class="list-group-item no-border bg-gris">
						Rouge
						<div class="m-t-5">
							<input class="sf-object-gamma" name="r" id="sf-object-gamma-rouge">
						</div>
					</li>
					<li class="list-group-item no-border bg-gris">
						Vert
						<div class="m-t-5">
							<input class="sf-object-gamma" name="v" id="sf-object-gamma-vert">
						</div>
					</li>
					<li class="list-group-item no-border bg-gris">
						Bleu
						<div class="m-t-5">
							<input class="sf-object-gamma" name="b" id="sf-object-gamma-bleu">
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>