<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>


<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('clients/add.js', ['block' => true]); ?>


<?php
$titrePage = "Modification d'un utilisateur" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>


<?php 
//debug($client);
if(!empty($client->user)){ ?>
<!--<div class="pull-right m-b-15">
        <?php echo $this->Html->link('<i class="mdi mdi-lock-open"></i> Connecter à ce compte ',['controller' => 'Clients', 'action' => 'forceLogin', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'btn btn-success' ]); ?>
</div>-->
<?php } ?>
<div class="clearfix"></div>
<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"><?= __("Information") ?></h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
                <div class="form-body">
                     <div class="col-md-6">
                        <?php
                            $type = array('person'=>'Particulier', 'corporation' => 'Professionnel');
                            if(!empty($user->client) && ($user->role_id == 2 || $user->role_id == 6)){
                        		echo $this->Form->control('client.nom', ['label'=>'Client', 'disabled'=>true]);
							}
							if(!empty($user->evenement)  && $user->role_id == 5){
                        		echo $this->Form->control('evenement.nom', ['label'=>'Evenement', 'disabled'=>true]);
                        	}
                            echo $this->Form->control('username',['label'=>'Login']);
                            echo $this->Form->control('password_visible',['label'=>'Mot de passe','type'=>'text', 'required'=>false]);
                            
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