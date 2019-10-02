<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->css('ConfigBornes/config_anim.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/config_anim.js', ['block' => true]); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-body p-b-0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab2 cf_anim_tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab" href="#tab1" role="tab" aria-selected="true">
                        <span class="num_tab" >1</span>
                        <img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">
                        <span class="icon_check_tab">
                            <img src="/img/gallery/icons8-checked_2.png" alt="" width="">
                        </span>
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"  style="margin-left: -15px;">Carte postale paysage</span>
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-selected="false">
                        <span class="num_tab" >2</span>
                        <img src="/img/gallery/carte_postale_paysage.png" alt="" width="60px">
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
                <div class="tab-pane active show" id="tab1" role="tabpanel">
                    <!-- <div class="p-20">
                        <h3>Best Clean Tab ever</h3>
                        <h4>you can use it with the small code</h4>
                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                    </div>-->
                    <?php echo $this->element('ConfigBornes/config_animation_cadre'); ?>
                </div>
                <div class="tab-pane p-20" id="tab2" role="tabpanel">
                    <h3>;)</h3>
                    <?php //echo $this->element('ConfigBornes/config_animation_cadre_edit'); ?>
                </div>
            </div>
        </div>
    </div>
</div>