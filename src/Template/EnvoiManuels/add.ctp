<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnvoiManuel $envoiManuel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Envoi Manuels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contact To Send Manuels'), ['controller' => 'ContactToSendManuels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact To Send Manuel'), ['controller' => 'ContactToSendManuels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="envoiManuels form large-9 medium-8 columns content">
    <?= $this->Form->create($envoiManuel) ?>
    <fieldset>
        <legend><?= __('Add Envoi Manuel') ?></legend>
        <?php
            echo $this->Form->control('email_notify');
            echo $this->Form->control('evenement_id', ['options' => $evenements]);
            echo $this->Form->control('is_email');
            echo $this->Form->control('is_sms');
            echo $this->Form->control('is_force_envoi');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
