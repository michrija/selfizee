
<?php
$titrePage = " Configuration de colonne du CSV" ;
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

        <div class="card-body">
            <?= $this->Form->create($csvColonnePosition) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-6">
                               <?php
                                    
                                    echo $this->Form->hidden('evenement_id',['options'=>$evenements,'value'=>$idEvenement]);
                                    echo $this->Form->control('csv_colonne_id',['options'=>$csvColonnes,'label'=>'Colonne']);
                                    echo $this->Form->control('position');
                                ?>
                        </div>
                        <!--/span-->
                    </div>
                    
                </div>
             
                
                  <div class="form-actions m-t-10">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
                

