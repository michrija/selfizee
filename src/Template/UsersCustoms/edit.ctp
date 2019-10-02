<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersCustom $usersCustom
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersCustom->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersCustom->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users Customs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCustoms form large-9 medium-8 columns content">
    <?= $this->Form->create($usersCustom) ?>
    <fieldset>
        <legend><?= __('Edit Users Custom') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
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
