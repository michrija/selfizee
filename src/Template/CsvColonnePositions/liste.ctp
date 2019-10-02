<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\ModelBorne[]|\Cake\Collection\CollectionInterface $modelBornes
*/
?>

    
<?php
$titrePage = "Configuration de colones du csv " ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Dashboards', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i>'.__("Create"),['action'=>'add',$evenement->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);                           
$this->end();

?>
<div class="row">
    <div class="col-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black"><?= $titrePage ?> </h4>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                         <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('csv_colonne_id','Nom de la colonne') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('position') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($csvColonnePositions as $csvColonnePosition): ?>
                            <tr>
                                <td><?= $csvColonnePosition->has('csv_colonne') ? $this->Html->link($csvColonnePosition->csv_colonne->nom, ['controller' => 'CsvColonnes', 'action' => 'view', $csvColonnePosition->csv_colonne->id]) : '' ?></td>
                                <td><?= $this->Number->format($csvColonnePosition->position) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit',$csvColonnePosition->evenement_id, $csvColonnePosition->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $csvColonnePosition->evenement_id, $csvColonnePosition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $csvColonnePosition->id)]) ?>
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
