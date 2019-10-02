<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Catalogue $catalogue
 */
?>
<?php use Cake\Routing\Router; ?>
<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>

<?= $this->Html->script('catalogues/add.js', ['block' => true]); ?>

<?php
if($is_new) {
    $titrePage = "Créer un modèle de mise en page";
} else {
    $titrePage = "Modifier un modèle de mise en page";
}
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

//echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>

<style>
.btn_suppr_bloc, .btn_suppr_bloc_edit {
    background: #e72763 url(/img/gallery/dz_rm.png) no-repeat scroll 6px 6px;
    border-radius: 25px;
    width: 30px;
    height: 30px;
}
</style>

<div class="clearfix"></div>
<div class="row">
<div class="col-lg-12">
    <div class="card card-new-selfizee">
        <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                <?php echo $this->Html->link(__('Liste des modèles'),['action'=>'liste', $client->id],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite pull-right" ]); ?>
            </div>
        <div class="card-body">
            <?= $this->Form->create($catalogue, ['type' => 'file']) ?>
                <?= $this->Form->control('client_id',['value'=>$client->id,'type'=>'hidden']) ?>
                <div class="form-body">
                     <div class="col-md-12">
                     <style>span.select2.select2-container { width: 100% !important;} </style>
                        <?php         
                                echo $this->Form->control('nom', ['required' => true, 'placeholder' => 'Flamingo']); 
                                echo $this->Form->control('description', [ 'placeholder' => 'Thème floral pour mariage ...']);
                                echo $this->Form->control('themes._ids', ['class'=> 'select2', 'options'=> $themes, 'empty'=> 'Séléctionner', 'required' => true, 'label' => 'Thème(s)', 'templateVars'=>['help'=>$this->html->link('Ajouter thème', ['controller'=>'Themes', 'action'=>'add', $client->id], ['target' => '_blank']) ]]);
                                //echo $this->Form->control('format_id', ['options'=> $formats,'empty'=> 'Séléctionner', 'required' => true]);                
                        ?>
                     </div>
                     <hr>
                     <div class="col-md-12 titre_fond_cat p-b-25">
                        <label class="control-label">Image des fonds</label>
                        <ul class="list-inline pull-right">                        
                            <button type="button" class="btn btn-success btn_ajout_autre_fond">Ajouter un autre fond</button>
                        </ul>
                    </div>
                    <?php 
                        if(!$is_new) {
                            foreach($catalogue->image_fonds as $key => $image_fond) { //$evenement->id
                                echo $this->Form->control('fond_to_delete.'.($key),["type"=>"hidden","id"=>"fond_to_delete_".$key]);
                                $url_fond = Router::url('/', true).'import/config_bornes/ecran_catalogue/'.$client->id.'/'.$image_fond->file_name; ?>    
                                <?php if($key != 0) { ?>  <hr class="divider_bloc_<?= $key ?>  m-t-30 m-b-30"> <?php } ?>                   
                                    <div class="col-md-12 bloc_image_fond" id='bloc_image_fond_<?= $key ?>'>                                    
                                        <?php echo $this->Form->control('image_fonds.'.$key.'.id',["type"=>"hidden", "class"=>"id_fond"]) ?>
                                        <div class="row ">
                                            <div class="col-md-4 bloc_fond" >                                
                                                <div class="cf_blocDropify">
                                                    <input  type="file" name="image_fonds_files[]" class="dropify_image_fond" id='image_fonds_files_<?= $key ?>'  accept="image/*"  data-default-file="<?= $url_fond ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-3 bloc_type_fond">                               
                                                <?php
                                                        $types = ['accueil' => 'Accueil'/*, 'cadre' => 'Cadre'*/, 'prise_photo'  => 'Prise de photo', 'filtre'  => 'Filtre', 'remerciement'  => 'Remerciement', 'visualisation' => 'Visualisation de photo', 'choix_fv' => 'Choix du fond vert', 'selection_mult_config' => 'Sélection multiple configuration'];
                                                        echo $this->Form->control('image_fonds.'.$key.'.type', ['label' => 'Page', 'options'=> $types, 'required' => true]);              
                                                ?>
                                            </div>                                    
                                                <div class="col-md-5">
                                                    <ul class="list-inline pull-right">
                                                    <?php if($key == 0) { ?> 
                                                            <!--<button type="button" class="btn btn-success btn_ajout_autre_fond">Ajouter un autre fond</button> -->
                                                        <?php } else {?>
                                                        <span class="btn btn_suppr_bloc_edit" id="btn_suppr_bloc_<?= $key."_".$image_fond->id ?>"></span>
                                                    <?php } ?>
                                                    </ul>
                                                </div>
                                        </div>
                                    </div>

                         <?php   }
                        } else { ?>
                                    <div class="col-md-12 bloc_image_fond" id='bloc_image_fond_0'>
                                        <div class="row ">
                                            <div class="col-md-4 bloc_fond" >                                
                                                <div class="cf_blocDropify">
                                                    <input  type="file" name="image_fonds_files[]" class="dropify_image_fond" id='image_fonds_files_0'  accept="image/*" required='required' >
                                                </div>
                                            </div>
                                            <div class="col-md-3 bloc_type_fond">                               
                                                <?php
                                                        $types = ['accueil' => 'Accueil'/*, 'cadre' => 'Cadre'*/, 'prise_photo'  => 'Prise de photo', 'filtre'  => 'Filtre', 'remerciement'  => 'Remerciement', 'visualisation' => 'Visualisation de photo', 'choix_fv' => 'Choix du fond vert', 'selection_mult_config' => 'Sélection multiple configuration'];
                                                        echo $this->Form->control('image_fonds.0.type', [ 'label' => 'Page', 'options'=> $types, 'required' => true]);               
                                                ?>
                                            </div>
                                            <div class="col-md-5 "> 
                                                <ul class="list-inline pull-right ">
                                                   <!-- <button type="button" class="btn btn-success btn_ajout_autre_fond">Ajouter un autre fond</button>-->
                                                    <span class="btn btn_suppr_bloc" id="btn_suppr_bloc_0" ></span>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                    <?php } ?>

                </div><br>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>

