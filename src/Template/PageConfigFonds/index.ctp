<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigFond[]|\Cake\Collection\CollectionInterface $pageConfigFonds
 */
?>
<?php
$titrePage = "Liste des couleurs de fonds" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Ajouter un fond',['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse kl_btn_add_event" ]);
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
							<th><?= $this->Paginator->sort('couleur') ?></th>
							<th>Aperçus</th>
							<th><?= $this->Paginator->sort('created') ?></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($pageConfigFonds as $pageConfigFond): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?= $this->Html->link($pageConfigFond->couleur, ['action' => 'edit', $pageConfigFond->id]) ?></td>
							<td><div class="sf-apercus-couleur" style="background-color: <?php echo $pageConfigFond->couleur; ?>"></div></td>
							<td><span class="text-muted"><i class="fa fa-clock-o"></i> <?= h($pageConfigFond->created->format('Y-m-d H:i:s')); ?></span></td>
							<td>
								<?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $pageConfigFond->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigFond->id), 'escape' => false]) ?>
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

<?php if(false){ ?>
<div class="pageConfigFonds index large-9 medium-8 columns content">
    <h3><?= __('Page Config Fonds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('couleur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pageConfigFonds as $pageConfigFond): ?>
            <tr>
                <td><?= $this->Number->format($pageConfigFond->id) ?></td>
                <td><?= h($pageConfigFond->couleur) ?></td>
                <td><?= h($pageConfigFond->created->format('Y-m-d H:i:s')); ?></td>
                <td><?= h($pageConfigFond->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pageConfigFond->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pageConfigFond->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pageConfigFond->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigFond->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<?php } ?>
<style type="text/css">
	.sf-apercus-couleur{
		width: 100px;
		height: 30px;
		border: solid 1px #F2F2F2;
	}
</style>
