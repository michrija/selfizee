<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementPost $evenementPost
 */
?>

<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css', ['block' => true]) ?>
<?php echo  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js', ['block' => true]) ?>
<?= $this->Html->script('summernote/summernote-fr-FR.min.js', ['block' => true]); ?> 
<?= $this->Html->script('summernote/summernote-image-attributes.js', ['block' => true]); ?>
<?= $this->Html->script('summernote/fr-FR.js', ['block' => true]); ?>
<?= $this->Html->script('speackingurl/speakingurl.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>
<?= $this->Html->script('posts/post.js', ['block' => true]); ?>

<?php
$titrePage = "Création contenu" ;
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
    <div class="col-md-12">
        <div class="card card-new-selfizee" id="">
            <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($evenementPost, ['type' => 'file']) ?>
                    <div class="form-body">
                         <div class="col-md-12">
                            <?php
                                //echo $this->Form->control('evenement_id', ['options' => $evenements]);
                            ?>
                         </div>
                         <div class="col-md-12">
                            <?php
                                echo $this->Form->control('titre',['class'=>'form-control','label' => 'Titre *', 'id' => 'id_title']);
                                echo $this->Form->hidden('slug',['class'=>'', 'id' => 'id_slug']);
                            ?>
                         </div>
                         <div class="col-md-12">
                            <div id="img_name_content"></div>
                            <?php
                                echo $this->Form->control('contenus',['class'=>'textarea_editor','label' => 'Contenu *']);
                                
                            ?>
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