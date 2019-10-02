<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RsConfiguration[]|\Cake\Collection\CollectionInterface $rsConfigurations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rs Configuration'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rsConfigurations index large-9 medium-8 columns content">
    <h3><?= __('Rs Configurations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hashtag_twitter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rsConfigurations as $rsConfiguration): ?>
            <tr>
                <td><?= $this->Number->format($rsConfiguration->id) ?></td>
                <td><?= h($rsConfiguration->hashtag_twitter) ?></td>
                <td><?= h($rsConfiguration->created) ?></td>
                <td><?= h($rsConfiguration->modified) ?></td>
                <td><?= $rsConfiguration->has('evenement') ? $this->Html->link($rsConfiguration->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $rsConfiguration->evenement->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rsConfiguration->int]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rsConfiguration->int]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rsConfiguration->int], ['confirm' => __('Are you sure you want to delete # {0}?', $rsConfiguration->int)]) ?>
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
