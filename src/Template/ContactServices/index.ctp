 <?php $ccp = @$userConnected['client']['code_couleur_principal']; ?>
    <?php 
        if(!empty($userConnected['client']->code_couleur_principal)){
            $urlCss = $this->Url->build(['controller' => 'CssCustoms', 'action' => 'interne',  $userConnected['client']['id']]);
            $this->Html->css($urlCss,['block' => true]);
        }
    ?>
<style>
    .contacts {
        display: flex;
        padding: 10px;
        align-items: center;
        margin: 0 auto;
        justify-content: space-around;
        float: none;
        overflow: hidden;
    }
</style>
<div class="row contacts">
    <div class="col-sm-8"><?= $this->Flash->render() ?></div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body" style="text-align:center ;">
                <h4>CONTACT</h4>
                <span style="font-size: 14px;">L'équipe Selfizee est à votre service pour tout acompagnement, du lundi au vendredi de 9h à 12h et 14h à 18h.
                <br>Contact téléphonique : 02 96 76 63 57</span>
            </div>
            <div class="row" style="justify-content: space-around;">
                <div class="col-8">
                    <div class="card-body">
                        <?= $this->Form->create($contactService, ['class'=>'form p-t-20']) ?>
                        <!--<form class="form p-t-20">-->
                            <div class="form-group row">
                                <label for="exampleInputuname3" class="col-sm-3 control-label">Nom *</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                        </div>
                                        <!--<input type="text" class="form-control" id="exampleInputuname3" placeholder="Nom">-->
                                        <?php echo $this->Form->control('nom', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Nom', 'required'=>true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputuname3" class="col-sm-3 control-label">Email *</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-email"></i>
                                                    </span>
                                        </div>
                                        <!--<input type="email" class="form-control" id="exampleInputuname3" placeholder="Email">-->
                                        <?php echo $this->Form->control('email', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Email', 'required'=>true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputuname3" class="col-sm-3 control-label">Message *</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </span>
                                        </div>
                                        <!--<textarea class="form-control" rows="5" placeholder="Message"></textarea>-->
                                        <?php echo $this->Form->control('message', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Message','required'=>true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
                                    </div>
                                </div>
                            </div>

                           <!-- <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><i class="mdi mdi-send "></i> ENVOYER</button>-->
                        <?= $this->Form->button('<i class="mdi mdi-send "></i> ENVOYER', ['class'=>'btn btn-success waves-effect waves-light m-r-10', 'escape'=>false]) ?>
                        <?= $this->Form->end() ?>
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>