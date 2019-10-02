<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>

<?= $this->Html->script('chart/chartjs.init.js',['block'=>true]) ?>
<?= $this->Html->script('chart/Chart.min.js',['block'=>true]) ?>
<?php
$titrePage = "Statistiques page souvenir";
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
                <li class="nav-item"><?php echo $this->Html->link('Géographique',['controller' => 'Statistiques', 'action' => 'statGeographique', $idEvenement],["class"=>"nav-link ","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Device',['controller' => 'Statistiques', 'action' => 'statDevice', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Navigateur',['controller' => 'Statistiques', 'action' => 'statNavigateur', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Source',['controller' => 'Statistiques', 'action' => 'statSource', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
						<?php if(!empty($stats)){ ?>
                    	<div><canvas id="chart3" height="150"></canvas></div>
                    	<div class="table-responsive">
							<table class="table tableContact">
								<thead>
									<tr id="entete_table">
									<th scope="col"><a href="#">Device</a></th>
									<th scope="col"><a href="#">Utilisateurs</a></th>
                                    <!--<th scope="col"> <a href="#">Sessions</a></th>-->
									<th scope="col"> <a href="#">Pages vues</a></th>
								</tr> 
								</thead>
							<tbody> 
                                <input type="hidden" class="hide"  id="nbrs" value="<?= count($stats) ?>"/>
								<?php foreach ($stats as $key => $stat) {?>
								<tr> 
									<td><?= $stat[1] ?></td> 
									<td><?= $stat[2] ?></td> 
									<!--<td><?= $stat[3] ?></td>-->
									<td><?= $stat[4] ?></td> 
                                     <input type="hidden" id="systeme_<?= $key ?>" value="<?php echo $stat[1] ?>"/>
                                     <input type="hidden" id="user_<?= $key ?>" value="<?php echo $stat[2] ?>"/>
                                     <input type="hidden" id="session_<?= $key ?>" value="<?php echo $stat[3] ?>"/>
                                     <input type="hidden" id="pageview_<?= $key ?>" value="<?php echo $stat[4] ?>"/>
								</tr>
								<?php } ?>
							</tbody>
							</table>
						</div>
						<!-- Boucle Device -->
                            <?php if(!empty($browsers)){ ?>
                            <input type="hidden" class="hide"  id="nbrs_total_os" value="<?= count($operatingSystemes) ?>"/>
                            <?php foreach ($operatingSystemes as $i => $os) {?>
                                <input type="hidden" id="os_<?= $i ?>" value="<?= $os[0] ?>"/>
                            <?php } } ?>
                            <!--===============-->

						<?php } else { ?>
                            <h6 style="text-align:center;color:#7b7b7b;">Aucune donnée</h6>
                        <?php } ?>
                    </div>
                            
                </div>
               
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->