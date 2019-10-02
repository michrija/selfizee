<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsCustom $clientsCustom
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clients Custom'), ['action' => 'edit', $clientsCustom->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clients Custom'), ['action' => 'delete', $clientsCustom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsCustom->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients Customs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clients Custom'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientsCustoms view large-9 medium-8 columns content">
    <h3><?= h($clientsCustom->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $clientsCustom->has('client') ? $this->Html->link($clientsCustom->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsCustom->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ps Bandeau Par Defaut') ?></th>
            <td><?= h($clientsCustom->ps_bandeau_par_defaut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ps Couleur De Fond') ?></th>
            <td><?= h($clientsCustom->ps_couleur_de_fond) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Nom') ?></th>
            <td><?= h($clientsCustom->gs_nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Slug') ?></th>
            <td><?= h($clientsCustom->gs_slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Is Public') ?></th>
            <td><?= h($clientsCustom->gs_is_public) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Titre') ?></th>
            <td><?= h($clientsCustom->gs_titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Sous Titre') ?></th>
            <td><?= h($clientsCustom->gs_sous_titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Couleur') ?></th>
            <td><?= h($clientsCustom->gs_couleur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Img Banniere') ?></th>
            <td><?= h($clientsCustom->gs_img_banniere) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clientsCustom->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($clientsCustom->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($clientsCustom->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Is Livredor Active') ?></th>
            <td><?= $clientsCustom->gs_is_livredor_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Signature Email') ?></h4>
        <?= $this->Text->autoParagraph(h($clientsCustom->signature_email)); ?>
    </div>
    <div class="row">
        <h4><?= __('Ps Publicite') ?></h4>
        <?= $this->Text->autoParagraph(h($clientsCustom->ps_publicite)); ?>
    </div>
</div>
