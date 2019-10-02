<div class="modal fade" id="envoiEMail" tabindex="-1" role="dialog" aria-labelledby="envoiEMail1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="envoiEMail1">Envoi email </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <?php echo $this->Form->create(null, ['url'=>['controller'=>'Galeries', 'action'=>'sendgalerie'] ,'type' => 'post','role'=>'form']); ?>
                <div class="modal-body">
                    <input type="hidden" name="galery_id" value="<?= $galery->id ?>">
                    <input type="hidden" name="evenement_id" value="<?= $evenement->id ?>">
                    <?php if(!empty($evenement->client->email)) { ?>
                        <h4>Etes-vous sûr de vouloir envoyer à </h4>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Client:</label>
                            <input type="email" name="destinateur" class="form-control" value="<?= $evenement->client->email ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Autre(s) :</label>
                            <input type="text" name="destinateurs_mutliple" class="form-control">
                            <span class="help-block"><small>Pour mettre plusieurs destinataires veuillez séparer les e-mails d'une virgule.</small></span>
                        </div>
                        <?php } else { ?>
                        <!--<h4>Aucun email trouvé </h4>-->
                        <div class="form-group">
                            <label for="message-text" class="control-label">Email(s) *:</label>
                            <input type="text" name="destinateurs_mutliple" class="form-control" required>
                            <span class="help-block"><small>Pour mettre plusieurs destinataires veuillez séparer les e-mails d'une virgule.</small></span>
                        </div>
                        <?php } ?>

                        <!--<label for="message-text" class="control-label">Commentaire :</label>
                        <textarea name="commentaire" class="form-control"></textarea>-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>