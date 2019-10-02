<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <?php echo $this->Html->link('<i class="mdi mdi-gauge"></i><span class="hide-menu">Tableau de bord</span>',['controller' => 'Clients', 'action' => 'view', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>

                <li>
                    <?php //echo $this->Html->link('<i class="mdi mdi-settings"></i><span class="hide-menu">Personnalisation</span>',['controller' => 'ClientsCustoms', 'action' => 'add', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Personnalisation</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><?php echo $this->Html->link('Signature email',['controller' => 'ClientsSignaturesEmails', 'action' => 'add', $client->id]); ?> </li>
                        <li>
                            <?php echo $this->Html->link('<span class="hide-menu">Page souvenir</span>',['controller' => 'ClientsCustoms', 'action' => 'page_souvenir', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<span class="hide-menu">Galerie souvenir</span>',['controller' => 'ClientsCustoms', 'action' => 'galerie_souvenir', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?>
                        </li>
                        <li><?php //echo $this->Html->link('Téléchargement',['controller' => 'DownloadConfigurations', 'action' => 'create', $client->id]); ?> </li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Email</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Modèles</span>',['controller' => 'ClientsModelesEmails', 'action' => 'index', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                        <li><?php echo $this->Html->link('<span class="hide-menu">Adresses d\'expéditeurs</span>','#',['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-email-outline"></i><span class="hide-menu">Sms</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Modèles</span>',['controller' => 'ClientsModelesSmss', 'action' => 'index', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                        <li><?php echo $this->Html->link('<span class="hide-menu">Mes crédits</span>','#',['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-face-profile"></i><span class="hide-menu">Réseaux sociaux</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Mes pages Facebook</span>','#',['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-folder-multiple"></i><span class="hide-menu">Catalogue de mis en page</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Modèles</span>','#',['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Thématiques</span>','#',['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">Évenements</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Types</span>','#' ,['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                        <li> <?php echo $this->Html->link('<span class="hide-menu">Types de clients</span>','#' ,['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_sansEnfant' ]); ?> </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  
</aside>