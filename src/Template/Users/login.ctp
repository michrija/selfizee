<?php 
use Cake\Routing\Router;
$this->assign('title', 'Se connecter') ;

if(!empty($client->code_couleur_principal)){
    $urlCss = Router::url(['controller' => 'CssCustoms', 'action' => 'login',  $client->id]);
    $this->Html->css($urlCss,['block' => true]);
} 
?>
<div class="row">
    <div class="col-sm-12 col-lg-6 col-md-6 kl_loginLeft">
        <div class="kl_logoInlogin">
            <a href="#">
              <?php 
              $logo = 'logo-noir.png';
              if(!empty($client) && !empty($client->logo_page_bo)){
                    $logo = $client->url_logo_page_bo; 
              }
              echo $this->Html->image($logo, ['alt' => 'Logo Selfizee' ,'class'=>'img-responsive']); 
                ?>
            </a>
        </div>
        <div class="containerLogin">
            <div class="kl_loginSignin">
                <div class="kl_loginTitle" >Manager d'événement</div>
                <div class="kl_loginDesc">Vous avez un compte pour  gérer vos événement ? Identifiez vous .</div>
                <div class="kl_loginForm">
                        <?= $this->Flash->render() ?>
                        <?= $this->Form->create(null, ["class"=>"form-horizontal form-material", "id"=>"loginform"]) ?>
                            
                            <?php echo $this->Form->input('username', ['type'=>'text','class' => 'kl_InputLogin empty','placeholder' => "Nom d'utilisateur",'label' => "Nom d'utilisateur","autocomplete"=>false]);?>
                            
                            <?php echo $this->Form->input('password', ['type'=>'password', 'placeholder' => "Mot de passe", 'class' => 'kl_InputLogin empty', 'label' => "Mot de passe"]);?>
                            
                            
                            <div class="kl_loginActions">
                                <?= $this->Form->button('Se connecter',["class"=>"btn btn-danger btn-pill btn-elevate kl_btnLogin",'escape'=>false]) ?>
                            </div>
                        <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
        <div class="kl_linkToSite">
                <?php
                    $urlSiteWeb = 'http://www.selfizee.fr';
                    if(!empty($client) && !empty($client->url_site_web)){
                        $urlSiteWeb = $client->url_site_web; 
                  }
                ?>
                <a href="<?= $urlSiteWeb ?>" target="_blank"><i class="fa fa-chevron-left pr-3 color-selfizee font-ligth"></i> Accéder au site internet</a>
        </div>
    </div>
    <?php
        $bgRight = $this->Url->build('/img/gallery/gallery_calque.jpg');
        if(!empty($client) && !empty($client->img_fond_login)){
            $bgRight = $client->url_img_fond_login; 
        }
    ?>
    <div class="col-sm-12 col-lg-6 col-md-6 d-none d-md-block d-lg-block d-xl-block kl_loginRigth" style="background-image: url(<?= $bgRight ?>);">
        
    </div>
</div>