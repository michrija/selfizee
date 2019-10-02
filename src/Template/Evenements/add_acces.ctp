<?= $this->Html->script('Evenements/acces.js', ['block' => true]); ?>
<?php
$titrePage = "Ajouter un accès";
if($is_edit) $titrePage = "Modifier un accès";
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
echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
//debug($timelines->toArray());
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($user, ['type' => 'file']) ?>
                <div class="form-body">
                    <div class="col-md-4">
                        <?php $login = $default_login; if($is_edit) $login = $user->username; ?>
                        <?php echo $this->Form->control('username',['label'=>'Login', 'value'=>$login, 'required'=>true]);?>
                    </div>
                    <div class="col-md-4">
                        <?php  echo $this->Form->control('password_visible',['label'=>'Mot de passe','type'=>'text', 'id'=>'password_visible', 'required'=>true, 'value'=>$user->password_visible, 'templates' => ['inputContainer' => '{{content}}']]);?>
                        <?= $this->Form->hidden('password', ['id'=>'password']); ?>
                        <small class="form-control-feedback">
                        <?php echo $this->Html->link('Générer <i class="fa fa-refresh"></i>', '#', ["escape"=>false, 'id'=>'id_generateMotDePasse']);   ?>
                        </small>
                    </div><br>
                    
                    <div class="col-md-4">
                        <?php
                            echo $this->Form->control('is_active_acces_config',['label'=>'Accès configuration']);
                            echo $this->Form->control('is_active_acces_event',['label'=>'Accès événement', 'id'=>'is_active_acces_event']);
                        ?>
                    </div>
                    <div class="col-md-6 acces_detail hide">
                        <div class="col-md-6 ">
                            <?php
                            echo $this->Form->control('is_active_acces_affichage_photo',['label'=>'Possibilité d\'afficher les photos']);
                                    echo $this->Form->control('is_active_acces_edit_photo',['label'=>'Possibilité d\'editer les photos']);
                                    echo $this->Form->control('is_active_acces_send_email',['label'=>'Possibilité d\'envoyer des emails']);
                                    echo $this->Form->control('is_active_acces_send_sms',['label'=>'Possibilité d\'envoyer des sms']);
                                    echo $this->Form->control('is_active_acces_data',['label'=>'Accès data']);
                            echo $this->Form->control('is_active_acces_stat',['label'=>'Accès statistiques']);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php
                            echo $this->Form->control('is_active_acces_timeline',['label'=>'Accès timeline']);
                        ?>
                    </div>
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>