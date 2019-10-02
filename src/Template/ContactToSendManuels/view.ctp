<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactToSendManuel $contactToSendManuel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contact To Send Manuel'), ['action' => 'edit', $contactToSendManuel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contact To Send Manuel'), ['action' => 'delete', $contactToSendManuel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactToSendManuel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contact To Send Manuels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact To Send Manuel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Envoi Manuels'), ['controller' => 'EnvoiManuels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Envoi Manuel'), ['controller' => 'EnvoiManuels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contactToSendManuels view large-9 medium-8 columns content">
    <h3><?= h($contactToSendManuel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Contact') ?></th>
            <td><?= $contactToSendManuel->has('contact') ? $this->Html->link($contactToSendManuel->contact->id, ['controller' => 'Contacts', 'action' => 'view', $contactToSendManuel->contact->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Envoi Manuel') ?></th>
            <td><?= $contactToSendManuel->has('envoi_manuel') ? $this->Html->link($contactToSendManuel->envoi_manuel->id, ['controller' => 'EnvoiManuels', 'action' => 'view', $contactToSendManuel->envoi_manuel->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contactToSendManuel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($contactToSendManuel->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($contactToSendManuel->modified) ?></td>
        </tr>
    </table>
</div>
