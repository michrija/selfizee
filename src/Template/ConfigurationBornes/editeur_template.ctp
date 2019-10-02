<?php use Cake\Routing\Router; ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>

<!-- selectpicker -->
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>

<!--Range slider CSS -->
<?= $this->Html->css('/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css') ?>
<?= $this->Html->css('/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css') ?>
<?= $this->Html->script('/assets/plugins/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js', ['block' => true]); ?>
<?= $this->Html->script('/assets/plugins/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider-init.js', ['block' => true]); ?>

<!-- Nestable -->
<?= $this->Html->css('/assets/plugins/nestable/nestable.css') ?>
<?= $this->Html->script('/assets/plugins/nestable/jquery.nestable.js', ['block' => true]); ?>

<!-- select2 -->
<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?php // Plugins ?>
<?= $this->Html->script('fabric/fabric.min', ['block' => true]); ?>

<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>      

<?php echo $this->Html->script('jquery.backDetect/jquery.backDetect', ['block' => true]); ?>

<?php // Declaration css / js ?>
<?= $this->Html->css('configuration-bornes/editeur_template.css?'.time(), ['block' => true]) ?>
<?= $this->Html->script('ConfigurationBornes/editeur_template.js?'.time(), ['block' => true]); ?>

<?php // Chargement des fonts ?>
<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Anton|Architects+Daughter|Bangers|Caveat|Cookie|Dancing+Script|Gayathri|Gloria+Hallelujah|Great+Vibes|Handlee|Indie+Flower|Kaushan+Script|Lobster|Modak|Oswald|Pacifico|Permanent+Marker|Playfair+Display|Sacramento|Schoolbell|Shadows+Into+Light&display=swap" rel="stylesheet"> 


<div id="sf-editeur-loading" class="hide text-center"><img src="/img/confbornes/editeurs/icons/loading.svg" style="height: 100%;width:auto;"></div>
<div id='customBox' class="hide" style='position: absolute; top: 10; left: -50'>
	<div class="arrow_box">
		<a class="button alert tiny no-margin" href="#" id="duplique_layers" data-toggle="tooltip" title="Dupliquer ce calque" data-placement="bottom"><i class="fa fa-files-o"></i></a>|
		<a class="button alert tiny no-margin" href="#" id="remove_layers" data-toggle="tooltip" title="Supprimer ce calque" data-placement="bottom"><i class="fa fa-trash"></i></a>|
		<a class="button alert tiny no-margin" href="#" id="lock_layers" data-toggle="tooltip" title="Vérouiller ce calque" data-placement="bottom"><i class="fa fa-lock"></i></a>
		<!--a class="button alert tiny no-margin" href="#" id="lock_layers"><i class="fa fa-unlock-alt"></i></a-->
		<!--a class="button alert tiny no-margin" href="#" id="lock_layers"><i class="fa fa-unlock"></i></a-->
	</div>
</div>
<div class="sf-loading-spinner hide"></div>
<div class="sf-enregistrement-auto">
	<div class="text-secondary"><small>Enregistrement automatique</small><img src="/img/confbornes/editeurs/icons/loader.gif"></div>
	<div id="sf-enregistrement-auto-progress"></div>
</div>

<input type="hidden" id="baseUrl" value="<?php echo $domaine; ?>">
<input type="hidden" id="idEvenement" value="<?php echo $idEvenement; ?>">
<div class="row p-t-40">
	<?php echo $this -> element('ConfigurationBornes/editeur_menu_gauche'); ?>
	<div class="col-xl-9 col-lg-8">
		<canvas class="sf-bg-template" id="template" height="600"></canvas>
		<div id="canvas-copie"><canvas class="sf-bg-template" id="templatePNG" height="600"></canvas></div>
		<div id="sf-editeur-canvas-loading" class="hide">
			<img src="/img/confbornes/editeurs/icons/loading.svg">
		</div>
	</div>	
	<?php echo $this -> element('ConfigurationBornes/editeur_menu_droite'); ?>
	<div id="sf-object" class="hide">
		<table class="table color-table dark-table">
			<thead>
				<tr>
					<th>
						<span>Calques d'objets</span>
						<a class="sf-menu active pull-right">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php echo '<span id="sf-calcque-vide">Aucun calque de travail</span>' ?>
						<div class="myadmin-dd dd" id="nestable">
							<ol id="sf-object-element" class="dd-list list-group">
								
							</ol>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="sf-image"></div>
<script type="text/javascript">
	var json_editeur = <?php echo json_encode(!empty($evenement->evenement_crea) ? $evenement->evenement_crea->canvas_elements : false); ?>;
</script>