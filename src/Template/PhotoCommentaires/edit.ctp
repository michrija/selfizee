<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PhotoCommentaire $photoCommentaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $photoCommentaire->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $photoCommentaire->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Photo Commentaires'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="photoCommentaires form large-9 medium-8 columns content">
    <?= $this->Form->create($photoCommentaire) ?>
    <fieldset>
        <legend><?= __('Edit Photo Commentaire') ?></legend>
        <?php
            echo $this->Form->control('commentateur_name');
            echo $this->Form->control('commentaire');
            echo $this->Form->control('photo_id', ['options' => $photos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
