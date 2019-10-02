<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CatalogueCadre $catalogueCadre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $catalogueCadre->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $catalogueCadre->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Catalogue Cadres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Formats'), ['controller' => 'Formats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Format'), ['controller' => 'Formats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Catalogue Cadre Themes'), ['controller' => 'CatalogueCadreThemes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Catalogue Cadre Theme'), ['controller' => 'CatalogueCadreThemes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="catalogueCadres form large-9 medium-8 columns content">
    <?= $this->Form->create($catalogueCadre) ?>
    <fieldset>
        <legend><?= __('Edit Catalogue Cadre') ?></legend>
        <?php
            echo $this->Form->control('titre');
            echo $this->Form->control('file_name');
            echo $this->Form->control('nom_origine');
            echo $this->Form->control('chemin');
            echo $this->Form->control('nbr_pose');
            echo $this->Form->control('type_cadre');
            echo $this->Form->control('format_id', ['options' => $formats, 'empty' => true]);
            echo $this->Form->control('evenement_id', ['options' => $evenements, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
