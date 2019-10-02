<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigBorne[]|\Cake\Collection\CollectionInterface $configBornes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Config Borne'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Mise En Pages'), ['controller' => 'TypeMiseEnPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Mise En Page'), ['controller' => 'TypeMiseEnPages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Catalogues'), ['controller' => 'Catalogues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Catalogue'), ['controller' => 'Catalogues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taille Ecrans'), ['controller' => 'TailleEcrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taille Ecran'), ['controller' => 'TailleEcrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['controller' => 'TypeImprimantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['controller' => 'TypeImprimantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cadres'), ['controller' => 'Cadres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'Cadres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configborne Has Filtres'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configborne Has Filtre'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configborne Has Typeanimations'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configborne Has Typeanimation'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ecrans'), ['controller' => 'Ecrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ecran'), ['controller' => 'Ecrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['controller' => 'FondVerts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['controller' => 'FondVerts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Image Fond Verts'), ['controller' => 'ImageFondVerts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image Fond Vert'), ['controller' => 'ImageFondVerts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configBornes index large-9 medium-8 columns content">
    <h3><?= __('Config Bornes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_mise_en_page_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('catalogue_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('decompte_prise_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_reprise_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_incrustation_fond_vert') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_prise_coordonnee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titre_formulaire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_multi_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_max_multi_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_limite_impression') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_max_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_impression_auto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_copie_impression_auto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('decompte_time_out') ?></th>
                <th scope="col"><?= $this->Paginator->sort('num_borne') ?></th>
                <th scope="col"><?= $this->Paginator->sort('taille_ecran_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_imprimante_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configBornes as $configBorne): ?>
            <tr>
                <td><?= $this->Number->format($configBorne->id) ?></td>
                <td><?= $configBorne->has('evenement') ? $this->Html->link($configBorne->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $configBorne->evenement->id]) : '' ?></td>
                <td><?= $configBorne->has('type_mise_en_page') ? $this->Html->link($configBorne->type_mise_en_page->id, ['controller' => 'TypeMiseEnPages', 'action' => 'view', $configBorne->type_mise_en_page->id]) : '' ?></td>
                <td><?= $configBorne->has('catalogue') ? $this->Html->link($configBorne->catalogue->id, ['controller' => 'Catalogues', 'action' => 'view', $configBorne->catalogue->id]) : '' ?></td>
                <td><?= $this->Number->format($configBorne->decompte_prise_photo) ?></td>
                <td><?= h($configBorne->is_reprise_photo) ?></td>
                <td><?= h($configBorne->is_incrustation_fond_vert) ?></td>
                <td><?= h($configBorne->is_prise_coordonnee) ?></td>
                <td><?= h($configBorne->titre_formulaire) ?></td>
                <td><?= h($configBorne->is_impression) ?></td>
                <td><?= h($configBorne->is_multi_impression) ?></td>
                <td><?= $this->Number->format($configBorne->nbr_max_multi_impression) ?></td>
                <td><?= h($configBorne->has_limite_impression) ?></td>
                <td><?= $this->Number->format($configBorne->nbr_max_photo) ?></td>
                <td><?= h($configBorne->is_impression_auto) ?></td>
                <td><?= $this->Number->format($configBorne->nbr_copie_impression_auto) ?></td>
                <td><?= $this->Number->format($configBorne->decompte_time_out) ?></td>
                <td><?= $this->Number->format($configBorne->num_borne) ?></td>
                <td><?= $configBorne->has('taille_ecran') ? $this->Html->link($configBorne->taille_ecran->id, ['controller' => 'TailleEcrans', 'action' => 'view', $configBorne->taille_ecran->id]) : '' ?></td>
                <td><?= $configBorne->has('type_imprimante') ? $this->Html->link($configBorne->type_imprimante->id, ['controller' => 'TypeImprimantes', 'action' => 'view', $configBorne->type_imprimante->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configBorne->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configBorne->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configBorne->id)]) ?>
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
