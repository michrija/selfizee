<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeImprimante[]|\Cake\Collection\CollectionInterface $typeImprimantes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="typeImprimantes index large-9 medium-8 columns content">
    <h3><?= __('Type Imprimantes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($typeImprimantes as $typeImprimante): ?>
            <tr>
                <td><?= $this->Number->format($typeImprimante->id) ?></td>
                <td><?= h($typeImprimante->nom) ?></td>
                <td><?= h($typeImprimante->created) ?></td>
                <td><?= h($typeImprimante->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $typeImprimante->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $typeImprimante->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $typeImprimante->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeImprimante->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
