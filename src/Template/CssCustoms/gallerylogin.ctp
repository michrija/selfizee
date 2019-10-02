<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Selfizee';
?>
<!DOCTYPE html>
<html>
<head>
    <!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
    <?= $this->Html->charset() ?>
    <title><?= $cakeDescription ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta property="robots" content="noindex, nofollow" /> 
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
     
    <?= $this->Html->css('galerie/bootstrap.min.css') ?>
    <?= $this->Html->css('galerie/blueimp-gallery.min.css') ?>
    <?= $this->Html->css('galerie/bootstrap-image-gallery.css') ?>
    <?= $this->Html->css('galerie/demo.css') ?>
    <?= $this->Html->css('galerie/font-awesome.min.css') ?>
    <?= $this->Html->css('galerie/style.css',["data-cfasync"=>"false"]) ?>
   
    <?= $this->fetch('css') ?>
   
    <?= $this->Html->script('galerie/jquery.min.js') ?>
    <?= $this->Html->script('galerie/bootstrap.min.js') ?>
    
    <?= $this->fetch('script') ?>


</head>

<body class="login">

    
    <div id="container">

        <div id="content">
                  
            

            <div class="content_event">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p style="margin: 0;"> 
                <a href="http://www.selfizee.fr">
                    <?php if (isset($client) && isset($client['logo_header_page_galerie']) && !empty($client['logo_header_page_galerie'])): ?>
                        <?php echo $this->Html->image('/import/clients/'.$client['logo_header_page_galerie'], ['alt' => 'Logo Selfizee','class'=>'img_footer']); ?>
                    <?php else: ?>
                        <?php echo $this->Html->image('logo-footer-login-galerie.png', ['alt' => 'Logo Selfizee','class'=>'img_footer']); ?>
                    <?php endif ?>
                </a><br />
            </p>
            <p>
                <span class="kl-txt-fushia">[</span>
                   <label class="kl-txt-black kl-text-borne">Borne photo événementielle</label> 
                <span class="kl-txt-fushia">]</span>
            </p>
            <div class="">
                <div class="kl-txt-footer-1 kl-txt-gray">
                    Soirées privées ou professionnelles dans toutes la France :
                </div>
            </div>
            <p class="kl-txt-gray">
                mariages, anniversaires, salons et foires, séminaires, soirées événementielles...<br />
                                
            </p>
            <p class="kl-img-footer-galerie-login">
                 <?php echo $this->Html->image('img-footer-galerie-login.png', ['alt' => 'Logo Selfizee','class'=>'img_footer_galerie']); ?>
            </p>
            <p>
                <a class="btn btn-link-site" href="https://www.selfizee.fr" target="_blank">www.selfizee.fr</a>
            </p>            
        </div>
    </footer>
 <?php if(isset($is_dev) && !$is_dev){?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63833362-2', 'auto');
  ga('send', 'pageview');

</script>
<?php } ?>
</body>
</html>