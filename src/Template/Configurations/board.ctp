<?= $this->Html->css('configurations/board.css', ['block' => true]) ?>
<div class="row">
    <div class="col-md-12">
        	<div class="card card-outline-info">
        		<div class="row kl_titreBlocCadre">
        			<div class="col-md-6 kl_theTitreCadreBlock">Paramètrage borne</div>
        			<div class="col-md-6 kl_theActionIntitre kl_theActonTitreInBoard">
                    <?php if(!empty($configurationBorne)){ ?>
                        <?php echo ($configurationBorne->modified != null ? '<span>Dernière mise à jour le : '.$configurationBorne->modified->format('d/m/Y à H\hi').'</span>' : '');?>
                    <?php } ?>
                     </div>
        		</div>
            	<div class="card-body">
            		<div class="row ">
            			<div class="kl_titreAndDescriptionConf col-md-9">
                            <div class="kl_titreWithIconChecked <?= !empty($configurationBorne) ? 'checked' :'unchecked' ?> ">
                                        <i class="fa fa-check-circle<?= !empty($configurationBorne) ? '' :'-o' ?>"></i>
            				<!--<div class="kl_titreWithIconChecked checked">
            					<i class="fa fa-check-circle"></i>--> Configuration événement
            				</div>
            			</div>
            			<div class="kl_actionBtnConf col-md-3">
                            <?php
                            echo $this->Html->link(
                                'Configurer',
                                ['controller' => 'ConfigurationBornes', 'action' => 'add', $idEvenement],
                                ['escape' => false,'class' => 'btn btn-customSelfizee']
                            );
                            ?>
            			</div>
            		</div>
            		<div class="kl_recapAndCode row col-md-12">
            				<div class="kl_codeBorne col-3">
            					<div class="kl_titreCodeBorne">Code Logiciel</div>
            					<div class="kl_theCodeBorneValue"><?= $evenement->code_logiciel ?></div>
            				</div>
            				<div class="col-md-9 kl_recapCode">
            					<div class="kl_titreRecap">Récap config</div>
            					<div class="kl_detailRecap">
                                <?php if(!empty($configurationBorne)){ ?>
                                    <span class="kl_keyDesc">Type animation :</span>
                                    <?php if(!empty($configurationBorne->type_animations)) { 
                                        foreach($configurationBorne->type_animations as $typeAnimation){
                                    ?>
                                        <span class="kl_valueDesc"><?= $typeAnimation->nom .' '.$typeAnimation->description ?></span>
                                    <?php } } ?>
                                    <span class="kl_keyDesc"> - Prise de coordonnées : </span><?= $configurationBorne->is_prise_coordonnee ? '<span class="kl_valueDesc kl_actif " >activée</span>' : '<span class="kl_valueDesc kl_inactif ">non activée</span>' ?>
                                    <span class="kl_keyDesc"> - Impression :</span>
                                    <?= $configurationBorne->is_impression || $configurationBorne->is_impression == null ? '<span class="kl_valueDesc kl_actif " >activée</span>' : '<span class="kl_valueDesc kl_inactif ">non activée</span>' ?>
                                <?php }else{ ?>
                                    <span class="kl_valueDesc">Non configurée</span>
                                <?php } ?>
                                
                                </div>
            				</div>
            			</div>
            	</div>
            </div>
            <div class="card card-outline-info">
        		<div class="row kl_titreBlocCadre">
        			<div class="col-md-6 kl_theTitreCadreBlock">Fonctionnalités activées </div>
        			<div class="col-md-6 kl_theActionIntitre kl_titreLink">
                        <?php echo $this->Html->link('Gérer les fonctionnalités',['controller'=>'Configurations', 'action'=>'liste', $idEvenement],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite" ]); ?>
                    </div>
        		</div>
            	<div class="card-body-custom">
                <?php
                    if(!empty($listIdFonctionnaliteActive)){
                            //Email
                            if( in_array(1,$listIdFonctionnaliteActive) ){
                                if(!empty($emailConfig))  { 
                                ?>
                        		<div class="row kl_oneFonctionActivedInList">
                        			<div class="kl_titreAndDescription col-md-9">
                        				<div class="kl_titreWithIconChecked <?= !empty($emailConfig) ? 'checked' :'' ?> ">
                        					<i class="fa fa-check-circle"></i> Envoi photo par email <div class="kl_iconInterogation">?</div>
                        				</div>
                        				<div class="kl_descriptionAndDetailFonction">
                        					<span class="kl_keyDesc">Nom expéditeur :</span> <span class="kl_valueDesc"><?= $emailConfig->nom_expediteur ?></span>
                        					<span class="kl_keyDesc">- Objet :</span>
                        					<span class="kl_valueDesc"><?= $emailConfig->objet ?> </span>
                        					<span class="kl_keyDesc"> - Etat envoi : </span>
                        					<span class="kl_valueDesc <?= $emailConfig->is_active ? 'kl_actif' : 'kl_inactif' ?> "><?= $emailConfig->is_active ? 'actif' : 'désactivé' ?></span>
                        				</div>
                        			</div>
                        			<div class="kl_actionBtn col-md-3">
                                         <?php echo $this->Html->link('Configurer',['controller'=>'EmailConfigurations', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeConfigured" ]); ?>
                        			</div>
                        		</div>
                                <?php }else{ ?>
                                <div class="row kl_oneFonctionActivedInList">
                                    <div class="kl_titreAndDescription col-md-9">
                                        <div class="kl_titreWithIconChecked unchecked">
                                            <i class="fa fa-check-circle-o"></i> Envoi photo par E-mail <div class="kl_iconInterogation">?</div>
                                        </div>
                                        <div class="kl_descriptionAndDetailFonction">
                                            Personnalisation du contenu email envoyé automatiquement aux participants
                                        </div>
                                    </div>
                                    <div class="kl_actionBtn col-md-3">
                                        <?php echo $this->Html->link('Configurer',['controller'=>'EmailConfigurations', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeUnConfigured" ]); ?>
                                    </div>
                                </div>
                                <?php } 
                            } 
                            
                            //Sms
                            if( in_array(2,$listIdFonctionnaliteActive) ){
                                if(!empty($smsConfig))  { 
                                ?>
                                <div class="row kl_oneFonctionActivedInList">
                                    <div class="kl_titreAndDescription col-md-9">
                                        <div class="kl_titreWithIconChecked <?= !empty($smsConfig) ? 'checked' :'' ?> ">
                                            <i class="fa fa-check-circle"></i> Envoi photo par sms <div class="kl_iconInterogation">?</div>
                                        </div>
                                        <div class="kl_descriptionAndDetailFonction">
                                            <span class="kl_keyDesc">Nom expéditeur :</span> <span class="kl_valueDesc"><?= $smsConfig->expediteur ?></span>
                                            <span class="kl_keyDesc"> - Etat envoi : </span>
                                            <span class="kl_valueDesc <?= $smsConfig->is_active ? 'kl_actif' : 'kl_inactif' ?> "><?= $smsConfig->is_active ? 'actif' : 'désactivé' ?></span>
                                        </div>
                                    </div>
                                    <div class="kl_actionBtn col-md-3">
                                         <?php echo $this->Html->link('Configurer',['controller'=>'SmsConfigurations', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeConfigured" ]); ?>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="row kl_oneFonctionActivedInList">
                                    <div class="kl_titreAndDescription col-md-9">
                                        <div class="kl_titreWithIconChecked unchecked">
                                            <i class="fa fa-check-circle-o"></i> Envoi photo par sms <div class="kl_iconInterogation">?</div>
                                        </div>
                                        <div class="kl_descriptionAndDetailFonction">
                                            Personnalisation du contenu sms envoyé automatiquement aux participants
                                        </div>
                                    </div>
                                    <div class="kl_actionBtn col-md-3">
                                        <?php echo $this->Html->link('Configurer',['controller'=>'SmsConfigurations', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeUnConfigured" ]); ?>
                                    </div>
                                </div>
                                <?php } 
                            } 

                            //Galerie Souvenir
                            if( in_array(4,$listIdFonctionnaliteActive) ){
                                if(!empty($galerieSouvenirConf))  { 
                                ?>
                                <div class="row kl_oneFonctionActivedInList">
                                    <div class="kl_titreAndDescription col-md-9">
                                        <div class="kl_titreWithIconChecked <?= !empty($galerieSouvenirConf) ? 'checked' :'' ?> ">
                                            <i class="fa fa-check-circle"></i> Personnalisation de la galerie souvenir<div class="kl_iconInterogation">?</div>
                                        </div>
                                        <div class="kl_descriptionAndDetailFonction">
                                            <span class="kl_keyDesc">Identifiant :</span> <span class="kl_valueDesc"><?= $galerieSouvenirConf->slug ?></span>
                                        </div>
                                    </div>
                                    <div class="kl_actionBtn col-md-3">
                                         <?php echo $this->Html->link('Configurer',['controller'=>'Galeries', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeConfigured" ]); ?>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="row kl_oneFonctionActivedInList">
                                    <div class="kl_titreAndDescription col-md-9">
                                        <div class="kl_titreWithIconChecked unchecked">
                                            <i class="fa fa-check-circle-o"></i> Personnalisation de la galerie souvenir <div class="kl_iconInterogation">?</div>
                                        </div>
                                        <div class="kl_descriptionAndDetailFonction">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                        </div>
                                    </div>
                                    <div class="kl_actionBtn col-md-3">
                                        <?php echo $this->Html->link('Configurer',['controller'=>'Galeries', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeUnConfigured" ]); ?>
                                    </div>
                                </div>
                                <?php } 
                            } 

                            //Page Souvenir
                            if( in_array(5,$listIdFonctionnaliteActive) ){ ?>
                                <div class="row kl_oneFonctionActivedInList">
                                    <div class="kl_titreAndDescription col-md-9">
                                        <div class="kl_titreWithIconChecked <?= !empty($pageSouvenirConfig) ? 'checked' :'unchecked' ?> ">
                                            <i class="fa fa-check-circle<?= !empty($pageSouvenirConfig) ? '' :'-o' ?>"></i> Personnalisation de la page souvenir<div class="kl_iconInterogation">?</div>
                                        </div>
                                        <div class="kl_descriptionAndDetailFonction">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                        </div>
                                    </div>
                                    <div class="kl_actionBtn col-md-3">
                                        <?php
                                        $kl = 'btn btn-customSelfizeeConfigured';
                                        if(empty($pageSouvenirConfig)){
                                            $kl = 'btn btn-customSelfizeeUnConfigured';
                                        }
                                        echo $this->Html->link('Configurer',['controller'=>'PageSouvenirs', 'action'=>'add', $idEvenement],['escape'=>false,"class"=>$kl ]); ?>
                                    </div>
                                </div>
                        <?php    }
                        //FacebookAuto
                        if( in_array(9,$listIdFonctionnaliteActive) ){
                            if(!empty($facebookAutoConfig))  { 
                            ?>
                            <div class="row kl_oneFonctionActivedInList">
                                <div class="kl_titreAndDescription col-md-9">
                                    <div class="kl_titreWithIconChecked <?= !empty($facebookAutoConfig) ? 'checked' :'' ?> ">
                                        <i class="fa fa-check-circle"></i> Publication automatique sur la page Facebook<div class="kl_iconInterogation">?</div>
                                    </div>
                                    <?php foreach($facebookAutoConfig as $fb){ ?>
                                    <div class="kl_descriptionAndDetailFonction">
                                        <span class="kl_keyDesc">Nom de la page :</span> <span class="kl_valueDesc"><?= $fb->name_in_facebook ?></span>
                                        <span class="kl_keyDesc">Album :</span> <span class="kl_valueDesc"><?= $fb->name_album_in_facebook ?></span>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="kl_actionBtn col-md-3">
                                     <?php echo $this->Html->link('Configurer',['controller'=>'FacebookAutos', 'action'=>'liste', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeConfigured" ]); ?>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <div class="row kl_oneFonctionActivedInList">
                                <div class="kl_titreAndDescription col-md-9">
                                    <div class="kl_titreWithIconChecked unchecked">
                                        <i class="fa fa-check-circle-o"></i> Publication automatique sur la page Facebook  <div class="kl_iconInterogation">?</div>
                                    </div>
                                    <div class="kl_descriptionAndDetailFonction">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                    </div>
                                </div>
                                <div class="kl_actionBtn col-md-3">
                                    <?php echo $this->Html->link('Configurer',['controller'=>'FacebookAutos', 'action'=>'liste', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeUnConfigured" ]); ?>
                                </div>
                            </div>
                            <?php } 
                        } 
                        //Evenements posts
                        if( in_array(10,$listIdFonctionnaliteActive) ){
                            if(!empty($evenementPostConfig))  { 
                            ?>
                            <div class="row kl_oneFonctionActivedInList">
                                <div class="kl_titreAndDescription col-md-9">
                                    <div class="kl_titreWithIconChecked <?= !empty($evenementPostConfig) ? 'checked' :'' ?> ">
                                        <i class="fa fa-check-circle"></i> Page de contenu<div class="kl_iconInterogation">?</div>
                                    </div>
                                    <?php foreach($evenementPostConfig as $post){ ?>
                                    <div class="kl_descriptionAndDetailFonction">
                                        <span class="kl_keyDesc">Titre :</span> <span class="kl_valueDesc"><?= $post->titre ?></span>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="kl_actionBtn col-md-3">
                                     <?php echo $this->Html->link('Configurer',['controller'=>'EvenementPosts', 'action'=>'liste', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeConfigured" ]); ?>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <div class="row kl_oneFonctionActivedInList">
                                <div class="kl_titreAndDescription col-md-9">
                                    <div class="kl_titreWithIconChecked unchecked">
                                        <i class="fa fa-check-circle-o"></i> Page de contenu <div class="kl_iconInterogation">?</div>
                                    </div>
                                    <div class="kl_descriptionAndDetailFonction">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                    </div>
                                </div>
                                <div class="kl_actionBtn col-md-3">
                                    <?php echo $this->Html->link('Configurer',['controller'=>'EvenementPosts', 'action'=>'liste', $idEvenement],['escape'=>false,"class"=>"btn  btn-customSelfizeeUnConfigured" ]); ?>
                                </div>
                            </div>
                            <?php }
 
                        } 
                    }else{
                    ?>
                    <div class="col-md-12">Aucune fonctionnalitée activée</div>
                    <?php   
                    }
            
                ?>
            	</div>
            </div>
    </div>
</div>

