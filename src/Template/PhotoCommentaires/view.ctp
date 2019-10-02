<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PhotoCommentaire $photoCommentaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Photo Commentaire'), ['action' => 'edit', $photoCommentaire->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Photo Commentaire'), ['action' => 'delete', $photoCommentaire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $photoCommentaire->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Photo Commentaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo Commentaire'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="photoCommentaires view large-9 medium-8 columns content">
    <h3><?= h($photoCommentaire->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Commentateur Name') ?></th>
            <td><?= h($photoCommentaire->commentateur_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= $photoCommentaire->has('photo') ? $this->Html->link($photoCommentaire->photo->name, ['controller' => 'Photos', 'action' => 'view', $photoCommentaire->photo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($photoCommentaire->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($photoCommentaire->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($photoCommentaire->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Commentaire') ?></h4>
        <?= $this->Text->autoParagraph(h($photoCommentaire->commentaire)); ?>
    </div>
</div>
