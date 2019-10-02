<html>
    <?php  echo $content ; ?>
    <br />
    
    <?php if(!$evenement->is_marque_blanche)  {?>
    <div style="color:#474747">
        <br />
        <a href="https://selfizee.fr" target="_blank">
         <?php 
            echo 
            $this->Html->image(
            $this->Url->build('/webroot/email/logo.png', ['alt' => 'Selfizee', 'style' => 'display:block']));
        ?>
        </a>
        <p>E-mail envoyé depuis la borne photo Selfizee : </p>
        <p><strong>Soirées professionnelles et privées dans toutes la France : </strong></p>
        <p>soirées événementielles, salons et foires, séminaires, événements sportifs, mariages, anniversaires ...</p>
        <p><a href="https://www.selfizee.fr" style="color:#f00e5d">www.selfizee.fr</a></p>   
    </div>
    <?php } ?>
</html>
