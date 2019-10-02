<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\ModelBorne[]|\Cake\Collection\CollectionInterface $modelBornes
*/
?>

<!-- Footable -->
<?= $this->Html->script('footable/footable.all.min.js', ['block' => true]); ?>
<!--FooTable init-->
<?= $this->Html->script('footable-init.js', ['block' => true]); ?>
    
<?php
$titrePage = "Liste des utilisateurs" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>
<div class="row">
    <div class="col-md-12">
        <div class="kl_filtreEvenement pb-3">
          <div class="row">
                <?php echo $this->Form->create(null, ['type' => 'get' ,'class'=>'form-inline','role'=>'form']); ?>
                <div class="col-md-5 pr-2 ">
                <?php echo $this->Form->control('name',[ 'label'=>'Nom du client', 'class'=>'form-control search w-100','placeholder'=>'Rechercher...','default'=> $namekey ]); ?>  
                </div>
                <div class="col-md-4">
                <?php echo $this->Form->control('type',['empty' => 'Séléctionner le type','options'=>$typeclient,'label'=>'Type du client', 'class'=>'form-control search w-100','placeholder'=>'Rechercher...']); ?>  
                </div>
               <div class="col-md-3 pt-4 pull-right">
           
                <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => 'false' ,'class' => 'btn btn-primary  '] );  ?>  
                <?php echo $this->Html->link('<i class="fa fa-refresh"></i>', ['action' => 'index'], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-success  ", "escape"=>false]); ?>
               
               
               </div>
                <?php echo $this->Form->end(); ?>  
           </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('user.login','Login') ?></th>
                                <th><a href="#">Nombre événements</a></th>
                                <!-- th scope="col"><?php echo $this->Paginator->sort('Role.nom','Type du Client') ?></th-->
                                <th></th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($clients as $client): ?>
                              

                                <tr>
                                    <td><?= $this->Html->link($client->nom, ['action' => 'add', $client->id]) ?></td>
                                    <td><?php if(!empty($client->user)) echo h($client->user->username) ?></td>
                                    <td><?=  count($client->evenements) ?></td>
									<?php if(false){ ?>
                                    <td>
                                         <?php foreach ($typeclientcombined as $key=>$value): ?>
                                           <?php if ($key==$client->client_type_id): ?> 
                                             <?= $value ?>
                                           <?php endif?> 
                                         <?php endforeach; ?>
                                    </td>    
									<?php } ?>
                                    <td>
                                    <?php 
                                        if(!empty($client->user)){ ?>
                                        <div class="pull-right m-b-15">
                                                <?php echo $this->Html->link('<i class="mdi mdi-lock-open"></i> Connecter à ce compte ',['controller' => 'Clients', 'action' => 'forceLogin', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'' ]); ?>
                                        </div>
                                    <?php } ?>
                                    </td>
                                    <td>
                                        <?= $this->Html->link(__('Configuration'), ['action' => 'board', $client->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
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
