<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeClient $typeClient
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typeClient->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typeClient->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Type Clients'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="typeClients form large-9 medium-8 columns content">
    <?= $this->Form->create($typeClient) ?>
    <fieldset>
        <legend><?= __('Edit Type Client') ?></legend>
        <?php
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
