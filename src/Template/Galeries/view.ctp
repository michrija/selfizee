<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Galery $galery
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Galery'), ['action' => 'edit', $galery->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Galery'), ['action' => 'delete', $galery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $galery->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Galeries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Galery'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="galeries view large-9 medium-8 columns content">
    <h3><?= h($galery->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($galery->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($galery->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Public') ?></th>
            <td><?= h($galery->is_public) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Titre') ?></th>
            <td><?= h($galery->titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sous Titre') ?></th>
            <td><?= h($galery->sous_titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Couleur') ?></th>
            <td><?= h($galery->couleur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Img Banniere') ?></th>
            <td><?= h($galery->img_banniere) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($galery->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($galery->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($galery->modified) ?></td>
        </tr>
    </table>
</div>
