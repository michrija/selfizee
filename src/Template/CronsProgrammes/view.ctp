<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CronsProgramme $cronsProgramme
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Crons Programme'), ['action' => 'edit', $cronsProgramme->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Crons Programme'), ['action' => 'delete', $cronsProgramme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cronsProgramme->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Crons Programmes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crons Programme'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cronsProgrammes view large-9 medium-8 columns content">
    <h3><?= h($cronsProgramme->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cronsProgramme->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evenement Id') ?></th>
            <td><?= $this->Number->format($cronsProgramme->evenement_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Programme') ?></th>
            <td><?= h($cronsProgramme->date_programme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cronsProgramme->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cronsProgramme->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active Envoi Programme') ?></th>
            <td><?= $cronsProgramme->is_active_envoi_programme ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Email Cron Programme') ?></th>
            <td><?= $cronsProgramme->is_email_cron_programme ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Sms Cron Programme') ?></th>
            <td><?= $cronsProgramme->is_sms_cron_programme ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
