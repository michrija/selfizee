<?= $this->Html->script('Evenements/acces.js', ['block' => true]); ?>
<?php
$titrePage = "Ajouter un acces";
if($is_edit) $titrePage = "Modifier un acces";
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
    echo $this->Html->link('<i class="mdi mdi-view-list"></i> '.__('Liste des accès'),['action'=>'acces'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>

<div class="row">
	<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"><?= __("Information") ?></h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
                <div class="form-body">
                    <div class="col-md-4">
                        <?php  ?>
                        <?php echo $this->Form->control('username',['label'=>'Login * :', 'required'=>true]);?>
                    </div>
                    <div class="col-md-4">                     	
                     	<?php  echo $this->Form->control('password_visible',['label'=>'Mot de passe * :','type'=>'text', 'id'=>'password_visible', 'required'=>true, 'value'=>$user->password_visible, 'templates' => ['inputContainer' => '{{content}}']]);?>                     	
                     	<?= $this->Form->hidden('password', ['id'=>'password']); ?>
                     	<small class="form-control-feedback">
                     			<?php echo $this->Html->link('Générer <i class="fa fa-refresh"></i>', '#', ["escape"=>false, 'id'=>'id_generateMotDePasse']);   ?>
                     	</small>
                    </div><br>

                    <div  class="col-md-4">
                        <?= $this->Form->control('role_id', ['id'=>'role_id', 'label'=>'Rôle * :','options' => $roles, 'empty' =>'Séléctionner', 'required'=>true]);
                        ?>
                    </div>

                    <div class="col-md-4 kl_client hide">
                            <?php
                                $client_id = ""; $is_disabled = false;
                                if(!empty($client)) { 
                                    $client_id = $client->id;
                                    $is_disabled = true;
                                    echo $this->Form->hidden('client_id', ['value'=>$client_id]);
                                }

                                if($is_edit){
                                    $client_id = $user->client_id;
                                }
                                echo $this->Form->control('client_id', ['label'=>'Client * :','options' =>$clients, 'empty' =>'Séléctionner un client', 'id' => 'id_client', 'value'=>$client_id, 'disabled'=>$is_disabled]);
                            ?>
                    </div>

                    <div class="col-md-4 kl_parent hide">
                            <?php
                                echo $this->Form->control('parent_id', ['label'=>'Compte parent * :','options' =>$user_parents, 'empty' =>'Séléctionner un parent', 'id' => 'id_parent']);
                            ?>
                    </div>

                    <div class="col-md-4 kl_event hide">
                            <?php
                                $event_id = "";
                                echo $this->Form->control('evenement_id', ['label'=>'Evenement * :', 'options' =>$evenements, 'empty' => 'Séléctionner un événement', 'id' => 'id_event', 'disabled'=>false]);
                            ?>
                    </div>
                    
                    <div class="niveaux_acces hide">
                    <label  class="col-md-4" >Niveaux d'acces</label>
                        <div class="col-md-4 is_active_acces_creation_event hide">
                            <?php
                                echo $this->Form->control('is_active_acces_creation_event',['label'=>'Possibilité de créer un event', 'class'=>'', 'id'=>'is_active_acces_creation_event']);
                            ?>
                        </div>
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
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>