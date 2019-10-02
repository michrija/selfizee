<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EditeurTemplatesPhoto $editeurTemplatesPhoto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $editeurTemplatesPhoto->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $editeurTemplatesPhoto->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Editeur Templates Photos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Editeur Templates'), ['controller' => 'EditeurTemplates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Editeur Template'), ['controller' => 'EditeurTemplates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="editeurTemplatesPhotos form large-9 medium-8 columns content">
    <?= $this->Form->create($editeurTemplatesPhoto) ?>
    <fieldset>
        <legend><?= __('Edit Editeur Templates Photo') ?></legend>
        <?php
            echo $this->Form->control('file');
            echo $this->Form->control('editeur_template_id', ['options' => $editeurTemplates]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
