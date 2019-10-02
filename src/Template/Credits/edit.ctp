<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('clients/add.js', ['block' => true]); ?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Credit $credit
 */
$titrePage = "Modification d'un credit" ;
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

                            echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true, 'value'=>$client_id, 'disabled'=>true]);
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

