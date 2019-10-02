<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContenusEmail[]|\Cake\Collection\CollectionInterface $contenusEmails
 */
?>

<?php
$titrePage = "Paramétrage e-mails système" ;
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('contenu', 'Titre') ?></th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contenusEmails as $contenusEmail): ?>
                            <tr>
                                <td><?= $contenusEmail->titre ?></td>
                                <td>
                                    <?= $this->Html->link('Edit', ['action' => 'edit', $contenusEmail->id], ['escape'=>false]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contenusEmail->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
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