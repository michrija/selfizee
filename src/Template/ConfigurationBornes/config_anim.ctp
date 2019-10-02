<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->css('ConfigBornes/config_anim.css', ['block' => true]) ?>
<?= $this->Html->css('ConfigBornes/jquery.steps.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/config_anim.js', ['block' => true]); ?>

<div class="col-md-12">
        <div class="card">
            <div class="card-body p-b-0">
            <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab2 cf_anim_tab no-margin p-t-20 sf-bg-gris" role="tablist">
                    <li class="nav-item carte_postale_paysage">
                        <a class="nav-link active show" data-toggle="tab" href="#carte_postale_paysage" role="tab" aria-selected="true">
                            <span class="num_tab" >1</span>
                            <img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">
                            <span class="icon_check_tab">
                                <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                            </span>
                            <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                            <span class="hidden-xs-down"  style="margin-left: -15px;">Carte postale paysage</span>
                        </a> 
                    </li>

                    <li class="nav-item carte_postale_portrait ">
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
                    
                    <li class="nav-item marque_page">
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

                    <li class="nav-item palaroid">
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

                    <li class="nav-item carte_postale_multishoot">
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
                </ul>

                <!-- Tab panes -->
                
                <div class="tab-content">
                    <div class="tab-pane active show" id="carte_postale_paysage" role="tabpanel"> <!--  active show -->
                        <?php echo $this->element('ConfigBornes/carte_postale_paysage'); ?>
                    </div>
                    <div class="tab-pane p-20" id="carte_postale_portrait" role="tabpane1">
                        <!--<h3>;)</h3> -->
                        <?php echo $this->element('ConfigBornes/carte_postale_portrait'); ?>
                    </div>
                    
                    <div class="tab-pane p-20" id="marque_page" role="tabpanel">
                            <!--<h3>;)</h3> -->
                        <?php echo $this->element('ConfigBornes/marque_page'); ?>
                    </div>
                    
                    <div class="tab-pane p-20" id="palaroid" role="tabpanel">
                            <!--<h3>;)</h3> -->
                        <?php echo $this->element('ConfigBornes/palaroid'); ?>
                    </div>
                    
                    <div class="tab-pane p-20" id="carte_postale_multishoot" role="tabpanel">
                            <!--<h3>;)</h3> -->
                        <?php echo $this->element('ConfigBornes/carte_postale_multishoot'); ?>
                    </div>
                </div>
            </div>
        </div>
</div>