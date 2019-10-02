<div class="kl_contactContent kl_contentTab hide" id="id_contentContact">
    <div class="kl_editable" id="id_editContact_1338">
                        <?php
                            $email = '';
                            $tel = '';
                            if(!empty($photo->contacts)){
                                $email = $photo->contacts[0]->email;
                                $tel = $photo->contacts[0]->telephone;
                            }
                        ?>
                        <?php if(!empty($email) || !empty($tel)){ ?>   
                            <div class="form-inline">
                                    <?php if(!empty($email)){ ?>
                                        <strong class="text-center">Coordonnées</strong>
                                            <div class="form-group">
                                            <label class="">E-mail : </label>&nbsp;<span> <?= $email ?></span>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php if(!empty($tel)){ ?>     
                                        <div class="form-group">
                                            <label class="">Téléphone : </label>&nbsp;<span><?= $tel ?></span>
                                        </div>
                                <?php } ?>                        
                            </div>
                        <?php } else { ?>
                            <div style="text-align:center;"><p>Aucun contact associé à la photo.</p></div>                            
                        <?php } ?>
                        
                    
                        
                        <?php if($userConnected['is_active_acces_edit_photo']){ ?>
                            <?php  if(!empty($photo->contacts)){ ?>
                            <div class="kl_contDtl kl_actionContact text-center">
                                <button class="kl_deleteContactPhoto" id="id_pictureContact_<?= $photo->contacts[0]->id ?>">
                                    <i class="fa fa-trash"></i> supprimer ce contact
                                    <?php echo $this->Html->image('loading_bl.svg', ['class' => 'hide kl_loader']); ?>
                                </button>
                            </div>   
                            <?php } ?>     
                        <?php } ?>
    </div>
</div>