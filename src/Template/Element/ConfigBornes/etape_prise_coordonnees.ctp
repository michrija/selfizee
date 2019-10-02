<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>    
<div class="sf-step sf-step2 sf-choix-prise-coordonnees" id="id_priseCoordonnees">					
    <div class="col-sm-12 m-b-15">
        <h5>Prise de coordonnées :</h5>
    </div>
    
    <div class="col-sm-12">
        <p class="control-label m-b-20">Proposez la collecte de coordonnées permettant d’envoyer la photo en numérique et de collecter de la data supplémentaire.</p>
    </div>
    <div class="col-sm-12 form-inline">
        <label class="custom-control custom-radio m-r-100" for="is_prise_coordonnee-1">
            <input type="radio" name="is_prise_coordonnee" id="is_prise_coordonnee-1" value="1" class="custom-control-input" <?= $configurationBorne->is_prise_coordonnee ? 'checked="checked"' : '' ?>>
            <span class="custom-control-label m-l-5">Oui</span>
        </label>
        <label class="custom-control custom-radio" for="is_prise_coordonnee-0">
            <input type="radio" name="is_prise_coordonnee" id="is_prise_coordonnee-0" value="0" class="custom-control-input" <?= $configurationBorne->is_prise_coordonnee ? '' : 'checked="checked"' ?>>
            <span class="custom-control-label m-l-5">Non</span>
        </label>
    </div><br>
    
    <div id="id_siPriseDeCoordronnee" class="<?= $configurationBorne->is_prise_coordonnee ? "":"hide" ?> row col-md-12 no-padding-right">
        <div class="col-md-12">
            <?= $this->Form->control('titre_formulaire',['default'=>'Veuillez saisir vos coordonnées pour recevoir votre photo','label' => 'Titre formulaire ','maxlength'=>200,'id'=>'id_titreForme', 'templateVars' => ['help' => '<span class="kl_resteTitreForm">143</span> caractères restants']]); ?>
        </div>
        
        
        <div class="col-sm-12 m-t-20 kl_champs">
            <label class="control-label">Champs</label>
        </div>
        <div class="col-sm-12 kl_champs no-padding-right m-b-15">
            <div class="sf-bg-gris p-20 no-padding-left">
                <div class="form-group form-inline no-margin">
                    <label class="col-4 col-form-label">Configurations pré-configurées :</label>
                    <div class="col-4">
                        <select class="custom-select">
                            <option value="">E-mail / Accèpte de recevoir</option>
                        </select>
                    </div>
                    <div class="col-4 no-padding-right">
                        <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#id_addChamp" id="id_addChamp_popup" data-backdrop="static" data-keyboard="false">Ajouter un champ</button>
                        <input type="hidden" value="1" id="sf-champ-size">
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-12" id="id_listeChampAdded">
            <?php 
            if(!empty($configurationBorne->champs)){
            foreach($configurationBorne->champs as $key => $champ) { 
            ?>
            <div class="kl_oneListe" id="id_idChampAdded_<?= $champ->id ?>">
                <div class="col-md-12 kl_oneChampAdded m-t-15">
                    <div class="kl_indexChamp"><?= $key+1 ?></div>
                    <div class="kl_infoChamp">
                        <div class="kl_titreChamp"><?= $champ->nom ?></div>
                        <?php
                        $optionsInput = "";
                        $optionsPossible = array();
                        foreach($champ->champ_options as $key => $option ){
                            $optionsPossible[] = $option->nom;
                            $optionsInput =  $optionsInput . '<input type="hidden" name="champs['.$champ->id.'][champ_options]['.$key.'][id]" value="'.$option->id.'"  /><input type="hidden" class="kl_oneChoixPossible" name="champs['.$champ->id.'][champ_options]['.$key.'][nom]"  value="'.$option->nom.'" />';
                        }
                        $choixPossible = "";
                        if(!empty($optionsPossible)){
                            $choixPossible = " - Choix Possible : ".$this->Text->toList($optionsPossible);
                        }
                        $typeDonneeOptin = "";
                        if(!empty($champ->type_optin)){
                            $typeDonneeOptin = '- Type de données : '.$champ->type_optin->titre ;
                            if($champ->type_optin->id == 6 && !empty($champ->custom_optin)){
                                $typeDonneeOptin = $typeDonneeOptin . ' : '. $champ->custom_optin->titre;
                            }
                        } 
                        ?>
                        <div class="kl_infoChampAdded">Type de champ : <?= !empty($champ->type_champ) ? trim($champ->type_champ->nom) : '' ?>  <?= $typeDonneeOptin ?> <?= !empty($champ->type_donnee) ? '- Type de données : '.$champ->type_donnee->nom : ''  ?> <?= $choixPossible ?> - Obligatoire: <?= empty($champ->is_required) ? "Non" : "Oui" ?> </div>
                    </div>
                    <div class="kl_actionsChamp absolute">
                        <a class="btn btn-actionChamp float-right m-r-5 kl_editChamp" data-customid="<?= $champ->id ?>" href="#">
                            <i class="mdi mdi-lead-pencil"></i>
                        </a>
                        <a class="btn btn-actionChamp float-right m-r-5 kl_deleteChamp" date-customid="<?= $champ->id ?>" href="#">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </div>
                </div>
                <input type="hidden" id="id_IdChampIdAdded" name="champs[<?= $champ->id ?>][id]" value="<?= $champ->id ?>"/>
                <input type="hidden" id="id_typeChampIdAdded" name="champs[<?= $champ->id ?>][type_champ_id]" value="<?= $champ->type_champ_id ?>"/>
                <input type="hidden" id="id_nomChampAdded" name="champs[<?= $champ->id ?>][nom]" value="<?= $champ->nom ?>" />
                <input type="hidden" id="id_typeDonneIdAdded" name="champs[<?= $champ->id ?>][type_donnee_id]" value="<?= $champ->type_donnee_id ?>" />
                <input type="hidden" id="id_ordreAdded" name="champs[<?= $champ->id ?>][ordre]" value="<?= $champ->ordre ?>" />
                <input type="hidden" id="id_is_requiredAdded" name="champs[<?= $champ->id ?>][is_required]"  value="<?= intval($champ->is_required) ?>" />
                <input type="hidden" id="id_type_optinAdded" name="champs[<?= $champ->id ?>][type_optin_id]"  value="<?= $champ->type_optin_id ?>" />
                <?php if(!empty($champ->custom_optin) && $champ->type_optin_id == 6 ){ ?>
                <input type="hidden" id="id_type_optin" name="champs[<?= $champ->id ?>][custom_optin][titre]"  value="<?= $champ->custom_optin->titre ?>" />
                <?php } ?>
                <?= $optionsInput ?>
            </div>
            <?php }} ?>
        </div>
    
    </div>
</div>

<?php 
    // Paul 
    // Refonte
    if(false){ 
?>
<div class="sf-step sf-step2 sf-choix-prise-coordonnees">
    <div class="col-sm-12 m-b-15">
        <h5>Prise de coordonnées :</h5>
    </div>
    
    <div class="col-sm-12">
        <p class="control-label m-b-20">Proposez la collecte de coordonnées permettant d’envoyer la photo en numérique et de collecter de la data supplémentaire.</p>
    </div>
    <div class="col-sm-12 form-inline">
        <label class="custom-control custom-radio m-r-100" for="is_prise_coordonnee-1">
            <input type="radio" name="is_prise_coordonnee" id="is_prise_coordonnee-1" value="1" class="custom-control-input" checked="checked">
            <span class="custom-control-label m-l-5">Oui</span>
        </label>
        <label class="custom-control custom-radio" for="is_prise_coordonnee-0">
            <input type="radio" name="is_prise_coordonnee" id="is_prise_coordonnee-0" value="0" class="custom-control-input">
            <span class="custom-control-label m-l-5">Non</span>
        </label>

        <?php
                    // echo $this->Form->radio(
                    // 'is_prise_coordonnee',
                    // [
                        // ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                        // ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                    // ],
                    // ['default' => 1,'label' =>'Prise de coordonnées ', 'id'=> 'id_is_prise_coordonnee']
                    // );
            ?>
    </div><br>
    
    <div class="col-sm-12 kl_champs">
        <div class="form-group m-t-20">
            <label class="control-label">Titre du formulaire</label>
            <?php 
                $value = 'Veuillez saisir vos coordonnées pour recevoir votre photo';
                $maxlength = 200;
            ?>
            <?php // echo $this->Form->control('titre_formulaire', ['maxlength' => $maxlength, 'placeholder' =>$value, "value"=>$value, 'label'=> false ]); ?>
            <input type="text" name="titre_formulaire" class="form-control sf-control-caractere" maxlength="<?php echo $maxlength; ?>" value="<?php echo $value; ?>" placeholder="Veuillez saisir vos coordonnées pour recevoir votre photo" />
            <span class="help-block"><small><span id="sf-control-caractere-restant"><?php echo $maxlength - strlen($value) ?></span> caractères restants</small></span>
        </div>
    </div>
    
    <div class="col-sm-12 m-t-20 kl_champs">
        <label class="control-label">Champs</label>
    </div>
    <div class="col-sm-12 kl_champs">
        <div class="sf-bg-gris p-20">
            <div class="form-group form-inline no-margin">
                <label class="col-4 col-form-label">Configurations pré-configurées :</label>
                <div class="col-4">
                    <select class="custom-select">
                        <option value="">E-mail / Accèpte de recevoir</option>
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-primary pull-right" id="sf-champ-add">Ajouter un champ</button>
                    <input type="hidden" value="1" id="sf-champ-size">
                </div>
            </div>
        </div>
        
        <?php // Champs dynamiques ?>
        <div class="col-sm-12" id="sf-bloc-champ">
            <div class="card sf-champ-card m-t-20">
                <div class="d-flex flex-row sf-dashed sf-champ-dynamique">
                    <div class="p-10 sf-bg-default">
                        <h3 class="box m-b-0"><strong>1</strong></h3>
                    </div>
                    <div class="align-self-center p-20">
                        <h5 class="m-b-0">Email</h5>
                        <p class="m-b-0">
                            <span>Type de champ : </span>Texte - 
                            <span>Type de données : </span>Email - 
                            <span>Obligatoire : </span>Non
                        </p>
                        <h5 class="m-t-15">Aperçu :</h5>
                        <div>
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="sf-form-action p-t-5">
                        <button class="btn btn-default sf-champ-delete"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-default sf-champ-edit"><i class="fa fa-pencil"></i></button>
                    </div>
                </div>
            </div>
            
            
            
            <?php // Champ vierge ?>
            <div class="card m-t-20 sf-champ-card hide" id="sf-champ-vierge">
                <div class="d-flex flex-row sf-dashed sf-champ-dynamique">
                    <div class="p-10 sf-bg-default">
                        <h3 class="box m-b-0"><strong class="sf-num-ligne">1</strong></h3>
                    </div>
                    <div class="align-self-center p-20">
                        <h5 class="m-b-0 sf-titre-champ">Titre champ</h5>
                        <p class="m-b-0">
                            Type de champ : <span>Texte</span> - 
                            Type de données : <span>Email</span> - 
                            Obligatoire : <span>Non</span>
                        </p>
                        <h5 class="m-t-15">Aperçu :</h5>
                        <div>
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="sf-form-action p-t-5">
                        <button class="btn btn-default sf-champ-delete"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-default sf-champ-edit"><i class="fa fa-pencil"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>