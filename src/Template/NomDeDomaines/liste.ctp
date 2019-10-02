<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NomDeDomaine[]|\Cake\Collection\CollectionInterface $nomDeDomaines
 */
?>
<?php
$titrePage = "Gestion nom de domaine";
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
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>

<div class="row">

    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"><?php echo $this->Html->link('Erreur email',['controller' => 'NomDeDomaines', 'action' => 'erreuremail', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Nom de domaines',['controller' => 'NomDeDomaines', 'action' => 'liste', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <?php if(!empty($nomDeDomaines)){ ?>
                            
                            <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><?= $this->Paginator->sort('nom_de_domaine') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($nomDeDomaines as $nomDeDomaine): ?>
                                            <tr>
                                                <td><?= h($nomDeDomaine->nom_de_domaine) ?></td>
                                                <td class="actions">
                                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nomDeDomaine->id, $idEvenement]) ?>
                                                    <?php // $this->Form->postLink(__('Delete'), ['action' => 'delete', $nomDeDomaine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nomDeDomaine->id)]) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                </table>
                            </div>
                        
                        <?php } else { ?>
                            <h6 style="text-align:center;color:#7b7b7b;"></h6>
                        <?php } ?>
                    </div>
                            
                </div>
               
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->