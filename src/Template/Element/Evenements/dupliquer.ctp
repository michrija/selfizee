<?= $this->Html->script('speackingurl/speakingurl.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/dupliquer.js', ['block' => true]); ?>
<div class="modal fade" id="dupliquerEvenement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Dupliquer l'événement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php echo $this->Form->create(null, ['url' => ['action' => 'dupliquer',$evenement->id]]); ?>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label class="control-label col-md-12" for="id_nom_dup">Nom du nouvel événement : </label>
                            <div class="col-md-12">
                                <input name="nom" class="form-control"  required="required" type="text" id="id_nom_dup">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group hide">
                            <label class="control-label col-md-12" for="id_slug_dup">Identifiant de l'événement : </label>
                            <div class="col-md-12">
                                <input name="slug" class="form-control"  required="required" type="text" id="id_slug_dup">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Dupliquer</button>
                </div>
             <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>