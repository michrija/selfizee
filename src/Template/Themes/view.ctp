<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theme $theme
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Theme'), ['action' => 'edit', $theme->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Theme'), ['action' => 'delete', $theme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $theme->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Themes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Theme'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Image Fonds'), ['controller' => 'ImageFonds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Fond'), ['controller' => 'ImageFonds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="themes view large-9 medium-8 columns content">
    <h3><?= h($theme->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($theme->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($theme->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($theme->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client Id') ?></th>
            <td><?= $this->Number->format($theme->client_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($theme->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($theme->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($theme->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Image Fonds') ?></h4>
        <?php if (!empty($theme->image_fonds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Nom Origine') ?></th>
                <th scope="col"><?= __('Chemin') ?></th>
                <th scope="col"><?= __('Nbr Pose') ?></th>
                <th scope="col"><?= __('Theme Id') ?></th>
                <th scope="col"><?= __('Format Id') ?></th>
                <th scope="col"><?= __('Catalogue Id') ?></th>
                <th scope="col"><?= __('Configuration Animation Id') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($theme->image_fonds as $imageFonds): ?>
            <tr>
                <td><?= h($imageFonds->id) ?></td>
                <td><?= h($imageFonds->type) ?></td>
                <td><?= h($imageFonds->file_name) ?></td>
                <td><?= h($imageFonds->nom_origine) ?></td>
                <td><?= h($imageFonds->chemin) ?></td>
                <td><?= h($imageFonds->nbr_pose) ?></td>
                <td><?= h($imageFonds->theme_id) ?></td>
                <td><?= h($imageFonds->format_id) ?></td>
                <td><?= h($imageFonds->catalogue_id) ?></td>
                <td><?= h($imageFonds->configuration_animation_id) ?></td>
                <td><?= h($imageFonds->configuration_borne_id) ?></td>
                <td><?= h($imageFonds->created) ?></td>
                <td><?= h($imageFonds->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ImageFonds', 'action' => 'view', $imageFonds->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ImageFonds', 'action' => 'edit', $imageFonds->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ImageFonds', 'action' => 'delete', $imageFonds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imageFonds->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
