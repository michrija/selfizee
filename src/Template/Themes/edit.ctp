<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theme $theme
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $theme->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $theme->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Themes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Image Fonds'), ['controller' => 'ImageFonds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image Fond'), ['controller' => 'ImageFonds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="themes form large-9 medium-8 columns content">
    <?= $this->Form->create($theme) ?>
    <fieldset>
        <legend><?= __('Edit Theme') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('description');
            echo $this->Form->control('client_id');
            echo $this->Form->control('user_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
