<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeImprimante $typeImprimante
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typeImprimante->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typeImprimante->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="typeImprimantes form large-9 medium-8 columns content">
    <?= $this->Form->create($typeImprimante) ?>
    <fieldset>
        <legend><?= __('Edit Type Imprimante') ?></legend>
        <?php
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
