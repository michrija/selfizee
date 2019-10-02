<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lot $lot
 */
$titrePage = "Ajout de nouveau lot" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Lots', 'action' => 'index'] 
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Importer un fichier csv'),['action'=>'importcsvlot'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Consulter la liste'),['action'=>'index'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success personalizePull",'style' => "margin-right: 10px"]);//style="margin-right: 10px;
$this->end();
?>

<?= $this->Html->css('dropify/dropify.min.css', ['block' => true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.css', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('lots/dropifylot.js', ['block' => true]); ?> 
<?= $this->Html->script('lots/lot.css', ['block' => true]); ?>

<?= $this->Html->script('Evenements/edit.js', ['block' => true]); ?>
<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-body">
                <?= $this->Form->create($lot, ['type'=>'file']) ?>
                <?php
                $myTemplates = [
                    'dateWidget' => '<div class="col-md-6">{{day}}{{month}}{{year}} <span class="seperate">-</span> {{hour}} h {{minute}}{{second}}{{meridian}}</div>',
                    'select' => '<select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select>',
                ];
                
                $this->Form->setTemplates($myTemplates); 
                ?>

                <?php 
                   $kl_clientHide = "hide"; 
                   if($userConnected['role_id'] == 1  ){
                     $kl_clientHide = "";
                   }  
                ?>

                <div class="col-md-12 <?= $kl_clientHide ?>" style = "width: 500px;">
                    <?php echo $this->Form->control('evenement_id',['label' => 'Evennement *', 'options'=>$nom_event,'empty'=>'Séléctionner', 'class'=>'select2 form-control']); ?>
                </div>

                <div class="col-md-12" style = "width: 500px;">
                    <?php echo $this->Form->control('nom',['label'=>'Nom']); ?> 
                </div>

                <!--<div class="col-md-12">
                    <?php echo $this->Form->control('photo',['label'=>'Photo']); ?> 
                </div>-->

                <div class="col-md-4">
                    <?php echo $this->Form->control('photo_file',["id"=>"photo_id","label"=>"Photo : ","class"=>"dropify", "type"=>"file", "accept"=>"image/*"]) ?>
                </div>

                <div class="col-md-12" style = "width: 284px;">
                    <?php echo $this->Form->control('quantite',['label'=>'Quantité']); ?> 
                </div>

                <div class="col-md-12" id="tp_gain">
                    <!-- <?php echo $this->Form->control('type_gain',['label'=>'Type de gain']); ?>  -->
                <?php echo $this->Form->select('type_gain', [0=>'Séléctionner le type de gain', 1 => 'probabilité', 2 => 'instant gagnant']); ?>
                </div>

                <div class="marg">
                    <!-- , ['style' => 'margin-top: 19px'] -->
                </div>

                <div class="col-md-12" style = "margin-top: 19px; width: 284px;" id="pblt_gain">
                    <?php echo $this->Form->control('probabilite_gain', ['label'=>'Probabilité de gain', 'placeholder'=>'                 Valeur en %']); ?> 
                </div>

                <div class="col-md-12" id="hr_gain" style = "margin-top: 19px">
                    <?php
                     echo $this->Form->control('date_deb_gain',['label'=>['text'=>'Horaire gain','class'=>'col-md-6'], 'interval' => 15, 'minYear' => date('Y')]);
                     ?>
                </div>

                <div class="form-actions" style = "margin-top: 19px" >
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Sauvegarder'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                <?= $this->Form->end() ?>

            </div> 
        </div>
    </div>
</div>
