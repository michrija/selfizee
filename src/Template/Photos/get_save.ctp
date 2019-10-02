<?= $this->Html->css('photos/pictures.css') ?>
<div id="carousel-example-generic" class="carousel slide kl_mfpContent" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="item active row">
      <div class="col-sm-7 kl_contLeftDetails">
            <div class="kl_leftDetail text-center">
                
                <img src="<?= $photo->url_photo ?>" class="img-fluid mfp-img" />
            </div>
       </div>
      <div class="col-sm-5 kl_contRightDetails">
        <div class="">
        <div class="kl_rightDetails">
          <ul  class="nav nav-pills kl_navDetails">
    			<li class="active"><a  href="#details" data-toggle="tab">details</a></li>
    			<li><a href="#informations" data-toggle="tab">informations</a></li>
    			<li><a href="#contacts" data-toggle="tab" id="id_contactTab">contact</a></li>
    			<li><a href="#statistique" data-toggle="tab" id="id_statTab">Stat</a></li>
    		</ul>

		<div class="tab-content clearfix">
		    <div class="tab-pane active " id="details">
                <?php if(empty($photo->date_capture) && empty($photo->user->name)) {  ?>
                <div class="kl_detailsVide text-center  ">
                    <?= $this->Html->image('detailsVide.png') ?>
                    <div>Aucun detail</div>
                    <button id="id_addDetails">Ajouter detail</button>
                </div>
                <?php } else { ?>
                <div class="text-center">
                    <div class="kl_contDtl" id="id_datePick">
                        <strong>Photo prise le :</strong>
                        <input type="text" class="kl_theDateAdd" data-format="dd/MM/yyyy" value="<?= h(date('d/m/Y', $photo->date_capture)) ?>" disabled="" />
                        <span class="add-on kl_timePick">
                          <i class="fa fa-calendar" data-date-icon="icon-calendar">
                          </i>
                        </span>

                        <!--input type="text" class="kl_theDatePicker" value="<?= h(date('d/m/Y', $photo->date_capture)) ?>" disabled="" /-->
                    </div>
                    <div class="kl_contDtl" id="id_timePick">
                        <strong>Heure :</strong>
                        <span class="kl_theHeureAddTxt"><?= h(date('H', $photo->date_capture).' h '.date('i', $photo->date_capture)) ?></span>
                        <input type="text" class="kl_theHeureAdd hide"  data-format="hh:mm" value="<?= h(date('H:i', $photo->date_capture)) ?>" disabled="" />
                        <span class="add-on kl_timePick">
                          <i class="fa fa-clock-o" data-date-icon="icon-calendar">
                          </i>
                        </span>
                    </div>
                    <!--<div class="kl_contDtl">
                        <strong>Lieu :</strong>
                        <input type="text" value="Paris France" disabled="" />
                    </div>-->
                    <div class="kl_contDtl">
                        <strong>Ajouté par :</strong>
                        <!--<input type="text" value="<?= h( $photo->user->login) ?>" disabled="" />-->
                        <span><?= h( $photo->user->login) ?></span>
                    </div>
                    <div class="kl_contDtl">
                        <strong>Peut être utilisée à des fins commerciales ?</strong>
                        <span>
                        <?php 
                        if( $photo->is_commercial == 1){
                            echo 'Oui';
                        }else if($photo->is_commercial == 2){
                            echo 'Non';
                        }else{
                            echo 'Pas de réponse';
                        }
                        ?>
                        </span>
                    </div>
                    <div class="kl_contDtl">
                        <span id="id_editChampDetail">
                            <?= $this->Html->image('btnEditer.png') ?>
                        </span>
                        <a href="#" class="btn btn-success   kl_saveDetail hide" id="id_saveDetail_<?= $photo->id_picture ?>" cadre="<?= $photo->id_cadre ?>">Enregister</a>
                        <input type="button" value="Annuler" class="kl_cancel_details hide" />
                    </div>
                    <div class="kl_contDtl">
                        <button class="kl_deleteInPopupImage" id="id_pictuPop_<?= h($photo->id_picture) ?>">
                        <i class="fa fa-trash" ></i> supprimer la photo
                        <?= $this->Html->image('loading_bl.svg',['class'=>'hide kl_loader']) ?>
                        </button>
                        <!-- p/'.$_picture->token -->
                        <div class="kl_text-center">
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-file-image-o" aria-hidden="true"></i> Page souvenir',
                                '/p/'.$photo->token,
                                ['escape' => false,'class' => 'btn btn-success  kl_lienPagesouvenir', 'target' => '_blank']
                            );
                        ?>
                        </div>
                        <div class="kl_text-center">
                        <?php 
                           echo $this->Html->link('<i class="fa fa-cloud-download" aria-hidden="true"></i> Télécharger la photo', ['controller' => 'Pictures', 'action' => 'download', $photo->token],['class' => 'btn btn-success  kl_lienDownloadFile','escape' => false]);
                        ?>
                        </div>
                        <div class="kl_text-center kl_bloc_send_email hidden">
                            <button  id_picture="<?= h($photo->id_picture) ?>" class="kl_send_mail">
                            <i class="fa fa-envelope" ></i> envoyer email à tous les contacts
                            <?= $this->Html->image('loading_bl.svg',['class'=>'hide kl_loader']) ?>
                            </button>
                        </div>
                        <div class="kl_text-center kl_bloc_send_sms hidden">
                            <button  id_picture="<?= h($photo->id_picture) ?>" class="kl_send_sms">
                            <i class="fa kl_sendMessage" ></i> envoyer sms à tous les contacts
                            <?= $this->Html->image('loading_bl.svg',['class'=>'hide kl_loader']) ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="text-center kl_addDetails hidden">
                    <div class="kl_contDtl">
                        <strong>Photo prise le :</strong>
                        <input type="text" value=""  />
                    </div>
                    <div class="kl_contDtl">
                        <strong>Heure :</strong>
                        <input type="text" value=""  />
                    </div>
                    <div class="kl_contDtl">
                        <strong>Lieu :</strong>
                        <input type="text" value="" />
                    </div>
                    <div class="kl_contDtl">
                        <strong>Ajouté par :</strong>
                        <input type="text" value="" />
                    </div>
                    <div class="kl_contDtl">
                        <button class="btn">
                        Ajouter
                        </button>
                    </div>
                </div>
            </div>
			<div class="tab-pane " id="informations">
                <?php if( 
                   ( empty($photo->title)  || $photo->title == "NULL"  || $photo->title == "(null)" )
                && ( empty($photo->description) || $photo->description == "NULL" || $photo->description == "(null)"  )
                && ( empty($photo->keywords) || $photo->keywords == "NULL" || $photo->keywords == "(null)"  )
                
                ) { ?>
                <div class="kl_detailsVide text-center">
                    <?= $this->Html->image('infoVide.png') ?>
                    <div>Aucune information pour cette photo</div>
                    <button id="id_addInfo">Ajouter une information</button>
                </div>  
                <?php } else { ?>
                 <div class="text-center ">
                    <div class="kl_contDtl">
                        <strong>Titre ou légende</strong>
                        <input type="text" class="kl_titreInfo" value="<?= h( $photo->title) ?>" disabled="" />
                    </div>
                    <div class="kl_contDtl">
                        <strong>Description</strong>
                        <textarea disabled class="kl_descInfo">
                           <?= h( $photo->description) ?>
                        </textarea>
                    </div>
                    <div class="kl_contDtl">
                        <strong>Mots clés</strong>
                        <div class="kl_champKey hide">
                            <input type="text" class="kl_newKeyword" />
                            <a href="#" class="kl_addKeyWord right-align" id="id_picture_<?= $photo->id_picture?>"><i class="fa fa-plus-circle"></i></a>
                        </div>
                        <div class="kl_listeKeyword kl_hideEdit">
                            <?php foreach($photo->keywords as $keyword){ ?>
                            <span class="kl_onekeyWord " id="id_oneKeyWord_<?=$keyword->id_keyword?>">
                               <?= '#'.$keyword->keyword ?><a class="kl_removeKey" id="id_theKey_<?= $keyword->id_keyword ?>" href="#"><i class="fa fa-times-circle"></i></a>
                           </span>
                           <?php  } ?>
                            
                       </div>
                    </div>
                    <div class="">
                        <span id="id_editChampInfo">
                            <?= $this->Html->image('btnEditer.png') ?>
                        </span>
                        <a href="#" class="btn btn-success   kl_saveInfo hide" id="id_saveInfo_<?= $photo->id_picture ?>" cadre="<?= $photo->id_cadre ?>">Enregister</a>
                        <input type="button" value="Annuler" class="kl_cancel_info btn hide" />
                    </div>
                </div>
                
                <?php } ?>
                <div class="text-center hidden kl_ajoutInfo">
                    <div class="kl_contDtl">
                        <strong>Titre ou légende</strong>
                        <input class="kl_titreInfo" type="text" value=""  />
                    </div>
                    <div class="kl_contDtl">
                        <strong>Description</strong>
                        <textarea class="kl_descInfo"></textarea>
                    </div>
                    <div class="kl_contDtl">
                        <strong>Mots clés</strong>
                        <div class="kl_champKey">
                            <input type="text" class="kl_newKeyword" />
                            <a href="#" class="kl_addKeyWord right-align" id="id_picture_<?= $photo->id_picture?>"><i class="fa fa-plus-circle"></i></a>
                        </div>
                        <div class="kl_listeKeyword "></div>
                    </div>
                    <div class="">
                        <span id="id_editChampInfo" class="hide">
                            <?= $this->Html->image('btnEditer.png') ?>
                        </span>
                        <a href="#" class="btn btn-success kl_saveInfo " id="id_saveInfo_<?= $photo->id_picture ?>" cadre="<?= $photo->id_cadre ?>">Enregister</a>
                        <input type="button" value="Annuler" class="kl_cancel_infoAdd  btn hide" />
                    </div>
                </div>
                
			</div>
            <div class="tab-pane kl_tabContact kl_contactListe" id="contacts">
                <?php if(empty($photo->picture_contacts)){ ?>
                <div class="kl_detailsVide text-center ">
                    <?= $this->Html->image('contactVide.png') ?>
                    <div>Cette photo n’a pas de contact</div>
                    <button class="kl_addOneContact">Ajouter un contact</button>
                </div>
                <div class="kl_addContact hide">
                    <?php //$this->element('admin/add_contact_picture',['picture'=>$photo, 'countrys'=>$countrys]) ?>
                </div>
                <?php } else{ ?>
                     <?php //$this->element('admin/liste_contact_picture',['picture'=>$photo, 'countrys'=>$countrys])?>
                <?php } ?>
			</div>
            <div class="tab-pane kl_tabStat text-center" id="statistique">
                <div class="kl_contDtl">
                    <strong>Nombre de télechargement :</strong>
                    <span>0</span>
                </div>
                <?php if(!empty($photo->picture_downloads)) :
                    $_last_down = count($photo->picture_downloads)-1;
                 ?>
                    <div class="kl_contDtl">
                        <strong>Date du dernier télechargement :</strong>
                        <span><?=  date("d/m/Y",$photo->picture_downloads[$_last_down]->picture_download_date_add)?></span>
                    </div>
                <?php endif;?>
                <?php if(!empty($photo->envois)) :?>
                    <div class="kl_contDtl">
                        <?php foreach ($photo->envois as $_envoi) :?>
                        <strong>Mail ouvert le :</strong>
                            <label><?= $_envoi->picture_contact->picture_contact_email?></label>
                            <span>le <?=  date("d/m/Y",$_envoi->mailjet_message_date_opened) ?></span>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
                <?php if(!empty($photo->page_souvenir_views)) :?>
                    <div class="kl_contDtl">
                        <strong>Nombre de clic sur le lien dans le SMS :</strong>
                        <span><?= h($photo->page_souvenir_views[0]->page_souvenir_views_count);?></span>
                    </div>
                <?php endif; ?>
                <?php if(!empty($photo->picture_shared)) :?>
                <div class="kl_contDtl">
                    <strong>Photo partagée sur <i class="fa fa-facebook-official"></i> le :</strong>
                    <span><?= date("d/m/Y",$photo->picture_shared[0]->picture_shared_date_add)?></span>
                </div>
                <?php endif;?>
                <?php 
                    $_like_fb=$_like_twitter=$_like_pinterest=0;
                    if(!empty($photo->network_action)){
                        foreach ($photo->network_action as $_network_social_action) {
                            switch ($_network_social_action->social_network){
                                case 'facebook':
                                        $_like_fb = (int)$_network_social_action->like_count;
                                    break;
                                case 'twitter':
                                        $_like_twitter = (int)$_network_social_action->like_count;
                                    break;
                                case 'pinterest':
                                        $_like_pinterest = (int)$_network_social_action->like_count;
                                    break;
                            }
                        }
                    }
                ?>
                <div class="kl_contDtl">
                    <div class="kl_statImag">
                        <div><?=$_like_fb?></div>
                    </div>
                    <div class="kl_statImag">
                        <?= $this->Html->image('btnJaimeTwitter.png') ?>
                        <div><?=$_like_twitter?></div>
                    </div>
                    <div class="kl_statImag">
                        <?= $this->Html->image('btnPinterest.png') ?>
                        <div><?=$_like_pinterest?></div>
                    </div>
                </div>
            </div>
            </div>
        
        </div>
   </div>
      </div>
      <div class="clearfix"></div>
    </div>
    
  </div>

</div>
