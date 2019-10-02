<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigurationAnimation $configurationAnimation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $configurationAnimation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $configurationAnimation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Configuration Animations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Disposition Vignettes'), ['controller' => 'DispositionVignettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Disposition Vignette'), ['controller' => 'DispositionVignettes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configurationAnimations form large-9 medium-8 columns content">
    <?= $this->Form->create($configurationAnimation) ?>
    <fieldset>
        <legend><?= __('Edit Configuration Animation') ?></legend>
        <?php
            echo $this->Form->control('type_cadre');
            echo $this->Form->control('nbr_pose');
            echo $this->Form->control('disposition_vignette_id', ['options' => $dispositionVignettes, 'empty' => true]);
            echo $this->Form->control('configuration_borne_id', ['options' => $configurationBornes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
