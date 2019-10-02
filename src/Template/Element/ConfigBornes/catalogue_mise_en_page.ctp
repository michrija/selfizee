<div class="sf-step sf-step2 sf-mise-en-page catalogue_ecran">
						
					<input type="hidden" id="client_id_cat" value="<?= $evenement->client_id ?>" class="form-control">
						<!--<div class="col-sm-12 m-b-40">
							<h5>Mise en page</h5>
						</div>-->
						<?php
						 $titre = "Aucun modèle de mise en page";
						 $hr = "";
						 if(!empty($catalogues->toArray()))  {
							 $titre = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; // "Catalogue de mise en page"
							 $hr = "<hr/>";
						 }
						 
						?>
						<div class="col-sm-12  no-padding-left no-padding-right">
							<p class="control-label m-b-20"><?= $titre ?>  
							<a href="/catalogues/liste/<?= $evenement->client_id ?>" target="_blank"  class="pull-right sf-rose" id="btn_suppr_cadre_0">Créer un modèle</a>
						</p>
							<?= $hr ?>
						</div>
						<?php if(!empty($catalogues->toArray())) {?> 
							<div class="col-sm-12  no-padding-left no-padding-right">
								<div class="sf-bg-gris form-inline p-t-10 p-b-10">
									<div class="sf-input-group col-sm-3">
										<span class="sf-input-group-icon"><i class="fa fa-search"></i></span>
										<input class="form-control" placeholder="Rechercher" type="text" id="id_search_txt_cat">
									</div>
									<div class="col-sm-7 form-inline">
										<label class="control-label m-r-40">Thème(s) :</label>
										<?php if(!empty($themeCatalogues)) { ?>
										<?php foreach($themeCatalogues as $id => $theme){ ?>
											<label class="custom-control custom-checkbox m-r-20" for="theme_<?= strtolower($theme) ?>">
												<input type="checkbox" name="theme" value="<?= $id ?>" class="custom-control-input cat_theme" id="theme_<?= strtolower($theme) ?>">
												<span class="custom-control-label"><?= ucfirst($theme) ?></span>
											</label>
										<!--<label class="custom-control custom-checkbox m-r-20" for="theme_mariage">
											<input type="checkbox" name="theme" value="1" class="custom-control-input cat_theme" id="theme_mariage">
											<span class="custom-control-label">Mariage</span>
										</label>
										<label class="custom-control custom-checkbox m-r-20" for="theme_anniversaire">
											<input type="checkbox" name="" value="2" class="custom-control-input cat_theme" id="theme_anniversaire">
											<span class="custom-control-label">Anniversaire</span>
										</label>
										<label class="custom-control custom-checkbox m-r-20" for="theme_pro">
											<input type="checkbox" name="" value="3" class="custom-control-input cat_theme" id="theme_pro">
											<span class="custom-control-label">Proféssionnel</span>
										</label> -->										
										<?php } } ?>
									</div>
									<div class="col-sm-2">
										<h6 class="card-subtitle pull-right no-margin-bottom no-margin-top"><span id="count_theme"><?= $catalogues->count(); ?> <?php echo ($catalogues->count() > 1 ? 'modèles' : 'modèle') ;?></span> </h6>
									</div>
								</div>
							</div>
						<?php }  ?>
						<!--<progress></progress><button type="button" class="btn btn-success" id="id_post_form" >Submit Test</button>-->
						<div class="col-sm-12 bloc_loader hide" id="" style="/* border: 1px solid; */height: 67px;/* width: 100%; */position: absolute;top: 184px;text-align: center !important;z-index: 10;">   
							<img src="/img/gallery/spinner.gif" width="10%">
 						</div>
                        <input type="checkbox" name="ecrans_navigation[is_active_catalogue_mep]" class="is_active_theme hide" checked="checked" <?= (!empty($configurationBorne->ecrans_navigation) && $configurationBorne->ecrans_navigation->is_active_catalogue_mep) ? 'value="1"' :  'value="0"'  ;?> >
                        <div class="col-sm-12 no-padding-left no-padding-right p-t-25 p-b-25 form-inline" id="id_content_cat_mep">                          
                            <?php use Cake\Routing\Router; ?>
                            <?php if(!empty($catalogues->toArray())) {?>
							<?php foreach($catalogues as $ord => $catalogue) {?> 
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="sf-box-catalogue sf-box-mep">
                                            <div class="card p-t-15">
                                                <div class="col-sm-12 p-l-20 p-r-20">
                                                    <h4 class="card-title">
                                                        <?= $catalogue->nom //Flamingo ?> 
                                                        <?php echo $this->Html->link('<i class="fa fa-eye"></i> ',['controller'=>'ConfigurationBornes','action'=>'getTheme', $catalogue->id, '_full' => true],['escape'=>false,"class"=>"kl_viewTheme text-muted pull-right", "id"=>"link_view_theme_".$catalogue->id]);  ?>
                                                    </h4>
                                                    <h6 class="card-subtitle m-b-15"><?= $catalogue->description //Thème local pour mariage ?></h6>
                                                </div>
                                                <div class="col-sm-12 p-l-20 p-r-20">
                                                    <div id="carouselExampleIndicators0" class="carousel slide" data-ride="carousel" data-interval="false">
                                                        <!--<ol class="carousel-indicators">
                                                            <li data-target="#carouselExampleIndicators0" data-slide-to="0" class="active"></li>
                                                            <li data-target="#carouselExampleIndicators0" data-slide-to="1" class=""></li>
                                                            <li data-target="#carouselExampleIndicators0" data-slide-to="2" class=""></li>
                                                        </ol>-->
                                                        <div class="carousel-inner" role="listbox">
                                                            <?php foreach($catalogue->image_fonds as $ord => $fond) {                                                                
                                                                    if($ord < 3) {
                                                                        $url_img = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$catalogue->client_id.'/'.$fond->file_name;?>                                                            
                                                                        <div class="carousel-item <?php echo ($ord == 0 ? 'active': '') ?>">
																			<img class="img-responsive" src="<?= $url_img ?>" alt="First slide">
																			<!--<div class="carousel-caption d-none d-md-block">
																				<p ><?= $fond->type ?></p>
																			</div>-->
                                                                        </div>
                                                                        <!--<div class="carousel-item">
                                                                            <img class="img-responsive" src="/img/gallery/landscape2.jpg" alt="Second slide">
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="img-responsive" src="/img/gallery/landscape3.jpg" alt="Third slide">
                                                                        </div>-->
                                                                    <?php } ?>
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
												
                                                    <button type="button" class="btn btn-success btn_active_theme <?php echo ($configurationBorne->ecrans_navigation  && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ? 'active' : '' ;?>" id="btn_active_theme_<?= $catalogue->id ?>">
														<i class="fa <?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ? 'fa-times' : 'fa-check' ;?>"></i> 
														<?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ? 'Desactiver ce thème' : 'Activer ce thème' ;?> 
													</button>
													<input type="radio" name="ecrans_navigation[catalogue_id]" id="catalogue_<?= $catalogue->id ?>" value="<?= $catalogue->id ?>" class="custom-control-input check_active_theme hide"  <?php echo ($configurationBorne->ecrans_navigation && $configurationBorne->ecrans_navigation->is_active_catalogue_mep && $configurationBorne->ecrans_navigation->catalogue_id == $catalogue->id) ?  'checked="checked"' : '' ;?> >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?> 
                        <?php } ?>
                            <!--
							<div class="col-md-6 col-lg-4 col-xl-3">
								<div class="sf-box-catalogue sf-box-mep">
									<div class="card p-t-15">
										<div class="col-sm-12 p-l-20 p-r-20">
											<h4 class="card-title">
												Flamingo 
												<?php echo $this->Html->link('<i class="fa fa-eye"></i> ',['controller'=>'ConfigurationBornes','action'=>'getTheme', 72, '_full' => true],['escape'=>false,"class"=>"kl_viewTheme text-muted pull-right" ]);  ?>
											</h4>
											<h6 class="card-subtitle m-b-15">Thème local pour mariage</h6>
										</div>
										<div class="col-sm-12 p-l-20 p-r-20">
											<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
												<ol class="carousel-indicators">
													<li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
													<li data-target="#carouselExampleIndicators1" data-slide-to="1" class=""></li>
													<li data-target="#carouselExampleIndicators1" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner" role="listbox">
													<div class="carousel-item active">
														<img class="img-responsive" src="/img/gallery/landscape1.jpg" alt="First slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape2.jpg" alt="Second slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape3.jpg" alt="Third slide">
													</div>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										</div>
										<div class="card-body p-20">
											<button class="btn btn-success">Activer ce thème</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-4 col-xl-3">
								<div class="sf-box-catalogue sf-box-mep">
									<div class="card p-t-15">
										<div class="col-sm-12 p-l-20 p-r-20">
											<h4 class="card-title">
												Flamingo 
												<?php echo $this->Html->link('<i class="fa fa-eye"></i> ',['controller'=>'ConfigurationBornes','action'=>'getTheme', 72, '_full' => true],['escape'=>false,"class"=>"kl_viewTheme text-muted pull-right" ]);  ?>
											</h4>
											<h6 class="card-subtitle m-b-15">Thème local pour mariage</h6>
										</div>
										<div class="col-sm-12 p-l-20 p-r-20">
											<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
												<ol class="carousel-indicators">
													<li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
													<li data-target="#carouselExampleIndicators2" data-slide-to="1" class=""></li>
													<li data-target="#carouselExampleIndicators2" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner" role="listbox">
													<div class="carousel-item active">
														<img class="img-responsive" src="/img/gallery/landscape1.jpg" alt="First slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape2.jpg" alt="Second slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape3.jpg" alt="Third slide">
													</div>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										</div>
										<div class="card-body p-20">
											<button class="btn btn-success">Activer ce thème</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-4 col-xl-3">
								<div class="sf-box-catalogue sf-box-mep">
									<div class="card p-t-15">
										<div class="col-sm-12 p-l-20 p-r-20">
											<h4 class="card-title">
												Flamingo 
												<?php echo $this->Html->link('<i class="fa fa-eye"></i> ',['controller'=>'ConfigurationBornes','action'=>'getTheme', 72, '_full' => true],['escape'=>false,"class"=>"kl_viewTheme text-muted pull-right" ]);  ?>
											</h4>
											<h6 class="card-subtitle m-b-15">Thème local pour mariage</h6>
										</div>
										<div class="col-sm-12 p-l-20 p-r-20">
											<div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
												<ol class="carousel-indicators">
													<li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
													<li data-target="#carouselExampleIndicators3" data-slide-to="1" class=""></li>
													<li data-target="#carouselExampleIndicators3" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner" role="listbox">
													<div class="carousel-item active">
														<img class="img-responsive" src="/img/gallery/landscape1.jpg" alt="First slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape2.jpg" alt="Second slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape3.jpg" alt="Third slide">
													</div>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										</div>
										<div class="card-body p-20">
											<button class="btn btn-success">Activer ce thème</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-4 col-xl-3">
								<div class="sf-box-catalogue sf-box-mep">
									<div class="card p-t-15">
										<div class="col-sm-12 p-l-20 p-r-20">
											<h4 class="card-title">
												Flamingo 
												<?php echo $this->Html->link('<i class="fa fa-eye"></i> ',['controller'=>'ConfigurationBornes','action'=>'getTheme', 72, '_full' => true],['escape'=>false,"class"=>"kl_viewTheme text-muted pull-right" ]);  ?>
											</h4>
											<h6 class="card-subtitle m-b-15">Thème local pour mariage</h6>
										</div>
										<div class="col-sm-12 p-l-20 p-r-20">
											<div id="carouselExampleIndicators4" class="carousel slide" data-ride="carousel">
												<ol class="carousel-indicators">
													<li data-target="#carouselExampleIndicators4" data-slide-to="0" class="active"></li>
													<li data-target="#carouselExampleIndicators4" data-slide-to="1" class=""></li>
													<li data-target="#carouselExampleIndicators4" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner" role="listbox">
													<div class="carousel-item active">
														<img class="img-responsive" src="/img/gallery/landscape1.jpg" alt="First slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape2.jpg" alt="Second slide">
													</div>
													<div class="carousel-item">
														<img class="img-responsive" src="/img/gallery/landscape3.jpg" alt="Third slide">
													</div>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										</div>
										<div class="card-body p-20">
											<button class="btn btn-success">Activer ce thème</button>
										</div>
									</div>
								</div>
                            </div>
                            -->
							
						</div>
					</div>