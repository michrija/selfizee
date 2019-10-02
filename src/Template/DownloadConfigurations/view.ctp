<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DownloadConfiguration $downloadConfiguration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Download Configuration'), ['action' => 'edit', $downloadConfiguration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Download Configuration'), ['action' => 'delete', $downloadConfiguration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $downloadConfiguration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Download Configurations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Download Configuration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="downloadConfigurations view large-9 medium-8 columns content">
    <h3><?= h($downloadConfiguration->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $downloadConfiguration->has('evenement') ? $this->Html->link($downloadConfiguration->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $downloadConfiguration->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($downloadConfiguration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Oblig Ajout Infos Av Down') ?></th>
            <td><?= $downloadConfiguration->is_oblig_ajout_infos_av_down ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
