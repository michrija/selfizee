<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigurationAnimation[]|\Cake\Collection\CollectionInterface $configurationAnimations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Configuration Animation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Disposition Vignettes'), ['controller' => 'DispositionVignettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Disposition Vignette'), ['controller' => 'DispositionVignettes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configurationAnimations index large-9 medium-8 columns content">
    <h3><?= __('Configuration Animations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_cadre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_pose') ?></th>
                <th scope="col"><?= $this->Paginator->sort('disposition_vignette_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('configuration_borne_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configurationAnimations as $configurationAnimation): ?>
            <tr>
                <td><?= $this->Number->format($configurationAnimation->id) ?></td>
                <td><?= $this->Number->format($configurationAnimation->type_cadre) ?></td>
                <td><?= $this->Number->format($configurationAnimation->nbr_pose) ?></td>
                <td><?= $configurationAnimation->has('disposition_vignette') ? $this->Html->link($configurationAnimation->disposition_vignette->id, ['controller' => 'DispositionVignettes', 'action' => 'view', $configurationAnimation->disposition_vignette->id]) : '' ?></td>
                <td><?= $configurationAnimation->has('configuration_borne') ? $this->Html->link($configurationAnimation->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $configurationAnimation->configuration_borne->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configurationAnimation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configurationAnimation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configurationAnimation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configurationAnimation->id)]) ?>
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
