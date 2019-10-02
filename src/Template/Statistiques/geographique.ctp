<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>
<!-- Vector map JavaScript -->
<?= $this->Html->css('vectormap/jquery-jvectormap-2.0.2.css',['block'=>true]) ?>
<?= $this->Html->script('vectormap/jquery-jvectormap-2.0.2.min.js',['block'=>true]) ?>
<?= $this->Html->script('vectormap/jquery-jvectormap-world-mill-en.js',['block'=>true]) ?>
<?= $this->Html->script('vectormap/jvectormap.custom.js',['block'=>true]) ?>
 
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
                <li class="nav-item"><?php echo $this->Html->link('Géographique',['controller' => 'Statistiques', 'action' => 'statGeographique', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Device',['controller' => 'Statistiques', 'action' => 'statDevice', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Navigateur',['controller' => 'Statistiques', 'action' => 'statNavigateur', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Source',['controller' => 'Statistiques', 'action' => 'statSource', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">

                    <!--<div class="card-body">
                          <div id="world-map-markers" style="height: 630px"></div>
                    </div>-->

                    <div class="card-body">
                        <?php if(!empty($stats)){ ?>
                        <div id="world-map-markers" style="height: 630px"></div>
                    	<div class="table-responsive">
							<table class="table tableContact">
								<thead>
									<tr id="entete_table">
									<th scope="col"><a href="#">Pays</a></th>
                                    <th scope="col"><a href="#">Ville</a></th>
                                    <th scope="col"> <a href="#">Utilisateurs</a></th>
                                    <!--<th scope="col"> <a href="#">Sessions</a></th>-->
									<th scope="col"> <a href="#">Pages vues</a></th>
                                    <th scope="col"> <a href="#">Vues uniques</a></th>
                                    <th scope="col"> <a href="#">Entrées</a></th>
                                    <th scope="col"> <a href="#">Rebonds</a></th>
                                    <th scope="col"> <a href="#">Sorties</a></th>
								</tr> 
								</thead>
							<tbody>                          
                                <input type="hidden" class="hide"  id="nbrs" value="<?= count($stats) ?>"/>
								<?php foreach ($stats as $key => $stat) { ?>
									<tr>
										<td><?= $stat[0] ?></td> 
										<td><?= $stat[1] ?></td> 
										<td><?= $stat[5] ?></td> 
                                        <!--<td><?= $stat[7] ?></td>-->
                                        <td><?= $stat[10] ?></td> 
                                        <td><?= $stat[11] ?></td> 
                                        <td><?= $stat[9] ?></td> 
                                        <td><?= $stat[8] ?></td> 
                                        <td><?= $stat[13] ?></td>
                                        <input type="hidden" id="pays_<?= $key ?>" value="<?= $stat[0] ?>" />
                                        <input type="hidden" id="ville_<?= $key ?>" value="<?= $stat[1] ?>" />
                                        <input type="hidden" id="lat_<?= $key ?>" value="<?php echo $stat[2] ?>"/>
                                        <input type="hidden" id="lng_<?= $key ?>" value="<?php echo $stat[3] ?>"/>
                                        <input type="hidden" id="session_<?= $key ?>" value="<?php echo $stat[7] ?>"/>
                                        <input type="hidden" id="pageview_<?= $key ?>" value="<?php echo $stat[10] ?>"/>
									</tr>
								<?php } ?>
							</tbody>
								<!--<input id="latLng_id0" value="<?= json_encode($liste_latLng) ?>"></input>
								<textarea id="latLng_id"><?= json_encode($liste_latLng) ?></textarea>-->
							</table>
						</div>
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