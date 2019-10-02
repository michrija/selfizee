<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>

<?php
$titrePage = "Statistiques SMS";
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
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left">Statistiques sms </h4>
            </div>
            <div class="card-body">
            	<?php if(!empty($nbrSmsEnvoye)){ ?>
                    <div class="kl_contentStatSms kl_statMails row no-padding-top">  <!-- kl_contentStatSms col-12 -->
                            <!--<div class="container">
                                <div class="kl_statMails text-center row mx-auto">
                                </div>
                            </div> -->							
							<div class="col-md-3">
                                      <div class="kl_blocStatMails kl_totalMail">
										<a href="#" onclick="return false;" aria-expanded="false">
											<span class="kl_total_mail kl_txt_bold"><?= $nbrSmsEnvoye ?></span>
											<div class="kl_txt_bold">Sms</div>
											<strong>TOTAL</strong>
										</a>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
									
										<div class="kl_blocStatMails kl_emailDelivres">
											<!--div class="barOverflow"><div class="bar"></div></div-->
											<div class="clearfix sf-bloc-value">
												<span class="kl_values sf-rose pull-left"><?php echo $smsDeliveryPercent; ?>%</span>
												<div class="kl_valeurCounts pull-right"><?php echo  $smsDelivery ? $smsDelivery : '-'; ?></div>
											</div>
											<div class="progress m-t-20 kl-progress-pers">
												<div class="progress-bar bg-danger" style="width: <?php echo ($smsDeliveryPercent ? $smsDeliveryPercent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
											</div>
											<div class="kl_textNav">Délivrés</div>

										<?php if($smsDelivery > 0) { ?>
											 <div class="kl_voir_liste">
												<?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
                                                  ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['customSort'=>'smsDelivre','customDirection'=>'desc'] ], ['escape'=>false]); ?>
											 </div>
										<?php } ?>
										</div>
									
                                    </div>
                                    <div class="col-md-3">
									
										<div class="kl_blocStatMails kl_emailouvert">
											<div class="clearfix sf-bloc-value">
												<span class="kl_values sf-rose pull-left"><?php echo $smsNotDeliveryPercent; ?>%</span>
												<div class="kl_valeurCounts pull-right"><?php echo $smsNotDelivery ? $smsNotDelivery : '-'; ?></div>
											</div>
											<div class="progress m-t-20 kl-progress-pers">
												<div class="progress-bar bg-danger" style="width: <?php echo ($smsNotDeliveryPercent ? $smsNotDeliveryPercent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
											</div>
											<div class="kl_textNav">Non Délivrés</div>

										<?php if($smsNotDelivery > 0) { ?>
											 <div class="kl_voir_liste">
												<?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
                                                  ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['customSort'=>'smsDelivre','customDirection'=>'asc'] ], ['escape'=>false]); ?>
											 </div>
										<?php } ?>
										</div>
										
                                    </div>

                                    <div class="col-md-3">
									
										<div class="kl_blocStatMails kl_emailouvert">
											<div class="clearfix sf-bloc-value">
												<span class="kl_values sf-rose pull-left"><?php echo $smsClickedPourcent; ?>%</span>
												<div class="kl_valeurCounts pull-right"><?php echo $smsClicked ? $smsClicked : '-'; ?></div>
											</div>
											<div class="progress m-t-20 kl-progress-pers">
												<div class="progress-bar bg-danger" style="width: <?php echo ($smsClickedPourcent ? $smsClickedPourcent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
											</div>
											<div class="kl_textNav">Cliqués</div>

										<?php if($smsClicked > 0) { ?>
											<div class="kl_voir_liste">
                                                  <?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
                                                 ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['customSort'=>"smsDelivre",'customDirection'=>"desc"] ], ['escape'=>false]); ?>
                                            </div>
										<?php } ?>
										</div>
									
                                    </div>
                                    <div class="clearfix"></div>
                    </div>
                <?php }else{ ?>
                	<p class="col-md-12">Aucune statistique disponible pour le moment</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->