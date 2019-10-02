<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeEvenement $typeEvenement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Type Evenement'), ['action' => 'edit', $typeEvenement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type Evenement'), ['action' => 'delete', $typeEvenement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeEvenement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Type Evenements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Evenement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="typeEvenements view large-9 medium-8 columns content">
    <h3><?= h($typeEvenement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($typeEvenement->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $typeEvenement->has('client') ? $this->Html->link($typeEvenement->client->id, ['controller' => 'Clients', 'action' => 'view', $typeEvenement->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($typeEvenement->id) ?></td>
        </tr>
    </table>
</div>
