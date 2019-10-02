<div class="ajax-text-and-image white-popup-block">

    <div class="row kl_contentBlockPhoto">
        <div class="col-sm-7 kl_partieImg">
            <?php if($photo->type_media == 'video'){ ?>
                <video style="width:100%;height:auto;" controls  poster="<?php echo  $photo->url_miniature_video ?>" >
                    <source src="<?php echo  $photo->url_photo ?>" type="video/mp4">
                    Votre navigateur ne supporte pas cette vidéo
                </video>
           <?php } else{ ?>
                <!--<img  src="<?php echo  $photo->url_photo ?>" class="img-responsive" />-->
                <div style="background-image: url(<?php echo  $photo->url_photo ?>);" class="kl_imageInBackground"></div>
            <?php } ?>
        </div>
        <div class="col-sm-5 ">
            <div class="kl_rightDetails">
                <ul class="nav nav-pills kl_navDetails" id="id_navTab">
            			<li class="active" ><a href="javasciprt:void();" data-to="id_contentDetail" >details</a></li>
            			<li  ><a href="#" data-to="id_contentContact"  >contact</a></li>
            			<li><a href="javasciprt:void(0);" href="#" data-to="id_contentStat"   >Stat</a></li>
                        <div class="clearfix"></div>
            	</ul>
                <div id="contentTab">
                    <?php echo $this->element('Photos/detail',['photo'=>$photo]); ?>
                    <?php echo $this->element('Photos/contact',['photo'=>$photo]); ?>
                    <?php echo $this->element('Photos/stat',['photo'=>$photo]); ?>
                </div>
            </div>
            
        </div>
        <div class="clearfix"></div>
    </div>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
</div>