
<?= $this->Html->css('politiques/pol.css?'.time(), ['block' => true]) ?>

<div class="row kl_intro kl_introCssb">
	<div class="container">
         <div class="kl_theIntro">
            <!--<p class="kl_fontWhite400Date">Dernière mise à jour : 16 juillet 2019</p> -->
         </div>
         <div class="kl_phrase_intro">
            <p class="kl_fontWhite400">               
			<!--Découvrez en toute transparence la politique liée au traitement des données utilisateurs que nous collectons par le biais des animations effectuées au nom de nos clients organisateurs. -->
            </p>
         </div>
    </div>
</div>

<div class="sf-politique">
    <div class="container">
        <?php
                echo $contenu;            
        ?>
    </div>
</div>