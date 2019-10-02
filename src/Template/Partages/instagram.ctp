<!DOCTYPE html>
<html class="d">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?= $this->Html->css('partinstagr/instagr.css') ?>


          <?php if($is_mobile == 0) { ?>

           <div class="aside">
              <div class="">
                <img class="" id="source" src="/img/insta.jpg" >
              </div>
            </div>

    
          <?php } else { ?>

      
          <div class="aside">
            <div class="a">
              
            </div>
            <div>
              
            </div>
            <div class="">
              <img class="" id="source" src="/img/instagramm.png" height="50px" width="50px">
            </div>
            <div class="b">              
            </div>
            <div>              
            </div>
            <div class="">
              <img id="source" src="<?php echo  $photo->url_photo ?>" />
            </div>
            <div class="c">              
            </div>
            <div>
              
            </div>
            <div style="font-weight: 500;">
                  <p> 1. Tapez et maintenez la photo </p>    
                  <p> 2. Partager sur instagram </p>
            </div>
  <?php } ?>

</body>
</html>