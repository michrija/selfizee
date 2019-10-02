<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ecran $ecran
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Ecrans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ecrans form large-9 medium-8 columns content">
    <?= $this->Form->create($ecran) ?>
    <fieldset>
        <legend><?= __('Add Ecran') ?></legend>
        <?php
            echo $this->Form->control('page_accueil');
            echo $this->Form->control('btn_page_accueil');
            echo $this->Form->control('page_prise_photo');
            echo $this->Form->control('page_prise_photo_visualisation');
            echo $this->Form->control('page_choix_filtre');
            echo $this->Form->control('page_remerciement');
            echo $this->Form->control('page_choix_fond_vert');
            echo $this->Form->control('configuration_borne_id', ['options' => $configurationBornes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
