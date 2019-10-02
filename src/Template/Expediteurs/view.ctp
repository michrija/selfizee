<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expediteur $expediteur
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expediteur'), ['action' => 'edit', $expediteur->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expediteur'), ['action' => 'delete', $expediteur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expediteur->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expediteurs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expediteur'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expediteurs view large-9 medium-8 columns content">
    <h3><?= h($expediteur->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($expediteur->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $expediteur->has('client') ? $this->Html->link($expediteur->client->id, ['controller' => 'Clients', 'action' => 'view', $expediteur->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expediteur->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($expediteur->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($expediteur->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Create In Mailjet') ?></th>
            <td><?= $expediteur->is_create_in_mailjet ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Validate Sent In Mailjet') ?></th>
            <td><?= $expediteur->is_validate_sent_in_mailjet ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
