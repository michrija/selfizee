<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lot $lot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lot'), ['action' => 'edit', $lot->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lot'), ['action' => 'delete', $lot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lot->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lots'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lot'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lots view large-9 medium-8 columns content">
    <h3><?= h($lot->id) ?></h3>
<div class="table-responsive">
    <table class="table">
     <thead>
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($lot->nom) ?></td>
        </tr>
       </thead>
       <thead>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($lot->photo) ?></td>
        </tr>
    </thead>
    <thead>
        <tr>
            <th scope="row"><?= __('Type Gain') ?></th>
            <td><?= h($lot->type_gain) ?></td>
        </tr>
    </thead>
    <thead>
        <tr>
            <th scope="row"><?= __('Probabilite Gain') ?></th>
            <td><?= h($lot->probabilite_gain) ?></td>
        </tr>
    </thead>
    <thead>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lot->id) ?></td>
        </tr>
    </thead>
    <thead>
        <tr>
            <th scope="row"><?= __('Quantite') ?></th>
            <td><?= $this->Number->format($lot->quantite) ?></td>
        </tr>
    </thead>
    </thead>
        <tr>
            <th scope="row"><?= __('Date Deb Gain') ?></th>
            <td><?= h($lot->date_deb_gain) ?></td>
        </tr>
    </thead>
    </table>
</div>
</div>
