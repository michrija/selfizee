<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
?>
<?= $this->Html->script('speackingurl/speakingurl.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>

<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>

<?= $this->Html->css('html5-editor/bootstrap-wysihtml5.css', ['block' => true]) ?>
<?= $this->Html->script('html5-editor/wysihtml5-0.3.0.js', ['block' => true]); ?>
<?= $this->Html->script('html5-editor/bootstrap-wysihtml5.js', ['block' => true]); ?>

<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>

<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<?= $this->Html->css('Galeries/add.css', ['block' => true]) ?>
<?= $this->Html->script('Galeries/add.js', ['block' => true]); ?>
<?= $this->Html->script('Galeries/apercu.js', ['block' => true]); ?>

<?php


$this->start('breadcumb');
if(!empty($evenement)){
    $titrePage = "Configuration de la galerie";
    $this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'Evenements', 'action' => 'index']
    );
    $this->Breadcrumbs->add(
    $evenement->nom,
    ['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
    );
    $this->Breadcrumbs->add($titrePage);
    
    if(!empty($galery->id)){
        $this->start('actionTitle');
        echo $this->Form->button('<i class="mdi mdi-email"></i> '.__('Envoi galerie'),['id'=>'envoye_gallerie', "class"=>"btn btn-success0 btn-selfizee-inverse pull-right",'escape'=>false, 'type'=>'button', 'data-toggle'=>'modal', 'data-target'=>'#envoiEMail']);
        echo $this->Html->link('<i class="mdi mdi-eye"></i> Visualiser la galerie',['controller'=>'Galeries','action'=>'souvenir', $galery->id_encode],['target'=>'_blank','escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse m-r-5" ]);
        $this->end();
    }
    
}else{
    
    $titrePage = "Ajout d'une nouvelle galerie";
    $this->Breadcrumbs->add(
    'Galleries',
    ['controller' => 'Galeries', 'action' => 'index']
    );
    
    $this->Breadcrumbs->add($titrePage);

}




echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->assign('title', $titrePage);

?>

<?php
    $this->Form->setTemplates([
        'select' => '<div class="col-9"><select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select></div>',
        'label' => '<label{{attrs}} class="control-label kl_labelCustomMonsterat col-3">{{text}}</label>',
        'inputContainer' => '<div class="form-group"><div class="row">{{content}}</div> </div>',
        'input' => '<div class="col-9"> <input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/> <div class="help-block mt-2"><small>{{help}}</small></div></div>',
        'textarea' => '<div class="col-9"> <textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
        'inputContainerError' => '<div class="form-group row has-danger {{type}}{{required}} error">{{content}}{{error}}</div>',
        'error' => '<div class="form-control-feedback my-auto">{{content}}</div>',
        'nestingLabel' => '{{hidden}}<label class="custom-control custom-checkbox pl-3" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
        'radioWrapper' => '{{label}}',   
    ]);
?>

<?= $this->Form->create($galery,['type'=>'file', 'base-url' => $this->Url->build('/'), 'class' => 'form-galerie']) ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black"><?= $titrePage ?> </h4>
                </div>
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                           <?php 
                           $kl_EvenementHide = "";
                           if(!empty($idEvenement) ){
                             $kl_EvenementHide = "hide";
                           }  
                           ?>
                           
                           <div class="col-md-12 <?= $kl_EvenementHide ?>">
                                <div class="row">
                                    <label for="evenements-ids" class="col-3">Évenements</label>
                                    <div class="col-9">
                                        <?php
                                        // Select multiple pour belongsToMany
                                            echo $this->Form->control('evenements._ids', [
                                                'type' => 'select',
                                                'multiple' => true,
                                                'options' => $evenements,
                                                'value' => $idEvenement,
                                                'class' => 'select2 form-control',
                                                'label' => false,
                                                'hiddenField' => false,
                                                'templates' => [
                                                    'inputContainer' => '<div class="form-group"><div class="row-fluid">{{content}}</div> </div>',
                                                ]
                                            ]);
                                        ?>
                                    </div>
                                </div>
                           </div>
                            
    						<div class="col-md-12">
    							<?php 
                                    //debug($defaultIsLivreDor);
    								echo $this->Form->control('nom',['label'=>'Titre de la galerie','id'=>'id_nomGalerie']);
    								echo $this->Form->control('slug',['label'=>'Identifiant de la galerie (*)','required'=>true,'id'=>'id_identifiantGalerie']);
    							?>
                                <?php echo $this->Form->control('is_public',['label'=>'La galerie est publique','type'=>'checkbox', 'hiddenField' => false,]); ?>
                                <?php echo $this->Form->control('is_livredor_active',['label'=>'Livre d\'or actif ?','type'=>'checkbox','hiddenField' => false, 'default'=>$defaultIsLivreDor]); ?>

                                <?php 
                                    echo $this->Form->control('couleur',['label'=>'Couleur du thème','class'=>'form-control colorpicker','default'=>$defaultCouleurTheme]);
                                    echo $this->Form->control('titre',['class'=>'textarea_editor  form-control','type'=>'textarea', 'default'=>$defaultTitre]);
                                    echo $this->Form->control('sous_titre',['class'=>'textarea_editor2 form-control','type'=>'textarea', 'default'=>$defailtSousTitre, 'label' => 'Sous-titre']);
                                ?>
    						</div>

                            <div class="hide">
                                <?php 
                                     echo $this->Form->control('user.username',['class'=>'form-control','id'=>'id_loginGalerie', 'value'=>$galery->slug]);
                                     echo $this->Form->control('user.password',['class'=>'form-control', 'value'=>$galery->slug,'type'=>'text','id'=>'id_passwordGalerie', 'class' => '']);
                                     echo $this->Form->control('user.role_id',['class'=>'form-control','value' => 3, 'type'=>'text', 'class' => '']);
                                 ?>
                            </div>

                            <div class="col-md-12 m-b-15">
                                <div class="row">
                                    <label class="col-3">Image de la bannière (png, jpg, gif ) :</label>
                                    <div class="col-9">
                                        <?php
                                            $banniere = "";
                                            if(!empty($galery->img_banniere)){
                                                $banniere = "data-default-file=".$galery->url_banniere ;
                                            }
                                        ?>
                                        <input type="file" name="img_banniere_file" class="dropify"  <?= $banniere ?>  data-allowed-file-extensions="png jpeg jpg gif"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
    							<?php echo $this->Form->control('invited_can_upload_photo',['label'=>'Autoriser l\'upload photo depuis la galerie','id'=>'id_invited_can_upload_photo']); ?>
    						</div>
                            <div class="col-md-12 <?= $galery->invited_can_upload_photo ? "":"hide" ?>  kl_showIfCan">
    							<?php echo $this->Form->control('is_photo_invited_must_moderate',['label'=>'Modérer les photos uploadées depuis la galerie','id'=>'id_is_photo_invited_must_moderate']); ?>
    						</div>
                            <div class="col-md-12 <?= $galery->invited_can_upload_photo && $galery->is_photo_invited_must_moderate ? "":"hide" ?> kl_showIfModerate ">
                                	<?php echo $this->Form->control('email_to_notify',['label'=>'Veuillez saisir un email auquel on peut vous notifier quand des photos sont uploadées depuis la galerie','id'=>'id_email_to_notify']); ?>
                            </div>
                           
                            <!--/span-->
                        </div>
                    </div>
                    <div class="form-actions">
                        <?php $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            
            <?= $this->Form->button(__('Save'),["class"=>"btn btn-success btn-block",'escape'=>false]) ?>
        </div>
    </div>
<?= $this->Form->end() ?>

<!--MODAL ENVOI EMAIL GALERIE-->    
<?php echo $this->element('Galeries/envoi_email'); ?>
