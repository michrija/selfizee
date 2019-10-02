<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementPost $evenementPost
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evenement Post'), ['action' => 'edit', $evenementPost->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evenement Post'), ['action' => 'delete', $evenementPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evenementPost->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evenement Posts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement Post'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evenementPosts view large-9 medium-8 columns content">
    <h3><?= h($evenementPost->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $evenementPost->has('evenement') ? $this->Html->link($evenementPost->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $evenementPost->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Titre') ?></th>
            <td><?= h($evenementPost->titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evenementPost->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($evenementPost->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($evenementPost->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contenus') ?></h4>
        <?= $this->Text->autoParagraph(h($evenementPost->contenus)); ?>
    </div>
</div>
