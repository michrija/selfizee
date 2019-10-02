<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cadre $cadre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cadre'), ['action' => 'edit', $cadre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cadre'), ['action' => 'delete', $cadre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cadre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cadres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cadre'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cadres view large-9 medium-8 columns content">
    <h3><?= h($cadre->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($cadre->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Configuration Borne') ?></th>
            <td><?= $cadre->has('configuration_borne') ? $this->Html->link($cadre->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $cadre->configuration_borne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cadre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordre') ?></th>
            <td><?= $this->Number->format($cadre->ordre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cadre->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cadre->modified) ?></td>
        </tr>
    </table>
</div>
