<input type="hidden" id="id_evenementFirst" value="<?= $listeIdEvenement[0] ?>" />
<input type="hidden" id="id_queue" value="<?= $queue ?>" />
<input type="hidden" id="id_mustModerate"  value="<?= intval($galery->is_photo_invited_must_moderate)  ?>" />
                          
<div class="container" id="id_uploadPhotoContentGal">
        <h2 class="col-md-12 kl_titreAjoutPhto">Envoi de photos dans la galerie</h2>
        <?php if($galery->is_photo_invited_must_moderate){ ?>
        <div class="kl_ifModerateTxt col-md-12">Vos photos seront modérées par les responsables de l'événement qui valideront ou non chacune de vos photos envoyées.</div>
        <?php } ?>
        <?php
        echo $this->Form->create($visiteur, ['url' => ['action' => 'savePhotoVisiteur',$idEncode]]);
        ?>
            <div class="col-md-12">
                <div class="pull-left">
                    <?php
                        echo $this->Html->link( 
                                                '<i class="fa fa-angle-left"></i> Retour',
                                                ['action' => 'souvenir', $idEncode],
                                                ["class"=>"btn  btnGalerie",'escape' => false]
                                            );
                    ?>
                </div>
                <div class="pull-right">
                    <?php
                        /*echo $this->Html->link( 
                                                'Enregistrer',
                                                ['action' => 'souvenir', $idEncode],
                                                ["class"=>"kl_saveUpoad btn",'escape' => false]
                                            );*/
                                            
                    ?>
                    <?= $this->Form->button('Enregistrer',["class"=>"btn btnGalerie",'escape'=>false]) ?>
        
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-12 kl_lesForm">
    			<?php echo $this->Form->control('full_name',['label'=>'Nom et prénom']); ?>
    		</div>
            <div class="col-md-12">
        			<?php echo $this->Form->control('email',['label'=>'E-mail']); ?>
                    <?php echo $this->Form->control('evenement_id',['value'=>$listeIdEvenement[0],'type'=>"hidden"]); ?>
        	</div>
            <div class="col-md-12" id="id_containerDropPhoto">
                <div class="dropzone" id="id_uploadPhoto"></div>
            </div>    
        <?php echo $this->Form->end(); ?>
</div>