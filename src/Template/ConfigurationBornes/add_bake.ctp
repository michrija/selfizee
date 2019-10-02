<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigurationBorne $configurationBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Animations'), ['controller' => 'TypeAnimations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Animation'), ['controller' => 'TypeAnimations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multiconfigurations'), ['controller' => 'Multiconfigurations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multiconfiguration'), ['controller' => 'Multiconfigurations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['controller' => 'TypeImprimantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['controller' => 'TypeImprimantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Bornes'), ['controller' => 'ModelBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Borne'), ['controller' => 'ModelBornes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cadres'), ['controller' => 'Cadres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'Cadres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ecrans'), ['controller' => 'Ecrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ecran'), ['controller' => 'Ecrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Filtre Configuration Bornes'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Filtre Configuration Borne'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['controller' => 'FondVerts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['controller' => 'FondVerts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configurationBornes form large-9 medium-8 columns content">
    <?= $this->Form->create($configurationBorne) ?>
    <fieldset>
        <legend><?= __('Add Configuration Borne') ?></legend>
        <?php
            echo $this->Form->control('evenement_id', ['options' => $evenements, 'empty' => true]);
            echo $this->Form->control('type_animation_id', ['options' => $typeAnimations]);
            echo $this->Form->control('nbr_pose');
            echo $this->Form->control('disposition_vignette');
            echo $this->Form->control('multiconfiguration_id', ['options' => $multiconfigurations, 'empty' => true]);
            echo $this->Form->control('decompte_prise_photo');
            echo $this->Form->control('decompte_time_out');
            echo $this->Form->control('is_reprise_photo');
            echo $this->Form->control('is_prise_coordonnee');
            echo $this->Form->control('is_impression');
            echo $this->Form->control('is_multi_impression');
            echo $this->Form->control('nbr_max_impression');
            echo $this->Form->control('nbr_max_photo');
            echo $this->Form->control('texte_impression');
            echo $this->Form->control('is_impression_auto');
            echo $this->Form->control('nbr_copie_impression_auto');
            echo $this->Form->control('type_imprimante_id', ['options' => $typeImprimantes, 'empty' => true]);
            echo $this->Form->control('model_borne_id', ['options' => $modelBornes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
