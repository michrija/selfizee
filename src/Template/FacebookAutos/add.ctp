<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>


<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<?= $this->Html->script('facebookAutos/selectAlbum.js',["type"=>"application/javascript","block"=>true]) ?>



<?php
$titrePage = "Publication automatique sur Facebook " ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
$evenement->nom,
['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);
$titre = "Séléction d'un album Facebook pour la page : ".$namePageFacebook;
echo $this->element('breadcrumb',['titrePage' => $titre]);
$this->end();


?>

<div class="row">
<div class="col-lg-12">
    <div class="card card-new-selfizee" >
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black"><?= $titrePage ?> </h4>
            </div>
        <div class="card-body">
            <?php echo $this->Form->create($facebookAuto,array('id'=>'album_facebook')); 
            
                $myTemplates = [
                    'nestingLabel' => '{{hidden}}<label class="custom-control custom-radio col-sm-4" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
                    'dateWidget' => '<div class="col-md-6">{{day}}{{month}}{{year}} <span class="seperate">-</span> {{hour}} h {{minute}}{{second}}{{meridian}}</div>',
                    'select' => '<select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select>',
                ];
                
                $this->Form->setTemplates($myTemplates); 
            ?>
            
            
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-12">
                            <?php
                                $listeAlbum = array();
                                if(!empty($fbAlbums)){
                                    foreach ($fbAlbums as $fbAlbum) {
                                        $listeAlbum[$fbAlbum["id"]] = $fbAlbum["name"];
                                        echo '<input type="radio" id="id_album_name_'.$fbAlbum['id'].'" value="'.$fbAlbum['name'].'" name="name_album_in_facebook" class="hide" />';
                                    }
                                }
                                $listeAlbum["create"] = __('Créer un album facebook');
                                
                                echo $this->Form->control('id_album_in_facebook', [
                                    'id'=>'id_listeAlbums',
                                    'type' => 'select',
                                    'multiple' => false,
                                    'options' => $listeAlbum,
                                    'label' => false,
                                    'required'=>true,
                                    'empty'=>__('Séléctionnez un album existant'),
                                    'class' => 'select2 form-control'
                                ]);
                                
                            ?>
                            <button type="button" class="btn btn-info" id="id_createNew"><i class="fa fa-plus"></i> Créer un nouvel album</button>
                            <?php
                                
                                echo $this->Form->control('id_in_facebook',['value'=>$idPageFacebook,'class'=>'hide','label'=>false]);
                                echo $this->Form->control('name_in_facebook',["value"=>$namePageFacebook,'class'=>'hide','label'=>false]);
                                echo $this->Form->control('token_facebook',['value'=>$tokenPageFacebook,'class'=>'hide','label'=>false]);
                                echo $this->Form->hidden('evenement_id', ['type'=>'text','value'=>$idEvenement,'class'=>'hide','label'=>false]);
                                    
                               
                            ?>
                        </div>
                        
                        <div class="col-md-12 hide" id="id_createAlbum">
                                    <?php 
                                        echo $this->Form->control('new_album_name', ['type'=>'text','label'=>'Nom de l\'album']);
                                        echo $this->Form->control('new_album_description', ['label'=>'Description de l\'album','type'=>'textarea']);
                                        //echo $this->Form->control('content',['label'=>'Contenu', 'type'=>'textarea','class'=>'form-control textarea_editor','rows'=>'20', 'templateVars' => ['help'=>'Astuce : synthaxe pouvant être utilisée dans le corps de mail : [[email]], [[prenom]], [[nom]], [[lien_partage]], [[extra]], [[extra2]], [[miniature]], [[miniature_lien]]']]);                         
                                        echo $this->Form->control('is_creation', ['type'=>'checkbox','id'=>'id_isCreation','label'=>false,'class'=>'hide']);
                                    ?>
                                 <hr />    
                        </div>
                       
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-4">Activer l'envoi automatique</label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php
                                        echo $this->Form->radio(
                                                'is_active',
                                                [
                                                    ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                    ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                ]
                                                ,['default' => 0, 'label' => "Activer l'envoi automatique", 'class'=>'kl_isActivedCron']
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 hide" id="id_toActiveCron">
                         <?php
                            echo $this->Form->control('date_debut',['label'=>['text'=>'Date de début','class'=>'col-md-6 m-t-15'], 'interval' => 15]);
                            echo $this->Form->control('date_fin',['label'=>['text'=>'Date de fin','class'=>'col-md-6'], 'interval' => 15]);
                            echo $this->Form->control('intervalle_id', ['options' => $intervalles,'class'=>'form-control col-md-6 m-l-15','label'=>['text'=>'Intervalle','class'=>'col-md-12']]);
                        ?>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-4">Activer l'envoi programme</label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php
                                        echo $this->Form->radio(
                                                'is_programmee',
                                                [
                                                    ['value' => 1, 'text' => 'Oui','class'=>'custom-control-input'],
                                                    ['value' => 0, 'text' => 'Non','class'=>'custom-control-input'],
                                                ]
                                                ,['default' => 0, 'label' => "Activer l'envoi programme", 'class'=>'']
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-12 hide" id="id_activeEnvoiProgramme">
                        <?php
                            echo $this->Form->control('date_programmee',['type'=>'datetime', 'label'=>['text'=>'Date programmée','class'=>'col-md-6 m-t-15'], 'interval' => 15]);
                            ?>
                        </div>
                        
                    <div class="form-actions col-12">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
                