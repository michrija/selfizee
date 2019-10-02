<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DownloadConfiguration $downloadConfiguration
 */
?>

<?php
$titrePage = "Configuration de Téléchargement";
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

echo $this->element('breadcrumb',['titrePage' => ""]);
$this->end();

?>
<div class="row">

    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($downloadConfiguration) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <?php
                            $kl_EvenementHide = "";
                            if(!empty($idEvenement)){
                                $kl_EvenementHide = "hide";
                            }
                        ?>
                        <div class="col-md-12 <?= $kl_EvenementHide ?>">
                            <?php echo $this->Form->control('evenement_id',['label' => 'Evénement *', 'options'=>$evenements,'value'=>$idEvenement, 'empty'=>'Séléctionner']); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('is_oblig_ajout_infos_av_down', ['label'=>'Obligatoire le saisie de formulaire avant le telechargement de photo']); ?>
                        </div>
                    </div>
                    <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>