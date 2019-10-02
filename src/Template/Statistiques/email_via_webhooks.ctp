<?= $this->Html->css('Statistiques/statistiques.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/emails_notifications.js',['block'=>true]) ?>

<?php
$titrePage = "Statistiques E-mail";
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

    /*$delivered_percent = 0;
    $opened_percent = 0;
    $clicked_percent = 0;
    $blocked_percent = 0;
    $spam_percent = 0;
    $seconde_minute_heure_clic = 0;
    $seconde_minute_heure_ouverture = 0;
    $average_opened_count = 0;
    //debug($emailStat);
    if(!empty($emailStat)){
        $delivered_percent = $emailStat->delivered_percent;
        $opened_percent = $emailStat->opened_percent;
        $clicked_percent = $emailStat->clicked_percent;
        $blocked_percent = $emailStat->blocked_percent;
        $spam_percent = $emailStat->spam_percent;
        $seconde_minute_heure_ouverture = $emailStat->seconde_minute_heure_ouverture;
        $seconde_minute_heure_clic = $emailStat->seconde_minute_heure_clic;
        $average_opened_count = $emailStat->average_opened_count;
    }*/

?>
<!-- Row -->
<div class="row">

    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"><?php echo $this->Html->link('Email notification',['controller' => 'Statistiques', 'action' => 'email', $idEvenement],["class"=>"nav-link active","role"=>"tab"]); ?> </li>
                <li class="nav-item"><?php echo $this->Html->link('Sms notification',['controller' => 'Statistiques', 'action' => 'sms', $idEvenement],["class"=>"nav-link","role"=>"tab"]); ?> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="kl_contentStat">
                            <div class="container">
                                <div class="kl_statMails row">
                                    <div class="kl_blocStatMails kl_totalMail col-md-2">
                                        <span><?= $nbrContactEmail ?></span>
                                        <div>E-mails</div>
                                        <strong>TOTAL</strong>
                                    </div>
                                    <div class="kl_blocStatMails kl_emailDelivres col-md-2">
                                          <div class="barOverflow">
                                            <div class="bar"></div>
                                          </div>
                                          <span><?= h($delivredPourcent) ?></span>%
                                          <div class="kl_valeurCount"><?= !empty($nbrEmailSent) ? $nbrEmailSent : "-" ?></div>
                                          <div class="kl_textNav">Délivrés</div>
                                    </div>
                                    <div class="kl_blocStatMails kl_emailouvert col-md-2">
                                          <div class="barOverflow">
                                            <div class="bar"></div>
                                          </div>
                                          <span><?= h($ouvertPourcent) ?></span>%
                                          <div class="kl_valeurCount "><?= !empty($nbrEmailOuvert) ? $nbrEmailOuvert : "-" ?></div>
                                          <div class="kl_textNav">Ouvert</div>
                                    </div>
                                    <div class="kl_blocStatMails kl_emailclique col-md-2">
                                          <div class="barOverflow">
                                            <div class="bar"></div>
                                          </div>
                                          <span><?= h($clickPourcent) ?></span>%
                                          <div class="kl_valeurCount"><?= !empty($nbrEmailClick) ? $nbrEmailClick : "-" ?></div>
                                          <div class="kl_textNav">cliqués</div>
                                    </div>
                                    <div class="kl_blocStatMails kl_emailAutre col-md-3">
                                        <div class="kl_oneInfoStat">
                                            <span class="kl_titreInfoStat">Bloqués</span>
                                            <span class="kl_valueInfoStat"><?= h($blockedPourcent) ?>%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="kl_oneInfoStat">
                                            <span class="kl_titreInfoStat">Spam</span>
                                            <span class="kl_valueInfoStat"><?= h($spamPourcent ) ?>%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="kl_oneInfoStat">
                                            <span class="kl_titreInfoStat">Erreur permanente</span>
                                            <span class="kl_valueInfoStat">9,52%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="kl_oneInfoStat">
                                            <span class="kl_titreInfoStat">Erreur temporaire</span>
                                            <span class="kl_valueInfoStat">9,52%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="kl_oneInfoStat">
                                            <span class="kl_titreInfoStat">Renvoi</span>
                                            <span class="kl_valueInfoStat">9,52%</span>
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
                                            echo $moyenOuverture;
                                           ?>
                                            </div>
                                            <div class="kl_textTime">
                                                Temps moyen entre la réception et ouverture de l’e-mail
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kl_tempsMoyen kl_tmpBLack">
                                            <div class="kl_timeMoyen">
                                            <?php 
                                            echo $moyenClick;
                                            ?>
                                            </div>
                                            <div class="kl_textTime">
                                                Temps moyen entre l’ouverture et le clic dans l’e-mail
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kl_tempsMoyen kl_tmpGris">
                                            <div class="kl_timeMoyen"><?= $nbrMoyenneDouverture ?></div>
                                            <div class="kl_textTime">
                                                Nombre moyen d’ouvertures par e-mail envoyé 
                                            </div>
                                        </div>
                                    </div>
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