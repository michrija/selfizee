<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theme $theme
 */
?>
<?php use Cake\Routing\Router; ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->script('catalogues/catalogue_cadre.js', ['block' => true]); ?>

<?php

if($is_new) {
    $titrePage = "Créer un thème";
} else {
    $titrePage = "Modifier un thème";
}
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

//echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
?>

<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                <?php echo $this->Html->link(__('Liste des thèmes'),['action'=>'liste', $client->id],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite pull-right" ]); ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($theme, ['type' => 'file']) ?>
                    <?= $this->Form->control('client_id',['value'=>$client->id,'type'=>'hidden']) ?>
                    <div class="form-body">
                        <div class="col-md-12">
                            <?php
                                echo $this->Form->control('nom');
                            ?>                            
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



