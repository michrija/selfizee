<html>
    <div style="color:#474747">
        <a href="https://selfizee.fr" target="_blank">
         <?php 
            echo 
            $this->Html->image(
            $this->Url->build('/webroot/email/logo.png', ['alt' => 'Selfizee', 'style' => 'display:block']));
        ?>
        </a>
        <p>Bonjour, </p>
        <p>Votre galerie est pret </p>
        <p>Voici les accès  :</p>
        <p>Login : <?= $slug ?> </p>
        <br/>
        <p>Merci.</p>
    </div>
</html>
