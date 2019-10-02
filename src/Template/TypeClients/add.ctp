


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
$titrePage = "ajouter un type de client" ;
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
    //echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>
<div class="row">
    <div class="col-12">
   
        <div class="card">
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                        <?= $this->Form->create($typeClient) ?>
                        
                        <?php
                        echo $this->Form->control('type');
                        ?>
                        <?= $this->Form->button(__('Submit')) ?>
                        <?= $this->Form->end() ?>
                  </div>
              </div>
            </div>
            </div>
        </div>
    </div>

</div>