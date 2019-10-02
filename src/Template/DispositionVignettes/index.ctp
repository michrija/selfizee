<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DispositionVignette[]|\Cake\Collection\CollectionInterface $dispositionVignettes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Disposition Vignette'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dispositionVignettes index large-9 medium-8 columns content">
    <h3><?= __('Disposition Vignettes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dispositionVignettes as $dispositionVignette): ?>
            <tr>
                <td><?= $this->Number->format($dispositionVignette->id) ?></td>
                <td><?= h($dispositionVignette->nom) ?></td>
                <td><?= h($dispositionVignette->file_name) ?></td>
                <td><?= h($dispositionVignette->created) ?></td>
                <td><?= h($dispositionVignette->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dispositionVignette->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dispositionVignette->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dispositionVignette->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dispositionVignette->id)]) ?>
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
