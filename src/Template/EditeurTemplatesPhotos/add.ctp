<?= $this->Html->script('dropzone/dropzone.js', ['block' => true]); ?>
<?= $this->Html->css('dropzone/dropzone.css', ['block' => true]) ?>

<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>

<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>    

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>

<?= $this->Html->script('EditeurTemplatesPhotos/add.js?'.time(), ['block' => true]); ?>


<?php
    $titrePage = "Gestion photo dans éditeur de template" ;
    $this->assign('title', $titrePage);

    $this->start('breadcumb');

    $this->Breadcrumbs->add($titrePage);

    echo $this->element('breadcrumb',['titrePage' => $titrePage]);
    $this->end();
?>
<?= $this->Form->create($editeurTemplatesPhoto, ['type' => 'file', 'id' => 'form-photos']) ?>
    
    <div class="container-alert d-none" onclick="this.classList.add('d-none')">
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div class="message"></div>
        </div>
        <!-- JS Callback alert -->
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-new-selfizee" id="id_configEmail">
                <div class="card-header border-bottom">
                    <div class="row-fluid  d-none">
                        <?= $this->Form->control('file', ["id"=>"photo_id","label"=>"Photo","class"=>"dropify","type"=>"file", "accept"=>"image/*",'data-default-file' => $this->Url->build($editeurTemplatesPhoto->get('filePath'))]); ?>
                    </div>
                    <?= $this->Form->control('editeur_template_id', ['options' => $editeurTemplates, 'empty' => 'Séléctionner le type', 'required', 'class' => 'form-control to-deactive custom-select', 'label' => 'Type d\'image template']); ?>
                    
                    <div class="row-fluid mt-2">
                        <label for="tags" class="control-label">Tags</label>
                        <?php
                        // Select multiple pour belongsToMany
                            echo $this->Form->control('tags', [
                                'type' => 'select',
                                'multiple' => true,
                                'options' => $tags,
                                'class' => 'select2 form-control',
                                'label' => false,
                                'hiddenField' => false,
                                'templates' => [
                                    'inputContainer' => '<div class="form-group"><div class="row-fluid">{{content}}</div><span class="help-block"><small><em>Vous avez la possibilité d\'ajouter d\'autres tags.</em></small></span></div>',
                                ]
                            ]);
                        ?>
                    </div>
					
                    <div class="row-fluid">
                        <div class="dropzone" data-srcurl="<?= $this->Url->build('/', true) ?>">
                            <div class="fallback">
                                <?= $this->Form->control('file', ['multiple']); ?>
                            </div>
                         </div>
                    </div>
					
                    <?= $this->Form->button(__('Enregistrer'),["class"=>"btn btn-danger col-2 m-t-15 pull-right submit-multi",'escape'=>false]) ?>
                    <?= $this->Html->link(__('Retour à la liste'),['action' => 'index'], ["class"=>"btn btn-secondary col-2 m-t-15 m-r-10 pull-right",'escape'=>false]) ?>

                </div>
            </div>
        </div>

    </div>
 <?= $this->Form->end() ?>    