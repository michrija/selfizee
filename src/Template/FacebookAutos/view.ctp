<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacebookAuto $facebookAuto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Facebook Auto'), ['action' => 'edit', $facebookAuto->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Facebook Auto'), ['action' => 'delete', $facebookAuto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facebookAuto->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Facebook Autos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facebook Auto'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facebook Auto Suivis'), ['controller' => 'FacebookAutoSuivis', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facebook Auto Suivi'), ['controller' => 'FacebookAutoSuivis', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facebookAutos view large-9 medium-8 columns content">
    <h3><?= h($facebookAuto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $facebookAuto->has('evenement') ? $this->Html->link($facebookAuto->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $facebookAuto->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id In Facebook') ?></th>
            <td><?= h($facebookAuto->id_in_facebook) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Album In Facebook') ?></th>
            <td><?= h($facebookAuto->id_album_in_facebook) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name In Facebook') ?></th>
            <td><?= h($facebookAuto->name_in_facebook) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Album In Facebook') ?></th>
            <td><?= h($facebookAuto->name_album_in_facebook) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($facebookAuto->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Token Facebook') ?></h4>
        <?= $this->Text->autoParagraph(h($facebookAuto->token_facebook)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Facebook Auto Suivis') ?></h4>
        <?php if (!empty($facebookAuto->facebook_auto_suivis)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Facebook Auto Id') ?></th>
                <th scope="col"><?= __('Photo Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modifed') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($facebookAuto->facebook_auto_suivis as $facebookAutoSuivis): ?>
            <tr>
                <td><?= h($facebookAutoSuivis->id) ?></td>
                <td><?= h($facebookAutoSuivis->facebook_auto_id) ?></td>
                <td><?= h($facebookAutoSuivis->photo_id) ?></td>
                <td><?= h($facebookAutoSuivis->created) ?></td>
                <td><?= h($facebookAutoSuivis->modifed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FacebookAutoSuivis', 'action' => 'view', $facebookAutoSuivis->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FacebookAutoSuivis', 'action' => 'edit', $facebookAutoSuivis->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FacebookAutoSuivis', 'action' => 'delete', $facebookAutoSuivis->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facebookAutoSuivis->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
