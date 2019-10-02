<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigurationBorne[]|\Cake\Collection\CollectionInterface $configurationBornes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Animations'), ['controller' => 'TypeAnimations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Animation'), ['controller' => 'TypeAnimations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multiconfigurations'), ['controller' => 'Multiconfigurations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multiconfiguration'), ['controller' => 'Multiconfigurations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['controller' => 'TypeImprimantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['controller' => 'TypeImprimantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Bornes'), ['controller' => 'ModelBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Borne'), ['controller' => 'ModelBornes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cadres'), ['controller' => 'Cadres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'Cadres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ecrans'), ['controller' => 'Ecrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ecran'), ['controller' => 'Ecrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Filtre Configuration Bornes'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Filtre Configuration Borne'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['controller' => 'FondVerts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['controller' => 'FondVerts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configurationBornes index large-9 medium-8 columns content">
    <h3><?= __('Configuration Bornes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_animation_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_pose') ?></th>
                <th scope="col"><?= $this->Paginator->sort('disposition_vignette') ?></th>
                <th scope="col"><?= $this->Paginator->sort('multiconfiguration_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('decompte_prise_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('decompte_time_out') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_reprise_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_prise_coordonnee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_multi_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_max_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_max_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_impression_auto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_copie_impression_auto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_imprimante_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model_borne_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configurationBornes as $configurationBorne): ?>
            <tr>
                <td><?= $this->Number->format($configurationBorne->id) ?></td>
                <td><?= $configurationBorne->has('evenement') ? $this->Html->link($configurationBorne->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $configurationBorne->evenement->id]) : '' ?></td>
                <td><?= $configurationBorne->has('type_animation') ? $this->Html->link($configurationBorne->type_animation->id, ['controller' => 'TypeAnimations', 'action' => 'view', $configurationBorne->type_animation->id]) : '' ?></td>
                <td><?= $this->Number->format($configurationBorne->nbr_pose) ?></td>
                <td><?= $this->Number->format($configurationBorne->disposition_vignette) ?></td>
                <td><?= $configurationBorne->has('multiconfiguration') ? $this->Html->link($configurationBorne->multiconfiguration->id, ['controller' => 'Multiconfigurations', 'action' => 'view', $configurationBorne->multiconfiguration->id]) : '' ?></td>
                <td><?= $this->Number->format($configurationBorne->decompte_prise_photo) ?></td>
                <td><?= $this->Number->format($configurationBorne->decompte_time_out) ?></td>
                <td><?= h($configurationBorne->is_reprise_photo) ?></td>
                <td><?= h($configurationBorne->is_prise_coordonnee) ?></td>
                <td><?= h($configurationBorne->is_impression) ?></td>
                <td><?= h($configurationBorne->is_multi_impression) ?></td>
                <td><?= $this->Number->format($configurationBorne->nbr_max_impression) ?></td>
                <td><?= $this->Number->format($configurationBorne->nbr_max_photo) ?></td>
                <td><?= h($configurationBorne->is_impression_auto) ?></td>
                <td><?= $this->Number->format($configurationBorne->nbr_copie_impression_auto) ?></td>
                <td><?= $configurationBorne->has('type_imprimante') ? $this->Html->link($configurationBorne->type_imprimante->id, ['controller' => 'TypeImprimantes', 'action' => 'view', $configurationBorne->type_imprimante->id]) : '' ?></td>
                <td><?= $configurationBorne->has('model_borne') ? $this->Html->link($configurationBorne->model_borne->id, ['controller' => 'ModelBornes', 'action' => 'view', $configurationBorne->model_borne->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configurationBorne->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configurationBorne->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configurationBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configurationBorne->id)]) ?>
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
