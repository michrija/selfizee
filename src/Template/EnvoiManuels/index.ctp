<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnvoiManuel[]|\Cake\Collection\CollectionInterface $envoiManuels
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Envoi Manuel'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contact To Send Manuels'), ['controller' => 'ContactToSendManuels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact To Send Manuel'), ['controller' => 'ContactToSendManuels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="envoiManuels index large-9 medium-8 columns content">
    <h3><?= __('Envoi Manuels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_notify') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_sms') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_force_envoi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($envoiManuels as $envoiManuel): ?>
            <tr>
                <td><?= $this->Number->format($envoiManuel->id) ?></td>
                <td><?= h($envoiManuel->email_notify) ?></td>
                <td><?= $envoiManuel->has('evenement') ? $this->Html->link($envoiManuel->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $envoiManuel->evenement->id]) : '' ?></td>
                <td><?= h($envoiManuel->is_email) ?></td>
                <td><?= h($envoiManuel->is_sms) ?></td>
                <td><?= h($envoiManuel->is_force_envoi) ?></td>
                <td><?= h($envoiManuel->created) ?></td>
                <td><?= h($envoiManuel->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $envoiManuel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $envoiManuel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $envoiManuel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $envoiManuel->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
