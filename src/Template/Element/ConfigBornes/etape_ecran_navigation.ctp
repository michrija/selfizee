<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>
<?php 
    $configBorne = $configurationBorne;
    $option_fond_page = [1 => 'Image de fond', 0 => 'Couleur de fond'];
    $choix_accuiel_fond_page = $choix_accueil_btn = $choix_prise_fond_page =  $choix_filtre_fond_page = $choix_remerc_fond_page = 1;
    $choix_choix_fv_fond_page =  $choix_vis_photo_fond_page = 1;
    $hide_suppr_accueil = $hide_suppr_btn_accueil = $hide_suppr_prise_photo =  $hide_suppr_filtre = $hide_suppr_remerc = $hide_suppr_choix_fv =  $hide_suppr_vis_photo = "hide";

    $url_page_accueil_image_fond = null;
    $url_page_accueil_image_btn = null;
    $url_page_prise_photos_image_fond = null;
    $url_page_filtre_image_fond = null;
    $url_page_remerc_image_fond = null;
    $url_page_choix_fv_image_fond = null;
    $url_page_vis_photo_image_fond = null;

    if(!$is_new) {
        if(!empty($configBorne->ecrans_navigation)) {
            $choix_accuiel_fond_page = $configBorne->ecrans_navigation->is_active_page_accueil_image_fond;
            $choix_accueil_btn = $configBorne->ecrans_navigation->is_active_page_accueil_image_btn_fond;
            $choix_prise_fond_page = $configBorne->ecrans_navigation->is_active_page_prise_photo_image_fond;
            $choix_filtre_fond_page = $configBorne->ecrans_navigation->is_active_page_filtre_image_fond;
            $choix_remerc_fond_page = $configBorne->ecrans_navigation->is_active_page_remerc_image_fond;
            $choix_choix_fv_fond_page = $configBorne->ecrans_navigation->is_active_page_choix_fv_image_fond;
            $choix_vis_photo_fond_page = $configBorne->ecrans_navigation->is_active_page_vis_photo_image_fond;								
        }

        if($configBorne->ecrans_navigation->is_active_catalogue_mep) {

            if(!empty($configBorne->ecrans_navigation->catalogue->ecran_accueil)){
                $fileName = $configBorne->ecrans_navigation->catalogue->ecran_accueil->file_name;
                if(file_exists(PATH_CONFIG_BORNE .'/ecran_catalogue/'. $evenement->client_id .'/'. $fileName )) $url_page_accueil_image_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$evenement->client_id.'/'.$fileName;
            }

            if(!empty($configBorne->ecrans_navigation->catalogue->ecran_prise_photo)){
                $fileName = $configBorne->ecrans_navigation->catalogue->ecran_prise_photo->file_name;
                if(file_exists(PATH_CONFIG_BORNE .'/ecran_catalogue/'. $evenement->client_id .'/'. $fileName)) $url_page_prise_photos_image_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$evenement->client_id.'/'.$fileName;
            }

            if(!empty($configBorne->ecrans_navigation->catalogue->ecran_filtre)){
                $fileName = $configBorne->ecrans_navigation->catalogue->ecran_filtre->file_name;
                if(file_exists(PATH_CONFIG_BORNE .'/ecran_catalogue/'. $evenement->client_id .'/'. $fileName )) $url_page_filtre_image_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$evenement->client_id.'/'.$fileName;
            }

            if(!empty($configBorne->ecrans_navigation->catalogue->ecran_visualisation_photo)){
                $fileName = $configBorne->ecrans_navigation->catalogue->ecran_visualisation_photo->file_name;
                if(file_exists(PATH_CONFIG_BORNE .'/ecran_catalogue/'. $evenement->client_id .'/'. $fileName )) $url_page_vis_photo_image_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$evenement->client_id.'/'.$fileName;
            }

            if(!empty($configBorne->ecrans_navigation->catalogue->ecran_choix_fond_vert)){
                $fileName = $configBorne->ecrans_navigation->catalogue->ecran_choix_fond_vert->file_name;
                if(file_exists(PATH_CONFIG_BORNE .'/ecran_catalogue/'. $evenement->client_id .'/'. $fileName )) $url_page_choix_fv_image_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$evenement->client_id.'/'.$fileName;
            }

            if(!empty($configBorne->ecrans_navigation->catalogue->ecran_remerciement)){
                $fileName = $configBorne->ecrans_navigation->catalogue->ecran_remerciement->file_name;
                if(file_exists(PATH_CONFIG_BORNE .'/ecran_catalogue/'. $evenement->client_id .'/'. $fileName )) $url_page_remerc_image_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$evenement->client_id.'/'.$fileName;
            }
        } else { 				
            if($configBorne->ecrans_navigation->is_active_page_accueil_image_fond){
                    $fileName = $configBorne->ecrans_navigation->page_accueil_image_fond;
                    if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )){
                        $url_page_accueil_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                        $hide_suppr_accueil = "";
                    }
            }     
            
            /*if($configBorne->ecrans_navigation->is_active_page_accueil_image_btn_fond){  
                    $fileName = $configBorne->ecrans_navigation->page_accueil_image_btn;
                    if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) {
                        $url_page_accueil_image_btn = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                        $hide_suppr_btn_accueil = "";
                    }
            }*/

            if($configBorne->ecrans_navigation->is_active_page_prise_photo_image_fond){
                    $fileName = $configBorne->ecrans_navigation->page_prise_photos_image_fond;
                    //debug($fileName);
                    if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) {
                        $url_page_prise_photos_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                        $hide_suppr_prise_photo = "";
                    }
            }
            
            if($configBorne->ecrans_navigation->is_active_page_filtre_image_fond){
                $fileName = $configBorne->ecrans_navigation->page_filtre_image_fond;
                //debug($fileName);
                if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) {
                    $url_page_filtre_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                    $hide_suppr_filtre = "";
                }
            }

            if($configBorne->ecrans_navigation->is_active_page_remerc_image_fond){
                $fileName = $configBorne->ecrans_navigation->page_remerc_image_fond;
                //debug($fileName);
                if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )){
                    $url_page_remerc_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                    $hide_suppr_remerc = "";
                }
            }

            if($configBorne->ecrans_navigation->is_active_page_choix_fv_image_fond){
                $fileName = $configBorne->ecrans_navigation->page_choix_fv_image_fond;
                //debug($fileName);
                if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) {
                    $url_page_choix_fv_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                    $hide_suppr_choix_fv = "";
                }
            }

            if($configBorne->ecrans_navigation->is_active_page_vis_photo_image_fond){
                $fileName = $configBorne->ecrans_navigation->page_vis_photo_image_fond;
                //debug($fileName);
                if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) {
                    $url_page_vis_photo_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                    $hide_suppr_vis_photo = "";
                }
            }
        }
        
        // BTN accueil
        if($configBorne->ecrans_navigation->is_active_page_accueil_image_btn_fond){  
            $fileName = $configBorne->ecrans_navigation->page_accueil_image_btn;
            if(!empty($fileName) && file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) {
                $url_page_accueil_image_btn = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                $hide_suppr_btn_accueil = "";
            }
        } 
    } 

    // Réinitialisation couleur;
    $page_prise_photos_couleur_fond = "#FFFFFF"; 
    if(!empty($configurationBorne->ecrans_navigation) && !$configurationBorne->ecrans_navigation->is_active_page_prise_photo_image_fond){ 
        $page_prise_photos_couleur_fond = $configurationBorne->ecrans_navigation->page_prise_photos_couleur_fond; 
    }
    
    $page_accueil_couleur_fond = "#FFFFFF"; 
    $active_img_fond = "hide";
    if(!empty($configurationBorne->ecrans_navigation)) {
        $page_accueil_couleur_fond = !$configurationBorne->ecrans_navigation->is_active_page_accueil_image_fond ? $configurationBorne->ecrans_navigation->page_accueil_couleur_fond : $page_accueil_couleur_fond;
        if($configurationBorne->ecrans_navigation->is_active_page_accueil_image_fond)
            $active_img_fond = "" ;
    }

    $page_filtre_couleur_fond = "#FFFFFF"; 
    if(!empty($configurationBorne->ecrans_navigation) && !$configurationBorne->ecrans_navigation->is_active_page_filtre_image_fond){ 
        $page_filtre_couleur_fond = $configurationBorne->ecrans_navigation->page_filtre_couleur_fond; 
    }

    $page_remerc_couleur_fond = "#FFFFFF"; 
    if(!empty($configurationBorne->ecrans_navigation) && !$configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond){ 
        $page_remerc_couleur_fond = $configurationBorne->ecrans_navigation->page_remerc_couleur_fond; 
    }

    $page_choix_fv_image_fond = "#FFFFFF"; 
    if(!empty($configurationBorne->ecrans_navigation) && !$configurationBorne->ecrans_navigation->is_active_page_choix_fv_image_fond){ 
        $page_choix_fv_image_fond = $configurationBorne->ecrans_navigation->page_choix_fv_image_fond; 
    }

    $page_vis_photo_image_fond = "#FFFFFF"; 
    if(!empty($configurationBorne->ecrans_navigation) && !$configurationBorne->ecrans_navigation->is_active_page_vis_photo_image_fond){ 
        $page_vis_photo_image_fond = $configurationBorne->ecrans_navigation->page_vis_photo_image_fond;
    }

    // bg apercu : edition;
    $style_bg_accueil = '';
    if($page_accueil_couleur_fond != '#FFFFFF') {
        $style_bg_accueil = 'background-color:'.$page_prise_photos_couleur_fond.';';
    }
    if(!empty($url_page_accueil_image_fond)){
        $style_bg_accueil = 'background-image:url('.$url_page_accueil_image_fond.');';
        //debug($style_bg_accueil);
    }
    
    $style_bg_prise_photo = '';
    if($page_prise_photos_couleur_fond != '#FFFFFF') {
        $style_bg_prise_photo = 'background-color:'.$page_prise_photos_couleur_fond.';';
        //($page_prise_photos_couleur_fond != '#FFFFFF' ? 'background-color:'.$page_prise_photos_couleur_fond.';' : '')
    }
    if(!empty($url_page_prise_photos_image_fond)){
        $style_bg_prise_photo = 'background-image:url('.$url_page_prise_photos_image_fond.');';
    }

    $style_bg_filtre = '';
    if($page_filtre_couleur_fond != '#FFFFFF') {
        $style_bg_filtre = 'background-color:'.$page_filtre_couleur_fond.';';
    }
    if(!empty($url_page_filtre_image_fond)){
        $style_bg_filtre = 'background-image:url('.$url_page_filtre_image_fond.');'; 
        //debug($style_bg_accueil);background-size:auto;
    }

    $style_bg_remerc = '';
    if($page_remerc_couleur_fond != '#FFFFFF') {
        $style_bg_remerc = 'background-color:'.$page_remerc_couleur_fond.';';
    }
    if(!empty($url_page_remerc_image_fond)){
        $style_bg_remerc = 'background-image:url('.$url_page_remerc_image_fond.');';
        //debug($style_bg_accueil);
    }

    $style_bg_choix_fv = '';
    if($page_remerc_couleur_fond != '#FFFFFF') {
        $style_bg_choix_fv = 'background-color:'.$page_choix_fv_image_fond.';';
    }
    if(!empty($url_page_choix_fv_image_fond)){
        $style_bg_choix_fv = 'background-image:url('.$url_page_choix_fv_image_fond.');';
        //debug($style_bg_accueil);
    }

    $style_bg_vis_photo = '';
    if($page_remerc_couleur_fond != '#FFFFFF') {
        $style_bg_vis_photo = 'background-color:'.$page_choix_fv_image_fond.';';
    }
    if(!empty($url_page_vis_photo_image_fond)){
        $style_bg_vis_photo = 'background-image:url('.$url_page_vis_photo_image_fond.');';
        //debug($style_bg_accueil);
    }
    
?>
<div class="sf-step sf-step2 sf-parametrage-borne">
    <div class="col-sm-12 m-b-50">
        <p>
            Personnalisez les différents écrans intéractifs qui composent votre animation : écran d'accueil, écran de prise de photo, page d'impression, page de remerciement...<br/>
            Vous pouvez utiliser votre mise en page par défaut ou choisir dans votre catalogue de mise en page, ou encore ajouter votre propre mise en page.
        </p>
    </div>
    
    <div class="col-sm-12">
        <ul class="nav nav-tabs customtab2 tab_mep_cat" role="tablist">
            <li class="nav-item"> <a class="nav-link active show p-l-40 p-r-40" data-toggle="tab" href="#votre-design" role="tab" aria-selected="true"><span class="hidden-xs-down">Votre design</span></a> </li>
            <li class="nav-item"> <a class="nav-link p-l-40 p-r-40" data-toggle="tab" href="#votre-catalogue" role="tab" aria-selected="false"><span class="hidden-xs-down">Votre catalogue</span></a> </li>
        </ul>
        
        <div class="tab-content">
            <?php // onglet "Votre design" ?>
            <div class="tab-pane active show no-padding-left no-padding-right" id="votre-design" role="tabpanel">
                <a href="#" class="pull-right sf-rose" id="sf-reinstall-config">Réinitialiser la mise en page par défaut</a>
                <i class="clearfix"></i>
                <!-- Page accueil -->
                <div class="no-padding p-t-20"  id="bloc_page_acceuil">
                    <h4 class="text-uppercase">Page d'accueil</h4>
                    <div class="m-t-20 sf-bg-gris p-30-20 form-inline sf-align-top">
                        <div class="col-sm-5">
                            <div class="sf-bloc-apercus" style="<?php if(empty($url_page_accueil_image_fond)) echo $style_bg_accueil; ?>">
                                <?php if($choix_accuiel_fond_page) { ?>
                                    <img src="<?= $url_page_accueil_image_fond ?>" width="100%" /> 
                                <?php } ?>
                                <?php $img = "";
                                    if( !$is_new && $configBorne->ecrans_navigation->is_active_page_accueil_image_btn_fond && $configBorne->ecrans_navigation->page_accueil_image_btn){  
                                        $img_btn_file = $configBorne->ecrans_navigation->page_accueil_image_btn;
                                        $img_btn = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$img_btn_file;
                                        $img = '<img class="sf-bouton-center" src="'.$img_btn.'" />';																												
                                } ?>
                                <div class="sf-bloc-button-upload"><?= $img ?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="sf-etat-personnaliser hide">
                                <div class="form-group sf-etat-personnaliser">
                                    <!--label class="m-b-10">Fond de page</label><br>
                                    <<select class="custom-select m-b-15 sf-select-form-input">
                                        <option value="couleur">Couleur de fond</option>
                                        <option value="fichier" selected="selected">Image de fond</option>
                                    </select>-->														
                                    <?php                        
                                            echo $this->Form->control(
                                                'choix_fond_page_accueil', [
                                                'label' => ['text' => 'Fond de page', 'class' => 'm-b-10'], 
                                                'escape' => false, 
                                                'options' => $option_fond_page,
                                                'value' => 1, //  $choix_accuiel_fond_page
                                                'class' => 'hide custom-select m-b-15 sf-select-form-input',
                                                'id' => 'id_choix_fond_page_accueil'
                                            ]);
                                    ?>												
                                    <!-- Uniquement une image de fond ==> hide couleur (cl first !) -->
                                    <div class="sf-select-form-input-type sf-select-form-input-fichier sf-select-form-input-1 col-md-12 no-padding <?php // $active_img_fond ;?>">
                                        <input type="file" name="image_fond_page_accueil_file" class="form-control sf-form-fichier sf-fond-fichier" data-default-file="<?= $url_page_accueil_image_fond ?>">
                                        <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_accueil_image_fond ?>" id="page_acceuil" >
                                    </div>
                                    <div class="hide sf-select-form-input-type sf-select-form-input-couleur sf-select-form-input-0 <?= (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_accueil_image_fond) ? "hide":"" ;?>">
                                        <input type="text" name="ecrans_navigation[page_accueil_couleur_fond]" class="form-control colorpicker2" value="<?= $page_accueil_couleur_fond ?>">
                                    </div>
                                    <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_accueil ?>">
                                        <a href="#bloc_page_acceuil" class="pull-left suppr_fond_page" data-owner="page_acceuil" style="font-size: 13px;">Supprimer</a>
                                    </div>
                                    <div class="page_to_delete"></div>														
                                </div>
                                <hr style='<?php echo ($hide_suppr_accueil == "" ? "margin-top: 25px;" : "margin-top: 45px;") ?>'/>
                                <div class="form-group">
                                    <label class="m-b-10">Bouton</label>
                                    <select  name="choix_btn_page_accueil" class="custom-select m-b-15 hide">
                                        <option value="1">Image de fond</option>
                                    </select>
                                    <input type="file"  name="image_btn_page_accueil_file" class="form-control sf-form-fichier sf-bouton-fichier"  data-allowed-file-extensions="png" data-default-file="<?= $url_page_accueil_image_btn ?>">
                                    <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_accueil_image_btn ?>" id="btn_acceuil" >
                                </div>
                                <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_btn_accueil ?>">
                                    <a href="#bloc_page_acceuil" class="pull-left suppr_fond_page" data-owner="btn_acceuil" style="font-size: 13px;">Supprimer</a>
                                </div>
                            </div>
                            <div class="sf-etat-actuel">
                                <h5 class="p-b-20">Description</h5>
                                <p>
                                    Ecran de démarrage de l'animation, incitant au clic.
                                </p>
                                <p>
                                    Vous pouvez utiliser une image de fond ou un fond de couleur.
                                </p>
                                <p>
                                    Il est également possible de se voir dès le démarrage.
                                </p>
                                <p><a href="#"><u>En savoir +</u></a></p>
                                <hr/>
                                <?php 
                                    $config_actuel = [];
                                    if(!empty($url_page_accueil_image_fond)) {
                                        $config_actuel[] = "Image de fond";
                                    }
                                    if(!empty($url_page_accueil_image_btn)) {
                                        $config_actuel[] = "bouton intéractif";
                                    }
                                    ?>													 
                                <?php if(!empty($config_actuel)) {?><h5>Configuration actuelle :</h5> <?php }?>
                                <p><?= implode(' + ', $config_actuel) ?></p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary pull-right p-l-50 p-r-50 sf-button-personnalise" type="button">Personnaliser</button>
                        </div>
                    </div>
                </div>
                <!-- Page prise photo -->
                <div class="no-padding m-t-50"  id="bloc_page_prise_photo">
                    <h4 class="text-uppercase">Page de prise de photo</h4>
                    <div class="m-t-20 sf-bg-gris p-30-20 form-inline sf-align-top">
                        <div class="col-sm-5">
                            <div class="sf-bloc-apercus" style="<?php if(empty($url_page_prise_photos_image_fond)) echo $style_bg_prise_photo; ?>">
                                <?php if($choix_prise_fond_page) { ?>
                                    <img src="<?= $url_page_prise_photos_image_fond ?>" width="100%" /> 
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="sf-etat-personnaliser hide">
                                <div class="form-group sf-etat-personnaliser">
                                    <!--<label class="m-b-10">Fond de page</label><br>
                                    <select class="custom-select m-b-15 sf-select-form-input">
                                        <option value="couleur">Couleur de fond</option>
                                        <option value="fichier" selected="selected">Image de fond</option>
                                    </select> -->														
                                    <?php                        
                                            echo $this->Form->control('choix_fond_page_prise_photo', [
                                                'label' => ['text' => 'Fond de page', 'class' => 'm-b-10'],
                                                'escape' => false, 
                                                'options' => $option_fond_page,
                                                'value' => 1, //$choix_prise_fond_page,
                                                'id' => 'id_choix_fond_page_prise_photo',
                                                'class' => 'custom-select m-b-15 sf-select-form-input hide'
                                            ]);
                                            // debug($configurationBorne->ecrans_navigation);
                                    ?>
                                    <!-- Uniquement une image de fond ==> hide couleur (cl first !) -->
                                    <div class="sf-select-form-input-type sf-select-form-input-fichier sf-select-form-input-1 col-md-12 no-padding" > <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_prise_photo_image_fond) ? "":"hide" ?>
                                        <input type="file" name="image_fond_page_prise_photo_file" class="form-control sf-form-fichier sf-fond-fichier"  data-allowed-file-extensions="png" data-default-file="<?= $url_page_prise_photos_image_fond ?>">
                                        <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_prise_photos_image_fond ?>" id="page_prise_photo" >
                                    </div>
                                    <div class="hide sf-select-form-input-type sf-select-form-input-couleur sf-select-form-input-0 <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_prise_photo_image_fond) ? "hide":""?>">
                                        <input type="text" name="ecrans_navigation[page_prise_photos_couleur_fond]" class="form-control colorpicker2" value="<?php echo $page_prise_photos_couleur_fond; ?>">
                                    </div>
                                    <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_prise_photo ?>">
                                        <a href="#bloc_page_prise_photo" class="pull-left suppr_fond_page" data-owner="page_prise_photo" style="font-size: 13px;">Supprimer</a>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            <div class="sf-etat-actuel">
                                <h5 class="p-b-20">Description</h5>
                                <p>
                                    Ecran de démarrage de l'animation, incitant au clic.
                                </p>
                                <p>
                                    Vous pouvez utiliser une image de fond ou un fond de couleur.
                                </p>
                                <p>
                                    Il est également possible de se voir dès le démarrage.
                                </p>
                                <p><a href="#"><u>En savoir +</u></a></p>
                                <hr/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary pull-right p-l-50 p-r-50 sf-button-personnalise" type="button">Personnaliser</button>
                        </div>
                    </div>
                </div>
                
                <!-- Page choix fond vert -->
                <div class="no-padding m-t-50 ecran_pg_choix_fv hide" id="bloc_page_choix_fv">
                    <h4 class="text-uppercase">Page de choix de fond vert</h4>
                    <div class="m-t-20 sf-bg-gris p-30-20 form-inline sf-align-top">
                        <div class="col-sm-5">												
                            <div class="sf-bloc-apercus" style="<?php if(empty($url_page_choix_fv_image_fond)) echo $style_bg_choix_fv; ?>">
                                <?php if($choix_choix_fv_fond_page) { ?>
                                    <img src="<?= $url_page_choix_fv_image_fond ?>" width="100%" /> 
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="sf-etat-personnaliser hide">
                                <div class="form-group sf-etat-personnaliser">														
                                    <?php                        
                                            echo $this->Form->control('choix_fond_page_choix_fv', [
                                                'label' => ['text' => 'Fond de page', 'class' => 'm-b-10'],
                                                'escape' => false, 
                                                'options' => $option_fond_page,
                                                'value' => 1,//$choix_remerc_fond_page,
                                                'id' => 'id_choix_fond_page_choix_fv_photo',
                                                'class' => 'custom-select m-b-15 sf-select-form-input hide'
                                            ]);
                                    ?>
                                    <!-- Uniquement une image de fond ==> hide couleur (cl first !) -->														
                                    <div class="sf-select-form-input-type sf-select-form-input-fichier sf-select-form-input-1 col-md-12 no-padding <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond) ? "":"hide" ?>">
                                        <input type="file" name="image_fond_page_choix_fv_file" class="form-control sf-form-fichier sf-fond-fichier"  data-allowed-file-extensions="png" data-default-file="<?= $url_page_filtre_image_fond ?>">
                                        <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_choix_fv_image_fond ?>" id="page_choix_fv" >
                                    </div>
                                    <div class="hide sf-select-form-input-type sf-select-form-input-couleur sf-select-form-input-0 <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond) ? "hide":""?>">
                                        <input type="text" name="ecrans_navigation[page_choix_fv_couleur_fond]" class="form-control colorpicker2" value="<?php echo $page_remerc_couleur_fond; ?>">
                                    </div>
                                    
                                    <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_choix_fv ?>">
                                        <a href="#bloc_page_choix_fv" class="pull-left suppr_fond_page" data-owner="page_choix_fv" style="font-size: 13px;">Supprimer</a>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            <div class="sf-etat-actuel">
                                <h5 class="p-b-20">Description</h5>
                                <p>
                                    Ecran de démarrage de l'animation, incitant au clic.
                                </p>
                                <p>
                                    Vous pouvez utiliser une image de fond ou un fond de couleur.
                                </p>
                                <p>
                                    Il est également possible de se voir dès le démarrage.
                                </p>
                                <p><a href="#"><u>En savoir +</u></a></p>
                                <hr/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary pull-right p-l-50 p-r-50 sf-button-personnalise" type="button">Personnaliser</button>
                        </div>
                    </div>
                </div>

                <!-- Page visualisation de photo-->
                <div class="no-padding m-t-50"  id="bloc_page_vis_photo">
                    <h4 class="text-uppercase">Page de visualisation de photo</h4>
                    <div class="m-t-20 sf-bg-gris p-30-20 form-inline sf-align-top">
                        <div class="col-sm-5">											
                            <div class="sf-bloc-apercus" style="<?php if(empty($url_page_vis_photo_image_fond)) echo $style_bg_vis_photo; ?>">
                                <?php if($choix_vis_photo_fond_page) { ?>
                                    <img src="<?= $url_page_vis_photo_image_fond ?>" width="100%" /> 
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="sf-etat-personnaliser hide">
                                <div class="form-group sf-etat-personnaliser">														
                                    <?php                        
                                            echo $this->Form->control('choix_fond_page_vis_photo', [
                                                'label' => ['text' => 'Fond de page', 'class' => 'm-b-10'],
                                                'escape' => false, 
                                                'options' => $option_fond_page,
                                                'value' => 1,//$choix_remerc_fond_page,
                                                'id' => 'id_choix_fond_page_vis_photo',
                                                'class' => 'custom-select m-b-15 sf-select-form-input hide'
                                            ]);
                                    ?>
                                    <!-- Uniquement une image de fond ==> hide couleur (cl first !) -->														
                                    <div class="sf-select-form-input-type sf-select-form-input-fichier sf-select-form-input-1 col-md-12 no-padding <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond) ? "":"hide" ?>">
                                        <input type="file" name="image_fond_page_vis_photo_file" class="form-control sf-form-fichier sf-fond-fichier"  data-allowed-file-extensions="png" data-default-file="<?= $url_page_filtre_image_fond ?>">
                                        <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_vis_photo_image_fond ?>" id="page_vis_photo" >
                                    </div>
                                    <div class="hide sf-select-form-input-type sf-select-form-input-couleur sf-select-form-input-0 col-md-12 no-padding <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond) ? "hide":""?>">
                                        <input type="text" name="ecrans_navigation[page_vis_photo_couleur_fond]" class="form-control colorpicker2" value="<?php echo $page_remerc_couleur_fond; ?>">
                                    </div>
                                    <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_vis_photo ?>">
                                        <a href="#bloc_page_vis_photo" class="pull-left suppr_fond_page" data-owner="page_vis_photo" style="font-size: 13px;">Supprimer</a>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            <div class="sf-etat-actuel">
                                <h5 class="p-b-20">Description</h5>
                                <p>
                                    Ecran de démarrage de l'animation, incitant au clic.
                                </p>
                                <p>
                                    Vous pouvez utiliser une image de fond ou un fond de couleur.
                                </p>
                                <p>
                                    Il est également possible de se voir dès le démarrage.
                                </p>
                                <p><a href="#"><u>En savoir +</u></a></p>
                                <hr/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary pull-right p-l-50 p-r-50 sf-button-personnalise" type="button">Personnaliser</button>
                        </div>
                    </div>
                </div>

                <!-- Page filtre -->
                <div class="no-padding m-t-50 ecran_pg_filtre hide"  id="bloc_page_filtre">
                    <h4 class="text-uppercase">Page filtre</h4>
                    <div class="m-t-20 sf-bg-gris p-30-20 form-inline sf-align-top">
                        <div class="col-sm-5">											
                            <div class="sf-bloc-apercus" style="<?php if(empty($url_page_filtre_image_fond)) echo $style_bg_filtre; ?>">
                                <?php if($choix_filtre_fond_page) { ?>
                                    <img src="<?= $url_page_filtre_image_fond ?>" width="100%" /> 
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="sf-etat-personnaliser hide">
                                <div class="form-group sf-etat-personnaliser">
                                    <!--<label class="m-b-10">Fond de page</label><br>
                                    <select class="custom-select m-b-15 sf-select-form-input">
                                        <option value="couleur">Couleur de fond</option>
                                        <option value="fichier" selected="selected">Image de fond</option>
                                    </select> -->														
                                    <?php                        
                                            echo $this->Form->control('choix_fond_page_filtre', [
                                                'label' => ['text' => 'Fond de page', 'class' => 'm-b-10'],
                                                'escape' => false, 
                                                'options' => $option_fond_page,
                                                'value' => 1, //$choix_filtre_fond_page,
                                                'id' => 'id_choix_fond_page_filtre_photo',
                                                'class' => 'custom-select m-b-15 sf-select-form-input hide'
                                            ]);
                                            // debug($configurationBorne->ecrans_navigation);
                                    ?>
                                    
                                    <!-- Uniquement une image de fond ==> hide couleur (cl first !) -->
                                    <div class="sf-select-form-input-type sf-select-form-input-fichier sf-select-form-input-1 col-md-12 no-padding <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_filtre_image_fond) ? "":"hide" ?>">
                                        <input type="file" name="image_fond_page_filtre_file" class="form-control sf-form-fichier sf-fond-fichier"  data-allowed-file-extensions="png" data-default-file="<?= $url_page_filtre_image_fond ?>">
                                        <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_filtre_image_fond ?>" id="page_filtre" >
                                    </div>
                                    <div class="hide sf-select-form-input-type sf-select-form-input-couleur sf-select-form-input-0 <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_filtre_image_fond) ? "hide":""?>">
                                        <input type="text" name="ecrans_navigation[page_filtre_couleur_fond]" class="form-control colorpicker2" value="<?php echo $page_filtre_couleur_fond; ?>">
                                    </div>
                                    <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_filtre ?>">
                                        <a href="#bloc_page_filtre" class="pull-left suppr_fond_page" data-owner="page_filtre" style="font-size: 13px;">Supprimer</a>
                                    </div>
                                </div>
                                <hr/>
                                <?php                        
                                        echo $this->Form->control('ecrans_navigation.page_filtre_titre', [
                                            'label' => ['text' => 'Titre', 'class' => 'm-b-10'],
                                            'escape' => false,
                                            'class' => 'form-control'
                                        ]);
                                ?>
                            </div>
                            <div class="sf-etat-actuel">
                                <h5 class="p-b-20">Description</h5>
                                <p>
                                    Ecran de démarrage de l'animation, incitant au clic.
                                </p>
                                <p>
                                    Vous pouvez utiliser une image de fond ou un fond de couleur.
                                </p>
                                <p>
                                    Il est également possible de se voir dès le démarrage.
                                </p>
                                <p><a href="#"><u>En savoir +</u></a></p>
                                <hr/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary pull-right p-l-50 p-r-50 sf-button-personnalise" type="button">Personnaliser</button>
                        </div>
                    </div>
                </div>
                <!-- Page remerciement -->
                <div class="no-padding m-t-50"  id="bloc_page_remerc">
                    <h4 class="text-uppercase">Page remerciement</h4>
                    <div class="m-t-20 sf-bg-gris p-30-20 form-inline sf-align-top">
                        <div class="col-sm-5">							
                            <div class="sf-bloc-apercus" style="<?php if(empty($url_page_remerc_image_fond)) echo $style_bg_remerc; ?>">
                                <?php if($choix_remerc_fond_page) { ?>
                                    <img src="<?= $url_page_remerc_image_fond ?>" width="100%" /> 
                                <?php } ?>
                            </div>	
                        </div>
                        <div class="col-sm-4">
                            <div class="sf-etat-personnaliser hide">
                                <div class="form-group sf-etat-personnaliser">														
                                    <?php                        
                                            echo $this->Form->control('choix_fond_page_remerc', [
                                                'label' => ['text' => 'Fond de page', 'class' => 'm-b-10'],
                                                'escape' => false, 
                                                'options' => $option_fond_page,
                                                'value' => 1,//$choix_remerc_fond_page,
                                                'id' => 'id_choix_fond_page_remerc_photo',
                                                'class' => 'custom-select m-b-15 sf-select-form-input hide'
                                            ]);
                                    ?>
                                    <!-- Uniquement une image de fond ==> hide couleur (cl first !) -->														
                                    <div class="sf-select-form-input-type sf-select-form-input-fichier sf-select-form-input-1 col-md-12 no-padding <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond) ? "":"hide" ?>">
                                        <input type="file" name="image_fond_page_remerc_file" class="form-control sf-form-fichier sf-fond-fichier"   data-allowed-file-extensions="png" data-default-file="<?= $url_page_remerc_image_fond ?>">
                                        <input type="hidden"  value="<?= $configurationBorne->ecrans_navigation->page_remerc_image_fond ?>" id="page_remerc" >
                                    </div>
                                    <div class="hide sf-select-form-input-type sf-select-form-input-couleur sf-select-form-input-0 <?php //echo (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_page_remerc_image_fond) ? "hide":""?>">
                                        <input type="text" name="ecrans_navigation[page_remerc_couleur_fond]" class="form-control colorpicker2" value="<?php echo $page_remerc_couleur_fond; ?>">
                                    </div>
                                    <div class="cf_bloc_suppr_ecran m-t-2 <?= $hide_suppr_remerc ?>">
                                        <a href="#bloc_page_remerc" class="pull-left suppr_fond_page" data-owner="page_remerc" style="font-size: 13px;">Supprimer</a>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            <div class="sf-etat-actuel">
                                <h5 class="p-b-20">Description</h5>
                                <p>
                                    Ecran de démarrage de l'animation, incitant au clic.
                                </p>
                                <p>
                                    Vous pouvez utiliser une image de fond ou un fond de couleur.
                                </p>
                                <p>
                                    Il est également possible de se voir dès le démarrage.
                                </p>
                                <p><a href="#"><u>En savoir +</u></a></p>
                                <hr/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary pull-right p-l-50 p-r-50 sf-button-personnalise" type="button">Personnaliser</button>
                        </div>
                    </div>
                </div>

            </div>
            <?php // onglet "Votre catalogue" ?>
            <div class="tab-pane  no-padding-left no-padding-right " id="votre-catalogue" role="tabpanel">
                <!--Catalogue de mep Ecrans --><!--Mon catalogue-->
                <?php echo $this->element('ConfigBornes/catalogue_mise_en_page') ;?>
            </div>
        </div>
    </div>
</div>	