<?php use Cake\Routing\Router; ?>
<div class="row">
    <div class="col-md-12">
        <div class="kl_titreAnimationSelected">Animation : <span class="kl_typeAnimationSelectedValue"><?= !empty($configurationBorne->type_animation->nom) ? $configurationBorne->type_animation->nom : "" ?></span></div>
    </div>
    
    <div class="col-md-12 kl_cadre">
        <div class="row col-12 m-t-15 hide" id="id_type_cadre">
            <label class="col-md-12 p-l-0">1 - Type de cadre :</label>
            <div class="col-md-12">
                    <div class="row" id="id_customChexCadre">
                        <?php
                        echo $this->Form->control('configuration_animations.0.type_cadre',[
                            'type'=>'radio',
                            'templates'=>[
                                'inputContainer' => '{{content}}',
                                'nestingLabel' => '{{hidden}}<label class="custom-control custom-radio col-sm-5" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
                            ],
                            'options'=>[
                                ['value' => 0, 'text' => 'Paysage','class'=>'kl_paysageCadre custom-control-input'],
                                ['value' => 1, 'text' => 'Portait','class'=>'kl_portraitCadre custom-control-input'],
                            ],
                            'label'=>false,
                            'default' => 0
                          ]);
                        ?>
                    </div>
            </div>
         </div>
         
        <div class="kl_cadreMultiple <?= $configurationBorne->type_animation_id == 1 ? "":"hide" ?> row col-12">
            <label class="col-md-12 p-l-0">2 - Cadres :</label>
            <div class="col-md-12">
                <div class="kl_labelDesc">Vous pouvez ajouter autant de cadres que souhaités. Gérez l’ordre d’affichage en glissant / déposant.</div>
                <div class="id_cadreDropzoneAndPreview">
                    <div id="id_uploadCadreMuliple" class="dropzone sortable">
                        <?php 
                        if($configurationBorne->type_animation_id == 1){
                        foreach($configurationBorne->cadres as $key => $cadre){ 
                            if(!empty($cadre->file_name)){
                            ?>
                            <div class="dz-preview dz-processing dz-image-preview dz-complete" id="id_oneCadre_<?= $cadre->id ?>">
                               <div class="dz-image"><img data-dz-thumbnail="" alt="" src="<?= Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$cadre->file_name ?>"></div>
                               <a class="dz-remove kl_deleteEdit" href="javascript:undefined;" data-dz-remove="" data-cadreid="<?= $cadre->id ?>">Remove file</a>
                               <input type="hidden" class="" value="<?= $cadre->id ?>" name="cadres[<?= $key ?>][id]" />
                               <input type="hidden" class="" value="<?= $cadre->ordre ?>" name="cadres[<?= $key ?>][ordre]" />
                               <input type="hidden" class="" value="<?= $cadre->file_name ?>" name="cadres[<?= $key ?>][file_name]" />
                            </div>
                        <?php }}} ?>
                    </div>
                    
                </div>
                <div class="kl_info">Rappel : Format image : .png (avec fond transparent) - Dimensions : 1844 x 1200px - 72dpi - Couleurs : RVB</div>
                
            </div>
        </div>
        <hr />
         <div class="col-md-12 kl_siMultiConfiguration <?= $configurationBorne->type_animation_id == 6 ? "":"hide"  ?> ">
            <?= $this->Form->control('configuration_animations.0.multiconfiguration_id',['label' => 'Multiple configuration', 'options'=>$multiconfigurations, 'empty'=>'Séléctionner','id'=>'id_mutliconfiguration']); ?>
        </div>
        <div class="col-md-12 kl_multiposeOuBandellete <?= ($configurationBorne->type_animation_id == 2  || $configurationBorne->type_animation_id == 3 || $configurationBorne->type_animation_id == 6) ? "":"hide"  ?> ">
             <?php 
                $muliposeBOptions = array(1=>"1", 2=>"2", 3 => "3", 4 => "4");
                if($configurationBorne->type_animation_id ==3 ){
                    $muliposeBOptions = array(3=>"3", 4 => "4");
                }
                echo $this->Form->control('configuration_animations.0.nbr_pose',['label' => 'Nombre de poses', 'options'=>$muliposeBOptions,'id'=>'id_nombreDePose']); 
             ?>
            <div class="row <?= !empty($configurationBorne->disposition_vignette_id) ? "":"hide" ?>" id="id_dispositionVignette">
                <div class="col-md-12">Disposition des vignettes </div>
                <?php 
                $optionDispositions = array();
                //debug($dispositionVignettes);
                //debug($configurationBorne->nb_pose_mulipose);
                foreach($dispositionVignettes as $disposition){ ?>
                    <div class="col-md-2 kl_oneDispostion kl_dispositionVignette_<?= $disposition->nbr_pose ?>_pourAnimation_<?= $disposition->type_animation_id ?>  kl_dispositionVignette_<?= $disposition->nbr_pose ?> <?= ($disposition->nbr_pose == $configurationBorne->nbr_pose) ? "":"hide" ?> <?= ($disposition->id == $configurationBorne->disposition_vignette_id) ? "selected":"" ?>" data-key="<?= $disposition->id ?>" id="id_siposition_<?= $disposition->id ?>">
                        <?= $this->Html->image('disposition_vignettes/'.$disposition->file_name, ['alt' => $disposition->id,'class' => 'kl_imageDisposition']); ?>
                    </div>
                <?php $optionDispositions[$disposition->id] = $disposition->id; } ?>
                
                 <div class="col-md-12 hide">
                     <?= $this->Form->control('configuration_animations.0.disposition_vignette_id',['label' => 'Dispositon vignette', 'options'=>$optionDispositions, 'empty'=>'Séléctionner', 'class'=>'no-style', 'id'=>'id_dispositionvignette']); ?>
                </div>
             </div>
           
        </div>
        <div class="kl_cadreSimple row col-12 <?= $configurationBorne->type_animation_id == 1 ? "hide":"" ?>">
            <label class="col-md-12 p-l-0">2 - Cadre :</label>
            <div class="col-md-12">
                <?php 
                    $urlCadreSimple = null;
                    if(!empty($configurationBorne->cadres)){
                        if(count($configurationBorne->cadres) == 1){
                            $fileName = $configurationBorne->cadres[0]->file_name;
                            $urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
                    }
                 ?>   
                <input type="hidden" class="" value="<?= $configurationBorne->cadres[0]->id ?>" name="cadres[<?= $configurationBorne->cadres[0]->id ?>][id]" />
                <input type="hidden" class="" value="<?= $configurationBorne->cadres[0]->ordre ?>" name="cadres[<?= $configurationBorne->cadres[0]->id ?>][ordre]" />
                <input type="hidden" class="" value="<?= $configurationBorne->cadres[0]->file_name ?>" name="cadres[<?= $configurationBorne->cadres[0]->id ?>][file_name]" />
                <?php } ?>
                <input type="file" name="img_cadre_simple" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
            </div>
        </div>
    </div>
    <hr />
    <div class="row col-md-12 mt-5">
        <label class="col-md-12 ">3 - Prise de photos :</label>
        <div class="col-md-6">
            <?= $this->Form->control('decompte_prise_photo',['label' => 'Décompte prise de photo (secondes)','class'=>'kl_deComptePriseDePhoto form-control']); ?>
         </div>
         <div class="clearfix"></div>
        
         
         <div class="row col-12 m-t-15">
            <label class="col-md-6">Autoriser la reprise de photos</label>
            <div class="col-md-6">
                    <div class="row">
                        <?php
                              echo $this->Form->radio(
                                'is_reprise_photo',
                                [
                                    ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                    ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                ],
                                ['default' => 0,'label' =>'Autoriser la reprise de photos']
                                );
                        ?>
                    </div>
            </div>
         </div>
     </div>
     
    
    
    <div class="col-md-12 kl_siFondVert <?= $configurationBorne->type_animation_id == 5 ? "":"hide"  ?>">
        <div class="kl_titreFondVert">Uploader les fonds vert - <span class="info">Vous pouvez changer l'ordre en glissant-déposant les élements</span></div>
        <div id="id_uploadFondVert" class="dropzone sortable">
             <?php 
             if(!empty($configurationBorne->fond_verts)){
             foreach($configurationBorne->fond_verts as $vert){ ?>
                            <div class="dz-preview dz-processing dz-image-preview dz-complete" id="id_oneCadre_<?= $vert->id ?>">
                               <div class="dz-image"><img data-dz-thumbnail="" alt="" src="<?= Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$vert->file_name ?>"></div>
                               <a class="dz-remove kl_deleteEdit" href="javascript:undefined;" data-dz-remove="" data-cadreid="<?= $vert->id ?>">Remove file</a>
                               <input type="hidden" class="" value="<?= $vert->id ?>" name="fond_verts[<?= $vert->ordre ?>][id]" />
                               <input type="hidden" class="" value="<?= $vert->ordre ?>" name="fond_verts[<?= $vert->ordre ?>][ordre]" />
                               <input type="hidden" class="" value="<?= $vert->file_name ?>" name="fond_verts[<?= $vert->ordre ?>][file_name]" />
                            </div>
            <?php }} ?>
        </div>
    </div>
</div>