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
<?= $this->Html->script('ConfigBornes/step.js?'.time(), ['block' => true]); ?>
<?= $this->Html->script('ConfigBornes/step-1.js?'.time(), ['block' => true]); ?>
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

<?= $this->Html->css('Configurations/partage.css?'.time(), ['block' => true]); ?>
<?= $this->Html->css('ConfigBornes/step.css?'.time(), ['block' => true]); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="card card-new-selfizee">
            <div class="card-body no-padding">
                <div class="col-md-12 config_header">
                    <div class="row">
                        <div class="col-md-2 p-t-5">
                            <label class="card-title config_label_titre"  style="font-weight: 600 !important;">CONFIGURATEUR</label>
                        </div>
                        <div class="col-md-8 config_step">
                            <div class="steps clearfix" style="line-height: 2.5;"><ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="configuration_bornes_form_id-t-0" href="#configuration_bornes_form_id-h-0" aria-controls="configuration_bornes_form_id-p-0"><span class="current-info audible">current step: </span><span class="step">1</span> ANIMATION(S)</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-1" href="#configuration_bornes_form_id-h-1" aria-controls="configuration_bornes_form_id-p-1"><span class="step">2</span> CONFIGURATION ANIMATION(S)</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-2" href="#configuration_bornes_form_id-h-2" aria-controls="configuration_bornes_form_id-p-2"><span class="step">3</span> OPTIONS</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-4" href="#configuration_bornes_form_id-h-4" aria-controls="configuration_bornes_form_id-p-4"><span class="step">5</span> PRISE DE COORDONNÉES</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-5" href="#configuration_bornes_form_id-h-5" aria-controls="configuration_bornes_form_id-p-5"><span class="step">6</span> IMPRESSION</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="configuration_bornes_form_id-t-7" href="#configuration_bornes_form_id-h-7" aria-controls="configuration_bornes_form_id-p-7"><span class="step">8</span> ENREGISTREMENT</a></li></ul></div>
                        </div>
                        <div class="col-sm-2 p-t-10 no-padding-left no-padding-right config_btn">
                                <button type="button" class="btn btn-success " id="" style=""><i class="mdi mdi-chevron-left fa-lg"></i></button>
                                <button type="button" class="btn btn-success" id=""><i class="mdi mdi-chevron-right fa-lg"></i></button>
                                <button type="button" class="btn btn-inverse  p-l-30 p-r-30" id="">Quitter</button>
                                
                        </div>
                    </div>
                </div>
                <div class="col-md-12 m-t-0 sous_header"> </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
<div class="col-lg-12">
    <div class="card card-new-selfizee">
        <div class="card-header border-bottom hide">            
        </div>
        <div class="card-body">
            <div class="col-md-12 config_header">
                <div class="row">
                    <div class="col-md-2 p-t-5">
                        <label class="card-title config_label_titre"  style="font-weight: 600 !important;">CONFIGURATEUR</label>
                    </div>
                    <div class="col-md-8 config_step">
                        <?php echo $this->Form->create('configurationBorne', ['id' => 'configurateur_id', 'type' => 'file']); ?>
                            <?= $this->Form->control('evenement_id',['value'=>$evenement->id,'type'=>'hidden']) ?>
                            <input type="hidden" name="is_edit" id="id_isEdit" value="<?= !empty($configurationBorne->id) ? 1:0 ?>" />
                            <!--<div class="col-md-12 config_header_2">
                            <div class="row">
                            </div>-->

                            <h6>ANIMATION(S)</h6>                            
                            <section>
                                <div class="sf-step sf-step1 p-l-15 p-r-15">
                                    <div class="col-sm-12 m-b-15">
                                        <h5>Comment souhaitez-vous gérer la mise en page de votre cadre :</h5>
                                    </div>
                                        <ul class="sf-list-pers">
                                            <li class="p-30 p-l-50">
                                                <label class="custom-control custom-radio no-margin" for="mep_cadre_catalogue">
                                                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_catalogue" value="1" class="custom-control-input" <?php  echo $configurationBorne->type_mise_en_page_id == 1 ? 'checked="checked"' : '';?>>
                                                    <span class="custom-control-label m-l-20">Choisir et personnaliser un visuel choisi dans le catalogue</span>
                                                </label>
                                            </li> 
                                            <li class="p-30 p-l-50">
                                                <label class="custom-control custom-radio no-margin" for="mep_cadre_1">
                                                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_1" value="2" class="custom-control-input" <?php echo $configurationBorne->type_mise_en_page_id == 2 ? 'checked="checked"' : '';?>>
                                                    <span class="custom-control-label m-l-20">Importer ma propre mise en page</span>
                                                </label>
                                            </li>
                                            <li class="p-30 p-l-50 hide">
                                                <label class="custom-control custom-radio no-margin" for="mep_cadre_2">
                                                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_2" value="3" class="custom-control-input" <?php  echo $configurationBorne->type_mise_en_page_id == 3 ? 'checked="checked"' : '';?>>
                                                    <span class="custom-control-label m-l-20">Créer ma mise en page en ligne depuis une base vierge</span>
                                                </label>
                                            </li>
                                            <li class="p-30 p-l-50">
                                                <label class="custom-control custom-radio no-margin" for="mep_cadre_3">
                                                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_3" value="4" class="custom-control-input" <?php  echo $configurationBorne->type_mise_en_page_id == 4 ? 'checked="checked"' : '';?>>
                                                    <span class="custom-control-label m-l-20">Pas besoin de mise en page, prendre une photo sans personnalisation graphique</span>
                                                </label>
                                            </li>
                                        </ul>
                                    <!--</div> -->
                                    
                                    
                                    <div class="col-sm-12 float-right">
                                        <?php
                                            /*echo $this -> Form -> submit(
                                                'Continuer',
                                                [
                                                    'class' => 'btn btn-success float-right sf-btn-pers'
                                                ]
                                            );*/
                                        ?>
                                    </div>
                                </div>
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
			            <?php echo $this -> Form -> end(); ?>
                    </div>
                    <div class="col-sm-2 p-t-10 no-padding-left no-padding-right config_btn">
                            <button type="button" class="btn btn-success " id="" style=""><i class="mdi mdi-chevron-left fa-lg"></i></button>
                            <button type="button" class="btn btn-success" id=""><i class="mdi mdi-chevron-right fa-lg"></i></button>
                            <button type="button" class="btn btn-inverse  p-l-30 p-r-30" id="">Quitter</button>
                            <ul role="menu" aria-label="Pagination">
    <li class="" aria-disabled="false"><a href="#previous" role="menuitem">Previous</a></li>
    <li aria-hidden="true" aria-disabled="true" class="disabled" style="display: none;"><a href="#next" role="menuitem">Next</a></li>
    <li aria-hidden="false" style=""><a href="#finish" role="menuitem">Finish</a></li>
</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>