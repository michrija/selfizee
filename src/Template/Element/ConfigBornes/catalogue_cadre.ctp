<div class="sf-step sf-step2 sf-choix1-mep_cadre_catalogue config_catalogue hide catalogue_cadre">
    <input type="hidden" id="client_id_cat" value="<?= $evenement->client_id ?>" class="form-control">
    <!--<div class="col-sm-12 m-b-15">
        <h5>Choix du visuel parmis le catalogue :</h5>
    </div> -->    
    <?php
        $titre = "Aucun modèle de cadre";
        $hr = "";
        if(!empty($catalogueCadres->toArray()))  {
            $titre = "Choix du visuel parmis le catalogue :"; 
            $hr = "<hr/>";
        }						 
    ?>
    <div class="col-sm-12">
        <p class="control-label m-b-20"><?= $titre ?>  <a href="/catalogueCadres/liste/<?= $evenement->client_id ?>" target="_blank" class="pull-right  sf-rose"  id="btn_suppr_cadre_0">Créer un modèle</a></p>
        <?= $hr ?>
    </div>
    
    <?php if(!empty($catalogueCadres->toArray())) {?> 
    <div class="row p-15 justify-content-end">
        <!--<select class="custom-select form-control col-md-3 m-r-15">
            <option class="Mariage">Mariage</option>
        </select> -->        
        <?php 
            echo $this->Form->control('', [
                                'class'=> 'custom-select form-control col-md-3 m-r-15',
                                'options'=> $themeCatalogues,
                                'empty'=> 'Sélectionner',
                                'label' => false,
                                'id' => 'id_theme_cat_cadre',
                                'templates' => ['selectContainer' => '{{content}}']
           ]);
        ?>
        <div class="sf-input-group col-md-3">
            <span class="sf-input-group-icon"><i class="fa fa-search"></i></span>
            <input class="form-control" placeholder="Rechercher thème, mot clé..." type="text" id="id_txt_search_cat_cadre">
        </div>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-12 sf-bg-gris p-t-20 p-b-20">
            <div class="row">
                <?php // Prise de photos ?>
                <div class="col-sm-6 form-inline">
                    <label class="control-label no-padding-left m-r-20">Prise photos :</label>
                    
                    <label class="custom-control custom-checkbox m-r-20" for="prise_photo_1">
                        <input type="checkbox" name="" value="1" class="custom-control-input prise_photo_cat_cadre" id="prise_photo_1" >
                        <span class="custom-control-label">1 pose photo</span>
                    </label>
                    <label class="custom-control custom-checkbox m-r-20" for="prise_photo_2">
                        <input type="checkbox" name="" value="2" class="custom-control-input prise_photo_cat_cadre" id="prise_photo_2">
                        <span class="custom-control-label">2 poses photos</span>
                    </label>
                    <label class="custom-control custom-checkbox m-r-20" for="prise_photo_3">
                        <input type="checkbox" name="" value="3" class="custom-control-input prise_photo_cat_cadre" id="prise_photo_3">
                        <span class="custom-control-label">3 poses photos</span>
                    </label>
                    <label class="custom-control custom-checkbox" for="prise_photo_4">
                        <input type="checkbox" name="" value="4" class="custom-control-input prise_photo_cat_cadre" id="prise_photo_4">
                        <span class="custom-control-label">4 poses photos</span>
                    </label>
                </div>                
                
                <?php // Formats disponibles ?>
                <div class="col-sm-6 form-inline">
                    <label class="control-label m-r-20">Formats disponibles :</label>
                    <?php foreach($formatCatalogues as $id => $format) { 
                        $poses_1 = ['Paysage', 'Portrait', 'Palaroid']; $poses_2 = ['Multishoot']; $poses_3 = ['Multishoot', 'Marque page'];$poses_4 = ['Multishoot'];?>
                        <label class="custom-control custom-checkbox m-r-16 format_cat_cadre <?= in_array($format, $poses_1) ? 'pose_1':'' ?> <?= in_array($format, $poses_2) ? 'pose_2':'' ?> <?= in_array($format, $poses_3) ? 'pose_3':'' ?> <?= in_array($format, $poses_4) ? 'pose_4':'' ?>" for="format_dispo_<?= $id ?>">
                            <input type="checkbox" name="" value="<?= $id ?>" class="custom-control-input format_cat_cadre" id="format_dispo_<?= $id ?>">
                            <span class="custom-control-label"><?= $format ?></span>
                        </label>
                    <?php } ?>
                    <!--<label class="custom-control custom-checkbox m-r-20" for="format_dispo_2">
                        <input type="checkbox" name="" value="2" class="custom-control-input" id="format_dispo_2" checked="checked">
                        <span class="custom-control-label">Portrait</span>
                    </label>
                    <label class="custom-control custom-checkbox m-r-20" for="format_dispo_3">
                        <input type="checkbox" name="" value="3" class="custom-control-input" id="format_dispo_3" checked="checked">
                        <span class="custom-control-label">Paysage</span>
                    </label>-->
                </div>
            </div>
        </div>
    </div>    
    <div class="col-sm-12 m-t-30 text-right"><h6 class="card-subtitle"><span id="count_cat_cadre"><?= $catalogueCadres->count(); //23 ?>  <?php echo ($catalogueCadres->count() > 1 ? 'modèles' : 'modèle') ;?> </span> </h6></div>
    <?php } ?>

    <div class="col-sm-12 bloc_loader_cat_cadre hide" id="" style="/* border: 1px solid; */height: 67px;/* width: 100%; */position: absolute;top: 350px;text-align: center !important;z-index: 10;">   
		<img src="/img/gallery/spinner.gif" width="10%">
    </div>
     
    <input type="checkbox" name="is_active_catalogue_cadre" class="is_active_catalogueCadre hide" checked="checked" <?= ($configurationBorne->is_active_catalogue_cadre) ? 'value="1"' :  'value="0"'  ;?> >
    <div class="row p-15" id="id_content_cat_cadre">
        <?php use Cake\Routing\Router; ?>
        <?php if(!empty($catalogueCadres->toArray())) {?>
            <?php foreach($catalogueCadres as $ord => $cadre) {?> 
                <?php $url_cadre = Router::url('/', true).'import/config_bornes/cadre_catalogue/'.$cadre->client_id.'/'.$cadre->file_name;?>                                                            
                                                                        
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="sf-box-catalogue">
                        <div class="card p-t-40">
                            <figure>
                                <img class="img-responsive" src="<?= $url_cadre ?>" alt="catalogue-1">
                            </figure>
                            <div class="card-body">
                                <div class="col-md-12 no-padding">
                                    <label class="m-b-25"><?= $cadre->titre ?></label>
                                    <?php echo $this->Html->link('<i class="fa fa-eye pull-right m-b-25 sf-cursor"></i>',['controller' => 'ConfigurationBornes','action' => 'viewCatalogueCadre', $cadre->id],['escape'=>false,"class"=>"kl_viewCatCadre  text-muted" ]);  ?>
                                </div>
                                <?php
                                    $is_active_this_cadre_cat = false;
                                    if($configurationBorne->is_active_catalogue_cadre && $configurationBorne->catalogue_cadre_id == $cadre->id) {
                                        $is_active_this_cadre_cat = true;
                                    }
                                ?>
                                <button type="button" class="btn btn-success btn_active_catalogue_cadre <?php echo $is_active_this_cadre_cat ? 'active' : '' ?>" id="btn_active_catCadre_<?= $cadre->id ?>">
                                    <i class="fa <?php echo $is_active_this_cadre_cat ? 'fa-times' : 'fa-check' ?>"></i> <?php echo $is_active_this_cadre_cat ? 'Désactiver ce cadre' : ' Choisir ce cadre' ?>
								</button>
								<input type="radio" name="catalogue_cadre_id" id="catalogueCadre_<?= $cadre->id ?>" value="<?= $cadre->id ?>" class="custom-control-input check_active_catCadre hide" <?php echo $is_active_this_cadre_cat ? 'checked="checked"' : '' ?> />                                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <!--<div class="col-md-6 col-lg-4 col-xl-3">
            <div class="sf-box-catalogue">
                <div class="card p-t-40">
                    <figure>
                        <img class="img-responsive" src="/img/confbornes/catalogues/catalogue-2.png" alt="catalogue-2">
                    </figure>
                    <div class="card-body">
                        <div class="col-md-12 no-padding">
                            <label class="m-b-25">Végétal - C2</label>
                            <i class="fa fa-eye pull-right m-b-25 sf-cursor"></i>
                        </div>
                        <button class="btn btn-success">Choisir ce cadre</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="sf-box-catalogue">
                <div class="card p-t-40">
                    <figure>
                        <img class="card-img-top img-responsive" src="/img/confbornes/catalogues/catalogue-3.png" alt="catalogue-3">
                    </figure>
                    <div class="card-body">
                        <div class="col-md-12 no-padding">
                            <label class="m-b-25">Végétal - C3</label>
                            <i class="fa fa-eye pull-right m-b-25 sf-cursor"></i>
                        </div>
                        <button class="btn btn-success">Choisir ce cadre</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="sf-box-catalogue">
                <div class="card p-t-40">
                    <figure>
                        <img class="img-responsive" src="/img/confbornes/catalogues/catalogue-4.png" alt="catalogue-4">
                    </figure>
                    <div class="card-body">
                        <div class="col-md-12 no-padding">
                            <label class="m-b-25">Végétal - C4</label>
                            <i class="fa fa-eye pull-right m-b-25 sf-cursor"></i>
                        </div>
                        <button class="btn btn-success">Choisir ce cadre</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>