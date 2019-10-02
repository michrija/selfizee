<?= $this->Html->css('configurations/board.css', ['block' => true]) ?>
<?= $this->Html->css('evenements/add.css?t='.time(), ['block' => true]) ?>
<?= $this->Html->script('Evenements/gestion-fonctionnalite.js', ['block' => true]) ?>
<div class="row">
    <div class="col-md-12">
            <div class="card card-outline-info">
        		<div class="row kl_titreBlocCadre">
        			<div class="col-md-6 kl_theTitreCadreBlock">Fonctionnalités activées </div>
        			<div class="col-md-6 kl_theActionIntitre kl_titreLink">
                        <?php echo $this->Html->link('Voir les fonctionnalités activées',['controller'=>'Configurations', 'action'=>'board', $idEvenement],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite" ]); ?>
                    </div>
        		</div>
            	<div class="card-body-custom" id="id_listeFonctionInBoard">
                    <?= $this->Form->create($evenement) ?>
            		<?php 
                            $listeIdFonctionnalite = array();
                            foreach($fonctionnalites as $fonctionnalite){ 
                            $kl_link ='kl_disable';
                            $textDesact = 'Activer';
                            $kl_icon = 'fa-check';
                            if(!empty($listIdFonctionnaliteActive)){
                                if(in_array($fonctionnalite->id,$listIdFonctionnaliteActive)){
                                    $kl_link = '';
                                    $textDesact = 'Désactiver';
                                    $kl_icon = "fa-times-circle";
                                }
                            }

                    ?>
                            <div class="row col-12 kl_oneOption">
                                <div class="col-md-9 col-sm-12 kl_theFletOneOption">
                                    <div class="kl_titreOptionMark"><?= $fonctionnalite->nom ?> <div class="kl_iconInterogation">?</div> </div>
                                    <div class="kl_descOpton"><?= $fonctionnalite ->description ?></div>
                                </div>
                                <div class="col-md-3 col-sm-12 kl_nopaddingR">
                                    <div class="customBtn pull-right">
                                        <a href="#" id="id_toActive_<?= $fonctionnalite->id ?>" class="btn kl_checkSelfizee <?= $kl_link ?> "><i class="fa <?= $kl_icon ?>"></i> <span class="kl_texteAremplacer"><?= $textDesact ?></span> la fonctionnalité</a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $listeIdFonctionnalite[$fonctionnalite->id] = $fonctionnalite->id;
                            } 
                            ?>
                            <div class="hide">
                                <?php
                                echo $this->Form->control('fonctionnalites._ids', [
                                    'type' => 'select',
                                    'multiple' => true,
                                    'options' => $listeIdFonctionnalite,
                                    'selected' => $listIdFonctionnaliteActive,
                                    'id' => 'id_selecteFonctionnaite',
                                    'class' => 'col-6',
                                    'label' => false
                                ]);
                                ?>
                               <?php echo $this->Form->control('client_id',['label' =>false  ,'type'=>'text', 'value'=>$evenement->client_id,'required'=>true,'class'=>'form-control']); ?>
                                    
                            </div>
                            <div class="form-actions">
                                <?= $this->Form->button(__('Save'),["class"=>"btn btn-success m-t-15 pull-right",'escape'=>false]) ?>
                            </div>
                    <?= $this->Form->end() ?>
            	</div>
            </div>
    </div>
</div>
