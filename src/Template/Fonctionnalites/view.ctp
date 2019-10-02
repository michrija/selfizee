<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fonctionnalite $fonctionnalite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fonctionnalite'), ['action' => 'edit', $fonctionnalite->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fonctionnalite'), ['action' => 'delete', $fonctionnalite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fonctionnalite->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fonctionnalites'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonctionnalite'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fonctionalite Evenements'), ['controller' => 'FonctionaliteEvenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonctionalite Evenement'), ['controller' => 'FonctionaliteEvenements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fonctionnalites view large-9 medium-8 columns content">
    <h3><?= h($fonctionnalite->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($fonctionnalite->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Titre Link') ?></th>
            <td><?= h($fonctionnalite->titre_link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($fonctionnalite->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fonctionnalite->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordre') ?></th>
            <td><?= $this->Number->format($fonctionnalite->ordre) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($fonctionnalite->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Texte Helper') ?></h4>
        <?= $this->Text->autoParagraph(h($fonctionnalite->texte_helper)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fonctionalite Evenements') ?></h4>
        <?php if (!empty($fonctionnalite->fonctionalite_evenements)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Evenement Id') ?></th>
                <th scope="col"><?= __('Fonctionnalite Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fonctionnalite->fonctionalite_evenements as $fonctionaliteEvenements): ?>
            <tr>
                <td><?= h($fonctionaliteEvenements->id) ?></td>
                <td><?= h($fonctionaliteEvenements->evenement_id) ?></td>
                <td><?= h($fonctionaliteEvenements->fonctionnalite_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FonctionaliteEvenements', 'action' => 'view', $fonctionaliteEvenements->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FonctionaliteEvenements', 'action' => 'edit', $fonctionaliteEvenements->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FonctionaliteEvenements', 'action' => 'delete', $fonctionaliteEvenements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fonctionaliteEvenements->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
