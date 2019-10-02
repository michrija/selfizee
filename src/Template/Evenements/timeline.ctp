<?= $this->Html->css('evenements/timeline.css?'.time(), ['block' => true]) ?>
<?= $this->Html->script('Evenements/timeline.js?'.time(), ['block' => true]); ?>


<div class="row">

    <?php if (is_null($idEvenement) || $idEvenement == 0): ?>
        <div class="col-md-3">

            <h2 class="kl_theSousTitreTimeLine">Type d'activité</h2>
            <div class="kl_filtreParActiviteBoc">
                    <?php
                    
                        $filtres = [
                                "mdi-reorder-horizontal"=> 'Toutes les activités',
                                "mdi-image-multiple" =>  'Upload photos',
                                "mdi-contacts" => 'Import contact',
                                "mdi-telegram" => 'Envoi mail',
                                "mdi-cellphone-iphone" => 'Envoi sms',
                                "mdi-delete-empty" => 'Photo supprimée',
                                "mdi-login" => 'Connexion à la galerie souvenir',
                                "mdi-cloud-download" => 'Téléchargement manuel de photo depuis la galerie' ,
                                "mdi-network-download" => 'Téléchargement de tous les photos depuis la galerie',
                                "mdi-facebook-box" => 'Upload auto vers facebook',
                                "mdi-library-plus" => 'Création de l\'événement',
                                "mdi-file-video" =>  'Upload videos',
                                "mdi-key" => 'Suppression depuis RGPD'
                            ];
                    ?>
                    <ul class="kl_listeFiltre">
                         <?php 
                            $i = 0;
                            foreach($filtres as $key => $filre){
                                $nb = ($i > 0 && isset($nb_menu_left[$i])) ? '('.$nb_menu_left[$i].')' : '';
                         ?>
                        <li>
                            <?= $this->Html->link('<i class="mdi '.$key.'"></i> '.$filre .' '. $nb, ['action' => 'timeline', ($idEvenement ? $idEvenement : 0), $i ], ["escape"=>false,'class'=>'kl_oneLinkTypeActivite'.($type == $i ? ' active' : '')]); ?>
                        </li>
                        <?php $i++ ; } ?>
                    </ul>
            </div>
        </div>
    <?php endif ?>

    <div class="<?= is_null($idEvenement) || $idEvenement == 0 ? "col-md-9 mt-5" : "col-md-12" ?>">
        <?php if (isset($evenement->fonctionnalites)): ?>
            <?php $nameFonctionnalites = collection($evenement->fonctionnalites)->extract('nom')->toArray() ?>
        <?php endif ?>
        <div class="">

            <div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black">Timeline</h4>
                </div>
                
                <div class="card-body">
                    <div class="row-fluid">
                        <h2 class="kl_theSousTitreTimeLine">Activité(s)</h2>
                    </div>
                    <div class="row-fluid" style="margin-bottom: 20px;" id="klVueTimeline">
                        <div class="btn-group" data-toggle="buttons" role="group">
                            <label class="btn btn-outline btn-warnin active kl_vue_evenement">
                                <input type="radio" name="options" autocomplete="off" value="0" checked="">
                                <i class="text-active" aria-hidden="true"></i> Vue synthétique
                            </label>
                            <label class="btn btn-outline btn-warnin kl_vue_evenement">
                                <input type="radio" name="options" autocomplete="off" value="1">
                                <i class="text-active" aria-hidden="true"></i> Vue détaillée
                            </label>
                        </div>
                    </div>
                   
                   
                    <?php if (!is_null($idEvenement) && $idEvenement != 0): ?>

                    <?php echo $this->Form->control('filtre',['label'=>'Filtrer par type d’activité','type'=>'checkbox','class'=>'filter']); ?>
                        <div class="filtre d-none">
                        <h2 class="kl_theSousTitreTimeLine ">Type d'activité</h2>
                            <div class="kl_filtreParActiviteBoc mb-4">
                                <?php

                                    $filtres = [
                                            "mdi-reorder-horizontal"=> 'Toutes les activités',
                                            "mdi-image-multiple" =>  'Upload photos',
                                            "mdi-contacts" => 'Import contact',
                                            "mdi-telegram" => 'Envoi mail',
                                            "mdi-cellphone-iphone" => 'Envoi sms',
                                            "mdi-delete-empty" => 'Photo supprimée',
                                            "mdi-login" => 'Connexion à la galerie souvenir',
                                            "mdi-cloud-download" => 'Téléchargement manuel de photo depuis la galerie' ,
                                            "mdi-network-download" => 'Téléchargement de tous les photos depuis la galerie',
                                            "mdi-facebook-box" => 'Upload auto vers facebook',
                                            "mdi-library-plus" => 'Création de l\'événement',
                                            "mdi-file-video" =>  'Upload videos',
                                            "mdi-key" => 'Suppression depuis RGPD'
                                        ];
                                ?>
                             <?php $queryType = $this->request->getQuery('type'); ?>

                                <?= $this->Form->create(false, ['class' => 'filter-form', 'type' => 'GET']); ?>

                                    <div class="row">
                                             
                                        <?php 
                                            $i = 0;
                                            foreach($filtres as $key => $filre){
                                                $nb = ($i > 0 && isset($nb_menu_left[$i])) ? '('.$nb_menu_left[$i].')' : '';
                                        ?> 

                                        <?php $idEvenements = []; ?>
                                        <?php if (isset($evenement->fonctionnalites)): ?>
                                            <?php $idEvenements = collection($evenement->fonctionnalites)->extract('id')->toArray() ?>
                                        <?php endif ?>       

                                        <?php if ($i == 3 && !in_array(1, $idEvenements)): /*si n'a pas f° envoi email*/ ?>
                                        <?php elseif ($i == 4 && !in_array(2, $idEvenements)): /*si n'a pas f° envoi sms*/ ?>
                                        <?php elseif ($i == 2 && !in_array(1, $idEvenements) && !in_array(2, $idEvenements)): /*désactiver import conctact si email & sms non activé*/ ?>
                                            
                                        <?php else: ?>
                                            <div class="col-md-3 col-filtre">
                                                <div class="form-group m-0">
                                                <label class="custom-control custom-checkbox" for="chekedValue<?= $key ?>">
                                                    <?= $this->Form->checkbox('type.'.$i, ['checked' => isset($queryType[$i]) ? 'checked' : '', 'label' => false, 'hiddenField' => false,'id'=>'chekedValue'.$key]); ?>
                                                    <span class="custom-control-label <?= $type == $i ? ' active' : '' ?>">
                                                     <i class="mdi <?= $key ?>"></i> <?=$filre ?> <?=$nb ?> 
                                                    </span>
                                                </label>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <?php $i++ ; } ?>

                                    </div>

                                <?= $this->form->end() ?>
                            </div>
                        </div>  
                    <?php endif ?>
                  
                </div>
        </div>

            
  



            <div class="qa-message-list" id="wallmessages">
                <?php 
                //debug($timelines);
            if(!empty($timelines->toArray())){
                $init = 
                $buffer = 
                $buffer_synth = 
                $data_synth = '';
                $nbr_1 = 
                $nbr_2 = 
                $nbr_3 = 
                $nbr_4 = 
                $nbr_5 = 
                $nbr_6 = 
                $nbr_7 = 
                $nbr_8 = 
                $nbr_9 = 
                $nbr_11 = 
                $nbr_12 = 0;
                foreach($timelines as $timeline){
                    
                    if(is_null($timeline->date_timeline))
                        continue;
                    
                    if($init != $timeline->date_timeline->format('d/m/Y')){
                        $now = new DateTime();
                        $date_auj = $now -> format('d/m/Y');
                        $hier = new DateTime('-1 day');
                        $date_hier = $hier -> format('d/m/Y');
                        
                        setlocale(LC_TIME, 'fr_FR.utf8','fra'); 
                        $date = strftime("%d %B %Y", strtotime($timeline->date_timeline->format('Y-m-d H:i:s')));
                        
                        $texte = ($timeline->date_timeline->format('d/m/Y') == $date_auj ? 'Aujourd\'hui' : ($timeline->date_timeline->format('d/m/Y') == $date_hier ? 'Hier' : $date));
                        $ss_texte = ($timeline->date_timeline->format('d/m/Y') == $date_auj ? 'Aujourd\'hui' : ($timeline->date_timeline->format('d/m/Y') == $date_hier ? 'Hier' : $timeline->date_timeline->format('d/m/Y')));
                        
                        if($init != ''){
                            // Photos uploads
                            if($nbr_1 > 0){
                                $pl = $nbr_1 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-image-multiple"></i> '.$nbr_1 . ' photo'.$pl.' uploadée'.$pl.'</span>';
                            }
                            // Videos uploads
                            if($nbr_11 > 0){
                                $pl = $nbr_11 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-file-video"></i> '.$nbr_11 . ' video'.$pl.' uploadée'.$pl.'</span>';
                            }
                            // contact
                            if($nbr_2 > 0){
                                $pl = $nbr_2 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-contacts"></i> '. $nbr_2 . ' contact'.$pl.' uploadé'.$pl.'</span>';
                            }
                            // envoi email
                            if($nbr_3 > 0){
                                $pl = $nbr_3 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-telegram"></i> '. $nbr_3 . ' email'.$pl.' envoyé'.$pl.'</span>';
                            }
                            // envoi sms
                            if($nbr_4 > 0){
                                $pl = $nbr_4 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-cellphone-iphone"></i> '. $nbr_4 . ' sms envoyé'.$pl.'</span>';
                            }
                            // Photo supprimée
                            if($nbr_5 > 0){
                                $pl = $nbr_5 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-delete-empty"></i> '. $nbr_5. ' photo'.$pl.' supprimée'.$pl.'</span>';
                            }
                            // Connexion galérie souvenir
                            if($nbr_6 > 0){
                                $pl = $nbr_6 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-login"></i> '. $nbr_6 . ' connexion'.$pl.' de la galerie souvenir</span>';
                            }
                            // Téléchargement photo
                            if($nbr_7 > 0){
                                $pl = $nbr_1 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_7. ' téléchargement'.$pl.' photo</span>';
                            }
                            if($nbr_8 > 0){
                                $pl = $nbr_8 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_8.' téléchargement'.$pl.' de tous les média</span>';
                            }
                            // Facebook
                            if($nbr_9 > 0){
                                $pl = $nbr_9 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-facebook-box"></i> '. $nbr_9 . ' photo'.$pl.' uploadée'.$pl.'</span>';
                            }
                            
                            // Rgpd
                            if($nbr_12 > 0){
                                $pl = $nbr_12 > 1 ? 's' : '';
                                $data_synth .= '<span><i class="mdi mdi-key"></i> RGPD : '. $nbr_12 . ' fichier'.$pl.' et donnée'.$pl.' supprimé'.$pl.'</span>';
                            }   
                        }
                        
                        $buffer_synth .= $init == '' ? '' : $data_synth.'</div>';
                        
                        $bloc_date = ''.
                        '<div class="message-item message-item-0">'.
                            '<div class="message-inner-0">'.
                                '<div class="qa-message-content">'.
                                    $texte.
                                '</div>'.
                            '</div>'.
                        '</div>';
                        
                        $bloc_date_synth = ''.
                        '<div class="message-item-1 message-item-0">'.
                            '<div class="message-inner-0">'.
                                '<div class="qa-message-content">'.
                                    $texte.
                                '</div>'.
                            '</div>'.
                        '</div>';
                        
                        $buffer_synth .= $bloc_date_synth;
                        $buffer .= $bloc_date;
                        
                        
                        $init = $timeline->date_timeline->format('d/m/Y');
                        $data_synth = '';
                        $nbr_1 = $nbr_2 = $nbr_3 = $nbr_4 = $nbr_5 = $nbr_6 = $nbr_7 = $nbr_8 = $nbr_9 = $nbr_11 = $nbr_12 = 0;
                        
                        $buffer_synth .= '<div class="kl_filtreParActiviteBoc kl_filtre_vue" id="'.(Cake\Utility\Inflector::slug($init, '-')).'">';
                    }
                    // if(!empty($timeline->date_timeline)){
                        $nom = 
                        $depuis = "";
                        if($timeline->source_timeline == 'bo' ){
                            $depuis = "depuis l'espace administration";
                            $nom = '<small class="text-muted"><strong><i class="fa fa-user"></i> Par Selfizee</strong></small>';
                        }else if($timeline->source_timeline == 'auto' || $timeline->source_timeline == 'upload') {
                            $depuis = " depuis la borne";
                        }else if($timeline->source_timeline == 2){
                            $depuis = "depuis la galerie souvenir";
                        }else if($timeline->source_timeline == 1){
                            $depuis = 'depuis la page souvenir';
                        }else if($timeline->source_timeline == "galerie"){
                            $depuis = "depuis la galerie";
                        }else if($timeline->source_timeline == 'rgpd'){
                            $depuis = 'depuis la page RGPD';
                            $nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
                        }
                        
                        //debug($timeline->date_timeline);
                        $source = "";
                        //debug($timeline->type_timeline);
                        switch ($timeline->type_timeline) {
                            case 1: // upload photo
                                $source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
                                $nbr_1+= $timeline->nbr;
                                break;
                            case 2: //contact
                                $source = $timeline->nbr > 1 ? "contacts uploadés" : "contact uploadé";
                                $nbr_2 += $timeline->nbr;
                                break;
                            case 3: // envoi email
                                $source = $timeline->nbr > 1 ? "emails envoyés" : "email envoyé";
                                $nbr_3 += $timeline->nbr;
                                break;
                            case 4 : // sms envoyé
                                $source = $timeline->nbr > 1 ? "sms envoyés" : "sms envoyé";
                                $nbr_4 += $timeline->nbr;
                                break;
                            case 5 :
                                $source = $timeline->nbr > 1 ? "photos supprimées" : "photo supprimée";
                                $nbr_5 += $timeline->nbr;
                                break;
                            case 6 :
                                $source = 'connexion de la galerie souvenir';
                                $nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
                                $nbr_6 += $timeline->nbr;
                                
                                break;
                            case 7:
                                $source = $timeline->nbr > 1 ? "téléchargements photo" : "téléchargement photo";
                                $nbr_7 += $timeline->nbr;
                                $nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
                                break;
                            case 8:
                                $source = $timeline->nbr > 1 ? "téléchargements de tous les média" : "téléchargement de tous les média";
                                $nbr_8 += $timeline->nbr;
                                $depuis = "depuis la galerie souvenir";
                                $nom = '<small class="text-muted"><strong><i class="fa fa-user-circle-o"></i> Par un visiteur</strong></small>';
                                break;
                            case 9:
                                $source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
                                $nbr_9 += $timeline->nbr;
                                $depuis = "automatiquement sur facebook";
                                break;
                            case 11: // upload video
                                $source = $timeline->nbr > 1 ? "video uploadées" : "video uploadée";
                                $nbr_11+= $timeline->nbr;
                                break;
                            case 12: // upload video
                                $source = $timeline->nbr > 1 ? "donnée et fichier supprimés" : "donnée et fichier supprimé";
                                $nbr_12+= $timeline->nbr;
                                $depuis = "depuis la page RGPD";
                                break;
                        }
                        
                        if(!empty($timeline->user)){
                            // Client
                            if(!empty($timeline->user->client))
                                $nom = '<small class="text-muted"><strong><i class="fa fa-user-circle"></i> Par '. $timeline->user->client->nom . '</strong></small>';
                            // Admin
                            else
                                $nom = '<small class="text-muted"><strong><i class="fa fa-user"></i> Par Selfizee</strong></small>';
                        }
                        
                        $buffer .= ''.
                        '<div class="text-right">'.$ss_texte.''.$timeline->date_timeline->format(' - H:i').'</div>'.
                        '<div class="message-item" id="type_'.$timeline->type_timeline.'">'.
                            '<div class="message-inner">'.
                                '<div class="qa-message-content">'.
                                    ''.(!empty($timeline->evenement) ? $timeline->evenement->slug.' : ' : "").' '.$timeline->nbr." ". $source.' '.$depuis.($nom ? ' - '. $nom : '').
                                '</div>'.
                            '</div>'.
                        '</div>'; 
                        if(false){
        ?>
                <div class="message-item" id="type_<?= $timeline->type_timeline ?>">
                    <div class="message-inner">
                            
                            <div class="qa-message-content">
                              <?= empty($idEvenement) ? $timeline->evenement->slug.' : ' : "" ?> <?= $timeline->date_timeline->format('d/m/Y - H:i') ?> - <?= $timeline->nbr." ". $source ?>  <?= $depuis ?>
                            </div>
                    </div>
                </div>
        <?php       
        
                        }
                    // }
                }
                
                if($nbr_1 || $nbr_2 || $nbr_3 || $nbr_4 || $nbr_5 || $nbr_6 || $nbr_7 || $nbr_8 || $nbr_9 || $nbr_11 || $nbr_12){
                    // Photos uploads
                    if($nbr_1 > 0){
                        $pl = $nbr_1 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-image-multiple"></i> '.$nbr_1 . ' photo'.$pl.' uploadée'.$pl.'</span>';
                    }
                    // Videos uploads
                    if($nbr_11 > 0){
                        $pl = $nbr_11 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-file-video"></i> '.$nbr_11 . ' video'.$pl.' uploadée'.$pl.'</span>';
                    }
                    // contact
                    if($nbr_2 > 0){
                        $pl = $nbr_2 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-contacts"></i> '. $nbr_2 . ' contact'.$pl.' uploadé'.$pl.'</span>';
                    }
                    // envoi email
                    if($nbr_3 > 0){
                        $pl = $nbr_3 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-telegram"></i> '. $nbr_3 . ' email'.$pl.' envoyé'.$pl.'</span>';
                    }
                    // envoi sms
                    if($nbr_4 > 0){
                        $pl = $nbr_4 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-cellphone-iphone"></i> '. $nbr_4 . ' sms envoyé'.$pl.'</span>';
                    }
                    // Photo supprimée
                    if($nbr_5 > 0){
                        $pl = $nbr_5 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-delete-empty"></i> '. $nbr_5. ' photo'.$pl.' supprimée'.$pl.'</span>';
                    }
                    // Connexion galérie souvenir
                    if($nbr_6 > 0){
                        $pl = $nbr_6 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-login"></i> '. $nbr_6 . ' connexion'.$pl.' de la galerie souvenir</span>';
                    }
                    // Téléchargement photo
                    if($nbr_7 > 0){
                        $pl = $nbr_7 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_7. ' téléchargement'.$pl.' photo</span>';
                    }
                    if($nbr_8 > 0){
                        $pl = $nbr_8 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-network-download"></i> '. $nbr_8.' téléchargement'.$pl.' de tous les média</span>';
                    }
                    // Facebook
                    if($nbr_9 > 0){
                        $pl = $nbr_9 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-facebook-box"></i> '. $nbr_9 . ' photo'.$pl.' uploadée'.$pl.'</span>';
                    }

                    //Deleted in RGPD
                    if($nbr_12 > 0){
                        $pl = $nbr_12 > 1 ? 's' : '';
                        $data_synth .= '<span><i class="mdi mdi-key"></i> '. $nbr_12 . ' donnée'.$pl.' RGPD supprimée'.$pl.' </span>';
                    }

                    $buffer_synth .= $data_synth.'</div>';
                }
                
                // Ajout bloc
                if($buffer_synth != '')
                    $buffer_synth .= '</div>';
                
                
                echo ''.
                '<div class="sf-bloc-detaille hide">'.$buffer.'</div>'.
                '<div class="sf-bloc-synth">'.$buffer_synth.'</div>';
                
            }else{ ?>
            <div class="kl_aucuneActivite">Aucune activité.</div>
       <?php } ?>
        <?php
            if( ((/*empty($type) || */empty($queryType) || @$queryType[0] == 1) || $type == 10 ) && !empty($idEvenement)){
        ?>
        <div class="message-item" id="type_10">
            <div class="message-inner">
                <div class="qa-message-content">
                  <?= $evenement->created->format('d/m/Y - H:i') ?> - Création de l'événement.
                </div>
            </div>
        </div>
        <?php } ?>
                <?php 
                if($idEvenement){
                    echo '<input type="hidden" id="idEvenement" value="'.$idEvenement.'">';
                }
                $nbr_1 = !empty($nbr_1) ? $nbr_1 : 0;
                $nbr_2 = !empty($nbr_2) ? $nbr_2 : 0;
                $nbr_3 = !empty($nbr_3) ? $nbr_3 : 0;
                $nbr_4 = !empty($nbr_4) ? $nbr_4 : 0;
                $nbr_5 = !empty($nbr_5) ? $nbr_5 : 0;
                $nbr_6 = !empty($nbr_6) ? $nbr_6 : 0;
                $nbr_7 = !empty($nbr_7) ? $nbr_7 : 0;
                $nbr_8 = !empty($nbr_8) ? $nbr_8 : 0;
                $nbr_9 = !empty($nbr_9) ? $nbr_9 : 0;
                $nbr_11 = !empty($nbr_11) ? $nbr_11 : 0;
                $nbr = [
                    'nbr_1' => $nbr_1,
                    'nbr_2' => $nbr_2,
                    'nbr_3' => $nbr_3,
                    'nbr_4' => $nbr_4,
                    'nbr_5' => $nbr_5,
                    'nbr_6' => $nbr_6,
                    'nbr_7' => $nbr_7,
                    'nbr_8' => $nbr_8,
                    'nbr_9' => $nbr_9,
                    'nbr_11' => $nbr_11
                ];
                ?>
                <input type="hidden" id="nbr" value="<?php echo base64_encode(base64_encode(base64_encode(serialize($nbr)))); ?>">
                <input type="hidden" id="isFin" value="1">
                <input type="hidden" id="sf-type" value="<?php echo isset($type) && $type ? $type : ''; ?>">
                <input type="hidden" id="page_next" value="2">
                <input type="hidden" id="actionDateLast" value="<?php echo isset($init) && $init ? $init : ''; ?>">
                <button class="btn btn-primary hide" id="bouton">Next</button>
                <div class="text-center hide" id="sf-loading"><img src="/img/loading_anim.gif"></div>
            </div>
        </div>
    </div>
</div>