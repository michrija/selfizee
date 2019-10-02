<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsModelesSms $clientsModelesSms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clients Modeles Sms'), ['action' => 'edit', $clientsModelesSms->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clients Modeles Sms'), ['action' => 'delete', $clientsModelesSms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsModelesSms->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients Modeles Smss'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clients Modeles Sms'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientsModelesSmss view large-9 medium-8 columns content">
    <h3><?= h($clientsModelesSms->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Modele') ?></th>
            <td><?= h($clientsModelesSms->nom_modele) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expediteur') ?></th>
            <td><?= h($clientsModelesSms->expediteur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $clientsModelesSms->has('client') ? $this->Html->link($clientsModelesSms->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsModelesSms->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clientsModelesSms->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nb Caractere') ?></th>
            <td><?= $this->Number->format($clientsModelesSms->nb_caractere) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Sms') ?></th>
            <td><?= $this->Number->format($clientsModelesSms->nbr_sms) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($clientsModelesSms->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($clientsModelesSms->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contenu') ?></h4>
        <?= $this->Text->autoParagraph(h($clientsModelesSms->contenu)); ?>
    </div>
</div>
