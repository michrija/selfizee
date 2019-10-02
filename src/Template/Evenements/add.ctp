<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
?>
<?= $this->Html->script('speackingurl/speakingurl.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.steps.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.validate.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/messages_fr.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-daterangepicker/daterangepicker.js', ['block' => true]); ?>


<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('evenements/add.css?t='.time(), ['block' => true]) ?>
<?= $this->Html->css('bootstrap-daterangepicker/daterangepicker.css', ['block' => true]) ?>

<?= $this->Html->script('Evenements/add.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/gestion-fonctionnalite.js', ['block' => true]); ?>
<?php
$titrePage = "Créer un événement";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>


<!-- vertical wizard -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content " id="id_creationEvenement">
                <?= $this->Form->create($evenement,['class' => 'no-tab-wizard form-bordered','id'=>'id_creationEvenementForm',"autocomplete"=>"off"]) ?>

                    <input autocomplete="off" name="hidden" type="text" style="display:none;">
                    <section>
                            <?php
                            $myTemplates = [
                                'dateWidget' => '<div class="col-md-6">{{day}}{{month}}{{year}} <span class="seperate">-</span> {{hour}} h {{minute}}{{second}}{{meridian}}</div>',
                                    'select' => '<div class="col-6"><select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select></div>',
                                    'label' => '<label{{attrs}} class="control-label kl_labelCustomMonsterat col-3">{{text}}</label>',
                                    'inputContainer' => '<div class="form-group row">{{content}} <span class="help-block"><small>{{help}}</small></span></div>',
                                    'input' => '<div class="col-6"> <input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/></div>',
                                    'inputContainerError' => '<div class="form-group row has-danger {{type}}{{required}} error">{{content}}{{error}}</div>',
                                    'error' => '<div class="form-control-feedback my-auto">{{content}}</div>',
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
                                        echo $this->Form->control('nom',['label'=>"Nom de l'événement *",'id'=>'id_nomEvenement','required'=>true, ]);
                                    ?>

                                    <?php if (!isset($evenement->getErrors()['nom']['_isUnique'])): ?>
                                        <div class="text-danger"><?= $this->Form->error('galeries.0.slug'); ?></div>
                                    <?php endif ?>
                                    
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
                                    <div class="pull-right">
                                        <button type="submit" id="id_saveEvenenemt">Enregistrer</button>
                                    </div>
                            </div>
                    </section>
                   
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->