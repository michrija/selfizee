<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filtre $filtre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Filtre'), ['action' => 'edit', $filtre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Filtre'), ['action' => 'delete', $filtre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filtre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Filtres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Filtre'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="filtres view large-9 medium-8 columns content">
    <h3><?= h($filtre->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($filtre->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($filtre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Filtre Type') ?></th>
            <td><?= $this->Number->format($filtre->filtre_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($filtre->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($filtre->modified) ?></td>
        </tr>
    </table>
</div>
