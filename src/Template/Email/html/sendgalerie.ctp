<html>
    <div style="color:#474747">
        <a href="https://selfizee.fr" target="_blank">
         <?php 
            echo 
            $this->Html->image(
            $this->Url->build('https://manager.selfizee.fr/webroot/email/logo.png', ['alt' => 'Selfizee', 'style' => 'display:block']));
        ?>
        </a>
        <!--<p>Bonjour, </p>
        <p>Votre galerie est prête </p>
        <p>Voici les accès  :</p>
        <p>Url : <a href="https://event.selfizee.fr/">https://event.selfizee.fr/</a></p>
        <p>Login : <?= $slug ?> </p>
        <p><?= $commentaire ?> </p>
        <br/>
        <p>Merci.</p>-->

        <p>Bonjour, </p>

        <p>Toute l'équipe SELFIZEE vous félicite pour votre événement.</p>

        <p>Nous sommes fiers d'avoir pu vous accompagner pour votre animation et nous vous remercions de votre confiance.</p>

        <p>Nous vous communiquons le lien pour accéder à votre galerie: <a href="<?= $url_front ?>"><?= $url_front ?></a></p>

        <p>Votre identifiant personnalisé : <?= $slug ?> </p>

        <p>Vous accédez ensuite à votre galerie avec l'ensemble de vos photos. Vous pouvez ensuite les télécharger et/ou les partager avec vos invités ou sur les réseaux sociaux.</p>

        <p>Nous restons à votre disposition pour tout renseignement.</p>

        <p>Merci et à bientôt.</p>

        <p>L'équipe SELFIZEE</p>

        <p>expediteur : <a href="mailto:contact@konitys.fr"> contact@konitys.fr </a></p>
    </div>
</html>
