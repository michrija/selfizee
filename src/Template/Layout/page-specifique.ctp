<!DOCTYPE HTML>
<?php 
use Cake\Routing\Router; 
$baseUrl = Router::url('/', true);
?>
<html manifest="<?php echo $baseUrl; ?>>offline.appcache">
<head>
    
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="author" content="Brandeet" />
    <meta name="description" content="Galerie photos souvenir des photos de l’événement " />
    <meta property="og:url"           content="<?= "" ?>"/>
    <meta property="og:image"           content="<?= $baseUrl.$this->request->getPath()?>"/>
    <meta property="og:title" content="<?= "" ; ?>" />
    <meta property="og:type" content="website" />

    <meta property="og:description" content="" />
    <title><?= $banniere_title  ?></title>
    
    <?=   $this->Html->css('galerieSouvenir/style_galerie_brandeet.css',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap.css') ?>
    <?=   $this->Html->css('galerieSouvenir/mobile-souvenir_brandeet.css') ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap-select.css') ?>
    <?=   $this->Html->css('galerieSouvenir/font-awesome.css') ?>
    <?=   $this->Html->css('galerieSouvenir/normalize.min.css') ?>
    <?=   $this->Html->css('galerieSouvenir/magnific-popup.css') ?>
    <?=   $this->Html->css('dropzone/dropzone.css') ?>
    
    <?=   $this->Html->script('galerieSouvenir/jquery.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/bootstrap.min.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/lib.touchSwipe.min.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/bootstrap-select.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/wookmark.js',["data-cfasync"=>"false"])   ?>
    <?=   $this->Html->script('galerieSouvenir/souvenir_brandeet.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/jquery.touchSwipe.min.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/jquery.slimscroll.min.js',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->script('galerieSouvenir/imagesloaded.pkgd.min.js',["data-cfasync"=>"false"])   ?>
    <?=   $this->Html->script('galerieSouvenir/jquery.magnific-popup.min.js',["data-cfasync"=>"false"])   ?>
    <?=   $this->Html->script('PhotoCommentaires/add.js')   ?>
    <?=   $this->Html->script('dropzone/dropzone.js'); ?>
    <?=   $this->Html->script('galerieSouvenir/ajoutPhoto.js'); ?>
      
     <?= $this->fetch('script') ?>

</head>
<body>
    <header>
    
        <div class="kl_topHeader">
            <div class="container">

               <div class="pull-left">
                        <a href="#" class="kl_logoHeader">
                            <img src="<?= $baseUrl ?>webroot/img/logo-noir.png" />
                            <p>
                                <span class="kl-txt-fushia">[</span>
                                <label class="kl-txt-black kl-text-borne">Borne photo événementielle</label>
                                <span class="kl-txt-fushia">]</span>
                            </p>
                        </a>
                </div>
                <div class="pull-right" style="padding-top: 10px;">
                    <div class="pull-left">
                            <a class="kl-lang">
                                <span>FR</span>
                                <img src="<?= $baseUrl ?>webroot/img/fr.jpg">
                            </a>
                            <a class="kl-link-site" href="https://www.selfizee.fr">
                                <i class="fa fa-angle-right"></i><span>Voir le site Selfizee</span>
                            </a>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--<div class="kl_baniereGal" id="id_baniereGal">
                
                <div class="kl_textHeader text-center">
                    <div class="container">
                        <div class="clearfix"></div>
                        <?php
                            $titreHeader = "Titr";
                        ?>
                        
                        <div class="kl_grosTitle kl_titleHeader">
                                <?= $titreHeader ?> 
                        </div>
                           
                        <div class="kl_subtitle"><?= 'Sous titre' ?></div>
                        
                        <div class="clearfix"></div>
                        <?php 
                        
                        ?>

                     </div>
               </div>
        </div>-->
    </header>   
    <div class="kl_contenu">
        <!--<div class="kl_topGalerie">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="kl_descMobile">
                    <?php
                            $titreHeader = "Titr";
                        ?>
                        
                        <div class="kl_grosTitle kl_titleHeader">
                                <?= $titreHeader ?> 
                        </div>
                            
                        <div class="kl_subtitle"><?= "ss" ?></div>
                </div>
                <div class="pull-left kl_btnFiltre" id="id_btnFilter">
                    <i class="fa fa-search"></i>
                </div>
                
                <div class="clearfix"></div> 
            
            
        </div>-->
        <div class="navMobile" id="menuMobile">
                <ul class="kl_navbar_header" id="id_listMobile">
                    <li><a id="id_galerie" class="active"><i class="my_icon_file-text"></i></a></li>                             
                    
                    <li>
                        <?php echo $this->Html->link(
		                     $this->Html->tag('i', '', array('class' => 'fa fa-sign-out')).'<span>Déconnexion</span>',
		                     ['controller' => 'Users', 'action' => 'logout', 1],
		                     ['escape' => false]
		                );
                                ?>  
                    </li>                         
                </ul> 
               
                <!--<div class="kl_signOut text-center"><a href=""><i class="fa fa-sign-out"></i> Deconnexion</a></div>-->
            </div>
            <div id="id_menuLoupe">
                
            </div>
            
            <div class="kl_menu" id="id_menuCenter">
                <div class="pull-left kl_navMenu">
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
        <div>
        <!--DEBUT CONTENU-->
        <div class="kl_imagesListe container">
            <div class="" style="width: 100%; text-align: center;padding: 50px; ">
                <h1 style="text-transform: uppercase;font-weight: 800;font-size: 36px;"><?= $banniere_title ?></h1>
            </div>
            <?= $this->fetch('content') ?>
        </div>
        <!--FIN CONTENU-->
    </div>
        <footer>
            <div class="container">
                <p style="margin: 0;">
                    <a><img src="<?= $baseUrl ?>webroot/img/logo-noir.png" alt="Selfizee" class="img_footer"/></a><br />
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
                    <img alt="Selfizee" src="<?= $baseUrl ?>webroot/img/img-footer-galerie-login.png" class="img_footer_galerie">
                </p>
                <p>
                    <a class="btn btn-link-site" href="https://www.selfizee.fr" target="_blank">www.selfizee.fr</a>
                </p>
            </div>
        </footer>
</body>
</html>
