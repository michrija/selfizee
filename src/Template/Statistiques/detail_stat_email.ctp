<?php
$titrePage = "Statistiques détaillées" ;

?>
<div class="row">
        <div class="col-md-12">
            <div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                        <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                </div>
                    <div class="card-body">
                        <div class="infoBoxStat">
                            <div class="kl_oneStatdetail">
                                <span class="kl_titreStat">Evénement :</span> <?= $evenement->slug ?>
                            </div>
                            <div class="kl_oneStatdetail">
                                <span class="kl_titreStat">E-mail :</span> <?= $contact->email ?>
                            </div>
                            <div class="kl_oneStatdetail">
                                <span class="kl_titreStat">Date d'envoi :</span> <?=  $this->Text->toList($dateEnvois); //$contact->email ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <?php if(!empty($statistiques)){ ?>
                            <div class="table-responsive">
                                <table class="table tableContact">
                                    <thead>
                                        <tr>
                                            <th scope="col">Actions</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        
                                        foreach($statistiques as $statistique) {?>
                                        <tr>
                                            <td>
                                            <?php
                                                switch ($statistique->event_type) {
                                                    case "open":
                                                        echo "Message ouvert";
                                                        break;
                                                    case "sent":
                                                        echo "Message delivré";
                                                        break;
                                                    case "click":
                                                        echo "Message cliqué";
                                                        break;
                                                    case "blocked":
                                                        echo 'Messsage bloqué';
                                                        break;
                                                   /* case "bounce":
                                                        echo 'Messsage non delivré';
                                                        break;*/
                                                    default :
                                                        echo $statistique->event_type;
                                                        break;
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <?= $statistique->date_event->format('d/m/y à H:i:s') ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }else{ ?>
                              <div class="bold">Aucune action pour le moment</div>
                            <?php } ?>
                        </div>
                    </div>
            </div>
        </div>
</div>