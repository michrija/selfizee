<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReponsesPageSouvenir $reponsesPageSouvenir
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reponses Page Souvenir'), ['action' => 'edit', $reponsesPageSouvenir->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reponses Page Souvenir'), ['action' => 'delete', $reponsesPageSouvenir->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reponsesPageSouvenir->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reponses Page Souvenirs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reponses Page Souvenir'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Champ Options'), ['controller' => 'ChampOptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champ Option'), ['controller' => 'ChampOptions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Page Souvenirs'), ['controller' => 'PageSouvenirs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Souvenir'), ['controller' => 'PageSouvenirs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reponsesPageSouvenirs view large-9 medium-8 columns content">
    <h3><?= h($reponsesPageSouvenir->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Value Text') ?></th>
            <td><?= h($reponsesPageSouvenir->value_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Champ Option') ?></th>
            <td><?= $reponsesPageSouvenir->has('champ_option') ? $this->Html->link($reponsesPageSouvenir->champ_option->id, ['controller' => 'ChampOptions', 'action' => 'view', $reponsesPageSouvenir->champ_option->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Champ') ?></th>
            <td><?= $reponsesPageSouvenir->has('champ') ? $this->Html->link($reponsesPageSouvenir->champ->id, ['controller' => 'Champs', 'action' => 'view', $reponsesPageSouvenir->champ->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= $reponsesPageSouvenir->has('photo') ? $this->Html->link($reponsesPageSouvenir->photo->name, ['controller' => 'Photos', 'action' => 'view', $reponsesPageSouvenir->photo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Souvenir') ?></th>
            <td><?= $reponsesPageSouvenir->has('page_souvenir') ? $this->Html->link($reponsesPageSouvenir->page_souvenir->id, ['controller' => 'PageSouvenirs', 'action' => 'view', $reponsesPageSouvenir->page_souvenir->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Queque') ?></th>
            <td><?= h($reponsesPageSouvenir->queque) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reponsesPageSouvenir->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($reponsesPageSouvenir->created) ?></td>
        </tr>
    </table>
</div>
