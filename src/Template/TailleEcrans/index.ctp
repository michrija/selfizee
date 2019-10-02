<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TailleEcran[]|\Cake\Collection\CollectionInterface $tailleEcrans
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Taille Ecran'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tailleEcrans index large-9 medium-8 columns content">
    <h3><?= __('Taille Ecrans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valeur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tailleEcrans as $tailleEcran): ?>
            <tr>
                <td><?= $this->Number->format($tailleEcran->id) ?></td>
                <td><?= h($tailleEcran->valeur) ?></td>
                <td><?= h($tailleEcran->created) ?></td>
                <td><?= h($tailleEcran->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tailleEcran->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tailleEcran->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tailleEcran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tailleEcran->id)]) ?>
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
