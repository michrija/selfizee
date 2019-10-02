<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NomDeDomaine $nomDeDomaine
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Nom De Domaine'), ['action' => 'edit', $nomDeDomaine->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Nom De Domaine'), ['action' => 'delete', $nomDeDomaine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nomDeDomaine->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Nom De Domaines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nom De Domaine'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="nomDeDomaines view large-9 medium-8 columns content">
    <h3><?= h($nomDeDomaine->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom De Domaine') ?></th>
            <td><?= h($nomDeDomaine->nom_de_domaine) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($nomDeDomaine->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($nomDeDomaine->id) ?></td>
        </tr>
    </table>
</div>
