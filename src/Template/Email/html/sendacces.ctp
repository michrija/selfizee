<html>
    <div style="color:#474747">
		<?php 
			if(isset($no_logo_header) && $no_logo_header){
				
			}else{
		?>
			<a href="https://selfizee.fr" target="_blank">
			 <?php 
				echo 
				$this->Html->image(
				$this->Url->build('https://manager.selfizee.fr/webroot/email/logo.png', ['alt' => 'Selfizee', 'style' => 'display:block']));
			?>
			</a>
        <?php } ?>
        <?= $contenu ?>
		<?php
			if(isset($no_logo_header) && $no_logo_header){
				echo '<p><a href="https://www.selfizee.fr" target="_blank"><img src="https://manager.selfizee.fr/img/logo-selfizee-noir-sans-accroche.png" alt="Logo Selfizee"></a></p>';
			}
		?>
    </div>
</html>