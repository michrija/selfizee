<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsCustom $clientsCustom
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
$titrePage = "Page souvenir";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add(
$client->nom,
['controller' => 'Clients', 'action' => 'view', $client->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($clientsCustom,['type'=>'file'] ) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <?php echo $this->Form->control('client_id',['type' => 'hidden', 'value'=>$client->id]); ?>
                        <!--<div class="col-md-12"><h5>Page souvenir</h5><hr></div>-->
                        <div class="col-md-12">
                            <?php echo $this->Form->control('signature_email',['label'=>'Signature','class'=>'textarea_editor form-control','type'=>'textarea']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('ps_publicite',['label'=>'Publicité page souvenir','class'=>'textarea_editor2 form-control','type'=>'textarea']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('ps_couleur_de_fond',['label'=>'Couleur par défaut du fond de la page souvenir','class'=>'colorpicker form-control']); ?>
                        </div>
                        
                        <div class="col-md-12">
                            <?php echo $this->Form->control('ps_couleur_download_link',['label'=>'Couleur par défaut du bouton de téléchargement','class'=>'colorpicker form-control']); ?>
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
