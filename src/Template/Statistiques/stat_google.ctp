<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>

<?php
$titrePage = "Statistiques";
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
<!-- Row -->
<div class="row">

    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"><?php echo $this->Html->link('Geographiques',['controller' => 'Statistiques', 'action' => 'geographique', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Devices',['controller' => 'Statistiques', 'action' => 'device', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                            <div class="kl_contentStat">
                                    <div class="container">
                                        <div class="kl_statMails text-center row mx-auto">
                                            
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
	
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->