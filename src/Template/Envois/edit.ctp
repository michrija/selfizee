<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Envois $envois
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $envois->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $envois->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Envois'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="envois form large-9 medium-8 columns content">
    <?= $this->Form->create($envois) ?>
    <fieldset>
        <legend><?= __('Edit Envois') ?></legend>
        <?php
            echo $this->Form->control('contact_id', ['options' => $contacts]);
            echo $this->Form->control('envoi_type');
            echo $this->Form->control('is_force_envoi');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
