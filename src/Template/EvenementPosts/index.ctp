<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementPost[]|\Cake\Collection\CollectionInterface $evenementPosts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evenement Post'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evenementPosts index large-9 medium-8 columns content">
    <h3><?= __('Evenement Posts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evenementPosts as $evenementPost): ?>
            <tr>
                <td><?= $this->Number->format($evenementPost->id) ?></td>
                <td><?= $evenementPost->has('evenement') ? $this->Html->link($evenementPost->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $evenementPost->evenement->id]) : '' ?></td>
                <td><?= h($evenementPost->titre) ?></td>
                <td><?= h($evenementPost->created) ?></td>
                <td><?= h($evenementPost->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evenementPost->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evenementPost->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evenementPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evenementPost->id)]) ?>
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
