<?= $this->Html->css('clients/board.css', ['block' => true]); ?>
<?php
$titrePage = "Tableau de board client" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
?>
    <h3 class="text-themecolor m-b-0 m-t-0 titre_page kl_newTitrePage">Personnalisation</h3>
    <div class="kl_sousTitrePage">Paramétrez en toute simplicité vos éléments par défaut et modèles des données !</div>
<?php $this->end(); ?>
<div class="row">
	<div class="kl_titreGroupe col-md-12">Fonctionnalités marketing</div>
	<div class="row col-md-12 kl_theListeFonctionnalite">
		<div class="col-md-4">
			<div class="kl_oneBockConfigure">
				<div class="kl_headerBlock">
					<div class="kl_theTitreBlock">E-mail</div>
					<div class="kl_descTitreBlock">Géréz les préférences d'e-mails et adresses e-mails expéditeurs autorisées</div>
				</div>
				<div class="kl_bodyBlock">
					<ul>
						<li>
							<?php echo $this->Html->link('Gestion des modèles d\'e-mail',['controller' => 'ClientsModelesEmails', 'action' => 'index', $client->id]); ?>
						</li>
						<li>
							<?php echo $this->Html->link('Gestion des adresses expéditeurs',['controller' => 'Expediteurs', 'action' => 'index', $client->id]); ?>
						</li>
						<li>
							<?php echo $this->Html->link('Gestion de la signature e-mail',['controller' => 'ClientsSignaturesEmails', 'action' => 'add', $client->id]); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="kl_oneBockConfigure">
				<div class="kl_headerBlock">
					<div class="kl_theTitreBlock">Sms</div>
					<div class="kl_descTitreBlock">Géréz les crédits et personnaliser les modèles prêts à l'emploi</div>
					<div class="kl_creditRestantInTitre">
						<span>Crédit restant :</span> 0 sms
					</div>
				</div>
				<div class="kl_bodyBlock">
					<ul>
						<li>
							<?php echo $this->Html->link('Gestion de mes crédtis sms',['controller' => 'Credits', 'action' => 'buySms', $client->id]); ?>
						</li>
						<li>
							<?php echo $this->Html->link('Gestion des modèles sms',['controller' => 'ClientsModelesSmss', 'action' => 'index', $client->id]); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="kl_oneBockConfigure">
				<div class="kl_headerBlock">
					<div class="kl_theTitreBlock">Réseaux sociaux</div>
					<div class="kl_descTitreBlock">Géréz vos réseaux sociaux favoris pour les remontées automatiques des photos dans votre page facebook</div>
				</div>
				<div class="kl_bodyBlock">
					<ul>
						<li><a href="#">Gérez mes pages</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row row p-t-15">
	<div class="kl_titreGroupe col-md-12 p-b-5">Mise en page</div>
	<div class="row col-md-12 kl_theListeFonctionnalite">
		<div class="col-md-4">
			<div class="kl_oneBockConfigure">
				<div class="kl_headerBlock">
					<div class="kl_theTitreBlock">Catalogue de mise en page</div>
					<div class="kl_descTitreBlock">Géréz les modèles de mise en page (cadres et fonds de page ) ainsi que les thématiques globales</div>
				</div>
				<div class="kl_bodyBlock">
					<ul>
						<li>
							<!--<a href="#">Gestion des thématiques</a> -->
							<?php echo $this->Html->link('Gestion des thématiques',['controller' => 'Themes', 'action' => 'liste', $client->id]); ?>
						</li>
						<li>				
							<?php echo $this->Html->link('Gestion des modèles d\'écran',['controller' => 'Catalogues', 'action' => 'liste', $client->id]); ?>
						</li>
						<li>				
							<?php echo $this->Html->link('Gestion des modèles de cadre',['controller' => 'CatalogueCadres', 'action' => 'liste', $client->id]); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="kl_oneBockConfigure">
				<div class="kl_headerBlock">
					<div class="kl_theTitreBlock">Personnalisations globales</div>
					<div class="kl_descTitreBlock">Géréz les mises en page par défaut de vos pages souvenirs et galerie souvenir à envoyer vos clients </div>
				</div>
				<div class="kl_bodyBlock">
					<ul>
						<li>
                            <?php echo $this->Html->link('Personnaliser la page souvenir par défaut',['controller' => 'ClientsCustoms', 'action' => 'page_souvenir', $client->id]); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('Personnaliser la galerie souvenir par défaut',['controller' => 'ClientsCustoms', 'action' => 'galerie_souvenir', $client->id]); ?>
                        </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row row p-t-15">
	<div class="kl_titreGroupe col-md-12 p-b-5">Evénements</div>
	<div class="row col-md-12 kl_theListeFonctionnalite">
		<div class="col-md-4">
			<div class="kl_oneBockConfigure">
				<div class="kl_headerBlock">
					<div class="kl_theTitreBlock">Configuration</div>
					<div class="kl_descTitreBlock">Géréz vos types d'événements qui vous correspondent ainsi que vos types de clients</div>
				</div>
				<div class="kl_bodyBlock">
					<ul>
						<li>
                            <?php echo $this->Html->link('Gestion des types d\'événements',['controller' => 'TypeEvenements', 'action' => 'index', $client->id]); ?>
                        </li>

                        <li>
                            <?php echo $this->Html->link('Gestion des types de clients',['controller' => 'TypeClients', 'action' => 'index', $client->id]); ?>
                        </li>
					</ul>
				</div>
			</div>
		</div>
		
	</div>
</div>