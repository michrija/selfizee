<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NomDeDomaine $nomDeDomaine
 */
?>

<?php
$titrePage = "Ajout nom de domaine";
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
                <?= $this->Form->create($nomDeDomaine) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-12">
                            <?php echo $this->Form->control('nom_de_domaine',['type'=>'text', 'label'=>'Nom de domaine']); ?>
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
