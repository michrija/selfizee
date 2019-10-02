<section id="id_prefooter_2">
	<div class="container">
		<div class="sf-titre-prefooter2">GÉRER VOS PROPRES DONNÉES</div>
		<div id="sf-bloc-replace">
			<div class="sf-paraf-prefooter2">
				<p>Saisissez votre adresse e-mail et recevez immédiatement un e-mail contenant un accès vers notre plateforme recensant l'ensemble de vos données collectées par Selfizee.</p>

				<p>Ce lien aura une durée de validité de 7 jours.</p>
			</div>
			<?= $this->Form->create('sf-rgpd-inscription', ['id' => 'sf-post']) ?>
				<div class="row">
					<div class="col-md-5">
						<input class="sf-rgpd-form-input" name="email" id="sf-email" type="email" placeholder="VOTRE ADRESSE E-MAIL" >
					</div>
					<div class="col-md-4 kl_leftContetBtn">
						<button class="btn sf-rgpd-form-btn sf-uppercase">Envoyer</button>
					</div>
				</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</section>
