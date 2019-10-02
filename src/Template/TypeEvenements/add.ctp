<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeEvenement $typeEvenement
 */
?>

<div class="card card-new-selfizee" >
    <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black">Catégorie d'événement </h4>
    </div>
    <div class="card-body row">
        <div class="col-sm-12 col-xs-12">
            <?= $this->Form->create($typeEvenement) ?>
                <?php  echo $this->Form->control('nom',['required' => true]); ?>
                <div class="hide">
                    <?php  echo $this->Form->control('client_id',['required' => true, 'value' => $userConnected['client_id']]); ?>
                </div>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success waves-effect waves-light ']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
                    
