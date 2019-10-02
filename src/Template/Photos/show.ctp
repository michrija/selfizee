<?php use Cake\Collection\Collection; 
use Cake\Core\Configure; ?>
<?= $this->Html->css('photos/popup_photo.css') ?>
<?= $this->Html->css('galerieSouvenir/bootstrap.css') ?>
<?= $this->Html->script('pageSouvenir/desactirightclick.js?'.time()) ?>

<?php //debug(Configure::read("url_front_domaine"));die; ?>
<div class="kl_imagesAcommenter">
 
    <?php if($photo->type_media == 'video'){ ?>
    <!--video width="870" height="550" controls  poster="<?php //echo  $photo->url_miniature_video ?>"-->
    <video style="width:100%" controls  poster="<?php echo  $photo->url_miniature_video ?>">
        <source src="<?php echo  $photo->url_photo ?>" type="video/mp4">
        Your browser does not support the video tag or the file format of this video.
    </video>
   <?php } else{ ?>
        <img id="imgg" src="<?php echo  $photo->url_photo ?>" class="img-responsive kl_imageEvent" />
    <?php } ?>
    

    <div class="kl_contActionImage"> 
       
    </div>
</div>
<div class="kl_contShareSocial">
    <ul class=" kl_listSocial">
        <li> <?php
            
        if($is_required) { 
                        echo $this->Html->link(
                            "<i class='icon_souvenir_Download-01'></i>",                                 
                            '#',
                            ['id' =>'download_file','class' => 'kl_saveImg', 'escape' => false, 'data-toggle'=>'modal', 'data-target'=>'#modalBeforeDownload',  'style'=>'color:'.$couleur_download_link]
                            );  
                } else {
                        echo $this->Html->link(
                            "<i class='icon_souvenir_Download-01'></i>",
                            ['controller' => 'Photos', 'action' => 'download', $photo->id , 1],
                            ['id' =>'download_file','class' => 'kl_saveImg', 'escape' => false, 'style'=>'color:'.$couleur_download_link]
                            );
                }
            ?>
        </li>
        <li>
            <a href="#" onclick="javascript:share('<?= $photo->url_photo ?>')">
               <?= $this->Html->image('facebook.jpg') ?>
            </a>
        </li>
        <li>
            <?php 
            $hashTagTwiterr = "";
            $descTwit = "";
            if(!empty($photo->evenement->rs_configuration)){
                $hashTagTwiterr = $photo->evenement->rs_configuration->hashtag_twitter;
                $descTwit = $photo->evenement->rs_configuration->desc_twiter;
            }
            ?>
            
            <a title="Partager twitter" target="_blank" href="https://twitter.com/intent/tweet?url=<?= $photo->url_photo ?>&text=<?= $descTwit ?>&hashtags=<?= $hashTagTwiterr ?>">
              <?= $this->Html->image('twitter.jpg') ?>
            </a>
        </li>
        <li>
			<div class="a2a_kit hide">
				<a class="a2a_button_linkedin_share" id="a2a_button_linkedin_share" data-url="<?= $photo->url_photo ?>"></a>
			</div>
			<script async src="https://static.addtoany.com/menu/page.js"></script>
            <a title="Partager sur linkdin" class="a2a_button_linkedin_share_btn" target="_blank" href="">
              <?= $this->Html->image('linkedin.png') ?>
            </a>
        </li>
        
        <li class="hide">
         <a href="<?php echo Configure::read("url_front_domaine").'partages/instagram/'.$photo->token ?>" title="Partager Instagram"  id="link_share_instagram" onclick="javascript:window.open(this.href,
                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" >
               <?= $this->Html->image('instagram.jpg') ?>
             </a>
        </li>
        
        <div class="clearfix"></div>
    </ul>
    <div class="clearfix"></div>
    <?php // Vidéo ?>
    <?php
    if(!empty($pageSouvenir)){
        if($pageSouvenir->is_active_video_pub && !empty($pageSouvenir->url_video)){
            echo '<iframe class="sf-ps-video noness" src="'.trim($pageSouvenir->url_video).'">'.
            '</iframe>';
        }
    }
    ?>
    <div class="clearfix"></div>       
    <?php

    if($is_actif == ""){ $is_actif = '#';}
    // Bandeau bas
    if(!empty($pageSouvenir->img_bandeau)){
        echo '<div class="img-thumbnail-1 pdTop">'.            
            $this->Html->link($this -> Html -> image($pageSouvenir->url_bandeau), $is_actif , ['escape' => false,'target' =>'_blank']).
        '</div>';
    } 
    ?>
    <div class="clearfix"></div>
</div>
<div class="kl_conComment">
    <div class="fb-comments" data-href="<?= $photo->url_photo_souvenir ?>_picture" data-colorscheme="dark" data-numposts="5"></div>
</div>
<?php if(!$photo->evenement->is_marque_blanche) :?>
<div class="kl_imgPub">
    <a href="https://www.selfizee.fr" title="Borne photo photobooth">
        <?= $this->Html->image('bornephoto.jpg',["class"=>"img-responsive","alt"=>"Borne photobooth photos"]) ?>
    </a>
</div>
<?php endif;?>

                <?php /* if(!empty($pageSouvenir->champs)) { ?>
                    <?php foreach($pageSouvenir->champs as $champ) { 
                        if($champ->type_champ->id == 1) { // Text
                            //debug($champ);
                            if($champ->type_donnee->id == 1) { ?>

                                <div class="form-group">
                                    <label for="" class="control-label">Email *:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                            <?php } else { ?>

                                <div class="form-group">
                                    <label for="" class="control-label">Téléphone *:</label>
                                    <input type="number" name="telephone" class="form-control" required>
                                </div>
                            <?php }
                        } 

                        if($champ->type_champ->id == 2) { // Case à cocher
                            //debug($champ);die;
                            ?>
                            <label for="" class="control-label"><?= $champ->nom." :" ?></label>
                            <?php foreach($champ->champ_options as $option) {                            
                                echo $this->Form->control('published', ['type' => 'checkbox', 'label'=>$option->nom, 'class'=>'form-control' ]);
                            }
                        }

                        if($champ->type_champ->id == 4) { // QCM
                                //debug($champ);die;
                                ?>
                                <label for="" class="control-label"><?= $champ->nom." :" ?></label>
                                <?php foreach($champ->champ_options as $option) {                       
                                echo $this->Form->control('published', ['type' => 'checkbox', 'label'=>"  ".$option->nom, 'class'=>'form-control' ]);
                            }
                        }

                        if($champ->type_champ->id == 5) { // Liste deroulante
                                ?>
                                <label for="" class="control-label"><?= $champ->nom." :" ?></label> <br>
                                <?php 
                                $collection = new Collection($champ->champ_options);
                                $options = $collection->extract('nom')->toArray();
                                //debug($options);die;
                                //$options = [];
                                echo $this->Form->select('size', $options, ['empty' => 'Selectionner', 'class'=>'form-control']);
                        }
                        ?>
                <?php } }*/ ?>


<!--MODAL POPUP BEFORE DOWNLOAD-->

<?php if($is_required) { ?>
<div class="modal fade" id="modalBeforeDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Téléchargement de la photo</h4>
            </div>

            <div class="modal-header">
                 <label for="" class="control-label">Merci de renseigner le formulaire suivant pour lancer le téléchargement de votre photo.
                </label>
            </div>

            <?php  //['controller' => 'Photos', 'action' => 'download', $photo->id , 1],
            echo $this->Form->create(null, ['url'=>['controller' => 'ReponsesPageSouvenirs', 'action' => 'addResponse', $photo->id , 1] ,'type' => 'post','role'=>'form']); ?>
            <div class="modal-body">
                <div class="card card-outline-info">
                <input type="hidden" name="photo_id" value="<?= $photo->id ?>">
                <input type="hidden" name="page_souvenir_id" value="<?= $pageSouvenir->id ?>">
                <input type="hidden" name="evenement_id" value="<?= $photo->evenement_id ?>">

                <!-- CHAMPS -->
                <?php if(!empty($pageSouvenir->champs)) { ?>
                    <?php foreach($pageSouvenir->champs as $key => $champ) { 
                        echo $this->Form->hidden('champ_id[]', ['value'=>$champ->id]);
                        $is_champ_required = "";$is_obli = ""; if($champ->is_required) {$is_obli = "*"; $is_champ_required = "required"; };

                        if($champ->type_champ->id == 1) { // Text
                            if($champ->type_donnee->id == 1) { ?>
                                <div class="form-group">
                                    <label for="" class="control-label">Email <?= $is_obli ?>:</label>
                                    <input type="email" name="value_text[<?= $champ->id ?>][]" class="form-control" <?= $is_champ_required ?>>
                                </div>
                            <?php } else if($champ->type_donnee->id == 2) { ?> 
                                <div class="form-group">
                                <label for="" class="control-label">Téléphone <?= $is_obli ?>:</label> 
                                    <input type="number" name="value_text[<?= $champ->id ?>][]" class="form-control" <?= $is_champ_required ?>>
                                </div>

                            <?php } else { ?>
                                <div class="form-group">
                                    <label for="" class="control-label"><?= $champ->nom." ".$is_obli." :" ?></label>
                                    <input type="text" name="value_text[<?= $champ->id ?>][]" class="form-control" <?= $is_champ_required ?>>
                                </div>
                            <?php }
                        }

                        if($champ->type_champ->id == 2) { // Case à cocher
                            ?>
                            <label for="" class="control-label"><?= $champ->nom." ".$is_obli." :" ?></label>                             
                            <?php
                                $collection = new Collection($champ->champ_options);
                                $options = $collection->extract(function ($option) {

                                        $array = array();
                                        $array ['value'] = $option->id;
                                        $array ['text'] = '  '.$option->nom;
                                        //$array ['class'] = "";
                                        return $array;
                                });
                                //debug($options->toArray());
                                echo '<div class="form-group check_box">';
                                echo $this->Form->radio('champ_option_id.'.$champ->id, $options, ['required'=>$champ->is_required]);
                                echo '</div>';
                        }

                        if($champ->type_champ->id == 4) { // QCM
                                ?>
                                <label for="" class="custom-control custom-radio"><?= $champ->nom." ".$is_obli." :" ?></label>
                                <?php
                                $collection = new Collection($champ->champ_options);
                                $options = $collection->extract(function ($option) {

                                        $array = array();
                                        $array ['value'] = $option->id;
                                        $array ['text'] = '  '.$option->nom;
                                        $array ['class'] = "custom-control-input";
                                        return $array;
                                });
                                echo '<div class="form-group">';
                                    echo $this->Form->radio('champ_option_id.'.$champ->id, $options, ['required'=>$champ->is_required]);
                                echo '</div>';
                        }

                        if($champ->type_champ->id == 5) { // Liste deroulante
                                ?>
                                <label for="" class="control-label"><?= $champ->nom." ".$is_obli." :" ?></label><br>
                                <?php 
                                $collection = new Collection($champ->champ_options);
                                //$options = $collection->extract('nom')->toArray();
                                $options = [];
                                foreach($champ->champ_options as $option) {    
                                    $options[$option->id] = $option->nom;                             
                                }
                                echo '<div class="form-group">';
                                echo $this->Form->select('champ_option_id.'.$champ->id, $options, ['empty' => 'Selectionner', 'required'=>$champ->is_required]);
                                echo '</div>';
                        }

                        ?>
                <?php } } ?>
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary bord" id="valide_form_reponse">Valider</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<!--<script type="text/javascript">
    $('#valide_form_reponse').click(function(){
        $('#modalBeforeDownload').modal('hide');
    });
</script>-->
<?php } ?>

<?php if($is_required) { ?>
<!--<div class="modal fade" id="modalBeforeDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Téléchargements</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?php  //['controller' => 'Photos', 'action' => 'download', $photo->id , 1],
            echo $this->Form->create(null, ['url'=>['controller' => 'Photos', 'action' => 'downloadFromModalPageSouvenir', $photo->id , 1] ,'type' => 'get','role'=>'form']); ?>
            <div class="modal-body">
                <input type="hidden" name="photo_id" value="<?= $photo->id ?>">
                <input type="hidden" name="evenement_id" value="<?= $photo->evenement_id ?>">

                <?php if($downloadConfiguration->is_nom_active) { ?>
                <div class="form-group">
                    <label for="" class="control-label">Nom *:</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <?php } ?>

                <?php if($downloadConfiguration->is_prenoms_active) { ?>
                <div class="form-group">
                    <label for="" class="control-label">Prenom *:</label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>
                <?php } ?>

                <?php if($downloadConfiguration->is_tel_active) { ?>
                <div class="form-group">
                    <label for="" class="control-label">Téléphone *:</label>
                    <input type="number" name="telephone" class="form-control" required>
                </div>
                <?php } ?>

                <?php if($downloadConfiguration->is_email_active) { ?>
                <div class="form-group">
                    <label for="" class="control-label">Email *:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <?php } ?>


                <?php if($downloadConfiguration->is_optin_active) { ?>
                <div class="form-group">
                    <label for="" class="control-label">Optin *:</label>
                    <input type="text" name="optin" class="form-control" required>
                </div>
                <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>-->
<?php } ?>


         <script type="text/javascript">
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|windows phone/i.test(navigator.userAgent)) { 
                    //alert('Mobile');
                    //document.getElementById('link_share_instagram').setAttribute('href', 'http://localhost/event-selfizee-v2/PartageInstagram/instagrammobile');
                    //alert(link);
                    document.getElementById('link_share_instagram').setAttribute('href', <?php echo "'".Configure::read('url_front_domaine')."partages/instagram/".$photo->token."/1'" ?>);
                } else {
                     document.getElementById('link_share_instagram').setAttribute('href', <?php echo "'".Configure::read('url_front_domaine')."partages/instagram/".$photo->token."/0'" ?>);
                }
            </script>           