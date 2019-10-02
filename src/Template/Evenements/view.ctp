<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('flot/jquery.flot.js', ['block' => true]); ?>
<?= $this->Html->script('flot/jquery.flot.pie.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/view.js', ['block' => true]); ?>


<?php
$titrePage = "Tableau de bord de l'événement";
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
$evenement->nom,
['controller' => 'Evenements', 'action' => 'view', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<?php $this->start('actionTitle'); ?>
    <div class="pull-right">
        <?= $this->Html->link('<i class="mdi mdi-printer"></i> ' . __('Imprimer rapport de stats'), '/evenements/statistique/'.(base64_encode(base64_encode(base64_encode(serialize(array('idEvenement'=>$evenement->id)))))).'/'.md5(time()).'.pdf' , ['escape' => false, 'class' => 'kl_bntLinkSimple', 'target' => '_blank']); ?>
        <?php if($userConnected['role_id'] == 1 || $userConnected['role_id'] == 2){ ?>
            <?= $this->Form->postLink(__('Supprimer l\'événement'), ['action' => 'delete', $evenement->id], ['escapeTitle'=>false, 'class'=>'kl_bntLinkSimple', 'confirm' => __('Are you sure you want to delete ?')]) ?>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
<?php $this->end(); ?>

   <div class="kl_miseAjour">Date de dernière mise à jour : 
    <?php
    //debug($timeline); die;
     if(!empty($timeline)){
       //echo  date('d/m/y à H\hi', $timeline->queue);
       echo $timeline->date_timeline->format('d/m/Y à H\hi');// $timeline->date_timeline->format('d/m/y à H\hi');
     }else{
        echo $evenement->created->format('d/m/Y à H\hi');
     }
     //debug($photoEnAttenteValidation);
     
     ?>
    
     
     </div>
    <div class="row kl_firstBloc">
        <div class="col-md-3">
            <div class="col-md-12 kl_oneCount kl_countPhoto">
                <?php 

                $photoText = $nbrPhoto > 1 ? 'Photos':'Photo';

                if ($nbrPhoto == 0) {
                    echo $this->Html->link(
                    'Aucune photo',
                    ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]],
                    ['escape' => false]
                );
                }else{
                    echo $this->Html->link(
                    '<span class="kl_countValue">'.$nbrPhoto.'</span>'.$photoText,
                    //'/photos/liste/'.$idEvenement,
                    ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]],
                    ['escape' => false]
                );}              
                ?>
                  <div class="kl_photoAValider">
                    <?php
                    if($photoEnAttenteValidation){
                    $aValider = $photoEnAttenteValidation > 1 ? $photoEnAttenteValidation." photos" :$photoEnAttenteValidation." photo";
                                    echo $this->Html->link(
                                    '('.$aValider.' en attente de validation >>)',
                                    ['controller' => 'Photos', 'action' => 'liste', $evenement->id, '?' => ['queue' => time(), 'is_validate' => false]],
                                    ['escape' => false,'class'=>'kl_lienPhtoAValder']);
                    }
                    ?>
                    </div>
            </div>  
          
            
            <div class="col-md-12 kl_oneCount kl_countImpression">
                <span class="kl_countValue"><?= $evenement->print_counter ?></span> <?= $evenement->print_counter > 1 ? "Impressions" : "Impression" ?>
            </div>
            
            <div class="kl_oneCount kl_noBorder">
                <!--<a class="kl_voirToutPhoto">Voir les photos ></a>-->
                <?= $this->Html->link('Voir les photos >',['controller'=>'Photos','action'=>'liste', $evenement->id],['class'=>'kl_voirToutPhoto']); ?>
            </div>
        </div>
        <div class="col-md-9 kl_listePhotoBord">
            <?php 
            for($i=0; $i<5; $i++){
                if(isset($evenement->photos[$i])){
                    $photo = $evenement->photos[$i];
                    //echo $this->Html->image($photo->url_thumb_bo, ['width' => '18%']);
                   // echo $this->Html->link($this->Html->image($photo->url_thumb_bo, ['width' => '18%']), ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]], ['escape' => false]);
                    if($photo->type_media == 'video'){
                         echo $this->Html->link($this->Html->image($photo->url_miniature_video, ['width' => '18%']), ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]], ['escape' => false]);
                    }else{
                         echo $this->Html->link($this->Html->image($photo->url_thumb_bo, ['width' => '18%']), ['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]], ['escape' => false]);
                    }
                }
            } 
            ?>
        </div>
    </div>
    
    <div class="row kl_blocStatEvent">
        
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'Contacts','action' => 'liste',$evenement->id]) ?>">
                <?php $contxt = $nbrContact > 1 ? 'contacts':'contact'; ?>
                <div class="kl_oneStatValue"><?= $nbrContact ?></div>
                <div class="kl_oneStatTitre"><?= $contxt ?></div>
        </a>
        
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'Contacts','action' => 'liste',$evenement->id]) ?>">
            <div class="kl_oneStatValue"><?= $nbrContactEmail ?></div>
            <div class="kl_oneStatTitre"><?= $nbrContactEmail >1 ?"emails collectés" : "email collecté" ?></div>
        </a>
        
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'Contacts','action' => 'liste',$evenement->id]) ?>">
            <div class="kl_oneStatValue"><?= $nbrContactTel ?></div>
            <div class="kl_oneStatTitre"><?= $nbrContactTel > 1 ? 'téléphones collectés' : "téléphone collecté" ?></div>
        </a>
        
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'Contacts','action' => 'liste',$evenement->id,'?'=>['emailEnvoye'=> 1]]) ?>">
            <?php $textEmail = $nbrEmailEnvoye > 1 ? 'emails envoyés' :'email envoyé'; ?>
            <div class="kl_oneStatValue"><?= $nbrEmailEnvoye ?></div>
            <div class="kl_oneStatTitre"><?= $textEmail ?></div>
        </a>
        
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'Contacts','action' => 'liste',$evenement->id,'?'=>['smsEnvoye'=> 1]]) ?>">
            <?php $textSms = $nbrSmsEnvoye > 1 ? 'sms envoyés' : 'sms envoyé'; ?>
            <div class="kl_oneStatValue"><?= $nbrSmsEnvoye ?></div>
            <div class="kl_oneStatTitre"><?= $textSms ?></div>
        </a>
        
        <!--<div class="kl_oneStat">
            <div class="kl_oneStatValue"><?= $nbrTelechargementPhoto ?></div>
            <div class="kl_oneStatTitre"><?= $nbrTelechargementPhoto > 1 ? "photos téléchargées" : "photo téléchargée" ?></div>
        </div>-->
    </div>
    
    <div class="row kl_staEnvoiEvent">
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
            $boucePourcent = 0;
            
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
                    
                    $bouceCount = $messageHardBouncedCount + $messageSoftBouncedCount;
                    $boucePourcent = ($bouceCount*100)/$total;
                    $boucePourcent = round($boucePourcent, 2);
                    
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
        
        <input type="hidden" class="kl_delivredRatio" value="<?= $delivredPourcent ?>" />
        <input type="hidden" class="kl_ouvertRatio" value="<?= $ouvertPourcent ?>" />
        <input type="hidden" class="kl_clickedRatio" value="<?= $clickPourcent ?>" />
        <input type="hidden" class="kl_bounceRatio" value="<?= $boucePourcent ?>" />
        <div class="col-lg-6 p-0">
            <div class=" kl_campagne kl_campagneEmail">
                <h4 class="kl_titreCampagne">
                <?= $this->Html->link('Campagne E-mail',['controller'=>'Statistiques','action'=>'email', $evenement->id]) ?>
                </h4>
                <div class="chartCampagne <?php if(empty($delivredPourcent) && empty($smsDeliveryPercent)){ echo 'chartCampagne_vide_both' ;}?>">
                    <?php if(!empty($delivredPourcent)){ ?>
                        <div class="chartCampagne-content" id="flot-pie-chartSms"></div>
                    <?php }else{ ?>
                    <div class="chartCampagne_vide_email"><p class="kl_pasDeCampagagne">Aucune campagne E-mail</p></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <input type="hidden" class="kl_smsdelivredRatio" value="<?= $smsDeliveryPercent ?>" />
        <input type="hidden" class="kl_smsNotdelivredRatio" value="<?= $smsNotDeliveryPercent ?>" />
        <div class="col-lg-6 p-r-0">
            <div class="kl_campagne kl_campagneSms">
                <h4 class="kl_titreCampagne">
                 <?= $this->Html->link('Campagne Sms',['controller'=>'Statistiques','action'=>'sms', $evenement->id]) ?>
                </h4>
                <div class="chartCampagne <?php if(empty($delivredPourcent) && empty($smsDeliveryPercent)){ echo 'chartCampagne_vide_both' ;}?>">
                    <?php if(!empty($smsDeliveryPercent)){ ?>
                        <div class="chartCampagne-content" id="flot-pie-chartEmail" ></div>
                    <?php } else{ ?>
                        <div class="chartCampagne_vide_sms"><p class="kl_pasDeCampagagne">Aucune campagne sms</p></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row kl_blocStatEvent kl_chiffreFacebook">
        <div class="kl_pasDeCampagagne">
            <h4><?= $this->Html->link('Campagne Facebook',['controller'=>'FacebookAutos','action'=>'liste', $evenement->id]) ?></h4>
        </div>
        <?php //debug(count($evenement->facebook_autos));
         if(count($evenement->facebook_autos)){ ?>
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'FacebookAutos','action' => 'liste',$evenement->id]) ?>">
            <?php
            $isFacebookActive = 'Non';
            if(count($evenement->facebook_autos)){
                $isFacebookActive = 'Oui';
            }
            ?>
            <div class="kl_oneStatValue"><?= $isFacebookActive ?></div>
            <div class="kl_oneStatTitre">Plannification facebook</div>
        </a>
        <a class="kl_oneStat" href="<?= Router::url(['controller' => 'FacebookAutos','action' => 'liste',$evenement->id]) ?>">
            <?php
            $nbrFbAutoPoste = 0;
            foreach($evenement->facebook_autos as $fb_auto){
                $nbrFbAutoPoste = $nbrFbAutoPoste + count($fb_auto->facebook_auto_suivis);
            }
            ?>
            <div class="kl_oneStatValue"><?= $nbrFbAutoPoste ?></div>
            <div class="kl_oneStatTitre">Publiée sur facebook</div>
        </a>
        <?php } else{ ?>
            <p class="col-md-12">Aucune campagne Facebook</p>
        <?php } ?>
        
    </div>

