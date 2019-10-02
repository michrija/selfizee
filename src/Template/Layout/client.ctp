<?php $siteDescription = !empty($title) ? $title : 'Event Selfizee : '.$this->fetch('title'); ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $siteDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <?= $this->Html->css('plugins/bootstrap.min.css') ?>
    <?= $this->Html->css('style.css?'.time()) ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <?= $this->Html->css('rgpd/client.css?'.time()) ?>
    <?= $this->Html->css('rgpd/custom-mob.css?'.time()) ?>

    
    <?= $this->Html->css('colors/green.css') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?= $this->element('preloader'); ?>
	
	<?php // Si liste des informations médias ?>
	<?php if(isset($info_liste)){ ?>
		<?php if(false){// old ?>
		<header class="text-center">
			<a href="https://rgpd.selfizee.fr/">
				<?php echo $this->Html->image('logo-selfizee-noir-sans-accroche.png', ['alt' => 'Logo selfizee']); ?>
			</a>
		</header>
		<?php } ?>
		<header class="text-center">
			<div class="row container kl_auto">
				<div class="col-8 col-sm-4 sf-header-rel">
					<a href="https://rgpd.selfizee.fr/" class="pull-left kl_logSelfizeeInt">
						<?php echo $this->Html->image('logo-selfizee-noir-sans-accroche.png', ['alt' => 'Logo selfizee']); ?>
					</a>
				</div>
				<div class="col-4 col-sm-4 sf-to-hide-mob">
					<h1 class="kl_titreSite">Plateforme de gestion des données - RGPD</h1>
				</div>
				<div class="col-4 col-sm-4">
					<?php // echo $this -> element('Rgdp/menu_mobile_2'); ?>
					<div class="sf-menu-bloc sf-menu-bloc-1">
						<a class="sf-menu sf-menu-1 pull-right">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</a>
						<!--a class="sf-menu-link sf-menu-link-1 pull-right m-r-20" href="https://www.selfizee.fr" target="_blank">Accéder au site internet <strong>Selfizee</strong></a-->
					</div>
				</div>
			</div>
		</header>
		<?php echo $this -> element('Rgdp/menu_mobile_2'); ?>
		
		<section class="sl-banniere sl-banniere1 text-center">
			<div class="sl-evenement">
				<h1><?php echo (isset($banniere_title) ? $banniere_title : ''); ?></h1>
			</div>
		</section>
		<section class="sl-header">
			<div class="container">
				<aside class="text-center sl-header-box">
					<p class="text-center">
						Dans le cadre de la loi RGPD relative à la gestion des données individuelles, <br/>vous retrouverez sur cette page les informations relatives à vos données.
					</p>
					<p class="text-center">
						L’utilisation de ce service vous permettra de consulter ou de requérir une modification ou la dépersonnalisation <br/>des données que nous conservons à votre sujet, au nom de nos clients.
					</p>
				</aside>
			</div>
		</section>
		<section class="sl-body">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
		</section>
	<?php }else{ ?>
		<?php echo $this -> element('Rgdp/menu_mobile_1'); ?>
		<header class="sf-header-bloc text-center">
			<div class="sf-header-bloc-contenu">
				<!--div class="sf-header-link">
					<a class="sf-header-btn" href="https://www.selfizee.fr">Accéder au site internet <strong>Selfizee</strong></a>
				</div-->
				<div class="sf-logo">
					<?php echo $this->Html->image('logo-login.png', ['alt' => 'Logo selfizee']); ?>
				</div>
				<h1><?php echo $banniere_title ?></h1>
			</div>
		</header>
		<section class="sl-header">
			<div class="container">
				<aside class="text-center sl-header-box">
					<h2 class="sf-uppercase m-b-100">Gestion de mes données personnelles</h2>
					
                                        
                                        <p class="text-center">L’entrée en vigueur le 25 mai 2018 de la directive Européenne relative au Règlement Général sur la Protection des Données Personnelles (RGPD) a pour but de donner à chacun plus de visibilité et de contrôle sur la manière dont ses données personnelles sont collectées et traitées par les entreprises. Par conséquent, il est impératif pour Selfizee, représenté par la société Konitys, d’être en conformité quant à notre pratique de gestion des données des tiers et de transparence dans la collecte et l’utilisation de ces dernières.</p>

                                        <p  class="text-center">Selfizee est qualifié de « sous-traitant » lorsqu’il traite des données à caractère personnel pour le compte d’un responsable. C’est typiquement le cas lorsque nous collectons des informations à caractère personnel sur nos bornes photos.</p>

                                        <p  class="text-center">Le respect des données personnelles, n’est pas une nouveauté en soit mais cette nouvelle réglementation a permis de remettre à plat des processus et d’homogénéiser les pratiques entre les différents organismes, et surtout limiter les abus engendrés ces dernières années par certaines sociétés.</p>

                                        <p class="text-center">Chez Selfizee, nous n’avons pas attendu le RGPD pour assurer la confidentialité et la sécurité de vos données. <br />Ce règlement renforce néanmoins certaines de nos obligations. Nous avons donc entrepris toutes les démarches nécessaires à notre mise en conformité. </p>

                                        <p>Vous en trouverez le détail ci-après.</p>

                                        
                                        
                                        <?php /*
                                        <p class="text-center">
						Depuis le 25 mai 2018 la collecte et l’utilisation de données à caractère personnel sont encadrées par le Règlement Général sur la Protection des Données (RGPD).
					</p>
					<p class="text-center">
						Selfizee est heureux de proposer à ses clients et partenaires sa solution complète de gestion des données en parfaite conformité avec la règlementation européenne.
					</p>*/ ?>
				</aside>
			</div>
		</section>
		<?= $this->Flash->render() ?>
		<?= $this->fetch('content') ?>
	<?php } ?>
	
	
	<?php  
	if($showPreFooter) {
		echo $this->element('Rgdp/pre_footer_1'); 
	}
	?>
	<?php echo $this->element('Rgdp/footer'); ?>
	
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?= $this->Html->script('jquery/jquery.min.js') ?>
    <?= $this->Html->script('bootstrap/popper.min.js') ?>
    <?= $this->Html->script('bootstrap/bootstrap.min.js') ?>
    <!-- slimscrollbar scrollbar JavaScript -->
     <?= $this->Html->script('jquery.slimscroll.js') ?>
    <!--Wave Effects -->
     <?= $this->Html->script('waves.js') ?>
    <!--Menu sidebar -->
     <?= $this->Html->script('sidebarmenu.js') ?>
    <!--stickey kit -->
     <?= $this->Html->script('sticky-kit-master/sticky-kit.min.js') ?>
    <!--Custom JavaScript -->
     <?= $this->Html->script('custom.min.js') ?>
	 <?= $this->Html->script('custom.selfizee.js?'.time()); ?>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
     <?= $this->Html->script('styleswitcher/jQuery.style.switcher.js') ?>
    
    <?= $this->fetch('script') ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63833362-7"></script>
	<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-63833362-7');

		window.cookieconsent.initialise({
			"palette": {
				"popup": {
					"background": "#000"
				},
				"button": {
					"background": "#f1d600"
				}
			},
			"content": {
				"message": "Ce site utilise des cookies. <br/>Nous utilisons des cookies afin d'améliorer votre expérience sur notre site Web, analyser votre trafic et personnaliser les annonces. Nous utilisons également des cookies tiers (Google...). Vous consentez à l'utilisation de cookies si vous continuez à utiliser ce site Web.",
				"dismiss": "Ok",
				"link": "Plus de détails",
				"href": "https://rgpd.selfizee.fr/politique-relative-a-utilisation-des-cookies"
			}
		});
	</script>
</body>
</html>
