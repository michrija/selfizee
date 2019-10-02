<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EditeurTemplate $editeurTemplate
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $editeurTemplate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $editeurTemplate->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Editeur Templates'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="editeurTemplates form large-9 medium-8 columns content">
    <?= $this->Form->create($editeurTemplate) ?>
    <fieldset>
        <legend><?= __('Edit Editeur Template') ?></legend>
        <?php
            echo $this->Form->control('fond');
            echo $this->Form->control('element');
            echo $this->Form->control('contours');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
