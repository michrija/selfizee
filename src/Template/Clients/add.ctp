<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\ModelBorne $modelBorne
*/
?>
<?php $contrat = [1=>'1 mois',3=>'3 mois',6=>'6 mois',12=>'12 mois',24=>'24 mois',36=>'36 mois'] ?>
<?= $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js', ['block' => true]); ?>
<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('clients/add.js', ['block' => true]); ?>
<?= $this->Html->script('customer.js', ['block' => true]); ?>

<?php
    $titrePage = "Créer un nouveau compte client" ;
?>

<?= $this->Form->create($client, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-9">
        <div class="card card-new-selfizee" id="id_configEmail">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black"><?= $titrePage ?> </h4>
            </div>
            <div class="card-body">
                <div class="form-body">
                    <h3 class="card-title">Information du client</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('client_type_id', ['options' => $typeclient, 'empty' => 'Séléctionner le type', 'required', 'class' => 'form-control', 'label' => 'Type de client *']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('nom',['label' => 'Nom *','required' => true]); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('note_intern', ['class' => 'form-control', 'label' => 'Note interne']); ?>
                        </div>
                    </div>


                    <h3 class="card-title">Compte admin du client</h3>
                    <hr>
                    <div  class="row">
                        <div class="col-md-6">
                            <label for="">Login </label>
                            <?php echo $this->Form->control('user.username',['label'=>false]);    ?>
                            <?php echo $this->Form->hidden('user.role_id',['value'=>2]);  ?>
                            <?php echo $this->Form->control('is_active_add_client', ['label'=> 'Autoriser la création de ses propres comptes clients', 'class' => 'form-check-input', 'hiddenField' => false]);    ?>
                            
                        </div>
                        <div class="col-md-6 ">
                            <label for="" class="motdepass" >Mot de passe</label>
                            <?php echo $this->Form->control('user.password',['label'=>false,'type'=>'text', 'type' => 'password', 'class'=>'form-control mb-5']); ?>
                        </div>
                    </div>
                </div>
                <hr>
                
                <h3>Contact principal</h3>
                
                <div class="row">
                    <div class="col-md-6 ">
                        <?php echo $this->Form->control('contact_principale.contact_name',['input-name'=>'[contact][contact_name]','type'=>'text','label'=>'Nom']); ?>
                    </div>
                    <div class="col-md-6 ">
                        <?php echo $this->Form->control('contact_principale.prenom',[ 'input-name'=>'prenom',"type"=>"text",'label'=>'Prénom','class'=>' form-control  ',]); ?>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6 ">
                        <?php echo $this->Form->control('contact_principale.email',['input-name'=>'email','type'=>'email','label'=>'E-mail']); ?>
                        <h3>Personnalisation du Back-Office</h3>
                        <?php echo $this->Form->control('user.is_active_custom_marque_blanche', ['label'=> 'Activer la personnalisation marque blanche', 'class' => 'form-check-input', 'id' => 'marque', 'hiddenField' => false]);    ?>
                    </div>
                    <div class="col-md-6 ">
                        <?php echo $this->Form->control('contact_principale.mobile',['input-name'=>'mobile','type'=>'text','label'=>'Télephone']); ?>
                    </div>
                </div>

                <div class="customBo <?= @$client->user->is_active_custom_marque_blanche == 1 ? : 'd-none'; ?> codeCouleur">
                    <hr>
                    <div class="row ">
                        <div class="col-md-6 ">
                            <?php echo $this->Form->control('url_bo',['label'=>'Url du back-office', 'type'=>'text']); ?>
                        </div>
                        <div class="col-md-6 ">
                            <?php echo $this->Form->control('code_couleur_principal',["label"=>"Code couleur principale du back-office", "type"=>"text", "accept"=>"image/*",'class'=>' form-control colorpicker ','default' => '#e72763']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ">
                            <?php echo $this->Form->control('url_site_web',['label'=>'Url du site vitrine', 'type'=>'text']); ?>
                        </div>
                        <div class="col-md-6 ">
                            <?php echo $this->Form->control('logo_page_bo_file',["id"=>"photo_id","label"=>"Logo du back-office","class"=>"dropify", "type"=>"file", "accept"=>"image/*", 'data-default-file' => $client->logo_page_bo != null ? @$client->get('urlLogoPageBo') : false ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ">
                            <?php echo $this->Form->control('logo_header_page_galerie_file',["id"=>"photo_id","label"=>"Logo de la page galerie","class"=>"dropify", "type"=>"file", "accept"=>"image/*", 'data-default-file' => @$client->logo_header_page_galerie != null ? @$client->get('urlLogoHeaderPageGalerie') : false ]); ?>
                        </div>
                        <div class="col-md-6 ">
                            <?php echo $this->Form->control('img_fond_login_file',["label"=>"Image de fond de la page login","class"=>"dropify", "type"=>"file", "accept"=>"image/*", 'data-default-file' => @$client->img_fond_login != null ? @$client->get('urlImgFondLogin') : false ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 kl_noPaddingLeft ">
        <div class="card card-new-selfizee">
            <div class="card-header">
                <h4 class="m-b-0 text-black"> Abonnement </h4>
            </div>
            <div class="card-body ">
                <div class="form-group " id="id_dateHeureEnvoi">
                    <label>Date de début du contrat</label>
                    <?php //echo $this->Form->control('date_debut_contact',['type'=>'text','class'=>'form-control','id'=>'id_debutContrat','label'=>false]); ?>

                     <?php 
                    echo $this->Form->control('date_debut_contact',
                        [
                            'type'=>'text',
                            'label'=>false,
                            'class'=>'kl_dateHeureDenvoi form-control datepicker',
                            'id'=>'id_debutContrat',
                            "autocomplete"=>"off",
                            'templates' => [
                                'inputContainer' => '<div class="form-group input-group">{{content}}<div class="input-group-append">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                    </div></div>',

                            ]
                        ]
                    ); 
                    ?>

                </div>
                <div class="form-group " id="id_dateHeureEnvoi">
                    <?php echo $this->Form->control('abonnement',['options'=>$contrat,'label'=>'Durée d\'accès au BO','class'=>'form-control']); ?>
                </div>
            </div>
        </div>
        <?= $this->Form->button(__('Save'),["class"=>"btn btn-success col-12 m-t-15",'escape'=>false]) ?>
    </div>
</div>

<?= $this->Form->end() ?>