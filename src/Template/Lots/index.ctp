<?php
$titrePage = "Liste des Lots" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Lots', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Créer'),['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
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
                        echo $this->Form->control('cle',['value'=>$cle, 'label'=>false, 'class'=>'form-control search','placeholder'=>'Rechercher...']);
                        echo $this->Form->button('<i class="fa fa-search"></i> Rechercher', ['label' => false ,'class' => 'btn btn-primary'] );
                        echo $this->Form->end();
                          ?>
                        </div>
                </div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Quantite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Type de gain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Probabilite de gain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date du debut de gain') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lots as $lot): ?>
            <tr>
                <td><?= $this->Number->format($lot->id) ?></td>
                <td><?= h($lot->nom) ?></td>
                <td><?= h($lot->photo) ?></td>
                <td><?= $this->Number->format($lot->quantite) ?></td>
                <td><?= h($lot->type_gain) ?></td>
                <td><?= h($lot->probabilite_gain) ?></td>
                <td><?= h($lot->date_deb_gain) ?></td>
                <td class="actions">
                    <?= $this->Html->link('Editer', ['action' => 'edit', $lot->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lot->id)]) ?>                    
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
        <!--<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>-->
    </div>
</div>
</div>
</div>
</div>
