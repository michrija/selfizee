<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactService $contactService
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contactService->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contactService->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contact Services'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contactServices form large-9 medium-8 columns content">
    <?= $this->Form->create($contactService) ?>
    <fieldset>
        <legend><?= __('Edit Contact Service') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('email');
            echo $this->Form->control('objet');
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
