<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement $evenement
 */
?>
<?= $this->Html->script('speackingurl/speakingurl.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>

<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>

<?= $this->Html->css('html5-editor/bootstrap-wysihtml5.css', ['block' => true]) ?>
<?= $this->Html->script('html5-editor/wysihtml5-0.3.0.js', ['block' => true]); ?>
<?= $this->Html->script('html5-editor/bootstrap-wysihtml5.js', ['block' => true]); ?>

<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>

<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<?= $this->Html->script('Galeries/add.js', ['block' => true]); ?>

<?php
$titrePage = "Modification de la galerie";
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
'Galeries',
['controller' => 'Galeries', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

if(!empty($galery->id)){
        $this->start('actionTitle');
        $this->Html->link('<i class="mdi mdi-eye"></i> Visualiser la galerie',['controller'=>'Galeries','action'=>'souvenir', $galery->id_encode],['target'=>'_blank','escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
        $this->end();
}

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->assign('title', $titrePage);
?>

<?= $this->Form->create($galery,['type'=>'file']) ?>
<div class="row">
    <div class="col-lg-9">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Information générales</h4>
            </div>
            <div class="card-body">
                <div class="form-body">
                    <div class="row p-t-20">
                       
						<div class="col-md-12">
							<?php 
								echo $this->Form->control('nom',['label'=>'Titre de la galerie','id'=>'id_nomGalerie']);
								echo $this->Form->control('slug',['label'=>'Identifiant de la galerie (*)','required'=>true,'id'=>'id_identifiantGalerie']);
                                
                                echo $this->Form->control('evenements._ids', [
                                    'type' => 'select',
                                    'multiple' => true,
                                    'options' => $evenements,
                                    'class' => 'select2 form-control'
                                ]);
                                
								echo $this->Form->control('is_public',['label'=>'La galerie est publique','type'=>'checkbox']);
                                echo $this->Form->control('is_livredor_active',['label'=>'Livre d\'or actif ?','type'=>'checkbox']);
                                echo $this->Form->control('couleur',['label'=>'Couleur du thème','class'=>'form-control colorpicker']);
								echo $this->Form->control('titre',['class'=>'textarea_editor form-control','type'=>'textarea']);
								echo $this->Form->control('sous_titre',['class'=>'textarea_editor2 form-control','type'=>'textarea']);
								//echo $this->Form->control('img_banniere');
                                
                                
							?>
						</div>
                        <div class="hide">
                                <?php 
                                 echo $this->Form->control('user.username',['class'=>'form-control','id'=>'id_loginGalerie', 'value'=>$galery->slug]);
                                echo $this->Form->control('user.password',['class'=>'form-control', 'value'=>$galery->slug,'type'=>'text','id'=>'id_passwordGalerie', 'class' => '']);
                                echo $this->Form->control('user.role_id',['class'=>'form-control','value' => 3, 'type'=>'text', 'class' => '']);
                                 ?>
                        </div>
                        
                        <div class="col-md-12 m-b-15">
                            <label>Image Bannière :</label>
                            <?php
                                $banniere = "";
                                if(!empty($galery->img_banniere)){
                                    $banniere = "data-default-file=".$galery->url_banniere ;
                                }
                            ?>
                            <input type="file" name="img_banniere_file" class="dropify"  <?= $banniere ?> />
                        </div>
                        <!--/span-->
                    </div>
                </div>
                <div class="form-actions">
                    <?php $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <a href="<?= $this->Url->build(['controller'=>'Galeries','action'=>'souvenir', $galery->id_encode]) ?>" class="btn btn-default btn-grey btn-selfizee-new btn-block" > Aperçu</a>
        <?= $this->Form->button(__('Save'),["class"=>"btn btn-success btn-block",'escape'=>false]) ?>
    </div>
</div>