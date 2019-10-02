<div class="kl_imagesAcommenter">
 
 
    <img src="<?php echo  $urlPhotoTest ?>" class="img-responsive " />
    

    <div class="kl_contActionImage">
       
    </div>
</div>
<div class="kl_contShareSocial">
    <ul class=" kl_listSocial">
        <li> <?php

      		echo $this->Html->link(
                            "<i class='icon_souvenir_Download-01'></i>",                          		 
                            ['#'],
                            ['id' =>'download_file','class' => 'kl_saveImg', 'escape' => false]
                            );  
                ?> </li>
        <li>
            <a href="#" onclick="javascript:share('<?= $urlPhotoTest ?>')">
               <?= $this->Html->image('facebook.jpg') ?>
            </a>
        </li>
        <li>
            <?php 
            $hashTagTwiterr = "";
            $descTwit = "";
            if(!empty($evenement->rs_configuration)){
                $hashTagTwiterr = $evenement->rs_configuration->hashtag_twitter;
                $descTwit = $evenement->rs_configuration->desc_twiter;
            }
            ?>
            
            <a title="Partager twitter" target="_blank" href="https://twitter.com/intent/tweet?url=<?= $urlPhotoTest ?>&text=<?= $descTwit ?>&hashtags=<?= $hashTagTwiterr ?>">
              <?= $this->Html->image('twitter.jpg') ?>
            </a>
        </li>
        <li>
            <a href="https://plus.google.com/share?url=<?= $urlPhotoTest; ?>" title="Partager Google+" onclick="javascript:window.open(this.href,
                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
               <?= $this->Html->image('google.jpg') ?>
            </a>
        </li>
        
    </ul>
	<div class="clearfix"></div>
	<?php // Vidéo ?>
	<?php
	if(!empty($evenement->page_souvenir->url_video)){
		echo '<iframe class="sf-ps-video" src="'.trim($evenement->page_souvenir->url_video).'">'.
		'</iframe>';
	}
	?>
	<div class="clearfix"></div>
	<?php
	// Bandeau bas
	if(!empty($evenement->page_souvenir->img_bandeau)){
		echo '<div class="img-thumbnail-1">'.
			$this -> Html -> image($evenement->page_souvenir->url_bandeau).
		'</div>';
	} 
	?>
    <div class="clearfix"></div>
</div>
<div class="kl_conComment">
    <div class="fb-comments" data-href="<?= $urlPhotoTest ?>_picture" data-colorscheme="dark" data-numposts="5"></div>
</div>

<?php if(!$evenement->is_marque_blanche) :?>
<div class="kl_imgPub">
    <a href="https://www.selfizee.fr" title="Borne photo photobooth">
        <?= $this->Html->image('bornephoto.jpg',["class"=>"img-responsive","alt"=>"Borne photobooth photos"]) ?>
    </a>
</div>
<?php endif;?>