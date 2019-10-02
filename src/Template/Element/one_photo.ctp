<li id="img_bloc_<?= $key ?>" spd_id="<?= $photo->id ?>"   class="kl_onePhoto" current_page="<?= $page ?>" >
<?php
	$bloc_img = 
	$style_img = 
	$photo_thumb = 
	$style_bloc = '';
	if($photo -> type_media == 'video'){
		$video_thumb = $photo->url_miniature_video;
		$photo_thumb = '/img/icon-play.png';
		$style_img = ' style="width:100px !important;margin: auto;margin-top:58px;" ';
		$style_bloc = ' style="background: black;background-image:url('.$video_thumb.');height: 210px !important;"';
		$bloc_img = '<div class="sf-video" '.$style_bloc.'><img src="'.$photo_thumb.'" alt="'.$photo->created.'" '.$style_img.'/></div>';
	}else{
		$photo_thumb = $photo->url_thumb_souv;
		$bloc_img = '<img  src="'.$photo_thumb.'"/>';
	}
?>
        <!--img  src="<?= $photo->url_thumb_souv; ?> "/-->
		<?php echo $bloc_img; ?>
		
        <div class="kl_hoverImgColor">
        </div>
        <div class="kl_hoverImg">
            <ul class="pull-right">
            <li class="kl_down_picture">
            <?php
                echo $this->Html->link(
                        $this->Html->image('down.png'),                          		 
                        ['controller' => 'Photos', 'action' => 'download', $photo->id,2, $queue], 
                        ['id' =>'download_file','class' => 'kl_saveImg', 'escape' => false]
                    );  
            ?>    	
                
            </li>
            <li class="kl_shareImage"><a href="#"><?= $this->Html->image('share.png') ?></a>
                <div class="kl_boxShare">
                    <a class="kl_email"  data-target="#modalMail"><i class="fa fa-envelope"></i></a>
                    
                    <a href="#" class="kl_facebook_share" data-urltoshare="<?= $photo->url_photo_souvenir ?>" ><i class="fa fa-facebook-square "></i></a>
                    
                    <?php
                        $descTwitter = "";
                        $hasTagTwitter = "";
                        if(!empty($rsConfiguration)){
                            $descTwitter = $rsConfiguration->desc_twiter;
                            $hasTagTwitter = $rsConfiguration->hashtag_twitter;
                        } 
                    ?>
                  
                    <a  link-popup="https://twitter.com/intent/tweet?url=<?= $photo->url_photo_souvenir ?>&text=<?= urlencode($descTwitter) ; ?>&hashtags=<?= urlencode($hasTagTwitter) ?>" class="kl_twitter">
                        <i class="fa fa-twitter-square "></i>
                    </a>

                    <a href="#" class="kl_pinterest"  link-popup="https://www.pinterest.com/pin/create/button/?url=<?= $photo->url_photo ?>&media=<?= $photo->url_photo ?>&description=" 
                       data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" href="#" >
                        <i class="fa fa-pinterest-square "></i>
                    </a>
                   
                   
                </div>
            </li>
            
        </ul>
        <div class="kl_contAgr">
           <div class="kl_agrandir">
                <?php
                  
                      echo $this->Html->link(
                          '<span>AGRANDIR</span>',
                          ['controller' => 'Galeries', 'action' => 'popupImage',$photo->id, $galery->id],
                          ['escape' => false,'class' => 'text-center kl_toAgrandir']

                      );
                  
                ?>  
                        
            </div> 
        </div>
    </div>
</li>