<div class="modal fade" id="newAdresse" tabindex="-1" role="dialog" aria-labelledby="NEwAdresseModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="NEwAdresseModal">Nouvelle adresse</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php //echo $this->Form->create(null, ['url' => ['action' => 'addNewAdresse',$clientId]]); ?>
                <div class="modal-body">
                        <div class="form-group">
                            <label  class="control-label">Email * :</label>
                            <input type="text" class="form-control" name="email" required="" id="email_new_adresse">
                        </div>
                        <?php echo $this->Form->hidden('clientId', ['value' => $clientId]); ?>
                        <div class="form-control-feedback text-danger" id="id_textError"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" id="saveNewAdresse">Enregister</button>
                </div>
             <?php //echo $this->Form->end(); ?>
        </div>
    </div>
</div>