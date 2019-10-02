<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsModelesSms[]|\Cake\Collection\CollectionInterface $clientsModelesSmss
 */
?>

<?= $this->Html->script('clients/modele_email.js', ['block' => true]); ?>

<?php
$titrePage = "Liste des modèles Sms" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add(
$client->nom,
['controller' => 'Clients', 'action' => 'view', $client->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
//echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add', $client->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
echo $this->Form->button('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success", 'type'=>'button', 'data-toggle'=>'modal', 'data-target'=>'#exampleModal' ]);
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
                            <th scope="col"><?= $this->Paginator->sort('nom_modele', 'Nom modèle') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('expediteur') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('client_id', 'Client') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($clientsModelesSmss as $clientsModelesSms): ?>
                        <tr>
                            <td><?= $this->Html->link($clientsModelesSms->nom_modele, ['action' => 'edit', $clientsModelesSms->client_id, $clientsModelesSms->id]) ?></td>
                            <td><?= $clientsModelesSms->expediteur ?></td>
                            <td><?= $clientsModelesSms->client->nom ?></td>
                            <td>
                                <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientsModelesSms->id, $clientsModelesSms->client_id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
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


<!--MODAL CREATION MODEL-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Ajout modèle sms</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?php echo $this->Form->create(null, ['url'=>['controller'=>'ClientsModelesSmss', 'action'=>'add', $client->id] ,'type' => 'get','role'=>'form']); ?>
            <div class="modal-body">
                <?php echo $this->Form->control(' ', ['type'=>'checkbox', 'label'=>'Créer un modèle vierge', 'id'=>'id_modele_vierge', 'hiddenField' => false,
                'templates' => ['checkboxContainer' => '{{content}}' ]]); ?>
                <?php echo $this->Form->control(' ', ['type'=>'checkbox', 'label'=>'Créer à partir d\'un modèle existant', 'id'=>'id_modele_existant', 'hiddenField' => false,
                'templates' => ['checkboxContainer' => '{{content}}' ]]); ?>
                <?php

                echo $this->Form->control('modele_id', [
                'empty'=>'Sélectionner',
                'label'=>false,
                'class'=>'form-control hide',
                'type' => 'select',
                'multiple' => false,
                'required'=>false,
                'id'=>'list_modeles',
                'options' => $modeles
                ]);
                ?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Créer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>