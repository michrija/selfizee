<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Licence[]|\Cake\Collection\CollectionInterface $licences
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Licence'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="licences index large-9 medium-8 columns content">
    <h3><?= __('Licences') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_borne') ?></th>
                <th scope="col"><?= $this->Paginator->sort('duree') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero_serie_non_crypte') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($licences as $licence): ?>
            <tr>
                <td><?= $this->Number->format($licence->id) ?></td>
                <td><?= h($licence->id_borne) ?></td>
                <td><?= h($licence->duree) ?></td>
                <td><?= h($licence->numero_serie_non_crypte) ?></td>
                <td><?= h($licence->created) ?></td>
                <td><?= h($licence->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $licence->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $licence->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $licence->id], ['confirm' => __('Are you sure you want to delete # {0}?', $licence->id)]) ?>
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
