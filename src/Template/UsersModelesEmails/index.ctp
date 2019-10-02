<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersModelesEmail[]|\Cake\Collection\CollectionInterface $usersModelesEmails
 */
?>

<!-- Footable -->
<?= $this->Html->script('footable/footable.all.min.js', ['block' => true]); ?>
<!--FooTable init-->
<?= $this->Html->script('footable-init.js', ['block' => true]); ?>

<?php
$titrePage = "Liste des modèles emails" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Utilisateurs',
['controller' => 'Users', 'action' => 'index']
);
$this->Breadcrumbs->add(
$user->username,
['controller' => 'Users', 'action' => 'view', $user->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add', $user->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
$this->end();

?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('nom_modele') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('email_expediteur') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('nom_expediteur') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usersModelesEmails as $usersModelesEmail): ?>
                        <tr>
                            <td><?= $this->Html->link($usersModelesEmail->nom_modele, ['action' => 'edit', $user->id, $usersModelesEmail->id]) ?></td>
                            <td><?= $usersModelesEmail->email_expediteur ?></td>
                            <td><?= $usersModelesEmail->nom_expediteur ?></td>
                            <td><?= $usersModelesEmail->user->username ?></td>
                            <td>
                                <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersModelesEmail->id, $user->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="text-right">
                                    <ul class="pagination">
                                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                        <?= $this->Paginator->numbers() ?>
                                        <?= $this->Paginator->next(__('next') . ' >') ?>
                                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Modeles Email'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersModelesEmails index large-9 medium-8 columns content">
    <h3><?= __('Users Modeles Emails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_modele') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_expediteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_expediteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_photo_en_pj') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersModelesEmails as $usersModelesEmail): ?>
            <tr>
                <td><?= $this->Number->format($usersModelesEmail->id) ?></td>
                <td><?= h($usersModelesEmail->nom_modele) ?></td>
                <td><?= h($usersModelesEmail->email_expediteur) ?></td>
                <td><?= h($usersModelesEmail->nom_expediteur) ?></td>
                <td><?= h($usersModelesEmail->is_photo_en_pj) ?></td>
                <td><?= h($usersModelesEmail->created) ?></td>
                <td><?= h($usersModelesEmail->modified) ?></td>
                <td><?= $usersModelesEmail->has('user') ? $this->Html->link($usersModelesEmail->user->id, ['controller' => 'Users', 'action' => 'view', $usersModelesEmail->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersModelesEmail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersModelesEmail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersModelesEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersModelesEmail->id)]) ?>
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
-->
