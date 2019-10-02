<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
?>

<?= $this->Html->script('speackingurl/speakingurl.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>

<?= $this->Html->css('evenements/add', ['block' => true]) ?>
<?= $this->Html->css('evenements/edit.css?t='.time(), ['block' => true]) ?>

<?= $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js', ['block' => true]); ?>


<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>

<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<?= $this->Html->script('wizard/jquery.steps.min.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/edit.js?'.time(), ['block' => true]); ?>

<?= $this->Html->script('wizard/jquery.validate.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/messages_fr.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/gestion-fonctionnalite.js', ['block' => true]); ?>



<?php
$titrePage = "Modification de l'événement";
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

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <!--<div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>-->
            <div class="card-body wizard-content" id="id_creationEvenement">
                <?= $this->Form->create($evenement, ['class' => 'tab-wizard form-bordered','id'=>'id_creationEvenementForm',"autocomplete"=>"off"]) ?>

                    <!-- Step 1 -->
                    <h6>Modification événement</h6>
                    <section>
                            <?php
                            $myTemplates = [
                                'dateWidget' => '<div class="col-md-6">{{day}}{{month}}{{year}} <span class="seperate">-</span> {{hour}} h {{minute}}{{second}}{{meridian}}</div>',
                                    'select' => '<div class="col-6"><select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select></div>',
                                    'label' => '<label{{attrs}} class="control-label kl_labelCustomMonsterat col-3">{{text}}</label>',
                                    'inputContainer' => '<div class="form-group row">{{content}} <span class="help-block"><small>{{help}}</small></span></div>',
                                    'input' => '<div class="col-6"> <input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/></div>',

                            ];
                            
                            $this->Form->setTemplates($myTemplates); 
                            ?>
                            <div class="form-body">
                                   <?php 
                                   $kl_clientHide = "";
                                   //debug($userConnected);
                                   if($userConnected['client_id']){
                                     $kl_clientHide = "hide";
                                   }  
                                   ?>
                                    
                                   <?php if ($currentUser['role_id'] == 7): ?>
                                       <div class="hide">
                                           <?php echo $this->Form->control('client_id',['label' => 'Client *', 'options'=>$clients,'empty'=>'Séléctionner', 'id'=>'clients_id', 'default' => $clientParrentId,'required'=>true,'class'=>'form-control']); ?>
                                       </div>
                                   <?php else: ?>
                                        <div class=" <?= $kl_clientHide ?>">
                                            <?php echo $this->Form->control('client_id',['label' => 'Client *', 'options'=>$clients,'empty'=>'Séléctionner', 'id'=>'clients_id', 'value'=>$userConnected['client_id'],'required'=>true,'class'=>'form-control']); ?>
                                        </div>
                                   <?php endif ?>
                                    
                                    <?php 
                                        echo $this->Form->control('nom',['label'=>"Nom de l'événement *",'id'=>'id_nomEvenement','required'=>true]);
                                    ?>
                                    <div class="hide">
                                        <?php echo $this->Form->control('slug',['label'=>'Identifiant de l\'événement *','templateVars' => ['help' => 'Sans accent, ni espace'], 'id'=>'id_identifiantEvemenemt']); ?>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 kl_labelCustomMonsterat ">Date événement</label>
                                        <div class="col-6">
                                            <div class="input-daterange input-group row" id="date-range">
                                               
                                                <div class="input-group col-4">
                                                   <?php  echo $this->Form->control('start',['label'=>false,"class"=>"form-control kl_noborderRigth",
                                                        'templates' => ['input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/>',
                                                            'inputContainer' => '{{content}}',
                                                        ]
                                                    ]);
                                                    ?>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text kl_custIcon"><i class="fa fa fa-calendar"></i></span>
                                                    </div>
                                                </div>

                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-white b-0 text-black">au</span>
                                                </div>
                                                
                                                <div class="input-group col-4">
                                                    <?php  echo $this->Form->control('end',['label'=>false,"class"=>"form-control kl_noborderRigth",
                                                        'templates' => ['input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/>',
                                                            'inputContainer' => '{{content}}',
                                                        ]
                                                    ]);
                                                    ?>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text kl_custIcon"><i class="fa fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                        echo $this->Form->control('lieu',['label'=>'Lieu','autocomplete' => 'off']); 
                                    ?>
                                    <div class="lastnoborder">
                                    <?php 
                                        if(empty($typeEvenements->toArray())){
                                            $typeEvenements =  [1 => 'Particulier', 2 => 'Professionel'];
                                        }
                                        echo $this->Form->control('type_evenement_id',['label' => 'Type', 'options'=>$typeEvenements,'empty'=>'Séléctionner','class'=>'form-control']); 
                                    ?>
                                    </div>
                                  
                                    <!-- Hide -->
                                    <div class="hide">
                                    <?php 
                                        //echo $this->Form->hidden('user.role_id',['value'=>4]); 
                                        echo $this->Form->control('galeries.0.nom',['id'=>'id_nomGaleire']);
                                        echo $this->Form->control('galeries.0.slug',['id'=>'id_slugGalerie']);
                                        echo $this->Form->control('galeries.0.titre',['id'=>'id_titreGalerie']);
                                        echo $this->Form->control('galeries.0.user.username',['class'=>'kl_sameValue']);
                                        echo $this->Form->control('galeries.0.user.password',['class'=>'kl_sameValue']);
                                        echo $this->Form->hidden('galeries.0.user.role_id',['value'=>3]);
                                    ?>
                                    </div>
                        </div>
                        
                    </section>
                    
                    <!-- Step 2 -->
                    <h6>Options marketing</h6>
                    <section>
                        <div class="row col-12" id="id_activationFonctionaliteMarketing" >
                            <div class="row-fluid d-block">
                                <p class="kl_texteIntroMarketing">Quelles fonctionnalités marketing souhaitez-vous modifier sur cet événement?</p>
                                <hr class="col-12 m-t-0 m-b-0">
                            </div>

                            <?php $listeIdFonctionnalite = []; ?>
                            <?php $listFonctionnalites = collection($evenement->fonctionnalites)->extract('id')->toArray() ?>
                            <?php foreach ($fonctionnalites as $key => $fonctionnalite): ?>
                                
                                <div class="row col-12 kl_oneOption">
                                    <div class="col-lg-9">
                                        <div class="kl_titreOptionMark"><?= $fonctionnalite->nom ?> <div class="kl_iconInterogation">?</div> </div>
                                        <div class="kl_descOpton"><?= $fonctionnalite ->description ?></div>
                                    </div>
                                    <div class="col-lg-3 kl_nopaddingR">
                                        <div class="customBtn pull-right">
                                            <?php if (in_array($fonctionnalite->id, $listFonctionnalites)): ?>
                                                <a href="#" id="id_toActive_<?= $fonctionnalite->id ?>" class="btn kl_checkSelfizee"><i class="fa fa-times-circle"></i> <span class="kl_texteAremplacer">Désactiver</span> la fonctionnalité</a>
                                            <?php else: ?>
                                                <a href="#" id="id_toActive_<?= $fonctionnalite->id ?>" class="btn kl_checkSelfizee kl_disable"><i class="fa fa-check"></i> <span class="kl_texteAremplacer">Activer</span> la fonctionnalité</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <hr class="col-12 m-t-0 m-b-0">
                                <?php $listeIdFonctionnalite[$fonctionnalite->id] = $fonctionnalite->id; ?>

                            <?php endforeach ?>


                            <div class="row hide">
                                <?php
                                echo $this->Form->control('fonctionnalites._ids', [
                                    'type' => 'select',
                                    'multiple' => true,
                                    'options' => $listeIdFonctionnalite,
                                    'id' => 'id_selecteFonctionnaite',
                                    'class' => 'col-lg-12 form-control',
                                    'label' => false
                                ]);
                                ?>
                            </div>
                        </div>
                    </section>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>