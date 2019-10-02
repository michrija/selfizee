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
                                <button type="button" class="btn btn-success btn_active_catalogue_cadre" id="btn_active_catCadre_<?= $cadre->id ?>">
                                    <i class="fa fa-check"></i> Choisir ce cadre
								</button>
								<input type="radio" name="" id="catalogueCadre_<?= $cadre->id ?>" value="<?= $cadre->id ?>" class="custom-control-input check_active_catCadre hide" />                                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else {?> 
            <div class="table-responsive">
                <p style="text-align: center;">Aucun resultat</p>
            </div>
        <?php } ?> 
<input type="hidden" value="<?= count($catalogueCadres->toArray()); ?>" id="count_cat_cadre_rech" />