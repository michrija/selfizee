<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersModelesSms $usersModelesSms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Modeles Sms'), ['action' => 'edit', $usersModelesSms->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Modeles Sms'), ['action' => 'delete', $usersModelesSms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersModelesSms->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Modeles Smss'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Modeles Sms'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersModelesSmss view large-9 medium-8 columns content">
    <h3><?= h($usersModelesSms->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Modele') ?></th>
            <td><?= h($usersModelesSms->nom_modele) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expediteur') ?></th>
            <td><?= h($usersModelesSms->expediteur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersModelesSms->has('user') ? $this->Html->link($usersModelesSms->user->id, ['controller' => 'Users', 'action' => 'view', $usersModelesSms->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersModelesSms->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nb Caractere') ?></th>
            <td><?= $this->Number->format($usersModelesSms->nb_caractere) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Sms') ?></th>
            <td><?= $this->Number->format($usersModelesSms->nbr_sms) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usersModelesSms->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usersModelesSms->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contenu') ?></h4>
        <?= $this->Text->autoParagraph(h($usersModelesSms->contenu)); ?>
    </div>
</div>
