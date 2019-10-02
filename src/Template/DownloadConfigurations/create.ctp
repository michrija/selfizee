<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DownloadConfiguration $downloadConfiguration
 */
?>
<?= $this->Html->script('clients/add.js', ['block' => true]); ?>

<?php
$titrePage = "Configuration téléchargement page souvenir";
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add(
$client->nom,
['controller' => 'Clients', 'action' => 'edit', $client->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
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
                            if(!empty($idClient)){
                                $kl_EvenementHide = "hide";
                            }
                        ?>
                        <div class="col-md-12 <?= $kl_EvenementHide ?>">
                            <?php echo $this->Form->control('client_id',['label' => 'Client *', 'options'=>$clients,'value'=>$idClient, 'empty'=>'Séléctionner']); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('is_oblig_ajout_infos_av_down', ['label'=>'Activer le saisie de formulaire avant le telechargement de photo', 'id'=>'is_active_form']); ?>
                        </div>

                        <div class="col-md-12 hide champs_formulaire">
                        <label>Champs :</label>
                            <?php
                                echo $this->Form->control('is_nom_active',['label'=>'Nom']);
                                echo $this->Form->control('is_prenoms_active',['label'=>'Prenoms']);
                                echo $this->Form->control('is_tel_active',['label'=>'Téléphone']);
                                echo $this->Form->control('is_email_active',['label'=>'Email']);
                                echo $this->Form->control('is_optin_active',['label'=>'Optin']);
                            ?>
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