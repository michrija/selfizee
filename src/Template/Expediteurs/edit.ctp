<div class="card card-new-selfizee" >
    <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black">Modifier un expéditeur </h4>
    </div>
    <div class="card-body row">
        <div class="col-sm-12 col-xs-12">
            <?= $this->Form->create($expediteur) ?>
                <?php  echo $this->Form->control('email',['required' => true]); ?>
                <div class="hide">
                    <?php  echo $this->Form->control('client_id',['required' => true, 'value' => $userConnected['client_id']]); ?>
                </div>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success waves-effect waves-light ']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>