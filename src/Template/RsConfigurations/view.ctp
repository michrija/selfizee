<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RsConfiguration $rsConfiguration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rs Configuration'), ['action' => 'edit', $rsConfiguration->int]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rs Configuration'), ['action' => 'delete', $rsConfiguration->int], ['confirm' => __('Are you sure you want to delete # {0}?', $rsConfiguration->int)]) ?> </li>
        <li><?= $this->Html->link(__('List Rs Configurations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rs Configuration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rsConfigurations view large-9 medium-8 columns content">
    <h3><?= h($rsConfiguration->int) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hashtag Twitter') ?></th>
            <td><?= h($rsConfiguration->hashtag_twitter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $rsConfiguration->has('evenement') ? $this->Html->link($rsConfiguration->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $rsConfiguration->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rsConfiguration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($rsConfiguration->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($rsConfiguration->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Desc Facebook') ?></h4>
        <?= $this->Text->autoParagraph(h($rsConfiguration->desc_facebook)); ?>
    </div>
    <div class="row">
        <h4><?= __('Desc Twiter') ?></h4>
        <?= $this->Text->autoParagraph(h($rsConfiguration->desc_twiter)); ?>
    </div>
</div>
