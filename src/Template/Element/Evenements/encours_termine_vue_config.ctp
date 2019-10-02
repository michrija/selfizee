<div class="table-responsive">
    <table  class="table table-striped table-hover" style="font-size: 13px;" >
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('Evenements.nom', 'Nom') ?></th>
            <th scope="col"><?= $this->Paginator->sort('Evenements.client_id', 'Client') ?></th>
            <th scope="col"><a href="#">Type</a></th>
            <th scope="col"><a href="#">Ville</a></th>
            <th scope="col"><?= $this->Paginator->sort('Evenements.date_debut', 'Début') ?></th>
            <th scope="col"><a href="#">Email configuré</a></th>
            <th scope="col"><a href="#">Sms configuré</a></th>
            <th scope="col"><a href="#">Envoi auto</a></th>
            <th scope="col"><a href="#">Facebook </a></th>
            <th scope="col"><a href="#">Login galerie</a></th>
            <th scope="col"><?= $this->Paginator->sort('Evenements.id', 'Identifiant') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php   
        //debug($evenements->toArray());
        
        foreach ($evenements as $evenement): ?>
            <?php if(!empty($evenement->photos[0]['url_thumb_popup'])){ ?>
                <tr class="red-tooltip " data-toggle="tooltip" data-placement="left" data-html="true" title="<img src='<?= $evenement->photos[0]['url_thumb_popup'] ?>' width='50' />" >
            <?php } else { ?>
                <tr>
            <?php }  ?>
                <td class="kl_nom_event"><?= $this->Html->link($evenement->nom, ['action' => 'board', $evenement->id]) ?></td>
                <td><?= $evenement->client->nom ?></td>
                <td>
                <?php 
                if($evenement->client->client_type == 'person'){
                    echo 'Part';
                }else{
                    echo 'Pro';
                }
                 ?>
                </td>
                <td><?= $evenement->lieu ?></td>
                <td>
                <?php 
                if($evenement->date_debut){
                   echo $evenement->date_debut->format('d/m/Y');
                } 
                ?>
                </td>
                <td><?= $evenement->has('email_configuration') ? 'Oui' : 'Non' ?></td>
                <td><?= $evenement->has('sms_configuration') ? 'Oui' : 'Non' ?></td>
                <td><?= $evenement->has('cron') ? 'Oui' : 'Non' ?></td>
                <td><?= !empty($evenement->facebook_autos) ? 'Oui' : 'Non' ?></td>
                
                <td>
                    <?php
                    if(!empty($evenement->galeries)){
                        echo $evenement->galeries[0]->slug;
                    }
                    ?>
                </td>
                 <td><?= $evenement->id ?></td>
                <!--<td>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evenement->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                </td>-->
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="12">
                <div class="text-right">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                </div>
            </td>
        </tr>
        </tfoot>
    </table>
</div>