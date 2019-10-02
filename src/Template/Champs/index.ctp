<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Champ[]|\Cake\Collection\CollectionInterface $champs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Champs'), ['controller' => 'TypeChamps', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Champ'), ['controller' => 'TypeChamps', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Donnees'), ['controller' => 'TypeDonnees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Donnee'), ['controller' => 'TypeDonnees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="champs index large-9 medium-8 columns content">
    <h3><?= __('Champs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_champ_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_donnee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('configuration_borne_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($champs as $champ): ?>
            <tr>
                <td><?= $this->Number->format($champ->id) ?></td>
                <td><?= $champ->has('type_champ') ? $this->Html->link($champ->type_champ->id, ['controller' => 'TypeChamps', 'action' => 'view', $champ->type_champ->id]) : '' ?></td>
                <td><?= h($champ->nom) ?></td>
                <td><?= $champ->has('type_donnee') ? $this->Html->link($champ->type_donnee->id, ['controller' => 'TypeDonnees', 'action' => 'view', $champ->type_donnee->id]) : '' ?></td>
                <td><?= $this->Number->format($champ->ordre) ?></td>
                <td><?= $champ->has('configuration_borne') ? $this->Html->link($champ->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $champ->configuration_borne->id]) : '' ?></td>
                <td><?= h($champ->created) ?></td>
                <td><?= h($champ->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $champ->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $champ->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $champ->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champ->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
