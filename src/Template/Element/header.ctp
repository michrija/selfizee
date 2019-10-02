<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->



<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light top_navBar">
        
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
            <button class="navbar-toggler d-inline m-l-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="navbar-header">

            <!-- navbar-toggler -->
            
			<?php if($userConnected['role_id'] != 5){

                $logo = 'logo-noir.png';
                if(isset($userConnected['client'])){
                    $client = $userConnected['client'];
                    if(!empty($client->logo_page_bo)){
                        $logo = $client->url_logo_page_bo;
                    }
                }


                //debug($logo);

				echo $this->Html->link($this->Html->image($logo, ['alt' => 'Selfizee', "class"=>"kl_logoSelfizee"]), ['controller'=>'Evenements','action' => 'index'],['class'=>'navbar-brand','escapeTitle'=>false]);
			} else{ 
			?>
                <a href="#" class="navbar-brand d-inline"><img src="/img/logo.png?1535697890" alt="Selfizee" class="kl_logoSelfizee"></a>
            <?php } ?>

				
		</div>

        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0 ">
                <!-- This is  -->
				<?php if($userConnected['role_id'] != 5){ ?>
                <li class="nav-item hidden-sm-down">
                    <?php
                    $keyValue = !empty($key) ? $key : '';
                    echo $this->Form->create(null, ['url' => ['controller'=>'Evenements', 'action' => 'index'], 'type' => 'get' ,'class'=>'form-inline mr-auto mt-md-0','id'=>'id_formSearch']);
                    // echo $this->Form->control('key',['value'=>$keyValue, 'label'=>false, 'class'=>'form-control mr-sm-2 rechreche_global','placeholder'=>'Rechercher...']);
                    // echo $this->Form->button('<i class="ti-search"></i>', ['label' => false ,'class' => 'srh-btn kl_btnSearch'] );
                    //echo $this->Form->button('', ['label' => false ,'class' => 'srh-btn kl_btnSearch2'] );
                    echo $this->Form->control('isGlobal',['value' => 1, 'type'=>'hidden']);
                    echo $this->Form->end();
                    ?>
                </li>
				<?php } ?>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0 kl_customLink">

                <?php if($userConnected['role_id'] != 5){ // Cacher qlq menu pour user event ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark tooltipeTimeline" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Timeline générale" data-placement="left"> <i class="mdi mdi-bell-outline"></i>
                            <!--<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>-->
                        </a>
                        
                        <div class="dropdown-menu mailbox animated bounceInDown kl_notificationTimeLine">
                                                
                            <ul>

                             
                                <li>
                                    <div class="drop-title">Timeline</div>
                                </li>
                    
                                
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <?php 
                                        foreach($notifications as $timeline){ 
                                           if(!empty($timeline->date_timeline)){ 
                                            
                                            $depuis ="";
                                            if($timeline->source_timeline == 'bo' ){
                                                $depuis = "depuis l'espace administration";
                                            }else if($timeline->source_timeline == 'auto' || $timeline->source_timeline == 'upload') {
                                                $depuis = " depuis la borne";
                                            }else if($timeline->source_timeline == 2){
                                                $depuis = "depuis la galerie souvenir";
                                            }
                                            
                                            //debug($timeline->date_timeline);
                                            $source = "";
                                            //debug($timeline->type_timeline);
                                            switch ($timeline->type_timeline) {
                                                case 1: // upload photo
                                                    $source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
                                                    break;
                                                case 2: //contact
                                                    $source = $timeline->nbr > 1 ? "contacts uploadés" : "contact uploadé";
                                                    break;
                                                case 3: // envoi email
                                                    $source = $timeline->nbr > 1 ? "email envoyés" : "email envoyé";
                                                    break;
                                                case 4 : // sms envoyé
                                                    $source = $timeline->nbr > 1 ? "sms envoyés" : "sms envoyé";
                                                    break;
                                                case 5 :
                                                    $source = $timeline->nbr > 1 ? "photos supprimées" : "photo supprimée";
                                                    break;
                                                case 6 :
                                                    $source = 'connexion de la galerie souvenir';
                                                    
                                                    break;
                                                case 7:
                                                    $source = $timeline->nbr > 1 ? "téléchargements photo" : "téléchargement photo";
                                                    break;
                                                case 8:
                                                    $source = $timeline->nbr > 1 ? "téléchargements de tous les média" : "téléchargement de tous les média";
                                                    $depuis = "depuis la galerie souvenir";
                                                    break;
                                                case 9:
                                                    $source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
                                                    $depuis = "automatiquement sur facebook";
                                                    break;
                                            }
                                        ?>
                                        <a href="/evenements/timeline/<?= $timeline->evenement->id ?>">
                                            <div class="mail-desc clearfix">
                                                <span class="kl_theEnventNameInNoitif"><?= $timeline->evenement->slug ?></span> <?= ": ".$timeline->nbr." ". $source ?>
                                                <span class="notification-time">
                                                    <?= $timeline->date_timeline->format('d/m/Y - H:i') ?> <span class="fa fa-clock-o"></span>
                                                </span> 
                                            </div>
                                        </a>
                                        <?php }} ?>
                                        
                                    </div>
                                </li>
                                <li>
                                    <?php echo $this->Html->link('<strong>Voir tous </strong> <i class="fa fa-angle-right"></i>',['controller'=>'Evenements','action'=>'timeline'],['escape'=>false,"class"=>"nav-link text-center kl_voirouts"]); ?>
                                </li>
                            </ul>
                        </div>
    				</li>


                    <?php if ($userConnected['role_id'] == 7 && $userConnected['is_active_acces_event'] == true): ?>
                        <li class="nav-item dropdown">
                            <?php echo $this->Html->link('<span class="kl_theBgEvenementAdd"></span>',['controller'=>'Evenements','action'=>'index'],['escape'=>false,"class"=>"nav-link kl_iconListeEvenement","data-toggle"=>"tooltip","title"=>"Liste des événements"]); ?>
                        </li>
                    <?php elseif($userConnected['role_id'] != 7): ?>
                        <li class="nav-item dropdown">
                            <?php echo $this->Html->link('<span class="kl_theBgEvenementAdd"></span>',['controller'=>'Evenements','action'=>'index'],['escape'=>false,"class"=>"nav-link kl_iconListeEvenement","data-toggle"=>"tooltip","title"=>"Liste des événements"]); ?>
                        </li>
                    <?php endif ?>
                    
                    <!-- On affiche que si que role == acces client && acces event activé  -->
                    <?php if ($userConnected['role_id'] == 7 && $userConnected['is_active_acces_creation_event'] == true): ?>
                        <li class="nav-item dropdown">
                            <?php echo $this->Html->link('<span class="kl_theBgEvenementList"></span>',['controller'=>'Evenements','action'=>'add'],['escape'=>false,"class"=>"nav-link kl_btn_add_event","data-toggle"=>"tooltip", "title"=>"Ajouter un événement" ]); ?>
                        </li>
                    <?php elseif($userConnected['role_id'] != 7): ?>
                        <li class="nav-item dropdown">
                            <?php echo $this->Html->link('<span class="kl_theBgEvenementList"></span>',['controller'=>'Evenements','action'=>'add'],['escape'=>false,"class"=>"nav-link kl_btn_add_event","data-toggle"=>"tooltip", "title"=>"Ajouter un événement" ]); ?>
                        </li>
                    <?php endif ?>
                    
    				
    				<?php 
    					/*
    					 * Début
    					 * Projet : Supprimer sous menu et mettre en icones
    					 * url : https://trello.com/c/L2yYagFv/365-supprimer-sous-menu-et-mettre-en-icones
    					 * date de modification : 18-fév-2019
    					 * 
    					 * author: Paul
    					 */
    				?>

                    <?php if ($userConnected['role_id'] != 7 ): // Cacher qlq menu pour access client idem event ?>
                        <li class="nav-item dropdown" >
                            <?php echo $this->Html->link('<i class="mdi mdi-camera-burst"></i>',['controller'=>'Galeries','action'=>'index'],['escape'=>false,"class"=>"nav-link kl_iconListeEvenement","data-toggle"=>"tooltip", 'data-placement' => 'bottom', "title"=>"Liste des galeries"]); ?>
                        </li>
                    <?php endif ?>
                    
    				<?php if($userConnected['role_id'] == 1){ ?>
                    <li class="nav-item dropdown">
                        <?php echo $this->Html->link('<i class="mdi mdi-account"></i>',['controller'=>'Clients','action'=>'index'],['escape'=>false,"class"=>"nav-link kl_btn_add_event","data-toggle"=>"tooltip", 'data-placement' => 'bottom',  "title"=>"Liste des clients" ]); ?>
                    </li>
    				<?php } ?>
    				<?php 
    					/*
    					 * FIN
    					 */
    				?>
                <?php } ?>
				
                <li class="nav-item dropdown">
                    <?php echo $this->Html->link('<span class=""><i class="mdi mdi-contact-mail"></i></span>',['controller'=>'ContactServices','action'=>'index'],['escape'=>false,"class"=>"nav-link kl_btn_add_event","data-toggle"=>"tooltip", "title"=>"Contact assistance" ]); ?>
                </li>
                <li class="nav-item kl_seperateur"></li>
                <li class="nav-item kl_theName sf_sous_menu">
                     <?php //echo $this->Html->image('users/1.png', ['alt' => 'User',"class"=>"profile-pic"]); ?>
                    <a class="nav-link dropdown-toggle0 text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=""><?php  echo $this->request->getSession()->read('Auth.User.username')." <i class='fa fa-navicon fa-lg'  style=''></i>"; ?> </a> <!-- angle-down-->
                    <?php //debug($this->request->getSession()->read('Auth.User.client'));die; ?>
                    <div class="dropdown-menu float-right dropdown-menu-right animated flipInY" style="">
                        <div class="box-sm sous-menu">
                            <div class="login-box">
                                <!--<div class="user-img hide">
                                    <?php //Echo $this->Html->image('users/1.png', ['alt' => 'User',"class"=>""]); ?>
                                </div> -->
                                <div class="user-info">
                                    <span><?php echo $this->request->getSession()->read('Auth.User.username'); ?> 
                                        <?php if(!empty($userConnected['client'])) { echo '<i>'.$userConnected['client']['nom'].'</i>' ;} ?>
                                    </span>
                                    <?php //if(!empty($userConnected['client'])) { ?>
                                        <?php // echo $this->Html->link(__('Edit profile'),['controller'=>'Clients','action'=>'editProfile', $userConnected['client']['id']] ,['escapeTitle'=> false,'class'=>'']) 
                                    ?>
                                    <?php //} ?>
                                </div>
                            </div>
                            <div class="divider divider_sous_menu" ></div>
                            
                            <?php if($userConnected['role_id'] != 5){ ?>
                                <ul class="reset-ul mrg5B">
                                    <li>
                                        <?php $idUser = $this->request->getSession()->read('Auth.User.id'); ?>
                                            <?= $this->Html->link(__('Mon compte'),['controller'=>'Users','action'=>'board'] ,['escapeTitle'=> false,'class'=>'']);//Account Setting
                                        ?>
                                    </li>
                                    <?php 
                                        if($userConnected['role_id'] == 2){ ?>
                                        <li><?php echo $this->Html->link('Personnalisation ',['controller' => 'Clients', 'action' => 'view',$this->request->getSession()->read('Auth.User.client_id') ],['escapeTitle'=> false]); ?> </li>
                                        <?php if ($is_active_add_client == true): ?>
                                            <li><?php echo $this->Html->link('Gestion accès ',['controller' => 'Clients', 'action' => 'acces-list'],['escapeTitle'=> false]); ?> </li>
                                        <?php endif  ?>
                                    <?php } ?>
                                   
                                    <?php 
                                        if($userConnected['client_id'] == 1){ ?>
                                        <li><?php echo $this->Html->link('Paramètrage de bornes ',['controller' => 'OptionBornes', 'action' => 'add'],['escapeTitle'=> false]); ?> 
                                        </li>
                                        <li><?php echo $this->Html->link('Paramètrage email accès ',['controller' => 'Users', 'action' => 'settingsEmailAcces'],['escapeTitle'=> false]); ?> 
                                        </li>
                                    <?php } ?>
                                    <li><a href="<?= $this->Url->build(['controller'=>'clients']) ?>" class="">Utilisateurs</a> </li>

                                    <li><a href="<?= $this->Url->build(['controller'=>'clients','action' =>'board']) ?>" class="">Personnalisation</a></li>

                                    <?php if(!empty($userConnected['client_id']) && $userConnected['client_id'] == 1 ) { ?> 
                                        <!--<li>
                                            <?php //echo $this->Html->link('Catégorie d\'événement ',['controller' => 'TypeEvenements', 'action' => 'index'],['escapeTitle'=> false]); ?> 
                                        </li> -->
                                        <li>
                                            <?php echo $this->Html->link('E-mail expéditeur',['controller' => 'Expediteurs', 'action' => 'index'],['escapeTitle'=> false]); ?> 
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <div class="divider divider_sous_menu" ></div>

                            <ul class="reset-ul mrg5B">
                                <li><a href="<?= $this->Url->build(['controller'=>'ContactServices','action'=>'index']) ?>" class="">Contact support</a> </li>
                                <li><a href="#">Aide</a></li>
                            </ul>

                            <div class="divider divider_sous_menu" ></div>
                            
                            <div class="bloc_btn_logout">
                                <?= $this->Html->link('<i class="fa fa-power-off"></i> '.__('Se déconnecter'),['controller'=>'Users','action'=>'logout'] ,['escapeTitle'=> false,'class'=>'btn  display-block btn-danger btn_logout']) ?>
                            </div>
                        </div>
                    </div>
                </li>
                
				<?php if(false){ ?>
                <li class="nav-item">
                    <button class="navbar-toggler" id="id_toshwosousmenu" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                </li>
				<?php } ?>
                
                
            </ul>
            
            
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->

