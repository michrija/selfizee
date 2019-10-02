<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactService $contactService
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contact Service'), ['action' => 'edit', $contactService->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contact Service'), ['action' => 'delete', $contactService->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactService->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contact Services'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact Service'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contactServices view large-9 medium-8 columns content">
    <h3><?= h($contactService->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($contactService->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($contactService->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Objet') ?></th>
            <td><?= h($contactService->objet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contactService->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($contactService->message)); ?>
    </div>
</div>
