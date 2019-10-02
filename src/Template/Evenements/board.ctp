<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->css('photos/popup_photo.css?v1_190213') ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?php //$this->Html->css('style.css', ['block' => true]) ?> 
<?php //$this->Html->script('https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', ['block' => true]) 
    echo $this->Html->script('mp-mansory/mp.mansory.min.js', ['block' => true]);
?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>
<?= $this->Html->script('photos/liste.js?'.time(), ['block' => true]); ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?= $this->Html->script('photos/popup_photo.js', ['block' => true]) ?>
<?= $this->Html->script('photos/resendcontact.js', ['block' => true]) ?>

<?= $this->Html->css('/assets/plugins/icheck/skins/all.css',['block'=>true]) ?>
<?= $this->Html->script('/assets/plugins/icheck/icheck.min.js', ['block' => true]); ?>
<?= $this->Html->script('/assets/plugins/icheck/icheck.init.js', ['block' => true]); ?>

<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>

<?php 
    $queue = time();
?>
<div class="row el-element-overlay">
	<div class="col-md-12">
		<div class="card card-new-selfizee">
			<div class="card-header border-bottom">
                        <h4 class="m-b-0 text-black pull-left">Tableau de bord événement </h4>
                        <?php 
                            if($nbrPhoto){ 
                                echo $this->Html->link('Générer le rapport de stat  <i class="fa  fa-angle-right"></i>', '/evenements/statistique/'.(base64_encode(base64_encode(base64_encode(serialize(array('idEvenement'=>$evenement->id)))))).'/'.md5(time()).'.pdf' , ['escape' => false, 'class' => 'pull-right link link-selfizee-action', 'target' => '_blank']); 
                        	} 
                        ?>
                        <div class="clearfix"></div>
            </div>
			
			<div class="card-body">
				<?php if($nbrPhoto){ ?>
				<div class="kl_titreTop">
					<div class="kl_syntheseEvent pull-left">Synthèse événement :</div>
					<div class="kl_dernireMiseAjour pull-right">Dernière mise à jour : 
						<span>
							<?php
						    if(!empty($timeline)){
						       echo $timeline->date_timeline->format('d/m/Y à H\hi');
						   	}else{
						        echo $evenement->created->format('d/m/Y à H\hi');
						    }
						    ?>
						</span>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="row ">
					<div class="col-md-2 kl_nopadding">
						<a href="<?= $this->Url->build(['controller' => 'Photos', 'action' => 'liste', $idEvenement], true) ?>">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $nbrPhoto ?></span> <?= $nbrPhoto>1 ? 'photos':'photo' ?> 
                            </div>
                        </a>
					</div>
					<div class="col-md-2 kl_nopadding">
						<a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $evenement->print_counter ?></span> <?= $evenement->print_counter > 1 ? "impressions" : "impression" ?>
                            </div>
                        </a>
					</div>
					<div class="col-md-6 kl_nopadding ">
						<a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'formulaire', $idEvenement]) ?>">
                            <div class="kl_oneStatCount text-center row">
                                <div class="col-6">
                                    <span class="kl_statNbrValue"><?= $nbrContact ?></span> <?= $nbrContact > 1 ? 'contacts':'contact'; ?>
                                </div>
                                <div class="col-6">
                                    <div class="kl_oneDetailContact">120 optin facebook</div>
                                    <div class="kl_oneDetailContact">100 optin commercial</div>
                                </div>
                            </div>
                        </a>
					</div>

					<div class="col-md-2 kl_nopadding">
						<a href="<?= $this->Url->build(['controller' => 'Statistiques', 'action' => 'demographie', $idEvenement]) ?>">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $nbrPersonnes ?></span> <?= $nbrPersonnes > 1 ? 'personnes':'personne'; ?>
                            </div>
                        </a>
					</div>
				</div>
				<?php }else{ ?>
				<p>Aucune donnée.</p>
				<?php } ?>
			</div>
		</div>

		<?php if($nbrPhoto){ ?>
		<div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left">Photos</h4>
                <?= $this->Html->link('Accéder aux photos  <i class="fa  fa-angle-right"></i>', ['controller' => 'Photos', 'action' => 'liste', $idEvenement], ['escape' => false,'class'=>'pull-right link link-selfizee-action']); ?>
                <div class="clearfix"></div>
            </div>

			<div class="card-body">

                <div class="kl_titreTop d-block clearfix">
                    <div class="kl_syntheseEvent pull-left">Dernières photos :</div>
                </div>

                <div class="kl_listePhoto row-fluid d-flex clearfix" id="id_photoListe">
                    <?php for($i=0; $i<6; $i++): ?>
                        <?php if(isset($evenement->photos[$i])): ?>
                            <?php 
                                $photo = $evenement->photos[$i]; 
                                $style_img = 'style="min-height: 150px;object-fit: cover;"';
                                $photo_thumb =
                                $style_bloc = '';

                                if($photo->type_media == 'video'){
                                    $photo_thumb = '/img/icon-play.png';
                                    $style_img = ' style="width:100px !important;margin: auto;margin-top:30px;" ';
                                    $style_bloc = ' style="background: black;background-image:url('.$photo->url_miniature_video.');height: 150px !important;"';
                                }else{
                                    $photo_thumb = $photo->url_thumb_bo;
                                    $style_bloc = 'style="height: 140px !important;"';
                                }
                            ?>

                            <div class="kl_onePhoto" data-order="<?= $i ?>" id="id_onePhoto_<?= $photo->id ?>">
                                <div class="card-one">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1 sf-video" <?= $style_bloc; ?>> 
                                            <img src="<?= $photo_thumb; ?>" alt="<?= $photo->created ?>" <?= $style_img ?>/>

                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li>
                                                        <!-- <a class="btn default btn-outline image-popup-vertical-fit" href="<?= $photo->url_photo ?>"><i class="icon-magnifier"></i></a>-->
                                                        <?php echo $this->Html->link('<i class="icon-magnifier"></i> ',['controller'=>'Photos','action'=>'get', $photo->id, '_full' => true],['escape'=>false,"class"=>"btn default btn-outline kl_viewImage" ]);  ?>
                                                    </li>

                                                    <?php if($userConnected['is_active_acces_edit_photo']): ?>
                                                        <li>
                                                            <a href="#" class="btn default btn-danger kl_deletePhoto" data-item="<?= $photo->id ?>" data-queue="<?= $queue ?>" ><i class="icon-close "></i></a>
                                                        </li>
                                                    <?php endif ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endfor ?>
                </div>
                    
    			<?php 
                // for($i=0; $i<6; $i++){
                //     if(isset($evenement->photos[$i])){
                //         $photo = $evenement->photos[$i]; 
                //         $style_img =
                //         $photo_thumb =
                //         $style_bloc = '';

                //         if($photo -> type_media == 'video'){
                //             $photo_thumb = '/img/icon-play.png';
                //             $style_img = ' style="width:100px !important;margin: auto;margin-top:77px;" ';
                //             $style_bloc = ' style="background: black;background-image:url('.$photo->url_miniature_video.');height: 244px !important;"';
                //         }else{
                //             $photo_thumb = $photo->url_thumb_bo;
                //         }


                //         if($photo->type_media == 'video'){
                //              echo $this->Html->link($this->Html->image($photo->url_miniature_video, ['width' => '100%']), ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]], ['escape' => false,'class'=>'col-md-2']);
                //         }else{
                //              echo $this->Html->link($this->Html->image($photo->url_thumb_bo, ['width' => '100%']), ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]], ['escape' => false,'class'=>'col-md-2 thumbevent-board']);
                //         }
                //     }
                // } 
                ?>
            </div>
        </div>
		<?php } ?>
	
        <?php 
        if(!empty($listIdFonctionnaliteActive)){
        if (in_array(1, $listIdFonctionnaliteActive)){ ?>
        	<div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                            <h4 class="m-b-0 text-black pull-left">E-mails </h4>
        						<?php
        						if($nbrContactEmail){
        							$this->Html->link('Accéder aux stats e-mails   <i class="fa  fa-angle-right"></i>', ['controller' => 'Statistiques', 'action' => 'email', $idEvenement], ['escape' => false,'class'=>'pull-right link link-selfizee-action']); 
        						}
        						?>
                            <div class="clearfix"></div>
                </div>

        		<div class="card-body row">
        		<?php 
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
        			?>
        			<div class="col-md-3">
        				<div class="kl_blocStatMails kl_totalMail">
        					<a href="/contacts/liste/<?= $idEvenement ?>"  class="">
        						<div class="kl_theMemeH">
        							<span class="kl_total_mail kl_txt_bold"><?= $total ?></span>
        							<div class="kl_txt_bold"><?= $total>1 ? 'E-mails' : 'E-mail' ?></div>
        						</div>
        						<div class="kl_textDescValue">TOTAL</div>
        					</a> 
        				</div>
        			</div>
        			<div class="col-md-2">
        				<div class="kl_blocStatMails kl_emailDelivres">
        					<a href="#" class="kl_linkToStatValue">
        						<div class="kl_theMemeH">
        							<div class="clearfix sf-bloc-value">
        								<div class="kl_values sf-rose pull-left"><?= $delivredPourcent ?>%</div>
        								<div class="kl_valeurCounts pull-right"><?= $messageSentCount ?></div>
        							</div>
        							<div class="progress kl-progress-pers kl-progress-pers-new">
        								<div class="progress-bar bg-danger" style="width: <?php echo ($delivredPourcent ? $delivredPourcent : 1); ?>%; height:10px;border-radius:0;" role="progressbar"></div>
        							</div>
        						</div>
        						<div class="kl_textDescValue">Délivrés</div>
        					</a>
        				</div>
        			</div>
        			<div class="col-md-2">
        				<div class="kl_blocStatMails kl_emailDelivres">
        					<a href="#" class="kl_linkToStatValue">
        						<div class="kl_theMemeH">
        							<div class="clearfix sf-bloc-value">
        								<div class="kl_values sf-rose pull-left"><?= $ouvertPourcent ?> %</div>
        								<div class="kl_valeurCounts pull-right"><?= $messageOpenedCount ?></div>
        							</div>
        							<div class="progress kl-progress-pers kl-progress-pers-new">
        								<div class="progress-bar bg-danger" style="width: <?php echo ($ouvertPourcent ? $ouvertPourcent : 1); ?>%; height:10px;border-radius:0;" role="progressbar"></div>
        							</div>
        						</div>
        						<div class="kl_textDescValue">Ouverts</div>
        					</a>
        				</div>
        			</div>
        			<div class="col-md-2">
        				<div class="kl_blocStatMails kl_emailDelivres">
        					<a href="#" class="kl_linkToStatValue">
        						<div class="kl_theMemeH">
        							<div class="clearfix sf-bloc-value">
        								<div class="kl_values sf-rose pull-left"><?= $clickPourcent ?>%</div>
        								<div class="kl_valeurCounts pull-right"><?= $messageClickedCount ?></div>
        							</div>
        							<div class="progress kl-progress-pers kl-progress-pers-new">
        								<div class="progress-bar bg-danger" style="width:<?php echo ($clickPourcent ? $clickPourcent : 1) ?>%; height:10px;border-radius:0;" role="progressbar"></div>
        							</div>
        						</div>
        						<div class="kl_textDescValue">Cliqués</div>
        					</a>
        				</div>
        			</div>
        			<div class="col-md-3">
        				<div class="kl_blocStatMailsListErreur">
        					<div class="kl_oneInfoStat text-white clearfix">
        						<div class="pull-left">Bloqués</div>
        						<div class="pull-right"><?= $blockedPourcent ?>%</div>
        					</div>
        					<div class="kl_oneInfoStat text-white clearfix">
        						<div class="pull-left">Spam</div>
        						<div class="pull-right"><?$spamPourcent ?>%</div>
        					</div>
        					<div class="kl_oneInfoStat text-white clearfix">
        						<div class="pull-left">Erreur permante</div>
        						<div class="pull-right"><?= $hardBouncePourcent ?>%</div>
        					</div>
        					<div class="kl_oneInfoStat text-white clearfix">
        						<div class="pull-left">Erreur temporaire</div>
        						<div class="pull-right"><?= $softBouncePourcent ?>%</div>
        					</div>
        					<div class="kl_oneInfoStat text-white clearfix">
        						<div class="pull-left">Renvoi</div>
        						<div class="pull-right"><?= $messageDeferredPourcent ?>%</div>
        					</div>
        				</div>
        			</div>
        			<?php }else{ ?>
        				<p class="col-md-12">Aucun e-mail pour le moment.</p>
        			<?php } ?>
        		</div>
        	</div>
        <?php }} ?>
    </div>
</div>