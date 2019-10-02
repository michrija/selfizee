<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigPolice $pageConfigPolice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page Config Police'), ['action' => 'edit', $pageConfigPolice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page Config Police'), ['action' => 'delete', $pageConfigPolice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigPolice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Page Config Polices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Config Police'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pageConfigPolices view large-9 medium-8 columns content">
    <h3><?= h($pageConfigPolice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Police') ?></th>
            <td><?= h($pageConfigPolice->nom_police) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Css Specification') ?></th>
            <td><?= h($pageConfigPolice->css_specification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url Police') ?></th>
            <td><?= h($pageConfigPolice->url_police) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pageConfigPolice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pageConfigPolice->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pageConfigPolice->modified) ?></td>
        </tr>
    </table>
</div>
