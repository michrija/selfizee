<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Envois[]|\Cake\Collection\CollectionInterface $envois
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Envois'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="envois index large-9 medium-8 columns content">
    <h3><?= __('Envois') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('envoi_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_force_envoi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($envois as $envois): ?>
            <tr>
                <td><?= $this->Number->format($envois->id) ?></td>
                <td><?= $envois->has('contact') ? $this->Html->link($envois->contact->id, ['controller' => 'Contacts', 'action' => 'view', $envois->contact->id]) : '' ?></td>
                <td><?= h($envois->envoi_type) ?></td>
                <td><?= h($envois->is_force_envoi) ?></td>
                <td><?= h($envois->created) ?></td>
                <td><?= h($envois->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $envois->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $envois->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $envois->id], ['confirm' => __('Are you sure you want to delete # {0}?', $envois->id)]) ?>
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
