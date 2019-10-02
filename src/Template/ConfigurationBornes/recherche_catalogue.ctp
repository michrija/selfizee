<?php use Cake\Routing\Router; ?>
<?php if(!empty($catalogues->toArray())) {?>
    <?php foreach($catalogues as $ord => $catalogue) {?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="sf-box-catalogue sf-box-mep">
                <div class="card p-t-15">
                    <div class="col-sm-12 p-l-20 p-r-20">
                        <h4 class="card-title">
                            <?= $catalogue->nom //Flamingo ?> 
                            <?php echo $this->Html->link('<i class="fa fa-eye"></i> ',['controller'=>'ConfigurationBornes','action'=>'getTheme', $catalogue->id, '_full' => true],['escape'=>false,"class"=>"kl_viewTheme text-muted pull-right" ]);  ?>
                        </h4>
                        <h6 class="card-subtitle m-b-15"><?= $catalogue->description //Thème local pour mariage ?></h6>
                    </div>
                    <div class="col-sm-12 p-l-20 p-r-20">
                        <div id="carouselExampleIndicators0" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators0" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators0" data-slide-to="1" class=""></li>
                                <li data-target="#carouselExampleIndicators0" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php foreach($catalogue->image_fonds as $ord => $fond) {                                                                
                                        if($ord < 3) {
                                            $url_img = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$catalogue->client_id.'/'.$fond->file_name;?>                                                            
                                            <div class="carousel-item <?php echo ($ord == 0 ? 'active': '') ?>">
                                                <img class="img-responsive" src="<?= $url_img ?>" alt="First slide">
                                            </div>
                                        <?php } ?>
                                            <!--<div class="carousel-item">
                                                <img class="img-responsive" src="/img/gallery/landscape2.jpg" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-responsive" src="/img/gallery/landscape3.jpg" alt="Third slide">
                                            </div>-->
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators0" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators0" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-20">
                    
                        <button type="button" class="btn btn-success btn_active_theme <?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ? 'active' : '' ;?>" id="btn_active_theme_<?= $catalogue->id ?>">
                            <i class="fa <?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ? 'fa-times' : 'fa-check' ;?>"></i> 
                            <?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ? 'Desactiver ce thème' : 'Activer ce thème' ;?> 
                        </button>
                        <input type="radio" name="ecrans_navigation[catalogue_id]" id="catalogue_<?= $catalogue->id ?>" value="<?= $catalogue->id ?>" class="custom-control-input check_active_theme hide"  <?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ?  'checked="checked"' : '' ;?> >
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
<input type="hidden" value="<?= count($catalogues->toArray()); ?>" id="count_cat" />