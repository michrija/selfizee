
ALTER TABLE `client_contacts` ADD `is_by_webhooks` TINYINT(1) NOT NULL DEFAULT '0' AFTER `modified`;

ALTER TABLE `clients` ADD `is_by_webhooks` TINYINT(1) NOT NULL DEFAULT '0' AFTER `modified`;

<!-- Google Analytics -->
<?php 
$ip = $_SERVER['REMOTE_ADDR'];
$clientDetails = json_decode(file_get_contents("https://ipapi.co/$ip/json"));
$contryName = trim($clientDetails->country_name);//echo $ip;//echo $contryName;
	
if($contryName != 'Madagascar' ){ ?>

<?php } ?>
<!-- End Google Analytics -->
?>

<!--==== SRCIPT GOOGLE ANALITYCS -->
  	<?php 
        /*$ip = $_SERVER['REMOTE_ADDR'];
        $clientDetails = json_decode(file_get_contents("https://ipapi.co/$ip/json"));
        $contryName = trim($clientDetails->country_name);//echo $ip;//echo $contryName;
            
        if($contryName != 'Madagascar' ) { ?>     
		    <!-- Global site tag (gtag.js) - Google Analytics -->
		    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132418946-2"></script>
		    <script>
		      window.dataLayer = window.dataLayer || [];
		      function gtag(){dataLayer.push(arguments);}
		      gtag('js', new Date());

		      gtag('config', 'UA-132418946-2');
		    </script>

        <?php }*/ ?> 

        ==== DEFAULT LAYOUT

        <!--==== SRCIPT GOOGLE ANALITYCS -->
    <?php 
        $ip = $_SERVER['REMOTE_ADDR'];
        $clientDetails = json_decode(file_get_contents("https://ipapi.co/$ip/json"));
        $contryName = trim($clientDetails->country_name);//echo $ip;//echo $contryName;
            
        if($contryName != 'Madagascar' ) { ?>   
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
                <?php if(empty($isConfiguration)){ ?>
                	ga('set', 'page', '/evenements/view/<?= $evenement->id ?>');
                <?php } else { ?>
               		ga('set', 'page', '/evenements/edit/<?= $evenement->id ?>');  
               	<?php } ?>
                ga('send', 'pageview');
            </script>
    <?php } ?>