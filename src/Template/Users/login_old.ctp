<section id="wrapper">
    <div class="login-register" style="background-image:url(img/bg_login.png);"> 
        <div class="kl_logo">
            <?php echo $this->Html->image('logo-login.png', ['alt' => 'Logo Selfizee']); ?>
        </div>       
        <div class="login-box card">
        <div class="card-body">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ["class"=>"form-horizontal form-material", "id"=>"loginform"]) ?>
                <h3 class="box-title m-b-20"><?= __('Sign In') ?></h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <?= $this->Form->control('username',["label"=>false,"class"=>"form-control", "required"=>true, "placeholder"=>__('Login') ]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                       <?= $this->Form->control('password',["label"=>false,"class"=>"form-control", "required"=>true, "placeholder"=>__('Password') ]) ?>
                    </div>
                </div>
              
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <?= $this->Form->button('Connexion',["class"=>"btn btn-selfizee btn-info btn-lg btn-block text-uppercase waves-effect waves-light"]) ?>
                    </div>
                </div>
   
              
            <?= $this->Form->end() ?>
            
        </div>
      </div>
    </div>
</section>
