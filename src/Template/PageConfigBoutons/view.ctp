<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigBouton $pageConfigBouton
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page Config Bouton'), ['action' => 'edit', $pageConfigBouton->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page Config Bouton'), ['action' => 'delete', $pageConfigBouton->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigBouton->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Page Config Boutons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Config Bouton'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pageConfigBoutons view large-9 medium-8 columns content">
    <h3><?= h($pageConfigBouton->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= h($pageConfigBouton->tag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fichier') ?></th>
            <td><?= h($pageConfigBouton->fichier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pageConfigBouton->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pageConfigBouton->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pageConfigBouton->modified) ?></td>
        </tr>
    </table>
</div>
