<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('clients/add.js', ['block' => true]); ?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Credit $credit
 */
$titrePage = "Ajout d'un credit" ;
if($is_demande) $titrePage = "Demande de credit" ;
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>
<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"><?= __("Information") ?></h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create($credit, ['type' => 'file']) ?>
                <div class="form-body">
                     <div class="col-md-6">
                        <?php

                            $client_id = ""; $client_type = "";
                            if(!empty($client)) { 
                                $client_type = $client->client_type;
                                $client_id = $client->id;
                            }

                            $is_disabled = true;
                            if($is_demande) {
                                echo $this->Form->hidden('etat', ['value'=>0]);
                                echo $this->Form->hidden('client_id', ['value'=>$client_id]);
                                $is_disabled = true;
                            } else {
                                echo $this->Form->hidden('etat', ['value'=>1]);
                            }


                            //$type = array('person'=>'Particulier', 'corporation' => 'Professionnel');                            
                            //echo $this->Form->control('client_type',['label' => 'Type de client *', 'options'=>$type, 'value'=>$client_type, 'empty'=>'Séléctionner le type','required'=>true,'class'=>'form-control']);

                            echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true, 'value'=>$client_id, 'disabled'=>$is_disabled]);
                            echo $this->Form->control('credit');
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

