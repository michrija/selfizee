<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementStatCampaign[]|\Cake\Collection\CollectionInterface $evenementStatCampaigns
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evenement Stat Campaign'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evenementStatCampaigns index large-9 medium-8 columns content">
    <h3><?= __('Evenement Stat Campaigns') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_click_delay') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_clicked_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_open_delay') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_opened_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_spam_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_unsubscribed_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_workflow_exited_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_blocked_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_clicked_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_deferred_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_hard_bounced_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_opened_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_queued_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_sent_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_soft_bounced_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_spam_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_unsubscribed_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_workflow_exited_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('source_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evenementStatCampaigns as $evenementStatCampaign): ?>
            <tr>
                <td><?= $this->Number->format($evenementStatCampaign->id) ?></td>
                <td><?= $evenementStatCampaign->has('evenement') ? $this->Html->link($evenementStatCampaign->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $evenementStatCampaign->evenement->id]) : '' ?></td>
                <td><?= h($evenementStatCampaign->event_click_delay) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->event_clicked_count) ?></td>
                <td><?= h($evenementStatCampaign->event_open_delay) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->event_opened_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->event_spam_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->event_unsubscribed_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->event_workflow_exited_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_blocked_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_clicked_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_deferred_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_hard_bounced_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_opened_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_queued_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_sent_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_soft_bounced_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_spam_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_unsubscribed_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->message_workflow_exited_count) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->source_id) ?></td>
                <td><?= $this->Number->format($evenementStatCampaign->total) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evenementStatCampaign->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evenementStatCampaign->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evenementStatCampaign->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evenementStatCampaign->id)]) ?>
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
