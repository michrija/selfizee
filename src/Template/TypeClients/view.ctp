<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeClient $typeClient
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Type Client'), ['action' => 'edit', $typeClient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type Client'), ['action' => 'delete', $typeClient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeClient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Type Clients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Client'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="typeClients view large-9 medium-8 columns content">
    <h3><?= h($typeClient->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($typeClient->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($typeClient->id) ?></td>
        </tr>
    </table>
</div>
