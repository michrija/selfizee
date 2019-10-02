<style>
.tooltip-inner {
    max-width: 310px; /* the minimum width */
}
</style>
<?php if(!empty($evenements->toArray())){?>

<div class="table-responsive table_evenements">
    <table class="table table-striped table-hover" style="font-size: 13px;" >
        <thead>
        <tr>
            <th class="col_vue_event"></th>
            <th scope="col" class="col_vue_event"><?= $this->Paginator->sort('Evenements.nom', 'Nom') ?></th>
            <th scope="col" class="col_vue_event"><?= $this->Paginator->sort('Evenements.client_id', 'Client') ?></th>
            <th scope="col" class="col_vue_event"><a href="#">Type</a></th>
            <th scope="col" class="col_vue_event"><a href="#">Ville</a></th>
            <th scope="col" class="col_vue_event"><?= $this->Paginator->sort('Evenements.date_debut', 'Début') ?></th>
            <th scope="col" class="col_vue_event"><a href="#">Photos </a></th>
            <th scope="col" class="col_vue_event"><a href="#">Contacts</a></th>
            <th scope="col" class="col_vue_event"><a href="#">Mails envoyés</a></th>
            <th scope="col" class="col_vue_event"><a href="#">Sms envoyés</a></th>
            <th scope="col" class="col_vue_event"><a href="#">Publi. FB</a></th>
            <th scope="col" class="col_vue_event"><a href="#">Login galerie</a></th>
            <th scope="col" class="col_vue_event"><?= $this->Paginator->sort('Evenements.id', 'Identifiant') ?></th>
            <!--<th class="">Action</th>-->

            <!--VUE CONFIG-->
            <th scope="col" class="col_vue_config hide"><?= $this->Paginator->sort('Evenements.nom', 'Nom') ?></th>
            <th scope="col" class="col_vue_config hide"><?= $this->Paginator->sort('Evenements.client_id', 'Client') ?></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Type</a></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Ville</a></th>
            <th scope="col" class="col_vue_config hide"><?= $this->Paginator->sort('Evenements.date_debut', 'Début') ?></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Email configuré</a></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Sms configuré</a></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Envoi auto</a></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Facebook </a></th>
            <th scope="col" class="col_vue_config hide"><a href="#">Login galerie</a></th>
            <th scope="col" class="col_vue_config hide"><?= $this->Paginator->sort('Evenements.id', 'Identifiant') ?></th>

        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($evenements as $key => $evenement):
                $img_apercu = "";
                $dernier_maj = "";
                $dernier_upload_photo = "";
                $dernier_upload_contact = "";
                $dernier_email_envoye = "";
                $dernier_sms_envoye = "";
                $dernier_pub_fb = "";
                $info_vide = false;

                if(!empty($evenement->timelines)) {
                    $dernier_maj = $evenement->timelines[0]->date_timeline->format('d/m/Y H:i');
                };

                if(!empty($evenement->timelines_upload_photos)) {
                    $dernier_upload_photo = $evenement->timelines_upload_photos[0]->date_timeline->format('d/m/Y H:i');
                };

                if(!empty($evenement->timelines_import_contacts)) {
                    $dernier_upload_contact = $evenement->timelines_import_contacts[0]->date_timeline->format('d/m/Y H:i');
                };

                if(!empty($evenement->timelines_envoi_mails)) {
                    $dernier_email_envoye = $evenement->timelines_envoi_mails[0]->date_timeline->format('d/m/Y H:i');
                };

                if(!empty($evenement->timelines_envoi_smss)) {
                    $dernier_sms_envoye = $evenement->timelines_envoi_smss[0]->date_timeline->format('d/m/Y H:i');
                };

                if(!empty($dernier_maj) || !empty($dernier_upload_photo) || !empty($dernier_upload_contact) || !empty($dernier_email_envoye) || !empty($dernier_sms_envoye) ||  !empty($dernier_pub_fb)) { $info_vide = true;};
            ?>
            
            <?php if(!empty($apercuPhotoEvents[$evenement->id])){ ?>
                <tr id="ligne_event_<?= $evenement->id ?>" class="red-tooltip" data-toggle="tooltip" data-placement="left" data-html="true" title="<div>
                        <img src='<?= $apercuPhotoEvents[$evenement->id] ?>' width='150px' height='auto'/>
                        </div>"
                         >
                    <?php $img_apercu = $apercuPhotoEvents[$evenement->id]; } else { ?>
                <tr id="ligne_event_<?= $evenement->id ?>">
            <?php }  ?>

                <td class="col_vue_event">
                    <!--========== Tooltip Info Recap -->
                    <div class='info_recap' data-toggle="<?php if($info_vide) { echo 'tooltip' ;} ?>" data-placement="right" data-html="true" title=""
                        data-original-title="
                                <div style='max-width:300px;position:relative;overflow:hidden;max-height: 190px;'>
                                    <div style='width:300px;background:#F2F2F2;line-height:25px;float:left;-webkit-border-radius: 3px;
                                -moz-border-radius: 3px;border-radius: 3px;text-align:left;padding-left:15px;'><strong><?= $evenement->nom." #".$evenement->id ?></strong>
                                    </div>
                                    <div style='width:150px;float:left; height:;line-height:25px;text-align:left;padding-left:15px;'>
                                        <?php if(!empty($dernier_maj)) { echo "Dernière mise à jour : ".$dernier_maj."<br>" ;} ?>
                                        <?php if(!empty($dernier_upload_photo)) { echo "Dernier upload photo : ".$dernier_upload_photo."<br>" ;} ?>
                                        <?php if(!empty($dernier_upload_contact)) { echo "Dernier import contact : ".$dernier_upload_contact."<br>" ;} ?>
                                        <?php if(!empty($dernier_email_envoye)) { echo "Dernier e-mail envoyé : ".$dernier_email_envoye."<br>" ;} ?>
                                        <?php if(!empty($dernier_sms_envoye)) { echo "Dernier sms envoyé : ".$dernier_sms_envoye."<br>" ;} ?>
                                        <?php //if(!empty($dernier_pub_fb)) { echo "Dernier publication FB : ".$dernier_pub_fb."<br>" ;} ?>
                                    </div>
                                </div>"
                    ><i class="mdi mdi-information detail_event"></i>
                    </div>

                </td>
                <td  class="col_vue_event">
                    <div class="kl_nom_event">
                        <?= $this->Html->link($evenement->nom, ['action' => 'board', $evenement->id]) ?>
                        <!--======== Menu Contextuel -->
                        <div id="kl_menu_context_<?= $evenement->id ?>" tabindex="0" class="kl_menu_context" data-html="true" data-toggle="popover" data-placement="right" data-trigger="focus"
                              title="<div> <?php if(!empty($img_apercu)) { ?> <img src='<?= $img_apercu ?>' width='50px' height='50px' /> <?php } else { ?>  <?php }  ?>
                                              <span style='font-size:13px;'><?= $evenement->nom.' #'.$evenement->id ?> </span></div>"
                              data-content=
                                            '<div>
                                                <?php if(!empty($evenement->galeries)) { ?>
                                                    <?php echo $this->Html->link('<i class="mdi mdi-email"></i><span class="hide-menu"> Envoyer le galerie par mail</span>','#',["escapeTitle"=>false,"aria-expanded"=>"false","class"=>"dropdown-item btn_envoi_email_gal", 'data-owner'=>$evenement->id, 'data-toggle'=>'modal', 'data-target'=>'#envoiEMail']); //['controller'=>'Galeries', 'action'=>'add', $evenement->id]?>
                                                    <?php echo $this->Html->link('<i class="mdi mdi-image"></i><span class="hide-menu"> Visualiser la galerie</span>',['controller'=>'Galeries','action'=>'souvenir', $evenement->galeries[0]->id_encode],["escapeTitle"=>false,"aria-expanded"=>"false","class"=>"dropdown-item"]); ?>
                                                <?php } ?>
                                                <?php echo $this->Html->link('<i class="mdi mdi-chart-line"></i><span class="hide-menu"> Voir les stats</span>',['controller'=>'Statistiques','action'=>'email', $evenement->id],["escapeTitle"=>false,"aria-expanded"=>"false","class"=>"dropdown-item" ]); ?>
                                                <?php echo $this->Html->link('<i class="mdi mdi-file-image"></i><span class="hide-menu"> Voir les photos</span>',["controller" => "Photos", "action" => "liste", $evenement->id, "?"=>["queue" => time()]],["escapeTitle"=>false,"aria-expanded"=>"false","class"=>"dropdown-item"]); ?>
                                                <?php echo $this->Html->link('<i class="mdi mdi-settings"></i><span class="hide-menu"> Configurer la borne</span>',['controller'=>'ConfigurationBornes','action'=>'add', $evenement->id],["escapeTitle"=>false,"aria-expanded"=>"false","class"=>"dropdown-item"]); ?>
                                                <?php echo $this->Html->link('<i class="mdi mdi-delete"></i><span class="hide-menu"> Supprimer</span>','#',['data-owner'=>$evenement->id, "escapeTitle"=>false,"aria-expanded"=>"false","class"=>"dropdown-item bnt_suppr_event"]); ?>
                    </div>'
                        ><div class="kl_icon_option" data-toggle="tooltip" title="Affcher le menu"><i class="fa fa-ellipsis-h"></i></div>
                        </div>
                    </div>
                </td>
                <td class="col_vue_event"><?= $evenement->client->nom ?></td>
                <td class="col_vue_event">
                <?php 
                if($evenement->client->client_type == 'person'){
                    echo 'Part';
                }else{
                    echo 'Pro';
                }
                 ?>
                </td>
                <td class="col_vue_event"><?= $evenement->lieu ?></td>
                <td class="col_vue_event">
                <?php 
                if($evenement->date_debut){
                   echo $evenement->date_debut->format('d/m/Y');
                } 
                ?>
                </td>
                <td class="col_vue_event"><?= count($evenement->photos) ?></td>
               <td class="col_vue_event">
               <?php
                $nbrContactEvenement = 0;
                if(!empty($evenement->contact_evenement)){
                    $nbrContactEvenement = $evenement->contact_evenement->total_contact;
                }
                echo $nbrContactEvenement;
               ?>
               </td>
                <td class="col_vue_event">
                <?php
                $nbrEmailEnvoyer = 0;
                if(!empty($evenement->email_envois)){
                    $nbrEmailEnvoyer = $evenement->email_envois->total_envoi;
                }
                echo $nbrEmailEnvoyer;
                ?>
                </td>
                <td class="col_vue_event">
                <?php
                $nbrSmsEnvoyer = 0;
                if(!empty($evenement->sms_envois)){
                    $nbrSmsEnvoyer = $evenement->sms_envois->total_envoi;
                }
                echo $nbrSmsEnvoyer;
                ?>
                </td>
                <td class="col_vue_event">
                    <?php
                    $nbrFbAutoPoste = 0;
                    foreach($evenement->facebook_autos as $fb_auto){
                        $nbrFbAutoPoste = $nbrFbAutoPoste + count($fb_auto->facebook_auto_suivis);
                    }
                    echo $nbrFbAutoPoste;
                    ?>
                </td>
                <td class="col_vue_event">
                    <?php
                    if(!empty($evenement->galeries)){
                        echo $evenement->galeries[0]->slug;
                    }
                    ?>
                </td>
                 <td class="col_vue_event"><?= $evenement->id ?></td>
                <!--<td>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evenement->id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                </td>-->

                <!--VUE CONFIG CONTENU-->
                <td class="kl_nom_event col_vue_config hide"><?= $this->Html->link($evenement->nom, ['action' => 'board', $evenement->id]) ?></td>
                <td class="col_vue_config hide"><?= $evenement->client->nom ?></td>
                <td class="col_vue_config hide">
                <?php 
                if($evenement->client->client_type == 'person'){
                    echo 'Part';
                }else{
                    echo 'Pro';
                }
                 ?>
                </td>
                <td class="col_vue_config hide"><?= $evenement->lieu ?></td>
                <td class="col_vue_config hide">
                <?php 
                if($evenement->date_debut){
                   echo $evenement->date_debut->format('d/m/Y');
                } 
                ?>
                </td>
                <td class="col_vue_config hide"><?= $evenement->has('email_configuration') ? 'Oui' : 'Non' ?></td>
                <td class="col_vue_config hide"><?= $evenement->has('sms_configuration') ? 'Oui' : 'Non' ?></td>
                <td class="col_vue_config hide"><?= $evenement->has('cron') ? 'Oui' : 'Non' ?></td>
                <td class="col_vue_config hide"><?= !empty($evenement->facebook_autos) ? 'Oui' : 'Non' ?></td>
                
                <td class="col_vue_config hide">
                    <?php
                    if(!empty($evenement->galeries)){
                        echo $evenement->galeries[0]->slug;
                    }
                    ?>
                </td>
                <td class="col_vue_config hide"><?= $evenement->id ?></td>

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
 <?php }  else { ?>
<h6 class="card-subtitle" style="text-align: center;">Aucune donnée</h6
 <?php }?>