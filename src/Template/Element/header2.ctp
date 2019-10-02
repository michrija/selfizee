<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<?= $this->Html->script('Evenements/search.js', ['block' => true]); ?>
<header class="topbar">

    <nav class="navbar bg-light navbar-light nav_bar top_navBar">
    

        <!-- Brand -->
        <div class="navbar-header">
            <?= $this->Html->link($this->Html->image('logo.png', ['alt' => 'Selfizee', "class"=>"kl_logoSelfizee"]), ['controller'=>'Evenements','action' => 'index'],['class'=>'navbar-brand','escapeTitle'=>false]) ?>
        </div>

            <?php
                $keyValue = !empty($key) ? $key : '';
                echo $this->Form->create(null, ['url' => ['controller'=>'Evenements', 'action' => 'index'], 'type' => 'get' ,'class'=>'form-inline mr-auto mt-md-0','id'=>'id_formSearch']);
                echo $this->Form->control('key',['value'=>$keyValue, 'label'=>false, 'class'=>'form-control mr-sm-2 rechreche_global','placeholder'=>'Rechercher...']);
                echo $this->Form->button('<i class="ti-search"></i>', ['label' => false ,'class' => 'srh-btn kl_btnSearch'] );
                //echo $this->Form->button('', ['label' => false ,'class' => 'srh-btn kl_btnSearch2'] );
                echo $this->Form->control('isGlobal',['value' => 1, 'type'=>'hidden']);
                echo $this->Form->end();
            ?>

            <div class="my-2 my-lg-0">
                
                <li class="nav-item dropdown" style="list-style-type: none;">
                <span><?php echo $this->Html->link('',['controller'=>'Evenements','action'=>'index'],['escape'=>false,"class"=>"btn_album","data-toggle"=>"tooltip","title"=>"Liste des événements"]); ?></span>
                <span><?php echo $this->Html->link('',['controller'=>'Evenements','action'=>'add'],['escape'=>false,"class"=>"btn_add_event","data-toggle"=>"tooltip", "title"=>"Ajouter un événement" ]); ?></span>
                <span class="separateur_btn"></span>
                    <?= $this->Html->image('users/1.png', ['alt' => 'User',"class"=>"profile-pic"]); ?>
                    <a class="nav-link dropdown-toggle0 text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:14px !important;font-weight:500;"><?php echo $this->request->getSession()->read('Auth.User.username')." <i class='fa fa-angle-down'></i>"; ?> </a>
                  
                    <div class="dropdown-menu float-right dropdown-menu-right animated flipInY" style="box-shadow: 0 1px 7px 2px rgba(135,158,171,.2);">
                        <div class="box-sm sous-menu">
                            <div class="login-box clearfix">
                                <div class="user-img">
                                    <?= $this->Html->image('users/1.png', ['alt' => 'User',"class"=>""]); ?>
                                </div>
                                <div class="user-info">
                                    <span><?php echo $this->request->getSession()->read('Auth.User.username'); ?> 
                                        <?php if(!empty($userConnected['client'])) { echo '<i>'.$userConnected['client']['nom'].'</i>' ;} ?>
                                    </span>
                                </div>
                            </div>
                            <div class="divider"></div>
                        
                            <ul class="reset-ul mrg5B">
                                <li>
                                    <?php $idUser = $this->request->getSession()->read('Auth.User.id'); ?>
                                        <?= $this->Html->link('<i class="ti-settings"></i> '.__('Account Setting'),['controller'=>'Users','action'=>'settings', $idUser] ,['escapeTitle'=> false,'class'=>'']) 
                                    ?>
                                </li>
                                <?php 
                                    if($userConnected['role_id'] == 2){ ?>
                                    <li><?php echo $this->Html->link('<i class="ti-settings"></i> Personnalisation ',['controller' => 'Clients', 'action' => 'view',$this->request->getSession()->read('Auth.User.client_id') ],['escapeTitle'=> false]); ?> </li>
                            <?php } ?>
                               
                                <?php 
                                    if($userConnected['role_id'] == 1){ ?>
                                    <li><?php echo $this->Html->link('<i class="ti-settings"></i> Paramètrage de bornes',['controller' => 'OptionBornes', 'action' => 'add'],['escapeTitle'=> false]); ?> 
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="divider"></div>
                        
                            <div class="button-pane button-pane-alt pad5L pad5R text-center">
                                <?= $this->Html->link('<i class="fa fa-power-off"></i> '.__('Déconnexion'),['controller'=>'Users','action'=>'logout'] ,['escapeTitle'=> false,'class'=>'btn btn-flat display-block font-normal btn-danger']) ?>
                            </div>
                        </div>
                    </div>
                </li>
            </div>


        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse kl_sousMenuNew" id="collapsibleNavbar">
                <ul class="navbar-nav">
                   
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="mdi mdi-table"></i> Evénements',['controller'=>'Evenements','action'=>'index'] ,['escapeTitle'=> false,'class'=>'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="mdi mdi-camera-burst"></i> Galeries',['controller'=>'Galeries','action'=>'index'] ,['escapeTitle'=> false,'class'=>'nav-link']) ?>
                    </li>
                    <?php if($userConnected['role_id'] == 1){ ?>
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="mdi mdi-account"></i> Clients',['controller'=>'Clients','action'=>'index'] ,['escapeTitle'=> false,'class'=>'nav-link']) ?>
                    </li>
                    <?php } ?>

                    <li class="nav-item">
                        <?= $this->Html->link('<i class="mdi mdi-view-grid"></i> Contact',['controller'=>'ContactServices','action'=>'index'] ,['escapeTitle'=> false,'class'=>'nav-link']) ?>
                    </li>
                </ul>
            </div>
    </nav>
    
    <?php if(!empty($evenement->id)) { ?>
    <div class="kl_sousMenu">
        <div class="kl_titreEvenementMenu">
            <?= $evenement->nom ?>
        </div>
        <div class="kl_header2MenuInterne row col-12">
                            <div class="col-md-6 kl_menu">
                                <ul class="kl_theSousMenu">
                                    <li>
                                        <?php
                                            $kl_Configuration = "active";
                                            $kl_Evenement = "";
                                            $kl_timeLine ="";
                                            if(empty($isConfiguration)){
                                                $kl_Configuration = "";
                                                $kl_Evenement = "active";
                                            }
                                            
                                            if(!empty($isTimeLinePage)){
                                                $kl_timeLine = "active";
                                                $kl_Configuration = "";
                                                $kl_Evenement = "";
                                                
                                            }
                                        ?>
                                        <?= $this->Html->link('Configuration',['controller'=>'Evenements','action'=>'edit', $evenement->id] ,['class'=>$kl_Configuration]) ?>
                                    </li>
                                    <li>
                                         <?= $this->Html->link('Evénement',['controller'=>'Evenements','action'=>'view', $evenement->id],['class'=>$kl_Evenement] ) ?>
                                    </li>
                                    
                                     <li>
                                         <?= $this->Html->link('Timeline',['controller'=>'Evenements','action'=>'timeline', $evenement->id],['class'=>$kl_timeLine] ) ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 ">
                                <div class="kl_infoEventAndGalerie">
                                    ID : <?= $evenement->id ?>  <?php if(!empty($evenement->galeries)){ ?>- GALERIE : <?= $evenement->galeries[0]->slug ?> <?php } ?>
                                </div>
                            </div>
                    </div>
    </div>
    <?php } ?>

</header>