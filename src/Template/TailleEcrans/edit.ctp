<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TailleEcran $tailleEcran
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tailleEcran->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tailleEcran->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Taille Ecrans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tailleEcrans form large-9 medium-8 columns content">
    <?= $this->Form->create($tailleEcran) ?>
    <fieldset>
        <legend><?= __('Edit Taille Ecran') ?></legend>
        <?php
            echo $this->Form->control('valeur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
