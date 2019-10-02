<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>
<div class="sf-step no-padding cf_option_tab_anim">
    <div class="card">
        <div class="card-body p-l-15 p-r-15 no-padding-top no-padding-bottom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab2 cf_anim_tab no-margin p-t-20 sf-bg-gris hide" role="tablist">
                <li class="nav-item carte_postale_paysage cf_anim_tab_1 hide" id="id_cf_anim_tab_1" data-owner="1">
                    <a class="nav-link" data-toggle="tab" href="#carte_postale_paysage" role="tab" aria-selected="true">
                        <span class="num_tab" >1</span>
                        <img src="/img/confbornes/animations/animation-1.png" alt="" width="60px">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"  style="margin-left: -15px;">Carte postale paysage</span>
                    </a> 
                </li>

                <li class="nav-item carte_postale_portrait cf_anim_tab_2 hide" id="id_cf_anim_tab_2" data-owner="2">
                    <a class="nav-link" data-toggle="tab" href="#carte_postale_portrait" role="tab" aria-selected="true">
                        <span class="num_tab" >2</span>
                        <!--<img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">-->
                        <img src="/img/confbornes/animations/animation-2.png" alt="" width="37px">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"  style="margin-left: -15px;">Carte postale portrait</span>
                    </a>
                </li>
                
                <li class="nav-item marque_page cf_anim_tab_3 hide" id="id_cf_anim_tab_3" data-owner="3">
                    <a class="nav-link" data-toggle="tab" href="#marque_page" role="tab" aria-selected="true">
                        <span class="num_tab" >3</span>
                        <!--<img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">-->
                        <img src="/img/confbornes/animations/animation-3.png" alt="" width="39px">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"  style="margin-left: -15px;">Marque page</span>
                    </a>
                </li>

                <li class="nav-item palaroid cf_anim_tab_4 hide" id="id_cf_anim_tab_4" data-owner="4">
                    <a class="nav-link" data-toggle="tab" href="#palaroid" role="tab" aria-selected="true">
                        <span class="num_tab" >4</span>
                        <!--<img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">-->
                        <img src="/img/confbornes/animations/animation-4.png" alt="" width="37px">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"  style="margin-left: -15px;">Palaroid</span>
                    </a>
                </li>

                <li class="nav-item carte_postale_multishoot cf_anim_tab_5  hide" id="id_cf_anim_tab_5" data-owner="5">
                    <a class="nav-link" data-toggle="tab" href="#carte_postale_multishoot" role="tab" aria-selected="false">
                        <span class="num_tab" >5</span>
                        <!--<img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">-->
                        <img src="/img/confbornes/animations/animation-5.png" alt="" width="60px">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-user"></i></span>
                        <span class="hidden-xs-down"  style="margin-left: -15px;">Carte postale multishoot</span>
                    </a> 
                </li>

                <li class="nav-item add_animation cf_anim_tab_6 hide" id="id_cf_anim_tab_6" data-owner="">
                    <a class="nav-link" data-toggle="tab" href="#add_animation" role="tab" aria-selected="true">
                        <span class="num_tab" >1</span>
                        <img src="/img/confbornes/animations/animation-1.png" alt="" width="60px"  class="img_anim">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"  style="margin-left: -15px;" id="titre_anim_tab">Carte postale paysage</span>
                    </a> 
                </li>

            </ul>

            <!-- Tab panes -->
            
            <div class="tab-content cf_anim_content">	

                <!-- Tab ajout nouv -->
                <div class="tab-pane p-20 cf_anim_tab_content_6" id="add_animation" role="tabpanel">
                        <!--<h3>;)</h3> -->
                    <?php echo $this->element('ConfigBornes/add_animation'); ?>
                </div>
                <!-- Fin Tab ajout nouv  -->

                <div class="tab-pane p-20 cf_anim_tab_content_1" id="carte_postale_paysage" role="tabpanel">  <!--  active show -->
                    <?php echo $this->element('ConfigBornes/carte_postale_paysage'); ?>
                </div>
                <div class="tab-pane p-20 cf_anim_tab_content_2" id="carte_postale_portrait" role="tabpane2">
                    <!--<h3>;)</h3> -->
                    <?php echo $this->element('ConfigBornes/carte_postale_portrait'); ?>
                </div>
                
                <div class="tab-pane p-20 cf_anim_tab_content_3" id="marque_page" role="tabpanel">
                        <!--<h3>;)</h3> -->
                    <?php echo $this->element('ConfigBornes/marque_page'); ?>
                </div>
                
                <div class="tab-pane p-20 cf_anim_tab_content_4" id="palaroid" role="tabpanel">
                        <!--<h3>;)</h3> -->
                    <?php echo $this->element('ConfigBornes/palaroid'); ?>
                </div>
                
                <div class="tab-pane p-20 cf_anim_tab_content_5" id="carte_postale_multishoot" role="tabpanel">
                        <!--<h3>;)</h3> -->
                    <?php echo $this->element('ConfigBornes/carte_postale_multishoot'); ?>
                </div>

                <?php echo $this->element('ConfigBornes/bloc_prise_filtre_fondvert'); ?>
            </div>
            
        </div>
    </div>
</div>