<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NomDeDomaine $nomDeDomaine
 */
?>

<?php
$titrePage = "Modification erreur email";
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
$evenement->nom,
['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<div class="col-lg-12">
        <div class="card card-outline-info">
            <!--<div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>-->
            <div class="card-body">
                <?= $this->Form->create($contact) ?>
                <div class="form-body">
                    <div class="row p-t-20">

                        <div class="col-md-12">
                            <?php echo $this->Form->hidden('id',['value'=>$contact->id]); ?>
                            <?php echo $this->Form->control('contact_email',['value'=>$contact->email, 'type'=>'text', 'label'=>'Erreur', 'readonly'=>true]); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('nom_de_domaine_id',['options'=>$ndds, 'value'=>$contact->nom_de_domaine_id, 'label'=>'Correction ']); ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
