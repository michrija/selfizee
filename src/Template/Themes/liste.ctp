<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theme[]|\Cake\Collection\CollectionInterface $themes
 */
?>

<?php use Cake\Routing\Router; use Cake\Collection\Collection;?>

<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?= $this->Html->css('photos/popup_photo.css?v1_190213') ?>

<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->css('configuration-bornes/add.css?'.time(), ['block' => true]) ?>
<?= $this->Html->css('configuration-bornes/custom-mob.css?'.time(), ['block' => true]) ?>
<?= $this->Html->script('catalogues/add.js?'.time(), ['block' => true]) ?>

<?= $this->Html->css('ConfigBornes/tippy.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/tippy.js?'.time(), ['block' => true]); ?>

<?php
$titrePage = "Thèmes" ;
$this->assign('title', $titrePage);

?>

<div class="col-12">
    <div class="card card-new-selfizee">
			<div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left">Thèmes</h4>
                <?php
                    echo $this->Html->link(__('Ajouter un thème'),['action'=>'add', $client->id],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite pull-right" ]); 
                ?>
            </div>
			<div class="card-body">
                <?php if(!empty($themes->toArray())) {?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>    
                                <!--<th></th>-->                                            
                                <th class="text-nowrap">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>						                   
                            <?php foreach ($themes as $theme) { ?>
                                <tr>
                                    <td><?= $theme->nom ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'add', $theme->client_id, $theme->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $theme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $theme->id)]) ?>
                                    </td>
                                </tr>
                            <?php } ?>                                            
                        </tbody>
                    </table>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<< ' . __('first')) ?>
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                            <?= $this->Paginator->last(__('last') . ' >>') ?>
                        </ul>
                    </div>
                </div>
                <?php } else {?>
                    <p>Aucun thème.</p>
                <?php } ?>
			</div>
			
    </div>
</div>