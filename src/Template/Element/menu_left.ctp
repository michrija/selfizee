<!-- fullBase: pour activer la coloration des menu&sous-menu -->

<nav class="kl_navCustom menu" >

    <ul id="id_menuLeftList">
        <?php if($userConnected['is_active_acces_config']){ ?>
        <li class="li-menu <?= $this->request->getParam('action') == 'edit' || $controller  == 'Configurations' ? 'li-active' : ''; ?>">
            <?php 
                echo $this->Html->link('Configuration',['controller' => 'Configurations', 'action' => 'board', $idEvenement], ['fullBase' => true,]); 
            ?> 
            <?php 
            //debug($isConfiguration);
            if(!empty($isConfiguration)){ ?>
            <ul class="inner-menu">
                <li>
                   <?php 
                    echo  $this->Html->link('Borne',
                        ['controller'=>'ConfigurationBornes','action' => "add", $idEvenement, ],
                        ['fullBase' => true]
                    ); 
                    ?>
                </li>
                <?php 
                if(!empty($evenement->fonctionnalites)){
                foreach($evenement->fonctionnalites as $fonctionnlite){
                if($fonctionnlite->show_in_menu){ ?>
                <li>
                    <?php 
                    echo $this->Html->link(
                        $fonctionnlite->titre_link,
                        '/'.$fonctionnlite->link.$idEvenement,
                        ['fullBase' => true]
                    ); 

                    ?>

                </li>
                <?php }}} ?>
            </ul>
            <?php } ?>
        </li>
        <?php } ?>
        <li class="li-menu">
            <?php 
                echo $this->Html->link('Evénement',['controller' => 'Evenements', 'action' => 'board', $idEvenement], ['fullBase' => true]); 
            ?>
            <?php if(empty($isConfiguration)){ ?>
            <ul class="inner-menu">
                <?php if($userConnected['is_active_acces_affichage_photo']){ ?>
                    <li>
                        <?php 
                            echo $this->Html->link('Photos',['controller' => 'Photos', 'action' => 'liste', $idEvenement], ['fullBase' => true]); 
                        ?>
                    </li>
                <?php } ?>

                <?php if($userConnected['is_active_acces_data']){ ?>
                    <li class="<?= in_array($controllerAction, ['Contacts/liste']) ? 'degrade-sousmenu' : ''  ?>">
                        <?php 
                            echo $this->Html->link('Contacts',['controller' => 'Contacts', 'action' => 'formulaire', $idEvenement], ['fullBase' => true]); 
                        ?>
                    </li>
                <?php } ?>

                <?php  
                if(!empty($evenement->fonctionnalites)){
                foreach($evenement->fonctionnalites as $fonctionnlite){ ?>
                    <?php if($fonctionnlite->id == 1 && $userConnected['is_active_acces_stat']){ ?>
                        <li>
                             <?php 
                                echo $this->Html->link('Stat E-mail',['controller' => 'Statistiques', 'action' => 'email', $idEvenement], ['fullBase' => true]); 
                            ?>
                        </li>
                    <?php } ?>

                    <?php if($fonctionnlite->id == 2 && $userConnected['is_active_acces_stat']){ ?>
                        <li>
                             <?php 
                                echo $this->Html->link('Stat Sms',['controller' => 'Statistiques', 'action' => 'sms', $idEvenement], ['fullBase' => true]); 
                            ?>
                        </li>
                    <?php } ?>
                <?php } } ?>

                <?php if($userConnected['is_active_acces_stat']){ ?>
                    <li>
                        <?php 
                            echo $this->Html->link('Stat démographique',['controller' => 'Statistiques', 'action' => 'demographie', $idEvenement], ['fullBase' => true]); 
                        ?>
                    </li>
                <?php } ?>

            </ul>
            <?php } ?>
        </li>
        <?php if($userConnected['role_id'] == 1){ ?>
            <li class="li-menu">
                <?php 
                    echo $this->Html->link('Accès',['controller' => 'Evenements', 'action' => 'acces', $idEvenement], ['fullBase' => true]); 
                ?>
            </li>
        <?php } ?>

        <li class="li-menu">
            <?php 
                echo $this->Html->link('Timeline',['controller' => 'Evenements', 'action' => 'timeline', $idEvenement], ['fullBase' => true]); 
            ?>
        </li>



    </ul>
</nav>