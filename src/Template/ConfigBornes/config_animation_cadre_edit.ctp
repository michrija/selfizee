
<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', ['block' => true]); ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->css('ConfigBornes/config_anim.css', ['block' => true]) ?>
<?= $this->Html->script('ConfigBornes/config_anim.js', ['block' => true]); ?>

<div class="row card cf_anim">    
    <div class="col-md-12 cf_cadre_edit">
        <div class="card-body">
            <ul class="list-inline pull-right">
                <li> <a href="#" class="">Supprimer ce cadre</a> </li>
                <li> <a href="#" class="">Ajouter un autre cadre</a></li>
            </ul>
            <h4 class="card-title ">Type cadre</h4>
            <div class="cf_anim_bloc_cadre_edit"> 
                <div class="row ">
                    <div class="col-md-3">
                        <div class="cf_blocCadre">                    
                        </div>
                    </div>
                    <div class="col-md-4 cf_col2">                                                                
                        <h6 class="">Cadre paysage - 1 pose</h6>
                        <p class="">Vegetal - C1</p>
                        <a href="#" class="btn btn-danger">Modifier la mise en page</a>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="col-md-12 cf_prise">
        <div class="card-body">
            <h4 class="card-title bold">Prise de photo</h4>
            <div class="">           
                <h6 class="">Décompte prise de photo (secondes)</h6>
                <div class="col-md-4 row">
                    <input type="number" name="decompte_prise_photo" id="decompte-prise-photo" class="form-control">
                </div><br>
                
                <h6 class="">Autoriser la reprise de photo</h6>
                <div class="col-md-4 row">
                    <input type="hidden" name="is_reprise_photo" value="" class="form-control"><label class="custom-control custom-checkbox" for="is-reprise-photo-1"><input type="radio" name="is_reprise_photo" value="1" class="custom-control-input" id="is-reprise-photo-1"><span class="custom-control-label">Oui</span></label><label class="custom-control custom-checkbox" for="is-reprise-photo-0"><input type="radio" name="is_reprise_photo" value="0" class="custom-control-input" id="is-reprise-photo-0" checked="checked"><span class="custom-control-label">Non</span></label>                     
                </div>
            </div>
            <hr>            
        </div>
    </div>

    
    <div class="col-md-12 cf_filtre">
        <div class="card-body">
            <h4 class="card-title ">Filtres de couleurs</h4>
            <h6 class="">Offrez à vos utilisateurs la possibilité de choisir un filtre de couleur. Vous pouvez choisir plusieurs. Si un seul est choisit, l'effect s'appliquera automatiquement.</h6>
            <div class="cf_filtre_couleur ">
                <div class="row ">
                    <div class="col-md-2">
                        <input type="checkbox" ><label> Couleur </label>
                    </div>
                    <div class="col-md-4">
                        <label class="">Affiche la photo en couleur</label>
                    </div>
                    <div class="col-md-4">
                        <img src="/img/gallery/gallery_calque.jpg" alt="" width="40%">
                    </div>
                </div>
            </div>
            <div class="cf_filtre_noir_et_blanc">
            <div class="row ">
                    <div class="col-md-2 cf_content_filtre">
                        <input type="checkbox" ><label> Noir & blanc </label>
                    </div>
                    <div class="col-md-4  cf_content_filtre">
                        <label class="">Applique un filtre Noir & blanc sur la photo</label>
                    </div>
                    <div class="col-md-4 cf_content_filtre">
                        <img src="/img/gallery/gallery_calque.jpg" alt="" width="40%">
                    </div>
                </div>
            </div>
            <div class="cf_filtre_sepia">
            <div class="row ">
                    <div class="col-md-2 cf_content_filtre">
                        <input type="checkbox" ><label> Sepia </label>
                    </div>
                    <div class="col-md-4  cf_content_filtre">
                        <label class="">Applique un filtre Sepia sur la photo</label>
                    </div>
                    <div class="col-md-4 cf_content_filtre">
                        <img src="/img/gallery/gallery_calque.jpg" alt="" width="40%">
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    
    <div class="col-md-12 cf_fond_vert">
        <div class="card-body">
            <h4 class="">Incrustation fond verts</h4>
            <h6 class="">L'animation phot fond vert consiste à prendre en photo une personne ou un groupe de personnes sur un fond vert ou bleu uni qui est automatiquement remplacé par un ou plusieurs fonds photos en accord avec la thématique 
            de l'évèvenement. <strong>Attention vous devez bien posseder un fond vert pour utiliser cette fonctionnalité !</strong></h6><br>
            <div class="col-md-4 row">
                    <input type="hidden" name="is_reprise_photo" value="" class="form-control"><label class="custom-control custom-checkbox" for="is-reprise-photo-1"><input type="radio" name="is_reprise_photo" value="1" class="custom-control-input" id="is-reprise-photo-1"><span class="custom-control-label">Oui</span></label><label class="custom-control custom-checkbox" for="is-reprise-photo-0"><input type="radio" name="is_reprise_photo" value="0" class="custom-control-input" id="is-reprise-photo-0" checked="checked"><span class="custom-control-label">Non</span></label>                     
            </div><br>

            <h6 class=""><strong>Images de fond : </strong></h6>
            <h6 class="">Vous pouvez ajouter autant d'images que souhaité .<br>
            Rappel : Format Image : jpg - Dimensions : 1900X1020px - 72dpl - Couleurs : RVB</h6>
            <div class="dropzone kl_blocDropzone cf_anim_bloc_cadre" id="dropzone_fond_vert"></div>
        </div>
    </div>

     <!--<div class="col-sm-12">
        <div class="dropzone kl_blocDropzone cf_anim_bloc_cadre" id="dropzone_fond_vert"></div>
    </div>-->


</div>