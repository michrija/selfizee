<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CsvColonnePosition $csvColonnePosition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Csv Colonne Position'), ['action' => 'edit', $csvColonnePosition->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Csv Colonne Position'), ['action' => 'delete', $csvColonnePosition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $csvColonnePosition->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Csv Colonne Positions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Csv Colonne Position'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Csv Colonnes'), ['controller' => 'CsvColonnes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Csv Colonne'), ['controller' => 'CsvColonnes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="csvColonnePositions view large-9 medium-8 columns content">
    <h3><?= h($csvColonnePosition->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Csv Colonne') ?></th>
            <td><?= $csvColonnePosition->has('csv_colonne') ? $this->Html->link($csvColonnePosition->csv_colonne->id, ['controller' => 'CsvColonnes', 'action' => 'view', $csvColonnePosition->csv_colonne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $csvColonnePosition->has('evenement') ? $this->Html->link($csvColonnePosition->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $csvColonnePosition->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($csvColonnePosition->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= $this->Number->format($csvColonnePosition->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($csvColonnePosition->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($csvColonnePosition->modified) ?></td>
        </tr>
    </table>
</div>
