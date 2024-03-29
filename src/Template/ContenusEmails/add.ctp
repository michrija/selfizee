<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContenusEmail $contenusEmail
 */
?>
<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css', ['block' => true]) ?>
<?php echo  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js', ['block' => true]) ?>
<?= $this->Html->script('summernote/summernote-fr-FR.min.js', ['block' => true]); ?> 
<?= $this->Html->script('summernote/summernote-image-attributes.js', ['block' => true]); ?>
<?= $this->Html->script('summernote/fr-FR.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/acces.js', ['block' => true]); ?>

<?php
$titrePage = "Paramètrage e-mail système";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
?>

<div class="clearfix"></div>
<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create($contenusEmail, ['type' => 'file']) ?>
                <div class="form-body">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('titre',['class'=>'form-control','label' => 'Titre *:']);?>
                    </div>
                     <div class="col-md-12">
                        <?php echo $this->Form->control('contenu',['class'=>'textarea_editor','label' => 'Message type *:']);?>
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
