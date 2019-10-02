<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\ModelBorne[]|\Cake\Collection\CollectionInterface $credits
*/
?>

<!-- Footable -->
<?= $this->Html->script('footable/footable.all.min.js', ['block' => true]); ?>
<!--FooTable init-->
<?= $this->Html->script('footable-init.js', ['block' => true]); ?>
    
<?php
$titrePage = "Liste des demandes de credit" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>
<div class="row">
    <div class="col-12">
        <!--<div class="kl_filtreEvenement pb-3">
           <?php
            echo $this->Form->create(null, ['type' => 'get' ,'class'=>'form-inline','role'=>'form']);
            echo $this->Form->control('key',['value'=>$key, 'label'=>false, 'class'=>'form-control search m-r-10 m-l-10','placeholder'=>'Rechercher...']);

            echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-primary m-r-10'] );
            echo $this->Html->link('<i class="fa fa-refresh"></i>', ['action' => 'index'], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"m-r-10 btn btn-success", "escape"=>false]);

            echo $this->Form->end();
            ?>
        </div>-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Client') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Crédits') ?></th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($credits as $credit): ?>
                                    <td><?= $credit->client->nom ?></td>
                					<td><?= $this->Number->format($credit->credit) ?></td>
                                    <td>
                                    	<?php echo $this->Html->link('<i class="mdi mdi-lock-open"></i> Valider ','#',['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'' ]); ?>
                                    </td>
                                </tr>
                             <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="text-right">
                                        <ul class="pagination">
                                            <?= $this->Paginator->first('<< ' . __('first')) ?>
                                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                            <?= $this->Paginator->numbers() ?>
                                            <?= $this->Paginator->next(__('next') . ' >') ?>
                                            <?= $this->Paginator->last(__('last') . ' >>') ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
