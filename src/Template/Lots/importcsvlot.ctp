<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StripeCsvFile $stripeCsvFile
 */
?>


<!-- Color picker plugins css -->
<?= $this->Html->css('dropify/dropify.min.css', ['block' => true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('Stripes/stripes.js', ['block' => true]); ?>

<?php
$titrePage = "Import csv" ;
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Dashboards', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Informations</h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create(null, ['type'=>'file', 'url'=>['controller' => 'Lots', 'action'=>'importcsvlot']]) ?>
                <div class="form-body"><!-- 
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Date * </label>
                            <input type="date" name="date_import" class="form-control" placeholder="dd/mm/yyyy" required>
                        </div>
                    </div><br> -->
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $this->Form->control('stripe_csv_file',["id"=>"", "label"=>"Fichier CSV ","class"=>"dropify", "type"=>"file", "data-height"=>"100", "accept"=>".csv", 'templateVars'=>['help'=>'Remarque : Le contenu du fichier csv doit contenir et être arrangé comme suit:<br> nom,photo,qauntité,type de gain (probabilité/instant gagnant),probabilité de gain ou Horaire gain,id_evennement<br>Ex1: Smart phone,smart.jpg,122,probabilité,12%,,1<br>Ex2: Ordinateur,hp.jpg,77,instant gagnant,,2017-07-07 12:12:12,2']]) ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> Importer',["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>