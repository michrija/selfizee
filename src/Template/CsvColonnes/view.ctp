<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CsvColonne $csvColonne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Csv Colonne'), ['action' => 'edit', $csvColonne->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Csv Colonne'), ['action' => 'delete', $csvColonne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $csvColonne->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Csv Colonnes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Csv Colonne'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Csv Colonne Positions'), ['controller' => 'CsvColonnePositions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Csv Colonne Position'), ['controller' => 'CsvColonnePositions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="csvColonnes view large-9 medium-8 columns content">
    <h3><?= h($csvColonne->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($csvColonne->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($csvColonne->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($csvColonne->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($csvColonne->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Csv Colonne Positions') ?></h4>
        <?php if (!empty($csvColonne->csv_colonne_positions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Csv Colonne Id') ?></th>
                <th scope="col"><?= __('Evenement Id') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($csvColonne->csv_colonne_positions as $csvColonnePositions): ?>
            <tr>
                <td><?= h($csvColonnePositions->id) ?></td>
                <td><?= h($csvColonnePositions->csv_colonne_id) ?></td>
                <td><?= h($csvColonnePositions->evenement_id) ?></td>
                <td><?= h($csvColonnePositions->position) ?></td>
                <td><?= h($csvColonnePositions->created) ?></td>
                <td><?= h($csvColonnePositions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CsvColonnePositions', 'action' => 'view', $csvColonnePositions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CsvColonnePositions', 'action' => 'edit', $csvColonnePositions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CsvColonnePositions', 'action' => 'delete', $csvColonnePositions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $csvColonnePositions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
