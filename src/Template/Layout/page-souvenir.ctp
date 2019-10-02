
<!DOCTYPE HTML>
<html>
<head>
    
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="Selfizee" />
    <meta property="og:url" content="<?= $photo->url_photo ?>" />
    <meta property="og:title" content="<?= $photo->evenement->nom  ?>" />
    <meta property="og:type" content="website" />
    <?php
        $descFb = "";
        $descTwit = "";
        if(!empty($photo->evenement->rs_configuration)){
            $descFb = $photo->evenement->rs_configuration->desc_facebook;
            $descTwit = $photo->evenement->rs_configuration->desc_twiter;
        }
    ?>
    <meta property="og:description" content="<?= $descFb  ?>" />
    <meta property="og:image"  content="<?= $photo->url_photo ?>" />
    <meta property="robots" content="noindex, nofollow" /> 
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?= $photo->evenement->nom ; ?>">
    <meta name="twitter:description" content="<?= $descTwit  ?>">
    <meta name="twitter:image" content="<?= $photo->url_photo ?>" />
    <title><?php echo ucfirst($photo->evenement->nom );  ?></title>
	<link href="<?= $photo->url_photo ?>" rel="image_src"  />   
    <?=   $this->Html->css('pageSouvenir/style-souvenir.css') ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap.css') ?>
    <?=   $this->Html->css('pageSouvenir/mobile-souvenir.css?='.time()) ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap-select.css') ?>
    <?=   $this->Html->css('galerieSouvenir/font-awesome.css') ?>
    
    <?=   $this->Html->script('galerieSouvenir/jquery.js') ?>
    <?=   $this->Html->script('galerieSouvenir/bootstrap.min.js') ?>
    <?=   $this->Html->script('pageSouvenir/imagelightbox.js') ?>
    <?=   $this->Html->script('pageSouvenir/souvenir.js') ?>

    <?= $this->Html->css('photos/popup_photo.css') ?>
    
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
    
    <!--==== SRCIPT GOOGLE ANALITYCS -->
   <?php 
        $ip = $_SERVER['REMOTE_ADDR'];
        //$clientDetails = json_decode(file_get_contents("https://ipapi.co/$ip/json"));
        $clientDetails = json_decode(file_get_contents("http://api.ipapi.com/$ip?access_key=d1ab09895394456e6166a6e0f29563c2"));
        $contryName = trim($clientDetails->country_name);
        //debug($contryName);
            
        if($contryName != '' && $contryName != 'Madagascar' && $contryName != 'South Africa' ){ ?> 
            <!-- Global site tag (gtag.js) - Google Analytics -->
		    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132418946-2"></script>
		    <script>
		      window.dataLayer = window.dataLayer || [];
		      function gtag(){dataLayer.push(arguments);}
		      gtag('js', new Date());

		      gtag('config', 'UA-132418946-2');
		    </script>
		    <script>
			        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			        ga('create', 'UA-132705855-1', 'auto');
			        ga('set', 'page', '/photos/show/<?= $photo->token ?>');
			        ga('send', 'pageview');
                    if (document.location.pathname.indexOf('/<?= $photo->token ?>') > -1) {
                          console.log('Photo :<?= $photo->token ?> ===> EVENT:<?= $photo->evenement_id ?>');
                          var page = document.location.pathname.replace('/p/<?= $photo->token ?>', '/photos/show/<?= $photo->evenement_id ?>/<?= $photo->token ?>');
                          ga('set', 'title', 'ID:<?= $photo->evenement_id ?>');
                          ga('send', 'pageview', page); 
                    }
		    </script>
    <?php } ?>
 
    <script>
    	$.getJSON('https://ipapi.co/<?= $ip ?>/json', function(data) {
  			//console.log(JSON.stringify(data, null, 2));
  			console.log(data);
		});
	</script>
    
</head>
<?php
    $couleurBg = "#fff";
    if(!empty($photo->evenement->page_souvenir)){
        $couleurBg = $photo->evenement->page_souvenir->couleur_fond;
    }
?>
<body style="background:<?= $couleurBg ?>">
    <div class="kl_container container">

        <?php 
            if(!empty($photo->evenement->page_souvenir->img_banniere)){ 
        ?>
        <header>
            <div class="kl_imageHeader imgBanHaut">
                <img src="<?php echo $photo->evenement->page_souvenir->url_banniere ;?>" class="img-responsive" />
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
                <div class="pull-right"></div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>
</body>
</html>