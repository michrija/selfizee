<div  id="id_modalGalerie" >
    <div class="modal-dialog" role="document">
        <div class="modal-content kl_modalContent_desktop">
            <button type="button" class="close kl_toClose"  ><span >&times;</span></button>
            <div class="col-md-8 col-sm-6 kl_conLeftModal">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <div>
                        <div class="kl_btnModal text-center">
                            <ul>
                                <li id="btn_down_picture">
                                    <?php echo $this->Html->link(
                                        $this->Html->tag('i', '', array('class' => 'my_icon_Download-01')).'Télécharger',
                                        ['controller' => 'Photos', 'action' => 'download', $photo->id,2],
                                        ['escape' => false],
                                        ['class' => 'kl_saveImg','target' => '_blank',"id"=>"download_file"]
                                    );
                                    ?>
                                </li>
                                <li id="id_share_picture" class="kl_popup_shareImg">
                                    <?php  
                                    $rsConfiguration = $photo->evenement->rs_configuration; 
                                    $descTwitter = "";
                                    $hashTagTwitter = "";
                                    if(!empty($rsConfiguration)){
                                        $descTwitter = $rsConfiguration->desc_twiter;
                                        $hashTagTwitter = $rsConfiguration->hashtag_twitter;
                                    }
                                    
                                    ?>
                                    <a href='#' class='kl_popup_shareImg' >
                                        <i class='my_icon_Share-01'></i> Partager
                                    </a>
                                    <div class="kl_boxShare">
                                        <a class="kl_email" id="email_popup"  data-target="#modalMail" onclick="getPopupMail('#email_popup')"
                                            img="<?= $photo->url_photo ?>">
                                            <i class="fa fa-envelope"></i></a>
                                       

                                        <a href="#" class="kl_facebook_share" data-urltoshare="<?= $photo->url_photo_souvenir ?>" ><i class="fa fa-facebook-square "></i></a>
                                       
                                        <a  link-popup="https://twitter.com/intent/tweet?url=<?= $photo->url_photo_souvenir ?>&text=<?= urlencode($descTwitter) ; ?>&hashtags=<?= urlencode($hashTagTwitter) ?>" class="kl_twitter">
                                            <i class="fa fa-twitter-square "></i>
                                        </a>
                                        <a link-popup="<?= $photo->url_photo ?>" href="#" class="kl_pinterest" onclick="open_popupShare($(this).attr('link-popup'))"
                                           data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" href="#" >
                                            <i class="fa fa-pinterest-square "></i>
                                        </a>


                                    </div>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(
                                        $this->Html->tag('i', '', array('class' => 'my_icon_play3')).'Diaporama',
                                        ['controller' => 'Galeries', 'action' => 'diapo', $galery->id_encode],
                                        ['escape' => false],
                                        ['class' => 'kl_btnModalDiapo pull-right','target' => '_blank']
                                    );
                                    ?>
                                </li>
                            </ul>
                            <div class="bloc_imgPopup">
                                <?php if($photo->type_media == 'video'){ ?>
                                <video style="width:100%" controls  poster="<?php echo  $photo->url_miniature_video ?>">
                                    <source src="<?php echo  $photo->url_photo ?>" type="video/mp4">
                                    Your browser does not support the video tag or the file format of this video.
                                </video>
                               <?php } else{ ?>
                                    <img src="<?=$photo->url_photo ?>" spd_id="<?= $photo->id ?>"  class="kl_theRealImage"  />
                                <?php } ?>
							
                                <!--img src="<?=$photo->url_photo ?>" spd_id="<?= $photo->id ?>"  class="kl_theRealImage"  /-->
                                
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 kl_conRightModal">
                <div class="kl_rightModal">
                    <div class="kl_boxHeaderModal">
                        <?php 
                        $titreGal = $galery->nom; 
                        if(empty($titreGal)){
                            $titreGal = $photo->evenement->nom;
                        }
                        ?>
                        
                        <div class="text-center kl_titleHeader">
                                <?= $titreGal ?>
                                <span class="kl_border_bottom"></span>
                        </div>
                    </div>
                    <div class="kl_blocFbModal">

                        <div class="kl_nbrVue" id="picture_view">
                            <?php
                            if($photo->nbr_vue > 1){ 
                                $photo->nbr_vue.' vues pour cette photo actuellement';
                            }else{
                                $photo->nbr_vue.' vue pour cette photo actuellement';
                            }
                            ?>
                        </div>

                        <!-- Your like button code -->

                        <div class="kl_conComment">
                            <div id="commebt_fb" class="fb-comments" data-href="<?=$photo->url_photo?>" data-colorscheme="dark" data-numposts="5" data-width="100%"></div>
                        </div>
                        <?php if(!$galery->is_public) :?>
                            <div class="kl_formCommentaire">
                                <h4>Laisser un commentaire</h4>
                                <!--<form class="kl_commentaire" id="comment_picture_form" method="post">
                                    <textarea placeholder="Votre commentaire *" name="content" required="required"></textarea>
                                    <input type="text" placeholder="Votre nom *" name="name" required="required"/>
                                    <input type="hidden" name="spd_id" value="<?= $photo->evenement->id ?>">
                                    <input type="submit" value="Commenter" />
                                </form>-->
                                
                                <?= $this->Form->create($photoCommentaire, ['url' => ['controller' => 'PhotoCommentaires', 'action' => 'add'], 'id'=>'photoCommentaires', 'class'=>'kl_commentaire']) ?>
                                <?php
                                    echo $this->Form->control('commentaire',['id'=>'id_commentairePhoto',"placeholder"=>"Votre commentaire *", 'required' => true,'label'=>false]);
                                    echo $this->Form->control('commentateur_name',['id'=>'id_commentateurNamePhoto',"required"=>true,'label'=>false,"placeholder"=>"Votre nom *"]);
                                    echo $this->Form->hidden('photo_id', ['value' => $photo->id,'id'=>'id_theIdPhoto']);
                                ?>
                                
                                <?= $this->Form->submit(__('Commenter'),['id'=>'id_sendCommentairePhoto',"class"=>"pull-right"]) ?>
                                
                                <?= $this->Form->end() ?>
                            </div>
                            <div class="clearfix"></div>
                            <div id="id_blocCommentairePhotos">
                                <?php echo $this->element('Galeries/commentaires_photo',['photoCommentaires'=> $photoCommentaires,'maxLimit' => $maxLimit]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <div class="clearfix bg-white"></div>
        </div>


        <!----modal mobile--->
        <div class="modal-content kl_modalContent_mobile">
          <button type="button" class="close kl_toClose"  ><span >&times;</span></button>
          <div class="kl_infoMobile">
            <?= $this->Html->image('information.png') ?>
            <!--<i class="fa fa-ellipsis-h"></i>-->
            <i class="fa fa-angle-left"></i>
          </div>
          <div class="kl_contInfo">
                <div class="kl_descImage text-center">Photo prise par <span id="user_posted"></span> le <label id="date_post"></label></div>                <div class="kl_contTitle">
                    <h4>Titre ou légende :</h4>
                    <span>Lorem ipsum</span>
                </div>
                <div class="kl_contTitle">
                    <h4>Description :</h4>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>
                </div>
                <div class="kl_contTitle">
                    <h4>Mot clés :</h4>
                    <span>Mot clé1 - Mot clé2 - Mot clé3</span>
                </div>
          </div>
          <div class="col-md-7 col-sm-6 kl_conLeftModal">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                
                            
                <div id="item_carousel" class="carousel-inner text-center" role="listbox">
                    
                    <img src="<?= $photo->url_photo ?>" spd_id="<?= $photo->id ?>" class="kl_theRealImage"   >


                </div>
                
                <div class="kl_btnModal">
                        <ul>
                                <li id="btn_down_picture">
                                    <?php echo $this->Html->link(
                                        $this->Html->tag('i', '', array('class' => 'my_icon_Download-01')).'Télécharger',
                                        ['controller' => 'Photos', 'action' => 'download', $photo->id],
                                        ['escape' => false],
                                        ['class' => 'kl_saveImg','target' => '_blank',"id"=>"download_file"]
                                    );
                                    ?>
                                </li>
                                <li id="id_comment_picture"><a><i class="fa fa-comment"></i>Commenter</a></li>
                                <li id="id_share_picture" class="kl_popup_shareImg">
                                    <?php  $rsConfiguration = $photo->evenement->rs_configuration; ?>
                                    <a href='#' class='kl_popup_shareImg' onmouseover="getShortLink('<?= $photo->url_photo ?>','id_share_picture',<?= $photo->id?>)">
                                        <i class='my_icon_Share-01'></i> Partager</a>
                                    <div class="kl_boxShare">

                                       <a class="kl_email" id="email_popup"  data-target="#modalMail" onclick="getPopupMail('#email_popup')"
                                            img="<?= $photo->url_photo?>">
                                            <i class="fa fa-envelope"></i></a>
                                        <a disabled="disabled" href="https://plus.google.com/share?url=shareLink"
                                           title="Partager Google+"  class="kl_googlePlus"><i class="fa fa-google-plus-square "></i></a>
                                        <a disabled="disabled" href="#" class="kl_pinterest" onclick="open_popupShare($(this).attr('link-popup'))"
                                           data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" href="#" >
                                            <i class="fa fa-pinterest-square "></i>
                                        </a>
                                        <a disabled="disabled" link-popup="https://twitter.com/intent/tweet?url=shareLink&text=<?= urlencode($rsConfiguration->desc_twiter) ; ?>&hashtags=<?= urlencode($rsConfiguration->hashtag_twitter) ?>" class="kl_twitter">
                                            <i class="fa fa-twitter-square "></i>
                                        </a>
                                        <a href="#" class="kl_facebook" disabled="disabled"><i class="fa fa-facebook-square "></i></a>


                                        <!--<a href="#" class="kl_instagram"><i class="fa fa-instagram "></i></a>-->

                                        <!--<a href="#" class="kl_whatsapp"><i class="fa fa-whatsapp "></i></a>-->
                                        <!--<a href="#" class="kl_linkedin"><i class="fa fa-linkedin-square"></i></a-->

                                    </div>
                                </li>
                            </ul>
                        <div class="clearfix"></div>
                    </div>
            </div>
          </div>
          <div class="col-md-5 col-sm-6 kl_conRightModal">
            <div class="kl_rightModal">
                <div class="kl_closeComment pull-right"><i class="fa fa-reply"></i></div>
                <div class="kl_blocFbModal">
                    
                    <div class="kl_nbrVue" id="picture_view">
                           <?php
                            if($photo->nbr_vue > 1){ 
                                $photo->nbr_vue.' vues pour cette photo actuellement';
                            }else{
                                $photo->nbr_vue.' vue pour cette photo actuellement';
                            }
                            ?>
                        </div>
                    

                    <!-- Your like button code -->

                     <div class="kl_conComment">
                         <?php if($galery->is_public==0) :?>
                             <div class="kl_formCommentaire">
                                 <h4>Laisser un commentaire</h4>
                                 <form class="kl_commentaire" id="comment_picture_formMobile" method="post">
                                     <textarea placeholder="Votre commentaire *" name="content" required="required"></textarea>
                                     <input type="text" placeholder="Votre nom *" name="name" required="required"/>
                                     <input type="hidden" name="spd_id" value="<?= $photo->id ?>">
                                     <input type="submit" value="Commenter" />
                                 </form>
                             </div>
                             <div class="kl_liste_commentaire hidden">
                                 <div class="kl_topCommentaire">
                                     <div class="pull-left"><span id="count_comment_pictureMobile"></span> </div>
                                     <div class="kl_filtreCommentaire">
                                         <label>Affichage par</label>
                                         <select class="selectpicker select-mobile-affichage" id="maxLimit_pictureMobile">
                                             <?php for($_i = 0;$_i<101;$_i+=10) :?>
                                                 <?php if($_i==0) continue;?>
                                                 <option value="<?= $_i ?>"><?= $_i ?></option>
                                             <?php endfor;?>
                                             <option value="0"><?= __("Afficher tout") ?></option>
                                         </select>
                                     </div>
                                     <div class="clearfix"></div>
                                 </div>
                             </div>
                             <div class="kl_contCommentaire hidden" id="bloc_comment_pictureMobile">

                             </div>
                         <?php endif; ?>
                            <div id="commebt_fb_mobile" class="fb-comments" data-href="<?= $photo->url_photo ?>" data-colorscheme="dark" data-numposts="5" data-width="100%"></div>
                    </div>

                </div>
            </div>
          </div>
            
          <div class="clearfix"></div>
        </div>
    </div>
</div>
<script type="text/javascript" data-cfasync="false">
//<![CDATA[
	console.log(t_imgLoaded);
    current_spd_id = "<?= $photo->id;?>";
    var is_public = "<?= $galery->is_public ?>";

    if(parseInt(is_public)==1){
        eval(getPluginCommentFb());
        FB.XFBML.parse();
    }
	
	eval(popupMobile());
    eval(getComment_picture("<?= $photo->id;?>"));
    
    eval(exec_swipe());
    eval(heightPopup());
    $("#btn_partage_fb").removeAttr("disabled");
   
//]]>
</script>
