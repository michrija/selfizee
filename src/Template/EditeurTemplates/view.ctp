<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EditeurTemplate $editeurTemplate
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Editeur Template'), ['action' => 'edit', $editeurTemplate->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Editeur Template'), ['action' => 'delete', $editeurTemplate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $editeurTemplate->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Editeur Templates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Editeur Template'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="editeurTemplates view large-9 medium-8 columns content">
    <h3><?= h($editeurTemplate->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fond') ?></th>
            <td><?= h($editeurTemplate->fond) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Element') ?></th>
            <td><?= h($editeurTemplate->element) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contours') ?></th>
            <td><?= h($editeurTemplate->contours) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($editeurTemplate->id) ?></td>
        </tr>
    </table>
</div>
