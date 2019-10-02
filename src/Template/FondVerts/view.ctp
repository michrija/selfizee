<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FondVert $fondVert
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fond Vert'), ['action' => 'edit', $fondVert->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fond Vert'), ['action' => 'delete', $fondVert->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fondVert->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fondVerts view large-9 medium-8 columns content">
    <h3><?= h($fondVert->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($fondVert->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Configuration Borne') ?></th>
            <td><?= $fondVert->has('configuration_borne') ? $this->Html->link($fondVert->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $fondVert->configuration_borne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fondVert->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordre') ?></th>
            <td><?= $this->Number->format($fondVert->ordre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($fondVert->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($fondVert->modified) ?></td>
        </tr>
    </table>
</div>
