<?= $this->Html->css('Statistiques/statistiques.css?'.time(),['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>


<?= $this->Html->script('Statistiques/demographie.js',['block'=>true]) ?>
<?= $this->Html->script('chart/Chart.min.js',['block'=>true]) ?>

<?php
$titrePage = "Statistiques Démographiques";
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


	// Statistique démographie
	// Age
	$nbrPersonnes = 
	$nbrMoins20 = 
	$nbr20_30 = 
	$nbr30_40 = 
	$nbr40_60 = 
	$nbrPlus60 = 
	$age_moyen =

	//Emotion
	$nbrSourire = 
	$nbrNeutre = 
	$nbrColere = 
	$nbrPeur = 
	$nbrSurpris = 
	$nbrTriste = 

	// Sexe
	$nbrHommes = 
	$nbrFemmes = 0;


	$hommePourcent = 
	$femmePourcent = 

	$moins_20Pourcent = 
	$v_tPourcent = 
	$t_qPourcent = 
	$q_sPourcent = 
	$plus_60Pourcent = 

	$sourirePourcent = 
	$neutrePourcent = 
	$colerePourcent = 
	$peurPourcent = 
	$surprisPourcent = 
	$tristePourcent = 0;
	
	$data = [];

	if(!empty($evenement->photos)){
		foreach($evenement->photos as $item){
			if(!empty($item->photo_statistique)){
				$nbrHommes += $item->photo_statistique->nb_homme;
				$nbrFemmes += $item->photo_statistique->nb_femme;
				$nbrMoins20 += $item->photo_statistique->moins_20;
				$nbr20_30 += $item->photo_statistique->a_20_30;
				$nbr30_40 += $item->photo_statistique->a_30_40;
				$nbr40_60 += $item->photo_statistique->a_40_60;
				$nbrPlus60 += $item->photo_statistique->plus_60;
				$age_moyen += $item->photo_statistique->age_total;
				
				$nbrSourire += $item->photo_statistique->nb_sourire;
				$nbrNeutre += $item->photo_statistique->nb_neutre;
				$nbrColere += $item->photo_statistique->nb_colere;
				$nbrPeur += $item->photo_statistique->nb_peur;
				$nbrSurpris += $item->photo_statistique->nb_surpris;
				$nbrTriste += $item->photo_statistique->nb_triste;
			}
		}
	}
	
	if($nbrHommes || $nbrFemmes){
		$nbrPersonnes = $nbrHommes + $nbrFemmes;
		$hommePourcent = $nbrHommes * 100 / $nbrPersonnes;
		$hommePourcent = round($hommePourcent, 0);
		$femmePourcent = $nbrFemmes * 100 / $nbrPersonnes;
		$femmePourcent = round($femmePourcent, 0);
		
		$age_moyen = $age_moyen / $nbrPersonnes;
		$age_moyen = round($age_moyen, 0);
		
		$moins_20Pourcent = $nbrMoins20 * 100 / $nbrPersonnes;
		$moins_20Pourcent = round($moins_20Pourcent, 0);
		$v_tPourcent = $nbr20_30 * 100 / $nbrPersonnes;
		$v_tPourcent = round($v_tPourcent, 0);
		$t_qPourcent = $nbr30_40 * 100 / $nbrPersonnes;
		$t_qPourcent = round($t_qPourcent, 0);
		$q_sPourcent = $nbr40_60 * 100 / $nbrPersonnes;
		$q_sPourcent = round($q_sPourcent, 0);
		$plus_60Pourcent = $nbrPlus60 * 100 / $nbrPersonnes;
		$plus_60Pourcent = round($plus_60Pourcent, 0);
		
		$totalSentiment = $nbrSourire + $nbrNeutre + $nbrColere + $nbrPeur + $nbrSurpris + $nbrTriste;
		$sourirePourcent = $nbrSourire * 100 / $totalSentiment;
		$sourirePourcent = round($sourirePourcent, 0);
		$neutrePourcent = $nbrNeutre * 100 / $totalSentiment;
		$neutrePourcent = round($neutrePourcent, 0);
		$colerePourcent = $nbrColere * 100 / $totalSentiment;
		$colerePourcent = round($colerePourcent, 0);
		$peurPourcent = $nbrPeur * 100 / $totalSentiment;
		$peurPourcent = round($peurPourcent, 0);
		$surprisPourcent = $nbrSurpris * 100 / $totalSentiment;
		$surprisPourcent = round($surprisPourcent, 0);
		$tristePourcent = $nbrTriste * 100 / $totalSentiment;
		$tristePourcent = round($tristePourcent, 0);
		
		$data = [
			[
				'value' => $nbrMoins20,
				// 'color' => "#3da3b9",
				// 'highlight' => "#3da3b9",
				'color' => "#d0f442",
				'highlight' => "#d0f442",
				'label' => "- 20 ans"
			],
			[
				'value' => $nbr20_30,
				// 'color' => "#ac3603",
				// 'highlight' => "#ac3603",
				'color' => "#f47842",
				'highlight' => "#f47842",
				'label' => "  20 - 30 ans"
			],
			[
				'value' => $nbr30_40,
				// 'color' => "#15b909",
				// 'highlight' => "#15b909",
				'color' => "#f4ea42",
				'highlight' => "#f4ea42",
				'label' => "  30 - 40 ans"
			],
			[
				'value' => $nbr40_60,
				// 'color' => "#e72763",
				// 'highlight' => "#e72763",
				'color' => "#42abf4",
				'highlight' => "#42abf4",
				'label' => "  40 - 60 ans"
			],
			[
				'value' => $nbrPlus60,
				// 'color' => "#c442f4",
				'color' => "#c442f4",
				'highlight' => "#c442f4",
				'label' => "+ 60 ans"
			],
		];
	}

?>
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-15 text-black">Statistiques démographiques </h4>
				<h6 class="card-subtitle m-b-0 no-padding-bottom">Synthèse des données démographique des personnes présentes sur les photos. Il s’agit ici de données estimatives calculées automatiquement.</h6>
            </div>
	        <div class="card-body">
	        	<?php if(!empty($nbrPersonnes)){ ?>
	                <div class="kl_contentStat col-md-12 kl_statMails row no-padding-top no-padding-left">
	                        <!--<div class="container">
	                            <div class="kl_statMails text-center row mx-auto">	                            	
	                            </div>
							</div> -->
									<div class="col-md-2">
	                                    <div class="kl_blocStatMails kl_totalMail">
											<a href="#" onclick="return false;" aria-expanded="false">
												<span class="kl_total_mail kl_txt_bold"><?= $nbrPersonnes ?></span>
												<div class="kl_txt_bold">Personne<?php echo $nbrPersonnes > 1 ? 's' : ''; ?></div>
												<strong>TOTAL</strong>
											</a>
	                                    </div>
	                                </div>

	                            	<div class="col-md-3">
										
										<div class="kl_blocStatMails kl_emailDelivres">
											<div class="clearfix sf-bloc-value">
												<span class="kl_values sf-rose pull-left"><?php echo $hommePourcent; ?>%</span>
												<div class="kl_valeurCounts pull-right"><?php echo  $nbrHommes ? $nbrHommes : '-'; ?></div>
											</div>
											<div class="progress m-t-20 kl-progress-pers">
												<div class="progress-bar bg-danger" style="width: <?php echo ($hommePourcent ? $hommePourcent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
											</div>
											<div class="kl_textNav">Homme<?php echo $nbrHommes > 1 ? 's' : ''; ?></div>
										</div>
										
	                                </div>

	                            	<div class="col-md-3">
										
										<div class="kl_blocStatMails kl_emailDelivres">
											<div class="clearfix sf-bloc-value">
												<span class="kl_values sf-rose pull-left"><?php echo $femmePourcent; ?>%</span>
												<div class="kl_valeurCounts pull-right"><?php echo  $nbrFemmes ? $nbrFemmes : '-'; ?></div>
											</div>
											<div class="progress m-t-20 kl-progress-pers">
												<div class="progress-bar bg-danger" style="width: <?php echo ($femmePourcent ? $femmePourcent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
											</div>
											<div class="kl_textNav">Femme<?php echo $nbrFemmes > 1 ? 's' : ''; ?></div>
										</div>
										
	                                </div>
	                                <div class="col-md-3">
										<div class="kl_blocStatMails kl_emailAutre kl_sentiment">
											<div class="kl_oneInfoStat">
												<?php 
													echo $this->Html->link('
													<div class="kl_leftinList"><img src="/img/icon/sourire.png">Sourire</div>
													<div class="kl_rigthinList">
														<span class="kl_valueInfoStat">'.$sourirePourcent.'%</span>
													</div>
													<div class="clearfix"></div>  
													',
													'#',
													['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
												?>                                  
												<div class="clearfix"></div>
											</div>
											<div class="kl_oneInfoStat">
												<?php 
													echo $this->Html->link('
													<div class="kl_leftinList"><img src="/img/icon/neutre.png">Neutre</div>
													<div class="kl_rigthinList">
														<span class="kl_valueInfoStat">'.$neutrePourcent.'%</span>
													</div>
													<div class="clearfix"></div>  
													',
													'#',
													['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
												?>                                  
												<div class="clearfix"></div>
											</div>
											<div class="kl_oneInfoStat">
												<?php 
													echo $this->Html->link('
													<div class="kl_leftinList"><img src="/img/icon/colere.png">Colère</div>
													<div class="kl_rigthinList">
														<span class="kl_valueInfoStat">'.$colerePourcent.'%</span>
													</div>
													<div class="clearfix"></div>  
													',
													'#',
													['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
												?>                                  
												<div class="clearfix"></div>
											</div>
											<div class="kl_oneInfoStat">
												<?php 
													echo $this->Html->link('
													<div class="kl_leftinList"><img src="/img/icon/surpris.png">Surpris</div>
													<div class="kl_rigthinList">
														<span class="kl_valueInfoStat">'.$surprisPourcent.'%</span>
													</div>
													<div class="clearfix"></div>  
													',
													'#',
													['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
												?>                                  
												<div class="clearfix"></div>
											</div>
											<div class="kl_oneInfoStat">
												<?php 
													echo $this->Html->link('
													<div class="kl_leftinList"><img src="/img/icon/triste.png">Triste</div>
													<div class="kl_rigthinList">
														<span class="kl_valueInfoStat">'.$tristePourcent.'%</span>
													</div>
													<div class="clearfix"></div>  
													',
													'#',
													['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
												?>                                  
												<div class="clearfix"></div>
											</div>
											<div class="kl_oneInfoStat">
												<?php 
													echo $this->Html->link('
													<div class="kl_leftinList"><img src="/img/icon/peur.png">Peur</div>
													<div class="kl_rigthinList">
														<span class="kl_valueInfoStat">'.$peurPourcent.'%</span>
													</div>
													<div class="clearfix"></div>  
													',
													'#',
													['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
												?>                                  
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
									<?php if(false){ ?>
	                                <div class="col-md-2">
	                                    <div class="kl_blocStatMails kl_emailclique">
	                                          <div class="barOverflow">
	                                            <div class="bar"></div>
	                                          </div>

	                                          <span class="kl_value"><?= h($smsClickedPourcent) ?></span>%
	                                          <div class="kl_valeurCount"><?= $smsClicked ?></div>
	                                          <div class="kl_textNav">cliqués</div>
	                                          <?php if($smsClicked > 0) { ?>
	                                            <div class="kl_voir_liste">
	                                              <?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
	                                             ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['customSort'=>"smsDelivre",'customDirection'=>"desc"] ], ['escape'=>false]); ?>
	                                            </div>
	                                          <?php } ?>
	                                    </div>
	                            	</div>
								  <?php } ?>
	                                <div class="clearfix"></div>
					</div>			
								
					<div class="kl_statMails text-center row mx-auto" style="margin-top: 40px;">
						<div class="col-md-4" style="margin-top: 30px;">
							<h4 class="card-title">&nbsp;</h4>
							<div class="clearfix"><span class="pull-right sf-mv">- 20 ans <?php echo '['.$moins_20Pourcent.'%]'; ?></span></div>
							<div class="clearfix"><span class="pull-right sf-vt">&nbsp;&nbsp;20 - 30 ans <?php echo '['.$v_tPourcent.'%]'; ?></span></div>
							<div class="clearfix"><span class="pull-right sf-tq">&nbsp;&nbsp;30 - 40 ans <?php echo '['.$t_qPourcent.'%]'; ?></span></div>
							<div class="clearfix"><span class="pull-right sf-qs">&nbsp;&nbsp;40 - 60 ans <?php echo '['.$q_sPourcent.'%]'; ?></span></div>
							<div class="clearfix"><span class="pull-right sf-ps">+ 60 ans <?php echo '['.$plus_60Pourcent.'%]'; ?></span></div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<div class="kl_topDomaine"><div class="kl_titleDomaine">Classement par age</div></div>
										<?php if($nbrPersonnes){ ?>
										<div>
											<canvas id="chartAge" height="150"></canvas>
										</div>
										<?php }else{ ?>
											<h4 class="sf-age-moyen">Aucune image disponible pour cette statistique</h4>
										<?php } ?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">&nbsp;</h4>
									<h4 class="sf-age-moyen"><?php echo $age_moyen.' ans'; ?></h4>
									<p><span style="text-transform:uppercase;">â</span>ge moyen estimé</p>
								</div>
							</div>
						</div>
					</div>
                <?php }else{ ?>
                	<p class="col-md-12">Aucune statistique disponible pour le moment</p>
                <?php } ?>
	        </div>
        </div>
    </div>
</div>
<?php
	$this->Html->scriptStart(['block' => true]);
	echo 'var age = '.json_encode($data).';';
	$this->Html->scriptEnd();
?>