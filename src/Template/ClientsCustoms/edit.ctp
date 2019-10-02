<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsCustom $clientsCustom
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clientsCustom->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clientsCustom->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Clients Customs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientsCustoms form large-9 medium-8 columns content">
    <?= $this->Form->create($clientsCustom) ?>
    <fieldset>
        <legend><?= __('Edit Clients Custom') ?></legend>
        <?php
            echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true]);
            echo $this->Form->control('signature_email');
            echo $this->Form->control('ps_publicite');
            echo $this->Form->control('ps_bandeau_par_defaut');
            echo $this->Form->control('ps_couleur_de_fond');
            echo $this->Form->control('gs_nom');
            echo $this->Form->control('gs_slug');
            echo $this->Form->control('gs_is_public');
            echo $this->Form->control('gs_titre');
            echo $this->Form->control('gs_sous_titre');
            echo $this->Form->control('gs_couleur');
            echo $this->Form->control('gs_img_banniere');
            echo $this->Form->control('gs_is_livredor_active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
