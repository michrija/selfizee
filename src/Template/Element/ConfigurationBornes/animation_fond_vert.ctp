<?php use Cake\Routing\Router; ?>
<div class="col-md-12 pl-0">
    <div class="kl_titreAnimationSelected">Animation : Fond vert</div>
</div>
<div class="row col-12 m-t-15">
    <label class="col-md-12 p-l-0 kl_labelCustom">1 - Type de cadre :</label>
    <div class="col-md-12">
            <div class="row" id="id_customChexCadre">
                <?php
                echo $this->Form->control('configuration_animations.4.type_cadre',[
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
<div class="col-12">
    <hr><br />
</div>

<div class="kl_cadreSimple row col-12 ">
    <label class="col-md-12 p-l-0 kl_labelCustom">2 - Cadres :</label>
    <div class="col-md-12">
        <?php 
            $urlCadreSimple = null;
            if(!empty($configurationBorne->configuration_animations[4]->cadres)){
                    $cadre = $configurationBorne->configuration_animations[4]->cadres[0];
                    $fileName = $configurationBorne->configuration_animations[4]->cadres[0]->file_name;
                    $urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
         ?>
            <input type="hidden" value="<?= $cadre->id ?>" name="configuration_animations[4][cadres][0][id]" />
            <input type="hidden" value="<?= $cadre->ordre ?>" name="configuration_animations[4][cadres][0][ordre]" />
            <input type="hidden" value="<?= $cadre->file_name ?>" name="configuration_animations[4][cadres][0][file_name]" />
        <?php }?>
        <input type="file" name="img_cadre_simpleFondVert" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
    </div>
</div>


 
 <div class="row col-md-12 mt-5 kl_siFondVert ">
        
        <div class="kl_titreFondVert col-md-12">
            <div class="kl_labelDesc"> Uploader les fonds vert - <span class="info">Vous pouvez changer l'ordre en glissant-déposant les élements</span></div>
        </div>
        <div id="id_uploadFondVert" class="dropzone sortable col-md-12">
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