<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OptionBorne $optionBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Option Borne'), ['action' => 'edit', $optionBorne->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Option Borne'), ['action' => 'delete', $optionBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $optionBorne->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Option Bornes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Option Borne'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="optionBornes view large-9 medium-8 columns content">
    <h3><?= h($optionBorne->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ftp Server') ?></th>
            <td><?= h($optionBorne->ftp_server) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ftp Password') ?></th>
            <td><?= h($optionBorne->ftp_password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ftp Port') ?></th>
            <td><?= h($optionBorne->ftp_port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($optionBorne->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($optionBorne->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($optionBorne->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Chemin Dossier Assets') ?></h4>
        <?= $this->Text->autoParagraph(h($optionBorne->chemin_dossier_assets)); ?>
    </div>
    <div class="row">
        <h4><?= __('Chemin Dossier Events') ?></h4>
        <?= $this->Text->autoParagraph(h($optionBorne->chemin_dossier_events)); ?>
    </div>
    <div class="row">
        <h4><?= __('Fichier Setting Base') ?></h4>
        <?= $this->Text->autoParagraph(h($optionBorne->fichier_setting_base)); ?>
    </div>
</div>
