<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementStatCampaign $evenementStatCampaign
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evenement Stat Campaign'), ['action' => 'edit', $evenementStatCampaign->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evenement Stat Campaign'), ['action' => 'delete', $evenementStatCampaign->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evenementStatCampaign->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evenement Stat Campaigns'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement Stat Campaign'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evenementStatCampaigns view large-9 medium-8 columns content">
    <h3><?= h($evenementStatCampaign->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $evenementStatCampaign->has('evenement') ? $this->Html->link($evenementStatCampaign->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $evenementStatCampaign->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Click Delay') ?></th>
            <td><?= h($evenementStatCampaign->event_click_delay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Open Delay') ?></th>
            <td><?= h($evenementStatCampaign->event_open_delay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Clicked Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->event_clicked_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Opened Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->event_opened_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Spam Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->event_spam_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Unsubscribed Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->event_unsubscribed_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Workflow Exited Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->event_workflow_exited_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Blocked Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_blocked_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Clicked Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_clicked_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Deferred Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_deferred_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Hard Bounced Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_hard_bounced_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Opened Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_opened_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Queued Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_queued_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Sent Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_sent_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Soft Bounced Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_soft_bounced_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Spam Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_spam_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Unsubscribed Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_unsubscribed_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Workflow Exited Count') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->message_workflow_exited_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source Id') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->source_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($evenementStatCampaign->total) ?></td>
        </tr>
    </table>
</div>
