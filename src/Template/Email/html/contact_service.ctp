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
        <p>Votre message a été bien reçu.</p>
        <p>Merci.</p>
        <p>L'équipe Selfizee</p><br />
    </div>
</html>