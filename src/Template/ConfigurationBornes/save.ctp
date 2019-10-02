<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigBorne $configBorne
 *///Asphalt
?>
<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->script('ConfigBornes/add.js', ['block' => true]); ?>

<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
        </div>
        <div class="card-body">
            <?= $this->Form->create($configBorne, ['type' => 'file',"id"=>""]) ?>
                <?= $this->Form->control('evenement_id',['value'=>$evenement->id,'type'=>'hidden']) ?>
                <div class="form-body">
                    <h4 class="">Etape 1 : Animations</h4>
                     <div class="col-md-12">
                         <?php
                            //echo $this->Form->control('type_mise_en_page_id', ['options' => $typeMiseEnPages,"id"=>"id_type_mise_en_page"]);
                         ?>
                         
                         <?php
                                    echo $this->Form->radio(
                                    'type_mise_en_page_id',
                                    $mEnpOptions,
                                    [
                                        'default' => 1,
                                        'label' =>'',
                                    ]
                                    );
                            ?>
                     </div>

                     <h4 class="">Etape 2 : Configurations Animations</h4>
                     <div class="col-md-12 config_catalogue">
                     <h5 class="">Choisir du visuel parmi les catalogue :</h5>
                         <?php 
                            echo $this->Form->control('catalogue_id', ['options' => $catalogues]);
                         ?>
                     </div>
                     <div class="col-md-12 config_animation">
                     <h5 class="">Choisir d'une ou plusieurs animations</h5>
                     <style>span.select2.select2-container { width: 100% !important;} </style>
                         <?php 
                            echo $this->Form->control('type_animations._ids', ['label' => false , 'options' => $typeAnimations, 'class' => 'select2']);
                         ?>
                     </div>
                     
                     <h4 class="">Etape 3 : Options</h4>
                     <div class="col-md-12">
                        <h5 class="">Configuration animations : </h5>

                            <h6 class="cf_cadres">Cadres : </h6> 
                            <div class="col-md-4 form-group cf_cadres">                           
                            <?php 
                                $url_cadre = null;
                                if(!empty($configBorne->configuration_animations[0]->cadres)){
                                        $fileName = $configBorne->configuration_animations[0]->cadres[0]->file_name;
                                        if(file_exists(PATH_CONFIG_BORNE . $evenement->id .'/cadres/'. $fileName )) $url_cadre = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                                }                                
                            ?>  
                                <input  type="file" name="cadres_file" class="dropify_cadre" accept=".jpg, .jpeg" data-default-file="<?= $url_cadre ?>">
                            </div>
                            <hr class="cf_cadres">                            

                            <h6 class="">Prise de photo : </h6>
                            <?php 
                                echo $this->Form->control('decompte_prise_photo');
                                //echo $this->Form->control('is_reprise_photo');
                            ?>
                            <label class="">Reprise photo </label>
                            <div class="col-md-4 row">
                                 <?php
                                                  echo $this->Form->radio(
                                                    'is_reprise_photo',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 1,'label' =>'Reprise photo']
                                                    );
                                ?>
                            </div>
                            <hr>

                            <h6 class="">Filtres de couleurs : </h6>
                                <?php 
                                    echo $this->Form->control('filtres._ids', ['label' => false , 'options' => $filtres, 'class' => 'select2']);
                                ?>
                            <hr> 

                            <h6 class="">Incrustation fond vert : </h6>
                                <?php 
                                    //echo $this->Form->control('is_incrustation_fond_vert', ['id'=> 'id_is_incrustation_fond_vert']);
                                ?>
                                <div class="col-md-4 row">
                                 <?php
                                                  echo $this->Form->radio(
                                                    'is_incrustation_fond_vert',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 1,'label' =>'Incrustation fond vert']
                                                    );
                                ?>
                                </div>
                                <h6 class="cf_images_fond_vert">Images de fonds  : </h6>                                
                                <!--<div class="col-md-4 form-group">
                                    <input  type="file" name="image_fond_verts_files[]" class="dropify_fond_verts" accept=".jpg, .jpeg"> id_images_fond_vert
                                </div>-->                               
                                <div class="dropzone kl_blocDropzone cf_images_fond_vert hide" id="dropzone_fond_vert"></div>
                     </div>                     
                     
                     <h4 class="">Etape 4 : Prise de coordonnées</h4>
                     <div class="col-md-12">
                         <?php 
                           // echo $this->Form->control('is_prise_coordonnee', ['id'=> 'id_is_prise_coordonnee']);
                         ?>
                         <label class="">Prise de coordoonnées : </label>
                         <div class="col-md-4 row">
                            <?php
                                    echo $this->Form->radio(
                                    'is_prise_coordonnee',
                                    [
                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                    ],
                                    ['default' => 1,'label' =>'Prise de coordonnées ', 'id'=> 'id_is_prise_coordonnee']
                                    );
                            ?>
                        </div>

                        <div class="col-8 kl_champs hide">
                            <?php echo $this->Form->control('titre_formulaire'); ?>
                            <h6 class="">Champs : </h6>
                            <?php 
                                echo $this->Form->control('champs.0.nom');
                                echo $this->Form->control('champs.0.type_champ_id', [ 'options' => $typeChamps]); 
                                echo $this->Form->control('champs.0.type_donnee_id', [ 'options' => $typeDonnees]);
                                echo $this->Form->control('champs.0.ordre');
                                echo $this->Form->control('champs.0.is_required');
                                echo $this->Form->control('champs.0.type_optin_id', [ 'options' => $typeOptins]);                       
                            ?>
                        </div>
                     </div>
                     <hr>

                     <h4 class="">Etape 5 : Impressions</h4>
                     <div class="col-md-12">
                         <?php 
                            echo $this->Form->control('is_impression');
                            echo $this->Form->control('is_multi_impression');
                            echo $this->Form->control('nbr_max_multi_impression');
                            echo $this->Form->control('has_limite_impression');
                            echo $this->Form->control('nbr_max_photo');
                            echo $this->Form->control('texte_impression');
                            echo $this->Form->control('is_impression_auto');
                            echo $this->Form->control('nbr_copie_impression_auto');
                            echo $this->Form->control('decompte_time_out');
                         ?>
                     </div>
                     <hr> 
                     
                     <h4 class="">Etape 6 : Ecrans</h4>
                    <h6 class="">PAGE D'ACCUEIL </h6>                                                                              
                    <?php 
                        $option_fond_page = [1 => 'Image de fond', 0 => 'Couleur de fond'];
                        $choix_accuiel_fond_page = $choix_accueil_btn = $choix_prise_fond_page = 1;

                        $url_page_accueil_image_fond = null;
                        $url_page_accueil_image_btn = null;
                        $url_page_prise_photos_image_fond = null;

                        if(!$is_new) {
                            if(!empty($configBorne->ecrans_navigation)) {
                                $choix_accuiel_fond_page = $configBorne->ecrans_navigation->is_active_page_accueil_image_fond;
                                $choix_accueil_btn = $configBorne->ecrans_navigation->is_active_page_accueil_image_btn_fond;
                                $choix_prise_fond_page = $configBorne->ecrans_navigation->is_active_page_prise_photo_image_fond;
                            }
    
                            if($configBorne->ecrans_navigation->is_active_page_accueil_image_fond){
                                    $fileName = $configBorne->ecrans_navigation->page_accueil_image_fond;
                                    if(file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) $url_page_accueil_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                            }     
                            
                            if($configBorne->ecrans_navigation->is_active_page_accueil_image_btn_fond){  
                                    $fileName = $configBorne->ecrans_navigation->page_accueil_image_btn;
                                    if(file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) $url_page_accueil_image_btn = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                            } 
                            
                            if($configBorne->ecrans_navigation->is_active_page_prise_photo_image_fond){
                                    $fileName = $configBorne->ecrans_navigation->page_prise_photos_image_fond;
                                    if(file_exists(PATH_CONFIG_BORNE . $evenement->id .'/ecrans/'. $fileName )) $url_page_prise_photos_image_fond = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/ecrans/'.$fileName;
                            }
                        }   
                    ?>
                     <div class="col-md-12">
                         <?php                        
                            echo $this->Form->control('choix_fond_page_accueil', [
                                        'label' => '<strong>Fond de page</strong>', 
                                        'escape' => false, 
                                        'options' => $option_fond_page,
                                        'value' => $choix_accuiel_fond_page,
                                        'id' => 'id_choix_fond_page_accueil'
                            ]); 
                            //echo $this->Form->control('ecrans_navigation.page_accueil_image_fond', ['label' => 'Image fond ', 'id' => 'id_page_accueil_image_fond']);
                            ?>                              
                            <div class="col-md-4 form-group hide" id="id_page_accueil_image_fond">
                                <h6 class="">Image fond  : </h6>    
                                <input  type="file" name="image_fond_page_accueil_file" class="dropify_fond_page_accueil" accept=".jpg, .jpeg" data-default-file="<?= $url_page_accueil_image_fond ?>">
                            </div>
                            <?php
                            echo $this->Form->control('ecrans_navigation.page_accueil_couleur_fond', ['label' => 'Couleur fond ', 'id' => 'id_page_accueil_couleur_fond']);
                            //echo $this->Form->control('ecrans_navigation.page_config_fond_id');

                            // Button
                            echo $this->Form->control('choix_btn_page_accueil', ['label' => '<strong>Bouton</strong>', 'escape' => false, 'options' => $option_fond_page, 'value' => $choix_accueil_btn, 'id' => 'id_choix_btn_page_accueil']); 
                            //echo $this->Form->control('ecrans_navigation.page_accueil_image_btn', ['label' => 'Image btn ', 'id' => 'id_page_accueil_image_btn']);
                            ?>                                                      
                            <div class="col-md-4 form-group hide" id="id_page_accueil_image_btn">
                                <h6 class="">Image boutton  : </h6>
                                <input  type="file" name="image_btn_page_accueil_file" class="dropify_btn_page_accueil" accept=".jpg, .jpeg"  data-default-file="<?= $url_page_accueil_image_btn ?>">
                            </div>
                            <?php
                            echo $this->Form->control('ecrans_navigation.page_accueil_couleur_btn', ['label' => 'Couleur btn ', 'id' => 'id_page_accueil_couleur_btn']);                            
                            //echo $this->Form->control('ecrans_navigation.page_config_bouton_id');
                            //echo $this->Form->control('ecrans_navigation.page_config_police_id');                        
                         ?>
                     </div>
                     <hr> 

                     <h6 class="">PAGE DE PRISES PHOTOS </h6>
                     <div class="col-md-12">
                     <?php                         
                            echo $this->Form->control('choix_fond_page_prise_photo', ['label' => '<strong>Fond de page</strong>', 'escape' => false, 'options' => $option_fond_page, 'value' => $choix_prise_fond_page, 'id' => 'id_choix_fond_page_prise_photo']); 
                            //echo $this->Form->control('ecrans_navigation.page_prise_photos_image_fond', ['label' => 'Image fond ', 'id' => 'id_page_prise_photos_image_fond']);
                            ?>                                                      
                            <div class="col-md-4 form-group  hide" id="id_page_prise_photos_image_fond">
                                <h6 class="">Image fond  : </h6>
                                <input  type="file" name="image_fond_page_prise_photo_file" class="dropify_fond_page_prise_photo" accept=".jpg, .jpeg"  data-default-file="<?= $url_page_prise_photos_image_fond ?>">
                            </div>
                            <?php
                            echo $this->Form->control('ecrans_navigation.page_prise_photos_couleur_fond', ['label' => 'Couleur fond ', 'id' => 'id_page_prise_photos_couleur_fond']);                            
                         ?>
                     </div>
                     <hr> 

                     <h4 class="">Etape 7 : Bornes</h4>
                     <div class="col-md-12">
                         <?php 
                            echo $this->Form->control('num_borne');
                            echo $this->Form->control('taille_ecran_id', ['options' => $tailleEcrans, 'empty' => true]);
                            echo $this->Form->control('type_imprimante_id', ['options' => $typeImprimantes, 'empty' => true]);
                         ?>
                     </div>
                     
                     <div class="col-md-12">
                         <?php 
                         ?>
                     </div>
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> Save',["class"=>"btn btn-success",'escape'=>false]) ?>
                    <?= $this->Form->button('Cancel',["type"=>"reset", "class"=>"btn btn-inverse",'escape'=>false]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
