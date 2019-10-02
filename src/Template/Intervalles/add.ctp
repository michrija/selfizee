<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Intervalle $intervalle
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Intervalles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Crons'), ['controller' => 'Crons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cron'), ['controller' => 'Crons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="intervalles form large-9 medium-8 columns content">
    <?= $this->Form->create($intervalle) ?>
    <fieldset>
        <legend><?= __('Add Intervalle') ?></legend>
        <?php
            echo $this->Form->control('intervalle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
