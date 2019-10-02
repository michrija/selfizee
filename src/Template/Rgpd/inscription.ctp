<section class="sf-full-height sf-background-black">
	<div class="row">
		<div class="col-md-6 text-center kl_oneBlock">
			<h2 class="sf-uppercase sf-txt-blanc sf-rgpd-titre-1">à quoi sont destinées les données collectées ?</h2>
			<p class="sf-txt-blanc sf-rgpd-para-1 sf-rgpd-para-size-1">Consultez les différentes conditions liées à l’utilisation des données personnelles : </p>
			<ul class="sf-rgpd-list-link">

				<li class="sf-uppercase"><?php echo $this->Html->link('Charte de conformité au rgpd','charte-de-conformite-au-rgpd', ["class"=>"kl_confident"]);?></li>
				<li class="sf-uppercase"><?php echo $this->Html->link('Politique de confidentialité','politique-de-traitement-des-donnees', ["class"=>"kl_confident"]);?></li>
				<li class="sf-uppercase"><?php echo $this->Html->link('Politique relative aux cookies','politique-relative-a-utilisation-des-cookies', ["class"=>"kl_confident"]);?></li>
			</ul>
		</div>
		<div class="col-md-6 text-center kl_oneBlock kl_blockGray">
			<div style="margin:auto;">
				<h2 class="sf-uppercase sf-txt-blanc sf-rgpd-titre-1">Gérer vos propres données</h2>
				<div id="sf-bloc-replace">
					<p class="sf-txt-blanc sf-rgpd-para-size-1">Saisissez votre adresse e-mail et recevez immédiatement un e-mail contenant un accès vers notre plateforme recensant l'ensemble de vos données collectées par Selfizee.</p>
					<p class="sf-txt-blanc sf-rgpd-para-1 sf-rgpd-para-size-1">Ce lien aura une durée de validité de 7 jours.</p>
					<?= $this->Form->create('sf-rgpd-inscription', ['id' => 'sf-post']) ?>
						<input class="sf-rgpd-form-input" name="email" id="sf-email" type="email" placeholder="VOTRE ADRESSE E-MAIL" >
						<button class="btn sf-rgpd-form-btn sf-uppercase">Envoyer</button>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="sf-interrogation text-center">
	<div class="container">
		<h2 class="sf-uppercase sf-rgpd-titre-2">Une Question ? Une interrogation ?</h2>
		<p>
			<a class="label label-default label-pers text-uppercase kl_contactDPO" href="mailto:dpo@konitys.fr">Contactez notre DPO</a>
		</p>
	</div>
</section>
<section class="sf-bloc-gris text-center">
	<div class="container">
		<div class="text-uppercase kl_demarcheEnreprise">Découvrir la Démarche rgpd entreprise par Selfizee</div>
	</div>
</section>