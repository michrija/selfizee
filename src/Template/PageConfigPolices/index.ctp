<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigPolice[]|\Cake\Collection\CollectionInterface $pageConfigPolices
 */
?>

<?php
$titrePage = "Liste des polices" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Ajouter une police',['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse kl_btn_add_event" ]);
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
							<th><?= $this->Paginator->sort('nom_police') ?></th>
							<th>url</th>
							<th><?= $this->Paginator->sort('created') ?></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($pageConfigPolices as $pageConfigPolice): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?= $this->Html->link($pageConfigPolice->nom_police, ['action' => 'edit', $pageConfigPolice->id]) ?></td>
							<td><?= h($pageConfigPolice->url_police) ?></td>
							<td><span class="text-muted"><i class="fa fa-clock-o"></i> <?= h($pageConfigPolice->created->format('Y-m-d H:i:s')); ?></span></td>
							<td>
								<?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $pageConfigPolice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigPolice->id), 'escape' => false]) ?>
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
<div class="pageConfigPolices index large-9 medium-8 columns content">
    <h3><?= __('Page Config Polices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_police') ?></th>
                <th scope="col"><?= $this->Paginator->sort('css_specification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url_police') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pageConfigPolices as $pageConfigPolice): ?>
            <tr>
                <td><?= $this->Number->format($pageConfigPolice->id) ?></td>
                <td><?= h($pageConfigPolice->nom_police) ?></td>
                <td><?= h($pageConfigPolice->css_specification) ?></td>
                <td><?= h($pageConfigPolice->url_police) ?></td>
                <td><?= h($pageConfigPolice->created) ?></td>
                <td><?= h($pageConfigPolice->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pageConfigPolice->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pageConfigPolice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pageConfigPolice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageConfigPolice->id)]) ?>
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
