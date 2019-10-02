<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cadre $cadre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cadres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cadres form large-9 medium-8 columns content">
    <?= $this->Form->create($cadre) ?>
    <fieldset>
        <legend><?= __('Add Cadre') ?></legend>
        <?php
            echo $this->Form->control('file_name');
            echo $this->Form->control('ordre');
            echo $this->Form->control('configuration_borne_id', ['options' => $configurationBornes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
