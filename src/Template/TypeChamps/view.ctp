<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeChamp $typeChamp
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Type Champ'), ['action' => 'edit', $typeChamp->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type Champ'), ['action' => 'delete', $typeChamp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeChamp->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Type Champs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Champ'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="typeChamps view large-9 medium-8 columns content">
    <h3><?= h($typeChamp->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($typeChamp->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($typeChamp->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($typeChamp->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($typeChamp->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Champs') ?></h4>
        <?php if (!empty($typeChamp->champs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Type Champ Id') ?></th>
                <th scope="col"><?= __('Nom') ?></th>
                <th scope="col"><?= __('Type Donnee Id') ?></th>
                <th scope="col"><?= __('Ordre') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($typeChamp->champs as $champs): ?>
            <tr>
                <td><?= h($champs->id) ?></td>
                <td><?= h($champs->type_champ_id) ?></td>
                <td><?= h($champs->nom) ?></td>
                <td><?= h($champs->type_donnee_id) ?></td>
                <td><?= h($champs->ordre) ?></td>
                <td><?= h($champs->configuration_borne_id) ?></td>
                <td><?= h($champs->created) ?></td>
                <td><?= h($champs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Champs', 'action' => 'view', $champs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Champs', 'action' => 'edit', $champs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Champs', 'action' => 'delete', $champs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
