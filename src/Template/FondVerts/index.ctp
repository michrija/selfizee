<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FondVert[]|\Cake\Collection\CollectionInterface $fondVerts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fondVerts index large-9 medium-8 columns content">
    <h3><?= __('Fond Verts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('configuration_borne_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fondVerts as $fondVert): ?>
            <tr>
                <td><?= $this->Number->format($fondVert->id) ?></td>
                <td><?= h($fondVert->file_name) ?></td>
                <td><?= $this->Number->format($fondVert->ordre) ?></td>
                <td><?= $fondVert->has('configuration_borne') ? $this->Html->link($fondVert->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $fondVert->configuration_borne->id]) : '' ?></td>
                <td><?= h($fondVert->created) ?></td>
                <td><?= h($fondVert->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fondVert->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fondVert->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fondVert->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fondVert->id)]) ?>
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
