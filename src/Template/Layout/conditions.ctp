<?php 
	$meta_title = !empty($meta_title) ? $meta_title : 'RGPD - Selfizee';
	$meta_description = !empty($meta_desc) ? '<meta name="description" content="'.$meta_desc.'" />' : '';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $meta_title ?></title>
	<?php echo $meta_description ?>
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
				<?php if(false){ ?>

				<div class=" col-md-4 col-sm-12">
				</div>
				<div class="clearfix"></div>
				<a class="sf-header-btn pull-right kl_lienVersSelfizee" href="https://www.selfizee.fr">Accéder au site internet <strong>Selfizee</strong></a>
				<?php } ?>
			</div>
		</header>
		<?php echo $this -> element('Rgdp/menu_mobile_2'); ?>
		<section class="sl-banniere sl-banniere1 text-center">
			<div class="sl-evenement">
				<h1><?php echo (isset($banniere_title) ? $banniere_title : ''); ?></h1>
			</div>
		</section>
		
		<section class="sl-body">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
		</section>

	
	
	<?php echo $this->element('Rgdp/pre_footer_1'); ?>
	<?php if(!$is_page_gestion_donnees) {?>
	      <?php echo $this->element('Rgdp/pre_footer_2'); ?>
	  <?php }?>
	
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
