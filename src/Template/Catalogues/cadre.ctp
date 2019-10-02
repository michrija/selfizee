<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Catalogue $catalogue
 */
?>
<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->script('catalogues/add.js', ['block' => true]); ?>

<?php
$titrePage = "Ajout cadre catalogue";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
?>

<style>
.btn_suppr_bloc, .btn_suppr_bloc_edit {
    background: #e72763 url(/img/gallery/dz_rm.png) no-repeat scroll 6px 6px;
    border-radius: 25px;
    width: 30px;
    height: 30px;
}
</style>

<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($cadre_catalogue, ['type' => 'file']) ?>
                    <?= $this->Form->control('evenement_id',['value'=>$evenement->id,'type'=>'hidden']) ?>
                    <?= $this->Form->control('type',['value'=>'cadre','type'=>'hidden']) ?>
                    <div class="form-body">
                        <div class="col-md-12">
                            <?php          
                                    echo $this->Form->control('catalogue_id', ['options'=> $catalogues, 'empty'=> 'Séléctionner', 'required' => true]);
                                    echo $this->Form->control('theme_id', ['options'=> $themes, 'empty'=> 'Séléctionner', 'required' => true]);
                                    echo $this->Form->control('format_id', ['options'=> $formats,'empty'=> 'Séléctionner', 'required' => true]);                
                            ?>
                        </div>

                        <div class="col-md-12 bloc_image_fond_cadre">
                            <?php $url_fond = null;
                                if(!$is_new) {
                                    $url_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/image_fonds/'.$cadre_catalogue->file_name;
                                } 
                            ?>
                            <div class="row ">
                                <div class="col-md-4 bloc_fond" >                                
                                    <div class="cf_blocDropify">
                                        <input  type="file" name="image_fonds_cadre" class="dropify_image_fond" accept=".jpg, .jpeg" data-default-file="<?= $url_fond ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><br>
                    <div class="form-actions">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

