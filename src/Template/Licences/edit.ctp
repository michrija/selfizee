<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Licence $licence
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $licence->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $licence->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Licences'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="licences form large-9 medium-8 columns content">
    <?= $this->Form->create($licence) ?>
    <fieldset>
        <legend><?= __('Edit Licence') ?></legend>
        <?php
            echo $this->Form->control('id_borne');
            echo $this->Form->control('duree');
            echo $this->Form->control('numero_serie_non_crypte');
            echo $this->Form->control('numero_serie_crypte');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
