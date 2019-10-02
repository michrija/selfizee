<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DownloadConfiguration $downloadConfiguration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $downloadConfiguration->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $downloadConfiguration->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Download Configurations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="downloadConfigurations form large-9 medium-8 columns content">
    <?= $this->Form->create($downloadConfiguration) ?>
    <fieldset>
        <legend><?= __('Edit Download Configuration') ?></legend>
        <?php
            echo $this->Form->control('is_oblig_ajout_infos_av_down');
            echo $this->Form->control('evenement_id', ['options' => $evenements, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
