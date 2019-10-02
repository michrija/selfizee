<div class="ajax-text-and-image white-popup-block">
    <div class="row">
        <div class="col-sm-7  kl_partieImg">
            <img src="<?= $photo->url_photo ?>">
        </div>
        <div class="col-sm-5 ">
            <div class="kl_rightDetails">
                <div class="nav nav-pills kl_navDetailsDiv" id="id_navTab">
            			<a href="javasciprt:void();" data-to="id_contentDetail" >details</a>
            	</div>
                <div id="contentTab">
                    <?php //echo $this->element('Photos/detail',['photo'=>$photo]); ?>
                    <div class="kl_contentDetail  kl_contentTab" id="id_contentDetail">
                        <div class="kl_titreDetail">Photo déposée par :</div>
                        <div class="kl_reponseDetailPrise">
                            <div><strong>Nom : </strong><?php echo $photo->visiteur->full_name;?></div>
                            <div><strong>E-mail : </strong><?php echo $photo->visiteur->email;?></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="clearfix"></div>
    </div>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
</div>