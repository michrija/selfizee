<!--<style>
    .table-hover tbody tr:hover {
        background: #d3d8e1;
    }
</style> table-striped table-hover style="font-size: 13px;" -->
<div class="table-responsive">
    <table class="table " >
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('Evenements.nom', 'Nom') ?></th>
            <th scope="col"><?= $this->Paginator->sort('Evenements.client_id', 'Client') ?></th>
            <th scope="col"><a href="#">Type</a></th>
            <th scope="col"><a href="#">Ville</a></th>
            <th scope="col"><?= $this->Paginator->sort('Evenements.date_debut', 'Début') ?></th>
            <th scope="col"><a href="#">Photos </a></th>
            <th scope="col"><a href="#">Contacts</a></th>
            <th scope="col"><a href="#">Mails envoyés</a></th>
            <th scope="col"><a href="#">Sms envoyés</a></th>
            <th scope="col"><a href="#">Publi. FB</a></th>
            <th scope="col"><a href="#">Login galerie</a></th>
            <th scope="col"><?= $this->Paginator->sort('Evenements.id', 'Identifiant') ?></th>
            <!--<th class="">Action</th>-->
        </tr>
        </thead>
        <tbody>
        <?php 
        //debug($evenements->toArray());
        
        foreach ($evenements as $evenement): ?>
            <?php if(!empty($evenement->photos[0]['url_thumb_popup'])){ ?>
                <tr class="red-tooltip red-tooltip:hover" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='<?= $evenement->photos[0]['url_thumb_popup'] ?>'  />" >
            <?php } else { ?>
                <tr>
            <?php }  ?>
                <td><?= $this->Html->link($evenement->nom, ['action' => 'view', $evenement->id]) ?></td>
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
                <td><?= count($evenement->photos) ?></td>
               <td>
               <?php
                $nbrContactEvenement = 0;
                if(!empty($evenement->contact_evenement)){
                    $nbrContactEvenement = $evenement->contact_evenement->total_contact;
                }
                echo $nbrContactEvenement;
               ?>
               </td>
                <td>
                <?php
                $nbrEmailEnvoyer = 0;
                if(!empty($evenement->email_envois)){
                    $nbrEmailEnvoyer = $evenement->email_envois->total_envoi;
                }
                echo $nbrEmailEnvoyer;
                ?>
                </td>
                <td>
                <?php
                $nbrSmsEnvoyer = 0;
                if(!empty($evenement->sms_envois)){
                    $nbrSmsEnvoyer = $evenement->sms_envois->total_envoi;
                }
                echo $nbrSmsEnvoyer;
                ?>
                </td>
                <td>
                    <?php
                    $nbrFbAutoPoste = 0;
                    foreach($evenement->facebook_autos as $fb_auto){
                        $nbrFbAutoPoste = $nbrFbAutoPoste + count($fb_auto->facebook_auto_suivis);
                    }
                    echo $nbrFbAutoPoste;
                    ?>
                </td>
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