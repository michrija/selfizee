<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Champ $champ
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $champ->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $champ->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Type Champs'), ['controller' => 'TypeChamps', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Champ'), ['controller' => 'TypeChamps', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Donnees'), ['controller' => 'TypeDonnees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Donnee'), ['controller' => 'TypeDonnees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="champs form large-9 medium-8 columns content">
    <?= $this->Form->create($champ) ?>
    <fieldset>
        <legend><?= __('Edit Champ') ?></legend>
        <?php
            echo $this->Form->control('type_champ_id', ['options' => $typeChamps]);
            echo $this->Form->control('nom');
            echo $this->Form->control('type_donnee_id', ['options' => $typeDonnees, 'empty' => true]);
            echo $this->Form->control('ordre');
            echo $this->Form->control('configuration_borne_id', ['options' => $configurationBornes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
