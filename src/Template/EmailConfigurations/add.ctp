<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
  use Cake\Routing\Router; 
?>
<?php //$this->Html->css('html5-editor/bootstrap-wysihtml5.css', ['block' => true]) ?>
<?php //$this->Html->script('html5-editor/wysihtml5-0.3.0.js', ['block' => true]); ?>
<?php // $this->Html->script('html5-editor/bootstrap-wysihtml5.js', ['block' => true]); ?>

<?= $this->Html->css('bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css', ['block' => true]); ?>
<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('email-configurations/add.css',['block'=>true]) ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('nestable/jquery.nestable.js', ['block' => true]); ?>

<?= $this->Html->script('tinymce/tinymce.min.js', ['block' => true,"referrerpolicy"=>"origin"]); ?>

<?php //$this->Html->script('pageSouvenir/page-souvenir.js?'.time(), ['block' => true]); ?>
<?php //echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css', ['block' => true]) ?>
<?php //echo  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js', ['block' => true]) ?>
<?php //$this->Html->script('summernote/summernote-fr-FR.min.js', ['block' => true]); ?> 
<?php //$this->Html->script('summernote/summernote-image-attributes.js', ['block' => true]); ?>
<?php //$this->Html->css('/js/tam-emoji/css/emoji.css',['block'=>true]) ?>
<?php //$this->Html->script('/js/tam-emoji/js/config.js', ['block' => true]); ?>
<?php //echo $this->Html->script('/js/tam-emoji/js/tam-emoji.min.js?v=1.1', ['block' => true]); ?>
<?php //$this->Html->script('summernote/fr-FR.js', ['block' => true]); ?>   

<?= $this->Html->script('jasny/jasny-bootstrap.js', ['block' => true]); ?>

<?= $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datetime-picker/js/locales/bootstrap-datetimepicker.fr.js', ['block' => true]); ?>

<?= $this->Html->script('EmailConfigurations/email-configurations.js?t='.time(), ['block' => true]); ?>

<?php
$titrePage = "Configuration de l'e-mail";
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

<!--


    <div class="pull-right">
        <button type="button" class="kl_btnDeTest btn btn-success0 btn-selfizee-inverse" data-toggle="modal" data-target="#emailTest" data-whatever="@mdo"><i class="mdi mdi-near-me"></i> <?= __('Envoyer un e-mail de test') ?></button>
    </div>

    <?php echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Nom de domaine'),['controller'=>'NomDeDomaines', 'action'=>'liste', $idEvenement],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]); ?>


-->

<?= $this->Form->create($emailConfiguration,['type' => 'file']) ?>  
<div class="row">
    <div class="col-md-9">
        <div class="card card-new-selfizee" id="id_configEmail">
            <div class="card-header border-bottom">
                        <h4 class="m-b-0 text-black">Paramètrage E-mail </h4>
            </div>
            <div class="card-body">
                
                <div class="form-body">
                    <div class="row">
                        <?php
                            $kl_EvenementHide = "";
                            if(!empty($idEvenement)){
                                $kl_EvenementHide = "hide";
                            }
                        ?>
                        <div class="col-md-12 <?= $kl_EvenementHide ?>">
                            <?php echo $this->Form->control('evenement_id',['label' => 'Evénement *', 'options'=>$evenements,'value'=>$idEvenement, 'empty'=>'Séléctionner', 'id'=>'clients_id']); ?>
                        </div>
                        <?php if($clientsModelesEmails->count() > 0) {?>
                        <div class="col-md-12">
                            <input type="hidden" value="<?= Router::url('/', true) ?>" id="base_url" />
                            <?php echo $this->Form->control('clients_modeles_email_id',['id' => 'model_email', 'label' => 'Modèles ', 'options'=>$clientsModelesEmails,'empty'=>'Séléctionner le modèle','required'=>false,'class'=>'form-control']);?>
                        </div>
                        <?php  } ?>
                        <div class="col-md-4">
                            <?php 
                            $expediteurs = $expediteurs->toArray();

                            if(empty($expediteurs)){
                                $expediteurs = ['contact@selfizee.fr' => 'contact@selfizee.fr', 'createnew' => 'Nouvelle adresse'];
                            }else{
                                $expediteurs['createnew'] = 'Nouvelle adresse';
                            }
                            $default = $emailConfiguration->email_expediteur;
                            //debug($default);
                            echo $this->Form->control('email_expediteur', ['options' => $expediteurs,  'empty' => 'Séléctionner',  'label'=>"E-mail de l'expéditeur : ",'id' => 'id_expedtieurList', 'value' => $default]); 
                           //echo $this->Form->control('email_expediteur',['label'=>'E-mail de l\'expéditeur : ', 'type'=>'email']); 
                            ?>
                            <div class="hide">
                                <input type="checkbox" name="is_newAdresse" id="id_isNewAdresse">
                            </div>
                        </div>
						<div class="col-md-4">
							<?php echo $this->Form->control('nom_expediteur',['label'=>"Nom de l'expéditeur : "]); ?>
						</div>
						
						<div class="col-md-4">
							<?php echo $this->Form->control('objet',['label'=>'Objet :','type'=>'text']); ?>
                        </div>
                    
                        <div class="col-md-12">
                            <div id="img_name_content"></div><!-- Pour stocker le nom de l image uploadé -->
                            <?php 
                                echo $this->Form->control('content',
                                    [
                                        'label'=>"Contenu de l'email", 
                                        'type'=>'textarea',
                                        'class'=>'form-control textarea_editor',
                                        'rows'=>'20',
                                        'templates' => [
                                            'inputContainer' => '<div class="form-group m-b-0">{{content}}</div>',
                                        ]
                                    ]
                                ); 
                            ?>
                            <div class="kl_blocEnBas">
                                <div class="kl_toAddMiniature pull-left ">
                                    <a href="#" id="id_addMinuatureLienParam" class="kl_ajouterMinLien">Ajouter la miniature avec le lien vers la page souvenir</a>
                                </div>
                                <div class="kl_spearator pull-left m-l-15 m-r-15"></div>
                                <div class="pull-left">
                                    <select class="form-control kl_listeChoixParam pull-left">
                                            <option value="img/lien_page_souvenir.png">Lien page souvenir</option>
                                            <option value="img/miniature.png">Miniature</option>
                                            <!--<option value="img/nom.png">Nom</option>
                                            <option value="img/prenom.png">Prénom</option>
                                            <option value="img/param_email.png">Email</option>-->
                                    </select>
                                    <a id="id_addSelectedParam" href="#" class="kl_ajouterMinLien pull-left m-l-15">Ajouter</a>
                                    
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                         
                        <div class="col-md-12">
                            <?php echo $this->Form->control('is_photo_en_pj',['label'=>'Envoyer en pièce jointe (PJ) : dans le corps du mail ','type'=>'checkbox']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('is_blocshare_active',['label'=>'Activer le bloc d\'incitation','type'=>'checkbox','id'=>'id_isBlocSahreActive']); ?>
                        </div>
                        
                        <div class="col-md-12 row <?= $emailConfiguration->is_blocshare_active ? '':'hide' ?>" id="id_pickerColorIconShare">
                            <div class="col-3">
                                <button style="background: <?= $emailConfiguration->couleur_btn_download ?>;" class="btn btn-download waves-effect btn-circle waves-light pull-left kl_oneIconShare" type="button"> <i class="fa  fa-download"></i> </button>
                                <button style="background: <?= $emailConfiguration->couleur_share_facebook ?>;" class="btn btn-facebook waves-effect btn-circle waves-light pull-left kl_oneIconShare m-l-5" type="button"> <i class="fa fa-facebook"></i> </button>
                                <button style="background: <?= $emailConfiguration->couleur_share_twitter ?>;" class="btn btn-twitter waves-effect btn-circle waves-light pull-left kl_oneIconShare m-l-5" type="button"> <i class="fa fa-twitter"></i> </button>
                                <button style="background: <?= $emailConfiguration->couleur_share_instagram ?>;" class="btn btn-instagram waves-effect btn-circle waves-light pull-left kl_oneIconShare m-l-5" type="button"> <i class="fa fa-instagram"></i> </button>
                            </div>
                            <div class="col-md-9 p-l-0">
                                <div class=" kl_forIconBlock  pull-left">
                                    <?php echo $this->Form->control('couleur_btn_download',['label'=>false,'class'=>'colorpicker kl_forIcon form-control pull-left','default'=>'#000000']); ?>
                                    <button style="background: <?= $emailConfiguration->couleur_btn_download ?>;" class="btn btn-download waves-effect btn-circle waves-light pull-left" type="button"> <i class="fa  fa-download"></i> </button>
                                </div>
                                <div class=" kl_forIconBlock  pull-left m-l-15">
                                    <?php echo $this->Form->control('couleur_share_facebook',['label'=>false,'class'=>'colorpicker kl_forIcon form-control pull-left','default'=>'#000000']); ?>
                                    <button style="background: <?= $emailConfiguration->couleur_share_facebook ?>;" class="btn btn-facebook waves-effect btn-circle waves-light pull-left" type="button"> <i class="fa fa-facebook"></i> </button>
                                </div>
                                <div class=" kl_forIconBlock  pull-left m-l-15">
                                    <?php echo $this->Form->control('couleur_share_twitter',['label'=>false,'class'=>'colorpicker kl_forIcon form-control pull-left','default'=>'#000000']); ?>
                                   <button style="background: <?= $emailConfiguration->couleur_share_twitter ?>;" class="btn btn-twitter waves-effect btn-circle waves-light pull-left" type="button"> <i class="fa fa-twitter"></i> </button>
                                </div>
                                <div class=" kl_forIconBlock  pull-left m-l-15">
                                    <?php echo $this->Form->control('couleur_share_instagram',['label'=>false,'class'=>'colorpicker kl_forIcon form-control pull-left','default'=>'#000000']); ?>
                                    <button style="background: <?= $emailConfiguration->couleur_share_instagram ?>;" class="btn btn-instagram waves-effect btn-circle waves-light pull-left" type="button"> <i class="fa fa-instagram"></i> </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="#" id="id_addBlocIncitation" class="kl_ajouterMinLien kl_blocIndicationAdd">Ajouter dans le mail </a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('is_has_couleur_fond',['label'=>'Utiliser une couleur de fond personnalisée','type'=>'checkbox','id'=>'id_isHasCouleurFond']); ?>
                        </div>
                        
                        <div class="col-md-4 <?= $emailConfiguration->is_has_couleur_fond ? '':'hide' ?>" id="id_couleurFondPerso">
                            <?php echo $this->Form->control('couleur_fond_editeur',['label'=>'Couleur du fond  de l\'email','class'=>'colorpicker form-control','default'=>$defaultCouleurFond]); ?>
                        </div>

                   </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-3 kl_noPaddingLeft">
        <div class="card card-new-selfizee">
            <div class="card-header">
                <h4 class="m-b-0 text-black text-uppercase">état </h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <?php 
                    $opts = [ 0 =>'Désactivé', 1=>'Activé' ];
                    echo $this->Form->select('is_active', $opts,['class'=>'custom-select custom-select-selfizee col-12', 'default' => 1]); 
                    ?>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox custom-checkbox-selfizee">
                        <!--<input type="checkbox" id="id_activeDateEnvoi" class="custom-control-input" <?= $emailConfiguration->date_heure_envoi ? 'checked': '' ?>>-->
                        
                        <?php echo $this->Form->control('is_envoi_plannifie',
                                [
                                    'type' => 'checkbox',
                                    'class' => 'custom-control-input',
                                    'label'=>false, 
                                    //'hiddenField' => false,
                                    'id' => 'id_activeDateEnvoi',
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                                ]) ?>

                        <span class="custom-control-label">Plannifier l'envoi à une date programmée</span>
                    </label>
                </div>
                <div class="form-group <?= $emailConfiguration->is_envoi_plannifie ? '': 'hide' ?>" id="id_dateHeureEnvoi">
                    <?php 
                    echo $this->Form->control('date_heure_envoi',
                        [
                            'type'=>'text',
                            'label'=>false,
                            'class'=>'kl_dateHeureDenvoi form-control datepicker',
                            'id'=>'id_debutContrat',
                            "autocomplete"=>"off",
                            'templates' => [
                                'inputContainer' => '<div class="form-group input-group">{{content}}<div class="input-group-append">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                    </div></div>',

                            ]
                        ]
                    ); 
                    ?>
                </div>
            </div>
        </div>
        
        <button type="button" class="kl_btnDeTest btn btn-success0 btn-selfizee-new fw500 col-12" data-toggle="modal" data-target="#smsTest" data-whatever="@mdo"> <?= __('Enovyer un e-mail de test') ?></button>

        <?= $this->Form->button(__('Save'),["class"=>"kl_btnDeTest btn btn-success col-12 m-t-15",'escape'=>false]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?php echo $this->element('EmailConfigurations/email_test',['evenement' => $evenement]) ?>
<?php echo $this->element('EmailConfigurations/add_expediteur',['clientId' => $userConnected['client_id']]) ?>

<a href="<?php echo $this->Url->build(['controller' => 'EmailConfigurations', 'action' => 'getMailId']); ?>" class="url d-none"></a>
<input type="hidden" id="id_baseUrl" value="<?php echo Router::url('/', true) ; ?>"/>