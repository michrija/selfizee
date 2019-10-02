<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigurationAnimation $configurationAnimation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuration Animation'), ['action' => 'edit', $configurationAnimation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuration Animation'), ['action' => 'delete', $configurationAnimation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configurationAnimation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Animations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Animation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Disposition Vignettes'), ['controller' => 'DispositionVignettes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Disposition Vignette'), ['controller' => 'DispositionVignettes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configurationAnimations view large-9 medium-8 columns content">
    <h3><?= h($configurationAnimation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Disposition Vignette') ?></th>
            <td><?= $configurationAnimation->has('disposition_vignette') ? $this->Html->link($configurationAnimation->disposition_vignette->id, ['controller' => 'DispositionVignettes', 'action' => 'view', $configurationAnimation->disposition_vignette->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Configuration Borne') ?></th>
            <td><?= $configurationAnimation->has('configuration_borne') ? $this->Html->link($configurationAnimation->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $configurationAnimation->configuration_borne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($configurationAnimation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Cadre') ?></th>
            <td><?= $this->Number->format($configurationAnimation->type_cadre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Pose') ?></th>
            <td><?= $this->Number->format($configurationAnimation->nbr_pose) ?></td>
        </tr>
    </table>
</div>
