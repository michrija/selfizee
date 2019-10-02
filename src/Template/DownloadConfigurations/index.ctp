<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DownloadConfiguration[]|\Cake\Collection\CollectionInterface $downloadConfigurations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Download Configuration'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="downloadConfigurations index large-9 medium-8 columns content">
    <h3><?= __('Download Configurations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_oblig_ajout_infos_av_down') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evenement_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($downloadConfigurations as $downloadConfiguration): ?>
            <tr>
                <td><?= $this->Number->format($downloadConfiguration->id) ?></td>
                <td><?= h($downloadConfiguration->is_oblig_ajout_infos_av_down) ?></td>
                <td><?= $downloadConfiguration->has('evenement') ? $this->Html->link($downloadConfiguration->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $downloadConfiguration->evenement->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $downloadConfiguration->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $downloadConfiguration->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $downloadConfiguration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $downloadConfiguration->id)]) ?>
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
