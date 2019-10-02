<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacebookAuto $facebookAuto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $facebookAuto->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $facebookAuto->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Facebook Autos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Facebook Auto Suivis'), ['controller' => 'FacebookAutoSuivis', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facebook Auto Suivi'), ['controller' => 'FacebookAutoSuivis', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facebookAutos form large-9 medium-8 columns content">
    <?= $this->Form->create($facebookAuto) ?>
    <fieldset>
        <legend><?= __('Edit Facebook Auto') ?></legend>
        <?php
            echo $this->Form->control('evenement_id', ['options' => $evenements]);
            echo $this->Form->control('id_in_facebook');
            echo $this->Form->control('token_facebook');
            echo $this->Form->control('id_album_in_facebook');
            echo $this->Form->control('name_in_facebook');
            echo $this->Form->control('name_album_in_facebook');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
