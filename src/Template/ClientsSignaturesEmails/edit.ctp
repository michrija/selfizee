<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsSignaturesEmail $clientsSignaturesEmail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clientsSignaturesEmail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clientsSignaturesEmail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Clients Signatures Emails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientsSignaturesEmails form large-9 medium-8 columns content">
    <?= $this->Form->create($clientsSignaturesEmail) ?>
    <fieldset>
        <legend><?= __('Edit Clients Signatures Email') ?></legend>
        <?php
            echo $this->Form->control('signature_email');
            echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
