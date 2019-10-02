<aside class="left-sidebar sansShadow">
    
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-gauge"></i><span class="hide-menu">Tableau de bord</span>',['controller' => 'Evenements', 'action' => 'view', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Statistiques</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><?php echo $this->Html->link('Email',['controller' => 'Statistiques', 'action' => 'email', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Sms',['controller' => 'Statistiques', 'action' => 'sms', $idEvenement]); ?> </li>
                    </ul>
                </li>
               
               <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Configuration</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><?php echo $this->Html->link('Personnalisation',['controller' => 'Evenements', 'action' => 'edit', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Galerie souvenir',['controller' => 'Galeries', 'action' => 'add', $idEvenement]); ?> </li>
                        <li><?php echo $this->Html->link('Bornes',['controller' => 'ConfigurationBornes', 'action' => 'add', $idEvenement]); ?> </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Data</span></a>
                    <ul aria-expanded="false" class="collapse">
                         <li><?php echo $this->Html->link('Page souvernir',['controller' => 'PageSouvenirs', 'action' => 'add', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('E-mail',['controller' => 'EmailConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Sms',['controller' => 'SmsConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Envoi automatique',['controller' => 'Crons', 'action' => 'add', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Envoi manuel',['controller' => 'Crons', 'action' => 'manuel', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Réseaux sociaux',['controller' => 'RsConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Téléchargement',['controller' => 'DownloadConfigurations', 'action' => 'add', $idEvenement]); ?> </li>
                    </ul>
                </li>
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-image"></i><span class="hide-menu">Photos</span>',['controller' => 'Photos', 'action' => 'liste', $idEvenement,'?'=>['queue' => time()]],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-email"></i><span class="hide-menu">Contacts</span>',['controller' => 'Contacts', 'action' => 'liste', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-facebook-box"></i><span class="hide-menu">Facebook</span></a>
                    <ul aria-expanded="false" class="collapse">
                         <li><?php echo $this->Html->link('Publication automatique',['controller' => 'FacebookAutos', 'action' => 'liste', $idEvenement]); ?> </li>
                         <li><?php echo $this->Html->link('Formulaire',['controller' => 'CsvColonnePositions', 'action' => 'add', $idEvenement]); ?> </li>
                    </ul>
                </li>
                
                 <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-chart-timeline"></i><span class="hide-menu">Timeline</span>',['controller' => 'Evenements', 'action' => 'timeline', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>
                
                <!--<li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Utilisateurs</span></a>
                </li>-->
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  
</aside>