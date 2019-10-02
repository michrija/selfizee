
<!DOCTYPE HTML>
<html>
<head>
    <?php //var_dump($urlPhotoTest); ?>
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="Selfizee" />
    <meta property="og:url" content="<?= $urlPhotoTest  ?>" />
    <meta property="og:title" content="<?= $evenement->nom  ?>" />
    <meta property="og:type" content="website" />
    <?php
        $descFb = "";
        $descTwit = "";
        if(!empty($evenement->rs_configuration)){
            $descFb = $evenement->rs_configuration->desc_facebook;
            $descTwit = $evenement->rs_configuration->desc_twiter;
        }
    ?>
    <meta property="og:description" content="<?= $descFb  ?>" />
    <meta property="og:image"  content="<?= $urlPhotoTest ?>" />
    <meta property="robots" content="noindex, nofollow" /> 
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?= $evenement->nom ; ?>">
    <meta name="twitter:description" content="<?= $descTwit  ?>">
    <meta name="twitter:image" content="<?= $urlPhotoTest ?>" />
    <title><?php echo ucfirst($evenement->nom );  ?></title>
	<link href="<?= $urlPhotoTest ?>" rel="image_src"  />   
    <?=   $this->Html->css('pageSouvenir/style-souvenir.css?'.time()) ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap.css') ?>
    <?=   $this->Html->css('pageSouvenir/mobile-souvenir.css') ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap-select.css') ?>
    <?=   $this->Html->css('galerieSouvenir/font-awesome.css') ?>
    
    <?=   $this->Html->script('galerieSouvenir/jquery.js') ?>
    <?=   $this->Html->script('galerieSouvenir/bootstrap.min.js') ?>
    <?=   $this->Html->script('pageSouvenir/imagelightbox.js') ?>
    <?=   $this->Html->script('pageSouvenir/souvenir.js') ?>
    
    <?php use Cake\Routing\Router; ?>
    <script>
        const URL_BASE = "<?= Router::url('/', true) ?>";
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.7&appId=663316557166239";/**test 663316557166239**/
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      
        
    </script>
    <style>
        <?php
          $couleurDownloadLink = "#000";
          if(!empty($evenement->page_souvenir)){
            $couleurDownloadLink = $evenement->page_souvenir->couleur_download_link;
          }
        ?>
        .kl_saveImg{color:<?= $couleurDownloadLink ?>}
    </style>
    
</head>
<?php
    $couleurBg = "#fff";
    if(!empty($evenement->page_souvenir)){
        $couleurBg = $evenement->page_souvenir->couleur_fond;
    }
?>
<body style="background:<?= $couleurBg ?>">
    <div class="kl_container container">

        <?php 
            if(!empty($evenement->page_souvenir->img_banniere)){ 
        ?>
        <header>
            <div class="kl_imageHeader">
                <img src="<?php echo $evenement->page_souvenir->url_banniere ;?>" class="img-responsive" />
            </div>
        </header>
        <?php } ?>
        <div class="kl_content">
            <div class="row">
                <div class="col-sm-12">
                        <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="kl_copyright">
                <div class="pull-right">Brandeet 2016</div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>
</body>
</html>