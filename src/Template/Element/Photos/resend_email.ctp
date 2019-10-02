<div class="modal fade" id="sendSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Envoyer la photo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Contacts','action'=>'saveAndSend', $photo->id]]); ?>
                <div class="modal-body">
                    <h5>A quel destinataire souhaitez-vous envoyer ?</h5><br>
                    <?php $hide_form = '';
                    if(!empty($photo->contacts)) {
                        $hide_form = 'hide';?>
                        <div class="col-md-12">
                            <div class="row">
                                <?php 
                                        echo $this->Form->control('is_contact',[
                                            'type'=>'radio',
                                            'options'=>[
                                                ['value' => 1, 'text' => 'Contact de la photo','class'=>'custom-control-input', 'id'=>'id_contact_photo'],
                                                ['value' => 0, 'text' => 'Autre contact','class'=>'custom-control-input', 'id'=>'id_autre_contact'],
                                            ],
                                            'label'=>false,
                                            'hiddenField'=>false,
                                            'templates' => [
                                                'nestingLabel' => '{{hidden}}{{input}}<span class="custom-control-label m-r-40" >{{text}}</span>',
                                                'radioWrapper' => '<label class="custom-control custom-radio" {{attrs}}>{{label}}</label>',
                                                'radioContainer' => '{{content}}'
                                            ]
                                    ]);
                                ?> 
                            </div>
                        </div>
                    <?php } else { ?>
                    <?php //echo $this->Form->control('is_contact', ['type' => 'checkbox', 'label' => 'Autre contact', 'id' => 'id_autre_contact',]);?>
                    <?php  } ?>
                    <div class="kl_form_resend <?= $hide_form ?>">
                        <div class="form-group ">
                            <input type="hidden" name="id_contact" id="id_contact" value="">
                            <label  class="control-label">Email  :</label>
                            <input type="text" class="form-control" name="email" id="id_emailToSend" >
                        </div>                        
                        <div class="form-group">
                            <label  class="control-label">Téléphone :</label>
                            <input type="text" class="form-control" name="telephone" id="id_smsToSend">
                            <div class="info_crdt_sms"></div>
                        </div>
                    </div>
                    <div class="col-md-12 msg_retour"></div>

                    <?php echo $this->Form->hidden('photo_id', ['value' => $photo->id,'id'=>'id_photoId']); ?>
                    <?php echo $this->Form->hidden('evenement_id', ['value' => $photo->evenement_id,'id'=>'id_evenementId']); ?>
                    <div class="form-control-feedback text-danger" id="id_errorValue"></div>
                </div>
                <div class="modal-footer kl_form_resend <?= $hide_form ?>">
                    <button type="button" class="btn btn-default" id="id_annuler" data-dismiss="modal">Fermer</button>
                    <button  class="btn btn-primary" id="id_saveAndSendContact" href="#">Envoyer</button>
                </div>
             <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<style type="text/css">
.btn-primary:focus {
 background-color: #e72763;
}
</style>