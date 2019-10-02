<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cron $cron
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cron'), ['action' => 'edit', $cron->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cron'), ['action' => 'delete', $cron->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cron->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Crons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cron'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Intervalles'), ['controller' => 'Intervalles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Intervalle'), ['controller' => 'Intervalles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="crons view large-9 medium-8 columns content">
    <h3><?= h($cron->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $cron->has('evenement') ? $this->Html->link($cron->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $cron->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Intervalle') ?></th>
            <td><?= $cron->has('intervalle') ? $this->Html->link($cron->intervalle->id, ['controller' => 'Intervalles', 'action' => 'view', $cron->intervalle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cron->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Debut') ?></th>
            <td><?= h($cron->date_debut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Fin') ?></th>
            <td><?= h($cron->date_fin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cron->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cron->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $cron->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Cron Email') ?></th>
            <td><?= $cron->is_cron_email ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Cron Sms') ?></th>
            <td><?= $cron->is_cron_sms ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
