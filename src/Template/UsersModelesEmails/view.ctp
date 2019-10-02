<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersModelesEmail $usersModelesEmail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Modeles Email'), ['action' => 'edit', $usersModelesEmail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Modeles Email'), ['action' => 'delete', $usersModelesEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersModelesEmail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Modeles Emails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Modeles Email'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersModelesEmails view large-9 medium-8 columns content">
    <h3><?= h($usersModelesEmail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Modele') ?></th>
            <td><?= h($usersModelesEmail->nom_modele) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Expediteur') ?></th>
            <td><?= h($usersModelesEmail->email_expediteur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Expediteur') ?></th>
            <td><?= h($usersModelesEmail->nom_expediteur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersModelesEmail->has('user') ? $this->Html->link($usersModelesEmail->user->id, ['controller' => 'Users', 'action' => 'view', $usersModelesEmail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersModelesEmail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usersModelesEmail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usersModelesEmail->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Photo En Pj') ?></th>
            <td><?= $usersModelesEmail->is_photo_en_pj ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Objet') ?></h4>
        <?= $this->Text->autoParagraph(h($usersModelesEmail->objet)); ?>
    </div>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($usersModelesEmail->content)); ?>
    </div>
</div>
