<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContenusEmail $contenusEmail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contenus Email'), ['action' => 'edit', $contenusEmail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contenus Email'), ['action' => 'delete', $contenusEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contenusEmail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contenus Emails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contenus Email'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contenusEmails view large-9 medium-8 columns content">
    <h3><?= h($contenusEmail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contenusEmail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($contenusEmail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($contenusEmail->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contenu') ?></h4>
        <?= $this->Text->autoParagraph(h($contenusEmail->contenu)); ?>
    </div>
</div>
