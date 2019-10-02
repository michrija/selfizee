<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
?>


<?= $this->Html->script('crons/add.js', ['block' => true]); ?>
<?php
$titrePage = " Envoi automatique des photos";
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
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black"><?= $titrePage ?> </h4>
            </div>
            <div class="card-body">
                <?php
                echo $this->Form->create($cron);
                $myTemplates = [
                    'nestingLabel' => '{{hidden}}<label class="custom-control custom-radio col-sm-4" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
                    'dateWidget' => '<div class="col-md-6">{{day}}{{month}}{{year}} <span class="seperate">-</span> {{hour}} h {{minute}}{{second}}{{meridian}}</div>',
                    'select' => '<select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select>',
                ];
                
                $this->Form->setTemplates($myTemplates); 
                
                ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-12">
                        <?php
                            $kl_EvenementHide = "";
                            if(!empty($idEvenement)){
                                $kl_EvenementHide = "hide";
                            }
                        ?>
                        <div class="col-md-12 <?= $kl_EvenementHide ?>">
                            <?php echo $this->Form->control('evenement_id',['label' => 'Evénement *', 'options'=>$evenements,'value'=>$idEvenement, 'empty'=>'Séléctionner', 'id'=>'clients_id']); ?>
                        </div>
                        <!-- CRON AUTO -->
                        <div class="row col-8">
                            <label class="col-md-6">Activer l'envoi automatique</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <?php
                                    echo $this->Form->radio(
                                            'is_active',
                                            [
                                                ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                            ]
                                            ,['default' => 0, 'label' => "Activer l'envoi automatique", 'defaul']
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            $kl_cromActive ="hide";
                            if($cron->is_active){
                                $kl_cromActive ="";
                            }
                          ?>
                        <div id="id_activeCron" class=" <?= $kl_cromActive ?>">
                            <div class="row col-8 m-t-15">
                                <label class="col-md-6">E-mail</label>
                                <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_cron_email',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 0,'label' =>'E-mail']
                                                    );
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <div class="row col-8 m-t-15">
                                <label class="col-md-6">Sms</label>
                                <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_cron_sms',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => 0,'label' =>'Sms']
                                                    );
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->control('date_debut',['label'=>['text'=>'Date de début','class'=>'col-md-6 m-t-15'], 'interval' => 15]);
                            echo $this->Form->control('date_fin',['label'=>['text'=>'Date de fin','class'=>'col-md-6'], 'interval' => 15]);
                            echo $this->Form->control('intervalle_id', ['options' => $intervalles,'class'=>'form-control col-md-6 m-l-15','label'=>['text'=>'Intervalle','class'=>'col-md-12']]);
                            ?>
                            <hr>
                        </div>

                        <!-- CRON PROGRAMMEE -->
                        <div class="row col-8">
                            <label class="col-md-6">Activer l'envoi programmé</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <?php
                                    echo $this->Form->radio(
                                            'is_active_envoi_programme',
                                            [
                                                ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                            ]
                                            ,['default' => $cron_programme->is_active_envoi_programme, 'label' => "Activer l'envoi automatique", 'defaul']
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            $kl_cronProgrammeActive ="hide";
                            if($cron_programme->is_active_envoi_programme){
                                $kl_cronProgrammeActive ="";
                            }
                          ?>
                        <div id="id_activeCronProgramme" class=" <?= $kl_cronProgrammeActive ?>">
                            <div class="row col-8 m-t-15">
                                <label class="col-md-6">E-mail</label>
                                <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_email_cron_programme',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => $cron_programme->is_email_cron_programme,'label' =>'E-mail']
                                                    );
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <div class="row col-8 m-t-15">
                                <label class="col-md-6">Sms</label>
                                <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                                  echo $this->Form->radio(
                                                    'is_sms_cron_programme',
                                                    [
                                                        ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                        ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                    ],
                                                    ['default' => $cron_programme->is_sms_cron_programme,'label' =>'Sms']
                                                    );
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->control('date_programme',['type'=>'datetime', 'label'=>['text'=>'Date programmée','class'=>'col-md-6 m-t-15'], 'interval' => 15, 'value'=>$cron_programme->date_programme]);
                            ?>
                        </div>

                        </div>
                    </div>
                
                  
                    
                    <div class="form-actions m-t-10">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                    
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>