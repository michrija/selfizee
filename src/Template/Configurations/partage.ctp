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
                    <div class="card tab_steps">
                        <div class="col-md-12  ">
                            <div class="row">
                                <div class="col-md-2 p-t-5">
                                    <label class="card-title config_label_titre" style="font-weight: 600 !important;">CONFIGURATEUR</label>
                                </div>
                                <div class="col-md-8">
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
                                <div class="col-sm-2 p-t-10 no-padding-left no-padding-right config_btn">
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
</div>

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
                <ul class="step_partage">
                    <li>Choix des pargtages</li>
                    <li>Configuration specifiques</li>
                    <li>Options avancés</li>
                </ul>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                            <div class="card">
                                
                                <div class="col-md-12 config_header">
                                    <div class="row">
                                        <div class="col-md-2 p-t-10">
                                            <label class="card-title config_label_titre">CONFIGURATEUR</label>
                                        </div>
                                        <div class="col-md-8 config_step">
                                            <div class="steps clearfix" style="line-height: 3;"><ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="configuration_bornes_form_id-t-0" href="#configuration_bornes_form_id-h-0" aria-controls="configuration_bornes_form_id-p-0"><span class="current-info audible">current step: </span><span class="step">1</span> ANIMATION(S)</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-1" href="#configuration_bornes_form_id-h-1" aria-controls="configuration_bornes_form_id-p-1"><span class="step">2</span> CONFIGURATION ANIMATION(S)</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-2" href="#configuration_bornes_form_id-h-2" aria-controls="configuration_bornes_form_id-p-2"><span class="step">3</span> OPTIONS</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-4" href="#configuration_bornes_form_id-h-4" aria-controls="configuration_bornes_form_id-p-4"><span class="step">5</span> PRISE DE COORDONNÉES</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="configuration_bornes_form_id-t-5" href="#configuration_bornes_form_id-h-5" aria-controls="configuration_bornes_form_id-p-5"><span class="step">6</span> IMPRESSION</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="configuration_bornes_form_id-t-7" href="#configuration_bornes_form_id-h-7" aria-controls="configuration_bornes_form_id-p-7"><span class="step">8</span> ENREGISTREMENT</a></li></ul>
                                            </div>
                                        </div>
                                            <div class="col-sm-2 p-t-10 no-padding-left no-padding-right config_btn">
                                                    <button type="button" class="btn btn-success " id="" style=""><i class="mdi mdi-chevron-left fa-lg"></i></button>
                                                    <button type="button" class="btn btn-success" id=""><i class="mdi mdi-chevron-right fa-lg"></i></button>
                                                    <button type="button" class="btn btn-inverse  p-l-30 p-r-30" id="">Quitter</button>
                                            </div>
                                    </div>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#choix_partage_1" role="tab" aria-selected="true">
                                        <span class="num_step_partage">1</span>
                                        <span class="hidden-xs-down">Choix des partages</span></a> 
                                    </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#config_specifique_1" role="tab" aria-selected="false">
                                        <span class="num_step_partage">2</span>
                                        <span class="hidden-xs-down">Configuration specifiques</span></a> 
                                    </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#options_avancees_1" role="tab" aria-selected="false">
                                        <span class="num_step_partage">3</span>
                                        <span class="hidden-xs-down">Options avancés</span></a> 
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Choix partage contenu-->
                                    <div class="tab-pane p-20 active show" id="choix_partage_1" role="tabpanel">
                                        <div class="part_step_1 m-t-40 no-padding-left">
                                            <div class="col-sm-12 m-b-40"><h5>Comment souhaitez-vous partager les photos ?</h5></div>
                                            <div class="col-sm-12 list_choix_part p-l-40  m-b-70">
                                                    <label class="custom-control custom-checkbox m-r-5" for="partage_email">
                                                        <input type="checkbox" name="" value="1" class="custom-control-input partage" id="partage_email">
                                                        <span class="custom-control-label">Partage par E-mail</span>
                                                    </label>
                                                    <hr>
                                                    <label class="custom-control custom-checkbox m-r-20" for="partage_sms">
                                                        <input type="checkbox" name="" value="2" class="custom-control-input partage" id="partage_sms">
                                                        <span class="custom-control-label">Envoi par SMS</span>
                                                    </label>
                                                    <hr>
                                                    <label class="custom-control custom-checkbox m-r-20" for="partage_fb">
                                                        <input type="checkbox" name="" value="3" class="custom-control-input partage" id="partage_fb">
                                                        <span class="custom-control-label">Publication automatique sur Facebook</span>
                                                    </label>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="button" class="btn btn-success p-l-30 p-r-30 m-r-10" id="">Enregistrer</button>
                                                <button type="button" class="btn btn-inverse p-l-30 p-r-30" id="">Enregistrer et continuer  <i class="mdi mdi-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Config specifiques contenu UI tab2-->
                                    <div class="tab-pane p-20" id="config_specifique_1" role="tabpanel">
                                        <div class="vtabs customvtab part_step_2">
                                            <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#email_2" role="tab" aria-selected="true"> <span class="hidden-xs-down">E-MAIL</span> <i class="mdi mdi-chevron-right pull-right"></i> </a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sms_2" role="tab" aria-selected="false"> <span class="hidden-xs-down">SMS</span> <i class="mdi mdi-chevron-right pull-right"></i> </a> </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content no-padding-top">
                                                <div class="tab-pane  no-padding-top active show" id="email_2" role="tabpanel">
                                                <div class="step_email  no-padding">
                                                            <div class="col-sm-12 no-padding-left email_titre m-b-20">
                                                                <h4 class="card-title">Email</h4>
                                                                <h6 class="card-subtitle">Contenu de l'email</h6>
                                                            </div>
                                                            <div class="col-sm-12 no-padding-left email_contenu">
                                                                <!-- UItab3 -->
                                                                <div class="card">
                                                                    <ul class="nav nav-tabs customtab" role="tablist">
                                                                        <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#version_simple_3" role="tab" aria-selected="true"> <i class="mdi mdi-disk pull-left"></i> <span class="hidden-xs-down">Version simplifié</span></a> </li>
                                                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#version_avancee_3" role="tab" aria-selected="false"> <i class="mdi mdi-disk pull-left"></i> <span class="hidden-xs-down">Version avancée</span></a> </li>
                                                                    </ul>
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-content no-padding">
                                                                        <div class="tab-pane active show no-padding-left" id="version_simple_3" role="tabpanel">
                                                                            <div class="no-padding m-b-50 m-t-20">
                                                                                <div class="form-body">
                                                                                        <div class="row">          
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                    <label for="id_expedtieurList" class="control-label">E-mail de l'expéditeur </label><select name="email_expediteur" id="id_expedtieurList" class="custom-select">
                                                                                                    <option value="">Séléctionner</option>
                                                                                                    <option value="createnew">Nouvelle adresse</option></select> <span class="help-block"><small></small></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group"><label for="nom-expediteur" class="control-label">Nom de l'expéditeur  </label>
                                                                                                    <input type="text" name="nom_expediteur" maxlength="250" id="nom-expediteur" value="" class="form-control"> 
                                                                                                    <span class="help-block"><small></small></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group"><label for="objet" class="control-label">Objet del'email </label>
                                                                                                    <input type="text" name="objet" required="required" id="objet" value="" class="form-control"> 
                                                                                                    <span class="help-block"><small></small></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div id="img_name_content"></div>
                                                                                                <div class="form-group m-b-0"><label for="content" class="control-label">Contenu de l'email</label>
                                                                                                    <textarea name="content" class="form-control textarea_editor" rows="5" required="required" maxlength="100000" id="content"></textarea>
                                                                                                </div>                            
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 no-padding">
                                                                                <button type="button" class="btn btn-success p-l-30 p-r-30 m-r-10" id="">Enregistrer</button>
                                                                                <button type="button" class="btn btn-inverse p-l-30 p-r-30" id="">Enregistrer et continuer  <i class="mdi mdi-chevron-right"></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane p-20" id="version_avancee_3" role="tabpanel">2</div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-md-3 no-padding">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Daily Sales</h4>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                </div>
                                                <div class="tab-pane p-20 step_sms" id="sms_2" role="tabpanel">2</div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Option avancées contenu-->
                                    <div class="tab-pane p-20" id="options_avancees_1" role="tabpanel">
                                        <div class="vtabs customvtab options_avancees">
                                            <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#affichage_et_collecte" role="tab"><span class="hidden-xs-down">AFFICHAGE ET COLLECTE</span> <i class="mdi mdi-chevron-right pull-right"></i> </a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#page_souvenir" role="tab"><span class="hidden-xs-down">PAGE SOUVENIR</span> <i class="mdi mdi-chevron-right pull-right"></i> </a> </li>
                                                
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content no-padding">
                                                <div class="tab-pane active" id="affichage_et_collecte" role="tabpanel">
                                                        <div class="option_avancees_1 no-padding-left">
                                                                <div class="col-sm-12 m-b-20"><h5>Comment souhaitez-vous faire apparaitre vos partages email et sms  ?</h5></div>
                                                                <div class="col-sm-12 list_choix_affichage_part p-l-15  m-b-30">
                                                                    <label class="custom-control custom-checkbox m-r-5" for="activer_btn_part">
                                                                        <input type="checkbox" name="" value="1" class="custom-control-input option_av" id="activer_btn_part">
                                                                        <span class="custom-control-label">Activer les bouttons de partage e-mail et sms sur l'ecran d'impresssion</span>
                                                                    </label>

                                                                    <label class="custom-control custom-checkbox m-r-5" for="afficher_auto_fen">
                                                                        <input type="checkbox" name="" value="2" class="custom-control-input option_av" id="afficher_auto_fen">
                                                                        <span class="custom-control-label">Afficher automatiquement la fenêtre de partage après impression</span>
                                                                    </label>
                                                                </div><hr>
                                                                <div class="col-sm-12 m-t-30 m-b-30"><h5>Souhaitez-vous collecter les informations saisies ?</h5></div>
                                                                <div class="col-sm-12 form-inline m-b-30">
                                                                    <label class="custom-control custom-radio m-r-100" for="collecter_info_saisie_1">
                                                                        <input type="radio" name="collecter_info_saisie" id="collecter_info_saisie_1" value="1" class="custom-control-input">
                                                                        <span class="custom-control-label m-l-5">Oui</span>
                                                                    </label>
                                                                    <label class="custom-control custom-radio" for="collecter_info_saisie_0">
                                                                        <input type="radio" name="collecter_info_saisie" id="collecter_info_saisie_0" value="0" class="custom-control-input" checked="checked">
                                                                        <span class="custom-control-label m-l-5">Non</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-12  m-b-30">
                                                                    <p class="control-label m-b-20">La règlementation européene RGPD impose d'avoir le consentement de l'utilisateur pour pouvoir l'utiliser ultérieurement.Il doit également etre tenu informé des actions faites ...  </p>
                                                                </div>
                                                                <div class="col-sm-12 m-b-30"><h5>Champs de demandes d'autorisations :</h5></div>
                                                                <div class="col-sm-12">
                                                                    <button type="button" class="btn btn-success p-l-30 p-r-30 m-r-10" id="">Enregistrer</button>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="tab-pane  p-20" id="page_souvenir" role="tabpanel">2</div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>