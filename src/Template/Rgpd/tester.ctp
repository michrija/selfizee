<?php
$titrePage = "Cliquer sur l'email pour afficher la page RGPD de chaque client" ;
$this->assign('title', $titrePage);
?>  

<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title"><?php echo $titrePage ?></h4>
			<div class="table-responsive">
				<?php 
					$i = 1;
					echo '<ul class="list-unstyled">';
					// echo 'Jean yves : '.$domaine.'e/inf/'.($utilities->slEncryption(serialize(['email' => 'zanakolonajym@gmail.com'])));
					foreach($contacts as $contact){
						echo '<li class="media">'.
							'<img class="d-flex mr-3" src="/img/profil.jpg" width="60" alt="Generic placeholder image">'.
							'<div class="media-body">'.
								'<h5 class="mt-0 mb-1">'.$contact->nom.' '.$contact->prenom.'</h5>'.
								'<a target="_blank" href="'.$domaine.'e/inf/'.($utilities->slEncryption(serialize(['email' => $contact->email]))).'">'.$contact->email.'</a>'.
							'</div>'.
						'</li>';
						$i++;
					}
					echo '</ul>';
				?>
			</div>
		</div>
	</div>
</div>