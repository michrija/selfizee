<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cron[]|\Cake\Collection\CollectionInterface $crons
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cron'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Intervalles'), ['controller' => 'Intervalles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Intervalle'), ['controller' => 'Intervalles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="crons index large-9 medium-8 columns content">
    <h3><?= __('Crons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_cron_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_cron_sms') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_debut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_fin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('intervalle_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($crons as $cron): ?>
            <tr>
                <td><?= $this->Number->format($cron->id) ?></td>
                <td><?= h($cron->is_active) ?></td>
                <td><?= h($cron->is_cron_email) ?></td>
                <td><?= h($cron->is_cron_sms) ?></td>
                <td><?= h($cron->date_debut) ?></td>
                <td><?= h($cron->date_fin) ?></td>
                <td><?= $cron->has('evenement') ? $this->Html->link($cron->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $cron->evenement->id]) : '' ?></td>
                <td><?= $cron->has('intervalle') ? $this->Html->link($cron->intervalle->id, ['controller' => 'Intervalles', 'action' => 'view', $cron->intervalle->id]) : '' ?></td>
                <td><?= h($cron->created) ?></td>
                <td><?= h($cron->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cron->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cron->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cron->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cron->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
