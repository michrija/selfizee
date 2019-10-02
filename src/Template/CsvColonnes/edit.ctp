<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CsvColonne $csvColonne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $csvColonne->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $csvColonne->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Csv Colonnes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Csv Colonne Positions'), ['controller' => 'CsvColonnePositions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Csv Colonne Position'), ['controller' => 'CsvColonnePositions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="csvColonnes form large-9 medium-8 columns content">
    <?= $this->Form->create($csvColonne) ?>
    <fieldset>
        <legend><?= __('Edit Csv Colonne') ?></legend>
        <?php
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
