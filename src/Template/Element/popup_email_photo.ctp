<div class="modal fade" id="modalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="form_mailShare">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body kl_modalEmail">
                <div class="alert alert-success hidden">Votre e-mail a été bien envoyé.</div>
                <div class="alert alert-danger hidden">Une erreur est survenue. Veuillez réessayer plus tard.</div>
                <div class="kl_title_popup">Envoyer cette photo à un ami</div>
                <div class="kl_imageShare" id="img_share">
                    <img src="" />
                </div>
                 <div class="form-group">
                                    <input class="form-control" type="email" placeholder="E-mail destinataire" name="email" required="required"/>
                </div>
                <div class="form-group">
                    <label>La photo sera envoyée par email, vous pouvez y joindre un petit commentaire : </label>
                    <textarea class="form-control" placeholder="Commentaire" name="content" required="required"></textarea>
                </div>
                
                <input type='hidden' name='img'>
                <input type='hidden' name='img_share' id='link_share'>
                <div class="form-group">
                    <input id="share_pictureMail" type="submit" value="Envoyer"/>
                    
                    <div class="pull-right kl_loadingMail"></div>
                    <button type="button" id="id_btnFermer" class="btn btn-secondary pull-right" data-dismiss="modal">Fermer</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
      </div>
    </div>
</div>