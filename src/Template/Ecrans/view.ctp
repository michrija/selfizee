<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ecran $ecran
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ecran'), ['action' => 'edit', $ecran->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ecran'), ['action' => 'delete', $ecran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ecran->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ecrans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ecran'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ecrans view large-9 medium-8 columns content">
    <h3><?= h($ecran->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Page Accueil') ?></th>
            <td><?= h($ecran->page_accueil) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Btn Page Accueil') ?></th>
            <td><?= h($ecran->btn_page_accueil) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Prise Photo') ?></th>
            <td><?= h($ecran->page_prise_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Prise Photo Visualisation') ?></th>
            <td><?= h($ecran->page_prise_photo_visualisation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Choix Filtre') ?></th>
            <td><?= h($ecran->page_choix_filtre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Remerciement') ?></th>
            <td><?= h($ecran->page_remerciement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Choix Fond Vert') ?></th>
            <td><?= h($ecran->page_choix_fond_vert) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Configuration Borne') ?></th>
            <td><?= $ecran->has('configuration_borne') ? $this->Html->link($ecran->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $ecran->configuration_borne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ecran->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ecran->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ecran->modified) ?></td>
        </tr>
    </table>
</div>
