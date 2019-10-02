<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>
<div class="sf-step sf-impression">
    <div class="row col-md-12 m-t-15">
        <label class="col-md-12">Autoriser l’impression </label>
        <div class="col-md-4">
            <div class="row p-l-15 p-r-15">
                <label class="custom-control custom-radio" for="autorise_impression_oui">
                    <input type="radio" name="is_impression" id="autorise_impression_oui" value="1" class="custom-control-input" <?php echo $configurationBorne->is_impression || $configurationBorne->is_impression == null ? 'checked="checked"' : '' ?>>
                    <span class="custom-control-label m-r-40">Oui</span>
                </label>
                <label class="custom-control custom-radio" for="autorise_impression_non">
                    <input type="radio" name="is_impression" id="autorise_impression_non" value="0" class="custom-control-input" <?php echo ($configurationBorne->is_impression != null && $configurationBorne->is_impression == 0 ? 'checked="checked"' : '');?>>
                    <span class="custom-control-label">Non</span>
                </label>
            </div>
        </div>
    </div><br>
    <div id="id_siImpression" class="<?= $configurationBorne->is_impression || is_null($configurationBorne->is_impression) ? "":"hide" ?> col-md-12 row cf_impression">
        <div class="row col-md-12 m-t-15">
            <label class="col-md-12">Activer la multi-impression</label>
            <div class="col-md-4">
                <div class="row p-l-15 p-r-15">
                    <label class="custom-control custom-radio" for="is_multi_impression_oui">
                        <input type="radio" name="is_multi_impression" id="is_multi_impression_oui" value="1" class="custom-control-input"  <?php echo ($configurationBorne->is_multi_impression == 1 ? 'checked="checked"' : '');?>>
                        <span class="custom-control-label m-r-40">Oui</span>
                    </label>
                    <label class="custom-control custom-radio" for="is_multi_impression_non">
                        <input type="radio" name="is_multi_impression" id="is_multi_impression_non" value="0" class="custom-control-input" <?php echo ($configurationBorne->is_multi_impression == 0 ? 'checked="checked"' : '');?>>
                        <span class="custom-control-label">Non</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 row <?= $configurationBorne->is_multi_impression ? "":"hide" ?>" id="id_nbrMaxMultiImpression">							
            <label class="col-md-12">Nombre maximum en multi-impression</label>
                <?php
                    $nbr_max_multi_impression = null;
                    if(!empty($configurationBorne->nbr_max_multi_impression)){
                        $nbr_max_multi_impression = $configurationBorne->nbr_max_multi_impression;
                    }
                ?>
                <div class="col-md-2">
                    <?= $this->Form->control('nbr_max_multi_impression',['label' =>  false, 'type'=>'number', 'value' => $nbr_max_multi_impression, 'style'=>'width: 55%;']); ?>
                </div>
        </div>
        <div class="row col-md-12 m-t-15">
            <label class="col-md-12">Mettre une limite au nombre d'impressions de l'événement</label>
            <div class="col-md-4">
                <div class="row p-l-15 p-r-15">
                    <label class="custom-control custom-radio" for="has_limite_impression_oui">
                        <input type="radio" name="has_limite_impression" id="has_limite_impression_oui" value="1" class="custom-control-input" <?php echo ($configurationBorne->has_limite_impression == 1 ? 'checked="checked"' : '');?>>
                        <span class="custom-control-label m-r-40">Oui</span>
                    </label>
                    <label class="custom-control custom-radio" for="has_limite_impression_non">
                        <input type="radio" name="has_limite_impression" id="has_limite_impression_non" value="0" class="custom-control-input" <?php echo ($configurationBorne->has_limite_impression == 0 ? 'checked="checked"' : '');?>>
                        <span class="custom-control-label">Non</span>
                    </label>
                </div>
            </div>
        </div>
            
        <div class="row col-md-12 <?= $configurationBorne->has_limite_impression ? "":"hide" ?>" id="id_nbrMaxPhoto" >
            <?php
                $num_max = null;
                if(!empty($configurationBorne->nbr_max_photo)){
                    $num_max = $configurationBorne->nbr_max_photo;
                }
            ?>
            <label class="col-md-12">Nombre de photos maximum sur l’événement</label>
            <div class="col-md-2">
                <?= $this->Form->control('nbr_max_photo',['label' => false, 'type'=>'number', 'value'=>$num_max, 'style'=>'width: 55%;']); ?>
            </div>
        </div>
        <div class="row col-md-12 m-t-20">							
            <label class="col-md-12">Texte d’impression</label>
            <?= $this->Form->control('texte_impression',['type'=>'text','label' => ['text' =>false, 'class' => 'm-r-15'],'default'=>'Impression...', 'class' => "form-control w-150", 'style'=>'width: 385px !important;', 'value' => $configurationBorne->texte_impression]); ?>
        </div>							
            
        <div class="row col-md-12">
            <label class="col-md-12">Impression automatique</label>
            <div class="col-md-4">
                <div class="row p-l-15 p-r-15">
                    <label class="custom-control custom-radio" for="is_impression_auto_oui">
                        <input type="radio" name="is_impression_auto" id="is_impression_auto_oui" value="1" class="custom-control-input" <?php echo ($configurationBorne->is_impression_auto == 1 ? 'checked="checked"' : '');?>>
                        <span class="custom-control-label m-r-40">Oui</span>
                    </label>
                    <label class="custom-control custom-radio" for="is_impression_auto_non">
                        <input type="radio" name="is_impression_auto" id="is_impression_auto_non" value="0" class="custom-control-input" <?php echo ($configurationBorne->is_impression_auto == 0 ? 'checked="checked"' : '');?>>
                        <span class="custom-control-label">Non</span>
                    </label>
                </div>
            </div>
        </div>
            
        <div class="row col-md-12" <?= $configurationBorne->is_impression_auto ? "":"hide" ?>" id="id_nbrImpressionAuto">
                <?php
                    $nbr_copie_impression_auto = null;
                    if(!empty($configurationBorne->nbr_max_multi_impression)){
                        $nbr_copie_impression_auto = $configurationBorne->nbr_copie_impression_auto;
                    }
                ?>
            <label class="col-md-12 nbr_copie_impr_auto hide">Nombre de copies par impression automatique</label>
            <div class="col-md-2 nbr_copie_impr_auto hide">
                <?= $this->Form->control('nbr_copie_impression_auto',['label' => false, 'type'=>'number', 'value' => $nbr_copie_impression_auto, 'style'=>'width: 55%;']); ?>
            </div>
        </div>
    
        <div class="row col-md-12">
            <label class="col-md-12">Décompte Timeout</label>
            <div class="col-md-2">
                <?= $this->Form->control('decompte_time_out',['label' => false,'id'=>'id_decompteTimeOut','default' =>'80', 'value' =>$nbr_copie_impression_auto, 'style'=>'width: 55%;']); ?>
            </div>
        </div>
    </div>
</div>