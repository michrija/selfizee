<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>
<?= $this->Html->script('bootstrap/poper.min.js',['block'=>true]) ?>
<?php
$titrePage = "Statistiques E-mail";
$this->assign('title', $titrePage);
    
    $total = 0;
    $delivredPourcent = 0;
    $ouvertPourcent = 0;
    $clickPourcent = 0;
    $blockedPourcent = 0;
    $spamPourcent = 0;
    $hardBouncePourcent = 0;
    $softBouncePourcent = 0;
    $messageDeferredPourcent = 0;
    $messageUnsubscribedPourcent = 0;
    $messageSentCount = "-";
    $messageOpenedCount  = "-";
    $messageClickedCount = 0;
    
    if(!empty($eventStatCampaign)){
        $total = $eventStatCampaign->total;
        $messageSentCount = $eventStatCampaign->message_sent_count;
        $messageOpenedCount = $eventStatCampaign->message_opened_count;
        $messageClickedCount = $eventStatCampaign->message_clicked_count;
        $messageBlockedCount = $eventStatCampaign->message_blocked_count;
        $messageSpamCount = $eventStatCampaign->message_spam_count;
        $messageHardBouncedCount  = $eventStatCampaign->message_hard_bounced_count ;
        $messageSoftBouncedCount = $eventStatCampaign->message_soft_bounced_count;
        $messageDeferredCount = $eventStatCampaign->message_deferred_count;
        $messageUnsubscribedCount = $eventStatCampaign->event_unsubscribed_count;
        
        if(!empty($total)){
            $delivredPourcent = ($messageSentCount*100) / $total;
            $delivredPourcent = round($delivredPourcent, 2);
            
            $blockedPourcent = ($messageBlockedCount*100) / $total;
            $blockedPourcent = round($blockedPourcent, 2);
            
            $hardBouncePourcent = ($messageHardBouncedCount*100)/$total; 
            $hardBouncePourcent = round($hardBouncePourcent, 2);
            
            $softBouncePourcent = ($messageSoftBouncedCount*100) /$total;
            $softBouncePourcent = round($softBouncePourcent, 2);
            
            $messageDeferredPourcent = ($messageDeferredCount*100) / $total;
            $messageDeferredPourcent = round($messageDeferredPourcent, 2);
            
            if(!empty($messageSentCount)){
                $ouvertPourcent = ($messageOpenedCount*100)/ $messageSentCount;
                $ouvertPourcent = round($ouvertPourcent, 2);
                
                $messageUnsubscribedPourcent = ($messageUnsubscribedCount *100) / $messageSentCount;
                $messageUnsubscribedPourcent = round($messageUnsubscribedPourcent, 2);
                
                $spamPourcent = ($messageSpamCount*100)/ $messageSentCount;
                $spamPourcent = round($spamPourcent, 2);
            }
            
            if(!empty($messageOpenedCount)){
                $clickPourcent = ($messageClickedCount*100) / $messageOpenedCount;
                $clickPourcent = round($clickPourcent, 2);
            }
            
        }
    }

?>
                             
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left">Statistiques E-mails </h4>
            </div>
            <div class="card-body row"> <!--row -->
                <?php if(!empty($total) ) { ?>
                <div class="col-lg-12 kl_contentStat no-padding-top">
                    <div class="">
                        <div class="kl_statMails row">
                          <div class="col-md-2">
                            <div class="kl_blocStatMails kl_totalMail">
                                <?php echo $this->Html->link('<span class="kl_total_mail kl_txt_bold">'.$total.'</span><div class="kl_txt_bold">E-mails</div><strong>TOTAL</strong>',
                                    ['controller' => 'Contacts', 'action' => 'liste', $idEvenement],
                                    ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'' ]); ?>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="kl_blocStatMails kl_emailDelivres">
                                <!--div class="barOverflow"><div class="bar"></div></div-->
								<div class="clearfix sf-bloc-value">
									<span class="kl_values sf-rose pull-left"><?php echo $delivredPourcent; ?>%</span>
									<div class="kl_valeurCounts pull-right"><?php echo $messageSentCount; ?></div>
								</div>
								<div class="progress m-t-20 kl-progress-pers">
									<div class="progress-bar bg-danger" style="width: <?php echo ($delivredPourcent ? $delivredPourcent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
								</div>
								<div class="kl_textNav">Délivrés</div>

                            <?php if($messageSentCount > 0) { ?>
                                 <div class="kl_voir_liste">
                                              <?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
                                              ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'sent'=>1] ], ['escape'=>false]); ?>
                                 </div>
                            <?php } ?>
                            </div>
                          </div>
                            <!--=== OUVERTS -->
                             <div class="col-md-2">
                              <div class="kl_blocStatMails kl_emailouvert">
									<!--div class="barOverflow"><div class="bar"></div></div-->
									<div class="clearfix sf-bloc-value">
										<span class="kl_values sf-rose pull-left"><?php echo $ouvertPourcent; ?>%</span>
										<div class="kl_valeurCounts pull-right"><?php echo $messageOpenedCount; ?></div>
									</div>
									<div class="progress m-t-20 kl-progress-pers">
										<div class="progress-bar bg-danger" style="width: <?php echo ($ouvertPourcent ? $ouvertPourcent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
									</div>
									<div class="kl_textNav">
										Ouverts
										<span class="mytooltip tooltip-effect-2">
											<span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
											<span class="tooltip-content kl_contentToolTipeCustom clearfix">
												<span class="tooltip-text">
												  <?php echo $ouvertPourcent."% des destinataires ayant reçu cet email l'ont ouvert au moins une fois "; ?>
												</span>
											</span>
										</span>
									</div>

                              <?php  if($messageOpenedCount > 0) { ?>
                                   <div class="kl_voir_liste">
                                                <?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
                                                ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'emailOuvert'=>1] ], ['escape'=>false]); ?>
                                   </div>
                              <?php } ?>
                              </div>
                            </div>  
                            <!--=== CLICS -->
							<div class="col-md-2">
								<div class="kl_blocStatMails kl_emailclique">
									<div class="clearfix sf-bloc-value">
										<span class="kl_values sf-rose pull-left"><?php echo $clickPourcent; ?>%</span>
										<div class="kl_valeurCounts pull-right"><?php echo empty($messageClickedCount) ? '-' : $messageClickedCount; ?></div>
									</div>
									<div class="progress m-t-20 kl-progress-pers">
										<div class="progress-bar bg-danger" style="width: <?php echo ($clickPourcent ? $clickPourcent : 1); ?>%; height:25px;border-radius:0;" role="progressbar"></div>
									</div>
									<div class="kl_textNav">
										Cliqués
										<span class="mytooltip tooltip-effect-2">
                                            <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                            <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                <span class="tooltip-text">
                                                <?php echo $clickPourcent.'% des destinataires ayant ouvert cet email ont cliqué au moins une fois (les désinscriptions ne sont pas prises en compte)' ;?>
                                                </span> 
                                            </span>
										</span>
									</div>

								<?php if($messageClickedCount > 0) { ?>
									<div class="kl_voir_liste">
                                                <?php echo $this->Html->link('Voir la liste<i class="mdi mdi-chevron-right"></i>',
                                                ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'emailClick'=>1]], ['escape'=>false]); ?>
									</div>
								<?php } ?>
								</div>
							</div> 
                            <div class="col-md-4">
                                <div class="kl_blocStatMails kl_emailAutre">
                                    <div class="kl_oneInfoStat">
                                        <?php 
                                            echo $this->Html->link('
                                            <div class="kl_leftinList">
                                                Bloqués
                                                <span class="mytooltip tooltip-effect-2">
                                                   <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                                   <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                        <span class="tooltip-text">
                                                        Pour protéger votre réputation d\'expéditeur, nous identifions et bloquons proactivement les emails qui n\'ont aucune chance d\'arriver jusqu\'à la boîte de réception du destinataire. Les emails bloqués incluent notamment les messages précédemment signalés comme spam, les erreurs permanentes, les contenus inappropriés, et d\'autres facteurs.
                                                        </span> 
                                                   </span>
                                                </span> 
                                            </div>
                                            <div class="kl_rigthinList">
                                                <span class="kl_valueInfoStat">'.$blockedPourcent.'%</span>
                                            </div>
                                            <div class="clearfix"></div>  
                                            ',
                                            ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'blocked'=>1] ],
                                            ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
                                        ?>                                  
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="kl_oneInfoStat">
                                        <?php echo $this->Html->link('
                                        <div class="kl_leftinList">
                                            Spam
                                            <span class="mytooltip tooltip-effect-2">
                                               <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                               <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                    <span class="tooltip-text">
                                                        '.$spamPourcent.'% des destinataires ayant reçu cet email l\'ont signalé comme spam
                                                    </span> 
                                               </span>
                                            </span> 
                                        </div>
                                        <div class="kl_rigthinList">
                                            <span class="kl_valueInfoStat">'.$spamPourcent.'%</span>
                                        </div>
                                        <div class="clearfix"></div>',
                                        ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'spam'=>1] ],
                                        ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]); ?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="kl_oneInfoStat">
                                        <?php 
                                            echo $this->Html->link('
                                            <div class="kl_leftinList">
                                                Erreur permanente
                                                <span class="mytooltip tooltip-effect-2">
                                                   <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                                   <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                        <span class="tooltip-text">
                                                            Une erreur d\'envoi permanente peut être due à une adresse invalide (mal saisie, serveur de destination non existant, etc.). Les erreurs permanentes peuvent nuire à votre réputation d\'expéditeur et sont automatiquement bloquées.
                                                        </span> 
                                                   </span>
                                                </span> 
                                            </div>
                                            <div class="kl_rigthinList">
                                                <span class="kl_valueInfoStat">'.$hardBouncePourcent.'%</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            ',
                                            ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'hardBounce'=>1] ],
                                            ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
                                        ?> 
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="kl_oneInfoStat">
                                        <?php 
                                            echo $this->Html->link('
                                            <div class="kl_leftinList">
                                                Erreur temporaire
                                                <span class="mytooltip tooltip-effect-2">
                                                   <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                                   <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                        <span class="tooltip-text">
                                                        Erreur temporaire (la boîte de réception du destinataire est pleine ou la connexion a été interrompue). Ce taux est calculé en fonction du nombre de messages que l\'on a tenté d\'envoyer, les messages bloqués sont donc exclus.
                                                        </span> 
                                                   </span>
                                                </span> 
                                            </div>
                                            <div class="kl_rigthinList">
                                                <span class="kl_valueInfoStat">'.$softBouncePourcent.'%</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            ',
                                            ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'bounce'=>1 , 'countBoucnceTmp' => $softBouncePourcent] ],
                                            ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
                                        ?> 
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="kl_oneInfoStat">
                                        <div class="kl_leftinList">
                                            Renvoi
                                            <span class="mytooltip tooltip-effect-2">
                                               <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                               <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                    <span class="tooltip-text">
                                                        Emails rejetés par le serveur du destinataire. Nous essaierons à nouveau d'envoyer ces emails pendant 5 jours. S'ils sont toujours rejetés, ils s'afficheront en tant qu'erreur temporaire.
                                                    </span> 
                                               </span>
                                            </span> 
                                        </div>
                                        <div class="kl_rigthinList">
                                            <span class="kl_valueInfoStat"><?= $messageDeferredPourcent ?>%</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="kl_oneInfoStat">
                                        <?php 
                                            echo $this->Html->link('
                                            <div class="kl_leftinList">
                                                Désabo.
                                                <span class="mytooltip tooltip-effect-2">
                                                   <span class="tooltip-item kl_questionLogo"><i class="fa fa-question"></i></span> 
                                                   <span class="tooltip-content kl_contentToolTipeCustom clearfix">
                                                        <span class="tooltip-text">
                                                        '.$messageUnsubscribedPourcent.'% des destinataires ayant reçu cet email se sont désabonnés de cette liste.
                                                        </span> 
                                                   </span>
                                                </span> 
                                            </div>
                                            <div class="kl_rigthinList">
                                                <span class="kl_valueInfoStat">'.$messageUnsubscribedPourcent.'%</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            ',
                                            ['controller' => 'Contacts', 'action' => 'liste', $idEvenement,'?'=>['is_filtreAvance'=>1,'unsub'=>1] ],
                                            ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_linkSpanStat' ]);
                                        ?> 
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kl_contDomaines row">
                            <div class="col-md-3">
                                <div class="kl_topDomaine ">
                                    <div class="kl_titleDomaine">Top domaines</div>
                                    <ul>
                                        <?php 
                                        if(!empty($topDomaine)){
                                        foreach($topDomaine as $domaine){ 
                                            if(!empty($domaine->domaine)){
                                            ?>
                                        <li><?= h($domaine->domaine) ?></li>
                                        <?php } } } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="kl_tempsMoyen kl_tmpBLeu ">
                                    <div class="kl_timeMoyen">
                                    <?php
                                    if(!empty($eventStatCampaign)){
                                        $openClick = $eventStatCampaign->event_open_delay;
                                        if(!empty($openClick)){
                                            // Prints something like: Monday
                                            echo date("h:i\':s\'\'",$openClick);
                                        }else{
											echo '--:--:--';
										}
                                    }else{
										echo '--:--:--';
									}
                                    ?>
                                    </div>
                                    <div class="kl_textTime">
                                        Temps moyen entre la réception et ouverture de l’e-mail
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 sf-border-left-right">
                                <div class="kl_tempsMoyen kl_tmpBLack">
                                    <div class="kl_timeMoyen">
                                    <?php 
                                    if(!empty($eventStatCampaign)){
                                        $moyenClick = $eventStatCampaign->event_click_delay;
                                        if(!empty($moyenClick)){
                                            // Prints something like: Monday
                                            echo date("h:i\':s\'\'",$moyenClick);
                                        }else{
											echo '--:--:--';
										}
                                    }else{
										echo '--:--:--';
									}
                                    ?>
                                    </div>
                                    <div class="kl_textTime">
                                        Temps moyen entre l’ouverture et le clic dans l’e-mail
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="kl_tempsMoyen kl_tmpGris">
                                    <div class="kl_timeMoyen">
                                    <?php
                                      $nbrMoyenneDouverture = 0;
                                      $messageSentCount = floatval($messageSentCount); 
                                      $messageOpenedCount = floatval($messageOpenedCount);                      
                                     if(!empty($messageOpenedCount)){
                                        $nbrMoyenneDouverture = $messageSentCount / $messageOpenedCount;
                                        
                                     }
                                     echo round($nbrMoyenneDouverture, 2);
                                    ?>
                                    </div>
                                    <div class="kl_textTime">
                                        Nombre moyen d’ouvertures par e-mail envoyé 
                                    </div>
                                </div>
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
    <!-- Column -->
</div>
<!-- Row -->