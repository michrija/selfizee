<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>

<?= $this->Html->script('echarts/echarts-all.js',['block'=>true]) ?>
<?= $this->Html->script('echarts/echarts-init.js',['block'=>true]) ?>
<?= $this->Html->script('echarts/custom.min.js',['block'=>true]) ?>

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
                <li class="nav-item"><?php echo $this->Html->link('Device',['controller' => 'Statistiques', 'action' => 'statDevice', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Navigateur',['controller' => 'Statistiques', 'action' => 'statNavigateur', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Source',['controller' => 'Statistiques', 'action' => 'statSource', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <?php if(!empty($stats)){ ?>
                        <div id="doughnut-chart" style="width:100%; height:400px;"></div>
                    	<div class="table-responsive">
							<table class="table tableContact">
								<thead>
									<tr id="entete_table">
									<th scope="col"><a href="#">Source</a></th>
                                    <th scope="col"> <a href="#">Utilisateurs</a></th>
                                    <!--<th scope="col"> <a href="#">Sessions</a></th>-->
									<th scope="col"> <a href="#">Pages vues</a></th>
								</tr> 
								</thead>
							<tbody> 
                                <input type="hidden" class="hide"  id="nbrs" value="<?= count($stats) ?>"/>
								<?php foreach ($stats as $key => $stat) { if($stat[1] == "(direct)") $stat[1] = "Direct" ;?>
								<tr> 
									<td><?= $stat[1] ?></td> 
									<td><?= $stat[2] ?></td> 
									<!--<td><?= $stat[3] ?></td>-->
                                    <td><?= $stat[4] ?></td> 
                                     <input type="hidden" id="source_<?= $key ?>" value="<?php echo $stat[1] ?>"/>
                                     <input type="hidden" id="session_<?= $key ?>" value="<?php echo $stat[3] ?>"/>
                                     <input type="hidden" id="pageview_<?= $key ?>" value="<?php echo $stat[4] ?>"/>
								</tr>
								<?php } ?>
							</tbody>
							</table>
						</div>
                            <!-- Boucle CANAUX-->
                            <?php if(!empty($canaux)){ ?>
                            <input type="hidden" class="hide"  id="nbrs_total_source" value="<?= count($canaux) ?>"/>
                            <?php foreach ($canaux as $i => $canal) {?>
                                <input type="hidden" id="canaux_<?= $i ?>" value="<?php echo $canal[0] ?>"/>
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