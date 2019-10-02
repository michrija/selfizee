<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactToSendManuel[]|\Cake\Collection\CollectionInterface $contactToSendManuels
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Contact To Send Manuel'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Envoi Manuels'), ['controller' => 'EnvoiManuels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Envoi Manuel'), ['controller' => 'EnvoiManuels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contactToSendManuels index large-9 medium-8 columns content">
    <h3><?= __('Contact To Send Manuels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('envoi_manuel_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactToSendManuels as $contactToSendManuel): ?>
            <tr>
                <td><?= $this->Number->format($contactToSendManuel->id) ?></td>
                <td><?= $contactToSendManuel->has('contact') ? $this->Html->link($contactToSendManuel->contact->id, ['controller' => 'Contacts', 'action' => 'view', $contactToSendManuel->contact->id]) : '' ?></td>
                <td><?= $contactToSendManuel->has('envoi_manuel') ? $this->Html->link($contactToSendManuel->envoi_manuel->id, ['controller' => 'EnvoiManuels', 'action' => 'view', $contactToSendManuel->envoi_manuel->id]) : '' ?></td>
                <td><?= h($contactToSendManuel->created) ?></td>
                <td><?= h($contactToSendManuel->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contactToSendManuel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactToSendManuel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactToSendManuel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactToSendManuel->id)]) ?>
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
