<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('moment/min/moment.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.steps.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.validate.min.js', ['block' => true]); ?> 
<?= $this->Html->script('sweetalert/sweetalert.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/steps.js', ['block' => true]); ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>

<?= $this->Html->script('ConfigurationBornes/add.js?'.time(), ['block' => true]); ?>
<?= $this->Html->script('ConfigurationBornes/add_champ.js', ['block' => true]); ?>
<?= $this->Html->script('ConfigurationBornes/add_image.js', ['block' => true]); ?>
<?= $this->Html->script('ConfigurationBornes/add_mise_en_page.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('ConditionLojika/lojikapopup.js', ['block' => true]); ?>

<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>

<?= $this->Html->css('wizard/steps.css', ['block' => true]) ?>
<?= $this->Html->css('sweetalert/sweetalert.css', ['block' => true]) ?>
<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>
<?= $this->Html->css('configuration-bornes/add.css?'.time(), ['block' => true]) ?>

<?php
$titrePage = "Configuration borne";
$this->assign('title', $titrePage);
$this->start('breadcumb'); 

    $this->Breadcrumbs->add(
        'Evénements',
        ['controller' => 'Evenements', 'action' => 'index']
    );
    
    $this->Breadcrumbs->add(
        $evenement->nom,
        ['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
    );

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<?php 
$this->start('actionTitle'); 
if(empty($configurationBorneInBase)){
?>
    <div class="pull-right">
        <button type="button" class="btn btn-success0 btn-selfizee-inverse" data-toggle="modal" data-target="#smsTest" data-whatever="@mdo"><?= __('Créer à partir d\'une configuration existante') ?></button>
    </div>
 <?php } $this->end(); ?>
<input type="hidden" value="<?= $idEvenement ?>" id="id_evenmentConf" />
<div class="row" id="validation">
    <div class="col-12">
        <div class="card wizard-content card-outline-info">
            <!--<div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>-->
            <div class="card-body">
               <?php
               //debug($configurationBorne);
               echo $this->Form->create($configurationBorne,['class'=>'validation-wizard wizard-circle','id'=>'id_configurationForm','type'=>'file']); 
               $myTemplates = [
                    'nestingLabel' => '{{hidden}}<label class="custom-control custom-radio col-sm-4" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
               ];
                
                $this->Form->setTemplates($myTemplates); 
               ?>
                    <input type="hidden" name="is_edit" id="id_isEdit" value="<?= !empty($configurationBorne->id) ? 1:0 ?>" />
                    <!-- Step 1 -->
                    <h6>Choix animation et Configuration</h6>
                    <section>
                        <div class="row" id="id_listeTypeAnimation">
                            <div class="col-md-12 hide">
                                 <?= $this->Form->control('type_animation_id',['label' => 'Type animation', 'options'=>$typeAnimations, 'empty'=>'Séléctionner', 'class'=>'no-style', 'id'=>'id_typeAnimation']); ?>
                            </div>
                            
                                <?php foreach($typeAnimations as $key => $value){ ?>
                                    <div class="col-md-3 kl_oneAnimation <?= ($key == $configurationBorne->type_animation_id ) ? "selected" : "" ?>" data-key="<?= $key ?>" id="id_oneAnimation_<?= $key ?>">
                                        <div class="kl_image"></div>
                                        <div class="kl_titre"><?= $value ?></div>
                                    </div>
                                <?php } ?>
                                <?= $this->Form->control('evenement_id',['value'=>$evenement->id,'type'=>'hidden']) ?>
                        </div>

                        <!-- Step 2 à fusionner -->
                        <br>
                        <div class="kl_configAnimation">
                            <div class="row <?= $configurationBorne->type_animation_id == 6 ? "":"hide" ?> kl_theAnimation kl_theAnimation_6" id="id_animationDoubleConfiguration">
                            <div class="col-md-12">
                                <div class="kl_titreAnimationSelected">Animation : Double configuration</div>
                            </div>
                            <div class="col-md-12">
                                <?= $this->Form->control('multiconfiguration_id',['label' => 'Multiple configuration', 'options'=>$multiconfigurations, 'empty'=>'Séléctionner','id'=>'id_mutliconfiguration']); ?>
                            </div>
                        </div>
                        
                        <div class="row <?= $configurationBorne->type_animation_id == 1 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 1 || $configurationBorne->multiconfiguration_id == 2 )  ) ? "":"hide" ?> kl_theAnimation kl_theAnimation_1" id="id_animationCadrePostale">
                             <?= $this->element('ConfigurationBornes/animation_cadre_postale',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        
                        <div class="row <?= ($configurationBorne->type_animation_id == 2 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 2 || $configurationBorne->multiconfiguration_id == 4 )  )) ? "":"hide" ?> kl_theAnimation kl_theAnimation_2" id="id_animationCadrePostaleMultipose">
                             <?= $this->element('ConfigurationBornes/animation_cadre_postale_multipose',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        <div class="row <?= $configurationBorne->type_animation_id == 3 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 1 || $configurationBorne->multiconfiguration_id == 3 )  )? "":"hide" ?> kl_theAnimation kl_theAnimation_3" id="id_animationBadelette">
                            <?= $this->element('ConfigurationBornes/animation_bandelette',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        <div class="row <?= $configurationBorne->type_animation_id == 4 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 3 || $configurationBorne->multiconfiguration_id == 4 )  )? "":"hide" ?> kl_theAnimation kl_theAnimation_4" id="id_animationPolaroid">
                            <?= $this->element('ConfigurationBornes/animation_polaroid',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        <div class="row <?= $configurationBorne->type_animation_id == 5 ? "":"hide" ?> kl_theAnimation kl_theAnimation_5" id="id_animationFondVert">
                            <?= $this->element('ConfigurationBornes/animation_fond_vert',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        
                        
                        
                        <div class="kl_configAnimationCommun hide row col-md-12  m-t-15 pl-0">
                            <label class="col-md-12 p-l-0 kl_labelCustom">3 - Prise de photos :</label>
                            <div class="col-md-6">
                                <?= $this->Form->control('decompte_prise_photo',['label' => 'Décompte prise de photo (secondes)','class'=>'kl_deComptePriseDePhoto form-control']); ?>
                             </div>
                             <div class="clearfix"></div>
                            
                            <div class="row col-12 m-t-10">
                                <label class="col-md-12">Autoriser la reprise de photos</label>
                                <div class="col-md-5">
                                    <div class="row" style="padding: 0 15px;">
                                        <?php
                                            echo $this->Form->radio(
                                                'is_reprise_photo',
                                                [
                                                    ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                    ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                ],
                                                ['default' => 0,'label' =>'Autoriser la reprise de photos']
                                            );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <?php if(false){ ?>
                             <div class="row col-12 m-t-10">
                                <label class="col-md-6">Autoriser la reprise de photos</label>
                                <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_reprise_photo',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 0,'label' =>'Autoriser la reprise de photos']
                                                    );
                                            ?>
                                        </div>
                                </div>
                             </div>
                            <?php } ?>
                        </div>
                        </div>
                       
                    </section>
                    <!-- Step 2 -->
                    <!--<h6>Configuration animation </h6>-->
                    <!--<section> -->
                    <!--
                        <div class="row <?= $configurationBorne->type_animation_id == 6 ? "":"hide" ?> kl_theAnimation kl_theAnimation_6" id="id_animationDoubleConfiguration">
                            <div class="col-md-12">
                                <div class="kl_titreAnimationSelected">Animation : Double configuration</div>
                            </div>
                            <div class="col-md-12">
                                <?= $this->Form->control('multiconfiguration_id',['label' => 'Multiple configuration', 'options'=>$multiconfigurations, 'empty'=>'Séléctionner','id'=>'id_mutliconfiguration']); ?>
                            </div>
                        </div>
                        
                        <div class="row <?= $configurationBorne->type_animation_id == 1 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 1 || $configurationBorne->multiconfiguration_id == 2 )  ) ? "":"hide" ?> kl_theAnimation kl_theAnimation_1" id="id_animationCadrePostale">
                             <?= $this->element('ConfigurationBornes/animation_cadre_postale',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        
                        <div class="row <?= ($configurationBorne->type_animation_id == 2 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 2 || $configurationBorne->multiconfiguration_id == 4 )  )) ? "":"hide" ?> kl_theAnimation kl_theAnimation_2" id="id_animationCadrePostaleMultipose">
                             <?= $this->element('ConfigurationBornes/animation_cadre_postale_multipose',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        <div class="row <?= $configurationBorne->type_animation_id == 3 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 1 || $configurationBorne->multiconfiguration_id == 3 )  )? "":"hide" ?> kl_theAnimation kl_theAnimation_3" id="id_animationBadelette">
                            <?= $this->element('ConfigurationBornes/animation_bandelette',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        <div class="row <?= $configurationBorne->type_animation_id == 4 || ($configurationBorne->type_animation_id == 6 && ($configurationBorne->multiconfiguration_id == 3 || $configurationBorne->multiconfiguration_id == 4 )  )? "":"hide" ?> kl_theAnimation kl_theAnimation_4" id="id_animationPolaroid">
                            <?= $this->element('ConfigurationBornes/animation_polaroid',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        <div class="row <?= $configurationBorne->type_animation_id == 5 ? "":"hide" ?> kl_theAnimation kl_theAnimation_5" id="id_animationFondVert">
                            <?= $this->element('ConfigurationBornes/animation_fond_vert',['configurationBorne' => $configurationBorne]); ?>
                        </div>
                        
                        
                        
                        <div class="kl_configAnimationCommun row col-md-12  m-t-15 pl-0">
                            <label class="col-md-12 p-l-0 kl_labelCustom">3 - Prise de photos :</label>
                            <div class="col-md-4">
                                <?= $this->Form->control('decompte_prise_photo',['label' => 'Décompte prise de photo (secondes)','class'=>'kl_deComptePriseDePhoto form-control', 'style' => "width: 26%"]); ?>
                             </div>
                             <div class="clearfix"></div>
                            
							<div class="row col-12 m-t-10">
								<label class="col-md-12">Autoriser la reprise de photos</label>
								<div class="col-md-5">
									<div class="row kl_bloc_repise_photo" style="padding: 0 15px;">
										<?php
											echo $this->Form->radio(
												'is_reprise_photo',
												[
													['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
													['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
												],
												['default' => 0,'label' =>'Autoriser la reprise de photos']
											);
										?>
									</div>
								</div>
							</div>
							
							
                            <?php if(false){ ?>
                             <div class="row col-12 m-t-10">
                                <label class="col-md-6">Autoriser la reprise de photos</label>
                                <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_reprise_photo',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 0,'label' =>'Autoriser la reprise de photos']
                                                    );
                                            ?>
                                        </div>
                                </div>
                             </div>
							<?php } ?>
                        </div> 
                    -->
                    <!--</section>-->
                    <!-- Step 3 -->
                    <h6>Prise de coordonnées </h6>
                    <section >
                        <div class="row" id="id_priseCoordonnees">
                            <div class="row col-12 m-t-15">
                                <label class="col-md-12 lbl">Prise de coordonnées </label>
                                <div class="col-md-4 lbl-opt">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_prise_coordonnee',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 0,'label' =>'Prise de coordonnées ']
                                                    );
                                            ?>
                                        </div>
                                </div>
                             </div>
                             <div id="id_siPriseDeCoordronnee" class="<?= $configurationBorne->is_prise_coordonnee ? "":"hide" ?> row col-md-12">
                                <div class="col-md-12">
                                    <?= $this->Form->control('titre_formulaire',['default'=>'Veuillez saisir vos coordonnées pour recevoir votre photo','label' => 'Titre formulaire ','maxlength'=>200,'id'=>'id_titreForme', 'templateVars' => ['help' => '<span class="kl_resteTitreForm">143</span> caractères restants']]); ?>
                                </div>
                                <div class="col-md-12">
                                     <!--span class="sp" id="score">0</span>--><button type="button" class="btn btn-addchamp float-right" data-toggle="modal" data-target="#id_addChamp" id="id_addChamp_popup" data-backdrop="static" data-keyboard="false" onclick="qlClick()"; > <?= __('Ajouter un champ') ?></button>

<!--script id="testa">
var score = 0;
function qlClick(){
   score++;
   document.getElementById("score").innerHTML = score;
   if (score > 1) {
    //alert(score);
   }
}
</script>-->
                                </div>
                                <div class="col-md-12" id="id_listeChampAdded">
                                    <?php 
                                    if(!empty($configurationBorne->champs)){
                                    foreach($configurationBorne->champs as $key => $champ) { ?>
                                    <div class="kl_oneListe" id="id_idChampAdded_<?= $champ->id ?>">
                                        <div class="col-md-12 kl_oneChampAdded m-t-15">
                                            <div class="kl_indexChamp"><?= $key+1 ?></div>
                                            <div class="kl_infoChamp">
                                                <div class="kl_titreChamp"><?= $champ->nom ?></div>
                                                <?php
                                                $optionsInput = "";
                                                $optionsPossible = array();
                                                foreach($champ->champ_options as $key => $option ){
                                                    $optionsPossible[] = $option->nom;
                                                    $optionsInput =  $optionsInput . '<input type="hidden" name="champs['.$champ->id.'][champ_options]['.$key.'][id]" value="'.$option->id.'"  /><input type="hidden" class="kl_oneChoixPossible" name="champs['.$champ->id.'][champ_options]['.$key.'][nom]"  value="'.$option->nom.'" />';
                                                }
                                                $choixPossible = "";
                                                if(!empty($optionsPossible)){
                                                    $choixPossible = " - Choix Possible : ".$this->Text->toList($optionsPossible);
                                                }
                                                $typeDonneeOptin = "";
                                                if(!empty($champ->type_optin)){
                                                    $typeDonneeOptin = '- Type de données : '.$champ->type_optin->titre ;
                                                    if($champ->type_optin->id == 6 && !empty($champ->custom_optin)){
                                                        $typeDonneeOptin = $typeDonneeOptin . ' : '. $champ->custom_optin->titre;
                                                    }
                                                } 
                                                ?>
                                                <div class="kl_infoChampAdded">Type de champ : <?= $champ->type_champ->nom ?>  <?= $typeDonneeOptin ?> <?= !empty($champ->type_donnee) ? '- Type de données : '.$champ->type_donnee->nom : ''  ?> <?= $choixPossible ?> - Obligatoire: <?= empty($champ->is_required) ? "Non" : "Oui" ?> </div>
                                            </div>
                                            <div class="kl_actionsChamp absolute">
                                                <a class="btn btn-actionChamp float-right m-r-5 kl_editChamp" data-customid="<?= $champ->id ?>" href="#">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </a>
                                                <a class="btn btn-actionChamp float-right m-r-5 kl_deleteChamp" date-customid="<?= $champ->id ?>" href="#">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </div>
                                        </div>
                                         <input type="hidden" id="id_IdChampIdAdded" name="champs[<?= $champ->id ?>][id]" value="<?= $champ->id ?>"/>
                                        <input type="hidden" id="id_typeChampIdAdded" name="champs[<?= $champ->id ?>][type_champ_id]" value="<?= $champ->type_champ_id ?>"/>
                                        <input type="hidden" id="id_nomChampAdded" name="champs[<?= $champ->id ?>][nom]" value="<?= $champ->nom ?>" />
                                        <input type="hidden" id="id_typeDonneIdAdded" name="champs[<?= $champ->id ?>][type_donnee_id]" value="<?= $champ->type_donnee_id ?>" />
                                        <input type="hidden" id="id_ordreAdded" name="champs[<?= $champ->id ?>][ordre]" value="<?= $champ->ordre ?>" />
                                        <input type="hidden" id="id_is_requiredAdded" name="champs[<?= $champ->id ?>][is_required]"  value="<?= intval($champ->is_required) ?>" />
                                        <input type="hidden" id="id_type_optinAdded" name="champs[<?= $champ->id ?>][type_optin_id]"  value="<?= $champ->type_optin_id ?>" />
                                        <?php if(!empty($champ->custom_optin) && $champ->type_optin_id == 6 ){ ?>
                                        <input type="hidden" id="id_type_optin" name="champs[<?= $champ->id ?>][custom_optin][titre]"  value="<?= $champ->custom_optin->titre ?>" />
                                        <?php } ?>
                                        <?= $optionsInput ?>
                                    </div>
                                    <?php }} ?>
                                </div>
                           
                            </div>
                        </div>
                    </section>
                    <!-- Step 4 -->
                    <h6>Impression</h6>
                    <section>
                        <div class="row">
                            
                                <div class="row col-md-12 m-t-15">
                                    <label class="col-md-12">Autoriser l’impression </label>
                                    <div class="col-md-3">
										<div class="row" style="padding:0 15px;">
											<?php
												  echo $this->Form->radio(
													'is_impression',
														[
															['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
															['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
														],
														['default' => 1]
													);
											?>
										</div>
                                    </div>
                                </div>
                               <div id="id_siImpression" class="<?= $configurationBorne->is_impression || is_null($configurationBorne->is_impression) ? "":"hide" ?> col-md-12 row">
                                     <div class="row col-md-12 m-t-15">
                                        <label class="col-md-4">Activer la multi-impression</label>
                                        <div class="col-md-3">
                                                <div class="row">
                                                    <?php
                                                          echo $this->Form->radio(
                                                            'is_multi_impression',
                                                            [
                                                                ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                                ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                            ],
                                                            ['default' => 0]
                                                            );
                                                    ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-6 <?= $configurationBorne->is_multi_impression ? "":"hide" ?>" id="id_nbrMaxMultiImpression">
                                            <?= $this->Form->control('nbr_max_multi_impression',['label' => 'Nombre maximum en multi-impression']); ?>
                                        </div>
                                    </div>
                                    <div class="row col-md-12 m-t-15">
                                        <label class="col-md-4">Mettre une limite au nombre d'impressions de l'événement</label>
                                        <div class="col-md-3">
                                                <div class="row">
                                                    <?php
                                                          echo $this->Form->radio(
                                                            'has_limite_impression',
                                                            [
                                                                ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                                ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                            ],
                                                            ['default' => 0]
                                                            );
                                                    ?>
                                                </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row col-md-12 <?= $configurationBorne->has_limite_impression ? "":"hide" ?>" id="id_nbrMaxPhoto" >
                                        <label class="col-md-12">Nombre de photos maximum sur l’événement</label>
                                        <div class="col-md-2">
                                        <?= $this->Form->control('nbr_max_photo',['label' => false]); ?>
                                      </div>
                                   </div>
                                    <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <?= $this->Form->control('texte_impression',['type'=>'text','label' => 'Texte d’impression','default'=>'Impression...', 'style' => "width: 150px"]); ?>
                                    </div></div>
                                   
                                    
                                    <div class="row col-md-12">
                                        <label class="col-md-4">Impression automatique</label>
                                        <div class="col-md-3">
                                                <div class="row">
                                                    <?php
                                                          echo $this->Form->radio(
                                                            'is_impression_auto',
                                                            [
                                                                ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                                ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                            ],
                                                            ['default' => 0]
                                                            );
                                                    ?>
                                                </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row col-md-12" <?= $configurationBorne->is_impression_auto ? "":"hide" ?>" id="id_nbrImpressionAuto">
                                        <label class="col-md-12">Nombre de copies par impression automatique</label>
                                        <div class="col-md-2">
                                        <?= $this->Form->control('nbr_copie_impression_auto',['label' => false]); ?>
                                    </div>
                                </div>
                               
                                <div class="row col-md-12">
                                <label class="col-md-12">Décompte Timeout</label>
                                <div class="col-md-2">
                                        <?= $this->Form->control('decompte_time_out',['label' => false,'id'=>'id_decompteTimeOut','default' =>'80', 'style' => "width: 60%"]); ?>
                                </div></div>
                                
                                
                             
                        </div>
                    </section>
                    
                    <!-- Step 5 -->
                    <h6>Mise en page </h6>
                    <section>
						<?php 
							$url = '';
							// image prédéfinie
							if(!empty($configurationBorne->ecran->btn_page_accueil_id) && $configurationBorne->ecran->btn_page_accueil_id){
								$url = '/import/config_pages/boutons/'.$config_boutons[$configurationBorne->ecran->btn_page_accueil_id];
							}
							// Image upload-ereg
							elseif(!empty($configurationBorne->ecran->btn_page_accueil) && $configurationBorne->ecran->btn_page_accueil){
								$url = '/import/config_bornes/'.$idEvenement.'/cadres/'.$configurationBorne->ecran->btn_page_accueil;
							}
							
							$url_bpp = 
							$url_ba = 
							$url_bf = 
							$url_bg_accueil = 
							$url_bg_prise_photo = 
							$url_bg_filtre = '';
							
							// page fond accueil
							if(!empty($configurationBorne->ecran->page_accueil) && $configurationBorne->ecran->page_accueil){
								$url_bg_accueil = 'background-image:url(/import/config_bornes/'.$idEvenement.'/cadres/'.$configurationBorne->ecran->page_accueil.');';
								$url_ba = $configurationBorne->ecran->page_accueil;
							}
							// Image prise de photo
							if(!empty($configurationBorne->ecran->page_prise_photo) && $configurationBorne->ecran->page_prise_photo){
								$url_bg_prise_photo = 'background-image:url(/import/config_bornes/'.$idEvenement.'/cadres/'.$configurationBorne->ecran->page_prise_photo.');';
								$url_bpp = $configurationBorne->ecran->page_prise_photo;
							}
							// Image page filtre
							if(!empty($configurationBorne->ecran->page_choix_filtre) && $configurationBorne->ecran->page_choix_filtre){
								$url_bg_filtre = 'background-image:url(/import/config_bornes/'.$idEvenement.'/cadres/'.$configurationBorne->ecran->page_choix_filtre.');';
								$url_bf = $configurationBorne->ecran->page_choix_filtre;
							}
						?>
						<div class="row" id="id_pageHome">
                            
                            <div class="col-md-12">
                                <h4 class="card-title text-left">Page d'accueil</h4>
                            </div>
							
							<div class="col-md-12 row">
								<div class="col-md-5">
									<div class="sf-apercus" style="background-color:<?php echo !empty($configurationBorne->ecran->page_config_fond_accueil_couleur) ? $configurationBorne->ecran->page_config_fond_accueil_couleur : '#FFFFFF'; ?>;<?php echo $url_bg_accueil; ?>">
										<?php echo trim($url) != '' ? '<div class="sf-bloc-button-upload"><img class="sf-bouton-center" src="'.$url.'"></div>' : ''; ?>
									</div>
									
								</div>
								<div class="col-md-7">
									<div class="col-md-12 row clearfix sf-fond-page" style="margin-bottom: 14px;">
										<?= $this->Form->control('imagedefondAccueil0',['label' => ['text' => 'Fond de page', 'style' => 'width:102px'], 'options'=>$config_fondpage, 'empty'=>'Couleur de fond','id'=>'id_imagefondaccueil', 'name' => 'ecran[page_config_fond_accueil_id]', 'default' => (!empty($configurationBorne->ecran->page_config_fond_accueil_id) ? $configurationBorne->ecran->page_config_fond_accueil_id : '')]); ?>
										<div class="form-group pull-left sf-bloc-pers">
											<input type="file" class="hide sf-img-fond" name="imagedefondAccueil" accept=".jpg, .jpeg">
											<input type="hidden" class="sf-img-fondBD" value="<?php echo $url_ba; ?>" name="ecran[page_accueil]">
											<button class="btn btn-danger sf-img-fond-button"><i class="mdi mdi-image"></i> Upload image de fond</button>
											<button class="btn btn-secondary sf-img-fond-button-supp <?php echo $url_bg_accueil ? '' : 'hide'; ?>"><i class="mdi mdi-delete-empty"></i> Effacer image de fond</button>
										</div>
										<div class="sf-link-bloc"><a href="/page-config-fonds" class="text-primary" target="_blank"><small><em>Liste des couleurs de fonds prédéfinis</em></small></a></div>
									</div>
									<div class="row">
										<div class="col-md-12 sf-inline clearfix">
											<div class="form-group pull-left" style="width: 30%;">
												<input type="text" name="ecran[page_config_fond_accueil_couleur]" class="form-control colorpicker1" value="<?php echo !empty($configurationBorne->ecran->page_config_fond_accueil_couleur) ? $configurationBorne->ecran->page_config_fond_accueil_couleur : '#FFFFFF' ?>">
											</div>
											<label class="custom-control custom-checkbox pull-left">
												<input type="checkbox" class="custom-control-input" name="ecran[choix_all_pages]" <?php echo !empty($configurationBorne->ecran->choix_all_pages) && $configurationBorne->ecran->choix_all_pages ? 'checked=true' : ''; ?>>
												<span class="custom-control-label"> <u>Appliquer sur toutes les pages</u></span>
											</label>
										</div>
									</div>
									<div class="col-md-12 row clearfix">
										<?= $this->Form->control('boutonaccueil',['label' => ['text' => 'Bouton', 'style' => 'width:102px'], 'options'=>$config_bouton_options, 'empty'=>'Image prédéfinie','id'=>'id_boutonaccueil', 'name' => 'ecran[btn_page_accueil_id]', 'default' => (!empty($configurationBorne->ecran->btn_page_accueil_id) ? $configurationBorne->ecran->btn_page_accueil_id : '')]); ?>
										<div class="form-group pull-left sf-bloc-pers">
											<input type="file" id="sf-img-bouton" class="hide" name="btnaccueil" accept=".png">
											<input type="hidden" id="sf-img-bouton-bd" value="" name="ecran[btn_page_accueil]">
											<button class="btn btn-danger sf-img-bouton"><i class="mdi mdi-camera-iris"></i> Upload bouton</button>
											<button class="btn btn-secondary sf-img-button-supp <?php echo $url ? '' : 'hide'; ?>"><i class="mdi mdi-delete-empty"></i> Effacer bouton</button>
										</div>
										<div class="sf-link-bloc"><a href="/page-config-boutons" class="text-primary" target="_blank"><small><em>Liste des boutons prédéfinis</em></small></a></div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<br><hr><br>
							</div>
							
							<div class="col-md-12">
                                <h4 class="card-title text-left">Page prise de photo</h4>
                            </div>
							
							<div class="col-md-12 row">
								<div class="col-md-5">
									<div class="sf-apercus" style="background-color:<?php echo !empty($configurationBorne->ecran->page_config_fond_prise_photo_couleur) ? $configurationBorne->ecran->page_config_fond_prise_photo_couleur : '#FFFFFF'; ?>;<?php echo $url_bg_prise_photo; ?>">
										
									</div>
									
								</div>
								<div class="col-md-7">
									<div class="col-md-12 row clearfix sf-fond-page">
										<?= $this->Form->control('imagedefondAccueil0',['label' => ['text' => 'Fond de page', 'style' => 'width:102px'], 'options'=>$config_fondpage, 'empty'=>'Couleur de fond','id'=>'id_imagefondaccueil', 'name' => 'ecran[page_config_fond_prise_photo_id]', 'default' => (!empty($configurationBorne->ecran->page_config_fond_prise_photo_id) ? $configurationBorne->ecran->page_config_fond_prise_photo_id : '')]); ?>
										<div class="form-group pull-left sf-bloc-pers">
											<input type="file" class="hide sf-img-fond" name="imageDeFondPrisePhoto" accept=".jpg, .jpeg">
											<input type="hidden" class="sf-img-fondBD" value="<?php echo $url_bpp; ?>" name="ecran[page_prise_photo]">
											<button class="btn btn-danger sf-img-fond-button"><i class="mdi mdi-image"></i> Upload image de fond</button>
											<button class="btn btn-secondary sf-img-fond-button-supp <?php echo $url_bg_prise_photo ? '' : 'hide'; ?>"><i class="mdi mdi-delete-empty"></i> Effacer image de fond</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 sf-inline clearfix">
											<div class="form-group pull-left" style="width: 30%;">
												<input type="text" name="ecran[page_config_fond_prise_photo_couleur]" class="form-control colorpicker1" value="<?php echo !empty($configurationBorne->ecran->page_config_fond_prise_photo_couleur) ? $configurationBorne->ecran->page_config_fond_prise_photo_couleur : '#FFFFFF'; ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<br><hr><br>
							</div>
							
							<div class="col-md-12">
                                <h4 class="card-title text-left">Page filtres</h4>
                            </div>
							
							<div class="col-md-12 row">
								<div class="col-md-5">
									<div class="sf-apercus" style="background-color:<?php echo !empty($configurationBorne->ecran->page_config_fond_filtre_couleur) ? $configurationBorne->ecran->page_config_fond_filtre_couleur : '#FFFFFF'; ?>;<?php echo $url_bg_filtre; ?>">
									</div>
									
								</div>
								<div class="col-md-7">
									<div class="col-md-12 row clearfix sf-fond-page">
										<?= $this->Form->control('imagedefondAccueil0',['label' => ['text' => 'Fond de page', 'style' => 'width:102px'], 'options'=>$config_fondpage, 'empty'=>'Couleur de fond','id'=>'id_imagefondaccueil', 'name' => 'ecran[page_config_fond_filtre_id]', 'default' => (!empty($configurationBorne->ecran->page_config_fond_filtre_id) ? $configurationBorne->ecran->page_config_fond_filtre_id : '')]); ?>
										<div class="form-group pull-left sf-bloc-pers">
											<input type="file" class="hide sf-img-fond" name="choixFiltre"  accept=".jpg, .jpeg">
											<input type="hidden" class="sf-img-fondBD" value="<?php echo $url_bf; ?>" name="ecran[page_choix_filtre]">
											<button class="btn btn-danger sf-img-fond-button"><i class="mdi mdi-image"></i> Upload image de fond</button>
											<button class="btn btn-secondary sf-img-fond-button-supp <?php echo $url_bg_filtre ? '' : 'hide'; ?>"><i class="mdi mdi-delete-empty"></i> Effacer image de fond</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 sf-inline clearfix">
											<div class="form-group pull-left" style="width: 30%;">
												<input type="text" name="ecran[page_config_fond_filtre_couleur]" class="form-control colorpicker1" value="<?php echo !empty($configurationBorne->ecran->page_config_fond_filtre_couleur) ? $configurationBorne->ecran->page_config_fond_filtre_couleur : '#FFFFFF'; ?>">
											</div>
										</div>
									</div>
									<div class="col-md-5 row bloc-colorpicker2">
										<?= $this->Form->control('titreaccueilfiltre',['label' => ['text' => 'Titre', 'style' => 'width:102px'],'id'=>'titreaccueilfiltre', 'value' => !empty($configurationBorne->ecran->page_filtre_titre) ? $configurationBorne->ecran->page_filtre_titre : 'Choisissez votre filtre', 'name' => 'ecran[page_filtre_titre]', 'style' => 'color:'. (!empty($configurationBorne->ecran->page_filtre_titre_couleur) ? $configurationBorne->ecran->page_filtre_titre_couleur : '#000000;')]); ?>
									</div>
									<div class="row">
										<div class="col-md-12 sf-inline clearfix">
											<div class="form-group pull-left" style="width: 30%;">
												<input type="text" name="ecran[page_filtre_titre_couleur]" class="form-control colorpicker2" value="<?php echo !empty($configurationBorne->ecran->page_filtre_titre_couleur) ? $configurationBorne->ecran->page_filtre_titre_couleur : '#000000'; ?>">
											</div>
										</div>
									</div>
									<div class="col-md-12 row">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input sf-mp-avance" name="ecran[page_filtre_titre_avance]" <?php echo !empty($configurationBorne->ecran->page_filtre_titre_avance) && $configurationBorne->ecran->page_filtre_titre_avance ? 'checked=true' : ''; ?>>
											<span class="custom-control-label">Mise en page avancée</span>
										</label>
									</div>
									<div class="col-md-12 row <?php echo !empty($configurationBorne->ecran->page_filtre_titre_avance) && $configurationBorne->ecran->page_filtre_titre_avance ? '' : 'hide'; ?>" id="sf-mp-avance">
										<div class="col-md-9 row sf-mp-avc sf-mp-avc1">
											<?= $this->Form->control('police',['label' => ['text' => ' ', 'style' => 'width:102px'], 'options'=>$config_police, 'empty'=>'Police','id'=>'police', 'name' => 'ecran[page_filtre_titre_police_id]', 'default' => (!empty($configurationBorne->ecran->page_filtre_titre_police_id) ? $configurationBorne->ecran->page_filtre_titre_police_id : '')]); ?>
											<div class="sf-link-bloc"><a href="/page-config-polices" class="text-primary" target="_blank"><small><em>Liste des polices prédéfinis</em></small></a></div>
										</div>
										<div class="col-md-9 row sf-mp-avc">
											<?= $this->Form->control('fontsize',['label' => ['text' => ' ', 'style' => 'width:30px'], 'options'=>$config_fontsize, 'empty'=>'Taille police','id'=>'fontsize', 'name' => 'ecran[page_filtre_titre_taille]', 'default' => (!empty($configurationBorne->ecran->page_filtre_titre_taille) ? $configurationBorne->ecran->page_filtre_titre_taille : '')]); ?>
										</div>
										<div class="col-md-12 row sf-mp-avc sf-mp-marge">
											<div class="form-inline">
												<label class="sf-mp-p">Position Gauche</label>
												<?php echo $this->Form->control('marginLeft',['label' => false, 'options'=>$config_margin, 'empty'=>'Left','id'=>'marginLeft', 'name' => 'ecran[page_filtre_titre_left]', 'default' => (!empty($configurationBorne->ecran->page_filtre_titre_left) ? $configurationBorne->ecran->page_filtre_titre_left : '')]); ?>
												<label class="sf-mp-p">Position Droite</label>
												<?php echo $this->Form->control('marginRight',['label' => false, 'options'=>$config_margin, 'empty'=>'Right','id'=>'marginRight', 'name' => 'ecran[page_filtre_titre_right]', 'default' => (!empty($configurationBorne->ecran->page_filtre_titre_right) ? $configurationBorne->ecran->page_filtre_titre_right : '')]); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
						</div>
						
						
						
						<?php if(false){ ?>
                        <!--<div class="row">
                            <div id="id_dropZoneBtn">
                                <div id="id_uploadAllPage" class="dropzone"></div>
                            </div>
                        </div>-->
                        <!-- Page d'accueil -->
                        <div class="row" id="id_pageHome">
                            
                            <div class="col-md-12 row">
                                <h4 class="card-title text-left">Page d'accueil</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="row col-md-6">
                                    <?php
                                          echo $this->Form->radio(
                                            'personalise_acceuil',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                             <?php 
                                            $urlPageAcceul = null;
                                            $urlPresentationAccueil ="confbornes/BG_ACCUEIL.jpg";
                                            if(!empty($configurationBorne->ecran->page_accueil)){
                                                    $fileName = $configurationBorne->ecran->page_accueil;
                                                    $urlPageAcceul = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                                    $urlPresentationAccueil = $urlPageAcceul;
                                            }
                                     
                                            $urlBtnAcceul = null;
                                            $urlPresentionBtn = "confbornes/btn_accueil.png";
                                            if(!empty($configurationBorne->ecran->btn_page_accueil)){
                                                    $fileName = $configurationBorne->ecran->btn_page_accueil;
                                                    $urlBtnAcceul = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                                    $urlPresentionBtn = $urlBtnAcceul;
                                            }
                                ?>  
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationAccueil, ['id' => 'id_ImagedefondAccueil','class'=>'kl_photoView']); ?>
                                    <?php echo $this->Html->image($urlPresentionBtn, ['id' => 'id_btnaccueil','class' =>'kl_boutonEnDessous kl_photoView']); ?>
                                </div>
                            </div>
                            <div class="col-md-6 kl_personalise ">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    
                                    <input type="file" name="imagedefondAccueil" class="kl_imageQuiChange dropify" data-destination="#id_ImagedefondAccueil" data-allowed-file-extensions="jpeg jpg"  data-default-file="<?= $urlPageAcceul ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Bouton</label>
                                   
                                    <input type="file" name="btnaccueil" class="kl_imageQuiChange dropify" data-destination="#id_btnaccueil" data-allowed-file-extensions="png" data-default-file="<?= $urlBtnAcceul ?>"/>
                                </div>
                            </div>
                            
                          
                            
                            
                        </div>
                        
                        <!-- BG layout -->
                        <div class="row <?= $configurationBorne->type_animation_id == 6 ?"":"hide"?>" id="id_pageChoixConfiguration">
                            <div class="col-md-12 row">
                                <h4 class="card-title text-left">Page Choix de la configuration </h4>
                            </div>
                            <?php
                            
                            $urlChoixConf = null;
                            $urlPresentationChoixConf ="confbornes/BG_LAYOUT.jpg";
                            //debug($configurationBorne->ecran);
                            if(!empty($configurationBorne->ecran->page_choix_configuration)){
                                    $fileName = $configurationBorne->ecran->page_choix_configuration;
                                    $urlChoixConf = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                    $urlPresentationChoixConf = $urlChoixConf;
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php
                                          echo $this->Form->radio(
                                            'personalise_choixConfiguration',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationChoixConf, ['id' => 'id_ImageDeFondChoixConfiguration','class'=>'kl_photoView']); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    <input type="file" name="imageDeChoixConfiguration" class="kl_imageQuiChange dropify" data-destination="#id_ImageDeFondChoixConfiguration" data-allowed-file-extensions="jpeg jpg" data-default-file="<?= $urlChoixConf ?>" />
                                </div> 
                            </div>
                        </div>
                        
                        <!-- Page prise de photo -->
                        <div class="row" id="id_prisePhoto">
                            <div class="col-md-12 row">
                                <h4 class="card-title text-left">Page prise de photo </h4>
                            </div>
                            <?php
                            
                            $urlPrisePhoto = null;
                            $urlPresentationPrisePhoto ="confbornes/BG_ACCUEIL.jpg";
                            if(!empty($configurationBorne->ecran->page_prise_photo)){
                                    $fileName = $configurationBorne->ecran->page_prise_photo;
                                    $urlPrisePhoto = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                    $urlPresentationPrisePhoto = $urlPrisePhoto;
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="row col-md-6">
                                    <?php
                                          echo $this->Form->radio(
                                            'personalise_prisedephoto',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationPrisePhoto, ['id' => 'id_ImageDeFondPrisePhoto','class'=>'kl_photoView']); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    <input type="file" name="imageDeFondPrisePhoto" class="kl_imageQuiChange dropify" data-destination="#id_ImageDeFondPrisePhoto" data-allowed-file-extensions="jpeg jpg" data-default-file="<?= $urlPrisePhoto ?>" />
                                </div> 
                            </div>
                        </div>
                        
                        <!-- Page de prise de photo et visualisation photo  -->
                        <div class="row" id="id_PrisePhotoEtVisualisation">
                            <div class="col-md-12 row">
                                <h4 class="card-title text-left">Page de prise de photo (Visualisation) </h4>
                            </div>
                            
                            <?php
                            
                            $urlVisualiation = null;
                            $urlPresentationVisualisation ="confbornes/BG_FOND.jpg";
                            if(!empty($configurationBorne->ecran->page_prise_photo_visualisation)){
                                    $fileName = $configurationBorne->ecran->page_prise_photo_visualisation;
                                    $urlVisualiation = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                    $urlPresentationVisualisation = $urlVisualiation;
                            }
                            ?>
                            
                            <div class="col-md-12">
                                <div class="row col-md-6">
                                    <?php
                                          echo $this->Form->radio(
                                            'personalise_prisedephoto_visualiation',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationVisualisation, ['id' => 'id_ImagedefondPrisePhotoVisualiation','class'=>'kl_photoView']); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    <input type="file" name="imageDeFondVisualisation" class="kl_imageQuiChange dropify" data-destination="#id_ImagedefondPrisePhotoVisualiation" data-default-file="<?= $urlVisualiation ?>" data-allowed-file-extensions="jpeg jpg"/>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- Page de choix de filtre   -->
                        <div class="row" id="id_choixFiltre">
                            <div class="col-md-12 row">
                                <h4 class="card-title text-left">Page choix de filtre  </h4>
                            </div>
                            
                            <?php
                            
                            $urlFiltre = null;
                            $urlPresentationFiltre ="confbornes/BG_FILTRE.jpg";
                            if(!empty($configurationBorne->ecran->page_choix_filtre)){
                                    $fileName = $configurationBorne->ecran->page_choix_filtre;
                                    $urlFiltre = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                    $urlPresentationFiltre = $urlFiltre;
                            }
                            ?>
                            
                            <div class="col-md-12">
                                <div class="row col-md-6">
                                    <?php
                                          echo $this->Form->radio(
                                            'choix_filtre',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationFiltre, ['id' => 'id_ImagedefondChoixFiltre','class'=>'kl_photoView']); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    <input type="file"  data-default-file="<?= $urlFiltre ?>" name="choixFiltre" class="kl_imageQuiChange dropify" data-destination="#id_ImagedefondChoixFiltre" data-allowed-file-extensions="jpeg jpg" />
                                </div>
                            </div>
                            
                        </div>
                        
                         
                        <!-- Page de remerciement    -->
                        <div class="row" id="id_pageRemerciement">
                            <div class="col-md-12 row">
                                <h4 class="card-title text-center">Page de remerciement   </h4>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row col-md-6">
                                    <?php
                                          echo $this->Form->radio(
                                            'page_remerciement',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                            
                            <?php
                            $urlRemerciement = null;
                            $urlPresentationRemerciement ="confbornes/BG_MERCI.jpg";
                            if(!empty($configurationBorne->ecran->page_remerciement)){
                                    $fileName = $configurationBorne->ecran->page_remerciement;
                                    $urlRemerciement = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                    $urlPresentationRemerciement = $urlRemerciement;
                            }
                            ?>
                            
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationRemerciement, ['id' => 'id_ImageFondRemerciement','class'=>'kl_photoView']); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    <input type="file" name="fondRemerciement" data-default-file="<?= $urlRemerciement ?>" class="kl_imageQuiChange dropify" data-destination="#id_ImageFondRemerciement" data-allowed-file-extensions="jpeg jpg" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- Page de choix de fond vert     -->
                        <div class="row kl_siFonfVertMisePage <?= $configurationBorne->type_animation_id == 5 ? "":"hide" ?>" id="id_pageChoixFondVert">
                            <div class="col-md-12 row">
                                <h4 class="card-title text-center">Page de choix de fond vert  </h4>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row col-md-6">
                                    <?php
                                          echo $this->Form->radio(
                                            'choix_filtre',
                                            [
                                                ['value' => 1, 'text' => 'Par défaut','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Personnalisé','class'=>'custom-control-input'],
                                            ],
                                            ['default' => 0]
                                            );
                                    ?>
                                </div>
                            </div>
                            
                            <?php
                            $urlFondVert = null;
                            $urlPresentationFondVert ="confbornes/BG_FOND_VERT.jpg";
                            if(!empty($configurationBorne->ecran->page_choix_fond_vert)){
                                    $fileName = $configurationBorne->ecran->page_choix_fond_vert;
                                    $urlFondVert = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                    $urlPresentationFondVert = $urlFondVert;
                            }
                            ?>
                            
                            <div class="col-md-6">
                                <div class="kl_theAcceuilView">
                                    <?php echo $this->Html->image($urlPresentationFondVert, ['id' => 'id_ImageFondFondVert','class'=>'kl_photoView']); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image de fond</label>
                                    <input type="file" name="fondFondVert" data-default-file="<?= $urlFondVert ?>" class="kl_imageQuiChange dropify" data-destination="#id_ImageFondFondVert"  data-allowed-file-extensions="jpeg jpg" />
                                </div>
                            </div>
                            
                            
                        </div>
                        <?php } ?>
                    </section>
                     <!-- Step 5 -->
                    <h6>Filtres</h6>
                    <section>
                        <div class="row">
                            <div class="row col-md-12 m-t-15">
                                <label class="col-md-12">Filtres : </label>
                                <div class="col-md-4">
                                        <div class="row lbl-opt-2">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_filtre',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 0]
                                                    );
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <div id="id_choixDesFiltreSiOui" class="row col-md-12 <?= $configurationBorne->is_filtre ? "":"hide" ?>">
                                 <div class="kl_filtreLabelCustom col-md-12">Filtres Standards</div>
                                 <?php
                                    echo $this->Form->control('filtres._ids', [
                                        'type' => 'select',
                                        'multiple' => 'checkbox',
                                        'options' => $filtres,
                                        'label' => false,
                                        "class"=>"selectpicker kl_checkBoxFiltre",
                                        "default" => [1,2,3],
                                        'templates'=>[
                                                        'inputContainer' => '{{content}}',
                                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}" {{attrs}} class="no-class">',
                                                        'checkboxWrapper' => '<div class="col-md-4">{{label}}</div>',
                                                        'nestingLabel' => '{{hidden}}<label class="" {{attrs}} >{{input}}<span class="kl_theLabelOfCheckBox m-l-5">{{text}}</span></label>',
              
                                        ]
                                    ]);
                                 ?>
                                <div class="kl_filtreLabelCustom col-md-12">Filtre avancés (le temps de traitement est un peu plus long. )</div>
                                 <?php
                                    echo $this->Form->control('filtres._ids', [
                                        'type' => 'select',
                                        'multiple' => 'checkbox',
                                        'options' => $filtreAvancees,
                                        'label' => false,
                                        "class"=>"selectpicker kl_checkBoxFiltre" ,
                                        'hiddenField' => false,
                                        'templates'=>[
                                                        'inputContainer' => '{{content}}',
                                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}" {{attrs}} class="no-class">',
                                                        'checkboxWrapper' => '<div class="col-md-4">{{label}}</div>',
                                                        'nestingLabel' => '{{hidden}}<label class="" {{attrs}} >{{input}}<span class="kl_theLabelOfCheckBox m-l-5">{{text}}</span></label>',
              
                                        ]
                                    ]);
                                 ?>
                            </div>
                            <div class="kl_erroMaxFiltre error red hide">Vous ne pouvez  séléctionner que 6 filtres.</div>
                            
                        </div>
                    </section>
                    
                    <!-- Step 5 -->
                    <h6>Bornes</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-12">Numéro de la borne</label>
                                <div class="col-md-9">
                                            <?php
                                            echo $this->Form->control('num_borne', [
                                                'label' => false
                                            ]);
                                         ?>
                                </div>
                            </div>
                            <div class=" col-md-12 ">
                                <label class="col-md-12">Taille écran </label>
                                <div class="col-md-9">
                                            <?php
                                            echo $this->Form->control('taille_ecran_id', [
                                                'type' => 'select',
                                                'options' => $tailleEcrans,
                                                'label' => false,
                                                'empty' => 'Séléctionner'
                                            ]);
                                         ?>
                                </div>
                            </div>
                            
                            <div class=" col-md-12 ">
                                <label class="col-md-12">Type imprimante</label>
                                <div class="col-md-9 ">
                                            <?php
                                            echo $this->Form->control('type_imprimante_id', [
                                                'type' => 'select',
                                                'options' => $typeImprimantes,
                                                'label' => false,
                                                'empty' => 'Séléctionner'
                                            ]);
                                         ?>
                                        
                                </div>
                            </div>
                        </div>
                    </section>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
 <?php echo $this->element('ConfigurationBornes/add_champ',['typeChamps' => $typeChamps,'typeDonnees' => $typeDonnees,'typeOptins'=>$typeOptins]) ?> 
 <?php echo $this->element('ConfigurationBornes/duplicate_conf',['evenement' => $evenement,'listeEvenement' => $listeEvenement]) ?> 
<script type="text/javascript">
	var config_fondpage = <?php echo json_encode($config_fondpage); ?>;
	var config_boutons = <?php echo json_encode($config_boutons); ?>;
</script> 