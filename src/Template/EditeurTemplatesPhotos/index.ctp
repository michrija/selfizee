<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\ModelBorne[]|\Cake\Collection\CollectionInterface $modelBornes
*/
?>

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>

<?= $this->Html->script('footable/footable.all.min.js', ['block' => true]); ?>
<?= $this->Html->script('footable-init.js', ['block' => true]); ?>

<?= $this->Html->css('fenetre-perso.css', ['block' => true]) ?>
<?= $this->Html->script('fenetre-perso.min.js', ['block' => true]); ?>    

<?= $this->Html->script('EditeurTemplatesPhotos/index.js?'.time(), ['block' => true]); ?>
<?= $this->Html->css('EditeurTemplatesPhotos/index.css?'.time(), ['block' => true]) ?>
    
<?php
$titrePage = "Liste des photos" ;
$this->assign('title', $titrePage);

$this->start('breadcumb');

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                           
$this->end();

?>  
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
				<?php echo $this -> Form -> create('EditeurTemplatePhotos', ['id' => 'EditeurTemplatePhotoForm']); ?>                            
				<div class="row m-t-15">
					<div class="col-md-2 p-r-0">
						<div class="form-group">
							<?php echo $this->Form->control('key', ['placeholder' => 'Rechercher...', 'class' => 'form-control search', 'label' => false]); ?>
						</div>
					</div>
					<div class="col-md-2 p-r-0">
						<?php echo $this->Form->control('editeur_template_id', ['options' => $editeurTemplates, 'class' => 'form-control sf-type_image', 'label' => false, 'multiple' => true]); ?>
					</div>
					<div class="col-md-2 p-r-0">
						<?php echo $this->Form->control('tag_id', ['options' => $editeurTags, 'class' => 'form-control sf-tag', 'label' => false, 'multiple' => true]); ?>
					</div>
					<div class="col-md-6 p-l-15">                                   
						<button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Filtrer</button>                                        
						<a href="/editeur-templates-photos" class="btn btn-primary m-l-15"><i class="fa fa-refresh"></i> Réinitialiser</a>                                    
					</div>
				</div>
				<hr>
				<?php echo $this -> Form -> end(); ?>
			
			
			
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('file', 'Apercus') ?></th>
                                <th scope="col">Tags liés</th>
                                <th scope="col"><?= $this->Paginator->sort('editeur_template_id', 'Catégorie') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('editeur_template_id', 'Sous-catégorie') ?></th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($editeurTemplatesPhotos as $key => $editeurTemplatesPhoto): $tags = $editeurTemplatesPhoto['tags']?>
                                <tr>
                                    <td>
                                    <div class="mb-2"><img class="sf-editeur-photo" src="<?= $this->Url->build($editeurTemplatesPhoto->get('fileThumbnailPath')) ?>" alt=""></div>
                                    </td>
									<td>
                                    <?php 
										$tag_tp = [];
										foreach ($tags as $key => $tag): 
											array_push($tag_tp, $tag->id);
									?>
											<a href="<?= $this->Url->build(['controller' => 'EditeurTemplatesPhotos', 'action' => 'index',$tag->id]) ?>"class="badge badge-primary"><?= $tag->nom ?></a>
                                    <?php 
										endforeach;
									?>
									</td>
                                    <td class="text-uppercase"><?= $editeurTemplatesPhoto->editeur_template->type_menu ?></td>
                                    <td class="text-capitalize"><?= $editeurTemplatesPhoto->editeur_template->type_editeur ?></td>

                                    <td>
                                        <?= $this->Html->link('<i class="fa fa-tags"></i>', ['action' => 'edit', $editeurTemplatesPhoto->id], ['class' => 'text-primary fs-20 m-r-15 sf-add-tags', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Gérer les tags', 'data-placement' => 'bottom', 'data-img' => $this->Url->build($editeurTemplatesPhoto->get('filePath')), 'data-tag' => json_encode($tag_tp), 'data-id' => $editeurTemplatesPhoto->id]) ?>
                                        <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $editeurTemplatesPhoto->id], ['class' => 'text-danger fs-20', 'confirm' => __('Are you sure you want to delete ?'), 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Supprimer cette photo', 'data-placement' => 'bottom']) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="text-right">
                                    <ul class="pagination">
                                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                        <?= $this->Paginator->numbers() ?>
                                        <?= $this->Paginator->next(__('next') . ' >') ?>
                                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
	var tags = <?php echo json_encode($editeurTags); ?>;
</script>
