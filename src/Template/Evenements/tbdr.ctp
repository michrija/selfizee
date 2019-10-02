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
        <?= $this->Form->postLink(__('Supprimer l\'événement'), ['action' => 'delete', $evenement->id], ['escapeTitle'=>false, 'class'=>'kl_bntLinkSimple', 'confirm' => __('Are you sure you want to delete ?')]) ?>
    </div>
<?php $this->end(); ?>
<div class="clearfix"></div>
<div class="row mt-3">
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
                $photoText = $nbrPhoto > 1 ? 'Photos':'Photo';
                echo $this->Html->link('<h1 class="font-light text-white">'.$nbrPhoto.'</h1><h6 class="text-white">'.$photoText.'</h6>', ['controller'=>'Photos','action' => 'liste', $evenement->id,'?'=>['queue' => time()]],['escapeTitle'=>false,'class'=>'box text-center']) 
            ?>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
            $contxt = $nbrContact > 1 ? 'Contacts':'Contact';
            echo $this->Html->link('<h1 class="font-light text-white">'.$nbrContact.'</h1><h6 class="text-white">'.$contxt.'</h6>', ['controller'=>'Contacts','action' => 'liste', $evenement->id],['escapeTitle'=>false,'class'=>'box text-center']) ?>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
            $textEmail = $nbrEmailEnvoye > 1 ? 'Emails envoyés' :'Email envoyé';
            echo $this->Html->link('<h1 class="font-light text-white">'.$nbrEmailEnvoye.'</h1><h6 class="text-white">'.$textEmail.'</h6>', ['controller'=>'Contacts','action' => 'liste', $evenement->id,'?'=>['emailEnvoye'=>1]],['escapeTitle'=>false,'class'=>'box text-center']) ?>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <div class="box text-center">
                <h1 class="font-light text-white"><?= $nbrEmailOuvert ?></h1>
                <h6 class="text-white"><?= $nbrEmailOuvert> 1 ? "E-mails ouverts" :"E-mail ouvert" ?></h6>
            </div>
        </div>
    </div>
    
    
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
            //debug($nbrSmsEnvoye);
            $textSms = $nbrSmsEnvoye > 1 ? 'Sms envoyés' : 'Sms envoyé';
            echo $this->Html->link('<h1 class="font-light text-white">'.$nbrSmsEnvoye.'</h1><h6 class="text-white">'.$textSms.'</h6>', ['controller'=>'Contacts','action' => 'liste', $evenement->id,'?'=>['smsEnvoye'=>1]],['escapeTitle'=>false,'class'=>'box text-center']) ?>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <div class="box text-center">
                <h1 class="font-light text-white"><?= $nbrSmsOuvert ?></h1>
                <h6 class="text-white">Sms Ouvert</h6>
            </div>
        </div>
    </div>
    
     <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <div class="box text-center">
                <h1 class="font-light text-white">0</h1>
                <h6 class="text-white">Photo partagée sur facebook</h6>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
            $isCornActive = 'Non';
            if($evenement->cron) {
                $isCornActive = 'Oui';
            }
            echo $this->Html->link('<h1 class="font-light text-white">'.$isCornActive.'</h1><h6 class="text-white">Envoi live & planification</h6>', ['controller'=>'Crons','action' => 'add', $evenement->id],['escapeTitle'=>false,'class'=>'box text-center']);
            ?>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
            $isFacebookActive = 'Non';
            if(count($evenement->facebook_autos)){
                $isFacebookActive = 'Oui';
            }
            echo $this->Html->link('<h1 class="font-light text-white">'.$isFacebookActive.'</h1><h6 class="text-white">Planification facebook</h6>', ['controller'=>'FacebookAutos','action' => 'liste', $evenement->id],['escapeTitle'=>false,'class'=>'box text-center']);
            ?>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php          
            $nbrFbAutoPoste = 0;
            foreach($evenement->facebook_autos as $fb_auto){
                $nbrFbAutoPoste = $nbrFbAutoPoste + count($fb_auto->facebook_auto_suivis);
            }
            echo $this->Html->link('<h1 class="font-light text-white">'.$nbrFbAutoPoste.'</h1><h6 class="text-white">Publiée sur facebook</h6>', ['controller'=>'FacebookAutos','action' => 'liste', $evenement->id],['escapeTitle'=>false,'class'=>'box text-center']);
            ?>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <div class="box text-center">
                <h1 class="font-light text-white"><?= $nbrTelechargementPhoto ?></h1>
                <h6 class="text-white"><?= $nbrTelechargementPhoto > 1 ? "Photos téléchargées" : "Photo téléchargée" ?></h6>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <div class="box text-center">
                <h1 class="font-light text-white"><?= $nbrPageVue ?></h1>
                <h6 class="text-white"><?= $nbrPageVue > 0 ? "Pages souvenir vues" : "Page souvenir vue" ?></h6>
            </div>
        </div>
    </div>
    
    
    
</div>