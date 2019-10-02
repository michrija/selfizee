<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Catalogue $catalogue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $catalogue->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $catalogue->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Catalogues'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Config Bornes'), ['controller' => 'ConfigBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Config Borne'), ['controller' => 'ConfigBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="catalogues form large-9 medium-8 columns content">
    <?= $this->Form->create($catalogue) ?>
    <fieldset>
        <legend><?= __('Edit Catalogue') ?></legend>
        <?php
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
