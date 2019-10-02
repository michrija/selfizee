<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fonctionnalite $fonctionnalite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fonctionnalites'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Fonctionalite Evenements'), ['controller' => 'FonctionaliteEvenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fonctionalite Evenement'), ['controller' => 'FonctionaliteEvenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fonctionnalites form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnalite) ?>
    <fieldset>
        <legend><?= __('Add Fonctionnalite') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('description');
            echo $this->Form->control('texte_helper');
            echo $this->Form->control('titre_link');
            echo $this->Form->control('link');
            echo $this->Form->control('ordre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
