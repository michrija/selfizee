<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->css('photos/popup_photo.css?v1_190213') ?>
<?= $this->Html->css('daterange/bootstrap-timepicker.min.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/daterangepicker.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-switch/bootstrap-switch.min.css', ['block' => true]) ?>
<?= $this->Html->css('photos/liste.css') ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>

<?php //$this->Html->css('style.css', ['block' => true]) ?> 
<?php //$this->Html->script('https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', ['block' => true]) 
    echo $this->Html->script('mp-mansory/mp.mansory.min.js', ['block' => true]);
?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>
<?= $this->Html->script('photos/liste.js', ['block' => true]); ?>
<?= $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?= $this->Html->script('photos/popup_photo.js', ['block' => true]) ?>
<?= $this->Html->script('photos/resendcontact.js', ['block' => true]) ?>

<?= $this->Html->css('/assets/plugins/icheck/skins/all.css',['block'=>true]) ?>
<?= $this->Html->script('/assets/plugins/icheck/icheck.min.js', ['block' => true]); ?>
<?= $this->Html->script('/assets/plugins/icheck/icheck.init.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/liste.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/moment.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-switch/bootstrap-switch.min.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/bootstrap-timepicker.min.js', ['block' => true]); ?>
<?= $this->Html->css('photos/custom-mob.css?'.time(), ['block' => true]) ?>

<?php
$titrePage = "Photos de l'événement" ; 
$queue = time();
?>
<?php if(!empty($countAllPhotoOfEvenement)  || !empty($countAllVideoOfEvenement)){ ?>
    <div class="card card-new-selfizee">
        <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                    <?php 
                    $galery = $evenement->galeries[0];
                    echo $this->Html->link('Visualiser la galerie',['controller'=>'Galeries','action'=>'souvenir', $galery->id_encode],['target'=>'_blank','escape'=>false,"class"=>"pull-right link link-selfizee-action" ]);
                    
                    // echo $this->Html->link('Télécharger les médias',['action'=>'downloadByEvenement', $evenement->id],['escape'=>false,"class"=>"pull-right link link-selfizee-action m-r-15" ]);   
                  
                    /*
                     * @Paul
                     * Projet : https://trello.com/c/l6H6mZ3K/573-g%C3%A9n%C3%A9ration-url-des-photos-zipper
                     * Description : Génération zip + envoi mail pour téléchargement albums photos d'un event
                     * 06/08/19
                     *
                     */
                    echo $this -> Html -> link('Télécharger les médias',['action'=>'downloadByEvenement', $evenement->id], ['escape'=>false, 'class' => 'pull-right link link-selfizee-action m-r-15', 'id' => 'sf-download-album', 'data-evt' => $evenement->id, 'type' => 'button']);
                    
                    if($userConnected['is_active_acces_edit_photo']){
                        echo $this->Html->link('Ajouter des médias',['action'=>'add', $evenement->id],['escape'=>false,"class"=>"pull-right link link-selfizee-action m-r-15" ]);                           
                       /* echo $this->Html->link('Importer les médias',['action'=>'importPhoto', $evenement->id],['escape'=>false,"class"=>"pull-right link link-selfizee-action m-r-15" ]); */
                    }    
                    ?>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            <div class="kl_titreTop">
                <div class="kl_syntheseEvent pull-left">Synthèse événement :</div>
                <div class="clearfix"></div>
            </div>
            <div class="row kl_statTop">
                <?php if(!empty($countAllPhotoOfEvenement)){ ?>
                <div class="col-md-2 kl_nopadding">
                        <div class="kl_oneStatCount text-center">
                            <span class="kl_statNbrValue"><?= $countAllPhotoOfEvenement ?></span> 
                            <?= $countAllPhotoOfEvenement>1 ? "Photos" :"Photo" ?>
                        </div>
                </div>
                <?php } ?>
                <?php if(!empty($countAllVideoOfEvenement)){ ?>
                <div class="col-md-2 kl_nopadding">
                        <div class="kl_oneStatCount text-center">
                            <span class="kl_statNbrValue">
                                <?= $countAllVideoOfEvenement ?>
                            </span> 
                            <?= $countAllVideoOfEvenement > 1 ? "vidéos" : "vidéo" ?>
                        </div>
                </div>
                <?php } ?>
                <div class="col-md-2 kl_nopadding">
                        <div class="kl_oneStatCount text-center">
                            <span class="kl_statNbrValue"><?= $evenement->print_counter ?></span> <?= $evenement->print_counter>1 ? "Impressions" :"Impression" ?>
                        </div>
                </div>
            </div>
            <div class="kl_theFiltre">
                <?php  
                    echo $this->Form->create(null, ['type' => 'get' ,'id'=>'id_filtreContact','role'=>'form']);   
                ?>
                <?php 

                echo $this->Form->control('filtre',['label'=>'Filtrer les photos','type'=>'checkbox','id'=>'id_filtreToActive', "value"=>'1','default' => $filtre,'hiddenField' => false]); ?>
                <div class="kl_filtre_contact <?= empty($filtre) ? 'hide' :'' ?>"  id="id_blocFormFiltre">
                    <div class="row ml-0">         
                        <div class="col-md-3 p-l-0" id="id_datePickerMois">
                            <div class="form-group">
                                <input value="<?= $periode ?>" class="form-control input-daterange-datepicker" type="text" name="periode"  placeholder="jj/mm/aaaa - jj/mm/aaaa"  />
                            </div>
                        </div>
                       
                        <div class="col-md-3 p-l-0">
                            <div class="row btn_filtre_contact">
                                <div class="col-md-4 p-r-0 ">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-selfizee-inverse noborber'] );?>
                                </div>
                                <div class="col-md-4 p-l-0 ">
                                    <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Réinitialiser', ['action' => 'liste',$idEvenement], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-selfizee-inverse noborber", "escape"=>false]);   ?>         
                                </div>
                            </div>   
                        </div>     
                    </div>
                </div>
                <?php 
                    echo $this->Form->end(); 
                ?>
            </div>
        </div>
    </div>
    <div class="card card-new-selfizee">
        <div class="card-header no-padding-bottom ">
            <div class="kl_customActionPhoto col-12">
                <?php if($userConnected['is_active_acces_edit_photo'] &&  !empty($photos->toArray())){ ?>

                <?php if(!empty($countPhotoInCorbeille)){ ?>
                <div class="col-1 pull-right ">
                    <div class="btn-group ">
                      <button type="button" class="btn btn-selfizee-inverse dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Corbeille
                      </button>
                      <div class="dropdown-menu">
                        <?= $this->Html->link('<i class="mdi mdi-folder"></i> Ouvrir',['action'=>'liste', $evenement->id, '?'=>['corbeille'=>1]],['escape'=>false,"class"=>"dropdown-item" ]) ?>
                        <?php if($userConnected['is_active_acces_edit_photo']) { ?>
                            <?= $this->Form->postLink('<i class="mdi mdi-delete"></i> Vider',['action'=>'viderCorbeille', $evenement->id],['escape'=>false,"class"=>"dropdown-item",'confirm'=>'Etes vous sûr de vouloir vider la corbeille ?']); ?>
                        <?php } ?>
                      </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-2 pull-right m-r-25" id="id_btn_delete_all">
                     <?= $this->Form->postLink('Supprimer tous les médias',['action'=>'corbeilleAll', $evenement->id, $queue],['escape'=>false,"class"=>"btn btn-selfizee-inverse ",'confirm'=>'Etes vous sûr de vouloir tout supprimer ?']); ?>
                </div>
                <?php } ?>

                <div class="col-3 pull-right m-r-5 kl_deleteSelectPhoto hide" id="id_photosSelected">
                             <?= $this->Form->postLink('<i class="mdi mdi-delete"></i> Supprimer les médias séléctionnés',['action'=>'deleteSelected', $evenement->id,1],['escape'=>false,"class"=>"btn btn-selfizee-inverse",'confirm'=>'Etes vous sûr de vouloir supprimer les medias séléctionnés ?']); ?>
                            <input type="hidden" value="<?= $evenement->id ?>" id="id_evenement" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="kl_listePhoto row col-12 el-element-overlay" id="id_photoListe">
                <?php 
                if(!empty($photos->toArray())){
                    foreach($photos as $key => $photo){

                        $style_img = 
                        $photo_thumb = 
                        $style_bloc = '';
                        if($photo ->type_media == 'video'){
                            $photo_thumb = '/img/icon-play.png';
                            $style_img = ' style="width:100px !important;margin: auto;margin-top:77px;" ';
                            $style_bloc = ' style="background: black;background-image:url('.$photo->url_miniature_video.');height: 244px !important;"';
                        }else{
                            $photo_thumb = $photo->url_thumb_bo;
                           
                        }
                
                ?>
                    <div class="kl_onePhoto" data-order="<?= $key ?>" id="id_onePhoto_<?= $photo->id ?>">
                        <div class="card-one">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1 sf-video" <?= $style_bloc; ?>> <img src="<?= $photo_thumb; ?>" alt="<?= $photo->created ?>" <?= $style_img ?>/>
                                    <?php if($userConnected['is_active_acces_edit_photo']){ ?>
                                        <div class="kl_bloc_check_suppr ml-2 " title="Cocher pour supprimer" >
                                            <label class="custom-control custom-checkbox" for="square-checkbox-<?= $key ?>"><input type="checkbox" name="photos[]" value="<?= $photo->id ?>"  class="custom-control-input kl_onePhoto_checked" id="square-checkbox-<?= $key ?>"><span class="custom-control-label"></span></label>
                                        </div>
                                    <?php } ?>
                                    <div class="el-overlay">
                                        <ul class="el-info">
                                            <li>
                                                <?php echo $this->Html->link('<i class="icon-magnifier"></i> ',['controller'=>'Photos','action'=>'get', $photo->id, '_full' => true],['escape'=>false,"class"=>"btn default btn-outline kl_viewImage" ]);  ?>
                                            </li>
                                            <?php if($userConnected['is_active_acces_edit_photo']){ ?>
                                            <li>
                                                <a href="#" class="btn default btn-danger kl_deletePhoto" data-item="<?= $photo->id ?>" data-queue="<?= $queue ?>" ><i class="icon-close "></i></a>
                                            </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
                <div class="kl_thePaginate">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                </div>
                <?php }else{ ?>
                    <div class="col-md-12">Aucune photo trouvée</div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } else{ ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                    <div class="pull-right">
                      <?php 
                       echo $this->Html->link('Ajouter des médias',['action'=>'add', $evenement->id],['escape'=>false,"class"=>"kl_bntLinkSimpleCustom pull-right btn-selfizee m-l-25 " ]);                           
                       /* echo $this->Html->link('Importer les médias',['action'=>'importPhoto', $evenement->id],['escape'=>false,"class"=>"kl_bntLinkSimpleCustom pull-right btn-selfizee" ]);*/
                      ?> 
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="">Vous n'avez pas de médias</div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>