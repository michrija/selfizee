<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cron $cron
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cron->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cron->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Crons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Intervalles'), ['controller' => 'Intervalles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Intervalle'), ['controller' => 'Intervalles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="crons form large-9 medium-8 columns content">
    <?= $this->Form->create($cron) ?>
    <fieldset>
        <legend><?= __('Edit Cron') ?></legend>
        <?php
            echo $this->Form->control('is_active');
            echo $this->Form->control('is_cron_email');
            echo $this->Form->control('is_cron_sms');
            echo $this->Form->control('date_debut');
            echo $this->Form->control('date_fin');
            echo $this->Form->control('evenement_id', ['options' => $evenements]);
            echo $this->Form->control('intervalle_id', ['options' => $intervalles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
