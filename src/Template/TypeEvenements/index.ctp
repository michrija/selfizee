<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeEvenement[]|\Cake\Collection\CollectionInterface $typeEvenements
 */
?>

<!-- Footable -->
<?= $this->Html->script('footable/footable.all.min.js', ['block' => true]); ?>
<!--FooTable init-->
<?= $this->Html->script('footable-init.js', ['block' => true]); ?>
    
<?php
$titrePage = "Catégorie d'événement" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'TypeEvenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                    <th scope="col" class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($typeEvenements->toArray())){
                foreach ($typeEvenements as $typeEvenement){ ?>
                <tr>
                    <td>
                        <?= $this->Html->link($typeEvenement->nom, ['action' => 'edit', $typeEvenement->id]) ?>
                    </td>
                  
                    <td>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $typeEvenement->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                    </td>
                </tr>
                <?php } }else{?>
                <tr>
                    <!--<td colspan="2">Vous n'avez pas encore créé  vos propres catégories. Par défaut vous aurez : Professionel et Particulier</td>-->
                    <td colspan="2">Professionel</td>
                    <td colspan="2">Particulier</td>
                </tr>
                <?php } ?>
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

