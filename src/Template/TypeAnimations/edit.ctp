<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeAnimation $typeAnimation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typeAnimation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typeAnimation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Type Animations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="typeAnimations form large-9 medium-8 columns content">
    <?= $this->Form->create($typeAnimation) ?>
    <fieldset>
        <legend><?= __('Edit Type Animation') ?></legend>
        <?php
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
