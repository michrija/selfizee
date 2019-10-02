<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ecran[]|\Cake\Collection\CollectionInterface $ecrans
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ecran'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['controller' => 'ConfigurationBornes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['controller' => 'ConfigurationBornes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ecrans index large-9 medium-8 columns content">
    <h3><?= __('Ecrans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_accueil') ?></th>
                <th scope="col"><?= $this->Paginator->sort('btn_page_accueil') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_prise_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_prise_photo_visualisation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_choix_filtre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_remerciement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_choix_fond_vert') ?></th>
                <th scope="col"><?= $this->Paginator->sort('configuration_borne_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ecrans as $ecran): ?>
            <tr>
                <td><?= $this->Number->format($ecran->id) ?></td>
                <td><?= h($ecran->page_accueil) ?></td>
                <td><?= h($ecran->btn_page_accueil) ?></td>
                <td><?= h($ecran->page_prise_photo) ?></td>
                <td><?= h($ecran->page_prise_photo_visualisation) ?></td>
                <td><?= h($ecran->page_choix_filtre) ?></td>
                <td><?= h($ecran->page_remerciement) ?></td>
                <td><?= h($ecran->page_choix_fond_vert) ?></td>
                <td><?= $ecran->has('configuration_borne') ? $this->Html->link($ecran->configuration_borne->id, ['controller' => 'ConfigurationBornes', 'action' => 'view', $ecran->configuration_borne->id]) : '' ?></td>
                <td><?= h($ecran->created) ?></td>
                <td><?= h($ecran->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ecran->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ecran->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ecran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ecran->id)]) ?>
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
