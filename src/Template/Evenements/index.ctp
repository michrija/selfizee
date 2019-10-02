<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement[]|\Cake\Collection\CollectionInterface $evenements
 */
?>

<?= $this->Html->css('style2.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/bootstrap-timepicker.min.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/daterangepicker.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-switch/bootstrap-switch.min.css', ['block' => true]) ?>
<?= $this->Html->css('popover/bootstrap-popover-x.css', ['block' => true]) ?>

<?= $this->Html->script('daterange/moment.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/bootstrap-timepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-switch/bootstrap-switch.min.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/liste.js?'.time(), ['block' => true]); ?>
<?= $this->Html->script('popover/bootstrap-popover-x.js', ['block' => true]); ?>

<?php
$titrePage = "Liste des événements" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Ajouter un événement',['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse kl_btn_add_event p-t-20" ]);
$this->end();

?>         
        
<div class="row mt-5">
    <div class="col-12 kl_body_listing_event">
    <div class="card">
        <?php if(!$isGlobal){ ?>
        <div class="kl_myOnglet">
            <?php
                
                $kl_activeVenir = "";
                $kl_activePasse = "active";
                if($passe){
                   $kl_activeVenir = "active";
                    $kl_activePasse = "";
                }
            ?>
            <div class="kl_oneOnglet m-l-5 <?= $kl_activePasse ?> ">
                <?= $this->Html->link('En cours et terminés',['action'=>'index']) ?>
            </div>
            
            <div class="kl_oneOnglet <?= $kl_activeVenir ?>">
                <?php // $this->Html->link('A venir',['action'=>'index','?'=>['passe'=>1]]) ?>
                <?= $this->Html->link('A venir',['action'=>'a-venir']) ?>
            </div>
            
        </div>
        <?php } ?>
        <!--NEW Synthese, filtre-->
        <br>

        <?php if(!empty($evenements->toArray())){?>
            <div class="row kl_filtre_filtre_event">
                <div class="col-lg-12 col-md-12">
                    <div class="card0">
                        <div class="card-body kl_synthese_event">
                        <input type="hidden" name="" id="id_evenements_ids" value="<?= json_encode($allIdEvenements) ?>">
                            <div class="row">
                                <div class="col-lg-2 col-md-6"><h5 class=""><?= $this->Paginator->counter(['format' => __('{{count}}')]) ?></h5> <span class="kl_title_info_event">événements</span></div>
                                <?php  if(!$passe){ ?>
                                <div class="col-lg-2 col-md-6 kl_count_photos">
                                    <h5 class="" id="id_count_photos"><?= $totalPhotos ?></h5> <span class="kl_title_info_event">photos</span>
                                </div>
                                <?php } ?>
                                <div class="col-lg-2 col-md-6 kl_count_contacts hide">
                                    <h5 class="" id="id_count_contacts"></h5> <span class="kl_title_info_event">contacts</span>
                                </div>
                                <?php  if(!$passe){ ?>
                                <div class="col-lg-2 col-md-6  kl_count_email_envoyes hide">
                                    <h5 class=""  id="id_count_email_envoyes"></h5> <span class="kl_title_info_event">mails envoyés</span>
                                </div>
                                <div class="col-lg-2 col-md-6 kl_count_sms_envoyes hide">
                                    <h5 class=""  id="id_count_sms_envoyes"></h5> <span class="kl_title_info_event">sms envoyés</span>
                                </div>
                                <div class="col-lg-2 col-md-6  kl_count_publications hide">
                                    <h5 class="" id="id_count_publications"></h5> <span class="kl_title_info_event">publication facebook</span>
                                </div>
                                <?php } ?>
                            </div>
                            <hr>
                        </div>
                        <!--============ FILTRE-->
                            <div class="card-body kl_filtre_event">
                                <?php echo $this->Form->create(null, ['type' => 'post','role'=>'form', 'id' => 'evenementForm']);?>
                                <div class="row">
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <!--<input type="text" name="key" class="form-control search" placeholder="Rechercher..." id="key">-->
                                            <?php echo $this->Form->control('key',['value'=>$key, 'label'=>false, 'class'=>'form-control search','placeholder'=>'Rechercher...', 'id' => 'keys']); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <!--   <select name="clientType" class="form-control" id="clienttype"><option value="">Type</option><option value="person">Particulier</option><option value="corporation">Professionnel</option></select> <span class="help-block"><small></small></span>-->
                                            <?php
                                                $type = array('person'=>'Particulier', 'corporation' => 'Professionnel');
                                            echo $this->Form->control('clientType',['default'=>$clientType, 'label' => false, 'options'=>$type,'empty'=>'Type','class'=>'form-control']);

                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $type = array('w_'.(date('W')-1)=>'Semaine dernière', 'm_'.(date('m') - 1) => 'Mois dernier ', 'w_'.date('W')=>'Cette semaine', 'm_'.date('m') => 'Ce mois-ci','x'=>'De date à date');
                                                echo $this->Form->control('periodeType',['default'=>$periodeType, 'label' => false, 'options'=>$type,'empty'=>'Période','class'=>'form-control','id'=>'id_periodeChoix']);
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 p-r-0 hide" id="id_datePickerMois">
                                        <div class="form-group">
                                            <input class="form-control input-daterange-datepicker" type="text" name="periode" value="<?php if(!empty($date_fin0)) echo $date_debut0.' - '.$date_fin0; ?>" placeholder="jj/mm/aaaa - jj/mm/aaaa" readonly="readonly" id="periode" />
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="passe" id="passe" value="<?= $passe ?>" />
                                    <div class="col-md-6 p-r-0 bloc_active_filtre_avances row" style="padding-left:35px;">
                                        <?php echo $this->Form->control('filtre_avances', ['type'=>'checkbox', 'label'=>'Filtres avancés', 'id'=>'is_affiche_filtre_avances', 'hiddenField' => false,
                                        'templates' => ['checkboxContainer' => '{{content}}' ]]); ?>
                                        <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn  kl_btn_refresh', 'id' => 'filtreBtn'] );?>
                                        <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Réinitialiser', ['action' => 'index','?'=>['passe'=>$passe]], ["class"=>"btn kl_btn_refresh", "escape"=>false, 'style' => 'margin-left:25px;']);   ?>
                                    </div>
                                    <!--<div class="col-lg-3 col-md-6">
                                        <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-success kl_btn_refresh'] );?>
                                        <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Réinitialiser', ['action' => 'index','?'=>['passe'=>$passe]], ["class"=>"btn btn-success kl_btn_refresh", "escape"=>false]);   ?>

                                    </div>-->
                                </div>
                                <div class="row filtre_avances hide">
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $pageSouvConfOptions = ['1' => 'Oui', '2' => 'Non'];
                                            echo $this->Form->select('pageSouv', $pageSouvConfOptions, ['default'=>$pageSouv,'empty' => 'Page souvernir configurée','class'=>'form-control', 'id' => 'pageSouvenir']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $emailConfOptions = ['1' => 'Oui', '2' => 'Non'];
                                            echo $this->Form->select('emailConf', $emailConfOptions, ['default'=>$emailConf,'empty' => 'Email configuré','class'=>'form-control', 'id' => 'emailConf']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $smsConfOptions = ['1' => 'Oui', '2' => 'Non'];
                                            echo $this->Form->select('smsConf', $smsConfOptions, ['default'=>$smsConf,'empty' => 'Sms configuré','class'=>'form-control', 'id' => 'smsConf']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $envoiConfOptions = ['1' => 'Oui', '2' => 'Non'];
                                            echo $this->Form->select('envoiConf', $envoiConfOptions, ['default'=>$envoiConf,'empty' => 'Envoi configuré','class'=>'form-control', 'id' => 'envoiConf']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $fbConfOptions = ['1' => 'Oui', '2' => 'Non'];
                                            echo $this->Form->select('fbAutoConf', $fbConfOptions, ['default'=>$fbAutoConf,'empty' => 'Facebook auto','class'=>'form-control', 'id' => 'fbAutoConf']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-r-0">
                                        <div class="form-group">
                                            <?php
                                                $photoExisteOptions = ['1' => 'Oui', '2' => 'Non'];
                                            echo $this->Form->select('photoExiste', $photoExisteOptions, ['default'=>$photoExiste,'empty' => 'Photo uploadée','class'=>'form-control', 'id' => 'photoExiste']);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php echo $this->Form->end(); ?>
                            </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--FIN Synthese, filtre-->
    </div>
    <div class="row kl_listing_event">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="m-b-30" id="id_eventListSwitcher">

                        <?php  if(!$passe && !empty($evenements->toArray())){?>
                            <div class="btn-group" data-toggle="buttons" role="group">
                                <label class="btn btn-outline btn-warnin active kl_vue_evenement btn_vu_event">
                                    <input type="radio" name="options" autocomplete="off" value="0" checked="">
                                    <i class="ti-check text-active" aria-hidden="true"></i> Vue évènement
                                </label>
                                <label class="btn btn-outline btn-warnin kl_vue_evenement btn_vu_config">
                                    <input type="radio" name="options" autocomplete="off" value="1">
                                    <i class="ti-check text-active" aria-hidden="true"></i> Vue configuration
                                </label>
                            </div>
                        <?php } ?>
                	
						<?php if(false){ ?>
                        <input type="checkbox" checked data-on-color="warning" data-off-color="danger" data-on-text="Vue événement"  data-off-text="Vue configuration"> 
						<?php } ?>
                	</div>
                    <?php 
                    if(!$passe){
                    ?>
                        <div class="">
                            <?php echo $this->element('Evenements/encours_termine',['evenements'=>$evenements]); ?>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div class="">
                            <?php echo $this->element('Evenements/avenir',['evenements'=>$evenements]); ?>
                        </div>
                        <div class="hide kl_vueConfiguration">
                            <?php echo $this->element('Evenements/encours_termine',['evenements'=>$evenements]); ?>
                        </div>
                    <?php 
                    }
                    ?> 
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<!-- MODAL ENVOI EMAIL GALERIE-->    
<?php //echo $this->element('Galeries/envoi_email'); ?>
<div class="modal fade" id="envoiEMail" tabindex="-1" role="dialog" aria-labelledby="envoiEMail1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="envoiEMail1">Envoi email </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <?php echo $this->Form->create(null, ['url'=>['controller'=>'Galeries', 'action'=>'sendgalerie'] ,'type' => 'post','role'=>'form']); ?>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_envoi_gal">Envoyer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
      
       

