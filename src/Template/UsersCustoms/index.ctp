<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersCustom[]|\Cake\Collection\CollectionInterface $usersCustoms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Custom'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCustoms index large-9 medium-8 columns content">
    <h3><?= __('Users Customs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
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
            <?php foreach ($usersCustoms as $usersCustom): ?>
            <tr>
                <td><?= $this->Number->format($usersCustom->id) ?></td>
                <td><?= $usersCustom->has('user') ? $this->Html->link($usersCustom->user->id, ['controller' => 'Users', 'action' => 'view', $usersCustom->user->id]) : '' ?></td>
                <td><?= h($usersCustom->ps_bandeau_par_defaut) ?></td>
                <td><?= h($usersCustom->ps_couleur_de_fond) ?></td>
                <td><?= h($usersCustom->gs_nom) ?></td>
                <td><?= h($usersCustom->gs_slug) ?></td>
                <td><?= h($usersCustom->gs_is_public) ?></td>
                <td><?= h($usersCustom->gs_titre) ?></td>
                <td><?= h($usersCustom->gs_sous_titre) ?></td>
                <td><?= h($usersCustom->gs_couleur) ?></td>
                <td><?= h($usersCustom->gs_img_banniere) ?></td>
                <td><?= h($usersCustom->gs_is_livredor_active) ?></td>
                <td><?= h($usersCustom->created) ?></td>
                <td><?= h($usersCustom->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersCustom->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersCustom->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersCustom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersCustom->id)]) ?>
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
