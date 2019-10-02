<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeChamp $typeChamp
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Type Champs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="typeChamps form large-9 medium-8 columns content">
    <?= $this->Form->create($typeChamp) ?>
    <fieldset>
        <legend><?= __('Add Type Champ') ?></legend>
        <?php
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
