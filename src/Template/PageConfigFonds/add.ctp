<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigFond $pageConfigFond
 */
?>

<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('PageConfig/page-config.js', ['block' => true]); ?>

<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>

<?php
$titrePage = "Ajout couleur de fonds" ;
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
				 <?= $this->Form->create($pageConfigFond) ?>
					<div class="form-group">
						<div class="controls col-md-5" style="padding:0;">
						<?php
							echo $this->Form->control('couleur', ['class' => 'form-control colorpicker1']);
						?>
						</div>
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