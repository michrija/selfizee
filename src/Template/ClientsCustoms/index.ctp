<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsCustom[]|\Cake\Collection\CollectionInterface $clientsCustoms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Clients Custom'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientsCustoms index large-9 medium-8 columns content">
    <h3><?= __('Clients Customs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ps_bandeau_par_defaut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ps_couleur_de_fond') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_is_public') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_titre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_sous_titre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_couleur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_img_banniere') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gs_is_livredor_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientsCustoms as $clientsCustom): ?>
            <tr>
                <td><?= $this->Number->format($clientsCustom->id) ?></td>
                <td><?= $clientsCustom->has('client') ? $this->Html->link($clientsCustom->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsCustom->client->id]) : '' ?></td>
                <td><?= h($clientsCustom->ps_bandeau_par_defaut) ?></td>
                <td><?= h($clientsCustom->ps_couleur_de_fond) ?></td>
                <td><?= h($clientsCustom->gs_nom) ?></td>
                <td><?= h($clientsCustom->gs_slug) ?></td>
                <td><?= h($clientsCustom->gs_is_public) ?></td>
                <td><?= h($clientsCustom->gs_titre) ?></td>
                <td><?= h($clientsCustom->gs_sous_titre) ?></td>
                <td><?= h($clientsCustom->gs_couleur) ?></td>
                <td><?= h($clientsCustom->gs_img_banniere) ?></td>
                <td><?= h($clientsCustom->gs_is_livredor_active) ?></td>
                <td><?= h($clientsCustom->created) ?></td>
                <td><?= h($clientsCustom->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $clientsCustom->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientsCustom->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientsCustom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsCustom->id)]) ?>
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
