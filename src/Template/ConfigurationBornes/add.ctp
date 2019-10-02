<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>
<!-- Color Picker Plugin JavaScript -->

<?= $this->Html->script('wizard/jquery.steps.min', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.validate.min', ['block' => true]); ?>
<?= $this->Html->script('wizard/messages_fr', ['block' => true]); ?>

<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?= $this->Html->css('photos/popup_photo.css?v1_190213') ?>

<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>

<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>

<?= $this->Html->css('ConfigBornes/config_anim.css', ['block' => true]) ?>
<?= $this->Html->css('ConfigBornes/step.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/step.js?'.time(), ['block' => true]); ?>
<?= $this->Html->script('ConfigBornes/add.js?'.time(), ['block' => true]); ?>
<?= $this->Html->script('ConfigurationBornes/add_champ.js?'.time(), ['block' => true]); ?>


<?= $this->Html->css('configuration-bornes/add.css?'.time(), ['block' => true]) ?>
<?= $this->Html->css('configuration-bornes/custom-mob.css?'.time(), ['block' => true]) ?>
<?= $this->Html->script('ConfigurationBornes/add-1.js?'.time(), ['block' => true]) ?>


<?= $this->Html->css('ConfigBornes/zebra_tooltips.min.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/zebra_tooltips.min.js?'.time(), ['block' => true]) ?>

<?= $this->Html->css('ConfigBornes/tippy.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/tippy.js?'.time(), ['block' => true]); ?>
<?= $this->Html->css('ConfigBornes/microtip.min.css', ['block' => true]) ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-body p-30">
			<h4 class="card-title m-b-20">Paramétrage borne</h4>
			<div class="sf-border-hr"></div>
			
			<?php echo $this->Form->create('configurationBorne', ['id' => 'configuration_bornes_form_id', 'type' => 'file']); ?>
                <?= $this->Form->control('evenement_id',['value'=>$evenement->id,'type'=>'hidden']) ?>
                <input type="hidden" name="is_edit" id="id_isEdit" value="<?= !empty($configurationBorne->id) ? 1:0 ?>" />
			
				<?php // Choix step 1 ?>
				<h6>ANIMATION(S)</h6>
				<section>
					<?php echo $this->element('ConfigBornes/etape_choix_type_mep') ;?>	
				</section>
				
				<?php // Choix visuel parmis les catalogues ?>				
				<h6>CONFIGURATION ANIMATION(S)</h6>
				<section>
					<!--Mon catalogue-->					
					<?php echo $this->element('ConfigBornes/catalogue_cadre') ;?>
					<?php // Choix de une ou plusieurs animations ?>
					<?php echo $this->element('ConfigBornes/etape_choix_animation') ;?>				
				</section>

				<?php // Choix cadre : Célestin ?>
				<h6>OPTIONS</h6>
				<section>
					<?php echo $this->element('ConfigBornes/etape_options_cadre') ;?>
				</section>	

				<?php // Option d'événement bloc_option_fond_vert ?>
				<h6>Option d'événement</h6>
				<section>				
					<?php echo $this->element('ConfigBornes/etape_option_evenement') ;?>
				</section>			
				
				<?php // Prise de coordonnées ?>
				<h6>PRISE DE COORDONNÉES</h6>
				<section>
					<?php echo $this->element('ConfigBornes/etape_prise_coordonnees') ;?>
				</section>

				<?php // Impression ?>
				<h6>IMPRESSION</h6>
				<section>	
					<?php echo $this->element('ConfigBornes/etape_impression') ;?>	
				</section>

				<?php // Parametrage borne  ?>
				<?php // Ecrans navigation ?>
				<h6>ÉCRANS NAVIGATIONS</h6>
				<section>
					<?php echo $this->element('ConfigBornes/etape_ecran_navigation') ;?>										
				</section>
				<?php // Enregistrement ?>
				<h6>ENREGISTREMENT</h6>
				<section>
					<div class="sf-step" style="padding: 0px 0px 50px 13px;">
					<h5 class="m-t-30" style="margin-right: 20px;"><span class='cf_progress_text_0'>Enregistrement ...</span><span class="pull-right cf_progress_text">0 %</span></h5>
						<div class="progress m-t-10"  style="width: 98%;">
							<!--<div class="progress-bar bg-base cf_progress_sauve " style="width: 0.1%; height:14px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>-->
							<div class="progress-bar wow animated progress-animated bg-base cf_progress_sauve " style="width: 0.1%; height:14px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
						</div>
						<div class="bloc_etape_sauve m-t-30">
							<ul class="">
								<li><span class="etape_sauve_conf_1"><i class="fa fa-spin fa-spinner hide"></i> <i class="fa fa-check hide"></i> <small>  Enregistrement de la configuration</small></span></li>
								<li><span class="etape_sauve_conf_2"><i class="fa fa-spin fa-spinner hide"></i><i class="fa fa-check hide"></i> <small>  Envoi des images de mise en page</small></span></li>
								<li><span class="etape_sauve_conf_3"><i class="fa fa-spin fa-spinner hide"></i><i class="fa fa-check hide"></i> <small>  Préparation des fichiers de configuration</small></span></li>
							</ul>
						</div>
					</div>
				</section>
				
				<?php // CHoix borne ?>
				<input type="hidden" value="borne-spherik" id="sf-type-borne">
			<?php echo $this -> Form -> end(); ?>
			
		</div>
	</div>
</div>
<?php echo $this->element('ConfigurationBornes/add_champ',['typeChamps' => $typeChamps,'typeDonnees' => $typeDonnees,'typeOptins'=>$typeOptins]) ?>