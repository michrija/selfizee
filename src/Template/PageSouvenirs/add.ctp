<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
?>
<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('pageSouvenir/add.css?t='.time(), ['block' => true]) ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('wizard/jquery.steps.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('nestable/jquery.nestable.js', ['block' => true]); ?>
<?= $this->Html->script('pageSouvenir/page-souvenir.js?'.time(), ['block' => true]); ?>

<?= $this->Html->script('ConfigurationBornes/add_champ.js', ['block' => true]); ?>
<?= $this->Html->script('ConfigurationBornes/add_image.js', ['block' => true]); ?>
<?= $this->Html->script('ConfigurationBornes/add_mise_en_page.js', ['block' => true]); ?> 
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>


<?php
$titrePage = "Configuration de la page souvenir";
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
$myTemplates = [
    'select' => '<div class="col-6"><select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select></div>',
    'label' => '<label{{attrs}} class="control-label kl_labelCustomMonsterat col-3">{{text}}</label>',
    'inputContainer' => '<div class="form-group row">{{content}} </div>',
    'input' => '<div class="col-6"> <input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/> <div class="help-block mt-2"><small>{{help}}</small></div></div>',
    'textarea' => '<div class="col-9"> <textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
    'inputContainerError' => '<div class="form-group row has-danger {{type}}{{required}} error">{{content}}{{error}}</div>',
    'error' => '<div class="form-control-feedback my-auto">{{content}}</div>',
    'nestingLabel' => '{{hidden}}<label class="custom-control custom-checkbox pl-3 " {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
    'radioWrapper' => '{{label}}', 
];

$this->Form->setTemplates($myTemplates); 
?>

<?php $this->start('actionTitle'); ?>
    <div class="pull-right">
        <?php echo $this->Html->link('<i class="mdi mdi-eye"></i> Visualiser',['controller' => 'Photos', 'action' => 'testPageSouvenir', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'btn btn-success0 btn-selfizee-inverse','target'=>'_blank' ]); ?>
    </div>

    <div class="pull-right">
        <?php echo $this->Html->link('<i class="mdi mdi-eye"></i> Infos renseigner avant le téléchargement de photo',['controller' => 'ReponsesPageSouvenirs', 'action' => 'liste', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'btn btn-success0 btn-selfizee-inverse','target'=>'_blank' ]); ?>
    </div>

 <?php $this->end(); ?>

<div class="mb-2">
    <!--<div class="pull-right">
        <?php echo $this->Html->link('<i class="mdi mdi-eye"></i> Visualiser',['controller' => 'Photos', 'action' => 'testPageSouvenir', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'btn btn-success','target'=>'_blank' ]); ?>
    </div>-->
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<?= $this->Form->create($pageSouvenir,['type'=>'file', 'class' => 'form-bordered']) ?>
    <div class="row">
        <div class="col-md-9 col-xl-12">
            <div class="card card-new-selfizee" id="">
                <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black"><?= $titrePage ?> </h4>
                </div>
                <div class="card-body">
                    <div class="form-body">
                        <div class="row ">
                            <?php
                                $kl_EvenementHide = "";
                                if(!empty($idEvenement)){
                                    $kl_EvenementHide = "hide";
                                }
                            ?>
                            <div class="col-md-12 <?= $kl_EvenementHide ?>">
                                <?php echo $this->Form->control('evenement_id',['label' => 'Evénement *', 'options'=>$evenements,'value'=>$idEvenement, 'empty'=>'Séléctionner', 'id'=>'clients_id']); ?>
                            </div>

                            <div class="col-md-12 mb-2">
                                <h3>Mise en page</h3>
                            </div>
                            
                            <div class="col-md-12 m-b-20">
                                <div class="pl-4 form-group">
                                    <div class="row">
                                        <label class="col-3">Image de la BANNIERE de la page souvenir (png, jpg, gif ) :</label>
                                         <?php
                                            $banniere = "";
                                            if(!empty($pageSouvenir->img_banniere)){
                                                $banniere = "data-default-file=".$pageSouvenir->url_banniere ;
                                                echo '<input type="hidden" value="'.$pageSouvenir->img_banniere.'" name="img_banniere">';
                                            }
                                        ?>
                                        <div class="col-9"><input type="file" name="imagebaniere_file" class="dropify"   <?= $banniere ?> data-allowed-file-extensions="png jpeg jpg gif"/></div>
                                    </div>
                                </div>
                            </div>
    						
                            <div class="col-md-12 m-b-20">
                                <div class="pl-4 form-group border-0">
                                    <div class="row">
                                        <label class="col-3">Image du BANDEAU BAS de la page souvenir (png, jpg, gif ) :</label>
                                         <?php
                                            $bandeau = "";
                                            if(!empty($pageSouvenir->img_bandeau)){
                                                $bandeau = "data-default-file=".$pageSouvenir->url_bandeau ;
                                                echo '<input type="hidden" value="'.$pageSouvenir->img_bandeau.'" name="img_bandeau">';
                                            }
                                        ?>
                                        <div class="col-9"><input type="file" name="imagebandeau_file" class="dropify"  <?= $bandeau ?> data-allowed-file-extensions="png jpeg jpg gif"/></div>
                                    </div>
                                </div>

                                <div class="pl-4">
                                    <?php echo $this->Form->control('is_active_lienextern', ['label'=>'Activer un lien vers un site extérieur', 'id'=>'is_active_lienextern', 'hiddenField' => false]); ?>
                                    <div class="lien_extern hide"><?php echo $this->Form->control('lien_extern', ['label'=>'URL du site ', 'placeholder' => 'https://www.google.com', 'name' => 'lien_extern']); ?></div>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="pl-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $this->Form->control('couleur_fond',['label'=>'Couleur du fond de la page','class'=>'colorpicker form-control','default'=>$defaultCouleurFond]); ?>
                                            <?php echo $this->Form->control('couleur_download_link',['label'=>'Couleur du bouton de téléchargement','class'=>'colorpicker form-control','default'=>$defaultCouleurDownloadLink]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <h3>Réseaux sociaux</h3>
                            </div>

                            <div class="col-md-12 m-b-20">
                                <div class="pl-4">
                                    <?= $this->Form->control('rs_configuration.desc_facebook', ['label' => 'Description Facebook']) ?>
                                </div>
                            </div>

                            <div class="col-md-12 m-b-20">
                                <div class="pl-4">
                                    <?= $this->Form->control('rs_configuration.desc_twiter', ['label' => 'Description Twitter']) ?>
                                </div>
                            </div>


                            <div class="col-md-12 mb-2">
                                <h3>Modules supplémentaires:</h3>
                            </div>
                            
                            <div class="col-md-12 col-xl-12">
                                <div class="pl-4">
                                <?php echo $this->Form->control('is_active_video_pub', ['label'=>"Activer le module vidéo publicitaire", 'id'=>'is_active_video_pub', 'hiddenField' => false, 'class' => 'form-check-input']); ?>

                                </div>

                            </div>
                            
                            <div class="col-md-12 url-video hide">
                                <div class="pl-4"><?php echo $this->Form->control('url_video', ['label'=>'URL vidéo de la page souvenir (Youtube / Viméo / Dailymotion)', 'placeholder' => 'https://www.youtube.com/watch?v=IKwNodw_LhQ', 'name' => 'url_video']); ?></div>
                            </div>

                            <div class="col-md-12 col-xl-12">
                                <div class="pl-4"><?php echo $this->Form->control('is_active_form_down', ['label'=>'Activer le module de saisie de formulaire avant le téléchargement de photo', 'id'=>'is_active_form_down', 'hiddenField' => false]); ?></div>
                            </div>
     
                            <div id="activRenseign" class="col-md-12 hide">
                                <div class="pl-4"><?= $this->Form->control('titre_formulaire',['default'=>'Veuillez renseigner vos coordonnées pour télécharger votre photo','label' => 'Commentaire téléchargement','maxlength'=>200,'id'=>'id_titreForme', 'templateVars' => ['help' => '<span class="kl_resteTitreForm">143</span> caractères restants']]); ?></div>
                            </div>
    						

                            <?php
                                $this->Form->setTemplates([
                                    'label' => '<label{{attrs}} class="control-label">{{text}}</label>',
                                    'input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/>',
                                    'select' => '<select name="{{name}}"{{attrs}} class="custom-select">{{content}}</select>',
                                    'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}" class="custom-control-input" {{attrs}}>',
                                ]); 
                            ?>


                            <div class="col-md-12">
                                <button type="button" class="btn btn-addchamp float-right hide" data-toggle="modal" data-target="#id_addChamp" data-backdrop="static" data-keyboard="false"  > <?= __('Ajouter un champ') ?></button>
                            </div>

                                    <div class="col-md-12 hide" id="id_listeChampAdded">
                                        <?php 
                                        if(!empty($pageSouvenir->champs)){
                                        foreach($pageSouvenir->champs as $key => $champ) { ?>
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
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <?php if (isset($urlSouvenir)): ?>
                <a  target="_blank" href="<?= $urlSouvenir ?>" class="btn btn-default btn-grey btn-block" > Aperçu</a>
            <?php endif ?>
            <?= $this->Form->button(__('Save'),["class"=>"btn btn-success btn-block",'escape'=>false]) ?>
        </div>
    </div>
    <?php echo $this->element('PageSouvenir/add_champ',['typeChamps' => $typeChamps,'typeDonnees' => $typeDonnees,'typeOptins'=>$typeOptins]) ?> 
<?= $this->Form->end() ?>

