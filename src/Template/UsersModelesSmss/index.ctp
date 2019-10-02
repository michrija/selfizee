<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersModelesSms[]|\Cake\Collection\CollectionInterface $usersModelesSmss
 */
?>

<?php
$titrePage = "Liste des modèles Sms" ;
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
                            <th scope="col"><?= $this->Paginator->sort('expediteur') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usersModelesSmss as $usersModelesSms): ?>
                        <tr>
                            <td><?= $this->Html->link($usersModelesSms->nom_modele, ['action' => 'edit', $user->id, $usersModelesSms->id]) ?></td>
                            <td><?= $usersModelesSms->expediteur ?></td>
                            <td><?= $usersModelesSms->user->username ?></td>
                            <td>
                                <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersModelesSms->id, $user->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
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

<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Modeles Sms'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersModelesSmss index large-9 medium-8 columns content">
    <h3><?= __('Users Modeles Smss') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_modele') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expediteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nb_caractere') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nbr_sms') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersModelesSmss as $usersModelesSms): ?>
            <tr>
                <td><?= $this->Number->format($usersModelesSms->id) ?></td>
                <td><?= h($usersModelesSms->nom_modele) ?></td>
                <td><?= h($usersModelesSms->expediteur) ?></td>
                <td><?= h($usersModelesSms->created) ?></td>
                <td><?= h($usersModelesSms->modified) ?></td>
                <td><?= $usersModelesSms->has('user') ? $this->Html->link($usersModelesSms->user->id, ['controller' => 'Users', 'action' => 'view', $usersModelesSms->user->id]) : '' ?></td>
                <td><?= $this->Number->format($usersModelesSms->nb_caractere) ?></td>
                <td><?= $this->Number->format($usersModelesSms->nbr_sms) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersModelesSms->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersModelesSms->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersModelesSms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersModelesSms->id)]) ?>
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
</div>-->
