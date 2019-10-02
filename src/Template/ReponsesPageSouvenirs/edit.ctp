<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReponsesPageSouvenir $reponsesPageSouvenir
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reponsesPageSouvenir->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reponsesPageSouvenir->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reponses Page Souvenirs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Champ Options'), ['controller' => 'ChampOptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ Option'), ['controller' => 'ChampOptions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Page Souvenirs'), ['controller' => 'PageSouvenirs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Page Souvenir'), ['controller' => 'PageSouvenirs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reponsesPageSouvenirs form large-9 medium-8 columns content">
    <?= $this->Form->create($reponsesPageSouvenir) ?>
    <fieldset>
        <legend><?= __('Edit Reponses Page Souvenir') ?></legend>
        <?php
            echo $this->Form->control('value_text');
            echo $this->Form->control('champ_option_id', ['options' => $champOptions, 'empty' => true]);
            echo $this->Form->control('champ_id', ['options' => $champs, 'empty' => true]);
            echo $this->Form->control('photo_id', ['options' => $photos, 'empty' => true]);
            echo $this->Form->control('page_souvenir_id', ['options' => $pageSouvenirs, 'empty' => true]);
            echo $this->Form->control('queque');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
