
<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css', ['block' => true]) ?>
<?php echo  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js', ['block' => true]) ?>
<?= $this->Html->script('summernote/summernote-fr-FR.min.js', ['block' => true]); ?> 
<?= $this->Html->script('summernote/summernote-image-attributes.js', ['block' => true]); ?>
<?= $this->Html->script('summernote/fr-FR.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/acces.js', ['block' => true]); ?>

<?php
$titrePage = "Listes des accès ";
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
$evenement->nom,
['controller' => 'Evenements', 'action' => 'view', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);

//echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();


$this->start('actionTitle');
   //echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'addAcces', $evenement->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

//debug($timelines->toArray());
?>


<div class="row">
    <div class="col-12">
        <div class="card card-new-selfizee">
             <div class=" card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                  <?php 
                     echo $this->Html->link(__('Ajouter un accès'),['action'=>'addAcces', $evenement->id],['escape'=>false,"class"=>"kl_bntLinkSimple pull-right btn-selfizee m-r-40 p-b-0 p-t-0" ]);
                  ?> 
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
            <?php if(!empty($users->toArray())){ ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('username', 'Login') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('password_visible','Mot de passe') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_config','Configuration') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_event','Evénement') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_affichage_photo','Affichage photos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_edit_photo','Edition photos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_send_email','Envoi e-mails') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_send_sms','Envoi sms') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_data','Data') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_stat','Statistique') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_active_acces_timeline','Timeline') ?></th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $acces = [0=>'Non', 1=>'Oui']; foreach ($users as $key => $user){ 

                                $envoye_id = "envoyer_".$user->id."_".$user->evenement_id; ?>
                                <tr>
                                    <td><?= $this->Html->link($user->username, ['action' => 'addAcces', $user->evenement_id, $user->id]) ?></td>
                                    <td><?= $user->password_visible ?></td>
                                    <td><?= $acces[$user->is_active_acces_config] ?></td>
                                    <td><?= $acces[$user->is_active_acces_event] ?></td>
                                    <td><?= $acces[$user->is_active_acces_affichage_photo] ?></td>
                                    <td><?= $acces[$user->is_active_acces_edit_photo] ?></td>
                                    <td><?= $acces[$user->is_active_acces_send_email] ?></td>
                                    <td><?= $acces[$user->is_active_acces_send_sms] ?></td>
                                    <td><?= $acces[$user->is_active_acces_data] ?></td>
                                    <td><?= $acces[$user->is_active_acces_stat] ?></td>
                                    <td><?= $acces[$user->is_active_acces_timeline] ?></td>
                                    <td>


                                        <span data-toggle="modal" data-target="#exampleModal">
                                        <?= $this->Html->link('<i class="fa fa-send"></i>', "#", ["class"=>"btn-envoye_acces_event", 'data-toggle'=>'tooltip', 'data-target'=>'#exampleModal', 'id'=>$envoye_id, 'escapeTitle'=>false, 'title'=>'Envoyer']) ?>
                                        </span>

                                        <?php echo $this->Html->link('<i class="mdi mdi-login"></i>',['action' => 'forceLogin', $user->id],['escapeTitle'=>false,'aria-expanded'=>'false', 'data-toggle'=>'tooltip', 'title'=>'Se connecter à ce compte' ]); ?>
                                        <?= $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'addAcces', $user->evenement_id, $user->id],['escapeTitle'=>false,'aria-expanded'=>'false', 'data-toggle'=>'tooltip','title'=>'Editer' ]) ?>
                                        <?= $this->Form->postLink('<i class="mdi mdi-delete"></i>', ['action' => 'deleteAcces', $user->id], ['confirm' => __('Are you sure you want to delete ?'), 'escapeTitle'=>false,'aria-expanded'=>'false', 'data-toggle'=>'tooltip' ,'title'=>'Supprimer']) ?>
                                    </td>
                                </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                Gérez des accès utilisateurs permettant d’accéder aux données de votre événement : gestion de la configuration, accès aux photos, accès aux données, exports des données, accès à l'envoi emails,
                , possibilité de voir les stats,  possibilité de voir le timeline.
                </div>
            <?php } ?>
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
                <?php echo $this->Form->create(null, ['url'=>['controller'=>'Evenements', 'action'=>'sendAcces'] ,'type' => 'post','role'=>'form']); ?>
                <div class="modal-body">
                    <input type="hidden" name="evenement_id" id="evenement_to_send" value="">
                    <input type="hidden" name="user_id" id="user_to_send" value="">
                        <!--<h4>Aucun email trouvé </h4>-->
                    <div class="form-group">
                            <label for="message-text" class="control-label">Email(s) *:</label>
                            <input type="text" name="destinateurs" class="form-control" required>
                            <span class="help-block"><small>Pour mettre plusieurs destinataires veuillez séparer les e-mails d'une virgule.</small></span>
                    </div>

                    <label for="message-text" class="control-label">Commentaire :</label>
                    <textarea name="commentaire" class="form-control textarea_editor" id="commentaire_id"><?= $contenu ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
