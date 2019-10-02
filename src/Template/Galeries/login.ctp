<?= $this->Html->script('Galeries/login.js', ['block' => true]); ?>
<div id="status">
</div>
<?php 
if(!empty($client->code_couleur_principal)){
    $urlCss = $this->Url->build(['controller' => 'CssCustoms', 'action' => 'galerielogin',  $client->id]);
    $this->Html->css($urlCss,['block' => true]);
} 
?>

<div class="text-center" style="padding:50px 0">

<div class="logo">
    <!--<img src="/events/webroot/img/logo-selfizee.png" alt="Selfizee" id="logo_selfizee" />-->
    <h1>Accès galerie photos</h1>
    </div>

    <!-- Main Form -->
<div class="login-form-1">
	
    <?= $this->Form->create(null, ["class"=>"text-left", "id"=>"login-form"]) ?>
		<div class="etc-login-form">
			<p>Veuillez saisir l'identifiant de votre album pour afficher votre galerie photos :</p>
		</div>
		<div class="login-form-main-message"><?= $this->Flash->render() ?></div>
		<div class="main-login-form">
			<div class="login-group">
				<div class="form-group" id="id_loginGalerie">
					<label for="fp_email" class="sr-only">Identifiant</label>
					<!--<input type="text" class="form-control" id="code" name="code" placeholder="Nom de l'album">-->
                    <?= $this->Form->control('username',["id"=>'id_login',"label"=>false,"class"=>"form-control", "required"=>true, "placeholder"=>__('Nom de l\'album') ]) ?>
                    <?= $this->Form->hidden('password',["id"=>'id_password', "label"=>false,"class"=>"form-control", "required"=>true, "placeholder"=>__('Password') ]) ?>
				</div>
			</div>
            <?= $this->Form->button('<i class="fa fa-chevron-right"></i>',["class"=>"login-button"]) ?>
		</div>
	<?= $this->Form->end() ?>
</div>