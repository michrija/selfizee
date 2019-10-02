<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactToSendManuel $contactToSendManuel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contactToSendManuel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contactToSendManuel->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contact To Send Manuels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Envoi Manuels'), ['controller' => 'EnvoiManuels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Envoi Manuel'), ['controller' => 'EnvoiManuels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contactToSendManuels form large-9 medium-8 columns content">
    <?= $this->Form->create($contactToSendManuel) ?>
    <fieldset>
        <legend><?= __('Edit Contact To Send Manuel') ?></legend>
        <?php
            echo $this->Form->control('contact_id', ['options' => $contacts]);
            echo $this->Form->control('envoi_manuel_id', ['options' => $envoiManuels]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
