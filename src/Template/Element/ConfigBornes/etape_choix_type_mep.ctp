
<div class="sf-step sf-step1 p-l-15 p-r-15">
    <div class="col-sm-12 m-b-15">
        <h5>Comment souhaitez-vous gérer la mise en page de votre cadre :</h5>
    </div>
        <ul class="sf-list-pers">
            <li class="p-30 p-l-50">
                <label class="custom-control custom-radio no-margin" for="mep_cadre_catalogue">
                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_catalogue" value="1" class="custom-control-input" <?php  echo $configurationBorne->type_mise_en_page_id == 1 ? 'checked="checked"' : '';?>>
                    <span class="custom-control-label m-l-20">Choisir et personnaliser un visuel choisi dans le catalogue</span>
                </label>
            </li> 
            <li class="p-30 p-l-50">
                <label class="custom-control custom-radio no-margin" for="mep_cadre_1">
                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_1" value="2" class="custom-control-input" <?php echo $configurationBorne->type_mise_en_page_id == 2 ? 'checked="checked"' : '';?>>
                    <span class="custom-control-label m-l-20">Importer ma propre mise en page</span>
                </label>
            </li>
            <li class="p-30 p-l-50 hide">
                <label class="custom-control custom-radio no-margin" for="mep_cadre_2">
                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_2" value="3" class="custom-control-input" <?php  echo $configurationBorne->type_mise_en_page_id == 3 ? 'checked="checked"' : '';?>>
                    <span class="custom-control-label m-l-20">Créer ma mise en page en ligne depuis une base vierge</span>
                </label>
            </li>
            <li class="p-30 p-l-50">
                <label class="custom-control custom-radio no-margin" for="mep_cadre_3">
                    <input type="radio" name="type_mise_en_page_id" id="mep_cadre_3" value="4" class="custom-control-input" <?php  echo $configurationBorne->type_mise_en_page_id == 4 ? 'checked="checked"' : '';?>>
                    <span class="custom-control-label m-l-20">Pas besoin de mise en page, prendre une photo sans personnalisation graphique</span>
                </label>
            </li>
        </ul>
    <!--</div> -->
    
    
    <div class="col-sm-12 float-right">
        <?php
            /*echo $this -> Form -> submit(
                'Continuer',
                [
                    'class' => 'btn btn-success float-right sf-btn-pers'
                ]
            );*/
        ?>
    </div>
</div>