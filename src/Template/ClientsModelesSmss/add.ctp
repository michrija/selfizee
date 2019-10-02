<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsModelesSms $clientsModelesSms
 */
?>

<?= $this->Html->script('SmsConfigurations/modeles.js', ['block' => true]); ?>
<?php
$titrePage = "Ajout modèle Sms";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add(
$client->nom,
['controller' => 'Clients', 'action' => 'view', $client->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($clientsModelesSms) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-12">
                            <?php echo $this->Form->control('client_id',['type' => 'hidden', 'value'=>$client->id]); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('nom_modele',['label'=>'Nom du modèle :', 'required'=>true]); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('expediteur',['label'=>'Expéditeur : ','maxlength'=>'11','templateVars'=>['help'=>'Maximum 11 caractères']]); ?>
                        </div>
                        <div class="col-md-12 kl_ContenuSMS">
                            <?php echo $this->Form->control('contenu',['id'=>'id_contentSMS', 'maxlength'=>320, 'label'=>'Contenu : ','placeholder'=>'Le contenu du sms','type'=>'textarea','templateVars'=>['help'=>'Astuce : syntaxe pouvant être utilisée dans le contenu du sms : [[lien_partage]]']]); ?>
                            <?php
                            $kl_hideCount = "hide";
                            $kl_red ="";
                            if(!empty($clientsModelesSms->nb_caractere)){
                            $kl_hideCount = "";
                            if($clientsModelesSms->nbr_sms > 1){
                            $kl_red = "kl_red";
                            }
                            }
                            ?>
                            <div class="kl_lbl_sms_nbre <?= $kl_hideCount.' '. $kl_red ?>">
                                <div>Caractères: <span id=""><input name="nb_caractere" type="text" id="id_char_val" value="<?= $clientsModelesSms->nb_caractere ?>" /></span></div>
                                <div>Nombre de sms: <span id=""><input name="nbr_sms" type="text" id="id_sms_nbre" value="<?= $clientsModelesSms->nbr_sms ?>" /></span></div>
                            </div>

                        </div>



                    </div>

                    <div class="form-actions">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
