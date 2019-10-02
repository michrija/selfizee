<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EditeurTemplatesPhoto $editeurTemplatesPhoto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Editeur Templates Photo'), ['action' => 'edit', $editeurTemplatesPhoto->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Editeur Templates Photo'), ['action' => 'delete', $editeurTemplatesPhoto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $editeurTemplatesPhoto->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Editeur Templates Photos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Editeur Templates Photo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Editeur Templates'), ['controller' => 'EditeurTemplates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Editeur Template'), ['controller' => 'EditeurTemplates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="editeurTemplatesPhotos view large-9 medium-8 columns content">
    <h3><?= h($editeurTemplatesPhoto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('File') ?></th>
            <td><?= h($editeurTemplatesPhoto->file) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Editeur Template') ?></th>
            <td><?= $editeurTemplatesPhoto->has('editeur_template') ? $this->Html->link($editeurTemplatesPhoto->editeur_template->id, ['controller' => 'EditeurTemplates', 'action' => 'view', $editeurTemplatesPhoto->editeur_template->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($editeurTemplatesPhoto->id) ?></td>
        </tr>
    </table>
</div>
