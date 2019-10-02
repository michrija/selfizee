<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DispositionVignette $dispositionVignette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Disposition Vignettes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dispositionVignettes form large-9 medium-8 columns content">
    <?= $this->Form->create($dispositionVignette) ?>
    <fieldset>
        <legend><?= __('Add Disposition Vignette') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('file_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
