<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeChamp[]|\Cake\Collection\CollectionInterface $typeChamps
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Type Champ'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="typeChamps index large-9 medium-8 columns content">
    <h3><?= __('Type Champs') ?></h3>
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
            <?php foreach ($typeChamps as $typeChamp): ?>
            <tr>
                <td><?= $this->Number->format($typeChamp->id) ?></td>
                <td><?= h($typeChamp->nom) ?></td>
                <td><?= h($typeChamp->created) ?></td>
                <td><?= h($typeChamp->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $typeChamp->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $typeChamp->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $typeChamp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeChamp->id)]) ?>
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
