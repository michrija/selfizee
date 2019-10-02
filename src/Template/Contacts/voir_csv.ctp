<?= $this->Html->script('gdocsviewer/jquery.gdocsviewer.min.js', ['block' => true]); ?>
<?= $this->Html->script('Contacts/voir_csv.js', ['block' => true]); ?>
<?php
$titrePage = "Info csv" ;
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if($csv){ ?>
                    <strong>Oui</strong>, un csv est présent dans le dossier<br />
                    <p><?= $dataCsv ?></p>
                    <div>
                        <?= $this->Form->postLink('<i class="mdi mdi-delete"></i> '.__('Supprimer le csv'), ['action' => 'deleteCsv', $evenement->id], ['escape'=>false,"class"=>"btn btn-danger ",'confirm' => __('Are you sure you want to delete ?')]) ?>
                        <!--<a href="<?= $urlCsv ?>" class="btn btn-primary embed"><i class="mdi mdi-eye"></i> Voir le csv</a>-->
                        <?php 
                        if(!empty($urlCsv)){ 
                            echo $this->Html->link('<i class="mdi mdi-eye"></i> Voir le csv', array('controller' => 'Contacts', 'action' => 'downloaAndSeeCsv', $evenement->id) , ["escape" => false,"class" => 'btn btn-primary embed']); 
                        } 
                        ?>
                    </div>
                <?php }else{ ?>
                     <strong>Aucun csv</strong>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
