<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>



<?php
$titrePage = "Ajout d'un noveau contact" ;
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Dashboards', 'action' => 'index']
);

$this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
);



$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();


?>

<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"><?= __("Model information") ?></h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create($contact, ['type' => 'file',"id"=>"myDrop"]) ?>
                <div class="form-body">
                     <div class="col-md-6">
                        <?php
                        	echo $this->Form->control('nom');
                        	echo $this->Form->control('prenom');
                        	echo $this->Form->control('email');
                        	echo $this->Form->control('telephone');
                        ?>
                     </div>
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> Save',["class"=>"btn btn-success",'escape'=>false]) ?>
                    <?= $this->Form->button('Cancel',["type"=>"reset", "class"=>"btn btn-inverse",'escape'=>false]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
                