<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filtre[]|\Cake\Collection\CollectionInterface $filtres
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Filtre'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="filtres index large-9 medium-8 columns content">
    <h3><?= __('Filtres') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('filtre_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filtres as $filtre): ?>
            <tr>
                <td><?= $this->Number->format($filtre->id) ?></td>
                <td><?= h($filtre->nom) ?></td>
                <td><?= $this->Number->format($filtre->filtre_type) ?></td>
                <td><?= h($filtre->created) ?></td>
                <td><?= h($filtre->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $filtre->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $filtre->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $filtre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filtre->id)]) ?>
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
