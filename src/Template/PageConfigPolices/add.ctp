<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigPolice $pageConfigPolice
 */
?>

<?php
$titrePage = "Ajout police" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Ajouter un fond',['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse kl_btn_add_event" ]);
$this->end();
?>  


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?php echo $titrePage ?></h4>
				 <?= $this->Form->create($pageConfigPolice) ?>
					<div class="col-6" style="padding-left:0">
					<?php
						echo $this->Form->control('nom_police');
					?>
					</div>
					<div class="col-6" style="padding-left:0">
					<?php
						echo $this->Form->control('css_specification');
					?>
					</div>
					<div class="col-6" style="padding-left:0">
					<?php
						echo $this->Form->control('url_police');
					?>
					</div>
					<div class="text-xs-right">
						<?= $this->Html->link(__('Return of list'), ['action' => 'index'], ['class' => 'btn btn-inverse']) ?>
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>