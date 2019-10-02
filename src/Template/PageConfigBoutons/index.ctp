<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigBouton[]|\Cake\Collection\CollectionInterface $pageConfigBoutons
 */
?>
<?php
$titrePage = "Liste des boutons" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Ajouter un bouton',['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse kl_btn_add_event" ]);
$this->end();
$i=1;
?>  



<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title"><?php echo $titrePage ?></h4>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom bouton</th>
							<th>Aperçus</th>
							<th><?= $this->Paginator->sort('created') ?></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($pageConfigBoutons as $pageConfigBouton): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?= $this->Html->link($pageConfigBouton->tag, ['action' => 'edit', $pageConfigBouton->id]) ?></td>
							<td><img style="max-height:30px;" src="<?php echo '/import/config_pages/boutons/'.$pageConfigBouton->fichier; ?>"></td>
							<td><span class="text-muted"><i class="fa fa-clock-o"></i> <?= h($pageConfigBouton->created->format('Y-m-d H:i:s')); ?></span></td>
							<td>
								<?= $this->Html->link('<i class="mdi mdi-pencil"></i>',['action'=>'edit', $pageConfigBouton->id],['escape'=>false, 'class' => 'text-primary', 'style' => 'margin-right: 20px;']); ?>
								<?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $pageConfigBouton->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigBouton->id), 'escape' => false, 'class' => 'text-danger']) ?>
							</td>
						</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
