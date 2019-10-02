<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacebookAutoSuivi[]|\Cake\Collection\CollectionInterface $facebookAutoSuivis
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Facebook Auto Suivi'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Facebook Autos'), ['controller' => 'FacebookAutos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facebook Auto'), ['controller' => 'FacebookAutos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facebookAutoSuivis index large-9 medium-8 columns content">
    <h3><?= __('Facebook Auto Suivis') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('facebook_auto_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('photo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modifed') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facebookAutoSuivis as $facebookAutoSuivi): ?>
            <tr>
                <td><?= $this->Number->format($facebookAutoSuivi->id) ?></td>
                <td><?= $facebookAutoSuivi->has('facebook_auto') ? $this->Html->link($facebookAutoSuivi->facebook_auto->id, ['controller' => 'FacebookAutos', 'action' => 'view', $facebookAutoSuivi->facebook_auto->id]) : '' ?></td>
                <td><?= $facebookAutoSuivi->has('photo') ? $this->Html->link($facebookAutoSuivi->photo->name, ['controller' => 'Photos', 'action' => 'view', $facebookAutoSuivi->photo->id]) : '' ?></td>
                <td><?= h($facebookAutoSuivi->created) ?></td>
                <td><?= h($facebookAutoSuivi->modifed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $facebookAutoSuivi->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $facebookAutoSuivi->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $facebookAutoSuivi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facebookAutoSuivi->id)]) ?>
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
