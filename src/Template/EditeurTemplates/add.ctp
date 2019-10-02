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
        <div class="col-md-12">
             <div class="card card-new-selfizee" id="id_configEmail">
               <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-md-6 "> 
                    <?php
                    echo $this->Form->control('logo_page_bo_file',["id"=>"photo_id","label"=>"Logo du back office","class"=>"dropify", "type"=>"file", "accept"=>"image/*"]);
                    ?>
                    </div>
                    <div class="col-md-6 "> 
                    <?php
                    echo $this->Form->control('client_type_id', ['options' => $typeTemplate, 'empty' => 'Séléctionner le type', 'required', 'class' => 'form-control', 'label' => 'Type d\'image template']);
                    ?>
                   </div>
                </div>
               </div>
            </div>
        </div>
    </div>
 <?= $this->Form->end() ?>    

       

     

                