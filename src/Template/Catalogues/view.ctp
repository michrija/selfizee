<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Catalogue $catalogue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Catalogue'), ['action' => 'edit', $catalogue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Catalogue'), ['action' => 'delete', $catalogue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $catalogue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Catalogues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Catalogue'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Config Bornes'), ['controller' => 'ConfigBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Config Borne'), ['controller' => 'ConfigBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="catalogues view large-9 medium-8 columns content">
    <h3><?= h($catalogue->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($catalogue->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($catalogue->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($catalogue->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($catalogue->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Config Bornes') ?></h4>
        <?php if (!empty($catalogue->config_bornes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Evenement Id') ?></th>
                <th scope="col"><?= __('Type Mise En Page Id') ?></th>
                <th scope="col"><?= __('Catalogue Id') ?></th>
                <th scope="col"><?= __('Decompte Prise Photo') ?></th>
                <th scope="col"><?= __('Is Reprise Photo') ?></th>
                <th scope="col"><?= __('Is Incrustation Fond Vert') ?></th>
                <th scope="col"><?= __('Is Prise Coordonnee') ?></th>
                <th scope="col"><?= __('Titre Formulaire') ?></th>
                <th scope="col"><?= __('Is Impression') ?></th>
                <th scope="col"><?= __('Is Multi Impression') ?></th>
                <th scope="col"><?= __('Nbr Max Multi Impression') ?></th>
                <th scope="col"><?= __('Has Limite Impression') ?></th>
                <th scope="col"><?= __('Nbr Max Photo') ?></th>
                <th scope="col"><?= __('Texte Impression') ?></th>
                <th scope="col"><?= __('Is Impression Auto') ?></th>
                <th scope="col"><?= __('Nbr Copie Impression Auto') ?></th>
                <th scope="col"><?= __('Decompte Time Out') ?></th>
                <th scope="col"><?= __('Num Borne') ?></th>
                <th scope="col"><?= __('Taille Ecran Id') ?></th>
                <th scope="col"><?= __('Type Imprimante Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($catalogue->config_bornes as $configBornes): ?>
            <tr>
                <td><?= h($configBornes->id) ?></td>
                <td><?= h($configBornes->evenement_id) ?></td>
                <td><?= h($configBornes->type_mise_en_page_id) ?></td>
                <td><?= h($configBornes->catalogue_id) ?></td>
                <td><?= h($configBornes->decompte_prise_photo) ?></td>
                <td><?= h($configBornes->is_reprise_photo) ?></td>
                <td><?= h($configBornes->is_incrustation_fond_vert) ?></td>
                <td><?= h($configBornes->is_prise_coordonnee) ?></td>
                <td><?= h($configBornes->titre_formulaire) ?></td>
                <td><?= h($configBornes->is_impression) ?></td>
                <td><?= h($configBornes->is_multi_impression) ?></td>
                <td><?= h($configBornes->nbr_max_multi_impression) ?></td>
                <td><?= h($configBornes->has_limite_impression) ?></td>
                <td><?= h($configBornes->nbr_max_photo) ?></td>
                <td><?= h($configBornes->texte_impression) ?></td>
                <td><?= h($configBornes->is_impression_auto) ?></td>
                <td><?= h($configBornes->nbr_copie_impression_auto) ?></td>
                <td><?= h($configBornes->decompte_time_out) ?></td>
                <td><?= h($configBornes->num_borne) ?></td>
                <td><?= h($configBornes->taille_ecran_id) ?></td>
                <td><?= h($configBornes->type_imprimante_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ConfigBornes', 'action' => 'view', $configBornes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ConfigBornes', 'action' => 'edit', $configBornes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ConfigBornes', 'action' => 'delete', $configBornes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configBornes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
