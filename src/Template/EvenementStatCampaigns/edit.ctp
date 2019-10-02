<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementStatCampaign $evenementStatCampaign
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $evenementStatCampaign->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $evenementStatCampaign->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Evenement Stat Campaigns'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evenementStatCampaigns form large-9 medium-8 columns content">
    <?= $this->Form->create($evenementStatCampaign) ?>
    <fieldset>
        <legend><?= __('Edit Evenement Stat Campaign') ?></legend>
        <?php
            echo $this->Form->control('evenement_id', ['options' => $evenements]);
            echo $this->Form->control('event_click_delay');
            echo $this->Form->control('event_clicked_count');
            echo $this->Form->control('event_open_delay');
            echo $this->Form->control('event_opened_count');
            echo $this->Form->control('event_spam_count');
            echo $this->Form->control('event_unsubscribed_count');
            echo $this->Form->control('event_workflow_exited_count');
            echo $this->Form->control('message_blocked_count');
            echo $this->Form->control('message_clicked_count');
            echo $this->Form->control('message_deferred_count');
            echo $this->Form->control('message_hard_bounced_count');
            echo $this->Form->control('message_opened_count');
            echo $this->Form->control('message_queued_count');
            echo $this->Form->control('message_sent_count');
            echo $this->Form->control('message_soft_bounced_count');
            echo $this->Form->control('message_spam_count');
            echo $this->Form->control('message_unsubscribed_count');
            echo $this->Form->control('message_workflow_exited_count');
            echo $this->Form->control('source_id');
            echo $this->Form->control('total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
