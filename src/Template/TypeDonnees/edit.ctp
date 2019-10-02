<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeDonnee $typeDonnee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typeDonnee->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typeDonnee->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Type Donnees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="typeDonnees form large-9 medium-8 columns content">
    <?= $this->Form->create($typeDonnee) ?>
    <fieldset>
        <legend><?= __('Edit Type Donnee') ?></legend>
        <?php
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
