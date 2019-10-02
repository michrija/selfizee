<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Catalogue[]|\Cake\Collection\CollectionInterface $catalogueCadres
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
$titrePage = "Catalogue de cadre" ;
$this->assign('title', $titrePage);

?>

<div class="col-12">
    <div class="card card-new-selfizee">
			<div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left">Catalogue de cadre</h4>
                <?php
                    echo $this->Html->link(__('Ajouter un modèle'),['action'=>'add', $client->id],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite pull-right" ]); 
                ?>
            </div>
			<div class="card-body">
                <?php if(!empty($catalogueCadres->toArray())) {?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre</th>  
                                <th>Thème(s)</th>  
                                <!--<th>Format</th>-->                                            
                                <th class="text-nowrap">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>						                   
                            <?php foreach ($catalogueCadres as $catalogue_cadre) { ?>
                                <?php $url_aperc = Router::url('/', true).'import/config_bornes/cadre_catalogue/'.$client->id.'/'.$catalogue_cadre->file_name;
                                    
                                    $collection = new Collection($catalogue_cadre->themes);
                                    $themes = $collection->extract('nom');
                                    $themes = $themes->toList();
                                    ?>
                                <tr>
                                    <td><?php echo $this->Html->link($this->Html->image($url_aperc,['width'=>60])."  ".$catalogue_cadre->titre,['controller' => 'ConfigurationBornes','action' => 'viewCatalogueCadre', $catalogue_cadre->id],['escape'=>false,"class"=>"kl_viewTheme  text-muted" ]);  ?></td>
                                    <td><?php if(!empty($catalogue_cadre->themes)) echo implode(', ', $themes) ?></td>
                                    <!--<td><?php if($catalogue_cadre->format) echo($catalogue_cadre->format->nom) ?></td> --> 
                                    <td class="actions">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'add', $catalogue_cadre->client_id, $catalogue_cadre->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $catalogue_cadre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $catalogue_cadre->id)]) ?>
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
                    <p>Aucun modèle de cadre.</p>
                <?php } ?>
			</div>
			
    </div>
</div>