<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OptionBorne[]|\Cake\Collection\CollectionInterface $optionBornes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Option Borne'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="optionBornes index large-9 medium-8 columns content">
    <h3><?= __('Option Bornes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ftp_server') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ftp_password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ftp_port') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($optionBornes as $optionBorne): ?>
            <tr>
                <td><?= $this->Number->format($optionBorne->id) ?></td>
                <td><?= h($optionBorne->ftp_server) ?></td>
                <td><?= h($optionBorne->ftp_password) ?></td>
                <td><?= h($optionBorne->ftp_port) ?></td>
                <td><?= h($optionBorne->created) ?></td>
                <td><?= h($optionBorne->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $optionBorne->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $optionBorne->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $optionBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $optionBorne->id)]) ?>
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
