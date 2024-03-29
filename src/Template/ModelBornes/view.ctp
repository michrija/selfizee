<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Model Borne'), ['action' => 'edit', $modelBorne->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Model Borne'), ['action' => 'delete', $modelBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelBorne->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Model Bornes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model Borne'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="modelBornes view large-9 medium-8 columns content">
    <h3><?= h($modelBorne->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($modelBorne->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($modelBorne->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($modelBorne->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($modelBorne->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Configuration Bornes') ?></h4>
        <?php if (!empty($modelBorne->configuration_bornes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Evenement Id') ?></th>
                <th scope="col"><?= __('Type Animation Id') ?></th>
                <th scope="col"><?= __('Nbr Pose') ?></th>
                <th scope="col"><?= __('Disposition Vignette') ?></th>
                <th scope="col"><?= __('Multiconfiguration Id') ?></th>
                <th scope="col"><?= __('Decompte Prise Photo') ?></th>
                <th scope="col"><?= __('Decompte Time Out') ?></th>
                <th scope="col"><?= __('Is Reprise Photo') ?></th>
                <th scope="col"><?= __('Is Prise Coordonnee') ?></th>
                <th scope="col"><?= __('Is Impression') ?></th>
                <th scope="col"><?= __('Is Multi Impression') ?></th>
                <th scope="col"><?= __('Nbr Max Impression') ?></th>
                <th scope="col"><?= __('Nbr Max Photo') ?></th>
                <th scope="col"><?= __('Texte Impression') ?></th>
                <th scope="col"><?= __('Is Impression Auto') ?></th>
                <th scope="col"><?= __('Nbr Copie Impression Auto') ?></th>
                <th scope="col"><?= __('Type Imprimante Id') ?></th>
                <th scope="col"><?= __('Model Borne Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($modelBorne->configuration_bornes as $configurationBornes): ?>
            <tr>
                <td><?= h($configurationBornes->id) ?></td>
                <td><?= h($configurationBornes->evenement_id) ?></td>
                <td><?= h($configurationBornes->type_animation_id) ?></td>
                <td><?= h($configurationBornes->nbr_pose) ?></td>
                <td><?= h($configurationBornes->disposition_vignette) ?></td>
                <td><?= h($configurationBornes->multiconfiguration_id) ?></td>
                <td><?= h($configurationBornes->decompte_prise_photo) ?></td>
                <td><?= h($configurationBornes->decompte_time_out) ?></td>
                <td><?= h($configurationBornes->is_reprise_photo) ?></td>
                <td><?= h($configurationBornes->is_prise_coordonnee) ?></td>
                <td><?= h($configurationBornes->is_impression) ?></td>
                <td><?= h($configurationBornes->is_multi_impression) ?></td>
                <td><?= h($configurationBornes->nbr_max_impression) ?></td>
                <td><?= h($configurationBornes->nbr_max_photo) ?></td>
                <td><?= h($configurationBornes->texte_impression) ?></td>
                <td><?= h($configurationBornes->is_impression_auto) ?></td>
                <td><?= h($configurationBornes->nbr_copie_impression_auto) ?></td>
                <td><?= h($configurationBornes->type_imprimante_id) ?></td>
                <td><?= h($configurationBornes->model_borne_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ConfigurationBornes', 'action' => 'view', $configurationBornes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ConfigurationBornes', 'action' => 'edit', $configurationBornes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ConfigurationBornes', 'action' => 'delete', $configurationBornes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configurationBornes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
