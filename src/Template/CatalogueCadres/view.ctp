<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CatalogueCadre $catalogueCadre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Catalogue Cadre'), ['action' => 'edit', $catalogueCadre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Catalogue Cadre'), ['action' => 'delete', $catalogueCadre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $catalogueCadre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Catalogue Cadres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Catalogue Cadre'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Formats'), ['controller' => 'Formats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Format'), ['controller' => 'Formats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Catalogue Cadre Themes'), ['controller' => 'CatalogueCadreThemes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Catalogue Cadre Theme'), ['controller' => 'CatalogueCadreThemes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="catalogueCadres view large-9 medium-8 columns content">
    <h3><?= h($catalogueCadre->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titre') ?></th>
            <td><?= h($catalogueCadre->titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($catalogueCadre->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Origine') ?></th>
            <td><?= h($catalogueCadre->nom_origine) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Cadre') ?></th>
            <td><?= h($catalogueCadre->type_cadre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Format') ?></th>
            <td><?= $catalogueCadre->has('format') ? $this->Html->link($catalogueCadre->format->id, ['controller' => 'Formats', 'action' => 'view', $catalogueCadre->format->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $catalogueCadre->has('evenement') ? $this->Html->link($catalogueCadre->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $catalogueCadre->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($catalogueCadre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Pose') ?></th>
            <td><?= $this->Number->format($catalogueCadre->nbr_pose) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($catalogueCadre->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($catalogueCadre->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Chemin') ?></h4>
        <?= $this->Text->autoParagraph(h($catalogueCadre->chemin)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Catalogue Cadre Themes') ?></h4>
        <?php if (!empty($catalogueCadre->catalogue_cadre_themes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Catalogue Cadre Id') ?></th>
                <th scope="col"><?= __('Theme Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($catalogueCadre->catalogue_cadre_themes as $catalogueCadreThemes): ?>
            <tr>
                <td><?= h($catalogueCadreThemes->id) ?></td>
                <td><?= h($catalogueCadreThemes->catalogue_cadre_id) ?></td>
                <td><?= h($catalogueCadreThemes->theme_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CatalogueCadreThemes', 'action' => 'view', $catalogueCadreThemes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CatalogueCadreThemes', 'action' => 'edit', $catalogueCadreThemes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CatalogueCadreThemes', 'action' => 'delete', $catalogueCadreThemes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $catalogueCadreThemes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
