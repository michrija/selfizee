<?=   $this->Html->script('ConditionLojika/lojikapopup.js', ['block' => true]); ?>
<?=   $this->Html->css('style.js', ['block' => true]); ?>

<div class="modal fade" id="id_addChamp"con tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Ajout champ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
			<div class="modal-body">
				<div class="col-md-12 ">
					<?= $this->Form->control('nom',['label' => 'Titre','id'=>'id_nom_champ']); ?>
				</div>
				<div class="fql hide">                   
					<div id="qlActive" class="col-md-12">
						<label class="custom-control custom-checkbox" for="is_active_form_down">
						<input type="checkbox" name="is_active_form_down" value="0" class="custom-control-input" id="is_active_form_down"><span class="custom-control-label">Activer la condition logique</span>
						</label>
					</div>
				</div>
				   
				<label class="col-md-12">Obligatoire </label>
				<div class="col-md-12">
					<div class="col-md-12">                            
						<?php 
							echo $this->Form->radio('is_required',
								[
									['value' => 1, 'text' => 'Oui','class'=>'custom-control-input is_required isRequiredValue'],
									['value' => 0, 'text' => 'Non','class'=>'custom-control-input is_required isRequiredValue'],
								],
									['default' => 0,'label' =>'Required ']
							);
						?>                            
					 </div>
				</div>
							
				<div class="col-md-12">
					<?= $this->Form->control('type_champ_id',['label' => 'Type de champ', 'options'=>$typeChamps, 'empty'=>'Séléctionner','id'=>'id_type_champ']); ?>
				</div>  

				<div class="col-md-12 hide" id="id_listeOption">
					<div id="id_theListeOption">
						<?= $this->Form->control('option_1',['label' => 'Option 1','class'=>'k_oneOption form-control']); ?>
						<?= $this->Form->control('option_2',['label' => 'Option 2','class'=>'k_oneOption form-control']); ?>
					</div>
					<div class="col-md-12">
						<button type="button" class="btn btn-success" id="id_addOption"  ><i class="mdi mdi-plus-circle"></i> <?= __('Ajouter une option') ?></button>
					</div>
				</div>
					
				<div class="col-md-12 hide" id="id_theTypeOptin">
					<?= $this->Form->control('type_optin_id',['label' => 'Type de données', 'options'=>$typeOptins, 'empty'=>'Séléctionner', 'id'=>'id_type_optin_value']); ?>
				</div>
				<div class="col-md-12 hide" id="id_customOptin">
					 <?= $this->Form->control('customOptin',['label' =>false,'class'=>'form-control','placeholder'=>'Votre texte personnalsé ici...','id'=>'id_customOptinValue']); ?>
				</div>
					
				<div class="col-md-12 hide" id="id_theTypeDeDonnees">
					<?= $this->Form->control('type_donnee_id',['label' => 'Type de données', 'options'=>$typeDonnees, 'empty'=>'Séléctionner', 'id'=>'id_type_donnee']); ?>
				</div>
				<div class="col-md-12">
					<div class="kl_error kl_champObli hide">
						<span class="label label-danger">Tous les champs sont obligatoires.</span>
					</div>
				</div>
				<input type="hidden" id="id_editionForm" />
			</div>

            <div id="demo" class="main-wrapper">
				<div class="col-md-12">
					<div id="valeurTrsnsmis" class="valTra">
						<div class="col-md-12 ">
							<div class="form-group">
								<label for="id_nom_champ" class="control-label" id="quest">Question</label>
								<input type="text" name="nom" id="id_nom_champ" class="form-control"> <span class="help-block"><small></small></span>
							</div>                        
						</div>
					</div>

					<div id="optionValue hide" class="valOption">
						<div class="col-md-12">
							<div class="form-group">
								<label  class="control-label">Voulez vous séléctionner un titre?</label>
								<select class="custom-select" id="choix-select">
								</select>
							</div>
						</div>
					</div>

					<div class="shown">
					   <div class="col-md-4 lbl-opt">
							<div class="row">
								<input name="is_prise_coordonne" value="" class="form-control" type="hidden">
								<label class="custom-control custom-radio col-sm-4" for="is-prise-coordonne-1">
									<input name="is_prise_coordonne" value="1" class="custom-control-input" id="is-prise-coordonne-1" checked="checked" type="radio">
									<span id="translateTo1" class="custom-control-label">Oui</span>
								</label>

								<input value="" class="form-control" type="hidden">
								<label class="custom-control custom-radio col-sm-4" for="is-prise-coordonne-0">
									<input name="is_prise_coordonne" value="0" class="custom-control-input" id="is-prise-coordonne-0" type="radio">
									<span id="translateTo2" class="custom-control-label">Non</span>
								</label>

							 </div>
						</div>
					</div>
				</div>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" id="id_ToaddChamp">Ajouter</button>
			</div>
        </div>
    </div>
</div>