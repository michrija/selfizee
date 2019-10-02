<?= $this->Html->css('politiques/pol.css?'.time(), ['block' => true]) ?>

<!--<div class="row kl_intro kl_introCssb">
	<div class="container">
         <div class="kl_theIntro">
            <p class="kl_fontWhite400Date">Dernière mise à jour : 16 juillet 2019</p>
         </div>
         <div class="kl_phrase_intro">
            <p class="kl_fontWhite400">
               
			Découvrez en toute transparence la politique liée au traitement des données utilisateurs que nous collectons par le biais des animations effectuées au nom de nos clients organisateurs. 
            </p>
         </div>
    </div>
</div>-->



<div class="row kl_bloc_inscription" style="">
        <div class="container text-center kl_bloc_inscription_content"><!-- col-md-12 text-center kl_oneBlock kl_blockGray -->
					<div style="margin:auto;">
						<h2 class="sf-uppercase sf-rgpd-titre-1">Gérer vos propres données</h2>
						<div id="sf-bloc-replace">
							<p class="sf-rgpd-para-size-1">Saisissez votre adresse e-mail et recevez immédiatement un e-mail contenant un accès vers notre plateforme recensant l'ensemble de vos données collectées par Selfizee.</p>
							<p class=" sf-rgpd-para-1 sf-rgpd-para-size-1">Ce lien aura une durée de validité de 7 jours.</p>
							<?= $this->Form->create('sf-rgpd-inscription', ['id' => 'sf-post']) ?>
								<input class="sf-rgpd-form-input-page" name="email" id="sf-email" type="email" placeholder="VOTRE ADRESSE E-MAIL" >
								<button class="btn sf-rgpd-form-btn-page sf-uppercase">Envoyer</button>
							<?= $this->Form->end() ?>
						</div>
				    </div>
		</div>
</div>

