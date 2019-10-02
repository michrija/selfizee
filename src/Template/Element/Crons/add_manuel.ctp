<div class="modal fade" id="id_envoiManuel" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Envoi manuel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php echo $this->Form->create($envoiManuel, ['url' => ['controller'=>'EnvoiManuels','action' => 'add']]); ?>
                <div class="modal-body">
                        <p>Veuillez renseigner votre email si vous souhaiter être notifié quand c'est terminé.</p>
                        
                        <?php echo $this->Form->control('email_notify', ['type'=>'email','label'=>'E-mail ']); ?>
                        
                        <div class="hide" id="id_paramEnvoiManuel">
                            <?php echo $this->Form->control('is_email', ['default' => 0]); ?>
                            <?php echo $this->Form->control('is_sms', ['default' => 0]); ?>
                            <?php echo $this->Form->control('is_force_envoi', ['default' => 0]); ?>
                            <?php echo $this->Form->control('is_reenvoie_notsent', ['default' => 0]); ?>
                            
                            <?php echo $this->Form->hidden('evenement_id', ['value' => $evenement->id]); ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" id="id_submitEnvoiManuel">Envoyer</button>
                </div>
             <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
