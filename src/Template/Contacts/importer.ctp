<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>

<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?= $this->Html->script('jasny/jasny-bootstrap.js', ['block' => true]); ?>
<?= $this->Html->script('Contacts/liste.js', ['block' => true]); ?>

<?php
$titrePage = "Ajout noveau contact" ;
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
    echo $this->Form->create(null, [
'url' => ['action' => 'uploadCsv', $evenement->id],
'type' => 'file'
]);
?>
<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <!--*<div class="card-header">
            <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
        </div>-->
        <div class="card-body">
            <div class="pull-left col-8">
                <div class="row ">
                    <div class="col-md-6 p-r-0 p-l-0">
                        <div class="form-group">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-secondary btn-file">
                        <span class="fileinput-new"><?= __('Select csv file') ?></span>
                    <span class="fileinput-exists"><?= __('Change') ?></span>
                    <input type="file" name="csv_file">
                    </span>
                                <a href="#" class="input-group-addon btn btn-secondary fileinput-exists" data-dismiss="fileinput"><?= __('Remove') ?></a> </div>

                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <?php echo $this->Form->button('<i class="fa fa-cloud-upload"></i> Uploader le csv',['class'=>'btn btn-primary','escape'=>false]);?>
                        </div>
                    </div>
                    <!--/span-->

                </div>
            </div>
        </div>
    </div>
</div>
</div>
                