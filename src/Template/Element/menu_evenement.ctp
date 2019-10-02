<aside class="left-sidebar sansShadow">
    
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="kl_sideMenuEvenement">
                <?php if($idEvenement != 2403){ ?>
                <li> 
                    <?php echo $this->Html->link('<i class="mdi mdi-gauge"></i><span class="hide-menu">Tableau de bord</span>',['controller' => 'Evenements', 'action' => 'view', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
				<?php } ?>
                
                <?php if($userConnected['is_active_acces_affichage_photo']){ ?>
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-image"></i><span class="hide-menu">Photos</span>',['controller' => 'Photos', 'action' => 'liste', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                <?php } ?>

                <?php if($userConnected['is_active_acces_data']){ ?>
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-email"></i><span class="hide-menu">Contacts</span>',['controller' => 'Contacts', 'action' => 'formulaire', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                <?php } ?>
                
                <?php if($userConnected['is_active_acces_send_email'] == true || $userConnected['is_active_acces_send_sms'] == true) { ?>
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-send"></i><span class="hide-menu">Envoi email & sms</span>',['controller' => 'Crons', 'action' => 'manuel', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                <?php } ?>
                
                <?php if($userConnected['is_active_acces_stat']){ ?>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Statistiques</span></a>
                    <ul aria-expanded="false" class="collapse">

                        <?php if($userConnected['is_active_acces_data']){ ?>
                            <li><?php echo $this->Html->link('Détail',['controller' => 'Contacts', 'action' => 'liste', $idEvenement]); ?> </li>
                        <?php } ?>
                        <li><?php echo $this->Html->link('Email',['controller' => 'Statistiques', 'action' => 'email', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Sms',['controller' => 'Statistiques', 'action' => 'sms', $idEvenement]); ?> </li>
                        <?php if($userConnected['role_id'] == 1) { ?>
                            <li><?php echo $this->Html->link('Démographie',['controller' => 'Statistiques', 'action' => 'demographie', $idEvenement]); ?> </li>
                            <li><?php //echo $this->Html->link('Galerie souvenir',['controller' => 'Statistiques', 'action' => 'geographique', $idEvenement]); ?> </li>
                            <li><?php echo $this->Html->link('Page souvenir',['controller' => 'Statistiques', 'action' => 'statGeographique', $idEvenement]); ?> </li>
                            <li><?php echo $this->Html->link('Récapitulatif',['controller' => 'Statistiques', 'action' => 'recapGraphique', $idEvenement]); ?> </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
               
               
                <!-- <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-chart-timeline"></i><span class="hide-menu">Timeline</span>',['controller' => 'Evenements', 'action' => 'timeline', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>-->
                
                <!--<li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Utilisateurs</span></a>
                </li>-->
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  
</aside>