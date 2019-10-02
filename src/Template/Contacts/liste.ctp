<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>

<?= $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?= $this->Html->script('jasny/jasny-bootstrap.js', ['block' => true]); ?>
<?= $this->Html->script('fixedheader/jquery.fixedheadertable.min.js', ['block' => true]); ?>
<?= $this->Html->script('Contacts/liste.js', ['block' => true]); ?>
<?= $this->Html->script('Contacts/send_avec_email_propose.js', ['block' => true]); ?>

<?php
    $titrePage = "Statistiques par contact" ;
    //debug($countAllContact);
?>

<?php if(!empty($countAllContact)){ ?>
<div class="row el-element-overlay">
    <div class="col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?> </h4>
              
                <?php 
                    echo $this->Form->postLink('Supprimer tous les contacts',['action'=>'deleteAll', $evenement->id],['escape'=>false,"class"=>"pull-right link link-selfizee-action ",'confirm'=>'Etes vous sûr de vouloir tout supprimer ?']);

                    echo $this->Html->link('Voir le fichier csv',['controller' => 'Contacts', 'action' => 'voirCsv', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action m-r-15' ]); 

                    if($contacts->count() >= 1 ){ 
                        unset($options['listeIdPhoto']);
                        unset($options['idEnvoiEmail']);
                        unset($options['idConctatEmailDelivre']);
                        unset($options['idConctatEmailOuvert']);
                        unset($options['idConctatEmailClique']);
                        unset($options['idContactEmailEnvoye']);
                        unset($options['listeIdPhotoDownloaded']);
                        unset($options['idContactSmsDelivre']);
                            
                        echo $this->Html->link(' Exporter les contacts',
                                                    ['controller' => 'Contacts', 'action' => 'export', $idEvenement,'?'=>$options],
                                                    ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action m-r-15' ]); 
                    }

                    echo $this->Html->link('Importer fichier csv',['controller' => 'Contacts', 'action' => 'importer', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action m-r-15' ]);
                ?>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="kl_titreTop">
                    <div class="kl_syntheseEvent pull-left">Synthèse événement :</div>
                    <div class="clearfix"></div>
                </div>
                <div class="row kl_statTop">
                    
                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $countAllContact ?></span> 
                                <?= $countAllContact>1 ? "contacts" :"contact" ?>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $countContactEmail ?></span> 
                                <?= $countContactEmail>1 ? "e-mails" :"e-mail" ?>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $countContactTel ?></span> 
                                <?= $countContactTel>1 ? "téléphones" :"téléphone" ?>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $nbrEmailEnvoye ?></span> 
                                <?= $nbrEmailEnvoye > 1 ? "email envoyés" : "email envoyé" ?>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $nbrEmailEnvoye ?></span> 
                                <?= $nbrSmsEnvoye > 1 ? "sms envoyés" : "sms envoyé" ?>
                            </div>
                        </a>
                    </div>
                   
                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $nbrEmailEnvoye ?></span> 
                                <?= $nbrEmailOuvert > 1 ? "emails ouverts" : "email ouvert" ?>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="kl_theFiltre">
                    <?php  
                    echo $this->Form->create(null, ['type' => 'get' ,'id'=>'id_filtreContact','role'=>'form']);   
                    
                    echo $this->Form->control('filtre',['label'=>'Activer le filtre','type'=>'checkbox','id'=>'id_filtreToActive', "value"=>'1','default' => $filtre,'hiddenField' => false]); 
                    ?>
                    <div class="kl_filtre_contact <?= empty($filtre) ? 'hide' :'' ?>"  id="id_blocFormFiltre">
                        <div class="row">
                            <div class="col-md-2">
                                <?php echo $this->Form->control('key',['value'=>$key, 'label'=>false, 'class'=>'form-control search','placeholder'=>'Rechercher...', 'templates' => ['inputContainer' => '{{content}}']]); ?>
                            </div>
                        
                            <!--<div class="col-md-2 p-l-0">
                                <?php 
                                    
                                    $optinOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('optin', $optinOptions, ['default'=>$optin,'empty' => 'Optin','class'=>'form-control']);
                                ?>
                            </div>--> 
                            
                            <div class="col-md-2 p-l-0">
                                <?php 
                                    $smsEnvoyeOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('smsEnvoye', $smsEnvoyeOptions, ['default'=>$smsEnvoye,'empty' => 'SMS envoyé','class'=>'form-control']);
                                ?>
                            </div>
                            
                            <div class="col-md-2 p-l-0">
                                <?php 
                                    $emailEnvoyeOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('emailEnvoye', $emailEnvoyeOptions, ['default'=>$emailEnvoye, 'empty' => 'E-mail envoyé','class'=>'form-control']);
                                ?>
                            </div>
                            <div class="col-md-2 p-l-0 bloc_active_filtre_avances" id="id_theCheckBoxIfAvance">
                                <?php echo $this->Form->control('is_filtreAvance', ['value'=>1,'type'=>'checkbox', 'label'=>'Filtres avancés', 'id'=>'id_avanceFiltre', 'hiddenField' => false, 'checked' => $is_filtreAvance,
                                    'templates' => ['checkboxContainer' => '{{content}}' ]]); ?>
                            </div>
                            
                            <div class="col-md-2 p-l-0 row btn_filtre_contact">
                                <div class="col-md-4 p-l-0 m-r-5">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-selfizee-inverse noborber'] );?>
                                </div>
                                <div class="col-md-4 ">
                                    <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Réinitialiser', ['action' => 'liste', $evenement->id], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-selfizee-inverse noborber", "escape"=>false]);   ?>         
                                </div>
                            </div>
                        </div>
                        <?php
                            $hideFiltreAvance = "hide";
                            if($is_filtreAvance){
                                $hideFiltreAvance = "";
                            }
                        ?>
                        <div class="row kl_avanceFiltre <?= $hideFiltreAvance ?> m-t-5">
                            <div class="col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php 
                                    $sentOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('sent', $sentOptions, ['default'=>$sent, 'empty' => 'E-mail delivré','class'=>'form-control']);
                                ?>
                            </div>
                            
                            <div class="p-l-0 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php 
                                    $blockedOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('blocked', $blockedOptions, ['default'=>$blocked, 'empty' => 'Bloqués','class'=>'form-control']);
                                ?>
                            </div>
                            
                            <div class="p-l-0 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php 
                                    $spamOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('spam', $spamOptions, ['default'=>$spam, 'empty' => 'Spam','class'=>'form-control']);
                                ?>
                            </div>
                            
                            <div class="p-l-0 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php 
                                    $hardBounceOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('hardBounce', $hardBounceOptions, ['default'=>$hardBounce, 'empty' => 'Erreur temporaire','class'=>'form-control']);
                                ?>
                            </div>
                            
                            <div class="p-l-0 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php 
                                    $desaboOptions = ['1' => 'Oui', '2' => 'Non'];
                                    echo $this->Form->select('unsub', $desaboOptions, ['default'=>$unsub, 'empty' => 'Désabonné','class'=>'form-control']);
                                ?>
                            </div>
                            
                            <div class="p-l-0 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php
                                    $emailOuvertOptions = ['1' => 'Oui', '2' => 'Non'];
                                echo $this->Form->select('emailOuvert', $emailOuvertOptions, ['default'=>$emailOuvert,'empty' => 'Email Ouvert','class'=>'form-control']);
                                ?>
                            </div>
                        </div>

                        <div class="row kl_avanceFiltre <?= $hideFiltreAvance ?>">
                            <div class=" m-t-10 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php
                                $emailClickOptions = ['1' => 'Oui', '2' => 'Non'];
                                echo $this->Form->select('emailClick', $emailClickOptions, ['default'=>$emailClick,'empty' => 'Email cliqué','class'=>'form-control']);
                                ?>
                            </div>

                            <div class="p-l-0 m-t-10 col-md-2 kl_avanceFiltre <?= $hideFiltreAvance ?>">
                                <?php
                                    $photoTelechargeeOptions = ['1' => 'Oui', '2' => 'Non'];
                                echo $this->Form->select('photoTelechargee', $photoTelechargeeOptions, ['default'=>$photoTelechargee,'empty' => 'Photo Telechargée','class'=>'form-control']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="card card-new-selfizee">
            <div class="card-body">
                <?php if($contacts->count()){ ?>
                <div class="col-12  p-0">
                    <div class="kl_deleteSelectContact hide" id="id_contactSelected">
                         <?= $this->Form->postLink('<i class="mdi mdi-delete"></i> Supprimer les contacts séléctionnés',['action'=>'deleteSelected', $evenement->id],['escape'=>false,"class"=>"btn btn-danger ",'confirm'=>'Etes vous sûr de vouloir supprimer les contacts séléctionnés ?']); ?>
                        <input type="hidden" value="<?= $evenement->id ?>" id="id_evenement" />
                    </div>  
                    <div class="table-responsive" id="tete">
                    </div>
                    <div class="table-responsive">
                        <table class="table tableContact" id="id_tableContact" >
                            
                                <thead id="id_headeToFixed">
                                       <?php //$this->element('Contacts/head_table') ?>
                                    <?php
                                    $valueDirection = 'desc';
                                    if(strtolower($customDirection ) == 'desc'){
                                        $valueDirection = 'asc';
                                    }
                                    ?>
                                    <tr id="entete_table">
                                        <th scope="col"> <input type="checkbox" id="id_chekAll" /></th>
                                        <th scope="col"><?= $this->Paginator->sort('photo_id','Photo') ?></th>
                                        <th width="10px" scope="col"><?= $this->Paginator->sort('email','E-mail') ?></th>
                                        <th></th>
                                        <th scope="col"><?= $this->Paginator->sort('telephone','Tel') ?></th>
                                        <th scope="col"><a href="<?= $this->Paginator->generateUrl(['customSort' => 'dateHeurePrisePhoto','customDirection'=>$valueDirection]);?>">Date photo</a></th>
                                        
                                        <th scope="col"><a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailEnvoye','customDirection'=>$valueDirection]); ?>">E-mail envoyé</a> <?php //$this->Paginator->sort('ContactEmailsEnvois.id','E-mail envoyé') ?>  </th>
                                        <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailDelivre','customDirection'=>$valueDirection]); ?>">E-mail délivré</a></th>
                                        <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailOuvert','customDirection'=>$valueDirection]); ?>">E-mail ouvert</a></th>
                                        <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailClique','customDirection'=>$valueDirection]); ?>">E-mail cliqué</a></th>
                                        <th scope="col"><a href="<?=  $this->Paginator->generateUrl(['customSort' => 'smsEnvoye','customDirection'=>$valueDirection]); ?>">Sms envoyé</a></th>
                                        <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'smsDelivre','customDirection'=>$valueDirection]); ?>">Sms delivré</a></th>
                                        <!--<th scope="col"><?= $this->Paginator->sort('Photos.PhotoDownloads','Photo téléchargée') ?> <a href="#">Photo téléchargée</a></th>-->
                                        <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'download','customDirection'=>$valueDirection]); ?>">Photo téléchargée</a></th>
                                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>

                                <tbody id="id_bodyConctTable">
                                    <?php 
                                    foreach ($contacts as $contact){ 
                                            $email_propose = "";
                                            if(array_key_exists($contact->id, $listContactEmailNotSent) ){
                                                $email_propose = $listContactEmailNotSent[$contact->id];
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="contact[]" value="<?= $contact->id ?>" class="kl_OneContact" />
                                        </td>
                                        <td class="kl_thePhoto">
                                            <a class="kl_linkPhoto btn default btn-outline image-popup-vertical-fit" href="<?= $contact->photo->url_photo ?>">
                                            <?php
                                              echo $this->Html->image($contact->photo->url_thumb_bo,['width'=>75]);
                                            ?>
                                            </a>
                                        </td>
                                        <td  class="kl_theEmail">
                                            <?= $this->Html->link(($contact->email),['controller'=>'Statistiques','action'=>'detailStatEmail', $evenement->id, $contact->id],['class'=>'kl_linkVersStatEmail']) ?>
                                            <?php if(!empty($email_propose)) { ?>
                                            <input type="hidden" id="evenement_id_<?= $contact->id ?>" value="<?= $evenement->id ?>">
                                                <br><small class="text-muted">(Ce email peut être non valide, veuillez voir l'email proposé ci-dessous.) </small>
                                                <div class="btn-group ">
                                                      <button type="button" class="btn btn-selfizee-inverse dropdown-toggle btn-email-propose" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         <?= $email_propose ?>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                        <?= $this->Html->link('<i class="mdi mdi-send"></i> Remplacer par ce email et reenvoyer','#',['escape'=>false,"class"=>"dropdown-item kl_sendAvecEmailPropose", "id"=>"id_sendAvecEmailPropose_".$contact->id ]) ?>
                                                      </div>
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Html->image("check_email_2.png", ["width" => "20", "height" => "20", "data-toggle"=>"tooltip", "title" => "Suivi email", 'data-placement'=>"right", 'url' => ['controller' => 'Statistiques', 'action'=>'detailStatEmail', $evenement->id, $contact->id]]); ?>
                                        </td>
                                        <td class="kl_theTel"><?= h($contact->telephone) ?></td>
                                        <td class="kl_theDateprisePhoto"><?php if(!empty($contact->photo->date_prise_photo)) echo $contact->photo->date_prise_photo->format('d-m-y').$contact->photo->heure_prise_photo->format(' à H\hi'); ?></td>
                                        <td>
                                            <?php
                                                if(count($contact->contact_email_envois)){
                                                    $datePhraseEmail = $contact->contact_email_envois[0]->created->format('d-m-y à H\hi');
                                                    echo 'Oui<span class="kl_laDate">('.$datePhraseEmail.')</span>';
                                                }else{
                                                    echo 'Non';
                                                }
                                            ?>
                                        </td>
                                        <td class="kl_theDeliverCol">
                                            <?php 
                                                $resDelivre = '-';
                                                if(count($contact->contact_email_envois)){
                                                    
                                                    $resDelivre = 'Non';
                                                    if(count($contact->envois)){                                                    
                                                        $index_last_envois = count($contact->contact_email_envois) - 1; // index derniere envoie
                                                        if(!empty($contact->envois[$index_last_envois]->envoi_email_stat_delivres)){
                                                            $datePhraseEmailDelivre = $contact->envois[$index_last_envois]->envoi_email_stat_delivres[0]->date_event->format('d-m-y à H\hi');
                                                            $resDelivre = 'Oui<span class="kl_laDate">('.$datePhraseEmailDelivre.')</span>';
                                                        }else{
                                                            if(!empty($contact->envois[$index_last_envois]->envoi_email_stat_bounces)){
                                                                $resDelivre = 'Non <span class="kl_raisonErreur">(Bounce)</span>';
                                                            }else if(!empty($contact->envois[$index_last_envois]->envoi_email_stat_blockeds)){
                                                                $resDelivre = 'Non <span class="kl_raisonErreur">(Bloqué)</span>';
                                                            }
                                                        }
                                                    }
                                                }
                                                echo $resDelivre;
                                            ?>
                                        </td>
                                        <td class="kl_theEnvoiCol">
                                            <?php 
                                                $resOuverture = '-';
                                                if(count($contact->contact_email_envois)){
                                                    $resOuverture = 'Non';
                                                    if(count($contact->envois)){
                                                        if(!empty($contact->envois[0]->envoi_email_stat_ouvertures)){
                                                            $datePhraseEmail = $contact->envois[0]->envoi_email_stat_ouvertures[0]->date_event->format('d-m-y à H\hi');
                                                            $resOuverture = 'Oui<span class="kl_laDate">('.$datePhraseEmail.')</span>';
                                                        }
                                                    }
                                                }
                                                echo $resOuverture;
                                            ?>
                                        </td>
                                        
                                        <td class="kl_theClickCol"> 
                                            <?php 
                                                $resClick = '-';
                                                if(count($contact->contact_email_envois)){
                                                    $resClick = 'Non';
                                                    if(count($contact->envois)){
                                                        if(!empty($contact->envois[0]->envoi_email_stat_clicks)){
                                                            $datePhraseEmail = $contact->envois[0]->envoi_email_stat_clicks[0]->date_event->format('d-m-y à H\hi');
                                                            $resClick = 'Oui<span class="kl_laDate">('.$datePhraseEmail.')</span>';
                                                        }
                                                    }
                                                }
                                                echo $resClick;
                                            ?>
                                        </td>
                                        
                                        
                                        
                                        <td class="kl_theSmsEnvoiCol">
                                             <?php
                                                if(count($contact->contact_sms_envois)){
                                                    $datePhraseSms = $contact->contact_sms_envois[0]->created->format('d-m-y à H\hi');
                                                   
                                                    echo 'Oui<span class="kl_laDate">('.$datePhraseSms.')</span>';
                                                }else{
                                                    echo 'Non';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                             <?php
                                                //sms_statistiques_delivres
                                                //Non
                                                /*$resSmsDelivre = 'Non';
                                                if(count($contact->envois)){
                                                    if(!empty($contact->envois[0]->sms_statistiques_delivres)){
                                                        $resSmsDelivre = 'Oui';
                                                    }
                                                }
                                                echo $resSmsDelivre;*/
                                                $resSmsDelivre = '-';
                                                if(count($contact->contact_sms_envois)){
                                                    $resSmsDelivre = 'Non';
                                                    if(!empty($idContactSmsDelivre)){
                                                        if(in_array($contact->id, $idContactSmsDelivre)){
                                                            $resSmsDelivre = 'Oui';
                                                        }
                                                    }
                                                }
                                                echo $resSmsDelivre ;
                                            ?>
                                        </td>
                                        <td class="kl_theDownloadCol">
                                            <?php 
                                                if(count($contact->photo->photo_downloads)){
                                                    echo 'Oui<span class="kl_laDate">('.count($contact->photo->photo_downloads).' fois)</span>';
                                                }else{
                                                    echo 'Non';
                                                }
                                            ?>
                                        </td>
                                       
                                        <td class="actions">
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete',$evenement->id, $contact->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-right">
                                                <ul class="pagination">
                                                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                                                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                                    <?= $this->Paginator->numbers() ?>
                                                    <?= $this->Paginator->next(__('next') . ' >') ?>
                                                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
                <?php }else{ ?>
                    <div class="">Aucun contact lié à votre recherche</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                <div class="pull-right">
                  <?php 
                    echo $this->Html->link('Voir le fichier csv',['controller' => 'Contacts', 'action' => 'voirCsv', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action ' ]); 

                    echo $this->Html->link('Importer fichier csv',['controller' => 'Contacts', 'action' => 'importer', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action m-r-15' ]);
                  ?> 
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="">Aucun contact pour cet événement</div>
            </div>
        </div>
    </div>
</div>
<?php } ?>