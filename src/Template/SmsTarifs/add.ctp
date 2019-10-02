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

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <!--<div class="card-header">
                <h4 class="m-b-0 text-white">Information générales</h4>
            </div>-->
            <div class="card-body">
           
                <?= $this->Form->create($smsEntity) ?>
        
                 <div class="form-group">
                    <label for="">Prix €</label>
                    <?php echo $this->Form->input('prix', ['class' => 'form-control', 'label' => false]);?>
                </div>
                 <div class="form-group">
                    <label for="">Nombre</label>
                    <?php echo $this->Form->input('nbr_sms', ['class' => 'form-control', 'label' => false]);?>
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>