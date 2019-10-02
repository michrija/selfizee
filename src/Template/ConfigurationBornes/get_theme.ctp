<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('ConfigurationBornes/get_theme.js?'.time()); ?> 
<?= $this->Html->script('catalogues/detail.js?'.time()); ?>
<style>.hide{display:none;}</style>
<div class="ajax-text-and-image white-popup-block no-padding">
    <div class="col-sm-12 form-inline no-padding">
        <div class="col-sm-6 no-padding">
			<div class="sf-bloc-detail">
				<div class="sf-bloc-detail-borne" id="borne-spherik">
					
				</div>
				<div class="sf-bloc-detail-borne hide" id="borne-classik">
					
				</div>	
				<div class="sf-bloc-apercu_ecran_spherik" >
					
				</div>	
				<div class="sf-bloc-apercu_ecran_classik hide" >
					
				</div>
				<ul class="sf-borne-onglet no-padding form-inline">
					<li class="col-sm-6 active"><a id="tp-borne-spherik" href="#borne-spherik">Aperçus sphérik</a></li>
					<li class="col-sm-6"><a id="tp-borne-classik" href="#borne-classik">Aperçus classik</a></li>
				</ul>
			</div>
        </div>
        <div class="col-sm-6 sf-bg-gris">
			<div class="sf-bloc-detail-1 p-20">
				<h3><?= $catalogue->nom //Flamingo ?> </h3>
				<p class="m-b-30"><?= $catalogue->description //Thème floral pour mariage ?> </p>
				<div class="col-sm-12 no-padding sf-bloc-theme-images form-inline">				
						<?php
						$types = ['accueil' => 'Ecran d\'accueil', 'cadre' => 'Cadre', 'prise_photo'  => 'Ecran de prise photo', 'filtre'  => 'Ecran de filtre', 'remerciement'  => 'Ecran de remerciement', 'visualisation' => 'Ecran de visualisation', 'choix_fv' => 'Ecran de choix fond vert', 'selection_mult_config' => 'Sélection multiple configuration'];
						foreach($catalogue->image_fonds as $ord => $fond) {
							$url_img = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$catalogue->client_id.'/'.$fond->file_name; ?>
							<div class="col-sm-6 no-padding-left m-b-10 img_fond" title="<?= $types[$fond->type] ?>">
								<img class="img-responsive sf-cursor " src="<?= $url_img ?>">
							</div>
						<?php }?>
					<!--<div class="col-sm-6 no-padding-left m-b-10">
						<img class="img-responsive sf-cursor" src="/img/confbornes/animations/animation-1.png">
					</div>
					<div class="col-sm-6 no-padding-right m-b-10">
						<img class="img-responsive sf-cursor" src="/img/confbornes/animations/animation-1.png">
					</div>
					<div class="col-sm-6 no-padding-left m-b-10">
						<img class="img-responsive sf-cursor" src="/img/confbornes/animations/animation-1.png">
					</div>
					<div class="col-sm-6 no-padding-right m-b-10">
						<img class="img-responsive sf-cursor" src="/img/confbornes/animations/animation-1.png">
					</div>-->
				</div>
				<button type="button" class="btn btn-success p-l-50 p-r-50 m-t-40 sf-button-active-theme btn_in_view btn_active_theme <?= $is_active ? 'active':''?> " id="btnview_active_theme_<?= $catalogue->id ?>">
					<i class="fa <?= $is_active ?  'fa-times' : 'fa-check' ?>"></i> <?= $is_active ?  'Desactiver ce thème' : ' Activer ce thème' ?>
				</button>                        
			</div>
			<div class="sf-button-action">
			</div>
        </div>
        <div class="clearfix"></div>
    </div>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
</div>
<script>

$(function () {
	//$('.hide').hide();
	new Tippy('.img_fond', {
		position: 'top',
		arrow: true
	});

	$('[data-toggle="tooltip"]').tooltip();
	/*new $.Zebra_Tooltips($('.img_fond'), {
        position:           'right',
        vertical_alignment: 'below'
    });*/
});
</script>