<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
  use Cake\Routing\Router;
?>

<?= $this->Html->css('bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css', ['block' => true]); ?>
<?= $this->Html->css('sms-configurations/add.css', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datetime-picker/js/locales/bootstrap-datetimepicker.fr.js', ['block' => true]); ?>
<?= $this->Html->script('SmsConfigurations/add.js', ['block' => true]); ?>

<?php
$titrePage = "Configuration sms";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
$evenement->nom,
['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
?>


 <?= $this->Form->create($smsConfiguration) ?>
<div class="row">
    <div class="col-lg-9">
        <div class="card card-new-selfizee" id="id_configEmail">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black">Paramètrage sms </h4>
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-body">
                        <div class="row">
                            <?php
                                $kl_EvenementHide = "";
                                if(!empty($idEvenement)){
                                    $kl_EvenementHide = "hide";
                                }
                            ?>
                            <div class="col-md-12 <?= $kl_EvenementHide ?>">
                                <?php echo $this->Form->control('evenement_id',['label' => 'Evénement *', 'options'=>$evenements,'value'=>$idEvenement, 'empty'=>'Séléctionner', 'id'=>'clients_id']); ?>
                            </div>
                            <?php if($clientsModelesSmss->count() > 0) {?>
                            <div class="col-md-12">
                                <input type="hidden" value="<?= Router::url('/', true) ?>" id="base_url" />
                                <?php echo $this->Form->control('clients_modeles_sms_id',['id' => 'model_sms', 'label' => 'Modèles ', 'options'=>$clientsModelesSmss,'empty'=>'Séléctionner le modèle','required'=>false,'class'=>'form-control']);?>
                            </div>
                            <?php } ?>
                            <div class="col-md-12">
                                <?php echo $this->Form->control('expediteur',['label'=>'Expéditeur : ','maxlength'=>'11','templateVars'=>['help'=>'Maximum 11 caractères']]); ?>
                            </div>
                            <div class="col-md-12 kl_ContenuSMS">
                                <?php echo $this->Form->control('contenu',['id'=>'id_contentSMS', 'maxlength'=>140, 'label'=>'Contenu : ','placeholder'=>'Le contenu du sms','type'=>'textarea','templateVars'=>['help'=>'Limité à 140 caractères']]); ?>
                                <?php 
                                $kl_hideCount = "hide";
                                $kl_red ="";
                                if(!empty($smsConfiguration->nb_caractere)){ 
                                    $kl_hideCount = "";
                                    if($smsConfiguration->nbr_sms > 1){
                                        $kl_red = "kl_red";
                                    }
                                } 
                                ?>
                                <!--<div class="kl_lbl_sms_nbre <?= $kl_hideCount.' '. $kl_red ?>">
                                    <div>Caractères: <span id=""><input name="nb_caractere" type="text" id="id_char_val" value="<?= $smsConfiguration->nb_caractere ?>" /></span></div>
                                    <div>Nombre de sms: <span id=""><input name="nbr_sms" type="text" id="id_sms_nbre" value="<?= $smsConfiguration->nbr_sms ?>" /></span></div>
                                </div> -->
                                
                            </div>
                            <div class="col-md-12 ">
                                <div class="kl_grayAstuce">
                                    <div class="kl_iconSupInAstuce"> </div>
                                    <div class="kl_textAstuce">
                                        Insérez le code : [[lien_partage]] à l'endroit où vous souhaitez afficher le lien de la photo dans le contenu du sms. 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-15 ">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <!--<input type="checkbox" class="custom-control-input">-->
                                        <?php 
                                        echo $this->Form->checkbox('limiter_un_sms', ['hiddenField' => false, 'label'=>false, 'class'=>'custom-control-input']);
                                        ?>
                                        <span class="custom-control-label">Limiter à un nombre de sms maximum</span>
                                        
                                    </label>
                                </div>
                            </div>
                        </div>
                       
                     
                    </div> 
                </div>
                
                <div class="col-md-6">
                    <div class="card card-custom-selfizee-color">
                            <div class="card-header">
                                <h4 class="m-b-0 text-black">Crédit sms restant : <span class="kl_creditRestantValue"><?= isset($infoCreditClient['creditDisponible']) ? $infoCreditClient['creditDisponible'] : 0 ?></span></h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text kl_customCssCadre">Attention, si votre crédit sms est insuffisant les messages hors quota ne s'enverront pas. Pensez à créditer votre solde avant votre événement.</p>
                                <a href="<?= $this->Url->build(['controller' => 'credits', 'action' => 'buy-sms',$evenement->id, $evenement->client_id]) ?>" class="kl_linkSelfizeeSimple">> Acheter du crédit supplémentaire</a>
                            </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="col-md-3 kl_noPaddingLeft">
        <div class="card card-new-selfizee">
            <div class="card-header">
                <h4 class="m-b-0 text-black">Etat </h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <?php 
                    $opts = [ 0 =>'Désactivé', 1=>'Activé' ];
                    echo $this->Form->select('is_active', $opts,['class'=>'custom-select custom-select-selfizee col-12', 'default' => 1]); 
                    ?>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox custom-checkbox-selfizee">
                        <!--<input type="checkbox" id="id_activeDateEnvoi" class="custom-control-input" <?= $smsConfiguration->date_heure_envoi ? 'checked': '' ?>>-->

                        <?php echo $this->Form->control('is_envoi_plannifie',
                                [
                                    'type' => 'checkbox',
                                    'class' => 'custom-control-input',
                                    'label'=>false, 
                                    //'hiddenField' => false,
                                    'id' => 'id_activeDateEnvoi',
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                        ]) ?>
                                
                        <span class="custom-control-label">Plannifier l'envoi à une date programmée</span>
                    </label>
                </div>
                <div class="form-group <?= $smsConfiguration->is_envoi_plannifie ? '': 'hide' ?>" id="id_dateHeureEnvoi">
                        <?php 
                       echo $this->Form->control('date_heure_envoi',
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
            </div>
        </div>
        
        <button type="button" class="kl_btnDeTest btn btn-success0 btn-selfizee-new fw500 col-12" data-toggle="modal" data-target="#smsTest" data-whatever="@mdo"> <?= __('Envoyer un sms de test') ?></button>

        <?= $this->Form->button(__('Save'),["class"=>"kl_btnDeTest btn btn-success col-12 m-t-15",'escape'=>false]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
<?php echo $this->element('sms_test',['evenement' => $evenement]) ?>