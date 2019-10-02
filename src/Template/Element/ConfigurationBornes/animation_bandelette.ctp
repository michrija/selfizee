<?php use Cake\Routing\Router; ?>
<div class="col-md-12 pl-0">
    <div class="kl_titreAnimationSelected">Animation : Bandelette</div>
</div>

<div class="row col-12 m-t-15 hide">
                <?php
                echo $this->Form->control('configuration_animations.2.type_cadre',[
                    'type'=>'hidden',
                    'default' => 0
                  ]);
                ?>
</div>

<div class="col-md-12 row m-t-15 ">
    <label class="col-md-12 p-l-0 kl_labelCustom">1- Nombre de poses</label>
    <div class="col-md-6">
         <?php 
            $muliposeBOptions = array( 3=>"3", 4 => "4");
            echo $this->Form->control('configuration_animations.2.nbr_pose',['label' => false, 'options'=>$muliposeBOptions,'id'=>'id_nombreDePose_bandelette',"empty"=>'Séléctionner']); 
         ?>
     </div>
     <div class="clearfix"></div>
    <div class="kl_listeDispositionVignette row <?= !empty($configurationBorne->configuration_animations[2]->disposition_vignette_id) ? "":"hide" ?>" id="id_dispositionVignetteBandelette">
        <label class="col-md-12 kl_labelCustom">Disposition des vignettes </label>
        <?php 
        $optionDispositions = array();
        //debug($dispositionVignettes);
        //debug($configurationBorne->nb_pose_mulipose);
        foreach($dispositionVignettes as $disposition){ 
            if($disposition->type_animation_id == 3){
                $kl_selected = "";
                $kl_hide = "hide";
                if(!empty($configurationBorne->configuration_animations[2])){
                    if($disposition->id == $configurationBorne->configuration_animations[2]->disposition_vignette_id){
                        $kl_selected = "selected";
                    } 
                    if($disposition->nbr_pose == $configurationBorne->configuration_animations[2]->nbr_pose){
                        $kl_hide = "";
                    }
                }
        ?>
            <div data-animation="<?= $disposition->type_animation_id ?>" class="col-md-2 kl_oneDispostionBandelette kl_oneDispostion kl_dispositionVignette_<?= $disposition->nbr_pose ?>_pourAnimation_<?= $disposition->type_animation_id ?>  kl_dispositionVignette_<?= $disposition->nbr_pose ?> <?= $kl_selected." ".$kl_hide  ?>" data-key="<?= $disposition->id ?>" id="id_siposition_<?= $disposition->id ?>">
                <?= $this->Html->image('disposition_vignettes/'.$disposition->file_name, ['alt' => $disposition->id,'class' => 'kl_imageDisposition']); ?>
            </div>
        <?php 
            $optionDispositions[$disposition->id] = $disposition->id;
            }
        } 
        
        ?>
        
         <div class="col-md-12 hide">
             <?= $this->Form->control('configuration_animations.2.disposition_vignette_id',['label' => 'Dispositon vignette', 'options'=>$optionDispositions, 'empty'=>'Séléctionner', 'class'=>'no-style', 'id'=>'id_dispositionvignette_3']); ?>
        </div>
     </div>
   
</div>
<div class="col-12">
    <br /><hr><br />
</div>
<div class="kl_cadreSimple row col-12 ">
    <label class="col-md-12 p-l-0 kl_labelCustom">2 - Cadre :</label>
    <div class="col-md-12">
        <?php 
            $urlCadreSimple = null;
            if(!empty($configurationBorne->configuration_animations[2]->cadres)){
                    $cadre = $configurationBorne->configuration_animations[2]->cadres[0];
                    $fileName = $configurationBorne->configuration_animations[2]->cadres[0]->file_name;
                    $urlCadreSimple = Router::url('/', true).'import/config_bornes/'.$evenement->id.'/cadres/'.$fileName;
         ?>
            <input type="hidden" value="<?= $cadre->id ?>" name="configuration_animations[2][cadres][0][id]" />
            <input type="hidden" value="<?= $cadre->ordre ?>" name="configuration_animations[2][cadres][0][ordre]" />
            <input type="hidden" value="<?= $cadre->file_name ?>" name="configuration_animations[2][cadres][0][file_name]" />
        <?php }?>
        <input type="file" name="img_cadre_simpleBandelette" class="dropifyCadre" <?= !empty($urlCadreSimple) ? 'data-default-file="'.$urlCadreSimple.'"' : "" ?>   data-allowed-file-extensions="png"/>
    </div>
</div>
<div class="col-12">
    <br /><hr><br />
</div>
