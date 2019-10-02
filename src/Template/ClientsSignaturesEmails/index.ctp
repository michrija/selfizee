<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsSignaturesEmail[]|\Cake\Collection\CollectionInterface $clientsSignaturesEmails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Clients Signatures Email'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientsSignaturesEmails index large-9 medium-8 columns content">
    <h3><?= __('Clients Signatures Emails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientsSignaturesEmails as $clientsSignaturesEmail): ?>
            <tr>
                <td><?= $this->Number->format($clientsSignaturesEmail->id) ?></td>
                <td><?= $clientsSignaturesEmail->has('client') ? $this->Html->link($clientsSignaturesEmail->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsSignaturesEmail->client->id]) : '' ?></td>
                <td><?= h($clientsSignaturesEmail->created) ?></td>
                <td><?= h($clientsSignaturesEmail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $clientsSignaturesEmail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientsSignaturesEmail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientsSignaturesEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsSignaturesEmail->id)]) ?>
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
