<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>
<?= $this->Html->css('users/board.css', ['block' => true]) ?>

<div class="row el-element-overlay">
	<div class="col-md-12">
		<div class="card card-new-selfizee">
			<div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left">Mon compte</h4>
                <div class="clearfix"></div>
            </div>
			
			<div class="card-body custom-card">
				<div class="row">
					<div class="col-md-4">
						<div class="kl_titreBlocBoard text-uppercase">Compte Client</div>
						<div class="kl_contentBlocBoard">
							<?php
				              	if(!empty($client) && !empty($client->logo_page_bo)){
				            		$logo = $client->url_logo_page_bo; 
							?>
							<div class="pull-left">
								<?= $this->Html->image($logo, ['class'=>'img-responsive']) ?>
							</div>
							<?php } ?>
							<div class="pull-left kl_addresseEtInfo">
								<p>Hyper U rennes</p>
								<p>3 rue de Molières <br> 35000 Rennes</p>
								<p>hyperurennes@gmail.com</p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="kl_titreBlocBoard text-uppercase">Utilisateur</div>
						<div class="kl_contentBlocBoard">
							<div>Identifiant de connexion : </div>
							<div class="kl_indetifiantConnexionValuue"><?= $user->username ?></div>
							<div class="kl_blocLinkAction">
								<?= $this->Html->link('Modifier le mot de passe',['controller'=>'Users','action'=>'settings'] ,['class'=>'kl_linkActionBoardUser']) ?>
								<?= $this->Html->link('Se déconnecter',['controller'=>'Users','action'=>'logout'] ,['class'=>'kl_linkActionBoardUser']) ?>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="kl_titreBlocBoard text-uppercase">Personnalisation</div>
						<div class="kl_contentBlocBoard">
							<div>Personnalisation de vos thèmes graphiques, préférences utilisateurs...</div>
							<div class="kl_blocLinkAction">
								<?= $this->Html->link('Accès à la personnalisation',['controller'=>'Clients','action'=>'board'] ,['class'=>'kl_linkActionBoardUser']) ?>
							</div>
						</div>
					</div>
				</div>
				<hr class="kl_theSeparator">
				<div class="row">
					<div class="kl_titreBlocBoard text-uppercase col-md-12 kl_marginBottom45">Par machine</div>
					<div class="col-md-3 kl_imageCenter">
						<img src="/img/photo_borne.png" class="img-responsive kl_imgBorne">
					</div>
					<div class="col-md-8 row">
						<div class="kl_titreSoustitreBloc col-md-12">Selfizee Classik</div>
						<div class="col-md-4">
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">Molèle :</div>
								<div class="kl_valieElementBloc">V3</div>
							</div>
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">Numéro de série :</div>
								<div class="kl_valieElementBloc">CL1902113</div>
							</div>
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">Type imprimante :</div>
								<div class="kl_valieElementBloc">DNP 620</div>
							</div>
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">Prise de photo :</div>
								<div class="kl_valieElementBloc">Reflex cannon</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">Version logiciel installée :</div>
								<div class="kl_valieElementBloc">SelfizeeBooth v1.123</div>
								<div class="kl_comentaireBloc">(Dérnière vérification : 2 jours )</div>
							</div>
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">Type de contrat :</div>
								<div class="kl_valieElementBloc">Location longue durée</div>
							</div>
							<div class="kl_oneInfoBlocEl">
								<div class="kl_titreElementBloc">La licence selfizee est attribuée :</div>
								<div class="kl_valieElementBloc">- Date début du contrat : 01/09/2019</div>
								<div class="kl_valieElementBloc">- Date fin du contrat : 01/10/2019</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>