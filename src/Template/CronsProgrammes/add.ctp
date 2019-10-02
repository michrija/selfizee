<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CronsProgramme $cronsProgramme
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Crons Programmes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cronsProgrammes form large-9 medium-8 columns content">
    <?= $this->Form->create($cronsProgramme) ?>
    <fieldset>
        <legend><?= __('Add Crons Programme') ?></legend>
        <?php
            echo $this->Form->control('is_active_envoi_programme');
            echo $this->Form->control('is_email_cron_programme');
            echo $this->Form->control('is_sms_cron_programme');
            echo $this->Form->control('date_programme', ['empty' => true]);
            echo $this->Form->control('evenement_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
