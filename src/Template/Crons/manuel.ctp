<?= $this->Html->script('crons/manuel.js', ['block' => true]); ?>
<?php
$titrePage = " Envoi manuel des photos";
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
<!--<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"> Envoi manuel des photos</h4>
            </div>
        </div>
    </div>
</div>-->
<div class="row">
    <div class="col-md-6">
        <div class="card">
           <div class="card-body kl_bodyEnvoieCard">
                <h5 class="card-text">Envoyer les photos non envoyées </h5>
                <div class="kl_statEnvoiMail row">
                    <?php 
                        //debug($nbrContactEmail); debug($nbrEmailEnvoye);
                        $resteEmailNonEnvoye = $nbrContactEmail- $nbrEmailEnvoye;
                        $kl_lEmail = "col-md-12";
                        if($resteEmailNonEnvoye > 0){
                            $kl_lEmail = "col-md-6";
                        }
                    ?>
                    <div class="<?= $kl_lEmail ?> btn">
                        Mail : <?= $nbrEmailEnvoye ?> envoyés / <?= $nbrContactEmail ?> 
                    </div>
                    <?php if($resteEmailNonEnvoye > 0) { ?>
                    <div class="col-md-6">
                        <?php
                            //echo $this->Html->link('<i class="mdi mdi-send"></i> Envoyer les '.$resteEmailNonEnvoye.' emails restants',['controller'=>'Photos','action'=>'envoi', $evenement->id, 1, 0 , 0],['escape'=>false,"class"=>"btn  hidden-sm-down btn-success " ]);

                            if($userConnected['is_active_acces_send_email']){ 
                                echo $this->Html->link('<i class="mdi mdi-send"></i> Envoyer les '.$resteEmailNonEnvoye.' emails restants','#',['escape'=>false,"class"=>"btn hidden-sm-down btn-success", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'1','data-sms' =>'0','data-force' => '0','data-reenvoi' =>'0' ]);
                             } 
                        ?>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                
                <div class="kl_statEnvoiSms row">
                    <?php 
                        $resteSmsNonEnvoye = $nbrContactSms - $nbrSmsEnvoye;
                        $kl_lSms = "col-md-12";
                        if($resteSmsNonEnvoye > 0){
                            $kl_lSms = "col-md-6";
                        }
                    ?>
                    <div class="<?= $kl_lSms ?> btn">
                        Sms : <?= $nbrSmsEnvoye ?> envoyés / <?= $nbrContactSms ?> 
                    </div>
                    <?php if($resteSmsNonEnvoye > 0) { ?>
                    <div class="col-md-6">
                         <?php
                            //echo $this->Html->link('<i class="mdi mdi-send"></i> Envoyer les '.$resteSmsNonEnvoye.' sms restants',['controller'=>'Photos','action'=>'envoi', $evenement->id,0,1,0],['escape'=>false,"class"=>"btn  hidden-sm-down btn-primary " ]);

                            if($userConnected['is_active_acces_send_sms']){ 
                                    echo $this->Html->link('<i class="mdi mdi-send"></i> Envoyer les '.$resteSmsNonEnvoye.' sms restants','#',['escape'=>false,"class"=>"btn  hidden-sm-down btn-primary ", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'0','data-sms' =>'1','data-force' => '0','data-reenvoi' =>'0' ]);
                            }
                        ?>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                <?php 
                    if(!empty($resteSmsNonEnvoye) && !empty($resteSmsNonEnvoye)){
                        //echo $this->Html->link('<i class="mdi mdi-send"></i> Tout envoyer (mail + sms)',['controller'=>'Photos','action'=>'envoi', $evenement->id, 1, 1, 0],['escape'=>false,"class"=>"btn  hidden-sm-down btn-danger  " ]); 
                        echo $this->Html->link('<i class="mdi mdi-send"></i> Tout envoyer (mail + sms)','#',['escape'=>false,"class"=>"btn  hidden-sm-down btn-danger  ", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'1','data-sms' =>'1','data-force' => '0' ,'data-reenvoi' =>'0']); 
                    
                    }
                ?>
                
                
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-body kl_bodyEnvoieCard">
                <h5 class="card-text">Envoyer toutes les photos (même celles ayant déjà été envoyées) </h5>
                <div class="kl_statEnvoiMail row">
                    <?php 
                        $resteEmailNonEnvoye = $nbrContactEmail- $nbrEmailEnvoye;
                        $kl_lEmailF = "col-md-12";
                        if($nbrContactEmail > 0){
                            $kl_lEmailF = "col-md-6";
                        }
                    ?>
                    <div class="<?= $kl_lEmailF ?> btn">
                        Mail : <?= $nbrEmailEnvoye ?> envoyés / <?= $nbrContactEmail ?>
                    </div>
                    <?php if($nbrContactEmail > 0) { ?>
                    <div class="col-md-6">
                         <?php
                            //echo $this->Html->link('<i class="mdi mdi-send"></i> Forcer l\'envoi email',['controller'=>'Photos','action'=>'envoi', $evenement->id, 1, 0 , 1],['escape'=>false,"class"=>"btn  hidden-sm-down btn-success " ]);
                            echo $this->Html->link('<i class="mdi mdi-send"></i> Forcer l\'envoi email','#',['escape'=>false,"class"=>"btn  hidden-sm-down btn-success ", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'1','data-sms' =>'0','data-force' => '1','data-reenvoi' =>'0' ]);
                            
                        ?>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                
                <div class="kl_statEnvoiSms row">
                    <?php 
                        $resteSmsNonEnvoye = $nbrContactSms - $nbrSmsEnvoye;
                        $kl_l = "col-md-12";
                        if($nbrContactSms > 0){
                            $kl_l = "col-md-6";
                        }
                    ?>
                    <div class="<?= $kl_l ?> btn">
                        Sms : <?= $nbrSmsEnvoye ?> envoyés / <?= $nbrContactSms ?> 
                    </div>
                    <?php if($nbrContactSms > 0) { ?>
                    <div class="col-md-6">
                         <?php
                            //echo $this->Html->link('<i class="mdi mdi-send"></i> Forcer l\'envoi des sms',['controller'=>'Photos','action'=>'envoi', $evenement->id,0,1,1],['escape'=>false,"class"=>"btn  hidden-sm-down btn-primary " ]);
                            echo $this->Html->link('<i class="mdi mdi-send"></i> Forcer l\'envoi sms','#',['escape'=>false,"class"=>"btn  hidden-sm-down btn-primary ", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'0','data-sms' =>'1','data-force' => '1','data-reenvoi' =>'0' ]);
                            
                        ?>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                <?php
               /* if(!empty($nbrContactSms) && !empty($nbrContactEmail)){
                    //echo $this->Form->postLink('<i class="mdi mdi-near-me"></i> Forcer l\'envoi',['controller'=>'Photos','action'=>'envoi', $evenement->id, true, true, true],['escape'=>false,"class"=>"btn  hidden-sm-down btn-danger m-r-10" ,'confirm'=>'Etes vous sur de vouloir tout reenvoyer ?']);
                    echo $this->Html->link('<i class="mdi mdi-near-me"></i> Forcer l\'envoi','#',['escape'=>false,"class"=>"btn  hidden-sm-down btn-danger m-r-10", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'1','data-sms' =>'1','data-force' => '1','data-reenvoi' =>'0']);
                    
                }*/
                ?>
            </div>
        </div>
    </div>
    
    <?php if(!empty($nbrEmailNotDelivry)){ ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body kl_bodyEnvoieCard">
                <h5 class="card-text">Ré-envoyer les emails non delivrés  </h5>
                <div class="kl_statEnvoiMail row kl_blockEnvoiMail">
                    <div class="col-md-6 btn">
                        E-mail non-delivré : <?= $nbrEmailNotDelivry ?>  
                    </div>
                    <div class="col-md-6">
                        <?= $this->Html->link('<i class="mdi mdi-near-me"></i> Ré-envoyer','#',['escape'=>false,"class"=>"btn  hidden-sm-down btn-danger m-r-10", "data-toggle"=>"modal", "data-target"=>"#id_envoiManuel",'data-email'=>'1','data-sms' =>'0','data-force' => '1','data-reenvoi' =>'1']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

    
<?php echo $this->element('Crons/add_manuel',['evenement' => $evenement]) ?>