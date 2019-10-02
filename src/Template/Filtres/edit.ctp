<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Filtre $filtre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $filtre->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $filtre->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Filtres'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="filtres form large-9 medium-8 columns content">
    <?= $this->Form->create($filtre) ?>
    <fieldset>
        <legend><?= __('Edit Filtre') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('filtre_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
