<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersCustom $usersCustom
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Custom'), ['action' => 'edit', $usersCustom->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Custom'), ['action' => 'delete', $usersCustom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersCustom->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Customs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Custom'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersCustoms view large-9 medium-8 columns content">
    <h3><?= h($usersCustom->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersCustom->has('user') ? $this->Html->link($usersCustom->user->id, ['controller' => 'Users', 'action' => 'view', $usersCustom->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ps Bandeau Par Defaut') ?></th>
            <td><?= h($usersCustom->ps_bandeau_par_defaut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ps Couleur De Fond') ?></th>
            <td><?= h($usersCustom->ps_couleur_de_fond) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Nom') ?></th>
            <td><?= h($usersCustom->gs_nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Slug') ?></th>
            <td><?= h($usersCustom->gs_slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Is Public') ?></th>
            <td><?= h($usersCustom->gs_is_public) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Titre') ?></th>
            <td><?= h($usersCustom->gs_titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Sous Titre') ?></th>
            <td><?= h($usersCustom->gs_sous_titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Couleur') ?></th>
            <td><?= h($usersCustom->gs_couleur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Img Banniere') ?></th>
            <td><?= h($usersCustom->gs_img_banniere) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersCustom->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usersCustom->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usersCustom->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gs Is Livredor Active') ?></th>
            <td><?= $usersCustom->gs_is_livredor_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Ps Publicite') ?></h4>
        <?= $this->Text->autoParagraph(h($usersCustom->ps_publicite)); ?>
    </div>
</div>
