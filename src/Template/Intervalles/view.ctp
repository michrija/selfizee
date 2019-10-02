<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Intervalle $intervalle
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Intervalle'), ['action' => 'edit', $intervalle->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Intervalle'), ['action' => 'delete', $intervalle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $intervalle->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Intervalles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Intervalle'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Crons'), ['controller' => 'Crons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cron'), ['controller' => 'Crons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="intervalles view large-9 medium-8 columns content">
    <h3><?= h($intervalle->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Intervalle') ?></th>
            <td><?= h($intervalle->intervalle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($intervalle->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($intervalle->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($intervalle->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Crons') ?></h4>
        <?php if (!empty($intervalle->crons)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Cron Email') ?></th>
                <th scope="col"><?= __('Is Cron Sms') ?></th>
                <th scope="col"><?= __('Date Debut') ?></th>
                <th scope="col"><?= __('Date Fin') ?></th>
                <th scope="col"><?= __('Evenement Id') ?></th>
                <th scope="col"><?= __('Intervalle Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($intervalle->crons as $crons): ?>
            <tr>
                <td><?= h($crons->id) ?></td>
                <td><?= h($crons->is_active) ?></td>
                <td><?= h($crons->is_cron_email) ?></td>
                <td><?= h($crons->is_cron_sms) ?></td>
                <td><?= h($crons->date_debut) ?></td>
                <td><?= h($crons->date_fin) ?></td>
                <td><?= h($crons->evenement_id) ?></td>
                <td><?= h($crons->intervalle_id) ?></td>
                <td><?= h($crons->created) ?></td>
                <td><?= h($crons->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Crons', 'action' => 'view', $crons->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Crons', 'action' => 'edit', $crons->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Crons', 'action' => 'delete', $crons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $crons->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
