<?php
$titrePage = "Configuration réseaux sociaux";
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

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <!--<div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>-->
            <div class="card-body">
                <?= $this->Form->create($rsConfiguration) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <?php
                            $kl_EvenementHide = "";
                            if(!empty($idEvenement)){
                                $kl_EvenementHide = "hide";
                            }
                        ?>
                        <div class="col-md-12 <?= $kl_EvenementHide ?>">
                            <?php echo $this->Form->control('evenement_id',['label' => 'Evénement *', 'options'=>$evenements,'value'=>$idEvenement, 'empty'=>'Séléctionner', 'id'=>'clients_id']); ?>
                        </div>
                        <div class="col-md-12">
							<?php
								echo $this->Form->control('desc_facebook',['label'=>'Description Facebook']);
								echo $this->Form->control('desc_twiter',['label'=>'Description Twitter']);
								echo $this->Form->control('hashtag_twitter',['label'=>'Hashtag Twitter','templateVars'=>['help'=>'Astuce : synthaxe pouvant être utilisée : selfie,photo,club (Séparés par une virgule)']]);
							?>
						</div>
                    </div>
                
                    <div class="form-actions m-t-10">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                    
                    
                    
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>