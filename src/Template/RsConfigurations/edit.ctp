<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RsConfiguration $rsConfiguration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rsConfiguration->int],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rsConfiguration->int)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rs Configurations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rsConfigurations form large-9 medium-8 columns content">
    <?= $this->Form->create($rsConfiguration) ?>
    <fieldset>
        <legend><?= __('Edit Rs Configuration') ?></legend>
        <?php
            echo $this->Form->control('id');
            echo $this->Form->control('desc_facebook');
            echo $this->Form->control('desc_twiter');
            echo $this->Form->control('hashtag_twitter');
            echo $this->Form->control('evenement_id', ['options' => $evenements]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
