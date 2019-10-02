<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacebookAutoSuivi $facebookAutoSuivi
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Facebook Auto Suivis'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Facebook Autos'), ['controller' => 'FacebookAutos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facebook Auto'), ['controller' => 'FacebookAutos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facebookAutoSuivis form large-9 medium-8 columns content">
    <?= $this->Form->create($facebookAutoSuivi) ?>
    <fieldset>
        <legend><?= __('Add Facebook Auto Suivi') ?></legend>
        <?php
            echo $this->Form->control('facebook_auto_id', ['options' => $facebookAutos]);
            echo $this->Form->control('photo_id', ['options' => $photos]);
            echo $this->Form->control('modifed', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
