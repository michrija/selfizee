<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NomDeDomaine[]|\Cake\Collection\CollectionInterface $nomDeDomaines
 */
?>
<?php
$titrePage = "Gestion erreur email" ;
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

    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"><?php echo $this->Html->link('Erreur email',['controller' => 'NomDeDomaines', 'action' => 'erreuremail', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Nom de domaines',['controller' => 'NomDeDomaines', 'action' => 'liste', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <?php if(!empty($contacts_have_error_email)){ ?>
                        <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Erreur</th>
                                                <th scope="col" class="actions">Correction proposée</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $erreurs_emails = [];
                                            foreach ($contacts_have_error_email as $contact) {
                                            $email = $contact->email; ?>
                                                <tr>
                                                    <td><?= $contact->email ?></td>
                                                    <td><?php /*$contact->ndd_propose->nom_de_domaine*/
                                                            echo $this->Html->link($contact->email_propose,['controller' => 'NomDeDomaines', 'action' => 'correction', $contact->id, $evenement->id],["class"=>""]); ?></td>
                                                    <td><?php echo $this->Html->link("Modifier",['controller' => 'NomDeDomaines', 'action' => 'correction', $contact->id, $evenement->id],["class"=>""]); ?></td>
                                                </tr>
                                            <?php } ?>
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