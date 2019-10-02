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

echo $this->element('breadcrumb',['titrePage' => ""]);
$this->end();

?>
<!-- Row -->
<div class="row">

    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active"  href="#home" role="tab">Email notification</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#profile" role="tab">Profile</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#settings" role="tab">Settings</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="kl_contentStat">
        <div class="container">
            <div class="kl_statMails">
                <div class="kl_blocStatMails kl_totalMail">
                    <span><?= $_total_email ?></span>
                    <div>E-mails</div>
                    <strong>TOTAL</strong>
                </div>
                <div class="kl_blocStatMails kl_emailDelivres">
                      <div class="barOverflow">
                        <div class="bar"></div>
                      </div>
                      <span><?= h($delivered_percent) ?></span>%
                      <div class="kl_textNav">Délivrés</div>
                </div>
                <div class="kl_blocStatMails kl_emailouvert">
                      <div class="barOverflow">
                        <div class="bar"></div>
                      </div>
                      <span><?= h($opened_percent) ?></span>%
                      <div class="kl_textNav">Ouvert</div>
                </div>
                <div class="kl_blocStatMails kl_emailclique">
                      <div class="barOverflow">
                        <div class="bar"></div>
                      </div>
                      <span><?= h($clicked_percent) ?></span>%
                      <div class="kl_textNav">cliqués</div>
                </div>
                <div class="kl_blocStatMails kl_emailAutre">
                    <div><label>Bloqués</label><?= h($blocked_percent) ?>%</div>
                    <div><label>Erreurs</label>0%</div>
                    <div><label>Spam</label><?= h($spam_percent) ?>%</div>
                </div>
            </div>
            <div class="kl_contDomaines">
                <div class="kl_topDomaine">
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
                <div class="kl_tempsMoyen kl_tmpBLeu">
                    <div class="kl_timeMoyen">
                    <?php 
                    echo $seconde_minute_heure_ouverture;
                   ?>
                    </div>
                    <div class="kl_textTime">
                        Temps moyen entre la réception et ouverture de l’e-mail
                    </div>
                </div>
                <div class="kl_tempsMoyen kl_tmpBLack">
                    <div class="kl_timeMoyen">
                    <?php 
                    echo $seconde_minute_heure_clic;
                    ?>
                    </div>
                    <div class="kl_textTime">
                        Temps moyen entre l’ouverture et le clic dans l’e-mail
                    </div>
                </div>
                <div class="kl_tempsMoyen kl_tmpGris">
                    <div class="kl_timeMoyen"><?= h(number_format($average_opened_count, 2, '.', ',')) ?></div>
                    <div class="kl_textTime">
                        Nombre moyen d’ouvertures par e-mail envoyé 
                    </div>
                </div>
            </div>
        </div>
    </div>
	
                    </div>
                </div>
                <!--second tab-->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->