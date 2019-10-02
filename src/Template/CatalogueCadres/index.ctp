<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CatalogueCadre[]|\Cake\Collection\CollectionInterface $catalogueCadres
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Catalogue Cadre'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Formats'), ['controller' => 'Formats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Format'), ['controller' => 'Formats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Catalogue Cadre Themes'), ['controller' => 'CatalogueCadreThemes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Catalogue Cadre Theme'), ['controller' => 'CatalogueCadreThemes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="catalogueCadres index large-9 medium-8 columns content">
    <h3><?= __('Catalogue Cadres') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_origine') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_pose') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_cadre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('format_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($catalogueCadres as $catalogueCadre): ?>
            <tr>
                <td><?= $this->Number->format($catalogueCadre->id) ?></td>
                <td><?= h($catalogueCadre->titre) ?></td>
                <td><?= h($catalogueCadre->file_name) ?></td>
                <td><?= h($catalogueCadre->nom_origine) ?></td>
                <td><?= $this->Number->format($catalogueCadre->nbr_pose) ?></td>
                <td><?= h($catalogueCadre->type_cadre) ?></td>
                <td><?= $catalogueCadre->has('format') ? $this->Html->link($catalogueCadre->format->id, ['controller' => 'Formats', 'action' => 'view', $catalogueCadre->format->id]) : '' ?></td>
                <td><?= $catalogueCadre->has('evenement') ? $this->Html->link($catalogueCadre->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $catalogueCadre->evenement->id]) : '' ?></td>
                <td><?= h($catalogueCadre->created) ?></td>
                <td><?= h($catalogueCadre->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $catalogueCadre->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $catalogueCadre->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $catalogueCadre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $catalogueCadre->id)]) ?>
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
