<div class="modal fade" id="emailTest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Envoyer à</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php echo $this->Form->create(null, ['url' => ['action' => 'sendEmailTest',$evenement->id]]); ?>
                <div class="modal-body">
                    <!--
                        <div class="form-group">
                            <label  class="control-label">Nom :</label>
                            <input type="text" class="form-control" name="nom">
                        </div>
                        
                        <div class="form-group">
                            <label  class="control-label">Prénom :</label>
                            <input type="text" class="form-control" name="prenom">
                        </div>
                    -->
                        
                        <div class="form-group">
                            <label  class="control-label">Email * :</label>
                            <input type="text" class="form-control" name="email" required="">
                        </div>
                        <?php echo $this->Form->hidden('evenement_id', ['value' => $evenement->id]); ?>
                        
                        <div class="form-control-feedback text-danger">Avant de faire un test d'envoi. Veuillez enregistrer votre configuration.</div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
             <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>