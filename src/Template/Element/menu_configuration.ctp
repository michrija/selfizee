<aside class="left-sidebar sansShadow">
    
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="kl_sideMenuConfiguration">
               
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-gauge"></i><span class="hide-menu">Tableau de bord</span>',['controller' => 'Configurations', 'action' => 'board', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                
                
                <li><?php echo $this->Html->link('<i class="mdi mdi-information-outline"></i><span class="hide-menu">Informations</span>',['controller' => 'Evenements', 'action' => 'edit', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant']); ?> </li>
                        
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-google-pages"></i><span class="hide-menu">Borne</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <!--<li><?php echo $this->Html->link('Récapitulatif',['controller' => 'ConfigurationBornes', 'action' => 'recapitulatif', $idEvenement]); ?> </li>-->
                        <li><?php echo $this->Html->link('Configuration',['controller' => 'ConfigurationBornes', 'action' => 'add', $idEvenement]); ?> </li>
                    </ul>
                </li>
                <li>
                     <?php echo $this->Html->link('<i class="mdi mdi-google-photos"></i><span class="hide-menu">Galerie Souvenir</span>',['controller' => 'Galeries', 'action' => 'add', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">E-mail & Sms</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><?php echo $this->Html->link('E-mail',['controller' => 'EmailConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                        <?php if($userConnected['role_id'] == 1) { ?>
                            <li>
                            <?php echo $this->Html->link('Erreur e-mail',['controller' => 'NomDeDomaines', 'action' => 'erreuremail', $idEvenement]); ?> </li>
                            <?php } ?>
                        <li><?php echo $this->Html->link('Sms',['controller' => 'SmsConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Page souvenir',['controller' => 'PageSouvenirs', 'action' => 'add', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Plannification',['controller' => 'Crons', 'action' => 'add', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Réseaux sociaux',['controller' => 'RsConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Formulaire',['controller' => 'CsvColonnePositions', 'action' => 'liste', $idEvenement]); ?> </li>
                    </ul>
                </li>
                
                <li>
                     <?php echo $this->Html->link('<i class="mdi mdi-facebook-box"></i><span class="hide-menu">Publication facebook</span>',['controller' => 'FacebookAutos', 'action' => 'liste', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-content-paste"></i><span class="hide-menu">Gestion de contenus</span>',['controller' => 'EvenementPosts', 'action' => 'liste', $idEvenement],['escapeTitle'=>false, 'class'=>'kl_sansEnfant' ]); ?>
                </li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  
</aside>