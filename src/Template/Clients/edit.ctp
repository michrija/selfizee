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

<?php $this->start('actionTitle'); 
if(!empty($client->user)){ ?>
    <div class="pull-right m-b-15">
            <?php echo $this->Html->link('<i class="mdi mdi-lock-open"></i> Connecter à ce compte ',['controller' => 'Clients', 'action' => 'forceLogin', $client->id],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'btn btn-success0 btn-selfizee-inverse' ]); ?>
    </div>
<?php } ?>
<?php $this->end(); ?>

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
            <?= $this->Form->create($client, ['type' => 'file']) ?>
                <div class="form-body">
                     <div class="col-md-6">
                        <?php
                            $type = array('person'=>'Particulier', 'corporation' => 'Professionnel');
                            echo $this->Form->control('client_type',['label' => 'Type de client *', 'options'=>$type,'empty'=>'Séléctionner le type','required'=>true,'class'=>'form-control']);
                        	echo $this->Form->control('nom');
                            echo $this->Form->control('user.username',['label'=>'Login']);
                            echo $this->Form->control('pasafficherparnavigagauet',['class'=>'hide','type'=>'password','label' => false]);
                            echo $this->Form->control('user.password',['label'=>'Mot de passe','type'=>'text','value' => '', 'required'=>false]);
                            echo $this->Form->hidden('user.role_id',['value'=>2]);
                        ?>
                     </div><hr>

                    <div class="col-md-6">
                        <?php
                        echo $this->Form->control('acces_custom',['label'=>'Accès personalisation']);
                        echo $this->Form->control('acces_modele_email',['label'=>'Accès modèle e-mail']);
                        echo $this->Form->control('acces_modele_sms',['label'=>'Accès modèle sms']);
                        echo $this->Form->control('acces_mise_en_page',['label'=>'Accès mise en page']);
                        ?>
                    </div><hr>

                    <div class="col-md-6">
                        <?php
                            echo $this->Form->control('is_marque_blanche',['label'=>'Marque blanche', 'id'=>'is_marque_blanche']);
                        ?>
                    </div>
                    <div class="col-md-6 marque_blanche hide">
                        <?php
                            echo $this->Form->control('url_bo',['label'=>'Url back office', 'type'=>'text']);
                        echo $this->Form->control('url_site_web',['label'=>'Url site web', 'type'=>'text']);
                        echo $this->Form->control('logo_header_page_galerie_file',["label"=>"Logo header page galerie","class"=>"dropify", "type"=>"file", "accept"=>"image/*", "data-default-file"=>$client->url_logo_header_page_galerie]);
                        echo $this->Form->control('logo_page_bo_file',["label"=>"Logo page back office","class"=>"dropify", "type"=>"file", "accept"=>"image/*", "data-default-file"=>$client->url_logo_page_bo]);
                        echo $this->Form->control('favicon_file',["label"=>"Favicon","class"=>"dropify", "type"=>"file", "accept"=>"image/*", "data-default-file"=>$client->url_favicon]);
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
                