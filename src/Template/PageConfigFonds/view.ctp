<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigFond $pageConfigFond
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page Config Fond'), ['action' => 'edit', $pageConfigFond->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page Config Fond'), ['action' => 'delete', $pageConfigFond->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigFond->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Page Config Fonds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Config Fond'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pageConfigFonds view large-9 medium-8 columns content">
    <h3><?= h($pageConfigFond->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Couleur') ?></th>
            <td><?= h($pageConfigFond->couleur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pageConfigFond->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pageConfigFond->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pageConfigFond->modified) ?></td>
        </tr>
    </table>
</div>
