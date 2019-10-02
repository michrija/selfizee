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
<?= $this->Html->script('ConfigBornes/configuration.js?'.time(), ['block' => true]) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-new-selfizee">
            <div class="card-body no-padding">
                    <div class="card tab_steps">
                        <div class="col-md-12  ">
                            <div class="row">
                                <div class="col-md-2 p-t-5 label_titre">
                                    <label class="card-title config_label_titre">CONFIGURATEUR</label>
                                </div>
                                <div class="col-md-8 no-padding-left no-padding-right">
                                    <ul class="nav nav-tabs customtab tab_step_list" role="tablist">
                                        <li class="nav-item"> <a class="nav-link  active show" data-toggle="tab" href="#etape_choix_mep" role="tab" aria-selected="false">  <span class="hidden-xs-down">ANIMATIONS</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_choix_anim" role="tab" aria-selected="true"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">CONFIGURATIONS ANIMATIONS</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_option_cadre" role="tab" aria-selected="false"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">OPTIONS</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_option_event" role="tab" aria-selected="false"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">OPTION D'EVENEMENT</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_collecte" role="tab" aria-selected="false"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">COLLECTE</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_partage" role="tab" aria-selected="false"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">PARTAGE</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_impression" role="tab" aria-selected="false"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">IMPRESSION</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#etape_ecran_navigation" role="tab" aria-selected="false"> <i class="mdi mdi-chevron-right fa-lg"></i> <span class="hidden-xs-down">ECRAN NAVIGATIONS</span></a> </li>
                                    </ul>
                                </div>
                                <div class="col-sm-2 p-t-10 no-padding-right config_btn">
                                    <button type="button" class="btn btn-success nextPrev" id="prevBtn" data-owner="-1" ><i class="mdi mdi-chevron-left fa-lg"></i></button>
                                    <button type="button" class="btn btn-success nextPrev" id="nextBtn" data-owner="1" ><i class="mdi mdi-chevron-right fa-lg"></i></button>
                                    <button type="button" class="btn btn-inverse  p-l-30 p-r-30" id="">Quitter</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-t-0 sous_header m-t-20 p-t-40"> </div>
                        <!-- Tab panes -->
                        <div class="tab-content tab_step_content no-padding">
                            <div class="tab-pane active show " id="etape_choix_mep" role="tabpanel">                               
					            <form>
                                    <?php echo $this->element('ConfigBornes/etape_choix_type_mep') ;?>
                                </form>
                            </div>
                            <div class="tab-pane" id="etape_choix_anim" role="tabpanel">
                                <form>
                                    <!--Mon catalogue-->					
                                    <?php echo $this->element('ConfigBornes/catalogue_cadre') ;?>
                                    <?php // Choix de une ou plusieurs animations ?>
                                    <?php echo $this->element('ConfigBornes/etape_choix_animation') ;?>	
                                </form>
                            </div> 
                            <div class="tab-pane" id="etape_option_cadre" role="tabpanel"> 
                                <form>                               
					                <?php echo $this->element('ConfigBornes/etape_options_cadre') ;?>
                                </form>
                            </div> 
                            <div class="tab-pane" id="etape_option_event" role="tabpanel">
                                <form>
					                <?php echo $this->element('ConfigBornes/etape_option_evenement') ;?>
                                </form>
                            </div> 
                            <div class="tab-pane" id="etape_collecte" role="tabpanel">
                                <form>
					                <?php echo $this->element('ConfigBornes/etape_prise_coordonnees') ;?>
                                </form>
                            </div> 
                            <div class="tab-pane" id="etape_partage" role="tabpanel">
                                <form>                                
					                <?php //echo $this->element('ConfigBornes/etape_partage') ;?>
                                </form>
                            </div>  
                            <div class="tab-pane" id="etape_impression" role="tabpanel">
                                <form>                                
					                <?php echo $this->element('ConfigBornes/etape_impression') ;?>
                                </form>
                            </div>    
                            <div class="tab-pane" id="etape_ecran_navigation" role="tabpanel">
                                <form>
					                <?php echo $this->element('ConfigBornes/etape_ecran_navigation') ;?>
                                </form>
                            </div>

                            <?php // btn sauve etape?>
                            <div class="col-sm-12  p-l-30">
                                <button type="button" class="btn btn-success p-l-30 p-r-30 m-r-10 saveStep" id="btnSave" data-owner=""> <i class="fa fa-spin fa-spinner fa-lg hide"></i> Enregistrer</button>
                                <button type="button" class="btn btn-inverse p-l-30 p-r-30 saveStep" id="btnSaveAndNext" data-owner=""><i class="fa fa-spin fa-spinner fa-lg hide"></i> Enregistrer et continuer  <i class="mdi mdi-chevron-right"></i></button>
                            </div>                              
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php echo $this->element('ConfigurationBornes/add_champ',['typeChamps' => $typeChamps,'typeDonnees' => $typeDonnees,'typeOptins'=>$typeOptins]) ?>