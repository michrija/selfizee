<!DOCTYPE HTML>
<?php 
use Cake\Routing\Router; 
$baseUrl = Router::url('/', true);
$urlPublic = $galery->url_public;
?>
<html manifest="<?php echo $baseUrl; ?>>offline.appcache">
<head>
    
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="author" content="Selfizee" />
    <meta name="description" content="Galerie photos souvenir des photos de l’événement " />
    <meta property="og:url"           content="<?= $urlPublic ?>"/>
    <meta property="og:image"           content="<?= $baseUrl.$this->request->getPath()?>"/>
    <meta property="og:title" content="<?= trim($galery['nom']) ; ?>" />
    <meta property="og:type" content="website" />
    <?php
    $descFb= "";
    if(!empty($rsConfiguration)){
       $descFb = $rsConfiguration->desc_facebook;
    }
    ?>
    <meta property="og:description" content="<?= $descFb ?>" />
    <title><?php echo ucfirst($galery['nom']);  ?></title>
    
    <?=   $this->Html->css('galerieSouvenir/style_galerie_brandeet.css',["data-cfasync"=>"false"]) ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap.css') ?>
    <?=   $this->Html->css('galerieSouvenir/mobile-souvenir_brandeet.css') ?>
    <?=   $this->Html->css('galerieSouvenir/bootstrap-select.css') ?>
    <?=   $this->Html->css('galerieSouvenir/font-awesome.css') ?>
    <?=   $this->Html->css('galerieSouvenir/normalize.min.css') ?>
    <?=   $this->Html->css('galerieSouvenir/magnific-popup.css') ?>
    <?=   $this->Html->css('galerieSouvenir/custom.css') ?>
    <?=   $this->Html->css('dropzone/dropzone.css') ?>
    <?=   $this->Html->css('font/Montserrat.css') ?>
    
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
   

    <script data-cfasync="false" >
        const URL_BASE = "<?= $baseUrl ?>";
        const is_galerie  = true;
        const album_id = <?= (int) $galery->id?>;
    </script>
    <?php
        $couleurTheme = $galery['couleur'];
        if(empty($couleurTheme)){
            $couleurTheme = "#000";
        }
    ?>
    <style>
        /*.kl_btnModal a.kl_btnModalDiapo{background-color:<?=$couleurTheme?> !important;}
        .kl_textHeader a.kl_btnModalDiapo{background-color:<?=$couleurTheme?> !important;}*/
        .kl_navMenu ul li a:hover, .kl_navMenu ul li a.active{
         -moz-box-shadow: inset 0px -5px 0px 0px <?= $couleurTheme ?> !important;
        -webkit-box-shadow: inset 0px -5px 0px 0px <?= $couleurTheme?>  !important;
        -o-box-shadow: inset 0px -5px 0px 0px <?= $couleurTheme?> !important;
        box-shadow: inset 0px -5px 0px 0px <?= $couleurTheme?> !important;
        filter:progid:DXImageTransform.Microsoft.Shadow(color=<?=$couleurTheme?>, Direction=90, Strength=0)
        }
        .kl_contForm input[type="submit"],.kl_modalEmail input[type="submit"]{background-color: <?=$couleurTheme?>;}
        .kl_hoverImgColor{background-color:<?= $couleurTheme?> !important;}
        .kl_descImage span,.kl_menuTopHeader li a:hover{color:<?= $couleurTheme?> !important;}
        .navbar-toggle .icon-bar ,.kl_shareImage .kl_boxShare,.kl_shareImage.in > a,.kl_commentaire input[type="submit"]{background-color:<?= $couleurTheme?> !important;}
        .kl_btnVoir_photo:hover{background: <?=$couleurTheme?> !important;}
        .kl_btnVoir_photo:hover{border:1px solid <?=$couleurTheme?> !important;}
        .kl_btnModal a:hover,.kl_title_popup{color:<?=$couleurTheme?> !important;}
    </style>
     <?= $this->fetch('script') ?>

        <!--==== SRCIPT GOOGLE ANALITYCS -->    
    <?php /*
            $ip = $_SERVER['REMOTE_ADDR'];
            //$clientDetails = json_decode(file_get_contents("https://ipapi.co/$ip/json"));
            $clientDetails = json_decode(file_get_contents("http://api.ipapi.com/$ip?access_key=d1ab09895394456e6166a6e0f29563c2"));
            //debug($clientDetails);
            $contryName = trim($clientDetails->country_name);
                
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
                            ga('set', 'page', '/galeries/souvenir/<?= $galery->id_encode ?>');
                            ga('send', 'pageview');
                </script>
    <?php } */ ?>

    <script>
        /*$.getJSON('https://ipapi.co/<?= $ip ?>/json', function(data) {
            //console.log(JSON.stringify(data, null, 2));
            //console.log(data);
        });*/
    </script>
</head>
<body>
    <input type="hidden" id="id_gallery" value="<?= $galery->id_encode ?>" />
    <header>
    
        <div class="kl_topHeader">
            <div class="container">

               <div class="pull-left">
                        <a href="#" class="kl_logoHeader">
                            <img src="<?= $this->Url->build('/img/logo-noir.png') ?>" class="mb-1"/>
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
                    <div class="pull-right kl_signOut">
                         <?php echo $this->Html->link(
		                     $this->Html->tag('i', '', array('class' => 'fa fa-sign-out')),
		                     ['controller' => 'Users', 'action' => 'logout', 1],
		                     ['escape' => false]
		                );
                                ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="kl_baniereGal" id="id_baniereGal">
                
                <img src="<?= $galery->url_banniere_souvenir ?>" class="img-responsive" />
            
                <div class="kl_textHeader text-center">
                    <div class="container">
                        <div class="clearfix"></div>
                        <?php
                            $titreHeader = $galery->titre;
                            if(empty($titreHeader)){
                                $titreHeader = $galery->evenements[0]->nom;
                            }
                        ?>
                        
                        <div class="kl_grosTitle kl_titleHeader">
                                <?= $titreHeader ?> 
                        </div>
                           
                        <div class="kl_subtitle"><?= $galery->sous_titre ?></div>
                        
                        <div class="clearfix"></div>
                        <?php 
                        if(!empty($photos->toArray())){
                            echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-download')).
                                '<span>Télécharger les medias</span>',
                                ['action' => 'download', $galery->id, 2 , $queue],
                                // ["class"=>"kl_btnVoir_photo",'escape' => false, 'data-id' => $galery->id, 'source' => 2, 'queue' => $queue]
                                ["class"=>"kl_btnVoir_photo sf-download-front",'escape' => false, 'data-id' => $galery->id, 'source' => 2, 'queue' => $queue]
                            );
                        }
                        ?>

                     </div>
               </div>
        </div>
    </header>   
    <div class="kl_contenu">
        <div class="kl_topGalerie">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="kl_descMobile">
                        <?php
                            $titreHeader = $galery->titre;
                            if(empty($titreHeader)){
                                $titreHeader = $galery->evenements[0]->nom;
                            }
                        ?>
                        
                        <div class="kl_grosTitle kl_titleHeader">
                                <?= $titreHeader ?> 
                        </div>
                            
                        <div class="kl_subtitle"><?= $galery->sous_titre ?></div>
                </div>
                <div class="pull-left kl_btnFiltre" id="id_btnFilter">
                    <i class="fa fa-search"></i>
                </div>
                
                <div class="clearfix"></div> 
            
            
        </div>
        <div class="navMobile" id="menuMobile">
                <ul class="kl_navbar_header" id="id_listMobile">
                    <li><a id="id_galerie" class="active"><i class="my_icon_file-text"></i>Galerie</a></li>
                    <?php if($galery->is_livredor_active){ ?>
                    <li><a id="id_remerciement"><i class="icon_web_web"></i>Livre d'or</a></li>
                    <?php } ?>
                    <li>
                        <?php //echo $this->Html->link(
                        //$this->Html->tag('i', '', array('class' => 'my_icon_Download-01')).'<span>Télécharger</span>',
                        //['action' => 'download',$galery->id, 2 , $queue],
                        //['escape' => false]
                        //);
                        ?>    
                        <?php 
                        
                        if(!empty($photos->toArray())){
                            echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'my_icon_Download-01')).'<span>Télécharger</span>',
                                ['action' => 'download',$galery->id, 2 , $queue],
                                //['escape' => false, 'data-id' => $galery->id, 'data-source' => 2, 'data-queue' => $queue],
                                // ['class' => 'sf-download-front', 'escape' => false, 'data-id' => $galery->id, 'data-source' => 2, 'data-queue' => $queue]
                                ["class"=>"sf-download-front",'escape' => false, 'data-id' => $galery->id, 'source' => 2, 'queue' => $queue]
                            );
                        }
                        
                        ?>  						
                    </li>
                    <!--<li class="kl_partageSocial dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="my_icon_Share-01"></i><span>Partager</span></a>
                        <ul class="dropdown-menu kl_socialHeader pull-right" aria-labelledby="dropdownMenu1">
                            <li><a href="https://plus.google.com/share?url=<?= $urlPublic ?>"
                                   title="Partager Google+" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?= $baseUrl ?>webroot/img/google.png" /></a></li>
                            <li id="twitter_top">
                                <a title="Partager twitter" onclick="open_popupShare('https://twitter.com/intent/tweet?url=<?= $urlPublic ?>&text=<?= !empty($rsConfiguration) ? $rsConfiguration->desc_twiter : "" ; ?>&hashtags=<?= !empty($rsConfiguration) ? $rsConfiguration->hashtag_twitter : "" ?>')" href="#">
                                   <?php echo $this->Html->image('twitter.png') ?>
                                </a>
                            </li>
                            <li id="fb_top" onmouseover="add_url_fbShare('<?= $urlPublic ?>')">
                                <a href="#" onclick="javascript:share('<?= $urlPublic ?>')"><img src="<?= $baseUrl ?>webroot/img/facebook.png" /></a>
                            </li>
                            <li><a href="#" onclick="open_popupShare('https://www.pinterest.com/pin/create/button/?url=<?= $urlPublic ?>&media=<?= $urlPublic ?>&description=Votre description')"><img src="<?= $baseUrl ?>webroot/img/pinterest.png" /></a></li>
                            <li><a href="mailto:?body=<?= $urlPublic ?>"><img src="<?= $baseUrl ?>webroot/img/email.png" /></a></li>
                        </ul>
                    </li>-->
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
                    <?php if($galery->is_livredor_active){ ?>
                    <ul class="nav navbar-nav">
                        <li><a id="id_galerie_mobile" class="active">Galerie</a></li>
                        <li><a id="id_remerciement_mobile">Livre d'or</a></li>
                    </ul>
                    <?php } ?>
                </div>
                <?php  echo $this->Form->create(null, ['type' => 'get','id'=>'id_theFiltre']); ?>
                <div class="pull-right" id="id_filtre">
                   <div class="pull-left kl_filterSelect kl_filterDesktop text-center">
                        <div class="form-inline">
                            <?php
                            //debug($galery);
                            if($galery->invited_can_upload_photo){
                            ?>
                               <?php
                                echo $this->Html->link(
                                    'Ajouter des photos',
                                    ['action'=>'souvenir', $idEncode,'addPhoto'],
                                    ['class' => 'kl_addPhotoInGalerie']
                                );
                                ?>
                                
                                <div class="form-group">
                                   <?php 
                                    $parSourceOptions = [0=>'Toutes les photos', 1 => 'Depuis la borne', 2 => 'Par les invités'];
                                    echo $this->Form->select('sourceGal', $parSourceOptions, ['default' => 0 ,'class' => 'selectpicker kl_select_triSouvernir', 'id'=>'select_triSource', 'value' => $sourceGal ]);
                                    ?>
                                    
                                </div>
                                <?php 
                                //debug($visiteurs->toArray());
                                if(!empty($visiteurs->toArray())){ ?>
                                <div class="form-group">
                                   <?php 
                                    //$parSourceOptions = [0=>'Toutes les photos', 1 => 'Depuis la borne', 2 => 'Par les invités'];
                                    echo $this->Form->select('visiteur', $visiteurs, ['empty' => 'Déposer par' ,'class' => 'selectpicker kl_select_triVisiteur', 'id'=>'select_triVisiteur', 'value' => $visiteur ]);
                                    ?>
                                    
                                </div>
                                <?php } ?>
                            
                            <?php } ?>
                           <div class="form-group">
                               <?php 
                               $dateOrder = intval($dateOrder);
                               //debug($dateOrder);
                                $dataOption = ['Trier', 0 => 'Par date croissante', 1 => 'Par date décroissante'];
                                echo $this->Form->select('dateOrder', $dataOption, ['default' => 0 ,'class' => 'selectpicker kl_select_triSouvernir ', 'id'=>'select_tri', 'value' => $dateOrder ]);
                                ?>
                                
                            </div>
                           
                            <div class="form-group">
                                <?php 
                                if(count($galery->evenements)>1){
                                    echo $this->Form->select('evenement_id', $evenementList, ['default' => 'Choissiez un évémenemt' ,'class' => 'selectpicker' ]);
                                }
                                ?>
                            </div>
                        </div>
                        <!--<div class="form-inline kl_contForm">
                            <div class="form-group">
                                <input type="text" placeholder="E-mail" name="key"  value="<?= $key ?>"/>
                                <input type="submit" value="" id="search_btn" />
                            </div>
                        </div>-->
                    </div> 
                    <?php if(!empty($nbrContactEmail)){ ?>
                    <div class="pull-right kl_contForm">
                            <input type="text" placeholder="E-mail" name="key"  value="<?= $key ?>"/>
                            <input type="submit" value="" id="search_btn" />
                            <div class="clearfix"></div>

                    </div> 
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                <?php echo $this->Form->end() ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <div>
        <div class="kl_blocRemerciement">
            <!--DEBUT Commentaires-->
            <?php 
            if($galery->is_livredor_active){ 
                echo $this->element('Galeries/commentaires',['galery'=> $galery]); 
            }
            ?>
            <!--FIN Commentaires-->
        </div>
        <!--DEBUT GALERIE-->
        <div class="kl_imagesListe">
            <!--<div class="kl_blockNoir"></div>-->
            <?= $this->fetch('content') ?>
        </div>
        <!--FIN GALERIE-->
    </div>
        <footer>
            <div class="container">
                <p >
                    <a><img src="<?= $this->Url->build('/img/logo-noir.png') ?>" alt="Selfizee" class="img_footer"/></a><br />
                </p>
                
                <div class="">
                    <div class="kl-txt-footer-1 kl-txt-gray montserrat">
                        Soirées privées ou professionnelles dans toutes la France :
                    </div>
                </div>
                <p class="kl-txt-gray montserrat">
                    mariages, anniversaires, salons et foires, séminaires, soirées événementielles...<br />
                </p>
                <p class="kl-img-footer-galerie-login">
                    <img alt="Selfizee" src="<?= $baseUrl ?>webroot/img/img-footer-galerie-login.png" class="img_footer_galerie">
                </p>
                <p>
                    <a class="btn btn-link-site montserrat" href="https://www.selfizee.fr" target="_blank">www.selfizee.fr</a>
                </p>
            </div>
        </footer>


<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
{lang: 'fr'}
</script>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>