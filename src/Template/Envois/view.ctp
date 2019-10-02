<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Envois $envois
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Envois'), ['action' => 'edit', $envois->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Envois'), ['action' => 'delete', $envois->id], ['confirm' => __('Are you sure you want to delete # {0}?', $envois->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Envois'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Envois'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="envois view large-9 medium-8 columns content">
    <h3><?= h($envois->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Contact') ?></th>
            <td><?= $envois->has('contact') ? $this->Html->link($envois->contact->id, ['controller' => 'Contacts', 'action' => 'view', $envois->contact->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Envoi Type') ?></th>
            <td><?= h($envois->envoi_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($envois->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($envois->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($envois->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Force Envoi') ?></th>
            <td><?= $envois->is_force_envoi ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
