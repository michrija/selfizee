<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacebookAutoSuivi $facebookAutoSuivi
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Facebook Auto Suivi'), ['action' => 'edit', $facebookAutoSuivi->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Facebook Auto Suivi'), ['action' => 'delete', $facebookAutoSuivi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facebookAutoSuivi->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Facebook Auto Suivis'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facebook Auto Suivi'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facebook Autos'), ['controller' => 'FacebookAutos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facebook Auto'), ['controller' => 'FacebookAutos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facebookAutoSuivis view large-9 medium-8 columns content">
    <h3><?= h($facebookAutoSuivi->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Facebook Auto') ?></th>
            <td><?= $facebookAutoSuivi->has('facebook_auto') ? $this->Html->link($facebookAutoSuivi->facebook_auto->id, ['controller' => 'FacebookAutos', 'action' => 'view', $facebookAutoSuivi->facebook_auto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= $facebookAutoSuivi->has('photo') ? $this->Html->link($facebookAutoSuivi->photo->name, ['controller' => 'Photos', 'action' => 'view', $facebookAutoSuivi->photo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($facebookAutoSuivi->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($facebookAutoSuivi->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modifed') ?></th>
            <td><?= h($facebookAutoSuivi->modifed) ?></td>
        </tr>
    </table>
</div>
