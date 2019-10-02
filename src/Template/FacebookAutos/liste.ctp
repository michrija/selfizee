<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\ModelBorne[]|\Cake\Collection\CollectionInterface $modelBornes
*/
?>


    
<?php
$titrePage = "Publication automatique sur Facebook " ;
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

$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),$FB_URL_AUTORISATION,['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>
<div class="row">
    <div class="col-12">
         <div class="card card-new-selfizee" >
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?> </h4>
                <?php
                    echo $this->Html->link(__('Ajouter une nouvelle configuration'),$FB_URL_AUTORISATION,['escape'=>false,"class"=>"kl_linkToListeFonctionnalite pull-right" ]); 
                ?>
            </div>
            <div class="card-body">
                <?php if(empty($facebookAutos->toArray())){ ?>
                    <div class="">Aucune configuration pour cet événement.</div>
                <?php }else{ ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('name_in_facebook','Nom de la page') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name_album_in_facebook','Album') ?></th>
                                <th scope="col"><a href="#">Nombre de photos publiées</a></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facebookAutos as $facebookAuto){ ?>
                            <tr>
                                <td><a target="_blank" href="http://www.facebook.com/<?= $facebookAuto->id_in_facebook ?>"> <?= h($facebookAuto->name_in_facebook) ?></a></td>
                                <td><a target="_blank" href="https://www.facebook.com/<?= $facebookAuto->id_in_facebook ?>/photos/?tab=album&album_id=<?= $facebookAuto->id_album_in_facebook ?>"><?= h($facebookAuto->name_album_in_facebook) ?></td>
                                <td>
                                    <?php echo count($facebookAuto->facebook_auto_suivis); ?>
                                </td>
                                <td class="actions">
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $facebookAuto->evenement_id, $facebookAuto->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                                    / <a target="_blank" href="http://www.facebook.com/<?= $facebookAuto->id_in_facebook ?>"> Voir la page</a>
                                    / <a target="_blank" href="https://www.facebook.com/<?= $facebookAuto->id_in_facebook ?>/photos/?tab=album&album_id=<?= $facebookAuto->id_album_in_facebook ?>">Voir l'album</a>
                                
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
