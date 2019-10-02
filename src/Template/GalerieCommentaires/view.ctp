<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GalerieCommentaire $galerieCommentaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Galerie Commentaire'), ['action' => 'edit', $galerieCommentaire->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Galerie Commentaire'), ['action' => 'delete', $galerieCommentaire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $galerieCommentaire->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Galerie Commentaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Galerie Commentaire'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Galeries'), ['controller' => 'Galeries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Galery'), ['controller' => 'Galeries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="galerieCommentaires view large-9 medium-8 columns content">
    <h3><?= h($galerieCommentaire->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Commentateur Name') ?></th>
            <td><?= h($galerieCommentaire->commentateur_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Galery') ?></th>
            <td><?= $galerieCommentaire->has('galery') ? $this->Html->link($galerieCommentaire->galery->id, ['controller' => 'Galeries', 'action' => 'view', $galerieCommentaire->galery->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($galerieCommentaire->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($galerieCommentaire->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($galerieCommentaire->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Commentaire') ?></h4>
        <?= $this->Text->autoParagraph(h($galerieCommentaire->commentaire)); ?>
    </div>
</div>
