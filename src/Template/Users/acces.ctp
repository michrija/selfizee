
<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css', ['block' => true]) ?>
<?php echo  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js', ['block' => true]) ?>
<?= $this->Html->script('summernote/summernote-fr-FR.min.js', ['block' => true]); ?> 
<?= $this->Html->script('summernote/summernote-image-attributes.js', ['block' => true]); ?>
<?= $this->Html->script('summernote/fr-FR.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/acces.js', ['block' => true]); ?>

<?php

use Cake\I18n\Time;
$titrePage = "Liste des accès ";
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();


$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'addAcces'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

//debug($timelines->toArray());
?>
<style>
.tooltip-inner {
    max-width: 310px; /* the minimum width */
}
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('username', 'Login') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('password_visible','Mot de passe') ?></th>
                            	<th scope="col"><?= $this->Paginator->sort('role_id', 'Rôle') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('','Client') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('','Event') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('','Date') ?></th>
                                <th scope="col">Accès</th>
                                <!--<th scope="col"><?= $this->Paginator->sort('is_active_acces_creation_event','Création event') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_config','Configuration') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_event','Evénement') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_affichage_photo','Affichage photos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_edit_photo','Edition photos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_send_email','Envoi e-mails') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_send_sms','Envoi sms') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_data','Data') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_stat','Statistique') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_timeline','Timeline') ?></th>-->
                                <th colspan="3">Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($users as $key => $user){
                             	//debug($user);
                             	//===== Gestion accès
                             	$acces = [0=>'Non', 1=>'Oui'];
						        if($user->is_superadmin_or_oldadmin){
						        	$acces = [0=>'Oui', 1=>'Oui'];
						        }
                                $envoye_id = "envoyer_".$user->id."_".$user->role_id; ?>
                                <tr>
                                    <td><?= $this->Html->link($user->username, ['action' => 'addAcces', $user->id]) ?></td>
                                    <td><?= $user->password_visible ?></td>
                                	<td><?= $user->role->alias ?></td>                                	
                                    <td><?php if($user->client) echo $user->client->nom ?></td>
                                    <td><?php if($user->evenement) echo $user->evenement->nom ?></td>
                                    <td><?php if(!empty($user->created)) echo $user->created->format('d/m/Y') ?></td>
                                    <td>
                                    <!--========== Tooltip Info Recap -->
					                   	<div class='info_recap' data-toggle="tooltip" data-placement="right" data-html="true" title=""
					                        data-original-title="
					                                <div style='max-width:300px;position:relative;overflow:hidden;max-height: 300px;'>
					                                    <div style='width:300px;background:#F2F2F2;line-height:25px;float:left;-webkit-border-radius: 3px;
					                                -moz-border-radius: 3px;border-radius: 3px;text-align:left;padding-left:15px;'><strong>Accès du compte : <?= $user->username ?></strong>
					                                    </div>
					                            <div style='width:150px;float:left; height:;line-height:25px;text-align:left;padding-left:15px;'>

					                                <?= "- Possibilité de créer un événement : ".$acces[$user->is_active_acces_creation_event]."<br>" ?>
					                                <?= "- Possibilité d'acceder à la config : ".$acces[$user->is_active_acces_config]."<br>" ?>
					                                <?= "- Possibilité d'acceder à la partie event : ".$acces[$user->is_active_acces_event]."<br>" ?>
					                                <ul style='margin-bottom: -2px;'>
						                                <li><?= "Possibilité d'afficher les photos : ".$acces[$user->is_active_acces_affichage_photo]."<br>" ?></li>
						                                <li><?= "Possibilité d'editer les photos : ".$acces[$user->is_active_acces_edit_photo]."<br>" ?></li>
						                                <li><?= "Possibilité d'envoyer des e-mails : ".$acces[$user->is_active_acces_send_email]."<br>" ?></li>
						                                <li><?= "Possibilité d'envoyer des sms : ".$acces[$user->is_active_acces_send_sms]."<br>" ?></li>
						                                <li><?= "Possibilité de voir les statistiques : ".$acces[$user->is_active_acces_stat]."<br>" ?></li>
						                                <li><?= "Possibilité de voir les datas : ".$acces[$user->is_active_acces_data]."<br>" ?></li>
					                            	</ul>
					                                <?= "- Possibilité de voir les timelines : ".$acces[$user->is_active_acces_timeline]."<br>" ?>
					                                </div>
					                            </div>"
					                    ><i class="mdi mdi-information detail_event"></i>
					                    </div>
					                </td>
                                    <!--<td><?= $acces[$user->is_active_acces_creation_event] ?></td>
                                    <td><?= $acces[$user->is_active_acces_config] ?></td>
                                    <td><?= $acces[$user->is_active_acces_event] ?></td>
                                    <td><?= $acces[$user->is_active_acces_affichage_photo] ?></td>
                                    <td><?= $acces[$user->is_active_acces_edit_photo] ?></td>
                                    <td><?= $acces[$user->is_active_acces_send_email] ?></td>
                                    <td><?= $acces[$user->is_active_acces_send_sms] ?></td>
                                    <td><?= $acces[$user->is_active_acces_data] ?></td>
                                    <td><?= $acces[$user->is_active_acces_stat] ?></td>
                                    <td><?= $acces[$user->is_active_acces_timeline] ?></td>-->
                                    
                                    <td>
                                        <span data-toggle="modal" data-target="#exampleModal">
                                        <?= $this->Html->link('<i class="fa fa-send"></i>', "#", ["class"=>"btn-envoye_acces", 'data-toggle'=>'tooltip', 'data-target'=>'#exampleModal', 'id'=>$envoye_id, 'escapeTitle'=>false, 'title'=>'Envoyer']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php echo $this->Html->link('<i class="mdi mdi-login"></i>',['action' => 'forceLogin', $user->id],['escapeTitle'=>false,'aria-expanded'=>'false', 'data-toggle'=>'tooltip', 'title'=>'Se connecter à ce compte' ]); ?>
                                    </td>
                                    <td>
                                        <?php // $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'addAcces', $user->evenement_id, $user->id],['escapeTitle'=>false,'aria-expanded'=>'false', 'data-toggle'=>'tooltip','title'=>'Edit' ]) ?>

                                        <?= $this->Form->postLink('<i class="mdi mdi-delete"></i>', ['action' => 'deleteAcces', $user->id], ['confirm' => __('Are you sure you want to delete ?'), 'escapeTitle'=>false,'aria-expanded'=>'false', 'data-toggle'=>'tooltip' ,'title'=>'Supprimer']) ?>
                                    </td>
                                </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!--MODAL ENVOI EMAIL ACCES-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Envoi email</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <?php echo $this->Form->create(null, ['url'=>['controller'=>'Users', 'action'=>'sendAcces'] ,'type' => 'post','role'=>'form']); ?>
                <div class="modal-body">
                    <input type="hidden" name="role_id" id="role_to_send" value="">
                    <input type="hidden" name="user_id" id="user_to_send" value="">
                        <!--<h4>Aucun email trouvé </h4>-->
                    <div class="form-group">
                            <label for="message-text" class="control-label">Email(s) *:</label>
                            <input type="text" name="destinateurs" class="form-control" required>
                            <span class="help-block"><small>Pour mettre plusieurs destinataires veuillez séparer les e-mails d'une virgule.</small></span>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message type :</label>
                        <?php 
                            echo $this->Form->select('message_type', $contenu_emails, ['id' => 'id_msg_type', 'empty' => 'Message type', 'class'=>'form-control']);
                        ?>
                    </div>

                    <label for="message-text" class="control-label">Contenu :</label>
                    <textarea name="commentaire" class="form-control textarea_editor" id="commentaire_id"><?= $contenu ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_send_acces">Envoyer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
