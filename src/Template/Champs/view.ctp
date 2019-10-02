<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Champ $champ
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Champ'), ['action' => 'edit', $champ->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Champ'), ['action' => 'delete', $champ->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champ->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Champs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champ'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type Champs'), ['controller' => 'TypeChamps', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Champ'), ['controller' => 'TypeChamps', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type Donnees'), ['controller' => 'TypeDonnees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Donnee'), ['controller' => 'TypeDonnees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="champs view large-9 medium-8 columns content">
    <h3><?= h($champ->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type Champ') ?></th>
            <td><?= $champ->has('type_champ') ? $this->Html->link($champ->type_champ->id, ['controller' => 'TypeChamps', 'action' => 'view', $champ->type_champ->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($champ->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Donnee') ?></th>
            <td><?= $champ->has('type_donnee') ? $this->Html->link($champ->type_donnee->id, ['controller' => 'TypeDonnees', 'action' => 'view', $champ->type_donnee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Configuration Borne') ?></th>
            <td><?= $champ->has('configuration_borne') ? $this->Html->link($champ->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $champ->configuration_borne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($champ->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordre') ?></th>
            <td><?= $this->Number->format($champ->ordre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($champ->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($champ->modified) ?></td>
        </tr>
    </table>
</div>
