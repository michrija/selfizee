<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CatalogueCadre $catalogueCadre
 */
?>
<?php use Cake\Routing\Router; ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->css('select2/select2.css', ['block' => true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->script('catalogues/catalogue_cadre.js', ['block' => true]); ?>

<?php
if($is_new) {
    $titrePage = "Créer un modèle de cadre";
} else {
    $titrePage = "Modifier un modèle de cadre";
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
                <?= $this->Form->create($catalogueCadre, ['type' => 'file']) ?>
                    <?= $this->Form->control('client_id',['value'=>$client->id,'type'=>'hidden']) ?>
                    <div class="form-body">
                     <style>span.select2.select2-container { width: 100% !important;} </style>
                        <div class="col-md-12">
                            <?php
                                echo $this->Form->control('titre');
                            ?>                            
                        </div>
                        <div class="col-md-12">
                            <?php
                                echo $this->Form->control('nbr_pose', ['options' => [1=>'1', 2=>'2', 3=>'3', 4=>'4'], 'empty' => false, 'required' => true]);
                                echo $this->Form->control('themes._ids', ['class'=> 'select2', 'options'=> $themes, 'empty'=> 'Séléctionner', 'required' => true, 'label' => 'Thème(s)', 'templateVars'=>['help'=>$this->html->link('Ajouter thème', ['controller'=>'Themes', 'action'=>'add', $client->id], ['target' => '_blank']) ]]);
                                echo $this->Form->control('format_id', ['options' => $formats, 'empty' =>  'Séléctionner', 'required' => true]);
                            ?>
                        </div>

                        <div class="col-md-12 bloc_image_fond_cadre">
                            <?php $url_fond = null;
                                if(!$is_new) {
                                    $url_fond = Router::url('/', true).'import/config_bornes/cadre_catalogue/'.$client->id.'/'.$catalogueCadre->file_name;
                                } 
                            ?>
                            <div class="row ">
                                <div class="col-md-4 bloc_fond" >                                
                                    <div class="cf_blocDropify">
                                        <input  type="file" name="catalogue_cadre_file" class="dropify_image_fond" accept=".jpg, .jpeg, .png" data-default-file="<?= $url_fond ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><br>
                    <div class="form-actions">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


