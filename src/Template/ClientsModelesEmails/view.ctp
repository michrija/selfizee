<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsModelesEmail $clientsModelesEmail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clients Modeles Email'), ['action' => 'edit', $clientsModelesEmail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clients Modeles Email'), ['action' => 'delete', $clientsModelesEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsModelesEmail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients Modeles Emails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clients Modeles Email'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientsModelesEmails view large-9 medium-8 columns content">
    <h3><?= h($clientsModelesEmail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Modele') ?></th>
            <td><?= h($clientsModelesEmail->nom_modele) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Expediteur') ?></th>
            <td><?= h($clientsModelesEmail->email_expediteur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Expediteur') ?></th>
            <td><?= h($clientsModelesEmail->nom_expediteur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $clientsModelesEmail->has('client') ? $this->Html->link($clientsModelesEmail->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsModelesEmail->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clientsModelesEmail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($clientsModelesEmail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($clientsModelesEmail->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Photo En Pj') ?></th>
            <td><?= $clientsModelesEmail->is_photo_en_pj ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Objet') ?></h4>
        <?= $this->Text->autoParagraph(h($clientsModelesEmail->objet)); ?>
    </div>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($clientsModelesEmail->content)); ?>
    </div>
</div>
