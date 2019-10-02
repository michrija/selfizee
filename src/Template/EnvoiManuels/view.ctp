<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnvoiManuel $envoiManuel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Envoi Manuel'), ['action' => 'edit', $envoiManuel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Envoi Manuel'), ['action' => 'delete', $envoiManuel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $envoiManuel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Envoi Manuels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Envoi Manuel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contact To Send Manuels'), ['controller' => 'ContactToSendManuels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact To Send Manuel'), ['controller' => 'ContactToSendManuels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="envoiManuels view large-9 medium-8 columns content">
    <h3><?= h($envoiManuel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email Notify') ?></th>
            <td><?= h($envoiManuel->email_notify) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $envoiManuel->has('evenement') ? $this->Html->link($envoiManuel->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $envoiManuel->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($envoiManuel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($envoiManuel->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($envoiManuel->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Email') ?></th>
            <td><?= $envoiManuel->is_email ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Sms') ?></th>
            <td><?= $envoiManuel->is_sms ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Force Envoi') ?></th>
            <td><?= $envoiManuel->is_force_envoi ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Contact To Send Manuels') ?></h4>
        <?php if (!empty($envoiManuel->contact_to_send_manuels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Contact Id') ?></th>
                <th scope="col"><?= __('Envoi Manuel Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($envoiManuel->contact_to_send_manuels as $contactToSendManuels): ?>
            <tr>
                <td><?= h($contactToSendManuels->id) ?></td>
                <td><?= h($contactToSendManuels->contact_id) ?></td>
                <td><?= h($contactToSendManuels->envoi_manuel_id) ?></td>
                <td><?= h($contactToSendManuels->created) ?></td>
                <td><?= h($contactToSendManuels->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ContactToSendManuels', 'action' => 'view', $contactToSendManuels->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContactToSendManuels', 'action' => 'edit', $contactToSendManuels->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContactToSendManuels', 'action' => 'delete', $contactToSendManuels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactToSendManuels->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
