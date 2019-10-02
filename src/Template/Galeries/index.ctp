<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement[]|\Cake\Collection\CollectionInterface $evenements
 */
?>


<?php
$titrePage = "Liste des galeries" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
$this->end();

?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-body">
                      <div class="row">
                       <?php
                        echo $this->Form->create(null, ['type' => 'get' ,'class'=>'form-inline','role'=>'form']);
                        echo $this->Form->control('key',['value'=>$key, 'label'=>false, 'class'=>'form-control search','placeholder'=>'Rechercher...']);
                        echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-primary'] );
                        echo $this->Html->link('<i class="fa fa-refresh"></i>', ['action' => 'index'], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-success", "escape"=>false]);

                        echo $this->Form->end();
                          ?>
                        </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('nom', 'Nom') ?></th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($galeries as $galery): ?>
                            <tr>
                                <td><?= $this->Html->link($galery->nom, ['action' => 'edit', $galery->id]) ?></td>
                                <td>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $galery->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
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