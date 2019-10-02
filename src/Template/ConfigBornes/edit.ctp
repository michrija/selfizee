<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigBorne $configBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $configBorne->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $configBorne->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Config Bornes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Mise En Pages'), ['controller' => 'TypeMiseEnPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Mise En Page'), ['controller' => 'TypeMiseEnPages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Catalogues'), ['controller' => 'Catalogues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Catalogue'), ['controller' => 'Catalogues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taille Ecrans'), ['controller' => 'TailleEcrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taille Ecran'), ['controller' => 'TailleEcrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['controller' => 'TypeImprimantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['controller' => 'TypeImprimantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cadres'), ['controller' => 'Cadres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'Cadres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configborne Has Filtres'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configborne Has Filtre'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configborne Has Typeanimations'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configborne Has Typeanimation'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ecrans'), ['controller' => 'Ecrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ecran'), ['controller' => 'Ecrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['controller' => 'FondVerts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['controller' => 'FondVerts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Image Fond Verts'), ['controller' => 'ImageFondVerts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image Fond Vert'), ['controller' => 'ImageFondVerts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configBornes form large-9 medium-8 columns content">
    <?= $this->Form->create($configBorne) ?>
    <fieldset>
        <legend><?= __('Edit Config Borne') ?></legend>
        <?php
            echo $this->Form->control('evenement_id', ['options' => $evenements, 'empty' => true]);
            echo $this->Form->control('type_mise_en_page_id', ['options' => $typeMiseEnPages]);
            echo $this->Form->control('catalogue_id', ['options' => $catalogues]);
            echo $this->Form->control('decompte_prise_photo');
            echo $this->Form->control('is_reprise_photo');
            echo $this->Form->control('is_incrustation_fond_vert');
            echo $this->Form->control('is_prise_coordonnee');
            echo $this->Form->control('titre_formulaire');
            echo $this->Form->control('is_impression');
            echo $this->Form->control('is_multi_impression');
            echo $this->Form->control('nbr_max_multi_impression');
            echo $this->Form->control('has_limite_impression');
            echo $this->Form->control('nbr_max_photo');
            echo $this->Form->control('texte_impression');
            echo $this->Form->control('is_impression_auto');
            echo $this->Form->control('nbr_copie_impression_auto');
            echo $this->Form->control('decompte_time_out');
            echo $this->Form->control('num_borne');
            echo $this->Form->control('taille_ecran_id', ['options' => $tailleEcrans, 'empty' => true]);
            echo $this->Form->control('type_imprimante_id', ['options' => $typeImprimantes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
