<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsSignaturesEmail $clientsSignaturesEmail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clients Signatures Email'), ['action' => 'edit', $clientsSignaturesEmail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clients Signatures Email'), ['action' => 'delete', $clientsSignaturesEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsSignaturesEmail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients Signatures Emails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clients Signatures Email'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientsSignaturesEmails view large-9 medium-8 columns content">
    <h3><?= h($clientsSignaturesEmail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $clientsSignaturesEmail->has('client') ? $this->Html->link($clientsSignaturesEmail->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsSignaturesEmail->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clientsSignaturesEmail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($clientsSignaturesEmail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($clientsSignaturesEmail->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Signature Email') ?></h4>
        <?= $this->Text->autoParagraph(h($clientsSignaturesEmail->signature_email)); ?>
    </div>
</div>
