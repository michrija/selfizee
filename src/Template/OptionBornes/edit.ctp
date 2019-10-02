<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OptionBorne $optionBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $optionBorne->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $optionBorne->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Option Bornes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="optionBornes form large-9 medium-8 columns content">
    <?= $this->Form->create($optionBorne) ?>
    <fieldset>
        <legend><?= __('Edit Option Borne') ?></legend>
        <?php
            echo $this->Form->control('chemin_dossier_assets');
            echo $this->Form->control('chemin_dossier_events');
            echo $this->Form->control('fichier_setting_base');
            echo $this->Form->control('ftp_server');
            echo $this->Form->control('ftp_password');
            echo $this->Form->control('ftp_port');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
