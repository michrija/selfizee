<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GalerieCommentaire $galerieCommentaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $galerieCommentaire->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $galerieCommentaire->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Galerie Commentaires'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Galeries'), ['controller' => 'Galeries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Galery'), ['controller' => 'Galeries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="galerieCommentaires form large-9 medium-8 columns content">
    <?= $this->Form->create($galerieCommentaire) ?>
    <fieldset>
        <legend><?= __('Edit Galerie Commentaire') ?></legend>
        <?php
            echo $this->Form->control('commentateur_name');
            echo $this->Form->control('commentaire');
            echo $this->Form->control('galerie_id', ['options' => $galeries]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
