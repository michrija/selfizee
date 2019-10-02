<div class="modal fade" id="smsTest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Dupliquer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php echo $this->Form->create(null, ['url' => ['action' => 'toDuplicate',$evenement->id]]); ?>
                <div class="modal-body">
                    
                        <div class=" col-md-12 ">
                                <label class="col-md-12">Configuration de l'événement</label>
                                <div class="col-md-9 ">
                                            <?php
                                            echo $this->Form->control('configuration_borne_id', [
                                                'type' => 'select',
                                                'options' => $listeEvenement,
                                                'label' => false,
                                                'empty' => 'Séléctionner'
                                            ]);
                                         ?>
                                        
                                </div>
                            </div>
                        <?php echo $this->Form->hidden('evenement_id', ['value' => $evenement->id]); ?>
                        
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Dupliquer</button>
                </div>
             <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
