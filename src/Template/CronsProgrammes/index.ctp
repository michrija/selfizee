<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CronsProgramme[]|\Cake\Collection\CollectionInterface $cronsProgrammes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Crons Programme'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cronsProgrammes index large-9 medium-8 columns content">
    <h3><?= __('Crons Programmes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active_envoi_programme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_email_cron_programme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_sms_cron_programme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_programme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cronsProgrammes as $cronsProgramme): ?>
            <tr>
                <td><?= $this->Number->format($cronsProgramme->id) ?></td>
                <td><?= h($cronsProgramme->is_active_envoi_programme) ?></td>
                <td><?= h($cronsProgramme->is_email_cron_programme) ?></td>
                <td><?= h($cronsProgramme->is_sms_cron_programme) ?></td>
                <td><?= h($cronsProgramme->date_programme) ?></td>
                <td><?= $this->Number->format($cronsProgramme->evenement_id) ?></td>
                <td><?= h($cronsProgramme->created) ?></td>
                <td><?= h($cronsProgramme->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cronsProgramme->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cronsProgramme->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cronsProgramme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cronsProgramme->id)]) ?>
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
