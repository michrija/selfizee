<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersCustom $usersCustom
 */
?>


<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>

<?= $this->Html->css('html5-editor/bootstrap-wysihtml5.css', ['block' => true]) ?>
<?= $this->Html->script('html5-editor/wysihtml5-0.3.0.js', ['block' => true]); ?>
<?= $this->Html->script('html5-editor/bootstrap-wysihtml5.js', ['block' => true]); ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('UserCustomes/add.js', ['block' => true]); ?>

<?php
$titrePage = "Personalisations";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Utilisateurs',
['controller' => 'Users', 'action' => 'index']
);

$this->Breadcrumbs->add(
$user->username,
['controller' => 'Users', 'action' => 'view', $user->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => ""]);
$this->end();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($usersCustom,['type'=>'file'] ) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <?php echo $this->Form->control('user_id',['type' => 'hidden', 'value'=>$user->id]); ?>
                        <div class="col-md-12"><h5>Page souvenir</h5><hr></div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('signature_email',['label'=>'Signature','class'=>'textarea_editor form-control','type'=>'textarea']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('ps_publicite',['label'=>'Publicité page souvenir','class'=>'textarea_editor2 form-control','type'=>'textarea']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('ps_bandeau_par_defaut',['label'=>'Bandeau par defaut de la page souvenir','class'=>'colorpicker form-control']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('ps_couleur_de_fond',['label'=>'Couleur du fond de la page souvenir','class'=>'colorpicker form-control']); ?>
                        </div>

                        <br><div class="col-md-12"><h5>Galerie souvenir</h5><hr></div>
                        <div class="col-md-12">
                            <?php
								echo $this->Form->control('gs_nom',['label'=>'Titre de la galerie','id'=>'id_nomGalerie']);
                            echo $this->Form->control('gs_slug',['label'=>'Identifiant de la galerie (*)','required'=>true,'id'=>'id_identifiantGalerie']);
                            echo $this->Form->control('gs_is_public',['label'=>'La galerie est publique','type'=>'checkbox']);
                            echo $this->Form->control('gs_is_livredor_active',['label'=>'Livre d\'or actif ?','type'=>'checkbox']);
                            echo $this->Form->control('gs_couleur',['label'=>'Couleur du thème','class'=>'form-control colorpicker']);
                            echo $this->Form->control('gs_titre',['label'=>'Titre', 'class'=>'textarea_editor3 form-control','type'=>'textarea']);
                            echo $this->Form->control('gs_sous_titre',['label'=>'Sous titre', 'class'=>'textarea_editor4 form-control','type'=>'textarea']);
                            ?>
                        </div>
                        <div class="col-md-12 m-b-15">
                            <label>Image de la bannière (png, jpg, gif ) :</label>
                            <?php
                                $banniere = "";
                                if(!empty($usersCustom->gs_img_banniere)){
                                        $banniere = "data-default-file=".$usersCustom->url_banniere ;
                            }
                            ?>
                            <input type="file" name="img_banniere_file" class="dropify"  <?= $banniere ?>  data-allowed-file-extensions="png jpeg jpg gif"/>
                        </div>

                    </div>

                    <div class="form-actions">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>

<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users Customs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCustoms form large-9 medium-8 columns content">
    <?= $this->Form->create($usersCustom) ?>
    <fieldset>
        <legend><?= __('Add Users Custom') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('ps_publicite');
            echo $this->Form->control('ps_bandeau_par_defaut');
            echo $this->Form->control('ps_couleur_de_fond');
            echo $this->Form->control('gs_nom');
            echo $this->Form->control('gs_slug');
            echo $this->Form->control('gs_is_public');
            echo $this->Form->control('gs_titre');
            echo $this->Form->control('gs_sous_titre');
            echo $this->Form->control('gs_couleur');
            echo $this->Form->control('gs_img_banniere');
            echo $this->Form->control('gs_is_livredor_active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>-->
